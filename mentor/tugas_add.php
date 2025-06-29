<?php
include '../db.php';

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $judul = $conn->real_escape_string($_POST['judul']);
    $desk = $conn->real_escape_string($_POST['deskripsi']);
    $modul_id = intval($_POST['modul_id']);
    $deadline = $_POST['batas'];
    $target = "../uploads/".basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target)){
        $sql = "INSERT INTO Tugas(Judul_Tugas, Deskripsi_Tugas, File_Lampiran, Modul_ID, Batas_Kumpul)
                VALUES ('$judul', '$desk', '".basename($_FILES["file"]["name"])."', $modul_id, '$deadline')";
        if($conn->query($sql)){
            header("Location: tugas_list.php");
            exit;
        } else {
            echo "Error: ".$conn->error;
        }
    } else {
        echo "Upload gagal";
    }
}
?>

<h2>Tambah Tugas</h2>
<form method="post" enctype="multipart/form-data">
  Judul: <input name="judul"><br>
  Deskripsi: <textarea name="deskripsi"></textarea><br>
  Lampiran File: <input type="file" name="file"><br>
  Modul:
  <select name="modul_id">
    <option value="">--Pilih Modul--</option>
    <?php
    $moduls = $conn->query("SELECT Modul_ID, Nama_Modul FROM modul");
    while($m = $moduls->fetch_assoc()){
        echo "<option value='{$m['Modul_ID']}'>{$m['Nama_Modul']}</option>";
    }
    ?>
  </select><br>
  Batas Kumpul: <input type="date" name="batas"><br>
  <button type="submit">Simpan</button>
</form>
<a href="tugas_list.php">Kembali</a>
