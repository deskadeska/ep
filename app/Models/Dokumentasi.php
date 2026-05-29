<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'tb_dokumentasi';
    protected $primaryKey = 'idDokumentasi';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'judulDokumentasi',
        'statusDokumentasi',
        'tanggalDokumentasi',
        'urlFotoDokumentasi'
    ];
}
