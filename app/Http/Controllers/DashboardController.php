<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DashboardController extends Controller
{
    public function index()
    {
        // TODO: Ganti angka statis ini dengan query Eloquent di masa depan
        // Contoh: 'total_mhs' => \App\Models\Mahasiswa::count(),
        $data = [
            'tahun_ajaran' => 'Genap 2025/2026',
            'stats' => [
                'total_mhs' => 453,
                'total_dosen' => 45,
                'total_matkul' => 62,
                'mhs_aktif' => 400,
                'mhs_lulus' => 80,
                'pengunjung' => 1330
            ],
            'system' => [
                'status' => 'Online',
                'user_aktif' => 12, // Bisa diambil dari tabel sessions yang kita buat sebelumnya
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

        return view('admin.dashboard', $data);
    }

    public function backupDatabase()
    {
        // 1. Ambil kredensial dari environment
        $host = env('DB_HOST', '127.0.0.1');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');
        $database = env('DB_DATABASE', 'db_ekopem');

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
            // Menggunakan exec() murni untuk dukungan multi-platform yang lebih mudah
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