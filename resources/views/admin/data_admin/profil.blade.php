@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color: var(--navy);">Profil Saya</h1>
    <p class="text-sm mt-1" style="color: var(--caption);">Kelola informasi pribadi dan pengaturan keamanan akun Anda.</p>
</div>

<!-- Pesan Notifikasi -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
@endif
@if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Bagian Kiri: Kartu Ringkasan Profil -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden text-center p-6">
            <div class="relative inline-block mb-4">
                @if($admin->fotoUser)
                    <img src="{{ asset('assets/admin/uploads/users/' . $admin->fotoUser) }}" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover border-4 border-[#E8F1F8] shadow-md mx-auto">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-100 border-4 border-[#E8F1F8] shadow-md mx-auto flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                @endif
                <div class="absolute bottom-1 right-1 bg-green-500 w-5 h-5 rounded-full border-2 border-white" title="Online"></div>
            </div>

            <h2 class="text-xl font-bold text-gray-800">{{ $admin->namaLengkapUser }}</h2>
            <p class="text-sm text-gray-500 mb-3">{{ $admin->email }}</p>

            <span class="inline-block bg-[#E8F1F8] text-[#2A6F97] px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                {{ $admin->tipeUser }}
            </span>

            <div class="mt-6 pt-6 border-t border-gray-100 text-left text-sm space-y-3 text-gray-600">
                <div class="flex justify-between">
                    <span class="font-medium">Gender:</span>
                    <span>{{ $admin->jkUser }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Telepon:</span>
                    <span>{{ $admin->noTelpUser }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Bergabung:</span>
                    <span>{{ $admin->created_at ? $admin->created_at->translatedFormat('d M Y') : '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium">Diubah:</span>
                    <span>{{ $admin->updated_at ? $admin->updated_at->translatedFormat('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Kanan: Form Edit Profil -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="font-bold text-lg" style="color: var(--navy);">Pengaturan Profil</h3>
            </div>

            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateProfilPassword()">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">

                    <!-- Upload Foto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Foto Profil</label>
                        <input type="file" name="fotoUser" accept="image/png, image/jpeg, image/jpg" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100 transition">
                        <p class="text-xs text-gray-500 mt-1.5">Format: JPG, JPEG, PNG. Maksimal ukuran 2MB.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="namaLengkapUser" value="{{ old('namaLengkapUser', $admin->namaLengkapUser) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jkUser" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                                <option value="Laki-laki" {{ $admin->jkUser == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $admin->jkUser == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                        </div>

                        <!-- No Telp -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="number" name="noTelpUser" value="{{ old('noTelpUser', $admin->noTelpUser) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                        </div>
                    </div>

                    <hr class="border-gray-200 my-4">

                    <!-- Keamanan -->
                    <h4 class="font-semibold text-sm text-gray-800 mb-3">Ubah Password</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password" id="profil_pwd" placeholder="Kosongkan jika tidak diubah" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="profil_pwd_confirm" placeholder="Ulangi password baru" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e] transition shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS Validasi Password Klien -->
<script>
    function validateProfilPassword() {
        let pwd = document.getElementById('profil_pwd').value;
        let confirmPwd = document.getElementById('profil_pwd_confirm').value;

        if (pwd !== confirmPwd) {
            alert('Proses dibatalkan: Password Baru dan Konfirmasi Password tidak cocok!');
            return false;
        }
        return true;
    }
</script>
@endsection
