<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Statistik extends Model
{
    use LogsActivity;
    protected $table = 'tb_statistik';
    protected $primaryKey = 'idStatistik';

    protected $fillable = [
        'mahasiswa_aktif',
        'mahasiswa_baru',
        'alumni'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Statistik'); // Menentukan label nama modul pada log aktivitas
    }
}
