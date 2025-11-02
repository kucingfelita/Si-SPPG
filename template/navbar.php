<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>SI-SPPG Pucang 2</title>

  <!-- Tambahkan link font Rufina -->
  <link href="https://fonts.googleapis.com/css2?family=Rufina:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    .navbar {
      background-color: #1d2975; 
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 40px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

      /* agar tetap di atas saat scroll */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .navbar-left img {
      height: 50px; 
      width: 50px;
      object-fit: contain;
      border-radius: 50%;
    }

    .navbar-left h1 {
      font-family: 'Rufina', serif;
      font-size: 22px;
      font-weight: 700;
      color: #ffffff;
      margin: 0;
      letter-spacing: 0.5px;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .navbar-right a {
      color: #ffffff;
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      padding-bottom: 6px;
      transition: 0.3s;
    }

    .navbar-right a.active {
      border-bottom: 2px solid #ffffff;
    }

    .navbar-right a:hover {
      opacity: 0.9;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 20px;
      }
      .navbar-right {
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 8px;
      }
    }

    /* supaya konten tidak tertutup navbar */
    .main-content {
      margin-top: 80px;
      padding: 20px;
    }
  </style>
</head>
<body>

  <?php
  $current = basename($_SERVER['SCRIPT_NAME']);
  function is_active($name, $current) {
      return $name === $current ? 'active' : '';
  }
  ?>

  <nav class="navbar">
    <div class="navbar-left">
      <img src="/Si-SPPG/assets/img/Logo_Badan_Gizi_Nasional_(2024).png" alt="Logo Badan Gizi">
      <h1>SI-SPPG Pucang 2</h1>
    </div>

    <div class="navbar-right">
      <a href="index.php" class="<?php echo is_active('index.php', $current); ?>">Beranda</a>
      <a href="menu.php" class="<?php echo is_active('menu.php', $current); ?>">Menu</a>
      <a href="tentang.php" class="<?php echo is_active('tentang.php', $current); ?>">Tentang Kami</a>
      <a href="laporan.php" class="<?php echo is_active('laporan.php', $current); ?>">Pelayanan & Pengajuan</a>
    </div>
  </nav>


</body>
</html>
