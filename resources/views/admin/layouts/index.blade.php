<!-- Menggunakan Master Layout app.blade.php -->
@extends('admin.layouts.app')

<!-- Mengisi bagian @yield('content') pada Master Layout -->
@section('content')

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <h1 class="text-2xl font-bold mb-2" style="color: var(--navy);">Selamat Datang di Admin Portal</h1>
        <p style="color: var(--caption);">Anda login sebagai Super Admin. Gunakan menu di sidebar untuk mengelola data website.</p>
    </div>

@endsection
