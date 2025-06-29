<?php
include '../db.php';

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}
$id = intval($_GET['id']);
$q = $conn->query("SELECT * FROM Tugas WHERE Tugas_ID=$id");
$row = $q->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $judul = $conn->real_escape_string($_POST['judul']);
    $desk = $conn->real_escape_string($_POST['deskripsi']);
    $batas = $_POST['batas'];
    $sql = "UPDATE Tugas SET Judul_Tugas='$judul', Deskripsi_Tugas='$desk', Batas_Kumpul='$batas' WHERE Tugas_ID=$id";
    if($conn->query($sql)){
        header("Location: tugas_list.php");
        exit;
    }else{
        echo "Error: ".$conn->error;
    }
}
?>
<h2>Edit Tugas</h2>
<form method="post">
  Judul: <input name="judul" value="<?= $row['Judul_Tugas']?>"><br>
  Deskripsi: <textarea name="deskripsi"><?= $row['Deskripsi_Tugas']?></textarea><br>
  Batas Kumpul: <input type="date" name="batas" value="<?= $row['Batas_Kumpul']?>"><br>
  <button type="submit">Simpan</button>
</form>
<a href="tugas_list.php">Kembali</a>
