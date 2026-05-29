<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function frontendIndex()
    {
        // Mengambil data pertama dari database
        $so = StrukturOrganisasi::first();

        return view('frontend.kemahasiswaan.struktur_organisasi', compact('so'));
    }

    public function index()
    {
        // Ambil data pertama. Jika tabel kosong, buat instance memori kosong agar view tidak error.
        $so = StrukturOrganisasi::first() ?? new StrukturOrganisasi();

        return view('admin.kemahasiswaan.struktur_organisasi', compact('so'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'urlFotoSO'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Opsional, maks 2MB
            'deskripsiSO' => 'required|string',
        ]);

        // Cari data pertama, atau buat baru jika database masih benar-benar kosong
        $so = StrukturOrganisasi::find($id);

        if (!$so) {
            $so = new StrukturOrganisasi();
            $so->idSO = 1; // Mengunci ID pada angka 1
        }

        // Cek jika ada file gambar yang diunggah
        if ($request->hasFile('urlFotoSO')) {
            $file = $request->file('urlFotoSO');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/admin/uploads/struktur_organisasi');

            // Hapus file gambar lama dari public folder jika ada
            if ($so->urlFotoSO && file_exists(public_path($so->urlFotoSO))) {
                unlink(public_path($so->urlFotoSO));
            }

            // Pindahkan file baru ke path yang direquest
            $file->move($destinationPath, $fileName);

            // Simpan path relatif ke database agar mudah dipanggil oleh asset()
            $so->urlFotoSO = 'assets/admin/uploads/struktur_organisasi/' . $fileName;
        }

        // Perbarui deskripsi
        $so->deskripsiSO = $request->deskripsiSO;
        $so->save();

        return back()->with('success', 'Data Struktur Organisasi berhasil diperbarui.');
    }
}
