<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
    <h2>Tambah Produk</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nama" placeholder="Nama Produk" required><br>
        <input type="text" name="kategori" placeholder="Kategori" required><br>
        <input type="number" name="harga" placeholder="Harga" required><br>
        <textarea name="deskripsi" placeholder="Deskripsi Produk"></textarea><br>
        <input type="file" name="gambar" accept="image/*"><br>
        <label>Populer?</label>
        <input type="checkbox" name="populer" value="1"><br>
        <button type="submit" name="submit">Simpan</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $populer = isset($_POST['populer']) ? 1 : 0;

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "images/$gambar");

        mysqli_query($conn, "INSERT INTO produk (nama, kategori, harga, deskripsi, gambar, populer)
            VALUES ('$nama', '$kategori', '$harga', '$deskripsi', '$gambar', '$populer')");
        
        echo "Produk berhasil ditambahkan!";
    }
    ?>
</body>
</html>
