<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'tb_struktur_organisasi';
    protected $primaryKey = 'idSO';

    protected $fillable = [
        'urlFotoSO',
        'deskripsiSO'
    ];
}
