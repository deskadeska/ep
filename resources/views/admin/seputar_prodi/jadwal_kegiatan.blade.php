@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Jadwal Kegiatan</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen jadwal kegiatan program studi (Otomatis terhapus 7 hari setelah selesai).</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Jadwal
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
                    <th class="p-4 font-semibold w-16 text-center">No</th>
                    <th class="p-4 font-semibold w-40">Tanggal</th>
                    <th class="p-4 font-semibold">Nama & Deskripsi Kegiatan</th>
                    <th class="p-4 font-semibold w-40 text-center">Status / Info</th>
                    <th class="p-4 font-semibold text-center w-36">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($jadwal as $index => $jk)

                @php
                    $hariIni = \Carbon\Carbon::today();
                    $tglKegiatan = \Carbon\Carbon::parse($jk->tanggalJK)->startOfDay();
                    $selisihHari = $hariIni->diffInDays($tglKegiatan, false);
                @endphp

                <tr class="hover:bg-gray-50 transition {{ $jk->statusJK ? 'bg-gray-50/50 opacity-80' : '' }}">
                    <td class="p-4 text-center font-medium text-gray-500">{{ $index + 1 }}</td>

                    <td class="p-4">
                        <div class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($jk->tanggalJK)->translatedFormat('d M Y') }}</div>
                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($jk->tanggalJK)->translatedFormat('l') }}</div>
                    </td>

                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base mb-1 {{ $jk->statusJK ? 'line-through text-gray-500' : '' }}">{{ $jk->judulKegiatanJK }}</div>
                        <div class="text-xs text-gray-500 leading-relaxed">{{ $jk->deskripsiSingkatJK }}</div>
                    </td>

                    <td class="p-4 text-center">
                        @if($jk->statusJK)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                Selesai
                            </span>
                        @else
                            @if($selisihHari > 3)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">Mendatang</span>
                            @elseif($selisihHari == 3)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">H-3</span>
                            @elseif($selisihHari == 2)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">H-2</span>
                            @elseif($selisihHari == 1)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700 border border-orange-200">H-1</span>
                            @elseif($selisihHari == 0)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200 animate-pulse">Hari-H</span>
                            @elseif($selisihHari < 0)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-200 text-gray-700">Perlu Evaluasi</span>
                            @endif
                        @endif
                    </td>

                    <td class="p-4 flex items-center justify-center gap-2">
                        @if(!$jk->statusJK)
                            @if($selisihHari < 0)
                                <form action="{{ route('admin.jadwal_kegiatan.selesai', $jk->idJK) }}" method="POST" onsubmit="return confirm('Yakin menandai selesai? Jadwal yang selesai akan TERKUNCI secara permanen!');">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="p-1.5 bg-green-50 text-green-600 rounded hover:bg-green-100 transition" title="Tandai Selesai">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                            @endif

                            <button onclick="openEditModal({{ json_encode($jk) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </button>

                            <form action="{{ route('admin.jadwal_kegiatan.destroy', $jk->idJK) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal kegiatan ini secara permanen?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus Permanen">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        @else
                            <div class="flex items-center gap-1 text-gray-400 bg-gray-100 px-2.5 py-1 rounded-md border border-gray-200" title="Data tidak dapat diedit atau dihapus">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Terkunci</span>
                            </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada jadwal kegiatan yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Jadwal Kegiatan</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.jadwal_kegiatan.store') }}" method="POST" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulKegiatanJK" required placeholder="Contoh: Kuliah Umum Ekonomi Digital" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggalJK" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <textarea name="deskripsiSingkatJK" rows="3" required placeholder="Deskripsi singkat maksimal 255 karakter..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Jadwal Kegiatan</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST" class="overflow-y-auto">
            @csrf @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kegiatan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulKegiatanJK" id="edit_judul" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kegiatan <span class="text-gray-400 font-normal text-xs">(Tidak dapat diubah)</span></label>
                    <input type="date" id="edit_tanggal" readonly class="w-full border border-gray-200 bg-gray-100 text-gray-500 rounded-lg px-3 py-2 text-sm cursor-not-allowed outline-none select-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <textarea name="deskripsiSingkatJK" id="edit_deskripsi" rows="3" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:outline-none"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update Jadwal</button>
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
        form.action = `/admin/seputar-prodi/jadwal-kegiatan/${data.idJK}`;

        document.getElementById('edit_judul').value = data.judulKegiatanJK || '';
        document.getElementById('edit_tanggal').value = data.tanggalJK || '';
        document.getElementById('edit_deskripsi').value = data.deskripsiSingkatJK || '';

        openModal('modalEdit');
    }
</script>
@endsection
