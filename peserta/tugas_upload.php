<?php
include '../db.php';

if ($_SESSION['role'] != 'peserta') {
    header("Location: ../login.php");
    exit;
}

$tugas_id = intval($_GET['tugas_id']);
$user_id  = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $link = $conn->real_escape_string($_POST['link']);
    $waktu = date('Y-m-d H:i:s');

    // kalau file di-upload
    $filename = '';
    if (!empty($_FILES['file']['name'])) {
        $filename = basename($_FILES['file']['name']);
        $target = "../uploads/".$filename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            // ok
        } else {
            echo "Gagal upload file.<br>";
            $filename = '';
        }
    }

    $sql = "INSERT INTO Pengumpulan_Tugas 
        (Tugas_ID, User_ID, Link_Jawaban, File_Jawaban, Waktu_Kumpul, Status_ID)
        VALUES ($tugas_id, $user_id, '$link', '$filename', '$waktu', 1)";
    
    if($conn->query($sql)){
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal submit: " . $conn->error;
    }
}
?>

<h2>Upload Jawaban Tugas</h2>
<form method="post" enctype="multipart/form-data">
  Link jawaban (opsional): <input name="link"><br>
  Upload file (opsional): <input type="file" name="file"><br>
  <button type="submit">Kumpulkan</button>
</form>
<a href="dashboard.php">Kembali</a>
