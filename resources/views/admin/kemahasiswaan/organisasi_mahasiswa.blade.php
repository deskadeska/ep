@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Organisasi Mahasiswa</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen profil dan dokumentasi HIMA, BEM, atau Unit Kegiatan Mahasiswa.</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Ormawa
    </button>
</div>

<!-- Alert Notifikasi -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
@endif

<!-- Tabel Data -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold w-24 text-center">Logo</th>
                    <th class="p-4 font-semibold">Nama & Deskripsi</th>
                    <th class="p-4 font-semibold w-32 text-center">Foto Anggota</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($ormawa as $o)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center">
                        @if($o->fotoLogoUrlOrmawa)
                            <img src="{{ asset('assets/admin/uploads/ormawa/' . $o->fotoLogoUrlOrmawa) }}" alt="Logo" class="w-16 h-16 rounded-full object-cover mx-auto border border-gray-200 shadow-sm bg-white">
                        @else
                            <div class="w-16 h-16 rounded-full bg-gray-100 mx-auto flex items-center justify-center border border-gray-200 shadow-sm text-gray-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" /></svg>
                            </div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base mb-1">{{ $o->namaOrmawa }}</div>
                        <div class="text-xs text-gray-500 leading-relaxed line-clamp-2" title="{{ $o->deskripsiOrmawa }}">
                            {{ $o->deskripsiOrmawa ?? 'Belum ada deskripsi.' }}
                        </div>
                    </td>
                    <td class="p-4 text-center">
                        @if($o->fotoAnggotaUrlOrmawa)
                            <img src="{{ asset('assets/admin/uploads/ormawa/' . $o->fotoAnggotaUrlOrmawa) }}" alt="Anggota" class="w-20 h-14 rounded-lg object-cover mx-auto border border-gray-200 shadow-sm hover:scale-150 transition-transform origin-center cursor-zoom-in" title="Arahkan kursor untuk memperbesar">
                        @else
                            <span class="text-xs text-gray-400 italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="p-4 flex items-center justify-center gap-2">
                        <button onclick="openEditModal({{ json_encode($o) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.organisasi.destroy', $o->idOrmawa) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data Organisasi ini beserta file-filenya?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">Belum ada data organisasi mahasiswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Organisasi Mahasiswa</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.organisasi.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Organisasi <span class="text-red-500">*</span></label>
                    <input type="text" name="namaOrmawa" required placeholder="Contoh: BEM Fakultas Ekonomi" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="deskripsiOrmawa" rows="3" placeholder="Jelaskan secara singkat mengenai organisasi ini..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Logo Ormawa</label>
                        <input type="file" name="fotoLogoUrlOrmawa" accept="image/*" class="w-full border border-gray-300 bg-white rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-500 mt-1">Disarankan: Persegi (1:1), maks 2MB.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Bersama/Anggota</label>
                        <input type="file" name="fotoAnggotaUrlOrmawa" accept="image/*" class="w-full border border-gray-300 bg-white rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-500 mt-1">Disarankan: Landscape, maks 2MB.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Organisasi Mahasiswa</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Organisasi <span class="text-red-500">*</span></label>
                    <input type="text" name="namaOrmawa" id="edit_nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="deskripsiOrmawa" id="edit_deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-200 mt-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Logo Ormawa</label>
                        <input type="file" name="fotoLogoUrlOrmawa" accept="image/*" class="w-full border border-gray-300 bg-white rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah logo.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto Bersama</label>
                        <input type="file" name="fotoAnggotaUrlOrmawa" accept="image/*" class="w-full border border-gray-300 bg-white rounded-lg px-3 py-2 text-sm file:mr-3 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto anggota.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(data) {
        const form = document.getElementById('formEdit');
        form.action = `/admin/kemahasiswaan/organisasi/${data.idOrmawa}`;

        document.getElementById('edit_nama').value = data.namaOrmawa || '';
        document.getElementById('edit_deskripsi').value = data.deskripsiOrmawa || '';

        openModal('modalEdit');
    }
</script>
@endsection
