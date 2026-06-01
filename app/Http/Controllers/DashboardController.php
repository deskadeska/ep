<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Spatie\Activitylog\Models\Activity;

// Import model untuk statistik dinamis
use App\Models\MataKuliah;
use App\Models\TenagaPengajar;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'tahun_ajaran' => 'Genap 2025/2026',
            'stats' => [
                'total_mhs' => 453, // TODO: Ganti dengan App\Models\Mahasiswa::count() jika model sudah ada
                'total_dosen' => TenagaPengajar::count(), // Dinamis dari tabel tb_tenaga_pengajar
                'total_matkul' => MataKuliah::count(), // Dinamis dari tabel tb_mata_kuliah
                'mhs_aktif' => 400, // TODO: Sesuaikan dengan logika mahasiswa aktif
                'mhs_lulus' => 80,  // TODO: Sesuaikan dengan logika mahasiswa lulus
                'pengunjung' => 1330 // TODO: Sesuaikan dengan tabel pengunjung/visitor
            ],
            'system' => [
                'status' => 'Online',
                'user_aktif' => DB::table('sessions')->count(), // Dinamis menghitung jumlah sesi aktif saat ini
                'last_backup' => 'Belum ada backup'
            ]
        ];

        // Cek file backup terakhir di direktori storage/app/backup (opsional untuk info status)
        $backupDir = storage_path('app/backup');
        if (File::exists($backupDir)) {
            $files = File::files($backupDir);
            if (!empty($files)) {
                // Ambil waktu modifikasi file terbaru
                $lastModified = filemtime(end($files)->getPathname());
                $data['system']['last_backup'] = date('d M Y, H:i', $lastModified);
            }
        }

        // Mengambil 20 log aktivitas terbaru beserta data relasi admin yang melakukan aksi (causer)
        $data['activities'] = Activity::with('causer')->latest()->limit(20)->get();

        return view('admin.dashboard', $data);
    }

    public function backupDatabase()
    {
        // 1. Ambil kredensial dari environment
        $host = env('DB_HOST', '127.0.0.1');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');
        $database = env('DB_DATABASE', 'ekopem');

        // 2. Siapkan nama file dan direktori
        $fileName = 'backup_' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';
        $backupDir = storage_path('app/backup');

        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }
        $filePath = $backupDir . '/' . $fileName;

        // 3. Susun perintah mysqldump
        // Hati-hati dengan password kosong pada environment XAMPP lokal
        $passString = empty($password) ? '' : "-p{$password}";
        $command = "mysqldump -h {$host} -u {$username} {$passString} {$database} > \"{$filePath}\"";

        try {
            // 4. Eksekusi eksternal melalui shell
            exec($command . ' 2>&1', $output, $returnVar);

            if ($returnVar !== 0) {
                // Jika gagal, catat error dan kembalikan pesan
                \Log::error('Database Backup Failed: ' . implode("\n", $output));
                return back()->with('error', 'Gagal melakukan backup. Pastikan mysqldump tersedia di server. Log: ' . end($output));
            }

            // 5. Unduh file dan otomatis hapus setelah terkirim agar storage server tidak penuh
            return response()->download($filePath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            \Log::error('Backup Exception: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem saat backup: ' . $e->getMessage());
        }
    }
}
