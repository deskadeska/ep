<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PimpinanJurusan extends Model
{
    protected $table = 'tb_pimpinan_jurusan';
    protected $primaryKey = 'idPJ';

    protected $fillable = [
        'tahunMulaiPJ',
        'tahunSelesaiPJ',
        'idKetuaPJ',
        'idSekretarisPJ'
    ];

    // Relasi ke tabel tenaga pengajar sebagai Ketua
    public function ketua()
    {
        return $this->belongsTo(TenagaPengajar::class, 'idKetuaPJ', 'idTP');
    }

    // Relasi ke tabel tenaga pengajar sebagai Sekretaris
    public function sekretaris()
    {
        return $this->belongsTo(TenagaPengajar::class, 'idSekretarisPJ', 'idTP');
    }
}
