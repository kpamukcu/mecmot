-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 20 Ağu 2024, 10:40:21
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mecmot`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kadi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sifre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `kadi`, `sifre`) VALUES
(1, 'Admin', '123'),
(2, 'Kaan', '456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `katAdi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `katTuru` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ustKat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `aciklama` text COLLATE utf8mb4_general_ci NOT NULL,
  `gorsel` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `katDili` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `katAdi`, `katTuru`, `ustKat`, `aciklama`, `gorsel`, `katDili`) VALUES
(1, 'Vidalı Krikolar', 'Üst Kategori', '-', 'Vidalı Kriko Meta Description', '../assets/img/vidali-krikolar-48x48.webp', 'Türkçe'),
(2, 'Yön Değiştiriciler', 'Üst Kategori', '-', 'Yön Değiştiriciler Meta Description', '../assets/img/yon-degistirici.png', 'Türkçe'),
(3, 'Linear Aktuator', 'Üst Kategori', '-', 'Linear Aktuator Meta Description', '../assets/img/linear-aktuator.png', 'Türkçe'),
(6, 'Mil Hareketli Vidalı Krikolar', 'Alt Kategori', 'Vidalı Krikolar', 'Mil Hareketli Vidalı Krikolar Meta Description', '../assets/img/vidali-kriko-mil-hareketli.png', 'Türkçe'),
(10, 'Somun Hareketli Vidalı Krikolar (VK-SH)', 'Alt Kategori', 'Vidalı Krikolar', 'Somun Hareketli Vidalı Krikolar (VK-SH) Meta Description', '../assets/img/vidali-kriko-somun-hareketli.png', 'Türkçe'),
(11, 'MD Tipi Yön Değiştiriciler', 'Alt Kategori', 'Yön Değiştiriciler', 'MD Tipi Yön Değiştiriciler Meta Description', '../assets/img/yon-degistirici-md.png', 'Türkçe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
