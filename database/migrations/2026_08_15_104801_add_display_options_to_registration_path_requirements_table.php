<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration_path_requirements', function (Blueprint $table) {
            $table->boolean('show_in_upload')
                ->default(true)
                ->after('is_active');

            $table->boolean('show_in_proof')
                ->default(true)
                ->after('show_in_upload');
        });
    }

    public function down(): void
    {
        Schema::table('registration_path_requirements', function (Blueprint $table) {
            $table->dropColumn([
                'show_in_upload',
                'show_in_proof',
            ]);
        });
    }
};
