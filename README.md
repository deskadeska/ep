Palet Warna Utama
* Primary (#1E3A5F)
* Secondary (#2A6F97)
* Accent (#F2A541)
* Soft Background (#E8F1F8)
* Dark Neutral (#2F2F2F)
* Medium Neutral (#6B7280)
* Light Neutral (#F4F6F9)
Navigasi
* Navbar Background (#1E3A5F)
* Menu Text (#E8F1F8)
* Menu Hover (#F2A541)
* Active Menu (#FFD166)
Sub-Navigasi / Dropdown
* Background (#F4F6F9)
* Text (#2F2F2F)
* Hover (#E8F1F8)
* Border (#D1D5DB)
Headline & Teks
* Headline Utama (#1E3A5F)
* Subheadline (#2A6F97)
* Body Text (#2F2F2F)
* Caption / Secondary Text (#6B7280)
* Link (#2A6F97)
* Link Hover (#F2A541)
Tombol (Button)
Primary Button
* Background (#F2A541)
* Hover (#D4882E)
* Text (#2F2F2F)
Secondary Button
* Background (#2A6F97)
* Hover (#1E4F6F)
* Text (#E8F1F8)
Disabled Button
* Background (#C7CDD6)
* Text (#6B7280)
Icon
* Default (#2A6F97)
* Active (#F2A541)
* Icon Background (#E8F1F8)
Background Section
* Hero Section (#E8F1F8)
* Content Section (#F4F6F9)
* Card Background (#FFFFFF)
* Card Border (#D1D5DB)
Footer
* Footer Background (#1A2C44)
* Footer Text (#E8F1F8)
* Footer Link (#F2A541)
* Footer Link Hover (#FFD166)
* Footer Divider (#2F4A6B)
Status & Alert
* Success (#2E8B57)
* Warning (#F2A541)
* Info (#2A6F97)
* Danger (#D64545)


Buat desain halaman mata kuliah untuk website jurusan Ekonomi Pembangunan dengan gaya modern academic UI. Atur route, ubah controller, dan pisahkan javascript jika ada.

Halaman harus memiliki:
- Hero section modern
- Statistik mata kuliah
- Pencarian berdasarkan kode mata kuliah dan nama mata kuliah
- Filter semester
- Grid card mata kuliah
- Detail mata kuliah

Setiap card mata kuliah menampilkan:
- Kode mata kuliah
- Nama mata kuliah
- Semester
- SKS
- Dosen pengampu

path: views\frontend\akademik\mata_kuliah.blade.php
controller sebelumnya (untuk admin):
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\TenagaPengajar;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = MataKuliah::with(['dosen1', 'dosen2']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kodeMK', 'like', '%' . $search . '%')
                  ->orWhere('namaMK', 'like', '%' . $search . '%');
            });
        }

        $sortBy = $request->input('sort_by', 'semesterMK');
        $sortOrder = $request->input('sort_order', 'asc');

        if (in_array($sortBy, ['kodeMK', 'semesterMK']) && in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('semesterMK', 'asc');
        }

        $mataKuliah = $query->get();
        $dosen = TenagaPengajar::orderBy('namaTP', 'asc')->get();

        return view('admin.akademik.mata_kuliah', compact('mataKuliah', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeMK' => 'required|string|max:50|unique:tb_mata_kuliah,kodeMK',
            'namaMK' => 'required|string|max:255',
            'sksMK' => 'required|integer|min:1|max:6',
            'semesterMK' => 'required|integer|min:1|max:8',
            // UBAH VALIDASI: Cek eksistensi ke idTP
            'idTP_1' => 'nullable|exists:tb_tenaga_pengajar,idTP',
            'idTP_2' => 'nullable|exists:tb_tenaga_pengajar,idTP|different:idTP_1',
        ]);

        MataKuliah::create($request->all());

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
            // UBAH VALIDASI: Cek eksistensi ke idTP
            'idTP_1' => 'nullable|exists:tb_tenaga_pengajar,idTP',
            'idTP_2' => 'nullable|exists:tb_tenaga_pengajar,idTP|different:idTP_1',
        ]);

        $mk->update([
            'kodeMK' => $request->kodeMK,
            'namaMK' => $request->namaMK,
            'sksMK' => $request->sksMK,
            'semesterMK' => $request->semesterMK,
            // UBAH ASSIGNMENT:
            'idTP_1' => $request->idTP_1,
            'idTP_2' => $request->idTP_2,
        ]);

        return back()->with('success', 'Data Mata Kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->delete();

        return back()->with('success', 'Data Mata Kuliah berhasil dihapus.');
    }
}

schema:
        Schema::create('tb_mata_kuliah', function (Blueprint $table) {
            // 1. Kolom Data Utama
            $table->id('idMK');
            $table->string('kodeMK')->nullable()->unique();
            $table->string('namaMK')->nullable();
            $table->integer('sksMK')->nullable();
            $table->integer('semesterMK')->nullable();

            // 2. Kolom Relasi & Foreign Key
            $table->foreignId('idTP_1')
                ->nullable()
                ->constrained('tb_tenaga_pengajar', 'idTP')
                ->nullOnDelete();

            $table->foreignId('idTP_2')
                ->nullable()
                ->constrained('tb_tenaga_pengajar', 'idTP')
                ->nullOnDelete();
        });
Buat desain halaman mata kuliah untuk website jurusan Ekonomi Pembangunan dengan gaya modern academic UI. Atur route, ubah controller, dan pisahkan javascript jika ada.

Halaman harus memiliki:
- Hero section modern
- Statistik mata kuliah
- Pencarian berdasarkan kode mata kuliah dan nama mata kuliah
- Filter semester
- Grid card mata kuliah
- Detail mata kuliah

Setiap card mata kuliah menampilkan:
- Kode mata kuliah
- Nama mata kuliah
- Semester
- SKS
- Dosen pengampu




Buatlah desain seperti berikut menggunakan laravel dan tailwind, saya ingin ada animasi kedatangan saat digulir (scroll animation) agar website terlihat lebih interaktif, letakkan kode dalam folder nama_proyek/resources/views/index.blade.php, buatlah navbar dalam tag nav dan bagian lainnya dalam tag section. pastikan website responsif saat ditampilkan di perangkat seluler. Dalam mode perangkat seluler, buatlah statistik dengan susunan 2x2 dengan rasio 1:1.  Letakkan navbar dan footer dalam folder views/layout. Kunci posisi navbar, berikut adalah menu dan sub-menu untuk ditampilkan di navbar dengan dropdown: 
Akademik 
\Mata Kuilah 
\Magang \Kalender Akademik 
\Panduan Akademik 
\Keperluan Tugas Akhir 
\Admisi Akademik 
Kemahasiswaan 
\Alumni 
\Prestasi 
\Bank Judul Skripsi 
\Organisasi Mahasiswa 
Informasi Penting 
\Profil Jurusan 
\Zona Integritas 
\Tenaga Pengajar 
\Tenaga Kependidikan 
Seputar Prodi 
\Berita 
\Dokumentasi