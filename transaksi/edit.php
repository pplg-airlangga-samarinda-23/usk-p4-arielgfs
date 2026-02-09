<?php
session_start();
include '../config/database.php';

// proteksi admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: transaksi.php");
    exit;
}

// ambil data transaksi
$q = mysqli_query($conn, "
    SELECT 
        p.id,
        a.nama AS peminjam,
        b.judul AS buku,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        p.status,
        pg.tanggal_kembali,
        pg.denda
    FROM peminjaman p
    JOIN anggota a ON p.anggota_id = a.id
    JOIN buku b ON p.buku_id = b.id
    LEFT JOIN pengembalian pg ON pg.peminjaman_id = p.id
    WHERE p.id = $id
");

$data = mysqli_fetch_assoc($q);
if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

// proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $tanggal_kembali = $_POST['tanggal_kembali'] ?: null;
    $denda = $_POST['denda'] ?: 0;

    // update status peminjaman
    mysqli_query($conn, "
        UPDATE peminjaman 
        SET status = '$status'
        WHERE id = $id
    ");

    // jika dikembalikan → simpan ke tabel pengembalian
    if ($status === 'dikembalikan') {

        $cek = mysqli_query($conn, "
            SELECT id FROM pengembalian WHERE peminjaman_id = $id
        ");

        if (mysqli_num_rows($cek) > 0) {
            // update
            mysqli_query($conn, "
                UPDATE pengembalian 
                SET tanggal_kembali = '$tanggal_kembali',
                    denda = $denda
                WHERE peminjaman_id = $id
            ");
        } else {
            // insert
            mysqli_query($conn, "
                INSERT INTO pengembalian 
                (peminjaman_id, tanggal_kembali, denda)
                VALUES 
                ($id, '$tanggal_kembali', $denda)
            ");
        }
    }

    header("Location: transaksi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f5f2;
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            max-width: 500px;
            border-radius: 12px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background: #1976d2;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
        .back {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>✏️ Edit Transaksi</h2>

    <p><b>Peminjam:</b> <?= htmlspecialchars($data['peminjam']) ?></p>
    <p><b>Buku:</b> <?= htmlspecialchars($data['buku']) ?></p>
    <p><b>Tanggal Pinjam:</b> <?= $data['tanggal_pinjam'] ?></p>
    <p><b>Batas Kembali:</b> <?= $data['tanggal_jatuh_tempo'] ?></p>

    <form method="post">
        <label>Status</label>
        <select name="status" required>
            <option value="dipinjam" <?= $data['status']=='dipinjam'?'selected':'' ?>>
                Dipinjam
            </option>
            <option value="dikembalikan" <?= $data['status']=='dikembalikan'?'selected':'' ?>>
                Dikembalikan
            </option>
        </select>

        <label>Tanggal Dikembalikan</label>
        <input type="date" name="tanggal_kembali"
               value="<?= $data['tanggal_kembali'] ?>">

        <label>Denda (Rp)</label>
        <input type="number" name="denda"
               value="<?= $data['denda'] ?? 0 ?>">

        <button>Simpan Perubahan</button>
    </form>

    <a href="transaksi.php" class="back">← Kembali</a>
</div>

</body>
</html>
