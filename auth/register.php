<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO users (nama, email, password, role, status, alamat) 
            VALUES (?, ?, ?, 'penyewa', 'aktif', ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $nama, $email, $password, $alamat);

    if ($stmt->execute()) {
        header("Location: login.php?msg=daftar_berhasil");
        exit;
    } else {
        $error = "Pendaftaran gagal! Coba lagi nanti.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | Rupin</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="card">
        <h2>Registrasi Rupin</h2>
        <p>Silakan lengkapi data diri Anda</p>
        <?php if (isset($error)) echo "<div class='error-message'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email Aktif" required>
            <input type="text" name="alamat" placeholder="Alamat Domisili" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
        </form>
        <a href="login.php">Sudah punya akun? Login di sini</a>
    </div>
</body>
</html>
