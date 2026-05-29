<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan Ekonomi Pembangunan — FEB UNPAR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --navy: #1E3A5F;
            --menu-text: #E8F1F8;
            --amber: #F2A541;
            --gold: #FFD166;
            --subheadline: #2A6F97;
            --body: #2F2F2F;
            --caption: #6B7280;
            --hero-bg: #E8F1F8;
            --content-bg: #F4F6F9;
            --card-bg: #FFFFFF;
            --card-border: #D1D5DB;
            --footer-bg: #1A2C44;
            --footer-text: #E8F1F8;
            --divider: #2F4A6B;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--body);
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        html {
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Lora', serif;
        }

        /* SCROLL ANIMATIONS */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .delay-1 {
            transition-delay: 0.1s !important;
        }

        .delay-2 {
            transition-delay: 0.2s !important;
        }

        .delay-3 {
            transition-delay: 0.3s !important;
        }

        .delay-4 {
            transition-delay: 0.4s !important;
        }

        .delay-5 {
            transition-delay: 0.5s !important;
        }

        /* HERO */
        .hero-section {
            background-color: var(--hero-bg);
            background-image: radial-gradient(ellipse at 80% 20%, rgba(242, 165, 65, 0.08) 0%, transparent 60%), radial-gradient(ellipse at 10% 80%, rgba(30, 58, 95, 0.06) 0%, transparent 50%);
            padding-top: 64px;
        }

        /* STAT CARD */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            text-align: center;
            padding: 1.25rem 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(30, 58, 95, 0.12);
        }

        @media (max-width: 640px) {
            .stat-card {
                min-height: 110px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        .stat-icon-circle {
            width: 44px;
            height: 44px;
            background-color: var(--hero-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.6rem;
        }

        /* NEWS CARD */
        .news-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(30, 58, 95, 0.14);
        }

        /* HIGHLIGHT SLIDER INDICATORS */
        .slider-dot {
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background-color: var(--amber);
            width: 24px;
        }

        /* GALLERY */
        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
            aspect-ratio: 4/3;
            transition: transform 0.3s ease;
            position: relative;
        }

        .gallery-item:hover {
            transform: scale(1.03);
            z-index: 10;
        }

        /* BUTTONS */
        .btn-primary {
            background-color: var(--amber);
            color: #fff;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: background-color 0.2s ease, transform 0.2s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #D4882E;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--subheadline);
            border: 2px solid var(--subheadline);
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: var(--subheadline);
            color: #fff;
        }

        /* MAP */
        .map-placeholder {
            background: linear-gradient(135deg, #e2e8f0, #dbeafe);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 240px;
            border: 1px solid var(--card-border);
        }

        /* SECTION TITLE */
        .section-title::after {
            content: '';
            display: block;
            width: 48px;
            height: 3px;
            background: var(--amber);
            margin-top: 10px;
            border-radius: 2px;
        }

        /* NAVBAR */
        .nav-link:hover {
            color: #F2A541 !important;
        }

        .dropdown-item:hover {
            background-color: #E8F1F8 !important;
            color: #1E3A5F !important;
        }

        .footer-link:hover {
            color: #FFD166 !important;
        }

        /* ANIMASI MITRA (MARQUEE) */
        .mitra-slider {
            /* Membuat efek blur/fade transparan di ujung kiri dan kanan */
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }

        .mitra-track {
            display: flex;
            width: max-content;
            animation: scroll-mitra 30s linear infinite;
        }

        /* Animasi berhenti jika kursor diarahkan ke logo */
        .mitra-track:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-mitra {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }

            /* Bergeser 50% karena data diduplikat */
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

<section class="hero-section bg-cover bg-center bg-no-repeat relative" id="hero"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">

        <div class="absolute inset-0 bg-white/80"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 relative z-10">
            <div class="max-w-3xl">
                <p class="text-sm font-semibold uppercase tracking-widest mb-3 reveal"
                    style="color: var(--subheadline);">
                    Selamat Datang di
                </p>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight mb-3 reveal delay-1"
                    style="color: var(--navy);">
                    Jurusan Ekonomi<br>
                    Pembangunan
                </h1>
                <h2 class="text-lg sm:text-xl font-semibold mb-1 reveal delay-2" style="color: var(--subheadline);">
                    Fakultas Ekonomi dan Bisnis</h2>
                <h3 class="text-base sm:text-lg font-medium mb-6 reveal delay-2" style="color: var(--subheadline);">
                    Universitas Palangka Raya</h3>
                <blockquote class="border-l-4 pl-4 mb-8 reveal delay-3 max-w-full overflow-hidden"
                    style="border-color: var(--amber);">
                    <p class="text-sm sm:text-base italic leading-relaxed break-words" style="color: var(--caption);">
                        "Menghasilkan Lulusan Ilmu Ekonomi yang Unggul, Bermoral Pancasila, Berdaya Saing Global dan
                        Berkontribusi Nyata bagi Pembangunan Berkelanjutan."
                    </p>
                    <cite class="text-xs mt-1 block font-medium" style="color: var(--caption);">
                        Statistik T.A {{ $tahunAjaranTerbaru ? $tahunAjaranTerbaru->tahunAkademikTA : 'Berjalan' }}
                    </cite>
                </blockquote>
                <div class="flex flex-wrap gap-3 reveal delay-4">
                    <a href="#highlight" class="btn-primary">Lihat Selengkapnya</a>
                    <a href="informasi/profil" class="btn-secondary">Profil Jurusan</a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 relative z-10">
            <div class="stats-grid grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="stat-card reveal delay-1">
                    <div class="stat-icon-circle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: var(--subheadline);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mb-1 leading-tight" style="color: var(--caption);">Jumlah Mahasiswa
                        Aktif</p>
                    <p class="text-2xl sm:text-3xl font-bold" style="color: var(--navy);">
                        {{ number_format($statistik->mahasiswa_aktif ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="stat-card reveal delay-2">
                    <div class="stat-icon-circle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: var(--subheadline);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mb-1 leading-tight" style="color: var(--caption);">Jumlah Mahasiswa
                        Baru</p>
                    <p class="text-2xl sm:text-3xl font-bold" style="color: var(--navy);">
                        {{ number_format($statistik->mahasiswa_baru ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="stat-card reveal delay-3">
                    <div class="stat-icon-circle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: var(--subheadline);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mb-1 leading-tight" style="color: var(--caption);">Jumlah Alumni
                        </p>
                    <p class="text-2xl sm:text-3xl font-bold" style="color: var(--navy);">
                        {{ number_format($statistik->alumni ?? 0, 0, ',', '.') }}
                    </p>
                </div>
                <div class="stat-card reveal delay-4">
                    <div class="stat-icon-circle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: var(--subheadline);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <p class="text-xs font-medium mb-1 leading-tight" style="color: var(--caption);">Jumlah Pengunjung
                        Web</p>
                    <p class="text-2xl sm:text-3xl font-bold" style="color: var(--navy);">
                        {{ number_format($totalPengunjung ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white" id="highlight">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($highlights->count() > 0)
                <div class="relative rounded-2xl overflow-hidden shadow-2xl reveal active"
                    style="background-color: var(--navy);">

                    <div class="flex transition-transform duration-700 ease-in-out h-full" id="highlight-track">

                        @foreach ($highlights as $index => $item)
                            <a href="{{ url('prodi/berita/baca/' . $item->idBerita) }}"
                                class="w-full flex-shrink-0 flex flex-col md:flex-row group cursor-pointer block text-left">

                                <div
                                    class="w-full md:w-5/12 aspect-video md:aspect-auto relative bg-gray-200 overflow-hidden">
                                    @if ($item->fotoBerita)
                                        <img src="{{ asset('assets/admin/uploads/berita/' . $item->fotoBerita) }}"
                                            alt="{{ $item->judulBerita }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full bg-slate-300 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full md:w-7/12 p-8 md:p-12 flex flex-col justify-center">

                                    <div class="flex items-center flex-wrap gap-4 mb-3">
                                        <span
                                            class="text-xs font-bold uppercase tracking-widest flex items-center gap-2"
                                            style="color: var(--amber);">
                                            @if ($index == 0)
                                                <span class="w-2 h-2 rounded-full animate-pulse"
                                                    style="background-color: var(--amber);"></span>
                                            @endif
                                            {{ $item->kategoriBerita }}
                                        </span>

                                        <span class="w-1 h-1 rounded-full bg-gray-500"></span>

                                        <span class="text-xs text-gray-400 font-medium tracking-wide">
                                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>

                                    <h3
                                        class="text-2xl md:text-3xl font-bold text-white mb-4 leading-tight group-hover:text-[var(--amber)] transition-colors">
                                        {{ $item->judulBerita }}
                                    </h3>

                                    <p class="text-gray-300 leading-relaxed text-sm md:text-base line-clamp-3">
                                        {{ $item->deskripsiBerita }}
                                    </p>
                                </div>
                            </a>
                        @endforeach

                    </div>

                    @if ($highlights->count() > 1)
                        <div class="absolute bottom-6 right-8 md:right-12 flex gap-2" id="highlight-dots">
                            @foreach ($highlights as $index => $item)
                                <button
                                    class="slider-dot h-2.5 rounded-full {{ $index == 0 ? 'w-6 bg-white active' : 'w-2.5 bg-white/30' }}"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    @endif

                </div>
            @endif

        </div>
    </section>

    <section class="py-16 lg:py-24" style="background-color: var(--content-bg);" id="sejarah">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div class="reveal-left">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-5 section-title" style="color: var(--navy);">
                        Sejarah Singkat Jurusan Ekonomi dan Pembangunan
                    </h2>
                    <p class="text-sm sm:text-base leading-relaxed mb-4" style="color: var(--body);">
                        Fakultas Ekonomi dan Bisnis Universitas Palangka Raya (FEB-UPR) didirikan bersama dengan
                        berdirinya Universitas Palangka Raya yang diresmikan oleh Menteri Perguruan Tinggi dan Ilmu
                        Pendidikan (PTIP) Bapak Prof. Dr. Ir. Tojib Hadiwijaya, melalui Surat Keputusan (SK) Menteri
                        Perguruan Tinggi dan Ilmu Pendidikan (PTIP), Nomor: 141 tanggal 10 Nopember 1963.
                    </p>
                    <p class="text-sm sm:text-base leading-relaxed mb-6" style="color: var(--body);">
                        Perkuliahan perdana pada Fakultas Ekonomi dan Bisnis dimulai sejak bulan Maret 1964 dipimpin
                        oleh Bapak Hendrik Timang, dibantu oleh 8 (delapan) orang dosen dan didukung oleh staf
                        sekretariat yang dipimpin oleh Bapak H.F. Sahay. Fakultas Ekonomi dan Bisnis Universitas
                        Palangka Raya masih terdiri dari 2 (dua) program studi yaitu Program studi Ekonomi Pembangunan
                        dan Ekonomi Pembangunan Dengan jenjang pendidikan Sarjana Muda.
                    </p>
                    <a href="#" class="btn-primary">Lihat Selengkapnya</a>
                </div>
                <div class="reveal-right">
                    <div class="relative">
                        <div class="rounded-2xl overflow-hidden shadow-xl flex items-center justify-center"
                            style="min-height: 300px; border: 1px solid var(--card-border);">

                            <img src="{{ asset('assets/backrounds/backround_hero.jpg') }}" alt="Gedung FEB UPR"
                                class="w-full h-full object-cover absolute inset-0">

                        </div>

                        <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-xl -z-10"
                            style="background-color: var(--amber); opacity: 0.18;"></div>
                        <div class="absolute -top-4 -left-4 w-16 h-16 rounded-xl -z-10"
                            style="background-color: var(--navy); opacity: 0.08;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="py-16 lg:py-20 bg-white" id="jadwal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-2xl sm:text-3xl font-bold inline-block" style="color: var(--navy);">Jadwal Kegiatan Terdekat</h2>
                <div class="h-[3px] w-12 rounded-sm mx-auto mt-2.5" style="background-color: var(--amber);"></div>
            </div>

            @if(isset($jadwal) && $jadwal->count() > 0)
                <div class="flex flex-col md:grid md:grid-cols-3 gap-5 md:gap-6">
                    @foreach($jadwal as $item)
                        <div class="bg-[var(--content-bg)] rounded-2xl p-5 border border-[var(--card-border)] shadow-sm hover:shadow-md transition-all reveal delay-{{ $loop->iteration }} w-full">
                            <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-200">
                                <div class="bg-[var(--navy)] text-white rounded-xl p-3 text-center min-w-[70px] shadow-sm flex-shrink-0">
                                    <span class="block text-2xl font-bold leading-none mb-1">{{ \Carbon\Carbon::parse($item->tanggalJK)->translatedFormat('d') }}</span>
                                    <span class="block text-xs uppercase tracking-widest font-semibold text-[var(--amber)]">{{ \Carbon\Carbon::parse($item->tanggalJK)->translatedFormat('M') }}</span>
                                </div>
                                <div>
                                    <h3 class="text-base md:text-lg font-bold leading-snug line-clamp-2" style="color: var(--navy);">
                                        {{ $item->judulKegiatanJK }}
                                    </h3>
                                </div>
                            </div>
                            <p class="text-sm leading-relaxed line-clamp-3" style="color: var(--body);">
                                {{ $item->deskripsiSingkatJK }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-[var(--content-bg)] rounded-2xl border border-dashed border-gray-300 reveal">
                    <p class="text-gray-500 italic text-sm font-medium">Belum ada agenda kegiatan dalam waktu dekat.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 lg:py-20" style="background-color: var(--content-bg);" id="tentang">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div class="reveal-left">
                    <h2 class="text-2xl font-bold mb-4 section-title" style="color: var(--amber);">Tentang Jurusan
                        Ekopem</h2>
                    <p class="text-sm sm:text-base mb-4" style="color: var(--body);">
                        Jurusan Ekonomi Pembangunan terletak di bagian barat daya Gedung Fakultas Ekonomi dan Bisnis
                        Universitas Palangka Raya, berada dalam satu kawasan kampus FEB UPR yang mudah diakses melalui
                        Jalan Hendrik Timang dan Jalan DMG. Salilah I, Kota Palangka Raya.
                    </p>
                    <ul class="space-y-3 text-sm" style="color: var(--body);">
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="color:var(--subheadline);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span><strong>Alamat:</strong> Jl. DMG. Salilah I, Kota Palangka Raya, Kalimantan
                                Tengah</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="color:var(--subheadline);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            <span><strong>Link Maps:</strong> <a href="#" style="color:var(--subheadline);"
                                    class="underline">Lihat di Google Maps</a></span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="color:var(--subheadline);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span><strong>No. HP:</strong> +6281234567890</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="color:var(--subheadline);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span><strong>E-mail:</strong> epkom423@gmail.com</span>
                        </li>
                    </ul>
                </div>
                <div class="reveal-right h-full">
                    <div
                        class="bg-white p-4 md:p-6 rounded-3xl shadow-xl border border-gray-100 flex items-center justify-center h-full">

                        <img src="{{ asset('assets/files/Sertifikat 2025-2030.jpg') }}"
                            alt="Sertifikat Akreditasi 2025-2030" class="w-full h-auto object-contain rounded-xl">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-cover bg-center bg-no-repeat relative border-t border-gray-100" id="fasilitas"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">

        <div class="absolute inset-0 bg-white/90 backdrop-blur-[2px]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center mb-12 reveal">
                <h2 class="text-2xl sm:text-3xl font-bold inline-block" style="color: var(--navy);">Fasilitas Jurusan</h2>
                <div class="h-[3px] w-12 rounded-sm mx-auto mt-2.5" style="background-color: var(--amber);"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-5">

                <div class="stat-card reveal delay-1 border-none shadow-md" style="background: linear-gradient(135deg, #e0f2fe, #bae6fd);">
                    <div class="stat-icon-circle bg-white/60">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--navy);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0119.5 16.5h-2.25m-9 0h9l1.409 1.409a2.25 2.25 0 01.659 1.591v.75m-11.25-3.75h9m-9 0V21m9-4.5V21" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mt-3 leading-tight" style="color: var(--navy);">Ruang Kuliah Ber-AC</h3>
                    <p class="text-xs mt-1 font-medium" style="color: var(--caption);">25 Ruangan</p>
                </div>

                <div class="stat-card reveal delay-2 border-none shadow-md" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                    <div class="stat-icon-circle bg-white/60">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--navy);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mt-3 leading-tight" style="color: var(--navy);">Ruang Aula</h3>
                </div>

                <div class="stat-card reveal delay-3 border-none shadow-md" style="background: linear-gradient(135deg, #fef9c3, #fde68a);">
                    <div class="stat-icon-circle bg-white/60">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--navy);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mt-3 leading-tight" style="color: var(--navy);">Ruang Baca</h3>
                </div>

                <div class="stat-card reveal delay-4 border-none shadow-md" style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe);">
                    <div class="stat-icon-circle bg-white/60">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--navy);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mt-3 leading-tight" style="color: var(--navy);">Lab. Komputer</h3>
                </div>

                <div class="stat-card reveal delay-5 border-none shadow-md" style="background: linear-gradient(135deg, #fee2e2, #fecaca);">
                    <div class="stat-icon-circle bg-white/60">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--navy);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mt-3 leading-tight text-center px-1" style="color: var(--navy);">Ruang Rohis & Permakris</h3>
                </div>

            </div>
        </div>
    </section>

    @if (isset($pinnedVideo) && $pinnedVideo->count() > 0)
        <section class="py-16 lg:py-20 bg-white" id="video">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                @foreach ($pinnedVideo as $item)
                    @php
                        $ytId = '';
                        preg_match(
                            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                            $item->urlYoutube,
                            $match,
                        );
                        if (isset($match[1])) {
                            $ytId = $match[1];
                        }
                    @endphp

                    @if ($ytId)
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center reveal active">

                            <div class="lg:col-span-5 w-full">
                                <div class="relative rounded-2xl overflow-hidden shadow-2xl"
                                    style="background-color: var(--navy);">
                                    <div class="relative w-full" style="padding-bottom: 56.25%;">
                                        <iframe class="absolute top-0 left-0 w-full h-full border-0"
                                            src="https://www.youtube.com/embed/{{ $ytId }}?rel=0"
                                            title="YouTube video player"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-7 w-full flex flex-col justify-center text-left">
                                <h2 class="text-2xl sm:text-3xl font-bold leading-tight mb-2"
                                    style="color: var(--navy);">
                                    Video Profil Jurusan Ekopem
                                </h2>

                                <div class="h-[3px] w-12 rounded-sm mb-6" style="background-color: var(--amber);">
                                </div>

                                <p class="leading-relaxed text-sm sm:text-base mb-6" style="color: var(--body);">
                                    Saksikan profil interaktif, kilasan edukasi, dan dokumentasi audiovisual resmi dari
                                    <strong>Jurusan Ekonomi Pembangunan, Fakultas Ekonomi dan Bisnis, Universitas
                                        Palangka Raya</strong>.
                                    Melalui kanal ini, kami menghadirkan ruang transparansi informasi, publikasi
                                    kegiatan akademik,
                                    serta hasil kreativitas civitas akademika dalam mewujudkan tri dharma perguruan
                                    tinggi yang inovatif.
                                </p>

                                <div>
                                    <a href="https://youtube.com/@ekonomipembangunanupr?si=NscR5fDBoaPpgvLs"
                                        target="_blank" rel="noopener noreferrer"
                                        class="btn-primary inline-flex items-center gap-2 text-sm font-bold py-3 px-6 rounded-lg transition shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                        </svg>
                                        Kunjungi Channel YouTube
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endif
                @endforeach

            </div>
        </section>
    @endif

    <section class="py-16 lg:py-20" style="background-color: var(--hero-bg);" id="galeri">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8 reveal">
                <h2 class="text-2xl sm:text-3xl font-bold section-title" style="color:var(--navy);">Galeri Kegiatan
                </h2>
                <a href="{{ route('frontend.dokumentasi') }}"
                    class="btn-secondary hidden sm:inline-block flex-shrink-0 ml-4">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                @if (isset($galeri) && $galeri->count() > 0)

                    @foreach ($galeri as $item)
                        <div
                            class="gallery-item reveal delay-{{ $loop->iteration }} group cursor-pointer bg-gray-200">
                            <img src="{{ asset('assets/admin/uploads/dokumentasi/' . $item->urlFotoDokumentasi) }}"
                                alt="{{ $item->judulDokumentasi }}" class="w-full h-full object-cover">

                            <div
                                class="absolute inset-0 bg-[#1E3A5F]/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                                <span class="text-white text-[10px] md:text-xs font-semibold line-clamp-2">
                                    {{ $item->judulDokumentasi }}
                                </span>
                            </div>
                        </div>
                    @endforeach

                    @for ($i = $galeri->count(); $i < 5; $i++)
                        <div class="gallery-item reveal delay-{{ $i + 1 }}"
                            style="background: linear-gradient(135deg,#e2e8f0,#cbd5e1); display:flex;align-items:center;justify-content:center;">
                            <svg class="w-10 h-10 opacity-40" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="color:white;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endfor
                @else
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="gallery-item reveal delay-{{ $i }}"
                            style="background: linear-gradient(135deg,#e2e8f0,#cbd5e1); display:flex;align-items:center;justify-content:center;">
                            <svg class="w-10 h-10 opacity-40" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="color:white;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endfor
                @endif
            </div>

            <div class="text-center mt-8 sm:hidden reveal">
                <a href="{{ route('frontend.dokumentasi') }}" class="btn-secondary">Lihat Semua</a>
            </div>

        </div>
    </section>

    <section class="py-16 bg-white border-t border-gray-100" id="mitra">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12 reveal active">
                <h2 class="text-2xl font-bold inline-block" style="color: var(--navy);">Mitra Kami</h2>

                <div class="h-[3px] w-12 rounded-sm mx-auto mt-2.5" style="background-color: var(--amber);"></div>

                <p class="text-sm mt-3" style="color: var(--caption);">Instansi dan perusahaan yang telah bekerja sama
                    dengan pihak jurusan.</p>
            </div>

            @if (isset($mitra) && $mitra->count() > 5)

                <div class="mitra-slider overflow-hidden relative w-full reveal active py-4">
                    <div class="mitra-track flex gap-3 md:gap-5">
                        @foreach ($mitra->concat($mitra) as $item)
                            <div
                                class="relative group w-32 md:w-36 h-28 flex-shrink-0 flex flex-col items-center justify-center bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer px-3">

                                <img src="{{ asset('assets/admin/uploads/mitra/' . $item->urlLogoMitra) }}"
                                    alt="{{ $item->namaMitra }}"
                                    class="max-w-full max-h-12 object-contain grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:-translate-y-3 transition-all duration-300">

                                <div
                                    class="absolute bottom-2 md:bottom-3 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 w-full px-2 text-center pointer-events-none">
                                    <span class="text-[9px] md:text-[11px] font-bold leading-tight line-clamp-2"
                                        style="color: var(--navy);">
                                        {{ $item->namaMitra }}
                                    </span>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif(isset($mitra) && $mitra->count() > 0)
                <div class="flex flex-wrap justify-center items-center gap-3 md:gap-5 py-4 reveal active">
                    @foreach ($mitra as $item)
                        <div
                            class="relative group w-32 md:w-36 h-28 flex flex-col items-center justify-center bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer px-3">

                            <img src="{{ asset('assets/admin/uploads/mitra/' . $item->urlLogoMitra) }}"
                                alt="{{ $item->namaMitra }}"
                                class="max-w-full max-h-12 object-contain grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:-translate-y-3 transition-all duration-300">

                            <div
                                class="absolute bottom-2 md:bottom-3 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 w-full px-2 text-center pointer-events-none">
                                <span class="text-[9px] md:text-[11px] font-bold leading-tight line-clamp-2"
                                    style="color: var(--navy);">
                                    {{ $item->namaMitra }}
                                </span>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 text-gray-400 italic text-sm reveal active">
                    Belum ada data mitra kerja sama.
                </div>
            @endif

        </div>
    </section>
    @include('frontend.layout.footer')

    <script>
        (function() {
            // Scroll Animations
            var selectors = '.reveal, .reveal-left, .reveal-right';

            function check() {
                document.querySelectorAll(selectors).forEach(function(el) {
                    if (el.getBoundingClientRect().top <= window.innerHeight * 0.88) {
                        el.classList.add('active');
                    }
                });
            }
            window.addEventListener('load', function() {
                document.querySelectorAll('#hero ' + selectors).forEach(function(el) {
                    setTimeout(function() {
                        el.classList.add('active');
                    }, 80);
                });
                check();
            });
            window.addEventListener('scroll', check, {
                passive: true
            });
            window.addEventListener('resize', check, {
                passive: true
            });

            // Highlight News Slider
            const track = document.getElementById('highlight-track');
            const dots = document.querySelectorAll('.slider-dot');
            let currentSlide = 0;
            const totalSlides = dots.length;
            let slideInterval;

            function moveToSlide(index) {
                currentSlide = index;
                if (currentSlide >= totalSlides) currentSlide = 0;
                if (currentSlide < 0) currentSlide = totalSlides - 1;

                // Geser ke slide yang tepat (persentase)
                track.style.transform = `translateX(-${currentSlide * 100}%)`;

                // Update active class pada dots indicator
                dots.forEach(dot => dot.classList.remove('active', 'bg-white', 'w-6'));
                dots.forEach(dot => dot.classList.add('bg-white/30'));
                dots[currentSlide].classList.remove('bg-white/30');
                dots[currentSlide].classList.add('active', 'bg-white', 'w-6');
            }

            function startSlide() {
                slideInterval = setInterval(() => {
                    moveToSlide(currentSlide + 1);
                }, 5000); // 5 detik per slide
            }

            function resetSlide() {
                clearInterval(slideInterval);
                startSlide();
            }

            // Event listener untuk tombol dot indicator
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    moveToSlide(index);
                    resetSlide(); // Mengatur ulang waktu interval saat tombol diklik
                });
            });

            startSlide(); // Memulai animasi slider
        })();
    </script>

</body>

</html>
