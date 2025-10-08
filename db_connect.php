<?php
$host = "localhost";
$user = "root";     // default user XAMPP
$pass = "";         // default tanpa password
$db   = "money_heist_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>
