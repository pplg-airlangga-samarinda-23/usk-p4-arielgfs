<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'siswa') {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

<h2>Dashboard Siswa</h2>
<ul>
  <li><a href="peminjaman/pinjam.php">Pinjam Buku</a></li>
  <li><a href="pengembalian/kembali.php">Pengembalian</a></li>
</ul>