-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2019 at 04:52 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proofn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `profile_picture` varchar(1000) NOT NULL,
  `bio` text NOT NULL,
  `previlege` int(11) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `gender`, `birthdate`, `profile_picture`, `bio`, `previlege`, `join_date`) VALUES
(1, 'ardi', '20efd4061de57a7b79e04128d028a464024a5810ba136c12156972e1cc3c18e4', 'ardi@gmail.com', 'pria', '2002-04-17', 'http://[::1]/proofn/asset/images/profilepic/no-pic.png', 'skjfdnjksdnfkj', 0, '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_attachment`
--

CREATE TABLE `feedback_attachment` (
  `id` int(11) NOT NULL,
  `attach_id` varchar(1000) NOT NULL,
  `link_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_attachment`
--

INSERT INTO `feedback_attachment` (`id`, `attach_id`, `link_file`) VALUES
(1, '1b64e0b6396e14852fc26e233bb8fa65eace72c551b1db9f97cf8d5c5b289840', 'http://[::1]/proofn/asset/images/feed-attach/5f670644605f6d015bf875cf489034be.png'),
(2, '19d66f88a14ef28cc95bd42c4497535795e0cb0e4cb7b1b0c8d9341d25309f16', 'http://[::1]/proofn/asset/images/feed-attach/76b01aea04f3ad04edac34f47e43cbb2.png'),
(3, '012fdb3f6789d8f065e40f4ee01887e490582656ecd6f1419e40a2573e757232', 'http://[::1]/proofn/asset/images/feed-attach/6344623c4f3a909dec9ceaf6377d9b1f.png');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_type`
--

CREATE TABLE `feedback_type` (
  `id` int(11) NOT NULL,
  `feed_categoryname` varchar(1000) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_type`
--

INSERT INTO `feedback_type` (`id`, `feed_categoryname`, `priority`) VALUES
(1, 'Error Sign Up', 0),
(2, 'Error Login', 1),
(3, 'Force Close', 0),
(4, 'Pending Mengirim File', 0),
(5, 'Error Kirim Pesan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_forum`
--

CREATE TABLE `kategori_forum` (
  `id` int(11) NOT NULL,
  `judul_kategori` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komentar_post`
--

CREATE TABLE `komentar_post` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `komentator` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_thread`
--

CREATE TABLE `laporan_thread` (
  `id` int(11) NOT NULL,
  `pelapor` int(11) NOT NULL,
  `thread_id` int(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `id_thread` int(100) NOT NULL,
  `pengirim` int(11) NOT NULL,
  `isi_post` text NOT NULL,
  `tanggal_post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `kategori_forum` int(11) NOT NULL,
  `status_thread` int(1) NOT NULL,
  `judul_thread` varchar(100) NOT NULL,
  `moderator` int(11) NOT NULL,
  `deskripsi_thread` text NOT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_attachment`
--
ALTER TABLE `feedback_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_type`
--
ALTER TABLE `feedback_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_forum`
--
ALTER TABLE `kategori_forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar_post`
--
ALTER TABLE `komentar_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`id_post`),
  ADD KEY `komentator` (`komentator`);

--
-- Indexes for table `laporan_thread`
--
ALTER TABLE `laporan_thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelapor` (`pelapor`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topik` (`id_thread`),
  ADD KEY `pengirim` (`pengirim`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderator` (`moderator`) USING BTREE,
  ADD KEY `kategori_forum` (`kategori_forum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_attachment`
--
ALTER TABLE `feedback_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback_type`
--
ALTER TABLE `feedback_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_forum`
--
ALTER TABLE `kategori_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar_post`
--
ALTER TABLE `komentar_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_thread`
--
ALTER TABLE `laporan_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar_post`
--
ALTER TABLE `komentar_post`
  ADD CONSTRAINT `komentar_post_ibfk_1` FOREIGN KEY (`komentator`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `komentar_post_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`);

--
-- Constraints for table `laporan_thread`
--
ALTER TABLE `laporan_thread`
  ADD CONSTRAINT `laporan_thread_ibfk_1` FOREIGN KEY (`pelapor`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `laporan_thread_ibfk_2` FOREIGN KEY (`thread_id`) REFERENCES `thread` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`pengirim`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id`);

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`moderator`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `thread_ibfk_2` FOREIGN KEY (`kategori_forum`) REFERENCES `kategori_forum` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
