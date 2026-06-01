@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color: var(--navy);">Panduan Akademik</h1>
    <p class="text-sm mt-1" style="color: var(--caption);">Manajemen berkas panduan dan prosedur akademik mahasiswa.</p>
</div>

@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <p class="text-sm font-medium">{{ session('success') }}</p>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <ul class="list-disc pl-5 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="flex flex-col gap-6 max-w-6xl mx-auto">

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800">Berkas Panduan Saat Ini</h3>
            <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full">Pratinjau</span>
        </div>
        <div class="p-6 bg-gray-100 flex justify-center items-center min-h-[300px]">
            @if(isset($panduan) && $panduan->urlFilePA)
                <div class="bg-white p-8 rounded-xl shadow-md flex flex-col items-center border border-gray-200 w-full max-w-md text-center hover:shadow-lg transition">
                    <div class="bg-blue-50 p-4 rounded-full mb-4">
                        <svg class="w-12 h-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-1">{{ $panduan->judulPA ?? 'Dokumen Panduan' }}</h4>
                    <p class="text-xs text-gray-500 mb-6">Diperbarui: {{ $panduan->updated_at ? $panduan->updated_at->translatedFormat('d M Y, H:i') : '-' }}</p>

                    <a href="{{ asset('assets/admin/uploads/panduan/' . $panduan->urlFilePA) }}" target="_blank" class="inline-flex items-center gap-2 text-sm bg-[#F2A541] hover:bg-[#d4882e] text-white px-6 py-2.5 rounded-lg font-bold transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        Buka Dokumen
                    </a>
                </div>
            @else
                <div class="text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <p class="italic">Belum ada berkas yang diunggah.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="font-bold text-gray-800">Edit Data Panduan Akademik</h3>
        </div>

        <form action="{{ route('admin.panduan.update', $panduan->idPA ?? 1) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Perbarui Berkas (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-gray-100 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center mt-2">
                                <label for="file-upload" class="relative cursor-pointer bg-transparent rounded-md font-medium text-[#F2A541] hover:text-[#d4882e] focus-within:outline-none px-1">
                                    <span>Pilih berkas dokumen</span>
                                    <input id="file-upload" name="urlFilePA" type="file" class="sr-only" accept=".pdf,.doc,.docx">
                                </label>
                                <p class="pl-1">atau tarik dan lepas</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Format: PDF, DOC, DOCX. Maksimal 10MB.</p>
                            <p class="text-xs font-bold text-red-500 mt-1">* Biarkan kosong jika tidak ingin mengubah dokumen saat ini.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Panduan <span class="text-red-500">*</span></label>
                    <input type="text" name="judulPA" value="{{ old('judulPA', $panduan->judulPA ?? '') }}" required placeholder="Masukkan judul panduan akademik..."
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none transition">
                </div>

            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-3 px-8 rounded-lg flex items-center gap-2 shadow-md transition-all hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    Simpan Pembaruan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
