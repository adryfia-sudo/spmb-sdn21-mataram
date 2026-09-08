<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('verification_logs', function (Blueprint $table) {
            $table->foreignId('registration_id')
                ->after('id')
                ->constrained('registrations')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->after('registration_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('status')
                ->after('user_id');

            $table->text('notes')
                ->nullable()
                ->after('status');

            $table->index(['registration_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('verification_logs', function (Blueprint $table) {
            $table->dropForeign(['registration_id']);
            $table->dropForeign(['user_id']);

            $table->dropIndex([
                'registration_id',
                'created_at',
            ]);

            $table->dropColumn([
                'registration_id',
                'user_id',
                'status',
                'notes',
            ]);
        });
    }
};
