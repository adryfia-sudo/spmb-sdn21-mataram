<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentParent extends Model
{
    protected $fillable = [
        'registration_id',
        'type',
        'is_alive',
        'name',
        'nik',
        'birth_year',
        'education',
        'occupation',
        'income',
    ];

    protected $casts = [
        'is_alive' => 'boolean',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
