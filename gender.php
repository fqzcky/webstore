<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Produk <?= ucfirst($_GET['gender']) ?> - FaiqStore</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar">
    <div class="logo">FaiqStore</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="gender.php?gender=pria" <?= ($_GET['gender'] == 'pria') ? 'class="active"' : '' ?>>Pria</a></li>
        <li><a href="gender.php?gender=wanita" <?= ($_GET['gender'] == 'wanita') ? 'class="active"' : '' ?>>Wanita</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
    <div class="icons">
        <input type="text" placeholder="Search...">
        <span class="cart">🛒</span>
    </div>
</nav>

<!-- ✅ Konten -->
<div class="container" style="padding: 40px;">
    <h2 style="text-align: center;">Sepatu untuk <?= ucfirst($_GET['gender']) ?></h2>
    <div class="produk-container">
        <?php
        $gender = $_GET['gender'];
        $produk = mysqli_query($conn, "SELECT * FROM produk WHERE gender='$gender'");
        while ($row = mysqli_fetch_assoc($produk)) {
        ?>
            <div class="produk-card">
                <img src="images/<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>">
                <h4><?= $row['nama'] ?></h4>
                <p>Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                <a href="beli.php?id=<?= $row['id'] ?>" class="btn-beli">Beli</a>

            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
