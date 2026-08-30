<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegistrationPath;

class RegistrationPathSeeder extends Seeder
{
    public function run(): void
    {
        RegistrationPath::truncate();

        RegistrationPath::create([
            'name'        => 'Domisili',
            'slug'        => 'domisili',
            'description' => 'Jalur Domisili',
            'quota'       => 100,
            'color'       => 'primary',
            'icon'        => 'heroicon-o-home',
            'sort_order'  => 1,
            'is_active'   => true,
        ]);

        RegistrationPath::create([
            'name'        => 'Afirmasi',
            'slug'        => 'afirmasi',
            'description' => 'Jalur Afirmasi',
            'quota'       => 20,
            'color'       => 'success',
            'icon'        => 'heroicon-o-heart',
            'sort_order'  => 2,
            'is_active'   => true,
        ]);
    }
}
