<?php
include '../config/database.php';
include '../includes/header.php';

$data = mysqli_query($conn,"
 SELECT p.*, b.judul
 FROM peminjaman p
 JOIN buku b ON p.buku_id=b.id
 WHERE status='dipinjam'
");
?>

<h2>Pengembalian</h2>

<table border="1">
<?php while($p = mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $p['judul'] ?></td>
<td><?= $p['tanggal_jatuh_tempo'] ?></td>
<td>
<a href="proses_kembali.php?id=<?= $p['id'] ?>&buku=<?= $p['buku_id'] ?>">
Kembalikan
</a>
</td>
</tr>
<?php endwhile; ?>
</table>