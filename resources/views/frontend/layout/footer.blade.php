<footer style="background-color: #1A2C44;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 lg:gap-6">

            <div class="flex flex-col">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('assets/logo_upr.png') }}" alt="Logo UPR" class="w-12 h-12 object-contain flex-shrink-0">
                    <div>
                        <p class="text-xs font-medium" style="color: #E8F1F8;">Jurusan Ekonomi Pembangunan</p>
                        <p class="text-sm font-bold leading-tight" style="color: #FFD166;">Universitas Palangka Raya</p>
                    </div>
                </div>
                <p class="text-sm leading-relaxed" style="color: #E8F1F8; opacity: 0.75;">
                    Jl. DMG. Salilah. I (73112), Kota Palangka Raya, Kalimantan Tengah.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider mb-5" style="color: #E8F1F8;">Tentang Jurusan</h3>
                <ul class="space-y-3">
                    @foreach(['Sejarah Jurusan Ekopem', 'Visi', 'Misi'] as $link)
                    <li>
                        <a href="#" class="footer-link text-sm transition-colors duration-150" style="color: #F2A541;">{{ $link }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider mb-5" style="color: #E8F1F8;">Akademik</h3>
                <ul class="space-y-3">
                    @foreach(['Profil Dosen', 'Mata Kuliah', 'Kalender Akademik'] as $link)
                    <li>
                        <a href="#" class="footer-link text-sm transition-colors duration-150" style="color: #F2A541;">{{ $link }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider mb-5" style="color: #E8F1F8;">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 flex-shrink-0" style="color: #F2A541;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:epkom423@gmail.com" class="footer-link text-sm" style="color: #F2A541;">epkom423@gmail.com</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 flex-shrink-0" style="color: #F2A541;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-sm" style="color: #E8F1F8; opacity: 0.85;">+6281234567890</span>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider mb-5" style="color: #E8F1F8;">Sosial Media</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 flex-shrink-0" style="color: #F2A541;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <a href="#" class="footer-link text-sm leading-tight" style="color: #F2A541;">Ekonomi Pembangunan</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 flex-shrink-0" style="color: #F2A541;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                        <a href="#" class="footer-link text-sm" style="color: #F2A541;">@ekopem_upr</a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 flex-shrink-0" style="color: #F2A541;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        <a href="https://youtube.com/@ekonomipembangunanupr?si=NscR5fDBoaPpgvLs" target="_blank" class="footer-link text-sm" style="color: #F2A541;">Ekopem UPR</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="mt-14 pt-6 border-t" style="border-color: #2F4A6B;">
            <p class="text-center text-xs" style="color: #E8F1F8; opacity: 0.6;">© {{ date('Y') }} Jurusan Ekonomi Pembangunan — Fakultas Ekonomi dan Bisnis, Universitas Palangka Raya. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
.footer-link:hover { color: #FFD166 !important; }
</style>
