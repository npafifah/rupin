<?php
session_start();
include('../config.php');

// Redirect jika belum login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'penyewa') {
    header("Location: ../login.php");
    exit;
}

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$stmt = $con->prepare("SELECT nama FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penyewa | Rupin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f6fa;
            margin: 0;
        }

        .header {
            background-color: #00796b;
            color: white;
            padding: 1rem 2rem;
            text-align: center;
        }

        .container {
            padding: 2rem;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .card {
            background: white;
            padding: 1.2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
        }

        .card a {
            text-decoration: none;
            color: #00796b;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Selamat Datang di Rupin</h1>
        <p>Halo, <?= htmlspecialchars($user['nama']) ?>!</p>
    </div>

    <div class="container">
        <h2>Menu Cepat</h2>
        <div class="menu">
            <div class="card"><a href="cari_item.php">Cari Item</a></div>
            <div class="card"><a href="pesan_item.php">Pesan Item</a></div>
            <div class="card"><a href="status_pemesanan.php">Status Pemesanan</a></div>
            <div class="card"><a href="konfirmasi_pembayaran.php">Konfirmasi Pembayaran</a></div>
            <div class="card"><a href="batal_pemesanan.php">Batalkan Pesanan</a></div>
        </div>
    </div>

</body>
</html>
