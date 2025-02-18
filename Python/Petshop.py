class Petshop:
    def __init__(self, id=0, nama="", kategori="", harga=0, stok=0):
        # Constructor untuk kelas Petshop,
        # Sekaligus menginisialisasi atribut dasar seperti id, nama, kategori, harga, dan stok
        self.id = id
        self.nama = nama
        self.kategori = kategori
        self.harga = harga
        self.stok = stok

    # Getter dan setter untuk setiap atribut
    def get_id(self):
        return self.id

    def set_id(self, id):
        self.id = id

    def get_nama(self):
        return self.nama

    def set_nama(self, nama):
        self.nama = nama

    def get_kategori(self):
        return self.kategori

    def set_kategori(self, kategori):
        self.kategori = kategori

    def get_harga(self):
        return self.harga

    def set_harga(self, harga):
        self.harga = harga

    def get_stok(self):
        return self.stok

    def set_stok(self, stok):
        self.stok = stok

    # Kelas Menu untuk mengelola operasi CRUD (Create, Read, Update, Delete) pada data Petshop
    class Menu:
        def __init__(self):
            # Inisialisasi list kosong untuk menyimpan data produk
            self.data = []

        def tampilkan_info(self, pet):
            # Menampilkan informasi detail dari sebuah produk
            print(f"ID: {pet.get_id()}")
            print(f"Nama Produk: {pet.get_nama()}")
            print(f"Kategori: {pet.get_kategori()}")
            print(f"Harga: {pet.get_harga()}")
            print(f"Stok: {pet.get_stok()}")
            print("-------------------------")

        def create(self):
            # Method untuk menambahkan data produk baru ke dalam list
            id = int(input("Masukkan ID: "))
            nama = input("Masukkan Nama Produk: ")
            kategori = input("Masukkan Kategori: ")
            harga = int(input("Masukkan Harga: "))
            stok = int(input("Masukkan Stok: "))

            # Membuat objek Petshop baru dan menambahkannya ke list data
            self.data.append(Petshop(id, nama, kategori, harga, stok))
            print("Data berhasil ditambahkan!")

        def print(self):
            # Method untuk menampilkan semua data produk yang tersimpan
            if not self.data:
                print("Tidak ada data yang tersedia.")
            else:
                print("-------------------------")
                print("Berikut Peralatan PetShop")
                print("-------------------------")
                for pet in self.data:
                    self.tampilkan_info(pet)

        def update(self):
            # Method untuk mengubah data produk berdasarkan ID
            id = int(input("Masukkan ID produk yang ingin diubah: "))
            ditemukan = False

            for pet in self.data:
                if pet.get_id() == id:
                    # Jika ID ditemukan, minta input baru untuk setiap atribut
                    nama = input("Masukkan Nama Produk Baru: ")
                    kategori = input("Masukkan Kategori Baru: ")
                    harga = int(input("Masukkan Harga Baru: "))
                    stok = int(input("Masukkan Stok Baru: "))

                    # Update nilai atribut menggunakan setter
                    pet.set_nama(nama)
                    pet.set_kategori(kategori)
                    pet.set_harga(harga)
                    pet.set_stok(stok)

                    print("Data berhasil diubah!")
                    ditemukan = True
                    break

            if not ditemukan:
                print(f"Data dengan ID {id} tidak ditemukan.")

        def delete(self):
            # Method untuk menghapus data produk berdasarkan ID
            id = int(input("Masukkan ID produk yang ingin dihapus: "))
            for pet in self.data:
                if pet.get_id() == id:
                    self.data.remove(pet)
                    print("Data berhasil dihapus!")
                    return

            print(f"Data dengan ID {id} tidak ditemukan.")

        def search(self):
            # Method untuk mencari data produk berdasarkan nama
            nama = input("Masukkan Nama Produk yang ingin dicari: ")
            ditemukan = False

            for pet in self.data:
                if pet.get_nama() == nama:
                    self.tampilkan_info(pet)
                    ditemukan = True

            if not ditemukan:
                print(f"Data dengan nama {nama} tidak ditemukan.")