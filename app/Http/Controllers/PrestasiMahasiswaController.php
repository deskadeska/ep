<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestasiMahasiswa;
use Illuminate\Support\Facades\File;

class PrestasiMahasiswaController extends Controller
{
public function frontendIndex()
    {
        // Mengurutkan berdasarkan hierarki Peringkat tertinggi ke terendah,
        // lalu diurutkan lagi berdasarkan tahun perolehan terbaru (desc)
        $prestasi = PrestasiMahasiswa::orderByRaw("
            CASE peringkatPM
                WHEN 'Internasional' THEN 1
                WHEN 'Nasional' THEN 2
                WHEN 'Provinsi' THEN 3
                WHEN 'Kabupaten/Kota' THEN 4
                WHEN 'Kecamatan' THEN 5
                WHEN 'Desa/Kelurahan' THEN 6
                ELSE 7
            END
        ")->orderBy('tahunPM', 'desc')->get();

        return view('frontend.kemahasiswaan.prestasi_mahasiswa', compact('prestasi'));
    }
    public function index()
    {
        $prestasi = PrestasiMahasiswa::orderBy('tahunPM', 'desc')->get();
        // Mengarah ke folder kemahasiswaan
        return view('admin.kemahasiswaan.prestasi_mahasiswa', compact('prestasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaPenerimaPM' => 'required|string|max:255',
            'namaAjangPM'    => 'required|string|max:255',
            'peringkatPM'    => 'required|in:Desa/Kelurahan,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'tahunPM'        => 'required|digits:4|integer',
            'kategoriPM'     => 'nullable|string|max:255',
            'tingkatPM'      => 'nullable|string|max:255',
            'lokasiPM'       => 'nullable|string|max:255',
            'fotoUrlPM'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = null;
        if ($request->hasFile('fotoUrlPM')) {
            $file = $request->file('fotoUrlPM');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/prestasi'), $namaFoto);
        }

        PrestasiMahasiswa::create([
            'namaPenerimaPM' => $request->namaPenerimaPM,
            'namaAjangPM'    => $request->namaAjangPM,
            'peringkatPM'    => $request->peringkatPM,
            'tahunPM'        => $request->tahunPM,
            'kategoriPM'     => $request->kategoriPM,
            'tingkatPM'      => $request->tingkatPM,
            'lokasiPM'       => $request->lokasiPM,
            'fotoUrlPM'      => $namaFoto
        ]);

        return back()->with('success', 'Data Prestasi Mahasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $prestasi = PrestasiMahasiswa::findOrFail($id);

        $request->validate([
            'namaPenerimaPM' => 'required|string|max:255',
            'namaAjangPM'    => 'required|string|max:255',
            'peringkatPM'    => 'required|in:Desa/Kelurahan,Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'tahunPM'        => 'required|digits:4|integer',
            'kategoriPM'     => 'nullable|string|max:255',
            'tingkatPM'      => 'nullable|string|max:255',
            'lokasiPM'       => 'nullable|string|max:255',
            'fotoUrlPM'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'namaPenerimaPM' => $request->namaPenerimaPM,
            'namaAjangPM'    => $request->namaAjangPM,
            'peringkatPM'    => $request->peringkatPM,
            'tahunPM'        => $request->tahunPM,
            'kategoriPM'     => $request->kategoriPM,
            'tingkatPM'      => $request->tingkatPM,
            'lokasiPM'       => $request->lokasiPM,
        ];

        // Logika Update Foto
        if ($request->hasFile('fotoUrlPM')) {
            if ($prestasi->fotoUrlPM && File::exists(public_path('assets/admin/uploads/prestasi/' . $prestasi->fotoUrlPM))) {
                File::delete(public_path('assets/admin/uploads/prestasi/' . $prestasi->fotoUrlPM));
            }

            $file = $request->file('fotoUrlPM');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/prestasi'), $namaFotoBaru);
            $dataUpdate['fotoUrlPM'] = $namaFotoBaru;
        }

        $prestasi->update($dataUpdate);

        return back()->with('success', 'Data Prestasi Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $prestasi = PrestasiMahasiswa::findOrFail($id);

        // Hapus fisik file gambar dari server
        if ($prestasi->fotoUrlPM && File::exists(public_path('assets/admin/uploads/prestasi/' . $prestasi->fotoUrlPM))) {
            File::delete(public_path('assets/admin/uploads/prestasi/' . $prestasi->fotoUrlPM));
        }

        $prestasi->delete();

        return back()->with('success', 'Data Prestasi Mahasiswa berhasil dihapus.');
    }
}
