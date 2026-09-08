<?php

namespace Database\Seeders;

use App\Models\MasterReference;
use Illuminate\Database\Seeder;

class MasterReferenceSeeder extends Seeder
{
    public function run(): void
    {
        MasterReference::truncate();

        $data = [

            [
                'category' => MasterReference::RELIGION,
                'code' => 'ISLAM',
                'name' => 'Islam',
                'sort_order' => 1,
            ],
            [
                'category' => MasterReference::RELIGION,
                'code' => 'KRISTEN',
                'name' => 'Kristen',
                'sort_order' => 2,
            ],
            [
                'category' => MasterReference::RELIGION,
                'code' => 'KATOLIK',
                'name' => 'Katolik',
                'sort_order' => 3,
            ],
            [
                'category' => MasterReference::RELIGION,
                'code' => 'HINDU',
                'name' => 'Hindu',
                'sort_order' => 4,
            ],
            [
                'category' => MasterReference::RELIGION,
                'code' => 'BUDDHA',
                'name' => 'Buddha',
                'sort_order' => 5,
            ],
            [
                'category' => MasterReference::RELIGION,
                'code' => 'KONGHUCU',
                'name' => 'Konghucu',
                'sort_order' => 6,
            ],

        ];

        foreach ($data as $item) {
            MasterReference::create([
                'category' => $item['category'],
                'code' => $item['code'],
                'name' => $item['name'],
                'description' => null,
                'sort_order' => $item['sort_order'],
                'is_active' => true,
            ]);
        }
    }
}
