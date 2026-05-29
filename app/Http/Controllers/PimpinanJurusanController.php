<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PimpinanJurusan;
use App\Models\TenagaPengajar;

class PimpinanJurusanController extends Controller
{
    public function frontendPimpinan()
{
    // Mengambil data pimpinan beserta relasinya, diurutkan periode terbaru ke terlama
    $pimpinan = PimpinanJurusan::with(['ketua', 'sekretaris'])
                                           ->orderBy('tahunMulaiPJ', 'desc')
                                           ->get();

    return view('frontend.informasi_penting.pimpinan_jurusan', compact('pimpinan'));
}
    public function index()
    {
        // Ambil data pimpinan beserta relasi ketua dan sekretaris, urutkan dari periode terbaru
        $pimpinan = PimpinanJurusan::with(['ketua', 'sekretaris'])
                                   ->orderBy('tahunSelesaiPJ', 'desc')
                                   ->get();

        // Ambil daftar tenaga pengajar untuk dropdown form
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.informasi_penting.pimpinan_jurusan', compact('pimpinan', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahunMulaiPJ'   => 'required|integer|digits:4',
            'tahunSelesaiPJ' => 'required|integer|digits:4|gte:tahunMulaiPJ',
            'idKetuaPJ'      => 'required|exists:tb_tenaga_pengajar,idTP',
            'idSekretarisPJ' => 'required|exists:tb_tenaga_pengajar,idTP|different:idKetuaPJ',
        ]);

        PimpinanJurusan::create($request->all());
        return back()->with('success', 'Data pimpinan jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pj = PimpinanJurusan::findOrFail($id);

        $request->validate([
            'tahunMulaiPJ'   => 'required|integer|digits:4',
            'tahunSelesaiPJ' => 'required|integer|digits:4|gte:tahunMulaiPJ',
            'idKetuaPJ'      => 'required|exists:tb_tenaga_pengajar,idTP',
            'idSekretarisPJ' => 'required|exists:tb_tenaga_pengajar,idTP|different:idKetuaPJ',
        ]);

        $pj->update($request->all());
        return back()->with('success', 'Data pimpinan jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PimpinanJurusan::findOrFail($id)->delete();
        return back()->with('success', 'Data pimpinan jurusan berhasil dihapus.');
    }
}
