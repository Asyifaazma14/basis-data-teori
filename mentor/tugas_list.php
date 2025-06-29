<?php
include '../db.php';

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}
$res = $conn->query("SELECT * FROM Tugas");
echo "<h2>Daftar Tugas</h2>";
echo "<a href='tugas_add.php'>Tambah Tugas</a><br><br>";
echo "<table border=1>
<tr><th>Judul</th><th>Modul</th><th>Deskripsi</th><th>Deadline</th><th>File</th><th>Aksi</th></tr>";
while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>{$row['Judul_Tugas']}</td>
      <td>{$row['Modul_ID']}</td>
      <td>{$row['Deskripsi_Tugas']}</td>
      <td>{$row['Batas_Kumpul']}</td>
      <td><a href='../uploads/{$row['File_Lampiran']}'>Lampiran</a></td>
      <td>
        <a href='tugas_edit.php?id={$row['Tugas_ID']}'>Edit</a>
      </td>
    </tr>";
}
echo "</table>";
echo "<a href='dashboard.php'>Kembali</a>";
