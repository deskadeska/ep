<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenaga Kependidikan — Ekonomi Pembangunan UPR</title>
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

        .staff-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .staff-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(30, 58, 95, 0.15), 0 10px 10px -5px rgba(30, 58, 95, 0.04);
            border-color: var(--secondary);
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
                Layanan Prima</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Tenaga Kependidikan</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Mengenal lebih dekat staf administrasi dan layanan penunjang akademik Jurusan Ekonomi Pembangunan
                Universitas Palangka Raya.
            </p>
        </div>
    </section>

    <!-- CONTENT SECTION -->
    <section class="py-20 px-4">
        <div class="max-w-5xl mx-auto">

            <!-- GROUP HEADER (Diubah ke tengah) -->
            <div class="mb-14 text-center reveal active">
                <div class="inline-flex flex-col items-center">
                    <h2 class="text-2xl md:text-3xl font-bold mb-3">Staf Administrasi Jurusan</h2>
                    <div class="h-1.5 w-16 rounded-full" style="background-color: var(--accent);"></div>
                </div>
            </div>

            <!-- CARDS FLEXBOX (Otomatis ke tengah & ukurannya membesar) -->
            <div class="flex flex-wrap justify-center gap-8 md:gap-12">

                @forelse($staff as $tk)
                    <!-- CARD TENAGA KEPENDIDIKAN (Ukuran diperbesar: w-full sm:w-[320px] md:w-[360px]) -->
                    <div
                        class="staff-card reveal active bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-md flex flex-col w-full sm:w-[320px] md:w-[360px]">

                        <!-- FOTO (Rasio 1:1) -->
                        <div class="aspect-square w-full relative overflow-hidden bg-gray-100">
                            @if ($tk->urlFotoTK)
                                <img src="{{ asset('assets/admin/uploads/tenaga_kependidikan/' . $tk->urlFotoTK) }}"
                                    alt="{{ $tk->namaTK }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <svg class="w-16 h-16 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">Foto Tidak
                                        Tersedia</span>
                                </div>
                            @endif

                            <!-- Badge Staf (Melayang, ukuran diperbesar) -->
                            <div class="absolute bottom-3 left-3">
                                <span
                                    class="px-3 py-1 rounded-md text-[10px] sm:text-xs font-black uppercase tracking-wider shadow-sm"
                                    style="background-color: white; color: var(--primary);">
                                    Staf Jurusan
                                </span>
                            </div>
                        </div>

                        <!-- KONTEN INFO (Padding dan Teks diperbesar) -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-base sm:text-lg md:text-xl font-bold leading-snug mb-1"
                                style="color: var(--primary);">
                                {{ $tk->namaTK }}
                            </h3>
                            <p class="text-xs sm:text-sm font-medium mb-5 text-[var(--medium-neutral)]">
                                NIP. {{ $tk->nipTK ?? '-' }}
                            </p>

                            <!-- Mini Divider -->
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span
                                    class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-widest">Administrasi</span>
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full" style="background-color: var(--secondary);"></div>
                                    <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- EMPTY STATE -->
                    <div
                        class="w-full py-16 text-center bg-white rounded-2xl border border-dashed border-gray-300 shadow-sm">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="text-base font-bold text-gray-500">Belum ada data tenaga kependidikan.</h3>
                    </div>
                @endforelse

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
