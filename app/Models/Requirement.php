<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
 protected $fillable = [
        'name',
        'description',
        'is_required',
    ];
 protected $casts = [
        'is_required' => 'boolean',
    ];
}
