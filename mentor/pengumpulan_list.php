<?php
include '../db.php';
if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}

$q = $conn->query("SELECT pt.*, u.Nama_User 
                   FROM Pengumpulan_Tugas pt
                   JOIN User u ON pt.User_ID = u.User_ID");

?>
<h2>Daftar Pengumpulan Tugas</h2>
<table border="1">
  <tr>
    <th>Peserta</th>
    <th>Link</th>
    <th>File</th>
    <th>Status</th>
    <th>Aksi</th>
  </tr>
  <?php while($row = $q->fetch_assoc()){ ?>
    <tr>
      <td><?= htmlspecialchars($row['Nama_User']) ?></td>
      <td>
        <?= $row['Link_Jawaban'] ? "<a href='".htmlspecialchars($row['Link_Jawaban'])."' target='_blank'>Lihat</a>" : "-" ?>
      </td>
      <td>
        <?= $row['File_Jawaban'] ? "<a href='../uploads/".urlencode($row['File_Jawaban'])."'>Download</a>" : "-" ?>
      </td>
      <td><?= $row['Status_ID']==2 ? "Sudah Dinilai" : "Belum Dinilai" ?></td>
      <td>
        <a href="pengumpulan_nilai.php?id=<?= $row['Pengumpulan_ID'] ?>">Nilai</a>
      </td>
    </tr>
  <?php } ?>
</table>
<br>
<a href="dashboard.php">Kembali</a>
