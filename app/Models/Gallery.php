<?php

namespace TheFramework\Models;

use Exception;
use TheFramework\App\Model;

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
class Gallery extends Model
{
    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uid',
        'uid_event',
        'foto_event'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'uid_event'
        // 'password', 'token', ...
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'uid_event', 'uid')->select(['uid', 'nama_event']);
    }

    public function addGallery($data)
    {
        try {
            $this->db->beginTransaction();
            $add = $this->query()->insert($data);
            $this->db->commit();
            return $add;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function addMultipleGallery(array $batchData)
    {
        try {
            $this->db->beginTransaction();
            foreach ($batchData as $data) {
                $this->query()->insert($data);
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updateGallery($data, $uid)
    {
        try {
            $this->db->beginTransaction();
            $update = $this->query()->where('uid', '=', $uid)->update($data);
            $this->db->commit();
            return $update;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function deleteGallery($uid)
    {
        try {
            $this->db->beginTransaction();
            $delete = $this->query()->where('uid', '=', $uid)->delete();
            $this->db->commit();
            return $delete;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}