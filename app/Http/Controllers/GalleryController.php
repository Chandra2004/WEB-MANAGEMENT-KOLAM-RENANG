<?php

namespace TheFramework\Http\Controllers;

use TheFramework\Http\Controllers\Controller;
use TheFramework\App\Request;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;

class GalleryController extends DashboardControlller
{
    public function gallery()
    {
        return View::render('dashboard.general.gallery', array_merge($this->dataTetap, [
            'title' => 'Manajemen Gallery ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website'
        ]));
    }
}