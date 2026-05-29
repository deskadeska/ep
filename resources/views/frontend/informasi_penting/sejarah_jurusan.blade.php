<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Jurusan — Ekonomi Pembangunan UNPAR</title>
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
            transition: all 0.7s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }

        .subheadline-label {
            font-family: 'Lora', serif;
            color: var(--accent);
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
            display: block;
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
                Tentang Kami</p>
            <h1 class="text-4xl md:text-6xl font-bold mb-4 reveal active text-white">Profil Jurusan</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Mengenal lebih dekat Fakultas Ekonomi dan Bisnis Universitas Palangka Raya serta visi besar yang kami
                usung.
            </p>
        </div>
    </section>

    <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto space-y-16">

            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12 reveal">
                <div class="w-full md:w-5/12">
                    <div class="relative rounded-2xl overflow-hidden shadow-lg border-2 border-[var(--soft-bg)]">
                        <img src="{{ asset('assets/images/fakultas-1.jpg') }}" alt="FEB UPR"
                            class="w-full aspect-video object-cover">
                    </div>
                </div>
                <div class="w-full md:w-7/12">
                    <span class="subheadline-label">Profil</span>
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">Fakultas Ekonomi dan Bisnis UPR</h2>
                    <p class="text-base leading-relaxed text-[var(--medium-neutral)] text-justify">
                        Fakultas Ekonomi dan Bisnis Universitas Palangka Raya berdiri bersamaan
                        dengan berdirinya Unversitas Palangka Raya, melalui Surat Keputusan (SK) Menteri
                        Perguruan Tinggi dan llmu Pendidikan (PTIP), nomor : 141 tanggal 10 Nopember
                        1963. Perkuliahan pertama pada Fakultas Ekonomi dan Bisni s dimulai sejak bulan
                        Maret 1964 dipimpin oleh Bapak H. Timang, dibantu oleh 8 (delapan) orang dosen
                        dan didukung oleh staf sketariat yang dipimpin oleh Bapak H.F. Sahay. Pada awal
                        berdirinya Fakultas Ekonomi dan Bisnis UPR masih terdiri dari 2 (dua) jurusan yaitu
                        Jurusan Ekonomi Umum yang sekarang dikenal dengan Jurusan Ekonomi
                        Pembangunan dan Jurusan Ekonomi Perusahaan yang kemudian berganti nama
                        menjandi Jurusan Manajemen. <br>
                        Fakultas Ekonomi dan Bisnis UPR setiap tahun mengalami perkembangan, baik
                        dari segi kuantitas maupun dari segi kualitas sesuai dengan perkembangan fakultas
                        dan kebutuhan akan pembangunan. Pada tahun 1999 dibuka program studi baru
                        yakni Jurusan Akuntansi, sehingga Fakultas Ekonomi dan Bisnis saat ini terdiri dari 3
                        (tiga) jurusan yakni Jurusan Ekonomi Pembangunan, Jurusan Manajemen, dan
                        Jurusan Akuntansi.
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-8 md:gap-12 reveal delay-1">
                <div class="w-full md:w-5/12">
                    <div class="relative rounded-2xl overflow-hidden shadow-lg border-2 border-[var(--soft-bg)]">
                        <img src="{{ asset('assets/images/dekan.jpg') }}" alt="Dekan FEB UPR"
                            class="w-full aspect-video object-cover">
                    </div>
                </div>
                <div class="w-full md:w-7/12">
                    <p class="text-base leading-relaxed text-[var(--medium-neutral)] text-justify">
                        Fakultas Ekonomi sebagai salah satu Fakultas tertua di lingkungan Universitas
                        Palangka Raya, Fakultas Ekonomi juga dipercayakan untuk membina embrio Fakultas
                        baru di Iingkungan Universitas Palangka Raya, yakni Jurusan Hukum dan Jurusan
                        llmu Sosial dan Politik (ISIPOL), yang kemudian Jurusan ini telah berdiri sendiri
                        menjadi Fakultas Hukum dan Fakultas ISIPOL. Fakultas Ekonomi dan Bisnis juga
                        membuka program pascasarjana, Program pascasarjana diawali pada tahun 2004
                        yaitu dengan dikeluarkannya Surat Izin Direktorat Jenderal Pendidikan Tinggi
                        Departemen Pendidikan Nasional Nomor : 4799/D/T/2004 tanggal 16 Desember
                        2004 tentang penyelenggaraan Program Studi Manajemen (S2) dan kemudian disusul
                        pembukaan program Magister Ilmu Ekonomi.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="py-16 px-4" style="background-color: var(--light-neutral);">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10 reveal">
                <span class="subheadline-label">Informasi Umum</span>
                <h2 class="text-2xl md:text-3xl font-bold">Kontak & Lokasi</h2>
                <p class="text-sm text-[var(--medium-neutral)] mt-2">Adapun informasi umum mengenai FEB UPR adalah
                    sebagai berikut:</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 reveal delay-1">
                <div
                    class="bg-[#E8F1F8] p-5 rounded-xl border border-blue-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div
                        class="w-10 h-10 rounded-full flex items-center justify-center bg-white text-[var(--secondary)] flex-shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm mb-0.5 text-[var(--primary)]">Alamat</h3>
                        <p class="text-xs text-[var(--dark-neutral)] leading-tight">Jl. Hendrik Timang Kampus UPR
                            Tanjung Nyaho, Palangka Raya</p>
                    </div>
                </div>

                <div
                    class="bg-[#FEF4E8] p-5 rounded-xl border border-orange-100 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div
                        class="w-10 h-10 rounded-full flex items-center justify-center bg-white text-[var(--accent)] flex-shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm mb-0.5 text-[var(--primary)]">Telepon</h3>
                        <p class="text-xs text-[var(--dark-neutral)] leading-tight">12345</p>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                    <div
                        class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-50 text-[var(--primary)] flex-shrink-0 shadow-sm border border-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="font-bold text-sm mb-0.5 text-[var(--primary)]">Email</h3>
                        <p class="text-xs text-[var(--dark-neutral)] leading-tight truncate">
                            fakultasekonomidanbisnis2402@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Efek Reveal pada Scroll
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
