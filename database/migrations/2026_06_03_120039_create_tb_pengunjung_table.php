<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_pengunjung', function (Blueprint $table) {
            $table->id('idPengunjung');
            $table->string('ip_address', 45); // Mendukung format IPv4 dan IPv6
            $table->date('tanggal_kunjungan');
            $table->text('user_agent')->nullable(); // Menyimpan info browser/perangkat
            $table->timestamps();

            // Mencegah 1 IP tercatat 2 kali di hari yang sama di level database
            $table->unique(['ip_address', 'tanggal_kunjungan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_pengunjung');
    }
};
