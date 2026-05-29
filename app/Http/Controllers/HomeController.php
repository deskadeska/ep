<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Mitra;
use App\Models\Dokumentasi;
use App\Models\Video;
use App\Models\Pengunjung;
use App\Models\Statistik;
use App\Models\TahunAjaran;
use App\Models\JadwalKegiatan;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Data berita highlight (Maksimal 3 terbaru)
        $highlights = Berita::where('statusBerita', 'Highlight')
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

        // 2. Data Mitra, DIURUTKAN berdasarkan kolom 'urutan' ASC
        $mitra = Mitra::orderBy('urutan', 'asc')
                      ->orderBy('idMitra', 'desc')
                      ->get();

        // 3. Data Galeri / Dokumentasi (5 Terbaru)
        $galeri = Dokumentasi::where('statusDokumentasi', 'Published')
                             ->orderBy('tanggalDokumentasi', 'desc')
                             ->take(5)
                             ->get();

        // 4. Data Video Pinned (Hanya 1)
        $pinnedVideo = Video::where('statusVideo', 'Pinned')
                            ->take(1)
                            ->get();

        // 5. Total pengunjung periode aktif (reset tiap 6 bulan sejak 13 Jan 2026)
        $totalPengunjung = Pengunjung::totalPeriodeIni();

        // 6. Ambil data statistik dari tabel (jika kosong, buat instance baru agar tidak error)
        $statistik = Statistik::first() ?? new Statistik();

        // 7. Ambil Tahun Ajaran paling baru (berdasarkan ID terakhir yang ditambahkan)
        $tahunAjaranTerbaru = TahunAjaran::latest('idTA')->first();

        // 8. Ambil Jadwal Kegiatan yang akan datang (tanggal >= hari ini) dan statusJK = true, urutkan berdasarkan tanggal terdekat
        $jadwal = JadwalKegiatan::where('tanggalJK', '>=', now()->toDateString())
                            ->where('statusJK', false)
                            ->orderBy('tanggalJK', 'asc')
                            ->take(3)
                            ->get();

        return view('frontend.home', compact(
            'highlights',
            'mitra',
            'galeri',
            'pinnedVideo',
            'totalPengunjung',
            'statistik',
            'tahunAjaranTerbaru',
            'jadwal'
        ));
    }
}
