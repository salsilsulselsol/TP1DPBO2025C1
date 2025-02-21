<?php
require_once "Petshop.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Demo Petshop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .section {
            background-color: #f5f5f5;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 5px solid #4CAF50;
        }
        .section-title {
            color: #2E7D32;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            background-color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        .search-box {
            padding: 10px;
            margin: 10px 0;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    $petshop = new Petshop();

    // Buat objek produk untuk ditambahkan
    $toAdd1 = new Petshop(1, "Gumball", "Kucing Biru", 100000, 10, "./gumball.png");
    $toAdd2 = new Petshop(2, "Darwin", "Ikan Darat", 150000, 5, "./darwin.jpg");
    $toEdit1 = new Petshop(1, "Anais", "Kelinci Lucu", 120000, 8, "./anais.png");
    $idToDel = 2;
    ?>

    <div class="section">
        <h2 class="section-title">1. Demonstrasi Penambahan Data</h2>
        <?php
        $petshop->tambahProduk($toAdd1->ambilId(), $toAdd1->ambilNama(), $toAdd1->ambilKategori(), 
                              $toAdd1->ambilHarga(), $toAdd1->ambilStok(), $toAdd1->ambilPhotoUrl());
        $petshop->tambahProduk($toAdd2->ambilId(), $toAdd2->ambilNama(), $toAdd2->ambilKategori(), 
                              $toAdd2->ambilHarga(), $toAdd2->ambilStok(), $toAdd2->ambilPhotoUrl());
        echo "<p>Status: Data berhasil ditambahkan</p>";
        $petshop->tampilkan();
        ?>
    </div>

    <div class="section">
        <h2 class="section-title">2. Demonstrasi Pencarian Data</h2>
        <form method="get">
            <input type="text" name="search" placeholder="Masukkan nama produk..." class="search-box">
            <input type="submit" value="Cari" class="search-button">
        </form>
        <?php
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            echo "<p>Hasil pencarian untuk: " . htmlspecialchars($_GET['search']) . "</p>";
            $petshop->cariProdukByNama($_GET['search']);
        }
        ?>
    </div>

    <div class="section">
        <h2 class="section-title">3. Demonstrasi Update Data</h2>
        <?php
        $petshop->ubahDataProduk($toEdit1->ambilId(), $toEdit1->ambilNama(), $toEdit1->ambilKategori(), 
                                $toEdit1->ambilHarga(), $toEdit1->ambilStok(), $toEdit1->ambilPhotoUrl());
        echo "<p>Status: Data berhasil diupdate</p>";
        $petshop->tampilkan();
        ?>
    </div>

    <div class="section">
        <h2 class="section-title">4. Demonstrasi Penghapusan Data</h2>
        <?php
        $petshop->hapusDataProduk($idToDel);
        echo "<p>Status: Data dengan ID $idToDel berhasil dihapus</p>";
        $petshop->tampilkan();
        ?>
    </div>
</body>
</html>