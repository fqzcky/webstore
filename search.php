<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="logo">FaiqStore</div>
    <ul>
        <ul>
    <li><a href="index.php" <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : '' ?>>Home</a></li>
    <li><a href="gender.php?gender=pria" <?= ($_GET['gender'] ?? '') == 'pria' ? 'class="active"' : '' ?>>Pria</a></li>
    <li><a href="gender.php?gender=wanita" <?= ($_GET['gender'] ?? '') == 'wanita' ? 'class="active"' : '' ?>>Wanita</a></li>
    <li><a href="about.php" <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'class="active"' : '' ?>>About</a></li>
    <li><a href="contact.php" <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'class="active"' : '' ?>>Contact Us</a></li>
</ul>

    </ul>
    <div class="icons">
        <form method="get" action="search.php">
            <input type="text" name="q" placeholder="Search..." required>
            <button type="submit">🔍</button>
        </form>
    </div>
</nav>

<div class="container" style="padding: 40px;">
    <h2>Hasil Pencarian</h2>
    <div class="produk-container">
        <?php
        if (isset($_GET['q'])) {
            $q = mysqli_real_escape_string($conn, $_GET['q']);
            $produk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$q%'");
            if (mysqli_num_rows($produk) > 0) {
                while ($row = mysqli_fetch_assoc($produk)) {
        ?>
            <div class="produk-card">
                <img src="images/<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>">
                <h4><?= $row['nama'] ?></h4>
                <p>Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                <a href="produk.php?id=<?= $row['id'] ?>">Lihat Detail</a>
            </div>
        <?php
                }
            } else {
                echo "<p>Tidak ada hasil untuk: <strong>$q</strong></p>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
