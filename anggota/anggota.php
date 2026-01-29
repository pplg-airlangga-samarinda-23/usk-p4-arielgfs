<?php
include '../config/database.php';

$data = mysqli_query($conn,"
    SELECT anggota.*, users.username
    FROM anggota
    JOIN users ON anggota.user_id = users.id
");
?>

<h2>Data Anggota (Siswa)</h2>
<a href="tambah.php">+ Tambah Anggota</a>
<table border="1">
<tr>
  <th>Nama</th>
  <th>Kelas</th>
  <th>Username</th>
  <th>Aksi</th>
</tr>

<?php while($a = mysqli_fetch_assoc($data)): ?>
<tr>
  <td><?= $a['nama'] ?></td>
  <td><?= $a['kelas'] ?></td>
  <td><?= $a['username'] ?></td>
  <td>
    <a href="edit.php?id=<?= $a['id'] ?>">Edit</a> |
    <a href="hapus.php?id=<?= $a['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
  </td>
  
</tr>
<?php endwhile; ?>
</table>