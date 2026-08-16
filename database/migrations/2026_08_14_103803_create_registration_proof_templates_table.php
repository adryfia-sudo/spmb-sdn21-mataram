<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_proof_templates', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('school_name')
                ->nullable();

            $table->string('institution_name')
                ->nullable();

            $table->string('address')
                ->nullable();

            $table->string('phone')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('accreditation')
                ->nullable();

            $table->string('accreditation_reference')
                ->nullable();

            $table->string('city')
                ->default('Mataram');

            $table->string('document_title')
                ->default('BUKTI PENDAFTARAN');

            $table->string('document_subtitle')
                ->nullable();

            $table->string('logo_government')
                ->nullable();

            $table->string('logo_school')
                ->nullable();

            $table->string('verification_title')
                ->default('VERIFIKATOR');

            $table->string('verification_position')
                ->nullable();

            $table->string('verification_name')
                ->nullable();

            $table->string('verification_nip')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->boolean('is_active')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_proof_templates');
    }
};
