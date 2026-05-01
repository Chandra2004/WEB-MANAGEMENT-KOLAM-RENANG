<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function myProfile() {
        $data = [
            'user' => $this->user
        ];

        return view('dashboard.general.my-profile', $data);
    }
}
