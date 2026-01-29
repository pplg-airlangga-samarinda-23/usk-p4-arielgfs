<?php
include '../config/database.php';
$id = $_GET['id'];

$buku = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM buku WHERE id=$id")
);
?>

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $buku['id'] ?>">
    <input type="text" name="judul" value="<?= $buku['judul'] ?>"><br>
    <input type="text" name="penulis" value="<?= $buku['penulis'] ?>"><br>
    <input type="number" name="stok" value="<?= $buku['stok'] ?>"><br>
    <button>Update</button>
</form>