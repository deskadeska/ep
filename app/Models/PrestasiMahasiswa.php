<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiMahasiswa extends Model
{
    protected $table = 'tb_prestasi_mahasiswa';
    protected $primaryKey = 'idPM';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'namaPenerimaPM',
        'namaAjangPM',
        'peringkatPM',
        'tahunPM',
        'kategoriPM',
        'tingkatPM',
        'lokasiPM',
        'fotoUrlPM'
    ];
}
