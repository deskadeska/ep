<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Kunci rahasia untuk dekripsi (Sama dengan yang ada di JS)
    // Di tahap production, letakkan ini di file .env (misal: env('CLIENT_SECRET_KEY'))
    private $secretKey = 'EkopemUprSecretKey2026AdminLogin';

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // 1. Ambil data terenkripsi dari input hidden
        $encryptedPayload = $request->input('encrypted_payload');

        if (!$encryptedPayload) {
            return back()->with('error', 'Payload tidak valid.');
        }

        // 2. Dekripsi data menggunakan OpenSSL (mendukung hasil dari CryptoJS)
        $decryptedJson = openssl_decrypt(
            $encryptedPayload,
            'AES-256-ECB',
            $this->secretKey,
            0 // Flag 0 wajib karena output CryptoJS.toString() adalah Base64
        );

        $credentials = json_decode($decryptedJson, true);

        if (!$credentials || !isset($credentials['identifier']) || !isset($credentials['password'])) {
            return back()->with('error', 'Gagal mendekripsi data kredensial.');
        }

        $identifier = $credentials['identifier'];
        $password = $credentials['password'];

        // 3. Deteksi apakah input berupa Email atau Nomor Telepon
        // Jika input hanya berisi angka, asumsikan itu nomor telepon
        $loginType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'noTelpUser';

        // 4. Proses Autentikasi
        if (Auth::attempt([$loginType => $identifier, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Kredensial tidak cocok dengan data kami.');
    }

    public function logout(Request $request)
    {
        // 1. Keluarkan pengguna dari sistem autentikasi
        Auth::logout();

        // 2. Hancurkan semua data sesi yang ada (termasuk ID sesi di database/file)
        $request->session()->invalidate();

        // 3. Buat ulang token CSRF untuk keamanan (mencegah eksploitasi token lama)
        $request->session()->regenerateToken();

        // 4. Arahkan kembali ke halaman login
        return redirect('/admin/login')->with('success', 'Anda telah berhasil log out.');
    }
}
