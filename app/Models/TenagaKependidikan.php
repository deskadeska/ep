<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class TenagaKependidikan extends Model
{
    use LogsActivity;
    protected $table = 'tb_tenaga_kependidikan';
    protected $primaryKey = 'idTK';

    // Biarkan timestamps aktif (tidak perlu public $timestamps = false)

    protected $fillable = [
        'nipTK',
        'namaTK',
        'urlFotoTK'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Tenaga Kependidikan'); // Menentukan label nama modul pada log aktivitas
    }
}
