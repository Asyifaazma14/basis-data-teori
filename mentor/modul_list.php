<?php
include '../db.php';

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}
$res = $conn->query("SELECT * FROM Modul");
echo "<h2>Daftar Modul</h2>";
echo "<a href='modul_add.php'>Tambah Modul</a><br><br>";
echo "<table border=1>
<tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>File</th><th>Kelas</th><th>Aksi</th></tr>";
while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>{$row['Modul_ID']}</td>
      <td>{$row['Nama_Modul']}</td>
      <td>{$row['Deskripsi_Modul']}</td>
      <td><a href='../uploads/{$row['Url_Modul']}'>File</a></td>
      <td>{$row['Kelas_ID']}</td>
      <td>
        <a href='modul_edit.php?id={$row['Modul_ID']}'>Edit</a>
      </td>
    </tr>";
}
echo "</table>";
echo "<a href='dashboard.php'>Kembali</a>";
