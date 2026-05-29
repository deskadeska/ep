<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeperluanTugasAkhir extends Model
{
    use HasFactory;

    // Sesuaikan nama tabel jika Anda mendefinisikannya secara manual
    protected $table = 'tb_keperluan_tugas_akhir';

    // Sesuaikan primary key karena Anda menggunakan 'idKTA', bukan 'id'
    protected $primaryKey = 'idKTA';

    protected $guarded = [];

    /**
     * Relasi One-to-Many ke DetailKeperluanTugasAkhir
     * 1 Kelompok KTA memiliki banyak Detail KTA
     */
    public function details()
    {
        // Parameter: (Nama Model Target, Foreign Key di tabel target, Local Key di tabel ini)
        return $this->hasMany(DetailKeperluanTugasAkhir::class, 'idKTA', 'idKTA');
    }
}
