<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ekopem UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Library CryptoJS untuk enkripsi sisi Client -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            /* Background gambar atau gradient untuk menonjolkan efek Glassmorphism */
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

        @if(session('error'))
            <div class="bg-red-500 bg-opacity-70 border border-red-300 text-white px-4 py-3 rounded-lg mb-6 text-sm backdrop-blur-sm">
                {{ session('error') }}
            </div>
        @endif

        <form id="loginForm" action="{{ url('/admin/login') }}" method="POST">
            @csrf
            <!-- Input aslinya tidak akan dikirim (tanpa atribut name) -->
            <div class="mb-5">
                <label class="block text-sm font-medium mb-2 opacity-90">Email / No. Telepon</label>
                <input type="text" id="raw_identifier" required
                    class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-gray-200 border-opacity-30 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-[#F2A541] transition-all"
                    placeholder="Masukkan Email atau No. Telepon">
            </div>

            <div class="mb-6">
                <labelcm class="block text-sm font-medium mb-2 opacity-90">Password</label>
                <input type="password" id="raw_password" required
                    class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 border border-gray-200 border-opacity-30 text-white placeholder-gray-200 focus:outline-none focus:ring-2 focus:ring-[#F2A541] transition-all"
                    placeholder="Masukkan Password Min. 8 Karakter">
            </div>

            <!-- Input hidden untuk menampung hasil enkripsi -->
            <input type="hidden" name="encrypted_payload" id="encrypted_payload">

            <button type="submit"
                class="w-full bg-[#F2A541] hover:bg-[#d4882e] text-white font-bold py-3 px-4 rounded-lg transition-all transform hover:-translate-y-1 shadow-lg">
                Masuk Sistem
            </button>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const identifier = document.getElementById('raw_identifier').value;
            const password = document.getElementById('raw_password').value;

            const payloadData = JSON.stringify({
                identifier: identifier,
                password: password
            });

            // 1. KUNCI BARU (Wajib sama persis 32 Karakter dengan di Controller)
            const secretKey = 'EkopemUprSecretKey2026AdminLogin';

            // 2. PARSING KUNCI (Wajib untuk AES murni)
            const keyParsed = CryptoJS.enc.Utf8.parse(secretKey);

            // 3. ENKRIPSI
            const encryptedData = CryptoJS.AES.encrypt(payloadData, keyParsed, {
                mode: CryptoJS.mode.ECB,
                padding: CryptoJS.pad.Pkcs7
            }).toString();

            document.getElementById('encrypted_payload').value = encryptedData;

            // Lanjutkan submit
            this.submit();
        });
    </script>
</body>
</html>
