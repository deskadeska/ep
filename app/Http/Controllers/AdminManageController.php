<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminManageController extends Controller
{
    private function checkSuperAdmin()
    {
        abort_if(auth()->user()->tipeUser !== 'Super Admin', 403, 'Akses Ditolak: Hanya Super Admin yang dapat mengakses halaman ini.');
    }

    public function index()
    {
        $this->checkSuperAdmin();

        // PERUBAHAN 1: Filter agar hanya menampilkan Admin biasa
        $admins = User::where('tipeUser', '!=', 'Super Admin')
                      ->orderBy('user_id', 'desc')
                      ->get();

        return view('admin.data_admin.kelola', compact('admins'));
    }

    public function store(Request $request)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'namaLengkapUser' => 'required|string|max:255',
            'jkUser' => 'required|in:Laki-laki,Perempuan',
            'noTelpUser' => 'required|string|unique:tb_users,noTelpUser',
            'email' => 'required|email|unique:tb_users,email',
            'password' => 'required|string|min:6|confirmed',
            'fotoUser' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = null;

        if ($request->hasFile('fotoUser')) {
            $file = $request->file('fotoUser');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/users'), $namaFoto);
        }

        User::create([
            'namaLengkapUser' => $request->namaLengkapUser,
            'tipeUser' => 'Admin', // Mutlak Admin biasa
            'jkUser' => $request->jkUser,
            'noTelpUser' => $request->noTelpUser,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fotoUser' => $namaFoto
        ]);

        return back()->with('success', 'Data Admin baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $this->checkSuperAdmin();

        $admin = User::findOrFail($id);

        // PERUBAHAN 2: Cegat jika target edit adalah Super Admin
        if ($admin->tipeUser === 'Super Admin') {
            return back()->with('error', 'Akses Ditolak: Anda tidak dapat mengedit data Super Admin melalui form ini.');
        }

        $request->validate([
            'namaLengkapUser' => 'required|string|max:255',
            'jkUser' => 'required|in:Laki-laki,Perempuan',
            'noTelpUser' => 'required|string|unique:tb_users,noTelpUser,' . $id . ',user_id',
            'email' => 'required|email|unique:tb_users,email,' . $id . ',user_id',
            'password' => 'nullable|string|min:6|confirmed',
            'fotoUser' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'namaLengkapUser' => $request->namaLengkapUser,
            'jkUser' => $request->jkUser,
            'noTelpUser' => $request->noTelpUser,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('fotoUser')) {
            if ($admin->fotoUser && File::exists(public_path('assets/admin/uploads/users/' . $admin->fotoUser))) {
                File::delete(public_path('assets/admin/uploads/users/' . $admin->fotoUser));
            }

            $file = $request->file('fotoUser');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
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

        // PERUBAHAN 3: Cegat penghapusan Super Admin
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
