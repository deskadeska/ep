<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganisasiMahasiswa;
use Illuminate\Support\Facades\File;

class OrganisasiMahasiswaController extends Controller
{
    public function frontendIndex()
    {
        // Mengambil semua data organisasi mahasiswa
        $ormawa = OrganisasiMahasiswa::orderBy('idOrmawa', 'asc')->get();

        return view('frontend.kemahasiswaan.organisasi_mahasiswa', compact('ormawa'));
    }
    public function index()
    {
        $ormawa = OrganisasiMahasiswa::orderBy('idOrmawa', 'desc')->get();
        return view('admin.kemahasiswaan.organisasi_mahasiswa', compact('ormawa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaOrmawa'           => 'required|string|max:255',
            'deskripsiOrmawa'      => 'nullable|string',
            'fotoLogoUrlOrmawa'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fotoAnggotaUrlOrmawa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $logoName = null;
        $anggotaName = null;

        // Upload Logo
        if ($request->hasFile('fotoLogoUrlOrmawa')) {
            $fileLogo = $request->file('fotoLogoUrlOrmawa');
            $logoName = time() . '_logo_' . uniqid() . '.' . $fileLogo->getClientOriginalExtension();
            $fileLogo->move(public_path('assets/admin/uploads/ormawa'), $logoName);
        }

        // Upload Foto Anggota
        if ($request->hasFile('fotoAnggotaUrlOrmawa')) {
            $fileAnggota = $request->file('fotoAnggotaUrlOrmawa');
            $anggotaName = time() . '_anggota_' . uniqid() . '.' . $fileAnggota->getClientOriginalExtension();
            $fileAnggota->move(public_path('assets/admin/uploads/ormawa'), $anggotaName);
        }

        OrganisasiMahasiswa::create([
            'namaOrmawa'           => $request->namaOrmawa,
            'deskripsiOrmawa'      => $request->deskripsiOrmawa,
            'fotoLogoUrlOrmawa'    => $logoName,
            'fotoAnggotaUrlOrmawa' => $anggotaName
        ]);

        return back()->with('success', 'Data Organisasi Mahasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $ormawa = OrganisasiMahasiswa::findOrFail($id);

        $request->validate([
            'namaOrmawa'           => 'required|string|max:255',
            'deskripsiOrmawa'      => 'nullable|string',
            'fotoLogoUrlOrmawa'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'fotoAnggotaUrlOrmawa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $dataUpdate = [
            'namaOrmawa'      => $request->namaOrmawa,
            'deskripsiOrmawa' => $request->deskripsiOrmawa,
        ];

        // Update Logo
        if ($request->hasFile('fotoLogoUrlOrmawa')) {
            if ($ormawa->fotoLogoUrlOrmawa && File::exists(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoLogoUrlOrmawa))) {
                File::delete(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoLogoUrlOrmawa));
            }
            $fileLogo = $request->file('fotoLogoUrlOrmawa');
            $logoNameBaru = time() . '_logo_' . uniqid() . '.' . $fileLogo->getClientOriginalExtension();
            $fileLogo->move(public_path('assets/admin/uploads/ormawa'), $logoNameBaru);
            $dataUpdate['fotoLogoUrlOrmawa'] = $logoNameBaru;
        }

        // Update Foto Anggota
        if ($request->hasFile('fotoAnggotaUrlOrmawa')) {
            if ($ormawa->fotoAnggotaUrlOrmawa && File::exists(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoAnggotaUrlOrmawa))) {
                File::delete(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoAnggotaUrlOrmawa));
            }
            $fileAnggota = $request->file('fotoAnggotaUrlOrmawa');
            $anggotaNameBaru = time() . '_anggota_' . uniqid() . '.' . $fileAnggota->getClientOriginalExtension();
            $fileAnggota->move(public_path('assets/admin/uploads/ormawa'), $anggotaNameBaru);
            $dataUpdate['fotoAnggotaUrlOrmawa'] = $anggotaNameBaru;
        }

        $ormawa->update($dataUpdate);

        return back()->with('success', 'Data Organisasi Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ormawa = OrganisasiMahasiswa::findOrFail($id);

        // Hapus file Logo
        if ($ormawa->fotoLogoUrlOrmawa && File::exists(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoLogoUrlOrmawa))) {
            File::delete(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoLogoUrlOrmawa));
        }

        // Hapus file Foto Anggota
        if ($ormawa->fotoAnggotaUrlOrmawa && File::exists(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoAnggotaUrlOrmawa))) {
            File::delete(public_path('assets/admin/uploads/ormawa/' . $ormawa->fotoAnggotaUrlOrmawa));
        }

        $ormawa->delete();

        return back()->with('success', 'Data Organisasi Mahasiswa berhasil dihapus.');
    }
}
