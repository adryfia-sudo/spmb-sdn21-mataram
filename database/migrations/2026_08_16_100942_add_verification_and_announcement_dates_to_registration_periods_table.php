<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration_periods', function (Blueprint $table) {
            $table->date('verification_end_date')
                ->nullable()
                ->after('end_date');

            $table->date('announcement_date')
                ->nullable()
                ->after('verification_end_date');
        });
    }

    public function down(): void
    {
        Schema::table('registration_periods', function (Blueprint $table) {
            $table->dropColumn([
                'verification_end_date',
                'announcement_date',
            ]);
        });
    }
};
