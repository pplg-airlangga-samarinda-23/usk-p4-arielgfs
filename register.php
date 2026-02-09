<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #1976d2, #42a5f5);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            padding: 30px 28px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1976d2;
        }

        .input-group {
            margin-bottom: 12px;
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

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 18px 0;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #1976d2, #0f4c81);
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

        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .footer-text a {
            color: #1976d2;
            font-weight: 600;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>🧑‍🎓 Register Siswa</h2>

    <form action="proses_register.php" method="post">
        <div class="input-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="input-group">
            <label>Kelas</label>
            <input type="text" name="kelas" placeholder="Contoh: XII RPL 1">
        </div>

        <div class="input-group">
            <label>Alamat</label>
            <input type="text" name="alamat" placeholder="Alamat lengkap">
        </div>

        <div class="input-group">
            <label>No HP</label>
            <input type="text" name="no_hp" placeholder="08xxxxxxxxxx">
        </div>

        <hr>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username login" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password login" required>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <div class="footer-text">
        Sudah punya akun? <a href="index.php">Login</a>
    </div>
</div>

</body>
</html>
