<?php

require_once "Petshop.php";
session_start(); // Memulai session PHP untuk menyimpan data

// Inisialisasi objek Petshop jika belum ada dalam session
if (!isset($_SESSION['petshop'])) {
    $_SESSION['petshop'] = new Petshop();
}
$petshop = $_SESSION['petshop'];

// Menangani permintaan POST untuk operasi CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aksi'])) {
        switch ($_POST['aksi']) {
            case 'tambah':
                // Menambahkan produk baru dengan data dari form
                $petshop->tambahProduk(
                    (int)$_POST['id'],
                    $_POST['nama'],
                    $_POST['kategori'],
                    (int)$_POST['harga'],
                    (int)$_POST['stok'],
                    $_POST['urlFoto']
                );
                break;
            case 'ubah':
                // Mengubah data produk yang sudah ada
                $petshop->ubahDataProduk(
                    (int)$_POST['id'],
                    $_POST['nama'],
                    $_POST['kategori'],
                    (int)$_POST['harga'],
                    (int)$_POST['stok'],
                    $_POST['urlFoto']
                );
                break;
            case 'hapus':
                // Menghapus produk berdasarkan ID
                $petshop->hapusDataProduk((int)$_POST['id']);
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Manajemen Petshop</title>
    <style>
        /* Style umum untuk halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Style untuk header halaman */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Style untuk tombol */
        .tombol {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            margin-left: 10px;
        }
        .tombol-utama { background-color: #4CAF50; }
        .tombol-ubah { background-color: #2196F3; }
        .tombol-hapus { background-color: #f44336; }
        .tombol-cari { background-color: #ff9800; }
        
        /* Style untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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

        /* Style untuk modal/popup */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-konten {
            background-color: white;
            margin: 5% auto; /* Diubah dari 15% ke 5% untuk posisi lebih atas */
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            position: relative;
            max-height: 80vh; /* Maksimum tinggi modal */
            overflow-y: auto; /* Scroll jika konten terlalu panjang */
        }
        .tutup {
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 24px;
            cursor: pointer;
        }

        /* Style untuk form */
        .grup-form {
            margin-bottom: 15px;
        }
        .grup-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .grup-form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style untuk pencarian */
        .pencarian {
            margin-bottom: 20px;
        }
        .pencarian input {
            padding: 8px;
            width: 200px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header dengan judul dan tombol aksi utama -->
        <div class="header">
            <h1><a href="index.php" style="text-decoration: none; color: inherit;">Sistem Manajemen Petshop</a></h1>
            <div>
                <button onclick="tampilkanModal('modalTambah')" class="tombol tombol-utama">Tambah Produk</button>
                <button onclick="tampilkanModal('modalCari')" class="tombol tombol-cari">Cari Produk</button>
            </div>
        </div>

        <!-- Tampilan tabel produk -->
        <?php
        // Menampilkan hasil pencarian jika ada, atau semua data jika tidak ada pencarian
        if (isset($_GET['cari']) && !empty($_GET['cari'])) {
            echo "<h3>Hasil pencarian untuk: " . htmlspecialchars($_GET['cari']) . "</h3>";
            $petshop->cariProdukByNama($_GET['cari']);
        } else {
            $petshop->tampilkan();
        }
        ?>

        <!-- Modal form untuk menambah produk -->
        <div id="modalTambah" class="modal">
            <div class="modal-konten">
                <span class="tutup" onclick="tutupModal('modalTambah')">&times;</span>
                <h2>Tambah Produk Baru</h2>
                <form method="post">
                    <input type="hidden" name="aksi" value="tambah">
                    <div class="grup-form">
                        <label>ID:</label>
                        <input type="number" name="id" required>
                    </div>
                    <div class="grup-form">
                        <label>Nama:</label>
                        <input type="text" name="nama" required>
                    </div>
                    <div class="grup-form">
                        <label>Kategori:</label>
                        <input type="text" name="kategori" required>
                    </div>
                    <div class="grup-form">
                        <label>Harga:</label>
                        <input type="number" name="harga" required>
                    </div>
                    <div class="grup-form">
                        <label>Stok:</label>
                        <input type="number" name="stok" required>
                    </div>
                    <div class="grup-form">
                        <label>URL Foto:</label>
                        <input type="text" name="urlFoto" required>
                    </div>
                    <button type="submit" class="tombol tombol-utama">Tambah</button>
                </form>
            </div>
        </div>

        <!-- Modal form untuk mengubah produk -->
        <div id="modalUbah" class="modal">
            <div class="modal-konten">
                <span class="tutup" onclick="tutupModal('modalUbah')">&times;</span>
                <h2>Ubah Produk</h2>
                <form method="post">
                    <input type="hidden" name="aksi" value="ubah">
                    <div class="grup-form">
                        <label>ID:</label>
                        <input type="number" name="id" id="ubahId" required readonly>
                    </div>
                    <div class="grup-form">
                        <label>Nama Baru:</label>
                        <input type="text" name="nama" required>
                    </div>
                    <div class="grup-form">
                        <label>Kategori Baru:</label>
                        <input type="text" name="kategori" required>
                    </div>
                    <div class="grup-form">
                        <label>Harga Baru:</label>
                        <input type="number" name="harga" required>
                    </div>
                    <div class="grup-form">
                        <label>Stok Baru:</label>
                        <input type="number" name="stok" required>
                    </div>
                    <div class="grup-form">
                        <label>URL Foto Baru:</label>
                        <input type="text" name="urlFoto" required>
                    </div>
                    <button type="submit" class="tombol tombol-ubah">Perbarui</button>
                </form>
            </div>
        </div>

        <!-- Modal konfirmasi untuk menghapus produk -->
        <div id="modalHapus" class="modal">
            <div class="modal-konten">
                <span class="tutup" onclick="tutupModal('modalHapus')">&times;</span>
                <h2>Hapus Produk</h2>
                <form method="post">
                    <input type="hidden" name="aksi" value="hapus">
                    <div class="grup-form">
                        <label>ID Produk yang akan dihapus:</label>
                        <input type="number" name="id" id="hapusId" required readonly>
                    </div>
                    <button type="submit" class="tombol tombol-hapus">Hapus</button>
                </form>
            </div>
        </div>

        <!-- Modal untuk pencarian produk -->
        <div id="modalCari" class="modal">
            <div class="modal-konten">
                <span class="tutup" onclick="tutupModal('modalCari')">&times;</span>
                <h2>Cari Produk</h2>
                <form method="get">
                    <div class="grup-form">
                        <label>Nama Produk:</label>
                        <input type="text" name="cari" placeholder="Masukkan nama produk..." required>
                    </div>
                    <button type="submit" class="tombol tombol-cari">Cari</button>
                </form>
            </div>
        </div>

        <script>
        // Fungsi untuk menampilkan modal berdasarkan ID
        function tampilkanModal(id) {
            document.getElementById(id).style.display = "block";
        }

        // Fungsi untuk menutup modal berdasarkan ID
        function tutupModal(id) {
            document.getElementById(id).style.display = "none";
        }

        // Fungsi yang dijalankan setelah halaman dimuat
        window.onload = function() {
            var table = document.querySelector("table");
            if (table) {
                var rows = table.getElementsByTagName("tr");
                
                // Menambahkan kolom header untuk aksi
                var headerRow = rows[0];
                var th = document.createElement("th");
                th.textContent = "Aksi";
                headerRow.appendChild(th);
                
                // Menambahkan tombol aksi ke setiap baris data
                for (var i = 1; i < rows.length; i++) {
                    var td = document.createElement("td");
                    var id = rows[i].cells[0].textContent; // Mengambil ID dari kolom pertama
                    
                    // Membuat tombol ubah dan hapus untuk setiap baris
                    td.innerHTML = `
                        <button onclick="ubahProduk(${id})" class="tombol tombol-ubah">Ubah</button>
                        <button onclick="hapusProduk(${id})" class="tombol tombol-hapus">Hapus</button>
                    `;
                    rows[i].appendChild(td);
                }
            }
        }

        // Fungsi untuk menangani aksi ubah produk
        function ubahProduk(id) {
            document.getElementById('ubahId').value = id;
            tampilkanModal('modalUbah');
        }

        // Fungsi untuk menangani aksi hapus produk
        function hapusProduk(id) {
            document.getElementById('hapusId').value = id;
            tampilkanModal('modalHapus');
        }
        </script>
    </div>
</body>
</html>