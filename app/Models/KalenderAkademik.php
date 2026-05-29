<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderAkademik extends Model
{
    protected $table = 'tb_kalender_akademik';
    protected $primaryKey = 'idKA';

    // Matikan timestamps karena tidak ada kolom created_at/updated_at di skema
    public $timestamps = false;

    protected $fillable = [
        'kegiatanKA',
        'tanggalMulaiKA',
        'tanggalSelesaiKA',
        'tahunAjaranKA'
    ];

    // Relasi ke tabel Tahun Ajaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahunAjaranKA', 'idTA');
    }
}
