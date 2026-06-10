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
        Schema::create('tb_jurnal_ilmiah', function (Blueprint $table) {
            $table->id('idJI'); // Opsional: disesuaikan jika Anda menggunakan standar penamaan ID
            $table->string('judulJI');
            $table->string('jurnalPenerbitJI');
            $table->string('namaMahasiswaJI')->nullable();
            $table->longText('abstrakJI');
            $table->string('keywordJI');
            $table->string('tahunPublikasiJI');
            $table->string('doiJI')->unique();
            $table->timestamps();

            // Foreign Key untuk mengambil data dari tb_tenaga_pengajar
            $table->foreignId('idTP')
                ->nullable()
                ->constrained('tb_tenaga_pengajar', 'idTP')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
