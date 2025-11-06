<?php
// home.php
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Halaman Utama - Satuan Pelayanan Pemenuhan Gizi</title>


  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      overflow-y: scroll; /* Always show scrollbar to prevent layout shifts */
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-wrapper {
        flex: 1 0 auto;
    }

    /* Bagian hero / sambutan */
    .hero {
      position: relative;
      width: 100%;
      min-height: 80vh; /* Use min-height instead of fixed height */
      background-image: url('assets/img/gambarsppg.jpg'); /* ganti dengan gambar kamu */
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 80px 20px; /* Add vertical padding */
    }

    /* Lapisan transparan gelap */
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.55); /* Slightly darker overlay */
    }

    /* Teks sambutan */
    .hero-content {
      position: relative;
      color: #ffffff;
      text-align: center;
      z-index: 1;
      max-width: 900px; /* Slightly wider */
      padding: 30px; /* More padding */
      background: rgba(0, 0, 0, 0.2); /* Subtle background for text */
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* More prominent shadow */
    }

    .hero-content h1 {
      font-family: 'Segoe UI', Arial, sans-serif;
      font-size: 52px; /* Larger font size */
      font-weight: 900; /* Even bolder */
      margin-bottom: 15px; /* More space */
      letter-spacing: 2px; /* More letter spacing */
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Text shadow */
    }

    .hero-content p {
      font-family: 'Segoe UI', Arial, sans-serif;
      font-size: 24px; /* Larger font size */
      font-weight: 400;
      color: #f0f0f0;
      line-height: 1.6;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 36px;
      }
      .hero-content p {
        font-size: 20px;
      }
      .hero-content {
        padding: 20px;
      }
    }

    @media (max-width: 480px) {
      .hero-content h1 {
        font-size: 28px;
      }
      .hero-content p {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
<?php require 'template/navbar.php'; ?>

<div class="content-wrapper">
  <section class="hero">
    <div class="hero-content">
      <h1>Selamat Datang Di</h1>
      <p>Sistem Informasi Satuan Pelayanan Pemenuhan Gizi</p>
    </div>
  </section>
</div>

<?php require 'template/footer.php'; ?>
</body>
</html>
