<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';

?>


<h2>Dashboard Admin</h2>

<ul>
    <li><a href="buku/buku.php">Kelola Buku</a></li>
    <li><a href="anggota/anggota.php">Kelola Anggota</a></li>
    <li><a href="transaksi.php">Transaksi</a></li>
</ul>

<?php include 'includes/footer.php'; ?>