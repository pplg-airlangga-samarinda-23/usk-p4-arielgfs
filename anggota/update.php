<?php
include '../config/database.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

mysqli_query($conn,"
 UPDATE anggota SET
 nama='$nama',
 kelas='$kelas'
 WHERE id=$id
");

header("Location: anggota.php");