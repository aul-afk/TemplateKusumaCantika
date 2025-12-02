-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 10:37 PM
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
-- Database: `qc`
--

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE `checks` (
  `check_id` int(11) NOT NULL,
  `costume_id` int(11) DEFAULT NULL,
  `check_date` date DEFAULT NULL,
  `status` enum('worthy','unworthy','maintenance') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checks`
--

INSERT INTO `checks` (`check_id`, `costume_id`, `check_date`, `status`, `notes`) VALUES
(301, 101010, '2025-09-01', 'maintenance', NULL),
(302, 101011, '2025-09-01', 'worthy', '-'),
(303, 101012, '2025-09-01', 'worthy', '-'),
(304, 101013, '2025-09-01', 'worthy', '-'),
(306, 101014, '2025-11-23', 'worthy', NULL),
(307, 101015, '2025-11-23', 'worthy', NULL),
(308, 101016, '2025-11-23', 'worthy', NULL);

--
-- Triggers `checks`
--
DELIMITER $$
CREATE TRIGGER `clear_notes_when_worthy` BEFORE UPDATE ON `checks` FOR EACH ROW BEGIN
    -- Jika status berubah menjadi 'worthy'
    IF NEW.status = 'worthy' THEN
        SET NEW.notes = NULL;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_costume_availability` AFTER UPDATE ON `checks` FOR EACH ROW BEGIN
    -- Jika status menjadi 'unworthy'
    IF NEW.status = 'unworthy' THEN
        UPDATE costume
        SET availability = 'no'
        WHERE costume_id = NEW.costume_id;
        
    -- Jika status menjadi 'worthy'
    ELSEIF NEW.status = 'worthy' THEN
        UPDATE costume
        SET availability = 'yes'
        WHERE costume_id = NEW.costume_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `costume`
--

CREATE TABLE `costume` (
  `costume_id` int(11) NOT NULL,
  `costume_category` enum('Tari Daerah','Tokoh wayang','','') DEFAULT NULL,
  `costume_name` varchar(100) NOT NULL,
  `size` enum('S','M','L','XL') DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `availability` enum('yes','no') DEFAULT 'yes',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `costume`
--

INSERT INTO `costume` (`costume_id`, `costume_category`, `costume_name`, `size`, `price`, `availability`, `image`) VALUES
(101010, 'Tokoh wayang', ' KODE \"ANOMAN\"', 'L', 95000.00, 'no', 'anoman.png'),
(101011, 'Tari Daerah', ' KODE \"BWI\"', 'M', 75000.00, 'yes', 'bwi .png'),
(101012, 'Tari Daerah', 'KODE \"CLARA\"', 'L', 90000.00, 'yes', 'clara.png'),
(101013, 'Tari Daerah', 'KODE \"DESWITA\"', 'L', 85000.00, 'yes', 'deswita.png'),
(101014, 'Tari Daerah', 'KODE \"HANNA\"', 'M', 95000.00, 'yes', 'hanna.png'),
(101015, 'Tari Daerah', 'KODE \"HASTUNGKARA\"', 'L', 120000.00, 'yes', 'hastungkara.png'),
(101016, 'Tokoh wayang', 'KODE \"LAKSAMANA\"', 'XL', 130000.00, 'yes', 'laksamana.png'),
(101017, 'Tokoh wayang', 'KODE \"PATIH\"', 'XL', 100000.00, 'yes', 'patih.png'),
(101018, 'Tokoh wayang', 'KODE \"RAHWANA\"', 'L', 95000.00, 'yes', 'rahwana.png'),
(101019, 'Tokoh wayang', 'KODE \"RAMA\"', 'XL', 90000.00, 'yes', 'rama.png'),
(101020, 'Tokoh wayang', 'KODE \"RATU HIJAU\"', 'L', 120000.00, 'yes', 'ratu hijau.png'),
(101021, 'Tari Daerah', 'KODE \"REMO\"', 'M', 85000.00, 'yes', 'remo.png'),
(101022, 'Tari Daerah', 'KODE \"SEKAR AYU\"', 'M', 95000.00, 'yes', 'sekar ayu.png'),
(101023, 'Tokoh wayang', 'KODE \"SHINTA\"', 'M', 100000.00, 'yes', 'shinta.png'),
(101024, 'Tokoh wayang', 'KODE \"SRIKANDI\"', 'M', 120000.00, 'yes', 'srikandi.png'),
(101025, 'Tari Daerah', 'KODE \"SUNDA NAVY\"', 'M', 75000.00, 'yes', 'sunda navy.png'),
(101026, 'Tari Daerah', 'KODE \"TANI\"', 'M', 75000.00, 'yes', 'tani.png'),
(101027, 'Tari Daerah', 'KODE\"TANJUNG GEMIRANG\"', 'L', 90000.00, 'yes', 'tanjung gemirang.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `gender`, `phone_number`, `address`) VALUES
(101, 'Putri Ayuningtyas', 'female', '082145938488', 'Jl. Basuki Rahmat, Kel. Ganung Kidul, Kec. Nganjuk'),
(102, 'Maya Nur Azzahra', 'female', '08763421112', 'Jl. Gatot Subroto, Kel. Kartoharjo, Kec. Nganjuk'),
(103, 'Rani Oktaviani', 'female', '087714561654', 'Jl. Panglima Sudirman, Kel. Sukorejo, Kec. Nganjuk'),
(104, 'Bella Kusumawardani', 'female', '082134567654', 'Jl. Raya Loceret, Kel. Loceret, Kec. Loceret'),
(105, 'Novi Anindya', 'female', '087654321234', 'Jl. Cempaka, Desa Balongrejo, Kec. Gondang'),
(106, 'Nadya Amelia', 'female', '087654321234', 'Jl. Mawar, Desa Kedungrejo, Kec. Lengkong'),
(107, 'Indah Ayuningrum', 'female', '087654329987', 'Jl. Raya Rejoso, Desa Patianrowo, Kec. Rejoso'),
(108, 'Larissa Wulandari', 'female', '087612349876', 'Jl. Cemara, Desa Watudandang, Kec. Wilangan'),
(109, 'Nadia Pramesti', 'female', '087543211123', 'Jl. Wilis Selatan, Kel. Begadung, Kec. Nganjuk'),
(110, 'Rani Oktaviani', 'female', '082212349876', 'Jl. Panglima Sudirman, Kel. Sukorejo, Kec. Nganjuk'),
(111, 'Anisa Kurniawati', 'female', '085808761234', 'Jl. Merak, Desa Jaan, Kec. Gondang'),
(112, 'Sofi Nur Halimah', 'female', '087765431234', 'l. Wijaya, Desa Pelem, Kec. Wilangan'),
(113, 'Nadira Putri', 'female', '087712345431', 'Jl. Kenanga Hijau, Desa Jomblang, Kec. Bagor'),
(114, 'Dewi Anggun', 'female', '088112355432', 'Jl. Soka Barat, Desa Bagor Kulon, Kec. Bagor');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_name`, `phone_number`, `email`, `address`) VALUES
('KEYLA AMELIA TASYA', '085614567721', 'keylaatasya@gmail.com', 'Kec. Wilangan, Kab. Nganjuk');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rental_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `costume_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid',
  `status` enum('booked','borrowed','returned') DEFAULT 'booked',
  `penalty_fee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rental_id`, `customer_id`, `costume_id`, `start_date`, `end_date`, `quantity`, `total_amount`, `payment_status`, `status`, `penalty_fee`) VALUES
(401, 101, 101010, '2025-10-01', '2025-10-04', 1, 95000.00, 'paid', 'returned', 0.00),
(402, 102, 101027, '2025-10-01', '2025-10-04', 1, 90000.00, 'paid', 'returned', 0.00),
(403, 103, 101024, '2025-10-03', '2025-10-07', 1, 120000.00, 'paid', 'returned', 0.00),
(404, 104, 101018, '2025-10-03', '2025-10-07', 1, 95000.00, 'paid', 'returned', 0.00),
(405, 105, 101010, '2025-10-04', '2025-10-08', 1, 95000.00, 'paid', 'returned', 0.00),
(406, 106, 101016, '2025-10-10', '2025-10-14', 1, 130000.00, 'paid', 'borrowed', 0.00),
(407, 107, 101019, '2025-10-14', '2025-10-18', 1, 90000.00, 'paid', 'returned', 0.00),
(408, 108, 101024, '2025-10-15', '2025-10-19', 1, 120000.00, 'paid', 'returned', 0.00),
(409, 109, 101015, '2025-11-01', '2025-11-03', 1, 120000.00, 'paid', 'returned', 0.00),
(410, 110, 101017, '2025-11-01', '2025-11-05', 1, 100000.00, 'paid', 'returned', 0.00),
(411, 111, 101010, '2025-11-01', '2025-11-04', 1, 95000.00, 'paid', 'returned', 0.00),
(412, 112, 101024, '2025-11-02', '2025-11-05', 1, 120000.00, 'paid', 'returned', 0.00),
(413, 113, 101027, '2025-11-04', '2025-11-08', 1, 85000.00, 'paid', 'returned', 0.00),
(414, 114, 101012, '2025-11-09', '2025-11-12', 1, 90000.00, 'paid', 'returned', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`check_id`),
  ADD KEY `costume_id` (`costume_id`);

--
-- Indexes for table `costume`
--
ALTER TABLE `costume`
  ADD PRIMARY KEY (`costume_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `costume_id` (`costume_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `costume`
--
ALTER TABLE `costume`
  MODIFY `costume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101029;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checks`
--
ALTER TABLE `checks`
  ADD CONSTRAINT `checks_ibfk_2` FOREIGN KEY (`costume_id`) REFERENCES `costume` (`costume_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`costume_id`) REFERENCES `costume` (`costume_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
