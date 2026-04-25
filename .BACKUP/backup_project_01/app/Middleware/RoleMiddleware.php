<?php

namespace TheFramework\Middleware;

use TheFramework\App\SessionManager;
use TheFramework\Helpers\Helper;
use TheFramework\Http\Controllers\Services\ErrorController;
use TheFramework\Models\User;

class RoleMiddleware implements Middleware {
    private $allowedRoles = [];

    public function __construct(array $allowedRoles) {
        // Normalize semua allowed roles ke lowercase
        $this->allowedRoles = array_map('strtolower', $allowedRoles);
    }

    public function before() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            SessionManager::startSecureSession();
        }

        $user_session = Helper::session_get('user');

        // 1. Cek User Session
        if (empty($user_session) || !isset($user_session['uid'])) {
            ErrorController::error403();
            exit();
        }
        
        // 2. Ambil role user asli dari database (Real-time)
        $user_from_db = User::query()
            ->select('roles.nama_role')
            ->join('roles', 'users.uid_role', '=', 'roles.uid')
            ->where('users.uid', '=', $user_session['uid'])
            ->first();

        $currentRole = null;
        if (!empty($user_from_db) && isset($user_from_db['nama_role'])) {
            $currentRole = strtolower($user_from_db['nama_role']);
        }

        // 3. Ambil role yang diminta dari URL segment pertama
        $roleTargetDiURL = strtolower(Helper::getUriSegment(1) ?? '');

        // 4. VALIDASI TAHAP 1: Apakah role user ada dalam daftar yang diizinkan?
        if (is_null($currentRole) || !in_array($currentRole, $this->allowedRoles)) {
            ErrorController::error403();
            exit();
        }

        // 5. VALIDASI TAHAP 2 (SMART): Proteksi Silang Link
        // Jika URL segment 1 adalah salah satu role yang kita jaga (misal: 'admin')
        // Tapi role user tersebut bukan 'admin', maka blokir.
        if (in_array($roleTargetDiURL, $this->allowedRoles)) {
            if ($currentRole !== $roleTargetDiURL) {
                // Member mencoba buka milik Admin atau sebaliknya
                ErrorController::error403();
                exit();
            }
        }
    }

    public function after() {}
}