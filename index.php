<?php
// home.php
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Halaman Utama - Satuan Pelayanan Pemenuhan Gizi</title>

  <!-- ✅ Link Google Fonts yang benar -->
  <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;700;800&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
    }

    /* Bagian hero / sambutan */
    .hero {
      position: relative;
      width: 100%;
      height: 100vh;
      background-image: url('assets/img/gambarsppg.jpg'); /* ganti dengan gambar kamu */
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* Lapisan transparan gelap */
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
    }

    /* Teks sambutan */
    .hero-content {
      position: relative;
      color: #ffffff;
      text-align: center;
      z-index: 1;
      max-width: 800px;
      padding: 20px;
    }

    .hero-content h1 {
      font-family: 'Abhaya Libre', serif; /* ✅ Terapkan langsung juga */
      font-size: 44px;
      font-weight: 800; /* ExtraBold */
      margin-bottom: 12px;
      letter-spacing: 1px;
    }

    .hero-content p {
      font-family: 'Abhaya Libre', serif;
      font-size: 22px;
      font-weight: 400;
      color: #f0f0f0;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 30px;
      }
      .hero-content p {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>
<?php require 'template/navbar.php'; ?>

  <section class="hero">
    <div class="hero-content">
      <h1>Selamat Datang Di</h1>
      <p>Sistem Informasi Satuan Pelayanan Pemenuhan Gizi</p>
    </div>
  </section>

<?php require 'template/footer.php'; ?>
</body>
</html>
