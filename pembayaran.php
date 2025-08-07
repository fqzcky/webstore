<?php
// Ambil data dari POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produk_id = $_POST['produk_id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $ukuran = $_POST['ukuran'];
    $jumlah = $_POST['jumlah'];

    include 'db.php';
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $produk_id");
    $produk = mysqli_fetch_assoc($query);

    if (!$produk) {
        echo "Produk tidak ditemukan.";
        exit;
    }

    $total = $produk['harga'] * $jumlah;
} else {
    echo "Akses tidak valid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - FaiqStore</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .pembayaran-container {
            max-width: 800px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .pembayaran-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .info {
            margin-bottom: 15px;
        }
        .info strong {
            display: inline-block;
            width: 150px;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .btn-konfirmasi {
            background-color: #27ae60;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-konfirmasi:hover {
            background-color: #1e8449;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo">FaiqStore</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="gender.php?gender=pria">Pria</a></li>
        <li><a href="gender.php?gender=wanita">Wanita</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
</nav>

<div class="pembayaran-container">
    <h2>Ringkasan Pembelian</h2>

    <div class="info"><strong>Nama Produk:</strong> <?= $produk['nama'] ?></div>
    <div class="info"><strong>Harga Satuan:</strong> Rp <?= number_format($produk['harga']) ?></div>
    <div class="info"><strong>Ukuran:</strong> <?= $ukuran ?></div>
    <div class="info"><strong>Jumlah:</strong> <?= $jumlah ?></div>
    <div class="info"><strong>Total Harga:</strong> Rp <?= number_format($total) ?></div>

    <h3 style="margin-top:30px;">Data Pembeli</h3>
    <div class="info"><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></div>
    <div class="info"><strong>Alamat:</strong> <?= nl2br(htmlspecialchars($alamat)) ?></div>
    <div class="info"><strong>No HP:</strong> <?= htmlspecialchars($hp) ?></div>

    <form action="konfirmasi.php" method="post">
       <input type="hidden" name="id_produk" value="<?= $produk_id ?>">
        <input type="hidden" name="nama" value="<?= htmlspecialchars($nama) ?>">
        <input type="hidden" name="alamat" value="<?= htmlspecialchars($alamat) ?>">
        <input type="hidden" name="hp" value="<?= htmlspecialchars($hp) ?>">
        <input type="hidden" name="ukuran" value="<?= $ukuran ?>">
        <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
        <input type="hidden" name="total" value="<?= $total ?>">

        <!-- Dropdown Metode Pembayaran -->
        <div class="form-group">
            <label for="metode">Pilih Metode Pembayaran:</label>
            <select name="metode" id="metode" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="COD">Cash on Delivery (COD)</option>
                <option value="BRI">Transfer Bank - BRI</option>
                <option value="BCA">Transfer Bank - BCA</option>
                <option value="Mandiri">Transfer Bank - Mandiri</option>
            </select>
        </div>

        <button type="submit" class="btn-konfirmasi">Konfirmasi Pembayaran</button>
    </form>
</div>

</body>
</html>
