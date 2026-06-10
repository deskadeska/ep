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
        Schema::create('tb_tracer_studies', function (Blueprint $table) {
            $table->id();

            // --- Bagian 1: Data Diri dan Status Utama ---
            $table->string('nama_lengkap');
            $table->string('nim');
            $table->year('tahun_lulus');
            $table->string('status_pekerjaan');

            // --- Bagian 2: Khusus Bekerja / Wiraswasta ---
            // Dibuat nullable() karena alumni yang "Belum Bekerja" tidak akan mengisi bagian ini
            $table->string('nama_instansi')->nullable();
            $table->string('sektor_pekerjaan')->nullable();
            $table->integer('waktu_tunggu_bulan')->nullable();
            $table->string('rata_rata_pendapatan')->nullable();

            // --- Bagian 3: Keselarasan Studi dan Feedback ---
            // Kolom relevansi disesuaikan dengan opsi spesifik yang kamu minta
            $table->enum('relevansi_pekerjaan', ['Ya', 'Mungkin', 'Tidak'])->nullable();
            $table->string('tingkat_pendidikan_tepat')->nullable();
            $table->text('saran_kompetensi')->nullable(); // Menggunakan text() karena jawaban berupa paragraf

            // --- Status Validasi Admin ---
            $table->enum('status_validasi', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_studies');
    }
};
