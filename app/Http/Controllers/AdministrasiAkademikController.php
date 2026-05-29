<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdministrasiAkademik;
use Illuminate\Support\Facades\File;

class AdministrasiAkademikController extends Controller
{
    public function frontendIndex()
{
    // Mengelompokkan berdasarkan ketFileAAK
    $administrasi = AdministrasiAkademik::all()->groupBy('ketFileAAK');

    // Menuju ke path view yang sudah Anda tentukan sebelumnya
    return view('frontend.akademik.administrasi_akademik', compact('administrasi'));
}
    public function index()
    {
        // Ambil data dan kelompokkan berdasarkan kolom 'ketFileAAK'
        $administrasi = AdministrasiAkademik::orderBy('idAAK', 'desc')
            ->get()
            ->groupBy('ketFileAAK');

        // Mengambil daftar kategori unik untuk rekomendasi input dropdown (Datalist)
        $kategoriList = AdministrasiAkademik::select('ketFileAAK')
            ->whereNotNull('ketFileAAK')
            ->distinct()
            ->pluck('ketFileAAK');

        return view('admin.akademik.administrasi_akademik', compact('administrasi', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ketFileAAK'  => 'required|string|max:255',
            'namaFileAAK' => 'required|string|max:255',
            'urlFileAAK'  => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240', // Maks 10MB
        ]);

        $namaFile = null;
        if ($request->hasFile('urlFileAAK')) {
            $file = $request->file('urlFileAAK');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/administrasi'), $namaFile);
        }

        AdministrasiAkademik::create([
            'ketFileAAK'  => $request->ketFileAAK,
            'namaFileAAK' => $request->namaFileAAK,
            'urlFileAAK'  => $namaFile
        ]);

        return back()->with('success', 'File administrasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $adminAkademik = AdministrasiAkademik::findOrFail($id);

        $request->validate([
            'ketFileAAK'  => 'required|string|max:255',
            'namaFileAAK' => 'required|string|max:255',
            'urlFileAAK'  => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240', // Maks 10MB
        ]);

        $dataUpdate = [
            'ketFileAAK'  => $request->ketFileAAK,
            'namaFileAAK' => $request->namaFileAAK,
        ];

        if ($request->hasFile('urlFileAAK')) {
            // Hapus file lama jika ada
            if ($adminAkademik->urlFileAAK && File::exists(public_path('assets/admin/uploads/administrasi/' . $adminAkademik->urlFileAAK))) {
                File::delete(public_path('assets/admin/uploads/administrasi/' . $adminAkademik->urlFileAAK));
            }

            $file = $request->file('urlFileAAK');
            $namaFileBaru = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/administrasi'), $namaFileBaru);
            $dataUpdate['urlFileAAK'] = $namaFileBaru;
        }

        $adminAkademik->update($dataUpdate);

        return back()->with('success', 'File administrasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $adminAkademik = AdministrasiAkademik::findOrFail($id);

        if ($adminAkademik->urlFileAAK && File::exists(public_path('assets/admin/uploads/administrasi/' . $adminAkademik->urlFileAAK))) {
            File::delete(public_path('assets/admin/uploads/administrasi/' . $adminAkademik->urlFileAAK));
        }

        $adminAkademik->delete();

        return back()->with('success', 'File administrasi berhasil dihapus.');
    }
}
