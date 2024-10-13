<?php
// Veritabanı bağlantısı
$conn = new mysqli('DB_ENDPOINT', 'DB_USER', 'DB_PASSWORD', 'DB_NAME');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>" . $row['content'] . "</p>";
}

$conn->close();
?>
