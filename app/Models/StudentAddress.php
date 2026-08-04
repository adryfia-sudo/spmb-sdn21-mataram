<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAddress extends Model
{
    protected $fillable = [
        'registration_id',
        'kk_number',
        'birth_certificate_number',
        'rt',
        'rw',
        'dusun',
        'village',
        'district',
        'postal_code',
        'distance',
        'travel_time',
        'transportation',
        'residence_type',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
