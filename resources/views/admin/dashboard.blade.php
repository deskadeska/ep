@extends('admin.layouts.app')

@section('content')
<!-- Bagian Header & Tahun Ajaran -->
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-2xl font-bold" style="color: var(--navy);">Dashboard Utama</h1>
        <p class="text-sm mt-1" style="color: var(--caption);">
            Selamat datang, <strong class="text-[#2A6F97]">{{ auth()->user()->namaLengkapUser }}</strong>!
        </p>
    </div>

    <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-lg border border-gray-200 shadow-sm">
        <svg class="w-5 h-5 text-[#2A6F97]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tahun Ajaran</p>
            <p class="text-sm font-bold" style="color: var(--navy);">ABC</p>
        </div>
    </div>
</div>

<!-- Tampilkan Notifikasi Error jika Backup gagal -->
@if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <p class="font-bold">Gagal!</p>
        <p class="text-sm">{{ session('error') }}</p>
    </div>
@endif

<!-- Summary Cards (Grid) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">

    <!-- Total Mahasiswa -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 bg-[#E8F1F8] rounded-lg text-[#2A6F97]">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase">Total Mahasiswa</p>
            <p class="text-2xl font-bold" style="color: var(--navy);">120</p>
        </div>
    </div>

    <!-- Total Dosen -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 bg-[#E8F1F8] rounded-lg text-[#2A6F97]">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase">Total Dosen</p>
            <p class="text-2xl font-bold" style="color: var(--navy);">36</p>
        </div>
    </div>

    <!-- Total Mata Kuliah -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 bg-[#E8F1F8] rounded-lg text-[#2A6F97]">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase">Total Mata Kuliah</p>
            <p class="text-2xl font-bold" style="color: var(--navy);">64</p>
        </div>
    </div>

    <!-- Mahasiswa Aktif -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 bg-green-100 rounded-lg text-green-600">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase">Mahasiswa Aktif</p>
            <p class="text-2xl font-bold" style="color: var(--navy);">77</p>
        </div>
    </div>

    <!-- Mahasiswa Lulus -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 bg-[#FFF3CD] rounded-lg text-[#F2A541]">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase">Mahasiswa Lulus</p>
            <p class="text-2xl font-bold" style="color: var(--navy);">340</p>
        </div>
    </div>

    <!-- Pengunjung Website -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:shadow-md transition">
        <div class="p-3 bg-purple-100 rounded-lg text-purple-600">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase">Pengunjung Website</p>
            <p class="text-2xl font-bold" style="color: var(--navy);">1330</p>
        </div>
    </div>
</div>

<!-- Status Sistem & Backup Area -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Status Sistem -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <h3 class="text-lg font-bold mb-4 border-b pb-2" style="color: var(--navy);">Status Sistem</h3>
        <ul class="space-y-4">
            <li class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-sm font-medium text-gray-700">Status Server</span>
                </div>
                <span class="text-sm font-bold text-green-600">online</span>
            </li>
            <li class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <span class="text-sm font-medium text-gray-700">User Aktif Saat Ini</span>
                </div>
                <span class="text-sm font-bold" style="color: var(--navy);">12 Admin</span>
            </li>
            <li class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-sm font-medium text-gray-700">Terakhir Backup</span>
                </div>
                <span class="text-sm font-semibold text-gray-500">Tidak ada</span>
            </li>
        </ul>
    </div>

    <!-- Backup Area -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex flex-col justify-center items-center text-center">
        <div class="p-4 bg-[#FFF3CD] rounded-full mb-4">
            <svg class="w-10 h-10 text-[#F2A541]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
        </div>
        <h3 class="text-lg font-bold mb-2" style="color: var(--navy);">Backup Database Sistem</h3>
        <p class="text-sm text-gray-500 mb-6">Unduh seluruh data tabel, skema, dan konfigurasi database saat ini dalam format <code class="bg-gray-100 px-1 py-0.5 rounded text-red-500">.sql</code>.</p>

        <a href="#" onclick="return confirm('Proses ini mungkin memakan waktu beberapa detik. Lanjutkan?')" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-2.5 px-6 rounded-lg transition-all transform hover:-translate-y-0.5 shadow flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Mulai Backup & Unduh
        </a>
    </div>

</div>
@endsection
