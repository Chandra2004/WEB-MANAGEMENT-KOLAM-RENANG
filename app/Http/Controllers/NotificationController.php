<?php
namespace TheFramework\Http\Controllers;

use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use TheFramework\Models\Notification;
use TheFramework\Models\User;
use TheFramework\Models\Role;
use Exception;
use TheFramework\Http\Controllers\Services\ErrorController;

class NotificationController extends DashboardController
{
    /**
     * Helper to send notification to all Admins
     */
    public static function sendToAdmin(string $judul, string $pesan)
    {
        try {
            $admins = User::query()
                ->join('roles', 'users.uid_role', '=', 'roles.uid')
                ->where('roles.nama_role', '=', 'admin')
                ->select(['users.uid'])
                ->all();

            foreach ($admins as $admin) {
                Notification::query()->insert([
                    'uid' => Helper::uuid(),
                    'uid_user' => $admin['uid'],
                    'judul' => $judul,
                    'pesan' => $pesan,
                    'is_read' => 0
                ]);
            }
        } catch (Exception $e) {
            // Log error silently or handle as needed
        }
    }

    public function notification()
    {
        $userSession = Helper::session_get('user');

        // Ambil notifikasi untuk user ini
        $notifications = Notification::query()
            ->where('uid_user', '=', $userSession['uid'])
            ->orderBy('created_at', 'DESC')
            ->all();

        // Jika admin, berikan data tambahan untuk form kirim notif
        $extraData = [];
        if ($userSession['nama_role'] === 'admin') {
            $extraData['users'] = User::query()->select(['uid', 'nama_lengkap', 'email'])->orderBy('nama_lengkap', 'ASC')->all();
            $extraData['roles'] = Role::query()->all();
        }

        return View::render('dashboard.general.notification', array_merge($this->dataTetap, [
            'title' => 'Notifikasi Saya ' . $userSession['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
            'notifications' => $notifications,
            'is_admin' => $userSession['nama_role'] === 'admin'
        ], $extraData));
    }

    public function notificationCreateProcess($role, $uidUser)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false || $role !== 'admin') {
                ErrorController::error403();
            }

            $targetType = $_POST['target_type'] ?? 'all'; // all, role, specific
            $judul = $_POST['judul'] ?? '';
            $pesan = $_POST['pesan'] ?? '';

            if (empty($judul) || empty($pesan)) {
                throw new Exception('Judul dan pesan tidak boleh kosong.');
            }

            $targetUids = [];

            if ($targetType === 'all') {
                $users = User::query()->select(['uid'])->all();
                foreach ($users as $u)
                    $targetUids[] = $u['uid'];
            } elseif ($targetType === 'role') {
                $roleUid = $_POST['target_role_uid'] ?? '';
                if (empty($roleUid))
                    throw new Exception('Pilih role target.');
                $users = User::query()->where('uid_role', '=', $roleUid)->select(['uid'])->all();
                foreach ($users as $u)
                    $targetUids[] = $u['uid'];
            } elseif ($targetType === 'specific') {
                $userUids = $_POST['target_user_uids'] ?? [];
                if (empty($userUids))
                    throw new Exception('Pilih minimal satu user target.');
                $targetUids = is_array($userUids) ? $userUids : [$userUids];
            }

            foreach ($targetUids as $targetUid) {
                Notification::query()->insert([
                    'uid' => Helper::uuid(),
                    'uid_user' => $targetUid,
                    'judul' => $judul,
                    'pesan' => $pesan,
                    'is_read' => 0
                ]);
            }

            return Helper::redirect("/{$role}/dashboard/notifications", 'success', "Berhasil mengirim notifikasi ke " . count($targetUids) . " pengguna.", 10);
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/notifications", 'error', 'Gagal kirim notifikasi: ' . $e->getMessage(), 10);
        }
    }

    public function notificationEditProcess($role, $uidUser, $uidNotification)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            // Mark as Read
            Notification::query()
                ->where('uid', '=', $uidNotification)
                ->where('uid_user', '=', $uidUser)
                ->update(['is_read' => 1]);

            if (Helper::is_ajax()) {
                echo json_encode(['success' => true]);
                exit;
            }

            return Helper::redirect("/{$role}/dashboard/notifications", 'success', 'Notifikasi ditandai sudah dibaca.', 10);
        } catch (Exception $e) {
            if (Helper::is_ajax()) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
            return Helper::redirect("/{$role}/dashboard/notifications", 'error', 'Gagal memperbarui notifikasi.', 10);
        }
    }

    public function notificationDeleteProcess($role, $uidUser, $uidNotification)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            if (Helper::is_ajax()) {
                Notification::query()->where('uid', '=', $uidNotification)->where('uid_user', '=', $uidUser)->delete();
                echo json_encode(['success' => true]);
                exit;
            }

            $notif = Notification::query()
                ->where('uid', '=', $uidNotification)
                ->where('uid_user', '=', $uidUser)
                ->first();

            if (!$notif) {
                throw new Exception('Notifikasi tidak ditemukan.');
            }

            Notification::query()->where('uid', '=', $uidNotification)->delete();

            return Helper::redirect("/{$role}/dashboard/notifications", 'success', 'Notifikasi berhasil dihapus.', 10);
        } catch (Exception $e) {
            if (Helper::is_ajax()) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
            return Helper::redirect("/{$role}/dashboard/notifications", 'error', 'Gagal hapus notifikasi: ' . $e->getMessage(), 10);
        }
    }

    public function notificationMarkAllAsReadProcess($role, $uidUser)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            Notification::query()
                ->where('uid_user', '=', $uidUser)
                ->where('is_read', '=', 0)
                ->update(['is_read' => 1]);

            return Helper::redirect("/{$role}/dashboard/notifications", 'success', 'Semua notifikasi ditandai sudah dibaca.', 10);
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/notifications", 'error', 'Gagal memperbarui notifikasi: ' . $e->getMessage(), 10);
        }
    }

    public function notificationDeleteAllProcess($role, $uidUser)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            Notification::query()
                ->where('uid_user', '=', $uidUser)
                ->delete();

            return Helper::redirect("/{$role}/dashboard/notifications", 'success', 'Semua notifikasi berhasil dihapus.', 10);
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/notifications", 'error', 'Gagal menghapus notifikasi: ' . $e->getMessage(), 10);
        }
    }
}