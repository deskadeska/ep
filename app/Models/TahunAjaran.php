<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tb_tahun_ajaran';
    protected $primaryKey = 'idTA';

    // Matikan timestamps karena tidak ada kolom created_at/updated_at di skema
    public $timestamps = false;

    protected $fillable = [
        'tahunAkademikTA'
    ];
}
