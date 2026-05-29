@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Bank Judul Skripsi</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen dan repositori judul skripsi mahasiswa.</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Judul
    </button>
</div>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET" action="{{ route('admin.bank_judul.index') }}" class="flex flex-col lg:flex-row gap-4 justify-between items-center">

        <div class="flex items-center gap-2 w-full lg:w-auto">
            <span class="text-sm font-medium text-gray-700">Tampilkan</span>
            <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-2 py-1.5 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            </select>
            <span class="text-sm font-medium text-gray-700">Baris</span>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <div class="relative w-full sm:w-64">
                <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari Nama Mhs atau Judul..." class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
            </div>

            <select name="sort_by" onchange="this.form.submit()" class="w-full sm:w-auto border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="tanggalSeminarBJS" {{ $sortBy == 'tanggalSeminarBJS' ? 'selected' : '' }}>Urut: Tanggal Seminar</option>
                <option value="namaMhsBJS" {{ $sortBy == 'namaMhsBJS' ? 'selected' : '' }}>Urut: Nama Mahasiswa</option>
            </select>

            <select name="sort_order" onchange="this.form.submit()" class="w-full sm:w-auto border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Terbaru / Z-A</option>
                <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Terlama / A-Z</option>
            </select>

            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition">Cari</button>
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
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-4">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold w-12 text-center">No</th>
                    <th class="p-4 font-semibold w-36">Tgl Seminar</th>
                    <th class="p-4 font-semibold">Mahasiswa & Judul Skripsi</th>
                    <th class="p-4 font-semibold w-64">Dosen Pembimbing</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($bankJudul as $index => $bjs)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center font-medium text-gray-500">
                        {{ $bankJudul->firstItem() + $index }}
                    </td>
                    <td class="p-4">
                        <span class="inline-block bg-[#E8F1F8] text-[#2A6F97] px-2.5 py-1 rounded text-xs font-bold tracking-wide">
                            {{ \Carbon\Carbon::parse($bjs->tanggalSeminarBJS)->translatedFormat('d M Y') }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base mb-1">{{ $bjs->namaMhsBJS }}</div>
                        <div class="text-gray-700 font-medium leading-snug">"{{ $bjs->judulSkripsiBJS }}"</div>
                        <div class="mt-1.5 inline-block bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">
                            {{ $bjs->metodologiPenelitianBJS }}
                        </div>
                    </td>
                    <td class="p-4 text-gray-700 text-xs">
                        <div class="space-y-1.5">
                            <div class="flex items-start gap-1.5 font-medium">
                                <span class="text-gray-400 font-bold shrink-0">1.</span>
                                @if($bjs->dosen)
                                    <span>{{ $bjs->dosen->namaTP }}</span>
                                @else
                                    <span class="italic text-gray-400">Belum diatur</span>
                                @endif
                            </div>
                            <div class="flex items-start gap-1.5 font-medium">
                                <span class="text-gray-400 font-bold shrink-0">2.</span>
                                @if($bjs->dosen2)
                                    <span>{{ $bjs->dosen2->namaTP }}</span>
                                @else
                                    <span class="italic text-gray-400">Belum diatur</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="p-4 flex items-center justify-center gap-2">
                        <button onclick="openEditModal({{ json_encode($bjs) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.bank_judul.destroy', $bjs->idBJS) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        @if($search)
                            Pencarian "<b>{{ $search }}</b>" tidak ditemukan.
                        @else
                            Belum ada data bank judul skripsi.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $bankJudul->links() }}
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Judul Skripsi</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.bank_judul.store') }}" method="POST" class="overflow-y-auto">
            @csrf
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa <span class="text-red-500">*</span></label>
                    <input type="text" name="namaMhsBJS" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Skripsi <span class="text-red-500">*</span></label>
                    <textarea name="judulSkripsiBJS" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Seminar <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggalSeminarBJS" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Metodologi <span class="text-red-500">*</span></label>
                    <select name="metodologiPenelitianBJS" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                        <option value="Kualitatif">Kualitatif</option>
                        <option value="Kuantitatif">Kuantitatif</option>
                        <option value="Campuran">Campuran</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing 1 (Opsional)</label>
                    <select name="dosenPembimbingBJS" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                        <option value="">-- Pilih Pembimbing 1 --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->idTP }}">{{ $d->namaTP }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing 2 (Opsional)</label>
                    <select name="dosenPembimbingBJS2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                        <option value="">-- Pilih Pembimbing 2 --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->idTP }}">{{ $d->namaTP }}</option>
                        @endforeach
                    </select>
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
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Judul Skripsi</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST" class="overflow-y-auto">
            @csrf @method('PUT')
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa <span class="text-red-500">*</span></label>
                    <input type="text" name="namaMhsBJS" id="edit_nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Skripsi <span class="text-red-500">*</span></label>
                    <textarea name="judulSkripsiBJS" id="edit_judul" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Seminar <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggalSeminarBJS" id="edit_tanggal" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Metodologi <span class="text-red-500">*</span></label>
                    <select name="metodologiPenelitianBJS" id="edit_metode" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                        <option value="Kualitatif">Kualitatif</option>
                        <option value="Kuantitatif">Kuantitatif</option>
                        <option value="Campuran">Campuran</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing 1 (Opsional)</label>
                    <select name="dosenPembimbingBJS" id="edit_dosen" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                        <option value="">-- Pilih Pembimbing 1 --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->idTP }}">{{ $d->namaTP }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing 2 (Opsional)</label>
                    <select name="dosenPembimbingBJS2" id="edit_dosen2" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                        <option value="">-- Pilih Pembimbing 2 --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->idTP }}">{{ $d->namaTP }}</option>
                        @endforeach
                    </select>
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
        form.action = `/admin/kemahasiswaan/bank-judul/${data.idBJS}`;

        document.getElementById('edit_nama').value = data.namaMhsBJS || '';
        document.getElementById('edit_judul').value = data.judulSkripsiBJS || '';
        document.getElementById('edit_tanggal').value = data.tanggalSeminarBJS || '';
        document.getElementById('edit_metode').value = data.metodologiPenelitianBJS || 'Kualitatif';
        document.getElementById('edit_dosen').value = data.dosenPembimbingBJS || '';
        document.getElementById('edit_dosen2').value = data.dosenPembimbingBJS2 || '';

        openModal('modalEdit');
    }
</script>
@endsection
