<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TahunAjaran extends Model
{
    use LogsActivity;
    protected $table = 'tb_tahun_ajaran';
    protected $primaryKey = 'idTA';

    // Matikan timestamps karena tidak ada kolom created_at/updated_at di skema
    public $timestamps = false;

    protected $fillable = [
        'tahunAkademikTA'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Tahun Ajaran'); // Menentukan label nama modul pada log aktivitas
    }
}
