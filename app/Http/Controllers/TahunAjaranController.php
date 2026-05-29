<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        // Urutkan dari data terbaru
        $tahunAjaran = TahunAjaran::orderBy('idTA', 'desc')->get();
        return view('admin.akademik.tahun_ajaran', compact('tahunAjaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahunAkademikTA' => 'required|string|max:100|unique:tb_tahun_ajaran,tahunAkademikTA'
        ], [
            'tahunAkademikTA.unique' => 'Tahun Ajaran ini sudah terdaftar di sistem.'
        ]);

        TahunAjaran::create([
            'tahunAkademikTA' => $request->tahunAkademikTA
        ]);

        return back()->with('success', 'Data Tahun Ajaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $ta = TahunAjaran::findOrFail($id);

        $request->validate([
            'tahunAkademikTA' => 'required|string|max:100|unique:tb_tahun_ajaran,tahunAkademikTA,' . $id . ',idTA'
        ], [
            'tahunAkademikTA.unique' => 'Tahun Ajaran ini sudah terdaftar di sistem.'
        ]);

        $ta->update([
            'tahunAkademikTA' => $request->tahunAkademikTA
        ]);

        return back()->with('success', 'Data Tahun Ajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ta = TahunAjaran::findOrFail($id);
        $ta->delete();

        return back()->with('success', 'Data Tahun Ajaran berhasil dihapus.');
    }
}
