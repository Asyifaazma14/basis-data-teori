<?php
include '../db.php';
if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID tidak valid.");
}
$id = intval($_GET['id']);
$q = $conn->query("SELECT * FROM Pengumpulan_Tugas WHERE Pengumpulan_ID=$id");
$data = $q->fetch_assoc();
if (!$data) {
    die("Data tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nilai = intval($_POST['nilai']);
    $catatan = $conn->real_escape_string($_POST['catatan']);
    $conn->query("UPDATE Pengumpulan_Tugas
                  SET Nilai=$nilai, Catatan_Mentor='$catatan', Status_ID=2
                  WHERE Pengumpulan_ID=$id");
    header("Location: pengumpulan_list.php");
    exit;
}
?>
<h2>Penilaian Tugas</h2>
<p>File:
  <?= $data['File_Jawaban'] ? "<a href='../uploads/".urlencode($data['File_Jawaban'])."'>Download File</a>" : "-" ?>
</p>
<p>Link:
  <?= $data['Link_Jawaban'] ? "<a href='".htmlspecialchars($data['Link_Jawaban'])."' target='_blank'>Lihat</a>" : "-" ?>
</p>
<form method="post">
  Nilai: <input type="number" name="nilai"><br>
  Catatan:<br>
  <textarea name="catatan"></textarea><br>
  <button type="submit">Simpan</button>
</form>
<br>
<a href="pengumpulan_list.php">Kembali</a>
