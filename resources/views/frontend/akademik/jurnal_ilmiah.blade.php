<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Ilmiah — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1E3A5F;
            --secondary: #2A6F97;
            --accent: #F2A541;
            --soft-bg: #E8F1F8;
            --dark-neutral: #2F2F2F;
            --light-neutral: #F4F6F9;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--dark-neutral);
            background-color: var(--light-neutral);
        }

        h1, h2, h3 {
            font-family: 'Lora', serif;
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

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 30px -5px rgba(30, 58, 95, 0.12);
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/80 backdrop-blur-[1px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Publikasi & Riset</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Jurnal Ilmiah</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Kumpulan portal dan direktori jurnal publikasi karya tulis ilmiah yang dihasilkan oleh civitas akademika Jurusan Ekonomi Pembangunan.
            </p>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-5xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                @forelse($jurnalIlmiah as $ji)

                    <a href="{{ $ji->linkJI }}" target="_blank" rel="noopener noreferrer" class="group flex flex-col bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden card-hover reveal active">

                        <div class="w-full bg-gray-50 py-10 px-6 flex items-center justify-center relative border-b border-gray-100 overflow-hidden">

                            @if($ji->sampulJI)
                                <img src="{{ asset('assets/admin/uploads/jurnal/' . $ji->sampulJI) }}" alt="Sampul {{ $ji->namaJI }}" class="h-48 md:h-56 w-auto object-contain drop-shadow-md rounded-sm transition-transform duration-700 group-hover:scale-105 relative z-10">

                                <div class="absolute inset-0 bg-cover bg-center opacity-10 blur-2xl scale-110" style="background-image: url('{{ asset('assets/admin/uploads/jurnal/' . $ji->sampulJI) }}');"></div>
                            @else
                                <div class="h-48 md:h-56 w-36 border-2 border-dashed border-gray-300 rounded flex items-center justify-center text-gray-400 bg-white relative z-10">
                                    <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6 z-20">
                                <span class="bg-white/95 backdrop-blur-sm text-[var(--primary)] px-5 py-2 rounded-full text-xs font-bold shadow-lg flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    Buka Tautan Jurnal <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 md:p-8 text-center bg-white flex-1 flex flex-col justify-center relative z-10">
                            <h3 class="text-xl md:text-2xl font-bold text-[var(--primary)] group-hover:text-[var(--secondary)] transition-colors line-clamp-2 leading-snug">
                                {{ $ji->namaJI }}
                            </h3>
                            <p class="text-xs md:text-sm text-gray-400 mt-2 font-medium break-all line-clamp-1 opacity-60">
                                {{ $ji->linkJI }}
                            </p>
                        </div>
                    </a>

                @empty
                    <div class="col-span-1 md:col-span-2 py-20 text-center bg-white rounded-3xl border border-dashed border-gray-300 reveal active">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-30 text-[var(--secondary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="text-xl font-bold text-gray-800">Tidak Ada Jurnal</h3>
                        <p class="text-gray-500 mt-2">Belum ada direktori jurnal ilmiah yang ditambahkan ke dalam sistem.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Animasi Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>

</html>
