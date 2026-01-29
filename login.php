<?php
session_start();
include 'config/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($q);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] == 'admin') {
        header("Location: dashboard_admin.php");
    } else if ($user['role'] == 'siswa') {
        header("Location: dashboard_siswa.php");
    }
    exit;
}
echo "Login gagal";