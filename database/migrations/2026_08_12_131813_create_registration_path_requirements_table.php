<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_path_requirements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_path_id')
                ->constrained('registration_paths')
                ->cascadeOnDelete();

            $table->foreignId('document_type_id')
                ->constrained('document_types')
                ->cascadeOnDelete();

            $table->boolean('is_required')
                ->default(true);

            $table->boolean('is_active')
                ->default(true);

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'registration_path_id',
                'document_type_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_path_requirements');
    }
};
