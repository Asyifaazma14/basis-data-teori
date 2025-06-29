<?php
include '../db.php';

$id = $_SESSION['user_id'] ?? null;

if (!$id) {
    echo "Unauthorized";
    exit;
}

$q = $conn->query("SELECT * FROM peserta WHERE User_ID = $id");
$data = $q->fetch_assoc();

// safe
$alamat = $data['Alamat'] ?? '-';
$no_hp = $data['No_Hp'] ?? '-';
$asal_sekolah = $data['Asal_Sekolah'] ?? '-';
$status_lulus = $data['Status_Lulus'] ?? '-';

?>
<h2>Profil Peserta</h2>
<table border="1">
    <tr>
        <td>Alamat</td>
        <td><?= htmlspecialchars($alamat) ?></td>
    </tr>
    <tr>
        <td>No HP</td>
        <td><?= htmlspecialchars($no_hp) ?></td>
    </tr>
    <tr>
        <td>Asal Sekolah</td>
        <td><?= htmlspecialchars($asal_sekolah) ?></td>
    </tr>
    <tr>
        <td>Status Lulus</td>
        <td><?= htmlspecialchars($status_lulus) ?></td>
    </tr>
</table>
<br>
<a href="profil_edit.php">Edit Profil</a> |
<a href="dashboard.php">Kembali</a>
