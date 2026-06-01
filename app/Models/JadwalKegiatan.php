<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class JadwalKegiatan extends Model
{
    use HasFactory, LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Jadwal Kegiatan'); // Menentukan label nama modul pada log aktivitas
    }
}
