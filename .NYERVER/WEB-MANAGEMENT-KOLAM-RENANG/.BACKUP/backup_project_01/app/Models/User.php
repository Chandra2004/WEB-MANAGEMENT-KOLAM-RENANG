<?php

namespace TheFramework\Models;

use Exception;
use TheFramework\App\Model;
use TheFramework\Helpers\Helper;

/**
 * @method static \TheFramework\App\QueryBuilder query()
 * @method static array all()
 * @method static mixed find($id)
 * @method static mixed where($column, $value)
 * @method static mixed insert(array $data)
 * @method static mixed update(array $data, $id)
 * @method static mixed delete($id)
 * @method static mixed paginate(int $perPage = 10, int $page = 1)
 * @method static static with(array $relations)
 */
class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'nama_lengkap',
        'email',
        'uid_role',
        'no_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_klub',
        'alamat',
        'foto_ktp',
        'foto_profil',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'uid_role',
        'password'
    ];

    public function checkEmail($email)
    {
        return $this->query()
            ->select([
                'users.*',
                'roles.nama_role'
            ])
            ->join('roles', 'users.uid_role', '=', 'roles.uid')
            ->where('email', '=', $email)
            ->first();
    }

    public static function authorizeAction(string $role, string $uidUser): bool
    {
        $user = Helper::session_get('user');
        return $user['nama_role'] === $role && $user['uid'] === $uidUser;
    }

    public function checkNomor($no_telepon)
    {
        return $this->query()->where('no_telepon', '=', $no_telepon)->first();
    }

    public function addUser($data)
    {
        try {
            $this->db->beginTransaction();
            $user = $this->query()->insert($data);
            $this->db->commit();
            return $user;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updateUser($data)
    {
        try {
            $this->db->beginTransaction();
            $updateUser = $this->query()->where('uid', '=', $data['uid'])->update($data);
            $this->db->commit();
            return $updateUser;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function deleteUser($data)
    {
        try {
            $this->db->beginTransaction();
            $deleteUser = $this->query()->where('uid', '=', $data)->delete();
            $this->db->commit();
            return $deleteUser;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updatePassword($data)
    {
        unset($data['token']);
        unset($data['password_confirm']);
        try {
            $this->db->beginTransaction();

            $updatePassword = $this->query()
                ->where('email', '=', $data['email'])
                ->update($data);

            $this->db->commit();
            if ($updatePassword == 1) {
                return true;
            } else if ($updatePassword == 0) {
                return false;
            }
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function chechKredensial($role, $uidUser)
    {
        $dataValid = $this->query()
            ->select([
                'users.*',
                'roles.nama_role'
            ])
            ->join('roles', 'users.uid_role', '=', 'roles.uid')
            ->where('roles.nama_role', '=', $role)
            ->where('users.uid', $uidUser)
            ->first();

        if ($dataValid == null) {
            return false;
        } else {
            return true;
        }
    }

    public function updateMyProfile($data)
    {
        try {
            $this->db->beginTransaction();
            $updateMyProfile = $this->query()->where('uid', '=', $data['uid'])->update($data);
            $this->db->commit();
            return $updateMyProfile;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

}
