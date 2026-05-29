<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Halaman Tidak Ditemukan — Ekonomi Pembangunan UPR</title>
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
            background-color: var(--light-neutral);
            color: var(--dark-neutral);
        }
        h1 { font-family: 'Lora', serif; color: var(--primary); }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    @include('frontend.layout.navbar')

    <main class="flex-grow flex items-center justify-center pt-32 pb-20 px-4">
        <div class="text-center max-w-xl w-full">

            <div class="flex justify-center mb-4" style="color: var(--accent);">
                <svg class="w-16 h-16 md:w-20 md:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>

            <div class="text-[80px] md:text-[120px] font-black text-gray-200 leading-none select-none mb-6">
                404
            </div>

            <h1 class="text-2xl md:text-3xl font-bold mb-4">Oops! Halaman Tidak Ditemukan 🚧</h1>

            <p class="text-sm md:text-base text-gray-500 mb-10 leading-relaxed max-w-md mx-auto">
                Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia. Mari kembali ke jalan yang benar! 🧭
            </p>

            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 bg-[var(--primary)] text-white text-sm font-bold py-3 px-8 rounded-full hover:bg-[#2A6F97] transition-all shadow-md hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Kembali ke Beranda
            </a>

        </div>
    </main>

    @include('frontend.layout.footer')

</body>
</html>
