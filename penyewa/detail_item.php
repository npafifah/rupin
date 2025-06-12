<?php
include('../session.php');
include('../config.php');

// Ambil detail item
$item_id = $_GET['id'];
$sql = "SELECT * FROM items WHERE item_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Item | Rupin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f6fa;
            margin: 0;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .item-image {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .item-image img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 10px;
        }

        .info p {
            font-size: 1rem;
            margin: 0.5rem 0;
        }

        .info strong {
            color: #555;
        }

        .btn-group {
            margin-top: 2rem;
        }

        .btn-group button,
        .btn-group a {
            padding: 0.75rem 1.5rem;
            margin-right: 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #26a69a;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1e8e7e;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Ruang / Alat</h2>

        <div class="item-image">
            <?php if (!empty($item['gambar'])): ?>
                <img src="../uploads/<?= htmlspecialchars($item['gambar']) ?>" alt="Gambar <?= htmlspecialchars($item['nama']) ?>">
            <?php else: ?>
                <p><em>Gambar tidak tersedia</em></p>
            <?php endif; ?>
        </div>

        <div class="info">
            <p><strong>Nama:</strong> <?= htmlspecialchars($item['nama']) ?></p>
            <p><strong>Tipe:</strong> <?= htmlspecialchars($item['tipe']) ?></p>
            <p><strong>Lokasi:</strong> <?= htmlspecialchars($item['lokasi']) ?></p>
            <p><strong>Harga Sewa:</strong> Rp <?= number_format($item['harga_sewa'], 0, ',', '.') ?> / hari</p>
            <p><strong>Status:</strong> <?= htmlspecialchars($item['status']) ?></p>
        </div>

        <div class="btn-group">
            <form method="POST" action="pesan_item.php" style="display:inline;">
                <input type="hidden" name="item_id" value="<?= $item_id ?>">
                <button type="submit" class="btn-primary">Pesan Sekarang</button>
            </form>
            <a href="cari_item.php" class="btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>
