<?php include "db.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Tambah Data Mahasiswa</h2>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">NIM</label>
      <input type="text" name="nim" class="form-control" required>
    </div>

    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];

    // Coba simpan ke database
    $query = "INSERT INTO mahasiswa (nama, nim) VALUES ('$nama', '$nim')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "<script>
              alert('Data Berhasil Ditambahkan!');
              window.location.href = 'index.php';
            </script>";
    } else {
      echo "<div class='alert alert-danger mt-3'>Gagal menyimpan data: " . mysqli_error($conn) . "</div>";
    }
  }
  ?>
</body>
</html>
