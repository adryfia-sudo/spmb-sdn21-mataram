<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('registrations', function (Blueprint $table) {
    $table->id();

    $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
    $table->foreignId('registration_period_id')->constrained()->cascadeOnDelete();
    $table->foreignId('registration_path_id')->constrained()->cascadeOnDelete();

    $table->string('registration_number')->unique()->nullable();

    $table->string('full_name');
    $table->string('nik', 16)->unique();
    $table->string('nisn', 10)->nullable()->unique();

    $table->enum('gender', ['L', 'P']);

    $table->string('birth_place');
    $table->date('birth_date');

    $table->string('religion');

    $table->boolean('special_needs')->default(false);

    // Data sekolah asal
    $table->string('previous_school')->nullable();

    // Data fisik
    $table->decimal('height', 5, 2)->nullable();
    $table->decimal('weight', 5, 2)->nullable();
    $table->decimal('head_circumference', 5, 2)->nullable();

    // Data keluarga
    $table->unsignedTinyInteger('siblings_count')->default(0);
    $table->unsignedTinyInteger('child_order')->nullable();

    // Kontak
    $table->string('phone');
    $table->string('email')->nullable();

    $table->enum('status', [
        'draft',
        'submitted',
        'verified',
        'accepted',
        'rejected',
    ])->default('draft');

    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
