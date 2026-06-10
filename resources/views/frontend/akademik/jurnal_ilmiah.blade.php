<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Ilmiah — Ekonomi Pembangunan UPR</title>
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

        h1, h2, h3 {
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

        /* Modal Scrollbar Custom */
        .modal-body::-webkit-scrollbar { width: 6px; }
        .modal-body::-webkit-scrollbar-track { background: #f1f5f9; }
        .modal-body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/80 backdrop-blur-[1px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Publikasi & Riset</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Jurnal Ilmiah</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Kumpulan karya tulis dan publikasi riset ilmiah yang dihasilkan oleh civitas akademika Jurusan Ekonomi Pembangunan.
            </p>
        </div>
    </section>

    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-8 reveal active">
                <form method="GET" action="{{ url()->current() }}" class="flex flex-col md:flex-row gap-4 items-center">

                    <div class="w-full md:w-1/2 relative">
                        <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan Judul atau Keyword..." class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-[#F2A541] focus:border-[#F2A541] outline-none transition-shadow">
                    </div>

                    <div class="w-full md:w-1/2 flex flex-col sm:flex-row gap-3">
                        <select name="tahun" class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-[#F2A541] focus:border-[#F2A541] outline-none transition-shadow bg-white text-gray-700">
                            <option value="">Semua Tahun Terbit</option>
                            @foreach($listTahun as $thn)
                                <option value="{{ $thn }}" {{ $filterTahun == $thn ? 'selected' : '' }}>Tahun {{ $thn }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="bg-[var(--primary)] hover:bg-[var(--secondary)] text-white font-bold py-3 px-6 rounded-xl text-sm transition shadow-sm flex items-center justify-center gap-2 whitespace-nowrap">
                            Terapkan Filter
                        </button>

                        @if(request('search') || request('tahun'))
                            <a href="{{ url()->current() }}" class="bg-red-50 text-red-600 hover:bg-red-100 font-bold py-3 px-4 rounded-xl text-sm transition border border-red-200 flex justify-center" title="Reset Pencarian">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden reveal active">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-sm tracking-wide" style="color: var(--primary);">
                                <th class="p-5 font-bold text-center w-16">No.</th>
                                <th class="p-5 font-bold w-1/4">Penulis</th>
                                <th class="p-5 font-bold w-1/5">Jurnal Penerbit</th>
                                <th class="p-5 font-bold w-1/3">Judul</th>
                                <th class="p-5 font-bold">DOI</th>
                                <th class="p-5 font-bold text-center w-20">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100 text-gray-700">
                            @forelse($jurnalIlmiah as $index => $ji)
                                @php
                                    $arrPenulis = [];
                                    // 1. Ambil nama dosen dari relasi Pivot
                                    if($ji->tenagaPengajar) {
                                        foreach($ji->tenagaPengajar as $dosen) {
                                            $arrPenulis[] = $dosen->namaTP;
                                        }
                                    }
                                    // 2. Ambil nama mahasiswa dari JSON
                                    $mhsList = is_string($ji->namaMahasiswaJI) ? json_decode($ji->namaMahasiswaJI, true) : $ji->namaMahasiswaJI;
                                    if(!empty($mhsList)) {
                                        $arrPenulis = array_merge($arrPenulis, $mhsList);
                                    }
                                    // 3. Gabungkan menjadi satu kalimat
                                    $strPenulis = !empty($arrPenulis) ? implode(', ', $arrPenulis) : 'Anonim';
                                @endphp

                                <tr class="hover:bg-[#F4F6F9] transition-colors duration-200">
                                    <td class="p-5 text-center text-gray-500 font-medium">
                                        {{ $jurnalIlmiah->firstItem() + $index }}
                                    </td>
                                    <td class="p-5">
                                        <div class="line-clamp-2 leading-relaxed" title="{{ $strPenulis }}">
                                            {{ $strPenulis }}
                                        </div>
                                    </td>
                                    <td class="p-5 font-medium text-gray-800">
                                        {{ $ji->jurnalPenerbitJI }}
                                    </td>
                                    <td class="p-5">
                                        <div class="font-bold text-[var(--primary)] line-clamp-2 leading-snug" title="{{ $ji->judulJI }}">
                                            {{ $ji->judulJI }}
                                        </div>
                                    </td>
                                    <td class="p-5">
                                        <a href="{{ Str::startsWith($ji->doiJI, 'http') ? $ji->doiJI : 'https://doi.org/' . $ji->doiJI }}" target="_blank" class="text-[var(--secondary)] hover:text-[var(--accent)] font-medium transition-colors break-all">
                                            {{ $ji->doiJI }}
                                        </a>
                                    </td>
                                    <td class="p-5 text-center">
                                        @php
                                            $ji->strPenulis = $strPenulis; // Disisipkan agar mudah dipanggil di JS
                                        @endphp
                                        <button type="button" data-jurnal="{{ json_encode($ji) }}" onclick="openDetailModal(this)" class="p-2 bg-[var(--soft-bg)] text-[var(--secondary)] hover:bg-[var(--primary)] hover:text-white rounded-lg transition-all duration-200 shadow-sm" title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            <h3 class="text-lg font-bold mb-1" style="color: var(--primary);">Data Tidak Ditemukan</h3>
                                            @if(request('search') || request('tahun'))
                                                <p>Pencarian atau filter Anda tidak membuahkan hasil. Silakan coba kata kunci lain.</p>
                                            @else
                                                <p>Belum ada data publikasi jurnal ilmiah yang diunggah.</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($jurnalIlmiah->hasPages())
                <div class="mt-8 reveal active">
                    {{ $jurnalIlmiah->appends(request()->query())->links() }}
                </div>
            @endif

        </div>
    </section>

    <div id="modalDetail" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl flex flex-col relative transform transition-transform scale-95 origin-center max-h-[90vh] overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/80 sticky top-0 z-10">
                <h3 class="font-bold text-lg" style="color: var(--navy);">Detail Publikasi</h3>
                <button onclick="closeDetailModal()" class="p-2 bg-white hover:bg-gray-100 rounded-full text-gray-500 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 md:p-8 overflow-y-auto modal-body">

                <h2 id="m_judul" class="text-xl md:text-2xl font-bold mb-6 leading-snug" style="color: var(--primary);"></h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-[#F4F6F9] p-4 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">Penulis</p>
                        <p id="m_penulis" class="text-sm font-semibold text-[var(--primary)] leading-relaxed"></p>
                    </div>
                    <div class="bg-[#F4F6F9] p-4 rounded-xl border border-gray-100">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1">Penerbit Jurnal</p>
                        <p id="m_penerbit" class="text-sm font-semibold text-[var(--primary)]"></p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary)] mb-1">Tahun Publikasi</p>
                        <p id="m_tahun" class="text-sm font-medium text-gray-800"></p>
                    </div>

                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary)] mb-2">Abstrak</p>
                        <p id="m_abstrak" class="text-sm text-gray-600 leading-relaxed text-justify"></p>
                    </div>

                    <div class="border-b border-gray-100 pb-4">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary)] mb-2">Kata Kunci (Keywords)</p>
                        <div id="m_keyword_container" class="flex flex-wrap gap-2">
                            </div>
                    </div>

                    <div class="pb-2">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary)] mb-2">Tautan DOI</p>
                        <a id="m_doi" href="#" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white rounded-lg text-sm font-bold transition-colors border border-blue-100 break-all">
                            </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('frontend.layout.footer')

    <script>
        // Animasi Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Logika Modal
        function openDetailModal(btn) {
            const data = JSON.parse(btn.getAttribute('data-jurnal'));

            // Isi Teks
            document.getElementById('m_judul').innerText = data.judulJI;
            document.getElementById('m_penulis').innerText = data.strPenulis;
            document.getElementById('m_penerbit').innerText = data.jurnalPenerbitJI;
            document.getElementById('m_tahun').innerText = data.tahunPublikasiJI;
            document.getElementById('m_abstrak').innerText = data.abstrakJI;

            // Logika Keyword
            const kwContainer = document.getElementById('m_keyword_container');
            kwContainer.innerHTML = '';
            if(data.keywordJI) {
                const keywords = data.keywordJI.split(',');
                keywords.forEach(kw => {
                    if(kw.trim() !== '') {
                        const span = document.createElement('span');
                        span.className = 'bg-[var(--soft-bg)] text-[var(--primary)] px-2.5 py-1 rounded-md text-[11px] font-bold tracking-wide border border-[var(--secondary)]';
                        span.innerText = kw.trim();
                        kwContainer.appendChild(span);
                    }
                });
            }

            // Logika DOI Link
            const doiEl = document.getElementById('m_doi');
            const link = data.doiJI.startsWith('http') ? data.doiJI : 'https://doi.org/' + data.doiJI;
            doiEl.href = link;
            doiEl.innerHTML = `
                Buka Dokumen Asli
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            `;

            // Tampilkan Modal
            const modal = document.getElementById('modalDetail');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.children[0].classList.remove('scale-95');
                modal.children[0].classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeDetailModal() {
            const modal = document.getElementById('modalDetail');
            modal.children[0].classList.remove('scale-100');
            modal.children[0].classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        // Menutup modal jika klik latar belakang hitam
        document.getElementById('modalDetail').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
    </script>

</body>

</html>
