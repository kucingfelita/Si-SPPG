<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

$koneksi = check_and_reconnect($koneksi);

$where = '';
$params = [];

if (isset($_GET['all'])) {
    // print everything
} elseif (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    // sanitize: keep only integers
    $ids = array_filter($ids, 'ctype_digit');
    if (count($ids) === 0) {
        echo "Tidak ada data untuk dicetak.";
        exit;
    }
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $where = "WHERE id IN ($placeholders)";
    $params = $ids;
} elseif (isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%";
    $where = "WHERE namamenu LIKE ?";
    $params = [$search];
} else {
    echo "Tidak ada data untuk dicetak.";
    exit;
}

$sql = "SELECT * FROM menu $where ORDER BY tanggal DESC";
$stmt = mysqli_prepare($koneksi, $sql);
if ($params) {
    // determine types dynamically (i for integer, s for string)
    $types = '';
    foreach ($params as $p) {
        $types .= ctype_digit($p) ? 'i' : 's';
    }
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cetak Menu</title>
<style>
body { font-family: Arial, sans-serif; padding: 20px; }
table { width:100%; border-collapse: collapse; margin-bottom:20px; }
th, td { border:1px solid #000; padding:8px; }
th { background:#eee; }
img { max-width:100px; max-height:100px; }
@media print {
    .no-print { display:none; }
}
</style>
</head>
<body onload="window.print()">
<h2>Data Menu</h2>
<table>
<thead>
<tr>
<th>Nama Menu</th>
<th>Tanggal</th>
<th>Menu Utama</th>
<th>Lauk</th>
<th>Saus</th>
<th>Dessert</th>
<th>Energi Besar</th>
<th>Protein Besar</th>
<th>Lemak Besar</th>
<th>Karbo Besar</th>
<th>Energi Kecil</th>
<th>Protein Kecil</th>
<th>Lemak Kecil</th>
<th>Karbo Kecil</th>
<th>Foto</th>
</tr>
</thead>
<tbody>
<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
<td><?php echo htmlspecialchars($row['namamenu']); ?></td>
<td><?php echo htmlspecialchars($row['tanggal']); ?></td>
<td><?php echo htmlspecialchars($row['menu_utama']); ?></td>
<td><?php echo htmlspecialchars($row['lauk']); ?></td>
<td><?php echo htmlspecialchars($row['saus']); ?></td>
<td><?php echo htmlspecialchars($row['dessert']); ?></td>
<td><?php echo htmlspecialchars($row['energi_besar']); ?></td>
<td><?php echo htmlspecialchars($row['protein_besar']); ?></td>
<td><?php echo htmlspecialchars($row['lemak_besar']); ?></td>
<td><?php echo htmlspecialchars($row['karbo_besar']); ?></td>
<td><?php echo htmlspecialchars($row['energi_kecil']); ?></td>
<td><?php echo htmlspecialchars($row['protein_kecil']); ?></td>
<td><?php echo htmlspecialchars($row['lemak_kecil']); ?></td>
<td><?php echo htmlspecialchars($row['karbo_kecil']); ?></td>
<td>
<?php if ($row['foto'] && file_exists('../assets/uploads/'.$row['foto'])): ?>
<img src="../assets/uploads/<?php echo $row['foto']; ?>">
<?php endif; ?>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<button class="no-print" onclick="window.print()">Cetak</button>
</body>
</html>