<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_addresses', function (Blueprint $table) {

            $table->foreignId('registration_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('address');

            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');

            $table->string('hamlet')->nullable();

            $table->string('rt',3)->nullable();
            $table->string('rw',3)->nullable();

            $table->string('postal_code',10)->nullable();

            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_addresses', function (Blueprint $table) {

            $table->dropForeign(['registration_id']);

            $table->dropColumn([
                'registration_id',
                'address',
                'province',
                'city',
                'district',
                'village',
                'hamlet',
                'rt',
                'rw',
                'postal_code',
                'latitude',
                'longitude',
            ]);
        });
    }
};
