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
        Schema::create('tb_tenaga_pengajar', function (Blueprint $table) {
            $table->id('idTP');
            $table->string('nipTP')->unique();
            $table->string('nuptkTP')->unique();
            $table->string('namaTP');
            $table->string('kodeDosenTP')->unique();
            $table->string('pendidikanTP');
            $table->string('pangkatTP');
            $table->string('golonganTP');
            $table->string('jabatanFungsionalTP');
            $table->enum('tipeTP', ['Dosen Tetap', 'Dosen Luar Biasa']);
            $table->string('urlFotoTP');
            $table->timestamps();
        });

        Schema::create('tb_tenaga_kependidikan', function (Blueprint $table) {
            $table->id('idTK');
            $table->string('nipTK')->unique();
            $table->string('namaTK');
            $table->string('urlFotoTK');
            $table->timestamps();
        });

        Schema::create('tb_mitra', function (Blueprint $table) {
            $table->id('idMitra');
            $table->string('namaMitra');
            $table->string('urlLogoMitra');
        });

        Schema::create('tb_pimpinan_jurusan', function (Blueprint $table) {
            $table->id('idPJ');

            $table->year('tahunMulaiPJ');
            $table->year('tahunSelesaiPJ');

            // Foreign Key Ketua Jurusan
            $table->unsignedBigInteger('idKetuaPJ');

            // Foreign Key Sekretaris Jurusan
            $table->unsignedBigInteger('idSekretarisPJ');

            $table->timestamps();

            // Relasi ke tb_tenaga_pengajar
            $table->foreign('idKetuaPJ')
                ->references('idTP')
                ->on('tb_tenaga_pengajar')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('idSekretarisPJ')
                ->references('idTP')
                ->on('tb_tenaga_pengajar')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tenaga_pengajar');
        Schema::dropIfExists('tb_tenaga_kependidikan');
        Schema::dropIfExists('tb_mitra');
        Schema::dropIfExists('tb_pimpinan_jurusan');
    }
};
