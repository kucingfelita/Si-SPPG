<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>SI-SPPG Pucang 2</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    .navbar {
      background-color: #1d2975; /* biru tua */
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 40px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
      font-size: 20px;
      font-weight: 600;
      margin: 0;
      letter-spacing: 0.3px;
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
      transition: all 0.2s ease;
      position: relative;
    }

    .navbar-right a:hover::after,
    .navbar-right a.active::after {
      content: '';
      position: absolute;
      bottom: -5px;
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
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="navbar-left">
      <img src="../assets/img/Logo_Badan_Gizi_Nasional_(2024).png" alt="Logo">
      <h1>SI-SPPG Pucang 2</h1>
    </div>

    <div class="navbar-right">
      <a href="#" class="active">Dashboard</a>
      <a href="#">Kelola Menu</a>
      <a href="#">Kelola Pelayanan & Pengajuan</a>
      <a href="#">Logout</a>
    </div>
  </nav>

</body>
</html>
