<?php

namespace App\Livewire\Registration\Concerns;

trait HasMotherData
{
    public $mother_full_name = '';

    public $mother_nik = '';

    public $mother_birth_year = null;

    public $mother_education = '';

    public $mother_job = '';

    public $mother_income = '';

    public $mother_phone = '';

    public $mother_is_alive = true;

    /*
    |--------------------------------------------------------------------------
    | Validasi Step 5
    |--------------------------------------------------------------------------
    */

    protected function validateStepFive(): void
    {
        $this->validate([
            'mother_full_name' => [
                'required',
                'string',
                'max:255',
            ],

            'mother_nik' => [
                'nullable',
                'digits:16',
            ],

            'mother_birth_year' => [
                'nullable',
                'integer',
                'digits:4',
            ],

            'mother_education' => [
                'nullable',
                'in:Tidak Sekolah,Putus SD,SD,Paket A,Paket B,Paket C,SMP,SMA,D1,D2,D3,D4,S1,S2,S3,Nonformal,Informal,Lainnya',
            ],

            'mother_job' => [
                'nullable',
                'in:Tidak Bekerja,Nelayan,Petani,Peternak,ASN/TNI/POLRI,Karyawan Swasta,Pedagang Kecil,Pedagang Besar,Wiraswasta,Wirausaha,Buruh,Pensiunan,Tenaga Kerja Indonesia,Karyawan BUMN,Lainnya',
            ],

            'mother_income' => [
                'nullable',
                'in:Kurang dari Rp. 500.000,Rp. 500.000 - Rp. 999.999,Rp. 1.000.000 - Rp. 1.999.999,Rp. 2.000.000 - Rp. 4.999.999,Rp. 5.000.000 - Rp. 20.000.000,>Rp. 20.000.000,Tidak Berpenghasilan',
            ],

            'mother_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'mother_is_alive' => [
                'required',
                'boolean',
            ],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Data Ibu
    |--------------------------------------------------------------------------
    */

    protected function saveMotherData($registration): void
    {
        $registration->mother()->create([
            'type' => 'mother',

            'full_name' => $this->mother_full_name,

            'nik' => $this->mother_nik ?: null,

            'birth_year' => $this->mother_birth_year,

            'education' => $this->mother_education ?: null,

            'job' => $this->mother_job ?: null,

            'income' => $this->mother_income ?: null,

            'phone' => $this->mother_phone ?: null,

            'is_alive' => $this->mother_is_alive,

            'is_guardian' => false,
        ]);
    }
}
