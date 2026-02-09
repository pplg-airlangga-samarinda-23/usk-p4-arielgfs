<?php
session_start();
include '../config/database.php';

// Proteksi halaman (khusus admin)
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

/* =======================
   Ambil filter dari form
======================= */
$nama   = $_GET['nama'] ?? '';
$buku   = $_GET['buku'] ?? '';
$dari   = $_GET['dari'] ?? '';
$sampai = $_GET['sampai'] ?? '';

$where = [];

if ($nama != '') {
    $where[] = "a.nama LIKE '%$nama%'";
}
if ($buku != '') {
    $where[] = "b.judul LIKE '%$buku%'";
}
if ($dari != '' && $sampai != '') {
    $where[] = "p.tanggal_pinjam BETWEEN '$dari' AND '$sampai'";
}

$whereSQL = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

/* =======================
   Query utama
======================= */
$data = mysqli_query($conn, "
    SELECT
        p.id,
        a.nama AS peminjam,
        b.judul AS buku,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        pg.tanggal_kembali,
        p.status,
        pg.denda
    FROM peminjaman p
    JOIN buku b ON p.buku_id = b.id
    JOIN anggota a ON p.anggota_id = a.id
    LEFT JOIN pengembalian pg ON pg.peminjaman_id = p.id
    $whereSQL
    ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Transaksi Peminjaman</title>
<style>
body { font-family: Arial; background:#f7f5f2; padding:20px; }
h2 { margin-bottom: 10px; }
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
tr:hover { background: #f3efe9; }

.filter {
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 15px;
}

.filter input {
    padding: 8px;
    margin-right: 8px;
}

.filter button {
    padding: 8px 14px;
    cursor: pointer;
}

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

.aksi a {
    text-decoration: none;
    margin: 0 5px;
    font-size: 18px;
}
.edit { color: #1976d2; }
.hapus { color: red; }
</style>
</head>
<body>

<h2>📚 Transaksi Peminjaman Buku</h2>

<!-- FILTER -->
<form method="GET" class="filter">
    <input type="text" name="nama" placeholder="Nama Siswa" value="<?= htmlspecialchars($nama) ?>">
    <input type="text" name="buku" placeholder="Judul Buku" value="<?= htmlspecialchars($buku) ?>">
    <input type="date" name="dari" value="<?= $dari ?>">
    <input type="date" name="sampai" value="<?= $sampai ?>">
    <button type="submit">🔍 Filter</button>
    <a href="transaksi.php">Reset</a>
</form>

<table>
<tr>
    <th>No</th>
    <th>Nama Peminjam</th>
    <th>Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Batas Kembali</th>
    <th>Dikembalikan</th>
    <th>Status</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while ($row = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['peminjam']) ?></td>
    <td><?= htmlspecialchars($row['buku']) ?></td>
    <td><?= $row['tanggal_pinjam'] ?></td>
    <td><?= $row['tanggal_jatuh_tempo'] ?></td>
    <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
    <td>
        <?php if ($row['status'] == 'dikembalikan'): ?>
            <span class="dikembalikan">Dikembalikan</span>
        <?php else: ?>
            <span class="dipinjam">Dipinjam</span>
        <?php endif; ?>
    </td>
    <td>
        <?= $row['denda'] ? 'Rp ' . number_format($row['denda'],0,',','.') : '-' ?>
    </td>
    <td class="aksi">
        <a href="edit.php?id=<?= $row['id'] ?>" class="edit">✏️</a>
        <a href="hapus.php?id=<?= $row['id'] ?>" class="hapus"
           onclick="return confirm('Hapus transaksi ini?')">🗑</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
