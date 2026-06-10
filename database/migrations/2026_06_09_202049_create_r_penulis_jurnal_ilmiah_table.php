<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('r_penulis_jurnal_ilmiah', function (Blueprint $table) {
            $table->id('idRPJI');

            // Relasi ke Jurnal Ilmiah
            $table->foreignId('idJI')
                  ->constrained('tb_jurnal_ilmiah', 'idJI')
                  ->cascadeOnDelete();

            // Relasi ke Tenaga Pengajar
            $table->foreignId('idTP')
                  ->constrained('tb_tenaga_pengajar', 'idTP')
                  ->cascadeOnDelete();

            // Peran penulis jurnal
            $table->enum('rolePenulis', [
                'Penulis Pertama',
                'Penulis Anggota',
                'Corresponding Author'
            ])->default('Penulis Anggota');

            $table->timestamps();

            // Mencegah dosen yang sama masuk 2x di jurnal yang sama
            $table->unique(['idJI', 'idTP']);
        });

        // HAPUS kolom idTP dari tabel tb_jurnal_ilmiah karena sudah dipindah ke tabel pivot
        if (Schema::hasColumn('tb_jurnal_ilmiah', 'idTP')) {
            Schema::table('tb_jurnal_ilmiah', function (Blueprint $table) {
                $table->dropForeign(['idTP']); // Hapus constraint foreign key dulu
                $table->dropColumn('idTP');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('r_penulis_jurnal_ilmiah');

        // Kembalikan kolom idTP jika di-rollback
        Schema::table('tb_jurnal_ilmiah', function (Blueprint $table) {
            $table->foreignId('idTP')->nullable()->constrained('tb_tenaga_pengajar', 'idTP')->nullOnDelete();
        });
    }
};
