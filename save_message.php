<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);

  if ($stmt->execute()) {
    echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='index.php#contact';</script>";
  } else {
    echo "<script>alert('Terjadi kesalahan, coba lagi.'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
