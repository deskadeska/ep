<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'tb_alumni';
    protected $primaryKey = 'idAlumni';

    // Matikan timestamps jika tidak ada kolom created_at/updated_at di migration
    public $timestamps = false;

    protected $fillable = [
        'namaAlumni',
        'angkatanAlumni',
        'tahunLulusAlumni',
        'pesanAlumni',
        'kesanAlumni',
        'urlFotoAlumni'
    ];
}
