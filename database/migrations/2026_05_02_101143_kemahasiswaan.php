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
        Schema::create('tb_alumni', function (Blueprint $table) {
            $table->id('idAlumni');
            $table->string('namaAlumni');
            $table->year('angkatanAlumni');
            $table->year('tahunLulusAlumni');
            $table->string('pesanAlumni');
            $table->string('kesanAlumni');
            $table->string('urlFotoAlumni');
        });

        Schema::create('tb_organisasi_mahasiswa', function (Blueprint $table) {
            $table->id('idOrmawa');
            $table->string('namaOrmawa');
            $table->string('deskripsiOrmawa');
            $table->string('fotoLogoUrlOrmawa');
            $table->string('fotoAnggotaUrlOrmawa');
        });

        Schema::create('tb_prestasi_mahasiswa', function (Blueprint $table) {
            $table->id('idPM');
            $table->string('namaPenerimaPM');
            $table->string('namaAjangPM');
            $table->enum('peringkatPM', ['Desa/Kelurahan', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional']);
            $table->year('tahunPM');
            $table->string('kategoriPM');
            $table->string('tingkatPM');
            $table->string('lokasiPM');
            $table->string('fotoUrlPM');
        });

        Schema::create('tb_bank_judul_skripsi', function (Blueprint $table) {
            $table->id('idBJS');
            $table->string('namaMhsBJS');
            $table->date('tanggalSeminarBJS');
            $table->string('judulSkripsiBJS');
            $table->enum('metodologiPenelitianBJS', ['Kualitatif', 'Kuantitatif', 'Campuran']);
            $table->foreign('dosenPembimbingBJS')->references('idTP')->on('tb_tenaga_pengajar')->nullOnDelete();
            $table->foreign('dosenPembimbingBJS2')->references('idTP')->on('tb_tenaga_pengajar')->nullOnDelete();
        });

        Schema::create('tb_struktur_organisasi', function (Blueprint $table) {
            $table->id('idSO');
            $table->string('urlFotoSO');
            $table->string('deskripsiSO');
            $table->timestamps();
        });

        Schema::create('tb_statistik', function (Blueprint $table) {
            $table->id('idStatistik');
            $table->integer('mahasiswa_aktif')->default(0);
            $table->integer('mahasiswa_baru')->default(0); // Di gambar tertulis mahasiswa baru
            $table->integer('alumni')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alumni');
        Schema::dropIfExists('tb_organisasi_mahasiswa');
        Schema::dropIfExists('tb_prestasi_mahasiswa');
        Schema::dropIfExists('tb_bank_judul_skripsi');
        Schema::dropIfExists('tb_struktur_organisasi');
        Schema::dropIfExists('tb_statistik');
    }
};
