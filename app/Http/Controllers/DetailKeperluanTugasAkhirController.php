<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeperluanTugasAkhir;
use App\Models\DetailKeperluanTugasAkhir;
use Illuminate\Support\Facades\File;

class DetailKeperluanTugasAkhirController extends Controller
{
    // Method untuk memaksa unduhan file di frontend (mencegah format .htm)
    public function download($idDKTA)
    {
        $detail = \App\Models\DetailKeperluanTugasAkhir::findOrFail($idDKTA);

        if (!$detail->urlFile) {
            return back()->with('error', 'File tidak tersedia.');
        }

        $filePath = public_path('assets/admin/uploads/tugas_akhir/' . $detail->urlFile);

        if (file_exists($filePath)) {
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);

            // Format nama file agar rapi dan aman (Nama Persyaratan + ekstensi)
            $safeName = str_replace(['/', '\\'], '-', $detail->namaKTA);
            $downloadName = $safeName . '.' . $extension;

            return response()->download($filePath, $downloadName);
        }

        return back()->with('error', 'Mohon maaf, file fisik tidak ditemukan di server.');
    }
    public function index($idKTA)
    {
        $parent = KeperluanTugasAkhir::findOrFail($idKTA);
        $details = DetailKeperluanTugasAkhir::where('idKTA', $idKTA)->orderBy('idDKTA', 'desc')->get();

        return view('admin.akademik.detail_keperluan_tugas_akhir', compact('parent', 'details'));
    }

    public function store(Request $request, $idKTA)
    {
        $request->validate([
            'namaKTA' => 'required|string|max:255',
            'urlFile' => 'nullable|file|mimes:pdf,doc,docx,zip,xls,xlsx|max:10240', // Maks 10MB
        ]);

        $namaFile = null;
        if ($request->hasFile('urlFile')) {
            $file = $request->file('urlFile');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/tugas_akhir'), $namaFile);
        }

        DetailKeperluanTugasAkhir::create([
            'namaKTA' => $request->namaKTA,
            'urlFile' => $namaFile,
            'idKTA'   => $idKTA
        ]);

        return back()->with('success', 'Detail persyaratan berhasil ditambahkan.');
    }

    public function update(Request $request, $idDKTA)
    {
        $detail = DetailKeperluanTugasAkhir::findOrFail($idDKTA);

        $request->validate([
            'namaKTA' => 'required|string|max:255',
            'urlFile' => 'nullable|file|mimes:pdf,doc,docx,zip,xls,xlsx|max:10240',
        ]);

        $dataUpdate = ['namaKTA' => $request->namaKTA];

        if ($request->hasFile('urlFile')) {
            // Hapus file lama
            if ($detail->urlFile && File::exists(public_path('assets/admin/uploads/tugas_akhir/' . $detail->urlFile))) {
                File::delete(public_path('assets/admin/uploads/tugas_akhir/' . $detail->urlFile));
            }

            $file = $request->file('urlFile');
            $namaFileBaru = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/admin/uploads/tugas_akhir'), $namaFileBaru);
            $dataUpdate['urlFile'] = $namaFileBaru;
        }

        $detail->update($dataUpdate);

        return back()->with('success', 'Detail persyaratan berhasil diperbarui.');
    }

    public function destroy($idDKTA)
    {
        $detail = DetailKeperluanTugasAkhir::findOrFail($idDKTA);

        if ($detail->urlFile && File::exists(public_path('assets/admin/uploads/tugas_akhir/' . $detail->urlFile))) {
            File::delete(public_path('assets/admin/uploads/tugas_akhir/' . $detail->urlFile));
        }

        $detail->delete();

        return back()->with('success', 'Detail persyaratan berhasil dihapus.');
    }
}
