-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2024 at 05:03 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasiryuzu`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_kategori` (IN `namaNya` VARCHAR(50))   SELECT * FROM tbl_kategori WHERE nama_kategori LIKE CONCAT ('%',namaNya,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_produk` (IN `namaNya` VARCHAR(100))   SELECT 
	   tbl_produk.kode_produk,
       tbl_produk.nama_produk,
       tbl_produk.harga_beli,
       tbl_produk.harga_jual,
       tbl_satuan.nama_satuan,
       tbl_kategori.nama_kategori,
       tbl_produk.stok
FROM tbl_produk
JOIN tbl_satuan ON tbl_satuan.kode_satuan=tbl_produk.kode_satuan
JOIN tbl_kategori ON tbl_kategori.kode_kategori=tbl_produk.kode_kategori
WHERE nama_produk LIKE concat('%',namaNya,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_satuan` (IN `namaNya` VARCHAR(50))   SELECT * FROM tbl_satuan WHERE nama_satuan LIKE CONCAT ('%',namaNya,'%')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_user` (IN `namaNya` VARCHAR(100))   SELECT tbl_user.email,
	   tbl_user.nama_user,
       tbl_user.role,
       tbl_user.status
FROM tbl_user
WHERE nama_user LIKE concat("%",namaNya,"%")$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detail_kategori` (IN `idNya` INT)   SELECT * FROM tbl_kategori WHERE kode_kategori=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detail_produk` (IN `idNya` INT)   SELECT * FROM tbl_produk where id_produk=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detail_satuan` (IN `idNya` INT)   SELECT * FROM tbl_satuan WHERE kode_satuan=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detail_user` (IN `emailNya` VARCHAR(255))   SELECT tbl_user.email,
	   tbl_user.nama_user,
       tbl_user.password,
       tbl_user.role,
       tbl_user.status
FROM tbl_user
WHERE email=emailNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_detailpenjualan` (IN `idNya` INT)   DELETE FROM tbl_detailpenjualan WHERE kode_detailpenjualan=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_kategori` (IN `idNya` INT)   DELETE FROM tbl_kategori WHERE kode_kategori=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_produk` (IN `idNya` INT)   DELETE FROM tbl_produk WHERE id_produk=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_satuan` (IN `idNya` INT)   DELETE FROM tbl_satuan WHERE kode_satuan=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_user` (IN `emailNya` VARCHAR(255))   DELETE FROM tbl_user WHERE email=emailNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `laporan_stok` ()   SELECT tbl_produk.nama_produk,
	   tbl_produk.harga_jual,
       tbl_produk.harga_beli,
       tbl_produk.stok,
       tbl_satuan.nama_satuan
FROM tbl_produk
JOIN tbl_satuan ON tbl_satuan.kode_satuan=tbl_produk.kode_satuan
ORDER BY tbl_produk.stok ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_daftartransaksi` ()   SELECT tbl_detailpenjualan.kode_detailpenjualan,
	   tbl_detailpenjualan.kode_penjualan,
       tbl_produk.nama_produk,
       tbl_detailpenjualan.qty,
       tbl_detailpenjualan.diskon,
       tbl_detailpenjualan.total_harga
FROM tbl_detailpenjualan
JOIN tbl_produk ON tbl_produk.id_produk=tbl_detailpenjualan.id_produk$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_detail` ()   SELECT tbl_detailpenjualan.kode_detailpenjualan,
tbl_penjualan.no_faktur,
tbl_produk.nama_produk,
        tbl_detailpenjualan.qty,
        tbl_detailpenjualan.total_harga
FROM tbl_detailpenjualan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_detailProduk` ()   SELECT tbl_produk.id_produk,
	   tbl_produk.kode_produk,
       tbl_produk.nama_produk,
       tbl_produk.harga_beli,
       tbl_produk.harga_jual,
       tbl_satuan.nama_satuan,
       tbl_kategori.nama_kategori,
       tbl_produk.stok
FROM tbl_produk
JOIN tbl_satuan ON tbl_satuan.kode_satuan=tbl_produk.kode_satuan
JOIN tbl_kategori ON tbl_kategori.kode_kategori=tbl_produk.kode_kategori
WHERE tbl_produk.stok > 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_kategori` ()   SELECT * FROM tbl_kategori$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_produk` ()   SELECT tbl_produk.id_produk,
	   tbl_produk.kode_produk,
       tbl_produk.nama_produk,
       tbl_produk.harga_beli,
       tbl_produk.harga_jual,
       tbl_satuan.nama_satuan,
       tbl_kategori.nama_kategori,
       tbl_produk.stok
FROM tbl_produk
JOIN tbl_satuan ON tbl_satuan.kode_satuan=tbl_produk.kode_satuan
JOIN tbl_kategori ON tbl_kategori.kode_kategori=tbl_produk.kode_kategori$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_satuan` ()   SELECT * FROM tbl_satuan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_supplier` ()   SELECT tbl_supplier.nama_supplier,
	   tbl_supplier.alamat_supplier,
       tbl_supplier.wa_supplier
FROM tbl_supplier$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihat_user` ()   SELECT tbl_user.email,
	   tbl_user.nama_user, 
       tbl_user.role,
       tbl_user.status
FROM tbl_user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `simpan_pembayaran` (IN `p_id_penjualan` INT)   BEGIN
    -- Hapus data sesi pembelian berdasarkan ID penjualan
    DELETE FROM penjualan WHERE kode_penjualan = p_id_penjualan;
    DELETE FROM detail_penjualan WHERE kode_penjualan = p_id_penjualan;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `simpan_penjualan` (IN `p_no_faktur` VARCHAR(255), IN `p_tgl_penjualan` DATETIME, IN `p_email` VARCHAR(255), IN `p_total` DECIMAL(10,2), IN `p_id_produk` INT, IN `p_qty` INT)   BEGIN
    -- Menyimpan data penjualan
    INSERT INTO penjualan (no_faktur, tgl_penjualan, email, total) 
    VALUES (p_no_faktur, p_tgl_penjualan, p_email, p_total);
    
    -- Menyimpan detail penjualan
    INSERT INTO detail_penjualan (kode_penjualan, id_produk, qty, total_harga) 
    VALUES (LAST_INSERT_ID(), p_id_produk, p_qty, (SELECT harga_jual FROM produk WHERE id_produk = p_id_produk) * p_qty);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_kategori` (IN `namaNya` VARCHAR(50))   INSERT INTO tbl_kategori (nama_kategori) VALUES (namaNya)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_penjualan` (IN `fakturNya` VARCHAR(50), IN `emailNya` VARCHAR(255), IN `produkNya` INT, IN `qtyNya` INT)   BEGIN
    DECLARE id_penjualan INT;

    -- Simpan data ke tbl_penjualan
    INSERT INTO tbl_penjualan (tgl_penjualan, no_faktur, email)
    VALUES (NOW(), fakturNya, emailNya);

    -- Dapatkan ID penjualan yang baru saja disimpan
    SELECT LAST_INSERT_ID() INTO id_penjualan;

    -- Simpan detail penjualan ke tbl_detailpenjualan
    INSERT INTO tbl_detailpenjualan (kode_penjualan, id_produk, qty)
    VALUES (id_penjualan, produkNya, qtyNya);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_produk` (IN `kodeNya` VARCHAR(25), IN `namaNya` VARCHAR(100), IN `beliNya` INT, IN `jualNya` INT, IN `satuanNya` INT, IN `kategoriNya` INT, IN `stokNya` INT)   INSERT INTO tbl_produk (kode_produk, nama_produk, harga_beli, harga_jual,
                        kode_satuan, kode_kategori, stok)
VALUES (kodeNya, namaNya, beliNya, jualNya, satuanNya, kategoriNya, stokNya)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_satuan` (IN `namaNya` VARCHAR(50))   INSERT INTO tbl_satuan (nama_satuan) VALUES (namaNya)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_supplier` (IN `namaNya` VARCHAR(150), IN `alamatNya` MEDIUMTEXT, IN `waNya` VARCHAR(20))   INSERT INTO tbl_supplier (nama_supplier, alamat_supplier, wa_supplier)
VALUES (namaNya, alamatNya, waNya)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_user` (IN `emailNya` VARCHAR(255), IN `namaNya` VARCHAR(100), IN `passwordNya` VARCHAR(60), IN `roleNya` ENUM('admin','petugas'))   INSERT INTO tbl_user (email, nama_user, password, role, status)
    VALUES (emailNya, namaNya, md5(passwordNya), roleNya, 'aktif')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_kategori` (IN `idNya` INT, IN `namaNya` VARCHAR(50))   UPDATE tbl_kategori SET nama_kategori=namaNya WHERE kode_kategori=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_produk` (IN `idNya` INT, IN `kodeNya` VARCHAR(25), IN `namaNya` VARCHAR(100), IN `beliNya` INT, IN `jualNya` INT, IN `satuanNya` INT, IN `kategoriNya` INT, IN `stokNya` INT)   UPDATE tbl_produk SET kode_produk=kodeNya,
					  nama_produk=namaNya,
                      harga_beli=beliNya,
                      harga_jual=jualNya,
                      kode_satuan=satuanNya,
                      kode_kategori=kategoriNya,
                      stok=stokNya
WHERE id_produk=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_satuan` (IN `idNya` INT, IN `namaNya` VARCHAR(50))   UPDATE tbl_satuan SET nama_satuan=namaNya WHERE kode_satuan=idNya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user` (IN `emailNya` VARCHAR(255), IN `roleNya` ENUM('admin','petugas'), IN `statusNya` ENUM('aktif','nonaktif'))   UPDATE tbl_user set role=roleNya, status=statusNya WHERE email=emailNya$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detailpenjualan`
--

CREATE TABLE `tbl_detailpenjualan` (
  `kode_detailpenjualan` int NOT NULL,
  `kode_penjualan` int NOT NULL,
  `id_produk` int NOT NULL,
  `qty` int NOT NULL,
  `diskon` int DEFAULT NULL,
  `total_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_detailpenjualan`
--

INSERT INTO `tbl_detailpenjualan` (`kode_detailpenjualan`, `kode_penjualan`, `id_produk`, `qty`, `diskon`, `total_harga`) VALUES
(1, 1, 9, 3, NULL, 30000),
(2, 1, 9, 3, NULL, 30000),
(3, 1, 9, 3, NULL, 30000),
(4, 1, 13, 2, NULL, 150000),
(5, 2, 9, 1, NULL, 10000),
(6, 3, 9, 2, NULL, 20000),
(7, 3, 13, 2, NULL, 150000),
(8, 4, 9, 3, NULL, 30000),
(9, 5, 9, 2, NULL, 20000),
(10, 5, 10, 2, NULL, 48000),
(11, 5, 9, 2, NULL, 20000),
(12, 5, 11, 1, NULL, 15000),
(13, 5, 10, 1, NULL, 24000),
(14, 5, 13, 1, NULL, 75000),
(15, 5, 13, 1, NULL, 75000),
(16, 5, 13, 3, NULL, 225000),
(17, 5, 13, 3, NULL, 225000),
(18, 5, 13, 3, NULL, 225000),
(19, 5, 13, 3, NULL, 225000),
(20, 5, 13, 3, NULL, 225000),
(21, 5, 13, 3, NULL, 225000),
(22, 5, 13, 3, NULL, 225000),
(23, 5, 13, 3, NULL, 225000),
(24, 5, 13, 3, NULL, 225000),
(25, 5, 13, 3, NULL, 225000),
(26, 5, 13, 3, NULL, 225000),
(27, 5, 13, 3, NULL, 225000),
(28, 5, 13, 3, NULL, 225000),
(29, 5, 13, 3, NULL, 225000),
(30, 5, 13, 3, NULL, 225000),
(31, 5, 13, 3, NULL, 225000),
(32, 5, 13, 3, NULL, 225000),
(33, 5, 13, 3, NULL, 225000),
(34, 5, 13, 3, NULL, 225000),
(35, 6, 9, 2, NULL, 20000),
(36, 7, 10, 2, NULL, 48000),
(37, 7, 9, 2, NULL, 20000),
(38, 7, 11, 2, NULL, 30000),
(39, 8, 13, 1, NULL, 75000),
(40, 8, 9, 9, NULL, 90000),
(41, 9, 13, 2, NULL, 150000),
(42, 9, 10, 3, NULL, 72000),
(43, 9, 13, 4, NULL, 300000),
(44, 10, 9, 4, NULL, 40000),
(45, 11, 11, 1, NULL, 15000),
(46, 11, 9, 9, NULL, 90000),
(47, 12, 9, 3, NULL, 30000),
(50, 13, 10, 3, NULL, 72000),
(52, 13, 9, 1, NULL, 10000),
(53, 14, 9, 2, NULL, 20000),
(54, 14, 10, 2, NULL, 48000),
(55, 15, 9, 2, NULL, 20000),
(56, 15, 10, 3, NULL, 72000),
(57, 16, 9, 4, NULL, 40000),
(58, 16, 11, 2, NULL, 30000),
(59, 16, 10, 3, NULL, 72000),
(61, 17, 9, 2, NULL, 20000),
(62, 17, 10, 3, NULL, 72000),
(63, 18, 10, 10, NULL, 240000),
(64, 19, 10, 1, NULL, 24000),
(65, 20, 10, 2, NULL, 48000),
(66, 21, 10, 1, NULL, 24000),
(67, 21, 11, 2, NULL, 30000),
(68, 21, 11, 3, NULL, 45000),
(69, 22, 9, 4, NULL, 40000),
(71, 24, 9, 1, NULL, 10000),
(72, 25, 11, 2, NULL, 30000),
(73, 26, 10, 1, NULL, 24000),
(74, 26, 13, 2, NULL, 150000),
(75, 26, 9, 4, NULL, 40000),
(76, 27, 10, 2, NULL, 48000),
(77, 27, 9, 1, NULL, 10000),
(78, 27, 10, 10, NULL, 240000),
(79, 28, 10, 3, NULL, 72000),
(80, 28, 13, 1, NULL, 75000),
(81, 29, 13, 2, NULL, 150000),
(82, 29, 9, 1, NULL, 10000),
(83, 30, 10, 1, NULL, 24000),
(84, 30, 9, 1, NULL, 10000),
(85, 31, 9, 1, NULL, 10000),
(86, 31, 13, 1, NULL, 75000),
(87, 32, 10, 9, NULL, 216000),
(88, 32, 9, 3, NULL, 30000),
(89, 33, 9, 1, NULL, 10000),
(90, 33, 11, 2, NULL, 30000),
(91, 33, 10, 1, NULL, 24000);

--
-- Triggers `tbl_detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `increase_stock_after_delete_detailpenjualan` AFTER DELETE ON `tbl_detailpenjualan` FOR EACH ROW BEGIN
    DECLARE product_stock INT;
    DECLARE new_stock INT;
    
    -- Ambil stok produk
    SELECT stok INTO product_stock FROM tbl_produk WHERE id_produk = OLD.id_produk;
    
    -- Hitung stok baru setelah pengembalian penjualan
    SET new_stock = product_stock + OLD.qty;
    
    -- Update stok produk
    UPDATE tbl_produk SET stok = new_stock WHERE id_produk = OLD.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduce_stock_after_insert_detailpenjualan` AFTER INSERT ON `tbl_detailpenjualan` FOR EACH ROW BEGIN
    DECLARE product_stock INT;
    DECLARE new_stock INT;
    
    -- Ambil stok produk
    SELECT stok INTO product_stock FROM tbl_produk WHERE id_produk = NEW.id_produk;
    
    -- Hitung stok baru setelah penjualan
    SET new_stock = product_stock - NEW.qty;
    
    -- Update stok produk
    UPDATE tbl_produk SET stok = new_stock WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kode_kategori` int NOT NULL,
  `nama_kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kode_kategori`, `nama_kategori`) VALUES
(8, 'Skincare'),
(12, 'Make Up'),
(15, 'Aksesoris'),
(25, 'Barang Pecah Belah'),
(28, 'Aksesoris kecantikan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelianbarang`
--

CREATE TABLE `tbl_pembelianbarang` (
  `kode_pembelian` int NOT NULL,
  `no_faktur` int NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `kode_barang` int NOT NULL,
  `id_supplier` int NOT NULL,
  `jumlah_barang` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `total_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `kode_penjualan` int NOT NULL,
  `tgl_penjualan` datetime NOT NULL,
  `no_faktur` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `grand_total` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`kode_penjualan`, `tgl_penjualan`, `no_faktur`, `grand_total`, `email`) VALUES
(1, '2024-02-26 08:55:46', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(2, '2024-02-26 08:59:54', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(3, '2024-02-26 09:01:53', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(4, '2024-02-26 09:09:21', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(5, '2024-02-26 09:10:13', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(6, '2024-02-26 11:48:40', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(7, '2024-02-26 13:39:16', 'INV-20240226-01', 0, 'kiyotaka@gmail.com'),
(8, '2024-02-26 20:45:59', 'INV-202402260007', 0, 'ais@gmail.com'),
(9, '2024-02-26 20:49:01', 'INV-202402260008', 0, 'ais@gmail.com'),
(10, '2024-02-26 20:58:45', 'INV-202402260009', 0, 'ais@gmail.com'),
(11, '2024-02-26 21:00:58', 'INV-202402260010', 0, 'ais@gmail.com'),
(12, '2024-02-26 21:35:44', 'INV-202402260011', 0, 'ais@gmail.com'),
(13, '2024-02-26 21:52:08', 'INV-202402260012', 0, 'ais@gmail.com'),
(14, '2024-02-26 23:15:12', 'INV-202402260013', 0, 'ais@gmail.com'),
(15, '2024-02-26 23:18:54', 'INV-202402260014', 0, 'ais@gmail.com'),
(16, '2024-02-26 23:21:17', 'INV-202402260015', 0, 'ais@gmail.com'),
(17, '2024-02-27 02:02:42', 'INV-202402270016', 0, 'ais@gmail.com'),
(18, '2024-02-27 02:33:46', 'INV-202402270017', 0, 'ais@gmail.com'),
(19, '2024-02-27 02:55:57', 'INV-202402270018', 549000, 'ais@gmail.com'),
(20, '2024-02-27 03:04:18', 'INV-202402270019', 0, 'ais@gmail.com'),
(21, '2024-02-27 03:04:58', 'INV-202402270020', 573000, 'ais@gmail.com'),
(22, '2024-02-27 03:11:18', 'INV-202402270021', 672000, 'ais@gmail.com'),
(23, '2024-02-27 03:11:39', 'INV-202402270022', 712000, 'ais@gmail.com'),
(24, '2024-02-27 03:13:11', 'INV-202402270023', 742000, 'ais@gmail.com'),
(25, '2024-02-27 03:14:56', 'INV-202402270024', 742000, 'ais@gmail.com'),
(26, '2024-02-27 03:17:13', 'INV-202402270025', 0, 'ais@gmail.com'),
(27, '2024-02-27 03:19:56', 'INV-202402270026', 298000, 'ais@gmail.com'),
(28, '2024-02-27 03:24:55', 'INV-202402270027', 147000, 'ais@gmail.com'),
(29, '2024-02-27 03:48:00', 'INV-202402270028', 160000, 'ais@gmail.com'),
(30, '2024-02-27 04:16:44', 'INV-202402270029', 34000, 'ais@gmail.com'),
(31, '2024-03-01 17:12:46', 'INV-202403010030', 85000, 'ais@gmail.com'),
(32, '2024-03-01 19:26:10', 'INV-202403010031', 246000, 'ais@gmail.com'),
(33, '2024-03-01 22:37:16', 'INV-202403010032', 64000, 'ais@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int NOT NULL,
  `kode_produk` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `kode_satuan` int NOT NULL,
  `kode_kategori` int NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `kode_satuan`, `kode_kategori`, `stok`) VALUES
(9, 'BRG0001', 'Jepit Rambut', 7000, 10000, 4, 15, 1),
(10, 'BRG0002', 'Lip Cream Hanasui 06', 23000, 24000, 4, 12, 6),
(11, 'BRG0003', 'Cermin', 13000, 15000, 4, 15, 11),
(13, 'BRG0004', 'Vas Bunga', 50000, 75000, 2, 25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `kode_satuan` int NOT NULL,
  `nama_satuan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`kode_satuan`, `nama_satuan`) VALUES
(2, 'Box'),
(4, 'pcs'),
(7, 'Lembar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int NOT NULL,
  `nama_supplier` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_supplier` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `wa_supplier` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `wa_supplier`) VALUES
(1, 'CV BERKAH JAYA', 'Kuningan', '08689938329');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`email`, `nama_user`, `password`, `role`, `status`) VALUES
('ais@gmail.com', 'Yuzushi Aishi', 'c6f057b86584942e415435ffb1fa93d4', 'admin', 'aktif'),
('gojo@gmail.com', 'Gojo Satoru', '202cb962ac59075b964b07152d234b70', 'petugas', 'aktif'),
('kiyotaka@gmail.com', 'Kiyotaka Ayanokouji', '202cb962ac59075b964b07152d234b70', 'admin', 'aktif'),
('nagi@gmail.com', 'Nagi Seishiro', '202cb962ac59075b964b07152d234b70', 'petugas', 'nonaktif'),
('reo@gmail.com', 'Reo', '202cb962ac59075b964b07152d234b70', 'admin', 'aktif'),
('tojifushiguro@gmail.com', 'Toji Fushiguro', '202cb962ac59075b964b07152d234b70', 'admin', 'nonaktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_detailpenjualan`
--
ALTER TABLE `tbl_detailpenjualan`
  ADD PRIMARY KEY (`kode_detailpenjualan`),
  ADD KEY `kode_penjualan` (`kode_penjualan`),
  ADD KEY `kode_produk` (`id_produk`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `tbl_pembelianbarang`
--
ALTER TABLE `tbl_pembelianbarang`
  ADD PRIMARY KEY (`kode_pembelian`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`kode_penjualan`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `kode_satuan` (`kode_satuan`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`kode_satuan`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detailpenjualan`
--
ALTER TABLE `tbl_detailpenjualan`
  MODIFY `kode_detailpenjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `kode_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_pembelianbarang`
--
ALTER TABLE `tbl_pembelianbarang`
  MODIFY `kode_pembelian` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `kode_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `kode_satuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
