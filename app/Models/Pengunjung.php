<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';

    protected $fillable = [
        'ip_address',
        'user_agent',
        'tanggal_kunjungan',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    /**
     * Tanggal awal periode pertama (tidak pernah berubah).
     */
    const TANGGAL_MULAI = '2026-01-13';

    /**
     * Menghitung tanggal awal periode aktif saat ini.
     * Reset dilakukan setiap 6 bulan dari TANGGAL_MULAI.
     *
     * Contoh:
     *   Periode 1 : 13 Jan 2026 – 12 Jul 2026
     *   Periode 2 : 13 Jul 2026 – 12 Jan 2027
     *   Periode 3 : 13 Jan 2027 – dst.
     */
    public static function tanggalAwalPeriodeAktif(): Carbon
    {
        $awal    = Carbon::parse(self::TANGGAL_MULAI);
        $sekarang = now();

        // Hitung berapa periode 6-bulan sudah berlalu sejak TANGGAL_MULAI
        $bulanBerlalu = $awal->diffInMonths($sekarang);
        $periodeKe    = (int) floor($bulanBerlalu / 6);

        return $awal->copy()->addMonths($periodeKe * 6);
    }

    /**
     * Total pengunjung unik dalam periode aktif saat ini.
     */
    public static function totalPeriodeIni(): int
    {
        return static::whereDate('tanggal_kunjungan', '>=', self::tanggalAwalPeriodeAktif())
                     ->count();
    }
}
