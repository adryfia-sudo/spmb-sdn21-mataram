<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationPeriod extends Model
{
    protected $fillable = [
        'academic_year_id',
        'name',
        'start_date',
        'end_date',
        'verification_end_date',
        'announcement_date',
        'announcement_published_at',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'verification_end_date' => 'date',
        'announcement_date' => 'date',
        'announcement_published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
