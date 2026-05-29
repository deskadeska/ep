<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\File;

class DokumentasiController extends Controller
{
    public function frontendIndex()
    {
        // Hanya menampilkan dokumentasi yang sudah di-publish
        $dokumentasi = Dokumentasi::where('statusDokumentasi', 'Published')
                                  ->orderBy('tanggalDokumentasi', 'desc')
                                  ->get();

        return view('frontend.seputar_prodi.dokumentasi', compact('dokumentasi'));
    }

    public function index()
    {
        $dokumentasi = Dokumentasi::orderBy('tanggalDokumentasi', 'desc')->get();
        return view('admin.seputar_prodi.dokumentasi', compact('dokumentasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulDokumentasi'   => 'required|string|max:255',
            'statusDokumentasi'  => 'required|in:Published,Draft',
            'tanggalDokumentasi' => 'required|date',
            'urlFotoDokumentasi' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $namaFoto = null;
        if ($request->hasFile('urlFotoDokumentasi')) {
            $file = $request->file('urlFotoDokumentasi');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/dokumentasi'), $namaFoto);
        }

        Dokumentasi::create([
            'judulDokumentasi'   => $request->judulDokumentasi,
            'statusDokumentasi'  => $request->statusDokumentasi,
            'tanggalDokumentasi' => $request->tanggalDokumentasi,
            'urlFotoDokumentasi' => $namaFoto
        ]);

        return back()->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $data = Dokumentasi::findOrFail($id);

        $request->validate([
            'judulDokumentasi'   => 'required|string|max:255',
            'statusDokumentasi'  => 'required|in:Published,Draft',
            'tanggalDokumentasi' => 'required|date',
            'urlFotoDokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $updateData = [
            'judulDokumentasi'   => $request->judulDokumentasi,
            'statusDokumentasi'  => $request->statusDokumentasi,
            'tanggalDokumentasi' => $request->tanggalDokumentasi,
        ];

        if ($request->hasFile('urlFotoDokumentasi')) {
            // Hapus foto lama
            if ($data->urlFotoDokumentasi && File::exists(public_path('assets/admin/uploads/dokumentasi/' . $data->urlFotoDokumentasi))) {
                File::delete(public_path('assets/admin/uploads/dokumentasi/' . $data->urlFotoDokumentasi));
            }

            $file = $request->file('urlFotoDokumentasi');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/dokumentasi'), $namaFotoBaru);
            $updateData['urlFotoDokumentasi'] = $namaFotoBaru;
        }

        $data->update($updateData);

        return back()->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Dokumentasi::findOrFail($id);

        if ($data->urlFotoDokumentasi && File::exists(public_path('assets/admin/uploads/dokumentasi/' . $data->urlFotoDokumentasi))) {
            File::delete(public_path('assets/admin/uploads/dokumentasi/' . $data->urlFotoDokumentasi));
        }

        $data->delete();

        return back()->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
