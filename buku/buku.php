<?php
include '../config/database.php';
include '../includes/header.php';

$data = mysqli_query($conn, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #0f4c81, #1976d2);
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0;
            color: #0f4c81;
        }

        .btn-add {
            background: linear-gradient(90deg, #43a047, #2e7d32);
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-add:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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

        .aksi a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            margin-right: 5px;
        }

        .edit {
            background: #ffa000;
            color: #fff;
        }

        .hapus {
            background: #e53935;
            color: #fff;
        }

        .edit:hover, .hapus:hover {
            opacity: 0.85;
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
    <div class="header">
        <h2>📚 Data Buku</h2>
        <a href="tambah.php" class="btn-add">+ Tambah Buku</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($b = mysqli_fetch_assoc($data)) : ?>
            <tr>
                <td data-label="No"><?= $no++ ?></td>
                <td data-label="Judul"><?= htmlspecialchars($b['judul']) ?></td>
                <td data-label="Penulis"><?= htmlspecialchars($b['penulis']) ?></td>
                <td data-label="Stok"><?= $b['stok'] ?></td>
                <td data-label="Aksi" class="aksi">
                    <a href="edit.php?id=<?= $b['id'] ?>" class="edit">Edit</a>
                    <a href="hapus.php?id=<?= $b['id'] ?>" class="hapus"
                       onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php include '../includes/footer.php'; ?>
