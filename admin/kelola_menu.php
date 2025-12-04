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
    // First, get the filename of the photo to delete it from the server
    $sql = "SELECT foto FROM menu WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $foto);
    if (mysqli_stmt_fetch($stmt)) {
        if (file_exists('../assets/uploads/' . $foto)) {
            unlink('../assets/uploads/' . $foto);
        }
    }
    mysqli_stmt_close($stmt);

    // Then, delete the record from the database
    $sql = "DELETE FROM menu WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: kelola_menu.php");
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $namamenu = $_POST['namamenu'];
    $tanggal = $_POST['tanggal'];
    $menu_utama = $_POST['menu_utama'];
    $lauk = $_POST['lauk'];
    $saus = $_POST['saus'];
    $dessert = $_POST['dessert'];
    $energi_besar = $_POST['energi_besar'];
    $protein_besar = $_POST['protein_besar'];
    $lemak_besar = $_POST['lemak_besar'];
    $karbo_besar = $_POST['karbo_besar'];
    $energi_kecil = $_POST['energi_kecil'];
    $protein_kecil = $_POST['protein_kecil'];
    $lemak_kecil = $_POST['lemak_kecil'];
    $karbo_kecil = $_POST['karbo_kecil'];
    $foto = $_FILES['foto']['name'];

    if ($id) { // Edit
        if ($foto) {
            $target = "../assets/uploads/" . basename($foto);
            move_uploaded_file($_FILES['foto']['tmp_name'], $target);
            $sql = "UPDATE menu SET namamenu=?, tanggal=?, menu_utama=?, lauk=?, saus=?, dessert=?, energi_besar=?, protein_besar=?, lemak_besar=?, karbo_besar=?, energi_kecil=?, protein_kecil=?, lemak_kecil=?, karbo_kecil=?, foto=? WHERE id=?";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, 'sssssssssssssssi', $namamenu, $tanggal, $menu_utama, $lauk, $saus, $dessert, $energi_besar, $protein_besar, $lemak_besar, $karbo_besar, $energi_kecil, $protein_kecil, $lemak_kecil, $karbo_kecil, $foto, $id);
        } else {
            $sql = "UPDATE menu SET namamenu=?, tanggal=?, menu_utama=?, lauk=?, saus=?, dessert=?, energi_besar=?, protein_besar=?, lemak_besar=?, karbo_besar=?, energi_kecil=?, protein_kecil=?, lemak_kecil=?, karbo_kecil=? WHERE id=?";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssssssssssssi', $namamenu, $tanggal, $menu_utama, $lauk, $saus, $dessert, $energi_besar, $protein_besar, $lemak_besar, $karbo_besar, $energi_kecil, $protein_kecil, $lemak_kecil, $karbo_kecil, $id);
        }
    } else { // Add
        $target = "../assets/uploads/" . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
        $sql = "INSERT INTO menu (namamenu, tanggal, menu_utama, lauk, saus, dessert, energi_besar, protein_besar, lemak_besar, karbo_besar, energi_kecil, protein_kecil, lemak_kecil, karbo_kecil, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssssssssss', $namamenu, $tanggal, $menu_utama, $lauk, $saus, $dessert, $energi_besar, $protein_besar, $lemak_besar, $karbo_besar, $energi_kecil, $protein_kecil, $lemak_kecil, $karbo_kecil, $foto);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: kelola_menu.php");
    exit;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM menu WHERE namamenu LIKE ? ORDER BY tanggal DESC";
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
    <title>Kelola Menu - Admin</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding-top: 80px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { color: #002b6b; }
        .btn { padding: 8px 12px; border: none; border-radius: 4px; color: white; text-decoration: none; cursor: pointer; }
        .btn-add { background-color: #28a745; }
        .btn-edit { background-color: #ffc107; }
        .btn-delete { background-color: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .table-wrapper {
            overflow-x: auto;
        }
        .modal { display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px; border-radius: 8px; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <?php include '../template/navbar_admin.php'; ?>

    <div class="container">
        <h2>Kelola Menu</h2>
        <form action="kelola_menu.php" method="GET" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Cari Nama Menu..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-add">Cari</button>
        </form>

        <button class="btn btn-add" onclick="openModal(null)">Tambah Menu</button>

        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Tanggal</th>
                    <th>Menu Utama</th>
                    <th>Lauk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['namamenu']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['menu_utama']; ?></td>
                    <td><?php echo $row['lauk']; ?></td>
                    <td>
                        <button class="btn btn-info" onclick='openGiziModal(<?php echo json_encode($row); ?>)'>Lihat Gizi</button>
                        <button class="btn btn-edit" onclick='openModal(<?php echo json_encode($row); ?>)'>Edit</button>
                        <a href="kelola_menu.php?delete=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    </div>

    <div id="menuModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="modalTitle">Tambah Menu</h3>
            <form action="kelola_menu.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="menuId">
                <p><label>Nama Menu: <input type="text" name="namamenu" id="namamenu" required></label></p>
                <p><label>Tanggal: <input type="date" name="tanggal" id="tanggal" required></label></p>
                <p><label>Menu Utama: <input type="text" name="menu_utama" id="menu_utama" required></label></p>
                <p><label>Lauk: <input type="text" name="lauk" id="lauk"></label></p>
                <p><label>Saus: <input type="text" name="saus" id="saus"></label></p>
                <p><label>Dessert: <input type="text" name="dessert" id="dessert"></label></p>
                <p><label>Energi (Besar): <input type="text" name="energi_besar" id="energi_besar"></label></p>
                <p><label>Protein (Besar): <input type="text" name="protein_besar" id="protein_besar"></label></p>
                <p><label>Lemak (Besar): <input type="text" name="lemak_besar" id="lemak_besar"></label></p>
                <p><label>Karbohidrat (Besar): <input type="text" name="karbo_besar" id="karbo_besar"></label></p>
                <p><label>Energi (Kecil): <input type="text" name="energi_kecil" id="energi_kecil"></label></p>
                <p><label>Protein (Kecil): <input type="text" name="protein_kecil" id="protein_kecil"></label></p>
                <p><label>Lemak (Kecil): <input type="text" name="lemak_kecil" id="lemak_kecil"></label></p>
                <p><label>Karbohidrat (Kecil): <input type="text" name="karbo_kecil" id="karbo_kecil"></label></p>
                <p><label>Foto: <input type="file" name="foto" id="foto"></label></p>
                <button type="submit" class="btn btn-add">Simpan</button>
            </form>
        </div>
    </div>

    <div id="giziModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeGiziModal()">&times;</span>
            <h3>Informasi Gizi</h3>
            <div id="giziContent"></div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('menuModal');
        const modalTitle = document.getElementById('modalTitle');
        const menuId = document.getElementById('menuId');
        const namamenu = document.getElementById('namamenu');
        const tanggal = document.getElementById('tanggal');
        const menu_utama = document.getElementById('menu_utama');
        const lauk = document.getElementById('lauk');
        const saus = document.getElementById('saus');
        const dessert = document.getElementById('dessert');
        const energi_besar = document.getElementById('energi_besar');
        const protein_besar = document.getElementById('protein_besar');
        const lemak_besar = document.getElementById('lemak_besar');
        const karbo_besar = document.getElementById('karbo_besar');
        const energi_kecil = document.getElementById('energi_kecil');
        const protein_kecil = document.getElementById('protein_kecil');
        const lemak_kecil = document.getElementById('lemak_kecil');
        const karbo_kecil = document.getElementById('karbo_kecil');

        const giziModal = document.getElementById('giziModal');
        const giziContent = document.getElementById('giziContent');

        function openModal(data) {
            if (data) {
                modalTitle.innerText = 'Edit Menu';
                menuId.value = data.id;
                namamenu.value = data.namamenu;
                tanggal.value = data.tanggal;
                menu_utama.value = data.menu_utama;
                lauk.value = data.lauk;
                saus.value = data.saus;
                dessert.value = data.dessert;
                energi_besar.value = data.energi_besar;
                protein_besar.value = data.protein_besar;
                lemak_besar.value = data.lemak_besar;
                karbo_besar.value = data.karbo_besar;
                energi_kecil.value = data.energi_kecil;
                protein_kecil.value = data.protein_kecil;
                lemak_kecil.value = data.lemak_kecil;
                karbo_kecil.value = data.karbo_kecil;
            } else {
                modalTitle.innerText = 'Tambah Menu';
                menuId.value = '';
                document.getElementById('menuModal').querySelector('form').reset();
            }
            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function openGiziModal(data) {
            giziContent.innerHTML = '';
            giziContent.innerHTML += `<p><strong>Energi (Besar):</strong> ${data.energi_besar}</p>`;
            giziContent.innerHTML += `<p><strong>Protein (Besar):</strong> ${data.protein_besar}</p>`;
            giziContent.innerHTML += `<p><strong>Lemak (Besar):</strong> ${data.lemak_besar}</p>`;
            giziContent.innerHTML += `<p><strong>Karbohidrat (Besar):</strong> ${data.karbo_besar}</p>`;
            giziContent.innerHTML += `<p><strong>Energi (Kecil):</strong> ${data.energi_kecil}</p>`;
            giziContent.innerHTML += `<p><strong>Protein (Kecil):</strong> ${data.protein_kecil}</p>`;
            giziContent.innerHTML += `<p><strong>Lemak (Kecil):</strong> ${data.lemak_kecil}</p>`;
            giziContent.innerHTML += `<p><strong>Karbohidrat (Kecil):</strong> ${data.karbo_kecil}</p>`;
            giziModal.style.display = 'block';
        }

        function closeGiziModal() {
            giziModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
            if (event.target == giziModal) {
                closeGiziModal();
            }
        }
    </script>

</body>
</html>
