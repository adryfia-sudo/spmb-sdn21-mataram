<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_documents', function (Blueprint $table) {

            $table->foreignId('registration_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('document_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('original_name');

            $table->string('file_name');

            $table->string('file_path');

            $table->string('mime_type');

            $table->unsignedBigInteger('size');

            $table->enum('status',[
                'uploaded',
                'verified',
                'rejected'
            ])->default('uploaded');

            $table->timestamp('verified_at')->nullable();

            $table->text('notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_documents', function (Blueprint $table) {

            $table->dropForeign(['registration_id']);
            $table->dropForeign(['document_type_id']);

            $table->dropColumn([
                'registration_id',
                'document_type_id',
                'original_name',
                'file_name',
                'file_path',
                'mime_type',
                'size',
                'status',
                'verified_at',
                'notes',
            ]);
        });
    }
};
