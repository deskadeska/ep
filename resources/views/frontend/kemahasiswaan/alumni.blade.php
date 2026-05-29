<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Alumni — Ekonomi Pembangunan UNPAR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* TEMA WARNA */
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
        h3,
        .font-serif-quote {
            font-family: 'Lora', serif;
        }

        /* Animasi */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }

        /* Bubble Chat Specific Hover */
        .chat-bubble {
            transition: all 0.3s ease;
        }

        .chat-container:hover .chat-bubble {
            border-color: var(--secondary);
            box-shadow: 0 10px 25px -5px rgba(30, 58, 95, 0.08);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/75 backdrop-blur-[1px]"></div>

        <div class="relative max-w-4xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-4 reveal active" style="color: var(--accent);">
                Keluarga Besar Ekopem</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 reveal active text-white leading-snug">
                Pesan & Kesan <br /><span style="color: var(--accent);">Alumni Kami</span>
            </h1>
            <p class="text-lg md:text-xl reveal active delay-1" style="color: var(--soft-bg);">
                Jejak langkah, pengalaman, dan cerita inspiratif dari mereka yang telah merajut kisah sukses setelah
                lulus dari program studi Ekonomi Pembangunan.
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 pb-24">
        <div class="space-y-8 md:space-y-10">
            @forelse($alumni as $index => $a)
                <div class="flex items-start gap-3 md:gap-5 reveal active chat-container">

                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-full overflow-hidden flex-shrink-0 mt-1 shadow-sm border-2"
                        style="border-color: var(--soft-bg);">
                        @if ($a->urlFotoAlumni)
                            <img src="{{ asset('assets/admin/uploads/alumni/' . $a->urlFotoAlumni) }}"
                                alt="{{ $a->namaAlumni }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-bold text-xl"
                                style="background-color: var(--soft-bg); color: var(--secondary);">
                                {{ strtoupper(substr($a->namaAlumni ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col w-full max-w-2xl">
                        <div class="mb-1.5 ml-2 flex flex-wrap items-baseline gap-x-2 gap-y-1">
                            <span class="font-bold text-base" style="color: var(--primary);">{{ $a->namaAlumni }}</span>
                            <span class="text-xs font-semibold uppercase tracking-wider"
                                style="color: var(--medium-neutral);">
                                Angkatan {{ $a->angkatanAlumni }} &bull; Lulus {{ $a->tahunLulusAlumni }}
                            </span>
                        </div>

                        <div
                            class="chat-bubble bg-white p-5 md:p-6 shadow-sm border border-[var(--card-border)] rounded-2xl rounded-tl-none">
                            @if ($a->kesanAlumni)
                                <h3 class="font-serif-quote font-bold text-lg md:text-xl mb-3 leading-snug"
                                    style="color: var(--primary);">
                                    "{{ $a->kesanAlumni }}"
                                </h3>
                            @endif

                            @if ($a->pesanAlumni)
                                <p class="text-sm md:text-base leading-relaxed" style="color: var(--dark-neutral);">
                                    {{ $a->pesanAlumni }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-1.5 ml-2">
                            <span class="text-[10px] font-medium" style="color: var(--medium-neutral);">Pesan dari
                                Alumni</span>
                        </div>
                    </div>

                </div>
            @empty
                <div class="py-20 text-center bg-white rounded-3xl border border-dashed reveal active"
                    style="border-color: var(--card-border);">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-40" style="color: var(--secondary);" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <h3 class="text-lg font-bold mb-1" style="color: var(--primary);">Belum Ada Pesan</h3>
                    <p class="text-sm" style="color: var(--medium-neutral);">
                        Belum ada data pesan dan kesan alumni yang ditambahkan ke dalam sistem.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Animasi Reveal saat scroll
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
