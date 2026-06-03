<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'tb_pengunjung';
    protected $primaryKey = 'idPengunjung';

    protected $fillable = [
        'ip_address',
        'tanggal_kunjungan',
        'user_agent'
    ];
}
