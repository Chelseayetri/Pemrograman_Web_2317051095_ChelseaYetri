<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

  <h2>Edit Data Mahasiswa</h2>

  <?php
  if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID tidak ditemukan!</div>";
    exit;
  }

  $id = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id");
  $data = mysqli_fetch_assoc($result);

  if (!$data) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan!</div>";
    exit;
  }
  ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">NIM</label>
      <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" required>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>

  <?php
  if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim  = $_POST['nim'];

    $update = mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama', nim='$nim' WHERE id=$id");

    if ($update) {
      echo "<script>alert('Data berhasil diupdate!'); window.location.href='index.php';</script>";
    } else {
      echo "<div class='alert alert-danger mt-3'>Gagal update data: " . mysqli_error($conn) . "</div>";
    }
  }
  ?>

</body>
</html>
