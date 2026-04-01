<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RBTV Review System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- GLOBAL STYLE -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f7fb;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: relative;
            z-index: 999;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 40px;
        }

        .logo span {
            font-weight: 600;
            color: #2c3e50;
        }

        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: #2563eb;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">
        <img src="assets/img/logo.png" alt="RBTV">
        <span>Program Review</span>
    </div>

    <div class="nav-links">
        <a href="index.php">Beranda</a>
        <a href="program.php">Program</a>
        <a href="ulasan.php">Ulasan</a>
        <a href="tentang.php">Tentang</a>
        <a href="kontak.php">Kontak</a>
    </div>
</div>