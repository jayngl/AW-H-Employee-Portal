CREATE DATABASE IF NOT EXISTS EMPLOYEES;

USE EMPLOYEES;

CREATE TABLE IF NOT EXISTS `employee_info` (
  `EIN` varchar(10) NOT NULL,
  `Name` text NOT NULL,
  `Current highest Qualification` text NOT NULL,
  `Salary` decimal (10,0) NOT NULL,
  `Deductions` decimal(10,0) NOT NULL,
  `TRN` VARCHAR(15) NOT NULL UNIQUE,
  `Bank branch` int NOT NULL,
  `BAN` int NOT NULL UNIQUE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `employee_info` (`EIN`, `Name`, `Current highest Qualification`, `Salary`, `Deductions`, `TRN`, `Bank branch`, `BAN`) VALUES

('IA05', 'Karine Coke', 'Asc.Deg', 60000, 300, '143-228', 5, 5847),
('IA78', 'Suzan Powell', 'Bsc.Deg', 70000, 400, '119-837', 5, 7483),
('IA79', 'William Smith', 'Asc.Deg', 60000, 250, '193-635', 5, 7063),
('IA45', 'Pauline Clarke', 'PHD', 90000, 1500, '193-841', 6, 9367),
('IA56', 'Karlene Graham', 'Phd', 91000, 1600, '122-831', 5, 8474),
('IA32', 'Vin Miller', 'Asc.Deg', 61000, 310, '162-363', 5, 2345),
('IA25', 'Sam Henry', 'Msc.Deg', 80000, 450, '114-877', 5, 9494),
('IA02', 'Ian Clarke', 'Bsc.Deg', 70000, 400, '121-623', 6, 5894),
('IA05', 'Karine Coke', 'Asc.Deg', 60000, 300, '126-331', 5, 8485);
COMMIT;

