<?php
session_start();
include '../config/database.php';

// pastikan siswa login
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../index.php");
    exit;
}

$anggota_id = $_SESSION['anggota_id']; // dari login
$buku_id    = $_POST['buku_id'];

// tanggal hari ini
$tanggal_pinjam = date('Y-m-d');

// +7 hari
$tanggal_jatuh_tempo = date('Y-m-d', strtotime('+7 days'));

mysqli_query($conn, "
    INSERT INTO peminjaman 
    (anggota_id, buku_id, tanggal_pinjam, tanggal_jatuh_tempo, status)
    VALUES 
    ($anggota_id, $buku_id, '$tanggal_pinjam', '$tanggal_jatuh_tempo', 'dipinjam')
");

// kurangi stok buku
mysqli_query($conn, "
    UPDATE buku 
    SET stok = stok - 1 
    WHERE id = $buku_id
");

header("Location: ../dashboard_siswa.php");
exit;
