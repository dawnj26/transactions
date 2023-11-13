-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 01:35 PM
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
-- Database: `blogging`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `blog_ID` int(11) NOT NULL,
  `blog_title` varchar(250) NOT NULL,
  `blog_content` mediumtext NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp(),
  `blog_category` varchar(100) NOT NULL,
  `blog_pic_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`blog_ID`, `blog_title`, `blog_content`, `date_posted`, `blog_category`, `blog_pic_path`) VALUES
(9, 'About blogs', 'Blog definition: In simple terms, a blog is a regularly updated website or web page, and can either be used for personal use or to fulfill a business need.\r\n\r\nA brief history — in 1994, Swarthmore College student Justin Hall is credited with the creation of the first blog, Links.net. At the time, however, it wasn\'t considered a blog … just a personal homepage.', '2023-11-12 20:24:00', 'Technology', 'uploads/black tshirt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment` mediumtext NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_ID`, `blog_ID`, `username`, `comment`, `date_posted`) VALUES
(15, 9, 'dquinto', 'nice blog bro', '2023-11-12 20:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('djayson', '$2y$10$ustJrH4xkMo9rWLC9Av5juH.YzFp4e4U49AUS2WCWeIWCtFBQOY6m'),
('dquinto', '$2y$10$od6tb7Z5HPxjVbGnyx2grujcW9oMyi619wE4VQpsr.9jgzlEu.1Z6'),
('dsolomon', '$2y$10$g3PKkTTcxAnU.NHLUcQazemukKX46ul78hgNPXpg5eCoLt9PKu4R6'),
('hatdogmo', '$2y$10$ys3ji6soRkilbbN79OAvIejJ1KoFDKCykte4g3fYMvbZdohEGP8PG'),
('solomon', '$2y$10$pqdW8hM3eFEqvhq..Kx40ujd6b9YmjbHNSgdR9kNX8GRgrOk2JszK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`blog_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `blog_post_fk` (`blog_ID`),
  ADD KEY `user_fk` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `blog_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `blog_post_fk` FOREIGN KEY (`blog_ID`) REFERENCES `blog_post` (`blog_ID`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
