<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    include 'db.php';

    $user_id = $_SESSION['user']['id'];

    $foto = $_FILES['profile_pic']['name'];
    $tmp = $_FILES['profile_pic']['tmp_name'];
    $target_dir = 'uploads/';
    $target_file = $target_dir . basename($foto);

    if (move_uploaded_file($tmp, $target_file)) {
        $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->bind_param("si", $foto, $user_id);
        if ($stmt->execute()) {
            $_SESSION['user']['profile_pic'] = $foto;

            header('Location: dashboard.php?upload=success');
            exit;
        } else {
            $error = "Gagal menyimpan path ke database.";
        }
    } else {
        $error = "Gagal mengupload file.";
    }
} else {
    $error = "Tidak ada file yang diupload.";
}
echo "<div class='alert alert-danger mt-3'>$error</div>";
echo "<a href='dashboard.php'>Kembali ke Dashboard</a>";
