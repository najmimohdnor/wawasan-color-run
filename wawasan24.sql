-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 02:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wawasan24`
--

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `subcategory` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`username`, `password`, `phone`, `email`, `category`, `subcategory`, `user_type`, `id`, `subcategory_id`) VALUES
('jkadkad12313', '$2y$10$VNZDUUge2ei5zptJaodgOunDMIQP9jgceslWR6n53eXste1X3Ii4q', '13134114124', 'ada@dd.com', 'Beginner', '10KM', 'user', 55, NULL),
('im', '$2y$10$MUiyg5hrwMMjTXoQpNOr.Oxggr8JS7dIJwMfMKPNi47aJjlKcPjhi', '123', 'imB@im.com', 'Veteran', '10KM', 'user', 56, NULL),
('123', '$2y$10$Bb58DkrFCTFpuTFKdW4M7eBoJPZH1.IUF5xHMUixCCaGDWqj622ru', '019605213113', 'naj@mi.com', 'Veteran', '10KM', 'user', 57, NULL),
('manap', '$2y$10$fFJtdbZWt0MnAB2o89B6kex5eI.Lj13Byr0aprCHK2djoyfpsxAgK', '01223456', 'm@p.com', 'Veteran', '3KM', 'admin', 59, NULL),
('broski', '$2y$10$2ctVJfXbv6a21kdFPLHYAeumodGXwoNrpd1ImC3kQUDpj1qhuvBRK', '0101010101', 'l@l.com', 'Veteran', '3KM', 'admin', 61, NULL),
('asdaksjdb', '$2y$10$nEMyt5aaPZ4NYLbgjrqDw.fQ0zS1l7FyKfcRUCo6vWjtTbm0zdC/W', 'asdasoidjasd', 'ada@sd.com', 'Beginner', '10KM', 'user', 62, NULL),
('farid', '$2y$10$g4odMMDI8X7DQCVciwBCrO1eHD88dvKnvXZLj.NlcoSvG2jK8CTVu', '31313123123123', 'f@d.com', 'Beginner', '3KM', 'admin', 63, NULL),
('abdul', '$2y$10$dDM3v6LIVN2oHFZtW1JCEehZNkhlgHNHUfN/Qvtlmpg1RX2M0abe.', '12123123', 'namicreates@gmaii.co', 'Beginner', '5KM', 'user', 65, NULL),
('manap', '$2y$10$MAVEzqNRniC9fj/S2RZoc.lv2x2bcUbRTKTPubTm2iP7ODVoFJlRS', '0213213i12313', 'm@n.com', 'Beginner', '5KM', 'admin', 67, NULL),
('justforsale', '$2y$10$6S9t16glHWEn5pOwq2AIquuKHKM3wtTJlz1dSVxMoBzlMrwnF167m', '213131233', 'asd@sdac.com', 'Beginner', '10KM', 'user', 68, NULL),
('ade', '$2y$10$Ne6I1pex4NyIiHLaS.u9sOAxqAAqKGSnBHJBjHcHkqdqKtn4Uc19y', '213131231', 'ad@43.com', 'Beginner', '10KM', 'user', 69, NULL),
('justforsale', '$2y$10$/uxR.GtYqD8YI/.jLUGLl.bShjE/FY.2wtOGtAPICGkB8C7fUE2bO', '211124124124', 'ds@da.com', 'Beginner', '10KM', 'user', 70, NULL),
('1dad', '$2y$10$7yVyG3ceWV7vnb7KOzboquxsrPJHZmVIeNNM1MLUSx8sWuuejZROy', '214141412', 'dasd@a.com', 'Beginner', '10KM', 'user', 71, NULL),
('123131', '$2y$10$ziEAQPH4zsRHCfsTSv2Ur.m1AHXzslPYYtqU4lCIhhYImrlS29NT6', '12314414124', 'qe@d.com', 'Beginner', '3KM', 'user', 72, NULL),
('qeqe1', '$2y$10$QT4Ufdf8W2FcYhofZs2l9uw37nZpmEAK1YDk1jkCEOaS3eb8CaPRG', '545235235', 'justnamilol@gmail.co', 'Beginner', '10KM', 'user', 73, NULL),
('ewrweqrewr', '$2y$10$f1oY/S/F/EuyVHkRJ8iEmeRgCcj6Q7jNIw4Th3Svr4zn8Pd3IvshC', '12423552235', 'ds@f.com', 'Beginner', '5KM', 'user', 74, NULL),
('qeqeqeq', '$2y$10$AsWebLeYdut3Xen1DIYh9ubItDWFsgj5j7QpabcPkORKTcnvoIYg.', '21412414124', 'ada@asd.com', 'Beginner', '10KM', 'user', 75, NULL),
('124124124', '$2y$10$ls78ERGNeBOtYt5x90cESu0jRtVrsbu1zADBJZkcM9i9azDag9Rsa', '421141212', 'qeqe@sa.com', 'Beginner', '10KM', 'user', 76, NULL),
('sos', '$2y$10$5ZZpvgTRQ6Pvsc9v41ctG.2UchEf7vCdtRBRrRHOSNNL/Eotu58ui', '12131313', 'sos@sos.com', 'Veteran', '10KM', 'user', 82, NULL),
('ajkndaknd', '$2y$10$wcK5lZM899sk.S4i2tIXB.PnFrFrUT4m7Mv/gJBZuW22/mS5orY5e', '4443434', 'sdsa@ds.com', 'Veteran', '10KM', 'user', 83, NULL),
('dadd', '$2y$10$mQyfzpIgtV5rgeTLRzaQCO3qDT.mCZ04ma5tmlrSBYwiEvJo5qGOO', '5454353', '12@gmail.com', 'Beginner', '5KM', 'admin', 84, NULL),
('test', '$2y$10$u/SbuUjzMnfJLbcVRWmq4uSFDZy6oFS8GcViNXR0YCJco9qnNnKvq', '4412124', 'n@o.com', 'Veteran', '5KM', '', 91, NULL),
('bruh', '$2y$10$eA3KBH/7tL/SE/EChXHhquY23/D6gB/07z4YZ948A1VhhdIdrkvca', '12314414124', 'bruh@bruh.my', 'Beginner', '5KM', 'user', 92, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_quota` int(11) NOT NULL DEFAULT 0,
  `current_quota` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `max_quota`, `current_quota`) VALUES
(4, '3KM', 4, 5),
(5, '5KM', 30, 8),
(6, '10KM', 19, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
