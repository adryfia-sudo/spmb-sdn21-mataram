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
    Schema::create('schools', function (Blueprint $table) {
        $table->id();

        // Identitas Sekolah
        $table->string('npsn')->unique();
        $table->string('school_name');

        // Kepala Sekolah
        $table->string('principal_name')->nullable();
        $table->string('principal_nip')->nullable();

        // Operator
        $table->string('operator_name')->nullable();

        // Kontak
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('whatsapp')->nullable();
        $table->string('website')->nullable();

        // Logo
        $table->string('logo')->nullable();

        // Alamat
        $table->text('address')->nullable();
        $table->string('village')->nullable();
        $table->string('district')->nullable();
        $table->string('city')->nullable();
        $table->string('province')->nullable();
        $table->string('postal_code')->nullable();

        // Koordinat
        $table->decimal('latitude',10,7)->nullable();
        $table->decimal('longitude',10,7)->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
