<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
<h2>Login</h2>
<form method="POST">
  <div class="mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
</form>
<p class="mt-3">
  Belum punya akun? <a href="register.php">Daftar di sini</a>
</p>
<?php
if (isset($_POST['login'])) {
  include 'db.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      header('Location: dashboard.php');
      exit;
    } else {
      echo "<div class='alert alert-danger mt-3'>Password salah.</div>";
    }
  } else {
    echo "<div class='alert alert-danger mt-3'>User tidak ditemukan.</div>";
  }
}
?>
</body>
</html>