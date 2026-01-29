<?php
session_start();
include '../config/database.php';

// proteksi admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: transaksi.php");
    exit;
}

$id = (int) $_GET['id'];

// cek apakah peminjaman ada
$cek = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id=$id");
if (mysqli_num_rows($cek) == 0) {
    header("Location: transaksi.php");
    exit;
}

// hapus pengembalian dulu (jika ada)
mysqli_query($conn, "DELETE FROM pengembalian WHERE peminjaman_id=$id");

// hapus peminjaman
mysqli_query($conn, "DELETE FROM peminjaman WHERE id=$id");

// (opsional) catat log
$user_id = $_SESSION['user_id'];
mysqli_query($conn, "
    INSERT INTO log_transaksi (user_id, aktivitas)
    VALUES ($user_id, 'Menghapus transaksi peminjaman ID $id')
");

// kembali ke halaman transaksi
header("Location: transaksi.php");
exit;