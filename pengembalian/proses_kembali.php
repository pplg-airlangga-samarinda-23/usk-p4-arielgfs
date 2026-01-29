<?php
include '../config/database.php';


$id = $_GET['id'];
$buku = $_GET['buku'];
$today = date('Y-m-d');

$p = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT tanggal_jatuh_tempo FROM peminjaman WHERE id=$id")
);

$denda = 0;
if ($today > $p['tanggal_jatuh_tempo']) {
    $hari = (strtotime($today)-strtotime($p['tanggal_jatuh_tempo']))/86400;
    $denda = $hari * 1000;
}

mysqli_query($conn,"
 INSERT INTO pengembalian
 (peminjaman_id,tanggal_kembali,denda)
 VALUES ($id,'$today',$denda)
");

mysqli_query($conn,"
 UPDATE peminjaman SET status='dikembalikan' WHERE id=$id
");

mysqli_query($conn,"UPDATE buku SET stok=stok+1 WHERE id=$buku");

header("Location: kembali.php");