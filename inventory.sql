-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Okt 2021 pada 04.05
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `status` int(5) NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `date_update` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `tgl`, `merk`, `style`, `model`, `jumlah`, `customer`, `keterangan`, `status`, `date_create`, `date_update`) VALUES
(1, '2021-10-14', 'adsa', 'adasd', 'adsa', '2123', 'Adul', 'asdsad', 0, '1633767823741', '1633771597738'),
(2, '2021-10-10', 'Adidas', 'Kaos', 'Jersey', '100', 'Adul', 'Syawal yang bayar', 1, '1633768209848', '1633830824506'),
(3, '2021-10-09', 'asds', 'asdas', 'adas', '727272', 'adas', 'asdas', 0, '1633768285300', '1633787057555'),
(4, '2021-10-23', 'asds', 'asdasd', 'adasd', '2121', 'Syawal', 'adsa', 0, '1633768339039', '1633782300047'),
(5, '2021-10-09', 'sadas', 'adsa', 'adsad', '2121', 'asdasd', 'adsa', 0, '1633768458036', ''),
(6, '2021-10-11', 'Nike', 'Baju', 'YTY', '100', 'Vigo', 'Rafi yang bayar katanya', 1, '1633831372798', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `cmt` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `status` int(5) NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `date_update` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `tgl`, `merk`, `style`, `model`, `jumlah`, `cmt`, `keterangan`, `status`, `date_create`, `date_update`) VALUES
(1, '2021-10-09', 'adas', 'adas', 'adas', '221', 'dasd', 'asdasd', 0, '1633744992299', ''),
(2, '2021-10-09', 'adsas', 'adas', 'ada', '21', 'sadas', 'adsa', 0, '1633745322324', ''),
(3, '2021-10-09', 'Nano Nano', 'Permen', 'Permen 2', '2121', '2212', 'Yg bayar adul', 1, '1633752487836', '1633766264555'),
(4, '2021-10-09', '222', '12', '122', '212', '122', '2212', 1, '1633752586288', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pbl_aksesoris`
--

CREATE TABLE `pbl_aksesoris` (
  `id_pbl_aksesoris` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `no_faktur` varchar(100) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `jenis_aksesoris` varchar(100) NOT NULL,
  `kd_aksesoris` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `status` int(5) NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `date_update` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pbl_aksesoris`
--

INSERT INTO `pbl_aksesoris` (`id_pbl_aksesoris`, `nama_supplier`, `no_faktur`, `tgl`, `jenis_aksesoris`, `kd_aksesoris`, `qty`, `harga`, `keterangan`, `status`, `date_create`, `date_update`) VALUES
(6, 'Cola', '32121', '2021-10-08', 'Minuman', 'TYUU', '123', '21222121', 'Habisin', 0, '1633663109212', '1633774273051'),
(7, 'Fanta', '765', '2021-10-08', 'Minuman', 'RETE', '222', '1450000', 'Enak Mantap', 0, '1633663151033', ''),
(8, 'Alkohol Sisitipsi Lagu', '2222', '2021-10-09', 'Minuman', '2222', '2212', '2122212', 'Tak baik anak muda F', 0, '1633663196352', '1633686726200'),
(9, 'Juragan99', '211111', '2021-10-08', 'Minuman', 'TYUU', '56', '21122', 'adasdsad', 1, '1633663412418', '1633830791640'),
(10, 'adas', 'FGD', '2021-10-09', 'adas', 'w2w2', '7777', '22122', 'adas', 0, '1633686864743', '1633787555483');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pbl_bahan`
--

CREATE TABLE `pbl_bahan` (
  `id_pbl_bahan` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `kd_faktur` varchar(100) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `po_bahan` varchar(50) NOT NULL,
  `jenis_bahan` varchar(100) NOT NULL,
  `kd_bahan` varchar(100) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `date_create` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pbl_bahan`
--

INSERT INTO `pbl_bahan` (`id_pbl_bahan`, `nama_supplier`, `kd_faktur`, `tgl`, `po_bahan`, `jenis_bahan`, `kd_bahan`, `qty`, `harga`, `keterangan`, `status`, `date_create`) VALUES
(20, 'asd', 'asd', '2021-10-06', 'qdasd', 'asg', 'asa', '124', '12515', '', 0, '1633359358366'),
(51, 'Cola', '12345', '2021-10-08', '23 Hari', 'Beludru', '12321', '212', '21212', 'Nopal yang bayar 2 kali lipat Dan Adul', 1, '1633687494457'),
(52, 'Unilever', '1231', '2021-10-09', '12 Hari', 'Kain', 'KJKJ', '12', '1200000', 'ADASDSA', 0, '1633784019087');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `date_update` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tgl`, `merk`, `style`, `model`, `jumlah`, `customer`, `harga`, `discount`, `total`, `pembayaran`, `keterangan`, `status`, `date_create`, `date_update`) VALUES
(1, '2021-10-09', 'asdas', 'asdad', 'adas', 'dsads', 'ads', '212', '21', '212', '122', 'adasd', '0', '1633774229569', ''),
(2, '2021-10-16', 'Adidas', 'Jersey', 'Baju Olahraga', '20022', 'Adul', '1200000', '20', '1000000', '200000', 'Jangan Di Ambil', '0', '1633774922785', '1633783038289'),
(3, '2021-10-23', 'Adidas', 'Jersey', 'China', '21', 'Syawal', '1000000', '10', '900000', '2000000', 'Syawal yang bayar', '1', '1633775002913', '1633831066369'),
(4, '2021-10-16', 'Fafa', 'WW', 'Bikini', '212', 'adas', '2121', 'adas', '11212', '2112', 'adas', '0', '1633782670074', '1633831486354');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `id_srp` varchar(100) NOT NULL,
  `tgl` varchar(100) NOT NULL,
  `po_bahan_utama` varchar(100) NOT NULL,
  `po_bahan_kombinasi` varchar(100) NOT NULL,
  `jumlah_bahan_utama` varchar(100) NOT NULL,
  `jumlah_kombinasi` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `style` varchar(100) NOT NULL,
  `aksesoris` varchar(100) NOT NULL,
  `alamat_cutting` varchar(200) NOT NULL,
  `jml_hasil_cuting` varchar(100) NOT NULL,
  `alamat_produksi` varchar(200) NOT NULL,
  `biaya_cmt` varchar(100) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `status` int(5) NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `date_update` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `id_srp`, `tgl`, `po_bahan_utama`, `po_bahan_kombinasi`, `jumlah_bahan_utama`, `jumlah_kombinasi`, `merk`, `model`, `style`, `aksesoris`, `alamat_cutting`, `jml_hasil_cuting`, `alamat_produksi`, `biaya_cmt`, `keterangan`, `status`, `date_create`, `date_update`) VALUES
(1, 'sdasd', '2021-10-08', 'asdsa', 'asdsa', '212', '1212', 'sad', 'ad', 'sadssa', 'adas', 'sdas', 'aasd', 'asds', 'aasdsa', 'adsadsa', 0, '1633687315230', ''),
(2, '2918UU', '2021-10-08', 'Cocacola', '12 Hari', '55', '77', 'Channel', 'Kekinian', 'Anak Punk', 'Banyak', 'Bekasi', '12', 'Gundar', '21212121', 'Nopal yang bayar', 0, '1633687411405', '1633768703818'),
(3, '122121', '2021-10-08', 'adasd', 'adsa', '21', '212', 'adsa', 'sdas', 'adas', 'das', 'dadas', '2121', 'adsa', '2121', 'sdas', 0, '1633691124062', ''),
(4, '34121', '2021-10-14', 'dadsa', 'Fanta', '1212', '1212', 'asdas', 'ada', 'adas', 'adsa', 'adas', '1212', 'asdas', '1212', 'asdas', 0, '1633691681865', '1633707252545'),
(5, '2121 ', '2021-10-10', 'asdsad', 'asds', '12', '1221', 'asdas', 'adsa', 'asdas', 'sdas', 'adssa', '1221', 'adas', '1221', 'asdas', 1, '1633830269062', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indeks untuk tabel `pbl_aksesoris`
--
ALTER TABLE `pbl_aksesoris`
  ADD PRIMARY KEY (`id_pbl_aksesoris`);

--
-- Indeks untuk tabel `pbl_bahan`
--
ALTER TABLE `pbl_bahan`
  ADD PRIMARY KEY (`id_pbl_bahan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pbl_aksesoris`
--
ALTER TABLE `pbl_aksesoris`
  MODIFY `id_pbl_aksesoris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pbl_bahan`
--
ALTER TABLE `pbl_bahan`
  MODIFY `id_pbl_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
