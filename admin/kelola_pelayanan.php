<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

$koneksi = check_and_reconnect($koneksi);

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM pelayanan WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: kelola_pelayanan.php");
    exit;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM pelayanan WHERE nama LIKE ? ORDER BY tanggal DESC";
$stmt = mysqli_prepare($koneksi, $sql);
$search_param = "%$search%";
mysqli_stmt_bind_param($stmt, 's', $search_param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelayanan & Pengajuan - Admin</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding-top: 80px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { color: #002b6b; }
        .btn-delete { padding: 8px 12px; border: none; border-radius: 4px; color: white; text-decoration: none; cursor: pointer; background-color: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .table-wrapper {
            overflow-x: auto;
        }
        .modal { display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .btn-info { background-color: #17a2b8; }
    </style>
</head>
<body>
    <?php include '../template/navbar_admin.php'; ?>

    <div class="container">
        <h2>Kelola Pelayanan & Pengajuan</h2>

        <form action="kelola_pelayanan.php" method="GET" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Cari Nama..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn-add" style="background-color: #007bff;">Cari</button>
        </form>

        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo date('d F Y', strtotime($row['tanggal'])); ?></td>
                    <td><?php echo htmlspecialchars($row['jenis']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['pesan'])); ?></td>
                    <td>
                        <button class="btn btn-info" onclick='openMessageModal(<?php echo json_encode($row['pesan']); ?>)'>Lihat Lengkap</button>
                        <a href="kelola_pelayanan.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    </div>

    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeMessageModal()">&times;</span>
            <h3>Pesan Lengkap</h3>
            <div id="fullMessageContent"></div>
        </div>
    </div>

    <script>
        const messageModal = document.getElementById('messageModal');
        const fullMessageContent = document.getElementById('fullMessageContent');

        function openMessageModal(message) {
            fullMessageContent.innerHTML = '<p>' + message.replace(/\n/g, '<br>') + '</p>';
            messageModal.style.display = 'block';
        }

        function closeMessageModal() {
            messageModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == messageModal) {
                closeMessageModal();
            }
        }
    </script>

</body>
</html>
