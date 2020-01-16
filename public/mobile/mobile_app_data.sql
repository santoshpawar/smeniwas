-- phpMyAdmin SQL Dump
-- version 4.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2015 at 08:47 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smeniwas2`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobile_app_data`
--

CREATE TABLE IF NOT EXISTS `mobile_app_data` (
  `id` int(11) NOT NULL,
  `Firm_Name` varchar(50) NOT NULL,
  `EntityType` text NOT NULL,
  `BusinessType` text NOT NULL,
  `KeyProduct` text NOT NULL,
  `AuditedTurnover` bigint(50) NOT NULL,
  `FirmPan` varchar(100) NOT NULL,
  `FirmRegNo` varchar(100) NOT NULL,
  `OwnerName` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `Contact` int(11) NOT NULL,
  `CibilScore` int(11) NOT NULL,
  `LenderName` varchar(100) NOT NULL,
  `OutstandingAmt` bigint(50) NOT NULL,
  `MonthlyEmi` bigint(50) NOT NULL,
  `Liability` bigint(50) NOT NULL,
  `Degree` varchar(255) NOT NULL,
  `PromoType` varchar(11) NOT NULL,
  `Independent` varchar(50) NOT NULL,
  `OwnedVehicle` varchar(255) NOT NULL,
  `MarketValue` int(11) NOT NULL,
  `OwnedProperty` int(11) NOT NULL,
  `CustomerNature` varchar(110) NOT NULL,
  `OfficePremiseOwned` int(11) DEFAULT NULL,
  `OfficePremiseRented` int(11) DEFAULT NULL,
  `ManufacturePremise` int(11) DEFAULT NULL,
  `BankName` varchar(225) NOT NULL,
  `Amount` bigint(50) NOT NULL,
  `cust1` varchar(50) NOT NULL,
  `sale1` varchar(100) NOT NULL,
  `year1` varchar(100) NOT NULL,
  `cust2` varchar(50) NOT NULL,
  `sale2` varchar(225) NOT NULL,
  `year2` varchar(225) NOT NULL,
  `cust3` varchar(225) NOT NULL,
  `sale3` varchar(225) NOT NULL,
  `year3` varchar(225) NOT NULL,
  `CashSales` int(11) NOT NULL,
  `LoanPurpose` varchar(255) NOT NULL,
  `ReqAmt` bigint(20) NOT NULL,
  `PropType` varchar(11) NOT NULL,
  `ColAddress` varchar(255) NOT NULL,
  `ColCity` varchar(100) NOT NULL,
  `ColPincode` int(11) NOT NULL,
  `LatestVal` bigint(11) NOT NULL,
  `CollateralType` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile_app_data`
--

INSERT INTO `mobile_app_data` (`id`, `Firm_Name`, `EntityType`, `BusinessType`, `KeyProduct`, `AuditedTurnover`, `FirmPan`, `FirmRegNo`, `OwnerName`, `Email`, `Address`, `City`, `State`, `Pincode`, `Contact`, `CibilScore`, `LenderName`, `OutstandingAmt`, `MonthlyEmi`, `Liability`, `Degree`, `PromoType`, `Independent`, `OwnedVehicle`, `MarketValue`, `OwnedProperty`, `CustomerNature`, `OfficePremiseOwned`, `OfficePremiseRented`, `ManufacturePremise`, `BankName`, `Amount`, `cust1`, `sale1`, `year1`, `cust2`, `sale2`, `year2`, `cust3`, `sale3`, `year3`, `CashSales`, `LoanPurpose`, `ReqAmt`, `PropType`, `ColAddress`, `ColCity`, `ColPincode`, `LatestVal`, `CollateralType`) VALUES
(84, 'logitia', 'Pvt Ltd Company', 'B2B', 'cvcvc', 100000, '56546', '54645', 'sandhya', 'test@yahoo.com', 'thane', 'Mumbai', 'Maharashtra', 421301, 2147483647, 10000, '0', 0, 0, 0, '1', '2nd Generat', '2 to 4', '2 to 4', 1, 0, 'Manufacturing', 2000000, 100000, 122212121, '0', 0, 'sandy', '200000', '2-4 years', 'seema', '22222', '1 year', 'john', '12121221', '2-4 years', 0, 'Short term WC', 499999, 'Commercial', 'jalyan', 'Achabbal', 453654654, 799998, 'Rented'),
(85, 'IT solutions', 'Partnership Firm', 'B2C', 'application developer', 100000, '0', '5269456', 'Mr. Smith', 'abc@yahoo.com', 'ghatkopar', 'Mumbai', 'Maharashtra', 400008, 2147483647, 500, '500000', 0, 0, 0, '3', '1st Generat', '2 to 4', '1', 75000, 0, 'B2B', 0, 50000, 0, '8000000', 0, 'abc', '50000', '2-4 years', 'xyz', '10000', '1 year', 'pqr', '22000', '1 year', 0, 'Short term WC', 499999, 'Residential', 'thane', 'Mumbai', 40008, 300000, 'Self Occupied'),
(86, 'dsada', 'Partnership Firm', 'B2B', 'sdsd', 636, '45645', '45654', '5645', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, 'Commercial', 'xfgfh', 'Adalaj', 54654, 45645645, 'Rented'),
(90, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, 'Commercial', 'kalyan', 'Mumbai', 421301, 200000, 'Rented'),
(89, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, 'abc', '4554', '2-4 years', 'xyz', '4545', '1 year', 'fsfs', '4564', '1 year', 454545, 'purchase of property', 45456458, 'Residential', 'kalyan', 'Adalaj', 645, 456456, ''),
(91, 'ssfs', 'Partnership Firm', 'Manufacturing', 'testing', 50000, '5646456', '4564564', 'mr. x', 'test@yahoo.in', 'vashi', 'Mumbai', 'Madhya Pradesh', 741258, 2147483647, 800, '0', 0, 0, 0, '4', '1st Generat', '2 to 4', 'None', 0, 2, 'Manufacturing', 0, 44000, 20000, '486984568', 0, 'abcd', '5454', '1 year', 'hfh', '4545', '1 year', 'fdfh', '4456', '2-4 years', 0, 'long term WC', 800000, 'Industrial', 'mumbai', 'Mumbai', 410031, 60000, 'Self Occupied'),
(92, 'gdg', 'Partnership Firm', 'B2B', 'fhbfhf', 4545, '45645', '45645', 'fhfdh', 'abc@gmail.com', 'sfg', 'Adari', 'Goa', 4564, 455645, 45645, '45645', 0, 0, 0, '1', '2nd Generat', '2 to 4', '1', 56546456, 0, 'B2B', 0, 536345, 456456, '0', 0, 'dfsg', '10000', '1 year', 'sdgs', '10000', '2-4 years', 'sdgsg', '2000', '1 year', 0, 'Short term WC', 78688, 'Residential', 'khdkjgd', 'Achabbal', 585664, 3999999, 'Self Occupied'),
(93, 'sfaf', 'Partnership Firm', 'trading', 'asfasf', 4524, '564', '45654645', 'sandy', 'test@gmail.com', 'dsgds', 'Adilabad', 'Assam', 546456546, 78656, 66, '0', 0, 0, 0, '1', '1st Generat', '1', '1', 0, 2, 'B2B', 4565, 0, 4645, '45645645', 0, 'vhh', '456', '2-4 years', 'fhjf', '4656', '1 year', 'jfj', '45645', '1 year', 0, 'purchase of equipment', 399999, 'Residential', 'gdsg', 'Achhnera', 4565465, 100000, 'Rented'),
(94, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, 'Residential', 'bvb', 'Adilabad', 454654, 4565465462, 'Self Occupied'),
(95, 'logitia solutions', 'LLP', 'B2C', 'testing', 500000, '11111', '23454', 'admin', 'abc@gmail.com', 'ggfg', 'Achabbal', 'Bihar', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(96, 'logitia solutions', 'Trust', 'B2B', 'sfsf', 1000, '456546', '45654645', 'sandhya', 'kasar@gmail.com', 'mumbai', 'Mumbai', 'Maharashtra', 11111, 12425487, 78577, '0', 0, 0, 0, '1', '1st Generat', '1', '2 to 4', 0, 1, 'B2B', 0, 45654654, 0, '0', 0, 'sfs', '45635', '2-4 years', 'sfs', '436', '1 year', 'asfaf', '45645', '1 year', 0, 'Short term WC', 1000000, 'Land Agri', 'fhfh', 'Achabbal', 456322, 100000, 'Rented'),
(97, 'it solutions', 'Trust', 'B2B', 'testing', 50000, '656', '5654', 'sandy', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(98, 'it solutions', 'Proprietorship', 'B2C', 'sdfsaf', 100000, '0', '456464', 'gjfjfj', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(99, 'faf', 'Proprietorship', 'B2B', 'sfsf', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(100, 'abc solutions', 'Pvt Ltd Company', 'Manufacturing', 'testing', 50000, '123654', '5464', 'mr.smith', 'testmail@yahoo.com', 'delhi', 'Agra', 'Rajasthan', 421301, 2147483647, 600, '0', 0, 0, 0, '1', '1st Generat', '2 to 4', '1', 0, 0, 'Manufacturing', 0, 100000, 0, '0', 0, 'seema', '500000', '1 year', 'jaya', '500000', '1 year', 'rekha', '1000000', '4-8 years', 0, 'contractor advance for project', 500000, 'Commercial', 'mumbai', 'Thane', 421301, 599998, 'Rented'),
(101, 'xyz solutions pvt.ltd.', 'Proprietorship', 'trading', 'key product', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(102, 'xyz solutions pvt.ltd.', 'Partnership Firm', 'B2C', 'key products', 100000, '0', '5698976', 'sandhya kasar', 'comp@yahoo.in', 'mumbai', 'Thane', 'Maharashtra', 421301, 2147483647, 900, '0', 0, 0, 0, '3', '1st Generat', '2 to 4', '2 to 4', 0, 0, 'B2B', 456456, 0, 456546, '0', 0, 'sfsaf', '2321', '2-4 years', 'fsf', '123', '2-4 years', 'dff', '123', '2-4 years', 0, 'Short term WC', 6000197, 'Commercial', 'cvzcv', 'Adari', 66454, 949999, 'Rented'),
(103, 'dfdsf', 'Pvt Ltd Company', 'B2B', 'fdsfdsf', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(104, 'sfsaf', 'Proprietorship', 'B2B', 'sfsf', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(105, 'abcd', 'LLP', 'B2C', 'add', 60000, '456546', '5645', 'sandy', 'a@g.com', 'dgd', 'Adra, Purulia', 'Bihar', 123456, 1234567890, 400, '0', 0, 0, 0, '3', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 0, 122222, 0, '0', 0, 'b', '325', '1 year', 'b', '35325', '1 year', 'b', '65656', '1 year', 6, 'contractor advance for project', 9001998, 'Commercial', 'gdsgsd', 'Achhnera', 45546, 5465464, 'Rented'),
(106, 'gfdg', 'LLP', 'B2B', 'fgfdg', 213123, '213213', '123123', 'jkjk', 'fgsdgd@g.com', 'dgdsg', 'Chittoor', 'Chandigarh', 4564, 546546, 5454, '0', 0, 0, 0, '3', '1st Generat', '2 to 4', '2 to 4', 0, 2, 'B2B', 0, 45654, 0, '0', 0, 'ghg', '', '', 'ghgh', '', '', '', '', '', 0, '', 0, 'Land Agri', 'ghg', 'Adalaj', 4645, 534534534, 'Empty'),
(107, 'sadas', 'Partnership Firm', 'B2B', 'aas', 45645, '45645', '45645', 'dfasf', 'nn@g.com', 'dgdg', 'Achabbal', 'Assam', 45654, 45654, 4564, '45645', 0, 0, 0, '3', '1st Generat', '2 to 4', '2 to 4', 0, 0, 'trading', 6545, 0, 54654, '0', 0, 'dgsg', '4564', '2-4 years', 'dsgg', '4654', '1 year', 'dgsg', '4564', '1 year', 456456, 'purchase of equipment', 456456456, 'Land Agri', 'cnhv', 'Adalaj', 5454654, 56546456, 'Rented'),
(108, 'fvhf', 'Pvt Ltd Company', 'B2B', 'fh', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(109, 'xbfx', 'Pvt Ltd Company', 'B2B', 'fgg', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(110, 'hfh', 'Proprietorship', 'B2B', 'fhfh', 46545645, '0', '4554', '5445', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(111, 'admin firm', 'Partnership Firm', 'B2B', 'faf', 500000, '564564', '456456', 'testUser', 'abc@yahoo.in', 'hjhk', 'Adalaj', 'Arunachal Pradesh', 421301, 2147483647, 90, '0', 0, 0, 0, '2', '1st Generat', '1', '1', 0, 3, 'Manufacturing', 56456, 0, 56546, '0', 0, 'a', '54', '2-4 years', 'a', '54', '8 years', 's', '54', '1 year', 0, 'purchase of property', 2699998, 'Residential', 'fhfhfh', 'Achhnera', 45645, 5000000, 'Rented'),
(112, 'cbcb', 'Proprietorship', 'Manufacturing', 'fgfh', 546456, '54645', '54654', '4645', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(113, 'fhdf', 'Proprietorship', 'Manufacturing', 'fhf', 664, '545', '546', 'sandy', 'abc@gmail.com', 'dgg', 'Adalaj', 'Assam', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(114, 'dgsdg', 'Pvt Ltd Company', 'B2C', 'dgg', 5446, '45645', '45645', 'gdg', 'dgsg@gmail.com', 'dgds', 'Adari', 'Chandigarh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(115, 'dgdsg', 'Proprietorship', 'B2C', 'dsgd', 564, '54654', '54654', 'ghgf', 'dgg@gmail.com', 'dgsdg', 'Abhayapuri', 'Assam', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(116, 'ddg', 'Partnership Firm', 'Manufacturing', 'dgdsg', 695, '456', '456', '456', 'sandhya.kasar@rediffmail.com', 'dgsg', 'Adari', 'Assam', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(117, 'adasd', 'Proprietorship', 'B2B', 'dad', 4545, '564', '456', 'aaf', 'dfhfh@gmail.com', 'fdhfdh', 'Achhnera', 'Bihar', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(118, 'ssfs', 'Pvt Ltd Company', 'B2B', 'sfsf', 546, '546', '456', 'sandy', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(119, 'hdh', 'Pvt Ltd Company', 'B2B', 'dhdh', 56546, '45654', '54645', 'fdsf', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(120, 'dfhh', 'Pvt Ltd Company', 'B2B', 'fdhdfh', 6456, '45645', '4564', 'ghg', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(121, 'gnghn', 'Proprietorship', 'Manufacturing', 'ghgh', 54645, '45645', '45645', 'san', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(122, 'nn', 'Pvt Ltd Company', 'B2C', 'ghgh', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(123, 'abc', 'Proprietorship', 'Manufacturing', 'gdg', 8500000, '0', '456321', 'sandy', 'test@gmail.com', 'fhfh', 'Achhnera', 'Andhra Pradesh', 4645, 45645, 456, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(124, 'abc', 'Partnership Firm', 'B2B', 'fsfs', 676, '0', '4565', 'ss', 'test@gmail.com', 'sfsf', 'Achabbal', 'Jharkhand', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(125, 'gdfg', 'Partnership Firm', 'B2B', 'fgfh', 8500000, '0', '4646', 'sandhya', 'test@gmail.com', 'dgdg', 'Achhnera', 'Andhra Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(126, 'adda', 'Proprietorship', 'B2B', 'dadad', 8500000, '0', '56546', 'sandy', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(127, 'gdg', 'Pvt Ltd Company', 'B2B', 'sgg', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(128, 'fsf', 'Proprietorship', 'Manufacturing', 'fdf', 5645, '45645', '45645', 'ss', 'sanjog121@gmail.com', 'sfsf', 'Achhnera', 'Arunachal Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(129, 'dgg', 'Pvt Ltd Company', 'B2B', 'dgdg', 4546, '6436', '63566', 'sandy', 'kasarsandhya4@gmail.com', 'dgdg', 'Achabbal', 'Arunachal Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(130, 'abc', 'Proprietorship', 'B2B', 'dfdf', 4000, '7855885', '588469', 'sandhya', 'admin@teacher.com', 'gdfg', 'Abhayapuri', 'Arunachal Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(131, 'abc', 'Proprietorship', 'B2B', 'fdf', 8500000, '0', '456456', 'sandy', 'admin@teacher.com', 'fdfds', 'Adalaj', 'Dadra and Nagar Haveli', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(132, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(133, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(134, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(135, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(136, 'bb', 'Partnership Firm', 'B2B', 'gg', 5656, '45645', '4564', 'sandy', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(137, 'fhgdfh', 'Pvt Ltd Company', 'Manufacturing', 'fhfh', 5645, '45645', '456', 'sandy', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(138, 'gjfj', 'Pvt Ltd Company', 'B2B', 'ghgfj', 54654, '5464', '4564', 'ffdfd', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(139, 'fhhdfh', 'Pvt Ltd Company', 'B2B', 'hhh', 456456, '456546', '45645', 'dgg', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(140, 'fhgh', 'Proprietorship', 'B2C', 'hh', 54654, '45645', '45645', '456456', 'sandhya.kasar@rediffmail.com', 'fhhf', 'Adari', 'Bihar', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(141, 'gdgd', 'Pvt Ltd Company', 'B2B', 'dgdg', 54645, '54645', '54645', 'vzvfz', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(142, '', '', '', '', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(143, 'firm', 'LLP', 'B2B', 'fgfg', 645656546, '4564564', '56456', 'sandhya', 'kasarsandhya4@gmail.com', 'fsdfs', 'Achhnera', 'Bihar', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(144, 'admin firm', 'Proprietorship', 'trading', 'dfsdf', 8500000, '456546', '456456', 'sandhya', 'sanjog121@gmail.com', 'sfsf', 'Adalaj', 'Assam', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(145, 'gjgj', 'Pvt Ltd Company', 'B2C', 'ggj', 45645, '546546', '546546', '546', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(146, 'adad', 'Pvt Ltd Company', 'B2B', 'adad', 546, '4545', '456', 'bxfg', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(147, 'bvb', 'Proprietorship', 'B2B', 'vbvb', 78676, '877', '87587', 'sandhya', 'sandhya.kasar@rediffmail.com', 'gfdh', 'Achabbal', 'Arunachal Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(148, 'small firm', 'Partnership Firm', 'Manufacturing', 'manufacturing products', 800000, '456456', '456456', 'sandhya', 'sandhya.kasar@Logitia.in', 'kalyan', 'Thane', 'Manipur', 421301, 2147483647, 50, '50000', 0, 0, 0, '2', '1st Generat', '1', '2 to 4', 45000, 1, 'B2B', 0, 5000, 40000, '8500000', 0, 'abc', '800000', '1 year', 'xyz', '2500000', '2-4 years', 'pqr', '50000', '4-8 years', 0, 'Short term WC', 1000000, 'Residential', 'mumbai', 'Mumbai', 400008, 4500000, 'Self Occupied'),
(149, 'firm', 'Partnership Firm', 'Manufacturing', 'test', 45, '4123645', '5645', 'ssan', 'sandhya.kassar@logitia.in', 'adad', 'Adalaj', 'Bihar', 421301, 54645, 456, '0', 0, 0, 0, '3', '1st Generat', '1', '1', 0, 3, 'B2B', 0, 5464, 0, '0', 0, 'a', '4554', '1 year', 'b', '554', '2-4 years', 'c', '56456', '8 years', 0, 'Short term WC', 100000, 'Commercial', 'sfa', 'Achabbal', 4552, 45454, ''),
(150, 'firm', 'Proprietorship', 'Manufacturing', 'sf', 1000000, '0', '45645', 'sandy', 'kasarsandhya4@gmail.com', 'adad', 'Achhnera', 'Assam', 6456, 54654, 45654, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(151, 'xvx', 'Proprietorship', 'B2B', 'fgf', 45, '54', '45', 'sa', 'sandhya.kasar@rediffmail.com', 'xvxv', 'Achhnera', 'Arunachal Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(152, 'abc', 'Pvt Ltd Company', 'B2C', 'sdsd', 44, '44', '545', 'san', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(153, 'abc', 'LLP', 'B2B', 'dsd', 4564, '45645', '5654', 'asc', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(154, 'abc', 'Proprietorship', 'B2B', 'dfd', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(155, 'dd', 'Proprietorship', 'B2B', 'gdg', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(156, 'abc', 'Pvt Ltd Company', 'B2C', 'df df', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(157, 'ss', 'Proprietorship', 'B2C', 'sfs', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(158, 'sad', 'Partnership Firm', 'Manufacturing', 'sad', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(159, 'wq', 'Partnership Firm', 'B2B', 'sad', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(160, 'asd', 'LLP', 'B2C', 'sad', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(161, 'sad', 'Pvt Ltd Company', 'B2B', 'sad', 12, '0', '23', 'sad', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(162, 'asd', 'Proprietorship', 'B2B', 'sad', 0, '0', '0', '', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(163, 'sdf', 'Proprietorship', 'Manufacturing', 'sad', 123, '0', '123', 'asd', '', '', '', '', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(164, 'asd', 'Partnership Firm', 'B2B', 'sad', 12, '0', '12', 'asd', 'test@test123.comh', 'hjhj', 'Gudivada', 'Andhra Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(165, 'sfs', 'Proprietorship', 'B2B', 'sfsf', 5454, '4554', '4545', 'sandhya123', 'abc@yahoo.com', 'gh', 'Achhnera', 'Arunachal Pradesh', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(166, 'sfsf', 'Proprietorship', 'B2C', 'fsf', 45, '45', '45', 'happy', 'admin@teacher.com', 'fdg', 'Adalaj', 'Dadra and Nagar Haveli', 0, 0, 0, '0', 0, 0, 0, '', '', '', '', 0, 0, '', 0, 0, 0, '0', 0, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', 0, 0, ''),
(167, 'ABC', 'Proprietorship', 'B2C', 'SFF', 46456, '4554', '54654645', 'SANDY', 'ADS@GMAIL.COM', 'gfhjfgjg', 'Adalaj', 'Arunachal Pradesh', 4564, 544646, 50, '0', 0, 0, 0, '2', '1st Generat', '1', '1', 0, 1, 'B2B', 0, 546, 45645, '0', 0, 'a', '45654', '1 year', 'a', '554', '2-4 years', 'a', '5645', '1 year', 0, 'purchase of equipment', 456546, 'Residential', 'gjgj', 'Achabbal', 546546, 399999, 'Self Occupied'),
(168, 'IT firm', 'Pvt Ltd Company', 'B2C', 'key products & services', 100000, '64645', '56546546', 'HFM', 'hfm@gmail.com', 'navi mumbai', 'Thane', 'Maharashtra', 421301, 2147483647, 50, '200000', 0, 0, 0, '2', '2nd Generat', '2 to 4', '1', 654654654, 1, '', 4544, 0, 56546, '0', 0, 'hina', '55000', '2-4 years', 'tina', '60000', '1 year', 'meena', '25000', '8 years', 0, 'Short term WC', 800000, 'Commercial', 'sfsf', 'Achhnera', 123653, 599999, 'Self Occupied'),
(169, 'Logitia solutions', 'Pvt Ltd Company', 'B2C', 'Mobile application', 500000, '4656465', '55465453', 'pratiksha', '', 'nerul', 'Thane', 'Maharashtra', 400012, 2147483647, 80, '0', 0, 0, 0, '3', '1st Generat', '1', '2 to 4', 0, 2, 'Manufacturing', 52631, 0, 456321, '900000', 0, 'as', '45216', '1 year', 'zc', '45632', '2-4 years', 'we', '89566', '1 year', 0, 'Short term WC', 600000, 'Residential', 'vashi', 'Achhnera', 4000123, 300000, 'Rented'),
(170, 'abc123', 'Pvt Ltd Company', 'B2B', 'hfgh', 12, '6354', '123', 'test12345', 'test12345@gmail.com', 'mulund', 'Adari', 'Assam', 421330, 89652345, 5021, '0', 0, 0, 0, '1', '1st Generat', '1', '2 to 4', 0, 1, 'Manufacturing', 6546, 0, 45654, '0', 0, 'x', '45654', '1 year', 'y', '546', '1 year', 'z', '54654', '4-8 years', 0, 'purchase of equipment', 850000, 'Commercial', 'ghatkopar', 'Mumbai', 421299, 100000, 'Rented'),
(171, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'sadsad', 'sadsad@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(172, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'sadsad', 'sadsad@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(173, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'CYA', 'CYA@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(174, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'abhi', 'abhi@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(175, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'lmn', 'lmn@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(176, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'mysuser', 'mysuser@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(177, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'user123', 'user123@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(178, 'small business firm', 'Proprietorship', 'B2B', 'adadf', 325235, '35252', '3525', 'user567', 'user567@test.com', 'ADWA', 'Adalaj', 'Chandigarh', 3325, 2147483647, 4, '0', 0, 0, 0, '2', '1st Generat', '2 to 4', '', 0, 0, 'B2B', 436346, 0, 643634, '0', 0, '', '', '', '', '', '', '', '', '', 0, 'purchase of property', 4500000, 'Land Non-Ag', 'TETET', 'Achhnera', 453453, 43536, 'Rented'),
(179, 'ABC FIRM', 'Proprietorship', 'Manufacturing', 'development', 123124, '325325', '0', 'satish', 'satish@logita.com', 'mumbai', 'mumbai', 'Bihar', 421301, 2147483647, 43, 'sandhya', 346436436, 436436346, 46346, '2', '1st Generat', '2 to 4', 'None', 366546, 1, 'B2B', 436466, 0, 0, 'SBI', 45436457, 'SA', '466', '2-4 years', 'GFG', '4646', '2-4 years', 'ABC', '346363', '8 years', 45634634, 'purchase of equipment', 346346, 'Commercial', 'THANE', 'abc', 3255235, 25235, 'Rented'),
(180, 'arfete', 'Proprietorship', 'Manufacturing', 'etet', 346346, '4665', '346346', 'rahulc', 'rahulcc@testmail.com', 'ere', 'Adalaj', 'Andhra Pradesh', 346346, 436436, 436346, 'dhdfh', 756, 55, 6765, '3', '2nd Generat', '2 to 4', '1', 76867, 1, 'B2B', 0, 346463, 0, 'gryr', 46467, '45436', '43643', '1 year', '4643', '43643', '2-4 years', '436', '436', '2-4 years', 46, 'purchase of property', 4364367, '', '', '', 0, 0, ''),
(181, 'arfete', 'Proprietorship', 'Manufacturing', 'etet', 346346, '4665', '346346', 'rahulc123', 'rahulcc123@testmail.com', 'ere', 'Adalaj', 'Andhra Pradesh', 346346, 436436, 436346, 'dhdfh', 756, 55, 6765, '3', '2nd Generat', '2 to 4', '1', 76867, 1, 'B2B', 0, 346463, 0, 'gryr', 46467, '45436', '43643', '1 year', '4643', '43643', '2-4 years', '436', '436', '2-4 years', 46, 'purchase of property', 4364367, '', '', '', 0, 0, ''),
(182, 'arfete', 'Proprietorship', 'Manufacturing', 'etet', 346346, '4665', '346346', 'rahulc123', 'rahulcc123@testmail.com', 'ere', 'Adalaj', 'Andhra Pradesh', 346346, 436436, 436346, 'dhdfh', 756, 55, 6765, '3', '2nd Generat', '2 to 4', '1', 76867, 1, 'B2B', 0, 346463, 0, 'gryr', 46467, '45436', '43643', '1 year', '4643', '43643', '2-4 years', '436', '436', '2-4 years', 46, 'purchase of property', 4364367, '', '', '', 0, 0, ''),
(183, 'arfete', 'Proprietorship', 'Manufacturing', 'etet', 346346, '4665', '346346', 'rahulc1231', 'rahulcc1123@testmail.com', 'ere', 'Adalaj', 'Andhra Pradesh', 346346, 436436, 436346, 'dhdfh', 756, 55, 6765, '3', '2nd Generat', '2 to 4', '1', 76867, 1, 'B2B', 0, 346463, 0, 'gryr', 46467, '45436', '43643', '1 year', '4643', '43643', '2-4 years', '436', '436', '2-4 years', 46, 'purchase of property', 4364367, '', '', '', 0, 0, ''),
(184, 'arfete', 'Proprietorship', 'Manufacturing', 'etet', 346346, '4665', '346346', 'rahulca1231', 'rahulcc11a23@testmail.com', 'ere', 'Adalaj', 'Andhra Pradesh', 346346, 436436, 436346, 'dhdfh', 756, 55, 6765, '3', '2nd Generat', '2 to 4', '1', 76867, 1, 'B2B', 0, 346463, 0, 'gryr', 46467, '45436', '43643', '1 year', '4643', '43643', '2-4 years', '436', '436', '2-4 years', 46, 'purchase of property', 4364367, '', '', '', 0, 0, ''),
(185, 'dfds', 'Pvt Ltd Company', 'trading', 'sdf', 12, '12fdfsd', '123', '123', 'abcdefg@test.com', 'dsfdsf123', 'Adityana', 'Chhattisgarh', 21213, 23213, 21312, '12asdsd', 232, 12, 12, '2', '1st Generat', '1', 'None', 12, 0, 'B2B', 0, 12, 0, 'dsdsad', 112, 'sd', '12', '2-4 years', 'sad', '12', '4-8 years', 'dsd', '12', '4-8 years', 0, 'fund capital expenditure incl civil work', 12, '', '', '', 0, 0, ''),
(186, 'dsfds', 'Pvt Ltd Company', 'B2B', 'rewrewr', 23, '324sdfsd', '324', '234sdfs', 'aaaaa@test.com', 'sdasd', 'Adoni', 'Goa', 2147483647, 123123123, 2312, 'sdsa', 12, 12, 12, '4', '1st Generat', '1', 'None', 12, 0, 'Manufacturing', 12, 0, 12, 'sadas', 12, 'aew', '12', '4-8 years', 'qweqw', '12', '4-8 years', 'aads', '112', '2-4 years', 12, 'fund capital expenditure incl civil work', 12, '', '', '', 0, 0, ''),
(187, 'dfsdf', 'Pvt Ltd Company', 'B2B', 'fdsf', 324, 'df2342', '234', 'sdfs', 'aaaaaaa@test.com', '2eqwe21321', 'Adoor', 'Chandigarh', 23123, 2147483647, 123, 'sfsd', 12, 12, 12, '4', '1st Generat', '1', 'None', 12, 0, 'B2B', 12, 0, 0, '12', 12, 'aaaa', '12', '4-8 years', 'dsfsdf', '12', '2-4 years', 'ds', '12', '4-8 years', 12, 'contractor advance for project', 12, '', '', '', 0, 0, ''),
(188, 'dfsdf', 'Pvt Ltd Company', 'B2B', 'fdsf', 324, 'df2342', '234', 'sdfs46346', 'aaaaaaa123@test.com', '2eqwe21321', 'Adoor', 'Chandigarh', 23123, 2147483647, 123, 'sfsd', 12, 12, 12, '4', '1st Generat', '1', 'None', 12, 0, 'B2B', 12, 0, 0, '12', 12, 'aaaa', '12', '4-8 years', 'dsfsdf', '12', '2-4 years', 'ds', '12', '4-8 years', 12, 'contractor advance for project', 12, '', '', '', 0, 0, ''),
(189, '54745', 'LLP', 'B2B', '57547', 5754, 'sryry', 'reyer5t7', 'sandhya123456', 'kasarsansjfh@gmail.com', 'aftet', 'Achabbal', 'Assam', 354, 4534634, 6436, 'etet', 436436, 436346, 64346, '3', '2nd Generat', '1', '1', 45745, 1, 'B2B', 54747, 0, 5454, 'etwet', 36347, 'fdf', '546', '4-8 years', 'dfdsf', '43643', '1 year', 'dgdg', '34643', '1 year', 35346, 'fund capital expenditure incl civil work', 367347, '', '', '', 0, 0, ''),
(190, 'Xyz', 'Partnership Firm', 'Manufacturing', 'Hgx I gd', 77, 'Gfsf', 'Cgu', 'Fibct', 'abc@yahoo.com', 'Hxsfhhd', 'Bobbili', 'Bihar', 452369, 2147483647, 600, 'Abdjdndhd', 88, 5, 68, '1', '1st Generat', '2 to 4', '2 to 4', 5, 0, 'Manufacturing', 88, 0, 66, 'Vsosndus', 99, 'Trees uh ff', '5248', '2-4 years', 'Bhxgg', '555', '4-8 years', 'Vdtui', '999', '4-8 years', 0, 'purchase of property', 99, '', '', '', 0, 0, ''),
(191, 'asd', 'Pvt Ltd Company', 'Manufacturing', 'safsaf', 4336, '66', 'ryry', 'sandhya123', 'kasarsandhya6454@gmail.com', 'erew', 'Abhayapuri', 'Arunachal Pradesh', 436, 43643, 43, 'fsdgf', 34673, 57, 57, '3', '1st Generat', '2 to 4', '1', 3463, 2, 'B2C', 45745, 0, 0, 'syry', 347457, 's', '45656', '1 year', 'ryrey', '346456', '2-4 years', 'fdgfg', '36436', '2-4 years', 0, 'contractor advance for project', 3575, '', '', '', 0, 0, ''),
(192, 'asd', 'Pvt Ltd Company', 'Manufacturing', 'safsaf', 4336, '66', 'ryry', 'sandhya12354365', 'kasarsandhy43643a6454@gmail.com', 'erew', 'Abhayapuri', 'Arunachal Pradesh', 436, 43643, 43, 'fsdgf', 34673, 57, 57, '3', '1st Generat', '2 to 4', '1', 3463, 2, 'B2C', 45745, 0, 0, 'syry', 347457, 's', '45656', '1 year', 'ryrey', '346456', '2-4 years', 'fdgfg', '36436', '2-4 years', 0, 'contractor advance for project', 3575, '', '', '', 0, 0, ''),
(193, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'adsads', 'asas@testmail.com', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 32532532, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(194, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'safasfsaf', 'sandhya.kasar@logitia.in', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 32532532, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(195, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'sandhyaTest', 'kasarsandhya4@gmail.com', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 32532532, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(196, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'sandhyaTest', 'kasarsandhya4@gmail.com', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 32532532, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(197, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'sandhyaTest', 'sandhya.kasar@logitia.in', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 32532532, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(198, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'sandhyauser', 'kasarsandhya4@gmail.com', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 32532532, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(199, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'pallavik', 'pallavi.kasera@logitia.in', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 2147483647, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(200, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'pallavik123', 'kasarsandhya4@gmail.com', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 2147483647, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, ''),
(201, 'asbf', 'Proprietorship', 'B2B', 'asfasf', 32423, '32532', 'ewwt', 'pallavik123456', 'kasarsandhya4@gmail.com', 'qwrqwr', 'Adalaj', 'Chandigarh', 32532, 2147483647, 44, 'rqwr', 23523, 56262, 643, '2', '1st Generat', '2 to 4', '1', 456, 1, 'B2C', 436436, 0, 436436, 'sgrgtr', 346436, 'sfa', '345346', '4-8 years', 'safs', '265346', '1 year', 'sf', '346346', '1 year', 0, 'promoters personal use', 57457, '', '', '', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobile_app_data`
--
ALTER TABLE `mobile_app_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mobile_app_data`
--
ALTER TABLE `mobile_app_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=202;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
