<?php
include '../db.php';

if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM Modul WHERE Modul_ID=$id");
$row = $result->fetch_assoc();

echo "<h2>Detail Modul</h2>";
echo "<p>Nama: {$row['Nama_Modul']}</p>";
echo "<p>Deskripsi: {$row['Deskripsi_Modul']}</p>";
echo "<p>Tanggal: {$row['Tgl_Dikirim']}</p>";
echo "<p>File: <a href='../uploads/{$row['Url_Modul']}' target='_blank'>Download</a></p>";
echo "<a href='modul_list.php'>Kembali</a>";
?>
