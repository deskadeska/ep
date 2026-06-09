<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ekopem UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
        }
        /* Efek Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(30, 58, 95, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Efek Overlay Gelap untuk Keterbacaan -->
    <div class="absolute inset-0 bg-gray-900 bg-opacity-40 z-0"></div>

    <div class="glass-panel w-full max-w-md p-8 rounded-2xl relative z-10 text-white">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">Admin Portal</h2>
            <p class="text-sm opacity-80">Jurusan Ekonomi Pembangunan UPR</p>
        </div>

        {{-- Notifikasi Sukses (misal: setelah logout) --}}
        @if(session('success'))
            <div class="bg-green-500 bg-opacity-70 border border-green-300 text-white px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi Error Umum --}}
        @if(session('error'))
            <div class="bg-red-500 bg-opacity-70 border border-red-300 text-white px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{--
            Form standar Laravel:
            - Tidak ada CryptoJS. Keamanan data saat transit adalah tugas HTTPS/SSL.
            - Input langsung menggunakan atribut `name` sehingga dikirim ke server secara standar.
            - Error validasi ditampilkan per field menggunakan $errors dari Laravel.
        --}}
        <form id="loginForm" action="{{ url('/admin/login') }}" method="POST" novalidate>
            @csrf

            {{-- Field: Identifier (Email / No. Telepon) --}}
            <div class="mb-5">
                <label for="identifier" class="block text-sm font-medium mb-2 opacity-90">
                    Email / No. Telepon
                </label>
                <input
                    type="text"
                    id="identifier"
                    name="identifier"
                    value="{{ old('identifier') }}"
                    required
                    autocomplete="username"
                    class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-gray-200 border-opacity-30 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F2A541] transition-all {{ $errors->has('identifier') ? 'border-red-400 border-opacity-100' : '' }}"
                    placeholder="Masukkan Email atau No. Telepon">

                @error('identifier')
                    <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field: Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2 opacity-90">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-gray-200 border-opacity-30 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F2A541] transition-all {{ $errors->has('password') ? 'border-red-400 border-opacity-100' : '' }}"
                    placeholder="Masukkan Password">

                @error('password')
                    <p class="mt-2 text-xs text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-3 px-4 rounded-lg transition-all transform hover:-translate-y-1 shadow-lg">
                Masuk Sistem
            </button>

            <div class="mt-4 text-center text-sm opacity-80">
                <p>Kembali ke <a href="{{ url('/') }}" class="text-[#F2A541] hover:underline">Beranda</a></p>
            </div>
        </form>
    </div>

    {{-- Tidak ada lagi script CryptoJS atau logika enkripsi di sisi client --}}

</body>
</html>
