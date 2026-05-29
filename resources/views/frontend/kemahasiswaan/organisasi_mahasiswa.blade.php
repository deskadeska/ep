<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organisasi Mahasiswa — Ekonomi Pembangunan UPR</title>
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
            --light-neutral: #F4F6F9;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--light-neutral);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3 {
            font-family: 'Lora', serif;
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glassmorphism Premium */
        .glass-card {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }

        /* Modifikasi Scrollbar khusus untuk deskripsi panjang di PC */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-[#1E3A5F] overflow-hidden">
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-[#2A6F97] rounded-full mix-blend-screen filter blur-[80px] opacity-60">
        </div>
        <div
            class="absolute bottom-0 right-0 w-80 h-80 bg-[#F2A541] rounded-full mix-blend-screen filter blur-[80px] opacity-20">
        </div>

        <div class="relative max-w-4xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 text-[#F2A541] reveal active">Wadah Kreativitas &
                Kepemimpinan</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 text-white reveal active">Organisasi Mahasiswa
            </h1>
            <p class="text-base md:text-lg text-gray-300 font-medium reveal active delay-1">
                Mengenal lebih dekat motor penggerak kegiatan mahasiswa di lingkungan Jurusan Ekonomi Pembangunan
                Universitas Palangka Raya.
            </p>
        </div>
    </section>

    <section class="py-16 md:py-24 px-4 relative z-20 -mt-10">
        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                @forelse($ormawa as $index => $item)
                    <div
                        class="relative w-full rounded-[2rem] overflow-hidden shadow-xl hover:shadow-[0_20px_50px_rgba(30,58,95,0.4)] group reveal flex flex-col justify-end bg-gray-900 min-h-[450px] md:min-h-[550px] transition-all duration-500 md:hover:-translate-y-3 cursor-default">

                        <div class="absolute inset-0 w-full h-full">
                            @if ($item->fotoAnggotaUrlOrmawa)
                                <img src="{{ asset('assets/admin/uploads/ormawa/' . $item->fotoAnggotaUrlOrmawa) }}"
                                    alt="Anggota {{ $item->namaOrmawa }}"
                                    class="w-full h-full object-cover opacity-70 transition-transform duration-[1500ms] ease-out group-hover:scale-110 group-hover:opacity-50">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-[#1E3A5F] to-gray-800 opacity-90 transition-transform duration-[1500ms] group-hover:scale-110">
                                </div>
                            @endif

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/50 to-transparent transition-colors duration-500 md:group-hover:from-black md:group-hover:via-black/70">
                            </div>
                        </div>

                        <div class="relative z-10 w-full p-4 md:p-6">

                            <div
                                class="glass-card p-6 md:p-8 rounded-3xl transition-all duration-700 ease-in-out md:translate-y-8 md:group-hover:translate-y-0">

                                <div class="flex items-center gap-4 mb-2 relative">
                                    @if ($item->fotoLogoUrlOrmawa)
                                        <div
                                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-white p-2 shadow-[0_0_15px_rgba(255,255,255,0.3)] flex-shrink-0 flex items-center justify-center transform transition-transform duration-500 group-hover:scale-105 group-hover:-rotate-3">
                                            <img src="{{ asset('assets/admin/uploads/ormawa/' . $item->fotoLogoUrlOrmawa) }}"
                                                alt="Logo {{ $item->namaOrmawa }}" class="w-full h-full object-contain">
                                        </div>
                                    @endif
                                    <div>
                                        <h2
                                            class="text-xl md:text-2xl lg:text-3xl font-bold text-white leading-tight drop-shadow-md">
                                            {{ $item->namaOrmawa }}
                                        </h2>
                                        <div
                                            class="h-1 w-12 bg-[#F2A541] rounded-full mt-2 transition-all duration-500 group-hover:w-24">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="hidden md:flex items-center gap-2 mt-4 text-[#F2A541] text-xs font-bold tracking-widest uppercase transition-all duration-500 group-hover:opacity-0 group-hover:-translate-y-4 absolute">
                                    <svg class="w-4 h-4 animate-bounce" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                                    </svg>
                                    Arahkan Kursor
                                </div>

                                <button
                                    onclick="toggleDescription('desc-{{ $item->idOrmawa }}', 'icon-{{ $item->idOrmawa }}')"
                                    class="md:hidden flex items-center gap-2 mt-4 text-sm font-bold text-[#F2A541] transition-colors outline-none py-2">
                                    <svg id="icon-{{ $item->idOrmawa }}" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span id="text-{{ $item->idOrmawa }}">Lihat Detail</span>
                                </button>

                                <div id="desc-{{ $item->idOrmawa }}"
                                    class="hidden md:block transition-all duration-700 ease-in-out md:opacity-0 md:max-h-0 md:overflow-hidden md:group-hover:opacity-100 md:group-hover:max-h-[300px] md:group-hover:mt-6">

                                    <div
                                        class="text-gray-200 text-sm md:text-base leading-relaxed pr-2 custom-scrollbar md:max-h-[250px] md:overflow-y-auto">
                                        @if ($item->deskripsiOrmawa)
                                            {!! nl2br(e($item->deskripsiOrmawa)) !!}
                                        @else
                                            <p class="italic text-gray-400">Belum ada profil lengkap untuk organisasi
                                                ini.</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <div
                        class="col-span-1 md:col-span-2 text-center py-24 bg-white rounded-[2rem] shadow-sm border border-gray-100 reveal">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-[#1E3A5F] mb-3">Data Belum Tersedia</h3>
                        <p class="text-gray-500 max-w-md mx-auto">Kami sedang mempersiapkan informasi terbaik mengenai
                            organisasi kemahasiswaan kami. Silakan kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Animasi Reveal saat Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Script Tombol Mata (Toggle Deskripsi Khusus HP)
        function toggleDescription(descId, iconId) {
            const descElement = document.getElementById(descId);
            const iconElement = document.getElementById(iconId);
            const textElement = document.getElementById(iconId.replace('icon-', 'text-'));

            if (descElement.classList.contains('hidden')) {
                descElement.classList.remove('hidden');
                descElement.classList.add('animate-pulse');
                setTimeout(() => descElement.classList.remove('animate-pulse'), 500);

                textElement.innerText = "Tutup Detail";
                iconElement.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            `;
            } else {
                descElement.classList.add('hidden');
                textElement.innerText = "Lihat Detail";
                iconElement.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
            }
        }
    </script>

</body>

</html>
