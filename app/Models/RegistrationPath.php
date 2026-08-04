<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPath extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quota',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
