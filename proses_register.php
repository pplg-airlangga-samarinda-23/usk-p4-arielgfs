<?php
include 'config/database.php';

$nama     = $_POST['nama'];
$kelas    = $_POST['kelas'];
$alamat   = $_POST['alamat'];
$no_hp    = $_POST['no_hp'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    die("Username sudah digunakan");
}


mysqli_query($conn, "
    INSERT INTO users (username, password, role)
    VALUES ('$username', '$password', 'siswa')
");

$user_id = mysqli_insert_id($conn);


mysqli_query($conn, "
    INSERT INTO anggota (user_id, nama, kelas, alamat, no_hp)
    VALUES ('$user_id', '$nama', '$kelas', '$alamat', '$no_hp')
");

header("Location: index.php");
exit;
