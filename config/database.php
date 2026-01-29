<?php
$host = "localhost";
$db   = "perpus_lat_usk";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal");
}