<?php
// tentang.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | SI-SPPG Pucang 2</title>
    <link rel="stylesheet" href="assets/css/tentang.css">
    <style>
        html, body {
            overflow-y: scroll; /* Always show scrollbar to prevent layout shifts */
        }
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
            padding-top: 76px; /* sesuai tinggi navbar (66px) + 10px jarak */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-wrapper {
            flex: 1 0 auto;
        }

        .main {
            max-width: 900px; /* Slightly wider */
            background: white;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            padding: 40px; /* More padding */
            border-radius: 12px; /* More rounded corners */
            box-shadow: 0 6px 20px rgba(0,0,0,0.08); /* Softer, larger shadow */
            margin-bottom: 50px; /* Add margin to the bottom */
        }

        @media (max-width: 768px) {
            .main {
                max-width: 100%;
                padding: 25px;
            }
        }

        h2 {
            text-align: center;
            color: #1d2975; /* Darker blue for headings */
            margin-top: 0;
            margin-bottom: 30px; /* More space below heading */
            font-size: 2.2em; /* Larger heading */
            font-weight: 700;
        }

        h3 {
            color: #1d2975;
            margin-bottom: 10px; /* More space below subheadings */
            margin-top: 35px; /* More space above subheadings */
            font-size: 1.5em;
            font-weight: 600;
        }

        ul {
            margin-top: 10px;
            padding-left: 25px;
            line-height: 1.8; /* Improved line spacing */
        }

        li {
            margin-bottom: 8px;
            font-size: 1.05em;
        }

        p {
            text-align: justify;
            line-height: 1.7; /* Improved line spacing */
            margin-bottom: 15px;
            font-size: 1.05em;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main {
                margin-top: 20px;
                padding: 25px;
                border-radius: 8px;
            }
            h2 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }
            h3 {
                font-size: 1.3em;
                margin-top: 25px;
            }
            p, li {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .main {
                margin-top: 15px;
                padding: 15px;
            }
            h2 {
                font-size: 1.5em;
            }
            h3 {
                font-size: 1.2em;
            }
        }
    </style>
<body>
<?php require 'template/navbar.php'; ?>

<div class="main-wrapper">
<div class="main">
    <h2>Apa itu SPPG dalam Program Makan Bergizi Gratis?</h2>

    <p>
        SPPG adalah Satuan Pelayanan Pemenuhan Gizi yang merupakan unit pelaksana Program Makan Bergizi Gratis (MBG).
        Tujuannya adalah menyediakan informasi dan akses terhadap makanan bergizi, dengan tugas utama memastikan makanan diproduksi sesuai standar, diaudit kualitasnya,
        dan diterima tepat waktu. SPPG berfungsi sebagai dapur pusat yang menangani rantai penyediaan makanan dari bahan baku hingga distribusi ke sekolah-sekolah atau penerima manfaat lainnya.
    </p>

    <h3>Tugas utama SPPG:</h3>
    <ul>
        <li><b>Dapur Makan Bergizi Gratis (MBG):</b> Memasak makanan sesuai standar gizi, kebersihan, dan keamanan pangan.</li>
        <li><b>Pengawasan Kualitas:</b> Memeriksa kualitas makanan melalui berbagai standard, termasuk kebersihan dan kandungan nutrisi.</li>
        <li><b>Distribusi:</b> Mengatur dan memastikan makanan terkirim tepat waktu ke sekolah-sekolah penerima manfaat, seringkali dalam dua sesi: lebih tergantung jangkauan pengiriman.</li>
        <li><b>Pengendalian Rantai Pasok:</b> Mengelola seluruh proses, mulai dari pemilihan bahan baku, pembelian, hingga pengolahan dan distribusi.</li>
    </ul>

    <h3>Jenis SPPG:</h3>
    <ul>
        <li><b>SPPG Baru:</b> Dibangun dari awal.</li>
        <li><b>SPPG Renovasi:</b> Dibuat dari renovasi restoran, kafe, catering, rumah, atau ruko.</li>
        <li><b>SPPG Dapur:</b> Dapur yang berlokasi di dalam sekolah atau pesantren.</li>
    </ul>

    <h3>Kerjasama dan dampak:</h3>
    <p>
        Kemitraan SPPG melibatkan berbagai pihak termasuk mitra lokal seperti UMKM (pedagang sayur, ayam, dan bahan makanan) organisasi seperti TNI, Polri, dan BUMN.<br>
        Dampak Ekonomi: Program ini menciptakan lapangan kerja lokal baru, mendukung usaha kecil dan menengah (UMKM), seperti para pedagang sayur yang menyetai meningkat.<br>
        Investasi: Mitra yang mengelola SPPG umumnya mengeluarkan investasi yang signifikan untuk pembangunan dan operasionalnya.
    </p>

    <h3>Visi</h3>
    <p>
        Mewujudkan aksi dan nilai pemerintah dalam pemenuhan gizi masyarakat, khususnya melalui distribusi makanan bergizi yang aman dan sehat.
    </p>

    <h3>Misi</h3>
    <ul>
        <li>Mendistribusikan bahan dapur dan makanan yang tersandar di berbagai wilayah untuk memenuhi kebutuhan gizi anak sekolah.</li>
        <li>Meningkatkan efisiensi proses dan kesinambungan masakan secara berkelanjutan.</li>
        <li>Memberdayakan pelaku usaha lokal seperti petani/peternak di Kabupaten Jember.</li>
        <li>Mendorong partisipasi, tanggung jawab, dan kolaborasi dengan UMKM dengan mendengarkan masukan dan kebutuhan lokal.</li>
        <li>Menciptakan tata kelola program yang transparan dan profesional.</li>
    </ul>
</div>
</div>
<?php require 'template/footer.php'; ?>
</body>
</html>
