<?php
// db.php
$host = 'localhost';
$user = 'root';
$pass = '';        // XAMPP default: empty; MAMP default: 'root'
$db   = 'web_lab';

// For MAMP on macOS, if using default port 8889:
// $conn = new mysqli('localhost:8889', 'root', 'root', $db);

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die('Database connection failed: ' . $conn->connect_error);
}
?>
