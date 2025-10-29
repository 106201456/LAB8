<?php
// login.php
session_start();
require 'db.php';

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  $sql = "SELECT username FROM user WHERE username = ? AND password = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $_SESSION['username'] = $username;
    header('Location: profile.php');
    exit;
  } else {
    $err = 'Invalid username or password';
  }
  $stmt->close();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <style>body{font-family:sans-serif;max-width:480px;margin:40px auto}</style>
</head>
<body>
  <h2>Login</h2>
  <?php if ($err): ?><p style="color:#c00"><?=htmlspecialchars($err)?></p><?php endif; ?>
  <form method="post" action="login.php">
    <label>Username<br><input name="username" required></label><br><br>
    <label>Password<br><input name="password" type="password" required></label><br><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
