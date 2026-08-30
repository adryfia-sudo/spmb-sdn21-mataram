<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_guardians', function (Blueprint $table) {

            $table->foreignId('registration_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('full_name');

            $table->string('family_relation');

            $table->string('nik',16)->nullable();

            $table->year('birth_year')->nullable();

            $table->string('education')->nullable();

            $table->string('job')->nullable();

            $table->string('income')->nullable();

            $table->string('phone')->nullable();

            $table->text('address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_guardians', function (Blueprint $table) {

            $table->dropForeign(['registration_id']);

            $table->dropColumn([
                'registration_id',
                'full_name',
                'family_relation',
                'nik',
                'birth_year',
                'education',
                'job',
                'income',
                'phone',
                'address',
            ]);
        });
    }
};
