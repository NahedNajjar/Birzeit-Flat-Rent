
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
-- --------------------------------------------------------
-- Table structure
-- --------------------------------------------------------
 
CREATE TABLE `appointments` (
  `appointment_id` int NOT NULL,
  `flat_ref` int DEFAULT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `slot_id` int DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `availability_times` (
  `slot_id` int NOT NULL,
  `flat_ref` int DEFAULT NULL,
  `day_of_week` varchar(20) DEFAULT NULL,
  `time_slot` time DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `customers` (
  `customer_id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `flatno` int NOT NULL,
  `StreetName` varchar(30) NOT NULL,
  `City` varchar(30) NOT NULL,
  `PostalCode` int NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `dateob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `userID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `flats` (
  `flat_ref` int NOT NULL,
  `owner_id` int NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `address` text,
  `price` decimal(10,2) DEFAULT NULL,
  `available_from` date DEFAULT NULL,
  `available_to` date DEFAULT NULL,
  `bedrooms` int DEFAULT NULL,
  `bathrooms` int DEFAULT NULL,
  `size_sqm` int DEFAULT NULL,
  `rent_conditions` text,
  `heating` tinyint(1) DEFAULT NULL,
  `air_conditioning` tinyint(1) DEFAULT NULL,
  `access_control` tinyint(1) DEFAULT NULL,
  `parking` tinyint(1) DEFAULT NULL,
  `backyard` enum('none','individual','shared') DEFAULT NULL,
  `playground` tinyint(1) DEFAULT NULL,
  `storage` tinyint(1) DEFAULT NULL,
  `is_rented` tinyint(1) DEFAULT '0',
  `is_approved` tinyint(1) DEFAULT '0',
  `Type` varchar(100) NOT NULL,
  `PhotoPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `flat_photos` (
  `photo_id` int NOT NULL,
  `flat_ref` int DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `Caption` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `marketing_info` (
  `marketing_id` int NOT NULL,
  `flat_ref` int DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `Messages` (
  `MessageID` int NOT NULL,
  `MessageBody` text,
  `MessageTitle` varchar(255) DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `Sender` enum('system','manager','owner','customer') DEFAULT NULL,
  `MessageDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `MessageIsRead` tinyint(1) DEFAULT '0',
  `Receiver` enum('manager','owner','customer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `Owners` (
  `owner_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `flatno` int NOT NULL,
  `StreetName` varchar(30) NOT NULL,
  `City` varchar(30) NOT NULL,
  `PostalCode` int NOT NULL,
  `dateob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `userID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `RentalCustomer` (
  `rental_id` int NOT NULL,
  `flatRef` int DEFAULT NULL,
  `customerID` int UNSIGNED DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `cardNumber` int DEFAULT NULL,
  `CardExpireDate` date DEFAULT NULL,
  `NameOnCard` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
CREATE TABLE `Users` (
  `userID` int NOT NULL,
  `password` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `role` enum('customer','owner','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
 
-- --------------------------------------------------------
-- Safe demo data only (fictional people, fictional contact info)
-- --------------------------------------------------------
 
-- manager@demo.com   / Manager123
-- customer@demo.com  / Customer123
-- owner@demo.com     / Owner123
 
INSERT INTO `Users` (`userID`, `password`, `userName`, `role`) VALUES
(1, '$2b$10$kV8u3XoiwAVLFX41XOZ/juCpMIkt1Z/SmKX.lvdJvEPyEUTrNJ8ji', 'manager@demo.com', 'manager'),
(2, '$2b$10$T4uHqoh/GgcUA.A.wpPPnuO71cdtFKMwv4o5emDLXJH9Quiin.JEq', 'customer@demo.com', 'customer'),
(3, '$2b$10$SJC.Xl5RQbBWD.aqD.7BvuvZglvwcFiisZ9oCbhgP50GJrl8Y9i.O', 'owner@demo.com', 'owner');
 
INSERT INTO `customers` (`customer_id`, `name`, `flatno`, `StreetName`, `City`, `PostalCode`, `telephone`, `dateob`, `email`, `mobile`, `userID`) VALUES
(100000000, 'Demo Customer', 1, 'Main Street', 'Ramallah', 1000, '02-0000000', '2000-01-01', 'customer@demo.com', '0590000000', 2);
 
INSERT INTO `Owners` (`owner_id`, `name`, `flatno`, `StreetName`, `City`, `PostalCode`, `dateob`, `email`, `mobile`, `account_number`, `telephone`, `bank_name`, `bank_branch`, `userID`) VALUES
(100000000, 'Demo Owner', 1, 'Main Street', 'Ramallah', 1000, '2000-01-01', 'owner@demo.com', '0590000000', '000000000', '02-0000000', 'Demo Bank', 'Ramallah Branch', 3);
 
INSERT INTO `flats` (`flat_ref`, `owner_id`, `location`, `address`, `price`, `available_from`, `available_to`, `bedrooms`, `bathrooms`, `size_sqm`, `rent_conditions`, `heating`, `air_conditioning`, `access_control`, `parking`, `backyard`, `playground`, `storage`, `is_rented`, `is_approved`, `Type`, `PhotoPath`) VALUES
(1, 100000000, 'Ramallah - Al Quds Street', 'Building 3, Floor 2, Apartment 4', 450.00, '2025-07-01', '2025-12-31', 2, 1, 85, 'No pets allowed. 2 months deposit required.', 1, 1, 1, 1, 'shared', 1, 1, 0, 1, 'furnished', 'sample-living-room.png'),
(2, 100000000, 'Ramallah - City Center', 'Building 1, Floor 1, Apartment 2', 700.00, '2025-07-01', '2025-12-31', 3, 2, 110, 'No smoking inside the flat.', 1, 1, 1, 1, 'individual', 0, 1, 0, 1, 'not furnished', 'sample-bedroom.png');
 
INSERT INTO `flat_photos` (`photo_id`, `flat_ref`, `photo_path`, `Caption`) VALUES
(1, 1, 'sample-living-room.png', 'Living room'),
(2, 1, 'sample-bedroom.png', 'Bedroom'),
(3, 2, 'sample-kitchen.png', 'Kitchen');
 
INSERT INTO `marketing_info` (`marketing_id`, `flat_ref`, `title`, `description`, `url`) VALUES
(1, 1, 'Birzeit University', '5 minutes walk from campus', 'https://example.com');
 
INSERT INTO `availability_times` (`slot_id`, `flat_ref`, `day_of_week`, `time_slot`, `telephone`) VALUES
(1, 1, 'Sunday', '10:00:00', '02-0000000'),
(2, 1, 'Tuesday', '14:00:00', '02-0000000');
 
-- --------------------------------------------------------
-- Indexes
-- --------------------------------------------------------
 
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `flat_ref` (`flat_ref`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `slot_id` (`slot_id`);
 
ALTER TABLE `availability_times`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `flat_ref` (`flat_ref`);
 
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `userID` (`userID`);
 
ALTER TABLE `flats`
  ADD PRIMARY KEY (`flat_ref`),
  ADD KEY `owner_id` (`owner_id`);
 
ALTER TABLE `flat_photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `flat_ref` (`flat_ref`);
 
ALTER TABLE `marketing_info`
  ADD PRIMARY KEY (`marketing_id`),
  ADD KEY `flat_ref` (`flat_ref`);
 
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`MessageID`);
 
ALTER TABLE `Owners`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `userID` (`userID`);
 
ALTER TABLE `RentalCustomer`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `flatRef` (`flatRef`),
  ADD KEY `customerID` (`customerID`);
 
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`);
 
-- --------------------------------------------------------
-- Auto increment starting points
-- --------------------------------------------------------
 
ALTER TABLE `appointments` MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `availability_times` MODIFY `slot_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `customers` MODIFY `customer_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000001;
ALTER TABLE `flats` MODIFY `flat_ref` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `flat_photos` MODIFY `photo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `marketing_info` MODIFY `marketing_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `Messages` MODIFY `MessageID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `Owners` MODIFY `owner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000001;
ALTER TABLE `RentalCustomer` MODIFY `rental_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `Users` MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
 
-- --------------------------------------------------------
-- Foreign keys
-- --------------------------------------------------------
 
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`flat_ref`) REFERENCES `flats` (`flat_ref`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`slot_id`) REFERENCES `availability_times` (`slot_id`);
 
ALTER TABLE `availability_times`
  ADD CONSTRAINT `availability_times_ibfk_1` FOREIGN KEY (`flat_ref`) REFERENCES `flats` (`flat_ref`);
 
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);
 
ALTER TABLE `flats`
  ADD CONSTRAINT `flats_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `Owners` (`owner_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
 
ALTER TABLE `flat_photos`
  ADD CONSTRAINT `flat_photos_ibfk_1` FOREIGN KEY (`flat_ref`) REFERENCES `flats` (`flat_ref`);
 
ALTER TABLE `marketing_info`
  ADD CONSTRAINT `marketing_info_ibfk_1` FOREIGN KEY (`flat_ref`) REFERENCES `flats` (`flat_ref`);
 
ALTER TABLE `Owners`
  ADD CONSTRAINT `Owners_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);
 
ALTER TABLE `RentalCustomer`
  ADD CONSTRAINT `RentalCustomer_ibfk_1` FOREIGN KEY (`flatRef`) REFERENCES `flats` (`flat_ref`),
  ADD CONSTRAINT `RentalCustomer_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customer_id`);
 
COMMIT;