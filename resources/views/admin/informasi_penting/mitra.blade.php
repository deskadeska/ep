@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Data Mitra</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Manajemen data instansi dan perusahaan yang bekerja sama.</p>
    </div>
    <div class="flex items-center gap-3">
        <div id="order-actions" class="hidden flex gap-2">
            <button onclick="cancelOrder()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition">
                Batal
            </button>
            <button onclick="saveOrder()" id="btn-save-order" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Terapkan Urutan
            </button>
        </div>

        <button onclick="openModal('modalTambah')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Mitra
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
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm" style="color: var(--subheadline);">
                    <th class="p-4 font-semibold w-10 text-center"></th> <th class="p-4 font-semibold w-32 text-center">Logo Mitra</th>
                    <th class="p-4 font-semibold">Nama Mitra</th>
                    <th class="p-4 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="sortable-table" class="text-sm divide-y divide-gray-100">
                @forelse($mitra as $m)
                <tr data-id="{{ $m->idMitra }}" class="hover:bg-gray-50 transition bg-white group">
                    <td class="p-4 text-center cursor-move text-gray-400 group-hover:text-gray-700 drag-handle" title="Tahan dan geser untuk mengurutkan">
                        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                    </td>
                    <td class="p-4">
                        @if($m->urlLogoMitra)
                            <img src="{{ asset('assets/admin/uploads/mitra/' . $m->urlLogoMitra) }}" alt="Logo Mitra" class="w-20 h-14 rounded-lg object-contain bg-white border border-gray-200 shadow-sm p-1 mx-auto drag-none" draggable="false">
                        @else
                            <div class="w-20 h-14 mx-auto rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200 shadow-sm text-gray-400 text-xs text-center px-2">No Image</div>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="font-bold text-gray-800 text-base">{{ $m->namaMitra }}</div>
                    </td>
                    <td class="p-4 flex items-center justify-center gap-2 mt-2">
                        <button onclick="openEditModal({{ json_encode($m) }})" class="p-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                        <form action="{{ route('admin.informasi_penting.mitra.destroy', $m->idMitra) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data mitra ini?');">
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
                    <td colspan="4" class="p-6 text-center text-gray-500">Belum ada data mitra.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Tambah Mitra Baru</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('admin.informasi_penting.mitra.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mitra <span class="text-red-500">*</span></label>
                    <input type="text" name="namaMitra" required placeholder="Contoh: Bank Indonesia" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo Mitra <span class="text-red-500">*</span></label>
                    <input type="file" name="urlLogoMitra" required accept="image/png, image/jpeg, image/jpg, image/webp" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                    <p class="text-[11px] text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maksimal: 2MB.</p>
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
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Edit Data Mitra</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data" class="overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mitra <span class="text-red-500">*</span></label>
                    <input type="text" name="namaMitra" id="edit_nama" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Logo (Opsional)</label>
                    <input type="file" name="urlLogoMitra" accept="image/png, image/jpeg, image/jpg, image/webp" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#F2A541] file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E8F1F8] file:text-[#2A6F97] hover:file:bg-blue-100">
                    <p class="text-[11px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti logo saat ini.</p>
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
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }
    function openEditModal(m) {
        let form = document.getElementById('formEdit');
        form.action = `/admin/informasi-penting/mitra/${m.idMitra}`;
        document.getElementById('edit_nama').value = m.namaMitra;
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
            handle: '.drag-handle', // Area drag
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

        fetch("{{ route('admin.informasi_penting.mitra.update_urutan') }}", {
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

