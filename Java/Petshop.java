import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

// Class Petshop untuk merepresentasikan produk di petshop
class Petshop {
    private int id;
    private String nama;
    private String kategori;
    private int harga;
    private int stok;
    private static List<Petshop> data = new ArrayList<>(); // List untuk menyimpan data produk

    // Constructor nilai default
    public Petshop() {
        this.id = 0;
        this.nama = "";
        this.kategori = "";
        this.harga = 0;
        this.stok = 0;
    }

    // Constructor parameter atribut
    public Petshop(int id, String nama, String kategori, int harga, int stok) {
        this.id = id;
        this.nama = nama;
        this.kategori = kategori;
        this.harga = harga;
        this.stok = stok;
    }

    // Getter dan Setter untuk setiap atribut
    // id
    public int get_id() { return id; }
    public void set_id(int id) { this.id = id; }

    // nama
    public String get_nama() { return nama; }
    public void set_nama(String nama) { this.nama = nama; }

    // kategori
    public String get_kategori() { return kategori; }
    public void set_kategori(String kategori) { this.kategori = kategori; }

    // harga
    public int get_harga() { return harga; }
    public void set_harga(int harga) { this.harga = harga; }

    // stok
    public int get_stok() { return stok; }
    public void set_stok(int stok) { this.stok = stok; }

    // METHOD-METHOD YANG DIPERLUKAN UNTUK CRUD
    // Method untuk menampilkan informasi produk
    public static void tampilkanInfo(Petshop pet) {
        System.out.println("ID: " + pet.get_id());
        System.out.println("Nama Produk: " + pet.get_nama());
        System.out.println("Kategori: " + pet.get_kategori());
        System.out.println("Harga: " + pet.get_harga());
        System.out.println("Stok: " + pet.get_stok());
        System.out.println("-------------------------");
    }

    // Method untuk menambahkan data produk baru
    public static void create() {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Masukkan ID: ");
        int id = scanner.nextInt();
        scanner.nextLine();  // Consume newline

        // Cek apakah ID sudah ada
        for (Petshop pet : data) {
            if (pet.get_id() == id) {
                System.out.println("ID sudah ada. Silakan masukkan ID yang berbeda.");
                return;
            }
        }

        System.out.print("Masukkan Nama Produk: ");
        String nama = scanner.nextLine();
        System.out.print("Masukkan Kategori: ");
        String kategori = scanner.nextLine();
        System.out.print("Masukkan Harga: ");
        int harga = scanner.nextInt();
        System.out.print("Masukkan Stok: ");
        int stok = scanner.nextInt();

        data.add(new Petshop(id, nama, kategori, harga, stok));
        System.out.println("Data berhasil ditambahkan!");
    }

    // Method untuk menampilkan semua data produk
    public static void print() {
        if (data.isEmpty()) {
            System.out.println("Tidak ada data yang tersedia.");
        } else {
            System.out.println("-------------------------");
            System.out.println("Berikut Peralatan PetShop");
            System.out.println("-------------------------");
            for (Petshop pet : data) {
                tampilkanInfo(pet);
            }
        }
    }

    // Method untuk mengubah data produk berdasarkan ID
    public static void update() {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Masukkan ID produk yang ingin diubah: ");
        int id = scanner.nextInt();
        scanner.nextLine();  // Consume newline

        boolean ditemukan = false;
        for (Petshop pet : data) {
            if (pet.get_id() == id) {
                System.out.print("Masukkan Nama Produk Baru: ");
                String nama = scanner.nextLine();
                System.out.print("Masukkan Kategori Baru: ");
                String kategori = scanner.nextLine();
                System.out.print("Masukkan Harga Baru: ");
                int harga = scanner.nextInt();
                System.out.print("Masukkan Stok Baru: ");
                int stok = scanner.nextInt();

                pet.set_nama(nama);
                pet.set_kategori(kategori);
                pet.set_harga(harga);
                pet.set_stok(stok);

                System.out.println("Data berhasil diubah!");
                ditemukan = true;
                break;
            }
        }

        if (!ditemukan) {
            System.out.println("Data dengan ID " + id + " tidak ditemukan.");
        }
    }

    // Method untuk menghapus data produk berdasarkan ID
    public static void delete() {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Masukkan ID produk yang ingin dihapus: ");
        int id = scanner.nextInt();

        for (Petshop pet : data) {
            if (pet.get_id() == id) {
                data.remove(pet);
                System.out.println("Data berhasil dihapus!");
                return;
            }
        }

        System.out.println("Data dengan ID " + id + " tidak ditemukan.");
    }

    // Method untuk mencari data produk berdasarkan nama
    public static void search() {
        Scanner scanner = new Scanner(System.in);
        System.out.print("Masukkan Nama Produk yang ingin dicari: ");
        String nama = scanner.nextLine();

        boolean ditemukan = false;
        for (Petshop pet : data) {
            if (pet.get_nama().equals(nama)) {
                tampilkanInfo(pet);
                ditemukan = true;
            }
        }

        if (!ditemukan) {
            System.out.println("Data dengan nama " + nama + " tidak ditemukan.");
        }
    }
}
