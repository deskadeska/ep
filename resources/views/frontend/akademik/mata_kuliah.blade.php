<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah — Ekonomi Pembangunan UNPAR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* TEMA WARNA BARU */
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

        .delay-1 {
            transition-delay: 0.1s;
        }

        /* Custom Scrollbar untuk Tabel yang responsif */
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: var(--light-neutral);
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: var(--card-border);
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: var(--medium-neutral);
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
                Kurikulum Akademik</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Struktur Kurikulum</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Daftar lengkap mata kuliah program studi Ekonomi Pembangunan berdasarkan semester dan kompetensi dosen
                pengampu.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 -mt-8 relative z-10 mb-8">
        <div
            class="bg-white rounded-2xl md:rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100 p-2 md:p-1.5 reveal active delay-1">
            <form action="{{ route('frontend.mata_kuliah') }}" method="GET"
                class="flex flex-col md:flex-row items-center w-full divide-y md:divide-y-0 md:divide-x divide-gray-100">

                <div class="relative w-full md:flex-1 px-4 py-2">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Kode atau Nama MK..."
                        class="w-full pl-8 pr-2 py-2 bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none text-sm text-[var(--dark-neutral)] placeholder-gray-400">
                </div>

                @if (request('semester'))
                    <input type="hidden" name="semester" value="{{ request('semester') }}">
                @endif

                <div class="relative w-full md:w-60 px-4 py-2 group">
                    <select name="dosen"
                        class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none text-sm font-medium text-[var(--medium-neutral)] cursor-pointer appearance-none pr-6 truncate">
                        <option value="">Semua Pengampu</option>
                        @foreach ($listDosen as $d)
                            <option value="{{ $d->idTP }}" {{ request('dosen') == $d->idTP ? 'selected' : '' }}>
                                {{ $d->namaTP }} {{ $d->gelarTP }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none group-hover:text-[#F2A541] transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div class="w-full md:w-auto p-1 mt-2 md:mt-0">
                    <button type="submit"
                        class="w-full md:w-auto text-[var(--dark-neutral)] font-semibold py-2.5 px-6 rounded-xl md:rounded-full transition duration-200 text-sm flex items-center justify-center gap-2 shadow-sm"
                        style="background-color: var(--accent);">
                        <span>Terapkan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

            </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 mb-4">
        <div class="flex overflow-x-auto custom-scrollbar gap-3 pb-3 reveal active">
            <a href="{{ request()->fullUrlWithQuery(['semester' => null]) }}"
                class="px-5 py-2.5 rounded-full text-sm font-bold whitespace-nowrap transition-all shadow-sm
               {{ !request('semester') ? 'bg-[var(--primary)] text-white' : 'bg-white text-[var(--medium-neutral)] border border-gray-200 hover:bg-gray-50' }}">
                Semua Semester
            </a>

            @for ($i = 1; $i <= $stats['total_semester']; $i++)
                <a href="{{ request()->fullUrlWithQuery(['semester' => $i]) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-bold whitespace-nowrap transition-all shadow-sm
                   {{ request('semester') == $i ? 'bg-[var(--primary)] text-white' : 'bg-white text-[var(--medium-neutral)] border border-gray-200 hover:bg-gray-50' }}">
                    Semester {{ $i }}
                </a>
            @endfor
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 pb-20">
        <div
            class="bg-[var(--card-bg)] rounded-2xl border border-[var(--card-border)] overflow-hidden shadow-sm reveal active">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-[var(--light-neutral)] border-b border-[var(--card-border)]">
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center"
                                style="color: var(--medium-neutral);">No</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider"
                                style="color: var(--medium-neutral);">Kode MK</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider"
                                style="color: var(--medium-neutral);">Nama Mata Kuliah</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center"
                                style="color: var(--medium-neutral);">SKS</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center"
                                style="color: var(--medium-neutral);">Semester</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider"
                                style="color: var(--medium-neutral);">Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($mataKuliah as $index => $mk)
                            <tr class="hover:bg-[var(--light-neutral)] transition duration-150 group">
                                <td class="py-4 px-6 text-center text-sm font-medium"
                                    style="color: var(--medium-neutral);">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded text-xs font-bold tracking-wide"
                                        style="background-color: var(--soft-bg); color: var(--secondary);">
                                        {{ $mk->kodeMK }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="text-base font-bold"
                                        style="color: var(--dark-neutral);">{{ $mk->namaMK }}</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="text-sm font-bold"
                                        style="color: var(--secondary);">{{ $mk->sksMK }}</span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                                        style="background-color: var(--light-neutral); color: var(--medium-neutral); border: 1px solid var(--card-border);">
                                        {{ $mk->semesterMK }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="space-y-1.5">
                                        @if ($mk->dosen1)
                                            <div class="flex items-start gap-2 text-sm font-medium"
                                                style="color: var(--dark-neutral);">
                                                <span class="font-bold mt-0.5 leading-none"
                                                    style="color: var(--accent);">1.</span>
                                                <span class="leading-snug">{{ $mk->dosen1->namaTP }}
                                                    {{ $mk->dosen1->gelarTP }}</span>
                                            </div>
                                        @endif
                                        @if ($mk->dosen2)
                                            <div class="flex items-start gap-2 text-sm font-medium"
                                                style="color: var(--dark-neutral);">
                                                <span class="font-bold mt-0.5 leading-none"
                                                    style="color: var(--accent);">2.</span>
                                                <span class="leading-snug">{{ $mk->dosen2->namaTP }}
                                                    {{ $mk->dosen2->gelarTP }}</span>
                                            </div>
                                        @endif
                                        @if (!$mk->dosen1 && !$mk->dosen2)
                                            <div class="text-xs italic" style="color: var(--medium-neutral);">Belum
                                                diatur</div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" style="color: var(--card-border);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    <p class="font-medium" style="color: var(--medium-neutral);">Data mata kuliah
                                        tidak ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Efek Reveal pada Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>

</html>
