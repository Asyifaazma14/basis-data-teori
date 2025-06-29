<?php
include '../db.php';

if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

// contoh: ambil kelas_id = hardcode 1 (silakan dinamis kalau mau)
$kelas_id = 1;

$result = $conn->query("SELECT * FROM Modul WHERE Kelas_ID=$kelas_id");

echo "<h2>Modul</h2>";
echo "<ul>";
while($row = $result->fetch_assoc()){
    echo "<li>
        {$row['Nama_Modul']} -
        <a href='modul_detail.php?id={$row['Modul_ID']}'>Lihat Detail</a>
    </li>";
}
echo "</ul>";
echo "<a href='dashboard.php'>Kembali</a>";
