<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrasiAkademik extends Model
{
    protected $table = 'tb_administrasi_akademik';
    protected $primaryKey = 'idAAK';

    // Timestamps aktif secara default di Laravel, biarkan menyala.

    protected $fillable = [
        'ketFileAAK',
        'namaFileAAK',
        'urlFileAAK'
    ];
}
