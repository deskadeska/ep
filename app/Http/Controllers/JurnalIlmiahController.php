<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalIlmiah;
use App\Models\TenagaPengajar;

class JurnalIlmiahController extends Controller
{
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');
        $filterTahun = $request->input('tahun');

        // Memuat relasi tenagaPengajar (Many-to-Many)
        $query = JurnalIlmiah::with('tenagaPengajar');

        // Pencarian berdasarkan judul atau keyword
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judulJI', 'like', '%' . $search . '%')
                  ->orWhere('keywordJI', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan tahun terbit
        if ($filterTahun) {
            $query->where('tahunPublikasiJI', $filterTahun);
        }

        // Mengambil daftar tahun unik untuk opsi filter di frontend
        $listTahun = JurnalIlmiah::select('tahunPublikasiJI')
                                 ->distinct()
                                 ->orderBy('tahunPublikasiJI', 'desc')
                                 ->pluck('tahunPublikasiJI');

        // Diurutkan dari yang terbaru dan paginate 10
        $jurnalIlmiah = $query->orderBy('tahunPublikasiJI', 'desc')
                              ->orderBy('judulJI', 'asc')
                              ->paginate(10);

        return view('frontend.akademik.jurnal_ilmiah', compact('jurnalIlmiah', 'listTahun', 'filterTahun'));
    }

    public function index(Request $request)
    {
        $query = JurnalIlmiah::with('tenagaPengajar');
        $search = $request->input('search');

        if ($search != '') {
            $query->where(function ($q) use ($search) {
                $q->where('judulJI', 'like', '%' . $search . '%')
                  ->orWhere('jurnalPenerbitJI', 'like', '%' . $search . '%')
                  ->orWhere('keywordJI', 'like', '%' . $search . '%')
                  ->orWhere('namaMahasiswaJI', 'like', '%' . $search . '%');
            });
        }

        $sortBy = $request->input('sort_by', 'tahunPublikasiJI');
        $sortOrder = $request->input('sort_order', 'desc');

        if (in_array($sortBy, ['judulJI', 'tahunPublikasiJI'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $jurnalIlmiah = $query->get();
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.akademik.jurnal_ilmiah', compact('jurnalIlmiah', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulJI'          => 'required|string|max:255',
            'jurnalPenerbitJI' => 'required|string|max:255',
            'tahunPublikasiJI' => 'required|integer|digits:4',
            'keywordJI'        => 'required|string|max:255',
            'doiJI'            => 'required|string|max:255|unique:tb_jurnal_ilmiah,doiJI',
            'abstrakJI'        => 'required|string',
            'idTP'             => 'nullable|array',
            'idTP.*'           => 'nullable|exists:tb_tenaga_pengajar,idTP',
            'rolePenulis'      => 'nullable|array', // Validasi array role
            'namaMahasiswaJI'  => 'nullable|array',
            'namaMahasiswaJI.*'=> 'nullable|string|max:255',
        ]);

        $mahasiswaList = array_filter($request->namaMahasiswaJI ?? []);
        $dosenList = array_filter($request->idTP ?? []);

        if (empty($mahasiswaList) && empty($dosenList)) {
            return back()->withErrors(['penulis' => 'Minimal salah satu penulis (Dosen atau Mahasiswa) wajib diisi.'])->withInput();
        }

        // Hapus 'idTP' dari create karena sudah dipindah ke tabel pivot
        $ji = JurnalIlmiah::create([
            'judulJI'          => $request->judulJI,
            'jurnalPenerbitJI' => $request->jurnalPenerbitJI,
            'tahunPublikasiJI' => $request->tahunPublikasiJI,
            'keywordJI'        => $request->keywordJI,
            'doiJI'            => $request->doiJI,
            'abstrakJI'        => $request->abstrakJI,
            'namaMahasiswaJI'  => !empty($mahasiswaList) ? json_encode(array_values($mahasiswaList)) : null,
        ]);

        // Simpan relasi Many-to-Many ke tabel pivot
        if (!empty($dosenList)) {
            $syncData = [];
            foreach ($request->idTP as $index => $idTP) {
                if ($idTP) {
                    $syncData[$idTP] = ['rolePenulis' => $request->rolePenulis[$index] ?? 'Penulis Anggota'];
                }
            }
            $ji->tenagaPengajar()->sync($syncData);
        }

        return back()->with('success', 'Data Jurnal Ilmiah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $ji = JurnalIlmiah::findOrFail($id);

        $request->validate([
            'judulJI'          => 'required|string|max:255',
            'jurnalPenerbitJI' => 'required|string|max:255',
            'tahunPublikasiJI' => 'required|integer|digits:4',
            'keywordJI'        => 'required|string|max:255',
            'doiJI'            => 'required|string|max:255|unique:tb_jurnal_ilmiah,doiJI,' . $id . ',idJI',
            'abstrakJI'        => 'required|string',
            'idTP'             => 'nullable|array',
            'idTP.*'           => 'nullable|exists:tb_tenaga_pengajar,idTP',
            'rolePenulis'      => 'nullable|array',
            'namaMahasiswaJI'  => 'nullable|array',
            'namaMahasiswaJI.*'=> 'nullable|string|max:255',
        ]);

        $mahasiswaList = array_filter($request->namaMahasiswaJI ?? []);
        $dosenList = array_filter($request->idTP ?? []);

        if (empty($mahasiswaList) && empty($dosenList)) {
            return back()->withErrors(['penulis' => 'Minimal salah satu penulis (Dosen atau Mahasiswa) wajib diisi.'])->withInput();
        }

        $ji->update([
            'judulJI'          => $request->judulJI,
            'jurnalPenerbitJI' => $request->jurnalPenerbitJI,
            'tahunPublikasiJI' => $request->tahunPublikasiJI,
            'keywordJI'        => $request->keywordJI,
            'doiJI'            => $request->doiJI,
            'abstrakJI'        => $request->abstrakJI,
            'namaMahasiswaJI'  => !empty($mahasiswaList) ? json_encode(array_values($mahasiswaList)) : null,
        ]);

        // Simpan pembaruan relasi Many-to-Many ke tabel pivot
        if (!empty($dosenList)) {
            $syncData = [];
            foreach ($request->idTP as $index => $idTP) {
                if ($idTP) {
                    $syncData[$idTP] = ['rolePenulis' => $request->rolePenulis[$index] ?? 'Penulis Anggota'];
                }
            }
            $ji->tenagaPengajar()->sync($syncData);
        } else {
            // Jika dosen dikosongkan secara keseluruhan saat edit
            $ji->tenagaPengajar()->sync([]);
        }

        return back()->with('success', 'Data Jurnal Ilmiah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ji = JurnalIlmiah::findOrFail($id);
        $ji->delete(); // Otomatis menghapus relasi di tabel pivot berkat cascadeOnDelete di database
        return back()->with('success', 'Data Jurnal Ilmiah berhasil dihapus.');
    }
}
