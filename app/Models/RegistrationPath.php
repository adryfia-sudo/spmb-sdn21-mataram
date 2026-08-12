<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RegistrationPath extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function requirements(): BelongsToMany
    {
        return $this->belongsToMany(
            DocumentType::class,
            'registration_path_requirements',
            'registration_path_id',
            'document_type_id'
        )->withPivot([
            'is_required',
            'is_active',
            'notes',
        ])->withTimestamps();
    }
}
