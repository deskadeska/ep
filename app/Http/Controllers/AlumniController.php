<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\File;

class AlumniController extends Controller
{
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');

        // 1. Ambil daftar tahun angkatan yang unik terlebih dahulu (diurutkan dari yang terbaru)
        $listAngkatan = Alumni::select('angkatanAlumni')
                              ->distinct()
                              ->orderBy('angkatanAlumni', 'desc')
                              ->pluck('angkatanAlumni');

        // 2. Default ke angkatan paling baru jika parameter 'angkatan' tidak ada di URL
        $filterAngkatan = $request->input('angkatan', $listAngkatan->first());

        $query = Alumni::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('namaAlumni', 'like', "%{$search}%")
                  ->orWhere('angkatanAlumni', 'like', "%{$search}%");
            });
        }

        // 3. Filter berdasarkan angkatan (sekarang otomatis memfilter angkatan terbaru sejak awal load)
        if ($filterAngkatan) {
            $query->where('angkatanAlumni', $filterAngkatan);
        }

        // Urutkan dari lulusan terbaru
        $alumni = $query->orderBy('tahunLulusAlumni', 'desc')->paginate(15);

        return view('frontend.kemahasiswaan.alumni', compact('alumni', 'listAngkatan', 'filterAngkatan'));
    }

    public function index()
    {
        $alumni = Alumni::orderBy('tahunLulusAlumni', 'desc')->get();
        return view('admin.kemahasiswaan.alumni', compact('alumni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaAlumni'       => 'required|string|max:255',
            'angkatanAlumni'   => 'required|digits:4|integer',
            'tahunLulusAlumni' => 'required|digits:4|integer',
            'pesanAlumni'      => 'nullable|string|max:255',
            'kesanAlumni'      => 'nullable|string|max:255',
            'urlFotoAlumni'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = null;
        if ($request->hasFile('urlFotoAlumni')) {
            $file = $request->file('urlFotoAlumni');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/alumni'), $namaFoto);
        }

        Alumni::create([
            'namaAlumni'       => $request->namaAlumni,
            'angkatanAlumni'   => $request->angkatanAlumni,
            'tahunLulusAlumni' => $request->tahunLulusAlumni,
            'pesanAlumni'      => $request->pesanAlumni,
            'kesanAlumni'      => $request->kesanAlumni,
            'urlFotoAlumni'    => $namaFoto
        ]);

        return back()->with('success', 'Data Alumni berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $request->validate([
            'namaAlumni'       => 'required|string|max:255',
            'angkatanAlumni'   => 'required|digits:4|integer',
            'tahunLulusAlumni' => 'required|digits:4|integer',
            'pesanAlumni'      => 'nullable|string|max:255',
            'kesanAlumni'      => 'nullable|string|max:255',
            'urlFotoAlumni'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'namaAlumni'       => $request->namaAlumni,
            'angkatanAlumni'   => $request->angkatanAlumni,
            'tahunLulusAlumni' => $request->tahunLulusAlumni,
            'pesanAlumni'      => $request->pesanAlumni,
            'kesanAlumni'      => $request->kesanAlumni,
        ];

        if ($request->hasFile('urlFotoAlumni')) {
            if ($alumni->urlFotoAlumni && File::exists(public_path('assets/admin/uploads/alumni/' . $alumni->urlFotoAlumni))) {
                File::delete(public_path('assets/admin/uploads/alumni/' . $alumni->urlFotoAlumni));
            }

            $file = $request->file('urlFotoAlumni');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/alumni'), $namaFotoBaru);
            $dataUpdate['urlFotoAlumni'] = $namaFotoBaru;
        }

        $alumni->update($dataUpdate);

        return back()->with('success', 'Data Alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        if ($alumni->urlFotoAlumni && File::exists(public_path('assets/admin/uploads/alumni/' . $alumni->urlFotoAlumni))) {
            File::delete(public_path('assets/admin/uploads/alumni/' . $alumni->urlFotoAlumni));
        }

        $alumni->delete();

        return back()->with('success', 'Data Alumni berhasil dihapus.');
    }
}
