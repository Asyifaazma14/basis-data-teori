<?php
include '../db.php';

if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ambil daftar tugas
$tugas_q = $conn->query("SELECT t.*, m.Nama_Modul 
    FROM tugas t 
    JOIN modul m ON t.Modul_ID = m.Modul_ID");

?>
<h2>Upload Tugas</h2>
<table border="1">
    <tr>
        <th>Judul</th>
        <th>Modul</th>
        <th>Deadline</th>
        <th>Aksi</th>
    </tr>
    <?php
    while ($row = $tugas_q->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['Judul_Tugas'])."</td>";
        echo "<td>".htmlspecialchars($row['Nama_Modul'])."</td>";
        echo "<td>".htmlspecialchars($row['Batas_Kumpul'])."</td>";
        echo "<td><a href='tugas_upload.php?tugas_id=".$row['Tugas_ID']."'>Kumpulkan</a></td>";
        echo "</tr>";
    }
    ?>
</table>
<a href="dashboard.php">Kembali</a>
