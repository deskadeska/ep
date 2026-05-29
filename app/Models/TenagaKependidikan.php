<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaKependidikan extends Model
{
    protected $table = 'tb_tenaga_kependidikan';
    protected $primaryKey = 'idTK';

    // Biarkan timestamps aktif (tidak perlu public $timestamps = false)

    protected $fillable = [
        'nipTK',
        'namaTK',
        'urlFotoTK'
    ];
}
