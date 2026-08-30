<?php

namespace App\Livewire\Registration\Concerns;

trait HasGuardianData
{
    /*
    |--------------------------------------------------------------------------
    | Status Wali
    |--------------------------------------------------------------------------
    */

    public $guardian_status = '';

    /*
    |--------------------------------------------------------------------------
    | Data Wali
    |--------------------------------------------------------------------------
    */

    public $guardian_full_name = '';

    public $guardian_family_relation = '';

    public $guardian_nik = '';

    public $guardian_birth_year = null;

    public $guardian_education = '';

    public $guardian_job = '';

    public $guardian_income = '';

    public $guardian_phone = '';

    public $guardian_address = '';

    /*
    |--------------------------------------------------------------------------
    | Validasi Step 6
    |--------------------------------------------------------------------------
    */

    protected function validateStepSix(): void
    {
        $rules = [
            'guardian_status' => [
                'required',
                'in:none,has_guardian,lives_with_guardian',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Jika memiliki wali atau tinggal bersama wali
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $this->guardian_status,
                ['has_guardian', 'lives_with_guardian'],
                true
            )
        ) {
            $rules = array_merge($rules, [

                'guardian_full_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'guardian_family_relation' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'guardian_nik' => [
                    'nullable',
                    'digits:16',
                ],

                'guardian_birth_year' => [
                    'nullable',
                    'integer',
                    'min:1900',
                    'max:' . date('Y'),
                ],

                'guardian_education' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'guardian_job' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'guardian_income' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'guardian_phone' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'guardian_address' => [
                    'nullable',
                    'string',
                    'max:500',
                ],
            ]);
        }

        $this->validate($rules);
    }
}
