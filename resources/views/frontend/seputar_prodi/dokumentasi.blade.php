<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi Kegiatan — Ekonomi Pembangunan UPR</title>
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
            --medium-neutral: #6B7280;
            --light-neutral: #F4F6F9;
        }
        body { font-family: 'DM Sans', sans-serif; color: var(--dark-neutral); background-color: var(--light-neutral); }
        h1, h2, h3 { font-family: 'Lora', serif; color: var(--primary); }

        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* Efek hover pada item dokumentasi */
        .dok-item { transition: transform 0.3s ease; }
        .dok-item:hover { transform: translateY(-4px); }
        .dok-overlay {
            background: linear-gradient(to top, rgba(30, 58, 95, 0.95) 0%, rgba(30, 58, 95, 0.4) 60%, transparent 100%);
        }
    </style>
</head>
<body>

@include('frontend.layout.navbar')

<section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
    <div class="absolute inset-0 bg-[#1E3A5F]/85 backdrop-blur-[1px]"></div>
    <div class="relative max-w-7xl mx-auto text-center z-10">
        <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">Galeri & Memori</p>
        <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Dokumentasi Kegiatan</h1>
        <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
            Kumpulan momen, acara, dan aktivitas civitas akademika Jurusan Ekonomi Pembangunan Universitas Palangka Raya.
        </p>
    </div>
</section>

<section class="py-16 px-4 min-h-screen">
    <div class="max-w-7xl mx-auto">

        @if($dokumentasi->count() > 0)

            <div class="columns-2 md:columns-3 lg:columns-4 gap-3 sm:gap-4 mx-auto space-y-3 sm:space-y-4 reveal active">

                @foreach($dokumentasi as $dok)
                <div class="dok-item relative rounded-xl overflow-hidden shadow-sm group cursor-pointer break-inside-avoid">
                    <img src="{{ asset('assets/admin/uploads/dokumentasi/' . $dok->urlFotoDokumentasi) }}"
                         alt="{{ $dok->judulDokumentasi }}"
                         loading="lazy"
                         class="w-full h-auto object-cover block">

                    <div class="dok-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3 sm:p-4 pointer-events-none">
                        <span class="text-[9px] sm:text-[10px] font-bold tracking-widest text-[var(--accent)] uppercase mb-1">
                            {{ \Carbon\Carbon::parse($dok->tanggalDokumentasi)->translatedFormat('d M Y') }}
                        </span>
                        <h3 class="text-white text-xs sm:text-sm font-bold leading-tight line-clamp-3">
                            {{ $dok->judulDokumentasi }}
                        </h3>
                    </div>
                </div>
                @endforeach

            </div>

        @else
            <div class="py-20 text-center bg-white rounded-2xl border border-dashed border-gray-300 shadow-sm reveal active">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <h3 class="text-lg font-bold text-gray-500 mb-1">Belum Ada Dokumentasi</h3>
                <p class="text-sm text-gray-400">Dokumentasi kegiatan akan segera ditambahkan.</p>
            </div>
        @endif

    </div>
</section>

@include('frontend.layout.footer')

<script>
    // Scroll Animasi
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
