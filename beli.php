<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Produk tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$data = mysqli_fetch_assoc($produk);

if (!$data) {
    echo "Produk tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beli Produk - FaiqStore</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .beli-container {
            max-width: 800px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .beli-container img {
            max-width: 100%;
            border-radius: 8px;
        }
        .beli-container h2 {
            margin-top: 20px;
            color: #333;
        }
        .form-group {
            margin: 15px 0;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .form-group button {
            background-color: #e74c3c;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<!-- Navbar -->
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

<!-- Konten -->
<div class="beli-container">
    <img src="images/<?= $data['gambar'] ?>" alt="<?= $data['nama'] ?>">
    <h2><?= $data['nama'] ?></h2>
    <p><strong>Harga:</strong> Rp <?= number_format($data['harga']) ?></p>

    <form method="post" action="pembayaran.php">
        <input type="hidden" name="produk_id" value="<?= $data['id'] ?>">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Nomor HP</label>
            <input type="text" name="hp" required>
        </div>

        <div class="form-group">
            <label>Ukuran Sepatu</label>
            <select name="ukuran" required>
                <option value="">Pilih Ukuran</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Beli</label>
            <input type="number" name="jumlah" value="1" min="1" required>
        </div>

        <div class="form-group">
            <button type="submit">Lanjutkan ke Pembayaran</button>
        </div>
    </form>
</div>

</body>
</html>
