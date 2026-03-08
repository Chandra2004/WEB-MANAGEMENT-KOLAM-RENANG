<?php

namespace TheFramework\Http\Controllers;

use TheFramework\Http\Controllers\Controller;
use TheFramework\App\Request;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;

class NotificationController extends DashboardController
{
    public function notification()
    {
        return View::render('dashboard.general.notification', array_merge($this->dataTetap, [
            'title' => 'Notifikasi Saya ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website'
        ]));
    }
}