<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration_path_requirements', function (Blueprint $table) {
            $table->boolean('is_verification_required')
                ->default(true)
                ->after('is_required');
        });
    }

    public function down(): void
    {
        Schema::table('registration_path_requirements', function (Blueprint $table) {
            $table->dropColumn('is_verification_required');
        });
    }
};
