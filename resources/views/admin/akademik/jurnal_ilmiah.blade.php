@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Data Jurnal Ilmiah</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen direktori dan tautan jurnal publikasi.</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Jurnal
    </button>
</div>

<!-- Form Pencarian -->
<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET" action="{{ url()->current() }}" class="flex flex-col sm:flex-row gap-4 items-center">
        <div class="w-full relative flex-grow">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Jurnal Ilmiah..." class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
        </div>

        <button type="submit" class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-lg text-sm transition shadow-sm">
            Cari
        </button>

        @if(request('search'))
            <a href="{{ url()->current() }}" class="w-full sm:w-auto bg-red-50 text-red-600 hover:bg-red-100 font-medium py-2 px-4 rounded-lg text-sm transition border border-red-200 text-center" title="Reset Pencarian">
                Reset
            </a>
        @endif
    </form>
</div>

<!-- Alert Notifikasi -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
@endif
@if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <p class="font-bold text-sm mb-1">Gagal menyimpan data:</p>
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<!-- Tabel Data -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold text-center w-16">ID</th>
                    <th class="p-4 font-semibold w-32 text-center">Sampul</th>
                    <th class="p-4 font-semibold">Nama Jurnal & Tautan</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($jurnalIlmiah as $ji)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center font-mono font-bold text-gray-500">
                        {{ $ji->idJI }}
                    </td>
                    <td class="p-4">
                        @if($ji->sampulJI)
                            <a href="{{ asset('assets/admin/uploads/jurnal/' . $ji->sampulJI) }}" target="_blank" class="block w-20 h-24 mx-auto rounded border border-gray-200 shadow-sm overflow-hidden bg-gray-100 hover:opacity-80 transition">
                                <img src="{{ asset('assets/admin/uploads/jurnal/' . $ji->sampulJI) }}" alt="Sampul" class="w-full h-full object-cover">
                            </a>
                        @else
                            <div class="w-20 h-24 mx-auto rounded border border-dashed border-gray-300 bg-gray-50 flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-[#1E3A5F] text-base mb-1">{{ $ji->namaJI }}</div>
                        <a href="{{ $ji->linkJI }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded transition border border-blue-100 break-all">
                            Buka Tautan <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                        <div class="text-xs text-gray-500 mt-1">{{ $ji->linkJI }}</div>
                    </td>
                    <td class="p-4 flex flex-col sm:flex-row items-center justify-center gap-2">
                        <button type="button" data-jurnal="{{ json_encode($ji) }}" onclick="openEditModal(this)" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>

                        <!-- PENTING: Ubah URL Route Hapus ini sesuai web.php Anda (misal admin.akademik.jurnal_ilmiah.destroy) -->
                        <form action="{{ route('admin.akademik.jurnal_ilmiah.destroy', $ji->idJI) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ini beserta file gambarnya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-12 text-center text-gray-500">
                        @if(request('search'))
                            <p>Data jurnal dengan kata kunci "<b>{{ request('search') }}</b>" tidak ditemukan.</p>
                            <a href="{{ url()->current() }}" class="mt-2 inline-block text-[#2A6F97] font-bold text-xs underline">Lihat Semua Data</a>
                        @else
                            <p>Belum ada data jurnal ilmiah yang ditambahkan.</p>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH JURNAL -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden max-h-[95vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Jurnal Ilmiah</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>

        <!-- ENCTYPE MULTIPART WAJIB ADA UNTUK UPLOAD FILE -->
        <!-- PENTING: Ubah URL Route Store ini sesuai web.php Anda -->
        <form action="{{ route('admin.akademik.jurnal_ilmiah.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jurnal <span class="text-red-500">*</span></label>
                    <input type="text" name="namaJI" placeholder="Contoh: Jurnal Ekonomi Pembangunan" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan / Link Jurnal <span class="text-red-500">*</span></label>
                    <input type="url" name="linkJI" placeholder="Contoh: https://jurnal.upr.ac.id/..." required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Sampul <span class="text-red-500">*</span></label>
                    <input type="file" name="sampulJI" accept=".jpg,.jpeg,.png,.webp" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100 bg-gray-50">
                    <p class="text-[11px] text-gray-500 mt-1">Format didukung: JPG, PNG, WEBP. Maksimal ukuran: 5MB.</p>
                </div>

            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Jurnal</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT JURNAL -->
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden max-h-[95vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Jurnal Ilmiah</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jurnal <span class="text-red-500">*</span></label>
                    <input type="text" name="namaJI" id="edit_nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tautan / Link Jurnal <span class="text-red-500">*</span></label>
                    <input type="url" name="linkJI" id="edit_link" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Sampul (Opsional)</label>
                    <input type="file" name="sampulJI" accept=".jpg,.jpeg,.png,.webp" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-white file:border-gray-300 file:border file:text-gray-700 hover:file:bg-gray-100 bg-white">
                    <p class="text-[11px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar sampul yang sudah ada.</p>
                </div>

            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update Jurnal</button>
            </div>
        </form>
    </div>
</div>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(button) {
        let ji = JSON.parse(button.getAttribute('data-jurnal'));

        let form = document.getElementById('formEdit');
        // PENTING: Pastikan URL /admin/akademik/jurnal-ilmiah ini sesuai dengan struktur web.php Anda
        form.action = `/admin/akademik/jurnal-ilmiah/${ji.idJI}`;

        document.getElementById('edit_nama').value = ji.namaJI;
        document.getElementById('edit_link').value = ji.linkJI;

        openModal('modalEdit');
    }
</script>
@endsection
