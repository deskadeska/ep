@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Data Capaian Dosen</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen penghargaan, sertifikasi, dan prestasi tenaga pengajar.</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Capaian
    </button>
</div>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET" action="{{ url()->current() }}" class="flex flex-col lg:flex-row gap-4 items-center">
        <div class="w-full lg:w-1/2 relative">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Dosen atau Judul Capaian..." class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
        </div>

        <div class="w-full lg:w-1/2 flex gap-2">
            <select name="sort_by" class="w-full lg:w-1/3 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="tahunCD" {{ request('sort_by', 'tahunCD') == 'tahunCD' ? 'selected' : '' }}>Urutkan: Tahun</option>
                <option value="judulCD" {{ request('sort_by') == 'judulCD' ? 'selected' : '' }}>Urutkan: Judul</option>
            </select>

            <select name="sort_order" class="w-full lg:w-1/3 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru / Z-A</option>
                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Terlama / A-Z</option>
            </select>

            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition shadow-sm">
                Terapkan
            </button>

            @if(request('search'))
                <a href="{{ url()->current() }}" class="bg-red-50 text-red-600 hover:bg-red-100 font-medium py-2 px-3 rounded-lg text-sm transition border border-red-200" title="Reset Pencarian">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                </a>
            @endif
        </div>
    </form>
</div>

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

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold text-center w-16">ID</th>
                    <th class="p-4 font-semibold w-1/4">Nama Dosen</th>
                    <th class="p-4 font-semibold w-1/3">Judul Capaian & Tingkat</th>
                    <th class="p-4 font-semibold w-1/5">Metadata & Bukti</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($capaianDosen as $cd)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center font-mono font-bold text-gray-500">
                        {{ $cd->idCD }}
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            @if($cd->tenagaPengajar && $cd->tenagaPengajar->urlFotoTP)
                                <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/' . $cd->tenagaPengajar->urlFotoTP) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200 shadow-sm">
                                    {{ substr($cd->tenagaPengajar->namaTP ?? 'A', 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-bold text-gray-800">{{ $cd->tenagaPengajar->namaTP ?? 'Dosen Tidak Ditemukan' }}</div>
                                <div class="text-[11px] text-gray-500">{{ $cd->tenagaPengajar->nipTP ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-[#1E3A5F] text-base mb-1.5">{{ $cd->judulCD }}</div>

                        @php
                            $badgeColor = 'bg-gray-100 text-gray-700 border-gray-200'; // Lokal
                            if($cd->tingkatCD == 'Nasional') $badgeColor = 'bg-green-100 text-green-700 border-green-200';
                            elseif($cd->tingkatCD == 'Internasional') $badgeColor = 'bg-orange-100 text-orange-700 border-orange-200';
                        @endphp
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider border {{ $badgeColor }}">
                            {{ $cd->tingkatCD }}
                        </span>

                        @if($cd->deskripsiCD)
                            <p class="text-xs text-gray-500 mt-2 line-clamp-2" title="{{ $cd->deskripsiCD }}">{{ $cd->deskripsiCD }}</p>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="text-xs text-gray-600 mb-2">
                            <span class="font-semibold text-gray-800">Tahun:</span> {{ $cd->tahunCD }}
                        </div>

                        <div>
                            <span class="font-semibold text-gray-800 text-xs block mb-1">Bukti/Sertifikat:</span>
                            @if($cd->fileSertifikatCD)
                                <a href="{{ asset('assets/admin/uploads/capaian_dosen/' . $cd->fileSertifikatCD) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded transition border border-blue-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                    Lihat File
                                </a>
                            @else
                                <span class="text-[11px] text-gray-400 italic">Tidak ada lampiran</span>
                            @endif
                        </div>
                    </td>
                    <td class="p-4 flex flex-col sm:flex-row items-center justify-center gap-2">
                        <button type="button" data-capaian="{{ json_encode($cd) }}" onclick="openEditModal(this)" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>

                        <form action="{{ route('admin.capaian_dosen.destroy', $cd->idCD) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus capaian dosen ini beserta file lampirannya?');">
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
                    <td colspan="5" class="p-12 text-center text-gray-500">
                        @if(request('search'))
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p>Data capaian dengan kata kunci "<b>{{ request('search') }}</b>" tidak ditemukan.</p>
                                <a href="{{ url()->current() }}" class="mt-4 text-[#2A6F97] font-bold text-xs underline">Lihat Semua Data</a>
                            </div>
                        @else
                            Belum ada data capaian dosen yang ditambahkan ke dalam sistem.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden max-h-[95vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Capaian Dosen</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
            <form action="{{ route('admin.capaian_dosen.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dosen <span class="text-red-500">*</span></label>
                    <select name="idTP" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                        <option value="">-- Pilih Tenaga Pengajar --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->idTP }}">{{ $d->namaTP }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Capaian/Penghargaan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulCD" placeholder="Contoh: Best Presenter International Conference" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat <span class="text-red-500">*</span></label>
                        <select name="tingkatCD" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                            <option value="Lokal">Lokal</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunCD" min="1990" max="{{ date('Y')+1 }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat (Opsional)</label>
                    <textarea name="deskripsiCD" rows="3" placeholder="Jelaskan secara singkat mengenai penghargaan ini..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">File Bukti/Sertifikat (Opsional)</label>
                    <input type="file" name="fileSertifikatCD" accept=".pdf,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                    <p class="text-[11px] text-gray-500 mt-1">Format: PDF, JPG, PNG. Maksimal: 5MB.</p>
                </div>

            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden max-h-[95vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Capaian Dosen</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dosen <span class="text-red-500">*</span></label>
                    <select name="idTP" id="edit_idTP" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                        <option value="">-- Pilih Tenaga Pengajar --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->idTP }}">{{ $d->namaTP }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Capaian/Penghargaan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulCD" id="edit_judul" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat <span class="text-red-500">*</span></label>
                        <select name="tingkatCD" id="edit_tingkat" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                            <option value="Lokal">Lokal</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunCD" id="edit_tahun" min="1990" max="{{ date('Y')+1 }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat (Opsional)</label>
                    <textarea name="deskripsiCD" id="edit_deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]"></textarea>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti File Bukti (Opsional)</label>
                    <input type="file" name="fileSertifikatCD" accept=".pdf,.jpg,.jpeg,.png" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100 bg-white">
                    <p class="text-[11px] text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file yang sudah ada.</p>
                </div>

            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update Data</button>
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
        let cd = JSON.parse(button.getAttribute('data-capaian'));

        let form = document.getElementById('formEdit');
        form.action = `/admin/prodi/capaian-dosen/${cd.idCD}`; // Pastikan URL ini cocok dengan struktur route Anda

        document.getElementById('edit_idTP').value = cd.idTP;
        document.getElementById('edit_judul').value = cd.judulCD;
        document.getElementById('edit_tingkat').value = cd.tingkatCD;
        document.getElementById('edit_tahun').value = cd.tahunCD;
        document.getElementById('edit_deskripsi').value = cd.deskripsiCD || '';

        openModal('modalEdit');
    }
</script>
@endsection
