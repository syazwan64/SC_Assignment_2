-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 12:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtechw9`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `kategori` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `tarikh` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`kategori`, `nama`, `description`, `tarikh`, `gambar`) VALUES
('weapons and arms', 'Sundang', 'Sundang', '1300 Hijrah', 'sundang.jpg'),
('weapons and arms', 'Kerambit', 'Seni kraftangan yang telah lama wujud di kalangan masyarakat Malaysia.', '1240 Hijrah', 'kerambit.jpg'),
('household items', 'congkak', 'congkak permainan tradisional', '1440 Hijrah', 'congkak.png'),
('household items', 'tepak sirih', 'bagai pinang dibelah dua - peribahasa melayu', '1300 Hijrah', 'tepakSirih.jpg'),
('textiles', 'songket tenun asli', 'lorem ipsum.', '1444 Hijrah', 'songket.jpg'),
('textiles', 'Batik canting', 'batik canting lukisan tangan asli.', '1444 Hijrah', 'batikCanting.jpg'),
('carving and woodworks', 'tunjuk langit', 'dipasang di bumbung rumah tradisional, menyimpan falsafah tersirat disebaliknya', '1330 Hijrah', 'tunjukLangit.jpg'),
('carving and woodworks', 'ukiran kayu', 'ukiran tangan, material kayu cengal merah', '24000', 'ukiranKayu.jpg'),
('carving and woodworks', 'to be completed', 'kosong', 'none', 'none.jpg'),
('carving and woodworks', 'Ukiran Iban', 'Ukiran oleh kaum Iban di Sarawak', 'later', 'ukiranIban.jpg'),
('test 123', 'test', 'test 1234', 'test 12345', 'test.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `collectionskuih`
--

CREATE TABLE `collectionskuih` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `resepi` varchar(100) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collectionskuih`
--

INSERT INTO `collectionskuih` (`kategori`, `nama`, `description`, `resepi`, `gambar`) VALUES
('Malay', 'Nasi Lemak', 'Rice dish', 'Coconut rice, sambal, anchovies, peanuts, cucumber, egg', 'nasilemak.jpg'),
('Malay', 'Rendang', 'Curry dish', 'Slow-cooked beef/chicken in rich coconut and spice paste', 'rendang.jpg'),
('Malay', 'Satay', 'Grilled skewers', 'Marinated meat (chicken, beef, or lamb) with peanut sauce', 'satay.jpg'),
('Malay', 'Lemang', 'Sticky rice', 'Glutinous rice, coconut milk, cooked in bamboo', 'lemang.jpg'),
('Malay', 'Ketupat', 'Rice dumpling', 'Glutinous rice, coconut milk, cooked in bamboo', 'ketupat.jpg'),
('Indian', 'Roti Canai', 'Flatbread', 'Flaky bread served with curry sauce or dhal', 'roticanai.jpg'),
('Indian', 'Roti Nan', 'Indian bread', 'Leavened bread made with all-purpose flour, baked in a tandoor', 'rotinan.jpg'),
('Indian', 'Tosai', 'Pancake', 'Fermented rice and lentil batter, often served with chutney and sambar', 'tosai.jpg'),
('Indian', 'Putu Mayam', 'Rice noodle dish', 'Steamed rice noodles served with grated coconut and sugar', 'putumayam.jpg'),
('Indian', 'Nasi Briani', 'Rice dish', 'Fragrant rice, meat (chicken, mutton, or fish), spices', 'briani.jpg'),
('Chinese', 'Char Kuey Tiau', 'Stir-fried noodles', 'Flat rice noodles, soy sauce, seafood, Chinese sausage', 'char.jpg'),
('Chinese', 'Nasi Ayam Hainan', 'Rice dish', 'Poached chicken, fragrant rice, condiments and sauces', 'nasiayam.jpg'),
('Chinese', 'Mee Wantan', 'Noodle dish', 'Egg noodles, wontons (filled dumplings), char siu (barbecue pork)', 'meewantan.jpg'),
('Chinese', 'Moon Cake', 'Pastry', 'Traditional Chinese pastry filled with various sweet fillings', 'mooncake.jpg'),
('Chinese', 'Dim Sum', 'Bite-sized dishes', 'Steamed dumplings, buns, rolls, and other small plates', 'dimsum.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
