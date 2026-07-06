<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalIlmiah;
use Illuminate\Support\Facades\File;

class JurnalIlmiahController extends Controller
{
    // Fungsi untuk Pengunjung (Frontend)
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');
        $query = JurnalIlmiah::query();

        if ($search) {
            $query->where('namaJI', 'like', '%' . $search . '%');
        }

        // Paginate 10 data
        $jurnalIlmiah = $query->orderBy('idJI', 'desc')->paginate(10);

        return view('frontend.akademik.jurnal_ilmiah', compact('jurnalIlmiah'));
    }

    // Fungsi untuk Admin (Backend)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = JurnalIlmiah::query();

        if ($search != '') {
            $query->where('namaJI', 'like', '%' . $search . '%');
        }

        $jurnalIlmiah = $query->orderBy('idJI', 'desc')->get();

        return view('admin.akademik.jurnal_ilmiah', compact('jurnalIlmiah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaJI'   => 'required|string|max:255',
            'linkJI'   => 'required|url|max:255',
            'sampulJI' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // Wajib upload gambar, maks 5MB
        ]);

        $namaFile = null;
        if ($request->hasFile('sampulJI')) {
            $file = $request->file('sampulJI');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            // PERBAIKAN: Cek dan buat direktori otomatis jika belum ada di server production
            $destinationPath = public_path('assets/admin/uploads/jurnal');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $namaFile);
        }

        JurnalIlmiah::create([
            'namaJI'   => $request->namaJI,
            'linkJI'   => $request->linkJI,
            'sampulJI' => $namaFile,
        ]);

        return back()->with('success', 'Data Jurnal Ilmiah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $ji = JurnalIlmiah::findOrFail($id);

        $request->validate([
            'namaJI'   => 'required|string|max:255',
            'linkJI'   => 'required|url|max:255',
            'sampulJI' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // Opsional saat edit
        ]);

        $dataUpdate = [
            'namaJI' => $request->namaJI,
            'linkJI' => $request->linkJI,
        ];

        // Jika admin mengganti sampul
        if ($request->hasFile('sampulJI')) {
            // Hapus sampul lama jika file fisiknya ada
            if ($ji->sampulJI && File::exists(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI))) {
                File::delete(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI));
            }

            $file = $request->file('sampulJI');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            // PERBAIKAN: Cek dan buat direktori otomatis
            $destinationPath = public_path('assets/admin/uploads/jurnal');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $namaFile);

            $dataUpdate['sampulJI'] = $namaFile;
        }

        $ji->update($dataUpdate);

        return back()->with('success', 'Data Jurnal Ilmiah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ji = JurnalIlmiah::findOrFail($id);

        // Hapus file sampul
        if ($ji->sampulJI && File::exists(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI))) {
            File::delete(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI));
        }

        $ji->delete();

        return back()->with('success', 'Data Jurnal Ilmiah berhasil dihapus.');
    }
}
