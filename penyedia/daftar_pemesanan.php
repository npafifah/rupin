<?php
include '../session.php';
include '../config.php';

$uid = $_SESSION['user_id'];
$sql = "
SELECT p.booking_id, i.nama AS item, u.nama AS penyewa, p.status, p.tanggal 
FROM pemesanan p 
JOIN items i ON p.item_id=i.item_id 
JOIN users u ON p.user_id=u.user_id 
WHERE i.user_id=? ORDER BY p.tanggal DESC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$res = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan | Rupin</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Daftar Pemesanan Masuk</h2>
        <table>
            <tr>
                <th>Booking</th>
                <th>Item</th>
                <th>Penyewa</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($r = $res->fetch_assoc()) { ?>
            <tr>
                <td><?= $r['booking_id'] ?></td>
                <td><?= htmlspecialchars($r['item']) ?></td>
                <td><?= htmlspecialchars($r['penyewa']) ?></td>
                <td><?= $r['tanggal'] ?></td>
                <td><?= htmlspecialchars($r['status']) ?></td>
                <td>
                    <?php if ($r['status'] == 'menunggu') { ?>
                        <a href="verifikasi_pesanan.php?id=<?= $r['booking_id'] ?>&aksi=terima" class="btn btn-accept">Terima</a>
                        <a href="verifikasi_pesanan.php?id=<?= $r['booking_id'] ?>&aksi=tolak" class="btn btn-decline">Tolak</a>
                    <?php } else { echo '-'; } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
