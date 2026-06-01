<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DetailKeperluanTugasAkhir extends Model
{
    use HasFactory, logsActivity;

    protected $table = 'tb_detail_keperluan_tugas_akhir';
    protected $primaryKey = 'idDKTA';
    protected $guarded = [];

    /**
     * Relasi Many-to-One (Inverse) ke KeperluanTugasAkhir
     */
    public function parentKelompok()
    {
        // Parameter: (Nama Model Target, Foreign Key di tabel ini, Owner Key di tabel target)
        return $this->belongsTo(KeperluanTugasAkhir::class, 'idKTA', 'idKTA');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Detail Keperluan Tugas Akhir'); // Menentukan label nama modul pada log aktivitas
    }
}
