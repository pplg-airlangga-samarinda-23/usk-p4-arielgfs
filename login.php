<?php
session_start();
include 'config/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$q = mysqli_query($conn, "
    SELECT users.*, anggota.id AS anggota_id
    FROM users
    LEFT JOIN anggota ON users.id = anggota.user_id
    WHERE users.username = '$username'
");

$user = mysqli_fetch_assoc($q);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['anggota_id'] = $user['anggota_id'] ?? null;

    if ($user['role'] === 'admin') {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_siswa.php");
    }
    exit;
}

echo "Login gagal";
