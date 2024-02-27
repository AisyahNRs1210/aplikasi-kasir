<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// login
$routes->get('/dashboard', 'Home::realDashboard',['filter'=>'autentifikasi']);
// $routes->post('/blank-dashboard', 'Home::dashboard',['filter'=>'autentifikasi']);
$routes->get('/form-login', 'User::login');
$routes->post('/form-login', 'User::login');
$routes->get('/blank-dashboard', 'Home::dashboard',['filter'=>'autentifikasi']);
$routes->get('/logout', 'User::logout');



// registrasi
$routes->get('/form-registrasi', 'User::registrasi');
$routes->post('/form-registrasi', 'User::registrasi');

// user
$routes->get('/list-user', 'User::tampilUser',['filter'=>'autentifikasi']);
$routes->get('/tambah-user', 'User::formtambah',['filter'=>'autentifikasi']);
$routes->post('/tambah-user', 'User::tambah',['filter'=>'autentifikasi']);
$routes->get('/hapus-user/(:any)', 'User::hapus/$1',['filter'=>'autentifikasi']);
$routes->get('/edit-user/(:any)', 'User::edit/$1',['filter'=>'autentifikasi']);
$routes->post('/edit-user/(:any)', 'User::update',['filter'=>'autentifikasi']);
$routes->get('/edit-password/(:any)', 'User::editpassUser/$1',['filter'=>'autentifikasi']);
$routes->post('/edit-password/(:any)', 'User::updatepassUser/$1',['filter'=>'autentifikasi']);

$routes->get('edit-password', 'User::editpassUser',['filter'=>'autentifikasi']);
$routes->post('edit-password', 'User::updatepassUser',['filter'=>'autentifikasi']);


// kategori
$routes->get('/list-kategori', 'Kategori::tampilkategori',['filter'=>'autentifikasi']);
$routes->get('/hapus-kategori/(:num)', 'kategori::hapus/$1',['filter'=>'autentifikasi']);
$routes->get('/list-kategori', 'Kategori::formtambah',['filter'=>'autentifikasi']);
$routes->post('/list-kategori', 'Kategori::tambah',['filter'=>'autentifikasi']);
$routes->get('/edit-kategori/(:num)', 'Kategori::edit/$1',['filter'=>'autentifikasi']);
$routes->post('/edit-kategori', 'Kategori::update',['filter'=>'autentifikasi']);

// Satuan
$routes->get('/list-satuan', 'Satuan::tampilsatuan',['filter'=>'autentifikasi']);
$routes->get('/hapus-satuan/(:num)', 'Satuan::hapus/$1',['filter'=>'autentifikasi']);
$routes->get('/list-satuan', 'Satuan::formtambah',['filter'=>'autentifikasi']);
$routes->post('/list-satuan', 'Satuan::tambah',['filter'=>'autentifikasi']);
$routes->get('/edit-satuan/(:num)', 'Satuan::edit/$1',['filter'=>'autentifikasi']);
$routes->post('/edit-satuan', 'Satuan::update',['filter'=>'autentifikasi']);

//  Produk
$routes->get('/list-produk', 'Produk::tampilProduk',['filter'=>'autentifikasi']);
$routes->get('/tambah-produk', 'Produk::formTambah',['filter'=>'autentifikasi']);
$routes->post('/tambah-produk', 'Produk::tambah',['filter'=>'autentifikasi']);
$routes->get('/hapus-produk/(:num)', 'Produk::hapus/$1',['filter'=>'autentifikasi']);
$routes->get('/edit-produk/(:num)', 'Produk::edit/$1',['filter'=>'autentifikasi']);
$routes->post('/edit-produk/(:num)', 'Produk::update',['filter'=>'autentifikasi']);

// penjualan
// $routes->get('/form-penjualan', 'Penjualan::tampilkanFormPenjualan');
$routes->post('/form-penjualan/savePenjualan', 'Penjualan::savePenjualan',['filter'=>'autentifikasi']);
// $routes->post('/form-penjualan', 'Penjualan::simpanPenjualan');


//pembayaran
$routes->get('/form-penjualan/savePembayaran', 'Penjualan::savePembayaran',['filter'=>'autentifikasi']);
// $routes->post('/form-penjualan/savePembayaran', 'Penjualan::savePembayaran');


// laporan
$routes->get('/stok-barang','Laporan::tampilStok',['filter'=>'autentifikasi']);
$routes->get('/pdf/generate', 'Laporan::generate',['filter'=>'autentifikasi']);
// Route untuk menampilkan formulir input
$routes->get('/input-laporanpenjualan', 'Laporan::tampilLaporanPenjualan');

// Route untuk mengirimkan data formulir dan menghasilkan laporan
$routes->post('/generate-laporan', 'Laporan::generate_laporan');

// Dari Nay
$routes->get('/form-penjualan','Penjualan::lihatPenjualan',['filter'=>'autentifikasi']);
$routes->post('/form-penjualan','Penjualan::savePenjualan',['filter'=>'autentifikasi']);
$routes->get('/form-bayar','Penjualan::simpanPembayaran',['filter'=>'autentifikasi']);
$routes->post('/form-penjualan/savePembayaran','Penjualan::savePembayaran',['filter'=>'autentifikasi']);
$routes->get('/hapus-barang/(:num)', 'Penjualan::hapus/$1',['filter'=>'autentifikasi']);


