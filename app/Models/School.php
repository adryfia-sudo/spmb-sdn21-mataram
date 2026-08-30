<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [

        'npsn',

        'school_name',

        'principal_name',
        'principal_nip',

        'operator_name',

        'email',
        'phone',
        'whatsapp',
        'website',

        'logo',

        'address',
        'village',
        'district',
        'city',
        'province',
        'postal_code',

        'latitude',
        'longitude',
    ];
}
