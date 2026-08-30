<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'name' => 'Kartu Keluarga',
                'is_required' => true,
                'is_conditional' => false,
            ],
            [
                'name' => 'Akta Kelahiran',
                'is_required' => true,
                'is_conditional' => false,
            ],
            [
                'name' => 'KTP Ayah',
                'is_required' => true,
                'is_conditional' => false,
            ],
            [
                'name' => 'KTP Ibu',
                'is_required' => true,
                'is_conditional' => false,
            ],
            [
                'name' => 'KTP Wali',
                'is_required' => false,
                'is_conditional' => true,
            ],
            [
                'name' => 'Ijazah',
                'is_required' => false,
                'is_conditional' => false,
            ],
            [
                'name' => 'Dokumen Pendukung',
                'is_required' => false,
                'is_conditional' => false,
            ],
        ];

        foreach ($documents as $document) {
            DocumentType::updateOrCreate(
                ['name' => $document['name']],
                $document
            );
        }
    }
}
