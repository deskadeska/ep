<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeperluanTugasAkhir;

class KeperluanTugasAkhirController extends Controller
{
    // Method untuk menampilkan halaman frontend (pengunjung)
    public function frontendIndex()
    {
        // Mengambil data kelompok tugas akhir beserta relasi detailnya
        $keperluan = \App\Models\KeperluanTugasAkhir::with('details')->get();

        return view('frontend.akademik.keperluan_tugas_akhir', compact('keperluan'));
    }
    public function index()
    {
        $keperluan = KeperluanTugasAkhir::orderBy('idKTA', 'desc')->get();
        return view('admin.akademik.keperluan_tugas_akhir', compact('keperluan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompokKTA' => 'required|string|max:255'
        ]);

        KeperluanTugasAkhir::create([
            'kelompokKTA' => $request->kelompokKTA
        ]);

        return back()->with('success', 'Kelompok Keperluan Tugas Akhir berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kta = KeperluanTugasAkhir::findOrFail($id);

        $request->validate([
            'kelompokKTA' => 'required|string|max:255'
        ]);

        $kta->update([
            'kelompokKTA' => $request->kelompokKTA
        ]);

        return back()->with('success', 'Kelompok Keperluan Tugas Akhir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kta = KeperluanTugasAkhir::findOrFail($id);
        $kta->delete();

        return back()->with('success', 'Kelompok Keperluan Tugas Akhir berhasil dihapus.');
    }
}
