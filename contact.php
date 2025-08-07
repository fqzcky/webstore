<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hubungi Kami - FaiqStore</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #e53935;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        form button {
            background-color: #e53935;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        form button:hover {
            background-color: #c62828;
        }

        

        /* Navbar styling jika belum ada di style.css */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 10%;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e53935;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            color: #e53935;
        }

        .icons input {
            padding: 6px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">FaiqStore</div>
    <ul>
        <li><a href="index.php" <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : '' ?>>Home</a></li>
        <li><a href="gender.php?gender=pria" <?= ($_GET['gender'] ?? '') == 'pria' ? 'class="active"' : '' ?>>Pria</a></li>
        <li><a href="gender.php?gender=wanita" <?= ($_GET['gender'] ?? '') == 'wanita' ? 'class="active"' : '' ?>>Wanita</a></li>
        <li><a href="about.php" <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'class="active"' : '' ?>>About</a></li>
        <li><a href="contact.php" <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'class="active"' : '' ?>>Contact Us</a></li>
    </ul>
    <div class="icons">
        <input type="text" placeholder="Search...">
        <span class="cart">🛒</span>
    </div>
</nav>

<!-- Contact Form -->
<div class="container">
    <h2>Hubungi Kami</h2>
    <form method="post" action="#">
        <label>Nama:</label>
        <input type="text" name="nama" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Pesan:</label>
        <textarea name="pesan" rows="5" required></textarea>

        <button type="submit">Kirim Pesan</button>
    </form>
</div>

</body>
</html>
