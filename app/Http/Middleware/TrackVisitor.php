<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pengunjung;
use Carbon\Carbon;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil IP pengunjung dan tanggal hari ini
        $ip = $request->ip();
        $date = Carbon::today()->toDateString();

        // Cek apakah IP ini sudah tercatat berkunjung hari ini
        $hasVisited = Pengunjung::where('ip_address', $ip)
                                ->where('tanggal_kunjungan', $date)
                                ->exists();

        // Jika belum tercatat hari ini, tambahkan ke database
        if (!$hasVisited) {
            Pengunjung::create([
                'ip_address' => $ip,
                'tanggal_kunjungan' => $date,
                'user_agent' => $request->header('User-Agent')
            ]);
        }

        return $next($request);
    }
}
