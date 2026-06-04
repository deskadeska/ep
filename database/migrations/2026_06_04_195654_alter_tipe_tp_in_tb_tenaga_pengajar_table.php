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
        Schema::table('tb_tenaga_pengajar', function (Blueprint $table) {
            // Mengubah opsi value enum menjadi lebih lengkap (Typo 'Luas' disesuaikan menjadi 'Luar')
            $table->enum('tipeTP', [
                'Dosen Luar Biasa',
                'Dosen Tetap',
                'Dosen Tidak Tetap',
                'Dosen Praktisi'
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_tenaga_pengajar', function (Blueprint $table) {
            // Mengembalikan ke struktur enum awal jika dilakukan rollback
            $table->enum('tipeTP', [
                'Dosen Tetap',
                'Dosen Luar Biasa'
            ])->change();
        });
    }
};
