<?php
include '../config/database.php';

$judul   = $_POST['judul'];
$penulis = $_POST['penulis'];
$stok    = $_POST['stok'];

mysqli_query($conn, "
    INSERT INTO buku (judul, penulis, stok)
    VALUES ('$judul', '$penulis', '$stok')
");

header("Location: buku.php");