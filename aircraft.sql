-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Paź 24, 2024 at 07:16 PM
-- Wersja serwera: 8.0.39-0ubuntu0.24.04.1
-- Wersja PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `21_rybicki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aircraft`
--

CREATE TABLE `aircraft` (
  `id` int NOT NULL,
  `company` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `model` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `country` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL,
  `speed` int NOT NULL,
  `combat_range` int NOT NULL,
  `ceiling` int NOT NULL,
  `climb` int NOT NULL,
  `wing_loading` int NOT NULL,
  `armament` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`id`, `company`, `model`, `country`, `speed`, `combat_range`, `ceiling`, `climb`, `wing_loading`, `armament`) VALUES
(1, 'North American', 'P-51D Mustang', 'USA', 703, 1529, 12771, 1097, 202, '6 x 12,7 mm'),
(2, 'Focke-Wulf', 'Fw 190A-8', 'Niemcy', 647, 1059, 9967, 991, 230, '4 x 20 mm + 2 x 13 mm'),
(3, 'Lockheed', 'P-38J Lightning', 'USA', 666, 1545, 11887, 1158, 259, '1 x 20 mm + 4 x 12,7 mm'),
(4, 'Republic', 'P-47D-10 Thunderbolt', 'USA', 690, 764, 12802, 814, 215, '8 x 12,7 mm'),
(5, 'Messerschmitt', 'Bf 109G-6/AS', 'Niemcy', 652, 719, 11549, 1158, 193, '1 x 20 mm + 2 x 13 mm'),
(6, 'Curtiss', 'P-40E Warhawk', 'USA', 571, 1287, 8839, 732, 191, '6 x 12,7 mm'),
(20, 'North American', 'A-36A Apache', 'USA', 587, 885, 7650, 610, 187, '6 x 12,7 mm'),
(21, 'Messerschmitt', 'Bf 109G-6', 'Niemcy', 620, 719, 11549, 1006, 193, '1 x 20 mm + 2 x 13 mm'),
(22, 'Focke-Wulf', 'Fw 190A-5', 'Niemcy', 652, 1059, 9967, 914, 219, '2 x 20 mm + 2 x 7,92 mm'),
(24, 'Bell', 'P-39D Airacobra', 'USA', 592, 845, 10668, 829, 168, '1 x 37 mm + 2 x 12,7 mm + 4 x 7,7 mm'),
(25, 'Messerschmitt', 'Me 262', 'Niemcy', 869, 1046, 11460, 1200, 295, '4 x 30 mm'),
(26, 'Lockheed', 'P-38G Lightning', 'USA', 644, 1545, 11887, 1116, 207, '1 x 20 mm + 4 x 12,7 mm');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
