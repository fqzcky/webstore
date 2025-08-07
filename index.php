<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FaiqStore</title>
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

    <div class="icons" style="position: relative;">
        <form method="get" action="search.php" autocomplete="off">
            <input type="text" name="q" id="searchInput" placeholder="Search..." required>
            <button type="submit">🔍</button>
        </form>
        <div id="suggestions"></div>
    </div>
    
</nav>

<!-- Hero Section -->
<header class="hero">
    <div class="hero-text">
        <h1>SUMMER SALE</h1>
        <h2>COLLECTION 2025</h2>
        <p>Temukan produk terbaik dengan harga spesial untuk musim ini!</p>
        <a href="#produk-terbaru" class="btn">Shop Now</a>
        <a href="#" class="btn-secondary">Watch Video</a>
    </div>
    <div class="hero-img" style="text-align: center;">
        <h3 style="color: white; margin-bottom: 10px;">Produk Andalan</h3>
        <img src="images/airmax95.jpg" alt="Nike Airmax 95 Neon">
    </div>
</header>

<!-- Produk Terbaru -->
<section id="produk-terbaru">
    <h2 style="text-align: center; margin-top: 40px;">Produk Terbaru</h2>
    <div class="produk-container">
        <?php
        $produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY RAND() LIMIT 6");
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
</section>

<!-- Script untuk Search Suggestion -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const suggestionsBox = document.getElementById('suggestions');

    searchInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length > 1) {
            fetch(`search_suggestion.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.textContent = item;
                        div.style.padding = '8px';
                        div.style.cursor = 'pointer';
                        div.addEventListener('click', () => {
                            searchInput.value = item;
                            suggestionsBox.innerHTML = '';
                        });
                        suggestionsBox.appendChild(div);
                    });
                });
        } else {
            suggestionsBox.innerHTML = '';
        }
    });

    // Sembunyikan kotak saat klik di luar
    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.innerHTML = '';
        }
    });
});
</script>

</body>
</html>
