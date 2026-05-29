<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_statistik', function (Blueprint $table) {
            $table->id('idStatistik');
            $table->integer('mahasiswa_aktif')->default(0);
            $table->integer('mahasiswa_baru')->default(0); // Di gambar tertulis mahasiswa baru
            $table->integer('alumni')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_statistik');
    }
};
