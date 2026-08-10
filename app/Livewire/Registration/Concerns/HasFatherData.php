<?php

namespace App\Livewire\Registration\Concerns;

trait HasFatherData
{
    public $father_full_name = '';

    public $father_nik = '';

    public $father_birth_year = null;

    public $father_education = '';

    public $father_job = '';

    public $father_income = '';

    public $father_phone = '';

    public $father_is_alive = true;

    /*
    |--------------------------------------------------------------------------
    | Validasi Step 4
    |--------------------------------------------------------------------------
    */

    protected function validateStepFour(): void
    {
        $this->validate([
            'father_full_name' => [
                'required',
                'string',
                'max:255',
            ],

            'father_nik' => [
                'nullable',
                'digits:16',
            ],

            'father_birth_year' => [
                'nullable',
                'integer',
                'digits:4',
            ],

            'father_education' => [
                'nullable',
                'in:Tidak Sekolah,Putus SD,SD,Paket A,Paket B,Paket C,SMP,SMA,D1,D2,D3,D4,S1,S2,S3,Nonformal,Informal,Lainnya',
            ],

            'father_job' => [
                'nullable',
                'in:Tidak Bekerja,Nelayan,Petani,Peternak,ASN/TNI/POLRI,Karyawan Swasta,Pedagang Kecil,Pedagang Besar,Wiraswasta,Wirausaha,Buruh,Pensiunan,Tenaga Kerja Indonesia,Karyawan BUMN,Lainnya',
            ],

            'father_income' => [
                'nullable',
                'in:Kurang dari Rp. 500.000,Rp. 500.000 - Rp. 999.999,Rp. 1.000.000 - Rp. 1.999.999,Rp. 2.000.000 - Rp. 4.999.999,Rp. 5.000.000 - Rp. 20.000.000,>Rp. 20.000.000,Tidak Berpenghasilan',
            ],

            'father_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'father_is_alive' => [
                'required',
                'boolean',
            ],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Data Ayah
    |--------------------------------------------------------------------------
    */

    protected function saveFatherData($registration): void
    {
        $registration->father()->create([
            'type' => 'father',

            'full_name' => $this->father_full_name,

            'nik' => $this->father_nik ?: null,

            'birth_year' => $this->father_birth_year,

            'education' => $this->father_education ?: null,

            'job' => $this->father_job ?: null,

            'income' => $this->father_income ?: null,

            'phone' => $this->father_phone ?: null,

            'is_alive' => $this->father_is_alive,

            'is_guardian' => false,
        ]);
    }
}
