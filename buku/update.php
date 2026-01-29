<?php
include '../config/database.php';

$id      = $_POST['id'];
$judul   = $_POST['judul'];
$penulis = $_POST['penulis'];
$stok    = $_POST['stok'];

mysqli_query($conn, "
    UPDATE buku SET
    judul='$judul',
    penulis='$penulis',
    stok='$stok'
    WHERE id=$id
");

header("Location: buku.php");