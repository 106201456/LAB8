<?php
// profile.php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}
require 'db.php';

$username = $_SESSION['username'];

// fetch current details
$sql = "SELECT username, email FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$updated = isset($_GET['updated']);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Profile</title>
  <style>
    body{font-family:sans-serif;max-width:720px;margin:40px auto}
    table{width:100%;border-collapse:collapse;margin:16px 0}
    th,td{border:1px solid #ddd;padding:10px;text-align:left}
    th{background:#eef5ff}
    .ok{background:#eaffea;border:1px solid #b9e3b9;padding:10px}
  </style>
</head>
<body>
  <h2>My Profile</h2>

  <?php if ($updated): ?>
    <p class="ok">Email updated successfully.</p>
  <?php endif; ?>

  <table>
    <tr><th>Username</th><td><?=htmlspecialchars($user['username'])?></td></tr>
    <tr><th>Email</th><td><?=htmlspecialchars($user['email'])?></td></tr>
  </table>

  <h3>Edit Profile</h3>
  <form method="post" action="update_profile.php">
    <label>New Email<br>
      <input type="email" name="email" value="<?=htmlspecialchars($user['email'])?>" required style="width:100%">
    </label>
    <br><br>
    <button type="submit">Save Changes</button>
  </form>

  <p><a href="logout.php">Log out</a></p>
</body>
</html>
