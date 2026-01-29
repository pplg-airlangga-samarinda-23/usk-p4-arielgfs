<?php
include '../config/database.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

mysqli_query($conn,"
 INSERT INTO users (username,password,role)
 VALUES ('$username','$password','siswa')
");

$user_id = mysqli_insert_id($conn);

mysqli_query($conn,"
 INSERT INTO anggota (user_id,nama,kelas)
 VALUES ($user_id,'$nama','$kelas')
");

header("Location: anggota.php");