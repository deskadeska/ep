<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminManageController extends Controller
{
    private function checkSuperAdmin()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_if($user->tipeUser !== 'Super Admin', 403, 'Akses Ditolak: Hanya Super Admin yang dapat mengakses halaman ini.');
    }

    public function index()
    {
        $this->checkSuperAdmin();

        $admins = User::where('tipeUser', '!=', 'Super Admin')
                      ->orderBy('user_id', 'desc')
                      ->get();

        // 1. Ambil semua user_id dari admin yang ditampilkan
        $adminIds = $admins->pluck('user_id');

        // 2. Ambil sesi yang terkait dengan admin-admin tersebut
        $rawSessions = DB::table('sessions')
                         ->whereIn('user_id', $adminIds)
                         ->orderBy('last_activity', 'desc')
                         ->get();

        // 3. Kelompokkan sesi berdasarkan user_id dan manipulasi datanya
        $sessions = [];
        foreach ($rawSessions as $session) {
            $session->last_activity_formatted = Carbon::createFromTimestamp($session->last_activity)
                                                      ->translatedFormat('d M Y, H:i:s');

            $parsedUa = $this->parseUserAgent($session->user_agent);
            $session->os      = $parsedUa['os'];
            $session->browser = $parsedUa['browser'];

            // Simpan ke dalam array multi-dimensi dengan key berupa user_id
            $sessions[$session->user_id][] = $session;
        }

        return view('admin.data_admin.kelola', compact('admins', 'sessions'));
    }

    // Fungsi Privat untuk memecah string User Agent
    private function parseUserAgent($userAgent)
    {
        $os      = 'Unknown';
        $browser = 'Unknown';

        if (empty($userAgent)) {
            return ['os' => $os, 'browser' => $browser];
        }

        if (preg_match('/windows nt 10/i', $userAgent))        $os = 'Windows 10 / 11';
        elseif (preg_match('/windows nt 6\.3/i', $userAgent))  $os = 'Windows 8.1';
        elseif (preg_match('/windows nt 6\.2/i', $userAgent))  $os = 'Windows 8';
        elseif (preg_match('/windows nt 6\.1/i', $userAgent))  $os = 'Windows 7';
        elseif (preg_match('/macintosh|mac os x/i', $userAgent)) $os = 'Mac OS';
        elseif (preg_match('/linux/i', $userAgent))             $os = 'Linux';
        elseif (preg_match('/android/i', $userAgent))           $os = 'Android';
        elseif (preg_match('/iphone|ipad|ipod/i', $userAgent))  $os = 'iOS';
        else                                                     $os = 'Other OS';

        if (preg_match('/edg/i', $userAgent))                                              $browser = 'Microsoft Edge';
        elseif (preg_match('/opr|opera/i', $userAgent))                                   $browser = 'Opera';
        elseif (preg_match('/chrome/i', $userAgent))                                      $browser = 'Google Chrome';
        elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) $browser = 'Safari';
        elseif (preg_match('/firefox/i', $userAgent))                                     $browser = 'Mozilla Firefox';
        else                                                                               $browser = 'Other Browser';

        return ['os' => $os, 'browser' => $browser];
    }

    public function store(Request $request)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'namaLengkapUser' => ['required', 'string', 'max:255'],
            'jkUser'          => ['required', 'in:Laki-laki,Perempuan'],
            'noTelpUser'      => ['required', 'string', 'unique:tb_users,noTelpUser'],
            'email'           => ['required', 'email', 'unique:tb_users,email'],
            'password'        => ['required', 'string', 'min:6', 'confirmed'],
            'fotoUser'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'namaLengkapUser.required' => 'Nama lengkap wajib diisi.',
            'jkUser.required'          => 'Jenis kelamin wajib dipilih.',
            'noTelpUser.required'      => 'Nomor telepon wajib diisi.',
            'noTelpUser.unique'        => 'Nomor telepon sudah terdaftar.',
            'email.required'           => 'Email wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'email.unique'             => 'Email sudah terdaftar.',
            'password.required'        => 'Password wajib diisi.',
            'password.min'             => 'Password minimal 6 karakter.',
            'password.confirmed'       => 'Konfirmasi password tidak cocok.',
            'fotoUser.image'           => 'File harus berupa gambar.',
            'fotoUser.mimes'           => 'Format gambar harus jpeg, png, atau jpg.',
            'fotoUser.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $namaFoto = null;

        if ($request->hasFile('fotoUser')) {
            $file     = $request->file('fotoUser');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/users'), $namaFoto);
        }

        User::create([
            'namaLengkapUser' => $request->namaLengkapUser,
            'tipeUser'        => 'Admin', // Mutlak Admin biasa
            'jkUser'          => $request->jkUser,
            'noTelpUser'      => $request->noTelpUser,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'fotoUser'        => $namaFoto,
        ]);

        return back()->with('success', 'Data Admin baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $this->checkSuperAdmin();

        $admin = User::findOrFail($id);

        if ($admin->tipeUser === 'Super Admin') {
            return back()->with('error', 'Akses Ditolak: Anda tidak dapat mengedit data Super Admin melalui form ini.');
        }

        $request->validate([
            'namaLengkapUser' => ['required', 'string', 'max:255'],
            'jkUser'          => ['required', 'in:Laki-laki,Perempuan'],
            'noTelpUser'      => ['required', 'string', 'unique:tb_users,noTelpUser,' . $id . ',user_id'],
            'email'           => ['required', 'email', 'unique:tb_users,email,' . $id . ',user_id'],
            'password'        => ['nullable', 'string', 'min:6', 'confirmed'],
            'fotoUser'        => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ], [
            'namaLengkapUser.required' => 'Nama lengkap wajib diisi.',
            'jkUser.required'          => 'Jenis kelamin wajib dipilih.',
            'noTelpUser.required'      => 'Nomor telepon wajib diisi.',
            'noTelpUser.unique'        => 'Nomor telepon sudah digunakan oleh akun lain.',
            'email.required'           => 'Email wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'email.unique'             => 'Email sudah digunakan oleh akun lain.',
            'password.min'             => 'Password minimal 6 karakter.',
            'password.confirmed'       => 'Konfirmasi password tidak cocok.',
            'fotoUser.image'           => 'File harus berupa gambar.',
            'fotoUser.mimes'           => 'Format gambar harus jpeg, png, atau jpg.',
            'fotoUser.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $dataUpdate = [
            'namaLengkapUser' => $request->namaLengkapUser,
            'jkUser'          => $request->jkUser,
            'noTelpUser'      => $request->noTelpUser,
            'email'           => $request->email,
        ];

        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('fotoUser')) {
            // Hapus foto lama jika ada
            if ($admin->fotoUser && File::exists(public_path('assets/admin/uploads/users/' . $admin->fotoUser))) {
                File::delete(public_path('assets/admin/uploads/users/' . $admin->fotoUser));
            }

            $file                   = $request->file('fotoUser');
            $namaFotoBaru           = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/users'), $namaFotoBaru);
            $dataUpdate['fotoUser'] = $namaFotoBaru;
        }

        $admin->update($dataUpdate);

        return back()->with('success', 'Data Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->checkSuperAdmin();

        $admin = User::findOrFail($id);

        if ($admin->tipeUser === 'Super Admin') {
            return back()->with('error', 'Akses Ditolak: Data Super Admin tidak dapat dihapus.');
        }

        if ($admin->fotoUser && File::exists(public_path('assets/admin/uploads/users/' . $admin->fotoUser))) {
            File::delete(public_path('assets/admin/uploads/users/' . $admin->fotoUser));
        }

        $admin->delete();

        return back()->with('success', 'Data Admin berhasil dihapus.');
    }
}
