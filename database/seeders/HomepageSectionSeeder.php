<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'key' => 'hero',
                'title' => 'SD Negeri 21 Mataram',
                'subtitle' => 'Website Resmi Sekolah',
                'content' => 'Selamat datang di Website Resmi SD Negeri 21 Mataram.',
                'sort_order' => 1,
            ],
            [
                'key' => 'sambutan',
                'title' => 'Sambutan Kepala Sekolah',
                'subtitle' => null,
                'content' => null,
                'sort_order' => 2,
            ],
            [
                'key' => 'informasi',
                'title' => 'Informasi Terbaru',
                'subtitle' => 'Informasi terbaru dari SD Negeri 21 Mataram.',
                'content' => null,
                'sort_order' => 3,
            ],
            [
                'key' => 'berita',
                'title' => 'Berita & Kegiatan',
                'subtitle' => 'Berita dan kegiatan terbaru sekolah.',
                'content' => null,
                'sort_order' => 4,
            ],
            [
                'key' => 'pengumuman',
                'title' => 'Pengumuman',
                'subtitle' => 'Pengumuman penting untuk peserta didik dan orang tua.',
                'content' => null,
                'sort_order' => 5,
            ],
            [
                'key' => 'kontak',
                'title' => 'Hubungi Kami',
                'subtitle' => 'Informasi kontak SD Negeri 21 Mataram.',
                'content' => null,
                'sort_order' => 6,
            ],
        ];

        foreach ($sections as $section) {
            HomepageSection::updateOrCreate(
                ['key' => $section['key']],
                array_merge($section, [
                    'is_active' => true,
                ])
            );
        }
    }
}
