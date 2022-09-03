-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2022 at 05:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pifair2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` varchar(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_youtube` varchar(255) NOT NULL,
  `team_image` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `rotation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `team_name`, `team_youtube`, `team_image`, `position`, `rotation`) VALUES
('team-1', 'Team A', 'https://www.youtube.com/embed/3uVMOOf3zRQ', 'https://i.postimg.cc/RFtddr3R/PIFAIR.png', '-1.6 2 -3.9', '0 0 0'),
('team-2', 'Team B', 'https://www.youtube.com/embed/40cLHVNlvmI', 'https://i.postimg.cc/vBXBpT6H/image.png', '3.9 2 0', '0 -90 0'),
('team-3', 'Team C', 'https://www.youtube.com/embed/yAiCUXWT-QA', 'https://cdn.aframe.io/examples/ui/ponyoPoster.jpg', '1.6 2 -3.9', '0 0 0'),
('team-4', 'Team D', 'https://www.youtube.com/embed/tChKQMBBkv4', 'https://cdn.aframe.io/examples/ui/karigurashiPoster.jpg', '-3.9 2 0', '0 90 0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `team_id` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `university`, `team_id`, `is_admin`, `token`) VALUES
(15, 'Pifair 2022 Admin', 'pifair-admin@gmail.com', '$2y$10$NjdwhU61V6dem.bYZ9G9VeWbutwZwVA5kN3ZbdruJvaxP4klq39em', 'Universitas Trisakti', NULL, 1, '9e2db730dd6fd9b12fca39d115805a78'),
(18, 'User 1', 'user1@gmail.com', '$2y$10$8FXhcXTmsP/k8isgnPWUyORAChK15XynGqlLPVcKAGCa7oJF3lb5.', 'UGM', NULL, 0, 'cb865139d3b2100a510c64b1a3ae8238');

-- --------------------------------------------------------

--
-- Table structure for table `youtube`
--

CREATE TABLE `youtube` (
  `page` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `sponsor_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `youtube`
--

INSERT INTO `youtube` (`page`, `src`, `sponsor_id`) VALUES
('auditorium', 'https://www.youtube.com/embed/YegJp-E0j0g', ''),
('exhibition', 'https://www.youtube.com/embed/uj-fZfscY9Y', 'sponsor-1'),
('exhibition', 'https:/www.youtube.com/embed/YegJp-E0j0g', 'sponsor-2'),
('exhibition', 'https:/www.youtube.com/embed/YegJp-E0j0g', 'sponsor-3'),
('exhibition', 'https:/www.youtube.com/embed/YegJp-E0j0g', 'sponsor-4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`team_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
