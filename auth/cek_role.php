<?php
if ($_SESSION['user']['role'] != 'admin') {
    die("Akses ditolak");
}