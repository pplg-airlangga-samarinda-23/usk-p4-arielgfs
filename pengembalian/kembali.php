<?php
include '../config/database.php';
include '../includes/header.php';

$data = mysqli_query($conn,"
 SELECT p.*, b.judul
 FROM peminjaman p
 JOIN buku b ON p.buku_id=b.id
 WHERE status='dipinjam'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #1976d2, #42a5f5);
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            margin-bottom: 25px;
            color: #1976d2;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
        }

        th {
            background: #1976d2;
            color: white;
        }

        tr:nth-child(even) {
            background: #f4f8ff;
        }

        tr:hover {
            background: #e3f2fd;
        }

        .btn {
            padding: 8px 14px;
            background: linear-gradient(90deg, #43a047, #2e7d32);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: #f9f9f9;
                border-radius: 10px;
                padding: 10px;
            }

            td {
                padding: 8px;
                display: flex;
                justify-content: space-between;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #1976d2;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🔄 Pengembalian Buku</h2>

    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Jatuh Tempo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($p = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td data-label="Judul"><?= htmlspecialchars($p['judul']) ?></td>
                <td data-label="Jatuh Tempo"><?= $p['tanggal_jatuh_tempo'] ?></td>
                <td data-label="Aksi">
                    <a class="btn"
                       href="proses_kembali.php?id=<?= $p['id'] ?>&buku=<?= $p['buku_id'] ?>"
                       onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                       Kembalikan
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php include '../includes/footer.php'; ?>
