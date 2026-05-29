<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Video — Ekonomi Pembangunan UPR</title>
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
        body { font-family: 'DM Sans', sans-serif; color: var(--dark-neutral); background-color: var(--light-neutral); }
        h1, h2, h3 { font-family: 'Lora', serif; color: var(--primary); }

        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

@include('frontend.layout.navbar')

@php
    function getYtId($url) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return $match[1] ?? null;
    }
@endphp

<section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
    <div class="absolute inset-0 bg-[#1E3A5F]/90 backdrop-blur-sm"></div>
    <div class="relative max-w-4xl mx-auto text-center z-10">
        <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">Media & Penyiaran</p>
        <h1 class="text-3xl md:text-5xl font-bold mb-6 reveal active text-white">Galeri Video</h1>

        <p class="text-base md:text-lg mb-8 reveal active delay-1 text-gray-200 leading-relaxed">
            Saksikan berbagai liputan kegiatan, profil program studi, seminar, dan dokumentasi audiovisual lainnya.
            Dukung kami dengan cara bergabung bersama komunitas digital kami di YouTube resmi
            <span class="font-bold text-white">Ekonomi Pembangunan UPR</span>.
        </p>

        <div class="reveal active delay-2">
            <a href="https://youtube.com/@ekonomipembangunanupr?si=NscR5fDBoaPpgvLs" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transition-transform hover:scale-105">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                Subscribe Channel Kami
            </a>
        </div>
    </div>
</section>

<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">

        @if($pinnedVideo)
            @php $pinnedId = getYtId($pinnedVideo->urlYoutube); @endphp
            @if($pinnedId)
            <div class="mb-16 reveal active">
                <div class="flex items-center gap-2 mb-6">
                    <svg class="w-6 h-6 text-[#F2A541]" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                    <h2 class="text-2xl font-bold" style="color: var(--navy);">Video Utama</h2>
                </div>

                <div class="w-full max-w-4xl mx-auto bg-black rounded-2xl overflow-hidden shadow-lg aspect-video relative">
                    <iframe
                        class="absolute inset-0 w-full h-full"
                        src="https://www.youtube.com/embed/{{ $pinnedId }}"
                        title="{{ $pinnedVideo->judulVideo }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>

                <div class="max-w-4xl mx-auto mt-4">
                    <h3 class="text-xl md:text-2xl font-bold" style="color: var(--navy);">{{ $pinnedVideo->judulVideo }}</h3>
                </div>
            </div>
            @endif
        @endif

        @if($otherVideos->count() > 0)
            @if($pinnedVideo)
                <div class="flex items-center justify-between mb-8 reveal active border-t border-gray-200 pt-10">
                    <h2 class="text-2xl font-bold" style="color: var(--navy);">Video Lainnya</h2>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 reveal active">
                @foreach($otherVideos as $video)
                    @php $ytId = getYtId($video->urlYoutube); @endphp
                    @if($ytId)
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col">

                        <div class="aspect-video bg-black relative w-full flex-shrink-0">
                            <iframe
                                class="absolute inset-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $ytId }}"
                                title="{{ $video->judulVideo }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <div class="p-5 flex-grow">
                            <h3 class="text-base font-bold text-gray-900 line-clamp-2 leading-snug">
                                {{ $video->judulVideo }}
                            </h3>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        @elseif(!$pinnedVideo)
            <div class="py-20 text-center bg-white rounded-2xl border border-dashed border-gray-300 shadow-sm reveal active">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <h3 class="text-lg font-bold text-gray-500 mb-1">Belum Ada Video</h3>
                <p class="text-sm text-gray-400">Galeri video kegiatan akan segera ditambahkan.</p>
            </div>
        @endif

    </div>
</section>

@include('frontend.layout.footer')

<script>
    // Animasi Muncul saat Scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
