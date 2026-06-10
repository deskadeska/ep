<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianDosen;
use App\Models\TenagaPengajar;
use Illuminate\Support\Facades\File;

class CapaianDosenController extends Controller
{
    // Fungsi untuk Pengunjung (Frontend)
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');
        $filterTingkat = $request->input('tingkat');

        $query = CapaianDosen::with('tenagaPengajar');

        if ($search) {
            $query->where('judulCD', 'like', '%' . $search . '%')
                  ->orWhereHas('tenagaPengajar', function($q) use ($search) {
                      $q->where('namaTP', 'like', '%' . $search . '%');
                  });
        }

        if ($filterTingkat) {
            $query->where('tingkatCD', $filterTingkat);
        }

        $capaianDosen = $query->orderBy('tahunCD', 'desc')
                              ->orderBy('idCD', 'desc')
                              ->paginate(12);

        return view('frontend.seputar_prodi.capaian_dosen', compact('capaianDosen', 'filterTingkat'));
    }

    // Fungsi untuk Admin (Backend)
    public function index(Request $request)
    {
        $query = CapaianDosen::with('tenagaPengajar');
        $search = $request->input('search');

        if ($search) {
            $query->where('judulCD', 'like', '%' . $search . '%')
                  ->orWhereHas('tenagaPengajar', function($q) use ($search) {
                      $q->where('namaTP', 'like', '%' . $search . '%');
                  });
        }

        $sortBy = $request->input('sort_by', 'tahunCD');
        $sortOrder = $request->input('sort_order', 'desc');

        if (in_array($sortBy, ['judulCD', 'tahunCD', 'tingkatCD'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $capaianDosen = $query->get();
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.seputar_prodi.capaian_dosen', compact('capaianDosen', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idTP'             => 'required|exists:tb_tenaga_pengajar,idTP',
            'judulCD'          => 'required|string|max:255',
            'tingkatCD'        => 'required|in:Lokal,Nasional,Internasional',
            'tahunCD'          => 'required|integer|digits:4',
            'deskripsiCD'      => 'nullable|string',
            'fileSertifikatCD' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // Maks 5MB
        ]);

        $namaFile = null;
        if ($request->hasFile('fileSertifikatCD')) {
            $file = $request->file('fileSertifikatCD');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/admin/uploads/capaian_dosen'), $namaFile);
        }

        CapaianDosen::create([
            'idTP'             => $request->idTP,
            'judulCD'          => $request->judulCD,
            'tingkatCD'        => $request->tingkatCD,
            'tahunCD'          => $request->tahunCD,
            'deskripsiCD'      => $request->deskripsiCD,
            'fileSertifikatCD' => $namaFile,
        ]);

        return back()->with('success', 'Data Capaian Dosen berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $capaian = CapaianDosen::findOrFail($id);

        $request->validate([
            'idTP'             => 'required|exists:tb_tenaga_pengajar,idTP',
            'judulCD'          => 'required|string|max:255',
            'tingkatCD'        => 'required|in:Lokal,Nasional,Internasional',
            'tahunCD'          => 'required|integer|digits:4',
            'deskripsiCD'      => 'nullable|string',
            'fileSertifikatCD' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $dataUpdate = $request->only(['idTP', 'judulCD', 'tingkatCD', 'tahunCD', 'deskripsiCD']);

        if ($request->hasFile('fileSertifikatCD')) {
            // Hapus file lama jika ada
            if ($capaian->fileSertifikatCD && File::exists(public_path('assets/admin/uploads/capaian_dosen/' . $capaian->fileSertifikatCD))) {
                File::delete(public_path('assets/admin/uploads/capaian_dosen/' . $capaian->fileSertifikatCD));
            }

            $file = $request->file('fileSertifikatCD');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/admin/uploads/capaian_dosen'), $namaFile);

            $dataUpdate['fileSertifikatCD'] = $namaFile;
        }

        $capaian->update($dataUpdate);

        return back()->with('success', 'Data Capaian Dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $capaian = CapaianDosen::findOrFail($id);

        // Hapus file fisik saat data dihapus
        if ($capaian->fileSertifikatCD && File::exists(public_path('assets/admin/uploads/capaian_dosen/' . $capaian->fileSertifikatCD))) {
            File::delete(public_path('assets/admin/uploads/capaian_dosen/' . $capaian->fileSertifikatCD));
        }

        $capaian->delete();

        return back()->with('success', 'Data Capaian Dosen berhasil dihapus.');
    }
}
