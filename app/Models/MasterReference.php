<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterReference extends Model
{
    use HasFactory;
    // Category
    public const RELIGION        = 'religion';
    public const EDUCATION       = 'education';
    public const JOB             = 'job';
    public const INCOME          = 'income';
    public const TRANSPORTATION  = 'transportation';
    public const RESIDENCE       = 'residence';
    public const BLOOD_TYPE      = 'blood_type';
    public const CITIZENSHIP     = 'citizenship';
    public const FAMILY_RELATION = 'family_relation';
    protected $fillable = [
        'category',
        'code',
        'name',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
