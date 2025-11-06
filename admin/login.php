<?php
session_start();
// include DB connection when needed; use absolute path to avoid issues
// (will be required below before running queries)
// require_once __DIR__ . '/../koneksi.php';

// PROSES LOGIN (database-backed)
if (isset($_POST['login'])) {
    // read submitted username and password
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($username === '' || $password === '') {
        echo "<script>alert('Mohon masukkan username dan password.');</script>";
    } else {
        // include DB connection
        require_once __DIR__ . '/../koneksi.php';

        $koneksi = check_and_reconnect($koneksi);

        if (!isset($koneksi) || !$koneksi) {
            echo "<script>alert('Tidak dapat terhubung ke database.');</script>";
        } else {
            $sql = "SELECT id, username, password FROM admin WHERE username = ? LIMIT 1";
            $stmt = mysqli_prepare($koneksi, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id, $dbUser, $dbPass);

                if (mysqli_stmt_fetch($stmt)) {
                    mysqli_stmt_close($stmt);

                    $verified = false;
                    if (function_exists('password_verify') && @password_verify($password, $dbPass)) {
                        $verified = true;
                    } elseif ($password === $dbPass) {
                        $verified = true; // fallback for plaintext (not recommended)
                    }

                    if ($verified) {
                        $_SESSION['admin'] = $dbUser;
                        echo "<script>alert('Login Berhasil!'); window.location='index.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('Username atau Password Salah!');</script>";
                    }
                } else {
                    mysqli_stmt_close($stmt);
                    echo "<script>alert('Username atau Password Salah!');</script>";
                }
            } else {
                echo "<script>alert('Gagal menyiapkan query database.');</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(to right, #0C2876, #0096FF);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .logo img {
        width: 100px;
        margin-bottom: 20px;
    }
    .box {
        background: rgba(255, 255, 255, 0.9);
        width: 380px;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .box h2 {
        margin-bottom: 20px;
        color: #333;
    }
    .box label {
        float: left;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }
    .box input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        outline: none;
        transition: border-color 0.3s;
    }
    .box input:focus {
        border-color: #0096FF;
    }
    .btn-login {
        background: #FFDB58;
        width: 100%;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.3s;
    }
    .btn-login:hover {
        background-color: #FFC700;
    }
    .back {
        margin-top: 20px;
        display: block;
        font-size: 14px;
        text-decoration: none;
        color: #555;
        transition: color 0.3s;
    }
    .back:hover {
        color: #000;
    }
</style>
</head>
<body>

<div class="container">

    <!-- LOGO TANPA FILE, SUDAH SATU PAGE -->
    <div class="logo">
        <img src="../assets/img/Logo_Badan_Gizi_Nasional_(2024).png" alt="Logo">
    </div>

    <form action="" method="POST" class="box">
        <label>Username:</label>
        <input type="text" name="username" placeholder="Username" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login" class="btn-login">LOGIN</button>

        <a href="../index.php" class="back">Kembali Ke Website</a>
    </form>
</div>

</body>
</html>
