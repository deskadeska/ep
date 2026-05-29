<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanduanAkademik extends Model
{
    protected $table = 'tb_panduan_akademik';
    protected $primaryKey = 'idPA';

    // HAPUS BARIS INI: public $timestamps = false;

    protected $fillable = ['judulPA', 'urlFilePA'];
}
