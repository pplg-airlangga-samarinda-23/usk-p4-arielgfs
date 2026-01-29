<?php
include '../config/database.php';

$id = $_GET['id'];

$a = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT user_id FROM anggota WHERE id=$id")
);

mysqli_query($conn,"DELETE FROM anggota WHERE id=$id");
mysqli_query($conn,"DELETE FROM users WHERE id=".$a['user_id']);

header("Location: anggota.php");