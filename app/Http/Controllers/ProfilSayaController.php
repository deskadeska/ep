<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfilSayaController extends Controller
{
    public function index()
    {
        // Ambil data admin yang sedang login
        $admin = auth()->user();
        return view('admin.data_admin.profil', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = auth()->user();

        $request->validate([
            'namaLengkapUser' => 'required|string|max:255',
            'jkUser' => 'required|in:Laki-laki,Perempuan',
            // Validasi unique mengecualikan ID milik admin itu sendiri
            'noTelpUser' => 'required|string|unique:tb_users,noTelpUser,' . $admin->user_id . ',user_id',
            'email' => 'required|email|unique:tb_users,email,' . $admin->user_id . ',user_id',
            'password' => 'nullable|string|min:6|confirmed',
            'fotoUser' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'namaLengkapUser' => $request->namaLengkapUser,
            'jkUser' => $request->jkUser,
            'noTelpUser' => $request->noTelpUser,
            'email' => $request->email,
        ];

        // Hash password baru jika form diisi
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        // Proses Ganti Foto
        if ($request->hasFile('fotoUser')) {
            // Hapus foto lama
            if ($admin->fotoUser && File::exists(public_path('assets/admin/uploads/users/' . $admin->fotoUser))) {
                File::delete(public_path('assets/admin/uploads/users/' . $admin->fotoUser));
            }

            // Upload foto baru
            $file = $request->file('fotoUser');
            $namaFotoBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/admin/uploads/users'), $namaFotoBaru);

            $dataUpdate['fotoUser'] = $namaFotoBaru;
        }

        // Update data menggunakan Query Builder berdasar ID
        User::where('user_id', $admin->user_id)->update($dataUpdate);

        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
