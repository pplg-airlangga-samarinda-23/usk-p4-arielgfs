<?php
session_start();
include '../config/database.php';

if ($_SESSION['role'] !== 'siswa') {
    die("Akses ditolak");
}

$buku = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #1976d2, #42a5f5);
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1976d2;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: #f4f8ff;
            border-radius: 14px;
            padding: 20px 18px;
            box-shadow: 0 5px 12px rgba(0,0,0,0.1);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .card h4 {
            margin: 0 0 8px;
            color: #0f4c81;
        }

        .card p {
            margin: 0 0 15px;
            color: #555;
        }

        .card form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #1976d2, #0f4c81);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .card form button:hover {
            opacity: 0.9;
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
    <h2>📚 Pinjam Buku</h2>

    <div class="grid">
        <?php while ($b = mysqli_fetch_assoc($buku)) : ?>
            <div class="card">
                <div>
                    <h4><?= htmlspecialchars($b['judul']) ?></h4>
                    <p>Stok: <?= $b['stok'] ?></p>
                </div>

                <form action="proses_pinjam.php" method="post">
                    <input type="hidden" name="buku_id" value="<?= $b['id'] ?>">
                    <button type="submit">Pinjam</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
