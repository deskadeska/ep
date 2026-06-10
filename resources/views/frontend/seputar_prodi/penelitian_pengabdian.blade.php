<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penelitian & Pengabdian — Ekonomi Pembangunan UPR</title>
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
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animasi Kartu Benefit */
        .benefit-card {
            transition: all 0.4s ease;
        }
        .benefit-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(30, 58, 95, 0.1);
        }
        .benefit-card:hover .icon-wrapper {
            background-color: var(--primary);
            color: white;
            transform: scale(1.1);
        }
        .icon-wrapper {
            transition: all 0.4s ease;
        }

        /* Efek Panel CTA */
        .cta-panel {
            transition: all 0.5s ease;
            overflow: hidden;
        }
        .cta-panel:hover {
            transform: scale(1.02);
            z-index: 10;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .cta-panel .bg-overlay {
            transition: all 0.5s ease;
        }
        .cta-panel:hover .bg-overlay {
            transform: scale(1.1);
            opacity: 0.9;
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/80 backdrop-blur-[1px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Tri Dharma Perguruan Tinggi</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white leading-tight">
                Penelitian & Pengabdian <br/> Masyarakat
            </h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Mendorong hilirisasi riset inovatif dan aksi nyata pengabdian demi mendukung pembangunan daerah dan kesejahteraan masyarakat berbasis potensi lokal.
            </p>
        </div>
    </section>

    <section class="py-24 px-4 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-50 rounded-full blur-3xl opacity-60 translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-6xl mx-auto relative z-10">

            <div class="text-center max-w-3xl mx-auto mb-16 reveal active">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Inovasi Berkelanjutan untuk Negeri</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    Kami berkomitmen untuk tidak hanya menjadi pusat transfer ilmu di dalam kelas, melainkan turun langsung mentransformasikan keilmuan ekonomi menjadi solusi nyata atas problematika masyarakat dan pembangunan daerah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">

                <div class="benefit-card bg-[var(--light-neutral)] p-8 rounded-3xl border border-gray-100 reveal active relative overflow-hidden">
                    <div class="icon-wrapper w-14 h-14 rounded-2xl bg-white text-[var(--secondary)] flex items-center justify-center shadow-sm mb-6 border border-gray-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Pengembangan Keilmuan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Fasilitas bagi tenaga pengajar (dosen) untuk mengembangkan kepakaran, menguji teori ekonomi, dan mempublikasikan temuan riset pada jurnal ilmiah bereputasi nasional maupun internasional.
                    </p>
                </div>

                <div class="benefit-card bg-[var(--light-neutral)] p-8 rounded-3xl border border-gray-100 reveal active relative overflow-hidden delay-1">
                    <div class="icon-wrapper w-14 h-14 rounded-2xl bg-white text-green-600 flex items-center justify-center shadow-sm mb-6 border border-gray-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kolaborasi Mahasiswa</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Ruang kolaborasi riset riil bagi mahasiswa untuk mengasah metodologi lapangan, mempercepat penyusunan tugas akhir (skripsi), dan membangun empati sosial melalui program pengabdian bersama dosen.
                    </p>
                </div>

                <div class="benefit-card bg-[var(--light-neutral)] p-8 rounded-3xl border border-gray-100 reveal active relative overflow-hidden">
                    <div class="icon-wrapper w-14 h-14 rounded-2xl bg-white text-orange-500 flex items-center justify-center shadow-sm mb-6 border border-gray-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Solusi Sosial & Ekonomi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Memberikan *output* berupa transfer teknologi tepat guna, pelatihan manajemen UMKM, dan perumusan rekomendasi kebijakan makroekonomi yang strategis bagi pemerintah daerah.
                    </p>
                </div>

                <div class="benefit-card bg-[var(--light-neutral)] p-8 rounded-3xl border border-gray-100 reveal active relative overflow-hidden delay-1">
                    <div class="icon-wrapper w-14 h-14 rounded-2xl bg-white text-purple-600 flex items-center justify-center shadow-sm mb-6 border border-gray-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Peningkatan Kinerja Institusi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Mendongkrak Indikator Kinerja Utama (IKU) Universitas, meningkatkan daya saing global, serta menjadi syarat mutlak untuk mempertahankan dan meningkatkan status Akreditasi jurusan.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 pb-24 reveal active">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-4">Akses Portal Layanan LPPM</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Silakan pilih layanan yang ingin Anda tuju untuk mengajukan proposal, memantau riwayat hibah, atau melihat direktori publikasi.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 rounded-3xl overflow-hidden shadow-2xl relative">

            <a href="https://upr.ac.id/penelitian/" target="_blank" rel="noopener noreferrer" class="cta-panel group relative block h-80 md:h-96 flex flex-col justify-end p-10 cursor-pointer bg-[#1E3A5F]">
                <div class="bg-overlay absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#1E3A5F] via-[#1E3A5F]/80 to-transparent"></div>

                <div class="relative z-10 text-white">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mb-4 border border-white/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" /></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 group-hover:text-blue-200 transition-colors">Portal Penelitian</h3>
                    <p class="text-blue-100 text-sm mb-6 max-w-sm line-clamp-2">Sistem informasi manajemen untuk pengajuan, evaluasi, dan pelaporan hibah penelitian.</p>
                    <div class="inline-flex items-center gap-2 font-bold text-sm border-b-2 border-transparent group-hover:border-white pb-1 transition-all">
                        Kunjungi Portal <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </div>
                </div>
            </a>

            <a href="https://upr.ac.id/pengabdian/" target="_blank" rel="noopener noreferrer" class="cta-panel group relative block h-80 md:h-96 flex flex-col justify-end p-10 cursor-pointer bg-[#F2A541]">
                <div class="bg-overlay absolute inset-0 bg-cover bg-center opacity-40 mix-blend-multiply" style="background-image: url('https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#d4882e] via-[#d4882e]/80 to-transparent"></div>

                <div class="relative z-10 text-white">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mb-4 border border-white/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 group-hover:text-orange-100 transition-colors">Portal Pengabdian</h3>
                    <p class="text-orange-50 text-sm mb-6 max-w-sm line-clamp-2">Sistem pendaftaran dan pendataan aktivitas pengabdian kepada masyarakat berbasis kemitraan.</p>
                    <div class="inline-flex items-center gap-2 font-bold text-sm border-b-2 border-transparent group-hover:border-white pb-1 transition-all">
                        Kunjungi Portal <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </div>
                </div>
            </a>

            <div class="hidden lg:flex absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-white rounded-full items-center justify-center z-20 shadow-xl border-4 border-gray-100">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
            </div>

        </div>
        <p class="text-center text-xs text-gray-400 mt-6 italic">
            *Tautan akan membuka tab baru menuju sistem informasi eksternal yang dikelola oleh Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM) UPR.
        </p>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Animasi Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

</body>

</html>
