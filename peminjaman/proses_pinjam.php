<?php
session_start();
include '../config/database.php';

// proteksi
if ($_SESSION['role'] !== 'siswa') {
    die("Akses ditolak");
}

$anggota_id = $_SESSION['anggota_id'];
$buku_id = $_POST['buku_id'];

if (!$anggota_id) {
    die("Data anggota tidak ditemukan");
}

// cek stok
$cek = mysqli_query($conn, "SELECT stok FROM buku WHERE id = $buku_id");
$buku = mysqli_fetch_assoc($cek);

if ($buku['stok'] <= 0) {
    die("Stok habis");
}

$tanggal_pinjam = date('Y-m-d');
$tanggal_jatuh_tempo = date('Y-m-d', strtotime('+7 days'));

// simpan peminjaman
mysqli_query($conn, "
    INSERT INTO peminjaman
    (anggota_id, buku_id, tanggal_pinjam, tanggal_jatuh_tempo, status)
    VALUES
    ($anggota_id, $buku_id, '$tanggal_pinjam', '$tanggal_jatuh_tempo', 'dipinjam')
");

// kurangi stok
mysqli_query($conn, "
    UPDATE buku SET stok = stok - 1 WHERE id = $buku_id
");

header("Location: ../dashboard_siswa.php");
exit;
