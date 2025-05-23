<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Beranda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-4">
  <h1>Selamat datang di Aplikasi</h1>
  <a href="login.php" class="btn btn-primary">Login</a>
  <a href="register.php" class="btn btn-secondary">Register</a>
</body>
</html>
