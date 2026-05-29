<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganisasiMahasiswa extends Model
{
    protected $table = 'tb_organisasi_mahasiswa';
    protected $primaryKey = 'idOrmawa';

    // Matikan timestamps karena skema tidak memiliki created_at dan updated_at
    public $timestamps = false;

    protected $fillable = [
        'namaOrmawa',
        'deskripsiOrmawa',
        'fotoLogoUrlOrmawa',
        'fotoAnggotaUrlOrmawa'
    ];
}
