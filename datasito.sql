-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2015 at 03:47 PM
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
  `diagnosis_rekomendasi` varchar(1000) NOT NULL,
  `orto_id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `flag_mengirim` char(1) NOT NULL,
  `flag_menerima` char(1) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` varchar(1000) DEFAULT NULL,
  `flag_membaca` int(11) NOT NULL DEFAULT '1',
  `flag_outbox` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisis`
--

INSERT INTO `analisis` (`id`, `pasien_id`, `skor`, `maloklusi_menurut_angka`, `diagnosis_rekomendasi`, `orto_id`, `foto`, `flag_mengirim`, `flag_menerima`, `waktu`, `pesan`, `flag_membaca`, `flag_outbox`) VALUES
(45, 5, '2.30', '2.10', 'pasien sakit hati', 123157, 'sdf', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(46, 5, '1.20', '1.10', 'halo saya cita', 123157, 'hai', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(53, 5, '1.20', '1.10', 'tes lagi nih wira', 123157, 'hai', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(57, 5, '1.20', '1.50', 'Giginya jelek bau busung jigong gila', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(58, 5, '1.30', '1.50', 'HALOOOOOOOOOOOOOOOOOO INI CITA GIGINYA JELEK DEH', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(59, 5, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(60, 5, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(61, 7, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(62, 8, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(63, 8, '12.00', '12.00', '21', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(64, 10, '1.20', '2.10', 'tes masuk foto ga ya', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-17 23:16:27', '', 1, 1),
(65, 8, '1.20', '3.20', '1.2', 123157, 'n', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(66, 7, '1.20', '2.20', 'alalalalal', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(67, 31, '1.20', '1.10', 'HALOOOOO', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(68, 7, '1.20', '1.10', 'tes cete mau tidur', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(69, 27, '2.20', '1.10', 'tes cete mau tidur', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(70, 7, '2.20', '1.10', 'lalalallllllllllllllllllll', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(71, 19, '1.20', '1.10', 'tes cete mau tidur', 123157, 'hai', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(72, 8, '1.20', '3.20', 'baru banget', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(73, 8, '2.20', '1.10', 'tes', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(74, 7, '1.30', '4.10', 'vuhdsuhviuhdsvuhidvuhdvs', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(75, 7, '2.20', '1.10', 'tes diagnose', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(76, 27, '1.20', '3.20', 'dfsdlkfks', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(77, 28, '2.40', '4.10', 'saya lapar', 123157, '', '1', '1', '2015-05-16 04:17:53', '', 1, 1),
(78, 28, '2.20', '3.00', 'fff', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(79, 19, '0.00', '0.00', '', 123157, '', '2', '', '2015-05-16 04:17:53', '', 1, 1),
(80, 32, '1.10', '3.40', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, 'tes', '2', '', '2015-05-16 11:06:16', NULL, 1, 1),
(81, 32, '1.10', '3.40', 'fdsa', 123157, 'kljdf', '2', '', '2015-05-16 11:08:29', NULL, 1, 1),
(82, 32, '2.10', '1.20', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, 'halo', '2', '', '2015-05-16 11:20:32', NULL, 1, 1),
(83, 32, '1.00', '2.00', '3', 123157, '', '2', '', '2015-05-20 07:41:14', NULL, 2, 1),
(84, 32, '1.23', '1.23', 'halo coba foto nih bisa ga ya', 123157, '', '2', '', '2015-05-17 02:32:26', NULL, 1, 1),
(85, 32, '9.90', '8.80', 'tes tanggal', 123157, '', '2', '', '2015-05-17 02:34:59', NULL, 1, 1),
(86, 32, '3.20', '2.30', 'fdsa', 123157, '', '2', '', '2015-05-17 02:38:24', NULL, 1, 1),
(87, 32, '3.20', '1.20', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, '', '2', '', '2015-05-17 02:39:21', NULL, 1, 1),
(88, 32, '3.30', '3.30', 'sedang nonton insert', 123157, '', '2', '', '2015-05-17 05:08:09', NULL, 1, 1),
(89, 32, '1.10', '9.90', 'meni pedi', 123157, '', '2', '', '2015-05-17 05:08:55', NULL, 1, 1),
(90, 32, '4.20', '1.10', 'afgan', 123157, '', '2', '', '2015-05-17 05:18:22', NULL, 1, 1),
(91, 32, '3.20', '1.20', 'coba foto wira', 123157, '', '2', '', '2015-05-17 05:47:32', NULL, 1, 1),
(92, 32, '1.20', '1.20', 'halo', 123157, '', '2', '', '2015-05-17 05:48:14', NULL, 1, 1),
(100, 32, '1.10', '1.10', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.jpg', '2', '', '2015-05-17 07:00:57', NULL, 1, 1),
(101, 32, '1.10', '1.10', 'halo tes hihi', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.jpg', '2', '', '2015-05-17 07:01:50', NULL, 1, 1),
(102, 32, '1.10', '1.10', 'fdsa', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.jpg', '2', '', '2015-05-17 07:06:59', NULL, 1, 1),
(103, 32, '1.10', '1.10', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-17 07:50:25', NULL, 1, 1),
(104, 32, '1.10', '1.10', 'masuk ga ya analisisnya', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-17 08:24:27', NULL, 1, 1),
(105, 32, '1.10', '1.10', 'coba nih lagi', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-17 08:31:46', NULL, 1, 1),
(106, 32, '4.20', '1.10', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-17 23:20:56', NULL, 1, 1),
(107, 32, '1.10', '1.20', 'Halo nama saya tniakljfkldsjfkljdsflkjdslkfjdslkjfdskljfdsljfkldsjfkldsjfkljdskfjdskljfkldsjfkldsjfkljdsklfjdslkfjdskljfldksjfkldsjfkldsjfkljdslfjdsfjdskljfdslkjfklds', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-17 23:21:53', NULL, 1, 1),
(109, 32, '3.20', '2.10', 'haloooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-18 06:45:39', NULL, 1, 1),
(110, 32, '1.10', '1.10', 'kdkfsjkldshgjkdsjgrkljfkldjsfkljsdklfj dskfjkldj', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-18 07:03:37', NULL, 1, 1),
(111, 32, '1.10', '1.10', 'coba tambah kandidat', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-18 07:11:10', NULL, 1, 1),
(112, 32, '1.10', '1.10', 'cete diusir', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-18 07:14:52', NULL, 1, 1),
(113, 32, '4.20', '1.20', 'tes text areanya besar sekali', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-18 12:36:31', NULL, 1, 1),
(114, 32, '4.20', '3.40', 'jkl', 123157, '', '2', '', '2015-05-19 13:54:04', NULL, 1, 1),
(115, 32, '3.20', '1.20', 'uijl', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '2', '', '2015-05-19 13:56:41', NULL, 1, 1),
(116, 32, '3.20', '3.20', 'sdfsd', 123157, 'uploads/images/citra42836637e4afa63e6ba120974d7671dc.JPG', '1', '1', '2015-05-19 14:17:03', NULL, 1, 1),
(117, 9, '1.10', '1.20', 'tes coba halo sekarang 20 mei', 123157, 'uploads/citra/eb160de1de89d9058fcb0b968dbbbd68.JPG', '2', '', '2015-05-20 07:12:20', NULL, 1, 1),
(118, 9, '3.20', '3.20', 'coba send diagnose 20 mei', 123157, 'uploads/citra/5ef059938ba799aaa845e1c2e8a762bd.JPG', '1', '1', '2015-05-20 07:27:23', NULL, 2, 1),
(119, 28, '1.10', '3.40', 'coba foto', 123157, 'uploads/citra/07e1cd7dca89a1678042477183b7ac3f.jpg', '2', '', '2015-05-20 07:40:46', NULL, 1, 1),
(120, 28, '1.10', '1.10', 'search', 123157, '', '2', '', '2015-05-20 07:43:25', NULL, 1, 1),
(121, 28, '4.20', '1.20', 'iojklj', 123157, 'uploads/citra/4c56ff4ce4aaf9573aa5dff913df997a.jpg', '2', '', '2015-05-20 08:49:47', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dokter_gigis`
--

CREATE TABLE IF NOT EXISTS `dokter_gigis` (
  `pengguna_id` int(11) NOT NULL,
  `kursus` varchar(100) NOT NULL,
  `pendidikan_dokter` varchar(100) NOT NULL,
  `alamat_praktik` varchar(500) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `no_dokter` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter_gigis`
--

INSERT INTO `dokter_gigis` (`pengguna_id`, `kursus`, `pendidikan_dokter`, `alamat_praktik`, `kode_pos`, `longitude`, `latitude`, `no_dokter`) VALUES
(123142, '', '', '', '0', '', '', ''),
(123154, 'Kursus mobil', 'SMA', 'tes', '222', '', '', ''),
(123155, 'Kursus mobil', 'SMA', 'lakdasda', '12345', '', '', ''),
(123157, 'orto', 's2', 'sawangan', '12345', '', '', ''),
(123158, 'Kursus mobil', 'SMA', '', '0', '', '', ''),
(123159, 'Kursus mobil', 'SMA', '', '0', '', '', ''),
(123161, 'Kursus mobil', 'SMA', '', '0', '', '', ''),
(123163, 'dsdd', 'sma', '', '0', '', '', ''),
(123164, 'ee', 'eee', '', '0', '', '', ''),
(123166, 'fff', 'ff', '', '0', '', '', ''),
(123167, 'Kursus mobil', 'SMA', '', '0', '', '', ''),
(123169, 'kursus', 'pendidikan', '', '0', '', '', ''),
(123176, 'Kursus gigi', 'SMA', '', '0', '', '', ''),
(123177, 'Memasak', 'SMA', 'Depok', '30124', '106.84559899999999', '-6.2087634', ''),
(123178, 'Memasak', 'SMA', 'Depok', '30124', '106.84559899999999', '-6.2087634', ''),
(123179, 'orto', 'kitty', 'hello', '123', '106.84559899999999', '-6.2087634', '');

-- --------------------------------------------------------

--
-- Table structure for table `drg_lains`
--

CREATE TABLE IF NOT EXISTS `drg_lains` (
  `pengguna_id` int(11) NOT NULL,
  `kursus_ortodonti` varchar(100) NOT NULL,
  `jadwal_praktik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drg_lains`
--

INSERT INTO `drg_lains` (`pengguna_id`, `kursus_ortodonti`, `jadwal_praktik`) VALUES
(123142, '', ''),
(123154, 'DMMDD', 'DKDKKD'),
(123155, 'jkjljkkl', 'jkljl'),
(123163, '', 'n'),
(123179, '', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `drg_ortodontis`
--

CREATE TABLE IF NOT EXISTS `drg_ortodontis` (
  `doktergigi_id` int(11) NOT NULL,
  `no_ikorti` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drg_ortodontis`
--

INSERT INTO `drg_ortodontis` (`doktergigi_id`, `no_ikorti`) VALUES
(123154, ''),
(123155, ''),
(123157, ''),
(123158, ''),
(123166, ''),
(123169, ''),
(123176, '');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_jagas`
--

CREATE TABLE IF NOT EXISTS `jadwal_jagas` (
`id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` varchar(11) NOT NULL,
  `jam_selesai` varchar(11) NOT NULL,
  `drg_ortodonti_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_jagas`
--

INSERT INTO `jadwal_jagas` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `drg_ortodonti_id`, `admin_id`) VALUES
(17, 'Monday', '8', '12', 123158, 123142),
(18, 'Monday', '12', '16', 123154, 123142),
(19, 'Monday', '16', '20', 123157, 123142),
(20, 'Tuesday', '8', '12', 123157, 123142),
(21, 'Tuesday', '12', '16', 123157, 123142),
(22, 'Tuesday', '16', '20', 123157, 123142),
(23, 'Wednesday', '8', '12', 123157, 123142),
(24, 'Wednesday', '12', '16', 123157, 123142),
(25, 'Wednesday', '16', '20', 123157, 123142),
(26, 'Thursday', '8', '12', 123157, 123142),
(27, 'Thursday', '12', '16', 123157, 123142),
(28, 'Thursday', '16', '20', 123157, 123142),
(29, 'Friday', '8', '12', 123157, 123142),
(30, 'Friday', '12', '16', 123157, 123142),
(31, 'Friday', '16', '20', 123157, 123142),
(32, 'Saturday', '16', '20', 123157, 123142),
(33, 'Saturday', '16', '20', 123157, 123142),
(34, 'Saturday', '16', '20', 123157, 123142),
(35, 'Sunday', '16', '20', 123157, 123142),
(36, 'Sunday', '16', '20', 123157, 123142),
(37, 'Sunday', '16', '20', 123157, 123142);

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
  `dokter_gigi_id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `tanggal`, `jam`, `deskripsi`, `pasien_id`, `dokter_gigi_id`, `foto`) VALUES
(1, '2015-05-15', 18, 'Halo aku coba masukkan manual nih', 32, 123163, ''),
(2, '2015-05-14', 8, 'halo', 27, 123154, 'uploads/citra/c81e728d9d4c2f636f067f89cc14862c.JPG'),
(3, '2015-04-07', 18, 'coba ga mau muncul med record', 28, 123154, 'uploads/citra/eccbc87e4b5ce2fe28308fd9f2a7baf3.JPG');

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
  `pesan` varchar(1000) DEFAULT NULL,
  `flag_membaca` int(1) DEFAULT '1',
  `flag_outbox` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengirims`
--

INSERT INTO `mengirims` (`waktu`, `id`, `admin_id`, `umum_id`, `orto_id`, `pusat_id`, `analisis_id`, `kandidat1`, `kandidat2`, `kandidat3`, `kandidat4`, `kandidat5`, `pesan`, `flag_membaca`, `flag_outbox`) VALUES
(NULL, 58, NULL, 123154, NULL, 123157, 75, 'Cita Indraswari', NULL, NULL, NULL, NULL, NULL, 2, 2),
(NULL, 59, NULL, 123154, NULL, 123157, 76, 'jvvjgvgk', NULL, NULL, NULL, NULL, NULL, 2, 2),
('2015-03-31 17:00:00', 60, 123142, 123154, NULL, 123157, 77, 'Wira Bau', NULL, NULL, NULL, NULL, NULL, 2, 2),
('0000-00-00 00:00:00', 61, NULL, NULL, NULL, NULL, 79, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 62, NULL, 123163, NULL, 123157, 82, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 63, NULL, 123163, NULL, 123157, 83, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 75, NULL, 123163, NULL, 123157, 105, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 76, NULL, 123163, NULL, 123157, 107, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 77, NULL, 123163, NULL, 123157, 109, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 78, NULL, 123163, NULL, 123157, 110, 'nama lengkap', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 79, NULL, 123163, NULL, 123157, 111, 'Cita Indraswari', NULL, NULL, NULL, NULL, NULL, 1, 2),
(NULL, 80, NULL, 123163, NULL, 123157, 112, 'Calvin Thurovin', 'Lili Lala', 'jvvjgvgk', NULL, NULL, NULL, 1, 1),
(NULL, 81, NULL, 123163, NULL, 123157, 113, 'Lili Lala', 'Calvin Thurovin', 'Cita Indraswari', NULL, NULL, NULL, 1, 1),
(NULL, 82, NULL, 123154, 123155, 123157, 117, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 2, 1),
(NULL, 83, NULL, 123154, NULL, 123157, 119, 'Lili Lala', NULL, NULL, NULL, NULL, NULL, 2, 1),
(NULL, 84, NULL, 123154, NULL, 123157, 121, 'jvvjgvgk', NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, 85, 123142, 123154, 123155, 123157, 118, 'Wira Bau', NULL, NULL, NULL, NULL, NULL, 1, 2);

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
  `pesan` varchar(1000) DEFAULT NULL,
  `flag_membaca` int(1) DEFAULT '1',
  `flag_outbox` int(1) NOT NULL DEFAULT '1',
  `medical_record_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merawats`
--

INSERT INTO `merawats` (`id`, `pasien_id`, `orto_id`, `umum_id`, `pusat_id`, `waktu`, `pesan`, `flag_membaca`, `flag_outbox`, `medical_record_id`) VALUES
(4, 9, 123155, 123154, 123157, '2015-05-20 07:08:33', NULL, 2, 2, 1),
(7, 28, NULL, 123154, NULL, '2015-05-20 08:49:21', NULL, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE IF NOT EXISTS `pasiens` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `umur` tinyint(4) NOT NULL,
  `alamat_rumah` varchar(100) NOT NULL,
  `tinggi` decimal(5,2) NOT NULL,
  `berat` smallint(6) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `warga_negara` varchar(100) NOT NULL,
  `doktergigi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

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
(31, 'Cita Indraswari', '2015-04-01', 'semarang', 'agama', 23, 'jakarta', '234.32', 145, 'Perempuan', 'Indonesia', 123155),
(32, 'Cheetos', '1994-07-06', 'Palembang', 'Islam', 20, 'Jln. Trikora Swakarya 1 No. A20', '160.50', 59, 'Perempuan', 'Indonesia', 123163),
(33, 'Chiesa Serena', '1994-10-02', 'Jakarta', 'Kristen', 20, 'Tebet', '160.50', 59, 'Perempuan', 'Indonesia', 123154),
(34, 'New', '1994-04-03', 'Palembang22', 'Islam', 20, 'Depok', '160.00', 57, 'Female', 'Indonesia', 123154);

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE IF NOT EXISTS `penggunas` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `warga_negara` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `fverifikasi` char(1) NOT NULL DEFAULT 'N',
  `email` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=123180 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunas`
--

INSERT INTO `penggunas` (`id`, `username`, `password`, `nama`, `tanggal_lahir`, `tempat_lahir`, `warga_negara`, `jenis_kelamin`, `agama`, `foto`, `fverifikasi`, `email`, `role`) VALUES
(123142, 'admin', 'password', 'admin', '2015-04-23', 'admin1', 'indonesia', 'admin', 'indonesia', 'uploads/images/21232f297a57a5a743894a0e4a801fc3.jpg', 'y', 'calvin.thurovin@gmail.com', 'admin'),
(123150, 'tania', 'halo', 'tania', '2015-04-22', 'palembang', 'indonesia', 'perempuan', 'islam', '', 'y', 'tania@gmail.com', 'admin'),
(123154, 'doktergigi', 'password', 'Cita Indraswari LAGI', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'islam', 'uploads/images/ae065ed38795a771f0bef84d9a6a5c77.jpg', 'y', 'cita.indraswari@gmail.com', 'umum'),
(123155, 'orthodonti', 'orthodonti', 'Lili Lala', '2015-04-03', 'Jakarta', 'Indonesia', 'Perempuan', 'islam', 'uploads/images/46d31fd6f736894bdd7be114294f816d.jpg', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123157, 'pusat', 'password', 'Taniki', '2015-04-01', 'palembang', 'indo', 'perempuan', 'asd', 'uploads/images/42836637e4afa63e6ba120974d7671dc.jpg', 'y', 'tania@l.o', 'pusat'),
(123158, 'Calvin Thurovin', '1234', 'Calvin Thurovin', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123159, 'caca', '1234', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123161, 'lkjkljklj', 'jhjhkhj', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123163, 'umumlagi', 'password', 'Cita Indraswari', '2015-04-02', 'jakarta', 'indonesia', 'Perempuan', 'islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@yeye.com', 'umum'),
(123164, 'skskskksks', 'admin', 'jvvjgvgk', '2015-04-02', 'krrkr', 'rkrkr', 'Perempuan', 'eee', 'uploads/images/woman.png', 'y', 'ssis#@yahoo.com', 'orthodonti'),
(123166, 'jjwjwjjwjwjw', '1234', 'Wira Bau', '2015-04-16', 'dff', 'fff', 'Perempuan', 'ffff', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123167, 'citayes12345678', 'lalalala', 'Cita Indraswari', '2015-04-02', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123169, 'asd', 'asdfad', 'nama lengkap', '2015-05-05', 'tempat lahir', 'waganegara', 'Laki-laki', 'agama', 'uploads/images/man.png', 'y', 'aqzwsx@qazswx.com', 'orthodonti'),
(123176, 'lala', '1234', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'oiopio', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123177, 'taniaputri', '1234', 'tania putri permatasari', '1994-07-06', 'Palembang', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'tania.putri21@ui.ac.id', 'umum'),
(123178, 'taniaputrilala', '666666', 'tania putri permatasari', '1994-07-06', 'Palembang', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'tania.putri21@ui.ac.id', 'orthodonti'),
(123179, 'HelloKitty', 'hhele', 'helokiti', '1994-04-03', 'helohelo', 'indonesia', 'Perempuan', 'hello', 'uploads/images/woman.png', 'n', 'hellokitti@hello.com', 'umum');

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
  `penerima_id` int(11) NOT NULL,
  `flag_membaca` int(1) DEFAULT '1',
  `flag_outbox` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesans`
--

INSERT INTO `pesans` (`id`, `subject`, `isi`, `waktu`, `pengguna_id`, `penerima_id`, `flag_membaca`, `flag_outbox`) VALUES
(1, 'tes diri sendiri', 'halo', '2015-05-11 04:48:45', 123155, 123155, 1, 1),
(2, 'Pasien dari dokter Cita Indraswari LAGI', 'Haidengan id rujukan1', '2015-05-11 04:50:39', 123154, 123155, 1, 1),
(3, 'coba reply', 'coba reply', '2015-05-16 02:33:52', 123154, 123166, 1, 1),
(4, 'Pasien dari dokter Cita Indraswari LAGI', 'dsfdengan id rujukan3', '2015-05-15 18:54:39', 123154, 123155, 1, 1),
(6, 'Pasien dari dokter Cita Indraswari LAGI', 'tes taniadengan id rujukan4', '2015-05-17 05:46:27', 123154, 123155, 2, 1),
(8, 'Tes ah huft mau coba', 'capek capek capek', '2015-05-16 14:14:34', 123155, 123154, 1, 1),
(9, 'Halo', 'coba reply cete main cs', '2015-05-16 14:38:28', 123155, 123154, 1, 1),
(10, 'Halo', 'coba reply cete main cs', '2015-05-16 14:39:21', 123155, 123154, 1, 1),
(11, 'bangga sama wira', 'selamat ya wira', '2015-05-16 14:39:59', 123155, 123163, 1, 1),
(12, 'coba kirim ke diri sendiri', 'halo', '2015-05-20 07:16:28', 123157, 123157, 2, 2),
(15, 'halo kirim sendiri nih', 'halo diri sendiri', '2015-05-18 08:15:04', 123154, 123154, 2, 1),
(16, 'halo diri sendiri', 'halo ', '2015-05-18 09:10:17', 123142, 123142, 1, 2),
(17, 'coba kirim pesan nih sekarang', 'coba sekarang kirim pesan', '2015-05-20 06:19:29', 123154, 123157, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rujukans`
--

CREATE TABLE IF NOT EXISTS `rujukans` (
`id` int(11) NOT NULL,
  `orto_id` int(11) NOT NULL,
  `pengirim_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `analisi_id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` varchar(1000) DEFAULT NULL,
  `flag_membaca` int(1) DEFAULT '1',
  `flag_outbox` int(1) NOT NULL DEFAULT '1',
  `medical_record_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rujukans`
--

INSERT INTO `rujukans` (`id`, `orto_id`, `pengirim_id`, `pasien_id`, `analisi_id`, `waktu`, `pesan`, `flag_membaca`, `flag_outbox`, `medical_record_id`) VALUES
(6, 123155, 123177, 27, 76, '2015-05-20 06:28:50', NULL, 2, 1, 2);

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
 ADD PRIMARY KEY (`id`), ADD KEY `orto_id` (`orto_id`,`umum_id`,`pusat_id`), ADD KEY `umum_id` (`umum_id`), ADD KEY `pusat_id` (`pusat_id`), ADD KEY `pasien_id` (`pasien_id`), ADD KEY `medical_record_id` (`medical_record_id`);

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
 ADD PRIMARY KEY (`id`), ADD KEY `orto_id` (`orto_id`), ADD KEY `pusat_id` (`pengirim_id`), ADD KEY `pasien_id` (`pasien_id`), ADD KEY `analisi_id` (`analisi_id`), ADD KEY `pengirim_id` (`pengirim_id`), ADD KEY `medical_record_id` (`medical_record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis`
--
ALTER TABLE `analisis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `jadwal_jagas`
--
ALTER TABLE `jadwal_jagas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mengirims`
--
ALTER TABLE `mengirims`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `merawats`
--
ALTER TABLE `merawats`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `penggunas`
--
ALTER TABLE `penggunas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123180;
--
-- AUTO_INCREMENT for table `pesans`
--
ALTER TABLE `pesans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `rujukans`
--
ALTER TABLE `rujukans`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
ADD CONSTRAINT `merawats_ibfk_5` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `merawats_ibfk_6` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
ADD CONSTRAINT `rujukans_ibfk_3` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rujukans_ibfk_4` FOREIGN KEY (`analisi_id`) REFERENCES `analisis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rujukans_ibfk_5` FOREIGN KEY (`pengirim_id`) REFERENCES `dokter_gigis` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rujukans_ibfk_6` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
