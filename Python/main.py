from Petshop import Petshop

class main():
    # Membuat instance dari kelas Menu untuk mengelola operasi CRUD
    menu = Petshop.Menu()
    pilihan = 0

    # Loop utama untuk menampilkan menu dan memproses pilihan pengguna
    while pilihan != 6:
        print("\nMenu:")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Ubah Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("6. Keluar")
        pilihan = int(input("Pilih: "))

        # Memproses pilihan pengguna
        if pilihan == 1:
            menu.create()  # Tambah data baru
        elif pilihan == 2:
            menu.print()  # Tampilkan semua data
        elif pilihan == 3:
            menu.update()  # Ubah data berdasarkan ID
        elif pilihan == 4:
            menu.delete()  # Hapus data berdasarkan ID
        elif pilihan == 5:
            menu.search()  # Cari data berdasarkan nama
        elif pilihan == 6:
            print("Keluar dari program.")  # Keluar dari program
        else:
            print("Pilihan tidak valid. Silakan coba lagi.")  # Pilihan tidak valid