<?php include '../includes/header.php'; ?>

<h2>Tambah Buku</h2>

<form action="simpan.php" method="post">
    <input type="text" name="judul" placeholder="Judul" required><br>
    <input type="text" name="penulis" placeholder="Penulis"><br>
    <input type="number" name="stok" placeholder="Stok" required><br>
    <button type="submit">Simpan</button>
</form>

<?php include '../includes/footer.php'; ?>