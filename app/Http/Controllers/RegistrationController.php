<?php

namespace TheFramework\Http\Controllers;

use Carbon\Carbon;
use Exception;
use TheFramework\App\Config;
use TheFramework\App\View;
use TheFramework\Config\UploadHandler;
use TheFramework\Helpers\Helper;
use TheFramework\Http\Requests\RegistrationRequest;
use TheFramework\Models\Event;
use TheFramework\Models\Payment;
use TheFramework\Models\Registration;
use TheFramework\Models\Role;
use TheFramework\Models\User;

class RegistrationController extends DashboardController
{
    protected Registration $registration;
    protected Payment $payment;

    public function __construct()
    {
        parent::__construct();
        $this->registration = new Registration();
        $this->payment = new Payment();
    }

    public function registration()
    {
        $events = Event::query()
            ->select(['id', 'uid', 'nama_event', 'tipe_event', 'biaya_event', 'status_event', 'kuota_peserta'])
            ->with(['registrations.user', 'registrations.payment'])
            ->withCount(['registrations'])
            ->orderBy('tanggal_event', 'DESC')
            ->all();

        $users = User::query()->select(['id_user', 'uid', 'nama_lengkap', 'email'])->where('uid_role', '=', Role::where('nama_role', 'member')->first()->uid)->all();

        // return Helper::json(['users' => $users, 'events' => $events]);

        return View::render('dashboard.general.registration', array_merge($this->dataTetap, [
            'title' => 'Manajemen Pendaftaran ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
            'events' => $events,
            'users' => $users,
        ]));
    }

    // file: app/Http/Controllers/RegistrationController.php

    public function registrationHistory()
    {
        $userUid = Helper::session_get('user')['uid'];
        $events = Event::query()
            ->select(['id', 'uid', 'nama_event', 'tipe_event', 'biaya_event', 'status_event', 'kuota_peserta'])
            ->with(['registrations.user', 'registrations.payment'])
            ->withCount(['registrations'])
            ->orderBy('tanggal_event', 'DESC')
            ->all();

        $filteredRegistrations = [];
        foreach ($events as $event) {
            foreach ($event->registrations as $registration) {
                $filteredRegistrations[] = $registration;
            }
        }

        return Helper::json([
            'user' => Helper::session_get('user'),
            'event-kamu' => $filteredRegistrations,
            'events' => $events,
        ]);
    }



    public function registrationCreateProcess(RegistrationRequest $request)
    {
        $photoBukti = null;
        $event = Event::where('uid', $request->input('uid_event'))->first();
        $user = User::where('uid', $request->input('uid_user'))->first();

        $fallbackUrl = $event ? "/detail-event/{$event['slug']}/{$event['uid']}" : '/events';
        $redirectUrl = previous($fallbackUrl);

        if ($user == null || $event == null) {
            return Helper::redirect(previous('/events'), 'warning', 'Kredensial pengguna yang anda daftarkan tidak tersedia', 10);
        }

        $existingRegistration = Registration::query()->where('uid_user', '=', $user->uid)->where('uid_event', '=', $event->uid)->first();
        if ($existingRegistration) {
            return Helper::redirect($redirectUrl, 'warning', 'Anda sudah melakukan pendaftaran untuk event ini.', 10);
        }

        try {
            if ($event['kuota_peserta'] > 0) {
                if (Registration::query()->where('uid_event', '=', $event['uid'])->count() >= $event['kuota_peserta']) {
                    throw new Exception('Kuota pendaftaran untuk event ini sudah penuh.');
                }
            }

            if ($request->hasFile('bukti_pembayaran')) {
                $photoBukti = UploadHandler::handleUploadToWebP($request->file('bukti_pembayaran'), '/bukti-pembayaran', 'payment_proof_');
                if (UploadHandler::isError($photoBukti)) {
                    throw new Exception(UploadHandler::getErrorMessage($photoBukti));
                }
            }

            $dataRegistration = $request->validated();
            $dataRegistration['uid'] = Helper::uuid();
            $dataRegistration['nomor_pendaftaran'] = Helper::generateSecureRegNumber('REG');
            $dataRegistration['uid_user'] = $user['uid'];
            $dataRegistration['uid_event'] = $event['uid'];
            $dataRegistration['status'] = 'menunggu';
            $dataRegistration['tanggal_registrasi'] = Carbon::now(Config::get('DB_TIMEZONE'))->toDateTimeString();
            unset($dataRegistration['bukti_pembayaran']);

            $this->registration->addRegistration($dataRegistration);

            if ($event['tipe_event'] === 'berbayar') {
                if ($photoBukti == null) {
                    throw new Exception('Bukti pembayaran wajib diunggah untuk event berbayar.');
                }

                $dataPayment['uid'] = Helper::uuid();
                $dataPayment['uid_registration'] = $dataRegistration['uid'];
                $dataPayment['status_pembayaran'] = 'menunggu';
                $dataPayment['tanggal_pembayaran'] = $dataRegistration['tanggal_registrasi'];
                $dataPayment['bukti_pembayaran'] = $photoBukti;

                $this->payment->addPayment($dataPayment);
            }

            return Helper::redirect($redirectUrl, 'success', 'Pendaftaran berhasil, tunggu verifikasi.', 10);
        } catch (Exception $e) {
            if ($photoBukti) {
                UploadHandler::delete($photoBukti, '/bukti-pembayaran');
            }

            return Helper::redirect($redirectUrl, 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }
}
