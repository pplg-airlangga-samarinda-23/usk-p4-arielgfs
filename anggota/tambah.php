<?php
include '../includes/header.php';
?>

<h2>Tambah Anggota (Siswa)</h2>

<form action="simpan.php" method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="text" name="kelas" placeholder="Kelas"><br>
    <button>Simpan</button>
</form>

<?php include '../includes/footer.php'; ?>