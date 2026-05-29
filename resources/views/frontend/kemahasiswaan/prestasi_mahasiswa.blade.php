<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestasi Mahasiswa — Ekonomi Pembangunan UPR</title>
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

        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* Hall of Fame Card Hover Effect */
        .champion-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .champion-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body>

@include('frontend.layout.navbar')

<section class="pt-32 pb-24 px-4 relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/bg-prestasi.jpg') }}');">
    <div class="absolute inset-0 bg-[#1E3A5F]/90 backdrop-blur-[2px]"></div>

    <div class="relative max-w-7xl mx-auto text-center z-10">
        <div class="inline-flex items-center justify-center p-3 rounded-full mb-4 bg-white/10 backdrop-blur-sm reveal active">
            <svg class="w-8 h-8 text-[var(--accent)]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 reveal active text-white leading-tight">
            Galeri Kehormatan <br/><span style="color: var(--accent);">Prestasi Mahasiswa</span>
        </h1>
        <p class="max-w-2xl mx-auto text-lg reveal active delay-1" style="color: var(--soft-bg);">
            Jejak kebanggaan dan pencapaian gemilang mahasiswa Fakultas Ekonomi dan Bisnis Universitas Palangka Raya di berbagai ajang kompetisi.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16 -mt-12 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($prestasi as $p)

        @php
            // Logika Warna Dinamis Berdasarkan Peringkat (Scope)
            $colorTheme = match($p->peringkatPM) {
                'Internasional'  => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'border' => 'border-purple-500', 'glow' => 'shadow-purple-500/20'],
                'Nasional'       => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'border' => 'border-red-500', 'glow' => 'shadow-red-500/20'],
                'Provinsi'       => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'border' => 'border-emerald-500', 'glow' => 'shadow-emerald-500/20'],
                'Kabupaten/Kota' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-500', 'glow' => 'shadow-blue-500/20'],
                'Kecamatan'      => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800', 'border' => 'border-orange-400', 'glow' => 'shadow-orange-500/20'],
                'Desa/Kelurahan' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-400', 'glow' => 'shadow-gray-500/20'],
                default          => ['bg' => 'bg-slate-100', 'text' => 'text-slate-800', 'border' => 'border-slate-500', 'glow' => 'shadow-slate-500/20'],
            };
        @endphp

        <div class="champion-card reveal active bg-white rounded-2xl overflow-hidden shadow-lg border-t-4 {{ $colorTheme['border'] }} flex flex-col h-full relative">

            <div class="absolute top-4 right-4 z-10">
                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-wider bg-white/90 backdrop-blur-sm text-[var(--primary)] rounded-full shadow-sm">
                    {{ $p->kategoriPM ?? 'Umum' }}
                </span>
            </div>

            <div class="aspect-[4/3] w-full relative overflow-hidden bg-gray-100">
                @if($p->fotoUrlPM)
                    <img src="{{ asset('assets/admin/uploads/prestasi/' . $p->fotoUrlPM) }}" alt="{{ $p->namaPenerimaPM }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 bg-[#F8FAFC]">
                        <svg class="w-16 h-16 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0011 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 003.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM7 10.82C5.84 10.4 5 9.3 5 8V7h2v3.82zM19 8c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg>
                        <span class="text-xs font-medium">Foto Tidak Tersedia</span>
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>

                <div class="absolute bottom-0 left-0 w-full p-5">
                    <h2 class="text-xl md:text-2xl font-bold text-white leading-tight mb-1">
                        {{ $p->namaPenerimaPM }}
                    </h2>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded text-xs font-bold bg-[var(--accent)] text-[var(--primary)] shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        {{ $p->tingkatPM }}
                    </span>
                </div>
            </div>

            <div class="p-6 flex flex-col flex-grow bg-white">

                <div class="mb-3 flex">
                    <span class="px-2.5 py-1 rounded text-[10px] font-black uppercase tracking-wider {{ $colorTheme['bg'] }} {{ $colorTheme['text'] }}">
                        Tingkat {{ $p->peringkatPM }}
                    </span>
                </div>

                <h3 class="text-base font-bold text-[var(--dark-neutral)] leading-snug mb-4">
                    {{ $p->namaAjangPM }}
                </h3>

                <div class="mt-auto grid grid-cols-2 gap-3 pt-4 border-t border-gray-100">
                    <div>
                        <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Tahun</p>
                        <p class="text-sm font-semibold text-[var(--primary)]">{{ $p->tahunPM }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Lokasi</p>
                        <p class="text-sm font-semibold text-[var(--primary)] truncate" title="{{ $p->lokasiPM }}">{{ $p->lokasiPM }}</p>
                    </div>
                </div>
            </div>

        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-gray-300 reveal active shadow-sm">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            <h3 class="text-xl font-bold text-[var(--primary)] mb-1">Belum Ada Data Prestasi</h3>
            <p class="text-sm text-[var(--medium-neutral)]">Daftar pencapaian mahasiswa akan ditampilkan di sini.</p>
        </div>
        @endforelse

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
