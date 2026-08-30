<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function registrationPaths(): BelongsToMany
    {
        return $this->belongsToMany(
            RegistrationPath::class,
            'registration_path_requirements',
            'document_type_id',
            'registration_path_id'
        )->withPivot([
            'is_required',
            'is_verification_required',
            'is_active',
            'show_in_upload',
            'show_in_proof',
            'notes',
        ])->withTimestamps();
    }
}
