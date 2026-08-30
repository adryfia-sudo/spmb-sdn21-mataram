<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();

            $table->string('label');

            $table->string('type')->default('internal');

            $table->string('route_name')->nullable();

            $table->string('url')->nullable();

            $table->string('location')->default('navbar');

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->boolean('open_new_tab')->default(false);

            $table->timestamps();

            $table->index(['location', 'is_active']);
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_menus');
    }
};
