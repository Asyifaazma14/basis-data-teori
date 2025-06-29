<?php
include '../db.php';
if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$q = $conn->query("SELECT * FROM Sertifikat WHERE User_ID=$user_id");
?>
<h2>Sertifikat</h2>
<?php
if($q->num_rows > 0){
    while($s = $q->fetch_assoc()){
        echo "<p>Kelas ID: {$s['Kelas_ID']}, Nilai Akhir: {$s['Nilai_Akhir']}, 
        Terbit: {$s['Tgl_Daftar_Sertifikat']}</p>";
    }
} else {
    echo "Belum ada sertifikat.";
}
?>
<a href="dashboard.php">Kembali</a>
