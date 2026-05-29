@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Panduan Akademik</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen berkas panduan dan prosedur akademik mahasiswa.</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Panduan
    </button>
</div>

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

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold w-12 text-center">No</th>
                    <th class="p-4 font-semibold">Judul Panduan</th>
                    <th class="p-4 font-semibold">Detail Berkas</th>
                    <th class="p-4 font-semibold">Waktu Sistem</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($panduan as $index => $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center font-medium text-gray-500">{{ $index + 1 }}</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base">{{ $p->judulPA }}</div>
                    </td>
                    <td class="p-4">
                        @if($p->urlFilePA)
                            @php
                                // Logika pengecekan ukuran file fisik
                                $filePath = public_path('assets/admin/uploads/panduan/' . $p->urlFilePA);
                                $fileSize = file_exists($filePath) ? filesize($filePath) : 0;

                                // Konversi ke KB atau MB
                                if ($fileSize > 1048576) {
                                    $sizeText = round($fileSize / 1048576, 2) . ' MB';
                                } elseif ($fileSize > 1024) {
                                    $sizeText = round($fileSize / 1024, 2) . ' KB';
                                } else {
                                    $sizeText = $fileSize . ' Bytes';
                                }
                            @endphp

                            <a href="{{ asset('assets/admin/uploads/panduan/' . $p->urlFilePA) }}" target="_blank" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-medium mb-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                Lihat Dokumen
                            </a>
                            <div class="text-[11px] text-gray-500 font-medium">Ukuran: <span class="text-gray-700">{{ $sizeText }}</span></div>
                        @else
                            <span class="text-gray-400 italic text-xs">File tidak ditemukan</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="text-xs text-gray-600">
                            <span class="font-semibold text-gray-800">Dibuat:</span><br>
                            {{ $p->created_at ? $p->created_at->translatedFormat('d M Y, H:i') : '-' }}
                        </div>
                        <div class="text-xs text-gray-600 mt-1.5">
                            <span class="font-semibold text-gray-800">Diedit:</span><br>
                            {{ $p->updated_at ? $p->updated_at->translatedFormat('d M Y, H:i') : '-' }}
                        </div>
                    </td>
                    <td class="p-4 flex items-center justify-center gap-2">
                        <button onclick="openEditModal({{ json_encode($p) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.panduan.destroy', $p->idPA) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus panduan ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada berkas panduan akademik.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Panduan Akademik</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.panduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Panduan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulPA" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Berkas (PDF/DOCX) <span class="text-red-500">*</span></label>
                    <input type="file" name="urlFilePA" required accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                    <p class="text-[11px] text-gray-500 mt-1">Ukuran maksimal 10 MB.</p>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Panduan Akademik</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Panduan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulPA" id="edit_judul" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Berkas (Kosongkan jika tidak ingin ganti)</label>
                    <input type="file" name="urlFilePA" accept=".pdf,.doc,.docx" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                    <p class="text-[11px] text-gray-500 mt-1">Ukuran maksimal 10 MB.</p>
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
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(data) {
        const form = document.getElementById('formEdit');
        form.action = `/admin/akademik/panduan/${data.idPA}`;
        document.getElementById('edit_judul').value = data.judulPA;
        openModal('modalEdit');
    }
</script>
@endsection
