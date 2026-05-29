<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'tb_mitra';
    protected $primaryKey = 'idMitra';

    // Nonaktifkan timestamps karena tidak ada di schema
    public $timestamps = false;

    protected $fillable = [
        'namaMitra',
        'urlLogoMitra',
        'urutan'
    ];
}
