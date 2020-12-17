-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2020 at 06:21 AM
-- Server version: 10.1.47-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kodeBarang` int(11) NOT NULL,
  `namaBarang` varchar(50) NOT NULL,
  `kodeLokasi` int(11) NOT NULL,
  `kodeJenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kodeBarang`, `namaBarang`, `kodeLokasi`, `kodeJenis`, `jumlah`) VALUES
(1000, 'Bangku Tunggu', 302, 201, 5),
(1001, 'Barcode Printer', 301, 202, 80),
(1002, 'Barcode Scanner', 302, 202, 10),
(1003, 'Brankas/Lemari Besi', 301, 201, 1),
(1004, 'Jaringan / Router Wifi', 303, 202, 29),
(1005, 'Kamera', 303, 202, 81),
(1006, 'Komputer PC', 301, 202, 89),
(1007, 'Kursi Hadap', 302, 201, 79),
(1008, 'Kursi Rapat', 303, 201, 37),
(1009, 'Kursi Staff', 302, 201, 71),
(1010, 'Laser Pointer', 301, 202, 10),
(1011, 'Lemari Arsip/Kelas', 301, 201, 37),
(1012, 'Meja Kerja', 303, 201, 71),
(1013, 'Mesin Absensi', 303, 202, 87),
(1014, 'Mesin Fax', 303, 202, 70),
(1015, 'Mobil Jeep', 304, 203, 3),
(1016, 'Mobil Mini Bus', 304, 203, 8),
(1017, 'Mobil Sedan', 304, 203, 80),
(1018, 'Mobile Storage Arsip', 303, 201, 79),
(1019, 'NotebBook/laptop', 303, 202, 11),
(1020, 'Papan Pengumuman', 303, 201, 18),
(1021, 'Printer', 303, 202, 98),
(1022, 'Screen Projector Digital', 301, 202, 25),
(1023, 'Sepeda Motor', 304, 203, 81),
(1024, 'Sofa', 301, 201, 96),
(1025, 'Sound System/wireless', 303, 202, 92),
(1026, 'Televisi', 302, 202, 11),
(1027, 'White Board', 303, 201, 35),
(1028, 'Kulkas', 301, 202, 2),
(1031, 'router', 301, 202, 5);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `kodeJenis` int(11) NOT NULL,
  `namaJenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kodeJenis`, `namaJenis`) VALUES
(201, 'Perlengkapan Kantor'),
(202, 'Elektronik'),
(203, 'Benda Bermotor');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `kodeLokasi` int(11) NOT NULL,
  `namaLokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`kodeLokasi`, `namaLokasi`) VALUES
(301, 'Lt 1, Gedung A'),
(302, 'Lt 2, Gedung A'),
(303, 'Lt 1, Gedung B'),
(304, 'Garasi, Gedung B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kodeBarang`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`kodeJenis`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`kodeLokasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kodeBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1032;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `kodeJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `kodeLokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
