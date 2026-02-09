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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #0f4c81, #1976d2);
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0f4c81;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: #f4f8ff;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            transition: 0.3s ease;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }

        .card a {
            text-decoration: none;
            color: #0f4c81;
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
    <h2>⚙️ Dashboard Admin</h2>

    <div class="menu">
        <div class="card">
            <div class="icon">📚</div>
            <a href="buku/buku.php">Kelola Buku</a>
        </div>

        <div class="card">
            <div class="icon">👥</div>
            <a href="anggota/anggota.php">Kelola Anggota</a>
        </div>

        <div class="card">
            <div class="icon">🔄</div>
            <a href="transaksi/transaksi.php">Transaksi</a>
        </div>
    </div>
</div>

</body>
</html>

<?php include 'includes/footer.php'; ?>
