<?php

namespace TheFramework\Http\Controllers;

use TheFramework\Http\Controllers\Controller;
use TheFramework\App\Request;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;

class CoachController extends DashboardController
{
    public function coach()
    {
        return View::render('dashboard.admin.coach', array_merge($this->dataTetap, [
            'title' => 'Manajemen Pelatih ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website'
        ]));
    }
}