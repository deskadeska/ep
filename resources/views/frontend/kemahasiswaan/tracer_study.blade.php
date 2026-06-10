<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Study — Ekonomi Pembangunan UPR</title>
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

        /* Styling Khusus Diagram Alir (Flow) */
        .step-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-card:hover {
            transform: translateY(-5px);
        }

        .step-number {
            transition: all 0.3s ease;
        }

        .step-card:hover .step-number {
            background-color: var(--accent);
            transform: scale(1.1);
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
                Evaluasi & Pengembangan Jurusan</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white leading-tight">
                Pelacakan Lulusan <br/> (Tracer Study)
            </h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Mari bersama-sama membangun dan mengembangkan Jurusan Ekonomi Pembangunan Universitas Palangka Raya menjadi lebih baik dengan berpartisipasi mengisi Tracer Study.
            </p>
        </div>
    </section>

    <section class="py-16 px-4 bg-white">
        <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-12 items-center">

            <div class="lg:w-1/2 reveal active">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-1 w-10 rounded-full" style="background-color: var(--accent);"></div>
                    <h2 class="text-2xl md:text-3xl font-bold">Apa itu Tracer Study?</h2>
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    <b>Tracer Study (Pelacakan Lulusan)</b> adalah survei alumni yang dilakukan untuk melacak jejak langkah lulusan perguruan tinggi. Ini merupakan instrumen penting bagi institusi untuk mengevaluasi hasil pendidikan yang telah diberikan kepada mahasiswa.
                </p>

                <h3 class="text-lg font-bold mb-4" style="color: var(--secondary);">Fungsi & Manfaat Utama:</h3>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-[#E8F1F8] flex items-center justify-center text-[#2A6F97]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Bagi Jurusan/Universitas</h4>
                            <p class="text-sm text-gray-500 mt-1">Bahan evaluasi kurikulum pembelajaran, pencapaian IKU (Indikator Kinerja Utama), dan syarat mutlak Akreditasi Perguruan Tinggi.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Bagi Calon Mahasiswa</h4>
                            <p class="text-sm text-gray-500 mt-1">Memberikan jaminan informasi prospek karir dan relevansi jurusan Ekonomi Pembangunan di dunia kerja industri.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Bagi Alumni</h4>
                            <p class="text-sm text-gray-500 mt-1">Membangun database jaringan alumni <strong>(networking)</strong> dan memberikan ruang untuk memberi <strong>feedback</strong> terhadap almamater.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 reveal active">
                <div class="relative group rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-100">
                    <img src="{{ asset('assets/images/screenshot_tracer_studi.png') }}" alt="Screenshot Web Tracer Study UPR" class="w-full h-auto object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1E3A5F] via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-center">
                        <span class="bg-white/90 backdrop-blur-sm text-[var(--primary)] text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">Portal Resmi DiTrace UPR</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-20 px-4 bg-[var(--light-neutral)]">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal active">
                <h2 class="text-3xl font-bold mb-4">Alur Pengisian Tracer Study</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Panduan langkah demi langkah untuk alumni Jurusan Ekonomi Pembangunan maupun jurusan lain di lingkungan UPR.</p>
            </div>

            <div class="relative reveal active">
                <div class="hidden lg:block absolute top-12 left-[10%] right-[10%] h-1 bg-blue-200 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-4 relative z-10">

                    <div class="step-card bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center relative flex flex-col items-center">
                        <div class="step-number w-16 h-16 rounded-full bg-[var(--primary)] text-white text-2xl font-bold flex items-center justify-center mb-4 border-4 border-white shadow-md z-10">1</div>
                        <h3 class="font-bold text-gray-800 text-sm mb-2">Kunjungi Website Tracer Study UPR</h3>
                        <p class="text-xs text-gray-500">Buka portal resmi pelacakan alumni UPR (DiTrace).</p>
                        <div class="lg:hidden mt-6 text-blue-200">
                            <svg class="w-6 h-6 animate-bounce mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        </div>
                    </div>

                    <div class="step-card bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center relative flex flex-col items-center">
                        <div class="step-number w-16 h-16 rounded-full bg-[var(--primary)] text-white text-2xl font-bold flex items-center justify-center mb-4 border-4 border-white shadow-md z-10">2</div>
                        <h3 class="font-bold text-gray-800 text-sm mb-2">Klik Tombol Login Pada Navbar</h3>
                        <p class="text-xs text-gray-500">Akses menu masuk yang berada di bagian atas website.</p>
                        <div class="lg:hidden mt-6 text-blue-200">
                            <svg class="w-6 h-6 animate-bounce mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        </div>
                    </div>

                    <div class="step-card bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center relative flex flex-col items-center">
                        <div class="step-number w-16 h-16 rounded-full bg-[var(--primary)] text-white text-2xl font-bold flex items-center justify-center mb-4 border-4 border-white shadow-md z-10">3</div>
                        <h3 class="font-bold text-gray-800 text-sm mb-2">Isi Data Mahasiswa</h3>
                        <p class="text-xs text-gray-500">Masukkan Nomor Induk Mahasiswa (NIM) dan kredensial yang telah diberikan.</p>
                        <div class="lg:hidden mt-6 text-blue-200 md:hidden"> <svg class="w-6 h-6 animate-bounce mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        </div>
                    </div>

                    <div class="step-card bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center relative flex flex-col items-center">
                        <div class="step-number w-16 h-16 rounded-full bg-[var(--primary)] text-white text-2xl font-bold flex items-center justify-center mb-4 border-4 border-white shadow-md z-10">4</div>
                        <h3 class="font-bold text-gray-800 text-sm mb-2">Isi Data Diri & Tracer Study</h3>
                        <p class="text-xs text-gray-500">Lengkapi kuisioner mengenai pekerjaan, studi lanjut, atau aktivitas Anda saat ini.</p>
                        <div class="lg:hidden mt-6 text-blue-200">
                            <svg class="w-6 h-6 animate-bounce mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        </div>
                    </div>

                    <div class="step-card bg-[#E8F1F8] p-6 rounded-2xl shadow-md border-2 border-[var(--secondary)] text-center relative flex flex-col items-center transform scale-105 z-20">
                        <div class="step-number w-16 h-16 rounded-full bg-[var(--accent)] text-white text-2xl font-bold flex items-center justify-center mb-4 border-4 border-white shadow-lg">5</div>
                        <h3 class="font-bold text-[var(--primary)] text-sm mb-2">Klik "Selesai Menjawab"</h3>
                        <p class="text-xs text-gray-600">Simpan jawaban Anda. Terima kasih atas kontribusi Anda untuk almamater!</p>

                        <div class="absolute -top-3 -right-3 bg-green-500 text-white p-1.5 rounded-full shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-4 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-blue-50 opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-orange-50 opacity-50"></div>

        <div class="max-w-3xl mx-auto text-center relative z-10 reveal active">
            <h2 class="text-3xl md:text-4xl font-bold mb-6" style="color: var(--primary);">Sudah Siap Mengisi Tracer Study?</h2>
            <p class="text-gray-600 mb-10 text-lg">
                Luangkan waktu 5-10 menit Anda. Suara dan rekam jejak Anda adalah penentu arah masa depan jurusan Ekonomi Pembangunan.
            </p>

            <a href="https://ditrace.upr.ac.id/" target="_blank" rel="noopener noreferrer"
                class="group relative inline-flex items-center justify-center gap-3 bg-[var(--accent)] hover:bg-[#d4882e] text-white text-lg md:text-xl font-bold py-4 px-10 rounded-full transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <span>Isi Tracer Study Sekarang</span>
                <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>

                <span class="absolute -inset-1 rounded-full border border-[var(--accent)] opacity-50 group-hover:animate-ping"></span>
            </a>

            <p class="text-xs text-gray-400 mt-6 italic">
                *Tombol di atas akan mengarahkan Anda ke portal resmi DiTrace UPR (https://ditrace.upr.ac.id/)
            </p>
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
