-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 06:19 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fund`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_rule`
--

CREATE TABLE `accounting_rule` (
  `rule_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_rule`
--

INSERT INTO `accounting_rule` (`rule_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(1, 'Rule 1', 'rule', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `amortization_method`
--

CREATE TABLE `amortization_method` (
  `method_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amortization_method`
--

INSERT INTO `amortization_method` (`method_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(1, 'TESTING ABC', 'ABC', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`api_id`, `username`, `firstname`, `lastname`, `password`, `status`, `date_added`, `date_modified`) VALUES
(2, 'uICL9n0QUGUHhGfhwLTOqGxJmCjpZySI1PBDIVLhtGQEL4eJsb3eTJBjnOQrumbJ', '', '', 'ZO9q4CNU2KmeHLlo5rHM0BeisRfqkiemmBWpvzdB6P2eS4kooWzzhZvdWARHPRyx8rrprzNPI4ArwSo0MQTdXdUTfgfueOpdd619fmMe2OEpv7etwWpKqh6PC1YHFD0k22Lg6F5jrPu4MKC9iQEpEM0hzACBWe2qgxM5WqSn39oW0stFfMTAgpf7GqB2kQLc01oCqC6KBg1pfhUPPKBbgh9CsZn4tRfxJw6N02nUL6oNetepltlE6IPD4M1t8P5h', 1, '2020-07-03 16:08:52', '2020-07-03 16:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(1, 'test', 'ts', 1, 1),
(2, 'Pakistan Areas', 'PK', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `name`, `remarks`, `status`, `sort_order`) VALUES
(1, 'TEST BANK', 'TESTED', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `charge_type_id` int(11) NOT NULL,
  `charge_option_id` int(11) NOT NULL,
  `penalty` double NOT NULL,
  `charge_amount` double NOT NULL,
  `override` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `name`, `sname`, `charge_type_id`, `charge_option_id`, `penalty`, `charge_amount`, `override`, `currency_id`, `status`, `remarks`, `added_date`) VALUES
(4, 'Chrage Testing', 'Charge', 2, 0, 44123, 458256, 346, 2, 1, 'trest entry', '2020-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `charges_option`
--

CREATE TABLE `charges_option` (
  `option_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges_option`
--

INSERT INTO `charges_option` (`option_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(0, 'Option TYPE 1', 'option', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `charges_type`
--

CREATE TABLE `charges_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges_type`
--

INSERT INTO `charges_type` (`type_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(1, 'CHARGE TYPE 1', 'CHARGE', 1, 1),
(2, 'CHARGE TYPE 1', 'CHARGE', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `rent_per` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `name`, `address`, `rent_per`, `contact`, `date_updated`) VALUES
(1, 'ABC', '1425', 111, 6589, '2023-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `sort_order` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `name`, `sname`, `sort_order`, `status`) VALUES
(259, 'Test Countrys', 'ts', 12, 1),
(260, 'United Arab Emirates', 'UAE', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(12) NOT NULL,
  `symbol_right` varchar(12) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` float(15,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_place`, `value`, `status`, `date_modified`) VALUES
(1, 'Pound Sterling', 'GBP', '£', '', '2', 0.61250001, 1, '2014-09-25 14:40:00'),
(2, 'US Dollar', 'USD', '$', '', '2', 1.00000000, 1, '2014-09-25 14:40:00'),
(3, 'Euro', 'EUR', '', '€', '2', 0.78460002, 1, '2014-09-25 14:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fname`, `lname`, `email`, `contact`, `address`, `status`, `sort_order`, `date_added`) VALUES
(2, 'as', 'dfbjb', 'naveedlanjar@outlook.com', '0300846352', 'ibh', 1, 2, '2023-08-16'),
(3, 'imran', 'ahsan', 'imran@gmail.com', '030000000052', 'test address karachi', 2, 2, '2023-08-16'),
(7, 'kashif', 'ali Dero', 'kashif@gmail.com1', '03004580585', 'JOhar complex', 1, 0, '2023-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `fname`, `lname`, `email`, `contact`, `address`, `status`, `sort_order`, `date_added`) VALUES
(1, 'Aakash', 'ali Dero', 'kashif@gmail.com1', '03004580585', 'JOhar complex', 1, 0, '2023-08-20'),
(2, 'Junaid', 'Lanjar', 'kashif@gmail.com1', '03004580585', 'JOhar complex', 1, 0, '2023-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `duration_types`
--

CREATE TABLE `duration_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duration_types`
--

INSERT INTO `duration_types` (`id`, `name`, `status`) VALUES
(1, 'MONTHS', 1),
(2, 'YEARS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

CREATE TABLE `entity` (
  `entity_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entity`
--

INSERT INTO `entity` (`entity_id`, `name`, `remarks`, `status`, `sort_order`) VALUES
(1, 'tested', 'abc', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fund_types`
--

CREATE TABLE `fund_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_type` int(11) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_types`
--

INSERT INTO `fund_types` (`id`, `name`, `sname`, `duration`, `duration_type`, `remarks`, `status`, `sort_order`, `date_added`) VALUES
(2, 'Funding Tests', 'fund testeds', 34, 2, 'test remarkss', 1, 0, '2020-11-24'),
(3, '', '', 0, 0, '', 0, 0, '2020-11-24'),
(4, 'New Fund', 'FD', 45, 1, 'test', 1, 0, '2020-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `interest_method`
--

CREATE TABLE `interest_method` (
  `method_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interest_method`
--

INSERT INTO `interest_method` (`method_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(1, 'Interest Method 1', 'interest', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

CREATE TABLE `investor` (
  `investor_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `nature_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `capital_amount` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_account` varchar(200) NOT NULL,
  `region_id` int(11) NOT NULL,
  `bank_address` varchar(200) NOT NULL,
  `added_date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investor`
--

INSERT INTO `investor` (`investor_id`, `name`, `sname`, `address`, `email`, `phone`, `entity_id`, `country_id`, `nature_id`, `currency_id`, `capital_amount`, `bank_id`, `bank_account`, `region_id`, `bank_address`, `added_date`, `status`, `remarks`) VALUES
(4, 'Naveed', 'Hussain', 'Karachi', 'naveedlanjar11@gmail.com,test@gmail.com', '030045080585', 1, 260, 1, 0, 56874, 1, '458774tef554', 1, 'karachi, sindh, pakistan', '2020-11-26', 1, 'TEST ENTRY');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(5) NOT NULL,
  `locale` varchar(255) NOT NULL,
  `image` varchar(64) NOT NULL,
  `directory` varchar(32) NOT NULL,
  `filename` varchar(64) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `name`, `code`, `locale`, `image`, `directory`, `filename`, `sort_order`, `status`) VALUES
(1, 'English', 'en', 'en_US.UTF-8,en_US,en-gb,english', 'gb.png', 'english', 'english', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `fmonth` varchar(100) NOT NULL,
  `tmonth` varchar(100) NOT NULL,
  `pdetail` varchar(500) NOT NULL,
  `pamount` int(11) NOT NULL,
  `fund_amount` int(11) NOT NULL,
  `repayment_freq` int(11) NOT NULL,
  `interest_percent` double NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_type_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_purpose` varchar(500) NOT NULL,
  `exp_date` varchar(30) NOT NULL,
  `charges` int(11) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `name`, `sname`, `fmonth`, `tmonth`, `pdetail`, `pamount`, `fund_amount`, `repayment_freq`, `interest_percent`, `duration`, `duration_type_id`, `region_id`, `area_id`, `remarks`, `status`, `sort_order`, `date_added`, `user_id`, `loan_purpose`, `exp_date`, `charges`, `loan_type_id`, `source_id`) VALUES
(4, 'Testings', 'test', '09-2020', '12-2020', '', 0, 0, 0, 0, 0, 0, 0, 0, 'testedd', 1, 0, '2020-11-24', 0, '', '2020-11-25', 0, 0, 0),
(5, 'testing abc', 'abc', '10-2020', '12-2020', '', 0, 0, 0, 0, 0, 0, 0, 0, 'test', 1, 0, '2020-11-24', 0, '', '2020-11-26', 0, 0, 0),
(6, 'N Loan', 'NWs', '11-2020', '11-2020', '', 0, 0, 0, 0, 0, 0, 0, 0, 'tested', 1, 0, '2020-11-25', 0, '', '2020-11-26', 0, 0, 0),
(7, '', '', '09-2020', '05-2021', '', 365, 0, 565, 56, 32, 2, 2, 2, 'tested', 1, 0, '2020-12-03', 1, 'testing', '04-12-2020', 565, 2, 3),
(8, '', '', '09-2020', '05-2021', '', 365, 0, 565, 56, 32, 2, 2, 2, 'tested', 1, 0, '2020-12-03', 1, 'testing', '', 565, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `loan_collection`
--

CREATE TABLE `loan_collection` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ucode` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `date_added` date NOT NULL,
  `ent_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_collection`
--

INSERT INTO `loan_collection` (`id`, `request_id`, `amount`, `ucode`, `status`, `remarks`, `date_added`, `ent_date`) VALUES
(2, 2, 123456, '345treg', 1, 'TESTED REMARKS', '2020-12-02', '09-12-2020');

-- --------------------------------------------------------

--
-- Table structure for table `loan_processing_strategy`
--

CREATE TABLE `loan_processing_strategy` (
  `strategy_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_processing_strategy`
--

INSERT INTO `loan_processing_strategy` (`strategy_id`, `name`, `sname`, `status`, `sort_order`) VALUES
(1, 'TESTING STRATEGY', 'STRATEGY', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nature`
--

CREATE TABLE `nature` (
  `nature_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `sort_order` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nature`
--

INSERT INTO `nature` (`nature_id`, `name`, `remarks`, `status`, `sort_order`) VALUES
(1, 'TEST NATURE ACTIVITY', 'tested', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `fund_amount` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `decimal_places` int(11) NOT NULL,
  `def_principal` double NOT NULL,
  `min_principle` double NOT NULL,
  `max_principle` double NOT NULL,
  `rep_freq` decimal(10,0) NOT NULL,
  `def_interest_rate` double NOT NULL,
  `min_interest_rate` double NOT NULL,
  `max_interest_rate` double NOT NULL,
  `duration_type` int(11) NOT NULL,
  `grace_pamount` double NOT NULL,
  `grace_interest_amount` double NOT NULL,
  `grace_interest_charges` double NOT NULL,
  `interest_method_id` int(11) NOT NULL,
  `amort_method_id` int(11) NOT NULL,
  `loan_processing_id` int(11) NOT NULL,
  `charges` double NOT NULL,
  `credit_check` int(11) NOT NULL,
  `accounting_rule_id` int(11) NOT NULL,
  `fund_source` varchar(100) NOT NULL,
  `loan_portfolio` varchar(100) NOT NULL,
  `overpayment` double NOT NULL,
  `susp_income` double NOT NULL,
  `income_from_interest` double NOT NULL,
  `income_from_penalty` double NOT NULL,
  `income_from_fess` double NOT NULL,
  `income_from_recovery` double NOT NULL,
  `loss_off` double NOT NULL,
  `interest_off` double NOT NULL,
  `auto_disburse` double NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `sname`, `remarks`, `fund_amount`, `currency_id`, `decimal_places`, `def_principal`, `min_principle`, `max_principle`, `rep_freq`, `def_interest_rate`, `min_interest_rate`, `max_interest_rate`, `duration_type`, `grace_pamount`, `grace_interest_amount`, `grace_interest_charges`, `interest_method_id`, `amort_method_id`, `loan_processing_id`, `charges`, `credit_check`, `accounting_rule_id`, `fund_source`, `loan_portfolio`, `overpayment`, `susp_income`, `income_from_interest`, `income_from_penalty`, `income_from_fess`, `income_from_recovery`, `loss_off`, `interest_off`, `auto_disburse`, `status`, `added_date`) VALUES
(2, 'Funding Test', 'fund testeds', 'test remarkss', 3564654, 1, 2, 435435, 898578, 876665, '67657', 2.5, 3.5, 5, 2, 54654, 65765, 488876, 1, 1, 1, 45745, 0, 1, '64856', '45763', 57543, 543, 43543, 54654, 45645, 4356, 4564, 123456789, 4555, 1, '2020-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `added_date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `name`, `sname`, `address`, `email`, `phone`, `added_date`, `status`, `remarks`) VALUES
(1, 'Karachi\'s', 'khi', '', '', '', '2020-11-26', 1, '1'),
(2, 'DUbai Region', 'Dubai', 'wert ertger 3465', 'imranahsan1@outlook.com', '030045080585', '2020-11-26', 1, 'tested');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(150) NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `fund_type_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `fdate` varchar(80) NOT NULL,
  `tdate` varchar(80) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `doc_status` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `name`, `sname`, `country_id`, `region_id`, `area_id`, `address`, `phone`, `email`, `loan_id`, `product_id`, `fund_type_id`, `currency_id`, `amount`, `fdate`, `tdate`, `remarks`, `image`, `doc_status`, `assign_to`, `sort_order`, `status`, `date_added`) VALUES
(2, 'Newslatter', 'nvds', 259, 2, 1, 'karachi, sindh', '03033750381', 'naveedlanjar11@gmail.com', 5, 2, 3, 3, 3500, '07-11-2020', '30-11-2020', 'test remarks', 'catalog/cart.png', 0, 1, 0, 1, '2020-11-25'),
(3, 'Testing Request', 'Rqst', 260, 1, 1, 'karachi, sindh', '030337503812', 'admin@mahardhi.com', 0, 0, 3, 1, 55353, '04-11-2020', '20-11-2020', '545', '', 0, 1, 0, 1, '2020-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `group` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES
(1, 0, 'shipping', 'shipping_sort_order', '3', 0),
(2, 0, 'sub_total', 'sub_total_sort_order', '1', 0),
(3, 0, 'sub_total', 'sub_total_status', '1', 0),
(4, 0, 'tax', 'tax_status', '1', 0),
(5, 0, 'total', 'total_sort_order', '9', 0),
(6, 0, 'total', 'total_status', '1', 0),
(7, 0, 'tax', 'tax_sort_order', '5', 0),
(8, 0, 'free_checkout', 'free_checkout_sort_order', '1', 0),
(9, 0, 'cod', 'cod_sort_order', '5', 0),
(10, 0, 'cod', 'cod_total', '0.01', 0),
(11, 0, 'cod', 'cod_order_status_id', '1', 0),
(12, 0, 'cod', 'cod_geo_zone_id', '0', 0),
(13, 0, 'cod', 'cod_status', '1', 0),
(14, 0, 'shipping', 'shipping_status', '1', 0),
(15, 0, 'shipping', 'shipping_estimator', '1', 0),
(27, 0, 'coupon', 'coupon_sort_order', '4', 0),
(28, 0, 'coupon', 'coupon_status', '1', 0),
(34, 0, 'flat', 'flat_sort_order', '1', 0),
(35, 0, 'flat', 'flat_status', '1', 0),
(36, 0, 'flat', 'flat_geo_zone_id', '0', 0),
(37, 0, 'flat', 'flat_tax_class_id', '9', 0),
(169, 0, 'carousel', 'carousel_status', '1', 0),
(170, 0, 'carousel', 'carousel_module', 'a:1:{i:0;a:5:{s:9:\"banner_id\";s:1:\"8\";s:5:\"limit\";s:2:\"10\";s:6:\"scroll\";s:1:\"3\";s:5:\"width\";s:3:\"130\";s:6:\"height\";s:3:\"100\";}}', 1),
(156, 0, 'featured', 'featured_status', '1', 0),
(155, 0, 'featured', 'featured_product', '43,40,42,30', 0),
(41, 0, 'flat', 'flat_cost', '5.00', 0),
(42, 0, 'credit', 'credit_sort_order', '7', 0),
(43, 0, 'credit', 'credit_status', '1', 0),
(53, 0, 'reward', 'reward_sort_order', '2', 0),
(54, 0, 'reward', 'reward_status', '1', 0),
(146, 0, 'category', 'category_status', '1', 0),
(158, 0, 'account', 'account_status', '1', 0),
(267, 0, 'config', 'config_robots', 'abot\r\ndbot\r\nebot\r\nhbot\r\nkbot\r\nlbot\r\nmbot\r\nnbot\r\nobot\r\npbot\r\nrbot\r\nsbot\r\ntbot\r\nvbot\r\nybot\r\nzbot\r\nbot.\r\nbot/\r\n_bot\r\n.bot\r\n/bot\r\n-bot\r\n:bot\r\n(bot\r\ncrawl\r\nslurp\r\nspider\r\nseek\r\naccoona\r\nacoon\r\nadressendeutschland\r\nah-ha.com\r\nahoy\r\naltavista\r\nananzi\r\nanthill\r\nappie\r\narachnophilia\r\narale\r\naraneo\r\naranha\r\narchitext\r\naretha\r\narks\r\nasterias\r\natlocal\r\natn\r\natomz\r\naugurfind\r\nbackrub\r\nbannana_bot\r\nbaypup\r\nbdfetch\r\nbig brother\r\nbiglotron\r\nbjaaland\r\nblackwidow\r\nblaiz\r\nblog\r\nblo.\r\nbloodhound\r\nboitho\r\nbooch\r\nbradley\r\nbutterfly\r\ncalif\r\ncassandra\r\nccubee\r\ncfetch\r\ncharlotte\r\nchurl\r\ncienciaficcion\r\ncmc\r\ncollective\r\ncomagent\r\ncombine\r\ncomputingsite\r\ncsci\r\ncurl\r\ncusco\r\ndaumoa\r\ndeepindex\r\ndelorie\r\ndepspid\r\ndeweb\r\ndie blinde kuh\r\ndigger\r\nditto\r\ndmoz\r\ndocomo\r\ndownload express\r\ndtaagent\r\ndwcp\r\nebiness\r\nebingbong\r\ne-collector\r\nejupiter\r\nemacs-w3 search engine\r\nesther\r\nevliya celebi\r\nezresult\r\nfalcon\r\nfelix ide\r\nferret\r\nfetchrover\r\nfido\r\nfindlinks\r\nfireball\r\nfish search\r\nfouineur\r\nfunnelweb\r\ngazz\r\ngcreep\r\ngenieknows\r\ngetterroboplus\r\ngeturl\r\nglx\r\ngoforit\r\ngolem\r\ngrabber\r\ngrapnel\r\ngralon\r\ngriffon\r\ngromit\r\ngrub\r\ngulliver\r\nhamahakki\r\nharvest\r\nhavindex\r\nhelix\r\nheritrix\r\nhku www octopus\r\nhomerweb\r\nhtdig\r\nhtml index\r\nhtml_analyzer\r\nhtmlgobble\r\nhubater\r\nhyper-decontextualizer\r\nia_archiver\r\nibm_planetwide\r\nichiro\r\niconsurf\r\niltrovatore\r\nimage.kapsi.net\r\nimagelock\r\nincywincy\r\nindexer\r\ninfobee\r\ninformant\r\ningrid\r\ninktomisearch.com\r\ninspector web\r\nintelliagent\r\ninternet shinchakubin\r\nip3000\r\niron33\r\nisraeli-search\r\nivia\r\njack\r\njakarta\r\njavabee\r\njetbot\r\njumpstation\r\nkatipo\r\nkdd-explorer\r\nkilroy\r\nknowledge\r\nkototoi\r\nkretrieve\r\nlabelgrabber\r\nlachesis\r\nlarbin\r\nlegs\r\nlibwww\r\nlinkalarm\r\nlink validator\r\nlinkscan\r\nlockon\r\nlwp\r\nlycos\r\nmagpie\r\nmantraagent\r\nmapoftheinternet\r\nmarvin/\r\nmattie\r\nmediafox\r\nmediapartners\r\nmercator\r\nmerzscope\r\nmicrosoft url control\r\nminirank\r\nmiva\r\nmj12\r\nmnogosearch\r\nmoget\r\nmonster\r\nmoose\r\nmotor\r\nmultitext\r\nmuncher\r\nmuscatferret\r\nmwd.search\r\nmyweb\r\nnajdi\r\nnameprotect\r\nnationaldirectory\r\nnazilla\r\nncsa beta\r\nnec-meshexplorer\r\nnederland.zoek\r\nnetcarta webmap engine\r\nnetmechanic\r\nnetresearchserver\r\nnetscoop\r\nnewscan-online\r\nnhse\r\nnokia6682/\r\nnomad\r\nnoyona\r\nnutch\r\nnzexplorer\r\nobjectssearch\r\noccam\r\nomni\r\nopen text\r\nopenfind\r\nopenintelligencedata\r\norb search\r\nosis-project\r\npack rat\r\npageboy\r\npagebull\r\npage_verifier\r\npanscient\r\nparasite\r\npartnersite\r\npatric\r\npear.\r\npegasus\r\nperegrinator\r\npgp key agent\r\nphantom\r\nphpdig\r\npicosearch\r\npiltdownman\r\npimptrain\r\npinpoint\r\npioneer\r\npiranha\r\nplumtreewebaccessor\r\npogodak\r\npoirot\r\npompos\r\npoppelsdorf\r\npoppi\r\npopular iconoclast\r\npsycheclone\r\npublisher\r\npython\r\nrambler\r\nraven search\r\nroach\r\nroad runner\r\nroadhouse\r\nrobbie\r\nrobofox\r\nrobozilla\r\nrules\r\nsalty\r\nsbider\r\nscooter\r\nscoutjet\r\nscrubby\r\nsearch.\r\nsearchprocess\r\nsemanticdiscovery\r\nsenrigan\r\nsg-scout\r\nshai\'hulud\r\nshark\r\nshopwiki\r\nsidewinder\r\nsift\r\nsilk\r\nsimmany\r\nsite searcher\r\nsite valet\r\nsitetech-rover\r\nskymob.com\r\nsleek\r\nsmartwit\r\nsna-\r\nsnappy\r\nsnooper\r\nsohu\r\nspeedfind\r\nsphere\r\nsphider\r\nspinner\r\nspyder\r\nsteeler/\r\nsuke\r\nsuntek\r\nsupersnooper\r\nsurfnomore\r\nsven\r\nsygol\r\nszukacz\r\ntach black widow\r\ntarantula\r\ntempleton\r\n/teoma\r\nt-h-u-n-d-e-r-s-t-o-n-e\r\ntheophrastus\r\ntitan\r\ntitin\r\ntkwww\r\ntoutatis\r\nt-rex\r\ntutorgig\r\ntwiceler\r\ntwisted\r\nucsd\r\nudmsearch\r\nurl check\r\nupdated\r\nvagabondo\r\nvalkyrie\r\nverticrawl\r\nvictoria\r\nvision-search\r\nvolcano\r\nvoyager/\r\nvoyager-hc\r\nw3c_validator\r\nw3m2\r\nw3mir\r\nwalker\r\nwallpaper\r\nwanderer\r\nwauuu\r\nwavefire\r\nweb core\r\nweb hopper\r\nweb wombat\r\nwebbandit\r\nwebcatcher\r\nwebcopy\r\nwebfoot\r\nweblayers\r\nweblinker\r\nweblog monitor\r\nwebmirror\r\nwebmonkey\r\nwebquest\r\nwebreaper\r\nwebsitepulse\r\nwebsnarf\r\nwebstolperer\r\nwebvac\r\nwebwalk\r\nwebwatch\r\nwebwombat\r\nwebzinger\r\nwhizbang\r\nwhowhere\r\nwild ferret\r\nworldlight\r\nwwwc\r\nwwwster\r\nxenu\r\nxget\r\nxift\r\nxirq\r\nyandex\r\nyanga\r\nyeti\r\nyodao\r\nzao\r\nzippp\r\nzyborg', 0),
(266, 0, 'config', 'config_shared', '0', 0),
(265, 0, 'config', 'config_secure', '0', 0),
(264, 0, 'config', 'config_fraud_status_id', '7', 0),
(263, 0, 'config', 'config_fraud_score', '', 0),
(262, 0, 'config', 'config_fraud_key', '', 0),
(94, 0, 'voucher', 'voucher_sort_order', '8', 0),
(95, 0, 'voucher', 'voucher_status', '1', 0),
(261, 0, 'config', 'config_fraud_detection', '0', 0),
(260, 0, 'config', 'config_mail_alert', '', 0),
(103, 0, 'free_checkout', 'free_checkout_status', '1', 0),
(104, 0, 'free_checkout', 'free_checkout_order_status_id', '1', 0),
(259, 0, 'config', 'config_mail', 'a:7:{s:8:\"protocol\";s:4:\"mail\";s:9:\"parameter\";s:0:\"\";s:13:\"smtp_hostname\";s:0:\"\";s:13:\"smtp_username\";s:0:\"\";s:13:\"smtp_password\";s:0:\"\";s:9:\"smtp_port\";s:0:\"\";s:12:\"smtp_timeout\";s:0:\"\";}', 1),
(157, 0, 'featured', 'featured_module', 'a:1:{i:0;a:3:{s:5:\"limit\";s:1:\"4\";s:5:\"width\";s:3:\"200\";s:6:\"height\";s:3:\"200\";}}', 1),
(165, 0, 'slideshow', 'slideshow_status', '1', 0),
(166, 0, 'slideshow', 'slideshow_module', 'a:2:{i:0;a:3:{s:9:\"banner_id\";s:1:\"7\";s:5:\"width\";s:4:\"1140\";s:6:\"height\";s:3:\"380\";}s:16:\"pol3h8iif8j2lnmi\";a:3:{s:9:\"banner_id\";s:1:\"6\";s:5:\"width\";s:3:\"300\";s:6:\"height\";s:3:\"300\";}}', 1),
(109, 0, 'banner', 'banner_module', 'a:1:{i:0;a:8:{s:9:\"banner_id\";s:1:\"6\";s:5:\"width\";s:3:\"182\";s:6:\"height\";s:3:\"182\";s:11:\"resize_type\";s:7:\"default\";s:9:\"layout_id\";s:1:\"3\";s:8:\"position\";s:11:\"column_left\";s:6:\"status\";s:1:\"1\";s:10:\"sort_order\";s:1:\"3\";}}', 1),
(258, 0, 'config', 'config_ftp_status', '0', 0),
(257, 0, 'config', 'config_ftp_root', '', 0),
(256, 0, 'config', 'config_ftp_password', '', 0),
(255, 0, 'config', 'config_ftp_username', '', 0),
(254, 0, 'config', 'config_ftp_port', '21', 0),
(253, 0, 'config', 'config_ftp_hostname', 'opencart.opencartdemo.com', 0),
(252, 0, 'config', 'config_image_location_height', '50', 0),
(251, 0, 'config', 'config_image_location_width', '268', 0),
(250, 0, 'config', 'config_image_cart_height', '47', 0),
(249, 0, 'config', 'config_image_cart_width', '47', 0),
(248, 0, 'config', 'config_image_wishlist_height', '47', 0),
(181, 0, 'config', 'config_meta_title', 'Your Store', 0),
(182, 0, 'config', 'config_meta_description', 'My Store', 0),
(183, 0, 'config', 'config_meta_keyword', '', 0),
(184, 0, 'config', 'config_template', 'default', 0),
(185, 0, 'config', 'config_layout_id', '4', 0),
(186, 0, 'config', 'config_country_id', '222', 0),
(187, 0, 'config', 'config_zone_id', '3563', 0),
(188, 0, 'config', 'config_language', 'en', 0),
(189, 0, 'config', 'config_admin_language', 'en', 0),
(190, 0, 'config', 'config_currency', 'USD', 0),
(191, 0, 'config', 'config_currency_auto', '1', 0),
(192, 0, 'config', 'config_length_class_id', '1', 0),
(193, 0, 'config', 'config_weight_class_id', '1', 0),
(194, 0, 'config', 'config_product_count', '1', 0),
(195, 0, 'config', 'config_product_limit', '15', 0),
(196, 0, 'config', 'config_product_description_length', '100', 0),
(197, 0, 'config', 'config_limit_admin', '20', 0),
(198, 0, 'config', 'config_review_status', '1', 0),
(199, 0, 'config', 'config_review_guest', '1', 0),
(200, 0, 'config', 'config_review_mail', '0', 0),
(201, 0, 'config', 'config_voucher_min', '1', 0),
(202, 0, 'config', 'config_voucher_max', '1000', 0),
(203, 0, 'config', 'config_tax', '1', 0),
(204, 0, 'config', 'config_tax_default', 'shipping', 0),
(205, 0, 'config', 'config_tax_customer', 'shipping', 0),
(206, 0, 'config', 'config_customer_online', '0', 0),
(207, 0, 'config', 'config_customer_group_id', '1', 0),
(208, 0, 'config', 'config_customer_group_display', 'a:1:{i:0;s:1:\"1\";}', 1),
(209, 0, 'config', 'config_customer_price', '0', 0),
(210, 0, 'config', 'config_account_id', '3', 0),
(211, 0, 'config', 'config_account_mail', '0', 0),
(212, 0, 'config', 'config_invoice_prefix', 'INV-2013-00', 0),
(283, 0, 'config', 'config_api_id', '2', 0),
(214, 0, 'config', 'config_cart_weight', '1', 0),
(215, 0, 'config', 'config_checkout_guest', '1', 0),
(216, 0, 'config', 'config_checkout_id', '5', 0),
(217, 0, 'config', 'config_order_status_id', '1', 0),
(218, 0, 'config', 'config_processing_status', 'a:1:{i:0;s:1:\"2\";}', 1),
(219, 0, 'config', 'config_complete_status', 'a:1:{i:0;s:1:\"5\";}', 1),
(220, 0, 'config', 'config_order_mail', '0', 0),
(221, 0, 'config', 'config_stock_display', '0', 0),
(222, 0, 'config', 'config_stock_warning', '0', 0),
(223, 0, 'config', 'config_stock_checkout', '0', 0),
(224, 0, 'config', 'config_affiliate_approval', '0', 0),
(225, 0, 'config', 'config_affiliate_auto', '0', 0),
(226, 0, 'config', 'config_affiliate_commission', '5', 0),
(227, 0, 'config', 'config_affiliate_id', '4', 0),
(228, 0, 'config', 'config_affiliate_mail', '0', 0),
(229, 0, 'config', 'config_return_id', '0', 0),
(230, 0, 'config', 'config_return_status_id', '2', 0),
(231, 0, 'config', 'config_logo', 'catalog/logo.png', 0),
(232, 0, 'config', 'config_icon', 'catalog/cart.png', 0),
(233, 0, 'config', 'config_image_category_width', '80', 0),
(234, 0, 'config', 'config_image_category_height', '80', 0),
(235, 0, 'config', 'config_image_thumb_width', '228', 0),
(236, 0, 'config', 'config_image_thumb_height', '228', 0),
(237, 0, 'config', 'config_image_popup_width', '500', 0),
(238, 0, 'config', 'config_image_popup_height', '500', 0),
(239, 0, 'config', 'config_image_product_width', '228', 0),
(240, 0, 'config', 'config_image_product_height', '228', 0),
(241, 0, 'config', 'config_image_additional_width', '74', 0),
(242, 0, 'config', 'config_image_additional_height', '74', 0),
(243, 0, 'config', 'config_image_related_width', '80', 0),
(244, 0, 'config', 'config_image_related_height', '80', 0),
(245, 0, 'config', 'config_image_compare_width', '90', 0),
(246, 0, 'config', 'config_image_compare_height', '90', 0),
(247, 0, 'config', 'config_image_wishlist_width', '47', 0),
(180, 0, 'config', 'config_comment', '', 0),
(179, 0, 'config', 'config_open', '', 0),
(178, 0, 'config', 'config_image', '', 0),
(177, 0, 'config', 'config_fax', '', 0),
(176, 0, 'config', 'config_telephone', '123456789', 0),
(280, 0, 'config', 'config_email', 'ahsani15@yahoo.com', 0),
(174, 0, 'config', 'config_geocode', '', 0),
(172, 0, 'config', 'config_owner', 'Your Name', 0),
(173, 0, 'config', 'config_address', 'Address 1', 0),
(171, 0, 'config', 'config_name', 'Your Store', 0),
(268, 0, 'config', 'config_seo_url', '0', 0),
(269, 0, 'config', 'config_file_max_size', '300000', 0),
(270, 0, 'config', 'config_file_ext_allowed', 'txt\r\npng\r\njpe\r\njpeg\r\njpg\r\ngif\r\nbmp\r\nico\r\ntiff\r\ntif\r\nsvg\r\nsvgz\r\nzip\r\nrar\r\nmsi\r\ncab\r\nmp3\r\nqt\r\nmov\r\npdf\r\npsd\r\nai\r\neps\r\nps\r\ndoc\r\nrtf\r\nxls\r\nppt\r\nodt\r\nods', 0),
(271, 0, 'config', 'config_file_mime_allowed', 'text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/vnd.microsoft.icon\r\nimage/tiff\r\nimage/svg+xml\r\napplication/zip\r\napplication/x-rar-compressed\r\napplication/x-msdownload\r\napplication/vnd.ms-cab-compressed\r\naudio/mpeg\r\nvideo/quicktime\r\napplication/pdf\r\nimage/vnd.adobe.photoshop\r\napplication/postscript\r\napplication/msword\r\napplication/rtf\r\napplication/vnd.ms-excel\r\napplication/vnd.ms-powerpoint\r\napplication/vnd.oasis.opendocument.text\r\napplication/vnd.oasis.opendocument.spreadsheet', 0),
(272, 0, 'config', 'config_maintenance', '0', 0),
(273, 0, 'config', 'config_password', '1', 0),
(282, 0, 'config', 'config_encryption', '8c6915c83217ff0cf8aadfdc4b71f734', 0),
(275, 0, 'config', 'config_compression', '0', 0),
(276, 0, 'config', 'config_error_display', '1', 0),
(277, 0, 'config', 'config_error_log', '1', 0),
(278, 0, 'config', 'config_error_filename', 'error.log', 0),
(279, 0, 'config', 'config_google_analytics', '', 0),
(281, 0, 'config', 'config_url', 'http://localhost/funds/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `cnic` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `comp_name` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ntn` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `fund_type_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `fdate` varchar(80) NOT NULL,
  `tdate` varchar(80) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `name`, `sname`, `cnic`, `country_id`, `region_id`, `area_id`, `address`, `comp_name`, `phone`, `email`, `ntn`, `zip_code`, `fund_type_id`, `currency_id`, `amount`, `fdate`, `tdate`, `remarks`, `image`, `status`, `date_added`) VALUES
(1, 'Funding Test', 'fund testeds', '43207', 260, 2, 2, 'karachi, sindh', 'Test Company', 6987511, 'Ife.abioye@yahoo.com', '9875415', '69857', 3, 1, 587456, '01-11-2020', '21-11-2020', 'test remarkss', 'catalog/cart.png', 1, '2020-11-26'),
(2, 'Funding Test', 'fund tested', '43207-3603036-7', 260, 2, 2, 'karachi, sindh', 'Test Company', 6987511, 'Ife.abioye@yahoo.com', '9875415', '69857', 3, 1, 587456, '01-11-2020', '21-11-2020', 'test remarkss', 'catalog/cart.png', 1, '2020-11-26'),
(3, 'Funding Test', 'fund testedsss', '43207-3603036-7', 260, 2, 2, 'karachi, sindh', 'Test Company', 6987511, 'Ife.abioye@yahoo.com', '9875415', '69857', 3, 1, 587456, '01-11-2020', '21-11-2020', 'test remarkss', 'catalog/cart.png', 1, '2020-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `tax_class`
--

CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_class`
--

INSERT INTO `tax_class` (`tax_class_id`, `title`, `description`, `date_added`, `date_modified`) VALUES
(9, 'Taxable Goods', 'Taxed goods', '2009-01-06 23:21:53', '2011-09-23 14:07:50'),
(10, 'Downloadable Products', 'Downloadable', '2011-09-21 22:19:39', '2011-09-22 10:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rate`
--

CREATE TABLE `tax_rate` (
  `tax_rate_id` int(11) NOT NULL,
  `geo_zone_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` char(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_rate`
--

INSERT INTO `tax_rate` (`tax_rate_id`, `geo_zone_id`, `name`, `rate`, `type`, `date_added`, `date_modified`) VALUES
(86, 3, 'VAT (20%)', '20.0000', 'P', '2011-03-09 21:17:10', '2011-09-22 22:24:29'),
(87, 3, 'Eco Tax (-2.00)', '2.0000', 'F', '2011-09-21 21:49:23', '2011-09-23 00:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rule`
--

CREATE TABLE `tax_rule` (
  `tax_rule_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_rule`
--

INSERT INTO `tax_rule` (`tax_rule_id`, `tax_class_id`, `tax_rate_id`, `based`, `priority`) VALUES
(121, 10, 86, 'payment', 1),
(120, 10, 87, 'store', 0),
(128, 9, 86, 'shipping', 1),
(127, 9, 87, 'shipping', 2);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `name`, `remarks`, `added_date`, `status`) VALUES
(1, 'FIRST TYPE', 'FOR INITIATIVE', '2020-07-05 18:54:21', 1),
(2, 'SECOND TYPE', 'FOR MACHINARY', '2020-07-05 18:54:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `upload_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `url_alias`
--

CREATE TABLE `url_alias` (
  `url_alias_id` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `url_alias`
--

INSERT INTO `url_alias` (`url_alias_id`, `query`, `keyword`) VALUES
(824, 'product_id=48', 'ipod-classic'),
(836, 'category_id=20', 'desktops'),
(834, 'category_id=26', 'pc'),
(835, 'category_id=27', 'mac'),
(730, 'manufacturer_id=8', 'apple'),
(772, 'information_id=4', 'about_us'),
(768, 'product_id=42', 'test'),
(789, 'category_id=34', 'mp3-players'),
(781, 'category_id=36', 'test2'),
(774, 'category_id=18', 'laptop-notebook'),
(775, 'category_id=46', 'macs'),
(776, 'category_id=45', 'windows'),
(777, 'category_id=25', 'component'),
(778, 'category_id=29', 'mouse'),
(779, 'category_id=28', 'monitor'),
(780, 'category_id=35', 'test1'),
(782, 'category_id=30', 'printer'),
(783, 'category_id=31', 'scanner'),
(784, 'category_id=32', 'web-camera'),
(785, 'category_id=57', 'tablet'),
(786, 'category_id=17', 'software'),
(787, 'category_id=24', 'smartphone'),
(788, 'category_id=33', 'camera'),
(790, 'category_id=43', 'test11'),
(791, 'category_id=44', 'test12'),
(792, 'category_id=47', 'test15'),
(793, 'category_id=48', 'test16'),
(794, 'category_id=49', 'test17'),
(795, 'category_id=50', 'test18'),
(796, 'category_id=51', 'test19'),
(797, 'category_id=52', 'test20'),
(798, 'category_id=58', 'test25'),
(799, 'category_id=53', 'test21'),
(800, 'category_id=54', 'test22'),
(801, 'category_id=55', 'test23'),
(802, 'category_id=56', 'test24'),
(803, 'category_id=38', 'test4'),
(804, 'category_id=37', 'test5'),
(805, 'category_id=39', 'test6'),
(806, 'category_id=40', 'test7'),
(807, 'category_id=41', 'test8'),
(808, 'category_id=42', 'test9'),
(809, 'product_id=30', 'canon-eos-5d'),
(840, 'product_id=47', 'hp-lp3065'),
(811, 'product_id=28', 'htc-touch-hd'),
(812, 'product_id=43', 'macbook'),
(813, 'product_id=44', 'macbook-air'),
(814, 'product_id=45', 'macbook-pro'),
(816, 'product_id=31', 'nikon-d300'),
(817, 'product_id=29', 'palm-treo-pro'),
(818, 'product_id=35', 'product-8'),
(819, 'product_id=49', 'samsung-galaxy-tab-10-1'),
(820, 'product_id=33', 'samsung-syncmaster-941bw'),
(821, 'product_id=46', 'sony-vaio'),
(837, 'product_id=41', 'imac'),
(823, 'product_id=40', 'iphone'),
(825, 'product_id=36', 'ipod-nano'),
(826, 'product_id=34', 'ipod-shuffle'),
(827, 'product_id=32', 'ipod-touch'),
(828, 'manufacturer_id=9', 'canon'),
(829, 'manufacturer_id=5', 'htc'),
(830, 'manufacturer_id=7', 'hewlett-packard'),
(831, 'manufacturer_id=6', 'palm'),
(832, 'manufacturer_id=10', 'sony'),
(841, 'information_id=6', 'delivery'),
(842, 'information_id=3', 'privacy'),
(843, 'information_id=5', 'terms');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code` varchar(40) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_group_id`, `username`, `password`, `salt`, `firstname`, `lastname`, `email`, `image`, `code`, `ip`, `status`, `date_added`) VALUES
(1, 1, 'admin', 'a6111ac25d85587f016617b77d02729947bb4700', '49db0d1eb', 'Naveed', 'Hussain', 'ahsani15@yahoo.com', 'catalog/logo2.png', '', '127.0.0.1', 1, '2020-07-03 16:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `permission` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `name`, `permission`) VALUES
(1, 'Administrator', 'a:2:{s:6:\"access\";a:46:{i:0;s:18:\"common/column_left\";i:1;s:18:\"common/filemanager\";i:2;s:11:\"common/menu\";i:3;s:14:\"common/profile\";i:4;s:9:\"core/area\";i:5;s:9:\"core/bank\";i:6;s:12:\"core/charges\";i:7;s:15:\"core/collection\";i:8;s:12:\"core/country\";i:9;s:11:\"core/entity\";i:10;s:13:\"core/fundtype\";i:11;s:13:\"core/investor\";i:12;s:9:\"core/loan\";i:13;s:11:\"core/nature\";i:14;s:12:\"core/product\";i:15;s:11:\"core/region\";i:16;s:12:\"core/request\";i:17;s:12:\"core/sources\";i:18;s:12:\"core/utility\";i:19;s:13:\"object/object\";i:20;s:12:\"rent/company\";i:21;s:13:\"rent/customer\";i:22;s:11:\"rent/driver\";i:23;s:16:\"report/affiliate\";i:24;s:25:\"report/affiliate_activity\";i:25;s:17:\"report/collection\";i:26;s:24:\"report/customer_activity\";i:27;s:22:\"report/customer_credit\";i:28;s:22:\"report/customer_online\";i:29;s:21:\"report/customer_order\";i:30;s:22:\"report/customer_reward\";i:31;s:16:\"report/marketing\";i:32;s:24:\"report/product_purchased\";i:33;s:21:\"report/product_viewed\";i:34;s:18:\"report/sale_coupon\";i:35;s:17:\"report/sale_order\";i:36;s:18:\"report/sale_return\";i:37;s:20:\"report/sale_shipping\";i:38;s:15:\"report/sale_tax\";i:39;s:11:\"tool/backup\";i:40;s:12:\"tool/captcha\";i:41;s:14:\"tool/error_log\";i:42;s:11:\"tool/upload\";i:43;s:8:\"user/api\";i:44;s:9:\"user/user\";i:45;s:20:\"user/user_permission\";}s:6:\"modify\";a:46:{i:0;s:18:\"common/column_left\";i:1;s:18:\"common/filemanager\";i:2;s:11:\"common/menu\";i:3;s:14:\"common/profile\";i:4;s:9:\"core/area\";i:5;s:9:\"core/bank\";i:6;s:12:\"core/charges\";i:7;s:15:\"core/collection\";i:8;s:12:\"core/country\";i:9;s:11:\"core/entity\";i:10;s:13:\"core/fundtype\";i:11;s:13:\"core/investor\";i:12;s:9:\"core/loan\";i:13;s:11:\"core/nature\";i:14;s:12:\"core/product\";i:15;s:11:\"core/region\";i:16;s:12:\"core/request\";i:17;s:12:\"core/sources\";i:18;s:12:\"core/utility\";i:19;s:13:\"object/object\";i:20;s:12:\"rent/company\";i:21;s:13:\"rent/customer\";i:22;s:11:\"rent/driver\";i:23;s:16:\"report/affiliate\";i:24;s:25:\"report/affiliate_activity\";i:25;s:17:\"report/collection\";i:26;s:24:\"report/customer_activity\";i:27;s:22:\"report/customer_credit\";i:28;s:22:\"report/customer_online\";i:29;s:21:\"report/customer_order\";i:30;s:22:\"report/customer_reward\";i:31;s:16:\"report/marketing\";i:32;s:24:\"report/product_purchased\";i:33;s:21:\"report/product_viewed\";i:34;s:18:\"report/sale_coupon\";i:35;s:17:\"report/sale_order\";i:36;s:18:\"report/sale_return\";i:37;s:20:\"report/sale_shipping\";i:38;s:15:\"report/sale_tax\";i:39;s:11:\"tool/backup\";i:40;s:12:\"tool/captcha\";i:41;s:14:\"tool/error_log\";i:42;s:11:\"tool/upload\";i:43;s:8:\"user/api\";i:44;s:9:\"user/user\";i:45;s:20:\"user/user_permission\";}}'),
(10, 'Demonstration', '');

-- --------------------------------------------------------

--
-- Table structure for table `utility`
--

CREATE TABLE `utility` (
  `utility_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` date DEFAULT NULL,
  `pname` varchar(100) NOT NULL,
  `psname` varchar(30) NOT NULL,
  `pdetail` varchar(1000) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility`
--

INSERT INTO `utility` (`utility_id`, `name`, `sname`, `address`, `email`, `phone`, `remarks`, `status`, `added_date`, `pname`, `psname`, `pdetail`, `region_id`) VALUES
(1, 'utility testing', 'tests', '', '', '', '', 1, '0000-00-00', '', '', '', 0),
(2, 'Utility test', 'utility', 'test address', 'naveedlanjar11@gmail.com', '03033750381', 'test notes', 1, '0000-00-00', '', '', '', 0),
(3, 'TEST Utility', 'TESTs', 'KHI', 'lanjarnaveed33@gmail.com', '03033750381', 'Notes for testing', 1, '2020-11-26', 'TEST Project', 'Projected', 'TESTed hjvfdsg gdfhnbdg rhgfhf reyrh gbfhgdf weryr rthtrhj ttttt s', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_rule`
--
ALTER TABLE `accounting_rule`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `amortization_method`
--
ALTER TABLE `amortization_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges_option`
--
ALTER TABLE `charges_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `charges_type`
--
ALTER TABLE `charges_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_id` (`company_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `driver_id` (`driver_id`);

--
-- Indexes for table `duration_types`
--
ALTER TABLE `duration_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `fund_types`
--
ALTER TABLE `fund_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest_method`
--
ALTER TABLE `interest_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`investor_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_collection`
--
ALTER TABLE `loan_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_processing_strategy`
--
ALTER TABLE `loan_processing_strategy`
  ADD PRIMARY KEY (`strategy_id`);

--
-- Indexes for table `nature`
--
ALTER TABLE `nature`
  ADD PRIMARY KEY (`nature_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_class`
--
ALTER TABLE `tax_class`
  ADD PRIMARY KEY (`tax_class_id`);

--
-- Indexes for table `tax_rate`
--
ALTER TABLE `tax_rate`
  ADD PRIMARY KEY (`tax_rate_id`);

--
-- Indexes for table `tax_rule`
--
ALTER TABLE `tax_rule`
  ADD PRIMARY KEY (`tax_rule_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `url_alias`
--
ALTER TABLE `url_alias`
  ADD PRIMARY KEY (`url_alias_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `utility`
--
ALTER TABLE `utility`
  ADD PRIMARY KEY (`utility_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_rule`
--
ALTER TABLE `accounting_rule`
  MODIFY `rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amortization_method`
--
ALTER TABLE `amortization_method`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `charges_type`
--
ALTER TABLE `charges_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `duration_types`
--
ALTER TABLE `duration_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entity`
--
ALTER TABLE `entity`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fund_types`
--
ALTER TABLE `fund_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interest_method`
--
ALTER TABLE `interest_method`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investor`
--
ALTER TABLE `investor`
  MODIFY `investor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_collection`
--
ALTER TABLE `loan_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_processing_strategy`
--
ALTER TABLE `loan_processing_strategy`
  MODIFY `strategy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nature`
--
ALTER TABLE `nature`
  MODIFY `nature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tax_class`
--
ALTER TABLE `tax_class`
  MODIFY `tax_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tax_rate`
--
ALTER TABLE `tax_rate`
  MODIFY `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tax_rule`
--
ALTER TABLE `tax_rule`
  MODIFY `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `url_alias`
--
ALTER TABLE `url_alias`
  MODIFY `url_alias_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=844;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
