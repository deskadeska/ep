@extends('admin.layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold" style="color: var(--navy);">Keperluan Tugas Akhir</h1>
            <p class="text-sm mt-1" style="color: var(--caption);">Manajemen kategori, syarat, dan dokumen keperluan tugas
                akhir mahasiswa.</p>
        </div>
        <button onclick="openModal('modalTambah')"
            class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kelompok
        </button>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
            <p class="text-sm font-medium">{{ session('success') }}</p>
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

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-5xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                        <th class="p-4 font-semibold w-16 text-center">No</th>
                        <th class="p-4 font-semibold">Kelompok / Kategori Keperluan</th>
                        <th class="p-4 font-semibold text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($keperluan as $index => $k)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-center font-medium text-gray-500">
                                {{ $index + 1 }}
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-800 text-base">{{ $k->kelompokKTA }}</div>
                            </td>
                            <td class="p-4 flex items-center justify-center gap-2">
                                <a href="{{ route('admin.tugas_akhir.detail', $k->idKTA) }}"
                                    class="p-1.5 bg-indigo-50 text-indigo-600 rounded hover:bg-indigo-100 transition"
                                    title="Lihat Detail Item">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                                <button onclick="openEditModal({{ json_encode($k) }})"
                                    class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition"
                                    title="Edit Kelompok">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>

                                <form action="{{ route('admin.tugas_akhir.destroy', $k->idKTA) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kelompok ini? Semua data detail di dalamnya mungkin akan ikut terhapus.');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition"
                                        title="Hapus Kelompok">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-gray-500">Belum ada data kelompok keperluan tugas
                                akhir.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md overflow-hidden flex flex-col">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
                <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Kelompok KTA</h3>
                <button onclick="closeModal('modalTambah')"
                    class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            </div>
            <form action="{{ route('admin.tugas_akhir.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kelompok / Kategori <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="kelompokKTA" required placeholder="Contoh: Dokumen Pendaftaran Skripsi"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalTambah')"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md overflow-hidden flex flex-col">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
                <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Kelompok KTA</h3>
                <button onclick="closeModal('modalEdit')"
                    class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            </div>
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kelompok / Kategori <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="kelompokKTA" id="edit_kelompok" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
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

        function openEditModal(data) {
            const form = document.getElementById('formEdit');
            // Action diarahkan ke endpoint update dengan parameter idKTA
            form.action = `/admin/akademik/tugas-akhir/${data.idKTA}`;
            document.getElementById('edit_kelompok').value = data.kelompokKTA || '';
            openModal('modalEdit');
        }
    </script>
@endsection
