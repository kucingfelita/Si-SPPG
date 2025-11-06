<?php
session_start();
include 'koneksi.php';

$pesan_sukses = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_pengajuan = $_POST['jenis_pengajuan'];
    $pesan = $_POST['pesan'];

    $koneksi = check_and_reconnect($koneksi);

    $query = "INSERT INTO pelayanan (nama, jenis, pesan) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sss", $nama, $jenis_pengajuan, $pesan);
    
    if (mysqli_stmt_execute($stmt)) {
        $pesan_sukses = "Pengajuan Anda berhasil terkirim!";
    } else {
        $pesan_sukses = "Terjadi kesalahan. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pelayanan & Pengajuan</title>
   <style>
      html, body {
         overflow-y: scroll; /* Always show scrollbar to prevent layout shifts */
         height: 100%;
      }
      body {
         background-color: #f4f6f9;
         margin: 0;
         padding: 0;
         font-family: 'Segoe UI', Arial, sans-serif;
         padding-top: 76px;
         display: flex;
         flex-direction: column;
      }
      .content-wrapper {
         flex-grow: 1;
      }
      .main {
         max-width: 600px;
         background: white;
         margin: 30px auto;
         padding: 30px;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }
      h2 {
         text-align: center;
         color: #002b6b;
         margin-top: 0;
         margin-bottom: 20px;
      }
      .form-group {
         margin-bottom: 15px;
      }
      .form-group label {
         display: block;
         margin-bottom: 5px;
         font-weight: bold;
      }
      .form-group input,
      .form-group select,
      .form-group textarea {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 4px;
         box-sizing: border-box;
      }
      .form-group textarea {
         resize: vertical;
         min-height: 100px;
      }
      .btn-submit {
         background-color: #1d2975;
         color: white;
         padding: 12px 20px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         width: 100%;
         font-size: 16px;
      }
      .btn-submit:hover {
         background-color: #002b6b;
      }
      .pesan-sukses {
         background-color: #d4edda;
         color: #155724;
         padding: 10px;
         border-radius: 4px;
         margin-bottom: 20px;
         text-align: center;
      }

      @media (max-width: 768px) {
        .main {
            padding: 20px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: calc(100% - 20px); /* Adjust for padding */
        }
      }
   </style>
</head>

<body>
   <?php include 'template/navbar.php'; ?>
   <div class="content-wrapper">
      <div class="main">
         <h2>Pelayanan & Pengajuan</h2>

         <?php if (!empty($pesan_sukses)): ?>
            <div class="pesan-sukses"><?php echo $pesan_sukses; ?></div>
         <?php endif; ?>

         <form action="laporan.php" method="POST">
            <div class="form-group">
               <label for="nama">Nama</label>
               <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
               <label for="jenis_pengajuan">Jenis Pengajuan</label>
               <select id="jenis_pengajuan" name="jenis_pengajuan" required>
                  <option value="Request">Request</option>
                  <option value="Keluhan">Keluhan</option>
               </select>
            </div>
            <div class="form-group">
               <label for="pesan">Pesan</label>
               <textarea id="pesan" name="pesan" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Kirim</button>
         </form>
      </div>
   </div>
   <?php 
   $show_admin_login_in_footer = true;
   include 'template/footer.php'; 
   ?>
</body>

</html>
