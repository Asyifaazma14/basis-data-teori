<?php
session_start();
$host = "localhost";
$user = "elearn_user";
$pass = "passwordku";
$db   = "elearningDB";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
