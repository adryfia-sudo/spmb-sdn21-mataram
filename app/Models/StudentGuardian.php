<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentGuardian extends Model
{
    protected $table = 'student_guardians';

    protected $fillable = [
        'registration_id',
        'full_name',
        'family_relation',
        'nik',
        'birth_year',
        'education',
        'job',
        'income',
        'phone',
        'address',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
