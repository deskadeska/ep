<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Integritas — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* Variabel Global Standar Web */
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

        .delay-1 {
            transition-delay: 0.1s;
        }

        .delay-2 {
            transition-delay: 0.2s;
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
                Komitmen Kami</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Zona Integritas</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Jurusan Ekonomi Pembangunan Universitas Palangka Raya berkomitmen penuh untuk mewujudkan Wilayah Bebas
                dari Korupsi (WBK) dan Wilayah Birokrasi Bersih dan Melayani (WBBM).
            </p>
        </div>
    </section>

    <section class="py-16 px-4 bg-white reveal active delay-2">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-start gap-12">

            <div class="w-full md:w-5/12 flex justify-center">
                <div class="relative rounded-2xl overflow-hidden shadow-xl border-4 border-[var(--soft-bg)] max-w-md w-full">
                    <img src="{{ asset('assets/images/zona_integritas_ekopem_upr.jpeg') }}"
                         alt="Banner Zona Integritas Menuju WBK/WBBM"
                         class="w-full h-auto object-cover">
                </div>
            </div>

            <div class="w-full md:w-7/12 space-y-6">
                <div>
                    <span class="subheadline-label">Tujuan & Implementasi</span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Wujud Nyata Integritas Jurusan</h2>
                </div>

                <p class="text-base leading-relaxed text-[var(--medium-neutral)] text-justify">
                    Penetapan <strong>Zona Integritas</strong> ini bukanlah sekadar simbol, melainkan wujud nyata dari penjabaran visi dan misi Jurusan Ekonomi Pembangunan, khususnya Jurusan Ekonomi Pembangunan. Kami berkomitmen penuh untuk menciptakan lingkungan akademik dan birokrasi yang transparan, akuntabel, dan sepenuhnya bebas dari praktik korupsi maupun gratifikasi.
                </p>

                <p class="text-base leading-relaxed text-[var(--medium-neutral)] text-justify">
                    Demi mewujudkan komitmen tersebut, seluruh jajaran staf, pimpinan, dan dosen berfokus pada <strong>6 Area Perubahan</strong> utama yang menjadi fondasi pelayanan kami:
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
                    <div class="flex items-center gap-3 bg-[var(--light-neutral)] p-3 rounded-lg border border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm flex-shrink-0">1</div>
                        <span class="text-sm font-semibold text-[var(--dark-neutral)]">Manajemen Perubahan</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[var(--light-neutral)] p-3 rounded-lg border border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm flex-shrink-0">2</div>
                        <span class="text-sm font-semibold text-[var(--dark-neutral)]">Penataan Tatalaksana</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[var(--light-neutral)] p-3 rounded-lg border border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm flex-shrink-0">3</div>
                        <span class="text-sm font-semibold text-[var(--dark-neutral)]">Sistem Manajemen SDM</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[var(--light-neutral)] p-3 rounded-lg border border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm flex-shrink-0">4</div>
                        <span class="text-sm font-semibold text-[var(--dark-neutral)]">Penguatan Akuntabilitas</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[var(--light-neutral)] p-3 rounded-lg border border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm flex-shrink-0">5</div>
                        <span class="text-sm font-semibold text-[var(--dark-neutral)]">Penguatan Pengawasan</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[var(--light-neutral)] p-3 rounded-lg border border-gray-200">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-sm flex-shrink-0">6</div>
                        <span class="text-sm font-semibold text-[var(--dark-neutral)]">Peningkatan Kualitas Layanan</span>
                    </div>
                </div>

                <p class="text-base leading-relaxed text-[var(--medium-neutral)] text-justify">
                    Dengan berpegang teguh pada prinsip <strong>Bebas Dari Korupsi</strong> dan <strong>Pelayanan Prima</strong>, Jurusan Ekonomi Pembangunan terus berbenah dan meningkatkan mutu pendidikan untuk mewujudkan <i>Wilayah Bebas dari Korupsi (WBK)</i> serta <i>Wilayah Birokrasi Bersih dan Melayani (WBBM)</i> bagi seluruh mahasiswa, dosen, dan masyarakat.
                </p>
            </div>

        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Script Animasi Reveal
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
