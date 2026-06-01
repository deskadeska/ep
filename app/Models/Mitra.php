<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Mitra extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'tb_mitra';
    protected $primaryKey = 'idMitra';

    // Nonaktifkan timestamps karena tidak ada di schema
    public $timestamps = false;

    protected $fillable = [
        'namaMitra',
        'urlLogoMitra',
        'urutan'
    ];

        /**
        * Konfigurasi Log Aktivitas Spatie
        */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mitra
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Mitra'); // Menentukan label nama modul pada log aktivitas
    }
}
