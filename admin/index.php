<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

$koneksi = check_and_reconnect($koneksi);

// Get stats
$menu_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM menu"))['count'];
$pelayanan_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM pelayanan"))['count'];
$request_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM pelayanan WHERE jenis = 'Request'"))['count'];
$keluhan_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM pelayanan WHERE jenis = 'Keluhan'"))['count'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SI-SPPG</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding-top: 80px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        h2 { color: #002b6b; }
        .stat-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 { margin-top: 0; color: #002b6b; }
        .stat-card p { font-size: 36px; font-weight: bold; margin: 10px 0; }

        @media (max-width: 768px) {
            .stat-container {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .stat-container {
                grid-template-columns: 1fr;
            }
            .stat-card p {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <?php include '../template/navbar_admin.php'; ?>

    <div class="container">
        <h2>Admin Dashboard</h2>
        <div class="stat-container">
            <div class="stat-card">
                <h3>Total Menu</h3>
                <p><?php echo $menu_count; ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Pengajuan</h3>
                <p><?php echo $pelayanan_count; ?></p>
            </div>
            <div class="stat-card">
                <h3>Jumlah Request</h3>
                <p><?php echo $request_count; ?></p>
            </div>
            <div class="stat-card">
                <h3>Jumlah Keluhan</h3>
                <p><?php echo $keluhan_count; ?></p>
            </div>
        </div>
    </div>

</body>
</html>
