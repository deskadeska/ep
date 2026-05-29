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
        Schema::create('tb_video', function (Blueprint $table) {
            $table->id('idVideo');
            $table->string('judulVideo');
            $table->enum('statusVideo', ['Published', 'Draft']);
            $table->string('urlYoutube');
        });

        Schema::create('tb_dokumentasi', function (Blueprint $table) {
            $table->id('idDokumentasi');
            $table->string('judulDokumentasi');
            $table->enum('statusDokumentasi', ['Published', 'Draft']);
            $table->date('tanggalDokumentasi');
            $table->string('urlFotoDokumentasi');
        });

        Schema::create('tb_berita', function (Blueprint $table) {
            $table->id('idBerita');
            $table->string('judulBerita');
            $table->string('deskripsiBerita');
            $table->enum('statusBerita', ['Highlight', 'Published', 'Draft']);
            $table->string('kategoriBerita');
            $table->string('fotoBerita');
            $table->timestamps();
        });

        Schema::create('tb_jadwal_kegiatan', function (Blueprint $table) {
            $table->id('idJK');
            $table->string('judulKegiatanJK');
            $table->string('deskripsiSingkatJK');
            $table->date('tanggalJK');
            $table->boolean('statusJK')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_video');
        Schema::dropIfExists('tb_dokumentasi');
        Schema::dropIfExists('tb_berita');
    }
};
