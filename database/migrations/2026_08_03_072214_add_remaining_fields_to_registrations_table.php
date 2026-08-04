<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {

            $table->string('family_card_number',16)->nullable()->after('nisn');

            $table->string('birth_certificate_number')->nullable();

            $table->enum('previous_school_type',[
                'TK',
                'PAUD',
                'KB',
                'RA',
                'Tidak Sekolah',
            ])->nullable();

            $table->enum('residence_type',[
                'Orang Tua',
                'Wali',
                'Kos',
                'Asrama',
                'Panti Asuhan',
                'Pesantren',
                'Lainnya',
            ])->nullable();

            $table->enum('transportation',[
                'Jalan Kaki',
                'Sepeda',
                'Sepeda Motor',
                'Mobil',
                'Angkutan Umum',
                'Perahu',
                'Lainnya',
            ])->nullable();

            $table->enum('distance_category',[
                '< 1 KM',
                '> 1 KM',
            ])->nullable();

            $table->decimal('distance_km',5,2)->nullable();

            $table->unsignedSmallInteger('travel_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {

            $table->dropColumn([
                'family_card_number',
                'birth_certificate_number',
                'previous_school_type',
                'residence_type',
                'transportation',
                'distance_category',
                'distance_km',
                'travel_time',
            ]);

        });
    }
};
