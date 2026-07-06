<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalIlmiah;
use Illuminate\Support\Facades\File;

class JurnalIlmiahController extends Controller
{
    public function frontendIndex()
    {
        // Mengambil semua data jurnal ilmiah
        $jurnalIlmiah = JurnalIlmiah::orderBy('idJI', 'desc')->get();

        return view('frontend.akademik.jurnal_ilmiah', compact('jurnalIlmiah'));
    }

    public function index()
    {
        $jurnalIlmiah = JurnalIlmiah::orderBy('idJI', 'desc')->get();
        return view('admin.akademik.jurnal_ilmiah', compact('jurnalIlmiah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaJI'   => 'required|string|max:255',
            'linkJI'   => 'required|url|max:255',
            'sampulJI' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        $sampulName = null;

        // Upload Sampul
        if ($request->hasFile('sampulJI')) {
            $fileSampul = $request->file('sampulJI');
            $sampulName = time() . '_sampul_' . uniqid() . '.' . $fileSampul->getClientOriginalExtension();

            $destinationPath = public_path('assets/admin/uploads/jurnal');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            $fileSampul->move($destinationPath, $sampulName);
        }

        JurnalIlmiah::create([
            'namaJI'   => $request->namaJI,
            'linkJI'   => $request->linkJI,
            'sampulJI' => $sampulName
        ]);

        return back()->with('success', 'Data Jurnal Ilmiah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $ji = JurnalIlmiah::findOrFail($id);

        $request->validate([
            'namaJI'   => 'required|string|max:255',
            'linkJI'   => 'required|url|max:255',
            'sampulJI' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        $dataUpdate = [
            'namaJI' => $request->namaJI,
            'linkJI' => $request->linkJI,
        ];

        // Update Sampul
        if ($request->hasFile('sampulJI')) {
            if ($ji->sampulJI && File::exists(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI))) {
                File::delete(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI));
            }

            $fileSampul = $request->file('sampulJI');
            $sampulNameBaru = time() . '_sampul_' . uniqid() . '.' . $fileSampul->getClientOriginalExtension();

            $destinationPath = public_path('assets/admin/uploads/jurnal');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            $fileSampul->move($destinationPath, $sampulNameBaru);

            $dataUpdate['sampulJI'] = $sampulNameBaru;
        }

        $ji->update($dataUpdate);

        return back()->with('success', 'Data Jurnal Ilmiah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ji = JurnalIlmiah::findOrFail($id);

        // Hapus file Sampul
        if ($ji->sampulJI && File::exists(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI))) {
            File::delete(public_path('assets/admin/uploads/jurnal/' . $ji->sampulJI));
        }

        $ji->delete();

        return back()->with('success', 'Data Jurnal Ilmiah berhasil dihapus.');
    }
}
