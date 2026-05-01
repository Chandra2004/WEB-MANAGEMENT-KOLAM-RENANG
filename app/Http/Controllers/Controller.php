<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->user = Auth::user();

                $unreadData = [
                    'totalUnreadNotifications' => Notification::where('user_uid', $this->user->uid)
                        ->where('is_read', false)
                        ->count(),
                    'unreadNotifications' => Notification::where('user_uid', $this->user->uid)
                        ->where('is_read', false)
                        ->latest()
                        ->take(5)
                        ->get(),
                    'user' => $this->user
                ];

                View::share($unreadData);
            }

            return $next($request);
        });
    }
}