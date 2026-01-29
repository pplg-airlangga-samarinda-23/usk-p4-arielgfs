<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$data = mysqli_query($conn, "
    SELECT
        p.id,
        b.judul AS buku,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        pg.tanggal_kembali,
        p.status,
        pg.denda
    FROM peminjaman p
    JOIN buku b ON p.buku_id = b.id
    LEFT JOIN pengembalian pg ON pg.peminjaman_id = p.id
    ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Peminjaman</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f7f5f2; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }
        th { background: #faf8f6; }
        .dipinjam {
            background: #e8dfd3;
            padding: 5px 12px;
            border-radius: 20px;
        }
        .dikembalikan {
            background: #3cb371;
            color: #fff;
            padding: 5px 12px;
            border-radius: 20px;
        }
        .hapus {
            color: red;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>
<body>

<h2>📚 Transaksi Peminjaman Buku</h2>

<table>
    <tr>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Batas Kembali</th>
        <th>Dikembalikan</th>
        <th>Status</th>
        <th>Denda</th>
        <th>Aksi</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $row['buku'] ?></td>
    <td><?= $row['tanggal_pinjam'] ?></td>
    <td><?= $row['tanggal_jatuh_tempo'] ?></td>
    <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
    <td>
        <?php if ($row['status'] == 'dikembalikan'): ?>
            <span class="dikembalikan">dikembalikan</span>
        <?php else: ?>
            <span class="dipinjam">dipinjam</span>
        <?php endif; ?>
    </td>
    <td><?= $row['denda'] ? 'Rp ' . number_format($row['denda']) : '-' ?></td>
    <td>
        <a href="hapus.php?id=<?= $row['id'] ?>" class="hapus"
           onclick="return confirm('Hapus transaksi ini?')">🗑</a>
    </td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>