<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankJudulSkripsi extends Model
{
    protected $table = 'tb_bank_judul_skripsi';
    protected $primaryKey = 'idBJS';

    // Matikan timestamps karena skema tidak memiliki created_at dan updated_at
    public $timestamps = false;

    protected $fillable = [
        'namaMhsBJS',
        'tanggalSeminarBJS',
        'judulSkripsiBJS',
        'metodologiPenelitianBJS',
        'dosenPembimbingBJS',
        'dosenPembimbingBJS2' // Tambahan kolom baru
    ];

    // Relasi ke Dosen Pembimbing 1
    public function dosen()
    {
        return $this->belongsTo(TenagaPengajar::class, 'dosenPembimbingBJS', 'idTP');
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(TenagaPengajar::class, 'dosenPembimbingBJS', 'idTP');
    }

    // Relasi ke Dosen Pembimbing 2
    public function dosen2()
    {
        return $this->belongsTo(TenagaPengajar::class, 'dosenPembimbingBJS2', 'idTP');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(TenagaPengajar::class, 'dosenPembimbingBJS2', 'idTP');
    }
}
