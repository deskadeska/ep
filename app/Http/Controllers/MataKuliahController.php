<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\TenagaPengajar;

class MataKuliahController extends Controller
{
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');
        $filterSemester = $request->input('semester');
        $filterDosen = $request->input('dosen');

        // Gunakan relasi terbaru (tenagaPengajar)
        $query = MataKuliah::with(['tenagaPengajar']);

        // Pencarian
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kodeMK', 'like', '%' . $search . '%')
                  ->orWhere('namaMK', 'like', '%' . $search . '%');
            });
        }

        // Filter Semester
        if ($filterSemester) {
            $query->where('semesterMK', $filterSemester);
        }

        // Filter Dosen dengan logika relasi Many-to-Many
        if ($filterDosen) {
            $query->whereHas('tenagaPengajar', function($q) use ($filterDosen) {
                $q->where('tb_tenaga_pengajar.idTP', $filterDosen);
            });
        }

        $mataKuliah = $query->orderBy('semesterMK', 'asc')
                            ->orderBy('namaMK', 'asc')
                            ->get();

        $listDosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        $stats = [
            'total_mk' => MataKuliah::count(),
            'total_sks' => MataKuliah::sum('sksMK'),
            'total_semester' => MataKuliah::max('semesterMK') ?? 8,
        ];

        return view('frontend.akademik.mata_kuliah', compact('mataKuliah', 'listDosen', 'stats'));
    }

    public function index(Request $request)
    {
        $query = MataKuliah::with(['tenagaPengajar']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kodeMK', 'like', '%' . $search . '%')
                  ->orWhere('namaMK', 'like', '%' . $search . '%');
            });
        }

        // Default ke Semester 1, wajib angka.
        $activeSemester = $request->input('semester', '1');
        $query->where('semesterMK', $activeSemester);

        // HANYA ADA 2 OPSI URUTKAN: Bobot SKS dan Kode MK
        $sortBy = $request->input('sort_by', 'sksMK');
        $sortOrder = $request->input('sort_order', 'asc');

        if (in_array($sortBy, ['kodeMK', 'sksMK']) && in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('sksMK', 'asc'); // DEFAULT SKS Naik (1, 2, 3...)
        }

        $mataKuliah = $query->get();
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.akademik.mata_kuliah', compact('mataKuliah', 'dosen', 'activeSemester'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeMK' => 'required|string|max:50|unique:tb_mata_kuliah,kodeMK',
            'namaMK' => 'required|string|max:255',
            'sksMK' => 'required|integer|min:1|max:6',
            'semesterMK' => 'required|integer|min:1|max:8',
            'idTP' => 'nullable|array',
            'idTP.*' => 'exists:tb_tenaga_pengajar,idTP',
            'rolePMK' => 'nullable|array',
        ]);

        // Simpan Data Mata Kuliah
        $mk = MataKuliah::create($request->only('kodeMK', 'namaMK', 'sksMK', 'semesterMK'));

        // Sinkronisasi data ke pivot table
        if ($request->has('idTP')) {
            $syncData = [];
            foreach ($request->idTP as $index => $idTP) {
                if ($idTP) {
                    $role = $request->rolePMK[$index] ?? 'Pengampu';
                    $syncData[$idTP] = ['rolePMK' => $role];
                }
            }
            // attach/sync akan memotong duplikasi idTP berdasarkan proteksi array key
            $mk->tenagaPengajar()->sync($syncData);
        }

        return back()->with('success', 'Data Mata Kuliah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $mk = MataKuliah::findOrFail($id);

        $request->validate([
            'kodeMK' => 'required|string|max:50|unique:tb_mata_kuliah,kodeMK,' . $id . ',idMK',
            'namaMK' => 'required|string|max:255',
            'sksMK' => 'required|integer|min:1|max:6',
            'semesterMK' => 'required|integer|min:1|max:8',
            'idTP' => 'nullable|array',
            'idTP.*' => 'exists:tb_tenaga_pengajar,idTP',
            'rolePMK' => 'nullable|array',
        ]);

        // Update data dasar
        $mk->update($request->only('kodeMK', 'namaMK', 'sksMK', 'semesterMK'));

        // Sinkronisasi relasi Dosen Pengampu & Role
        if ($request->has('idTP')) {
            $syncData = [];
            foreach ($request->idTP as $index => $idTP) {
                if ($idTP) {
                    $role = $request->rolePMK[$index] ?? 'Pengampu';
                    $syncData[$idTP] = ['rolePMK' => $role];
                }
            }
            $mk->tenagaPengajar()->sync($syncData);
        } else {
            // Jika form dikosongkan secara penuh, hapus semua pengampu
            $mk->tenagaPengajar()->sync([]);
        }

        return back()->with('success', 'Data Mata Kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->delete(); // Karena menggunakan cascadeOnDelete di database, relasi pivot akan otomatis terhapus

        return back()->with('success', 'Data Mata Kuliah berhasil dihapus.');
    }
}
