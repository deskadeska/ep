<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_capaian_dosen', function (Blueprint $table) {
            $table->id('idCD');

            // Relasi ke tabel dosen
            $table->foreignId('idTP')
                  ->constrained('tb_tenaga_pengajar', 'idTP')
                  ->cascadeOnDelete();

            $table->string('judulCD'); // Nama penghargaan/capaian
            $table->enum('tingkatCD', ['Lokal', 'Nasional', 'Internasional']); // Tingkat capaian
            $table->string('tahunCD', 4);
            $table->text('deskripsiCD')->nullable();
            $table->string('fileSertifikatCD')->nullable(); // Untuk upload bukti/sertifikat

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_capaian_dosen');
    }
};
