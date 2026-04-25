<?php

namespace TheFramework\Models;

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
class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'uid_user',
        'judul',
        'pesan',
        'is_read'
    ];

    protected $hidden = [
        // 'password', 'token', ...
    ];
}