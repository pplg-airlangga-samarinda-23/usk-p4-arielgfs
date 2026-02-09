<?php
// header.php
// session_start(); // aktifkan kalau perlu session
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Header</title>

    <style>
        /* Reset sederhana */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Header */
        .header {
            width: 100%;
            height: 60px;
            background: linear-gradient(90deg, #0f4c81, #1976d2);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        /* Navigation */
        .nav {
            list-style: none;
        }

        /* Link */
        .nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        /* Hover effect */
        .nav a:hover {
            background-color: rgba(255,255,255,0.2);
            color: #ffeb3b;
        }
    </style>
</head>
<body>

<header class="header">
    <ul class="nav">
        <li>
            <a href="/usk-p4-arielgfs/logout.php"
               onclick="return confirm('Yakin ingin logout?')">
               Logout
            </a>
        </li>
    </ul>
</header>
