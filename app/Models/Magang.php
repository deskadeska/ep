<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $table = 'tb_magang';
    protected $primaryKey = 'idMG';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'namatempatMG',
        'kepalaTempatMG',
        'posisiMG',
        'linkDaftarMG',
        'fotoTempatMG'
    ];
}
