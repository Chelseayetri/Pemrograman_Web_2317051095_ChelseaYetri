<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email    = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $uploadDir = "uploads/";
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxSize = 2 * 1024 * 1024; 

    if (!empty($_FILES["profile_pic"]["name"])) {
        if ($_FILES['profile_pic']['size'] > $maxSize) {
            $message = "Ukuran gambar terlalu besar. Maksimal 2MB.";
        } elseif (!in_array($_FILES['profile_pic']['type'], $allowedTypes)) {
            $message = "Format gambar tidak didukung. Gunakan JPG atau PNG.";
        } else {
            $ext = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
            $uniqueName = time() . '_' . uniqid() . '.' . $ext;
            $uploadFile = $uploadDir . $uniqueName;

            if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $uploadFile)) {
                $message = "Gagal mengupload foto profil.";
            }
        }
    } else {
        $uploadFile = "uploads/default.jpg";
    }

    if (empty($message)) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, profile_pic) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $uploadFile);

        if ($stmt->execute()) {
            $message = "Registrasi berhasil!";
        } else {
            $message = "Gagal registrasi: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Registrasi</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="profile_pic" class="form-label">Foto Profil (opsional)</label>
            <input type="file" name="profile_pic" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>

    <div class="text-center mt-3">
        <a href="login.php">Sudah punya akun? Login di sini</a>
    </div>
</div>
</body>
</html>
