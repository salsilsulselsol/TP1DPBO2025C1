import java.util.Scanner;

// Class Main untuk menjalankan program
public class Main {
    public static void main(String[] args) {
        Petshop.Menu menu = new Petshop.Menu();
        Scanner scanner = new Scanner(System.in);
        int pilihan = 0;

        // Loop untuk menampilkan menu dan memproses pilihan user
        while (pilihan != 6) {
            System.out.println("\nMenu:");
            System.out.println("1. Tambah Data");
            System.out.println("2. Tampilkan Data");
            System.out.println("3. Ubah Data");
            System.out.println("4. Hapus Data");
            System.out.println("5. Cari Data");
            System.out.println("6. Keluar");
            System.out.print("Pilih: ");
            pilihan = scanner.nextInt();

            // Switch case untuk memproses pilihan user
            switch (pilihan) {
                case 1 -> menu.create();
                case 2 -> menu.print();
                case 3 -> menu.update();
                case 4 -> menu.delete();
                case 5 -> menu.search();
                case 6 -> System.out.println("Keluar dari program.");
                default -> System.out.println("Pilihan tidak valid. Silakan coba lagi.");
            }
        }
    }
}