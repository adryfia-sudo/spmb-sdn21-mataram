<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();

            $table->string('code', 20)->unique();

            $table->string('name');

            $table->string('level', 20);

            $table->string('parent_code', 20)->nullable();

            $table->timestamps();

            $table->index(['level', 'parent_code']);
            $table->index(['level', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
