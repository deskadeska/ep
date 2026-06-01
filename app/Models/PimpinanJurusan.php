<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PimpinanJurusan extends Model
{
    use LogsActivity;
    protected $table = 'tb_pimpinan_jurusan';
    protected $primaryKey = 'idPJ';

    protected $fillable = [
        'tahunMulaiPJ',
        'tahunSelesaiPJ',
        'idKetuaPJ',
        'idSekretarisPJ'
    ];

    // Relasi ke tabel tenaga pengajar sebagai Ketua
    public function ketua()
    {
        return $this->belongsTo(TenagaPengajar::class, 'idKetuaPJ', 'idTP');
    }

    // Relasi ke tabel tenaga pengajar sebagai Sekretaris
    public function sekretaris()
    {
        return $this->belongsTo(TenagaPengajar::class, 'idSekretarisPJ', 'idTP');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()             // Mencatat seluruh kolom yang ada di tabel mata kuliah
            ->logOnlyDirty()        // Hanya mencatat log jika ada perubahan data pada kolom (saat update)
            ->dontSubmitEmptyLogs() // Mencegah pencatatan log kosong jika user hanya klik simpan tanpa ubah teks
            ->useLogName('Pimpinan Jurusan'); // Menentukan label nama modul pada log aktivitas
    }
}
