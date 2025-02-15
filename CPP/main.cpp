#include "PetShop.cpp"

using namespace std;

int main() {
    petshop::Menu menu;     // Panggil menu dari inner class menu class PetShop
    int pilihan = 0;        // Inisialisasi pilihan dengan 0

    while (pilihan != 6) {
        cout << "\nMenu:\n";
        cout << "1. Tambah Data\n";
        cout << "2. Tampilkan Data\n";
        cout << "3. Ubah Data\n";
        cout << "4. Hapus Data\n";
        cout << "5. Cari Data\n";
        cout << "6. Keluar\n";
        cout << "Pilih: ";
        cin >> pilihan;

        switch (pilihan) {
            case 1:
                menu.Create();
                break;
            case 2:
                menu.Print();
                break;
            case 3:
                menu.Update();
                break;
            case 4:
                menu.Delete();
                break;
            case 5:
                menu.Search();
                break;
            case 6:
                cout << "Keluar dari program.\n";
                break;
        }
    }

    return 0;
}