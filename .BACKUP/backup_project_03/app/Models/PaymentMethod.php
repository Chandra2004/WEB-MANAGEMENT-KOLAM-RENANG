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
class PaymentMethod extends Model
{
    protected $table = 'payment_method';
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'bank',
        'rekening',
        'atas_nama',
        'photo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function addPaymentMethod($data)
    {
        try {
            $this->db->beginTransaction();
            $insert = $this->query()->insert($data);
            $this->db->commit();
            return $insert;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updatePaymentMethod($data, $uid)
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

    public function deletePaymentMethod($uid)
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