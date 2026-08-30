<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentParent extends Model
{
    protected $fillable = [
        'registration_id',
        'type',
        'full_name',
        'nik',
        'birth_year',
        'education',
        'job',
        'income',
        'phone',
        'is_alive',
        'is_guardian',
    ];

    protected $casts = [
        'is_alive' => 'boolean',
        'is_guardian' => 'boolean',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
