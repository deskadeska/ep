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
                        Fakultas Ekonomi dan Bisnis Universitas Palangka Raya (FEB UPR) merupakan salah satu fakultas
                        yang berperan penting dalam penyelenggaraan pendidikan tinggi di bidang ekonomi. FEB UPR
                        memiliki komitmen untuk menghasilkan lulusan yang unggul, profesional, serta berintegritas dalam
                        bidang Ekonomi, Manajemen, dan Akuntansi. Komitmen ini diwujudkan melalui proses pembelajaran
                        yang terstruktur, pengembangan penelitian, serta pengabdian kepada masyarakat yang
                        berkelanjutan.
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
                        Dalam struktur organisasinya, FEB UPR dipimpin oleh Dekan, yaitu <strong>Dr. Sunaryo
                            Neneng</strong> untuk periode jabatan 2024–2028. Kepemimpinan ini menjadi bagian penting
                        dalam menentukan arah kebijakan akademik serta pengembangan institusi agar mampu bersaing di era
                        digital.
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

    <section class="py-16 px-4 bg-white">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-16 reveal">
                <span class="subheadline-label">Visi</span>
                <div class="py-6 px-4">
                    <h2 class="text-2xl md:text-3xl font-bold leading-relaxed" style="color: var(--primary);">
                        Menjadi Fakultas Ekonomi dan Bisnis Universitas Palangka Raya yang Unggul, Bermoral Pancasila
                        dan Bereputasi di Tingkat Nasional dan Internasional
                    </h2>
                </div>
            </div>

            <div class="reveal delay-1">
                <div class="text-center mb-8">
                    <span class="subheadline-label">Misi</span>
                    <p class="text-[var(--medium-neutral)] text-sm italic">Visi Fakultas Ekonomi dan Bisnis Universitas
                        Palangka Raya akan diwujudkan dengan misi sebagai berikut:</p>
                </div>

                <div class="flex flex-col gap-4">
                    @php
                        $misi = [
                            'Menyelenggarakan Tri Dharma Perguruan secara efisien dan produktif (efficiency & productivity) untuk menghasilkan sumber daya manusia yang berkualitas sesuai kebutuhan masyarakat yang dinamis (relevance).',
                            'Mewujudkan tatakelola Fakultas Ekonomi dan Bisnis yang baik, transparan, akuntabel, partisipatif, dan profesional, berbasis teknologi informasi.',
                            'Menciptakan suasana akademik (academic atmosphere) untuk meningkatkan kualitas pendidikan, kreativitas dan inovasi, produktivitas akademik, kerjasama dan kolaborasi civitas akademika.',
                            'Mengembangkan ketersediaan sarana dan prasarana pendidikan, perkantoran, serta fasilitas penunjang lainnya guna mendukung proses belajar-mengajar, layanan publik, kebersihan, keindahan, keamanan dan kenyamanan lingkungan.',
                            'Memperkuat kualitas sumber daya manusia (SDM) tenaga pendidik dan kependidikan.',
                            'Mendorong kegiatan di bidang kemahasiswaan agar mampu bersaing di tingkat regional, nasional, dan internasional.',
                            'Memperluas kerjasama dan sinergitas dengan pemerintah daerah, pelaku usaha, alumni, dan lembaga lainnya, baik di tingkat nasional dan internasional.',
                        ];
                    @endphp

                    @foreach ($misi as $index => $text)
                        <div
                            class="flex items-center gap-4 p-4 md:p-5 bg-[var(--light-neutral)] rounded-xl border border-[var(--card-border)] hover:bg-white hover:shadow-md hover:border-[var(--secondary)] transition-all duration-300">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm text-white shadow-sm"
                                style="background-color: var(--secondary);">
                                {{ $index + 1 }}
                            </div>
                            <p class="text-sm md:text-base text-[var(--dark-neutral)] leading-snug">
                                {{ $text }}
                            </p>
                        </div>
                    @endforeach
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
