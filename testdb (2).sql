-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 14, 2025 at 08:18 PM
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
-- Struktura tabeli dla tabeli `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_date` date NOT NULL,
  `array` int(11) NOT NULL,
  `task_description` text NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_date`, `array`, `task_description`, `start_time`, `end_time`) VALUES
(41, '2025-01-18', 0, 'yt', '20:38:00', '21:38:00'),
(44, '2024-12-31', 0, '111', '11:11:00', '22:02:00'),
(45, '2024-12-30', 0, 'zadanie', '11:11:00', '04:44:00'),
(46, '2024-12-31', 0, '1', '22:22:00', '11:11:00'),
(49, '2024-12-31', 0, 'hh', '11:11:00', '11:01:00'),
(50, '2024-12-31', 0, 'kacper', '10:00:00', '20:00:00'),
(51, '2024-12-31', 0, 'rower', '12:00:00', '13:00:00'),
(52, '2025-01-11', 0, 'dwsd', '12:32:00', '03:23:00'),
(53, '2025-01-12', 0, '12', '12:12:00', '15:45:00'),
(54, '2025-01-17', 0, 'kd', '12:12:00', '16:05:00'),
(55, '2025-01-11', 0, 'dwsd', '12:32:00', '03:23:00'),
(56, '2025-01-16', 0, 'kk', '12:01:00', '15:00:00');

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
(2, 'Kacper121', '$2y$10$2gY784UiKqwSm6sf1SxyeeajbqrX.UthXkYfrQ4tHmlDPSeHLymLi', '676ebe6caf1ca.png'),
(8, 'Loki', '$2y$10$zJS8SRb8XZ8kkRNcQBdqcuZmCtToDvna9kRpl2TRhMPt33W1yFkiK', '676eecf5bed4c.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_tasks`
--

CREATE TABLE `user_tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tasks`
--

INSERT INTO `user_tasks` (`id`, `user_id`, `task_id`) VALUES
(1, 2, 46),
(4, 2, 49),
(5, 2, 50),
(6, 2, 51),
(8, 2, 53),
(9, 2, 54),
(10, 2, 55),
(11, 2, 56);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indeksy dla tabeli `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD CONSTRAINT `user_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
