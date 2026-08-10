<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
        'name',
        'is_required',
        'is_conditional',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_conditional' => 'boolean',
    ];
}
