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
                Tentang Jurusan</p>
            <h1 class="text-4xl md:text-6xl font-bold mb-4 reveal active text-white">Visi & Misi Jurusan</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Mengenal lebih dekat Fakultas Ekonomi dan Bisnis Universitas Palangka Raya melalui visi & misi besar
                yang kami usung.
            </p>
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
