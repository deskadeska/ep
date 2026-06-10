<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CapaianDosen extends Model
{
    use LogsActivity;

    protected $table = 'tb_capaian_dosen';
    protected $primaryKey = 'idCD';

    protected $fillable = [
        'idTP', 'judulCD', 'tingkatCD', 'tahunCD', 'deskripsiCD', 'fileSertifikatCD'
    ];

    /**
     * Relasi ke Tenaga Pengajar (Satu Capaian dimiliki oleh Satu Dosen)
     */
    public function tenagaPengajar()
    {
        return $this->belongsTo(TenagaPengajar::class, 'idTP', 'idTP');
    }

    /**
     * Konfigurasi Log Aktivitas Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Capaian Dosen');
    }
}
