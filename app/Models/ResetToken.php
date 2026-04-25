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
class ResetToken extends Model
{
    protected $table = 'reset_token';
    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'token',
        'valid_until'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function createResetToken($data) {
        try {
            $this->db->beginTransaction();
            $createTokenReset = $this->query()->insert($data);
            $this->db->commit();
            return $createTokenReset;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function deleteResetToken($data) {
        try {
            $this->db->beginTransaction();
            $deleteTokenReset = $this->query()
                ->where('email', '=', $data['email'])
                ->where('token', '=', $data['token'])
                ->delete();
            $this->db->commit();
            if ($deleteTokenReset == 1) {
                return true;
            } else if ($deleteTokenReset == 0) {
                return false;
            }
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}