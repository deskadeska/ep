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

    // idTP sudah tidak ada di tabel ini
    protected $fillable = [
        'judulJI', 'jurnalPenerbitJI', 'namaMahasiswaJI', 'abstrakJI', 'keywordJI', 'tahunPublikasiJI', 'doiJI'
    ];

    /**
     * Relasi Many-to-Many ke Tenaga Pengajar
     */
    public function tenagaPengajar()
    {
        return $this->belongsToMany(
            TenagaPengajar::class,
            'r_penulis_jurnal_ilmiah',
            'idJI',
            'idTP'
        )->withPivot('idRPJI', 'rolePenulis')->withTimestamps();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('Jurnal Ilmiah');
    }
}
