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
        Schema::create('tb_tahun_ajaran', function (Blueprint $table) {
            $table->id('idTA');
            $table->string('tahunAkademikTA');
        });

        Schema::create('tb_mata_kuliah', function (Blueprint $table) {
            // 1. Kolom Data Utama
            $table->id('idMK');
            $table->string('kodeMK')->unique();
            $table->string('namaMK');
            $table->integer('sksMK');
            $table->integer('semesterMK');
            $table->timestamps();
        });

        Schema::create('tb_magang', function (Blueprint $table) {
            $table->id('idMG');
            $table->string('namatempatMG');
            $table->string('kepalaTempatMG');
            $table->string('posisiMG');
            $table->string('linkDaftarMG');
            $table->string('fotoTempatMG');
        });

        Schema::create('tb_kalender_akademik', function (Blueprint $table) {
            $table->id('idKA');
            $table->string('kegiatanKA')->index();
            $table->date('tanggalMulaiKA');
            $table->date('tanggalSelesaiKA')->nullable();
            $table->foreignId('tahunAjaranKA')

                ->constrained('tb_tahun_ajaran', 'idTA')
                ->nullOnDelete();
        });

        Schema::create('tb_panduan_akademik', function (Blueprint $table) {
            $table->id('idPA');
            $table->string('judulPA');
            $table->string('urlFilePA');
        });

        Schema::create('tb_keperluan_tugas_akhir', function (Blueprint $table) {
            $table->id('idKTA');
            $table->string('kelompokKTA');
        });

        Schema::create('tb_detail_keperluan_tugas_akhir', function (Blueprint $table) {
            $table->id('idDKTA');
            $table->string('namaKTA');
            $table->string('urlFile');

            $table->foreignId('idKTA')

                ->constrained('tb_keperluan_tugas_akhir', 'idKTA')
                ->nullOnDelete();
        });

        Schema::create('tb_administrasi_akademik', function (Blueprint $table) {
            $table->id('idAAK');
            $table->string('ketFileAAK');
            $table->string('namaFileAAK');
            $table->string('urlFileAAK');
        });

        Schema::create('tb_statistik', function (Blueprint $table) {
            $table->id('idStat');
            $table->integer('totalMahasiswaStat');
            $table->string('totalMabaStat');
            $table->string('totalKelulusanStat');
            $table->string('totalDosenStat');
            $table->string('totalMatkulStat');
            $table->string('pengunjungWebStat');
            $table->foreignId('tahunAjaranStat')

                ->constrained('tb_tahun_ajaran', 'idTA')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mata_kuliah');
        Schema::dropIfExists('tb_magang');
        Schema::dropIfExists('tb_tahun_ajaran');
        Schema::dropIfExists('tb_kalender_akademik');
        Schema::dropIfExists('tb_panduan_akademik');
        Schema::dropIfExists('tb_keperluan_tugas_akhir');
        Schema::dropIfExists('tb_detail_keperluan_tugas_akhir');
        Schema::dropIfExists('tb_administrasi_akademik');
        Schema::dropIfExists('tb_statistik');
    }
};
