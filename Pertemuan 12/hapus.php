<?php
include "db.php";

if (!isset($_GET['id'])) {
  echo "<script>alert('ID tidak ditemukan!'); window.location.href='index.php';</script>";
  exit;
}

$id = $_GET['id'];
$delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

if ($delete) {
  echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus data!'); window.location.href='index.php';</script>";
}
?>
