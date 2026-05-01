<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCategory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'event_categories';
    protected $primaryKey = 'uid';
    public $incrementing = false;

    protected $fillable = [
        'event_uid',
        'category_uid',
        'event_number',
        'event_name',
        'start_date',
        'start_time',
        'fee_type',
        'registration_fee',
        'series_count',
        'location',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_uid', 'uid');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_uid', 'uid');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'event_category_uid', 'uid');
    }

    public function requirements()
    {
        return $this->hasMany(CategoryRequirement::class, 'event_category_uid', 'uid');
    }
}
