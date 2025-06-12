<?php
include('../session.php');
include('../config.php');

// Ambil semua item yang tersedia
$query = "SELECT * FROM items WHERE status = 'tersedia'";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Item | Rupin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 2rem;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
        }

        th {
            background-color: #00796b;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            border-radius: 6px;
        }

        .btn-detail {
            background-color: #26a69a;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .btn-detail:hover {
            background-color: #1e8e7e;
        }

        .centered {
            max-width: 1080px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="centered">
        <h2>Daftar Ruang/Alat yang Tersedia</h2>

        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Harga Sewa</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
            <?php while ($item = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <?php if (!empty($item['gambar'])) { ?>
                        <img src="../uploads/<?= htmlspecialchars($item['gambar']) ?>" alt="Gambar <?= htmlspecialchars($item['nama']) ?>">
                    <?php } else { ?>
                        <em>Tidak ada gambar</em>
                    <?php } ?>
                </td>
                <td><?= htmlspecialchars($item['nama']) ?></td>
                <td><?= htmlspecialchars($item['tipe']) ?></td>
                <td>Rp<?= number_format($item['harga_sewa'], 0, ',', '.') ?>/hari</td>
                <td><?= htmlspecialchars($item['lokasi']) ?></td>
                <td><a class="btn-detail" href="detail_item.php?id=<?= $item['item_id'] ?>">Detail</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
