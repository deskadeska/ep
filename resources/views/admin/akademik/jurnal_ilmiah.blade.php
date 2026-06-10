@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Data Jurnal Ilmiah</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen publikasi, penulis (dosen & mahasiswa), dan metadata jurnal.</p>
    </div>
    <button onclick="openModalTambah()" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Jurnal
    </button>
</div>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET" action="{{ route('admin.akademik.jurnal_ilmiah') }}" class="flex flex-col lg:flex-row gap-4 items-center">
        <div class="w-full lg:w-1/2 relative">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Judul Jurnal atau Penerbit..." class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
        </div>

        <div class="w-full lg:w-1/2 flex gap-2">
            <select name="sort_by" class="w-full lg:w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="tahunPublikasiJI" {{ request('sort_by', 'tahunPublikasiJI') == 'tahunPublikasiJI' ? 'selected' : '' }}>Urutkan: Tahun Publikasi</option>
                <option value="judulJI" {{ request('sort_by') == 'judulJI' ? 'selected' : '' }}>Urutkan: Judul Jurnal</option>
            </select>

            <select name="sort_order" class="w-full lg:w-1/3 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru / Z-A</option>
                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Terlama / A-Z</option>
            </select>

            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition shadow-sm">
                Terapkan
            </button>

            @if(request('search'))
                <a href="{{ route('admin.akademik.jurnal_ilmiah') }}" class="bg-red-50 text-red-600 hover:bg-red-100 font-medium py-2 px-3 rounded-lg text-sm transition border border-red-200" title="Reset Pencarian">
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
                    <th class="p-4 font-semibold w-1/3">Judul & Penerbit</th>
                    <th class="p-4 font-semibold w-1/4">Penulis (Dosen & Mahasiswa)</th>
                    <th class="p-4 font-semibold">Metadata</th>
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
                        <div class="font-bold text-gray-800 text-base mb-1">{{ $ji->judulJI }}</div>
                        <div class="text-xs text-[#2A6F97] font-semibold flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            {{ $ji->jurnalPenerbitJI }}
                        </div>
                    </td>
                    <td class="p-4 align-top">
                        <div class="space-y-3">
                            @if($ji->tenagaPengajar && $ji->tenagaPengajar->count() > 0)
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-blue-500 block mb-1">Dosen:</span>
                                <ul class="text-xs text-gray-700 space-y-2">
                                    @foreach($ji->tenagaPengajar as $dosen)
                                        <li class="flex items-start justify-between gap-2 border-b border-gray-100 pb-1 last:border-0 last:pb-0">
                                            <div class="flex items-center gap-1.5 font-medium">
                                                <div class="w-1.5 h-1.5 rounded-full {{ $dosen->pivot->rolePenulis == 'Penulis Pertama' ? 'bg-orange-500' : 'bg-blue-500' }}"></div>
                                                {{ $dosen->namaTP }}
                                            </div>
                                            <span class="text-[9px] bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded border border-gray-200 whitespace-nowrap">{{ $dosen->pivot->rolePenulis }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @php
                                $mahasiswaList = is_string($ji->namaMahasiswaJI) ? json_decode($ji->namaMahasiswaJI, true) : $ji->namaMahasiswaJI;
                            @endphp
                            @if(!empty($mahasiswaList))
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-orange-500 block mb-1">Mahasiswa:</span>
                                <ul class="list-disc pl-4 text-xs text-gray-700 space-y-1">
                                    @foreach($mahasiswaList as $mhs)
                                        <li>{{ $mhs }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if((!$ji->tenagaPengajar || $ji->tenagaPengajar->count() == 0) && empty($mahasiswaList))
                                <span class="text-xs italic text-gray-400">Tidak ada data penulis</span>
                            @endif
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-xs text-gray-600 mb-1">
                            <span class="font-semibold text-gray-800">Tahun:</span> {{ $ji->tahunPublikasiJI }}
                        </div>
                        <div class="text-xs text-gray-600 mb-2">
                            <span class="font-semibold text-gray-800">DOI:</span>
                            <a href="{{ Str::startsWith($ji->doiJI, 'http') ? $ji->doiJI : 'https://doi.org/' . $ji->doiJI }}" target="_blank" class="text-blue-600 hover:underline">{{ $ji->doiJI }}</a>
                        </div>
                        <div class="flex flex-wrap gap-1">
                            @foreach(explode(',', $ji->keywordJI) as $kw)
                                <span class="bg-gray-100 border border-gray-200 text-gray-600 px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wider">{{ trim($kw) }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="p-4 flex flex-col sm:flex-row items-center justify-center gap-2">
                        <button type="button" data-jurnal="{{ json_encode($ji) }}" onclick="openEditModal(this)" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>

                        <form action="{{ route('admin.akademik.jurnal_ilmiah.destroy', $ji->idJI) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ilmiah ini?');">
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
                                <p>Jurnal Ilmiah "<b>{{ request('search') }}</b>" tidak ditemukan.</p>
                                <a href="{{ route('admin.akademik.jurnal_ilmiah') }}" class="mt-4 text-[#2A6F97] font-bold text-xs underline">Lihat Semua Jurnal</a>
                            </div>
                        @else
                            Belum ada data jurnal ilmiah yang terdaftar di sistem.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl overflow-hidden max-h-[95vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Jurnal Ilmiah</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('admin.akademik.jurnal_ilmiah.store') }}" method="POST" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Jurnal <span class="text-red-500">*</span></label>
                        <input type="text" name="judulJI" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit Jurnal <span class="text-red-500">*</span></label>
                        <input type="text" name="jurnalPenerbitJI" placeholder="Contoh: Jurnal Ekonomi Pembangunan" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Publikasi <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunPublikasiJI" min="2000" max="{{ date('Y')+1 }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keywords <span class="text-red-500">*</span></label>
                        <input type="text" name="keywordJI" placeholder="Pisahkan dengan koma (contoh: Ekonomi, Mikro)" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">DOI <span class="text-red-500">*</span></label>
                        <input type="text" name="doiJI" placeholder="10.xxxx/xxxxx" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Abstrak <span class="text-red-500">*</span></label>
                        <textarea name="abstrakJI" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-sm font-bold text-[#1E3A5F]">Penulis Dosen</label>
                            <button type="button" onclick="addDosenRow('tambah_dosen_container')" class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2.5 py-1.5 rounded-lg font-semibold transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Dosen
                            </button>
                        </div>
                        <div id="tambah_dosen_container" class="space-y-2"></div>
                    </div>

                    <div class="bg-orange-50/50 p-4 rounded-xl border border-orange-100">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-sm font-bold text-[#d4882e]">Penulis Mahasiswa</label>
                            <button type="button" onclick="addMahasiswaRow('tambah_mhs_container')" class="text-xs bg-orange-100 text-orange-700 hover:bg-orange-200 px-2.5 py-1.5 rounded-lg font-semibold transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Mahasiswa
                            </button>
                        </div>
                        <div id="tambah_mhs_container" class="space-y-2"></div>
                    </div>
                </div>
                <p class="text-xs text-gray-500 italic bg-gray-50 p-2 rounded border border-dashed border-gray-300">
                    <b>Catatan:</b> Minimal salah satu penulis (Dosen atau Mahasiswa) wajib diisi. Kosongkan/hapus baris jika tidak ada.
                </p>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Jurnal</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl overflow-hidden max-h-[95vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Jurnal Ilmiah</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="formEdit" method="POST" class="overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Jurnal <span class="text-red-500">*</span></label>
                        <input type="text" name="judulJI" id="edit_judul" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit Jurnal <span class="text-red-500">*</span></label>
                        <input type="text" name="jurnalPenerbitJI" id="edit_penerbit" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Publikasi <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunPublikasiJI" id="edit_tahun" min="2000" max="{{ date('Y')+1 }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keywords <span class="text-red-500">*</span></label>
                        <input type="text" name="keywordJI" id="edit_keyword" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">DOI <span class="text-red-500">*</span></label>
                        <input type="text" name="doiJI" id="edit_doi" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Abstrak <span class="text-red-500">*</span></label>
                        <textarea name="abstrakJI" id="edit_abstrak" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-sm font-bold text-[#1E3A5F]">Penulis Dosen</label>
                            <button type="button" onclick="addDosenRow('edit_dosen_container')" class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-2.5 py-1.5 rounded-lg font-semibold transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Dosen
                            </button>
                        </div>
                        <div id="edit_dosen_container" class="space-y-2"></div>
                    </div>

                    <div class="bg-orange-50/50 p-4 rounded-xl border border-orange-100">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-sm font-bold text-[#d4882e]">Penulis Mahasiswa</label>
                            <button type="button" onclick="addMahasiswaRow('edit_mhs_container')" class="text-xs bg-orange-100 text-orange-700 hover:bg-orange-200 px-2.5 py-1.5 rounded-lg font-semibold transition flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Mahasiswa
                            </button>
                        </div>
                        <div id="edit_mhs_container" class="space-y-2"></div>
                    </div>
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
    const listDosen = @json($dosen ?? []);

    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openModalTambah() {
        document.getElementById('tambah_dosen_container').innerHTML = '';
        document.getElementById('tambah_mhs_container').innerHTML = '';

        addDosenRow('tambah_dosen_container', '', 'Penulis Pertama');
        addMahasiswaRow('tambah_mhs_container');

        openModal('modalTambah');
    }

    function openEditModal(button) {
        let ji = JSON.parse(button.getAttribute('data-jurnal'));

        let form = document.getElementById('formEdit');
        form.action = `/admin/akademik/jurnal-ilmiah/${ji.idJI}`;

        document.getElementById('edit_judul').value = ji.judulJI;
        document.getElementById('edit_penerbit').value = ji.jurnalPenerbitJI;
        document.getElementById('edit_tahun').value = ji.tahunPublikasiJI;
        document.getElementById('edit_keyword').value = ji.keywordJI;
        document.getElementById('edit_doi').value = ji.doiJI;
        document.getElementById('edit_abstrak').value = ji.abstrakJI;

        // Render Baris Dosen (Dari Pivot Table Collection)
        const containerDosen = document.getElementById('edit_dosen_container');
        containerDosen.innerHTML = '';
        if (ji.tenaga_pengajar && ji.tenaga_pengajar.length > 0) {
            ji.tenaga_pengajar.forEach(tp => {
                addDosenRow('edit_dosen_container', tp.idTP, tp.pivot.rolePenulis);
            });
        } else {
            addDosenRow('edit_dosen_container');
        }

        // Render Baris Mahasiswa (Dari JSON)
        const containerMhs = document.getElementById('edit_mhs_container');
        containerMhs.innerHTML = '';

        let mhsArray = [];
        try {
            mhsArray = typeof ji.namaMahasiswaJI === 'string' ? JSON.parse(ji.namaMahasiswaJI) : (ji.namaMahasiswaJI || []);
        } catch(e) {}

        if (mhsArray && mhsArray.length > 0) {
            mhsArray.forEach(mhsName => {
                addMahasiswaRow('edit_mhs_container', mhsName);
            });
        } else {
            addMahasiswaRow('edit_mhs_container');
        }

        openModal('modalEdit');
    }

    function addDosenRow(containerId, selectedId = '', selectedRole = 'Penulis Anggota') {
        const container = document.getElementById(containerId);
        const row = document.createElement('div');
        row.className = 'flex flex-col xl:flex-row items-start xl:items-center gap-2';

        let optionsHtml = '<option value="">-- Pilih Dosen (Opsional) --</option>';
        listDosen.forEach(d => {
            let isSelected = (d.idTP == selectedId) ? 'selected' : '';
            optionsHtml += `<option value="${d.idTP}" ${isSelected}>${d.namaTP}</option>`;
        });

        // Menambahkan Pilihan Role Penulis
        row.innerHTML = `
            <select name="idTP[]" class="w-full xl:flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                ${optionsHtml}
            </select>
            <div class="flex gap-2 w-full xl:w-auto">
                <select name="rolePenulis[]" class="flex-1 xl:w-40 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                    <option value="Penulis Pertama" ${selectedRole == 'Penulis Pertama' ? 'selected' : ''}>Penulis Pertama</option>
                    <option value="Penulis Anggota" ${selectedRole == 'Penulis Anggota' ? 'selected' : ''}>Penulis Anggota</option>
                    <option value="Corresponding Author" ${selectedRole == 'Corresponding Author' ? 'selected' : ''}>Corresponding Author</option>
                </select>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 p-2 text-red-500 hover:bg-red-100 rounded-lg transition" title="Hapus">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    function addMahasiswaRow(containerId, value = '') {
        const container = document.getElementById(containerId);
        const row = document.createElement('div');
        row.className = 'flex items-center gap-2';

        row.innerHTML = `
            <input type="text" name="namaMahasiswaJI[]" value="${value}" placeholder="Nama Mahasiswa (Opsional)" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
            <button type="button" onclick="this.parentElement.remove()" class="flex-shrink-0 p-2 text-red-500 hover:bg-red-100 rounded-lg transition" title="Hapus">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        `;
        container.appendChild(row);
    }
</script>
@endsection
