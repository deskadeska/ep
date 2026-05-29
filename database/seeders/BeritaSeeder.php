<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tb_berita')->insert([

            // =========================
            // HIGHLIGHT
            // =========================

            [
                'judulBerita' => 'FEB Universitas Palangka Raya Gelar Seminar Nasional Ekonomi Digital',
                'deskripsiBerita' => 'Fakultas Ekonomi dan Bisnis Universitas Palangka Raya menyelenggarakan seminar nasional bertema ekonomi digital dan transformasi bisnis modern. Kegiatan ini menghadirkan akademisi, praktisi industri, serta mahasiswa untuk membahas perkembangan teknologi dalam dunia ekonomi dan bisnis.

Seminar ini bertujuan meningkatkan pemahaman mahasiswa mengenai peluang dan tantangan transformasi digital di era industri 5.0. Selain sesi pemaparan materi, peserta juga mengikuti diskusi interaktif terkait inovasi bisnis berbasis teknologi.',
                'statusBerita' => 'Highlight',
                'kategoriBerita' => 'Akademik',
                'fotoBerita' => 'berita/seminar-ekonomi-digital.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'Mahasiswa FEB UPR Raih Juara Kompetisi Business Plan Nasional',
                'deskripsiBerita' => 'Tim mahasiswa Fakultas Ekonomi dan Bisnis Universitas Palangka Raya berhasil meraih juara pada ajang kompetisi business plan tingkat nasional. Proposal bisnis yang diangkat berfokus pada pengembangan UMKM berbasis digital di Kalimantan Tengah.

Prestasi ini menjadi bukti bahwa mahasiswa FEB mampu bersaing secara kompetitif di tingkat nasional. Pihak fakultas berharap pencapaian tersebut dapat memotivasi mahasiswa lain untuk terus mengembangkan kreativitas dan inovasi bisnis.',
                'statusBerita' => 'Highlight',
                'kategoriBerita' => 'Prestasi',
                'fotoBerita' => 'berita/juara-business-plan.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'FEB UPR Perkuat Kerja Sama dengan Dunia Industri',
                'deskripsiBerita' => 'Fakultas Ekonomi dan Bisnis Universitas Palangka Raya melakukan penandatanganan kerja sama dengan beberapa perusahaan dan instansi strategis. Kerja sama ini meliputi program magang mahasiswa, penelitian kolaboratif, dan pengembangan kompetensi lulusan.

Melalui kolaborasi tersebut, mahasiswa diharapkan memperoleh pengalaman praktis yang relevan dengan kebutuhan dunia kerja. Fakultas juga berkomitmen memperluas jaringan kemitraan untuk mendukung implementasi program Merdeka Belajar Kampus Merdeka.',
                'statusBerita' => 'Highlight',
                'kategoriBerita' => 'Kerja Sama',
                'fotoBerita' => 'berita/kerjasama-industri.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // =========================
            // PUBLISHED
            // =========================

            [
                'judulBerita' => 'Pelaksanaan Workshop Penulisan Karya Ilmiah bagi Mahasiswa',
                'deskripsiBerita' => 'Program workshop penulisan karya ilmiah diselenggarakan untuk meningkatkan kemampuan akademik mahasiswa dalam menyusun artikel dan penelitian ilmiah. Kegiatan ini menghadirkan dosen serta peneliti berpengalaman sebagai narasumber utama.

Peserta memperoleh materi mengenai teknik penyusunan jurnal, metode penelitian, hingga penggunaan referensi ilmiah yang baik dan benar. Workshop berlangsung secara interaktif dengan sesi praktik penulisan langsung.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Kegiatan',
                'fotoBerita' => 'berita/workshop-karya-ilmiah.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'FEB UPR Adakan Pelatihan Digital Marketing untuk UMKM',
                'deskripsiBerita' => 'Fakultas Ekonomi dan Bisnis Universitas Palangka Raya mengadakan pelatihan digital marketing bagi pelaku UMKM lokal. Pelatihan ini membahas strategi pemasaran melalui media sosial dan marketplace digital.

Kegiatan tersebut merupakan bentuk pengabdian kepada masyarakat yang bertujuan membantu pelaku usaha meningkatkan daya saing bisnis. Peserta juga diberikan praktik langsung terkait pembuatan konten promosi digital.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Pengabdian',
                'fotoBerita' => 'berita/pelatihan-digital-marketing.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'Kuliah Umum Kepemimpinan dan Manajemen Organisasi',
                'deskripsiBerita' => 'Kuliah umum mengenai kepemimpinan dan manajemen organisasi diikuti oleh mahasiswa dari berbagai program studi di lingkungan FEB UPR. Materi disampaikan oleh praktisi manajemen yang memiliki pengalaman di dunia industri nasional.

Mahasiswa mendapatkan wawasan mengenai pentingnya kemampuan leadership dalam menghadapi tantangan dunia kerja modern. Kegiatan berlangsung dengan antusias melalui sesi tanya jawab dan studi kasus.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Akademik',
                'fotoBerita' => 'berita/kuliah-umum.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'Program Studi Manajemen Laksanakan Evaluasi Kurikulum',
                'deskripsiBerita' => 'Program Studi Manajemen FEB UPR melaksanakan evaluasi kurikulum untuk menyesuaikan kebutuhan industri dan perkembangan teknologi terkini. Evaluasi dilakukan bersama dosen, alumni, dan stakeholder eksternal.

Kegiatan ini bertujuan meningkatkan kualitas pembelajaran serta kompetensi lulusan agar lebih relevan dengan dunia kerja. Hasil evaluasi akan menjadi dasar pengembangan kurikulum pada tahun akademik berikutnya.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Akademik',
                'fotoBerita' => 'berita/evaluasi-kurikulum.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'Mahasiswa FEB Ikuti Program Pertukaran Mahasiswa Merdeka',
                'deskripsiBerita' => 'Sejumlah mahasiswa FEB Universitas Palangka Raya mengikuti program Pertukaran Mahasiswa Merdeka di berbagai perguruan tinggi di Indonesia. Program ini memberikan kesempatan belajar lintas budaya dan pengalaman akademik baru.

Selain mengikuti perkuliahan, mahasiswa juga terlibat dalam berbagai kegiatan sosial dan pengembangan karakter. Pengalaman tersebut diharapkan dapat meningkatkan wawasan kebangsaan serta kompetensi mahasiswa.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Mahasiswa',
                'fotoBerita' => 'berita/pertukaran-mahasiswa.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'FEB UPR Selenggarakan Bakti Sosial di Desa Mitra',
                'deskripsiBerita' => 'Kegiatan bakti sosial dilaksanakan oleh dosen dan mahasiswa FEB UPR sebagai bentuk kepedulian terhadap masyarakat desa mitra. Program meliputi pembagian bantuan pendidikan dan penyuluhan ekonomi kreatif.

Masyarakat menyambut positif kegiatan tersebut karena memberikan manfaat langsung bagi lingkungan sekitar. Fakultas berharap program pengabdian dapat terus dilaksanakan secara berkelanjutan.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Sosial',
                'fotoBerita' => 'berita/bakti-sosial.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'judulBerita' => 'Peningkatan Fasilitas Laboratorium Komputer FEB',
                'deskripsiBerita' => 'FEB Universitas Palangka Raya melakukan peningkatan fasilitas laboratorium komputer guna mendukung proses pembelajaran berbasis teknologi informasi. Pembaruan meliputi perangkat komputer, jaringan internet, dan software pendukung pembelajaran.

Dengan fasilitas baru tersebut, mahasiswa diharapkan dapat lebih optimal dalam mengikuti praktikum dan kegiatan akademik lainnya. Fakultas juga terus berupaya meningkatkan kualitas sarana dan prasarana pendidikan.',
                'statusBerita' => 'Published',
                'kategoriBerita' => 'Fasilitas',
                'fotoBerita' => 'berita/laboratorium-komputer.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
