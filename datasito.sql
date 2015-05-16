-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2015 at 10:39 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `datasito`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `pengguna_id` int(11) NOT NULL,
  `id_pegawai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`pengguna_id`, `id_pegawai`) VALUES
(123142, '');

-- --------------------------------------------------------

--
-- Table structure for table `analisis`
--

CREATE TABLE IF NOT EXISTS `analisis` (
`id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `skor` decimal(4,2) NOT NULL,
  `maloklusi_menurut_angka` decimal(4,2) NOT NULL,
  `diagnosis_rekomendasi` varchar(500) NOT NULL,
  `orto_id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `flag_mengirim` char(1) NOT NULL,
  `flag_menerima` char(1) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis`
--

INSERT INTO `analisis` (`id`, `pasien_id`, `skor`, `maloklusi_menurut_angka`, `diagnosis_rekomendasi`, `orto_id`, `foto`, `flag_mengirim`, `flag_menerima`, `waktu`, `pesan`) VALUES
(45, 5, '2.30', '2.10', 'pasien sakit hati', 123157, 'sdf', '2', '', '2015-05-16 04:17:53', ''),
(46, 5, '1.20', '1.10', 'halo saya cita', 123157, 'hai', '2', '', '2015-05-16 04:17:53', ''),
(53, 5, '1.20', '1.10', 'tes lagi nih wira', 123157, 'hai', '2', '', '2015-05-16 04:17:53', ''),
(57, 5, '1.20', '1.50', 'Giginya jelek bau busung jigong gila', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(58, 5, '1.30', '1.50', 'HALOOOOOOOOOOOOOOOOOO INI CITA GIGINYA JELEK DEH', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(59, 5, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(60, 5, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(61, 7, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(62, 8, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(63, 8, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(64, 10, '1.20', '2.10', 'adsa', 123157, 'n', '2', '', '2015-05-16 04:17:53', ''),
(65, 8, '1.20', '3.20', '1.2', 123157, 'n', '2', '', '2015-05-16 04:17:53', ''),
(66, 7, '1.20', '2.20', 'alalalalal', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(67, 31, '1.20', '1.10', 'HALOOOOO', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(68, 7, '1.20', '1.10', 'tes cete mau tidur', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(69, 27, '2.20', '1.10', 'tes cete mau tidur', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(70, 7, '2.20', '1.10', 'lalalallllllllllllllllllll', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(71, 19, '1.20', '1.10', 'tes cete mau tidur', 123157, 'hai', '2', '', '2015-05-16 04:17:53', ''),
(72, 8, '1.20', '3.20', 'baru banget', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(73, 8, '2.20', '1.10', 'tes', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(74, 7, '1.30', '4.10', 'vuhdsuhviuhdsvuhidvuhdvs', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(75, 7, '2.20', '1.10', 'tes diagnose', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(76, 27, '1.20', '3.20', 'dfsdlkfks', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(77, 28, '2.40', '4.10', 'saya lapar', 123157, '', '1', '1', '2015-05-16 04:17:53', ''),
(78, 28, '2.20', '3.00', 'fff', 123157, '', '2', '', '2015-05-16 04:17:53', ''),
(79, 19, '0.00', '0.00', '', 123157, '', '2', '', '2015-05-16 04:17:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `dokter_gigis`
--

CREATE TABLE IF NOT EXISTS `dokter_gigis` (
  `pengguna_id` int(11) NOT NULL,
  `kursus` varchar(20) NOT NULL,
  `pendidikan_dokter` varchar(20) NOT NULL,
  `alamat_prakitk` varchar(20) NOT NULL,
  `kode_pos` int(5) NOT NULL,
  `langitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter_gigis`
--

INSERT INTO `dokter_gigis` (`pengguna_id`, `kursus`, `pendidikan_dokter`, `alamat_prakitk`, `kode_pos`, `langitude`, `latitude`) VALUES
(123142, '', '', '', 0, '', ''),
(123154, 'Kursus mobil', 'SMA', 'tes', 222, '', ''),
(123155, 'Kursus mobil', 'SMA', 'lakdasda', 12345, '', ''),
(123157, 'orto', 's2', 'sawangan', 12345, '', ''),
(123158, 'Kursus mobil', 'SMA', '', 0, '', ''),
(123159, 'Kursus mobil', 'SMA', '', 0, '', ''),
(123161, 'Kursus mobil', 'SMA', '', 0, '', ''),
(123163, 'dsdd', 'sma', '', 0, '', ''),
(123164, 'ee', 'eee', '', 0, '', ''),
(123166, 'fff', 'ff', '', 0, '', ''),
(123167, 'Kursus mobil', 'SMA', '', 0, '', ''),
(123169, 'kursus', 'pendidikan', '', 0, '', ''),
(123176, 'Kursus gigi', 'SMA', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `drg_lains`
--

CREATE TABLE IF NOT EXISTS `drg_lains` (
  `pengguna_id` int(11) NOT NULL,
  `kursus_ortodonti` varchar(20) NOT NULL,
  `jadwal_praktik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drg_lains`
--

INSERT INTO `drg_lains` (`pengguna_id`, `kursus_ortodonti`, `jadwal_praktik`) VALUES
(123142, '', ''),
(123154, 'DMMDD', 'DKDKKD'),
(123155, 'jkjljkkl', 'jkljl'),
(123163, '', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `drg_ortodontis`
--

CREATE TABLE IF NOT EXISTS `drg_ortodontis` (
  `doktergigi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drg_ortodontis`
--

INSERT INTO `drg_ortodontis` (`doktergigi_id`) VALUES
(123154),
(123155),
(123157),
(123158),
(123166),
(123169),
(123176);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_jagas`
--

CREATE TABLE IF NOT EXISTS `jadwal_jagas` (
`id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` int(11) NOT NULL,
  `jam_selesai` int(11) NOT NULL,
  `drg_ortodonti_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_jagas`
--

INSERT INTO `jadwal_jagas` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `drg_ortodonti_id`, `admin_id`) VALUES
(17, 'Monday', 8, 12, 123158, 123142),
(18, 'Monday', 12, 16, 123154, 123142),
(19, 'Monday', 16, 20, 123157, 123142),
(20, 'Tuesday', 8, 12, 123157, 123142),
(21, 'Tuesday', 12, 16, 123157, 123142),
(22, 'Tuesday', 16, 20, 123157, 123142),
(23, 'Wednesday', 8, 12, 123157, 123142),
(24, 'Wednesday', 12, 16, 123157, 123142),
(25, 'Wednesday', 16, 20, 123157, 123142),
(26, 'Thursday', 8, 12, 123157, 123142),
(27, 'Thursday', 12, 16, 123157, 123142),
(28, 'Thursday', 16, 20, 123157, 123142),
(29, 'Friday', 8, 12, 123157, 123142),
(30, 'Friday', 12, 16, 123157, 123142),
(31, 'Friday', 16, 20, 123157, 123142),
(32, 'Saturday', 16, 20, 123157, 123142),
(33, 'Saturday', 16, 20, 123157, 123142),
(34, 'Saturday', 16, 20, 123157, 123142),
(35, 'Sunday', 16, 20, 123157, 123142),
(36, 'Sunday', 16, 20, 123157, 123142),
(37, 'Sunday', 16, 20, 123157, 123142);

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE IF NOT EXISTS `medical_records` (
`id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` int(11) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_gigi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mengirims`
--

CREATE TABLE IF NOT EXISTS `mengirims` (
  `waktu` timestamp NULL DEFAULT NULL,
`id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `umum_id` int(11) DEFAULT NULL,
  `orto_id` int(11) DEFAULT NULL,
  `pusat_id` int(11) DEFAULT NULL,
  `analisis_id` int(11) NOT NULL,
  `kandidat1` varchar(50) DEFAULT NULL,
  `kandidat2` varchar(50) DEFAULT NULL,
  `kandidat3` varchar(50) DEFAULT NULL,
  `kandidat4` varchar(50) DEFAULT NULL,
  `kandidat5` varchar(50) DEFAULT NULL,
  `pesan` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengirims`
--

INSERT INTO `mengirims` (`waktu`, `id`, `admin_id`, `umum_id`, `orto_id`, `pusat_id`, `analisis_id`, `kandidat1`, `kandidat2`, `kandidat3`, `kandidat4`, `kandidat5`, `pesan`) VALUES
(NULL, 58, NULL, 123154, NULL, 123157, 75, 'Cita Indraswari', NULL, NULL, NULL, NULL, NULL),
(NULL, 59, NULL, 123154, NULL, 123157, 76, 'jvvjgvgk', NULL, NULL, NULL, NULL, NULL),
('2015-03-31 17:00:00', 60, 123142, 123154, NULL, 123157, 77, 'Wira Bau', NULL, NULL, NULL, NULL, NULL),
('0000-00-00 00:00:00', 61, NULL, NULL, NULL, NULL, 79, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merawats`
--

CREATE TABLE IF NOT EXISTS `merawats` (
`id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `orto_id` int(11) DEFAULT NULL,
  `umum_id` int(11) DEFAULT NULL,
  `pusat_id` int(11) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE IF NOT EXISTS `pasiens` (
`id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `umur` tinyint(4) NOT NULL,
  `alamat_rumah` varchar(50) NOT NULL,
  `tinggi` decimal(5,2) NOT NULL,
  `berat` smallint(6) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `warga_negara` varchar(15) NOT NULL,
  `doktergigi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasiens`
--

INSERT INTO `pasiens` (`id`, `nama`, `tanggal_lahir`, `tempat_lahir`, `agama`, `umur`, `alamat_rumah`, `tinggi`, `berat`, `jenis_kelamin`, `warga_negara`, `doktergigi_id`) VALUES
(5, 'ganti lagi hihi haha', '0000-00-00', 'Permatasari ', 'agama', 17, 'halo', '393.20', 21, 'Perempuan', 'indo', 123142),
(7, 'tes baru', '2015-04-22', 'Palembang22', 'buddha', 21, 'Depok', '160.00', 87, 'Perempuan', 'Indonesia', 123142),
(8, 'lslalalallllllllllll', '2015-04-01', 'dmkdkd', 'dddddddddd', 12, 'e', '122.00', 122, 'Perempuan', 'indonesia', 123142),
(9, 'skskksks', '2015-04-01', 'sjsj', 'islam', 12, 'kddkd', '123.00', 12, 'Perempuan', 'Indonesia', 123142),
(10, 'skskksks', '2015-04-01', 'sjsj', 'islam', 12, 'kddkd', '123.00', 12, 'Perempuan', 'Indonesia', 123142),
(11, 'eeee', '2015-04-01', 'eeee', 'islam', 12, 'dddd', '123.00', 12, 'Perempuan', 'in\\\\', 123142),
(12, 'Bena Nadhira', '1994-08-18', 'Palembang', 'Islam', 20, 'Palembang', '165.00', 55, 'Perempuan', 'Indonesia', 123142),
(19, 'vbnm', '2015-04-29', 'nmbnm', '', 78, 'asd', '0.00', 0, '', '', 123155),
(21, 'nbnmbmn', '2015-05-06', 'aasdada', 'asdlad', 78, 'asd', '123.00', 132, 'Perempuan', 'asdlads', 123155),
(24, 'Wira Tania', '2015-04-02', 'Jakarta', 'Kristen', 12, 'jakarta', '122.00', 34, 'Perempuan', 'Indonesia', 123154),
(25, 'LALALLALALALALALLALA', '2015-04-03', 'semarang', 'agama', 45, 'lksdfjlkdsj', '45.00', 45, 'Laki-laki', 'Indonesia', 123154),
(26, 'Mahasiswa', '2015-04-01', 'cdkkdd', 'agama', 15, 'jakarta', '176.00', 87, 'Laki-laki', 'Indonesia', 123154),
(27, 'Chiesa Serena', '2015-04-03', 'Jakarta', 'agama', 16, 'jakarta', '212.20', 54, 'Perempuan', 'Indonesia', 123154),
(28, 'Calvin', '2015-04-06', 'ejejjee', 'islam', 14, 'lksdfjlkdsj', '122.00', 45, 'Perempuan', 'Indonesia', 123154),
(29, 'Mahasiswa Cantik', '2015-04-02', 'semarang', 'agama', 12, 'jakarta', '134.00', 123, 'Perempuan', 'Indonesia', 123155),
(30, 'Wira ganteng sekali', '2015-04-04', 'semarang', 'islam', 34, 'Surga', '167.00', 45, 'Laki-laki', 'Indonesia', 123155),
(31, 'Cita Indraswari', '2015-04-01', 'semarang', 'agama', 23, 'jakarta', '234.32', 145, 'Perempuan', 'Indonesia', 123155);

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE IF NOT EXISTS `penggunas` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `warga_negara` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `fverifikasi` char(1) NOT NULL DEFAULT 'N',
  `email` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=123177 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunas`
--

INSERT INTO `penggunas` (`id`, `username`, `password`, `nama`, `tanggal_lahir`, `tempat_lahir`, `warga_negara`, `jenis_kelamin`, `agama`, `foto`, `fverifikasi`, `email`, `role`) VALUES
(123142, 'admin', 'password', 'admin', '2015-04-23', 'admin1', 'indonesia', 'admin', 'indonesia', 'uploads/images/21232f297a57a5a743894a0e4a801fc3.jpg', 'y', 'calvin.thurovin@gmail.com', 'admin'),
(123150, 'tania', 'halo', 'tania', '2015-04-22', 'palembang', 'indonesia', 'perempuan', 'islam', '', 'y', 'tania@gmail.com', 'admin'),
(123154, 'doktergigi', 'password', 'Cita Indraswari LAGI', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'islam', 'uploads/images/ae065ed38795a771f0bef84d9a6a5c77.jpg', 'y', 'cita.indraswari@gmail.com', 'umum'),
(123155, 'orthodonti', 'orthodonti', 'Cita Indraswari', '2015-04-03', 'Jakarta', 'Indonesia', 'Perempuan', 'islam', 'uploads/images/46d31fd6f736894bdd7be114294f816d.jpg', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123157, 'pusat', 'password', 'Taniki', '2015-04-01', 'palembang', 'indo', 'perempuan', 'asd', 'uploads/images/42836637e4afa63e6ba120974d7671dc.jpg', 'y', 'tania@l.o', 'pusat'),
(123158, 'Calvin Thurovin', '1234', 'Calvin Thurovin', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123159, 'caca', '1234', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123161, 'lkjkljklj', 'jhjhkhj', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123163, 'admin12', 'asdasd', 'Cita Indraswari', '2015-04-02', 'jakarta', 'indonesia', 'Perempuan', 'islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@yeye.com', 'umum'),
(123164, 'skskskksks', 'admin', 'jvvjgvgk', '2015-04-02', 'krrkr', 'rkrkr', 'Perempuan', 'eee', 'uploads/images/woman.png', 'y', 'ssis#@yahoo.com', 'orthodonti'),
(123166, 'jjwjwjjwjwjw', '1234', 'Wira Bau', '2015-04-16', 'dff', 'fff', 'Perempuan', 'ffff', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123167, 'citayes12345678', 'lalalala', 'Cita Indraswari', '2015-04-02', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123169, 'asd', 'asdfad', 'nama lengkap', '2015-05-05', 'tempat lahir', 'waganegara', 'Laki-laki', 'agama', 'uploads/images/man.png', 'y', 'aqzwsx@qazswx.com', 'orthodonti'),
(123176, 'lala', '1234', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'oiopio', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti');

-- --------------------------------------------------------

--
-- Table structure for table `pesans`
--

CREATE TABLE IF NOT EXISTS `pesans` (
`id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `isi` varchar(1000) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pengguna_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesans`
--

INSERT INTO `pesans` (`id`, `subject`, `isi`, `waktu`, `pengguna_id`, `penerima_id`) VALUES
(1, 'tes diri sendiri', 'halo', '2015-05-11 04:48:45', 123155, 123155),
(2, 'Pasien dari dokter Cita Indraswari LAGI', 'Haidengan id rujukan1', '2015-05-11 04:50:39', 123154, 123155),
(3, 'coba reply', 'coba reply', '2015-05-16 02:33:52', 123154, 123166),
(4, 'Pasien dari dokter Cita Indraswari LAGI', 'dsfdengan id rujukan3', '2015-05-15 18:54:39', 123154, 123155),
(6, 'Pasien dari dokter Cita Indraswari LAGI', 'tes taniadengan id rujukan4', '2015-05-16 06:33:13', 123154, 123155);

-- --------------------------------------------------------

--
-- Table structure for table `rujukans`
--

CREATE TABLE IF NOT EXISTS `rujukans` (
`id` int(11) NOT NULL,
  `orto_id` int(11) NOT NULL,
  `pusat_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `analisi_id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rujukans`
--

INSERT INTO `rujukans` (`id`, `orto_id`, `pusat_id`, `pasien_id`, `analisi_id`, `waktu`, `pesan`) VALUES
(1, 123155, 123154, 7, 75, '2015-05-16 04:41:04', NULL),
(2, 123166, 123154, 28, 77, '2015-05-16 04:41:04', NULL),
(3, 123155, 123154, 7, 75, '2015-05-16 04:41:04', NULL),
(4, 123155, 123154, 7, 75, '2015-05-16 06:33:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `analisis`
--
ALTER TABLE `analisis`
 ADD PRIMARY KEY (`id`), ADD KEY `Username_Orto` (`orto_id`), ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `dokter_gigis`
--
ALTER TABLE `dokter_gigis`
 ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `drg_lains`
--
ALTER TABLE `drg_lains`
 ADD PRIMARY KEY (`pengguna_id`), ADD UNIQUE KEY `Username` (`pengguna_id`);

--
-- Indexes for table `drg_ortodontis`
--
ALTER TABLE `drg_ortodontis`
 ADD PRIMARY KEY (`doktergigi_id`);

--
-- Indexes for table `jadwal_jagas`
--
ALTER TABLE `jadwal_jagas`
 ADD PRIMARY KEY (`id`), ADD KEY `drg_ortodonti_id` (`drg_ortodonti_id`), ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
 ADD PRIMARY KEY (`id`), ADD KEY `pasien_id` (`pasien_id`), ADD KEY `dokter_gigi_id` (`dokter_gigi_id`);

--
-- Indexes for table `mengirims`
--
ALTER TABLE `mengirims`
 ADD PRIMARY KEY (`id`), ADD KEY `tanggal` (`waktu`), ADD KEY `admin_id` (`admin_id`), ADD KEY `umum_id` (`umum_id`), ADD KEY `orto_id` (`orto_id`), ADD KEY `pusat_id` (`pusat_id`), ADD KEY `analisis_id` (`analisis_id`);

--
-- Indexes for table `merawats`
--
ALTER TABLE `merawats`
 ADD PRIMARY KEY (`id`), ADD KEY `orto_id` (`orto_id`,`umum_id`,`pusat_id`), ADD KEY `umum_id` (`umum_id`), ADD KEY `pusat_id` (`pusat_id`), ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
 ADD PRIMARY KEY (`id`), ADD KEY `doktergigi_id` (`doktergigi_id`), ADD KEY `doktergigi_id_2` (`doktergigi_id`);

--
-- Indexes for table `penggunas`
--
ALTER TABLE `penggunas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesans`
--
ALTER TABLE `pesans`
 ADD PRIMARY KEY (`id`), ADD KEY `pengguna_id` (`pengguna_id`), ADD KEY `penerima_id` (`penerima_id`);

--
-- Indexes for table `rujukans`
--
ALTER TABLE `rujukans`
 ADD PRIMARY KEY (`id`), ADD KEY `orto_id` (`orto_id`), ADD KEY `pusat_id` (`pusat_id`), ADD KEY `pasien_id` (`pasien_id`), ADD KEY `analisi_id` (`analisi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis`
--
ALTER TABLE `analisis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `jadwal_jagas`
--
ALTER TABLE `jadwal_jagas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mengirims`
--
ALTER TABLE `mengirims`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `merawats`
--
ALTER TABLE `merawats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `penggunas`
--
ALTER TABLE `penggunas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123177;
--
-- AUTO_INCREMENT for table `pesans`
--
ALTER TABLE `pesans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rujukans`
--
ALTER TABLE `rujukans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `analisis`
--
ALTER TABLE `analisis`
ADD CONSTRAINT `analisis_ibfk_2` FOREIGN KEY (`orto_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `analisis_ibfk_3` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter_gigis`
--
ALTER TABLE `dokter_gigis`
ADD CONSTRAINT `dokter_gigis_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drg_lains`
--
ALTER TABLE `drg_lains`
ADD CONSTRAINT `drg_lains_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `dokter_gigis` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drg_ortodontis`
--
ALTER TABLE `drg_ortodontis`
ADD CONSTRAINT `drg_ortodontis_ibfk_1` FOREIGN KEY (`doktergigi_id`) REFERENCES `dokter_gigis` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_jagas`
--
ALTER TABLE `jadwal_jagas`
ADD CONSTRAINT `jadwal_jagas_ibfk_1` FOREIGN KEY (`drg_ortodonti_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_jagas_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`dokter_gigi_id`) REFERENCES `dokter_gigis` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `medical_records_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mengirims`
--
ALTER TABLE `mengirims`
ADD CONSTRAINT `mengirims_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `mengirims_ibfk_2` FOREIGN KEY (`umum_id`) REFERENCES `drg_lains` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `mengirims_ibfk_6` FOREIGN KEY (`pusat_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `mengirims_ibfk_7` FOREIGN KEY (`orto_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `mengirims_ibfk_8` FOREIGN KEY (`analisis_id`) REFERENCES `analisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `merawats`
--
ALTER TABLE `merawats`
ADD CONSTRAINT `merawats_ibfk_2` FOREIGN KEY (`umum_id`) REFERENCES `drg_lains` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `merawats_ibfk_3` FOREIGN KEY (`orto_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `merawats_ibfk_4` FOREIGN KEY (`pusat_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `merawats_ibfk_5` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pasiens`
--
ALTER TABLE `pasiens`
ADD CONSTRAINT `pasiens_ibfk_1` FOREIGN KEY (`doktergigi_id`) REFERENCES `dokter_gigis` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesans`
--
ALTER TABLE `pesans`
ADD CONSTRAINT `pesans_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `pesans_ibfk_2` FOREIGN KEY (`penerima_id`) REFERENCES `penggunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rujukans`
--
ALTER TABLE `rujukans`
ADD CONSTRAINT `rujukans_ibfk_1` FOREIGN KEY (`orto_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rujukans_ibfk_2` FOREIGN KEY (`pusat_id`) REFERENCES `drg_ortodontis` (`doktergigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rujukans_ibfk_3` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rujukans_ibfk_4` FOREIGN KEY (`analisi_id`) REFERENCES `analisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
