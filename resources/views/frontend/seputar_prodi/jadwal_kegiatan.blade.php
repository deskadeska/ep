<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        h1, h2, h3 { font-family: 'Lora', serif; color: var(--primary); }

        /* Animasi Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-16 px-4 relative bg-cover bg-center bg-no-repeat overflow-hidden" style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">

        <div class="absolute inset-0 bg-[#1E3A5F]/85 backdrop-blur-[1px]"></div>

        <div class="relative max-w-5xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">Seputar Prodi</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Jadwal Kegiatan</h1>
            <p class="max-w-2xl mx-auto text-base font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Informasi agenda dan kegiatan terbaru di lingkungan Program Studi Ekonomi Pembangunan Universitas Palangka Raya.
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 py-16">

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-10 reveal active">

            <h2 class="text-2xl font-bold mb-8 border-b pb-4 border-gray-100 flex items-center gap-3">
                <svg class="w-7 h-7 text-[#F2A541]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Agenda Kedepan
            </h2>

            @if(isset($jadwal) && $jadwal->count() > 0)
                <div class="relative border-l-2 border-gray-100 ml-3 md:ml-4">
                    @foreach($jadwal as $jk)
                        @php
                            $hariIni = \Carbon\Carbon::today();
                            $tglKegiatan = \Carbon\Carbon::parse($jk->tanggalJK)->startOfDay();
                            $selisihHari = $hariIni->diffInDays($tglKegiatan, false);
                        @endphp

                        <div class="mb-10 ml-8 relative group">

                            <span class="absolute flex items-center justify-center w-5 h-5 rounded-full -left-[41px] ring-4 ring-white
                                {{ $jk->statusJK ? 'bg-gray-300' : ($selisihHari == 0 ? 'bg-red-500 animate-pulse' : 'bg-[#F2A541]') }}">
                            </span>

                            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 md:p-6 transition-all duration-300 hover:shadow-md hover:bg-white hover:border-blue-100 {{ $jk->statusJK ? 'opacity-60 grayscale-[50%]' : '' }}">

                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-3">
                                    <div>
                                        <div class="flex items-center gap-2 text-sm font-bold mb-2" style="color: var(--secondary);">
                                            <span>{{ \Carbon\Carbon::parse($jk->tanggalJK)->translatedFormat('l, d F Y') }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 {{ $jk->statusJK ? 'line-through' : '' }}">{{ $jk->judulKegiatanJK }}</h3>
                                    </div>

                                    <div class="flex-shrink-0">
                                        @if($jk->statusJK)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                Selesai
                                            </span>
                                        @else
                                            @if($selisihHari > 3)
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-[#E8F1F8] text-[#2A6F97]">Akan Datang</span>
                                            @elseif($selisihHari == 3)
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 shadow-sm">H-3</span>
                                            @elseif($selisihHari == 2)
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 shadow-sm">H-2</span>
                                            @elseif($selisihHari == 1)
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700 shadow-sm">H-1</span>
                                            @elseif($selisihHari == 0)
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-700 shadow-sm animate-bounce inline-block">Sedang Berlangsung</span>
                                            @elseif($selisihHari < 0)
                                                <span class="px-3 py-1.5 rounded-full text-xs font-bold bg-gray-200 text-gray-700">Menunggu Evaluasi</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ $jk->deskripsiSingkatJK }}
                                </p>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center reveal active delay-1">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Agenda</h3>
                    <p class="text-gray-500">Saat ini belum ada jadwal kegiatan baru yang dipublikasikan.</p>
                </div>
            @endif

        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
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
