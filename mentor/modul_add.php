<?php
include '../db.php';
session_start();

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $nama = $conn->real_escape_string($_POST['nama']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $kelas_id = intval($_POST['kelas_id']); // pakai dropdown
    $tgl = date('Y-m-d');
    $target = "../uploads/".basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target)){
        $sql = "INSERT INTO modul (Kelas_ID, Nama_Modul, Deskripsi_Modul, Tgl_Dikirim, Url_Modul)
                VALUES ($kelas_id, '$nama', '$deskripsi', '$tgl', '".basename($_FILES["file"]["name"])."')";
        if($conn->query($sql)){
            header("Location: modul_list.php");
            exit;
        }else{
            echo "Error: ".$conn->error;
        }
    } else {
        echo "Upload gagal";
    }
}
?>

<h2>Tambah Modul</h2>
<form method="post" enctype="multipart/form-data">
  Nama Modul: <input name="nama"><br>
  Deskripsi: <textarea name="deskripsi"></textarea><br>
  Lampiran File: <input type="file" name="file"><br>
  Kelas:
  <select name="kelas_id" required>
    <option value="">-- Pilih Kelas --</option>
    <?php
    $q = $conn->query("SELECT Kelas_ID, Nama_Kelas FROM kelas");
    while($row = $q->fetch_assoc()){
        echo "<option value='{$row['Kelas_ID']}'>{$row['Nama_Kelas']}</option>";
    }
    ?>
  </select>
  <br>
  <button type="submit">Simpan</button>
</form>
<a href="modul_list.php">Kembali</a>
