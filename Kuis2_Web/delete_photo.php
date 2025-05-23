<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$id = $user['id'];

if (!empty($user['profile_pic']) && file_exists("uploads/" . $user['profile_pic'])) {
    unlink("uploads/" . $user['profile_pic']);
}

$stmt = $conn->prepare("UPDATE users SET profile_pic=NULL WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['user']['profile_pic'] = null;

header("Location: dashboard.php");
exit;
?>
