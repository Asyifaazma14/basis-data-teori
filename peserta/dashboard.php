<?php
include '../db.php';

// cek login role
if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Peserta</title>
</head>
<body>
    <h2>Dashboard Peserta</h2>
    <p>Selamat datang, <?= htmlspecialchars($userId) ?></p>
    <ul>
        <li><a href="modul_list.php">Lihat Modul</a></li>
        <li><a href="sertifikat.php">Lihat Sertifikat</a></li>
        <li><a href="tugas.php">Tugas Saya</a></li>
        <li><a href="pengumpulan_list.php">Upload Tugas</a></li>
        <li><a href="profil.php">Profil Saya</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>
</body>
</html>
