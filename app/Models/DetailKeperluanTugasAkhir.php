<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeperluanTugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_keperluan_tugas_akhir';
    protected $primaryKey = 'idDKTA';
    protected $guarded = [];

    /**
     * Relasi Many-to-One (Inverse) ke KeperluanTugasAkhir
     */
    public function parentKelompok()
    {
        // Parameter: (Nama Model Target, Foreign Key di tabel ini, Owner Key di tabel target)
        return $this->belongsTo(KeperluanTugasAkhir::class, 'idKTA', 'idKTA');
    }
}
