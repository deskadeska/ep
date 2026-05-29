<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magang;
use Illuminate\Support\Facades\File;

class MagangController extends Controller
{
    // ====================================================================
    // FRONTEND METHODS (PENGUNJUNG)
    // ====================================================================

    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');

        $query = Magang::query();

        // Pencarian berdasarkan nama tempat atau posisi magang
        if ($search) {
            $query->where('namatempatMG', 'like', '%' . $search . '%')
                  ->orWhere('posisiMG', 'like', '%' . $search . '%');
        }

        $dataMagang = $query->orderBy('idMG', 'desc')->get();

        // Statistik Dinamis
        $stats = [
            'total_mitra' => Magang::distinct('namatempatMG')->count(),
            'posisi_tersedia' => Magang::count(),
            'wilayah' => 'Kalimantan & Nasional' // Bisa disesuaikan
        ];

        return view('frontend.akademik.magang', compact('dataMagang', 'stats', 'search'));
    }

    // ====================================================================
    // ADMIN METHODS (USER)
    // ====================================================================
    public function index()
    {
        $magang = Magang::orderBy('idMG', 'desc')->get();
        return view('admin.akademik.magang', compact('magang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namatempatMG' => 'required|string|max:255',
            'kepalaTempatMG' => 'nullable|string|max:255',
            'posisiMG' => 'nullable|string|max:255',
            'linkDaftarMG' => 'nullable|url|max:255', // Memastikan input adalah URL yang valid
            'fotoTempatMG' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = null;

        if ($request->hasFile('fotoTempatMG')) {
            $file = $request->file('fotoTempatMG');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/magang'), $namaFoto);
        }

        Magang::create([
            'namatempatMG' => $request->namatempatMG,
            'kepalaTempatMG' => $request->kepalaTempatMG,
            'posisiMG' => $request->posisiMG,
            'linkDaftarMG' => $request->linkDaftarMG,
            'fotoTempatMG' => $namaFoto
        ]);

        return back()->with('success', 'Data Tempat Magang berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $magang = Magang::findOrFail($id);

        $request->validate([
            'namatempatMG' => 'required|string|max:255',
            'kepalaTempatMG' => 'nullable|string|max:255',
            'posisiMG' => 'nullable|string|max:255',
            'linkDaftarMG' => 'nullable|url|max:255',
            'fotoTempatMG' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'namatempatMG' => $request->namatempatMG,
            'kepalaTempatMG' => $request->kepalaTempatMG,
            'posisiMG' => $request->posisiMG,
            'linkDaftarMG' => $request->linkDaftarMG,
        ];

        // Jika upload foto baru
        if ($request->hasFile('fotoTempatMG')) {
            // Hapus foto lama
            if ($magang->fotoTempatMG && File::exists(public_path('assets/admin/uploads/magang/' . $magang->fotoTempatMG))) {
                File::delete(public_path('assets/admin/uploads/magang/' . $magang->fotoTempatMG));
            }

            // Simpan foto baru
            $file = $request->file('fotoTempatMG');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/magang'), $namaFotoBaru);

            $dataUpdate['fotoTempatMG'] = $namaFotoBaru;
        }

        $magang->update($dataUpdate);

        return back()->with('success', 'Data Tempat Magang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);

        // Hapus fisik foto dari server
        if ($magang->fotoTempatMG && File::exists(public_path('assets/admin/uploads/magang/' . $magang->fotoTempatMG))) {
            File::delete(public_path('assets/admin/uploads/magang/' . $magang->fotoTempatMG));
        }

        $magang->delete();

        return back()->with('success', 'Data Tempat Magang berhasil dihapus.');
    }
}
