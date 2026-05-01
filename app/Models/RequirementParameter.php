<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequirementParameter extends Model
{
    use HasUuids, SoftDeletes;

    protected $primaryKey = 'uid';
    public $incrementing = false;

    protected $fillable = [
        'parameter_key',
        'display_name',
        'input_type',
        'input_options',
        'allowed_operators',
        'description',
        'is_active',
    ];

    protected $casts = [
        'input_options' => 'json',
        'allowed_operators' => 'json',
        'is_active' => 'boolean',
    ];
}
