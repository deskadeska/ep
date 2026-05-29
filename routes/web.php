<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminManageController;
use App\Http\Controllers\ProfilSayaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\PanduanAkademikController;
use App\Http\Controllers\KeperluanTugasAkhirController;
use App\Http\Controllers\DetailKeperluanTugasAkhirController;
use App\Http\Controllers\AdministrasiAkademikController;
use App\Http\Controllers\TenagaPengajarController;
use App\Http\Controllers\TenagaKependidikanController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PimpinanJurusanController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PrestasiMahasiswaController;
use App\Http\Controllers\BankJudulSkripsiController;
use App\Http\Controllers\OrganisasiMahasiswaController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\JadwalKegiatanController;

// =========================================================
// BAGIAN 1: KODE ASLI DARI WEB.PHP SEBELUMNYA
// =========================================================
// Rute untuk Frontend / Halaman Utama Pengunjung
Route::get('/', [HomeController::class, 'index'])->name('home');

// Grup Rute Akademik
Route::prefix('akademik')->group(function () {
    Route::get('/mata-kuliah', [MataKuliahController::class, 'frontendIndex'])->name('frontend.mata_kuliah');
    Route::get('/magang', [MagangController::class, 'frontendIndex'])->name('frontend.magang');
    Route::get('/administrasi', [AdministrasiAkademikController::class, 'frontendIndex'])->name('frontend.administrasi');
    Route::get('/kalender', [KalenderAkademikController::class, 'frontendIndex'])->name('frontend.kalender');
    // Halaman Keperluan Tugas Akhir (Menyesuaikan path navbar: /akademik/tugas-akhir)
    Route::get('/tugas-akhir', [KeperluanTugasAkhirController::class, 'frontendIndex'])->name('frontend.tugas_akhir');

    // Rute untuk proses unduh file
    Route::get('/tugas-akhir/download/{idDKTA}', [DetailKeperluanTugasAkhirController::class, 'download'])->name('frontend.download_tugas_akhir');
    Route::get('/panduan', function () {
        return view('frontend.akademik.panduan_akademik');
    })->name('frontend.panduan_akademik');
    // Rute akademik frontend lainnya (seperti magang, kalender, dll) akan ditambahkan di sini nanti
});

Route::prefix('kemahasiswaan')->group(function () {
    Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'frontendIndex'])->name('frontend.struktur_organisasi');
    Route::get('/alumni', [AlumniController::class, 'frontendIndex'])->name('frontend.alumni');
    Route::get('/prestasi', [PrestasiMahasiswaController::class, 'frontendIndex'])->name('frontend.prestasi');
    Route::get('/bank-judul', [BankJudulSkripsiController::class, 'frontendIndex'])->name('frontend.bank_judul');
    Route::get('/organisasi-mahasiswa', [OrganisasiMahasiswaController::class, 'frontendIndex'])->name('frontend.ormawa');
    Route::get('/statistik', [StatistikController::class, 'index'])->name('frontend.statistik');
});

// Grup Rute Informasi Penting
Route::prefix('informasi')->group(function () {

    // Rute Sejarah Jurusan
    Route::get('/sejarah-jurusan', function () {
        return view('frontend.informasi_penting.sejarah_jurusan');
    })->name('frontend.sejarah_jurusan');

    // Rute Visi & Misi
    Route::get('/visi-misi', function () {
        return view('frontend.informasi_penting.visi_misi');
    })->name('frontend.visi_misi');

    Route::get('/zona-integritas', function () {
        return view('frontend.informasi_penting.zona_integritas');
    })->name('frontend.zona_integritas');

    // Rute Tenaga Pengajar
    Route::get('/tenaga-pengajar', [TenagaPengajarController::class, 'frontendIndex'])->name('frontend.tenaga_pengajar');

    // Rute Tenaga Kependidikan
    Route::get('/tenaga-kependidikan', [TenagaKependidikanController::class, 'frontendIndex'])->name('frontend.tenaga_kependidikan');

    // Rute Pimpinan Jurusan
    Route::get('/pimpinan-jurusan', [PimpinanJurusanController::class, 'frontendPimpinan'])->name('frontend.pimpinan_jurusan');

    // Rute informasi lainnya nanti bisa ditambahkan di sini (Zona Integritas, dll)

});

Route::prefix('prodi')->group(function () {
    Route::get('/berita', [BeritaController::class, 'frontendIndex'])->name('frontend.berita');

    // Placeholder untuk rute baca berita (sesuaikan parameternya nanti)
    Route::get('/berita/baca/{id}', [BeritaController::class, 'bacaBerita'])->name('frontend.baca_berita');
    Route::get('/dokumentasi', [DokumentasiController::class, 'frontendIndex'])->name('frontend.dokumentasi');
    Route::get('/video', [VideoController::class, 'frontendIndex'])->name('frontend.video');
    Route::get('/jadwal-kegiatan', [JadwalKegiatanController::class, 'frontendIndex'])->name('frontend.jadwal_kegiatan');
});

// Asumsi rute login sudah ada
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);

// Grup Rute yang membutuhkan Login
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Rute Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // (Tambahkan rute-rute lain di sini nantinya)
});


// =========================================================
// BAGIAN 2: KODE YANG DISATUKAN DARI ADMIN.PHP
// =========================================================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index'); // Sesuaikan dengan path Anda
    })->name('admin.dashboard');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Rute Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Rute Backup Database
    Route::get('/backup-database', [DashboardController::class, 'backupDatabase'])->name('admin.backup');

    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/kelola', [AdminManageController::class, 'index'])->name('admin.kelola.index');
    Route::post('/kelola', [AdminManageController::class, 'store'])->name('admin.kelola.store');
    Route::put('/kelola/{id}', [AdminManageController::class, 'update'])->name('admin.kelola.update');
    Route::delete('/kelola/{id}', [AdminManageController::class, 'destroy'])->name('admin.kelola.destroy');

    // Rute Profil Saya (Dapat diakses semua tipe admin)
    Route::get('/profil', [ProfilSayaController::class, 'index'])->name('admin.profil.index');
    Route::put('/profil', [ProfilSayaController::class, 'update'])->name('admin.profil.update');

    // Rute Kelola Akademik
    // -> Mata Kuliah
    Route::get('/akademik/mata-kuliah', [MataKuliahController::class, 'index'])->name('admin.akademik.matakuliah');
    Route::post('/akademik/mata-kuliah', [MataKuliahController::class, 'store'])->name('admin.akademik.matakuliah.store');
    Route::put('/akademik/mata-kuliah/{id}', [MataKuliahController::class, 'update'])->name('admin.akademik.matakuliah.update');
    Route::delete('/akademik/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('admin.akademik.matakuliah.destroy');
    // -> Magang
    Route::get('/akademik/magang', [MagangController::class, 'index'])->name('admin.akademik.magang');
    Route::post('/akademik/magang', [MagangController::class, 'store'])->name('admin.akademik.magang.store');
    Route::put('/akademik/magang/{id}', [MagangController::class, 'update'])->name('admin.akademik.magang.update');
    Route::delete('/akademik/magang/{id}', [MagangController::class, 'destroy'])->name('admin.akademik.magang.destroy');
    // -> Tahun Ajaran
    Route::get('/akademik/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('admin.tahun_ajaran.index');
    Route::post('/akademik/tahun-ajaran', [TahunAjaranController::class, 'store'])->name('admin.tahun_ajaran.store');
    Route::put('/akademik/tahun-ajaran/{id}', [TahunAjaranController::class, 'update'])->name('admin.tahun_ajaran.update');
    Route::delete('/akademik/tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('admin.tahun_ajaran.destroy');
    // -> Kalender Akademik
    Route::get('/akademik/kalender', [KalenderAkademikController::class, 'index'])->name('admin.kalender.index');
    Route::post('/akademik/kalender', [KalenderAkademikController::class, 'store'])->name('admin.kalender.store');
    Route::put('/akademik/kalender/{id}', [KalenderAkademikController::class, 'update'])->name('admin.kalender.update');
    Route::delete('/akademik/kalender/{id}', [KalenderAkademikController::class, 'destroy'])->name('admin.kalender.destroy');
    // -> Panduan Akademik
    Route::get('/akademik/panduan', [PanduanAkademikController::class, 'index'])->name('admin.panduan.index');
    Route::post('/akademik/panduan', [PanduanAkademikController::class, 'store'])->name('admin.panduan.store');
    Route::put('/akademik/panduan/{id}', [PanduanAkademikController::class, 'update'])->name('admin.panduan.update');
    Route::delete('/akademik/panduan/{id}', [PanduanAkademikController::class, 'destroy'])->name('admin.panduan.destroy');
    // -> Keperluan Tugas Akhir
    Route::get('/akademik/tugas-akhir', [KeperluanTugasAkhirController::class, 'index'])->name('admin.tugas_akhir.index');
    Route::post('/akademik/tugas-akhir', [KeperluanTugasAkhirController::class, 'store'])->name('admin.tugas_akhir.store');
    Route::put('/akademik/tugas-akhir/{id}', [KeperluanTugasAkhirController::class, 'update'])->name('admin.tugas_akhir.update');
    Route::delete('/akademik/tugas-akhir/{id}', [KeperluanTugasAkhirController::class, 'destroy'])->name('admin.tugas_akhir.destroy');
    // Detail KTA (Melekat pada ID Kelompok)
    Route::get('/akademik/tugas-akhir/detail/{idKTA}', [DetailKeperluanTugasAkhirController::class, 'index'])->name('admin.tugas_akhir.detail');
    Route::post('/akademik/tugas-akhir/detail/{idKTA}', [DetailKeperluanTugasAkhirController::class, 'store'])->name('admin.tugas_akhir.detail.store');
    Route::put('/akademik/tugas-akhir/detail/update/{idDKTA}', [DetailKeperluanTugasAkhirController::class, 'update'])->name('admin.tugas_akhir.detail.update');
    Route::delete('/akademik/tugas-akhir/detail/delete/{idDKTA}', [DetailKeperluanTugasAkhirController::class, 'destroy'])->name('admin.tugas_akhir.detail.destroy');
    // Administrasi Akademik
    Route::get('/akademik/administrasi', [AdministrasiAkademikController::class, 'index'])->name('admin.administrasi.index');
    Route::post('/akademik/administrasi', [AdministrasiAkademikController::class, 'store'])->name('admin.administrasi.store');
    Route::put('/akademik/administrasi/{id}', [AdministrasiAkademikController::class, 'update'])->name('admin.administrasi.update');
    Route::delete('/akademik/administrasi/{id}', [AdministrasiAkademikController::class, 'destroy'])->name('admin.administrasi.destroy');

    // Rute Informasi Penting
    // -> Tenaga Pengajar
    Route::get('/informasi-penting/tenaga-pengajar', [TenagaPengajarController::class, 'index'])->name('admin.pengajar.index');
    Route::post('/informasi-penting/tenaga-pengajar', [TenagaPengajarController::class, 'store'])->name('admin.pengajar.store');
    Route::put('/informasi-penting/tenaga-pengajar/{id}', [TenagaPengajarController::class, 'update'])->name('admin.pengajar.update');
    Route::delete('/informasi-penting/tenaga-pengajar/{id}', [TenagaPengajarController::class, 'destroy'])->name('admin.pengajar.destroy');
    Route::post('/informasi-penting/tenaga-pengajar/update-urutan', [TenagaPengajarController::class, 'updateUrutan'])->name('admin.pengajar.update_urutan');
    Route::post('/informasi-penting/tenaga-pengajar/reset-urutan', [TenagaPengajarController::class, 'resetUrutan'])->name('admin.pengajar.reset_urutan');
    // -> Tenaga Kependidikan
    Route::get('/informasi-penting/tenaga-kependidikan', [TenagaKependidikanController::class, 'index'])->name('admin.kependidikan.index');
    Route::post('/informasi-penting/tenaga-kependidikan', [TenagaKependidikanController::class, 'store'])->name('admin.kependidikan.store');
    Route::put('/informasi-penting/tenaga-kependidikan/{id}', [TenagaKependidikanController::class, 'update'])->name('admin.kependidikan.update');
    Route::delete('/informasi-penting/tenaga-kependidikan/{id}', [TenagaKependidikanController::class, 'destroy'])->name('admin.kependidikan.destroy');
    // -> Rute Mitra
    Route::get('/informasi-penting/mitra', [MitraController::class, 'index'])->name('admin.informasi_penting.mitra.index');
    Route::post('/informasi-penting/mitra', [MitraController::class, 'store'])->name('admin.informasi_penting.mitra.store');
    Route::put('/informasi-penting/mitra/{id}', [MitraController::class, 'update'])->name('admin.informasi_penting.mitra.update');
    Route::delete('/informasi-penting/mitra/{id}', [MitraController::class, 'destroy'])->name('admin.informasi_penting.mitra.destroy');
    Route::post('/informasi-penting/mitra/update-urutan', [MitraController::class, 'updateUrutan'])->name('admin.informasi_penting.mitra.update_urutan');
    // Rute Pimpinan Jurusan
    Route::get('/informasi-penting/pimpinan-jurusan', [PimpinanJurusanController::class, 'index'])->name('admin.pimpinan_jurusan.index');
    Route::post('/informasi-penting/pimpinan-jurusan', [PimpinanJurusanController::class, 'store'])->name('admin.pimpinan_jurusan.store');
    Route::put('/informasi-penting/pimpinan-jurusan/{id}', [PimpinanJurusanController::class, 'update'])->name('admin.pimpinan_jurusan.update');
    Route::delete('/informasi-penting/pimpinan-jurusan/{id}', [PimpinanJurusanController::class, 'destroy'])->name('admin.pimpinan_jurusan.destroy');

    // Rute Kemahasiswaan
    // -> Struktur Organisasi
    Route::get('/kemahasiswaan/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('admin.struktur_organisasi.index');
    Route::post('/kemahasiswaan/struktur-organisasi', [StrukturOrganisasiController::class, 'store'])->name('admin.struktur_organisasi.store');
    Route::put('/kemahasiswaan/struktur-organisasi/{id}', [StrukturOrganisasiController::class, 'update'])->name('admin.struktur_organisasi.update');
    Route::delete('/kemahasiswaan/struktur-organisasi/{id}', [StrukturOrganisasiController::class, 'destroy'])->name('admin.struktur_organisasi.destroy');
    // -> Alumni
    Route::get('/kemahasiswaan/alumni', [AlumniController::class, 'index'])->name('admin.alumni.index');
    Route::post('/kemahasiswaan/alumni', [AlumniController::class, 'store'])->name('admin.alumni.store');
    Route::put('/kemahasiswaan/alumni/{id}', [AlumniController::class, 'update'])->name('admin.alumni.update');
    Route::delete('/kemahasiswaan/alumni/{id}', [AlumniController::class, 'destroy'])->name('admin.alumni.destroy');
    // -> Rute Prestasi Mahasiswa (Sesuaikan dengan Sidebar)
    Route::get('/kemahasiswaan/prestasi', [PrestasiMahasiswaController::class, 'index'])->name('admin.prestasi.index');
    Route::post('/kemahasiswaan/prestasi', [PrestasiMahasiswaController::class, 'store'])->name('admin.prestasi.store');
    Route::put('/kemahasiswaan/prestasi/{id}', [PrestasiMahasiswaController::class, 'update'])->name('admin.prestasi.update');
    Route::delete('/kemahasiswaan/prestasi/{id}', [PrestasiMahasiswaController::class, 'destroy'])->name('admin.prestasi.destroy');
    // -> Bank Judul Skripsi
    Route::get('/kemahasiswaan/bank-judul', [BankJudulSkripsiController::class, 'index'])->name('admin.bank_judul.index');
    Route::post('/kemahasiswaan/bank-judul', [BankJudulSkripsiController::class, 'store'])->name('admin.bank_judul.store');
    Route::put('/kemahasiswaan/bank-judul/{id}', [BankJudulSkripsiController::class, 'update'])->name('admin.bank_judul.update');
    Route::delete('/kemahasiswaan/bank-judul/{id}', [BankJudulSkripsiController::class, 'destroy'])->name('admin.bank_judul.destroy');
    // -> Organisasi Mahasiswa
    Route::get('/kemahasiswaan/organisasi', [OrganisasiMahasiswaController::class, 'index'])->name('admin.organisasi.index');
    Route::post('/kemahasiswaan/organisasi', [OrganisasiMahasiswaController::class, 'store'])->name('admin.organisasi.store');
    Route::put('/kemahasiswaan/organisasi/{id}', [OrganisasiMahasiswaController::class, 'update'])->name('admin.organisasi.update');
    Route::delete('/kemahasiswaan/organisasi/{id}', [OrganisasiMahasiswaController::class, 'destroy'])->name('admin.organisasi.destroy');
    // -> Statistik
    Route::get('/kemahasiswaan/statistik', [StatistikController::class, 'index'])->name('admin.statistik.index');
    Route::post('/kemahasiswaan/statistik', [StatistikController::class, 'update'])->name('admin.statistik.update');

    // Rute Seputar Prodi
    // -> Berita
    Route::get('/prodi/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
    Route::post('/prodi/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/prodi/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/prodi/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');
    // -> Video
    Route::get('/prodi/video', [VideoController::class, 'index'])->name('admin.video.index');
    Route::post('/prodi/video', [VideoController::class, 'store'])->name('admin.video.store');
    Route::put('/prodi/video/{id}', [VideoController::class, 'update'])->name('admin.video.update');
    Route::delete('/prodi/video/{id}', [VideoController::class, 'destroy'])->name('admin.video.destroy');
    // -> Dokumentasi
    Route::get('/prodi/dokumentasi', [DokumentasiController::class, 'index'])->name('admin.dokumentasi.index');
    Route::post('/prodi/dokumentasi', [DokumentasiController::class, 'store'])->name('admin.dokumentasi.store');
    Route::put('/prodi/dokumentasi/{id}', [DokumentasiController::class, 'update'])->name('admin.dokumentasi.update');
    Route::delete('/prodi/dokumentasi/{id}', [DokumentasiController::class, 'destroy'])->name('admin.dokumentasi.destroy');
    // -> Jadwal Kegiatan
    Route::get('/prodi/jadwal-kegiatan', [JadwalKegiatanController::class, 'index'])->name('admin.jadwal_kegiatan.index');
    Route::post('/prodi/jadwal-kegiatan', [JadwalKegiatanController::class, 'store'])->name('admin.jadwal_kegiatan.store');
    Route::put('/prodi/jadwal-kegiatan/{id}', [JadwalKegiatanController::class, 'update'])->name('admin.jadwal_kegiatan.update');
    Route::delete('/prodi/jadwal-kegiatan/{id}', [JadwalKegiatanController::class, 'destroy'])->name('admin.jadwal_kegiatan.destroy');

    // Rute khusus mengunci status kegiatan menjadi Selesai
    Route::patch('/prodi/jadwal-kegiatan/{id}/selesai', [JadwalKegiatanController::class, 'markSelesai'])->name('admin.jadwal_kegiatan.selesai');
});
