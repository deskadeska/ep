@extends('admin.layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold" style="color: var(--navy);">Kelola Data Admin</h1>
            <p class="text-sm mt-1" style="color: var(--caption);">Manajemen hak akses, profil, dan foto administrator sistem.
            </p>
        </div>
        <button onclick="openModal('modalTambah')"
            class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Admin
        </button>
    </div>

    <!-- Pesan Notifikasi (Tetap Sama) -->
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabel Data -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                        <th class="p-4 font-semibold">Profil</th>
                        <th class="p-4 font-semibold">Nama Lengkap</th>
                        <th class="p-4 font-semibold">Kontak & Akses</th>
                        <th class="p-4 font-semibold">Waktu Sistem</th>
                        <th class="p-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($admins as $admin)
                        <tr class="hover:bg-gray-50 transition bg-white" id="row-admin-{{ $admin->user_id }}">
                            <td class="p-4">
                                @if ($admin->fotoUser)
                                    <img src="{{ asset('assets/admin/uploads/users/' . $admin->fotoUser) }}" alt="Foto"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-100 shadow-sm">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-800">{{ $admin->namaLengkapUser }}</div>
                                <div class="text-xs text-gray-500">{{ $admin->jkUser }}</div>
                            </td>
                            <td class="p-4">
                                <div class="text-gray-800 font-medium">{{ $admin->email }}</div>
                                <div class="text-xs text-gray-500 mb-1">{{ $admin->noTelpUser }}</div>
                                <span class="inline-block bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase">Admin</span>
                            </td>
                            <td class="p-4">
                                <div class="text-xs text-gray-600">
                                    <span class="font-semibold text-gray-800">Dibuat:</span><br>
                                    {{ $admin->created_at ? $admin->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                </div>
                                <div class="text-xs text-gray-600 mt-1">
                                    <span class="font-semibold text-gray-800">Diedit:</span><br>
                                    {{ $admin->updated_at ? $admin->updated_at->translatedFormat('d M Y, H:i') : '-' }}
                                </div>
                            </td>
                            <td class="p-4 flex items-center justify-center gap-2 mt-2">
                                <button onclick="toggleSessions({{ $admin->user_id }})"
                                    class="p-1.5 bg-green-50 text-green-600 rounded hover:bg-green-100 transition"
                                    title="Lihat Sesi Aktif">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                <button onclick="openEditModal({{ json_encode($admin) }})"
                                    class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition"
                                    title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>

                                <form action="{{ route('admin.kelola.destroy', $admin->user_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini beserta fotonya?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <tr id="session-row-{{ $admin->user_id }}" class="hidden bg-slate-50 border-b border-gray-300 shadow-inner">
                            <td colspan="5" class="p-6">
                                <div class="bg-white rounded border border-gray-200 shadow-sm p-4">
                                    <h4 class="font-bold text-gray-700 mb-3 text-sm flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                        Riwayat Sesi Aktif
                                    </h4>

                                    @if(isset($sessions[$admin->user_id]) && count($sessions[$admin->user_id]) > 0)
                                        <table class="w-full text-left text-xs">
                                            <thead class="bg-gray-100 text-gray-600">
                                                <tr>
                                                    <th class="p-2 rounded-l">IP Address</th>
                                                    <th class="p-2">OS / Platform</th>
                                                    <th class="p-2">Browser</th>
                                                    <th class="p-2 rounded-r">Aktivitas Terakhir</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">
                                                @foreach($sessions[$admin->user_id] as $s)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="p-2 font-mono text-gray-600">{{ $s->ip_address ?? '-' }}</td>
                                                        <td class="p-2">
                                                            <span class="bg-slate-200 text-slate-700 px-2 py-0.5 rounded">{{ $s->os }}</span>
                                                        </td>
                                                        <td class="p-2 text-gray-700 font-medium">{{ $s->browser }}</td>
                                                        <td class="p-2 text-gray-600">{{ $s->last_activity_formatted }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-sm text-gray-500 italic p-2 bg-gray-50 rounded border border-dashed border-gray-300">
                                            Tidak ada sesi aktif yang tercatat untuk admin ini pada saat ini.
                                        </p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MODAL TAMBAH ADMIN ================= -->
    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden max-h-[90vh] flex flex-col">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
                <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Admin Baru</h3>
                <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <!-- WAJIB: enctype="multipart/form-data" -->
            <form action="{{ route('admin.kelola.store') }}" method="POST" enctype="multipart/form-data"
                class="overflow-y-auto">
                @csrf
                <div class="p-6 space-y-4">
                    <!-- Input Upload Foto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profil (Opsional)</label>
                        <input type="file" name="fotoUser" accept="image/png, image/jpeg, image/jpg"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                        <p class="text-[11px] text-gray-500 mt-1">Format: JPG, PNG. Maksimal: 2MB.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="namaLengkapUser" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jkUser" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <!-- UBAH TYPE MENJADI NUMBER -->
                            <input type="number" name="noTelpUser" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="add_pwd" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                        <div>
                            <!-- FIELD BARU: Konfirmasi Password -->
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="add_pwd_confirm" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                    <button type="button" onclick="closeModal('modalTambah')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MODAL EDIT ADMIN ================= -->
    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden max-h-[90vh] flex flex-col">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
                <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Data Admin</h3>
                <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <!-- WAJIB: enctype="multipart/form-data" -->
            <form id="formEdit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <!-- Input Edit Foto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto Profil (Opsional)</label>
                        <input type="file" name="fotoUser" accept="image/png, image/jpeg, image/jpg"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                        <p class="text-[11px] text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto saat ini.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="namaLengkapUser" id="edit_nama" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jkUser" id="edit_jk" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="edit_email" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <!-- UBAH TYPE MENJADI NUMBER -->
                            <input type="number" name="noTelpUser" id="edit_telp" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (Opsional)</label>
                            <input type="password" name="password" id="edit_pwd"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                        <div>
                            <!-- FIELD BARU -->
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="edit_pwd_confirm"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541]">
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-500 mt-1">Kosongkan kedua kolom password jika tidak ingin mengganti.
                    </p>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                        <button type="button" onclick="closeModal('modalEdit')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update
                            Data</button>
                    </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function openEditModal(adminData) {
            let form = document.getElementById('formEdit');
            form.action = `/admin/kelola/${adminData.user_id}`;

            document.getElementById('edit_nama').value = adminData.namaLengkapUser;
            document.getElementById('edit_jk').value = adminData.jkUser;
            document.getElementById('edit_email').value = adminData.email;
            document.getElementById('edit_telp').value = adminData.noTelpUser;

            openModal('modalEdit');
        }

        // Fungsi baru untuk memunculkan dropdown riwayat sesi
        function toggleSessions(userId) {
            const sessionRow = document.getElementById(`session-row-${userId}`);
            const mainRow = document.getElementById(`row-admin-${userId}`);

            if (sessionRow.classList.contains('hidden')) {
                sessionRow.classList.remove('hidden');
                mainRow.classList.add('bg-blue-50'); // Memberikan highlight pada baris utama
            } else {
                sessionRow.classList.add('hidden');
                mainRow.classList.remove('bg-blue-50');
            }
        }
    </script>
@endsection
