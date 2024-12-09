-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 07:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borrow_resource`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `BorrowingID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ResourceID` int(11) NOT NULL,
  `BorrowStartTime` datetime NOT NULL,
  `BorrowEndTime` datetime NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`BorrowingID`, `UserID`, `ResourceID`, `BorrowStartTime`, `BorrowEndTime`, `Status`) VALUES
(1, 3, 1, '2024-12-02 08:00:00', '2024-12-02 14:49:00', 'Available'),
(2, 3, 2, '2024-12-10 07:00:00', '2024-12-10 08:00:00', 'Reserved'),
(6, 4, 3, '2025-12-11 07:00:00', '2025-12-11 09:30:00', 'Available'),
(7, 4, 4, '2025-12-12 10:00:00', '2025-12-12 11:30:00', 'Reserved'),
(8, 4, 3, '2025-12-10 07:00:00', '2025-12-10 09:30:00', 'Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Category 1'),
(2, 'Category 2'),
(3, 'Equipment'),
(4, 'book');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ResourceID` int(11) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `ResourceID` int(11) NOT NULL,
  `ResourceName` varchar(255) NOT NULL,
  `ResourceDescription` text NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`ResourceID`, `ResourceName`, `ResourceDescription`, `CategoryID`) VALUES
(1, 'Resource 1', 'Description for Resource 1', 1),
(2, 'Resource 2', 'Description for Resource 2', 1),
(3, 'projector', 'acer', 3),
(4, 'nini', 'haha', 4);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `ScheduleID` int(11) NOT NULL,
  `ResourceID` int(11) NOT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`ScheduleID`, `ResourceID`, `StartTime`, `EndTime`) VALUES
(1, 1, '2024-12-02 08:00:00', '2024-12-02 14:49:00'),
(2, 2, '2024-12-10 07:00:00', '2024-12-10 08:00:00'),
(3, 3, '2025-12-10 07:00:00', '2025-12-10 09:30:00'),
(4, 4, '2025-12-12 10:00:00', '2025-12-12 11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `UserType`) VALUES
(1, 'admin', '$2y$10$e0MYzXyjpJS2Xn5Zy5Zy5Oe0MYzXyjpJS2Xn5Zy5Zy5Oe0MYzXy', 'Admin'),
(2, 'subadmin', '$2y$10$e0MYzXyjpJS2Xn5Zy5Zy5Oe0MYzXyjpJS2Xn5Zy5Zy5Oe0MYzXy', 'SubAdmin'),
(3, 'student', '$2y$10$e0MYzXyjpJS2Xn5Zy5Zy5Oe0MYzXyjpJS2Xn5Zy5Zy5Oe0MYzXy', 'Student'),
(4, 'elouisa', '$2y$10$QuBpy4v2aL.uEIMI2cGNSuPa13ni5l6T63HLLHFWL/WXkMr0.9oCa', 'Student'),
(5, 'elis', '$2y$10$QAmq5WlbnWstU3CLxMkOjORM3UCtZZl9jUvNgOFZH8xF0JAI3AZZC', 'Student'),
(6, 'mimi', '$2y$10$7vVHs2tLJ16DHZkqTemNCOP.tbJQY778E2mzo.UaBN7.G6e/LfCs.', 'Student'),
(7, 'mimimi', '$2y$10$bUDNsTDzuXTObG9BMC3iJeK1BykkoX9NlzZ1p42lwwRnpXN6X1JYm', 'Student'),
(8, 'lenlen', '$2y$10$Arh8d7/ue1SgYsvhWehF6uRjnYV7TXe0M77aO2030tgvN0dXzxwEu', 'Student'),
(9, 'admin', '$2y$10$q4/JGqOu5pfkyWHCyhsg3OruDdxJyBi6n2ntBcNma6M9BBy4ad2yy', 'Admin'),
(10, 'admin', '$2y$10$NV85aG.O7RMGic6B6Pl0O.B/XRT2xkHe309DSVELteFEUOo1ow0ta', 'Admin'),
(11, 'admin', '$2y$10$RWSVVBOfqPmgUFcja8UV3.eNEa1OvdMfvWaY.da5cHEHf9qxroSEG', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`BorrowingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ResourceID` (`ResourceID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ResourceID` (`ResourceID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`ResourceID`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `ResourceID` (`ResourceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `BorrowingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`ResourceID`) REFERENCES `resources` (`ResourceID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`ResourceID`) REFERENCES `resources` (`ResourceID`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`ResourceID`) REFERENCES `resources` (`ResourceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
