<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi Kemahasiswaan — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* TEMA WARNA STANDAR PROYEK ANDA */
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

        /* Animasi Scroll Reveal */
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
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-16 px-4 relative bg-cover bg-center bg-no-repeat overflow-hidden"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">

        <div class="absolute inset-0 bg-[#1E3A5F]/85 backdrop-blur-[1px]"></div>

        <div class="relative max-w-5xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Kemahasiswaan</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Struktur Organisasi</h1>
            <p class="max-w-2xl mx-auto text-base font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Hierarki dan tata kerja kelembagaan kemahasiswaan di lingkungan Program Studi Ekonomi Pembangunan,
                Universitas Palangka Raya.
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 py-16">

        @if (isset($so) && ($so->urlFotoSO || $so->deskripsiSO))
            <div class="flex flex-col gap-10">

                @if ($so->urlFotoSO)
                    <div
                        class="reveal active bg-white p-4 md:p-6 rounded-2xl shadow-lg border border-gray-100 flex justify-center">
                        <img src="{{ asset($so->urlFotoSO) }}" alt="Bagan Struktur Organisasi"
                            class="w-full h-auto max-w-5xl rounded-lg object-contain">
                    </div>
                @endif

                @if ($so->deskripsiSO)
                    <div
                        class="reveal active delay-1 bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold mb-4 border-b pb-3 border-gray-100">Deskripsi & Tugas Pokok</h2>

                        <div class="text-gray-600 leading-relaxed text-base space-y-4 text-justify">
                            {!! nl2br(e($so->deskripsiSO)) !!}
                        </div>
                    </div>
                @endif

            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center reveal active">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Data Belum Tersedia</h3>
                <p class="text-gray-500">Bagan dan deskripsi struktur organisasi kemahasiswaan sedang dalam tahap
                    pembaruan.</p>
            </div>
        @endif

    </section>

    @include('frontend.layout.footer')

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>

</html>
