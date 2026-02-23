<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

$koneksi = check_and_reconnect($koneksi);
$message = '';
$message_type = '';

// Proses tambah admin
if (isset($_POST['tambah_admin'])) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $namalengkap = isset($_POST['namalengkap']) ? trim($_POST['namalengkap']) : '';

    // Validasi input
    if ($username === '' || $password === '' || $namalengkap === '') {
        $message = 'Semua field harus diisi!';
        $message_type = 'error';
    } elseif (strlen($username) < 3) {
        $message = 'Username minimal 3 karakter!';
        $message_type = 'error';
    } elseif (strlen($password) < 5) {
        $message = 'Password minimal 5 karakter!';
        $message_type = 'error';
    } else {
        // Cek apakah username sudah ada
        $check_sql = "SELECT username FROM admin WHERE username = ?";
        $check_stmt = mysqli_prepare($koneksi, $check_sql);
        mysqli_stmt_bind_param($check_stmt, 's', $username);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $message = 'Username sudah terdaftar!';
            $message_type = 'error';
            mysqli_stmt_close($check_stmt);
        } else {
            mysqli_stmt_close($check_stmt);

            // Hash password jika fungsi password_hash tersedia
            $hashed_password = function_exists('password_hash') ? password_hash($password, PASSWORD_DEFAULT) : $password;

            // Insert admin baru
            $insert_sql = "INSERT INTO admin (username, password, namalengkap) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($koneksi, $insert_sql);
            
            if ($insert_stmt) {
                mysqli_stmt_bind_param($insert_stmt, 'sss', $username, $hashed_password, $namalengkap);
                
                if (mysqli_stmt_execute($insert_stmt)) {
                    $message = 'Admin berhasil ditambahkan!';
                    $message_type = 'success';
                    // Kosongkan form
                    $_POST['username'] = '';
                    $_POST['password'] = '';
                    $_POST['namalengkap'] = '';
                } else {
                    $message = 'Gagal menambahkan admin: ' . mysqli_error($koneksi);
                    $message_type = 'error';
                }
                mysqli_stmt_close($insert_stmt);
            } else {
                $message = 'Gagal menyiapkan query: ' . mysqli_error($koneksi);
                $message_type = 'error';
            }
        }
    }
}

// Ambil daftar admin yang sudah ada
$admin_list = mysqli_query($koneksi, "SELECT id, username, namalengkap FROM admin ORDER BY id DESC");

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - SI-SPPG</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding-top: 80px;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        h2 {
            color: #002b6b;
            margin-bottom: 20px;
        }
        .form-section {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #0096FF;
            box-shadow: 0 0 5px rgba(0, 150, 255, 0.3);
        }
        .form-button {
            display: flex;
            gap: 10px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }
        .btn-submit {
            background-color: #0096FF;
            color: white;
        }
        .btn-submit:hover {
            background-color: #0078cc;
        }
        .btn-reset {
            background-color: #6c757d;
            color: white;
        }
        .btn-reset:hover {
            background-color: #5a6268;
        }
        .message {
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .message-icon {
            margin-right: 10px;
            font-size: 18px;
        }
        .table-section {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #002b6b;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            .form-section {
                padding: 15px;
            }
            table {
                font-size: 13px;
            }
            th, td {
                padding: 8px;
            }
            .form-button {
                flex-direction: column;
            }
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include '../template/navbar_admin.php'; ?>

    <div class="container">
        <h2>Tambah Admin Baru</h2>

        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <span class="message-icon">
                    <?php echo $message_type === 'success' ? '✓' : '✕'; ?>
                </span>
                <span><?php echo $message; ?></span>
            </div>
        <?php endif; ?>

        <div class="form-section">
            <h3 style="color: #002b6b; margin-top: 0;">Form Pendaftaran Admin</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                        required
                        placeholder="Masukkan username (minimal 3 karakter)"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        placeholder="Masukkan password (minimal 5 karakter)"
                    >
                </div>

                <div class="form-group">
                    <label for="namalengkap">Nama Lengkap:</label>
                    <input 
                        type="text" 
                        id="namalengkap" 
                        name="namalengkap" 
                        value="<?php echo isset($_POST['namalengkap']) ? htmlspecialchars($_POST['namalengkap']) : ''; ?>" 
                        required
                        placeholder="Masukkan nama lengkap"
                    >
                </div>

                <div class="form-button">
                    <button type="submit" name="tambah_admin" class="btn-submit">Tambah Admin</button>
                    <button type="reset" class="btn-reset">Bersihkan</button>
                </div>
            </form>
        </div>

        <div class="table-section">
            <h3 style="color: #002b6b; margin-top: 0;">Daftar Admin</h3>
            <?php if (mysqli_num_rows($admin_list) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($admin_list)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['namalengkap']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">Tidak ada data admin</div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
