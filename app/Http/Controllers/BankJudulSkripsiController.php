<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankJudulSkripsi;
use App\Models\TenagaPengajar;

class BankJudulSkripsiController extends Controller
{
    public function frontendIndex(Request $request)
    {
        $search = $request->input('search');

        // 1. Ambil data untuk Tabel (Search + Pagination + Order By Tanggal)
        // Tambahkan with('dosenPembimbing2') agar bisa menampilkan data dosen 2 di tabel
        $bankJudul = BankJudulSkripsi::with(['dosenPembimbing', 'dosenPembimbing2'])
            ->when($search, function ($query) use ($search) {
                $query->where('namaMhsBJS', 'like', "%{$search}%")
                    ->orWhere('judulSkripsiBJS', 'like', "%{$search}%");
            })
            ->orderBy('tanggalSeminarBJS', 'desc')
            ->paginate(10)
            ->withQueryString();

        // 2. Ambil data untuk Grafik (Total Metodologi per TAHUN)
        $chartDataRaw = BankJudulSkripsi::selectRaw("
        YEAR(tanggalSeminarBJS) as tahun,
        metodologiPenelitianBJS as metodologi,
        count(*) as total
    ")
            ->whereNotNull('tanggalSeminarBJS')
            ->groupBy('tahun', 'metodologi')
            ->orderBy('tahun', 'asc')
            ->get();

        // Mengolah data
        $labels = $chartDataRaw->pluck('tahun')->unique()->values()->toArray();
        $methodologies = ['Kualitatif', 'Kuantitatif', 'Campuran'];
        $datasets = [];

        $colors = [
            'Kualitatif' => '#1E3A5F',
            'Kuantitatif' => '#F2A541',
            'Campuran' => '#2A6F97',
        ];

        foreach ($methodologies as $m) {
            $data = [];
            foreach ($labels as $l) {
                $item = $chartDataRaw->where('tahun', $l)->where('metodologi', $m)->first();
                $data[] = $item ? $item->total : 0;
            }
            $datasets[] = [
                'label' => $m,
                'data' => $data,
                'borderColor' => $colors[$m] ?? '#CBD5E1',
                'backgroundColor' => ($colors[$m] ?? '#CBD5E1') . '20',
                'fill' => true, // Diubah ke true agar lebih terlihat tren tahunannya
                'tension' => 0.4
            ];
        }
        return view('frontend.kemahasiswaan.bank_judul_skripsi', compact('bankJudul', 'labels', 'datasets', 'search'));
    }

    public function index(Request $request)
    {
        // 1. Ambil parameter dari request (dengan nilai default)
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'tanggalSeminarBJS');
        $sortOrder = $request->input('sort_order', 'desc');
        $perPage = $request->input('per_page', 10);

        // 2. Mulai Query dengan relasi dosen 1 dan dosen 2
        $query = BankJudulSkripsi::with(['dosen', 'dosen2']);

        // 3. Fitur Pencarian (Nama Mhs atau Judul Skripsi)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('namaMhsBJS', 'like', '%' . $search . '%')
                    ->orWhere('judulSkripsiBJS', 'like', '%' . $search . '%');
            });
        }

        // 4. Fitur Pengurutan
        if (in_array($sortBy, ['tanggalSeminarBJS', 'namaMhsBJS']) && in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // 5. Eksekusi Pagination (appends digunakan agar filter tidak hilang saat pindah halaman)
        $bankJudul = $query->paginate($perPage)->appends($request->all());

        // Ambil data dosen untuk dropdown form
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.kemahasiswaan.bank_judul_skripsi', compact('bankJudul', 'dosen', 'search', 'sortBy', 'sortOrder', 'perPage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaMhsBJS'              => 'required|string|max:255',
            'judulSkripsiBJS'         => 'required|string',
            'tanggalSeminarBJS'       => 'required|date',
            'metodologiPenelitianBJS' => 'required|in:Kualitatif,Kuantitatif,Campuran',
            'dosenPembimbingBJS'      => 'nullable|exists:tb_tenaga_pengajar,idTP',
            'dosenPembimbingBJS2'     => 'nullable|exists:tb_tenaga_pengajar,idTP'
        ]);

        BankJudulSkripsi::create($request->all());

        return back()->with('success', 'Data Bank Judul Skripsi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $bjs = BankJudulSkripsi::findOrFail($id);

        $request->validate([
            'namaMhsBJS'              => 'required|string|max:255',
            'judulSkripsiBJS'         => 'required|string',
            'tanggalSeminarBJS'       => 'required|date',
            'metodologiPenelitianBJS' => 'required|in:Kualitatif,Kuantitatif,Campuran',
            'dosenPembimbingBJS'      => 'nullable|exists:tb_tenaga_pengajar,idTP',
            'dosenPembimbingBJS2'     => 'nullable|exists:tb_tenaga_pengajar,idTP'
        ]);

        $bjs->update($request->all());

        return back()->with('success', 'Data Bank Judul Skripsi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bjs = BankJudulSkripsi::findOrFail($id);
        $bjs->delete();

        return back()->with('success', 'Data Bank Judul Skripsi berhasil dihapus.');
    }
}
