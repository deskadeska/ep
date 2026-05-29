@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Data Tenaga Pengajar</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen profil dosen dan tenaga pengajar.</p>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <div id="order-actions" class="hidden flex gap-2">
            <button onclick="cancelOrder()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition">
                Batal
            </button>
            <button onclick="saveOrder()" id="btn-save-order" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Terapkan Urutan
            </button>
        </div>

        <form action="{{ route('admin.pengajar.reset_urutan') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengatur ulang urutan ke default (berdasarkan data terbaru)?');" class="inline-block">
            @csrf
            <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Reset Urutan
            </button>
        </form>

        <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengajar
        </button>
    </div>
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
                    <th class="p-4 font-semibold w-10 text-center"></th>
                    <th class="p-4 font-semibold w-24 text-center">Foto</th>
                    <th class="p-4 font-semibold">Informasi Dosen</th>
                    <th class="p-4 font-semibold">Status & Jabatan</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="sortable-table" class="text-sm divide-y divide-gray-100">
                @forelse($pengajar as $p)
                <tr data-id="{{ $p->idTP }}" class="hover:bg-gray-50 transition bg-white group">

                    <td class="p-4 text-center cursor-move text-gray-400 group-hover:text-gray-700 drag-handle" title="Tahan dan geser untuk mengurutkan">
                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                    </td>

                    <td class="p-4 text-center">
                        @if($p->urlFotoTP)
                            <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/' . $p->urlFotoTP) }}" alt="Foto" class="w-14 h-14 rounded-lg object-cover mx-auto border border-gray-200 shadow-sm drag-none" draggable="false">
                        @else
                            <div class="w-14 h-14 rounded-lg bg-gray-100 mx-auto flex items-center justify-center border border-gray-200 shadow-sm text-gray-400 drag-none" draggable="false">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            </div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base">{{ $p->namaTP }}</div>
                        <div class="text-xs text-gray-500 mt-1 space-y-0.5">
                            <div><span class="font-medium text-gray-600">NIP:</span> {{ $p->nipTP ?? '-' }}</div>
                            <div><span class="font-medium text-gray-600">NUPTK:</span> {{ $p->nuptkTP ?? '-' }}</div>
                            <div><span class="font-medium text-gray-600">Kode Dosen:</span> {{ $p->kodeDosenTP ?? '-' }}</div>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="inline-block {{ $p->tipeTP == 'Dosen Tetap' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }} px-2.5 py-1 rounded-md text-xs font-semibold mb-1">
                            {{ $p->tipeTP }}
                        </span>
                        <div class="text-xs text-gray-500 mt-0.5">
                            {{ $p->jabatanFungsionalTP ?? 'Tanpa Jabatan' }}
                        </div>
                        <div class="text-[11px] text-gray-400 mt-0.5">
                            {{ $p->pendidikanTP ?? '-' }}
                        </div>
                    </td>
                    <td class="p-4 flex flex-col sm:flex-row items-center justify-center gap-2 mt-2">
                        <button onclick="openEditModal({{ json_encode($p) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.pengajar.destroy', $p->idTP) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pengajar ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada data tenaga pengajar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Tenaga Pengajar</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.pengajar.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap (Beserta Gelar) <span class="text-red-500">*</span></label>
                    <input type="text" name="namaTP" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" name="nipTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NUPTK</label>
                        <input type="text" name="nuptkTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Dosen</label>
                        <input type="text" name="kodeDosenTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikanTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat</label>
                        <input type="text" name="pangkatTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Golongan</label>
                        <input type="text" name="golonganTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan Fungsional</label>
                        <input type="text" name="jabatanFungsionalTP" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Dosen <span class="text-red-500">*</span></label>
                        <select name="tipeTP" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none bg-white">
                            <option value="Dosen Tetap">Dosen Tetap</option>
                            <option value="Dosen Luar Biasa">Dosen Luar Biasa</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Pengajar</label>
                    <input type="file" name="urlFotoTP" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
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
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Tenaga Pengajar</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf @method('PUT')
            <div class="p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap (Beserta Gelar) <span class="text-red-500">*</span></label>
                    <input type="text" name="namaTP" id="edit_nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" name="nipTP" id="edit_nip" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NUPTK</label>
                        <input type="text" name="nuptkTP" id="edit_nuptk" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Dosen</label>
                        <input type="text" name="kodeDosenTP" id="edit_kode" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikanTP" id="edit_pendidikan" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat</label>
                        <input type="text" name="pangkatTP" id="edit_pangkat" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Golongan</label>
                        <input type="text" name="golonganTP" id="edit_golongan" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan Fungsional</label>
                        <input type="text" name="jabatanFungsionalTP" id="edit_jabatan" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Dosen <span class="text-red-500">*</span></label>
                        <select name="tipeTP" id="edit_tipe" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none bg-white">
                            <option value="Dosen Tetap">Dosen Tetap</option>
                            <option value="Dosen Luar Biasa">Dosen Luar Biasa</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto (Kosongkan jika tidak ingin ganti)</label>
                    <input type="file" name="urlFotoTP" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2 sticky bottom-0">
                <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    // --- Logika Bawaan Modal ---
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
        form.action = `/admin/informasi-penting/tenaga-pengajar/${data.idTP}`;

        document.getElementById('edit_nama').value = data.namaTP || '';
        document.getElementById('edit_nip').value = data.nipTP || '';
        document.getElementById('edit_nuptk').value = data.nuptkTP || '';
        document.getElementById('edit_kode').value = data.kodeDosenTP || '';
        document.getElementById('edit_pendidikan').value = data.pendidikanTP || '';
        document.getElementById('edit_pangkat').value = data.pangkatTP || '';
        document.getElementById('edit_golongan').value = data.golonganTP || '';
        document.getElementById('edit_jabatan').value = data.jabatanFungsionalTP || '';
        document.getElementById('edit_tipe').value = data.tipeTP || 'Dosen Tetap';

        openModal('modalEdit');
    }

    // --- Logika Drag & Drop Urutan ---
    const tbody = document.getElementById('sortable-table');
    const orderActions = document.getElementById('order-actions');
    let originalOrder = [];

    function getCurrentOrder() {
        return Array.from(tbody.querySelectorAll('tr[data-id]')).map(tr => tr.getAttribute('data-id'));
    }

    if(tbody) {
        originalOrder = getCurrentOrder();

        new Sortable(tbody, {
            handle: '.drag-handle', // Area drag khusus pada ikon hamburger
            animation: 150,
            ghostClass: 'bg-blue-50',
            onEnd: function () {
                const newOrder = getCurrentOrder();
                if (JSON.stringify(originalOrder) !== JSON.stringify(newOrder)) {
                    orderActions.classList.remove('hidden');
                } else {
                    orderActions.classList.add('hidden');
                }
            }
        });
    }

    function cancelOrder() {
        window.location.reload();
    }

    function saveOrder() {
        const btnSave = document.getElementById('btn-save-order');
        btnSave.innerHTML = "Menyimpan...";
        btnSave.disabled = true;

        const newOrder = getCurrentOrder();

        fetch("{{ route('admin.pengajar.update_urutan') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ urutan: newOrder })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                btnSave.innerHTML = "Berhasil!";
                btnSave.classList.replace('bg-green-600', 'bg-blue-600');
                setTimeout(() => { window.location.reload(); }, 600);
            } else {
                alert("Gagal menyimpan urutan.");
                window.location.reload();
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan sistem.");
            window.location.reload();
        });
    }
</script>
@endsection
