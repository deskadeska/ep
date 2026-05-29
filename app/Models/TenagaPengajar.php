<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenagaPengajar extends Model
{
    protected $table = 'tb_tenaga_pengajar';
    protected $primaryKey = 'idTP';

    protected $fillable = [
        'nipTP',
        'nuptkTP',
        'namaTP',
        'kodeDosenTP',
        'pendidikanTP',
        'pangkatTP',
        'golonganTP',
        'jabatanFungsionalTP',
        'tipeTP',
        'urlFotoTP',
        'urutan'
    ];

    public function mataKuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            'r_pengampu_mata_kuliah',
            'idTP',
            'idMK'
        )->withPivot('idPMK', 'rolePMK')->withTimestamps();
    }
}
