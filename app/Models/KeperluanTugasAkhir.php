<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class KeperluanTugasAkhir extends Model
{
    use HasFactory, LogsActivity;

    // Sesuaikan nama tabel jika Anda mendefinisikannya secara manual
    protected $table = 'tb_keperluan_tugas_akhir';

    // Sesuaikan primary key karena Anda menggunakan 'idKTA', bukan 'id'
    protected $primaryKey = 'idKTA';

    protected $guarded = [];

    /**
     * Relasi One-to-Many ke DetailKeperluanTugasAkhir
     * 1 Kelompok KTA memiliki banyak Detail KTA
     */
    public function details()
    {
        // Parameter: (Nama Model Target, Foreign Key di tabel target, Local Key di tabel ini)
        return $this->hasMany(DetailKeperluanTugasAkhir::class, 'idKTA', 'idKTA');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Keperluan Tugas Akhir'); // Menentukan label nama modul pada log aktivitas
    }
}
