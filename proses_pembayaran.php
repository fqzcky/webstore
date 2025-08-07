<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];
    $ukuran = $_POST['ukuran'];
    $jumlah = $_POST['jumlah'];
    $produk_id = $_POST['produk_id'];

    include 'db.php';
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE id=$produk_id");
    $produk = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - FaiqStore</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">FaiqStore</div>
    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>
</nav>

<div class="container" style="padding: 40px;">
    <h2>Konfirmasi Pembayaran</h2>
    <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
    <p><strong>Alamat:</strong> <?= htmlspecialchars($alamat) ?></p>
    <p><strong>Nomor HP:</strong> <?= htmlspecialchars($nomor) ?></p>
    <p><strong>Produk:</strong> <?= $produk['nama'] ?></p>
    <p><strong>Ukuran:</strong> <?= htmlspecialchars($ukuran) ?></p>
    <p><strong>Jumlah:</strong> <?= htmlspecialchars($jumlah) ?></p>
    <p><strong>Total Harga:</strong> Rp <?= number_format($produk['harga'] * $jumlah, 0, ',', '.') ?></p>

    <form method="post" action="proses_pembayaran.php">
        <input type="hidden" name="nama" value="<?= $nama ?>">
        <input type="hidden" name="alamat" value="<?= $alamat ?>">
        <input type="hidden" name="nomor" value="<?= $nomor ?>">
        <input type="hidden" name="produk_id" value="<?= $produk_id ?>">
        <input type="hidden" name="ukuran" value="<?= $ukuran ?>">
        <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
        <button type="submit">Bayar Sekarang</button>
    </form>
</div>

</body>
</html>
