<?php
include '../config/database.php';
$id = $_GET['id'];

$a = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT * FROM anggota WHERE id=$id")
);
?>

<h2>Edit Anggota</h2>

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $a['id'] ?>">
    <input type="text" name="nama" value="<?= $a['nama'] ?>"><br>
    <input type="text" name="kelas" value="<?= $a['kelas'] ?>"><br>
    <button>Update</button>
</form>