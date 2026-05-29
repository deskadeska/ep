<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function frontendIndex()
    {
        // 1. Ambil berita berstatus Highlight
        $highlights = Berita::where('statusBerita', 'Highlight')
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Ambil semua berita berstatus Published
        $published = Berita::where('statusBerita', 'Published')
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Ambil daftar Kategori unik dari berita yang Published
        $categories = Berita::where('statusBerita', 'Published')
            ->select('kategoriBerita')
            ->distinct()
            ->whereNotNull('kategoriBerita')
            ->where('kategoriBerita', '!=', '')
            ->pluck('kategoriBerita');

        return view('frontend.seputar_prodi.berita', compact('highlights', 'published', 'categories'));
    }

    public function bacaBerita($id)
    {
        // Ambil berita utama
        $berita = Berita::findOrFail($id);

        // Ambil 4 berita terkait dengan kategori yang sama, kecuali berita yang sedang dibaca
        $beritaTerkait = Berita::where('kategoriBerita', $berita->kategoriBerita)
            ->where('idBerita', '!=', $id)
            ->where('statusBerita', 'Published')
            ->limit(4)
            ->get();

        return view('frontend.seputar_prodi.baca_berita', compact('berita', 'beritaTerkait'));
    }

    public function index(Request $request)
    {
        // Ambil parameter dari form
        $search = $request->input('search');
        $sortOrder = $request->input('sort_order', 'desc'); // Default: desc (terbaru)

        // Mulai Query
        $query = Berita::query();

        // Fitur Pencarian berdasarkan Judul Berita
        if (!empty($search)) {
            $query->where('judulBerita', 'like', '%' . $search . '%');
        }

        // Fitur Pengurutan berdasarkan created_at
        if (in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy('created_at', $sortOrder);
        }

        // Ambil data (gunakan get(), atau ganti dengan paginate(10) jika ingin pagination)
        $berita = $query->get();

        return view('admin.seputar_prodi.berita', compact('berita', 'search', 'sortOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulBerita'     => 'required|string|max:255',
            'kategoriBerita'  => 'required|string|max:255',
            'statusBerita'    => 'required|in:Highlight,Published,Draft',
            'deskripsiBerita' => 'required|string',
            'fotoBerita'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' // Maks 2MB
        ]);

        $namaFoto = null;
        if ($request->hasFile('fotoBerita')) {
            $file = $request->file('fotoBerita');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/berita'), $namaFoto);
        }

        Berita::create([
            'judulBerita'     => $request->judulBerita,
            'kategoriBerita'  => $request->kategoriBerita,
            'statusBerita'    => $request->statusBerita,
            'deskripsiBerita' => $request->deskripsiBerita,
            'fotoBerita'      => $namaFoto
        ]);

        return back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judulBerita'     => 'required|string|max:255',
            'kategoriBerita'  => 'required|string|max:255',
            'statusBerita'    => 'required|in:Highlight,Published,Draft',
            'deskripsiBerita' => 'required|string',
            'fotoBerita'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $dataUpdate = [
            'judulBerita'     => $request->judulBerita,
            'kategoriBerita'  => $request->kategoriBerita,
            'statusBerita'    => $request->statusBerita,
            'deskripsiBerita' => $request->deskripsiBerita,
        ];

        // Jika ada unggahan gambar baru
        if ($request->hasFile('fotoBerita')) {
            // Hapus gambar lama jika bukan default/kosong
            if ($berita->fotoBerita && File::exists(public_path('assets/admin/uploads/berita/' . $berita->fotoBerita))) {
                File::delete(public_path('assets/admin/uploads/berita/' . $berita->fotoBerita));
            }

            $file = $request->file('fotoBerita');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/berita'), $namaFotoBaru);
            $dataUpdate['fotoBerita'] = $namaFotoBaru;
        }

        $berita->update($dataUpdate);

        return back()->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus fisik gambar dari folder
        if ($berita->fotoBerita && File::exists(public_path('assets/admin/uploads/berita/' . $berita->fotoBerita))) {
            File::delete(public_path('assets/admin/uploads/berita/' . $berita->fotoBerita));
        }

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
