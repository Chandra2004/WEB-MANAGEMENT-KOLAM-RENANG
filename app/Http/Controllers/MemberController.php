<?php

namespace TheFramework\Http\Controllers;

use TheFramework\Http\Controllers\Controller;
use TheFramework\App\Request;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;

class MemberController extends DashboardControlller
{
    public function member()
    {
        return View::render('dashboard.general.member', array_merge($this->dataTetap, [
            'title' => 'Manajemen Member ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website'
        ]));
    }
}