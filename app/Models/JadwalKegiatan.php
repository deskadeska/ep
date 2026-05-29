<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    use HasFactory;

    protected $table = 'tb_jadwal_kegiatan';
    protected $primaryKey = 'idJK';

    // Set ke false jika di migration Anda tidak menggunakan $table->timestamps()
    public $timestamps = false;

    protected $fillable = [
        'judulKegiatanJK',
        'deskripsiSingkatJK',
        'tanggalJK',
        'statusJK'
    ];

    protected $casts = [
        'tanggalJK' => 'date',
        'statusJK'  => 'boolean',
    ];
}
