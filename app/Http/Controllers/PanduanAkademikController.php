<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanduanAkademik;
use Illuminate\Support\Facades\File;

class PanduanAkademikController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika belum ada buat instansi memori kosong
        $panduan = PanduanAkademik::first() ?? new PanduanAkademik();

        return view('admin.akademik.panduan_akademik', compact('panduan'));
    }

    public function update(Request $request, $id = 1)
    {
        // Cari data pertama, atau buat baru jika tabel benar-benar kosong
        $panduan = PanduanAkademik::first();
        if (!$panduan) {
            $panduan = new PanduanAkademik();
        }

        $request->validate([
            'judulPA'   => 'required|string|max:255',
            'urlFilePA' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Maks 10MB
        ]);

        $panduan->judulPA = $request->judulPA;

        if ($request->hasFile('urlFilePA')) {
            // Hapus file lama jika ada dan bukan nilai default
            if ($panduan->urlFilePA && File::exists(public_path('assets/admin/uploads/panduan/' . $panduan->urlFilePA))) {
                File::delete(public_path('assets/admin/uploads/panduan/' . $panduan->urlFilePA));
            }

            $file = $request->file('urlFilePA');
            $namaFileBaru = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/panduan'), $namaFileBaru);
            $panduan->urlFilePA = $namaFileBaru;
        }

        $panduan->save();

        return back()->with('success', 'Panduan Akademik berhasil diperbarui.');
    }
}
