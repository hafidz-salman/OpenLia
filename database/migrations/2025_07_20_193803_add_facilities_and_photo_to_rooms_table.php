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
        Schema::table('rooms', function (Blueprint $table) {
            // Kolom untuk foto, bisa kosong
            $table->string('foto')->nullable()->after('gedung');
            // Kolom untuk fasilitas, akan kita simpan sebagai JSON
            $table->json('fasilitas')->nullable()->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['foto', 'fasilitas']);
        });
    }
};
