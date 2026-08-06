<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
    'academic_year_id',
    'registration_period_id',
    'registration_path_id',
    'registration_number',

    'full_name',
    'nik',
    'nisn',

    'family_card_number',
    'birth_certificate_number',

    'previous_school',
    'previous_school_type',

    'gender',
    'birth_place',
    'birth_date',
    'religion',

    'special_needs',

    'height',
    'weight',
    'head_circumference',

    'siblings_count',
    'child_order',

    'residence_type',
    'transportation',
    'distance_category',
    'distance_km',
    'travel_time',

    'phone',
    'email',
    'status',
];

        

    protected $casts = [
        'birth_date' => 'date',
        'special_needs' => 'boolean',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'head_circumference' => 'decimal:2',
        'distance_km' => 'decimal:2',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function registrationPath()
    {
        return $this->belongsTo(RegistrationPath::class);
    }

    public function registrationPeriod()
    {
        return $this->belongsTo(RegistrationPeriod::class);
    }

    public function address()
    {
        return $this->hasOne(StudentAddress::class);
    }

    public function father()
    {
        return $this->hasOne(StudentParent::class)
            ->where('type', 'father');
    }

    public function mother()
    {
        return $this->hasOne(StudentParent::class)
            ->where('type', 'mother');
    }

    public function guardian()
    {
        return $this->hasOne(StudentGuardian::class);
    }

    public function documents()
    {
        return $this->hasMany(StudentDocument::class);
    }
}
