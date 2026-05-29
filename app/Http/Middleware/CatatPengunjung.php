<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Symfony\Component\HttpFoundation\Response;

class CatatPengunjung
{
    /**
     * Mencatat pengunjung unik (per IP per hari) ke database.
     * Bot/crawler umum diabaikan agar hitungan lebih akurat.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lewati jika request bukan dari browser (AJAX, API, bot)
        if ($request->ajax() || $request->wantsJson()) {
            return $next($request);
        }

        // Lewati bot/crawler umum
        $userAgent = strtolower($request->userAgent() ?? '');
        $botKeywords = ['bot', 'crawler', 'spider', 'slurp', 'facebookexternalhit', 'curl', 'wget'];
        foreach ($botKeywords as $keyword) {
            if (str_contains($userAgent, $keyword)) {
                return $next($request);
            }
        }

        $ip = $request->ip();
        $today = today()->toDateString();

        // Gunakan updateOrCreate agar tidak duplikat (IP + tanggal unik)
        try {
            Pengunjung::firstOrCreate(
                [
                    'ip_address'          => $ip,
                    'tanggal_kunjungan'   => $today,
                ],
                [
                    'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                ]
            );
        } catch (\Exception $e) {
            // Jika terjadi race condition atau error lain, lanjutkan saja
            // agar tidak mengganggu tampilan halaman
            report($e);
        }

        return $next($request);
    }
}
