<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Akademik — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #1E3A5F;
            --secondary: #2A6F97;
            --accent: #F2A541;
            --soft-bg: #E8F1F8;
            --dark-neutral: #2F2F2F;
            --medium-neutral: #6B7280;
            --light-neutral: #F4F6F9;
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
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <!-- HERO SECTION -->
    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/75 backdrop-blur-[1px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Pedoman Mahasiswa</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Panduan Akademik</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Informasi lengkap mengenai kurikulum, peraturan akademik, dan pedoman perkuliahan di lingkungan Jurusan
                Ekonomi Pembangunan.
            </p>
        </div>
    </section>

    <!-- CONTENT SECTION -->
    <section class="py-16 px-4">
        <div class="max-w-5xl mx-auto">

            <!-- TEKS PELENGKAP & TOMBOL UNDUH -->
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-gray-200 mb-8 reveal active">
                <div class="flex flex-col md:flex-row gap-8 items-start justify-between">

                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="h-1 w-10 rounded-full" style="background-color: var(--accent);"></div>
                            <h2 class="text-2xl font-bold">Buku Panduan Akademik FEB</h2>
                        </div>
                        <p class="text-[var(--medium-neutral)] leading-relaxed mb-4">
                            Buku panduan ini merupakan kompas bagi seluruh mahasiswa dalam menjalani aktivitas akademik.
                            Di dalamnya tertuang struktur kurikulum terbaru, tata tertib perkuliahan, pedoman penyusunan
                            tugas akhir, hingga informasi terkait layanan kemahasiswaan untuk Tahun Ajaran 2025/2026.
                        </p>
                        <p class="text-sm font-semibold text-[var(--primary)] flex items-center gap-2">
                            <svg class="w-5 h-5 text-[var(--secondary)]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Silakan baca dokumen di bawah ini atau unduh untuk dibaca secara offline.
                        </p>
                    </div>

                    <!-- Action Button -->
                    <div class="flex-shrink-0 w-full md:w-auto">
                        <a href="{{ asset('assets/files/Buku Panduan Akademik FEB Tahun 2025-2026-1.pdf') }}" download
                            class="w-full md:w-auto flex items-center justify-center gap-2 px-6 py-3.5 bg-[var(--primary)] hover:bg-[var(--secondary)] text-white font-bold rounded-xl transition-colors shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh PDF
                        </a>
                    </div>

                </div>
            </div>

            <!-- PDF VIEWER -->
            <div class="reveal active bg-gray-900 rounded-2xl overflow-hidden shadow-lg border border-gray-300">
                <!--
                Menggunakan aspect-ratio untuk memastikan iframe tetap proporsional
                h-[600px] md:h-[800px] memastikan tingginya cukup nyaman untuk dibaca
            -->
                <iframe src="{{ asset('assets/files/Buku Panduan Akademik FEB Tahun 2025-2026-1.pdf') }}"
                    class="w-full h-[600px] md:h-[1000px] border-none bg-gray-100"
                    title="Buku Panduan Akademik FEB Tahun 2025-2026" loading="lazy">
                    <!-- Pesan Fallback jika browser tidak mendukung Iframe/PDF -->
                    <p class="text-center p-10 text-white">
                        Browser Anda tidak mendukung penayangan PDF secara langsung.
                        Silakan <a href="{{ asset('assets/files/Buku Panduan Akademik FEB Tahun 2025-2026-1.pdf') }}"
                            class="text-[var(--accent)] underline">unduh dokumen ini</a> untuk membacanya.
                    </p>
                </iframe>
            </div>

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
