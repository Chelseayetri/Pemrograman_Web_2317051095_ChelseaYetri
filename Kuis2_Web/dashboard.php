<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-4">
<h2>Dashboard</h2>
<p>Selamat datang, <strong><?= htmlspecialchars($user['username']) ?></strong>!</p>
<p>Email: <?= htmlspecialchars($user['email']) ?></p>
<?php if ($user['profile_pic']): ?>
  <img src="uploads/<?= htmlspecialchars($user['profile_pic']) ?>" width="120"><br>

  <a href="edit_photo.php" class="btn btn-warning btn-sm">Edit Foto</a>
  <a href="delete_photo.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus foto?')">Hapus Foto</a>
  <br><br>
<?php endif; ?>

<h4>Upload Foto Profil Baru</h4>
<form action="upload_photo.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <input type="file" name="profile_pic" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Upload</button>
</form>

<br>
<a href="read_users.php" class="btn btn-info">Kelola Data User</a>
<a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
