<?php
include '../db.php';

if ($_SESSION['role'] != 'mentor') {
    header("Location: ../login.php");
    exit;
}
?>
<h2>Dashboard Mentor</h2>
<p>Halo, <?= $_SESSION['user_id'] ?>! Kamu login sebagai Mentor.</p>
<ul>
    <li><a href="modul_list.php">Kelola Modul</a></li>
    <li><a href="tugas_list.php">Kelola Tugas</a></li>
    <li><a href="pengumpulan_list.php">Lihat Pengumpulan Tugas</a></li>
    <li><a href="../logout.php">Logout</a></li>
</ul>
