<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keperluan Tugas Akhir — Ekonomi Pembangunan UPR</title>
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

        /* Animasi Scroll */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Accordion Styles (Sudah Diperbaiki) */
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .accordion-item.is-open .accordion-content {
            max-height: 1000px;
            /* Angka besar agar muat untuk banyak item */
        }

        .accordion-item.is-open .accordion-icon {
            transform: rotate(180deg);
        }

        .accordion-icon {
            transition: transform 0.4s ease;
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
                Panduan Kelulusan</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Keperluan Tugas Akhir</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Temukan dan unduh dokumen, persyaratan, serta kelengkapan administrasi tugas akhir Anda pada daftar di
                bawah ini.
            </p>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto space-y-4">

            @forelse($keperluan as $index => $group)
                <div
                    class="accordion-item bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden reveal">

                    <button
                        class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 focus:outline-none transition-colors"
                        onclick="toggleAccordion(this)">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-lg"
                                style="background-color: var(--soft-bg); color: var(--secondary);">
                                {{ $index + 1 }}
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold m-0" style="color: var(--primary);">
                                {{ $group->kelompokKTA }}</h2>
                        </div>

                        <div class="w-8 h-8 rounded-full flex items-center justify-center bg-gray-100 flex-shrink-0">
                            <svg class="w-5 h-5 accordion-icon" style="color: var(--medium-neutral);" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>

                    <div class="accordion-content bg-[var(--light-neutral)]">
                        <div class="p-6 border-t border-gray-100">
                            <ul class="space-y-3">
                                @forelse($group->details as $detail)
                                    <li
                                        class="flex items-center justify-between p-4 rounded-xl bg-white border border-gray-100 shadow-sm hover:border-[var(--secondary)] transition-colors">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-5 h-5 flex-shrink-0" style="color: var(--accent);"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span
                                                class="font-medium text-sm md:text-base text-[var(--dark-neutral)]">{{ $detail->namaKTA }}</span>
                                        </div>

                                        @if ($detail->urlFile)
                                            <a href="{{ route('frontend.download_tugas_akhir', $detail->idDKTA) }}"
                                                class="ml-4 w-9 h-9 flex-shrink-0 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm bg-[var(--primary)] text-white hover:bg-[var(--secondary)]"
                                                title="Unduh Dokumen">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </a>
                                        @else
                                            <span
                                                class="text-[10px] ml-4 font-bold uppercase tracking-wider px-2.5 py-1 rounded-md bg-gray-100 text-gray-400 border border-gray-200">
                                                Info Saja
                                            </span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="text-center py-4 text-sm text-gray-400 italic">Belum ada detail
                                        persyaratan untuk kelompok ini.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                </div>
            @empty
                <div class="py-20 text-center bg-white rounded-3xl border border-dashed border-gray-300 reveal active">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-lg font-bold text-gray-400">Data belum tersedia</h3>
                </div>
            @endforelse

        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Logika Accordion / Dropdown yang sudah diperbaiki
        function toggleAccordion(element) {
            // Ambil elemen parent (.accordion-item)
            const currentItem = element.closest('.accordion-item');

            // Cek apakah elemen ini sedang terbuka (menggunakan class is-open)
            const isOpen = currentItem.classList.contains('is-open');

            // Toggle status buka/tutup pada elemen yang di-klik
            if (!isOpen) {
                currentItem.classList.add('is-open');
            } else {
                currentItem.classList.remove('is-open');
            }
        }

        // Efek Reveal pada Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Ketika elemen terlihat di layar, tambahkan class 'active'
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
