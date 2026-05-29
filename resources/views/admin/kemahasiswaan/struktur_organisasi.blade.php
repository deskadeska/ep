@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold" style="color: var(--navy);">Struktur Organisasi</h1>
    <p class="text-sm mt-1" style="color: var(--caption);">Kelola gambar bagan dan deskripsi struktur organisasi kemahasiswaan.</p>
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
            <h3 class="font-bold text-gray-800">Gambar Struktur Organisasi Saat Ini</h3>
            <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full">Pratinjau</span>
        </div>
        <div class="p-6 bg-gray-100 flex justify-center items-center min-h-[400px]">
            @if(isset($so) && $so->urlFotoSO)
                <img src="{{ asset($so->urlFotoSO) }}" alt="Struktur Organisasi" class="w-full h-auto max-w-4xl rounded-lg shadow-md object-contain">
            @else
                <div class="text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="italic">Belum ada gambar yang diunggah.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="font-bold text-gray-800">Edit Data Struktur Organisasi</h3>
        </div>

        <form action="{{ route('admin.struktur_organisasi.update', $so->idSO ?? 1) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Perbarui Gambar (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-gray-100 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-[#F2A541] hover:text-[#d4882e] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#F2A541] px-1">
                                    <span>Pilih file gambar</span>
                                    <input id="file-upload" name="urlFotoSO" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg, image/webp">
                                </label>
                                <p class="pl-1">atau tarik dan lepas</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG, JPEG. Maksimal 2MB.</p>
                            <p class="text-xs font-bold text-red-500 mt-1">* Biarkan kosong jika tidak ingin mengubah gambar saat ini.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Struktur Organisasi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsiSO" rows="10" required placeholder="Tuliskan deskripsi lengkap mengenai struktur organisasi di sini..."
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm leading-relaxed focus:ring-2 focus:ring-[#F2A541] focus:border-[#F2A541] focus:outline-none transition">{{ old('deskripsiSO', $so->deskripsiSO ?? '') }}</textarea>
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
