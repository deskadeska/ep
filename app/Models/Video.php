<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Video extends Model
{
    use LogsActivity;
    protected $table = 'tb_video';
    protected $primaryKey = 'idVideo';

    // Matikan timestamps karena tidak ada di skema
    public $timestamps = false;

    protected $fillable = [
        'judulVideo',
        'statusVideo',
        'urlYoutube'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Video'); // Menentukan label nama modul pada log aktivitas
    }
}
