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
        $filterDosen = $request->input('dosen');

        // Cari nilai semester paling kecil (default ke 1 jika data kosong)
        $minSemester = MataKuliah::min('semesterMK') ?? 1;
        // Jadikan semester terkecil sebagai nilai default jika request 'semester' kosong
        $activeSemester = $request->input('semester', $minSemester);

        // Gunakan relasi terbaru (tenagaPengajar)
        $query = MataKuliah::with(['tenagaPengajar']);

        // Pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kodeMK', 'like', '%' . $search . '%')
                    ->orWhere('namaMK', 'like', '%' . $search . '%');
            });
        }

        // Filter Semester selalu aktif (ke semester pilihan atau semester terkecil)
        $query->where('semesterMK', $activeSemester);

        // Filter Dosen dengan logika relasi Many-to-Many
        if ($filterDosen) {
            $query->whereHas('tenagaPengajar', function ($q) use ($filterDosen) {
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

        // Pastikan variabel $activeSemester dikirim ke View
        return view('frontend.akademik.mata_kuliah', compact('mataKuliah', 'listDosen', 'stats', 'activeSemester'));
    }

    public function index(Request $request)
    {
        $query = MataKuliah::with(['tenagaPengajar']);

        // AMBIL SEMESTER YANG TERSEDIA SAJA (Hapus semester kosong dari navigasi)
        $availableSemesters = MataKuliah::distinct()
            ->orderBy('semesterMK', 'asc')
            ->pluck('semesterMK');

        $search = $request->input('search');
        $activeSemester = $request->input('semester', $availableSemesters->first() ?? 1);

        if ($search != '') {
            // Pencarian Global (Mengabaikan filter semester saat mencari)
            $query->where(function ($q) use ($search) {
                $q->where('kodeMK', 'like', '%' . $search . '%')
                    ->orWhere('namaMK', 'like', '%' . $search . '%');
            });
        } else {
            // Filter semester hanya aktif jika TIDAK sedang mencari
            $query->where('semesterMK', $activeSemester);
        }

        $sortBy = $request->input('sort_by', 'sksMK');
        $sortOrder = $request->input('sort_order', 'asc');

        if (in_array($sortBy, ['kodeMK', 'sksMK'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $mataKuliah = $query->get();
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.akademik.mata_kuliah', compact('mataKuliah', 'dosen', 'activeSemester', 'availableSemesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeMK' => 'required|string|max:50|unique:tb_mata_kuliah,kodeMK',
            'namaMK' => 'required|string|max:255',
            'sksMK' => 'required|integer|min:1|max:6',
            'semesterMK' => 'required|integer|min:1|max:8',
            // VALIDASI DOSEN: Wajib ada (min:1)
            'idTP' => 'required|array|min:1',
            'idTP.*' => 'required|exists:tb_tenaga_pengajar,idTP',
            'rolePMK' => 'required|array|min:1',
        ], [
            'idTP.required' => 'Mata kuliah wajib memiliki minimal satu dosen pengampu.',
            'idTP.*.required' => 'Pilih nama dosen pada baris yang tersedia.'
        ]);

        $mk = MataKuliah::create($request->only('kodeMK', 'namaMK', 'sksMK', 'semesterMK'));

        $syncData = [];
        foreach ($request->idTP as $index => $idTP) {
            if ($idTP) {
                $syncData[$idTP] = ['rolePMK' => $request->rolePMK[$index] ?? 'Pengampu'];
            }
        }
        $mk->tenagaPengajar()->sync($syncData);

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
            // VALIDASI DOSEN: Jangan biarkan kosong saat edit
            'idTP' => 'required|array|min:1',
            'idTP.*' => 'required|exists:tb_tenaga_pengajar,idTP',
            'rolePMK' => 'required|array|min:1',
        ], [
            'idTP.required' => 'Dosen pengampu tidak boleh dikosongkan.',
            'idTP.*.required' => 'Pilih nama dosen atau hapus baris yang tidak digunakan.'
        ]);

        $mk->update($request->only('kodeMK', 'namaMK', 'sksMK', 'semesterMK'));

        $syncData = [];
        foreach ($request->idTP as $index => $idTP) {
            if ($idTP) {
                $syncData[$idTP] = ['rolePMK' => $request->rolePMK[$index] ?? 'Pengampu'];
            }
        }
        $mk->tenagaPengajar()->sync($syncData);

        return back()->with('success', 'Data Mata Kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->delete();
        return back()->with('success', 'Data Mata Kuliah berhasil dihapus.');
    }
}
