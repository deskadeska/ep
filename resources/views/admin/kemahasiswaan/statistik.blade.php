@extends('admin.layouts.app')

@section('content')
<div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Statistik Beranda</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">Kelola angka statistik pengunjung dan mahasiswa pada halaman utama.</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.tahun_ajaran.index') }}" class="bg-[#E8F1F8] hover:bg-[#d6e6f4] text-[#2A6F97] font-semibold py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition border border-[#b8d4eb]">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            Kelola Tahun Ajaran
        </a>
        <button type="button" onclick="window.location.reload();" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg flex items-center gap-2 shadow-sm transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Muat Ulang
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
    <form id="formStatistik" action="{{ route('admin.statistik.update') }}" method="POST">
        @csrf

        <div class="p-6">
            <div class="mb-6 pb-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Form Pembaruan Data</h3>
                <p class="text-sm text-gray-500 mt-1">Pastikan angka yang Anda masukkan valid. Angka ini akan langsung ditampilkan di halaman depan website.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Mahasiswa Aktif <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <input type="number" id="mahasiswa_aktif" name="mahasiswa_aktif" value="{{ $statistik->mahasiswa_aktif ?? 0 }}" required min="0" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-3 text-base font-semibold text-gray-800 focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none transition-shadow">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Total mahasiswa yang terdaftar saat ini.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Mahasiswa Baru <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        </div>
                        <input type="number" id="mahasiswa_baru" name="mahasiswa_baru" value="{{ $statistik->mahasiswa_baru ?? 0 }}" required min="0" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-3 text-base font-semibold text-gray-800 focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none transition-shadow">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Pendaftaran pada angkatan terbaru.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Alumni <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                        </div>
                        <input type="number" id="alumni" name="alumni" value="{{ $statistik->alumni ?? 0 }}" required min="0" class="w-full pl-10 border border-gray-300 rounded-lg px-3 py-3 text-base font-semibold text-gray-800 focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none transition-shadow">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Total lulusan yang telah menyelesaikan studi.</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
            <button type="button" onclick="openModal('modalKonfirmasi')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2 px-6 rounded-lg flex items-center gap-2 shadow-sm transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Statistik
            </button>
        </div>
    </form>
</div>

<div id="modalKonfirmasi" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white z-10">
            <h3 class="font-bold text-lg" style="color: var(--navy);">Konfirmasi Penyimpanan</h3>
            <button onclick="closeModal('modalKonfirmasi')" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>

        <div class="p-6">
            <div class="flex items-center justify-center mb-4 text-[#F2A541]">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            </div>
            <p class="text-center text-gray-600 text-sm">
                Apakah Anda yakin ingin memperbarui data statistik? Perubahan ini akan langsung terlihat oleh pengunjung di halaman beranda.
            </p>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-2">
            <button type="button" onclick="closeModal('modalKonfirmasi')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
            <button type="button" onclick="submitForm()" class="px-4 py-2 text-sm font-medium text-white bg-[#F2A541] rounded-lg hover:bg-[#d4882e]">Ya, Simpan</button>
        </div>
    </div>
</div>

<script>
    // Membuka modal konfirmasi
    function openModal(modalId) {
        // Validasi HTML5 dasar sebelum membuka modal
        const form = document.getElementById('formStatistik');
        if (form.checkValidity()) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            form.reportValidity();
        }
    }

    // Menutup modal konfirmasi
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Fungsi submit form setelah konfirmasi
    function submitForm() {
        document.getElementById('formStatistik').submit();
    }

    // (Opsional) Mencegah input angka negatif secara paksa
    document.querySelectorAll('input[type="number"]').forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    });
</script>
@endsection
