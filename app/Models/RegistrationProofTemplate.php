<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationProofTemplate extends Model
{
    protected $fillable = [
        'name',
        'school_name',
        'institution_name',
        'address',
        'phone',
        'email',
        'accreditation',
        'accreditation_reference',
        'city',
        'document_title',
        'document_subtitle',
        'logo_government',
        'logo_school',
        'verification_title',
        'verification_position',
        'verification_name',
        'verification_nip',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (RegistrationProofTemplate $template) {
            if ($template->is_active) {
                static::where('id', '!=', $template->id)
                    ->update([
                        'is_active' => false,
                    ]);
            }
        });
    }
}
