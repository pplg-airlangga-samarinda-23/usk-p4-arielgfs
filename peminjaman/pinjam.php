<?php
include '../config/database.php';

$buku = mysqli_query($conn,"SELECT * FROM buku WHERE stok > 0");
?>

<h2>Pinjam Buku</h2>

<form action="proses_pinjam.php" method="post">
<select name="buku_id">
<?php while($b = mysqli_fetch_assoc($buku)): ?>
  <option value="<?= $b['id'] ?>">
    <?= $b['judul'] ?> (<?= $b['stok'] ?>)
  </option>
<?php endwhile; ?>
</select>
<button>Pinjam</button>
</form>