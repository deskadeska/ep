<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $table = 'tb_statistik';
    protected $primaryKey = 'idStatistik';

    protected $fillable = [
        'mahasiswa_aktif',
        'mahasiswa_baru',
        'alumni'
    ];
}
