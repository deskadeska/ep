<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PrestasiMahasiswa extends Model
{
    use LogsActivity;
    protected $table = 'tb_prestasi_mahasiswa';
    protected $primaryKey = 'idPM';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'namaPenerimaPM',
        'namaAjangPM',
        'peringkatPM',
        'tahunPM',
        'kategoriPM',
        'tingkatPM',
        'lokasiPM',
        'fotoUrlPM'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Prestasi Mahasiswa'); // Menentukan label nama modul pada log aktivitas
    }
}
