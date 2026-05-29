<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'tb_mata_kuliah';
    protected $primaryKey = 'idMK';

    protected $fillable = [
        'kodeMK', 'namaMK', 'sksMK', 'semesterMK'
    ];

    public function tenagaPengajar()
    {
        return $this->belongsToMany(
            TenagaPengajar::class,
            'r_pengampu_mata_kuliah',
            'idMK',
            'idTP'
        )->withPivot('idPMK', 'rolePMK')->withTimestamps();
    }
}
