<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi Akademik — Ekonomi Pembangunan UPR</title>
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

        .download-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .download-card:hover {
            transform: translateX(8px);
            border-color: var(--secondary);
            background-color: white;
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
                Layanan Dokumen</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 reveal active text-white">Administrasi Akademik</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Pusat unduhan formulir, panduan, dan dokumen administratif untuk mendukung kelancaran studi mahasiswa
                Ekonomi Pembangunan.
            </p>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-6xl mx-auto">

            @forelse($administrasi as $kelompok => $files)
                <div class="mb-16 reveal">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-1 w-12 rounded-full" style="background-color: var(--accent);"></div>
                        <h2 class="text-2xl md:text-3xl font-bold">{{ $kelompok }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($files as $file)
                            <div
                                class="download-card group bg-[var(--card-bg)] p-5 rounded-2xl border border-[var(--card-border)] shadow-sm flex items-center justify-between">
                                <div class="flex items-center gap-4 overflow-hidden">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                                        style="background-color: var(--soft-bg); color: var(--secondary);">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h3
                                            class="font-bold text-base md:text-lg truncate group-hover:text-[var(--secondary)] transition-colors">
                                            {{ $file->namaFileAAK }}</h3>
                                        <p
                                            class="text-xs text-[var(--medium-neutral)] uppercase font-semibold tracking-wider">
                                            Format: PDF / Dokumen</p>
                                    </div>
                                </div>

                                <a href="{{ asset('assets/admin/uploads/administrasi/' . $file->urlFileAAK) }}"
                                    download="{{ $file->namaFileAAK }}"
                                    class="flex-shrink-0 ml-4 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm bg-[var(--accent)] text-[var(--dark-neutral)] hover:shadow-md"
                                    title="Download {{ $file->namaFileAAK }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div
                    class="py-20 text-center bg-white rounded-3xl border border-dashed border-[var(--card-border)] reveal active">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-bold text-[var(--medium-neutral)]">Belum ada dokumen tersedia</h3>
                    <p class="text-sm text-gray-400">Silakan hubungi bagian akademik untuk informasi lebih lanjut.</p>
                </div>
            @endforelse

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
