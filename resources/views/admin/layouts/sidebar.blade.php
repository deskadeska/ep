<aside
    class="fixed top-0 left-0 w-64 h-screen bg-white border-r border-[#D1D5DB] overflow-y-auto flex flex-col z-40 shadow-sm transition-transform duration-300">
    <div class="sticky top-0 bg-white z-10 px-6 py-5 border-b border-[#D1D5DB]">
        <h2 class="text-xl font-bold" style="color: var(--navy, #1E3A5F);">Admin Portal</h2>
        <p class="text-xs font-medium" style="color: var(--caption, #6B7280);">Ekonomi Pembangunan</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-8">

        <div>
            <h3 class="px-3 text-xs font-bold uppercase tracking-wider mb-2" style="color: var(--subheadline, #2A6F97);">
                Akademik</h3>
            <ul class="space-y-1">
                @php
                    $menusAkademik = [
                        [
                            'url' => 'admin/akademik/mata-kuliah',
                            'label' => 'Mata Kuliah',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />',
                        ],
                        [
                            'url' => 'admin/akademik/magang',
                            'label' => 'Magang',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />',
                        ],
                        [
                            'url' => 'admin/akademik/kalender',
                            'label' => 'Kalender Akademik',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />',
                        ],
                        [
                            'url' => 'admin/akademik/panduan',
                            'label' => 'Panduan Akademik',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
                        ],
                        [
                            'url' => 'admin/akademik/tugas-akhir',
                            'label' => 'Keperluan Tugas Akhir',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />',
                        ],
                        [
                            'url' => 'admin/akademik/administrasi',
                            'label' => 'Administrasi Akademik',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />',
                        ],
                    ];
                @endphp
                @foreach ($menusAkademik as $menu)
                    <li>
                        <a href="{{ url($menu['url']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is($menu['url'] . '*') ? 'bg-[#E8F1F8] text-[#F2A541] font-semibold' : 'text-[#2F2F2F] hover:bg-[#F4F6F9] hover:text-[#1E3A5F]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">{!! $menu['icon'] !!}</svg>
                            <span class="truncate">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="px-3 text-xs font-bold uppercase tracking-wider mb-2"
                style="color: var(--subheadline, #2A6F97);">Kemahasiswaan</h3>
            <ul class="space-y-1">
                @php
                    $menusMhs = [
                        [
                            'url' => 'admin/kemahasiswaan/struktur-organisasi',
                            'label' => 'Struktur Organisasi',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />',
                        ],
                        [
                            'url' => 'admin/kemahasiswaan/alumni',
                            'label' => 'Alumni',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.952-3.17m-1.23-3.11a3.75 3.75 0 10-7.5 0 3.75 3.75 0 007.5 0zM18.375 12a3.375 3.375 0 10-6.75 0 3.375 3.375 0 006.75 0z" />',
                        ],
                        [
                            'url' => 'admin/kemahasiswaan/prestasi',
                            'label' => 'Prestasi',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />',
                        ],
                        [
                            'url' => 'admin/kemahasiswaan/bank-judul',
                            'label' => 'Bank Judul Skripsi',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />',
                        ],
                        [
                            'url' => 'admin/kemahasiswaan/organisasi',
                            'label' => 'Organisasi Mahasiswa',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />',
                        ],
                        [
                            'url' => 'admin/kemahasiswaan/statistik',
                            'label' => 'Statistik Beranda',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />',
                        ],
                    ];
                @endphp
                @foreach ($menusMhs as $menu)
                    <li>
                        <a href="{{ url($menu['url']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is($menu['url'] . '*') ? 'bg-[#E8F1F8] text-[#F2A541] font-semibold' : 'text-[#2F2F2F] hover:bg-[#F4F6F9] hover:text-[#1E3A5F]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">{!! $menu['icon'] !!}</svg>
                            <span class="truncate">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="px-3 text-xs font-bold uppercase tracking-wider mb-2"
                style="color: var(--subheadline, #2A6F97);">Informasi Penting</h3>
            <ul class="space-y-1">
                @php
                    $menusInfo = [
                        [
                            'url' => 'admin/informasi-penting/tenaga-pengajar',
                            'label' => 'Tenaga Pengajar',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />',
                        ],
                        [
                            'url' => 'admin/informasi-penting/tenaga-kependidikan',
                            'label' => 'Tenaga Kependidikan',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />',
                        ],

                        // Perubahan path URL pada menu Mitra:
                        [
                            'url' => 'admin/informasi-penting/mitra',
                            'label' => 'Mitra',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />',
                        ],
                        [
                            'url' => 'admin/informasi-penting/pimpinan-jurusan',
                            'label' => 'Pimpinan Jurusan',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 9a2 2 0 11-4 0 2 2 0 014 0z" />',
                        ],
                    ];
                @endphp
                @foreach ($menusInfo as $menu)
                    <li>
                        <a href="{{ url($menu['url']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is($menu['url'] . '*') ? 'bg-[#E8F1F8] text-[#F2A541] font-semibold' : 'text-[#2F2F2F] hover:bg-[#F4F6F9] hover:text-[#1E3A5F]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">{!! $menu['icon'] !!}</svg>
                            <span class="truncate">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="px-3 text-xs font-bold uppercase tracking-wider mb-2"
                style="color: var(--subheadline, #2A6F97);">Seputar Prodi</h3>
            <ul class="space-y-1">
                @php
                    $menusProdi = [
                        [
                            'url' => 'admin/prodi/berita',
                            'label' => 'Berita',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-5.25 3h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />',
                        ],
                        [
                            'url' => 'admin/prodi/video',
                            'label' => 'Video',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />',
                        ],
                        [
                            'url' => 'admin/prodi/dokumentasi',
                            'label' => 'Dokumentasi',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316zM16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />',
                        ],
                        [
                            'url' => 'admin/prodi/jadwal-kegiatan',
                            'label' => 'Jadwal Kegiatan',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />',
                        ],
                    ];
                @endphp
                @foreach ($menusProdi as $menu)
                    <li>
                        <a href="{{ url($menu['url']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is($menu['url'] . '*') ? 'bg-[#E8F1F8] text-[#F2A541] font-semibold' : 'text-[#2F2F2F] hover:bg-[#F4F6F9] hover:text-[#1E3A5F]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">{!! $menu['icon'] !!}</svg>
                            <span class="truncate">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="px-3 text-xs font-bold uppercase tracking-wider mb-2"
                style="color: var(--subheadline, #2A6F97);">Data Admin</h3>
            <ul class="space-y-1">
                @php
                    $menusAdmin = [
                        [
                            'url' => 'admin/kelola',
                            'label' => 'Kelola',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143-.854-.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71-.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894zM15 12a3 3 0 11-6 0 3 3 0 016 0z" />',
                        ],
                        [
                            'url' => 'admin/profil',
                            'label' => 'Profil',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />',
                        ],
                    ];
                @endphp
                @foreach ($menusAdmin as $menu)
                    {{-- LOGIKA ROLE: Sembunyikan 'Kelola' jika bukan Super Admin --}}
                    @if ($menu['label'] == 'Kelola' && auth()->user()->tipeUser !== 'Super Admin')
                        @continue
                    @endif

                    <li>
                        <a href="{{ url($menu['url']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->is($menu['url'] . '*') ? 'bg-[#E8F1F8] text-[#F2A541] font-semibold' : 'text-[#2F2F2F] hover:bg-[#F4F6F9] hover:text-[#1E3A5F]' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">{!! $menu['icon'] !!}</svg>
                            <span class="truncate">{{ $menu['label'] }}</span>
                        </a>
                    </li>
                @endforeach

                <li class="pt-2">
                    <form action="{{ url('/admin/logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <span class="truncate">Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</aside>
