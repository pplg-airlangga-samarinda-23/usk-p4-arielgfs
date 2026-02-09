<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'siswa') {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #1976d2, #42a5f5);
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1976d2;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: #f5f9ff;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            transition: 0.3s ease;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .card a {
            text-decoration: none;
            color: #1976d2;
            font-weight: 600;
            font-size: 18px;
            display: block;
        }

        .icon {
            font-size: 45px;
            margin-bottom: 10px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📚 Dashboard Siswa</h2>

    <div class="menu">
        <div class="card">
            <div class="icon">📖</div>
            <a href="peminjaman/pinjam.php">Pinjam Buku</a>
        </div>

        <div class="card">
            <div class="icon">🔄</div>
            <a href="pengembalian/kembali.php">Pengembalian Buku</a>
        </div>
    </div>
</div>

</body>
</html>
