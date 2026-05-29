<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenagaPengajar;
use Illuminate\Support\Facades\File;

class TenagaPengajarController extends Controller
{
    public function frontendIndex()
    {
        // Mengurutkan berdasarkan urutan kustom, lalu fallback ke idTP Ascending
        $pengajar = TenagaPengajar::orderBy('urutan', 'asc')->orderBy('idTP', 'asc')->get()->groupBy('tipeTP');
        return view('frontend.informasi_penting.tenaga_pengajar', compact('pengajar'));
    }

    public function index()
    {
        // Urutkan berdasarkan kolom 'urutan' ASC, lalu 'idTP' ASC sebagai default/fallback
        $pengajar = TenagaPengajar::orderBy('urutan', 'asc')->orderBy('idTP', 'asc')->get();
        return view('admin.informasi_penting.tenaga_pengajar', compact('pengajar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nipTP'               => 'nullable|string|unique:tb_tenaga_pengajar,nipTP',
            'nuptkTP'             => 'nullable|string|unique:tb_tenaga_pengajar,nuptkTP',
            'namaTP'              => 'required|string|max:255',
            'kodeDosenTP'         => 'nullable|string|unique:tb_tenaga_pengajar,kodeDosenTP',
            'pendidikanTP'        => 'nullable|string|max:255',
            'pangkatTP'           => 'nullable|string|max:255',
            'golonganTP'          => 'nullable|string|max:255',
            'jabatanFungsionalTP' => 'nullable|string|max:255',
            'tipeTP'              => 'required|in:Dosen Tetap,Dosen Luar Biasa',
            'urlFotoTP'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = null;
        if ($request->hasFile('urlFotoTP')) {
            $file = $request->file('urlFotoTP');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/tenaga_pengajar'), $namaFoto);
        }

        TenagaPengajar::create([
            'nipTP'               => $request->nipTP,
            'nuptkTP'             => $request->nuptkTP,
            'namaTP'              => $request->namaTP,
            'kodeDosenTP'         => $request->kodeDosenTP,
            'pendidikanTP'        => $request->pendidikanTP,
            'pangkatTP'           => $request->pangkatTP,
            'golonganTP'          => $request->golonganTP,
            'jabatanFungsionalTP' => $request->jabatanFungsionalTP,
            'tipeTP'              => $request->tipeTP,
            'urlFotoTP'           => $namaFoto
        ]);

        return back()->with('success', 'Data Tenaga Pengajar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pengajar = TenagaPengajar::findOrFail($id);

        $request->validate([
            'nipTP'               => 'nullable|string|unique:tb_tenaga_pengajar,nipTP,' . $id . ',idTP',
            'nuptkTP'             => 'nullable|string|unique:tb_tenaga_pengajar,nuptkTP,' . $id . ',idTP',
            'namaTP'              => 'required|string|max:255',
            'kodeDosenTP'         => 'nullable|string|unique:tb_tenaga_pengajar,kodeDosenTP,' . $id . ',idTP',
            'pendidikanTP'        => 'nullable|string|max:255',
            'pangkatTP'           => 'nullable|string|max:255',
            'golonganTP'          => 'nullable|string|max:255',
            'jabatanFungsionalTP' => 'nullable|string|max:255',
            'tipeTP'              => 'required|in:Dosen Tetap,Dosen Luar Biasa',
            'urlFotoTP'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'nipTP'               => $request->nipTP,
            'nuptkTP'             => $request->nuptkTP,
            'namaTP'              => $request->namaTP,
            'kodeDosenTP'         => $request->kodeDosenTP,
            'pendidikanTP'        => $request->pendidikanTP,
            'pangkatTP'           => $request->pangkatTP,
            'golonganTP'          => $request->golonganTP,
            'jabatanFungsionalTP' => $request->jabatanFungsionalTP,
            'tipeTP'              => $request->tipeTP,
        ];

        if ($request->hasFile('urlFotoTP')) {
            if ($pengajar->urlFotoTP && File::exists(public_path('assets/admin/uploads/tenaga_pengajar/' . $pengajar->urlFotoTP))) {
                File::delete(public_path('assets/admin/uploads/tenaga_pengajar/' . $pengajar->urlFotoTP));
            }

            $file = $request->file('urlFotoTP');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/tenaga_pengajar'), $namaFotoBaru);
            $dataUpdate['urlFotoTP'] = $namaFotoBaru;
        }

        $pengajar->update($dataUpdate);

        return back()->with('success', 'Data Tenaga Pengajar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajar = TenagaPengajar::findOrFail($id);

        if ($pengajar->urlFotoTP && File::exists(public_path('assets/admin/uploads/tenaga_pengajar/' . $pengajar->urlFotoTP))) {
            File::delete(public_path('assets/admin/uploads/tenaga_pengajar/' . $pengajar->urlFotoTP));
        }

        $pengajar->delete();

        return back()->with('success', 'Data Tenaga Pengajar berhasil dihapus.');
    }

    // METHOD BARU: Menyimpan Urutan Kustom (Ajax)
    public function updateUrutan(Request $request)
    {
        $urutanData = $request->input('urutan');

        if($urutanData && is_array($urutanData)) {
            foreach ($urutanData as $index => $id) {
                TenagaPengajar::where('idTP', $id)->update(['urutan' => $index + 1]);
            }
            return response()->json(['success' => true, 'message' => 'Urutan berhasil disimpan!']);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menyimpan urutan.']);
    }

    // METHOD BARU: Mereset Urutan ke Default (ID)
    public function resetUrutan()
    {
        // Mengubah semua nilai urutan menjadi 0 agar kembali terurut berdasarkan idTP ASC
        TenagaPengajar::query()->update(['urutan' => 0]);
        return back()->with('success', 'Urutan berhasil dikembalikan ke default (berdasarkan ID awal).');
    }
}
