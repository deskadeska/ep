<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OrganisasiMahasiswa extends Model
{
    use LogsActivity;
    protected $table = 'tb_organisasi_mahasiswa';
    protected $primaryKey = 'idOrmawa';

    // Matikan timestamps karena skema tidak memiliki created_at dan updated_at
    public $timestamps = false;

    protected $fillable = [
        'namaOrmawa',
        'deskripsiOrmawa',
        'fotoLogoUrlOrmawa',
        'fotoAnggotaUrlOrmawa'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Organisasi Mahasiswa'); // Menentukan label nama modul pada log aktivitas
    }
}
