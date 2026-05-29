<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judulBerita }} — Ekonomi Pembangunan UNPAR</title>
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
            --card-bg: #FFFFFF;
        }

        body { font-family: 'DM Sans', sans-serif; color: var(--dark-neutral); background-color: white; }
        h1, h2, h3 { font-family: 'Lora', serif; color: var(--primary); }

        /* Article Content Styling */
        .article-content p {
            margin-bottom: 2rem;
            font-size: 1.15rem;
            line-height: 2;
            color: #374151;
            text-align: justify;
        }
        .article-content h2, .article-content h3 {
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            font-size: 1.85rem;
            font-weight: 700;
            line-height: 1.4;
        }
        .article-content ul, .article-content ol {
            margin-bottom: 2rem;
            padding-left: 1.5rem;
            font-size: 1.15rem;
            line-height: 2;
        }
        .article-content li { margin-bottom: 0.5rem; }

        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

@include('frontend.layout.navbar')

<section class="pt-32 pb-12 px-4 bg-[var(--light-neutral)]">
    <div class="max-w-5xl mx-auto">
        <nav class="flex items-center gap-4 mb-8 reveal active">
            <a href="{{ route('frontend.berita') }}" class="flex items-center gap-2 text-sm font-bold transition-colors hover:text-[var(--accent)]" style="color: var(--secondary);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
                Kembali ke Berita
            </a>
            <span class="text-gray-300">/</span>
            <span class="text-xs font-bold text-[var(--accent)] uppercase tracking-wider">{{ $berita->kategoriBerita ?? 'Berita' }}</span>
        </nav>

        <div class="reveal active delay-1">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-6">{{ $berita->judulBerita }}</h1>

            <div class="flex flex-wrap items-center gap-6 py-6 border-y border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[var(--soft-bg)] text-[var(--secondary)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-[var(--medium-neutral)]">Penulis</p>
                        <p class="text-sm font-bold">Admin Prodi</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[var(--soft-bg)] text-[var(--secondary)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-[var(--medium-neutral)]">Diterbitkan</p>
                        <p class="text-sm font-bold">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<article class="py-12 px-4">
    <div class="max-w-5xl mx-auto">

        <div class="rounded-3xl overflow-hidden shadow-xl mb-10 md:mb-14 reveal active aspect-video relative w-full">
            @if($berita->fotoBerita)
                <img src="{{ asset('assets/admin/uploads/berita/' . $berita->fotoBerita) }}" alt="{{ $berita->judulBerita }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-[var(--primary)] flex items-center justify-center text-white italic">Gambar tidak tersedia</div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-14">

            <aside class="lg:col-span-4 order-2 lg:order-1 flex flex-col gap-6 reveal active delay-1">
                <div class="border-b-2 border-gray-100 pb-3 mb-2 flex items-center gap-2">
                    <div class="w-1.5 h-6 bg-[var(--accent)] rounded-full"></div>
                    <h3 class="text-lg font-bold text-[var(--primary)]">Berita Terbaru</h3>
                </div>

                <div class="flex flex-col gap-5">
                    @php
                        // Mengambil 3 berita terbaru yang di-post, kecuali berita yang sedang dibaca
                        $beritaTerbaru = \App\Models\Berita::where('statusBerita', 'Published')
                            ->where('idBerita', '!=', $berita->idBerita)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
                    @endphp

                    @forelse($beritaTerbaru as $recent)
                    <a href="{{ route('frontend.baca_berita', $recent->idBerita) }}" class="flex gap-4 group">
                        <div class="w-20 h-20 md:w-24 md:h-20 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                            @if($recent->fotoBerita)
                                <img src="{{ asset('assets/admin/uploads/berita/' . $recent->fotoBerita) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="text-[9px] font-bold text-[var(--accent)] uppercase tracking-wider mb-1">{{ \Carbon\Carbon::parse($recent->created_at)->translatedFormat('d M Y') }}</span>
                            <h4 class="text-sm font-bold leading-snug line-clamp-2 group-hover:text-[var(--secondary)] transition-colors text-[var(--primary)]">
                                {{ $recent->judulBerita }}
                            </h4>
                        </div>
                    </a>
                    @empty
                    <p class="text-sm text-gray-400 italic">Belum ada berita terbaru.</p>
                    @endforelse
                </div>
            </aside>

            <div class="lg:col-span-8 order-1 lg:order-2 flex flex-col">
                <div class="flex-1 article-content reveal active delay-2">
                    {!! $berita->deskripsiBerita !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-200 reveal">
                    <p class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">Bagikan Berita Ini</p>
                    <div class="flex flex-wrap gap-4">

                        <a href="https://wa.me/?text={{ urlencode($berita->judulBerita . ' - ' . url()->current()) }}" target="_blank" class="w-12 h-12 rounded-full flex items-center justify-center bg-[#25D366] text-white shadow-md hover:-translate-y-1 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-12 h-12 rounded-full flex items-center justify-center bg-[#1877F2] text-white shadow-md hover:-translate-y-1 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>

                        <a href="https://t.me/share/url?url={{ url()->current() }}&text={{ urlencode($berita->judulBerita) }}" target="_blank" class="w-12 h-12 rounded-full flex items-center justify-center bg-[#0088cc] text-white shadow-md hover:-translate-y-1 transition-transform pl-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.96 7.224l-1.92 9.048c-.144.648-.528.816-1.056.528l-2.928-2.16-1.416 1.368c-.168.168-.312.312-.648.312l.216-3.048 5.544-5.016c.24-.216-.048-.336-.384-.144l-6.864 4.32-2.952-.936c-.648-.216-.672-.648.144-.96l11.52-4.44c.528-.192 1.008.12 1.008.864z"/></svg>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($berita->judulBerita) }}" target="_blank" class="w-12 h-12 rounded-full flex items-center justify-center bg-black text-white shadow-md hover:-translate-y-1 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</article>

<section class="py-20 bg-[var(--light-neutral)]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-end mb-10 reveal">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--secondary);">Lanjut Membaca</span>
                <h2 class="text-3xl font-bold mt-2">Berita Terkait Lainnya</h2>
            </div>
            <a href="{{ route('frontend.berita') }}" class="text-sm font-bold border-b-2 border-[var(--accent)] pb-1 hover:text-[var(--accent)] transition-colors">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($beritaTerkait as $bt)
            <a href="{{ route('frontend.baca_berita', $bt->idBerita) }}" class="flex flex-col bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all group reveal">
                <div class="aspect-video relative overflow-hidden bg-gray-100">
                    @if($bt->fotoBerita)
                        <img src="{{ asset('assets/admin/uploads/berita/' . $bt->fotoBerita) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-[10px] font-bold text-[var(--medium-neutral)] uppercase mb-2">{{ \Carbon\Carbon::parse($bt->created_at)->translatedFormat('d F Y') }}</p>
                    <h3 class="text-sm font-bold line-clamp-2 leading-snug group-hover:text-[var(--secondary)] transition-colors">{{ $bt->judulBerita }}</h3>
                </div>
            </a>
            @empty
            <p class="col-span-full text-center text-gray-400 italic">Tidak ada berita terkait lainnya untuk saat ini.</p>
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
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
