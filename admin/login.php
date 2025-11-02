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
        font-family: Poppins, sans-serif;
        background: #0C2876;
    }
    .container {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .logo img {
        width: 90px;
        margin-bottom: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .box {
        background: #E5E5E5;
        width: 350px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 0px 3px #0096FF;
        text-align: center;
    }
    .box label {
        float: left;
        font-size: 13px;
        margin-bottom: 5px;
        margin-top: 10px;
    }
    .box input {
        width: 100%;
        padding: 10px;
        border-radius: 7px;
        border: 1px solid #999;
        margin-bottom: 10px;
        outline: none;
    }
    .btn-login {
        background: #FFDB58;
        width: 100%;
        border: none;
        padding: 12px;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
        transition: .3s;
    }
    .btn-login:hover {
        opacity: .8;
    }
    .back {
        margin-top: 15px;
        display: block;
        font-size: 12px;
        text-decoration: none;
        color: black;
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
