<?php
include '../db.php';
session_start();

$id = $_SESSION['user_id'] ?? null;

if (!$id) {
    echo "Unauthorized";
    exit;
}

// kalau tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alamat = $conn->real_escape_string($_POST['Alamat'] ?? '');
    $no_hp = $conn->real_escape_string($_POST['No_HP'] ?? '');
    $asal_sekolah = $conn->real_escape_string($_POST['Asal_Sekolah'] ?? '');
    $status_lulus = $conn->real_escape_string($_POST['Status_Lulus'] ?? 'Belum Lulus');

    $update = $conn->query("
        UPDATE peserta SET
            Alamat='$alamat',
            No_HP='$no_hp',
            Asal_Sekolah='$asal_sekolah',
            Status_Lulus='$status_lulus'
        WHERE User_ID = $id
    ");

    if ($update) {
        header("Location: profil.php");
        exit;
    } else {
        echo "Gagal update data.";
    }
}

// ambil data peserta untuk diisi di form
$q = $conn->query("SELECT * FROM peserta WHERE User_ID = $id");
$data = $q->fetch_assoc();
?>

<h2>Edit Profil</h2>
<form method="post">
    Alamat:<br>
    <input name="Alamat" value="<?= htmlspecialchars($data['Alamat'] ?? '') ?>"><br>
    No HP:<br>
    <input name="No_HP" value="<?= htmlspecialchars($data['No_HP'] ?? '') ?>"><br>
    Asal Sekolah:<br>
    <input name="Asal_Sekolah" value="<?= htmlspecialchars($data['Asal_Sekolah'] ?? '') ?>"><br>
    Status Lulus:<br>
    <select name="Status_Lulus">
        <option value="Lulus" <?= ($data['Status_Lulus'] ?? '') == 'Lulus' ? 'selected' : '' ?>>Lulus</option>
        <option value="Belum Lulus" <?= ($data['Status_Lulus'] ?? '') == 'Belum Lulus' ? 'selected' : '' ?>>Belum Lulus</option>
    </select><br><br>
    <button type="submit">Simpan Perubahan</button>
</form>
<a href="profil.php">Kembali</a>
