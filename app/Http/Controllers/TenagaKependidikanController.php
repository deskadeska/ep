<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenagaKependidikan;
use Illuminate\Support\Facades\File;

class TenagaKependidikanController extends Controller
{
    public function frontendIndex()
    {
        // Mengambil semua data tenaga kependidikan, diurutkan berdasarkan nama
        $staff = TenagaKependidikan::orderBy('namaTK', 'asc')->get();

        return view('frontend.informasi_penting.tenaga_kependidikan', compact('staff'));
    }
    public function index()
    {
        $kependidikan = TenagaKependidikan::orderBy('idTK', 'desc')->get();
        return view('admin.informasi_penting.tenaga_kependidikan', compact('kependidikan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nipTK'     => 'nullable|string|max:255|unique:tb_tenaga_kependidikan,nipTK',
            'namaTK'    => 'required|string|max:255',
            'urlFotoTK' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nipTK.unique' => 'NIP/NIDN ini sudah digunakan oleh staf lain.'
        ]);

        $namaFoto = null;
        if ($request->hasFile('urlFotoTK')) {
            $file = $request->file('urlFotoTK');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/tenaga_kependidikan'), $namaFoto);
        }

        TenagaKependidikan::create([
            'nipTK'     => $request->nipTK,
            'namaTK'    => $request->namaTK,
            'urlFotoTK' => $namaFoto
        ]);

        return back()->with('success', 'Data Tenaga Kependidikan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $staf = TenagaKependidikan::findOrFail($id);

        $request->validate([
            // Pengecualian unik untuk idTK yang sedang diedit
            'nipTK'     => 'nullable|string|max:255|unique:tb_tenaga_kependidikan,nipTK,' . $id . ',idTK',
            'namaTK'    => 'required|string|max:255',
            'urlFotoTK' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nipTK.unique' => 'NIP/NIDN ini sudah digunakan oleh staf lain.'
        ]);

        $dataUpdate = [
            'nipTK'  => $request->nipTK,
            'namaTK' => $request->namaTK,
        ];

        // Jika ada foto baru yang diunggah
        if ($request->hasFile('urlFotoTK')) {
            // Hapus foto lama jika ada
            if ($staf->urlFotoTK && File::exists(public_path('assets/admin/uploads/tenaga_kependidikan/' . $staf->urlFotoTK))) {
                File::delete(public_path('assets/admin/uploads/tenaga_kependidikan/' . $staf->urlFotoTK));
            }

            $file = $request->file('urlFotoTK');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/tenaga_kependidikan'), $namaFotoBaru);
            $dataUpdate['urlFotoTK'] = $namaFotoBaru;
        }

        $staf->update($dataUpdate);

        return back()->with('success', 'Data Tenaga Kependidikan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $staf = TenagaKependidikan::findOrFail($id);

        // Hapus fisik file foto dari server
        if ($staf->urlFotoTK && File::exists(public_path('assets/admin/uploads/tenaga_kependidikan/' . $staf->urlFotoTK))) {
            File::delete(public_path('assets/admin/uploads/tenaga_kependidikan/' . $staf->urlFotoTK));
        }

        $staf->delete();

        return back()->with('success', 'Data Tenaga Kependidikan berhasil dihapus.');
    }
}
