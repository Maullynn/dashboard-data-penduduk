# Dashboard Data Penduduk

Dashboard Data Penduduk adalah sebuah aplikasi berbasis web yang digunakan untuk mengelola dan menampilkan data penduduk di RT 011. Aplikasi ini dilengkapi dengan fitur untuk menambah, mengedit, dan menghapus data penduduk. Selain itu, aplikasi ini juga memiliki tampilan statistik dan tabel yang interaktif.

## Fitur Utama

1. Tampilan Statistik:
   - Menampilkan total penduduk.
   - Menampilkan jumlah penduduk berdasarkan jenis kelamin (laki-laki dan perempuan).
2. Manajemen Data Penduduk:
   - Tambah data penduduk.
   - Edit data penduduk.
   - Hapus data penduduk.
3. Tabel Interaktif:
   - Mendukung pencarian, penyortiran, dan paginasi.
   - Menggunakan DataTables untuk meningkatkan pengalaman pengguna.

## Teknologi yang Digunakan

- Backend: PHP dengan PDO untuk koneksi ke database.
- Frontend: HTML, CSS, Bootstrap 5, Font Awesome.
- Database: MySQL.
- Library Tambahan:
  - DataTables untuk tabel interaktif.
  - JQuery untuk manipulasi DOM.

## Instalasi

1. Clone repository ini ke komputer Anda:
   ```bash
   git clone https://github.com/Maullynn/dashboard-data-penduduk.git
   ```

2. Import file database:
   - Masuk ke phpMyAdmin atau tool manajemen database lainnya.
   - Buat database baru, misalnya `dashboard_penduduk`.
   - Import file SQL yang disertakan dalam repository ini (pastikan nama tabel sesuai dengan struktur database di aplikasi).

3. Konfigurasi file `db.php`:
   - Pastikan file `db.php` memiliki konfigurasi berikut:
     ```php
     <?php
     $host = 'localhost';
     $dbname = 'dashboard_penduduk';
     $username = 'root'; // Sesuaikan dengan username MySQL Anda
     $password = ''; // Sesuaikan dengan password MySQL Anda

     try {
         $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } catch (PDOException $e) {
         die("Database connection failed: " . $e->getMessage());
     }
     ```

4. Jalankan aplikasi:
   - Pindahkan semua file ke folder server lokal Anda (misalnya, di folder `htdocs` untuk XAMPP).
   - Akses aplikasi melalui browser, contohnya: `http://localhost/dashboard-data-penduduk`.

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan fork repository ini dan ajukan pull request. Kami menyambut semua saran dan perbaikan.

## Lisensi

Proyek ini menggunakan lisensi [MIT License](https://opensource.org/licenses/MIT). Anda bebas menggunakan, memodifikasi, dan mendistribusikan proyek ini selama menyertakan hak cipta asli.

## git clone
https://github.com/Maullynn/dashboard-data-penduduk.git
