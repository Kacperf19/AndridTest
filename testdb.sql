-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 06:30 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_image`) VALUES
(1, 'testuser', '$2a$10$Vc/nh9JwMh1jQs5ugrUMUOSK/1j4anEGf/o/ZWvh9E3T.vf3GgGgW', ''),
(2, 'Kacper121', '$2y$10$2gY784UiKqwSm6sf1SxyeeajbqrX.UthXkYfrQ4tHmlDPSeHLymLi', '6761b4e7834c2.png'),
(3, 'Kacper11', '$2y$10$3jiuP7OSorTw38CtduV96eiffnsf7L/9Xyaxwwzg9URNjGj05OA2G', ''),
(4, 'Adam', '$2y$10$wrbqYnmtvGPO.RhburrgYefyGKHBBSK0Pw4g2Ct4sfWdRs40ofy/e', ''),
(5, 'ka', '$2y$10$7Cpq6M0NegarhK.FQXQAwuoOg6mpteDfbHsdm0iPmNSk7uxKIDwYK', ''),
(6, 'ka1', '$2y$10$Z6ZBYd2WPItMcMAJuRHnj.zvKqesoXhjuirSVP3YEVR2JhJA2Hs6e', ''),
(7, 'kacper22', '$2y$10$vghpOIESXGvu3ACHVSgOPuIPYkRNgFJfD.3m3P5RDs4zhes3jrbb2', ''),
(8, 'Loki', '$2y$10$zJS8SRb8XZ8kkRNcQBdqcuZmCtToDvna9kRpl2TRhMPt33W1yFkiK', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
