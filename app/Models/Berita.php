<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Berita extends Model
{
    use LogsActivity;
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mitra
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Berita'); // Menentukan label nama modul pada log aktivitas
    }
}
