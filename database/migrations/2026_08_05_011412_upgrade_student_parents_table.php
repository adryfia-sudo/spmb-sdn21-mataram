<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_parents', function (Blueprint $table) {

            $table->foreignId('registration_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', [
                'father',
                'mother',
            ]);

            $table->string('full_name');

            $table->string('nik',16)->nullable();

            $table->year('birth_year')->nullable();

            $table->string('education')->nullable();

            $table->string('job')->nullable();

            $table->string('income')->nullable();

            $table->string('phone')->nullable();

            $table->boolean('is_alive')
                ->default(true);

            $table->boolean('is_guardian')
                ->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('student_parents', function (Blueprint $table) {

            $table->dropForeign(['registration_id']);

            $table->dropColumn([
                'registration_id',
                'type',
                'full_name',
                'nik',
                'birth_year',
                'education',
                'job',
                'income',
                'phone',
                'is_alive',
                'is_guardian',
            ]);
        });
    }
};
