<?php
include 'koneksi.php';
$koneksi = mysqli_connect($koneksi);

if (isset($_GET['id'])) {
    // Jika ada parameter id → tampilkan detail gizi
    $id = $_GET['id'];
    $sql = "SELECT * FROM menu WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
} else {
    // Kalau tidak ada id → tampilkan semua daftar menu
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT * FROM menu WHERE namamenu LIKE ? ORDER BY tanggal DESC";
    $stmt = mysqli_prepare($koneksi, $sql);
    $search_param = "%$search%";
    mysqli_stmt_bind_param($stmt, 's', $search_param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Makanan - SI-SPPG Pucang 2</title>
    <style>
        body {
            background-color: #f4f6f9;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            padding-top: 76px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main {
            flex-grow: 1;
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #002b6b;
            margin-bottom: 30px;
        }
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .menu-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .menu-card:hover { transform: translateY(-5px); }
        .menu-card img { width: 100%; height: 200px; object-fit: cover; }
        .menu-content { padding: 15px; }
        .menu-content h3 { margin-top: 0; color: #333; }
        .menu-content .date { font-size: 12px; color: #777; margin-bottom: 10px; }
        .btn-gizi {
            background-color: #17a2b8;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .detail-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        .detail-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail-header img {
            max-width: 250px;
            border-radius: 10px;
            margin-top: 10px;
        }
        .gizi-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .gizi-box {
            background: #f9fafc;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            flex: 1 1 300px;
        }
        .gizi-box h3 {
            color: #002b6b;
            text-align: center;
        }
        .gizi-box p {
            font-size: 15px;
            margin: 5px 0;
        }
        a.back-btn {
            display: block;
            text-align: center;
            margin-top: 30px;
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        a.back-btn:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
<?php include 'template/navbar.php'; ?>

<div class="main">
<?php if (!isset($_GET['id'])): ?>
    <!-- Halaman daftar menu -->
    <h2>Daftar Menu Makanan</h2>
    <form action="menu.php" method="GET" style="margin-bottom: 20px; text-align: center;">
        <input type="text" name="search" placeholder="Cari Nama Menu..." 
               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
               class="search-input" style="padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
        <button type="submit" style="padding: 10px 20px; border-radius: 5px; border: none; background-color: #1d2975; color: white; cursor: pointer;">Cari</button>
    </form>

    <div class="menu-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="menu-card">
                <img src="assets/uploads/<?php echo $row['foto']; ?>" alt="<?php echo $row['namamenu']; ?>">
                <div class="menu-content">
                    <h3><?php echo $row['namamenu']; ?></h3>
                    <p class="date">Tanggal: <?php echo date('d F Y', strtotime($row['tanggal'])); ?></p>
                    <a href="menu.php?id=<?php echo $row['id']; ?>" class="btn-gizi">Lihat Gizi</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php else: ?>
    <!-- Halaman detail gizi -->
    <div class="detail-card">
        <div class="detail-header">
            <h2><?php echo htmlspecialchars($row['namamenu']); ?></h2>
            <p><strong>Tanggal:</strong> <?php echo date('d F Y', strtotime($row['tanggal'])); ?></p>
            <img src="assets/uploads/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['namamenu']); ?>">
        </div>

        <div class="gizi-section">
            <div class="gizi-box">
                <h3>Gizi Porsi Besar</h3>
                <p><strong>Energi:</strong> <?php echo $row['energi_besar']; ?></p>
                <p><strong>Protein:</strong> <?php echo $row['protein_besar']; ?></p>
                <p><strong>Lemak:</strong> <?php echo $row['lemak_besar']; ?></p>
                <p><strong>Karbohidrat:</strong> <?php echo $row['karbo_besar']; ?></p>
            </div>

            <div class="gizi-box">
                <h3>Gizi Porsi Kecil</h3>
                <p><strong>Energi:</strong> <?php echo $row['energi_kecil']; ?></p>
                <p><strong>Protein:</strong> <?php echo $row['protein_kecil']; ?></p>
                <p><strong>Lemak:</strong> <?php echo $row['lemak_kecil']; ?></p>
                <p><strong>Karbohidrat:</strong> <?php echo $row['karbo_kecil']; ?></p>
            </div>
        </div>

        <a href="menu.php" class="back-btn">← Kembali ke Daftar Menu</a>
    </div>
<?php endif; ?>
</div>

<?php include 'template/footer.php'; ?>
</body>
</html>