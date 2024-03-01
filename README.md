# Yuzushi Gift Store
Aplikasi ini merupakan contoh project uji kompetensi program keahlian Rekayasa Perangkat Lunak tahun 2023/2024. Aplikasi ini adalah sistem kasir untuk toko souvenir yang memungkinkan pengguna untuk melakukan interaksi transaksi dengan lebih efisien

# Fitur 
1. Manajemen data pengguna (Petugas, Admin)
2. Manajemen data produk
3. Manajemen data satuan dan kategori produk
4. Transaksi penjualan dan pembayaran
5. Laporan dan cetak laporan stok barang

# Teknologi yang Digunakan
1. Codeigniter 4 : Framework PHP
2. PHP : Bahasa pemrograman open-source yang digunakan untuk mengembangkan aplikasi web
3. mySQL : Sistem manajemen basis data (DBMS) untuk menyimpan data-data pengguna, produk, transaksi penjualan
4. Bootstrap : Framework CSS untuk sisi desain
5. JQueryMask : Library JavaScript untuk menampilkan format mata uang
6. Select 2 :  Library JavaScript yang memungkinkan pembuatan dropdown yang lebih interaktif di halaman web

# Download dan Instalasi
1. Jalankan CMD / Terminal
2. Masuk ke drive D: atau yang lain jika di linux silahkan masuk direktori mana saja
3. Jalankan perintah : 
    <code>
    git clone https://github.com/AisyahRslia1210/aplikasi-kasirAis.git
    </code>
4. Lakukan update dengan perintah 
   composer update
5. Ganti file env menjadi .env
6. Setting :
   <code> 
   CI_ENVIRONMENT = development atau production
   
   app.baseURL = 'http://localhost:8080'

   database.default.hostname = localhost
   database.default.database = db_kasiryuzu
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
    </code>
# Menjalankan aplikasi
1. Buka terminal
2. Jalankan perintah
   php spark serve
3. Buka browser, akses URL
   http://localhost:8080
4. Email Admin : ais@gmail.com dan password : 123
5. Email Petugas : gojo@gmail.com dan password : 123
