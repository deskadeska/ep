<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class JurnalIlmiah extends Model
{
    use LogsActivity;

    protected $table = 'tb_jurnal_ilmiah';
    protected $primaryKey = 'idJI';

    protected $fillable = [
        'namaJI', 'linkJI', 'sampulJI'
    ];

    /**
     * Konfigurasi Log Aktivitas Spatie
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Jurnal Ilmiah');
    }
}
