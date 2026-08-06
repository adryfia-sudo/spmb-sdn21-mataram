<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registration_paths', function (Blueprint $table) {

            $table->string('slug')->nullable()->unique()->after('name');

            $table->string('color')
                ->default('primary')
                ->after('quota');

            $table->string('icon')
                ->nullable()
                ->after('color');

            $table->integer('sort_order')
                ->default(0)
                ->after('icon');
        });
    }

    public function down(): void
    {
        Schema::table('registration_paths', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'color',
                'icon',
                'sort_order',
            ]);
        });
    }
};
