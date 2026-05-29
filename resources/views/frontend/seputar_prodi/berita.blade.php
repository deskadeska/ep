<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Artikel — Ekonomi Pembangunan UNPAR</title>
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
            --card-border: #E5E7EB;
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
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-track {
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .slide-indicator.active {
            width: 24px;
            background-color: var(--accent);
        }

        /* State aktif untuk tombol kategori Masonry */
        .cat-btn.active {
            background-color: var(--soft-bg);
            color: var(--secondary);
            font-weight: 700;
            border-color: var(--accent);
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-28 pb-10 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8 reveal active">
                <p class="text-sm font-bold uppercase tracking-widest mb-2" style="color: var(--secondary);">Seputar
                    Prodi</p>
                <h1 class="text-3xl md:text-5xl font-bold" style="color: var(--primary);">Berita & Informasi Terbaru
                </h1>
            </div>

            @if ($highlights->count() > 0)
                <div
                    class="relative w-full h-[400px] md:h-[480px] rounded-3xl overflow-hidden shadow-xl reveal active group border border-gray-100 bg-slate-900">

                    <div id="slider-track" class="flex w-full h-full slide-track">
                        @foreach ($highlights as $h)
                            <div class="w-full h-full relative flex-shrink-0 cursor-pointer flex flex-col justify-end"
                                onclick="window.location='{{ route('frontend.baca_berita', $h->idBerita) }}'">

                                <div class="absolute inset-0 w-full h-full z-0">
                                    @if ($h->fotoBerita)
                                        <img src="{{ asset('assets/admin/uploads/berita/' . $h->fotoBerita) }}"
                                            alt="{{ $h->judulBerita }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-[#1E3A5F] to-[#2A6F97]"></div>
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-[#1A2C44] via-[#1E3A5F]/60 to-transparent">
                                    </div>
                                </div>

                                <div class="relative z-10 p-6 md:p-12 w-full md:w-3/4 select-none">
                                    <span
                                        class="inline-block bg-[var(--accent)] text-[var(--dark-neutral)] text-[10px] md:text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 shadow-sm">
                                        Highlight &bull; {{ $h->kategoriBerita ?? 'Umum' }}
                                    </span>
                                    <h2
                                        class="text-xl md:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight group-hover:text-[var(--accent)] transition-colors line-clamp-2">
                                        {{ $h->judulBerita }}
                                    </h2>
                                    <p class="text-xs md:text-sm text-gray-200 line-clamp-3 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit($h->deskripsiBerita, 230, ' ...') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($highlights->count() > 1)
                        <button id="btn-prev"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/30 hover:bg-black/60 text-white opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center z-20 backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="btn-next"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-black/30 hover:bg-black/60 text-white opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center z-20 backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <div class="absolute bottom-6 right-8 flex gap-2 z-20" id="slider-indicators">
                            @foreach ($highlights as $index => $h)
                                <div class="slide-indicator w-2.5 h-2.5 rounded-full bg-white/40 cursor-pointer transition-all duration-300 {{ $index == 0 ? 'active' : '' }}"
                                    data-slide="{{ $index }}"></div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <section class="pb-20 px-4">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8 lg:gap-10">

            <aside class="w-full lg:w-1/4 reveal active">
                <div class="bg-white rounded-2xl border border-[var(--card-border)] shadow-sm p-5 md:p-6 sticky top-28">
                    <div class="flex items-center gap-2 mb-5 border-b border-gray-100 pb-4">
                        <svg class="w-5 h-5 text-[var(--secondary)]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <h3 class="text-lg font-bold text-[var(--primary)]">Kategori Berita</h3>
                    </div>

                    <div class="columns-2 gap-2 space-y-2">
                        <button
                            class="cat-btn active w-full break-inside-avoid text-left px-3 py-2 rounded-lg text-xs transition-all text-gray-600 border border-gray-200 hover:bg-gray-50"
                            data-cat="all">
                            Semua Berita
                        </button>
                        @foreach ($categories as $cat)
                            <button
                                class="cat-btn w-full break-inside-avoid text-left px-3 py-2 rounded-lg text-xs transition-all text-gray-600 border border-gray-200 hover:bg-gray-50"
                                data-cat="{{ strtolower($cat) }}">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </aside>

            <main class="w-full lg:w-3/4 reveal active">

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">

                    <h2 class="text-xl md:text-2xl font-bold text-[var(--primary)] w-full md:w-1/3" id="dynamic-title">
                        Semua Berita</h2>

                    <div class="relative w-full md:w-2/3 z-40">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchInput" autocomplete="off" placeholder="Cari judul berita..."
                            class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 shadow-sm rounded-full outline-none text-sm font-medium focus:ring-2 focus:ring-[var(--secondary)] focus:border-transparent transition-all placeholder-gray-400">

                        <ul id="search-suggestions"
                            class="absolute w-full bg-white border border-gray-200 shadow-xl rounded-2xl mt-2 overflow-hidden hidden flex-col max-h-60 overflow-y-auto">
                        </ul>
                    </div>
                </div>

                <div id="news-container" class="grid grid-cols-2 md:grid-cols-2 gap-3 md:gap-6">
                    @foreach ($published as $b)
                        <a href="{{ route('frontend.baca_berita', $b->idBerita) }}"
                            class="news-item flex flex-col bg-white rounded-2xl overflow-hidden border border-[var(--card-border)] hover:shadow-xl hover:border-[var(--secondary)] hover:-translate-y-1 transition-all duration-300 group"
                            data-title="{{ strtolower($b->judulBerita) }}" data-original-title="{{ $b->judulBerita }}"
                            data-category="{{ strtolower($b->kategoriBerita) }}">

                            <div class="aspect-[4/3] md:aspect-[16/9] w-full relative overflow-hidden bg-gray-100">
                                @if ($b->fotoBerita)
                                    <img src="{{ asset('assets/admin/uploads/berita/' . $b->fotoBerita) }}"
                                        alt="Berita"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8 md:w-12 md:h-12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                                <span
                                    class="absolute top-2 left-2 md:top-4 md:left-4 px-2 py-0.5 md:px-3 md:py-1 rounded-md md:rounded-lg text-[9px] md:text-[10px] font-bold uppercase tracking-wider shadow-md backdrop-blur-sm bg-white/90 text-[var(--secondary)]">
                                    {{ $b->kategoriBerita ?? 'Berita' }}
                                </span>
                            </div>

                            <div class="p-3 md:p-6 flex flex-col flex-grow">
                                <p
                                    class="text-[9px] md:text-xs font-semibold mb-2 md:mb-3 uppercase tracking-wider text-[var(--accent)] flex items-center gap-1">
                                    <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($b->created_at)->translatedFormat('d F Y') }}
                                </p>
                                <h3 class="text-sm md:text-lg font-bold line-clamp-2 mb-2 md:mb-3 leading-snug group-hover:text-[var(--secondary)] transition-colors"
                                    style="color: var(--primary);">
                                    {{ $b->judulBerita }}
                                </h3>
                                <p
                                    class="text-xs md:text-sm text-[var(--medium-neutral)] line-clamp-3 mt-auto leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit($b->deskripsiBerita, 200, '...') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div id="empty-state"
                    class="hidden py-16 text-center bg-white rounded-3xl border border-dashed border-gray-300 mt-2">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-30 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="text-lg font-bold mb-1" style="color: var(--primary);">Berita Tidak Ditemukan</h3>
                    <p class="text-sm" style="color: var(--medium-neutral);">Coba gunakan kata kunci atau kategori
                        lain.</p>
                </div>

            </main>
        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* =========================================
               1. SLIDER HIGHLIGHT
               ========================================= */
            const track = document.getElementById('slider-track');
            const indicators = document.querySelectorAll('.slide-indicator');
            const prevBtn = document.getElementById('btn-prev');
            const nextBtn = document.getElementById('btn-next');

            if (track) {
                let currentSlide = 0;
                const slideCount = indicators.length;
                let slideInterval;

                const updateSlider = () => {
                    track.style.transform = `translateX(-${currentSlide * 100}%)`;
                    indicators.forEach((ind, i) => ind.classList.toggle('active', i === currentSlide));
                };

                const nextSlide = () => {
                    currentSlide = (currentSlide + 1) % slideCount;
                    updateSlider();
                };
                const prevSlide = () => {
                    currentSlide = (currentSlide - 1 + slideCount) % slideCount;
                    updateSlider();
                };

                const startAutoSlide = () => {
                    slideInterval = setInterval(nextSlide, 5000);
                };
                const stopAutoSlide = () => {
                    clearInterval(slideInterval);
                };

                if (nextBtn && prevBtn) {
                    nextBtn.addEventListener('click', () => {
                        stopAutoSlide();
                        nextSlide();
                        startAutoSlide();
                    });
                    prevBtn.addEventListener('click', () => {
                        stopAutoSlide();
                        prevSlide();
                        startAutoSlide();
                    });
                }

                indicators.forEach(ind => {
                    ind.addEventListener('click', (e) => {
                        stopAutoSlide();
                        currentSlide = parseInt(e.target.getAttribute('data-slide'));
                        updateSlider();
                        startAutoSlide();
                    });
                });

                if (slideCount > 1) startAutoSlide();
            }

            /* =========================================
               2. FILTER KATEGORI & AUTOCOMPLETE SEARCH
               ========================================= */
            const searchInput = document.getElementById('searchInput');
            const suggestionsBox = document.getElementById('search-suggestions');
            const categoryBtns = document.querySelectorAll('.cat-btn');
            const allItems = Array.from(document.querySelectorAll('.news-item'));
            const emptyState = document.getElementById('empty-state');
            const dynamicTitle = document.getElementById('dynamic-title');

            let activeCategory = 'all';
            let searchQuery = '';

            // Fungsi Utama untuk memfilter Grid Berita
            const filterNews = () => {
                let visibleCount = 0;

                allItems.forEach(item => {
                    const title = item.getAttribute('data-title');
                    const category = item.getAttribute('data-category');

                    const matchSearch = title.includes(searchQuery);
                    const matchCategory = (activeCategory === 'all' || category === activeCategory);

                    if (matchSearch && matchCategory) {
                        item.style.display = 'flex';
                        item.style.animation = "fadeInUp 0.4s ease forwards";
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                } else {
                    emptyState.classList.add('hidden');
                }
            };

            // Event: Live Search dengan Autocomplete (Suggestions)
            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.toLowerCase().trim();

                suggestionsBox.innerHTML = ''; // Kosongkan saran lama

                if (searchQuery.length > 0) {
                    // Cari kecocokan data
                    let matches = allItems.filter(item => {
                        const title = item.getAttribute('data-title');
                        const category = item.getAttribute('data-category');
                        const matchCategory = (activeCategory === 'all' || category ===
                            activeCategory);
                        return title.includes(searchQuery) && matchCategory;
                    });

                    // Jika ada saran, tampilkan dropdown
                    if (matches.length > 0) {
                        suggestionsBox.classList.remove('hidden');
                        suggestionsBox.classList.add('flex');

                        matches.forEach(match => {
                            let originalTitle = match.getAttribute('data-original-title');
                            let li = document.createElement('li');
                            li.className =
                                "px-5 py-3 hover:bg-gray-50 cursor-pointer text-sm text-gray-700 border-b border-gray-100 last:border-0 flex items-center gap-3 transition-colors";
                            li.innerHTML =
                                `<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg> <span class="line-clamp-1">${originalTitle}</span>`;

                            // Jika saran diklik
                            li.addEventListener('click', () => {
                                searchInput.value = originalTitle;
                                searchQuery = originalTitle.toLowerCase().trim();
                                suggestionsBox.classList.add('hidden');
                                suggestionsBox.classList.remove('flex');
                                filterNews();
                            });
                            suggestionsBox.appendChild(li);
                        });
                    } else {
                        suggestionsBox.classList.add('hidden');
                        suggestionsBox.classList.remove('flex');
                    }
                } else {
                    suggestionsBox.classList.add('hidden');
                    suggestionsBox.classList.remove('flex');
                }

                // Jalankan filter utama
                filterNews();
            });

            // Sembunyikan dropdown saran jika mengeklik di luar area
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                    suggestionsBox.classList.add('hidden');
                    suggestionsBox.classList.remove('flex');
                }
            });

            // Event: Filter saat klik tombol kategori
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    e.currentTarget.classList.add('active');

                    activeCategory = e.currentTarget.getAttribute('data-cat');

                    if (activeCategory === 'all') {
                        dynamicTitle.innerText = "Semua Berita";
                    } else {
                        dynamicTitle.innerText = "Kategori: " + e.currentTarget.innerText.trim();
                    }

                    // Reset pencarian jika ganti kategori (opsional, tapi lebih rapi)
                    searchInput.value = '';
                    searchQuery = '';
                    suggestionsBox.classList.add('hidden');

                    filterNews();
                });
            });

            /* =========================================
               3. REVEAL ANIMATION SAAT SCROLL
               ========================================= */
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('active');
                });
            }, {
                threshold: 0.1
            });
            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</body>

</html>
