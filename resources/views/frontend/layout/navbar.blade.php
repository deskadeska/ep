@php
    // Sentralisasi Menu dan Path URL untuk Frontend
    $navMenus = [
        'Profil Jurusan' => [
            'Sejarah Jurusan' => url('/informasi/sejarah-jurusan'),
            'Visi & Misi' => url('/informasi/visi-misi'),
            'Zona Integritas' => url('/informasi/zona-integritas'),
            'Pimpinan Jurusan' => url('/informasi/pimpinan-jurusan'),
            'Tenaga Pengajar' => url('/informasi/tenaga-pengajar'),
            'Tenaga Kependidikan' => url('/informasi/tenaga-kependidikan'),
        ],
        'Akademik' => [
            'Mata Kuliah' => url('/akademik/mata-kuliah'),
            'Magang' => url('/akademik/magang'),
            'Kalender Akademik' => url('/akademik/kalender'),
            'Panduan Akademik' => url('/akademik/panduan'),
            'Keperluan Tugas Akhir' => url('/akademik/tugas-akhir'),
            'Administrasi Akademik' => url('/akademik/administrasi'),
        ],
        'Kemahasiswaan' => [
            'Struktur Organisasi' => url('/kemahasiswaan/struktur-organisasi'),
            'Alumni' => url('/kemahasiswaan/alumni'),
            'Prestasi' => url('/kemahasiswaan/prestasi'),
            'Bank Judul Skripsi' => url('/kemahasiswaan/bank-judul'),
            'Organisasi Mahasiswa' => url('/kemahasiswaan/organisasi-mahasiswa'),
        ],
        'Seputar Prodi' => [
            'Berita' => url('/prodi/berita'),
            'Dokumentasi' => url('/prodi/dokumentasi'),
            'Video' => url('/prodi/video'),
            'Jadwal Kegiatan' => url('/prodi/jadwal-kegiatan')
        ],
    ];
@endphp

<nav class="navbar fixed top-0 left-0 right-0 z-50 shadow-lg" style="background-color: #1E3A5F;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ url('/') }}"
                class="flex items-center space-x-3 flex-shrink-0 hover:opacity-90 transition-opacity">
                <img src="{{ asset('assets/logo_upr.png') }}" alt="Logo UPR" class="w-10 h-10 object-contain">

                <div class="hidden sm:block">
                    <p class="text-xs font-semibold leading-tight" style="color: #E8F1F8;">Jurusan Ekonomi
                        Pembangunan</p>
                    <p class="text-sm font-bold leading-tight" style="color: #FFD166;">Universitas Palangka Raya</p>
                </div>
            </a>

            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ url('/') }}"
                    class="nav-link px-3 py-2 rounded text-sm font-medium transition-all duration-200"
                    style="color: #E8F1F8;">Beranda</a>

                @foreach ($navMenus as $kategori => $subItems)
                    <div class="relative group">
                        <button
                            class="nav-link flex items-center px-3 py-2 rounded text-sm font-medium transition-all duration-200"
                            style="color: #E8F1F8;">
                            {{ $kategori }}
                            <svg class="ml-1 w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="dropdown-menu absolute left-0 mt-1 w-52 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border"
                            style="background-color: #F4F6F9; border-color: #D1D5DB;">
                            <div class="py-1">
                                @foreach ($subItems as $label => $path)
                                    <a href="{{ $path }}"
                                        class="dropdown-item block px-4 py-2 text-sm transition-colors duration-150"
                                        style="color: #2F2F2F;">{{ $label }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-md transition-colors duration-200"
                style="color: #E8F1F8;" aria-label="Toggle menu">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden" style="background-color: #1E3A5F; border-top: 1px solid #2F4A6B;">
        <div class="px-4 py-3 space-y-1 max-h-screen overflow-y-auto">
            <a href="{{ url('/') }}"
                class="block px-3 py-2 rounded text-sm font-medium transition-colors duration-150"
                style="color: #E8F1F8;">Beranda</a>

            @foreach ($navMenus as $kategori => $subItems)
                <div class="mobile-accordion">
                    <button
                        class="mobile-accordion-btn w-full flex items-center justify-between px-3 py-2 rounded text-sm font-medium transition-colors duration-150"
                        style="color: #E8F1F8;">
                        {{ $kategori }}
                        <svg class="accordion-arrow w-4 h-4 transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="mobile-accordion-content hidden pl-4 space-y-1 pb-2">
                        @foreach ($subItems as $label => $path)
                            <a href="{{ $path }}"
                                class="block px-3 py-2 rounded text-sm transition-colors duration-150"
                                style="color: #E8F1F8; opacity: 0.85;">{{ $label }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</nav>

<style>
    .nav-link:hover {
        color: #F2A541 !important;
    }

    .dropdown-item:hover {
        background-color: #E8F1F8 !important;
        color: #1E3A5F !important;
    }

    .mobile-accordion-btn:hover {
        color: #F2A541 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburger = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            hamburger.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Mobile accordion
        document.querySelectorAll('.mobile-accordion-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const arrow = this.querySelector('.accordion-arrow');
                content.classList.toggle('hidden');
                arrow.style.transform = content.classList.contains('hidden') ? 'rotate(0deg)' :
                    'rotate(180deg)';
            });
        });
    });
</script>
