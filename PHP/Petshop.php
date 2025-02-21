<?php
class Petshop {
    // Properti untuk menyimpan data produk
    private int $id;
    private string $nama;
    private string $kategori;
    private int $harga;
    private int $stok;
    private string $photoUrl;
    private array $daftarProduk;

    // Constructor untuk inisialisasi objek Petshop
    public function __construct(int $id = 0, string $nama = "", string $kategori = "", int $harga = 0, int $stok = 0, string $photoUrl = "") {
        $this->id = $id;
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->harga = $harga;
        $this->stok = $stok;
        $this->photoUrl = $photoUrl;
        $this->daftarProduk = array(); // Inisialisasi array daftar produk
    }

    // Setter methods untuk mengubah nilai properti
    public function setId(int $id) {
        $this->id = $id;
    }

    public function setNama(string $nama) {
        $this->nama = $nama;
    }

    public function setKategori(string $kategori) {
        $this->kategori = $kategori;
    }

    public function setHarga(int $harga) {
        $this->harga = $harga;
    }

    public function setStok(int $stok) {
        $this->stok = $stok;
    }

    public function setPhotoUrl(string $photoUrl) {
        $this->photoUrl = $photoUrl;
    }

    // Getter methods untuk mengambil nilai properti
    public function ambilId() {
        return $this->id;
    }

    public function ambilNama() {
        return $this->nama;
    }

    public function ambilKategori() {
        return $this->kategori;
    }

    public function ambilHarga() {
        return $this->harga;
    }

    public function ambilStok() {
        return $this->stok;
    }

    public function ambilPhotoUrl() {
        return $this->photoUrl;
    }

    // CRUD Operations
    public function tambahProduk($id, $nama, $kategori, $harga, $stok, $photoUrl) {
        // Tambahkan produk baru jika id tidak ada yang sama
        $indexProdukDicari = $this->cariProduk($id);
        if ($indexProdukDicari == count($this->daftarProduk)) {
            $produkBaru = new Petshop($id, $nama, $kategori, $harga, $stok, $photoUrl);
            $this->daftarProduk[] = $produkBaru;
        } else {
            echo "ditemukan id sama\n";
        }
    }

    public function cariProduk(int $idProduk) {
        // Cari produk berdasarkan id
        $indeks = 0;
        $banyakProduk = count($this->daftarProduk);
        $ditemukan = false;
        while ($indeks < $banyakProduk && !$ditemukan) {
            if ($this->daftarProduk[$indeks]->ambilId() == $idProduk) {
                $ditemukan = true;
            } else {
                $indeks++;
            }
        }
        return $indeks;
    }

    public function ubahDataProduk($id, $nama, $kategori, $harga, $stok, $photoUrl) {
        // Ubah data produk jika id ditemukan
        $indexProdukDicari = $this->cariProduk($id);
        if ($indexProdukDicari != count($this->daftarProduk)) {
            $this->daftarProduk[$indexProdukDicari]->setNama($nama);
            $this->daftarProduk[$indexProdukDicari]->setKategori($kategori);
            $this->daftarProduk[$indexProdukDicari]->setHarga($harga);
            $this->daftarProduk[$indexProdukDicari]->setStok($stok);
            $this->daftarProduk[$indexProdukDicari]->setPhotoUrl($photoUrl);
        } else {
            echo "tidak ditemukan id sama\n";
        }
    }

    public function hapusDataProduk(int $idProduk) {
        // Hapus data produk jika id ditemukan
        $indexProdukDicari = $this->cariProduk($idProduk);
        if ($indexProdukDicari != count($this->daftarProduk)) {
            array_splice($this->daftarProduk, $indexProdukDicari, 1);
        } else {
            echo "tidak ditemukan id sama\n";
        }
    }

    // Method untuk mencari produk berdasarkan nama
    public function cariProdukByNama($nama) {
        $found = false;
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Photo</th>
            </tr>";
        
        foreach ($this->daftarProduk as $produk) {
            if (stripos($produk->ambilNama(), $nama) !== false) {
                echo "<tr>
                        <td>" . $produk->ambilId() . "</td>
                        <td>" . $produk->ambilNama() . "</td>
                        <td>" . $produk->ambilKategori() . "</td>
                        <td>" . $produk->ambilHarga() . "</td>
                        <td>" . $produk->ambilStok() . "</td>
                        <td><img src='" . $produk->ambilPhotoUrl() . "' width='100' height='100'/></td>
                    </tr>";
                $found = true;
            }
        }
        echo "</table>";
        
        if (!$found) {
            echo "<p>Tidak ada produk yang ditemukan dengan nama tersebut.</p>";
        }
    }

    // Method untuk menampilkan semua produk
    public function tampilkan() {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Photo</th>
            </tr>";
        foreach ($this->daftarProduk as $produk) {
            echo "<tr>
                    <td>" . $produk->ambilId() . "</td>
                    <td>" . $produk->ambilNama() . "</td>
                    <td>" . $produk->ambilKategori() . "</td>
                    <td>" . $produk->ambilHarga() . "</td>
                    <td>" . $produk->ambilStok() . "</td>
                    <td><img src='" . $produk->ambilPhotoUrl() . "' width='100' height='100'/></td>
                </tr>";
        }
        echo "</table>";
    }
}
?>