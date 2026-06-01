<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Magang extends Model
{
    use LogsActivity;
    protected $table = 'tb_magang';
    protected $primaryKey = 'idMG';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'namatempatMG',
        'kepalaTempatMG',
        'posisiMG',
        'linkDaftarMG',
        'fotoTempatMG'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Magang'); // Menentukan label nama modul pada log aktivitas
    }
}
