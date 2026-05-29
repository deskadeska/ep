<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'tb_berita';
    protected $primaryKey = 'idBerita';

    // Timestamps dibiarkan aktif (tidak perlu menonaktifkannya)

    protected $fillable = [
        'judulBerita',
        'deskripsiBerita',
        'statusBerita',
        'kategoriBerita',
        'fotoBerita'
    ];
}
