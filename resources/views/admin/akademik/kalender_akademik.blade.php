@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Kalender Akademik</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen jadwal dan kegiatan akademik program studi.</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('admin.tahun_ajaran.index') }}" class="bg-[#E8F1F8] hover:bg-[#d6e6f4] text-[#2A6F97] font-semibold py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition border border-[#b8d4eb]">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            Kelola Tahun Ajaran
        </a>

        <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center justify-center gap-2 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kegiatan
        </button>
    </div>
</div>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6 flex items-center gap-4">
    <label class="font-semibold text-gray-700 whitespace-nowrap">Pilih Tahun Ajaran:</label>
    <form method="GET" action="{{ route('admin.kalender.index') }}" class="w-full sm:w-64">
        <select name="idTA" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541] font-medium text-gray-800">
            @forelse($tahunAjarans as $ta)
                <option value="{{ $ta->idTA }}" {{ $selectedTA == $ta->idTA ? 'selected' : '' }}>
                    {{ $ta->tahunAkademikTA }}
                </option>
            @empty
                <option value="">Belum ada Tahun Ajaran</option>
            @endforelse
        </select>
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

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold w-12 text-center">No</th>
                    <th class="p-4 font-semibold w-64">Waktu Kegiatan</th>
                    <th class="p-4 font-semibold">Nama Kegiatan / Agenda</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($kalender as $index => $k)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-center font-medium text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="p-4">
                        <span class="inline-block bg-[#E8F1F8] text-[#2A6F97] px-3 py-1.5 rounded-lg text-xs font-bold tracking-wide">
                            {{ \Carbon\Carbon::parse($k->tanggalMulaiKA)->translatedFormat('d M Y') }}
                            @if($k->tanggalSelesaiKA)
                                <span class="mx-1">-</span> {{ \Carbon\Carbon::parse($k->tanggalSelesaiKA)->translatedFormat('d M Y') }}
                            @endif
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base">{{ $k->kegiatanKA }}</div>
                        <div class="text-[11px] text-gray-500 mt-1 uppercase tracking-wider font-semibold">Tahun Akademik: {{ $k->tahunAjaran->tahunAkademikTA ?? '-' }}</div>
                    </td>
                    <td class="p-4 flex items-center justify-center gap-2">
                        <button onclick="openEditModal({{ json_encode($k) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.kalender.destroy', $k->idKA) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus agenda ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">Belum ada agenda pada tahun ajaran ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Agenda Akademik</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.kalender.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                    <select name="tahunAjaranKA" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                        @foreach($tahunAjarans as $ta)
                            <option value="{{ $ta->idTA }}" {{ $selectedTA == $ta->idTA ? 'selected' : '' }}>
                                {{ $ta->tahunAkademikTA }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan / Agenda <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatanKA" required placeholder="Contoh: Batas Akhir KRS" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggalMulaiKA" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="date" name="tanggalSelesaiKA" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Agenda</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Agenda Akademik</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST">
            @csrf @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                    <select name="tahunAjaranKA" id="edit_tahun_ajaran" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                        @foreach($tahunAjarans as $ta)
                            <option value="{{ $ta->idTA }}">
                                {{ $ta->tahunAkademikTA }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan / Agenda <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatanKA" id="edit_kegiatan" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggalMulaiKA" id="edit_tanggalMulai" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="date" name="tanggalSelesaiKA" id="edit_tanggalSelesai" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none focus:border-[#F2A541]">
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update Agenda</button>
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
        form.action = `/admin/akademik/kalender/${data.idKA}`;

        document.getElementById('edit_tahun_ajaran').value = data.tahunAjaranKA;
        document.getElementById('edit_kegiatan').value = data.kegiatanKA;
        document.getElementById('edit_tanggalMulai').value = data.tanggalMulaiKA;
        document.getElementById('edit_tanggalSelesai').value = data.tanggalSelesaiKA || ''; // Mengisi jika ada, biarkan kosong jika null

        openModal('modalEdit');
    }
</script>
@endsection
