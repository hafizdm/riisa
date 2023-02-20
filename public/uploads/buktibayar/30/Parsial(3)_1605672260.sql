-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 07:49 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pyk_sirii`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(100) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT NULL,
  `jenis_barang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kode_barang`, `jenis_barang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Laptop', '11', 1, '2020-10-30 01:24:18', '2020-10-30 01:24:18', NULL),
(2, 'Printer', '11', 1, '2020-10-30 01:24:34', '2020-10-30 01:24:34', NULL),
(5, 'HEAVY DUTY LEATHER GLOVES FOR OIL/GREASE, CIG 6556 \"SUPER GARD\" BLUE COLOUR', '14', 1, '2020-11-02 01:49:54', '2020-11-02 01:49:54', NULL),
(6, 'FULL BODY HARNESS + DOUBLE LANYARRD (1.5 M LENGTH) AND SHOCK ABSORBER, KARAM PN23 C/W DOUBLE LANYARD', '14', 1, '2020-11-02 01:50:15', '2020-11-02 01:50:15', NULL),
(7, 'HIGH VISIBILITY VEST ORANGE FLUORESCENT OR YELLOW FLUORESCENT CIG IT02 C/W REFLECTIVE', '14', 1, '2020-11-02 01:50:43', '2020-11-02 01:50:43', NULL),
(8, 'EAR PLUG ORIGINAL 3M ULTRAFIT 340-4002 C/W CASING', '14', 2, '2020-11-02 01:51:09', '2020-11-02 01:51:09', NULL),
(9, 'DUSK MASK CIG 801 N95 NIOSH APPROVED (1 BOX : 20 SETS)', '14', 2, '2020-11-02 02:04:42', '2020-11-02 02:04:42', NULL),
(10, 'SAFETY GLASS, SWISSONE - OXYGEN SMOKE, EN166.1, SUBTITUTE DARK SAFETY GLASSES 3M SECURE SF402AF', '14', 2, '2020-11-02 02:07:05', '2020-11-02 02:07:05', NULL),
(11, 'SAFETY GLASS, SWISSONE - OXYGEN CLEAR, EN166.1, SUBTITUTE CLEAR SAFETY GLASSES 3M SECURE SF401AF', '14', 2, '2020-11-02 02:07:29', '2020-11-02 02:07:29', NULL),
(12, 'HIGH VISIBILITY RAIN COAT PANT & CLOTH MODEL', '14', 2, '2020-11-02 02:08:07', '2020-11-02 02:08:07', NULL),
(13, 'PETROVA SAFETY RUBBER SHOES BOOTS, SIZE : TBA (NO. 4/38 TO 10/44)', '14', 2, '2020-11-02 02:08:46', '2020-11-02 02:08:46', NULL),
(14, 'Safety Gloves Summitech  Cut Resistance Gloves - PI6(5)GY, Size L Safety Standard EN388:2016 - 4X44D', '14', 2, '2020-11-02 02:10:58', '2020-11-02 02:10:58', NULL),
(15, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 6', '14', 2, '2020-11-02 02:12:14', '2020-11-02 02:15:04', NULL),
(16, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 7', '14', 2, '2020-11-02 02:15:24', '2020-11-02 02:15:24', NULL),
(17, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 8', '14', 2, '2020-11-02 02:15:53', '2020-11-02 02:15:53', NULL),
(18, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 9', '14', 2, '2020-11-02 02:16:25', '2020-11-02 02:16:25', NULL),
(19, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 9-1/2', '14', 2, '2020-11-02 02:17:09', '2020-11-02 02:17:09', NULL),
(20, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 10', '14', 2, '2020-11-02 02:17:21', '2020-11-02 02:17:21', NULL),
(21, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 11', '14', 2, '2020-11-02 02:17:34', '2020-11-02 02:17:34', NULL),
(22, 'MSA V-Gard Safety Helmet complete with Chin Strap and Ratchet Fastener (Local) Green Colour', '14', 1, '2020-11-02 02:18:55', '2020-11-02 02:18:55', NULL),
(23, 'MSA V-Gard Safety Helmet complete with Chin Strap and Ratchet Fastener (Local) White Colour', '14', 1, '2020-11-02 02:19:22', '2020-11-02 02:19:22', NULL),
(24, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 6', '14', 2, '2020-11-02 02:20:04', '2020-11-02 02:21:10', NULL),
(25, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 7', '14', 2, '2020-11-02 02:20:17', '2020-11-02 02:21:02', NULL),
(26, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 8', '14', 2, '2020-11-02 02:20:28', '2020-11-02 02:20:54', NULL),
(27, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 9', '14', 2, '2020-11-02 02:20:46', '2020-11-02 02:20:46', NULL),
(28, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 9-1/2', '14', 2, '2020-11-02 02:21:33', '2020-11-02 02:21:33', NULL),
(29, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 10', '14', 2, '2020-11-02 02:21:51', '2020-11-02 02:21:51', NULL),
(30, 'Safety Shoes Krusher Boot Type Texas Brown Colour Steel Mid Sole Size : 11', '14', 2, '2020-11-02 02:22:10', '2020-11-02 02:22:10', NULL),
(31, 'IMPACT SAFETY GLOVES MODEL : M08 BO, SYNTHETIC LEATHER PALM, SUMMITECH', '14', 1, '2020-11-02 02:34:28', '2020-11-02 02:34:28', NULL),
(32, 'Multi Purpose Gloves PL6 BK Safety Standard (EN388:2016 – 4131X), Summitech', '14', 2, '2020-11-02 02:37:49', '2020-11-02 07:18:32', NULL),
(33, 'Ear Plug Maxifit Pro, Safety Standard (EN352-2 SNR=26)', '14', 2, '2020-11-02 02:49:52', '2020-11-02 07:17:48', NULL),
(34, 'Flame Resistance Clothing/Brand Nomex IIIA 6.0 oz Color : Navy Blue, Size : M', '14', 2, '2020-11-02 02:56:51', '2020-11-03 04:43:27', NULL),
(35, 'Flame Resistance Clothing/Brand Nomex IIIA 6.0 oz Color : Navy Blue, Size : L', '14', 2, '2020-11-02 02:57:19', '2020-11-03 04:42:49', NULL),
(36, 'Flame Resistance Clothing/Brand Nomex IIIA 6.0 oz Color : Navy Blue, Size : XL', '14', 2, '2020-11-02 02:57:39', '2020-11-03 04:41:52', NULL),
(37, 'Flame Resistance Clothing/Brand Nomex IIIA 6.0 oz Color : Navy Blue, Size : XXL', '14', 2, '2020-11-02 02:58:17', '2020-11-03 04:41:14', NULL),
(38, 'Flame Resistance Clothing/Brand Nomex IIIA 6.0 oz Color : Navy Blue, Size : XXXL', '14', 2, '2020-11-02 02:58:49', '2020-11-03 04:41:00', NULL),
(39, 'Kacamata KINGS KY 2222 Dark Lens', '14', 2, '2020-11-02 03:03:09', '2020-11-02 03:03:09', NULL),
(40, '3M H9P3E Earmuff PELTOR', '14', 1, '2020-11-02 07:19:23', '2020-11-02 07:19:23', NULL),
(41, 'Kings\'s Safety Shoes by HONEYWELL KWD 805 CX', '14', 2, '2020-11-02 07:19:46', '2020-11-02 07:19:46', NULL),
(42, 'LEOPARD EARMUFF LPEM0148', '14', 1, '2020-11-02 07:21:10', '2020-11-02 07:21:47', NULL),
(43, 'HONEYWELL EAR PLUG MAX-30 @100 PAIR/BOX', '14', 2, '2020-11-02 07:21:30', '2020-11-02 07:21:30', NULL),
(44, 'HELMET MSA LOCAL FASTRAC - WHITE COLOUR', '14', 1, '2020-11-02 07:22:53', '2020-11-02 07:22:53', NULL),
(45, 'HELMET MSA LOCAL FASTRAC - GREEN COLOUR', '14', 1, '2020-11-02 07:23:10', '2020-11-02 07:23:10', NULL),
(46, 'CHIN STRAP LOCAL', '14', 2, '2020-11-02 07:23:32', '2020-11-02 07:23:32', NULL),
(47, 'KN95 MASKER DISPOSABLE PROTECTIVE MASK (40 PCS/BO)', '14', 2, '2020-11-02 07:23:46', '2020-11-02 07:23:46', NULL),
(48, 'MILLER MB 9000 FULL BODY HARNESS', '14', 1, '2020-11-02 07:28:07', '2020-11-02 07:28:07', NULL),
(49, 'MILLER MB 9007 FULL DOUBLE LANYARD', '14', 1, '2020-11-02 07:30:49', '2020-11-02 07:30:49', NULL),
(50, 'ARGON GLOVES GL206 SAFEGUARD 10 INCH', '14', 2, '2020-11-02 07:31:06', '2020-11-02 07:31:06', NULL),
(51, 'COVERALL RAPID WITH SCOTLIGHT, MATERIAL : VENTURA USA DRILL, RESLITING YKK', '14', 2, '2020-11-02 07:32:28', '2020-11-02 07:32:28', NULL),
(52, 'COVERALL RAPID WITH SCOTLIGHT, MATERIAL : MARYLAND DRILL - TROPICAL DELUXE, RESLITING KOREA', '14', 2, '2020-11-02 07:33:51', '2020-11-02 07:33:51', NULL),
(53, 'TWO PIECE RAPID WITH SCOTLIGHT, MATERIAL : TAIPAN TROPICAL, RESLITING KOREA', '14', 2, '2020-11-02 07:37:43', '2020-11-02 07:37:43', NULL),
(54, 'KEMEJA RAPID, MATERIAL : TAIPAN TROPICAL', '17', 2, '2020-11-02 07:41:58', '2020-11-02 07:41:58', NULL),
(55, 'Ear Plug Maxifit Pro, Safety Standard (EN352-2 SNR=26)', '17', 2, '2020-11-02 07:42:58', '2020-11-02 07:42:58', NULL),
(56, 'SAFETY GLASS, SWISSONE - OXYGEN CLEAR, EN166.1, SUBTITUTE CLEAR SAFETY GLASSES 3M SECURE SF401AF', '17', 2, '2020-11-02 07:43:31', '2020-11-02 07:43:31', NULL),
(57, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 6', '17', 2, '2020-11-02 07:44:16', '2020-11-02 07:44:16', NULL),
(58, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 7', '17', 2, '2020-11-02 07:44:33', '2020-11-02 07:44:33', NULL),
(59, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 8', '17', 2, '2020-11-02 07:45:28', '2020-11-02 07:45:28', NULL),
(60, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 9', '17', 2, '2020-11-02 07:45:40', '2020-11-02 07:45:40', NULL),
(61, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 10', '17', 2, '2020-11-02 07:45:55', '2020-11-02 07:45:55', NULL),
(62, 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 11', '17', 2, '2020-11-02 07:46:07', '2020-11-02 07:46:07', NULL),
(63, 'MSA V-Gard Safety Helmet complete with Chin Strap and Ratchet Fastener (Local) White Colour', '17', 1, '2020-11-02 07:46:57', '2020-11-02 07:46:57', NULL),
(64, 'MSA V-Gard Safety Helmet complete with Chin Strap and Ratchet Fastener (Local) Green Colour', '17', 2, '2020-11-02 07:47:17', '2020-11-02 07:47:17', NULL),
(65, 'Lenovo E490 06iD Core i5 8265U - 1.6 GHz, BT 4.1, FP, Webcam, MicroSD reader, Gigabit Ethernet, Wifi', '17', 1, '2020-11-02 07:48:51', '2020-11-02 07:48:51', NULL),
(66, 'LENOVO IP 130 75iD Core i3 7020U - upto 2.0GHz, DVDRW, Wifi, RAM 4GB DDR4 (on board) +1slot kosong', '17', 1, '2020-11-02 07:49:27', '2020-11-02 07:49:47', NULL),
(67, 'Office 365 Home Premium (6 Users)', '17', 1, '2020-11-02 07:53:27', '2020-11-02 07:53:27', NULL),
(68, 'Lenovo S145 Core i3 8145U-   2.1G up to 4.9GHz', '17', 1, '2020-11-02 07:54:26', '2020-11-02 07:54:26', NULL),
(69, 'HT Baofeng UV 82 Original (Dualband)', '17', 1, '2020-11-02 07:58:27', '2020-11-02 07:58:27', NULL),
(70, 'Primavera P6 Professional Project Management (PPM) - Application User Perpetual', '17', 1, '2020-11-02 07:58:56', '2020-11-02 07:58:56', NULL),
(71, 'Software Update License & Support (1st year) – Primavera P6 Professional Project Management (PPM)', '17', 1, '2020-11-02 07:59:10', '2020-11-02 07:59:10', NULL),
(72, 'AutoCAD LT 1 Year AutoCAD LT 2020 Commercial New Single-user ELD Annual Subscription', '17', 1, '2020-11-02 07:59:54', '2020-11-02 07:59:54', NULL),
(73, 'Adobe New 1 Years Acrobat Pro DC for Teams', '17', 1, '2020-11-02 08:00:16', '2020-11-02 08:00:16', NULL),
(74, 'UPGRADE HOSTING RAPIDINFRASTRUKTUR.COM KE PAKET ENTERPRISE 10GB DARI 6 APRIL 2020 S/D 3 NOVEMBER 202', '17', 3, '2020-11-02 08:00:51', '2020-11-02 08:01:22', NULL),
(75, 'LENOVO S145 P1iD, Core i5 8265U- 1.6GHz up to 3.9 GHz', '17', 1, '2020-11-02 08:07:59', '2020-11-02 08:07:59', NULL),
(76, 'MSA V-Gard Safety Helmet complete with Chin Strap and Ratchet Fastener (Local) Red Colour', '17', 1, '2020-11-02 08:08:35', '2020-11-02 08:08:35', NULL),
(77, 'MASKER HITAM, BAHAN COMBED COTTON 2 PLY, BORDIR \"RAPID\"', '17', 2, '2020-11-02 08:09:16', '2020-11-02 08:09:16', NULL),
(78, 'VivaDiag IgG/IgM COVID-19 Rapid Test', '17', 2, '2020-11-02 08:09:40', '2020-11-02 08:09:40', NULL),
(79, 'Lenovo ThinkBook 14 - Core i5 1035G7', '17', 1, '2020-11-02 08:10:20', '2020-11-02 08:10:20', NULL),
(80, 'BODY VEST WITH REFLECTIVE, GREEN COLOUR', '17', 1, '2020-11-02 08:11:30', '2020-11-02 08:11:30', NULL),
(81, 'MILLER MB 9000 FULL BODY HARNESS', '16', 1, '2020-11-02 08:12:03', '2020-11-02 08:12:03', NULL),
(82, 'MILLER MB 9007 FULL DOUBLE LANYARD', '17', 1, '2020-11-02 08:12:20', '2020-11-02 08:12:20', NULL),
(83, 'Dell Inspiron 3493 i5-1035G1, 8GB DDR4 2400Mhz', '17', 1, '2020-11-02 08:12:54', '2020-11-02 08:12:54', NULL),
(84, 'ANCHOR BOLT MATERIAL S45C	M12 x 250 (Slurry Sealing Tank), Type J – Panjang Drat sesuai gambar', '17', 2, '2020-11-02 08:13:54', '2020-11-02 08:13:54', NULL),
(86, 'ANCHOR BOLT MATERIAL S45C M12 x 250 (Receiver Water Tank), Type J – Panjang Drat sesuai gambar', '17', 2, '2020-11-02 08:19:29', '2020-11-02 08:19:29', NULL),
(87, 'ANCHOR BOLT MATERIAL S45C M16 x 350 (CO2 Compressor), Type J – Panjang Drat sesuai gambar', '17', 2, '2020-11-02 08:19:51', '2020-11-02 08:21:00', NULL),
(88, 'ANCHOR BOLT MATERIAL S45C M16 x 150 (FRP Water Tank), Type I – Panjang Drat sesuai gambar', '17', 2, '2020-11-02 08:20:34', '2020-11-02 08:20:51', NULL),
(89, 'ANCHOR BOLT MATERIAL S45C M20 x 200 (Flue Gas), Type J – Panjang Drat sesuai gambar', '17', 2, '2020-11-02 08:21:35', '2020-11-02 08:21:35', NULL),
(90, 'ANCHOR BOLT MATERIAL S45C M20 x 200 (CO2 Receiver Tank), Type J – Panjang Drat sesuai gambar', '17', 2, '2020-11-02 08:22:00', '2020-11-02 08:22:00', NULL),
(91, 'Kings\'s Safety Shoes by HONEYWELL KWD 805 CX', '17', 2, '2020-11-02 08:25:22', '2020-11-02 08:25:22', NULL),
(92, 'EVO 3 SLIP SAFETY HELMET JSP, WHITE COLOUR', '17', 1, '2020-11-02 08:25:51', '2020-11-02 08:25:51', NULL),
(93, 'CHIN STRAP, JSP', '17', 2, '2020-11-02 08:26:16', '2020-11-02 08:26:16', NULL),
(94, 'Multi Purpose Gloves PL6 BK Safety Standard (EN388:2016 – 4131X), Summitech', '17', 2, '2020-11-02 08:26:43', '2020-11-02 08:26:43', NULL),
(95, 'Trash Bag 90 x 120 Qty : 50 Pack (1 Pack @6 lembar)', '14', 2, '2020-11-03 04:32:45', '2020-11-03 04:32:45', NULL),
(96, 'LAKBAN COKLAT 2 INCH 100 YARD', '14', 2, '2020-11-03 04:34:12', '2020-11-03 04:34:12', NULL),
(97, 'Dynabolt M16 x 125', '21', 2, '2020-11-03 06:40:56', '2020-11-03 06:41:13', NULL),
(98, 'Dynabolt M20 x 125', '21', 2, '2020-11-03 06:41:39', '2020-11-03 06:41:39', NULL),
(99, 'Ancorbolt Type J M20 x 650', '21', 2, '2020-11-03 06:42:06', '2020-11-03 06:42:06', NULL),
(100, 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size M', '14', 2, '2020-11-03 08:00:39', '2020-11-03 08:02:22', NULL),
(101, 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size L', '14', 2, '2020-11-03 08:02:39', '2020-11-03 08:02:39', NULL),
(102, 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size XL', '14', 2, '2020-11-03 08:02:57', '2020-11-03 08:02:57', NULL),
(103, 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size XXL', '14', 2, '2020-11-03 08:03:09', '2020-11-03 08:03:09', NULL),
(104, 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size XXXL', '14', 2, '2020-11-03 08:03:21', '2020-11-03 08:03:21', NULL),
(105, 'Kantong Plastik Kresek Loco HD', '14', 2, '2020-11-03 08:39:49', '2020-11-03 08:39:49', NULL),
(106, 'Tali ID Card/Lanyard 2 cm Printing Full Colour Material Tissue c/w Stopper & Safety Device', '14', 2, '2020-11-03 09:52:33', '2020-11-03 09:52:46', NULL),
(107, 'Frame ID Card 2 Sisi', '14', 2, '2020-11-03 09:57:22', '2020-11-03 09:57:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cost_account`
--

CREATE TABLE `cost_account` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cost_account`
--

INSERT INTO `cost_account` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'HO', '2020-11-13 09:37:26', '2020-11-13 09:37:26'),
(2, 'Proposal', '2020-11-13 09:37:31', '2020-11-13 09:37:31'),
(3, 'Project', '2020-11-13 09:37:36', '2020-11-13 09:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `general_working_type`
--

CREATE TABLE `general_working_type` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general_working_type`
--

INSERT INTO `general_working_type` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Finance Tax', '2020-11-14 08:37:20', '2020-11-14 08:37:20'),
(2, 'IT Maintenance', '2020-11-14 08:37:30', '2020-11-14 08:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `handphone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `date_joining` date DEFAULT NULL,
  `date_resign` date DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `divisi_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `bpjs` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_cv` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_ijazah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama`, `alamat`, `npwp`, `email`, `handphone`, `agama`, `keterangan`, `date_birth`, `date_joining`, `date_resign`, `jabatan_id`, `divisi_id`, `status`, `bpjs`, `created_at`, `updated_at`, `deleted_at`, `tempat_lahir`, `jenis_kelamin`, `lokasi_id`, `foto`, `file_cv`, `file_ijazah`) VALUES
(19, 'admin', 'admin', 'Jakarta Selatan', '0', 'a@gmail.com', '0', '', NULL, '0000-00-00', '0000-00-00', NULL, 0, NULL, 0, NULL, '2020-10-28 02:50:15', '2020-10-28 02:49:30', NULL, NULL, NULL, 0, '', '', ''),
(20, 'finance', 'finance', '', '', 'a@gmail.com', '', '', NULL, '0000-00-00', '0000-00-00', NULL, 0, NULL, 0, NULL, '2020-10-28 02:50:15', '2020-10-28 02:49:30', NULL, NULL, NULL, 0, '', '', ''),
(21, 'asset.management', 'Asset Management', '', '', 'a@gmail.com', '', '', NULL, '0000-00-00', '0000-00-00', NULL, 0, NULL, 0, NULL, '2020-10-28 02:50:15', '2020-10-28 02:49:30', NULL, NULL, NULL, 0, '', '', ''),
(24, 'HO202002019', 'Ivan Yoga Putra', NULL, NULL, 'a@gmail.com', NULL, 'islam', NULL, NULL, NULL, NULL, 1, 1, 0, NULL, '2020-11-02 00:14:29', '2020-11-02 00:14:29', NULL, NULL, NULL, 3, 'HO202002019/Karyawan_1603867302.jpeg', '', ''),
(26, 'HO201905006', 'Oozaro Berkat Larosa', NULL, NULL, 'a@gmail.com', NULL, 'kristen', NULL, NULL, NULL, NULL, 4, 4, 0, NULL, '2020-11-02 00:40:43', '2020-11-02 00:40:43', NULL, NULL, 'Laki-laki', 3, 'HO201905006/Karyawan_1603867547.jpg', '', ''),
(27, 'HO201905005', 'Kim Shien', NULL, NULL, 'a@gmail.com', NULL, 'kristen', NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2020-11-02 03:37:45', '2020-11-02 03:37:45', NULL, NULL, 'Laki-laki', 0, NULL, '', ''),
(28, 'HO201902001', 'Robby Satria', NULL, NULL, 'a@gmail.com', NULL, 'kristen', NULL, NULL, NULL, NULL, 78, 9, 0, NULL, '2020-11-02 02:49:38', '2020-11-02 02:49:38', NULL, NULL, NULL, 3, 'HO201902001/Karyawan_1604285378.jpeg', '', ''),
(30, 'HO201902002', 'Andhika Susanto', NULL, NULL, 'a@gmail.com', NULL, 'islam', NULL, NULL, NULL, NULL, 88, 3, 0, NULL, '2020-11-02 00:15:47', '2020-11-02 00:15:47', NULL, NULL, NULL, 3, NULL, '', ''),
(32, 'HO202007004', 'Maria Geofrida', NULL, NULL, 'a@gmail.com', NULL, 'kristen', NULL, NULL, NULL, NULL, 65, 4, 0, NULL, '2020-11-02 00:40:05', '2020-11-02 00:40:05', NULL, NULL, NULL, 3, 'HO202007004/Karyawan_1603867170.jpeg', '', ''),
(33, 'SUM202002007', 'Fadhli Habil', NULL, NULL, 'a@gmail.com', NULL, 'islam', NULL, NULL, NULL, NULL, 23, 1, 0, NULL, '2020-11-02 00:13:46', '2020-11-02 00:13:46', NULL, NULL, NULL, 0, 'SUM202002007/Karyawan_1604276015.jpeg', '', ''),
(35, 'HO201902003', 'Jimmy Petra Sanjaya', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 81, 9, 0, NULL, '2020-11-02 02:15:49', '2020-11-02 02:15:49', NULL, NULL, 'Laki-laki', 3, '', '', ''),
(36, 'HO201908010', 'Jani Sumitro Pardosi', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 10, 1, 0, NULL, '2020-11-02 00:47:25', '2020-11-02 00:47:25', NULL, NULL, 'Laki-laki', 3, 'HO201908010/Karyawan_1603867330.jpeg', '', ''),
(37, 'HO201908009', 'Rika Tri Sanjaya', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 0, NULL, '2020-11-02 05:33:54', '2020-11-02 05:33:54', NULL, NULL, NULL, 3, '', '', ''),
(38, 'HO202001013', 'Anita Hari Wijayanti', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 8, 3, 0, NULL, '2020-11-02 01:26:50', '2020-11-02 01:26:50', NULL, NULL, NULL, 3, 'HO202001013/Karyawan_1603867043.jpeg', '', ''),
(39, 'HO202002020', 'Raonensen Tampubolon', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 67, 3, 0, NULL, '2020-11-02 00:43:57', '2020-11-02 00:43:57', NULL, NULL, NULL, 3, 'HO202002020/Karyawan_1603867508.jpeg', '', ''),
(40, 'PRO202002003', 'Danang Pratikto Kurniawan', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 9, 1, 0, NULL, '2020-11-02 00:52:37', '2020-11-02 00:52:37', NULL, NULL, NULL, 4, 'PRO202002003/Karyawan_1603867105.jpeg', '', ''),
(41, 'PRO202002002', 'Ir. Heru Soedjatmiko', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 0, NULL, '2020-11-02 02:12:44', '2020-11-02 02:12:44', NULL, NULL, NULL, 4, '', '', ''),
(42, 'PRO201911001', 'Ridha Fadili', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 11, 1, 0, NULL, '2020-11-02 01:36:03', '2020-11-02 01:36:03', NULL, NULL, NULL, 5, 'PRO201911001/Karyawan_1603866972.jpg', '', ''),
(43, 'HO201902004', 'Sayoga Arifagalih Hidayatullah', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 74, 6, 0, NULL, '2020-11-02 03:35:49', '2020-11-02 03:35:49', NULL, NULL, NULL, 3, '', '', ''),
(44, 'HO201909011', 'Ruth Artha S. Napitupulu', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 64, 4, 0, NULL, '2020-11-02 00:41:23', '2020-11-02 00:41:23', NULL, NULL, NULL, 0, 'HO201909011/Karyawan_1603867586.jpg', '', ''),
(45, 'HO202001014', 'Rut Aprillia Galuh Sarwendah', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 75, 6, 0, NULL, '2020-11-02 02:13:53', '2020-11-02 02:13:53', NULL, NULL, NULL, 3, '', '', ''),
(46, 'HO201910012', 'Doddy Alfon', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 0, NULL, '2020-11-02 00:50:16', '2020-11-02 00:50:16', NULL, NULL, NULL, 3, 'HO201910012/Karyawan_1603867118.jpg', '', ''),
(47, 'HO202002015', 'Selfiyanti', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 0, NULL, '2020-11-02 02:13:35', '2020-11-02 02:13:35', NULL, NULL, NULL, 3, '', '', ''),
(48, 'SUM202002001', 'Geraldo Joseph Frideandra Sirait', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 62, 2, 0, NULL, '2020-11-02 00:49:16', '2020-11-02 00:49:16', NULL, NULL, NULL, 4, 'SUM202002001/Karyawan_1603867184.jpeg', '', ''),
(49, 'SUM202002002', 'Andy Ardian', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 14, 1, 0, NULL, '2020-11-02 01:27:32', '2020-11-02 01:27:32', NULL, NULL, NULL, 4, 'SUM202002002/Karyawan_1603867027.jpg', '', ''),
(50, 'SUM202002003', 'Suwasto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 15, 1, 0, NULL, '2020-11-02 01:47:37', '2020-11-02 01:47:37', NULL, NULL, NULL, 4, 'SUM202002003/Karyawan_1603866542.jpg', '', ''),
(51, 'SUM202002002', 'Feri Irianto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 0, NULL, '2020-11-02 02:13:21', '2020-11-02 02:13:21', NULL, NULL, NULL, 0, '', '', ''),
(52, 'SUM202002011', 'Kitjuk Harijanto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 17, 1, 0, NULL, '2020-10-28 03:37:51', '2020-10-28 03:37:51', NULL, NULL, NULL, 4, '', '', ''),
(53, 'SUM202002012', 'Danang Arif Agustiyan', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 18, 1, 0, NULL, '2020-11-02 01:48:15', '2020-11-02 01:48:15', NULL, NULL, NULL, 4, 'SUM202002012/Karyawan_1603866506.jpg', '', ''),
(54, 'SUM202002004', 'Candra Aji Nugroho', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 19, 1, 0, NULL, '2020-11-02 02:13:11', '2020-11-02 02:13:11', NULL, NULL, NULL, 4, '', '', ''),
(55, 'SUM202002010', 'Hirwin Prayitno', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 20, 1, 0, NULL, '2020-11-02 01:34:37', '2020-11-02 01:34:37', NULL, NULL, NULL, 0, 'SUM202002010/Karyawan_1603866987.jpg', '', ''),
(56, 'SUM202002005', 'Aji Prasetyo', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 18, 1, 0, NULL, '2020-11-02 01:38:57', '2020-11-02 01:38:57', NULL, NULL, NULL, 4, 'SUM202002005/Karyawan_1603866597.jpg', '', ''),
(57, 'SUM202002006', 'Hari Tri Sofyan', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 22, 1, 0, NULL, '2020-11-02 01:37:41', '2020-11-02 01:37:41', NULL, NULL, NULL, 4, 'SUM202002006/Karyawan_1603866924.jpg', '', ''),
(58, 'SUM202002008', 'Muhammad Faqih Alwi', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 24, 1, 0, NULL, '2020-11-02 02:12:58', '2020-11-02 02:12:58', NULL, NULL, NULL, 4, '', '', ''),
(59, 'SUM202002009', 'Firmansyah', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 24, 1, 0, NULL, '2020-11-02 02:12:33', '2020-11-02 02:12:33', NULL, NULL, NULL, 4, '', '', ''),
(60, 'HO202003021', 'Gilang Arrahman Ikhsan V', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 77, 7, 0, NULL, '2020-11-02 03:33:17', '2020-11-02 03:33:17', NULL, NULL, NULL, 3, 'HO202003021/Karyawan_1603867199.jpeg', '', ''),
(61, 'SUM202002011', 'Cecep Fatikurrohman', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 25, 1, 0, NULL, '2020-11-02 00:53:00', '2020-11-02 00:53:00', NULL, NULL, NULL, 4, 'SUM202002011/Karyawan_1603867073.jpeg', '', ''),
(62, 'SUM202002013', 'Cecep Zainal Abidin', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 26, 1, 0, NULL, '2020-11-02 01:38:33', '2020-11-02 01:38:33', NULL, NULL, NULL, 4, 'SUM202002013/Karyawan_1603866892.jpg', '', ''),
(63, 'SUM202003004', 'Sigit Mulyanto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 27, 1, 0, NULL, '2020-11-02 01:39:31', '2020-11-02 01:39:31', NULL, NULL, NULL, 4, 'SUM202003004/Karyawan_1603866584.jpg', '', ''),
(65, 'SUM202003001', 'Tomi Nofianto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 28, 1, 0, NULL, '2020-11-02 01:42:15', '2020-11-02 01:42:15', NULL, NULL, NULL, 4, 'SUM202003001/Karyawan_1603866572.JPG', '', ''),
(66, 'HO202004002', 'Mustafa Dzulakmal', NULL, NULL, 'a@gmail.com', '081213994900', 'islam', NULL, '1996-04-26', '2020-02-04', NULL, 68, 3, 0, NULL, '2020-11-09 06:54:23', '2020-11-10 06:28:09', NULL, 'Pekanbaru', 'Laki-laki', 3, 'HO202004002/Karyawan_1603867495.jpg', 'CV_1604890590.pdf', 'Ijazah_1604904863.pdf'),
(67, 'SUM202004004', 'Muhamad Vicky Driantama', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 29, 1, 0, NULL, '2020-11-02 01:42:51', '2020-11-02 01:42:51', NULL, NULL, NULL, 4, 'SUM202004004/Karyawan_1603866558.JPG', '', ''),
(68, 'SUM202004003', 'Ilhamsyah Merdy Pratama', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 30, 1, 0, NULL, '2020-11-02 00:48:17', '2020-11-02 00:48:17', NULL, 'Jakarta', 'Laki-laki', 4, 'SUM202004003/Karyawan_1603867291.jpg', '', ''),
(69, 'SUM202004006', 'Perdana Putra Aksimaraja', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 31, 1, 0, NULL, '2020-11-02 02:12:22', '2020-11-02 02:12:22', NULL, NULL, NULL, 4, '', '', ''),
(70, 'EXTEP20191202', 'Budhi Timoera', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 32, 1, 0, NULL, '2020-11-02 02:12:11', '2020-11-02 02:12:11', NULL, NULL, NULL, 0, '', '', ''),
(71, 'EXTEP20191203', 'Erdhian Kusuma', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 33, 1, 0, NULL, '2020-11-02 02:12:01', '2020-11-02 02:12:01', NULL, NULL, NULL, 0, '', '', ''),
(72, 'EXTEP20200204', 'Dedeh Herdianto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 34, 1, 0, NULL, '2020-10-28 06:35:59', '2020-10-28 06:35:59', NULL, NULL, NULL, 0, 'EXTEP20200204/Karyawan_1603866959.jpeg', '', ''),
(73, 'EXTEP20200205', 'Meta Yunitasari', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 35, 1, 0, NULL, '2020-11-02 02:11:44', '2020-11-02 02:11:44', NULL, NULL, NULL, 0, '', '', ''),
(74, 'SUM202002014', 'Kateni', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 36, 1, 0, NULL, '2020-11-02 01:36:53', '2020-11-02 01:36:53', NULL, NULL, NULL, 4, 'SUM202002014/Karyawan_1603866940.jpeg', '', ''),
(75, 'SUM202005001', 'Agnetha Febriana Malino', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 37, 1, 0, NULL, '2020-11-02 01:33:41', '2020-11-02 01:33:41', NULL, NULL, NULL, 4, 'SUM202005001/Karyawan_1603867001.jpeg', '', ''),
(76, 'SUM202006003', 'Hanadi Ahmad Algadri', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 38, 1, 0, NULL, '2020-11-02 02:08:31', '2020-11-02 02:08:31', NULL, NULL, NULL, 4, '', '', ''),
(77, 'EXTEP20200605', 'Aris Hardi Yanto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 39, 1, 0, NULL, '2020-11-02 02:02:41', '2020-11-02 02:02:41', NULL, NULL, NULL, 0, '', '', ''),
(78, 'EXTEP20200606', 'Robin Meynrat Purba', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 17, 1, 0, NULL, '2020-11-02 01:59:21', '2020-11-02 01:59:21', NULL, NULL, NULL, 0, '', '', ''),
(79, 'SUM202006010', 'Yudhis Anggono Putro', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 41, 1, 0, NULL, '2020-11-02 01:59:06', '2020-11-02 01:59:06', NULL, NULL, NULL, 4, '', '', ''),
(80, 'EXTEP20200607', 'Sugiyarto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 42, 1, 0, NULL, '2020-11-02 01:58:54', '2020-11-02 01:58:54', NULL, NULL, NULL, 0, '', '', ''),
(81, 'SUM202006008', 'Ronaldo Yunus Lado', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 44, 1, 0, NULL, '2020-11-02 01:57:19', '2020-11-02 01:57:19', NULL, NULL, NULL, 4, '', '', ''),
(82, 'SUM202006009', 'Lady Diana Ridolf', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 35, 1, 0, NULL, '2020-11-02 01:56:48', '2020-11-02 01:56:48', NULL, NULL, NULL, 4, '', '', ''),
(83, 'SUM202006013', 'Ir. Irawan Sarjono', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 45, 1, 0, NULL, '2020-11-02 01:55:46', '2020-11-02 01:55:46', NULL, NULL, NULL, 4, '', '', ''),
(84, 'SUM202007011', 'Yayat Sudrajat', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 46, 1, 0, NULL, '2020-10-28 05:46:29', '2020-10-28 05:46:29', NULL, NULL, NULL, 4, '', '', ''),
(85, 'SUM202007012', 'Bill Jones Albert Lado', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 47, 1, 0, NULL, '2020-11-02 01:54:20', '2020-11-02 01:54:20', NULL, NULL, NULL, 4, '', '', ''),
(86, 'SUM202007013', 'Yerry Awan Susanto', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 48, 1, 0, NULL, '2020-11-02 01:53:37', '2020-11-02 01:53:37', NULL, NULL, NULL, 4, '', '', ''),
(87, 'SUM202007014', 'Jaminan Bison Limbong', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 49, 1, 0, NULL, '2020-10-28 06:41:55', '2020-10-28 06:41:55', NULL, NULL, NULL, 4, 'SUM202007014/Karyawan_1603867315.jpg', '', ''),
(88, 'SUM202007015', 'Muhamad Wafi Izzudien', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 17, 1, 0, NULL, '2020-11-02 01:52:41', '2020-11-02 01:52:41', NULL, NULL, NULL, 4, '', '', ''),
(89, 'HO202007005', 'Jonatan Kevin Daniel', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 76, 6, 0, NULL, '2020-11-02 00:45:36', '2020-11-02 00:45:36', NULL, NULL, NULL, 3, 'HO202007005/Karyawan_1603867483.jpg', '', ''),
(90, 'HO202007006', 'Ruri Setyo Widyasari', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 76, 6, 0, NULL, '2020-11-02 00:42:03', '2020-11-02 00:42:03', NULL, NULL, NULL, 3, 'HO202007006/Karyawan_1603867574.jpeg', '', ''),
(91, 'SUM202007016', 'Asep Lukmanul Hakim', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 51, 1, 0, NULL, '2020-11-02 01:52:18', '2020-11-02 01:52:18', NULL, NULL, NULL, 4, '', '', ''),
(92, 'SUM202007017', 'Kristanto Lubis', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 52, 1, 0, NULL, '2020-10-28 05:51:58', '2020-10-28 05:51:58', NULL, NULL, NULL, 4, '', '', ''),
(93, 'HO202007007', 'Brahmadhiksa Artha Pramesta', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 76, 6, 0, NULL, '2020-11-02 00:53:25', '2020-11-02 00:53:25', NULL, NULL, NULL, 0, 'HO202007007/Karyawan_1603867057.jpg', '', ''),
(94, 'SUM202007018', 'Yudi Setiawan', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, 0, NULL, '2020-11-02 03:37:33', '2020-11-02 03:37:33', NULL, NULL, NULL, 4, '', '', ''),
(95, 'SUM202007019', 'Salman', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 54, 1, 0, NULL, '2020-11-02 01:51:15', '2020-11-02 01:51:15', NULL, NULL, NULL, 4, '', '', ''),
(96, 'HO202007008', 'Nisa Okinadia', NULL, NULL, 'nisa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 69, 3, 0, NULL, '2020-11-05 08:40:30', '2020-11-05 08:40:30', NULL, NULL, NULL, 3, 'HO202007008/Karyawan_1603867519.jpeg', '', ''),
(98, 'SUM202007020', 'Aditya Rahmani Pratama', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 55, 1, 0, NULL, '2020-11-02 01:38:08', '2020-11-02 01:38:08', NULL, NULL, NULL, 4, '', '', ''),
(100, 'HO202008011', 'Nova Gebria', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 56, 1, 0, NULL, '2020-11-02 00:43:03', '2020-11-02 00:43:03', NULL, NULL, NULL, 3, 'HO202008011/Karyawan_1603867534.jpeg', '', ''),
(101, 'HO202008012', 'Rita Utami', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 55, 1, 0, NULL, '2020-11-02 00:42:33', '2020-11-02 00:42:33', NULL, NULL, NULL, 3, 'HO202008012/Karyawan_1603867562.jpeg', '', ''),
(103, 'SUM202008021', 'Dilo Naufal Putra', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 58, 1, 0, NULL, '2020-11-02 01:50:41', '2020-11-02 01:50:41', NULL, NULL, NULL, 4, '', '', ''),
(104, 'SUM202008022', 'Ratno Dini Pitoyo', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 58, 1, 0, NULL, '2020-11-02 01:50:21', '2020-11-02 01:50:21', NULL, NULL, NULL, 4, '', '', ''),
(105, 'HO202009001', 'Yuniar Anggraeni', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 63, 2, 0, NULL, '2020-11-02 01:49:53', '2020-11-02 01:49:53', NULL, NULL, NULL, 3, '', '', ''),
(106, 'HO202009002', 'Berman Nababan', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 66, 4, 0, NULL, '2020-11-02 01:49:22', '2020-11-02 01:49:22', NULL, NULL, NULL, 3, '', '', ''),
(107, 'SUM202009001', 'Zainuddin', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 59, 1, 0, NULL, '2020-11-02 01:48:46', '2020-11-02 01:48:46', NULL, NULL, NULL, 4, '', '', ''),
(108, 'HO202008013', 'Jevinna Euginia Novianty', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 70, 3, 0, NULL, '2020-11-02 00:45:09', '2020-11-02 00:45:09', NULL, NULL, NULL, 3, 'HO202008013/Karyawan_1603867443.jpeg', '', ''),
(109, 'HO201907007', 'Adrianus Baginda Mesiaries', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 0, NULL, '2020-11-02 01:31:39', '2020-11-02 01:31:39', NULL, NULL, NULL, 3, 'HO201907007/Karyawan_1604280672.jpg', '', ''),
(110, 'HO201902005', 'Oozaro Berkat Larosa', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 86, 4, 0, NULL, '2020-11-02 02:57:08', '2020-11-02 02:57:08', NULL, NULL, NULL, 3, 'HO201902005/Karyawan_1604285828.jpg', '', ''),
(111, 'HO201907008', 'Adrianus Baginda Mesiaries', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, 0, NULL, '2020-11-02 03:00:18', '2020-11-02 03:00:18', NULL, NULL, 'laki', 3, 'HO201907008/Karyawan_1604286018.jpg', '', ''),
(112, 'HO201907009', 'Adrianus Baginda', NULL, NULL, 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 85, 3, 0, NULL, '2020-11-02 06:41:46', '2020-11-02 06:41:46', NULL, NULL, NULL, 3, '', '', ''),
(113, 'HRD', 'HRD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-11-04 08:38:30', '2020-11-04 08:38:30', NULL, NULL, NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` int(100) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  `kode_kategori` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id`, `nama_kategori`, `kode_kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 'Bimasena', '16', '2020-10-16 07:50:47', '2020-10-16 07:58:09', NULL),
(11, 'Coorporate', '00', '2020-10-16 07:48:07', '2020-10-16 08:01:48', NULL),
(12, 'RDMP Early Work Tank', '01', '2020-10-16 07:48:26', '2020-10-16 07:48:26', NULL),
(13, 'Kujang PPCO', '05', '2020-10-16 07:48:38', '2020-10-16 07:48:38', NULL),
(14, 'TEP MPS', '07', '2020-10-16 07:48:51', '2020-10-16 07:48:51', NULL),
(15, 'RDMP WWTP', '08', '2020-10-16 07:49:03', '2020-10-16 07:49:03', NULL),
(16, 'JTB Evaporation & Crystalization', '09', '2020-10-16 07:49:24', '2020-10-16 07:49:24', NULL),
(17, 'MSM - PMT', '10', '2020-10-16 07:49:35', '2020-10-16 07:49:35', NULL),
(18, 'Methanol Fuel', '11', '2020-10-16 07:49:57', '2020-10-16 07:49:57', NULL),
(19, 'RDMP - SCTU', '13', '2020-10-16 07:50:10', '2020-10-16 07:50:10', NULL),
(20, 'JTB Flowline', '14', '2020-10-16 07:50:22', '2020-10-16 07:50:22', NULL),
(21, 'MSM - Engineering', '15', '2020-10-16 07:50:37', '2020-10-16 07:50:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_project`
--

CREATE TABLE `lokasi_project` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `code_loc` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi_project`
--

INSERT INTO `lokasi_project` (`id`, `nama`, `lokasi`, `code_loc`, `created_at`, `updated_at`) VALUES
(0, 'TEP Project', 'Papua', 'TA', '2020-09-30 16:18:57', '2020-09-30 16:24:22'),
(3, 'Head Office', 'Jakarta', 'HO', '2020-09-30 16:23:22', '2020-09-30 16:23:22'),
(4, 'Sumba Batik', 'Sumba', 'SU', '2020-09-30 16:24:15', '2020-09-30 16:24:15'),
(5, 'RDMP Pertamina Balik Papan', 'Balik Papan', 'RDMP', '2020-09-30 16:25:06', '2020-09-30 16:25:06'),
(7, 'JTB', 'Batam', 'JTB', '2020-11-13 02:13:23', '2020-11-13 02:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `master_divisi`
--

CREATE TABLE `master_divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_divisi`
--

INSERT INTO `master_divisi` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Project Services & Operation', 'Project Services & Operation', '2020-10-22 08:31:40', '2020-10-22 08:31:40', NULL),
(2, 'Strategic Planning & Marketing', 'Strategic Planning & Marketing', '2020-10-22 08:31:47', '2020-10-22 08:31:47', NULL),
(3, 'Finance & Support', 'Finance & Support', '2020-10-22 08:32:10', '2020-10-22 08:32:10', NULL),
(4, 'Business Development', 'Business Development', '2020-10-22 08:32:15', '2020-10-22 08:32:15', NULL),
(6, 'Technology & Innovation', 'Technology & Innovation', '2020-10-22 08:33:08', '2020-10-22 08:33:08', NULL),
(7, 'System & Development', 'System & Development', '2020-10-22 08:33:26', '2020-10-22 08:33:26', NULL),
(9, 'Board Of Director', 'Board Of Director', '2020-10-22 20:33:51', '2020-10-22 20:33:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jabatan`
--

CREATE TABLE `master_jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_jabatan`
--

INSERT INTO `master_jabatan` (`id`, `jenis_jabatan`, `divisi_id`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vice President', 1, 'Vice President', '2020-10-22 10:10:35', '2020-10-22 10:10:35', NULL),
(2, 'Vice President', 2, 'Vice President', '2020-10-22 10:10:50', '2020-10-22 10:10:50', NULL),
(3, 'Vice President', 3, 'Vice President', '2020-10-22 10:11:04', '2020-10-22 10:11:04', NULL),
(4, 'Vice President', 4, 'Vice President', '2020-10-22 10:11:12', '2020-10-22 10:11:12', NULL),
(5, 'Project Manager', 1, 'Project Manager Tangguh', '2020-10-22 10:11:23', '2020-10-22 10:11:35', NULL),
(6, 'Construction Manager', 1, 'Construction Manager', '2020-10-22 10:11:44', '2020-10-22 12:36:05', '2020-10-22 12:36:05'),
(7, 'Specialist Procurement', 1, 'Specialist Procurement', '2020-10-22 10:11:58', '2020-10-22 10:11:58', NULL),
(8, 'Receivable Staff', 3, 'Receivable Staff', '2020-10-22 10:12:12', '2020-10-22 10:12:12', NULL),
(9, 'Project Control Manager', 1, 'Project Control Manager', '2020-10-22 10:13:26', '2020-10-22 10:13:26', NULL),
(10, 'Construction Manager', 1, 'Construction Manager', '2020-10-22 10:13:35', '2020-10-22 10:13:35', NULL),
(11, 'Specialist QC', 1, 'Specialist QC', '2020-10-22 10:13:44', '2020-10-22 10:13:44', NULL),
(12, 'GA Project', 1, 'GA Project', '2020-10-22 10:13:52', '2020-10-22 10:13:52', NULL),
(13, 'Staff Secretary', 1, 'Staff Secretary', '2020-10-22 10:14:00', '2020-10-22 10:14:00', NULL),
(14, 'Project Control Scheduler', 1, 'Project Control Scheduler', '2020-10-22 10:14:08', '2020-10-22 10:14:08', NULL),
(15, 'Piping Engineer', 1, 'Piping Engineer', '2020-10-22 10:14:16', '2020-10-22 10:14:16', NULL),
(16, 'Document Control Staff', 1, 'Document Control Staff', '2020-10-22 10:14:23', '2020-10-22 10:21:09', '2020-10-22 10:21:09'),
(17, 'Material Control', 1, 'Material Control', '2020-10-22 10:14:31', '2020-10-22 10:21:04', '2020-10-22 10:21:04'),
(18, 'Engineer Coordinator', 1, 'Engineer Coordinator', '2020-10-22 10:14:38', '2020-10-22 10:14:38', NULL),
(19, 'Process Engineer (Pre Com)', 1, 'Process Engineer (Pre Com)', '2020-10-22 10:14:47', '2020-10-22 10:14:47', NULL),
(20, 'Mechanical & Strukture Inspector', 1, 'Mechanical & Strukture Inspector', '2020-10-22 10:14:57', '2020-10-22 10:14:57', NULL),
(21, 'Steel Structure Superintendent', 1, 'Steel Structure Superintendent', '2020-10-22 10:15:04', '2020-10-22 10:15:04', NULL),
(22, 'Construction Engineer', 1, 'Construction Engineer', '2020-10-22 10:15:11', '2020-10-22 10:15:11', NULL),
(23, 'Civil Superintendent', 1, 'Civil Superintendent', '2020-10-22 10:15:17', '2020-10-22 10:15:17', NULL),
(24, 'GA & HR Project', 1, 'GA & HR Project', '2020-10-22 10:15:24', '2020-10-22 10:15:24', NULL),
(25, 'Document Control', 1, 'Document Control', '2020-10-22 10:15:32', '2020-10-22 10:15:32', NULL),
(26, 'Electrical Superintendent', 1, 'Electrical Superintendent', '2020-10-22 10:15:38', '2020-10-22 10:15:38', NULL),
(27, 'Piping Junior Designer', 1, 'Piping Junior Designer', '2020-10-22 10:15:45', '2020-10-22 10:15:45', NULL),
(28, 'Process Engineer', 1, 'Process Engineer', '2020-10-22 10:15:55', '2020-10-22 10:15:55', NULL),
(29, 'Electrical Instrument Engineer', 1, 'Electrical Instrument Engineer', '2020-10-22 10:16:02', '2020-10-22 10:16:02', NULL),
(30, 'HSSE Project Coordinator', 1, 'HSSE Project Coordinator', '2020-10-22 10:16:10', '2020-10-22 10:16:10', NULL),
(31, 'Subcontracting Engineer', 1, 'Subcontracting Engineer', '2020-10-22 10:16:18', '2020-10-22 10:16:18', NULL),
(32, 'HSSE Project Manager', 1, 'HSSE Project Manager', '2020-10-22 10:16:29', '2020-10-22 10:16:29', NULL),
(33, 'Drafter', 1, 'Drafter', '2020-10-22 10:16:37', '2020-10-22 10:16:37', NULL),
(34, 'Piping  Supervisor', 1, 'Piping  Supervisor', '2020-10-22 10:16:45', '2020-10-22 10:16:45', NULL),
(35, 'Admin QC', 1, 'Admin QC', '2020-10-22 10:16:51', '2020-10-22 10:16:51', NULL),
(36, 'Mechanical Superintendent', 1, 'Mechanical Superintendent', '2020-10-22 10:16:58', '2020-10-22 10:16:58', NULL),
(37, 'Admin Engineer', 1, 'Admin Engineer', '2020-10-22 10:17:05', '2020-10-22 10:17:05', NULL),
(38, 'Admin Project', 1, 'Admin Project', '2020-10-22 10:17:12', '2020-10-22 10:17:12', NULL),
(39, 'Utility', 1, 'Utility', '2020-10-22 10:17:20', '2020-10-22 10:17:20', NULL),
(40, 'Material Control', 1, 'Material Control', '2020-10-22 10:17:27', '2020-10-22 10:20:56', '2020-10-22 10:20:56'),
(41, 'HSSE Staff', 1, 'HSSE Staff', '2020-10-22 10:17:33', '2020-10-22 10:17:33', NULL),
(42, 'Scafolding', 1, 'Scafolding', '2020-10-22 10:17:40', '2020-10-22 10:17:40', NULL),
(44, 'HSSE Officer', 1, 'HSSE Officer', '2020-10-22 10:17:57', '2020-10-22 10:17:57', NULL),
(45, 'Comissioning Manager', 1, 'Comissioning Manager', '2020-10-22 10:18:14', '2020-10-22 10:18:14', NULL),
(46, 'Electrical Supervisor', 1, 'Electrical Supervisor', '2020-10-22 10:18:22', '2020-10-22 10:18:22', NULL),
(47, 'GA Project Staff', 1, 'GA Project Staff', '2020-10-22 10:18:30', '2020-10-22 10:18:30', NULL),
(48, 'Mechanical Eng.', 1, 'Mechanical Eng.', '2020-10-22 10:18:38', '2020-10-22 10:18:38', NULL),
(49, 'QC Piping Inspector', 1, 'QC Piping Inspector', '2020-10-22 10:18:45', '2020-10-22 10:18:45', NULL),
(50, 'Material Control', 1, 'Material Control', '2020-10-22 10:18:54', '2020-10-22 10:18:54', NULL),
(51, 'Subcontract Engineer', 1, 'Subcontract Engineer', '2020-10-22 10:19:02', '2020-10-22 10:19:02', NULL),
(52, 'E/I QC Inspector', 1, 'E/I QC Inspector', '2020-10-22 10:19:10', '2020-10-22 10:19:10', NULL),
(53, 'Project Manager Sumba', 1, 'Project Manager Sumba', '2020-10-22 10:19:17', '2020-10-22 12:30:21', '2020-10-22 12:30:21'),
(54, 'Mechanical Engineer', 1, 'Mechanical Engineer', '2020-10-22 10:19:25', '2020-10-22 10:19:25', NULL),
(55, 'Civil Engineer', 1, 'Civil Engineer', '2020-10-22 10:19:33', '2020-10-22 10:19:33', NULL),
(56, 'HSSE Coordinator Head', 1, 'HSSE Coordinator Head', '2020-10-22 10:19:40', '2020-10-22 10:19:40', NULL),
(57, 'Cost Control', 1, 'Cost Control', '2020-10-22 10:19:54', '2020-10-22 10:19:54', NULL),
(58, 'Jr. Project Control', 1, 'Jr. Project Control', '2020-10-22 10:20:06', '2020-10-22 10:20:06', NULL),
(59, 'Pre Comm/Comm. Engineer', 1, 'Pre Comm/Comm. Engineer', '2020-10-22 10:20:16', '2020-10-22 10:20:16', NULL),
(60, 'Electrical Engineer', 1, 'Electrical Engineer', '2020-10-22 10:20:29', '2020-10-22 10:20:29', NULL),
(61, 'Project Control', 1, 'Project Control', '2020-10-22 10:20:45', '2020-10-22 10:20:45', NULL),
(62, 'Jr. Project Engineer', 2, 'Jr. Project Engineer', '2020-10-22 10:21:59', '2020-10-22 10:21:59', NULL),
(63, 'Business Development Staff', 2, 'Business Development Staff', '2020-10-22 10:22:11', '2020-10-22 10:22:11', NULL),
(64, 'Jr. Staff Bussiness Dev.', 4, 'Jr. Staff Bussiness Dev.', '2020-10-22 10:22:33', '2020-10-22 10:22:33', NULL),
(65, 'Busdev Adm.', 4, 'Busdev Adm.', '2020-10-22 10:22:43', '2020-10-22 10:22:43', NULL),
(66, 'Project Engineer', 4, 'Project Engineer', '2020-10-22 10:22:57', '2020-10-22 10:22:57', NULL),
(67, 'Specialist Legal', 3, 'Specialist Legal', '2020-10-22 10:23:25', '2020-10-22 10:23:25', NULL),
(68, 'IT Specialist', 3, 'IT Specialist', '2020-10-22 10:23:53', '2020-10-22 10:23:53', NULL),
(69, 'Payable & Tax Specialist', 3, 'Payable & Tax Specialist', '2020-10-22 10:24:05', '2020-10-22 10:24:05', NULL),
(70, 'Cost Control', 3, 'Cost Control', '2020-10-22 10:24:14', '2020-10-22 10:24:14', NULL),
(73, 'Staff Process Engineer', 6, 'Staff Process Engineer', '2020-10-22 10:25:24', '2020-10-22 10:25:24', NULL),
(74, 'Staff Process Engineer', 6, 'Staff Process Engineer', '2020-10-22 10:25:37', '2020-10-22 10:25:37', NULL),
(75, 'Jr. Staff Process Engineer', 6, 'Jr. Staff Process Engineer', '2020-10-22 10:25:46', '2020-10-22 10:25:46', NULL),
(76, 'Junior Process Engineer', 6, 'Junior Process Engineer', '2020-10-22 10:25:56', '2020-10-22 10:25:56', NULL),
(77, 'System Dev. Manager', 7, 'System Dev. Manager', '2020-10-22 10:26:18', '2020-10-22 10:26:18', NULL),
(78, 'Direktur Utama', 9, 'Direktur Utama', '2020-10-22 10:28:33', '2020-10-22 10:28:33', NULL),
(79, 'Komisaris', 9, 'Komisaris', '2020-10-22 10:28:55', '2020-10-22 10:28:55', NULL),
(80, 'Direktur Finance', 9, 'Direktur Finance', '2020-10-22 10:29:08', '2020-10-22 10:29:08', NULL),
(81, 'Direktur Teknologi', 9, 'Direktur Teknologi', '2020-10-22 10:29:19', '2020-10-22 10:29:19', NULL),
(82, 'Manager Project Services & Operation', 1, 'Manager Project Services & Operation', '2020-10-22 12:52:35', '2020-10-22 12:52:35', NULL),
(83, 'Manager Technology & Innovation', 6, 'Manager Technology & Innovation', '2020-10-22 12:52:55', '2020-10-22 12:52:55', NULL),
(84, 'Manager Strategic Planning & Marketing', 2, 'Manager Strategic Planning & Marketing', '2020-10-22 12:53:20', '2020-10-22 12:53:20', NULL),
(85, 'Manager Finance & Support', 3, 'Manager Finance & Support', '2020-10-22 12:53:44', '2020-10-22 12:53:44', NULL),
(86, 'Manager Busdev', 4, 'Manager Busdev', '2020-10-22 12:53:59', '2020-10-22 12:53:59', NULL),
(88, 'Chief Finance Officer', 3, 'Chief Finance Officer', '2020-10-23 01:32:33', '2020-10-23 01:32:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_jenis_barang`
--

CREATE TABLE `master_jenis_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_jenis_barang`
--

INSERT INTO `master_jenis_barang` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Asset', '2020-10-11 09:46:15', '2020-10-11 09:46:15'),
(2, 'Non Asset\r\n', '2020-10-11 09:46:27', '2020-10-11 09:46:27'),
(3, 'Jasa', '2020-10-11 09:46:34', '2020-10-11 09:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `master_vendor`
--

CREATE TABLE `master_vendor` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank_1` varchar(100) DEFAULT NULL,
  `bank_account_1` varchar(100) DEFAULT NULL,
  `bank_rekening_1` varchar(100) DEFAULT NULL,
  `bank_2` varchar(100) DEFAULT NULL,
  `bank_account_2` varchar(100) DEFAULT NULL,
  `bank_rekening_2` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_vendor`
--

INSERT INTO `master_vendor` (`id`, `nama`, `alamat`, `contact_person`, `phone_no`, `email`, `bank_1`, `bank_account_1`, `bank_rekening_1`, `bank_2`, `bank_account_2`, `bank_rekening_2`, `keterangan`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT. BAJU KEREN', 'Jl. Pertengahan', 'cici', '0989765655', 'bajukeren@gmail.com', 'Mandiri', 'bajukeren', '09876556737373', NULL, NULL, NULL, 'dataa', 1, NULL, NULL, '2020-10-26 03:04:43', '2020-10-26 03:09:50', '2020-10-26 03:09:50'),
(2, 'tesA', 'tes', 'tes', '0', 'a@mail.com', '0', '0', '0', NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:42:02', '2020-10-28 05:42:23', '2020-10-28 05:42:23'),
(3, 'BERKAT NIAGA DUNIA, PT', 'Jl. Cideng Barat 47-D, Jakarta - 10150', 'ADI KURNIAWAN', '6327060, 6327065', 'adi@berkatsafety.co.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:47:46', '2020-11-02 00:09:37', NULL),
(4, 'TRATAS MEGAH LESTARI, PT', 'Gedung Kimia Sakti Kalista, Lantai 3A, Jl. Siantar No. 15, Cideng, Gambir, Jakpus', 'Kevin', '021 351 4528', 'customer.services@tratasmegahlestari.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:48:55', '2020-10-28 06:22:53', NULL),
(5, 'TRIMANUNGGAL SEJAHTERA, PT', 'Jl. P. Jayakarta 141 Blok E No. 16, Jakarta Pusat 10730', 'Ratna', '021 6243928', 'sales@trimanunggal.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:50:05', '2020-10-28 06:22:38', NULL),
(6, 'Toko Bintang Safety Kenari', 'Gedung Plaza Kenari Mas Lt. F2 Blok HC01-HC03, Jakarta Pusat,  DKI Jakarta', 'SHINTA', '02129922392, 0821229', 'bintangsafety89@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:51:37', '2020-10-28 06:22:31', NULL),
(7, 'VISITAMA MANDIRI', 'Larangan Selatan Gg. H. Sadeli RT 005 RW 006 - No. 72, RT 004/RW 001, Kec. Larangan, Kota Tangerang, Banten 15155', 'Eri Irawan', '0878-0989-7746', 'visitama.mandiri@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:57:44', '2020-10-28 06:22:24', NULL),
(8, 'DUNIA CAKRAWALA AGUNG, PT', 'Jl. Hayam Wuruk No. 127 Gdg. LTC Glodok Lt. GF 2 Blok A26 No. 6-7', 'FEBA BHAYU SANDIKHA S.E', '021 2268 4586, 2268', 'sales@duniasafety.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 05:59:33', '2020-10-28 06:22:17', NULL),
(9, 'Toko Fajar Teknik', 'LTC Glodok Jalan Hayam Wuruk No.127 Lt. GF2 Blok C15 No. 1 & 5, RT.2/RW.4, Mangga Besar, Jakarta Barat, Jakarta 11180', 'Michael', '021 62201753', 'michael@fajarteknik.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 06:03:35', '2020-10-28 06:14:37', NULL),
(10, 'tes', 'Jakarta Selatan', 'tes', '0', NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-10-28 06:07:03', '2020-10-28 06:07:07', '2020-10-28 06:07:07'),
(11, 'DUNIA SAFTINDO', 'Mega Kemayoran Office Tower A Lt.5Jl. Angkasa Kav.B6 Kota Baru Bandar KemayoranJakarta 10610', 'Yessica', '021 29371188', 'tele3@safetyindonesia.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2020-10-28 06:57:34', '2020-10-28 07:01:26', NULL),
(12, 'FULINA OLINA, PT', 'MANGGA DUA SQUARE LT. 2, BLOK A NO. 137-138\r\nPADEMANGAN BARAT, PADEMANGAN, JAKARTA UTARA', 'Eddy', '0818-822-655, 021 62', 'sales1@fessadistribution.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-10-28 07:12:56', '2020-10-28 07:12:56', NULL),
(13, 'ERAKOMP INFONUSA, PT', '88 Tower 20th Floor - Kota Kasablanka\r\nJL. Casablanca No.88 - Jakarta Selatan', 'Syaiful Bahri', '021 8064 0799, 08588', 'syaiful@erakomp.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-10-28 07:23:13', '2020-10-28 07:23:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_vendor_category`
--

CREATE TABLE `master_vendor_category` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_07_15_155657_create_karyawan_table', 1),
(2, '2019_07_15_160840_create_libur_table', 2),
(3, '2019_07_15_161218_create_karyawan_aplikasi_table', 3),
(4, '2019_07_15_161237_create_aplikasi_table', 3),
(5, '2019_07_15_161255_create_lembur_table', 3),
(6, '2019_07_15_161314_create_jabatan_table', 3),
(7, '2019_07_15_161353_create_divisi_table', 3),
(8, '2019_07_15_161605_create_karyawan_absensi_table', 3),
(9, '2019_07_15_161643_create_karyawan_lembur_table', 3),
(10, '2019_07_15_161714_create_kantor_table', 3),
(11, '2019_07_15_161734_create_beban_tujuan_table', 3),
(12, '2019_07_15_161748_create_kota_table', 3),
(13, '2019_07_15_161807_create_provinsi_table', 3),
(14, '2019_07_15_161828_create_karyawan_leave_table', 3),
(15, '2019_07_15_161843_create_karyawan_leave_log_table', 3),
(16, '2019_07_25_160440_create_users_table', 4),
(17, '2019_07_25_160518_create_role_table', 4),
(18, '2019_11_05_115820_create_karyawan_permission_table', 5),
(19, '2019_11_05_121700_create_karyawan_permission_trail_table', 5),
(20, '2019_11_05_122609_create_karyawan_permission_log_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int(11) NOT NULL,
  `id_karyawan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_institusi` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jenjang_pendidikan` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `ipk` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `id_karyawan`, `nama_institusi`, `tgl_masuk`, `tgl_keluar`, `jenjang_pendidikan`, `jurusan`, `lokasi`, `ipk`, `created_at`, `updated_at`) VALUES
(1, 'HO202004002', 'Politeknik Caltex Riau', '2014-08-14', '2019-11-24', 'S1', 'Teknik Informatika', 'Riau', '3.90', '2020-11-08 14:58:51', '2020-11-08 16:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `pengalaman`
--

CREATE TABLE `pengalaman` (
  `id` int(11) NOT NULL,
  `id_karyawan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `gaji` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengalaman`
--

INSERT INTO `pengalaman` (`id`, `id_karyawan`, `nama_perusahaan`, `tgl_mulai`, `tgl_selesai`, `posisi`, `gaji`, `created_at`, `updated_at`) VALUES
(5, 'HO202004002', 'PT. ABC', '2015-11-03', '2021-11-03', 'QA', 6000000, '2020-11-06 10:05:20', '2020-11-08 14:46:41'),
(10, 'HO202004002', 'PT. Trakindo Utama', '2015-10-26', '2018-11-04', 'IT Specialist', 4500000, '2020-11-08 14:10:13', '2020-11-08 14:10:13'),
(11, 'HO202004002', 'PT. AZ', '2009-11-04', '2011-11-03', 'IT Specialist', 4500000, '2020-11-09 02:28:55', '2020-11-12 01:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'master_kota'),
(2, 'master_provinsi'),
(3, 'master_divisi'),
(4, 'master_jabatan'),
(5, 'master_kantor'),
(6, 'master_level'),
(7, 'master_karyawan'),
(8, 'karyawan_absensi'),
(9, 'karyawan_lembur'),
(10, 'working_schedule'),
(11, 'master_libur'),
(12, 'master_lembur_rest'),
(13, 'karyawan_leave'),
(14, 'karyawan_leave_log'),
(15, 'karyawan_leave_trail'),
(16, 'master_leave_type'),
(17, 'karyawan_leave_quota'),
(18, 'master_lembur');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `resource_id` varchar(100) NOT NULL,
  `man_hours` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `status_approved` int(11) NOT NULL,
  `tgl_approved` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `nama`, `lokasi_id`, `resource_id`, `man_hours`, `status`, `status_approved`, `tgl_approved`, `created_at`, `updated_at`) VALUES
(1, 'Proposal JTB', 7, '1,3', 0, 0, 1, '2020-11-14 09:39:39', '2020-11-13 02:07:10', '2020-11-13 02:07:10'),
(14, 'Proposal A', 5, '1,2,3', 0, 0, 1, NULL, '2020-11-13 07:32:40', '2020-11-13 07:32:40'),
(15, 'Proposal C', 7, '2,3', 0, 0, 1, NULL, '2020-11-16 07:31:07', '2020-11-16 07:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `request_barang`
--

CREATE TABLE `request_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `kode_barang` char(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `nama_proyek` varchar(100) NOT NULL,
  `status_pengajuan` int(11) NOT NULL,
  `status_PO` int(11) NOT NULL,
  `updated_manager_by` varchar(50) NOT NULL,
  `updated_vp_by` varchar(50) NOT NULL,
  `updated_ceo_by` varchar(50) NOT NULL,
  `updated_manager_po_by` varchar(100) NOT NULL,
  `updated_ceo_po_by` varchar(100) NOT NULL,
  `updated_cfo_po_by` varchar(100) NOT NULL,
  `updated_vp_po_by` varchar(100) NOT NULL,
  `updated_co_po_by` varchar(100) NOT NULL,
  `status_paid` int(11) NOT NULL,
  `quantity_satuan` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `divisi_id` int(11) NOT NULL,
  `upload_po` varchar(100) DEFAULT NULL,
  `upload_invoice` varchar(100) DEFAULT NULL,
  `updated_vp_pay_by` varchar(100) NOT NULL,
  `updated_ceo_pay_by` varchar(100) NOT NULL,
  `updated_manager_pay_by` varchar(100) NOT NULL,
  `updated_cfo_pay_by` varchar(100) NOT NULL,
  `updated_co_pay_by` varchar(100) NOT NULL,
  `upload_bukti_bayar` varchar(100) NOT NULL,
  `jenis_barang` int(11) NOT NULL,
  `komentar_vp` varchar(100) NOT NULL,
  `komentar_ceo` varchar(100) NOT NULL,
  `keterangan_by_cc` varchar(100) NOT NULL,
  `upload_cba` varchar(100) NOT NULL,
  `upload_tba` varchar(100) NOT NULL,
  `tanggal_pengeluaran` timestamp NULL DEFAULT NULL,
  `tgl_pengajuan_pengeluaran` timestamp NULL DEFAULT NULL,
  `status_brg_keluar` int(11) NOT NULL,
  `updated_asset_by` varchar(50) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `no_payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_barang`
--

INSERT INTO `request_barang` (`id`, `nama`, `nik`, `kode_barang`, `nama_barang`, `harga`, `quantity`, `total`, `nama_proyek`, `status_pengajuan`, `status_PO`, `updated_manager_by`, `updated_vp_by`, `updated_ceo_by`, `updated_manager_po_by`, `updated_ceo_po_by`, `updated_cfo_po_by`, `updated_vp_po_by`, `updated_co_po_by`, `status_paid`, `quantity_satuan`, `keterangan`, `tanggal_pengajuan`, `created_at`, `updated_at`, `divisi_id`, `upload_po`, `upload_invoice`, `updated_vp_pay_by`, `updated_ceo_pay_by`, `updated_manager_pay_by`, `updated_cfo_pay_by`, `updated_co_pay_by`, `upload_bukti_bayar`, `jenis_barang`, `komentar_vp`, `komentar_ceo`, `keterangan_by_cc`, `upload_cba`, `upload_tba`, `tanggal_pengeluaran`, `tgl_pengajuan_pengeluaran`, `status_brg_keluar`, `updated_asset_by`, `no_request`, `no_po`, `no_payment`) VALUES
(30, 'Doddy Alfon', 'HO201910012', '14', 'Kantong Plastik Kresek Loco HD', 19000, 10, 190000, '0', 3, 1, 'Kim Shien', 'Ivan Yoga Putra', 'Robby Satria', '', '', '', '', 'Jevinna Euginia Novianty', 0, 'pcs', 'mohon diproses', '2020-11-03', '2020-11-03 09:18:30', '2020-11-12 02:32:06', 1, '30/PO_1604452884.pdf', NULL, '', '', '', '', '', '', 2, 'Approve', 'Ok', 'OK', '30/CBA_1604452884.pdf', '30/TBA_1604452884.pdf', NULL, NULL, 0, '', '', '', ''),
(32, 'Doddy Alfon', 'HO201910012', '14', 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size XXL', 850000, 10, 8500000, '0', 3, 0, 'Kim Shien', 'Ivan Yoga Putra', 'Robby Satria', '', '', '', '', '', 0, 'pcs', 'mohon proses', '2020-11-03', '2020-11-03 09:38:07', '2020-11-04 00:30:40', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', 'Ok', '', '', '', NULL, NULL, 0, '', '', '', ''),
(33, 'Doddy Alfon', 'HO201910012', '14', 'Flame Retardant/Walls FR Coverall, 7 oz 100% Cotton FR Twill with Reflective Tape,  Size XXXL', 900000, 6, 5400000, '0', 3, 1, 'Kim Shien', 'Ivan Yoga Putra', 'Robby Satria', '', '', '', '', 'Jevinna Euginia Novianty', 0, 'pcs', 'mohon diproses', '2020-11-03', '2020-11-03 09:40:19', '2020-11-12 02:41:41', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', 'Ok', 'OK', '', '', NULL, NULL, 0, '', '', '', ''),
(34, 'Doddy Alfon', 'HO201910012', '14', 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 6', 312000, 5, 1560000, '0', 3, 0, 'Kim Shien', 'Ivan Yoga Putra', 'Robby Satria', '', '', '', '', '', 0, 'pcs', 'mohon di proses', '2020-11-03', '2020-11-03 09:43:52', '2020-11-04 00:30:51', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', 'Ok', '', '', '', NULL, NULL, 0, '', '', '', ''),
(35, 'Doddy Alfon', 'HO201910012', '14', 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 7', 320000, 4, 1280000, '0', 3, 1, 'Kim Shien', 'Ivan Yoga Putra', 'Robby Satria', '', '', '', '', 'Jevinna Euginia Novianty', 0, 'pcs', 'mohon diproses', '2020-11-03', '2020-11-03 09:45:28', '2020-11-12 02:42:12', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', 'Ok', 'OK', '', '', NULL, NULL, 0, '', '', '', ''),
(36, 'Doddy Alfon', 'HO201910012', '14', 'SAFETY SHOES KINGS KWD 805CX BROWN COLOUR SIZE : 8', 320000, 6, 1920000, '0', 2, 0, 'Kim Shien', 'Ivan Yoga Putra', '', '', '', '', '', '', 0, 'pcs', 'mohon di proses', '2020-11-03', '2020-11-03 09:46:56', '2020-11-04 00:31:20', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Agar ditambahkan nama penerima', '', '', '', '', NULL, NULL, 0, '', '', '', ''),
(37, 'Doddy Alfon', 'HO201910012', '14', 'LAKBAN COKLAT 2 INCH 100 YARD', 10000, 10, 100000, '0', 2, 0, 'Kim Shien', 'Ivan Yoga Putra', '', '', '', '', '', '', 0, 'pcs', 'mohon di proses', '2020-11-03', '2020-11-03 09:49:33', '2020-11-04 00:31:47', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', '', '', '', '', NULL, NULL, 0, '', '', '', ''),
(38, 'Doddy Alfon', 'HO201910012', '14', 'Tali ID Card/Lanyard 2 cm Printing Full Colour Material Tissue c/w Stopper & Safety Device', 16000, 100, 1600000, '0', 2, 0, 'Kim Shien', 'Ivan Yoga Putra', '', '', '', '', '', '', 0, 'pcs', 'mohon di proses', '2020-11-03', '2020-11-03 09:57:29', '2020-11-04 00:32:13', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', '', '', '', '', NULL, NULL, 0, '', '', '', ''),
(39, 'Doddy Alfon', 'HO201910012', '14', 'Frame ID Card 2 Sisi', 1800, 100, 180000, '0', 2, 0, 'Kim Shien', 'Ivan Yoga Putra', '', '', '', '', '', '', 0, 'pcs', 'mohon di proses', '2020-11-03', '2020-11-03 09:59:12', '2020-11-04 00:32:39', 1, NULL, NULL, '', '', '', '', '', '', 2, 'Approve', '', '', '', '', NULL, NULL, 0, '', '', '', ''),
(40, 'Mustafa Dzulakmal', 'HO202004002', '11', 'Laptop', 200000, 1, 200000, '3', 0, 0, '', '', '', '', '', '', '', '', 0, 'unit', 'urgent', '2020-11-04', '2020-11-04 07:56:29', '2020-11-04 07:56:29', 3, NULL, NULL, '', '', '', '', '', '', 1, '', '', '', '', '', NULL, NULL, 0, '', 'PR/40/HO/2020', '', ''),
(41, 'Mustafa Dzulakmal', 'HO202004002', '11', 'Laptop', 200000, 1, 200000, '3', 0, 0, '', '', '', '', '', '', '', '', 0, 'unit', 'urgent', '2020-11-04', '2020-11-04 07:57:18', '2020-11-04 07:57:18', 3, NULL, NULL, '', '', '', '', '', '', 1, '', '', '', '', '', NULL, NULL, 0, '', 'PR/41/HO/2020', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `nama_posisi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `nama_posisi`, `created_at`, `updated_at`) VALUES
(1, 'Project Manager', '2020-11-13 03:03:03', '2020-11-13 03:03:03'),
(2, 'Finance Payable', '2020-11-13 03:13:42', '2020-11-13 03:13:42'),
(3, 'Bussiness Dev', '2020-11-13 06:22:50', '2020-11-13 06:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2019-07-25 09:12:15', '2019-07-25 09:12:15'),
(2, 'Karyawan', '2020-09-28 17:46:19', '2020-09-28 17:46:19'),
(3, 'Manager', '2020-09-29 04:48:30', '2020-09-29 04:48:30'),
(4, 'VP', '2020-09-29 04:48:47', '2020-09-29 04:48:47'),
(5, 'CEO', '2020-09-29 04:48:59', '2020-09-29 04:48:59'),
(8, 'CO', '2020-10-05 01:03:00', '2020-10-05 01:03:00'),
(9, 'CFO', '2020-10-05 01:03:22', '2020-10-05 01:03:22'),
(10, 'Finance', '2020-10-08 01:10:07', '2020-10-08 01:10:07'),
(11, 'Asset Management', '2020-10-15 04:33:33', '2020-10-15 04:33:33'),
(12, 'HR', '2020-11-04 08:07:53', '2020-11-04 08:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL,
  `id_karyawan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_sertifikat` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id`, `id_karyawan`, `file_sertifikat`, `created_at`, `updated_at`) VALUES
(2, 'HO202004002', 'Sertifikat_1604907387.pdf', '2020-11-09 07:36:27', '2020-11-09 07:36:27'),
(3, 'HO202004002', 'Sertifikat_1604907408.pdf', '2020-11-09 07:36:48', '2020-11-09 07:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `time_sheet_user`
--

CREATE TABLE `time_sheet_user` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `cost_account_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `working_type_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `man_hours` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `tgl_approved` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_krywn` int(11) NOT NULL,
  `id_lead_timesheet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_login`, `role_id`, `is_active`, `remember_token`, `created_at`, `updated_at`, `id_krywn`, `id_lead_timesheet`) VALUES
(1, 'admin', '$2y$12$ib.hsr70plhbWc/.17MygeTPIzoWtQ6D.ypSS/B0Qu6En4D1SaYZS', 'admin', '2020-11-13 14:04:18', 1, 1, 'IIAm2TyKaEXP7Ssgjc6o9x5YYhaz0zw5yFhkgNiFoQKkkG4U53kdzfOW3Mpt', '2019-02-05 15:13:03', '2020-11-13 07:04:18', 19, 0),
(27, 'finance', '$2y$12$ib.hsr70plhbWc/.17MygeTPIzoWtQ6D.ypSS/B0Qu6En4D1SaYZS', 'finance', '2020-11-03 16:42:19', 10, 1, 'NFZ9RBKbmklRlLTCaNSfIE5jc6rDY72Wf45jhpNymp9w0vgh7PwFD4csYKMm', '2020-10-21 06:53:58', '2020-11-03 09:42:19', 20, 0),
(28, 'asset.management', '$2y$12$ib.hsr70plhbWc/.17MygeTPIzoWtQ6D.ypSS/B0Qu6En4D1SaYZS', 'Asset Management', '2020-11-02 16:45:33', 11, 1, 'db9E2aIuyg1gqT8e6nsFRHrJG8C3kms8fNkIUlJ9nfudySZAHveuZCeY4eo2', '2020-10-15 04:33:57', '2020-11-02 09:45:33', 21, 0),
(30, 'HO202002019', '$2y$10$TIZoyH83N4jPaFqGIi5xp.4WeBUywdq1/xjngUKdlAgIhGNmjfGre', 'Ivan Yoga Putra', '2020-11-13 08:01:27', 4, 0, 'buz2i4d8rUPNAtF9pZ97oKS3GmvJIqQFciDp8jsMEB0oGsvFkejSEC8OdkWK', '2020-10-23 01:22:13', '2020-11-13 01:01:27', 24, 2),
(32, 'HO201905006', '$2y$10$Fbj.l/h.AEgiK6doGaqd3umB9kCKBbmo2jXwrRhLLztvNfxOn24Wy', 'Oozaro Berkat Larosa', '2020-11-16 14:28:29', 4, 0, 'I4MmwIvx5qf3ej43WWqOx0fSGhdOiC721Ba8uwZtoklL8Fbc89RtD0XfrYNv', '2020-10-23 01:25:28', '2020-11-16 07:28:29', 26, 1),
(33, 'HO201905005', '$2y$10$/cH258KBmfhrs9VObO2LceB7Ynon4/7cPVsWXgQqYi4sbOvdyoMM.', 'Kim Shien', '2020-11-04 13:59:23', 3, 0, 'e6hFr85e3BqvsR24L853Ul4nL9ForsBpf4nVWNAr3WWhUQY7Tlwzjbh3UClB', '2020-10-23 01:26:55', '2020-11-04 06:59:23', 27, 0),
(34, 'HO201902001', '$2y$10$3XsqmG4bCrg2Un2uASQmOeYJPa2MHTzaqkdlMFmC7sTOtNbnF6j8y', 'Robby Satria', '2020-11-04 07:30:10', 5, 0, 'kvLcy5KHr9ga6myGDsFl3hsvWN3IfDkJEjPnBFFFvPrj2VHtUTdp1WCZu9PK', '2020-10-23 01:28:09', '2020-11-04 00:30:10', 28, 0),
(36, 'HO201902002', '$2y$10$OC5jUhLt2BSjEVidevOCWenZ0SDneWIhpf9yfIwRqe977L90XuPiy', 'Andhika Susanto', '2020-11-02 16:32:13', 9, 0, 'ZrSsvUmu45MzRcSkN5C16tG3ONw1iZXRBQoKQ4TpwjSZpdiIZ1uUWTiXIqIr', '2020-10-23 01:33:54', '2020-11-02 09:32:13', 30, 0),
(37, 'HO202006002', '$2y$10$TVX2gqhUYB.5oMYB85AUkecCKeGHjPyv7OKqoQN2C.jIEzpFVYCvK', 'Mashudi Sudarmadji', '2020-10-23 13:11:48', 3, 0, 'ya5K0qU0a6kflfvBpATtZgJWVHZcZ9m0wRs9nctiVlPpEZ6lfoKA200uKgL2', '2020-10-23 01:39:55', '2020-10-28 02:02:54', 31, 0),
(38, 'HO202007004', '$2y$10$RFS2NKBn4CSWHv9VXPXosODpJLM7VPfoMS/vTtTRruWVAL/7NzJDG', 'Maria Geofrida', '2020-11-03 08:41:16', 2, 0, 'HaMZ4Kzd7vpUol8EBa5nnGUmhDq1uE4eH0Jl3zskvj8XhKiydprgD0Xrqdas', '2020-10-23 01:41:20', '2020-11-03 01:41:16', 32, 0),
(39, 'SUM202002007', '$2y$10$wKHMjLeH4JNKYNwHLQ7/auVTCnf1/AMBRUsdpN7v.GZR3RYnEPZAG', 'Fadhli Habil', '2020-10-23 11:30:03', 2, 0, 'HffOkAhY2QpiKCbCqlBpscvwVQTeCvR8ukKdsBb72wCjL9tFC5ijwzIzOjsj', '2020-10-23 01:43:36', '2020-10-28 03:50:40', 33, 0),
(40, 'HO201902003', '$2y$10$n.fRwBiuqj.1uME9xGThrua8OLbIyX.mIqL.adsAGFY8G4kO0DMle', 'Jimmy Petra Sanjaya', '2020-11-02 15:42:16', 2, 0, 'rs7KmLGnPKJJZwAIBe3msjpU2gmuIK0gB60gAXLoQA0mkhTli026GKch2MXG', '2020-10-28 03:13:58', '2020-11-02 08:42:16', 35, 0),
(41, 'HO201908010', '$2y$10$PRyNVmW4FGcq6.4PiQoQT.7yhaaqrrSP/Gd1PDI8wBJZfVaJ3uHt6', 'Jani Sumitro Pardosi', '2020-10-28 10:19:23', 2, 0, '', '2020-10-28 03:19:23', '2020-10-28 03:19:23', 36, 0),
(42, 'HO201908009', '$2y$10$fTo.yDAvrxscciipfAA.1eEGpizxQohAoRCrBkhgHnqZly2.Khm0.', 'Rika Tri Sanjaya', '2020-10-28 10:21:08', 2, 0, '', '2020-10-28 03:21:08', '2020-11-02 05:33:54', 37, 0),
(43, 'HO202001013', '$2y$10$BteAPeKLOMeXxUD.BCx0queamIIQoVNjzUAX0JgiXbVCfo0xitoai', 'Anita Hari Wijayanti', '2020-11-02 16:45:35', 2, 0, 'jJC0HYa00adXT309ydRpQuURVtUK0XnxZsexjLZX1mMd6xULRqXkWXOcpS8M', '2020-10-28 03:22:06', '2020-11-02 09:45:35', 38, 0),
(44, 'HO202002020', '$2y$10$J5vEq/2yM3.FsrgNgSfjXOgKOdN9KfXdKfqNjeU96K6L1xmapfsbm', 'Raonensen Tampubolon', '2020-11-04 13:24:39', 2, 0, '', '2020-10-28 03:22:50', '2020-11-04 06:24:39', 39, 0),
(45, 'PRO202002003', '$2y$10$qnyE49js33/cRmO5NhIiCO6eal8iYM9t23ROpBwJcbFSGasTqB736', 'Danang Pratikto Kurniawan', '2020-10-28 10:23:38', 2, 0, '', '2020-10-28 03:23:38', '2020-10-28 03:23:38', 40, 0),
(46, 'PRO202002002', '$2y$10$3wTu2tP0mWnX2txn8ON/OOgU6UOVCrWgXhNf0vRRPM/Dz5cI1dhPC', 'Ir. Heru Soedjatmiko', '2020-11-03 14:50:42', 2, 0, 'AuYlmOLB1qJUhAY1oZ8eEBFPJNOmAa3cHoNbzCJ3Lz12jtOzkddJb4QSuRAD', '2020-10-28 03:24:21', '2020-11-03 07:50:42', 41, 0),
(47, 'PRO201911001', '$2y$10$l2O/BvvYNZA.Laa1oYlH5.Mul0pAJ07ydwOTUAUrm2c6QqLsoORdO', 'Ridha Fadili', '2020-10-28 10:25:16', 2, 0, '', '2020-10-28 03:25:16', '2020-10-28 03:25:16', 42, 0),
(48, 'HO201902004', '$2y$10$.zWp1itGvJj8uWlMBjNIJePQpvKcvd99lJFtPGLqiWRBcjTT3ZW1e', 'Sayoga Arifagalih Hidayatullah', '2020-11-02 15:42:32', 3, 0, 'AB3j507Lc5iaEwBdKs59UD43eIADX8vPCr4MeAApy3vA28SjdEBdssFQrsbP', '2020-10-28 03:27:37', '2020-11-02 08:42:32', 43, 0),
(49, 'HO201909011', '$2y$10$qWqX35KHGXa5wOHb812qWOS1TGEhxXvx6f.A8vMvVrBiweTKYXp/6', 'Ruth Artha S. Napitupulu', '2020-10-28 10:29:05', 2, 0, '', '2020-10-28 03:29:05', '2020-10-28 03:29:05', 44, 0),
(50, 'HO202001014', '$2y$10$fGxWcuB74.y4yYBtm8rXD.O8ZT5.CHFEJiC1G5zkUng7AKvSby73m', 'Rut Aprillia Galuh Sarwendah', '2020-11-02 09:31:50', 2, 0, '6c59GBQFUNZeMquSMLmhF17TrxwGS5XbAimKkva8qYqE6h7z6njLtyPv3Ibz', '2020-10-28 03:29:39', '2020-11-02 02:31:50', 45, 0),
(51, 'HO201910012', '$2y$12$ib.hsr70plhbWc/.17MygeTPIzoWtQ6D.ypSS/B0Qu6En4D1SaYZS', 'Doddy Alfon', '2020-11-04 14:49:41', 2, 0, '25IFiGuQYhDBplrEaHgqYJ4QewEL3VUfFWSWPOEYL1dafJvrmpyrxDxyJXyn', '2020-10-28 03:30:35', '2020-11-04 07:49:41', 46, 0),
(52, 'HO202002015', '$2y$10$Cz63F6jCO7V2xdM1d4EB3eH9pF7ttQAisQcfJbWgSxCxWliN36TLa', 'Selfiyanti', '2020-11-03 13:56:38', 2, 0, 'Cj3vTcryTuS6LNnuSBERzdATm6mBNKQimPaw1G0veOwI0HiDml2q42PFHSBU', '2020-10-28 03:31:41', '2020-11-03 06:56:38', 47, 0),
(53, 'SUM202002001', '$2y$10$VesngScwCkYeCalpQWTzjuSin7PiqUkJsX0IyHttLS6k684EI6asS', 'Geraldo Joseph Frideandra Sirait', '2020-11-03 16:22:26', 2, 0, 'cKPqi3l3QfwyvYJBR4rMPZY5IhgrzMjuiojaND1Z562O62kLl2zHJw5ovRSH', '2020-10-28 03:32:49', '2020-11-03 09:22:26', 48, 0),
(54, 'SUM202002002', '$2y$10$atR0zqRJEglpkSWMU8DhEOrJEd.5LzEOK2p.gsSOCmE1inMwPXFeS', 'Andy Ardian', '2020-10-28 10:34:12', 2, 0, '', '2020-10-28 03:34:12', '2020-10-28 03:34:12', 49, 0),
(55, 'SUM202002003', '$2y$10$mR2kTAMq2LHB9EkDcBVWNebEyn/de0aamAq0Z1EowKFJ34ocjf5GK', 'Suwasto', '2020-10-28 10:36:14', 2, 0, '', '2020-10-28 03:36:14', '2020-10-28 03:36:15', 50, 0),
(56, 'SUM202002002', '$2y$10$CVPdvQ22EtVxDUSp0E7w3e3yRVLPuxWHpW8Q//DjokXnMemNqCMiW', 'Feri Irianto', '2020-10-28 10:36:55', 2, 0, '', '2020-10-28 03:36:55', '2020-10-28 03:36:55', 51, 0),
(57, 'SUM202002011', '$2y$10$6cKdqz2CEzWoQP9xEXYubOLe/rvS1Tq1jaoCcZmSaLSyAMeYTnaB.', 'Kitjuk Harijanto', '2020-10-28 10:37:51', 2, 0, '', '2020-10-28 03:37:51', '2020-10-28 03:37:51', 52, 0),
(58, 'SUM202002012', '$2y$10$QLEVYIuawQ88cQ04ZmvcOe.ZNi1RoghF9Zk.9nFnVM1UYGUJ64Uiq', 'Danang Arif Agustiyan', '2020-10-28 10:43:47', 2, 0, '', '2020-10-28 03:43:47', '2020-10-28 03:43:47', 53, 0),
(59, 'SUM202002004', '$2y$10$pqDAf2wGzEchWLdKst9gX.Q3GLCQv7Sr40TlENEDDxuPUTZO45v/.', 'Candra Aji Nugroho', '2020-10-28 10:44:50', 2, 0, '', '2020-10-28 03:44:50', '2020-10-28 03:44:50', 54, 0),
(60, 'SUM202002010', '$2y$10$6Kfj0g1635e.wp7XmGNKkun0RCrxUGn1YseMTuO4p4vmB84Nd4.ey', 'Hirwin Prayitno', '2020-10-28 10:45:35', 2, 0, '', '2020-10-28 03:45:35', '2020-10-28 03:45:36', 55, 0),
(61, 'SUM202002005', '$2y$10$fYkh/hO3.2KTxlaIELfj0e1IkwC4MHo804n1qZnMsZ7wVEiDlJSS2', 'Aji Prasetyo', '2020-10-28 10:46:20', 2, 0, '', '2020-10-28 03:46:20', '2020-10-28 03:46:20', 56, 0),
(62, 'SUM202002006', '$2y$10$fObdykYZ2O38POGnEe0v9.XquXdaKJmBgfLAESoGKYsj9BSxATuJu', 'Hari Tri Sofyan', '2020-10-28 10:50:11', 2, 0, '', '2020-10-28 03:50:11', '2020-10-28 03:50:11', 57, 0),
(63, 'SUM202002008', '$2y$10$HoY9GmoCaKUC2zl3g6EZNeAMrF3B3/s5nc6xZeJCFmv3aXHghSCzG', 'Muhammad Faqih Alwi', '2020-10-28 10:52:00', 2, 0, '', '2020-10-28 03:52:00', '2020-10-28 03:52:00', 58, 0),
(64, 'SUM202002009', '$2y$10$xGHRoTdPSWbYQ4KBUtg.e.DMoDj.EmTm5/QZdCXIFlCNwltiy2bVO', 'Firmansyah', '2020-10-28 10:52:29', 2, 0, '', '2020-10-28 03:52:29', '2020-10-28 04:45:21', 59, 0),
(65, 'HO202003021', '$2y$10$0LOCUArOaf/eZHcZVYji3uTsyJiXhCzlc0FoVj0eWTSs.Al7e7UAC', 'Gilang Arrahman Ikhsan V', '2020-10-28 10:52:59', 3, 0, '', '2020-10-28 03:52:59', '2020-10-28 04:48:33', 60, 0),
(66, 'SUM202002011', '$2y$10$wqzSFu7.ummZIms2culFT.HaBzceKN3G3zaeQBVFIGehhntpoakVi', 'Cecep Fatikurrohman', '2020-10-28 10:53:32', 2, 0, '', '2020-10-28 03:53:32', '2020-10-28 03:53:32', 61, 0),
(67, 'SUM202002013', '$2y$10$5I/I9cOXiXQLQUNP1tmVkeYaPSVc1J7vlP61xK/cBz0ewerJ7B1Tu', 'Cecep Zainal Abidin', '2020-10-28 10:54:12', 2, 0, '', '2020-10-28 03:54:12', '2020-10-28 06:34:42', 62, 0),
(68, 'SUM202003004', '$2y$10$0l0i34JCnlDediHoSmdDyuNFUQMwqGWeF5CswK/kh.wx.uCPmjw9i', 'Sigit Mulyanto', '2020-10-28 10:54:43', 2, 0, '', '2020-10-28 03:54:43', '2020-10-28 03:54:43', 63, 0),
(70, 'SUM202003001', '$2y$10$AJkW12skMzvFSqhqbRcw0e3GYFiQ4Lm.KPFC7ICxr.G/6Zv630EhK', 'Tomi Nofianto', '2020-10-28 11:50:46', 2, 0, '', '2020-10-28 04:50:46', '2020-10-28 04:50:46', 65, 0),
(71, 'HO202004002', '$2y$10$daONjN9k22wGy.5Gajn2Qek8tS0LjMz5gqgPHc3w8pS2rMT5o6qOm', 'Mustafa Dzulakmal', '2020-11-17 07:50:23', 2, 0, 'xXe7rV8mpZtp2KRkGm6rOQvtvV4jfwDGheqKcPJcMNFd2iEF6ptD9wq2cByO', '2020-10-28 04:51:29', '2020-11-17 00:50:23', 66, 0),
(72, 'SUM202004004', '$2y$10$1a9Sm3bPiIvuqybzvbn3vu1GO7aYVvfTHli605NwuenGTCaLCVm32', 'Muhamad Vicky Driantama', '2020-10-28 11:52:01', 2, 0, '', '2020-10-28 04:52:01', '2020-10-28 04:52:01', 67, 0),
(73, 'SUM202004003', '$2y$10$9h7Zviy7nsev.Vj5V3JiV.uotDPXrY32KSrDbeGYJlQkCWhqOsh1y', 'Ilhamsyah Merdy Pratama', '2020-10-28 11:52:37', 2, 0, '', '2020-10-28 04:52:37', '2020-10-28 04:52:38', 68, 0),
(74, 'SUM202004006', '$2y$10$zwB31JxmR9ijpM7sIhRDOOahm22i.RpBtUUyr5/z/36N4fqbmJeDa', 'Perdana Putra Aksimaraja', '2020-10-28 11:53:12', 2, 0, '', '2020-10-28 04:53:12', '2020-10-28 04:53:12', 69, 0),
(75, 'EXTEP20191202', '$2y$10$6X/cYaAYnpjqo5dSJFyHM.jozHJTdOG5U/KNwMh5SAByMAPqxhVv.', 'Budhi Timoera', '2020-10-28 11:53:46', 2, 0, '', '2020-10-28 04:53:46', '2020-10-28 04:53:46', 70, 0),
(76, 'EXTEP20191203', '$2y$10$lzisincrf9tPvxNOA1PxVenPBbGf2dihBRbCJvJnxymLBQCFpWb0K', 'Erdhian Kusuma', '2020-10-28 12:33:27', 2, 0, '', '2020-10-28 05:33:27', '2020-10-28 05:33:27', 71, 0),
(77, 'EXTEP20200204', '$2y$10$GPN3ZYzZXvXpeekuA3Z8HOg06ONS/AM5fqVsJguT57gUCqCW0fd0C', 'Dedeh Herdianto', '2020-10-28 12:33:57', 2, 0, '', '2020-10-28 05:33:57', '2020-10-28 05:33:57', 72, 0),
(78, 'EXTEP20200205', '$2y$10$YwNLg7vJW0WKdF3aqpMb1.a.yYm8ZYr9WffJCYFmmRchd2T2NL1Am', 'Meta Yunitasari', '2020-11-02 12:48:12', 2, 0, 'G7AKi8NjjvOAlzRljZ2BgpaDauEt0zYFA5bYtmjUcF84OSUWpfVzWkti5cY0', '2020-10-28 05:34:28', '2020-11-02 05:48:12', 73, 0),
(79, 'SUM202002014', '$2y$10$Qe6yPD27HHStoGxLFUNh4.siH43ba0HjoH3a1yDNc5bwK9Ov8U4RG', 'Kateni', '2020-10-28 12:35:04', 2, 0, '', '2020-10-28 05:35:04', '2020-10-28 05:35:05', 74, 0),
(80, 'SUM202005001', '$2y$10$jfvbd6fsSjqAmHR8FZ.FX.lCaGx8jCmnmwm8mOxdddt06KFjb94mm', 'Agnetha Febriana Malino', '2020-10-28 12:35:27', 2, 0, '', '2020-10-28 05:35:27', '2020-10-28 05:35:27', 75, 0),
(81, 'SUM202006003', '$2y$10$rCPp3oN7k004d8cCKxHaw.oR6NjGJpZ.AXo2kNpkz9BfXezaBE0Za', 'Hanadi Ahmad Algadri', '2020-10-28 12:35:53', 2, 0, '', '2020-10-28 05:35:53', '2020-10-28 05:35:53', 76, 0),
(82, 'EXTEP20200605', '$2y$10$wNDHxEI0vTtWe7ihWtiPiujVmmpOtmX/s2QOq9QitSVr8hcASfmT.', 'Aris Hardi Yanto', '2020-10-28 12:36:28', 2, 0, '', '2020-10-28 05:36:28', '2020-10-28 05:36:28', 77, 0),
(83, 'EXTEP20200606', '$2y$10$MlMcuB491EcAx.yU/l9bYemlzXNAmmyJfg.5U6VeM6tKHMKEr5OHG', 'Robin Meynrat Purba', '2020-10-28 12:36:57', 2, 0, '', '2020-10-28 05:36:57', '2020-10-28 05:36:57', 78, 0),
(84, 'SUM202006010', '$2y$10$Ov3wYYqh8Wissj5XYqKd1u6s/v5mk4mPSXDrdqR.01IzaC9O7Dzp6', 'Yudhis Anggono Putro', '2020-10-28 12:37:26', 2, 0, '', '2020-10-28 05:37:26', '2020-10-28 05:37:26', 79, 0),
(85, 'EXTEP20200607', '$2y$10$nyiVcQt7XJtQyCjFS25WWeTglZghtWDgPBTLVXcqDUVyE4i7mQKcq', 'Sugiyarto', '2020-10-28 12:37:57', 2, 0, '', '2020-10-28 05:37:57', '2020-10-28 05:37:57', 80, 0),
(86, 'SUM202006008', '$2y$10$vru9sXUuNWN14txMCECMKuAYhOXhniyU7ngyeaBHJov6gU7ieAn/q', 'Ronaldo Yunus Lado', '2020-10-28 12:44:56', 2, 0, '', '2020-10-28 05:44:56', '2020-10-28 05:44:56', 81, 0),
(87, 'SUM202006009', '$2y$10$ejjiXB8p2zrwx8NumNyM9uXhamkIS1k8RipsRMou2I5OZvJoblece', 'Lady Diana Ridolf', '2020-10-28 12:45:29', 2, 0, '', '2020-10-28 05:45:29', '2020-10-28 05:45:29', 82, 0),
(88, 'SUM202006013', '$2y$10$5GOe0fTNeVRxqvz4ylraxucWRng/B1FCqoXvtZFkQZFytsNz7C1tG', 'Ir. Irawan Sarjono', '2020-10-28 12:45:59', 2, 0, '', '2020-10-28 05:45:59', '2020-10-28 05:45:59', 83, 0),
(89, 'SUM202007011', '$2y$10$fatRgu8zwmNYGyw63HGrce56j90CZoYMjJAE4NLiDGCkUXX.uNWjm', 'Yayat Sudrajat', '2020-10-28 12:46:29', 2, 0, '', '2020-10-28 05:46:29', '2020-10-28 05:46:29', 84, 0),
(90, 'SUM202007012', '$2y$10$CUtNn.gEFSyBUw/U/QCcEOsQm1Myn8263lt8CQjC4Nc72idd3jSfa', 'Bill Jones Albert Lado', '2020-10-28 12:46:56', 2, 0, '', '2020-10-28 05:46:56', '2020-10-28 05:46:56', 85, 0),
(91, 'SUM202007013', '$2y$10$rBQXKp4QFdzt8VXh.HolNOTe/NP7Rxl.L3Db7g0ESHsZ6lv6gVpJu', 'Yerry Awan Susanto', '2020-10-28 12:48:29', 2, 0, '', '2020-10-28 05:48:29', '2020-10-28 05:48:29', 86, 0),
(92, 'SUM202007014', '$2y$10$TAN/QP4Ffpn8RmJ2lIxKEeQzA/tfYeTEbtH.hP9gNCpWGBIL9sqLW', 'Jaminan Bison Limbong', '2020-10-28 12:48:58', 2, 0, '', '2020-10-28 05:48:58', '2020-10-28 05:48:58', 87, 0),
(93, 'SUM202007015', '$2y$10$AT3JWppZc.phbEqX9y1wvu7eCHJGAquUruNHu8oUdINOU4ZH5.Y4a', 'Muhamad Wafi Izzudien', '2020-10-28 12:49:30', 2, 0, '', '2020-10-28 05:49:30', '2020-10-28 05:49:30', 88, 0),
(94, 'HO202007005', '$2y$10$h4IWC7mPvMdXgVGzRpVMa.i0OYI.BmORnW.vWyLIdcUbT6UeXh.9q', 'Jonatan Kevin Daniel', '2020-10-28 12:50:12', 2, 0, '', '2020-10-28 05:50:12', '2020-10-28 05:50:12', 89, 0),
(95, 'HO202007006', '$2y$10$pju1Dwbwh9AgbHlWeS1hE.z9PNY5uwIvbOpuxUxWOsVWbzC8opTlC', 'Ruri Setyo Widyasari', '2020-10-28 12:50:52', 2, 0, '', '2020-10-28 05:50:52', '2020-10-28 05:50:52', 90, 0),
(96, 'SUM202007016', '$2y$10$rEjurwU0/tqLYsHNzEv2rO3jX4AbefXsoOPD56jRUz6CFF3Y/H.zy', 'Asep Lukmanul Hakim', '2020-10-28 12:51:25', 2, 0, '', '2020-10-28 05:51:25', '2020-10-28 05:51:25', 91, 0),
(97, 'SUM202007017', '$2y$10$VhbxNxGDs/HpXiNuJqjt5O2m22W0AW8DOIzca9Kd3WccOsMw6gEFS', 'Kristanto Lubis', '2020-10-28 12:51:58', 2, 0, '', '2020-10-28 05:51:58', '2020-10-28 05:51:58', 92, 0),
(98, 'HO202007007', '$2y$10$9RJqXGiGoJ0cP5T/GNBS0.pMi0mts.pHQvYqSskBUjgT9mlalim5W', 'Brahmadhiksa Artha Pramesta', '2020-11-02 15:32:53', 2, 0, 'UTJ27VxEajdQu4TGu1eAYzAQFvfc4h2GwiJcjrpSTMLENsHxcenT6ov6K7Th', '2020-10-28 05:52:29', '2020-11-02 08:32:53', 93, 0),
(99, 'SUM202007018', '$2y$10$p7jJ4WbEVULS/RQwfbr/9OClEPufxss26No5Odq5r3iJL7smuJRhi', 'Yudi Setiawan', '2020-11-02 13:20:42', 3, 0, 'ke0LMCGCJ42Ob2dWdX85mMGqzoYMgv5SfB4pC6xs0uPtQFQRDeMzhbS2lGwf', '2020-10-28 05:53:10', '2020-11-02 06:20:42', 94, 0),
(100, 'SUM202007019', '$2y$10$MGG13xOMCMyj2q/xFTzaXO2rmYgzslJc1zsjR37AqKR/DscLNoeJu', 'Salman', '2020-10-28 12:54:11', 2, 0, '', '2020-10-28 05:54:11', '2020-10-28 05:54:11', 95, 0),
(101, 'HO202007008', '$2y$10$nuSdSkzZH.u0vVowQjmwmOAF6AxXhYRXGd6cIL9Bd59pCHK4aTr2W', 'Nisa Okinadia', '2020-11-02 15:33:55', 2, 0, 'vwQphIw3U9umGwvos1HLK4WdZakFjKmp5Ty5N0QOwgWyJ1egarQ0yzEaJg3Y', '2020-10-28 05:54:44', '2020-11-02 08:33:55', 96, 0),
(102, 'HO202007009', '$2y$10$RT3LCusI4OLqj4pbx8bTeO7CBTcU9UmD1l3xh7bjtskMGi.3VbIRW', 'Gabriela Mercy Ulina Tampubolo', '2020-10-28 12:55:18', 2, 0, '', '2020-10-28 05:55:18', '2020-10-28 05:55:18', 97, 0),
(103, 'SUM202007020', '$2y$10$lEm4WMiBuEoYJyXPaT80a.HpHmahtLCn2uUTkHqIF7AYg1c3oeEbi', 'Aditya Rahmani Pratama', '2020-10-28 12:55:46', 2, 0, '', '2020-10-28 05:55:46', '2020-10-28 05:55:46', 98, 0),
(105, 'HO202008011', '$2y$10$ND9vdYBlcLsWyEQP5/u7B.HmKZvAdgw9KNGNCXscUDrqUOzMTGvfG', 'Nova Gebria', '2020-10-28 12:57:41', 2, 0, '', '2020-10-28 05:57:41', '2020-10-28 05:57:41', 100, 0),
(106, 'HO202008012', '$2y$10$PU2ouZQ.1YmWo8Jvyu5DWeqX1p11MTOfYAr92YQDOHX45BGtznpNm', 'Rita Utami', '2020-10-28 12:58:09', 2, 0, '', '2020-10-28 05:58:09', '2020-10-28 05:58:09', 101, 0),
(108, 'SUM202008021', '$2y$10$SVaYJrK65QBF6bWVj4IXjuC//42vjDg9Z9VkAm4iEfXkLxwzqopDe', 'Dilo Naufal Putra', '2020-10-28 12:59:08', 2, 0, '', '2020-10-28 05:59:08', '2020-10-28 05:59:08', 103, 0),
(109, 'SUM202008022', '$2y$10$dIGBZlxtRg7jaNnGoUgnQO2fJPkgLOhB.RrpoX5.65qOInNiS2i8a', 'Ratno Dini Pitoyo', '2020-10-28 12:59:47', 2, 0, '', '2020-10-28 05:59:47', '2020-10-28 05:59:47', 104, 0),
(110, 'HO202009001', '$2y$10$GqTaMiFBEuheFHJTGwHcGe/fqBT/PUaesv.zveOiiuBYdtymDJMK.', 'Yuniar Anggraeni', '2020-11-02 15:40:24', 2, 0, '', '2020-10-28 06:00:21', '2020-11-02 08:40:24', 105, 0),
(111, 'HO202009002', '$2y$10$J1eBXu.wB52VqqQLtxyTgu8XHJmf4XTUUZ8ganzrMur06Pe3yCTBe', 'Berman Nababan', '2020-11-02 15:33:41', 2, 0, 'vsX5Lir6FF6hqIAJj9OvLRbaA0CjGNJhf3f7xNFHdVyPa2xGZ7rJAbyuless', '2020-10-28 06:04:55', '2020-11-02 08:33:41', 106, 0),
(112, 'SUM202009001', '$2y$10$/9.AYs5FlSuFsXhdNw7nhuCrCG5xeBuCPHiSVmyTx.AbudLB9qAHm', 'Zainuddin', '2020-10-28 13:05:25', 2, 0, '', '2020-10-28 06:05:25', '2020-10-28 06:05:26', 107, 0),
(113, 'HO202008013', '$2y$10$DmiGQlj1iX7ejIludHjKiOeot9J2FcrpfrtqLeQzSrhxr7pTMVB6C', 'Jevinna Euginia Novianty', '2020-11-12 09:24:43', 8, 0, 'WjIINeVRS5wx22kb9if0FQAc7QpfAf05bRoFekLNIylh6eoU5T49VnyTJmG7', '2020-10-28 06:44:03', '2020-11-12 02:24:43', 108, 0),
(114, 'HO201907007', '$2y$10$EJgUGO.L3Qrha30NJb7g9usqJFCIlKcuicAOZdyUSoCje9YzV0Pry', 'Adrianus Baginda Mesiaries', '2020-11-03 17:04:41', 4, 0, 'PX7mIH8vY2sW4CD6Zn6SJKNPlDQg61TGBFYglAsTXtsrV8FUFfcfML52Hwn3', '2020-11-02 01:31:12', '2020-11-03 10:04:41', 109, 3),
(115, 'HO201902005', '$2y$10$p/6zMml1Bbasa.Z100KgZeeLSXl.GqjBW3ocDF7r1bGG42GTGPDam', 'Oozaro Berkat Larosa', '2020-11-02 15:42:53', 3, 0, 'H3sqGaBDuprBBrZJ1actPV74vzkZdlZVtCdMkpQ4CTZYrV26kulKRqFPVdDT', '2020-11-02 02:36:57', '2020-11-02 08:42:53', 110, 0),
(116, 'HO201907008', '$2y$10$FiUYe/3QDl14n2Vvywh5L.VsijXOUmZDWCJx/8dkACpqxuiAP7.gy', 'Adrianus Baginda Mesiaries', '2020-11-02 10:00:18', 4, 0, '', '2020-11-02 03:00:18', '2020-11-02 03:00:18', 111, 0),
(117, 'HO201907009', '$2y$10$CNJr2UqaFs/8LBK27skQPeIGP43fMo6o5huQ6fDyZw3JtjsISigiC', 'Adrianus Baginda', '2020-11-02 13:45:51', 3, 0, 'YnsI7MhFGMgi74KRP0UOYLZgoeR6AU32BCZjxe5knvg5O8g3O8etDOhHA9ay', '2020-11-02 03:42:33', '2020-11-02 06:45:51', 112, 0),
(118, 'HRD', '$2y$12$ib.hsr70plhbWc/.17MygeTPIzoWtQ6D.ypSS/B0Qu6En4D1SaYZS', 'HRD', '2020-11-12 09:59:13', 12, 0, 't19JZ87hCtRlVuQNVgHj49rnT9wp1jpk0CVylCXzgsosRawCMnADneLBT3L4', NULL, '2020-11-12 02:59:13', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `cost_account`
--
ALTER TABLE `cost_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_working_type`
--
ALTER TABLE `general_working_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_project`
--
ALTER TABLE `lokasi_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_divisi`
--
ALTER TABLE `master_divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_vendor`
--
ALTER TABLE `master_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_vendor_category`
--
ALTER TABLE `master_vendor_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengalaman`
--
ALTER TABLE `pengalaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_barang`
--
ALTER TABLE `request_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_sheet_user`
--
ALTER TABLE `time_sheet_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `cost_account`
--
ALTER TABLE `cost_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_working_type`
--
ALTER TABLE `general_working_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi_project`
--
ALTER TABLE `lokasi_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_divisi`
--
ALTER TABLE `master_divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `master_jenis_barang`
--
ALTER TABLE `master_jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_vendor`
--
ALTER TABLE `master_vendor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_vendor_category`
--
ALTER TABLE `master_vendor_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengalaman`
--
ALTER TABLE `pengalaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `request_barang`
--
ALTER TABLE `request_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time_sheet_user`
--
ALTER TABLE `time_sheet_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
