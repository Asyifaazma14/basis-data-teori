<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $pass  = $conn->real_escape_string($_POST['password']);

    $query = "SELECT * FROM User WHERE Email='$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // kalau password ga di hash
        if ($row['Password'] === $pass) {
            $_SESSION['user_id'] = $row['User_ID'];
            $_SESSION['role'] = $row['Role'];

            if ($row['Role'] == 'peserta') {
                header("Location: peserta/dashboard.php");
                exit;
            } elseif ($row['Role'] == 'mentor') {
                header("Location: mentor/dashboard.php");
                exit;
            } else {
                $error = "Role tidak dikenali";
            }
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Email tidak ditemukan";
    }
}
?>
<h2>Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
  Email: <input name="email" type="email" required><br>
  Password: <input name="password" type="password" required><br>
  <button type="submit">Login</button>
</form>
<a href="register.php">Belum punya akun? Daftar di sini</a>
