<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    $id = $user['id'];
    $foto = $_FILES['profile_pic']['name'];
    $tmp = $_FILES['profile_pic']['tmp_name'];
    $target = 'uploads/' . basename($foto);

    move_uploaded_file($tmp, $target);

    $stmt = $conn->prepare("UPDATE users SET profile_pic=? WHERE id=?");
    $stmt->bind_param("si", $foto, $id);
    $stmt->execute();

    $_SESSION['user']['profile_pic'] = $foto;
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Foto Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
<h2>Edit Foto Profil</h2>
<form method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Pilih Foto Baru</label>
    <input type="file" name="profile_pic" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<a href="dashboard.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</body>
</html>
