from Petshop import Petshop

class Main():
    # Membuat instance dari kelas Petshop untuk menu CRUD
    menu = Petshop()
    pilihan = 0

    # Memproses menu pilihan
    while pilihan != 6:
        print("\nMenu:")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Ubah Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("6. Keluar")
        pilihan = int(input("Pilih: ")) # Input pilihan

        # Memproses pilihan
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
            print("Keluar dari program.")  # Keluar/Exit
        else:
            print("Pilihan tidak valid. Silakan coba lagi.")  # default buat input yang ga valid
