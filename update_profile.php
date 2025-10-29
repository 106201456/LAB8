<?php
// update_profile.php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}
require 'db.php';

$username = $_SESSION['username'];
$newEmail = trim($_POST['email'] ?? '');

if ($newEmail === '') {
  header('Location: profile.php');
  exit;
}

// Update the email
$sql = "UPDATE user SET email = ? WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $newEmail, $username);
$stmt->execute();
$stmt->close();

// Redirect back to profile showing updated data
header('Location: profile.php?updated=1');
exit;
