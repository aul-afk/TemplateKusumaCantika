-- SQL dump for qc database
CREATE DATABASE IF NOT EXISTS qc CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE qc;
CREATE TABLE IF NOT EXISTS owner (
  owner_id INT AUTO_INCREMENT PRIMARY KEY,
  owner_name VARCHAR(100),
  phone_number VARCHAR(20),
  email VARCHAR(100),
  address VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS costume (
  costume_id INT AUTO_INCREMENT PRIMARY KEY,
  owner_id INT,
  costume_category VARCHAR(100),
  color VARCHAR(50),
  size VARCHAR(10),
  price DECIMAL(10,2),
  availability ENUM('yes','no') DEFAULT 'yes',
  FOREIGN KEY (owner_id) REFERENCES owner(owner_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS customer (
  customer_id INT AUTO_INCREMENT PRIMARY KEY,
  costume_id INT,
  customer_name VARCHAR(100),
  gender ENUM('male','female'),
  email VARCHAR(100),
  phone_number VARCHAR(20),
  address VARCHAR(255),
  FOREIGN KEY (costume_id) REFERENCES costume(costume_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS rental (
  rental_id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT,
  costume_id INT,
  start_date DATE,
  end_date DATE,
  quantity INT,
  total_amount DECIMAL(10,2),
  payment_status ENUM('paid','unpaid') DEFAULT 'unpaid',
  status ENUM('booked','borrowed','returned') DEFAULT 'booked',
  penalty_fee DECIMAL(10,2) DEFAULT 0,
  FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (costume_id) REFERENCES costume(costume_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS `checks` (
  check_id INT AUTO_INCREMENT PRIMARY KEY,
  owner_id INT,
  costume_id INT,
  check_date DATE,
  status ENUM('worthy','unworthy'),
  notes TEXT,
  FOREIGN KEY (owner_id) REFERENCES owner(owner_id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (costume_id) REFERENCES costume(costume_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
