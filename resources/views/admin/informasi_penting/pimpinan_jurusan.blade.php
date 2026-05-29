@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Riwayat Pimpinan Jurusan</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen data Ketua dan Sekretaris Jurusan beserta periode jabatannya.</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Periode
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
                    <th class="p-4 font-semibold w-32 text-center">Periode</th>
                    <th class="p-4 font-semibold">Ketua Jurusan</th>
                    <th class="p-4 font-semibold">Sekretaris Jurusan</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($pimpinan as $pj)
                <tr class="hover:bg-gray-50 transition">

                    <td class="p-4 text-center">
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-md font-bold border border-blue-100 block">
                            {{ $pj->tahunMulaiPJ }} - {{ $pj->tahunSelesaiPJ }}
                        </span>
                    </td>

                    <td class="p-4">
                        @if($pj->ketua)
                        <div class="flex items-center gap-3">
                            <img src="{{ $pj->ketua->urlFotoTP ? asset('assets/admin/uploads/tenaga_pengajar/' . $pj->ketua->urlFotoTP) : asset('assets/images/default-avatar.png') }}"
                                 alt="Foto Ketua"
                                 class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                            <div>
                                <p class="font-bold text-gray-800 text-base">{{ $pj->ketua->namaTP }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">NIP. {{ $pj->ketua->nipTP }}</p>
                            </div>
                        </div>
                        @else
                        <span class="text-xs text-red-500 italic">Data dosen tidak ditemukan</span>
                        @endif
                    </td>

                    <td class="p-4">
                        @if($pj->sekretaris)
                        <div class="flex items-center gap-3">
                            <img src="{{ $pj->sekretaris->urlFotoTP ? asset('assets/admin/uploads/tenaga_pengajar/' . $pj->sekretaris->urlFotoTP) : asset('assets/images/default-avatar.png') }}"
                                 alt="Foto Sekretaris"
                                 class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                            <div>
                                <p class="font-bold text-gray-800 text-base">{{ $pj->sekretaris->namaTP }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">NIP. {{ $pj->sekretaris->nipTP }}</p>
                            </div>
                        </div>
                        @else
                        <span class="text-xs text-red-500 italic">Data dosen tidak ditemukan</span>
                        @endif
                    </td>

                    <td class="p-4 flex items-center justify-center gap-2 mt-2">
                        <button onclick="openEditModal({{ json_encode($pj) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.pimpinan_jurusan.destroy', $pj->idPJ) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data riwayat pimpinan jurusan ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">Belum ada riwayat pimpinan jurusan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Pimpinan Jurusan</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.pimpinan_jurusan.store') }}" method="POST" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Mulai Jabatan <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunMulaiPJ" required placeholder="Contoh: 2020" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Selesai Jabatan <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunSelesaiPJ" required placeholder="Contoh: 2024" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                    </div>
                </div>

                <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1">Pilih Ketua Jurusan <span class="text-red-500">*</span></label>
                        <select name="idKetuaPJ" required class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->idTP }}">{{ $d->namaTP }} (NIP. {{ $d->nipTP }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1">Pilih Sekretaris Jurusan <span class="text-red-500">*</span></label>
                        <select name="idSekretarisPJ" required class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->idTP }}">{{ $d->namaTP }} (NIP. {{ $d->nipTP }})</option>
                            @endforeach
                        </select>
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

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Pimpinan Jurusan</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST" class="overflow-y-auto">
            @csrf @method('PUT')
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Mulai Jabatan <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunMulaiPJ" id="edit_mulai" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Selesai Jabatan <span class="text-red-500">*</span></label>
                        <input type="number" name="tahunSelesaiPJ" id="edit_selesai" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                    </div>
                </div>

                <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1">Pilih Ketua Jurusan <span class="text-red-500">*</span></label>
                        <select name="idKetuaPJ" id="edit_ketua" required class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->idTP }}">{{ $d->namaTP }} (NIP. {{ $d->nipTP }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1">Pilih Sekretaris Jurusan <span class="text-red-500">*</span></label>
                        <select name="idSekretarisPJ" id="edit_sekretaris" required class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none bg-white">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->idTP }}">{{ $d->namaTP }} (NIP. {{ $d->nipTP }})</option>
                            @endforeach
                        </select>
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
        form.action = `/admin/informasi-penting/pimpinan-jurusan/${data.idPJ}`; // Sesuaikan dengan Prefix Route Anda

        document.getElementById('edit_mulai').value = data.tahunMulaiPJ;
        document.getElementById('edit_selesai').value = data.tahunSelesaiPJ;
        document.getElementById('edit_ketua').value = data.idKetuaPJ;
        document.getElementById('edit_sekretaris').value = data.idSekretarisPJ;

        openModal('modalEdit');
    }
</script>
@endsection
