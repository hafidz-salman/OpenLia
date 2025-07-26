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
        Schema::table('access_logs', function (Blueprint $table) {
            // Hapus foreign key yang lama
            $table->dropForeign(['room_id']);

            // Buat ulang foreign key dengan onDelete('cascade')
            $table->foreign('room_id')
                  ->references('id')
                  ->on('rooms')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('access_logs', function (Blueprint $table) {
            // Kembalikan ke kondisi semula jika di-rollback
            $table->dropForeign(['room_id']);
            $table->foreign('room_id')
                  ->references('id')
                  ->on('rooms');
        });
    }
};
