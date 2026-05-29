<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistik;

class StatistikController extends Controller
{
    public function index()
    {
        // Ambil data pertama. Jika tabel masih kosong, buat instansiasi baru dengan nilai 0
        $statistik = Statistik::first() ?? new Statistik();
        return view('admin.kemahasiswaan.statistik', compact('statistik'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mahasiswa_aktif' => 'required|integer|min:0',
            'mahasiswa_baru'  => 'required|integer|min:0',
            'alumni'          => 'required|integer|min:0',
        ]);

        // Cek apakah data sudah ada. Jika ada, update. Jika belum, buat baru (firstOrCreate)
        $statistik = Statistik::first();

        if ($statistik) {
            $statistik->update($request->all());
        } else {
            Statistik::create($request->all());
        }

        return back()->with('success', 'Data statistik untuk halaman depan berhasil diperbarui!');
    }
}
