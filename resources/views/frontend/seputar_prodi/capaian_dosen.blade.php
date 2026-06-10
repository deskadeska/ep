<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capaian Dosen — Ekonomi Pembangunan UPR</title>
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
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--secondary);
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
                Prestasi & Dedikasi</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Capaian Dosen</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Apresiasi dan rekam jejak prestasi, penghargaan, serta sertifikasi bergengsi yang diraih oleh para tenaga pengajar Jurusan Ekonomi Pembangunan.
            </p>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-5xl mx-auto">

            <div class="flex flex-col gap-10">

                @forelse($capaianDosen as $cd)
                    @php
                        // Logika warna label tingkat capaian
                        $badgeColor = 'bg-gray-100 text-gray-700'; // Lokal
                        if($cd->tingkatCD == 'Nasional') $badgeColor = 'bg-emerald-50 text-emerald-700';
                        elseif($cd->tingkatCD == 'Internasional') $badgeColor = 'bg-[#F2A541]/10 text-[#d4882e]';

                        // Cek jenis file untuk preview gambar vs pdf
                        $isImage = false;
                        if($cd->fileSertifikatCD) {
                            $ext = strtolower(pathinfo($cd->fileSertifikatCD, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                        }
                    @endphp

                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col md:flex-row group reveal active card-hover shadow-sm">

                        <div class="p-6 md:p-8 flex flex-col justify-center relative z-10 md:w-2/5">

                            <div class="flex items-center gap-4 mb-5">
                                @if($cd->tenagaPengajar && $cd->tenagaPengajar->urlFotoTP)
                                    <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/' . $cd->tenagaPengajar->urlFotoTP) }}" alt="{{ $cd->tenagaPengajar->namaTP }}" class="w-12 h-12 rounded-full object-cover shadow-sm border border-gray-100">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-[var(--soft-bg)] flex items-center justify-center text-[var(--secondary)] font-bold text-lg shadow-sm border border-gray-100">
                                        {{ substr($cd->tenagaPengajar->namaTP ?? 'A', 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm leading-tight">{{ $cd->tenagaPengajar->namaTP ?? 'Dosen Anonim' }}</h3>
                                    <p class="text-[11px] text-gray-500 mt-1 uppercase tracking-wider font-bold">Tahun {{ $cd->tahunCD }}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span class="inline-block px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest border border-white {{ $badgeColor }}">
                                    {{ $cd->tingkatCD }}
                                </span>
                            </div>

                            <h2 class="text-xl md:text-2xl font-bold leading-snug mb-3 text-[var(--primary)]">{{ $cd->judulCD }}</h2>

                            @if($cd->deskripsiCD)
                                <p class="text-sm text-gray-600 leading-relaxed relative z-10">
                                    {{ $cd->deskripsiCD }}
                                </p>
                            @else
                                <p class="text-sm text-gray-400 italic">Tidak ada rincian deskripsi untuk capaian ini.</p>
                            @endif
                        </div>

                        <div class="md:w-3/5 bg-gray-50 border-t md:border-t-0 md:border-l border-gray-100 overflow-hidden relative flex items-center justify-center min-h-[250px] md:min-h-[320px]">

                            @if($cd->fileSertifikatCD && $isImage)
                                <a href="{{ asset('assets/admin/uploads/capaian_dosen/' . $cd->fileSertifikatCD) }}" target="_blank" class="absolute inset-0 w-full h-full block">
                                    <img src="{{ asset('assets/admin/uploads/capaian_dosen/' . $cd->fileSertifikatCD) }}" alt="Sertifikat" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <div class="bg-white/20 backdrop-blur-sm p-3 rounded-full text-white">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                        </div>
                                    </div>
                                </a>
                            @elseif($cd->fileSertifikatCD && !$isImage)
                                <a href="{{ asset('assets/admin/uploads/capaian_dosen/' . $cd->fileSertifikatCD) }}" target="_blank" class="absolute inset-0 flex flex-col items-center justify-center bg-[var(--soft-bg)] text-[var(--secondary)] hover:bg-[var(--primary)] hover:text-white transition-colors duration-300 p-6">
                                    <svg class="w-16 h-16 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <span class="font-bold text-sm tracking-widest uppercase">Dokumen PDF</span>
                                    <span class="text-xs mt-1 opacity-70">Klik untuk membuka</span>
                                </a>
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-100 p-6 text-gray-400">
                                    <svg class="w-12 h-12 mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    <span class="font-semibold text-[10px] tracking-widest uppercase opacity-60 text-center">Sertifikat<br>Tidak Dilampirkan</span>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="py-20 text-center bg-white rounded-3xl border border-dashed border-gray-300 reveal active">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-30 text-[var(--secondary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <h3 class="text-xl font-bold text-gray-800">Belum Ada Capaian</h3>
                        <p class="text-gray-500 mt-2">Data prestasi atau capaian dosen belum diunggah ke dalam sistem.</p>
                    </div>
                @endforelse

            </div>

            @if($capaianDosen->hasPages())
                <div class="mt-12 reveal active">
                    {{ $capaianDosen->links() }}
                </div>
            @endif

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
