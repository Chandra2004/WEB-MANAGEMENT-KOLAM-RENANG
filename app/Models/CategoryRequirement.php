<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryRequirement extends Model
{
    use HasUuids, SoftDeletes;

    protected $primaryKey = 'uid';
    public $incrementing = false;

    protected $fillable = [
        'event_category_uid',
        'parameter_name',
        'parameter_type',
        'parameter_value',
        'operator',
        'is_required',
        'priority',
        'error_message',
        'notes',
    ];

    protected $casts = [
        'parameter_value' => 'json',
        'is_required' => 'boolean',
    ];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_uid', 'uid');
    }
}
