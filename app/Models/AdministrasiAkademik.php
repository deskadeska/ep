<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AdministrasiAkademik extends Model
{
    use LogsActivity;
    protected $table = 'tb_administrasi_akademik';
    protected $primaryKey = 'idAAK';

    // Timestamps aktif secara default di Laravel, biarkan menyala.

    protected $fillable = [
        'ketFileAAK',
        'namaFileAAK',
        'urlFileAAK'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mitra
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Administrasi Akademik'); // Menentukan label nama modul pada log aktivitas
    }
}
