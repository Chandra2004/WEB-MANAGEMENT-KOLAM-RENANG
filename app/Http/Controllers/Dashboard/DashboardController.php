<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard ' . ucfirst($this->user->username) . ' | Khafid Swimming Club (KSC) - Official Website',
        ];

        return view('dashboard.index', $data);
    }
}
