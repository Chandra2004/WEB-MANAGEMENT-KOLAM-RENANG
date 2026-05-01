<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'uid';
    public $incrementing = false;

    protected $fillable = [
        'slug',
        'name',
        'banner',
        'logo_left',
        'logo_right',
        'description',
        'location',
        'start_date',
        'end_date',
        'start_time',
        'lane_count',
        'status',
        'type',
        'fee',
        'quota',
        'author_uid',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_uid', 'uid');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'event_categories', 'event_uid', 'category_uid')
                    ->withPivot('uid', 'event_number', 'event_name', 'registration_fee');
    }

    public function eventCategories()
    {
        return $this->hasMany(EventCategory::class, 'event_uid', 'uid');
    }
}
