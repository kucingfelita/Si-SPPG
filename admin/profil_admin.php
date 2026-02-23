<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';
$koneksi = check_and_reconnect($koneksi);

$username = $_SESSION['admin'];

// Get admin data from database
$stmt = mysqli_prepare($koneksi, "SELECT id, username, password, namalengkap FROM admin WHERE username = ?");
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $db_username, $db_password, $namalengkap);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Handle password change
if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify old password
    $verified = false;
    if (function_exists('password_verify') && @password_verify($old_password, $db_password)) {
        $verified = true;
    } elseif ($old_password === $db_password) {
        $verified = true; // fallback for plaintext
    }

    if (!$verified) {
        echo "<script>alert('Password lama salah!');</script>";
    } elseif ($new_password !== $confirm_password) {
        echo "<script>alert('Password baru dan konfirmasi tidak cocok!');</script>";
    } elseif (strlen($new_password) < 6) {
        echo "<script>alert('Password baru minimal 6 karakter!');</script>";
    } else {
        // Hash new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $update_stmt = mysqli_prepare($koneksi, "UPDATE admin SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($update_stmt, 'si', $hashed_password, $id);
        
        if (mysqli_stmt_execute($update_stmt)) {
            echo "<script>alert('Password berhasil diubah!'); window.location='profil_admin.php';</script>";
        } else {
            echo "<script>alert('Gagal mengubah password!');</script>";
        }
        mysqli_stmt_close($update_stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - SI-SPPG</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding-top: 80px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #1d2975, #0096FF);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 40px;
            font-weight: bold;
        }

        .profile-header h2 {
            margin: 0;
            color: #1d2975;
            font-size: 24px;
        }

        .profile-header p {
            color: #666;
            margin: 5px 0 0;
        }

        .info-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 150px;
            font-weight: 500;
            color: #333;
        }

        .info-value {
            flex: 1;
            color: #555;
        }

        .password-mask {
            letter-spacing: 3px;
        }

        h3 {
            color: #1d2975;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1d2975;
        }

        .btn-change {
            background: linear-gradient(135deg, #1d2975, #0096FF);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-change:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-logout:hover {
            background: #c82333;
        }

        .logout-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .info-row {
                flex-direction: column;
            }

            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <?php include '../template/navbar_admin.php'; ?>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo strtoupper(substr($namalengkap, 0, 1)); ?>
                </div>
                <h2><?php echo htmlspecialchars($namalengkap); ?></h2>
                <p><?php echo htmlspecialchars($db_username); ?></p>
            </div>

            <div class="profile-info">
                <div class="info-row">
                    <div class="info-label">Username</div>
                    <div class="info-value"><?php echo htmlspecialchars($db_username); ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value"><?php echo htmlspecialchars($namalengkap); ?></div>
                </div>
            </div>
        </div>

        <div class="profile-card">
            <h3>Ubah Password</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" id="old_password" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" required minlength="6">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
                </div>
                <button type="submit" name="change_password" class="btn-change">Ubah Password</button>
            </form>

            <div class="logout-section">
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
