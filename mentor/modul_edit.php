<?php
include '../db.php';

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}
$id = intval($_GET['id']);
$q = $conn->query("SELECT * FROM Modul WHERE Modul_ID=$id");
$row = $q->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $nama = $conn->real_escape_string($_POST['nama']);
    $desk = $conn->real_escape_string($_POST['deskripsi']);
    $kelas = intval($_POST['kelas_id']);
    $sql = "UPDATE Modul SET Nama_Modul='$nama', Deskripsi_Modul='$desk', Kelas_ID=$kelas WHERE Modul_ID=$id";
    if($conn->query($sql)){
        header("Location: modul_list.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<h2>Edit Modul</h2>
<form method="post">
  Nama Modul: <input name="nama" value="<?= $row['Nama_Modul']?>"><br>
  Deskripsi: <textarea name="deskripsi"><?= $row['Deskripsi_Modul']?></textarea><br>
  Kelas ID: <input type="number" name="kelas_id" value="<?= $row['Kelas_ID']?>"><br>
  <button type="submit">Simpan</button>
</form>
<a href="modul_list.php">Kembali</a>
