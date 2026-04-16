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
class Registration extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'id_registration';

    protected $fillable = [
        'uid',
        'nomor_pendaftaran',
        'uid_user',
        'uid_event',
        'status',
        'tanggal_registrasi'
    ];

    protected $hidden = [
        'uid_user',
        'uid_event',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid_user', 'uid')->select(['id_user', 'uid', 'nama_lengkap', 'foto_profil']);
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'uid_event', 'uid');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'uid', 'uid_registration');
    }


    public function addRegistration($data)
    {
        try {
            $this->db->beginTransaction();
            $addRegistration = $this->query()->insert($data);
            $this->db->commit();
            return $addRegistration;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updateRegistration($registration, $uid)
    {
        try {
            $this->db->beginTransaction();
            $updateRegistration = $this->query()->where('uid', '=', $uid)->update($registration);
            $this->db->commit();
            return $updateRegistration;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function deleteRegistration($uid)
    {
        try {
            $this->db->beginTransaction();
            $deleteRegistration = $this->query()->where('uid', '=', $uid)->delete();
            $this->db->commit();
            return $deleteRegistration;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}