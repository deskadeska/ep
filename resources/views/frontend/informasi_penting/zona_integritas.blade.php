<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Integritas — Ekonomi Pembangunan UPR</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Nunito:wght@700;800;900&family=Bangers&display=swap');

        /* Variabel Global Standar Web */
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

        /* =========================================
           CSS BANNER ZONA INTEGRITAS
        ========================================= */
        .banner-wrapper {
            display: flex;
            justify-content: center;
            padding: 60px 20px;
            /* Padding disesuaikan agar tidak menabrak navbar/footer */
            background: #f4f6f9;
        }

        .banner {
            width: 340px;
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            /* Shadow diperhalus agar lebih modern */
            font-family: 'Oswald', sans-serif;
            position: relative;
        }

        /* TOP LOGO AREA */
        .logo-bar {
            background: linear-gradient(180deg, #f5f0c8 0%, #e8d98a 100%);
            padding: 10px 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-bottom: 3px solid #cc0000;
        }

        .logo-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 2px solid #999;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: white;
            flex-shrink: 0;
        }

        .logo-circle.tut-wuri {
            background: #4a8cc4;
        }

        .logo-circle.upr {
            background: #2a6e3a;
        }

        .logo-circle.blu {
            background: #29abe2;
        }

        .logo-circle.dikti {
            background: white;
            border-color: #29abe2;
        }

        .logo-inner-text {
            font-size: 7px;
            font-weight: 700;
            color: white;
            text-align: center;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .logo-emblem {
            width: 32px;
            height: 32px;
        }

        /* RED HEADER */
        .red-header {
            background: linear-gradient(180deg, #cc0000 0%, #990000 100%);
            padding: 10px 12px 14px;
            text-align: center;
            position: relative;
        }

        .anda-masuki {
            color: white;
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 2px;
            font-family: 'Oswald', sans-serif;
        }

        .zona-text {
            font-family: 'Bangers', cursive;
            font-size: 72px;
            color: white;
            line-height: 0.9;
            letter-spacing: 4px;
            text-shadow: 3px 3px 0 rgba(0, 0, 0, 0.3);
            display: block;
        }

        .integritas-text {
            font-family: 'Bangers', cursive;
            font-size: 40px;
            color: white;
            letter-spacing: 6px;
            text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.3);
            display: block;
            margin-top: -8px;
            opacity: 0.95;
            border: 3px solid rgba(255, 255, 255, 0.6);
            padding: 2px 16px;
            display: inline-block;
            border-radius: 2px;
        }

        .menuju-wbk {
            color: white;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 3px;
            margin-top: 6px;
            display: block;
        }

        /* MIDDLE WHITE SECTION */
        .middle-section {
            background: white;
            padding: 16px 16px 12px;
            position: relative;
            overflow: hidden;
        }

        .bg-number {
            position: absolute;
            right: -20px;
            top: -10px;
            font-size: 180px;
            color: rgba(180, 180, 220, 0.2);
            font-weight: 900;
            line-height: 1;
            pointer-events: none;
            z-index: 0;
        }

        .komitmen-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .komitmen-icon {
            display: flex;
            gap: 3px;
            align-items: flex-end;
        }

        .flag-shape {
            width: 22px;
            height: 28px;
            border-radius: 2px;
            position: relative;
        }

        .flag-shape.purple {
            background: #6b4fa0;
            transform: rotate(-5deg);
        }

        .flag-shape.red {
            background: #cc0000;
            transform: rotate(5deg);
            margin-left: -8px;
        }

        .komitmen-label {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .commitment-row {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
            gap: 12px;
        }

        .commitment-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #cc0000;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .commitment-icon-box.hand-stop {
            background: white;
            border: none;
        }

        .commitment-text-block {
            flex: 1;
        }

        .commitment-label {
            font-size: 14px;
            font-weight: 700;
            color: #222;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .commitment-line {
            height: 2px;
            background: #cc0000;
            border-radius: 1px;
            margin-top: 4px;
            width: 80%;
        }

        .no-korupsi-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            flex-shrink: 0;
        }

        .no-letter {
            font-size: 28px;
            font-weight: 900;
            color: #222;
            line-height: 1;
            font-family: 'Oswald', sans-serif;
        }

        .hand-icon svg {
            width: 36px;
            height: 36px;
        }

        /* 6 AREA SECTION */
        .area-section {
            background: white;
            padding: 10px 16px 0;
        }

        .area-title-block {
            text-align: center;
            margin-bottom: 10px;
        }

        .area-number {
            font-family: 'Bangers', cursive;
            font-size: 36px;
            color: #cc0000;
            display: inline;
            margin-right: 4px;
        }

        .area-perubahan {
            font-family: 'Bangers', cursive;
            font-size: 30px;
            color: #29abe2;
            letter-spacing: 2px;
            display: inline;
        }

        .zona-integritas-sub {
            font-family: 'Bangers', cursive;
            font-size: 30px;
            color: #cc0000;
            letter-spacing: 2px;
            display: block;
            text-align: center;
            margin-top: -4px;
        }

        /* LIST ITEMS */
        .list-section {
            background: white;
            padding: 8px 14px 0;
        }

        .list-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .num-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #cc0000;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            flex-shrink: 0;
            z-index: 1;
        }

        .item-label {
            background: linear-gradient(135deg, #f5d020 0%, #e8a800 100%);
            border-radius: 20px;
            padding: 6px 14px 6px 10px;
            font-size: 13px;
            font-weight: 700;
            color: #1a1a00;
            font-family: 'Nunito', sans-serif;
            flex: 1;
            line-height: 1.2;
            margin-left: -14px;
            padding-left: 22px;
        }

        /* BOTTOM RED BAR */
        .bottom-bar {
            height: 12px;
            background: linear-gradient(90deg, #cc0000, #ff4444, #cc0000);
            margin-top: 14px;
            border-radius: 0 0 4px 4px;
        }
    </style>
</head>

<body>

    @include('frontend.layout.navbar')

    <section class="pt-32 pb-20 px-4 relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/backrounds/backround_hero.jpg') }}');">
        <div class="absolute inset-0 bg-[#1E3A5F]/75 backdrop-blur-[1px]"></div>
        <div class="relative max-w-7xl mx-auto text-center z-10">
            <p class="text-sm font-bold uppercase tracking-widest mb-3 reveal active" style="color: var(--accent);">
                Komitmen Kami</p>
            <h1 class="text-3xl md:text-5xl font-bold mb-4 reveal active text-white">Zona Integritas</h1>
            <p class="max-w-2xl mx-auto font-medium reveal active delay-1" style="color: var(--soft-bg);">
                Fakultas Ekonomi dan Bisnis Universitas Palangka Raya berkomitmen penuh untuk mewujudkan Wilayah Bebas
                dari Korupsi (WBK) dan Wilayah Birokrasi Bersih dan Melayani (WBBM).
            </p>
        </div>
    </section>

    <section class="reveal active delay-2">
        <div class="banner-wrapper">
            <div class="banner">

                <div class="logo-bar">
                    <div class="logo-circle tut-wuri">
                        <svg viewBox="0 0 56 56" class="logo-emblem">
                            <circle cx="28" cy="28" r="28" fill="#4a8cc4" />
                            <circle cx="28" cy="28" r="22" fill="none" stroke="white"
                                stroke-width="1.5" />
                            <text x="28" y="24" text-anchor="middle" fill="white" font-size="7" font-weight="700">TUT
                                WURI</text>
                            <text x="28" y="33" text-anchor="middle" fill="white" font-size="7"
                                font-weight="700">HANDAYANI</text>
                            <path d="M18 38 Q28 42 38 38" stroke="white" stroke-width="1.5" fill="none" />
                        </svg>
                    </div>
                    <div class="logo-circle upr">
                        <svg viewBox="0 0 56 56" class="logo-emblem">
                            <circle cx="28" cy="28" r="28" fill="#2a6e3a" />
                            <circle cx="28" cy="28" r="22" fill="none" stroke="white"
                                stroke-width="1" />
                            <text x="28" y="22" text-anchor="middle" fill="white" font-size="5"
                                font-weight="700">UNIVERSITAS</text>
                            <text x="28" y="29" text-anchor="middle" fill="white" font-size="5">PALANGKA RAYA</text>
                            <text x="28" y="38" text-anchor="middle" fill="#f5d020" font-size="8"
                                font-weight="900">UPR</text>
                        </svg>
                    </div>
                    <div class="logo-circle blu">
                        <svg viewBox="0 0 56 56" class="logo-emblem">
                            <circle cx="28" cy="28" r="28" fill="#29abe2" />
                            <text x="28" y="26" text-anchor="middle" fill="white" font-size="14"
                                font-weight="900">BLU</text>
                            <text x="28" y="36" text-anchor="middle" fill="white" font-size="6">SPEED</text>
                        </svg>
                    </div>
                    <div class="logo-circle dikti">
                        <svg viewBox="0 0 56 56" class="logo-emblem">
                            <circle cx="28" cy="28" r="28" fill="white" />
                            <circle cx="28" cy="28" r="22" fill="none" stroke="#29abe2"
                                stroke-width="2" />
                            <text x="28" y="22" text-anchor="middle" fill="#29abe2" font-size="5"
                                font-weight="700">DIKTISAINTEK</text>
                            <path d="M20 26 Q28 34 36 26" stroke="#29abe2" stroke-width="2" fill="#e8f5fb" />
                            <text x="28" y="38" text-anchor="middle" fill="#29abe2" font-size="5"
                                font-weight="700">BERDAMPAK</text>
                        </svg>
                    </div>
                </div>

                <div class="red-header">
                    <div class="anda-masuki">Anda Memasuki Wilayah</div>
                    <span class="zona-text">ZONA</span>
                    <span class="integritas-text">INTEGRITAS</span>
                    <span class="menuju-wbk">MENUJU WBK / WBBM</span>
                </div>

                <div class="middle-section">
                    <div class="bg-number">6</div>

                    <div class="komitmen-title">
                        <div class="komitmen-icon">
                            <div class="flag-shape purple"></div>
                            <div class="flag-shape red"></div>
                        </div>
                        <div class="komitmen-label">Komitmen</div>
                    </div>

                    <div class="commitment-row">
                        <div style="flex:1">
                            <div class="commitment-label">BEBAS DARI<br>KORUPSI</div>
                            <div class="commitment-line"></div>
                        </div>
                        <div class="no-korupsi-badge">
                            <div class="no-letter" style="font-size:22px; color:#cc0000;">N<span
                                    style="color:#222">o</span></div>
                            <svg width="38" height="38" viewBox="0 0 38 38">
                                <g transform="rotate(-15,19,19)">
                                    <path
                                        d="M19 6 C14 6 10 10 10 15 L10 28 C10 30 12 32 14 32 L24 32 C26 32 28 30 28 28 L28 15 C28 10 24 6 19 6 Z"
                                        fill="#cc3300" />
                                    <rect x="13" y="14" width="4" height="14" rx="2"
                                        fill="#ff6644" />
                                    <rect x="21" y="14" width="4" height="14" rx="2"
                                        fill="#ff6644" />
                                    <rect x="17" y="10" width="4" height="14" rx="2"
                                        fill="#ff6644" />
                                    <ellipse cx="11" cy="22" rx="3" ry="6"
                                        fill="#cc3300" />
                                    <ellipse cx="27" cy="22" rx="3" ry="6"
                                        fill="#cc3300" />
                                    <path d="M10 28 Q19 36 28 28" fill="#cc3300" />
                                </g>
                                <circle cx="19" cy="19" r="17" fill="none" stroke="#cc0000"
                                    stroke-width="2.5" stroke-dasharray="4,3" />
                            </svg>
                        </div>
                    </div>

                    <div class="commitment-row">
                        <div class="commitment-icon-box">
                            <svg width="34" height="34" viewBox="0 0 34 34">
                                <circle cx="17" cy="17" r="16" fill="#cc0000" stroke="white"
                                    stroke-width="1.5" />
                                <path d="M17 8 L21 14 L28 15 L23 21 L24 28 L17 25 L10 28 L11 21 L6 15 L13 14 Z"
                                    fill="#f5d020" stroke="#e8a800" stroke-width="0.5" />
                            </svg>
                        </div>
                        <div class="commitment-text-block">
                            <div class="commitment-label">PELAYANAN<br>PRIMA</div>
                            <div class="commitment-line"></div>
                        </div>
                    </div>
                </div>

                <div class="area-section">
                    <div class="area-title-block">
                        <span class="area-number">6</span>
                        <span class="area-perubahan">ARE PERUBAHAN</span>
                        <span class="zona-integritas-sub">ZONA INTEGRITAS</span>
                    </div>
                </div>

                <div class="list-section">
                    <div class="list-item">
                        <div class="num-circle">1</div>
                        <div class="item-label">Manajemen Perubahan</div>
                    </div>
                    <div class="list-item">
                        <div class="num-circle">2</div>
                        <div class="item-label">Penataan Tatalaksana</div>
                    </div>
                    <div class="list-item">
                        <div class="num-circle">3</div>
                        <div class="item-label">Sistem Manajemen SDM</div>
                    </div>
                    <div class="list-item">
                        <div class="num-circle">4</div>
                        <div class="item-label">Penguatan Akuntabilitas</div>
                    </div>
                    <div class="list-item">
                        <div class="num-circle">5</div>
                        <div class="item-label">Penguatan Pengawasan</div>
                    </div>
                    <div class="list-item">
                        <div class="num-circle">6</div>
                        <div class="item-label">Peningkatan Kualitas<br>Pelayanan Publik</div>
                    </div>
                </div>

                <div class="bottom-bar"></div>

            </div>
        </div>
    </section>

    @include('frontend.layout.footer')

    <script>
        // Script Animasi Reveal
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
