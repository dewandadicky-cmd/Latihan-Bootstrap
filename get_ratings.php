<?php
// Set agar browser tahu ini JSON, bukan HTML
header('Content-Type: application/json');

// Hubungkan ke database
include 'db_connect.php';

// Ambil data rating
$query = "SELECT season, rating FROM season_ratings";
$result = $conn->query($query);

// Siapkan array hasil
$data = [];

while ($row = $result->fetch_assoc()) {
  $data[] = [
    'season' => $row['season'],
    'rating' => (float)$row['rating']
  ];
}

// Kirim dalam format JSON
echo json_encode($data);
?>
