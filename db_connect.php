<?php
$host = "localhost";
$user = "user20232014";     // default user XAMPP
$pass = "ShEq8o";         // default tanpa password
$db   = "user20232014";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>
