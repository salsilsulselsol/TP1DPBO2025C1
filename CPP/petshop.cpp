#include <iostream>
#include <string>
#include <list>     // Pake list biar bisa pushback

using namespace std;

class petshop {
private:
    int id;
    string nama;
    string kategori;
    int harga;
    int stok;

public:
    petshop() {
        this->id = 0;
        this->nama = "";
        this->kategori = "";
        this->harga = 0;
        this->stok = 0;
    }

    petshop(int id, string nama, string kategori, int harga, int stok) {
        this->id = id;
        this->nama = nama;
        this->kategori = kategori;
        this->harga = harga;
        this->stok = stok;
    }

    int get_id() { return id; }
    void set_id(int id) { this->id = id; }
    string get_nama() { return nama; }
    void set_nama(string nama) { this->nama = nama; }
    string get_kategori() { return kategori; }
    void set_kategori(string kategori) { this->kategori = kategori; }
    int get_harga() { return harga; }
    void set_harga(int harga) { this->harga = harga; }
    int get_stok() { return stok; }
    void set_stok(int stok) { this->stok = stok; }

    class Menu {
    private:
        list<petshop> data;

    public:
        Menu() {}

        void tampilkanInfo(petshop pet) {
            cout << "ID: " << pet.get_id() << endl;
            cout << "Nama Produk: " << pet.get_nama() << endl;
            cout << "Kategori: " << pet.get_kategori() << endl;
            cout << "Harga: " << pet.get_harga() << endl;
            cout << "Stok: " << pet.get_stok() << endl;
            cout << "-------------------------" << endl;
        }

        void Create() {
            int id, harga, stok;
            string nama, kategori;

            cout << "Masukkan ID: ";
            cin >> id;
            cout << "Masukkan Nama Produk: ";
            cin >> nama;
            cout << "Masukkan Kategori: ";
            cin >> kategori;
            cout << "Masukkan Harga: ";
            cin >> harga;
            cout << "Masukkan Stok: ";
            cin >> stok;

            data.push_back(petshop(id, nama, kategori, harga, stok));
            cout << "Data berhasil ditambahkan!" << endl;
        }

        void Print() {
            if (data.empty()) {
                cout << "Tidak ada data yang tersedia." << endl;
            } else {
                cout << "-------------------------" << endl;
                cout << "Berikut Peralatan PetShop" << endl;
                cout << "-------------------------" << endl;
                for (list<petshop>::iterator it = data.begin(); it != data.end(); ++it) {
                    tampilkanInfo(*it);
                }
            }
        }

        void Update() {
            int id;
            cout << "Masukkan ID produk yang ingin diubah: ";
            cin >> id;

            bool ditemukan = false;
            for (list<petshop>::iterator it = data.begin(); it != data.end(); ++it) {
                if (it->get_id() == id) {
                    string nama, kategori;
                    int harga, stok;

                    cout << "Masukkan Nama Produk Baru: ";
                    cin >> nama;
                    cout << "Masukkan Kategori Baru: ";
                    cin >> kategori;
                    cout << "Masukkan Harga Baru: ";
                    cin >> harga;
                    cout << "Masukkan Stok Baru: ";
                    cin >> stok;

                    it->set_nama(nama);
                    it->set_kategori(kategori);
                    it->set_harga(harga);
                    it->set_stok(stok);

                    cout << "Data berhasil diubah!" << endl;
                    ditemukan = true;
                    break;
                }
            }

            if (!ditemukan) {
                cout << "Data dengan ID " << id << " tidak ditemukan." << endl;
            }
        }

        void Delete() {
            int id;
            cout << "Masukkan ID produk yang ingin dihapus: ";
            cin >> id;

            list<petshop>::iterator it = data.begin();
            while (it != data.end()) {
                if (it->get_id() == id) {
                    it = data.erase(it);
                    cout << "Data berhasil dihapus!" << endl;
                    return;
                }
                ++it;
            }
            cout << "Data dengan ID " << id << " tidak ditemukan." << endl;
        }

        void Search() {
            string nama;
            cout << "Masukkan Nama Produk yang ingin dicari: ";
            cin >> nama;

            bool ditemukan = false;
            for (list<petshop>::iterator it = data.begin(); it != data.end(); ++it) {
                if (it->get_nama() == nama) {
                    tampilkanInfo(*it);
                    ditemukan = true;
                }
            }

            if (!ditemukan) {
                cout << "Data dengan nama " << nama << " tidak ditemukan." << endl;
            }
        }
        ~Menu() {}
    };
    ~petshop() {}
};