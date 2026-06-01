<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MataKuliah extends Model
{
    use LogsActivity;

    protected $table = 'tb_mata_kuliah';
    protected $primaryKey = 'idMK';

    protected $fillable = [
        'kodeMK', 'namaMK', 'sksMK', 'semesterMK'
    ];

    public function tenagaPengajar()
    {
        return $this->belongsToMany(
            TenagaPengajar::class,
            'r_pengampu_mata_kuliah',
            'idMK',
            'idTP'
        )->withPivot('idPMK', 'rolePMK')->withTimestamps();
    }

    /**
     * Konfigurasi Log Aktivitas Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Mata Kuliah'); // Menentukan label nama modul pada log aktivitas
    }
}
