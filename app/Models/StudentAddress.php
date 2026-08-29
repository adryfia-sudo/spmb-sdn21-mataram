<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAddress extends Model
{
    protected $fillable = [
        'registration_id',
        'address',
        'province',
        'city',
        'district',
        'village',
        'hamlet',
        'rt',
        'rw',
        'postal_code',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    /*
    |--------------------------------------------------------------------------
    | WILAYAH
    |--------------------------------------------------------------------------
    */

    public function provinceRegion(): BelongsTo
    {
        return $this->belongsTo(
            Region::class,
            'province',
            'code'
        );
    }

    public function cityRegion(): BelongsTo
    {
        return $this->belongsTo(
            Region::class,
            'city',
            'code'
        );
    }

    public function districtRegion(): BelongsTo
    {
        return $this->belongsTo(
            Region::class,
            'district',
            'code'
        );
    }

    public function villageRegion(): BelongsTo
    {
        return $this->belongsTo(
            Region::class,
            'village',
            'code'
        );
    }

}
