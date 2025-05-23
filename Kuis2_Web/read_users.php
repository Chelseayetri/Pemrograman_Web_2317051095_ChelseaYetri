<?php include 'db.php'; $result = $conn->query("SELECT * FROM users"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
<h2>Data User</h2>
<table class="table table-bordered">
  <thead>
    <tr><th>ID</th><th>Username</th><th>Email</th><th>Foto</th><th>Aksi</th></tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['username'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?php if ($row['profile_pic']) echo '<img src="uploads/' . $row['profile_pic'] . '" width="50">'; ?></td>
      <td>
        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
</body>
</html>

