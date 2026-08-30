<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_types', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->boolean('is_required')->default(false)->after('name');
            $table->boolean('is_conditional')->default(false)->after('is_required');
        });
    }

    public function down(): void
    {
        Schema::table('document_types', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'is_required',
                'is_conditional',
            ]);
        });
    }
};
