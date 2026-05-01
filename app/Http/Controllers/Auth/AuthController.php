<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Masuk',
        ];

        return view('auth.login', $data);
    }

    public function loginProcess(LoginRequest $request)
    {
        $loginId = $request->input('email');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        $fieldType = filter_var($loginId, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $loginId, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('notification', [
                'status' => 'success',
                'message' => 'Selamat datang ' . Auth::user()->username . ' !',
                'duration' => 3000
            ]);
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    public function register()
    {
        $data = [
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Daftar',
        ];

        return view('auth.register', $data);
    }

    public function registerProcess(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => true,
        ]);

        $user->assignRole('atlet');

        return redirect('/login')->with('notification', [
            'status' => 'success',
            'message' => 'Pendaftaran berhasil sebagai Atlet! Silakan masuk.',
            'duration' => 5000
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('notification', [
            'status' => 'success',
            'message' => 'Anda telah berhasil keluar.',
            'duration' => 3000
        ]);
    }
}
