<?php

namespace TheFramework\Http\Controllers;

use Carbon\Carbon;
use Exception;
use TheFramework\App\Config;
use TheFramework\Http\Controllers\Controller;
use TheFramework\App\View;
use TheFramework\Config\EmailHandler;
use TheFramework\Helpers\Helper;
use TheFramework\Http\Controllers\Services\ErrorController;
use TheFramework\Http\Requests\ForgotPasswordRequest;
use TheFramework\Http\Requests\LoginRequest;
use TheFramework\Http\Requests\RegisterRequest;
use TheFramework\Http\Requests\ResetPasswordRequest;
use TheFramework\Models\ResetToken;
use TheFramework\Models\Role;
use TheFramework\Models\User;
use TheFramework\Http\Controllers\NotificationController;

class AuthController extends Controller
{
    protected User $user;
    protected ResetToken $resetToken;

    public function __construct()
    {
        $this->user = new User();
        $this->resetToken = new ResetToken();
    }

    public function register()
    {
        $notification = Helper::get_flash('notification');
        return View::render('auth.register', [
            'notification' => $notification,
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Daftar',
        ]);
    }

    public function login()
    {
        $notification = Helper::get_flash('notification');
        return View::render('auth.login', [
            'notification' => $notification,
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Masuk',
        ]);
    }

    public function forgotPassword()
    {
        $notification = Helper::get_flash('notification');
        return View::render('auth.forgot-password', [
            'notification' => $notification,
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Lupa Sandi',
        ]);
    }

    public function resetPassword($uid)
    {
        $notification = Helper::get_flash('notification');
        $data = $this->resetToken->query()->where('uid', '=', $uid)->first();

        if (empty($data)) {
            return ErrorController::error403();
        }

        return View::render('auth.reset-password', [
            'notification' => $notification,
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Reset Sandi',
            'data' => $data
        ]);
    }

    public function registerProcess(RegisterRequest $request)
    {
        $data = $request->validated();
        try {
            $userRole = (new Role())->query()->where('nama_role', '=', 'member')->first();
            $data['uid_role'] = $userRole ? $userRole->uid : null;
            $data['uid'] = Helper::uuid();
            $data['password'] = Helper::hash_password($data['password']);

            $checkEmail = $this->user->checkEmail($data['email']);
            $checkNomor = $this->user->checkNomor($data['no_telepon']);

            if ($checkEmail != null) {
                return Helper::redirect('/register', 'error', 'Email sudah terdaftar', 10);
            } else if ($checkNomor != null) {
                return Helper::redirect('/register', 'error', 'Nomor telepon sudah terdaftar', 10);
            } else {
                unset($data['password_confirm']);
                unset($data['checkbox']);
                $this->user->addUser($data);

                // Kirim notifikasi ke Admin
                NotificationController::sendToAdmin(
                    'Pendaftaran Member Baru',
                    "Halo Admin, ada member baru baru saja bergabung!<br><br><b>Nama:</b> {$data['nama_lengkap']}<br><b>Email:</b> {$data['email']}<br><br>Silakan cek manajemen pengguna untuk informasi lebih lanjut."
                );

                return Helper::redirect('/login', 'success', "Berhasil mendaftar, mohon untuk login {$data['nama_lengkap']}", 10);
            }
        } catch (Exception $e) {
            return Helper::redirect('/register', 'error', 'terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function loginProcess(LoginRequest $request)
    {
        $data = $request->validated();
        try {
            $user = $this->user->checkEmail($data['email']);

            if (!$user || !Helper::verify_password($data['password'], $user->password)) {
                return Helper::redirect('/login', 'error', 'Email atau kata sandi salah', 10);
            } else {
                Helper::session_write("user", $user, true);
                Helper::setAuthToken($user->uid);

                $dataUser = Helper::session_get("user");
                return Helper::redirect('/' . $dataUser['nama_role'] . '/dashboard', 'success', 'Selamat Datang ' . $dataUser['nama_lengkap'], 10);
            }
        } catch (Exception $e) {
            return Helper::redirect('/login', 'error', 'terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function forgotPasswordProcess(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $found = $this->user->query()->where('email', '=', $data['email'])->first();

        if ($found == null) {
            return Helper::redirect('/forgot-password', 'error', "Email tidak terdaftar di sistem kami", 10);
        }

        try {
            $timezone = Config::get('DB_TIMEZONE');
            $now = Carbon::now($timezone);

            $checkAvailability = $this->resetToken->query()->where('email', '=', $data['email'])->first();

            if ($checkAvailability) {
                $waktuDatabase = Carbon::parse($checkAvailability->valid_until, $timezone);
                // Cek apakah token yang ada masih valid
                if ($now->isBefore($waktuDatabase)) {
                    $sisaWaktu = $now->diffForHumans($waktuDatabase, true);
                    return Helper::redirect('/forgot-password', 'error', "Anda baru saja meminta token. Coba lagi dalam {$sisaWaktu}.", 10);
                }
            }

            $payload = [
                'uid' => Helper::uuid(),
                'token' => Helper::uuid(),
                'email' => $data['email'],
                'valid_until' => $now->copy()->addMinutes(5)->toDateTimeString(), // FIX: Menyimpan tanggal dan waktu lengkap
                'updated_at' => $now->toDateTimeString()
            ];

            if ($checkAvailability) {
                $this->resetToken->query()->where('email', $data['email'])->update($payload);
            } else {
                $this->resetToken->query()->insert($payload);
            }

            $htmlBody = Helper::renderToString('email.reset-password-notification', [
                'uid' => $payload['uid'],
                'token' => $payload['token'],
                'valid_until' => $payload['valid_until'],
            ]);

            EmailHandler::send($payload['email'], 'Permintaan Reset Password', $htmlBody);

            return Helper::redirect('/forgot-password', 'success', "Link reset password telah dikirim. Silakan cek email Anda.", 10);

        } catch (Exception $e) {
            return Helper::redirect('/forgot-password', 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function resetPasswordProcess($uid, ResetPasswordRequest $request)
    {
        try {
            $timezone = Config::get('DB_TIMEZONE');
            $now = Carbon::now($timezone);

            $requestData = $request->validated();
            $dataToken = $this->resetToken->query()
                ->where('uid', '=', $uid)
                ->where('email', '=', $requestData['email'])
                ->where('token', '=', $requestData['token'])
                ->first();

            if (empty($dataToken)) {
                return Helper::redirect("/reset-password/{$uid}", 'error', 'Token tidak valid atau informasi tidak cocok.', 10);
            }

            $validUntil = Carbon::parse($dataToken->valid_until, $timezone);

            if ($now->isAfter($validUntil)) {
                $this->resetToken->query()->where('id', $dataToken->id)->delete();
                return Helper::redirect('/forgot-password', 'error', "Token sudah kedaluwarsa. Silakan minta token baru.", 10);
            }

            $newPassword = Helper::hash_password($requestData['password']);
            $statusUpdate = $this->user->query()->where('email', $requestData['email'])->update(['password' => $newPassword]);

            if ($statusUpdate == 0) {
                return Helper::redirect("/reset-password/{$uid}", 'error', 'Gagal memperbarui kata sandi di database.', 10);
            }

            $this->resetToken->query()->where('id', $dataToken->id)->delete();
            return Helper::redirect("/login", 'success', "Kata sandi Anda berhasil diperbarui. Silakan masuk.", 10);

        } catch (Exception $e) {
            return Helper::redirect("/reset-password/{$uid}", 'error', 'Terjadi kesalahan sistem: ' . $e->getMessage(), 10);
        }
    }

    public function logout($role, $uidUser)
    {
        $status = $this->user->chechKredensial($role, $uidUser);

        if ($status) {
            Helper::session_destroy_all();
            Helper::redirect('/login', 'success', 'selamat tinggal');
        } else {
            Helper::redirect('/' . $role . '/dashboard', 'anda siapa??');
        }
    }
}
