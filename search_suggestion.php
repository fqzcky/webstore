<?php
include 'db.php';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $result = mysqli_query($conn, "SELECT nama FROM produk WHERE nama LIKE '%$query%' LIMIT 5");

    $suggestions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $suggestions[] = $row['nama'];
    }

    echo json_encode($suggestions);
}
?>
