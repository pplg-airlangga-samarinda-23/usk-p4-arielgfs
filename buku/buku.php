<?php
include '../config/database.php';
include '../includes/header.php';

$data = mysqli_query($conn, "SELECT * FROM buku");
?>

<h2>Data Buku</h2>
<a href="tambah.php">+ Tambah Buku</a>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php $no=1; while($b = mysqli_fetch_assoc($data)) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $b['judul'] ?></td>
        <td><?= $b['penulis'] ?></td>
        <td><?= $b['stok'] ?></td>
        <td>
            <a href="edit.php?id=<?= $b['id'] ?>">Edit</a> |
            <a href="hapus.php?id=<?= $b['id'] ?>" onclick="return confirm('Hapus buku?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>