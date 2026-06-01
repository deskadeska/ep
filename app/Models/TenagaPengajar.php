<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TenagaPengajar extends Model
{
    use LogsActivity;
    protected $table = 'tb_tenaga_pengajar';
    protected $primaryKey = 'idTP';

    protected $fillable = [
        'nipTP',
        'nuptkTP',
        'namaTP',
        'kodeDosenTP',
        'pendidikanTP',
        'pangkatTP',
        'golonganTP',
        'jabatanFungsionalTP',
        'tipeTP',
        'urlFotoTP',
        'urutan'
    ];

    public function mataKuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            'r_pengampu_mata_kuliah',
            'idTP',
            'idMK'
        )->withPivot('idPMK', 'rolePMK')->withTimestamps();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Tenaga Pengajar'); // Menentukan label nama modul pada log aktivitas
    }
}
