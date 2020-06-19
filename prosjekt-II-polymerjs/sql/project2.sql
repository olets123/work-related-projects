-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07. Mai, 2020 14:08 PM
-- Tjener-versjon: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `playlist`
--

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL,
  `playlist_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `playlist_name`) VALUES
(4, 'Skole');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `playlist_video`
--

CREATE TABLE `playlist_video` (
  `id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `playlist_video`
--

INSERT INTO `playlist_video` (`id`, `playlist_id`, `video_id`) VALUES
(16, 4, 41);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pwd` varchar(250) NOT NULL,
  `user_premission` varchar(255) NOT NULL,
  `user_request` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_pwd`, `user_premission`, `user_request`) VALUES
(1, 'admin', 'admin', 'admin@admin', '$2y$12$JVITpGROgBZnyEvH0MjbJeme5uL/nwqv0oY1qzfsolJ.1izuMNXX2', 'Admin', 0),
(2, 'teacher', 'teacher', 'teacher@teacher', '$2y$12$BfLFiS2.m0uvx5DGWE.Wt.1fdPkRC.O8ZLiGghm/ReDA2Hjl1Qcy2', 'Teacher', 0),
(3, 'student', 'student', 'student@student', '$2y$12$kto8I254ZHyXBFFth.e9vusT3o/I2bDC0lJO2gcxV3V1p7eq7YoWe', 'Student', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `video_2`
--

CREATE TABLE `video_2` (
  `video_id` int(11) NOT NULL,
  `video_filnavn` varchar(255) NOT NULL,
  `image_filnavn` varchar(250) NOT NULL,
  `video_tittel` varchar(255) DEFAULT NULL,
  `video_beskrivelse` varchar(255) DEFAULT NULL,
  `video_kategori` varchar(255) NOT NULL,
  `video_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dataark for tabell `video_2`
--

INSERT INTO `video_2` (`video_id`, `video_filnavn`, `image_filnavn`, `video_tittel`, `video_beskrivelse`, `video_kategori`, `video_text`) VALUES
(41, 'Sampleone.mp4', 'charming-desktop-wallpaper.JPG', 'Kristoffer', 'En liten video snutt', 'Blæææ', 'Sampleone.vtt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlist_id`);

--
-- Indexes for table `playlist_video`
--
ALTER TABLE `playlist_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `video_2`
--
ALTER TABLE `video_2`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `playlist_video`
--
ALTER TABLE `playlist_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `video_2`
--
ALTER TABLE `video_2`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
