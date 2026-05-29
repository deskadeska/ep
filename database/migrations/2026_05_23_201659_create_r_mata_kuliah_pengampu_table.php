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
        Schema::create('r_pengampu_mata_kuliah', function (Blueprint $table) {

            $table->id('idPMK');

            // Relasi ke mata kuliah
            $table->foreignId('idMK')
                ->constrained('tb_mata_kuliah', 'idMK')
                ->cascadeOnDelete();

            // Relasi ke tenaga pengajar
            $table->foreignId('idTP')
                ->constrained('tb_tenaga_pengajar', 'idTP')
                ->cascadeOnDelete();

            // Opsional:
            // Menentukan peran dosen pada mata kuliah
            $table->enum('rolePMK', [
                'Koordinator',
                'Pengampu',
                'Asisten'
            ])->default('Pengampu');

            $table->timestamps();

            // Mencegah dosen sama masuk 2x di MK yang sama
            $table->unique(['idMK', 'idTP']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_mata_kuliah_pengampu');
    }
};
