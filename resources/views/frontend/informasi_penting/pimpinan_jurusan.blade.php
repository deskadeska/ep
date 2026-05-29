<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pimpinan Jurusan — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* TEMA WARNA STANDAR */
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

        h1, h2 { font-family: 'Lora', serif; color: var(--primary); }

        /* Animasi Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .delay-1 { transition-delay: 0.1s; }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-16 px-4 relative bg-cover bg-center bg-no-repeat overflow-hidden" style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">

        <div class="absolute inset-0 bg-[#1E3A5F]/85 backdrop-blur-[1px]"></div>

        <div class="relative max-w-5xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">Profil Jurusan</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Pimpinan Jurusan</h1>
            <p class="max-w-2xl mx-auto text-base font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Daftar pimpinan Program Studi Ekonomi Pembangunan, Universitas Palangka Raya, dari masa ke masa.
            </p>
        </div>
    </section>

    <section class="pt-16 pb-20 px-4 max-w-7xl mx-auto">

        @if(isset($pimpinan) && $pimpinan->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">

                @foreach($pimpinan as $pj)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 hover:shadow-md transition-shadow reveal active">

                    <h2 class="text-xl md:text-2xl font-bold text-center text-[#2A6F97] mb-6 md:mb-8 pb-4 border-b border-gray-100">
                        Periode {{ $pj->tahunMulaiPJ }} - {{ $pj->tahunSelesaiPJ }}
                    </h2>

                    <div class="grid grid-cols-2 gap-x-4 md:gap-x-12 gap-y-4 justify-items-center">

                        <div class="text-center flex flex-col items-center">
                            <div class="w-24 md:w-32 h-32 md:h-40 mx-auto mb-3 md:mb-4 overflow-hidden rounded-lg shadow-sm border-2 border-white ring-2 ring-gray-100">
                                @if($pj->ketua)
                                    <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/' . ($pj->ketua->urlFotoTP ?: 'default.png')) }}"
                                         alt="{{ $pj->ketua->namaTP }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/default.png') }}" alt="Default" class="w-full h-full object-cover">
                                @endif
                            </div>
                            @if($pj->ketua)
                                <p class="text-sm md:text-lg font-bold text-gray-800 mb-0.5">{{ $pj->ketua->namaTP }}</p>
                                <p class="text-[10px] md:text-xs font-bold text-[#F2A541]">Ketua Jurusan</p>
                                <p class="text-[9px] md:text-[11px] text-gray-500 mt-1">{{ \Carbon\Carbon::parse($pj->tahunMulaiPJ)->format('Y') }} - {{ \Carbon\Carbon::parse($pj->tahunSelesaiPJ)->format('Y') }}</p>
                            @else
                                <p class="text-xs text-red-500 italic">Data Dosen Tidak Ditemukan</p>
                            @endif
                        </div>

                        <div class="text-center flex flex-col items-center">
                            <div class="w-24 md:w-32 h-32 md:h-40 mx-auto mb-3 md:mb-4 overflow-hidden rounded-lg shadow-sm border-2 border-white ring-2 ring-gray-100">
                                @if($pj->sekretaris)
                                    <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/' . ($pj->sekretaris->urlFotoTP ?: 'default.png')) }}"
                                         alt="{{ $pj->sekretaris->namaTP }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/default.png') }}" alt="Default" class="w-full h-full object-cover">
                                @endif
                            </div>
                            @if($pj->sekretaris)
                                <p class="text-sm md:text-lg font-bold text-gray-800 mb-0.5">{{ $pj->sekretaris->namaTP }}</p>
                                <p class="text-[10px] md:text-xs font-bold text-[#F2A541]">Sekretaris Jurusan</p>
                                <p class="text-[9px] md:text-[11px] text-gray-500 mt-1">{{ \Carbon\Carbon::parse($pj->tahunMulaiPJ)->format('Y') }} - {{ \Carbon\Carbon::parse($pj->tahunSelesaiPJ)->format('Y') }}</p>
                            @else
                                <p class="text-xs text-red-500 italic">Data Dosen Tidak Ditemukan</p>
                            @endif
                        </div>

                    </div> </div>
                @endforeach

            </div>
        @else
            <div class="text-center py-24 bg-white rounded-3xl border border-gray-100 shadow-sm reveal active delay-1">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2 2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Data Belum Tersedia</h3>
                <p class="text-gray-500">Bagan dan deskripsi pimpinan jurusan sedang dalam tahap pembaruan.</p>
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
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>

</html>
