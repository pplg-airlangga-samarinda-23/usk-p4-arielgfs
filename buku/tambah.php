<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #0f4c81, #1976d2);
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            padding: 30px 28px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #0f4c81;
        }

        .input-group {
            margin-bottom: 14px;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 4px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 2px rgba(25,118,210,0.15);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #43a047, #2e7d32);
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #1976d2;
            text-decoration: none;
            font-weight: 600;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>➕ Tambah Buku</h2>

    <form action="simpan.php" method="post">
        <div class="input-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" placeholder="Masukkan judul buku" required>
        </div>

        <div class="input-group">
            <label>Penulis</label>
            <input type="text" name="penulis" placeholder="Masukkan nama penulis">
        </div>

        <div class="input-group">
            <label>Stok</label>
            <input type="number" name="stok" placeholder="Jumlah stok" min="0" required>
        </div>

        <button type="submit">Simpan Buku</button>
    </form>

    <a href="buku.php" class="back">← Kembali ke Data Buku</a>
</div>

</body>
</html>

<?php include '../includes/footer.php'; ?>
