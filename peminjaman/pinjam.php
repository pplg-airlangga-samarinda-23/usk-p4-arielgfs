<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../index.php");
    exit;
}

$buku = mysqli_query($conn,"SELECT * FROM buku WHERE stok > 0");
?>

<!DOCTYPE html>
<html>
<head>
<title>Pinjam Buku</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f7f5f2;
}

h2 {
    margin-bottom: 10px;
}

.search-box {
    margin-bottom: 20px;
}

.search-box input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 16px;
}

.card {
    background: white;
    padding: 15px;
    border-radius: 14px;
    box-shadow: 0 4px 10px rgba(0,0,0,.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card h4 {
    margin: 0 0 8px;
}

.stok {
    font-size: 13px;
    margin-bottom: 10px;
}

.stok.banyak { color: green; }
.stok.sedikit { color: orange; }

.card form button {
    background: #3cb371;
    color: white;
    border: none;
    padding: 8px;
    border-radius: 8px;
    cursor: pointer;
}

.card form button:hover {
    opacity: .9;
}
</style>
</head>

<body>

<h2>📚 Pinjam Buku</h2>

<div class="search-box">
    <input type="text" id="search" placeholder="Cari judul buku...">
</div>

<div class="grid" id="bukuGrid">

<?php while($b = mysqli_fetch_assoc($buku)): ?>
<div class="card" data-judul="<?= strtolower($b['judul']) ?>">
    <h4><?= $b['judul'] ?></h4>

    <div class="stok <?= $b['stok'] <= 2 ? 'sedikit' : 'banyak' ?>">
        Stok: <?= $b['stok'] ?>
    </div>

    <form action="proses_pinjam.php" method="post">
        <input type="hidden" name="buku_id" value="<?= $b['id'] ?>">
        <button type="submit">Pinjam</button>
    </form>
</div>
<?php endwhile; ?>

</div>

<script>
const search = document.getElementById('search');
const cards = document.querySelectorAll('.card');

search.addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    cards.forEach(card => {
        const judul = card.dataset.judul;
        card.style.display = judul.includes(keyword) ? 'flex' : 'none';
    });
});
</script>

</body>
</html>
