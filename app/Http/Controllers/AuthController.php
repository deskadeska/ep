<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input menggunakan Form Validation resmi Laravel
        $request->validate([
            'identifier' => ['required', 'string'],
            'password'   => ['required', 'string'],
        ], [
            'identifier.required' => 'Email atau nomor telepon wajib diisi.',
            'password.required'   => 'Password wajib diisi.',
        ]);

        // 2. Terapkan Rate Limiting: Maks 5 percobaan per 1 menit per IP + identifier
        $throttleKey = Str::lower($request->input('identifier')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, maxAttempts: 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'identifier' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        $identifier = $request->input('identifier');
        $password   = $request->input('password');

        // 3. Deteksi apakah input berupa Email atau Nomor Telepon
        $loginType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'noTelpUser';

        // 4. Proses Autentikasi
        if (Auth::attempt([$loginType => $identifier, 'password' => $password])) {
            // Reset penghitung rate limiter jika login berhasil
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        // 5. Tambah hitungan percobaan gagal pada rate limiter
        RateLimiter::hit($throttleKey, 60);

        // 6. Kembalikan error validasi (tidak mengungkap kolom mana yang salah)
        throw ValidationException::withMessages([
            'identifier' => 'Kredensial tidak cocok dengan data kami.',
        ]);
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
