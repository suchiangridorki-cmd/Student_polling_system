-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 10:06 AM
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
-- Database: `student_polling_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'q', 'amy@gmail.com', 'qergt', '2026-03-04 12:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `option_text` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `poll_id`, `option_text`) VALUES
(1, 1, 'yes'),
(2, 1, 'no'),
(3, 2, 'eggs'),
(4, 2, 'pork'),
(5, 2, 'chicken'),
(6, 2, 'fish'),
(7, 3, 'yes'),
(8, 3, 'no'),
(9, 3, '1'),
(10, 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `title`, `description`, `created_by`, `expiry_date`, `status`) VALUES
(2, 'what do you want to eat', NULL, 1, '2026-03-06', 'active'),
(3, 'Are you sure?', NULL, 1, '2026-03-02', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','student') DEFAULT 'student',
  `theme` varchar(10) DEFAULT 'light',
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `theme`, `phone`) VALUES
(1, 'ridorki', 'suchiangridorki@gmail.com', '$2y$10$zxCqV9F7vUSGmw9j5oityOIlq5qydZTPKD4eV.vb.fjc9ECRqHTc2', 'admin', 'light', ''),
(2, 'alia', 'alia@gmail.com', '$2y$10$wruzw/jlJvydjhR0elCguuelNOVj7aMYxaHyHB37DYXmhz0f4HZOK', 'admin', 'light', ''),
(3, 'Gill', 'gill@gmail.com', '$2y$10$q2g7HAOd8G.nFgdRVAnW3ejB/Fj2HkESba6bdH2WEqGf/5irbALC.', 'student', 'light', ''),
(4, 'Amy', 'amy@gmail.com', '$2y$10$o/wUdurHVZwwFN2HP89y0uvYUT4QX2lfw9Kd0K/eJpBenbcAYTLqu', 'student', 'light', '1234567890'),
(5, 'Ri', 'ri@gmail.com', '$2y$10$JlWLhIGq0I4UiXlVdz72ueLx4G8cJ9MdQklcUUK4dQgkr7LIUTEYa', 'student', 'light', '2345678901'),
(6, 'tei', 'tei@gmail.com', '$2y$10$vT1qOH.O9fxyvm64TnxKUOjkYIrFOUfzTTz9cCZ4iz6tUeKX1KKa.', 'student', 'light', '3214567654'),
(7, 'ida Pasah', 'ida@gmail.com', '$2y$10$PKU7vvYCetz.8j6BmbyZ5uQ99I7i/JVdyoAc/IlPtimHxVY.HIbiG', 'student', 'light', '2345678901'),
(8, 'Mewan', 'mewan@gmail.com', '$2y$10$EmIhSrLuoyH6Yb4Rs8qv7eVLknjBjl7AFvtiTaLOIPe0L57BOdoxS', 'student', 'light', '6478352189');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `poll_id`, `user_id`, `option_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 3, 5),
(4, 1, 3, 2),
(5, 2, 1, 3),
(6, 2, 7, 3),
(7, 3, 7, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
