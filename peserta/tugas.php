<?php
include '../db.php';

// cek login
if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

echo "<h2>Daftar Tugas</h2>";

// kalau modul_id kosong, kasih pilihan list modul
if (!isset($_GET['modul_id'])) {
    echo "<p>Silakan pilih modul untuk melihat tugas:</p>";
    $q = $conn->query("SELECT * FROM modul");
    if ($q->num_rows > 0) {
        echo "<ul>";
        while ($row = $q->fetch_assoc()) {
            echo "<li><a href='tugas.php?modul_id=" . $row['Modul_ID'] . "'>" . htmlspecialchars($row['Nama_Modul']) . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Tidak ada modul tersedia.</p>";
    }
    echo "<br><a href='dashboard.php'>Kembali</a>";
    exit;
}

// jika modul_id dikirim
$modul_id = intval($_GET['modul_id']);

// ambil data tugas
$q = $conn->query("SELECT * FROM tugas WHERE Modul_ID = $modul_id");

if ($q->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Deadline</th>
            <th>Lampiran</th>
        </tr>";
    while ($row = $q->fetch_assoc()) {
        echo "<tr>
            <td>".htmlspecialchars($row['Judul_Tugas'])."</td>
            <td>".nl2br(htmlspecialchars($row['Deskripsi_Tugas']))."</td>
            <td>".htmlspecialchars($row['Batas_Kumpul'])."</td>
            <td><a href='../uploads/".rawurlencode($row['File_Lampiran'])."' target='_blank'>Download</a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<p>Belum ada tugas yang tersedia.</p>";
}
?>
<br>
<a href="dashboard.php">Kembali</a>
