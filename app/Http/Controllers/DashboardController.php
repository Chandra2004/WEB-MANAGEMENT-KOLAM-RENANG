<?php

namespace TheFramework\Http\Controllers;

use TheFramework\Http\Controllers\Controller;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use TheFramework\Http\Controllers\Services\ErrorController;
use TheFramework\Models\Event;
use TheFramework\Models\Notification;
use TheFramework\Models\Registration;
use TheFramework\Models\Role;
use TheFramework\Models\User;

class DashboardController extends Controller
{
    protected $data = [];
    protected $dataTetap = [];
    protected $notification = [];
    protected $roleSpesificData = [];

    public function __construct()
    {
        $this->notification = Helper::get_flash('notification');
        $this->dataTetap = [
            'notification' => $this->notification,
            'title' => 'Dashboard ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
            'user' => Helper::session_get("user"),
            'totalUnreadNotification' => Notification::query()->where('is_read', '=', 0)->where('uid_user', '=', Helper::session_get("user")['uid'])->count(),
            'unReadNotification' => Notification::query()->where('is_read', '=', 0)->where('uid_user', '=', Helper::session_get("user")['uid'])->all(),
        ];

        switch (Helper::session_get("user")['nama_role']) {
            case 'admin':
                $this->roleSpesificData = $this->getAdminData();
                break;
            case 'coach':
                $this->roleSpesificData = $this->getCoachData();
                break;
            case 'member':
                $this->roleSpesificData = $this->getMemberData();
                break;
            default:
                ErrorController::error403();
                break;
        }

        $this->data = array_merge($this->dataTetap, $this->roleSpesificData);
    }

    public function dashboard($role = null)
    {

        return View::render('dashboard.' . $role . '.dashboard', $this->data);
    }

    protected function getAdminData()
    {
        return [
            'totalAnggota' => User::query()->count(),
            'eventAktif' => Event::query()->where('status_event', '=', 'berjalan')->count(),
            'antreanValidasi' => Registration::query()->where('status', '=', 'menunggu')->count(),
            'members' => User::query()
                ->select([
                    'id_user',
                    'uid',
                    'nama_lengkap',
                    'tanggal_lahir',
                    'nama_klub',
                    'foto_profil'
                ])
                ->where('uid_role', Role::where('nama_role', 'member')->first()->uid)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->all()
        ];
    }

    protected function getCoachData()
    {
        return [
            'totalAnggota' => User::query()->count(),
            'eventAktif' => Event::query()->where('status_event', '=', 'berjalan')->count(),
            'antreanValidasi' => Registration::query()->where('status', '=', 'menunggu')->count(),
            'members' => User::query()
                ->select([
                    'id_user',
                    'uid',
                    'nama_lengkap',
                    'tanggal_lahir',
                    'nama_klub',
                    'foto_profil'
                ])
                ->where('uid_role', Role::where('nama_role', 'member')->first()->uid)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->all()
        ];
    }

    protected function getMemberData()
    {
        return [
            'events' => Event::query()->where('status_event', '=', 'berjalan')->orderBy('tanggal_event', 'DESC')->limit(2, 0)->all(),
            'members' => User::query()
                ->where('uid_role', Role::where('nama_role', 'member')->first()->uid)
                ->orderBy('created_at', 'DESC')
                ->all(),
            'coaches' => User::query()
                ->where('uid_role', Role::where('nama_role', 'coach')->first()->uid)
                ->orderBy('created_at', 'DESC')
                ->all()
            
        ];
    }
}
