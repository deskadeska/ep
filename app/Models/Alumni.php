<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Alumni extends Model
{
    use LogsActivity;
    protected $table = 'tb_alumni';
    protected $primaryKey = 'idAlumni';

    // Matikan timestamps jika tidak ada kolom created_at/updated_at di migration
    public $timestamps = false;

    protected $fillable = [
        'namaAlumni',
        'angkatanAlumni',
        'tahunLulusAlumni',
        'pesanAlumni',
        'kesanAlumni',
        'urlFotoAlumni'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Alumni'); // Menentukan label nama modul pada log aktivitas
    }
}
