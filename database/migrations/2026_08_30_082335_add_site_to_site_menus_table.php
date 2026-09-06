<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_menus', function (Blueprint $table) {
            $table->string('site')
                ->default('spmb')
                ->after('label');

            $table->index(['site', 'location', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('site_menus', function (Blueprint $table) {
            $table->dropIndex(['site', 'location', 'is_active']);
            $table->dropColumn('site');
        });
    }
};
