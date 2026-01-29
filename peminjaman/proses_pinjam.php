<?php
include '../config/database.php';
session_start();

$user_id = $_SESSION['user']['id'];

$anggota = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT id FROM anggota WHERE user_id=$user_id")
);

$buku_id = $_POST['buku_id'];
$tgl = date('Y-m-d');
$tempo = date('Y-m-d', strtotime('+7 days'));

mysqli_query($conn,"
 INSERT INTO peminjaman
 (anggota_id,buku_id,tanggal_pinjam,tanggal_jatuh_tempo)
 VALUES
 ($anggota[id],$buku_id,'$tgl','$tempo')
");

mysqli_query($conn,"UPDATE buku SET stok=stok-1 WHERE id=$buku_id");

header("Location: ../dashboard_siswa.php");