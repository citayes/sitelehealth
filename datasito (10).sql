-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2015 at 09:25 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
  `id_pegawai` varchar(20) NOT NULL,
  PRIMARY KEY (`pengguna_id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) NOT NULL,
  `skor` decimal(4,2) NOT NULL,
  `maloklusi_menurut_angka` decimal(4,2) NOT NULL,
  `diagnosis_rekomendasi` varchar(500) NOT NULL,
  `orto_id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `flag_mengirim` char(1) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag_outbox` int(11) NOT NULL DEFAULT '1',
  `flag_membaca` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `Username_Orto` (`orto_id`),
  KEY `pasien_id` (`pasien_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `analisis`
--

INSERT INTO `analisis` (`id`, `pasien_id`, `skor`, `maloklusi_menurut_angka`, `diagnosis_rekomendasi`, `orto_id`, `foto`, `flag_mengirim`, `waktu`, `flag_outbox`, `flag_membaca`) VALUES
(45, 5, 2.30, 2.10, 'pasien sakit hati', 123157, 'sdf', '2', '2015-05-16 04:17:53', 1, 1),
(46, 5, 1.20, 1.10, 'halo saya cita', 123157, 'hai', '2', '2015-05-16 04:17:53', 1, 1),
(53, 5, 1.20, 1.10, 'tes lagi nih wira', 123157, 'hai', '2', '2015-05-16 04:17:53', 1, 1),
(57, 5, 1.20, 1.50, 'Giginya jelek bau busung jigong gila', 123157, '', '1', '2015-05-16 17:59:12', 2, 2),
(58, 5, 1.30, 1.50, 'HALOOOOOOOOOOOOOOOOOO INI CITA GIGINYA JELEK DEH', 123157, '', '2', '2015-05-16 04:17:53', 1, 1),
(59, 5, 12.00, 12.00, '21', 123157, '', '1', '2015-05-16 18:50:27', 1, 2),
(60, 5, 12.00, 12.00, '21', 123157, '', '1', '2015-05-17 07:00:23', 1, 2),
(61, 7, 12.00, 12.00, '21', 123157, '', '1', '2015-05-17 12:51:18', 1, 2),
(62, 8, 12.00, 12.00, '21', 123157, '', '1', '2015-05-18 22:40:36', 1, 2),
(63, 8, 12.00, 12.00, '21', 123157, '', '1', '2015-05-16 04:17:53', 1, 1),
(64, 10, 1.20, 2.10, 'adsa', 123157, 'n', '2', '2015-05-16 04:17:53', 1, 1),
(65, 8, 1.20, 3.20, '1.2', 123157, 'n', '2', '2015-05-16 04:17:53', 1, 1),
(66, 7, 1.20, 2.20, 'alalalalal', 123157, '', '1', '2015-05-16 04:17:53', 1, 1),
(67, 31, 1.20, 1.10, 'HALOOOOO', 123157, '', '1', '2015-05-16 04:17:53', 1, 1),
(68, 7, 1.20, 1.10, 'tes cete mau tidur', 123157, '', '2', '2015-05-16 18:05:14', 1, 2),
(69, 27, 2.20, 1.10, 'tes cete mau tidur', 123157, '', '2', '2015-05-16 04:17:53', 1, 1),
(70, 7, 2.20, 1.10, 'lalalallllllllllllllllllll', 123157, '', '2', '2015-05-16 04:17:53', 1, 1),
(71, 19, 1.20, 1.10, 'tes cete mau tidur', 123157, 'hai', '2', '2015-05-16 04:17:53', 1, 1),
(72, 8, 1.20, 3.20, 'baru banget', 123157, '', '2', '2015-05-17 12:53:32', 1, 2),
(73, 8, 2.20, 1.10, 'tes', 123157, '', '2', '2015-05-17 12:56:33', 1, 2),
(74, 7, 1.30, 4.10, 'vuhdsuhviuhdsvuhidvuhdvs', 123157, '', '1', '2015-05-20 02:12:49', 1, 2),
(75, 7, 2.20, 1.10, 'tes diagnose', 123157, '', '2', '2015-05-18 07:01:06', 1, 2),
(76, 27, 1.20, 3.20, 'dfsdlkfks', 123157, '', '2', '2015-05-16 04:17:53', 1, 1),
(77, 28, 2.40, 4.10, 'saya lapar', 123157, '', '1', '2015-05-16 04:17:53', 1, 1),
(78, 28, 2.20, 3.00, 'fff', 123157, '', '2', '2015-05-16 04:17:53', 1, 1),
(79, 19, 0.00, 0.00, '', 123157, '', '2', '2015-05-16 04:17:53', 1, 1),
(80, 26, 4.30, 3.20, 'lalalallllllllllllllllllll', 123157, '', '2', '2015-05-16 10:16:09', 1, 1),
(81, 26, 2.30, 3.20, 'lala', 123157, '', '2', '2015-05-16 10:26:41', 1, 1),
(82, 24, 2.10, 1.30, 'lalallalala', 123157, '', '2', '2015-05-16 10:27:01', 1, 1),
(83, 24, 2.30, 3.10, 'halo saya cita indraswari', 123157, '', '2', '2015-05-16 10:38:38', 1, 1),
(84, 27, 1.20, 3.40, 'halo saya cita', 123157, '', '2', '2015-05-16 10:42:50', 1, 1),
(85, 24, 2.30, 4.30, 'haaa', 123157, '', '1', '2015-05-16 10:51:54', 1, 1),
(86, 24, 4.30, 2.30, 'halau', 123157, '', '1', '2015-05-16 10:52:15', 1, 1),
(87, 26, 3.40, 3.10, 'alay', 123157, '', '1', '2015-05-16 10:52:34', 1, 1),
(88, 27, 3.50, 2.50, 'hahahahah', 123157, '', '2', '2015-05-18 06:32:30', 1, 1),
(89, 24, 3.20, 2.10, 'hahahahahahahahahahahaha', 123157, '', '2', '2015-05-18 06:31:31', 1, 1),
(90, 24, 3.20, 1.40, 'hayaaaaah', 123157, '', '2', '2015-05-18 06:31:40', 1, 1),
(91, 24, 3.40, 2.30, 'tes mau ke d''cost', 123157, '', '2', '2015-05-18 06:31:54', 1, 1),
(92, 24, 2.30, 3.40, 'haiiii', 123157, '', '1', '2015-05-20 02:13:58', 1, 2),
(93, 24, 2.30, 3.40, 'haiiii', 123157, '', '1', '2015-05-17 12:04:44', 1, 1),
(94, 24, 3.40, 2.40, 'hai', 123157, '', '2', '2015-05-18 06:32:01', 1, 1),
(95, 24, 3.20, 1.20, 'hula', 123157, '', '1', '2015-05-18 07:15:29', 2, 1),
(96, 24, 3.40, 2.30, 'tes cita ngantuk', 123157, '', '1', '2015-05-17 12:10:00', 1, 1),
(97, 26, 3.40, 2.10, 'tes cita kedinginan', 123157, '', '1', '2015-05-17 12:12:32', 1, 1),
(98, 28, 3.40, 2.10, '2.4', 123157, '', '1', '2015-05-17 12:12:51', 1, 1),
(99, 28, 3.20, 1.20, 'tes saya ngantuk', 123157, '', '1', '2015-05-18 06:32:51', 2, 2),
(100, 28, 3.10, 2.30, 'halalalalllllllllllllllllllllllllllllllllllll', 123157, '', '2', '2015-05-18 06:32:38', 1, 1),
(104, 31, 2.30, 1.40, 'haloooooooooooooooooooooooo saya cita', 123157, '', '1', '2015-05-18 06:33:00', 1, 2),
(105, 31, 2.30, 3.90, 'HALO SAYA LAPAAAAAAAAAAAAAAAAAAAR', 123157, 'uploads/citra/65b9eea6e1cc6bb9f0cd2a47751a186f.PNG', '1', '2015-05-18 07:16:46', 2, 2),
(106, 31, 3.20, 4.10, 'saya cita indraswari dan saya lapar huhu', 123157, 'uploads/citra/f0935e4cd5920aa6c7c996a5ee53a70f.PNG', '2', '2015-05-18 06:56:48', 1, 1),
(107, 28, 3.10, 1.20, 'ulalalalla', 123157, 'uploads/citra/a97da629b098b75c294dffdc3e463904.PNG', '2', '2015-05-18 22:37:38', 1, 1),
(108, 28, 3.40, 1.20, 'ulallalalala', 123157, 'uploads/citra/a3c65c2974270fd093ee8a9bf8ae7d0b.PNG', '1', '2015-05-18 22:38:08', 1, 1),
(109, 27, 4.50, 3.50, 'ahahhahahahaah', 123157, 'uploads/citra/2723d092b63885e0d7c260cc007e8b9d.PNG', '2', '2015-05-18 22:38:35', 1, 1),
(110, 28, 2.30, 3.10, 'ahaaaaaaaaaaaaaaaaaaaaaaa', 123157, 'uploads/citra/5f93f983524def3dca464469d2cf9f3e.PNG', '2', '2015-05-18 22:39:08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dokter_gigis`
--

CREATE TABLE IF NOT EXISTS `dokter_gigis` (
  `pengguna_id` int(11) NOT NULL,
  `kursus` varchar(20) NOT NULL,
  `pendidikan_dokter` varchar(20) NOT NULL,
  `alamat_praktik` varchar(20) NOT NULL,
  `kode_pos` int(5) NOT NULL,
  PRIMARY KEY (`pengguna_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter_gigis`
--

INSERT INTO `dokter_gigis` (`pengguna_id`, `kursus`, `pendidikan_dokter`, `alamat_praktik`, `kode_pos`) VALUES
(123142, '', '', '', 0),
(123154, 'Kursus mobil', 'SMA', 'tes', 222),
(123155, 'Kursus mobil', 'SMA', 'lakdasda', 12345),
(123157, 'orto', 's2', 'sawangan', 12345),
(123158, 'Kursus mobil', 'SMA', '', 0),
(123159, 'Kursus mobil', 'SMA', '', 0),
(123161, 'Kursus mobil', 'SMA', '', 0),
(123163, 'dsdd', 'sma', '', 0),
(123164, 'ee', 'eee', '', 0),
(123166, 'fff', 'ff', '', 0),
(123167, 'Kursus mobil', 'SMA', '', 0),
(123169, 'kursus', 'pendidikan', '', 0),
(123176, 'Kursus gigi', 'SMA', '', 0),
(123184, 'Kursus mobil', 'SMA', 'Bogor', 12345),
(123187, 'Kursus mobil', 'SMA', 'Bogor', 12124),
(123188, 'Kursus mobil', 'SMA', 'Bogor', 12124);

-- --------------------------------------------------------

--
-- Table structure for table `drg_lains`
--

CREATE TABLE IF NOT EXISTS `drg_lains` (
  `pengguna_id` int(11) NOT NULL,
  `kursus_ortodonti` varchar(20) NOT NULL,
  `jadwal_praktik` varchar(20) NOT NULL,
  PRIMARY KEY (`pengguna_id`),
  UNIQUE KEY `Username` (`pengguna_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drg_lains`
--

INSERT INTO `drg_lains` (`pengguna_id`, `kursus_ortodonti`, `jadwal_praktik`) VALUES
(123142, '', ''),
(123154, 'DMMDD', 'DKDKKD'),
(123155, 'jkjljkkl', 'jkljl'),
(123163, '', 'n'),
(123184, '', 'n'),
(123187, '', 'n'),
(123188, '', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `drg_ortodontis`
--

CREATE TABLE IF NOT EXISTS `drg_ortodontis` (
  `doktergigi_id` int(11) NOT NULL,
  PRIMARY KEY (`doktergigi_id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` int(11) NOT NULL,
  `jam_selesai` int(11) NOT NULL,
  `drg_ortodonti_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `drg_ortodonti_id` (`drg_ortodonti_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `jadwal_jagas`
--

INSERT INTO `jadwal_jagas` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `drg_ortodonti_id`, `admin_id`) VALUES
(17, '', 8, 12, 123166, 123142),
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam` int(11) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_gigi_id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `dokter_gigi_id` (`dokter_gigi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `tanggal`, `jam`, `deskripsi`, `pasien_id`, `dokter_gigi_id`, `foto`) VALUES
(1, '2015-04-28', 2, 'halay', 28, 123154, ''),
(2, '2015-05-14', 5, 'tes cita ngantuk', 27, 123154, ''),
(3, '2015-04-30', 4, 'ngantuuuuuuuuuuuuuuuuk', 28, 123154, ''),
(4, '2015-04-28', 3, 'ngantuk banget sumpah', 28, 123154, 'uploads/images/citraae065ed38795a771f0bef84d9a6a5c77.PNG'),
(5, '1899-12-07', 1, 'yaya', 31, 123155, ''),
(6, '2015-05-17', 1, 'ulalalallalaaaaaaaaaaaaaaaaaaaaaaaa', 31, 123155, 'uploads/images/citra46d31fd6f736894bdd7be114294f816d.PNG'),
(7, '2015-04-30', 1, 'haloo', 28, 123154, 'uploads/images/citraae065ed38795a771f0bef84d9a6a5c77.PNG'),
(8, '2015-05-06', 3, 'haiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', 24, 123154, 'uploads/citra/c9f0f895fb98ab9159f51fd0297e236d.PNG'),
(9, '2015-05-08', 4, 'halooooooooooooooooooooooooooo', 24, 123154, 'uploads/citra/45c48cce2e2d7fbdea1afc51c7c6ad26.PNG'),
(10, '2015-05-16', 4, 'ggiginyabau', 24, 123154, 'uploads/citra/d3d9446802a44259755d38e6d163e820.PNG'),
(11, '2015-05-12', 6, 'giginya harus dioperasi dan ditambal hehehhe', 24, 123154, 'uploads/citra/6512bd43d9caa6e02c990b0a82652dca.PNG'),
(12, '2015-05-14', 7, 'giginya bau busuk', 24, 123154, 'uploads/citra/c20ad4d76fe97759aa27a0c99bff6710.PNG'),
(13, '2015-05-05', 2, 'hulaaaaaaaaaaaaaaaaaaaaaaaa', 24, 123154, 'uploads/citra/c51ce410c124a10e0db5e4b97fc2af39.PNG'),
(14, '2015-05-05', 5, 'ulalalalalalal giginya bau', 24, 123154, 'uploads/citra/aab3238922bcc25a6f606eb525ffdc56.PNG'),
(15, '2015-05-02', 5, 'saya lapar', 24, 123154, 'uploads/citra/9bf31c7ff062936a96d3c8bd1f8f2ff3.PNG'),
(16, '2015-05-14', 6, 'saya ngantuk', 24, 123154, 'uploads/citra/c74d97b01eae257e44aa9d5bade97baf.PNG'),
(17, '2015-05-08', 8, 'lapaaaaaaaaaaaaaaaar', 24, 123154, 'uploads/citra/70efdf2ec9b086079795c442636b55fb.PNG'),
(18, '2015-05-14', 8, 'lalallalalaaooooooooooooooooooooooooooooo', 24, 123154, 'uploads/citra/6f4922f45568161a8cdf4ad2299f6d23.PNG'),
(19, '2015-05-06', 3, 'hahahahha', 24, 123154, '');

-- --------------------------------------------------------

--
-- Table structure for table `mengirims`
--

CREATE TABLE IF NOT EXISTS `mengirims` (
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `flag_membaca` int(11) NOT NULL DEFAULT '1',
  `flag_outbox` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `tanggal` (`waktu`),
  KEY `admin_id` (`admin_id`),
  KEY `umum_id` (`umum_id`),
  KEY `orto_id` (`orto_id`),
  KEY `pusat_id` (`pusat_id`),
  KEY `analisis_id` (`analisis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `mengirims`
--

INSERT INTO `mengirims` (`waktu`, `id`, `admin_id`, `umum_id`, `orto_id`, `pusat_id`, `analisis_id`, `kandidat1`, `kandidat2`, `kandidat3`, `kandidat4`, `kandidat5`, `flag_membaca`, `flag_outbox`) VALUES
('2015-05-16 10:43:31', 58, NULL, 123154, NULL, 123157, 75, 'Cita Indraswari', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-16 10:43:31', 59, NULL, 123154, NULL, 123157, 76, 'jvvjgvgk', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-16 16:22:59', 60, 123142, 123154, NULL, 123157, 77, 'Wira Bau', NULL, NULL, NULL, NULL, 2, 1),
('0000-00-00 00:00:00', 61, NULL, NULL, NULL, NULL, 79, NULL, NULL, NULL, NULL, NULL, 1, 1),
('2015-05-18 22:40:36', 62, NULL, 123154, NULL, 123157, 81, 'Wira Bau', NULL, NULL, NULL, NULL, 2, 2),
('2015-05-17 13:34:30', 63, NULL, 123154, NULL, 123157, 82, 'Cita Indraswari', NULL, NULL, NULL, NULL, 1, 2),
('2015-05-16 10:43:31', 64, NULL, 123154, NULL, 123157, 83, 'nama lengkap', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-16 10:43:31', 65, NULL, 123154, NULL, 123157, 84, 'nama lengkap', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-16 10:49:11', 66, 123142, NULL, NULL, 123157, 57, 'Cita Indraswari', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-16 10:49:23', 67, 123142, NULL, NULL, 123157, 61, 'Cita Indraswari', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-16 19:05:24', 68, 123142, 123154, NULL, 123157, 87, 'Wira Bau', NULL, NULL, NULL, NULL, 2, 2),
('2015-05-17 08:34:12', 71, NULL, 123154, NULL, 123157, 91, 'Wira Bau', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-17 12:53:32', 72, NULL, 123154, NULL, 123157, 94, 'Cita Indraswari', NULL, NULL, NULL, NULL, 2, 1),
('2015-05-18 01:21:10', 73, NULL, 123154, NULL, 123157, 100, 'Wira Bau', NULL, NULL, NULL, NULL, 2, 2),
('2015-05-18 07:05:51', 74, NULL, NULL, 123155, 123157, 106, 'Wira Bau', NULL, NULL, NULL, NULL, 1, 2),
('2015-05-18 07:40:30', 75, 123142, NULL, 123155, 123157, 105, 'Wira Bau', NULL, NULL, NULL, NULL, 2, 2),
('2015-05-18 22:37:42', 76, NULL, 123154, NULL, 123157, 107, 'Cita Indraswari', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-18 22:38:39', 77, NULL, 123154, NULL, 123157, 109, 'Cita Indraswari', NULL, NULL, NULL, NULL, 1, 1),
('2015-05-18 22:39:13', 78, NULL, 123154, NULL, 123157, 110, 'Wira Bau', NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `merawats`
--

CREATE TABLE IF NOT EXISTS `merawats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) NOT NULL,
  `orto_id` int(11) DEFAULT NULL,
  `umum_id` int(11) DEFAULT NULL,
  `pusat_id` int(11) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag_membaca` int(11) NOT NULL DEFAULT '1',
  `flag_outbox` int(11) NOT NULL DEFAULT '1',
  `medicalrecord_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orto_id` (`orto_id`,`umum_id`,`pusat_id`),
  KEY `umum_id` (`umum_id`),
  KEY `pusat_id` (`pusat_id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `medicalrecord_id` (`medicalrecord_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `merawats`
--

INSERT INTO `merawats` (`id`, `pasien_id`, `orto_id`, `umum_id`, `pusat_id`, `waktu`, `flag_membaca`, `flag_outbox`, `medicalrecord_id`) VALUES
(1, 27, NULL, 123154, NULL, '2015-05-18 01:18:12', 2, 1, 0),
(2, 26, NULL, 123154, NULL, '2015-05-16 06:31:04', 1, 1, 0),
(3, 27, NULL, 123154, NULL, '2015-05-20 00:07:27', 2, 1, 0),
(4, 24, NULL, 123154, NULL, '2015-05-16 06:31:15', 1, 1, 0),
(5, 28, NULL, 123154, NULL, '2015-05-19 22:59:11', 2, 2, 0),
(6, 27, NULL, 123154, NULL, '2015-05-16 10:51:06', 1, 1, 0),
(7, 26, NULL, 123154, NULL, '2015-05-16 10:51:11', 1, 1, 0),
(8, 25, NULL, 123154, NULL, '2015-05-16 17:51:45', 2, 1, 0),
(9, 24, NULL, 123154, NULL, '2015-05-19 22:59:03', 2, 2, 0),
(10, 28, NULL, 123154, NULL, '2015-05-18 01:15:44', 2, 1, 0),
(12, 28, NULL, 123154, NULL, '2015-05-18 01:11:55', 2, 1, 1),
(13, 27, NULL, 123154, NULL, '2015-05-18 01:07:03', 2, 1, 2),
(14, 28, NULL, 123154, NULL, '2015-05-17 13:51:19', 2, 1, 4),
(15, 28, NULL, 123154, NULL, '2015-05-18 01:04:25', 2, 2, 4),
(16, 31, 123155, NULL, NULL, '2015-05-19 23:48:11', 2, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE IF NOT EXISTS `pasiens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `doktergigi_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doktergigi_id` (`doktergigi_id`),
  KEY `doktergigi_id_2` (`doktergigi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `pasiens`
--

INSERT INTO `pasiens` (`id`, `nama`, `tanggal_lahir`, `tempat_lahir`, `agama`, `umur`, `alamat_rumah`, `tinggi`, `berat`, `jenis_kelamin`, `warga_negara`, `doktergigi_id`) VALUES
(5, 'ganti lagi hihi haha', '0000-00-00', 'Permatasari ', 'agama', 17, 'halo', 393.20, 21, 'Perempuan', 'indo', 123142),
(7, 'tes baru', '2015-04-22', 'Palembang22', 'buddha', 21, 'Depok', 160.00, 87, 'Perempuan', 'Indonesia', 123142),
(8, 'lslalalallllllllllll', '2015-04-01', 'dmkdkd', 'dddddddddd', 12, 'e', 122.00, 122, 'Perempuan', 'indonesia', 123142),
(9, 'skskksks', '2015-04-01', 'sjsj', 'islam', 12, 'kddkd', 123.00, 12, 'Perempuan', 'Indonesia', 123142),
(10, 'skskksks', '2015-04-01', 'sjsj', 'islam', 12, 'kddkd', 123.00, 12, 'Perempuan', 'Indonesia', 123142),
(11, 'eeee', '2015-04-01', 'eeee', 'islam', 12, 'dddd', 123.00, 12, 'Perempuan', 'in\\\\', 123142),
(12, 'Bena Nadhira', '1994-08-18', 'Palembang', 'Islam', 20, 'Palembang', 165.00, 55, 'Perempuan', 'Indonesia', 123142),
(19, 'vbnm', '2015-04-29', 'nmbnm', '', 78, 'asd', 0.00, 0, '', '', 123155),
(21, 'nbnmbmn', '2015-05-06', 'aasdada', 'asdlad', 78, 'asd', 123.00, 132, 'Perempuan', 'asdlads', 123155),
(24, 'Wira Tania', '2015-04-02', 'Jakarta', 'Kristen', 12, 'jakarta', 122.00, 34, 'Perempuan', 'Indonesia', 123154),
(25, 'LALALLALALALALALLALA', '2015-04-03', 'semarang', 'agama', 45, 'lksdfjlkdsj', 45.00, 45, 'Laki-laki', 'Indonesia', 123154),
(26, 'Mahasiswa', '2015-04-01', 'cdkkdd', 'agama', 15, 'jakarta', 176.00, 87, 'Laki-laki', 'Indonesia', 123154),
(27, 'Chiesa Serena', '2015-04-03', 'Jakarta', 'agama', 16, 'jakarta', 212.20, 54, 'Perempuan', 'Indonesia', 123154),
(28, 'Calvin', '2015-04-06', 'ejejjee', 'islam', 14, 'lksdfjlkdsj', 122.00, 45, 'Perempuan', 'Indonesia', 123154),
(29, 'Mahasiswa Cantik', '2015-04-02', 'semarang', 'agama', 12, 'jakarta', 134.00, 123, 'Perempuan', 'Indonesia', 123155),
(30, 'Wira ganteng sekali', '2015-04-04', 'semarang', 'islam', 34, 'Surga', 167.00, 45, 'Laki-laki', 'Indonesia', 123155),
(31, 'Cita Indraswari', '2015-04-01', 'semarang', 'agama', 23, 'jakarta', 234.32, 145, 'Perempuan', 'Indonesia', 123155);

-- --------------------------------------------------------

--
-- Table structure for table `penggunas`
--

CREATE TABLE IF NOT EXISTS `penggunas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123190 ;

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
(123176, 'lala', '1234', 'Cita Indraswari', '2015-04-01', 'Jakarta', 'Indonesia', 'Perempuan', 'oiopio', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123177, 'adminahadhwwdww', '11111', 'Cita Indraswari', '2015-04-29', 'Jakarta', 'Indonesia', 'Laki-laki', 'Islam', 'uploads/images/man.png', 'n', 'cita.indraswari@gmail.com', 'orthodonti'),
(123178, 'uuuto4u69o3iu59', '123jsjja', 'Cita Indraswari', '2015-05-05', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@gmail.com', 'orthodonti'),
(123179, 'hahahahaha', 'wiracentil', 'Wira', '2015-05-07', 'palembang', 'Indonesia', 'Laki-laki', 'Islam', 'uploads/images/man.png', 'n', 'cita.indraswari@gmail.com', 'orthodonti'),
(123180, 'cetetetete', '727272772', 'Cita Indraswari', '2015-05-07', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@gmail.com', 'orthodonti'),
(123181, 'cetetetete1', '272727272', 'Cita Indraswari', '2015-05-07', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@gmail.com', 'orthodonti'),
(123182, 'remon', '12345', 'Cita Indraswari', '2015-05-06', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@gmail.com', 'umum'),
(123183, 'prasto', '123456', 'Cita Indraswari', '2015-05-01', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@gmail.com', 'umum'),
(123184, 'hahahahahcete', '12345', 'Cita Indraswari', '2015-05-05', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'cita.indraswari@gmail.com', 'umum'),
(123185, 'Cetejago', '6565656565', 'Cita Indraswari', '2015-05-06', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123186, 'Cetejago1', '122222', 'Cita Indraswari', '2015-05-06', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti'),
(123187, 'ahahahhaa', '122344', 'Cita Indraswari', '2015-05-21', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'tania.putrip@gmail.com', 'umum'),
(123188, 'ahahahhaaahahhaha', '7474774', 'Cita Indraswari', '2015-05-21', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'n', 'tania.putrip@gmail.com', 'umum'),
(123189, 'WiraRateh', '12345', 'Wira Bau', '2015-05-20', 'Jakarta', 'Indonesia', 'Perempuan', 'Islam', 'uploads/images/woman.png', 'y', 'cita.indraswari@gmail.com', 'orthodonti');

-- --------------------------------------------------------

--
-- Table structure for table `pesans`
--

CREATE TABLE IF NOT EXISTS `pesans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `isi` varchar(1000) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pengguna_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `flag_membaca` int(11) NOT NULL DEFAULT '1',
  `flag_outbox` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pengguna_id` (`pengguna_id`),
  KEY `penerima_id` (`penerima_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pesans`
--

INSERT INTO `pesans` (`id`, `subject`, `isi`, `waktu`, `pengguna_id`, `penerima_id`, `flag_membaca`, `flag_outbox`) VALUES
(1, 'tes diri sendiri', 'halo', '2015-05-17 05:39:20', 123155, 123155, 2, 2),
(2, 'Pasien dari dokter Cita Indraswari LAGI', 'Haidengan id rujukan1', '2015-05-19 23:01:17', 123154, 123155, 2, 2),
(3, 'coba reply', 'coba reply', '2015-05-16 02:33:52', 123154, 123166, 1, 1),
(4, 'Pasien dari dokter Cita Indraswari LAGI', 'dsfdengan id rujukan3', '2015-05-16 18:42:40', 123154, 123155, 2, 1),
(6, 'halay', 'huluy', '2015-05-18 01:54:20', 123142, 123159, 1, 2),
(7, 'Pasien dari dokter Cita Indraswari LAGI', 'huladengan id rujukan4', '2015-05-17 14:58:02', 123154, 123166, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rujukans`
--

CREATE TABLE IF NOT EXISTS `rujukans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orto_id` int(11) NOT NULL,
  `pusat_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `analisi_id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag_membaca` int(11) NOT NULL DEFAULT '1',
  `flag_outbox` int(11) NOT NULL DEFAULT '1',
  `pengirim_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orto_id` (`orto_id`),
  KEY `pusat_id` (`pusat_id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `analisi_id` (`analisi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rujukans`
--

INSERT INTO `rujukans` (`id`, `orto_id`, `pusat_id`, `pasien_id`, `analisi_id`, `waktu`, `flag_membaca`, `flag_outbox`, `pengirim_id`) VALUES
(1, 123155, 123154, 7, 75, '2015-05-17 02:40:53', 2, 1, 0),
(2, 123166, 123154, 28, 77, '2015-05-16 04:41:04', 1, 1, 0),
(3, 123155, 123154, 7, 75, '2015-05-16 04:41:04', 1, 1, 0),
(4, 123166, 123154, 26, 87, '2015-05-17 06:30:28', 1, 1, 0);

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
