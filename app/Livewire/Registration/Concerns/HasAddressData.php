<?php

namespace App\Livewire\Registration\Concerns;

use App\Models\Region;

trait HasAddressData
{
    public $address = '';

    public $province = '52';

    public $city = '';

    public $district = '';

    public $village = '';

    public $hamlet = '';

    public $rt = '';

    public $rw = '';

    public $postal_code = '';

    public $latitude = null;

    public $longitude = null;

    public $cities = [];

    public $districts = [];

    public $villages = [];

    /**
     * Load Kabupaten/Kota NTB
     */
    public function loadCities(): void
    {
        $this->cities = Region::query()
            ->where('level', 'regency')
            ->where('parent_code', '52')
            ->orderBy('name')
            ->get();
    }

    /**
     * Ketika Kabupaten/Kota berubah
     */
    public function updatedCity($value): void
    {
        $this->district = '';
        $this->village = '';

        $this->districts = [];
        $this->villages = [];

        if (! $value) {
            return;
        }

        $this->districts = Region::query()
            ->where('level', 'district')
            ->where('parent_code', $value)
            ->orderBy('name')
            ->get();
    }

    /**
     * Ketika Kecamatan berubah
     */
    public function updatedDistrict($value): void
    {
        $this->village = '';

        $this->villages = [];

        if (! $value) {
            return;
        }

        $this->villages = Region::query()
            ->where('level', 'village')
            ->where('parent_code', $value)
            ->orderBy('name')
            ->get();
    }

    /**
     * Validasi Step 3
     */
    protected function validateStepThree(): void
    {
        $this->validate([
            'city' => [
                'required',
                'exists:regions,code',
            ],

            'district' => [
                'required',
                'exists:regions,code',
            ],

            'village' => [
                'required',
                'exists:regions,code',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'rt' => [
                'nullable',
                'string',
                'max:5',
            ],

            'rw' => [
                'nullable',
                'string',
                'max:5',
            ],

            'hamlet' => [
                'nullable',
                'string',
                'max:100',
            ],

            'postal_code' => [
                'nullable',
                'string',
                'max:10',
            ],

            'latitude' => [
                'nullable',
                'numeric',
            ],

            'longitude' => [
                'nullable',
                'numeric',
            ],
        ]);
    }

    /**
     * Inisialisasi data wilayah ketika component pertama kali dibuka.
     */
    public function initializeAddressData(): void
    {
        $this->loadCities();
    }
}
