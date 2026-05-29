<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Judul Skripsi — Ekonomi Pembangunan UPR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@700&family=DM+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #1E3A5F;
            --secondary: #2A6F97;
            --accent: #F2A541;
            --soft-bg: #E8F1F8;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #F4F6F9;
        }

        h1,
        h2 {
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
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center"
        style="background-image: url('{{ asset('assets/images/bg-bank-judul.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/85 backdrop-blur-[2px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 text-[var(--accent)] reveal active">Referensi
                Akademik</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white reveal active">Bank Judul Skripsi</h1>
            <p class="max-w-2xl mx-auto text-[var(--soft-bg)] reveal active">
                Kumpulan judul penelitian mahasiswa Ekonomi Pembangunan sebagai referensi metodologi dan topik skripsi.
            </p>
        </div>
    </section>

    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">

            <div class="mb-8 flex justify-center reveal active">
                <form action="{{ route('frontend.bank_judul') }}" method="GET" class="w-full max-w-2xl">
                    <div class="relative bg-white rounded-full shadow-lg border border-gray-100 p-2 flex items-center">
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Cari nama mahasiswa atau judul skripsi..."
                            class="flex-1 bg-transparent px-6 py-2 outline-none text-sm">
                        <button type="submit"
                            class="bg-[var(--primary)] text-white px-8 py-2.5 rounded-full text-sm font-bold hover:bg-[var(--secondary)] transition-all">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-12 reveal active">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Mahasiswa</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Judul Skripsi</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Metodologi</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Pembimbing</th>
                                <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($bankJudul as $bj)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-5 px-6">
                                        <span
                                            class="font-bold text-[var(--primary)] text-sm">{{ $bj->namaMhsBJS }}</span>
                                    </td>
                                    <td class="py-5 px-6">
                                        <span
                                            class="text-sm leading-relaxed text-gray-700 block max-w-md">{{ $bj->judulSkripsiBJS }}</span>
                                    </td>
                                    <td class="py-5 px-6">
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider"
                                            style="background-color: var(--soft-bg); color: var(--secondary);">
                                            {{ $bj->metodologiPenelitianBJS }}
                                        </span>
                                    </td>
                                    <td class="py-5 px-6">
                                        <div class="text-sm font-medium text-gray-800 space-y-1">
                                            <div>
                                                {{ $bj->dosenPembimbing->namaTP ?? '-' }}
                                            </div>
                                            @if ($bj->dosenPembimbingBJS2)
                                                <div class="text-sm font-medium text-gray-800 space-y-1">
                                                    {{ $bj->dosenPembimbing2->namaTP ?? '-' }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-5 px-6 whitespace-nowrap">
                                        <span class="text-xs font-bold text-gray-400">
                                            {{ \Carbon\Carbon::parse($bj->tanggalSeminarBJS)->translatedFormat('d M Y') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center text-gray-400 italic">Data tidak
                                        ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    {{ $bankJudul->links() }}
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 reveal active">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-2">Tren Metodologi Penelitian</h2>
                    <p class="text-sm text-gray-500">Grafik penggunaan metodologi skripsi per bulan berdasarkan tanggal
                        seminar.</p>
                </div>
                <div class="h-[400px]">
                    <canvas id="methodologyChart"></canvas>
                </div>
            </div>

        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Inisialisasi Grafik Diagram Garis
        const ctx = document.getElementById('methodologyChart').getContext('2d');
        const methodologyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels), // Sekarang berisi tahun (misal: 2024, 2025, 2026)
                datasets: @json($datasets)
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                return 'Tahun: ' + tooltipItems[0].label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Tahun Seminar'
                        }
                    }
                }
            }
        });
        // Animasi Reveal
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
