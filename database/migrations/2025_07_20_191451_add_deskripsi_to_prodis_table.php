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
        Schema::table('prodis', function (Blueprint $table) {
            // Tambahkan kolom deskripsi setelah nama_prodi, bisa kosong
            $table->text('deskripsi')->nullable()->after('nama_prodi');
        });
    }

    public function down(): void
    {
        Schema::table('prodis', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};
