<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "webstore");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari POST
$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$hp = $_POST['no_hp'] ?? '';
$ukuran = $_POST['ukuran'] ?? '';
$jumlah = $_POST['jumlah'] ?? '';
$metode = $_POST['metode'] ?? '';
$id_produk = $_POST['id_produk'] ?? '';

// Validasi input dasar
if (empty($id_produk) || empty($metode)) {
    echo "<p style='color:red; font-weight:bold;'>Data tidak lengkap. Silakan ulangi proses pemesanan.</p>";
    echo "<a href='index.php'>Kembali ke Beranda</a>";
    exit;
}

// Ambil data produk
$produk = null;
$sql_produk = "SELECT * FROM produk WHERE id = '$id_produk'";
$result_produk = $conn->query($sql_produk);
if ($result_produk && $result_produk->num_rows > 0) {
    $produk = $result_produk->fetch_assoc();
} else {
    echo "<p style='color:red; font-weight:bold;'>Maaf, terjadi kesalahan saat memproses produk.</p>";
    echo "<a href='index.php'>Kembali ke Beranda</a>";
    exit;
}

// Hitung total
$total = $produk['harga'] * (int)$jumlah;

// Daftar rekening
$rekening_list = [
    'BRI' => '008626768314',
    'BCA' => '021559883441',
    'Mandiri' => '112882734112'
];
$nomor_rekening = $rekening_list[$metode] ?? '';

// Simpan transaksi ke database
$stmt = $conn->prepare("INSERT INTO transaksi (id_produk, nama, alamat, hp, ukuran, jumlah, total, metode_pembayaran)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssids", $id_produk, $nama, $alamat, $no_hp, $ukuran, $jumlah, $total, $metode);

$stmt->execute();
$stmt->close();

// Tampilkan konfirmasi
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f6f6f6;
            padding: 40px;
            text-align: center;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
        }
        .info {
            margin: 15px 0;
            font-size: 16px;
        }
        .rekening {
            background-color: #f1f1f1;
            padding: 10px;
            margin-top: 10px;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #34495e;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Terima kasih, <?= htmlspecialchars($nama) ?>!</h2>
        <div class="info">
            Pesanan Anda untuk <strong><?= htmlspecialchars($produk['nama']) ?></strong> telah kami terima.
        </div>
        <div class="info">
            Total Pembayaran: <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
        </div>
        <div class="info">
            Metode Pembayaran: <strong><?= htmlspecialchars($metode) ?></strong>
        </div>
        <?php if ($metode !== 'COD'): ?>
            <div class="info">
                Silakan transfer ke rekening <strong><?= htmlspecialchars($metode) ?></strong> berikut:
                <div class="rekening">
                    <?= htmlspecialchars($metode) ?> - <?= $nomor_rekening ?>
                </div>
            </div>
        <?php else: ?>
            <div class="info">
                Silakan siapkan pembayaran saat barang tiba (Cash on Delivery).
            </div>
        <?php endif; ?>
        <a href="index.php">Kembali ke Beranda</a>
    </div>
</body>
</html>
