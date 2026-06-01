<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BankJudulSkripsi extends Model
{
    use LogsActivity;
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Bank Judul Skripsi'); // Menentukan label nama modul pada log aktivitas
    }
}
