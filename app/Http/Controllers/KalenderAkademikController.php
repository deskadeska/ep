<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KalenderAkademik;
use App\Models\TahunAjaran;

class KalenderAkademikController extends Controller
{
    public function frontendIndex(Request $request)
    {
        // Mengambil semua tahun ajaran untuk dropdown menggunakan kolom tahunAkademikTA
        $listTahunAjaran = \App\Models\TahunAjaran::orderBy('tahunAkademikTA', 'desc')->get();

        // Mengambil tahun ajaran yang dipilih atau default ke yang terbaru (berdasarkan idTA)
        $selectedTA = $request->input('tahun_ajaran') ?? ($listTahunAjaran->first()->idTA ?? null);

        // Mengambil data kalender berdasarkan kolom tahunAjaranKA, urutkan berdasarkan tanggal mulai
        $kalender = \App\Models\KalenderAkademik::where('tahunAjaranKA', $selectedTA)
                    ->orderBy('tanggalMulaiKA', 'asc')
                    ->get();

        return view('frontend.akademik.kalender_akademik', compact('kalender', 'listTahunAjaran', 'selectedTA'));
    }

    public function index(Request $request)
    {
        // Ambil semua tahun ajaran untuk dropdown filter
        $tahunAjarans = TahunAjaran::orderBy('idTA', 'desc')->get();

        // Tentukan tahun ajaran yang dipilih (default ke tahun ajaran terbaru jika kosong)
        $selectedTA = $request->input('idTA');
        if (!$selectedTA && $tahunAjarans->isNotEmpty()) {
            $selectedTA = $tahunAjarans->first()->idTA;
        }

        // Ambil kalender berdasarkan tahun ajaran yang dipilih, urutkan berdasarkan tanggal mulai
        $kalenderQuery = KalenderAkademik::with('tahunAjaran');

        if ($selectedTA) {
            $kalenderQuery->where('tahunAjaranKA', $selectedTA);
        }

        $kalender = $kalenderQuery->orderBy('tanggalMulaiKA', 'asc')->get();

        return view('admin.akademik.kalender_akademik', compact('kalender', 'tahunAjarans', 'selectedTA'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatanKA'       => 'required|string|max:255',
            'tanggalMulaiKA'   => 'required|date',
            'tanggalSelesaiKA' => 'nullable|date|after_or_equal:tanggalMulaiKA',
            'tahunAjaranKA'    => 'required|exists:tb_tahun_ajaran,idTA'
        ]);

        KalenderAkademik::create([
            'kegiatanKA'       => $request->kegiatanKA,
            'tanggalMulaiKA'   => $request->tanggalMulaiKA,
            'tanggalSelesaiKA' => $request->tanggalSelesaiKA,
            'tahunAjaranKA'    => $request->tahunAjaranKA
        ]);

        return back()->with('success', 'Kegiatan Kalender Akademik berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kalender = KalenderAkademik::findOrFail($id);

        $request->validate([
            'kegiatanKA'       => 'required|string|max:255',
            'tanggalMulaiKA'   => 'required|date',
            'tanggalSelesaiKA' => 'nullable|date|after_or_equal:tanggalMulaiKA',
            'tahunAjaranKA'    => 'required|exists:tb_tahun_ajaran,idTA'
        ]);

        $kalender->update([
            'kegiatanKA'       => $request->kegiatanKA,
            'tanggalMulaiKA'   => $request->tanggalMulaiKA,
            'tanggalSelesaiKA' => $request->tanggalSelesaiKA,
            'tahunAjaranKA'    => $request->tahunAjaranKA
        ]);

        return back()->with('success', 'Kegiatan Kalender Akademik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kalender = KalenderAkademik::findOrFail($id);
        $kalender->delete();

        return back()->with('success', 'Kegiatan Kalender Akademik berhasil dihapus.');
    }
}
