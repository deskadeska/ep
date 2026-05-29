<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Magang — Ekonomi Pembangunan UNPAR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* TEMA WARNA SESUAI INSTRUKSI */
        :root {
            --primary: #1E3A5F;
            --secondary: #2A6F97;
            --accent: #F2A541;
            --soft-bg: #E8F1F8;
            --dark-neutral: #2F2F2F;
            --medium-neutral: #6B7280;
            --light-neutral: #F4F6F9;
            --card-bg: #FFFFFF;
            --card-border: #D1D5DB;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--dark-neutral);
            background-color: var(--light-neutral);
        }

        h1,
        h2,
        h3 {
            font-family: 'Lora', serif;
            color: var(--primary);
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/75 backdrop-blur-[1px]"></div>

        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Karir & Profesionalisme</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Kesempatan Magang & Praktik Kerja
            </h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Hubungkan teori akademik dengan pengalaman industri nyata melalui kemitraan magang strategis di instansi
                pemerintah dan swasta.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 -mt-10 relative z-10 mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 reveal active">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center mb-3" style="background-color: var(--soft-bg);">
                    <svg class="w-5 h-5" style="color: var(--secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <p class="text-2xl font-bold" style="color: var(--primary);">{{ $stats['total_mitra'] }}</p>
                <p class="text-xs font-bold uppercase tracking-wider" style="color: var(--medium-neutral);">Mitra Aktif</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center mb-3" style="background-color: var(--soft-bg);">
                    <svg class="w-5 h-5" style="color: var(--secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold" style="color: var(--accent);">{{ $stats['posisi_tersedia'] }}</p>
                <p class="text-xs font-bold uppercase tracking-wider" style="color: var(--medium-neutral);">Lowongan</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center mb-3" style="background-color: var(--soft-bg);">
                    <svg class="w-5 h-5" style="color: var(--secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold" style="color: var(--primary);">{{ $stats['wilayah'] }}</p>
                <p class="text-xs font-bold uppercase tracking-wider" style="color: var(--medium-neutral);">Cakupan</p>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 mb-8">
        <div class="bg-white rounded-2xl p-6 border-l-4 shadow-sm reveal active" style="border-color: var(--accent);">
            <div class="flex items-start gap-4">
                <div class="p-3 rounded-full flex-shrink-0" style="background-color: var(--soft-bg); color: var(--primary);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-2">Petunjuk Pendaftaran Magang</h3>
                    <p class="text-sm text-[var(--medium-neutral)] leading-relaxed mb-4">
                        Sebelum melakukan pendaftaran ke instansi tujuan, pastikan Anda telah menyiapkan dan mengunduh berkas-berkas persyaratan akademik magang (seperti Surat Pengantar, Form Penilaian, dll). Seluruh berkas format resmi jurusan dapat diunduh pada halaman Keperluan Tugas Akhir.
                    </p>
                    <a href="{{ url('/akademik/tugas-akhir') }}" class="inline-flex items-center gap-2 text-sm font-bold transition-colors" style="color: var(--secondary);">
                        <span>Unduh Berkas Magang Disini</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 mb-16">
        <div class="bg-white rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-1.5 reveal active delay-1">
            <form action="{{ route('frontend.magang') }}" method="GET" class="flex items-center w-full">
                <div class="relative flex-1 px-4">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama instansi atau posisi..."
                        class="w-full pl-8 pr-2 py-2 bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none text-sm text-[var(--dark-neutral)] placeholder-gray-400">
                </div>
                <button type="submit"
                    class="text-white font-semibold py-2.5 px-8 rounded-full transition duration-200 text-sm shadow-sm"
                    style="background-color: var(--accent);">
                    Cari Mitra
                </button>
            </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($dataMagang as $m)
                <div class="bg-white rounded-2xl border border-[var(--card-border)] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 reveal active group">
                    <div class="h-48 w-full relative overflow-hidden">
                        @if ($m->fotoTempatMG)
                            <img src="{{ asset('assets/admin/uploads/magang/' . $m->fotoTempatMG) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[var(--soft-bg)] text-[var(--secondary)]">
                                <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex flex-col h-[240px]">
                        <h3 class="text-xl font-bold mb-2 leading-tight group-hover:text-[var(--secondary)] transition-colors line-clamp-2">
                            {{ $m->namatempatMG }}</h3>
                        <p class="text-sm font-bold mb-6" style="color: var(--accent);">
                            {{ $m->posisiMG ?? 'Umum / Staf Magang' }}</p>

                        <div class="mt-auto pt-4 border-t border-gray-50">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: var(--soft-bg); color: var(--secondary);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[10px] uppercase font-bold text-gray-400 leading-none mb-1">Kepala/Pimpinan</p>
                                    <p class="text-xs font-bold text-[var(--dark-neutral)] truncate">{{ $m->kepalaTempatMG ?? 'Informasi Rahasia' }}</p>
                                </div>
                            </div>

                            @if ($m->linkDaftarMG)
                                <a href="{{ $m->linkDaftarMG }}" target="_blank"
                                    class="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-white font-bold text-xs transition duration-300 shadow-md hover:shadow-lg"
                                    style="background-color: var(--primary);">
                                    <span>Daftar Sekarang</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            @else
                                <button disabled class="w-full py-3 rounded-xl bg-gray-200 text-gray-400 font-bold text-xs cursor-not-allowed">
                                    Pendaftaran Ditutup
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-gray-200 reveal active">
                    <p class="text-gray-400 font-medium">Mitra magang belum tersedia atau tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>

</html>
