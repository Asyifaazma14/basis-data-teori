<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $tanggal = date('Y-m-d');

    // cek kalau email sudah terdaftar
    $cek = $conn->query("SELECT * FROM User WHERE Email='$email'");
    if($cek->num_rows > 0){
        $error = "Email sudah terdaftar";
    } else {
        $sql = "INSERT INTO User (Nama_User, Email, Password, Role, Tanggal_Daftar)
                VALUES ('$nama', '$email', '$password', 'peserta', '$tanggal')";
        if ($conn->query($sql)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal daftar: " . $conn->error;
        }
    }
}
?>
<h2>Register</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
  Nama: <input name="nama" required><br>
  Email: <input name="email" type="email" required><br>
  Password: <input name="password" type="password" required><br>
  <button type="submit">Daftar</button>
</form>
<a href="login.php">Sudah punya akun? Login di sini</a>
