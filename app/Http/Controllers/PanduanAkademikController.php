<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanduanAkademik;
use Illuminate\Support\Facades\File;

class PanduanAkademikController extends Controller
{
    public function index()
    {
        $panduan = PanduanAkademik::orderBy('idPA', 'desc')->get();
        return view('admin.akademik.panduan_akademik', compact('panduan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulPA'   => 'required|string|max:255',
            'urlFilePA' => 'required|file|mimes:pdf,doc,docx|max:10240', // Maks 10MB
        ]);

        $namaFile = null;
        if ($request->hasFile('urlFilePA')) {
            $file = $request->file('urlFilePA');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/panduan'), $namaFile);
        }

        PanduanAkademik::create([
            'judulPA'   => $request->judulPA,
            'urlFilePA' => $namaFile
        ]);

        return back()->with('success', 'Panduan Akademik berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $panduan = PanduanAkademik::findOrFail($id);

        $request->validate([
            'judulPA'   => 'required|string|max:255',
            'urlFilePA' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Maks 10MB
        ]);

        $dataUpdate = ['judulPA' => $request->judulPA];

        if ($request->hasFile('urlFilePA')) {
            // Hapus file lama jika ada
            if ($panduan->urlFilePA && File::exists(public_path('assets/admin/uploads/panduan/' . $panduan->urlFilePA))) {
                File::delete(public_path('assets/admin/uploads/panduan/' . $panduan->urlFilePA));
            }

            $file = $request->file('urlFilePA');
            $namaFileBaru = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/panduan'), $namaFileBaru);
            $dataUpdate['urlFilePA'] = $namaFileBaru;
        }

        $panduan->update($dataUpdate);

        return back()->with('success', 'Panduan Akademik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $panduan = PanduanAkademik::findOrFail($id);

        if ($panduan->urlFilePA && File::exists(public_path('assets/admin/uploads/panduan/' . $panduan->urlFilePA))) {
            File::delete(public_path('assets/admin/uploads/panduan/' . $panduan->urlFilePA));
        }

        $panduan->delete();

        return back()->with('success', 'Panduan Akademik berhasil dihapus.');
    }
}
