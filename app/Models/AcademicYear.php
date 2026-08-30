<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_active'  => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (AcademicYear $academicYear) {
            if ($academicYear->is_active) {
                static::where('id', '!=', $academicYear->id)
                    ->update([
                        'is_active' => false,
                    ]);
            }
        });
    }
}
