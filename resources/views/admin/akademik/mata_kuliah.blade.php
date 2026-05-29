@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Data Mata Kuliah</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen kurikulum, SKS, dan dosen pengampu.</p>
    </div>
    <button onclick="openModalTambah()" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Mata Kuliah
    </button>
</div>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
    <form method="GET" action="{{ route('admin.akademik.matakuliah') }}" class="flex flex-col lg:flex-row gap-4 items-center">
        <input type="hidden" name="semester" value="{{ $activeSemester }}">

        <div class="w-full lg:w-1/2 relative">
            <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode atau Nama MK..." class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
        </div>

        <div class="w-full lg:w-1/2 flex gap-2">
            <select name="sort_by" class="w-full lg:w-1/2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="sksMK" {{ request('sort_by', 'sksMK') == 'sksMK' ? 'selected' : '' }}>Urutkan: Bobot SKS</option>
                <option value="kodeMK" {{ request('sort_by') == 'kodeMK' ? 'selected' : '' }}>Urutkan: Kode MK</option>
            </select>

            <select name="sort_order" class="w-full lg:w-1/3 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] focus:border-[#F2A541]">
                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Naik (A-Z / 1-9)</option>
                <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Turun (Z-A / 9-1)</option>
            </select>

            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition shadow-sm">
                Terapkan
            </button>

            @if(request('search') || request('sort_by'))
                <a href="{{ route('admin.akademik.matakuliah', ['semester' => $activeSemester]) }}" class="bg-red-50 text-red-600 hover:bg-red-100 font-medium py-2 px-3 rounded-lg text-sm transition border border-red-200" title="Reset Pencarian">
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
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

    <div class="flex overflow-x-auto gap-2 p-4 border-b border-gray-100 hide-scrollbar">
        @for($i = 1; $i <= 8; $i++)
            <a href="{{ request()->fullUrlWithQuery(['semester' => $i]) }}"
               class="px-5 py-2 rounded-lg text-sm font-bold whitespace-nowrap transition-colors {{ $activeSemester == $i ? 'bg-[#1E3A5F] text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semester {{ $i }}
            </a>
        @endfor
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold w-1/3">Kode & Mata Kuliah</th>
                    <th class="p-4 font-semibold text-center w-24">SKS</th>
                    <th class="p-4 font-semibold">Dosen Pengampu</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($mataKuliah as $mk)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <span class="inline-block bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[10px] font-bold tracking-wider mb-1">{{ $mk->kodeMK }}</span>
                        <div class="font-bold text-gray-800">{{ $mk->namaMK }}</div>
                    </td>
                    <td class="p-4 text-center font-bold text-gray-700">{{ $mk->sksMK }}</td>
                    <td class="p-4">
                        <ul class="text-xs text-gray-700 space-y-2">
                            @forelse($mk->tenagaPengajar as $tp)
                                <li class="flex items-start md:items-center justify-between gap-2 border-b border-gray-100 pb-2 last:border-0 last:pb-0">
                                    <div class="flex items-center gap-1.5 font-medium">
                                        <div class="w-1.5 h-1.5 rounded-full {{ $tp->pivot->rolePMK == 'Koordinator' ? 'bg-orange-500' : 'bg-blue-500' }}"></div>
                                        {{ $tp->namaTP }}
                                    </div>
                                    <span class="text-[10px] bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded border border-gray-200 whitespace-nowrap">{{ $tp->pivot->rolePMK }}</span>
                                </li>
                            @empty
                                <li class="text-gray-400 italic">Belum ada dosen ditetapkan</li>
                            @endforelse
                        </ul>
                    </td>
                    <td class="p-4 flex flex-col sm:flex-row items-center justify-center gap-2">
                        <button type="button" data-mk="{{ json_encode($mk) }}" onclick="openEditModal(this)" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>

                        <form action="{{ route('admin.akademik.matakuliah.destroy', $mk->idMK) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?');">
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
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        @if(request('search'))
                            Pencarian "<b>{{ request('search') }}</b>" tidak ditemukan.
                        @else
                            Belum ada data mata kuliah pada Semester {{ $activeSemester }}.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Mata Kuliah</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('admin.akademik.matakuliah.store') }}" method="POST" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode MK <span class="text-red-500">*</span></label>
                        <input type="text" name="kodeMK" placeholder="Contoh: EKP101" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Kuliah <span class="text-red-500">*</span></label>
                        <input type="text" name="namaMK" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bobot SKS <span class="text-red-500">*</span></label>
                        <input type="number" name="sksMK" min="1" max="6" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Semester <span class="text-red-500">*</span></label>
                        <input type="number" name="semesterMK" min="1" max="8" value="{{ $activeSemester }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-sm font-bold text-gray-700">Daftar Dosen Pengampu</label>
                        <button type="button" onclick="addDosenRow('container_tambah')" class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1.5 rounded-lg font-semibold transition flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Dosen
                        </button>
                    </div>
                    <div id="container_tambah" class="space-y-3">
                        </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Simpan MK</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Mata Kuliah</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="formEdit" method="POST" class="overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode MK <span class="text-red-500">*</span></label>
                        <input type="text" name="kodeMK" id="edit_kode" required class="w-full border border-gray-300 bg-white rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] transition-colors">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Kuliah <span class="text-red-500">*</span></label>
                        <input type="text" name="namaMK" id="edit_nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bobot SKS <span class="text-red-500">*</span></label>
                        <input type="number" name="sksMK" id="edit_sks" min="1" max="6" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Semester <span class="text-red-500">*</span></label>
                        <input type="number" name="semesterMK" id="edit_semester" min="1" max="8" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-sm font-bold text-gray-700">Daftar Dosen Pengampu</label>
                        <button type="button" onclick="addDosenRow('container_edit')" class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1.5 rounded-lg font-semibold transition flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Dosen
                        </button>
                    </div>
                    <div id="container_edit" class="space-y-3">
                        </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update MK</button>
            </div>
        </form>
    </div>
</div>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
    const listDosen = @json($dosen);

    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openModalTambah() {
        const container = document.getElementById('container_tambah');
        container.innerHTML = '';
        addDosenRow('container_tambah', '', 'Koordinator');
        openModal('modalTambah');
    }

    function openEditModal(button) {
        let mk = JSON.parse(button.getAttribute('data-mk'));

        let form = document.getElementById('formEdit');
        form.action = `/admin/akademik/mata-kuliah/${mk.idMK}`;

        document.getElementById('edit_kode').value = mk.kodeMK;
        document.getElementById('edit_nama').value = mk.namaMK;
        document.getElementById('edit_sks').value = mk.sksMK;
        document.getElementById('edit_semester').value = mk.semesterMK;

        const container = document.getElementById('container_edit');
        container.innerHTML = '';

        if (mk.tenaga_pengajar && mk.tenaga_pengajar.length > 0) {
            mk.tenaga_pengajar.forEach(tp => {
                addDosenRow('container_edit', tp.idTP, tp.pivot.rolePMK);
            });
        } else {
            addDosenRow('container_edit');
        }

        openModal('modalEdit');
    }

    function addDosenRow(containerId, selectedId = '', selectedRole = 'Pengampu') {
        const container = document.getElementById(containerId);
        const row = document.createElement('div');
        row.className = 'flex flex-col sm:flex-row gap-2 items-start sm:items-center';

        let optionsHtml = '<option value="">-- Pilih Dosen --</option>';
        listDosen.forEach(d => {
            let isSelected = (d.idTP == selectedId) ? 'selected' : '';
            optionsHtml += `<option value="${d.idTP}" ${isSelected}>${d.namaTP}</option>`;
        });

        row.innerHTML = `
            <select name="idTP[]" required class="w-full sm:flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                ${optionsHtml}
            </select>
            <div class="flex gap-2 w-full sm:w-auto">
                <select name="rolePMK[]" required class="flex-1 sm:w-32 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] bg-white">
                    <option value="Koordinator" ${selectedRole == 'Koordinator' ? 'selected' : ''}>Koordinator</option>
                    <option value="Pengampu" ${selectedRole == 'Pengampu' ? 'selected' : ''}>Pengampu</option>
                    <option value="Asisten" ${selectedRole == 'Asisten' ? 'selected' : ''}>Asisten</option>
                </select>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="p-2 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition" title="Hapus Baris Ini">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        `;

        container.appendChild(row);
    }
</script>
@endsection
