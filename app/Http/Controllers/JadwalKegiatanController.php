<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKegiatan;
use Carbon\Carbon;

class JadwalKegiatanController extends Controller
{
    public function frontendIndex()
    {
        // Tetap terapkan auto-delete untuk menjaga kebersihan data di halaman depan
        JadwalKegiatan::where('statusJK', true)
                                  ->where('tanggalJK', '<', Carbon::today()->subDays(7))
                                  ->delete();

        // Ambil data, urutkan status belum selesai ke atas, lalu urutkan tanggal terdekat
        $jadwal = JadwalKegiatan::orderBy('statusJK', 'asc')
                                            ->orderBy('tanggalJK', 'asc')
                                            ->get();

        return view('frontend.seputar_prodi.jadwal_kegiatan', compact('jadwal'));
    }
    public function index()
    {
        // AUTO-DELETE LOGIC: Hapus kegiatan "Selesai" yang sudah lebih dari 7 hari dari tanggal kegiatan
        JadwalKegiatan::where('statusJK', true)
                      ->where('tanggalJK', '<', Carbon::today()->subDays(7))
                      ->delete();

        $jadwal = JadwalKegiatan::orderBy('statusJK', 'asc')
                                ->orderBy('tanggalJK', 'asc')
                                ->get();

        return view('admin.seputar_prodi.jadwal_kegiatan', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulKegiatanJK'    => 'required|string|max:255',
            'deskripsiSingkatJK' => 'required|string|max:255',
            'tanggalJK'          => 'required|date',
        ]);

        JadwalKegiatan::create([
            'judulKegiatanJK'    => $request->judulKegiatanJK,
            'deskripsiSingkatJK' => $request->deskripsiSingkatJK,
            'tanggalJK'          => $request->tanggalJK,
            'statusJK'           => false,
        ]);

        return back()->with('success', 'Jadwal kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $jk = JadwalKegiatan::findOrFail($id);

        // LOGIKA 2: Jadwal yang sudah selesai tidak boleh diedit
        if ($jk->statusJK) {
            return back()->withErrors(['error' => 'Akses ditolak: Jadwal yang telah selesai tidak dapat diedit.']);
        }

        $request->validate([
            'judulKegiatanJK'    => 'required|string|max:255',
            'deskripsiSingkatJK' => 'required|string|max:255',
            // LOGIKA 1: tanggalJK dihapus dari validasi karena tidak boleh diubah
        ]);

        $jk->update([
            'judulKegiatanJK'    => $request->judulKegiatanJK,
            'deskripsiSingkatJK' => $request->deskripsiSingkatJK,
            // LOGIKA 1: tanggalJK tidak diikutsertakan dalam update
        ]);

        return back()->with('success', 'Jadwal kegiatan berhasil diperbarui.');
    }

    public function markSelesai($id)
    {
        $jk = JadwalKegiatan::findOrFail($id);

        // LOGIKA 3: Tidak ada fungsi untuk mengembalikan (hanya bisa mark true)
        if (Carbon::today()->gt(Carbon::parse($jk->tanggalJK))) {
            $jk->update(['statusJK' => true]);
            return back()->with('success', 'Status kegiatan dikunci menjadi Selesai. Data tidak dapat diedit/dihapus lagi dan akan otomatis terhapus dalam 7 hari.');
        }

        return back()->withErrors(['error' => 'Kegiatan belum bisa diselesaikan karena belum mencapai H+1.']);
    }

    public function destroy($id)
    {
        $jk = JadwalKegiatan::findOrFail($id);

        // LOGIKA 2: Jadwal yang sudah selesai tidak boleh dihapus manual
        if ($jk->statusJK) {
            return back()->withErrors(['error' => 'Akses ditolak: Jadwal yang telah selesai tidak dapat dihapus manual (Sistem akan menghapusnya secara otomatis).']);
        }

        $jk->delete();
        return back()->with('success', 'Jadwal kegiatan berhasil dihapus.');
    }
}
