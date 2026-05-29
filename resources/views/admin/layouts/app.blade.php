<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Ekopem UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">


    <!-- Panggil Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Panggil Font (Opsional tapi direkomendasikan agar sesuai desain frontend) -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Variabel Warna Desain -->
    <style>
        :root {
            --navy: #1E3A5F;
            --subheadline: #2A6F97;
            --amber: #F2A541;
            --caption: #6B7280;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #F4F6F9; /* Warna abu-abu terang untuk area konten */
        }
    </style>
</head>
<body class="text-[#2F2F2F] antialiased">

    <!-- Memanggil file sidebar yang kita buat tadi -->
    @include('admin.layouts.sidebar')

    <!-- AREA KONTEN UTAMA -->
    <!-- ml-64 sangat penting: Memberi margin kiri sebesar lebar sidebar (16rem / 256px) -->
    <main class="ml-64 p-8 min-h-screen">

        <!-- Bagian ini akan diisi oleh konten dari halaman spesifik (seperti dashboard, tabel, dll) -->
        @yield('content')

    </main>

</body>
</html>
