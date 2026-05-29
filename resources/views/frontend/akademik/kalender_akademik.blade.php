<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Akademik — Ekonomi Pembangunan UPR</title>
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

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
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
                Agenda Perkuliahan</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Kalender Akademik</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Pantau jadwal penting, batas waktu administrasi, dan agenda akademik Fakultas Ekonomi dan Bisnis
                Universitas Palangka Raya.
            </p>
        </div>
    </section>

    <section class="max-w-xl mx-auto px-4 -mt-8 relative z-10 mb-12">
        <div
            class="bg-white rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100 p-2 reveal active delay-1">
            <form action="{{ route('frontend.kalender') }}" method="GET" class="flex items-center w-full">
                <div class="relative flex-1 px-4 group">
                    <select name="tahun_ajaran" onchange="this.form.submit()"
                        class="w-full bg-transparent border-transparent focus:border-transparent focus:ring-0 outline-none text-sm font-bold text-[var(--primary)] cursor-pointer appearance-none pr-8">
                        @foreach ($listTahunAjaran as $ta)
                            <option value="{{ $ta->idTA }}" {{ $selectedTA == $ta->idTA ? 'selected' : '' }}>
                                Tahun Ajaran {{ $ta->tahunAkademikTA }}
                            </option>
                        @endforeach
                        @if ($listTahunAjaran->isEmpty())
                            <option value="">Belum Ada Data Tahun Ajaran</option>
                        @endif
                    </select>
                    <svg class="w-5 h-5 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none group-hover:text-[var(--accent)] transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div class="px-2">
                    <div class="h-8 w-[1px] bg-gray-100"></div>
                </div>
                <button type="submit"
                    class="text-[var(--dark-neutral)] font-bold py-2.5 px-6 rounded-full transition duration-200 text-sm shadow-sm hover:opacity-90"
                    style="background-color: var(--accent);">
                    Tampilkan
                </button>
            </form>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 pb-24">
        <div
            class="bg-[var(--card-bg)] rounded-2xl border border-[var(--card-border)] overflow-hidden shadow-sm reveal active">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[var(--light-neutral)] border-b border-[var(--card-border)]">
                            <th class="py-4 px-8 text-xs font-bold uppercase tracking-wider text-center w-20"
                                style="color: var(--medium-neutral);">No</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider"
                                style="color: var(--medium-neutral);">Waktu Pelaksanaan</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider"
                                style="color: var(--medium-neutral);">Detail Kegiatan Akademik</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($kalender as $index => $k)
                            <tr class="hover:bg-[var(--light-neutral)] transition duration-150 group">
                                <td class="py-5 px-8 text-center text-sm font-bold"
                                    style="color: var(--medium-neutral);">
                                    {{ $index + 1 }}
                                </td>
                                <td class="py-5 px-6 whitespace-nowrap">
                                    <div
                                        class="inline-block px-4 py-2 rounded-lg bg-[var(--soft-bg)] border border-[#d6e6f4]">
                                        <span class="text-sm font-bold tracking-wide" style="color: var(--secondary);">
                                            {{ \Carbon\Carbon::parse($k->tanggalMulaiKA)->translatedFormat('d M Y') }}
                                            @if ($k->tanggalSelesaiKA)
                                                <span class="mx-1 font-black text-[var(--accent)]">-</span>
                                                {{ \Carbon\Carbon::parse($k->tanggalSelesaiKA)->translatedFormat('d M Y') }}
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span class="text-base font-bold leading-snug"
                                        style="color: var(--primary);">{{ $k->kegiatanKA }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-20 text-center">
                                    <p class="text-[var(--medium-neutral)] font-medium italic">Belum ada agenda akademik
                                        untuk tahun ajaran yang dipilih.</p>
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
