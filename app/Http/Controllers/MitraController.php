<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\File;

class MitraController extends Controller
{
    // ====================================================================
    // FRONTEND METHODS (PENGUNJUNG)
    // ====================================================================

    // Opsional: Jika suatu saat Anda ingin membuat halaman khusus daftar Mitra
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');
        $query = Mitra::query();

        if ($search) {
            $query->where('namaMitra', 'like', '%' . $search . '%');
        }

        $dataMitra = $query->orderBy('idMitra', 'desc')->get();

        return view('frontend.informasi_penting.mitra', compact('dataMitra', 'search'));
    }

    // ====================================================================
    // ADMIN METHODS (USER)
    // ====================================================================

    public function index()
    {
        // Urutkan berdasarkan kolom 'urutan' ASC, lalu 'idMitra' DESC sebagai fallback
        $mitra = Mitra::orderBy('urutan', 'asc')->orderBy('idMitra', 'desc')->get();
        return view('admin.informasi_penting.mitra', compact('mitra'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namaMitra' => 'required|string|max:255',
            'urlLogoMitra' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048'
        ]);

        $namaFoto = null;

        if ($request->hasFile('urlLogoMitra')) {
            $file = $request->file('urlLogoMitra');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/mitra'), $namaFoto);
        }

        Mitra::create([
            'namaMitra' => $request->namaMitra,
            'urlLogoMitra' => $namaFoto
        ]);

        return back()->with('success', 'Data Mitra berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $request->validate([
            'namaMitra' => 'required|string|max:255',
            'urlLogoMitra' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048'
        ]);

        $dataUpdate = [
            'namaMitra' => $request->namaMitra,
        ];

        // Jika upload foto baru
        if ($request->hasFile('urlLogoMitra')) {
            // Hapus foto lama
            if ($mitra->urlLogoMitra && File::exists(public_path('assets/admin/uploads/mitra/' . $mitra->urlLogoMitra))) {
                File::delete(public_path('assets/admin/uploads/mitra/' . $mitra->urlLogoMitra));
            }

            // Simpan foto baru
            $file = $request->file('urlLogoMitra');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/mitra'), $namaFotoBaru);

            $dataUpdate['urlLogoMitra'] = $namaFotoBaru;
        }

        $mitra->update($dataUpdate);

        return back()->with('success', 'Data Mitra berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);

        // Hapus fisik foto dari server
        if ($mitra->urlLogoMitra && File::exists(public_path('assets/admin/uploads/mitra/' . $mitra->urlLogoMitra))) {
            File::delete(public_path('assets/admin/uploads/mitra/' . $mitra->urlLogoMitra));
        }

        $mitra->delete();

        return back()->with('success', 'Data Mitra berhasil dihapus.');
    }

    public function updateUrutan(Request $request)
    {
        $urutanData = $request->input('urutan'); // Menerima array ID mitra yang sudah diurutkan

        if($urutanData && is_array($urutanData)) {
            foreach ($urutanData as $index => $id) {
                // Update nilai urutan di database (dimulai dari 1, 2, 3, dst)
                Mitra::where('idMitra', $id)->update(['urutan' => $index + 1]);
            }
            return response()->json(['success' => true, 'message' => 'Urutan berhasil disimpan!']);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menyimpan urutan.']);
    }
}
