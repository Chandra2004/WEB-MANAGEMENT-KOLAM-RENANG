<?php

namespace TheFramework\Http\Controllers;

use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;
use TheFramework\Config\UploadHandler;
use TheFramework\Http\Controllers\Services\ErrorController;
use TheFramework\Http\Requests\EventRequest;
use TheFramework\Models\Category;
use TheFramework\Models\Event;
use TheFramework\Models\PaymentMethod;
use TheFramework\Models\Role;
use TheFramework\Models\User;

class EventController extends DashboardController
{
    protected Event $event;

    public function __construct()
    {
        parent::__construct();
        $this->event = new Event();
    }

    public function event($role, $page = 1)
    {
        $role = Helper::session_get('user')['nama_role'];

        switch ($role) {
            case 'admin':
            case 'coach':
                return View::render('dashboard.general.event', array_merge($this->dataTetap, [
                    'title' => 'Manajemen Event ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
                    'events' => Event::query()
                        ->select([
                            'events.*',
                            'categories.nama_kategori',
                            'users.nama_lengkap AS author'
                        ])
                        ->join('categories', 'events.uid_kategori', '=', 'categories.uid')
                        ->join('users', 'events.uid_author', '=', 'users.uid')
                        ->orderBy('tanggal_event', 'DESC')
                        ->paginate(10, $page),
        
                    'categories' => Category::query()
                        ->select([
                            'uid',
                            'nama_kategori'
                        ])->all(),
        
                    'authors' => User::query()
                        ->select([
                            'uid',
                            'nama_lengkap'
                        ])
                        ->where('uid_role', Role::where('nama_role', 'admin')->first()->uid)
                        ->orWhere('uid_role', '=', Role::where('nama_role', 'coach')->first()->uid)
                        ->all(),
        
                    'paymentMethods' => PaymentMethod::query()
                        ->select(['uid', 'bank', 'rekening', 'atas_nama'])
                        ->all()
                ]));
                break;
            case 'member':
                $event = Event::query()->with(['category', 'author'])->withCount(['registrations'])->orderBy('tanggal_event', 'DESC')->paginate(9, $page);
                return View::render('dashboard.member.event', array_merge($this->dataTetap, [
                    'title' => 'Event ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
                    'events' => $event
                ]));
                break;
            
            default:
                ErrorController::error403();
                break;
        }
    }

    public function eventCreateProcess($role, $uidUser, EventRequest $request)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            $newPhoto = null;
            if ($request->hasFile('banner_event')) {
                $newPhoto = UploadHandler::handleUploadToWebP($request->file('banner_event'), '/banner-event', 'event_');
                if (UploadHandler::isError($newPhoto)) {
                    throw new Exception(UploadHandler::getErrorMessage($newPhoto));
                }
            }

            $data = $request->validated();
            $data['uid'] = Helper::uuid();
            $data['slug'] = Helper::slugify($data['nama_event']);
            $data['banner_event'] = $newPhoto;
            $data['biaya_event'] = $data['tipe_event'] == 'berbayar' ? $data['biaya_event'] : null;
            $data['uid_payment_method'] = $data['tipe_event'] == 'berbayar' ? ($data['uid_payment_method'] ?? null) : null;

            $event = Event::query()->where('slug', '=', $data['slug'])->first();
            if ($event) {
                return Helper::redirect("/{$role}/dashboard/management-event", 'error', 'Event sudah ada', 10);
            }

            $this->event->addEvent($data);
            return Helper::redirect("/{$role}/dashboard/management-event", 'success', "Event {$data['nama_event']} berhasil ditambahkan", 10);
        } catch (Exception $e) {
            if ($newPhoto) {
                UploadHandler::delete($newPhoto, '/banner-event');
            }
            return Helper::redirect("/{$role}/dashboard/management-event", 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function eventEditProcess($role, $uidUser, $uidEvent, EventRequest $request)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            $event = Event::where('uid', $uidEvent)->first();
            $oldPhoto = $event['banner_event'];

            if (!$event) {
                ErrorController::error403();
            }

            $data = $request->validated();
            $data['slug'] = Helper::slugify($data['nama_event']);
            $data['biaya_event'] = $data['tipe_event'] == 'berbayar' ? $data['biaya_event'] : null;
            $data['uid_payment_method'] = $data['tipe_event'] == 'berbayar' ? ($data['uid_payment_method'] ?? null) : null;

            $newPhoto = null;
            if ($request->hasFile('banner_event')) {
                $newPhoto = UploadHandler::handleUploadToWebP($request->file('banner_event'), '/banner-event', 'event_');
                if (UploadHandler::isError($newPhoto)) {
                    throw new Exception(UploadHandler::getErrorMessage($newPhoto));
                }
                if ($event['banner_event'] != null)
                    UploadHandler::delete($oldPhoto, '/banner-event');
                $data['banner_event'] = $newPhoto;
            } else {
                unset($data['banner_event']);
            }

            $duplicateSlug = Event::query()
                ->where('slug', '=', $data['slug'])
                ->where('uid', '!=', $uidEvent)
                ->first();

            if ($duplicateSlug) {
                return Helper::redirect("/{$role}/dashboard/management-event", 'error', 'nama event sudah digunakan', 10);
            }

            $this->event->updateEvent($data, $uidEvent);
            return Helper::redirect("/{$role}/dashboard/management-event", 'success', "Event {$data['nama_event']} berhasil diperbarui", 10);
        } catch (Exception $e) {
            if ($newPhoto) {
                UploadHandler::delete($newPhoto, '/banner-event');
            }
            return Helper::redirect("/{$role}/dashboard/management-event", 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function eventDeleteProcess($role, $uidUser, $uidEvent)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            $event = Event::where('uid', $uidEvent)->first();

            if ($event === null) {
                return Helper::redirect("/{$role}/dashboard/management-event", 'error', 'Event tidak ditemukan', 10);
            }

            $this->event->deleteEvent($uidEvent);
            if ($event->banner_event) {
                UploadHandler::delete($event['banner_event'], '/banner-event');
            }
            return Helper::redirect("/{$role}/dashboard/management-event", 'success', "Event berhasil dihapus", 10);
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/management-event", 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }
}
