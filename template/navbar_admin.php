<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>SI-SPPG Pucang 2</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f5f6fa;
    }

    .navbar {
      background-color: #1d2975; 
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 20px; /* ukuran sama dengan navbar awal */
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

      /* agar tetap di atas */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      box-sizing: border-box;
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
      font-family: 'Inter', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: #ffffff;
      margin: 0;
      letter-spacing: 0.5px;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 10px; /* 🔧 jarak antar tulisan diatur di sini */
    }

    .navbar-right a {
      color: #ffffff;
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      padding-bottom: 6px;
      transition: all 0.2s ease;
      position: relative;
      display: inline-block;
      font-family: 'Inter', sans-serif;
    }

    .navbar-right a:hover::after,
    .navbar-right a.active::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: #ffffff;
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

    @media (max-width: 480px) {
        .navbar-left h1 {
            font-size: 18px;
        }
        .navbar-right a {
            font-size: 14px;
        }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="navbar-left">
      <img src="../assets/img/Logo_Badan_Gizi_Nasional_(2024).png" alt="Logo">
      <h1>SI-SPPG Pucang 2</h1>
    </div>

    <div class="navbar-right">
      <?php
      $current_page = basename($_SERVER['SCRIPT_NAME']);
      ?>
      <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Dashboard</a>
      <a href="kelola_menu.php" class="<?php echo ($current_page == 'kelola_menu.php') ? 'active' : ''; ?>">Kelola Menu</a>
      <a href="kelola_pelayanan.php" class="<?php echo ($current_page == 'kelola_pelayanan.php') ? 'active' : ''; ?>">Kelola Pelayanan & Pengajuan</a>
      <a href="logout.php">Logout</a>
    </div>
    <button class="hamburger" aria-label="Toggle navigation">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>
  </nav>

</body>

<style>
  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background-color: #1d2975; 
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 20px; /* ukuran sama dengan navbar awal */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);

    /* agar tetap di atas */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    box-sizing: border-box;
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
    font-family: 'Inter', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    letter-spacing: 0.5px;
  }

  .navbar-right {
    display: flex;
    align-items: center;
    gap: 10px; /* 🔧 jarak antar tulisan diatur di sini */
  }

  .navbar-right a {
    color: #ffffff;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    padding-bottom: 6px;
    transition: all 0.2s ease;
    position: relative;
    display: inline-block;
    font-family: 'Inter', sans-serif;
  }

  .navbar-right a:hover::after,
  .navbar-right a.active::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #ffffff;
  }

  .navbar-right a:hover {
    opacity: 0.9;
  }

  .hamburger {
    display: none; /* Hidden by default */
    flex-direction: column;
    justify-content: space-around;
    width: 30px;
    height: 20px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    z-index: 200;
  }

  .hamburger-line {
    width: 100%;
    height: 2px;
    background: #fff;
    border-radius: 10px;
    transition: all 0.3s linear;
    position: relative;
  }

  @media (max-width: 768px) {
    .navbar-right {
      display: none; /* Hide nav links by default on small screens */
      flex-direction: column;
      width: 100%;
      position: absolute;
      top: 66px; /* Below the navbar */
      left: 0;
      background-color: #1d2975;
      padding: 10px 20px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-right.open {
      display: flex; /* Show when open */
    }

    .navbar-right a {
      padding: 10px 0;
      width: 100%;
      text-align: center;
    }

    .hamburger {
      display: flex; /* Show hamburger on small screens */
    }

    .navbar { flex-direction: row; align-items: center; justify-content: space-between; padding: 10px 20px; height: 66px; }
  }

  @media (max-width: 480px) {
      .navbar-left h1 {
          font-size: 18px;
      }
      .navbar-right a {
          font-size: 14px;
      }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navRight = document.querySelector('.navbar-right');

    hamburger.addEventListener('click', function() {
      navRight.classList.toggle('open');
    });
  });
</script>

</body>
</html>
