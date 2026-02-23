<?php
include 'koneksi.php';

$koneksi = check_and_reconnect($koneksi);

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
    <title>Menu Makanan - SI-SPPG Pucang 2</title>
    <style>
        html,
        body {
            overflow-y: scroll;
            /* Always show scrollbar to prevent layout shifts */
        }

        body {
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
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

        @media (max-width: 768px) {
            .main {
                max-width: 100%;
                padding: 15px;
            }
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

        .menu-card:hover {
            transform: translateY(-5px);
        }

        .menu-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-content {
            padding: 15px;
        }

        .menu-content h3 {
            margin-top: 0;
            color: #333;
        }

        .menu-content .date {
            font-size: 12px;
            color: #777;
            margin-bottom: 10px;
        }

        .menu-details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .menu-details strong {
            color: #002b6b;
        }

        .btn-gizi {
            background-color: #17a2b8;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .search-input {
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .search-button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #1d2975;
            color: white;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .search-input {
                width: 200px;
            }
        }

        @media (max-width: 480px) {
            .search-input {
                width: 100%;
                margin-bottom: 10px;
            }

            .search-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include 'template/navbar.php'; ?>

    <div class="main">
        <h2>Daftar Menu Makanan</h2>
        <form action="menu.php" method="GET" style="margin-bottom: 20px; text-align: center;">
            <input type="text" name="search" placeholder="Cari Nama Menu..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input">
            <button type="submit" class="search-button">Cari</button>
        </form>
        <div class="menu-container">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="menu-card">
                    <img src="assets/uploads/<?php echo $row['foto']; ?>" alt="<?php echo $row['namamenu']; ?>">
                    <div class="menu-content">
                        <h3><?php echo $row['namamenu']; ?></h3>
                        <p class="date">Tanggal: <?php echo date('d F Y', strtotime($row['tanggal'])); ?></p>
                        <div class="menu-details">
                            <p><strong>Menu Utama:</strong> <?php echo $row['menu_utama']; ?></p>
                            <p><strong>Lauk:</strong> <?php echo $row['lauk']; ?></p>
                            <p><strong>Saus:</strong> <?php echo $row['saus']; ?></p>
                            <p><strong>Dessert:</strong> <?php echo $row['dessert']; ?></p>
                            <button class="btn-gizi" onclick='openGiziModal(<?php echo json_encode($row); ?>, "besar")'>Lihat Gizi Besar</button>
                            <button class="btn-gizi" onclick='openGiziModal(<?php echo json_encode($row); ?>, "kecil")'>Lihat Gizi Kecil</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div id="giziModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeGiziModal()">&times;</span>
            <h3>Informasi Gizi</h3>
            <div id="giziContent"></div>
        </div>
    </div>

    <?php include 'template/footer.php'; ?>

    <script>
        const giziModal = document.getElementById('giziModal');
        const giziContent = document.getElementById('giziContent');

        function openGiziModal(data, ukuran) {
            giziContent.innerHTML = '';
            if (ukuran === 'besar') {
                giziContent.innerHTML += `<p><strong>Energi (Besar):</strong> ${data.energi_besar}</p>`;
                giziContent.innerHTML += `<p><strong>Protein (Besar):</strong> ${data.protein_besar}</p>`;
                giziContent.innerHTML += `<p><strong>Lemak (Besar):</strong> ${data.lemak_besar}</p>`;
                giziContent.innerHTML += `<p><strong>Karbohidrat (Besar):</strong> ${data.karbo_besar}</p>`;
            } else if (ukuran === 'kecil') {
                giziContent.innerHTML += `<p><strong>Energi (Kecil):</strong> ${data.energi_kecil}</p>`;
                giziContent.innerHTML += `<p><strong>Protein (Kecil):</strong> ${data.protein_kecil}</p>`;
                giziContent.innerHTML += `<p><strong>Lemak (Kecil):</strong> ${data.lemak_kecil}</p>`;
                giziContent.innerHTML += `<p><strong>Karbohidrat (Kecil):</strong> ${data.karbo_kecil}</p>`;
            }
            // update modal heading to indicate which size
            document.querySelector('#giziModal h3').textContent = `Informasi Gizi (${ukuran.charAt(0).toUpperCase() + ukuran.slice(1)})`;
            giziModal.style.display = 'block';
        }

        function closeGiziModal() {
            giziModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == giziModal) {
                closeGiziModal();
            }
        }
    </script>
</body>

</html>