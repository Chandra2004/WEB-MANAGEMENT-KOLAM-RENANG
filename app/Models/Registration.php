<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'uid';
    public $incrementing = false;

    protected $fillable = [
        'user_uid',
        'event_category_uid',
        'seed_time',
        'entry_time',
        'status',
        'registration_number',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uid', 'uid');
    }

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_uid', 'uid');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'registration_uid', 'uid');
    }

    public function result()
    {
        return $this->hasOne(Result::class, 'registration_uid', 'uid');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'registration_uid', 'uid');
    }
}
