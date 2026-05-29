<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenaga Pengajar — Ekonomi Pembangunan UPR</title>
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

        .lecturer-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .lecturer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(30, 58, 95, 0.15);
            border-color: var(--secondary);
        }

        /* Modal Scrollbar Custom */
        .modal-body::-webkit-scrollbar {
            width: 4px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/75 backdrop-blur-[1px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">SDM
                Unggul</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Tenaga Pengajar</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Mengenal lebih dekat para pendidik profesional dan pakar ekonomi di lingkungan Jurusan Ekonomi
                Pembangunan Universitas Palangka Raya.
            </p>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-6xl mx-auto">

            @forelse($pengajar as $tipe => $daftarDosen)
                <div class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-1 w-10 rounded-full" style="background-color: var(--accent);"></div>
                        <h2 class="text-xl md:text-2xl font-bold">{{ $tipe ?: 'Tenaga Pengajar Lainnya' }}</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                        @foreach ($daftarDosen as $dosen)
                            <div
                                class="lecturer-card reveal active bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm flex flex-col relative">

                                <div
                                    class="aspect-[4/5] w-full relative overflow-hidden bg-gray-100 border-b border-gray-100 flex-shrink-0">
                                    @if ($dosen->urlFotoTP)
                                        <img src="{{ asset('assets/admin/uploads/tenaga_pengajar/' . $dosen->urlFotoTP) }}"
                                            alt="{{ $dosen->namaTP }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                            <svg class="w-16 h-16 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-[9px] font-bold uppercase tracking-wider">No Photo</span>
                                        </div>
                                    @endif

                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="px-2.5 py-1 rounded-md text-[9px] font-bold uppercase tracking-wider shadow-sm backdrop-blur-md bg-white/90"
                                            style="color: var(--primary);">
                                            {{ $dosen->tipeTP ?? 'Dosen' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4 md:p-5 flex flex-col flex-grow">
                                    <h3 class="text-sm md:text-base font-bold leading-snug mb-3 line-clamp-2"
                                        style="color: var(--primary);">
                                        {{ $dosen->namaTP }}
                                    </h3>

                                    <div class="space-y-1.5 mb-6">
                                        <p
                                            class="text-[11px] md:text-xs font-medium text-[var(--medium-neutral)] truncate">
                                            <span class="font-semibold text-gray-500">NIP:</span>
                                            {{ $dosen->nipTP ?? '-' }}
                                        </p>
                                        <p
                                            class="text-[11px] md:text-xs font-medium text-[var(--medium-neutral)] truncate">
                                            <span class="font-semibold text-gray-500">Kode:</span>
                                            {{ $dosen->kodeDosenTP ?? '-' }}
                                        </p>
                                        <p
                                            class="text-[11px] md:text-xs font-medium text-[var(--medium-neutral)] line-clamp-1">
                                            <span class="font-semibold text-gray-500">Jabatan:</span>
                                            {{ $dosen->jabatanFungsionalTP ?? '-' }}
                                        </p>
                                    </div>

                                    <div class="mt-auto flex justify-end">
                                        <button type="button" data-dosen="{{ json_encode($dosen) }}"
                                            onclick="openDetailModal(this)"
                                            class="text-[11px] md:text-xs font-bold flex items-center gap-1 transition-colors outline-none hover:opacity-70"
                                            style="color: var(--accent);">
                                            Lihat Detail
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="py-16 text-center bg-white rounded-2xl border border-dashed border-gray-300 shadow-sm">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h3 class="text-base font-bold text-gray-500">Belum ada data pengajar yang ditambahkan.</h3>
                </div>
            @endforelse

        </div>
    </section>

    <div id="detailModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden flex flex-col md:flex-row relative transform transition-transform scale-95 origin-center">

            <button onclick="closeDetailModal()"
                class="absolute top-4 right-4 z-20 p-2 bg-white/70 hover:bg-white rounded-full text-gray-800 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="w-full md:w-2/5 bg-gray-100 relative h-64 md:h-auto flex-shrink-0">
                <img id="modalFoto" src="" alt="Foto Dosen" class="w-full h-full object-cover">
                <div id="modalNoFoto"
                    class="hidden w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-100">
                    <svg class="w-20 h-20 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-xs font-bold uppercase tracking-widest">No Photo</span>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 z-10">
                    <span id="modalTipe"
                        class="px-3 py-1 bg-[var(--accent)] text-white text-[10px] font-bold uppercase tracking-wider rounded-md shadow-sm"></span>
                </div>
            </div>

            <div
                class="w-full md:w-3/5 p-6 md:p-8 flex flex-col bg-white modal-body overflow-y-auto max-h-[60vh] md:max-h-[80vh]">

                <h2 id="modalNama" class="text-xl md:text-2xl font-bold mb-6 leading-snug"
                    style="color: var(--primary);"></h2>

                <div class="space-y-4">
                    <div class="border-b border-gray-100 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">NIP</p>
                        <p id="modalNip" class="text-sm font-medium text-gray-800"></p>
                    </div>

                    <div class="border-b border-gray-100 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">NUPTK</p>
                        <p id="modalNuptk" class="text-sm font-medium text-gray-800"></p>
                    </div>

                    <div class="border-b border-gray-100 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Kode Dosen</p>
                        <p id="modalKode" class="text-sm font-medium text-gray-800"></p>
                    </div>

                    <div class="border-b border-gray-100 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Pendidikan
                            Terakhir</p>
                        <p id="modalPendidikan" class="text-sm font-medium text-gray-800"></p>
                    </div>

                    <div class="border-b border-gray-100 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Jabatan Fungsional
                        </p>
                        <p id="modalJabatan" class="text-sm font-medium text-gray-800"></p>
                    </div>

                    <div class="pb-2">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Pangkat & Golongan
                        </p>
                        <p id="modalGolongan" class="text-sm font-medium text-gray-800"></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('frontend.layout.footer')

    <script>
        // 1. Script Animasi Reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // 2. Script Logika Modal Detail Dosen (Mengambil data JSON dari element tombol yang diklik)
        function openDetailModal(element) {
            // Parsing data JSON yang aman dari atribut HTML
            const dosen = JSON.parse(element.getAttribute('data-dosen'));

            // Isi Teks
            document.getElementById('modalNama').innerText = dosen.namaTP || '-';
            document.getElementById('modalNip').innerText = dosen.nipTP || '-';
            document.getElementById('modalNuptk').innerText = dosen.nuptkTP || '-';
            document.getElementById('modalKode').innerText = dosen.kodeDosenTP || '-';
            document.getElementById('modalPendidikan').innerText = dosen.pendidikanTP || '-';
            document.getElementById('modalJabatan').innerText = dosen.jabatanFungsionalTP || '-';
            document.getElementById('modalTipe').innerText = dosen.tipeTP || 'Dosen';

            // Gabungkan Pangkat & Golongan
            let pangkatGol = '-';
            if (dosen.pangkatTP && dosen.golonganTP) {
                pangkatGol = dosen.pangkatTP + ' (' + dosen.golonganTP + ')';
            } else if (dosen.pangkatTP) {
                pangkatGol = dosen.pangkatTP;
            } else if (dosen.golonganTP) {
                pangkatGol = dosen.golonganTP;
            }
            document.getElementById('modalGolongan').innerText = pangkatGol;

            // Atur Gambar
            const imgEl = document.getElementById('modalFoto');
            const noImgEl = document.getElementById('modalNoFoto');

            if (dosen.urlFotoTP) {
                imgEl.src = "{{ asset('assets/admin/uploads/tenaga_pengajar') }}/" + dosen.urlFotoTP;
                imgEl.classList.remove('hidden');
                noImgEl.classList.add('hidden');
            } else {
                imgEl.src = "";
                imgEl.classList.add('hidden');
                noImgEl.classList.remove('hidden');
            }

            // Munculkan Modal & Kunci Scroll Body
            const modal = document.getElementById('detailModal');
            modal.classList.remove('hidden');
            // Efek animasi pop up
            setTimeout(() => {
                modal.children[0].classList.remove('scale-95');
                modal.children[0].classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            // Kembalikan efek animasi pop up
            modal.children[0].classList.remove('scale-100');
            modal.children[0].classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 150);
        }

        // Klik di luar area modal untuk menutup
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });
    </script>

</body>

</html>
