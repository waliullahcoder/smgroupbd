-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2026 at 03:46 PM
-- Server version: 10.6.25-MariaDB-cll-lve
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smgroupbd_live`
--
use `smgroupbd_live`;
-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `faq_title` varchar(255) NOT NULL,
  `white_faq_name` varchar(255) NOT NULL,
  `white_faq_description` longtext NOT NULL,
  `black_faq_name` varchar(255) NOT NULL,
  `black_faq_description` longtext NOT NULL,
  `social_work_heading` varchar(255) NOT NULL,
  `social_work_title` varchar(255) NOT NULL,
  `social_work_description` longtext NOT NULL,
  `link` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `faq_title`, `white_faq_name`, `white_faq_description`, `black_faq_name`, `black_faq_description`, `social_work_heading`, `social_work_title`, `social_work_description`, `link`, `created_at`, `updated_at`) VALUES
(1, 'A Brief on Nijer Bazar', '<div>Nijer Bazar</div>', 'From The History Since 2024', 'OUR VISION', 'Being a leader in the cable industry of Bangladesh and a<br> global player our vision is to ensure to be constant in<br>  extending the dimensions of our business through transparent <br> business practices and striving towards new heights of excellence<br>  in service along with providing opportunities for growth and <br> enrichment to our employees, our business partners and the<br>  communities which we operate in. Besides of making sure of the<br>  best use of world-class performance of manpower, assets and<br>  investments, we are one of the privileged companies to be focusing <br> on a whole range of energy saving electrical protective devices.', 'OUR MISSION', '<table><tbody><tr><td class=\"line-content\">We are looking forward to continue the practice of <span class=\"html-tag\"><br></span> providing the guaranteed quality products and efficient  <span class=\"html-tag\"><br></span> service experience, which have made us the name that <span class=\"html-tag\"><br></span>  people can rely. Being a self-propelled organization we  <span class=\"html-tag\"><br></span> are not just about to carry our environment friendly steps <span class=\"html-tag\"><br></span>  but the best interest of our stakeholders and customers <span class=\"html-tag\"><br></span>  and their safety as well. We rely on world-class technology  <span class=\"html-tag\"><br></span> while pursuing continuous innovation to ensure the best  <span class=\"html-tag\"><br></span> possible solution practically for any cable need across the  <span class=\"html-tag\"><br></span> world and bring glory to our nation. </td></tr><tr><td class=\"line-number\" value=\"632\"></td><td class=\"line-content\"></td></tr></tbody></table>', 'SOCIAL WORKING', 'COMPANY - ALWAYS, CLOSE TO YOU.', '<div>We are proud to sponsor the Fundación Franlanqui, a non-profit organization founded more than 5 years ago, made up of a group of people dedicated to help other people who have become homeless or low-income people, by the donation of clothes, medicines, food, water or even economic resources needed to handle health issues. You can be a part of this!, Join us!</div><div><br></div>', 'https://nijerbazarbd.com/collections', '2023-10-04 03:28:29', '2024-10-12 11:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `access_logs`
--

CREATE TABLE `access_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_time` timestamp NULL DEFAULT NULL,
  `page` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_logs`
--

INSERT INTO `access_logs` (`id`, `date_time`, `page`, `action`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2026-05-07 09:50:05', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2605000001 to Shankhari Bazar products  Test 10 KG  on credit', 1, '2026-05-07 09:50:05', '2026-05-07 09:50:05'),
(2, '2026-05-13 05:16:42', 'Retail Sales', 'Add', 'Create a new retail sales with invoice no RS26050001 to client cffff from store Shankhari Bazar sales amount is 66 sales discount 0 products  Test Quantity : 2 KG on Retail Sales', 1, '2026-05-13 05:16:42', '2026-05-13 05:16:42'),
(3, '2026-07-07 10:15:59', 'Retail Sales', 'Add', 'Create a new retail sales with invoice no RS26070001 to client www from store Shankhari Bazar sales amount is 33 sales discount 0 products  Test Quantity : 1 KG on Retail Sales', 1, '2026-07-07 10:15:59', '2026-07-07 10:15:59'),
(4, '2026-07-07 10:16:51', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2607000001 to Shankhari Bazar products  Test 100 KG  on credit', 1, '2026-07-07 10:16:51', '2026-07-07 10:16:51'),
(5, '2026-07-13 08:26:25', 'Retail Sales', 'Add', 'Create a new retail sales with invoice no RS26070002 to client w from store Shankhari Bazar sales amount is 33 sales discount 0 products  Test Quantity : 1 KG Test Quantity : 1 KG on Retail Sales', 1, '2026-07-13 08:26:25', '2026-07-13 08:26:25'),
(6, '2026-07-13 08:42:31', 'Sales', 'Add', 'Create a new sales with invoice no STS2607000001 to client Wali from store Shankhari Bazar sales amount is 33 sales discount 3 products  Test Quanity : 1 KG on credit sale', 1, '2026-07-13 08:42:31', '2026-07-13 08:42:31'),
(7, '2026-07-27 04:28:42', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2607000002 to Shankhari Bazar products  Hair Oil 100ml 100 Gm  on credit', 1, '2026-07-27 04:28:42', '2026-07-27 04:28:42'),
(8, '2026-08-31 06:28:12', 'Collection', 'Add', 'Create a new Collection with payment no STC2608000001 from client Wali collection amount is 4 collection type advance', 187, '2026-08-31 06:28:12', '2026-08-31 06:28:12'),
(9, '2026-09-06 11:39:53', 'Retail Sales', 'Add', 'Create a new retail sales with invoice no RS26090001 to client dfsfs from store Shankhari Bazar sales amount is 665 sales discount 0 products  Test Quantity : 5 KG Hair Oil 100ml Quantity : 5 Gm on Retail Sales', 1, '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(10, '2026-09-10 10:59:37', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000001 to Shankhari Bazar products  polo 5 Pcs  on credit', 1, '2026-09-10 10:59:37', '2026-09-10 10:59:37'),
(11, '2026-09-10 11:00:19', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000002 to Shankhari Bazar products  belt 5 Pcs  on credit', 1, '2026-09-10 11:00:19', '2026-09-10 11:00:19'),
(12, '2026-09-10 11:05:44', 'Retail Sales', 'Add', 'Create a new retail sales with invoice no RS26090002 to client  from store Shankhari Bazar sales amount is 2690 sales discount 0 products  belt Quantity : 1 Pcs polo Quantity : 1 Pcs on Retail Sales', 1, '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(13, '2026-09-14 00:31:52', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000003 to Shankhari Bazar products  Test 100 KG  on credit', 1, '2026-09-14 00:31:52', '2026-09-14 00:31:52'),
(14, '2026-09-14 00:34:32', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000004 to Shankhari Bazar products  Mango 100 KG  on cash', 1, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(15, '2026-09-14 01:01:20', 'Retail Sales', 'Add', 'Create a new retail sales with invoice no RS26090003 to client Sumon from store Shankhari Bazar sales amount is 540 sales discount 0 products  Test Quantity : 011 KG Hair Oil 100ml Quantity : 1 Gm Mango Quantity : 1 KG on Retail Sales', 1, '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(16, '2026-09-14 07:29:31', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000005 to Shankhari Bazar products  belt 2560 Pcs  Hair Oil 100ml 2560 Gm  Mango 2560 KG  on credit', 176, '2026-09-14 07:29:31', '2026-09-14 07:29:31'),
(17, '2026-09-17 06:20:50', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000006 to Shankhari Bazar products  Hair Oil 100ml 5 Gm  Mango 5 KG  on credit', 1, '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(18, '2026-09-21 06:54:43', 'Purchase', 'Add', 'Create a new purhcase with purchase no STL2609000007 to Shankhari Bazar products  belt 100 Pcs  on credit', 1, '2026-09-21 06:54:43', '2026-09-21 06:54:43'),
(19, '2026-10-09 04:08:36', 'Collection', 'Add', 'Create a new Collection with payment no STC2610000001 from client Wali collection amount is 2230 collection type advance', 1, '2026-10-09 04:08:36', '2026-10-09 04:08:36'),
(20, '2026-10-26 04:30:48', 'Collection', 'Add', 'Create a new Collection with payment no STC2610000002 from client Wali collection amount is 5000 collection type advance', 1, '2026-10-26 04:30:48', '2026-10-26 04:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `account_transactions`
--

CREATE TABLE `account_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `account_transaction_auto_id` bigint(20) UNSIGNED NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `voucher_type` varchar(20) NOT NULL,
  `voucher_date` date NOT NULL,
  `coa_setup_id` bigint(20) UNSIGNED NOT NULL,
  `coa_head_code` bigint(20) NOT NULL,
  `narration` text NOT NULL,
  `debit_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `credit_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `posted` tinyint(4) NOT NULL DEFAULT 0,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_transaction_autos`
--

CREATE TABLE `account_transaction_autos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `voucher_type` varchar(20) NOT NULL,
  `voucher_date` date NOT NULL,
  `coa_setup_id` bigint(20) UNSIGNED NOT NULL,
  `coa_head_code` bigint(20) NOT NULL,
  `narration` text NOT NULL,
  `debit_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `credit_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `posted` tinyint(4) NOT NULL DEFAULT 0,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_transaction_autos`
--

INSERT INTO `account_transaction_autos` (`id`, `company_id`, `voucher_no`, `voucher_type`, `voucher_date`, `coa_setup_id`, `coa_head_code`, `narration`, `debit_amount`, `credit_amount`, `posted`, `approve`, `approve_by`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'STL2605000001', 'Product Purchase', '2026-05-07', 127, 40201, 'Product Purchase Against Purchase No - STL2605000001', 330.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-05-07 09:50:05', '2026-05-07 09:50:05'),
(2, 1, 'STL2605000001', 'Product Purchase', '2026-05-07', 166, 20101, 'Product Purchase Against Purchase No - STL2605000001', 0.00, 330.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-05-07 09:50:05', '2026-05-07 09:50:05'),
(3, 1, 'RS26050001', 'Retail Sales', '2026-05-13', 26, 1010201, 'Retail Sales Against Invoice No - RS26050001', 66.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-05-13 05:16:42', '2026-05-13 05:16:42'),
(4, 1, 'RS26050001', 'Retail Sales', '2026-05-13', 79, 30104, 'Retail Sales Against Invoice No - RS26050001', 0.00, 66.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-05-13 05:16:42', '2026-05-13 05:16:42'),
(5, 1, 'RS26070001', 'Retail Sales', '2026-07-07', 26, 1010201, 'Retail Sales Against Invoice No - RS26070001', 33.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-07 10:15:59', '2026-07-07 10:15:59'),
(6, 1, 'RS26070001', 'Retail Sales', '2026-07-07', 79, 30104, 'Retail Sales Against Invoice No - RS26070001', 0.00, 33.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-07 10:15:59', '2026-07-07 10:15:59'),
(7, 1, 'STL2607000001', 'Product Purchase', '2026-07-07', 127, 40201, 'Product Purchase Against Purchase No - STL2607000001', 3300.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-07 10:16:51', '2026-07-07 10:16:51'),
(8, 1, 'STL2607000001', 'Product Purchase', '2026-07-07', 234, 20166, 'Product Purchase Against Purchase No - STL2607000001', 0.00, 3300.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-07 10:16:51', '2026-07-07 10:16:51'),
(9, 1, 'RS26070002', 'Retail Sales', '2026-07-13', 26, 1010201, 'Retail Sales Against Invoice No - RS26070002', 33.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(10, 1, 'RS26070002', 'Retail Sales', '2026-07-13', 79, 30104, 'Retail Sales Against Invoice No - RS26070002', 0.00, 33.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(11, 1, 'STS2607000001', 'Sales', '2026-07-13', 141, 1010102, 'Product Sales Against Invoice No - STS2607000001', 30.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-13 08:42:31', '2026-07-13 08:42:31'),
(12, 1, 'STS2607000001', 'Sales', '2026-07-13', 78, 30103, 'Product Sales Against Invoice No - STS2607000001', 0.00, 30.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-13 08:42:31', '2026-07-13 08:42:31'),
(13, 1, 'STL2607000002', 'Product Purchase', '2026-07-27', 127, 40201, 'Product Purchase Against Purchase No - STL2607000002', 5000.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-27 04:28:41', '2026-07-27 04:28:41'),
(14, 1, 'STL2607000002', 'Product Purchase', '2026-07-27', 166, 20101, 'Product Purchase Against Purchase No - STL2607000002', 0.00, 5000.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-07-27 04:28:41', '2026-07-27 04:28:41'),
(15, 1, 'STC2608000001', 'Collection', '2026-08-31', 26, 1010201, 'Collection Against PAYMENT NO - STC2608000001', 4.00, 0.00, 0, 0, NULL, 187, NULL, NULL, NULL, '2026-08-31 06:28:12', '2026-08-31 06:28:12'),
(16, 1, 'STC2608000001', 'Collection', '2026-08-31', 141, 1010102, 'Collection Against PAYMENT NO - STC2608000001', 0.00, 4.00, 0, 0, NULL, 187, NULL, NULL, NULL, '2026-08-31 06:28:12', '2026-08-31 06:28:12'),
(17, 1, 'DV-1000000001', 'DV', '2026-09-03', 26, 1010201, 'Amanah Trading Ltd - 20199', 0.00, 4550.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-03 06:47:02', '2026-10-10 08:35:11'),
(18, 1, 'DV-1000000001', 'DV', '2026-09-03', 267, 20199, 'Amanah Trading Ltd - 20199', 4550.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-03 06:47:02', '2026-10-10 08:35:11'),
(19, 1, 'DV-1000000002', 'DV', '2026-09-05', 26, 1010201, 'Fortune Company - 20117', 0.00, 40000.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-05 08:29:09', '2026-09-05 08:29:09'),
(20, 1, 'DV-1000000002', 'DV', '2026-09-05', 182, 20117, 'Fortune Company - 20117', 40000.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-05 08:29:09', '2026-09-05 08:29:09'),
(21, 1, 'DV-1000000003', 'DV', '2026-09-05', 26, 1010201, 'Fortune Company - 20117', 0.00, 40000.00, 0, 0, NULL, 1, 1, NULL, NULL, '2026-09-05 08:29:11', '2026-09-14 06:12:34'),
(23, 1, 'RS26090001', 'Retail Sales', '2026-09-06', 26, 1010201, 'Retail Sales Against Invoice No - RS26090001', 665.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(24, 1, 'RS26090001', 'Retail Sales', '2026-09-06', 79, 30104, 'Retail Sales Against Invoice No - RS26090001', 0.00, 665.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(25, 1, 'STL2609000001', 'Product Purchase', '2026-09-10', 127, 40201, 'Product Purchase Against Purchase No - STL2609000001', 5025.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-10 10:59:37', '2026-09-10 10:59:37'),
(26, 1, 'STL2609000001', 'Product Purchase', '2026-09-10', 234, 20166, 'Product Purchase Against Purchase No - STL2609000001', 0.00, 5025.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-10 10:59:37', '2026-09-10 10:59:37'),
(27, 1, 'STL2609000002', 'Product Purchase', '2026-09-10', 127, 40201, 'Product Purchase Against Purchase No - STL2609000002', 3560.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-10 11:00:19', '2026-09-10 11:00:19'),
(28, 1, 'STL2609000002', 'Product Purchase', '2026-09-10', 234, 20166, 'Product Purchase Against Purchase No - STL2609000002', 0.00, 3560.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-10 11:00:19', '2026-09-10 11:00:19'),
(29, 1, 'RS26090002', 'Retail Sales', '2026-09-10', 26, 1010201, 'Retail Sales Against Invoice No - RS26090002', 2690.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(30, 1, 'RS26090002', 'Retail Sales', '2026-09-10', 79, 30104, 'Retail Sales Against Invoice No - RS26090002', 0.00, 2690.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(31, 1, 'STL2609000003', 'Product Purchase', '2026-09-14', 127, 40201, 'Product Purchase Against Purchase No - STL2609000003', 3300.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:31:52', '2026-09-14 00:31:52'),
(32, 1, 'STL2609000003', 'Product Purchase', '2026-09-14', 303, 201126, 'Product Purchase Against Purchase No - STL2609000003', 0.00, 3300.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:31:52', '2026-09-14 00:31:52'),
(33, 1, 'STL2609000004', 'Product Purchase', '2026-09-14', 127, 40201, 'Product Purchase Against Purchase No - STL2609000004', 5000.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(34, 1, 'STL2609000004', 'Product Purchase', '2026-09-14', 227, 20159, 'Product Purchase Against Purchase No - STL2609000004', 0.00, 5000.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(35, 1, 'STP2609000001', 'Vendor Payment', '2026-09-14', 227, 20159, 'Payment Vendor Against PAYMENT NO - STP2609000001', 5000.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(36, 1, 'STP2609000001', 'Vendor Payment', '2026-09-14', 26, 1010201, 'Payment Vendor Against PAYMENT NO - STP2609000001', 0.00, 5000.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(37, 1, 'RS26090003', 'Retail Sales', '2026-09-14', 26, 1010201, 'Retail Sales Against Invoice No - RS26090003', 540.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(38, 1, 'RS26090003', 'Retail Sales', '2026-09-14', 79, 30104, 'Retail Sales Against Invoice No - RS26090003', 0.00, 540.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(39, 1, 'DV-1000000003', 'DV', '2026-09-05', 182, 20117, 'Fortune Company - 20117', 40000.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 06:12:34', '2026-09-14 06:12:34'),
(40, 1, 'STL2609000005', 'Product Purchase', '2026-09-14', 127, 40201, 'Product Purchase Against Purchase No - STL2609000005', 2063360.00, 0.00, 0, 0, NULL, 176, NULL, NULL, NULL, '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(41, 1, 'STL2609000005', 'Product Purchase', '2026-09-14', 166, 20101, 'Product Purchase Against Purchase No - STL2609000005', 0.00, 2063360.00, 0, 0, NULL, 176, NULL, NULL, NULL, '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(42, 1, 'STL2609000006', 'Product Purchase', '2026-09-17', 127, 40201, 'Product Purchase Against Purchase No - STL2609000006', 470.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(43, 1, 'STL2609000006', 'Product Purchase', '2026-09-17', 234, 20166, 'Product Purchase Against Purchase No - STL2609000006', 0.00, 470.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(44, 1, 'STL2609000007', 'Product Purchase', '2026-09-21', 127, 40201, 'Product Purchase Against Purchase No - STL2609000007', 71200.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-21 06:54:43', '2026-09-21 06:54:43'),
(45, 1, 'STL2609000007', 'Product Purchase', '2026-09-21', 303, 201126, 'Product Purchase Against Purchase No - STL2609000007', 0.00, 71200.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-09-21 06:54:43', '2026-09-21 06:54:43'),
(46, 1, 'STC2610000001', 'Collection', '2026-10-09', 26, 1010201, 'Collection Against PAYMENT NO - STC2610000001', 2230.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-10-09 04:08:36', '2026-10-09 04:08:36'),
(47, 1, 'STC2610000001', 'Collection', '2026-10-09', 141, 1010102, 'Collection Against PAYMENT NO - STC2610000001', 0.00, 2230.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-10-09 04:08:36', '2026-10-09 04:08:36'),
(48, 1, 'STC2610000002', 'Collection', '2026-10-26', 26, 1010201, 'Collection Against PAYMENT NO - STC2610000002', 5000.00, 0.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-10-26 04:30:48', '2026-10-26 04:30:48'),
(49, 1, 'STC2610000002', 'Collection', '2026-10-26', 141, 1010102, 'Collection Against PAYMENT NO - STC2610000002', 0.00, 5000.00, 0, 0, NULL, 1, NULL, NULL, NULL, '2026-10-26 04:30:48', '2026-10-26 04:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `name_bn` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `delete` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `permission_id`, `parent_id`, `name`, `name_bn`, `route`, `icon`, `order`, `status`, `delete`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Dashboard', 'ড্যাশবোর্ড', 'admin.dashboard', '<i class=\"fad fa-tachometer-alt-fastest\"></i>', 1, 1, 1, '2023-09-19 09:04:28', '2026-07-16 03:36:40'),
(2, 2, NULL, 'System Setting', 'সিস্টেম সেটিংস', NULL, '<i class=\"fad fa-users-cog\"></i>', 2, 1, 1, '2023-09-19 09:05:17', '2026-07-16 03:57:41'),
(3, 3, 2, 'Company Setup', 'কোম্পানি সেটআপ', 'admin.company.index', NULL, 1, 1, 1, '2023-09-19 09:05:30', '2023-09-19 09:11:55'),
(4, 4, 2, 'Branch Setup', 'শাখা সেটআপ', 'admin.branch.index', NULL, 2, 1, 1, '2023-09-19 09:05:39', '2023-09-19 09:12:52'),
(5, 5, 2, 'Role Setup', 'রোল সেটআপ', 'admin.role.index', NULL, 3, 1, 1, '2023-09-19 09:05:48', '2023-09-19 09:13:04'),
(6, 6, 2, 'User Setup', 'ব্যবহারকারী সেটআপ', 'admin.user.index', NULL, 4, 1, 1, '2023-09-19 09:05:55', '2023-09-19 09:15:19'),
(7, 7, 2, 'Menu Setup', 'মেনু সেটআপ', 'admin.admin-menu.index', NULL, 5, 1, 1, '2023-09-19 09:06:24', '2023-09-19 09:15:35'),
(8, 20, NULL, 'Product Management', 'পণ্য ব্যবস্থাপনা', NULL, '<i class=\"fad fa-tools\"></i>', 3, 1, 1, '2023-09-19 09:20:32', '2026-07-16 03:45:48'),
(9, 21, 8, 'Sales Group', 'বিক্রয় গ্রুপ', 'admin.group.index', NULL, 5, 0, 1, '2023-09-19 09:20:46', '2024-10-13 17:24:19'),
(10, 22, 8, 'Store Setup', 'স্টোর সেটআপ', 'admin.store.index', NULL, 3, 1, 1, '2023-09-19 09:20:59', '2023-09-23 14:49:13'),
(11, 23, 8, 'Product Category', 'পণ্যের ক্যাটাগরি', 'admin.category.index', NULL, 8, 1, 1, '2023-09-19 09:21:10', '2024-10-12 11:31:46'),
(12, 24, 8, 'Product Setup', 'পণ্য সেটআপ', 'admin.product.index', NULL, 9, 1, 1, '2023-09-19 09:21:19', '2023-09-25 14:14:03'),
(13, 25, 8, 'Employee Setup', 'স্টাফ সেটআপ', 'admin.staff.index', NULL, 4, 1, 1, '2023-09-19 09:21:25', '2023-09-23 14:49:31'),
(14, 26, 8, 'Product List', 'পণ্যের তালিকা', 'admin.product-list.index', NULL, 10, 1, 1, '2023-09-19 09:21:36', '2023-09-30 06:36:17'),
(15, 27, NULL, 'System Configuration', 'সিস্টেম কনফিগারেশন', NULL, '<i class=\"fad fa-sliders-h\"></i>', 3, 0, 1, '2023-09-19 09:22:02', '2025-04-15 03:52:39'),
(16, 28, 15, 'Group Sales Target', 'গ্রুপ বিক্রয় লক্ষ্যমাত্রা', 'admin.group-target.index', NULL, 1, 0, 1, '2023-09-19 09:22:23', '2024-10-13 17:24:16'),
(17, 29, 15, 'Client Price Setup', 'গ্রাহক মূল্য সেটআপ', 'admin.client-price.index', NULL, 2, 0, 1, '2023-09-19 09:22:33', '2025-04-15 03:52:33'),
(18, 30, NULL, 'Purchase Management', 'ক্রয় ব্যবস্থাপনা', NULL, '<i class=\"fad fa-cogs\"></i>', 5, 1, 1, '2023-09-19 09:23:13', '2026-07-16 03:47:04'),
(19, 31, 18, 'Transaction', 'লেনদেন', NULL, NULL, 1, 1, 1, '2023-09-19 09:23:22', '2023-09-19 09:23:22'),
(20, 32, 19, 'Vendor Setup', 'সরবরাহকারী সেটআপ', 'admin.vendor.index', NULL, 1, 1, 1, '2023-09-19 09:23:31', '2023-09-25 04:28:11'),
(21, 33, 19, 'Product Purchase', 'পণ্য ক্রয়', 'admin.lifting.index', NULL, 2, 1, 1, '2023-09-19 09:23:43', '2024-07-31 03:24:18'),
(23, 35, 19, 'Vendor Payment', 'সরবরাহকারী পরিশোধ', 'admin.vendor-payment.index', NULL, 4, 1, 1, '2023-09-19 09:24:05', '2023-10-16 09:18:55'),
(24, 36, 18, 'Reports', 'প্রতিবেদন', NULL, NULL, 2, 1, 1, '2023-09-19 09:24:13', '2023-09-19 09:24:13'),
(25, 37, 24, 'Purchase History', 'ক্রয়ের ইতিহাস', 'admin.lifting-history.index', NULL, 1, 1, 1, '2023-09-19 09:24:28', '2024-07-31 03:25:52'),
(27, 39, 24, 'Payment History', 'পরিশোধের ইতিহাস', 'admin.vendor-payment-history.index', NULL, 3, 1, 1, '2023-09-19 09:24:54', '2024-07-31 03:27:00'),
(28, 40, 24, 'Vendor Statement', 'সরবরাহকারী বিবরণী', 'admin.vendor-statement.index', NULL, 4, 1, 1, '2023-09-19 09:25:06', '2023-10-26 08:58:42'),
(29, 41, NULL, 'Inventory Management', 'ইনভেন্টরি ব্যবস্থাপনা', NULL, '<i class=\"fad fa-analytics\"></i>', 6, 1, 1, '2023-09-19 09:25:29', '2026-07-16 04:04:54'),
(34, 46, 33, 'Closing Stock', 'সমাপনী মজুদ', NULL, NULL, 1, 0, 1, '2023-09-19 09:26:33', '2023-10-26 15:51:09'),
(35, 47, 29, 'Stock Status', 'স্টকের অবস্থা', 'admin.stock-status.index', NULL, 3, 1, 1, '2023-09-19 09:26:45', '2024-10-08 06:12:00'),
(37, 49, NULL, 'Sales Management', 'বিক্রয় ব্যবস্থাপনা', NULL, '<i class=\"fad fa-tasks\"></i>', 7, 1, 1, '2023-09-19 09:28:03', '2026-07-16 04:05:29'),
(38, 50, 37, 'Transaction', 'লেনদেন', NULL, NULL, 1, 1, 1, '2023-09-19 09:28:16', '2023-09-19 09:28:16'),
(39, 51, 8, 'Region Setup', 'অঞ্চল সেটআপ', 'admin.region.index', NULL, 0, 0, 1, '2023-09-19 09:28:49', '2024-09-11 04:16:06'),
(40, 52, 8, 'Area Setup', 'এলাকা সেটআপ', 'admin.area.index', NULL, 1, 1, 1, '2023-09-19 09:29:03', '2023-09-23 14:48:28'),
(41, 53, 8, 'Zone/Territory Setup', 'ঠিকানা সেটআপ', 'admin.territory.index', NULL, 2, 1, 1, '2023-09-19 09:29:15', '2026-07-18 09:31:40'),
(42, 54, 38, 'Client Setup', 'গ্রাহক সেটআপ', 'admin.client.index', NULL, 0, 1, 1, '2023-09-19 09:29:28', '2023-10-13 04:45:32'),
(43, 55, 38, 'Invoice', ' বিক্রয়', 'admin.sales.index', NULL, 3, 1, 1, '2023-09-19 09:29:42', '2025-04-13 12:09:37'),
(44, 56, 38, 'Collection', 'গ্রাহক আদায়', 'admin.collection.index', NULL, 6, 1, 1, '2023-09-19 09:29:54', '2025-04-13 12:10:05'),
(45, 57, 38, 'Bulk Collection', 'বাল্ক আদায়', 'admin.bulk-collection.index', NULL, 7, 0, 1, '2023-09-19 09:30:07', '2024-07-31 03:28:05'),
(46, 58, 38, 'Invoice Return', 'বিক্রয় ফেরত', 'admin.sales-return.index', NULL, 8, 1, 1, '2023-09-19 09:30:21', '2023-10-15 06:42:46'),
(47, 59, 38, 'Return Approval', 'ফেরত অনুমোদন', 'admin.return-approve.index', NULL, 9, 1, 1, '2023-09-19 09:30:32', '2023-10-18 12:04:00'),
(48, 60, 37, 'Reports', 'প্রতিবেদন', NULL, NULL, 2, 1, 1, '2023-09-19 09:30:42', '2023-09-19 09:30:42'),
(49, 61, 48, 'Invoice History', 'বিক্রয়ের ইতিহাস', 'admin.sales-history.index', NULL, 1, 1, 1, '2023-09-19 09:30:51', '2024-07-31 03:30:07'),
(50, 62, 48, 'Collection History', 'আদায়ের ইতিহাস', 'admin.collection-history.index', NULL, 2, 1, 1, '2023-09-19 09:31:08', '2024-07-31 03:30:14'),
(52, 64, 48, 'Client Statement', 'গ্রাহক বিবরণী', 'admin.client-statement.index', NULL, 4, 1, 1, '2023-09-19 09:31:39', '2023-10-26 08:51:35'),
(53, 65, 48, 'Client List', 'গ্রাহক তালিকা', 'admin.client-list.index', NULL, 0, 1, 1, '2023-09-19 09:31:52', '2023-11-14 06:20:12'),
(55, 67, 54, 'Payment Analysis', 'পরিশোধ বিশ্লেষণ', 'admin.lifting-realization.index', NULL, 1, 1, 1, '2023-09-19 09:33:39', '2023-10-29 17:06:44'),
(56, 68, 29, 'Stock Valuation', 'স্টক মূল্যায়ন', 'admin.stock-valuation.index', NULL, 4, 1, 1, '2023-09-19 09:33:47', '2024-10-08 06:09:53'),
(57, 69, 54, 'Target & Achievement', 'লক্ষ্যমাত্রা ও অর্জন', 'admin.sales-target-achivement.index', NULL, 3, 0, 1, '2023-09-19 09:33:56', '2024-10-13 15:42:18'),
(58, 70, 54, 'Sales Contribution', 'বিক্রয় অবদান', 'admin.sales-contribution.index', NULL, 4, 1, 1, '2023-09-19 09:34:06', '2023-10-29 17:07:36'),
(59, 71, 54, 'Sales Analysis', 'বিক্রয় বিশ্লেষণ', 'admin.sales-realization.index', NULL, 5, 1, 1, '2023-09-19 09:34:14', '2024-07-31 03:34:16'),
(60, 72, 54, 'Sales Ageing Report', 'বিক্রয় বকেয়া প্রতিবেদন', 'admin.sales-ageing.index', NULL, 6, 1, 1, '2023-09-19 09:34:41', '2023-10-29 17:08:39'),
(61, 73, 54, 'Client Outstanding', 'গ্রাহকের বকেয়া', 'admin.client-outstanding.index', NULL, 7, 1, 1, '2023-09-19 09:34:53', '2023-10-29 17:09:15'),
(62, 74, 54, 'Product Profit', 'পণ্যের লাভ', 'admin.product-wise-profit.index', NULL, 8, 1, 1, '2023-09-19 09:35:10', '2023-11-02 10:03:23'),
(64, 76, 38, 'Offline Order', 'অফলাইন অর্ডার', 'admin.offline-order.index', NULL, 1, 0, 1, '2023-09-19 09:36:18', '2025-04-13 12:09:03'),
(66, 78, 38, 'Prepare Gatepass', 'গেটপাস প্রস্তুত', 'admin.delivery.index', NULL, 4, 0, 1, '2023-09-19 09:38:15', '2024-09-26 16:33:18'),
(68, 80, 48, 'Delivery Statement', 'ডেলিভারি বিবরণী', 'admin.delivery-statement.index', NULL, 10, 1, 1, '2023-09-19 09:38:34', '2023-10-26 08:52:30'),
(71, 168, 8, 'Vehicle Setup', 'যানবাহন সেটআপ', 'admin.vehicle.index', NULL, 11, 0, 1, '2023-09-28 06:35:35', '2024-10-13 17:23:55'),
(73, 180, NULL, 'Website Management', 'ওয়েবসাইট ব্যবস্থাপনা', NULL, '<i class=\"fad fa-window-alt\"></i>', 11, 1, 1, '2023-10-08 15:08:32', '2026-07-16 03:55:20'),
(74, 181, 73, 'Slider', 'স্লাইডার', 'admin.slider.index', NULL, 1, 1, 1, '2023-10-08 15:09:27', '2023-10-08 15:14:11'),
(81, 188, 73, 'Client Message', 'গ্রাহক বার্তা', 'admin.client-message.index', NULL, 8, 1, 1, '2023-10-08 15:25:53', '2023-10-08 15:25:53'),
(84, 226, 73, 'Site Settings', 'সাইট সেটিংস', 'admin.settings.index', NULL, 11, 1, 1, '2023-10-08 15:50:46', '2023-10-08 15:50:46'),
(85, 291, 63, 'Orders Status', 'অর্ডারের অবস্থা', 'admin.online-order.index', NULL, 5, 1, 1, '2023-11-16 11:58:49', '2024-10-06 11:14:31'),
(86, 292, 63, 'Client Request', 'গ্রাহকের অনুরোধ', 'admin.client-request.index', NULL, 5, 1, 1, '2023-11-16 12:00:00', '2023-11-20 12:11:25'),
(87, 295, 54, 'Access Log', 'অ্যাক্সেস লগ', 'admin.access-log.index', NULL, 21, 1, 1, '2023-11-16 12:02:14', '2024-10-13 15:47:22'),
(88, 296, 63, 'Online Dashboard', 'অনলাইন ড্যাশবোর্ড', 'admin.order-dashboard.index', NULL, 0, 0, 1, '2023-11-19 17:02:39', '2024-09-11 03:57:32'),
(89, 299, 63, 'Cancelled Order', 'বাতিল অর্ডার', 'admin.cancel-order.index', NULL, 4, 0, 1, '2023-11-19 17:06:14', '2024-09-27 05:20:27'),
(90, 301, 63, 'Delivery Gatepass', 'ডেলিভারি গেটপাস', 'admin.online-order-delivery.index', NULL, 3, 0, 1, '2023-11-19 17:07:36', '2024-09-26 16:33:15'),
(91, 308, 63, 'Delivery Charge', 'ডেলিভারি চার্জ', 'admin.delivery-charge.index', NULL, 5, 1, 1, '2023-11-19 17:09:47', '2023-11-19 17:09:47'),
(99, 330, 48, 'Salesman Performance', 'বিক্রয় প্রতিনিধির কর্মদক্ষতা', 'admin.salesman-flowchart.index', NULL, 11, 1, 1, '2023-11-26 11:18:53', '2024-07-31 03:30:34'),
(100, 331, 48, 'Client Sales Flow', 'গ্রাহক বিক্রয় প্রবাহ', 'admin.client-sales-flow.index', NULL, 12, 1, 1, '2023-11-27 08:53:49', '2023-11-27 08:53:49'),
(101, 332, 54, 'Online Sales History', 'অনলাইন বিক্রয়ের ইতিহাস', 'admin.online-sales-history.index', NULL, 13, 1, 1, '2023-11-27 11:16:13', '2024-09-05 06:38:55'),
(102, 333, 73, 'Page Setup', 'পেজ সেটআপ', 'admin.page.index', NULL, 12, 1, 1, '2023-11-27 14:58:52', '2023-11-27 14:58:52'),
(103, 334, NULL, 'General Accounting', 'সাধারণ হিসাবরক্ষণ', NULL, '<i class=\"fal fa-ballot-check\"></i>', 8, 1, 1, '2023-12-13 12:04:08', '2026-07-16 04:05:55'),
(104, 335, 103, 'Transaction', 'লেনদেন', NULL, NULL, 1, 1, 1, '2023-12-13 12:04:34', '2023-12-13 12:04:34'),
(105, 336, 104, 'Chart of Accounts', 'হিসাবের তালিকা', 'admin.coa-setup.index', NULL, 1, 1, 1, '2023-12-13 12:05:02', '2023-12-13 12:05:02'),
(106, 337, 104, 'Debit Voucher', 'ডেবিট ভাউচার', 'admin.debit-voucher-entry.index', NULL, 2, 1, 1, '2023-12-13 12:05:41', '2024-07-31 03:32:43'),
(107, 338, 104, 'Credit Voucher', 'ক্রেডিট ভাউচার', 'admin.credit-voucher-entry.index', NULL, 3, 1, 1, '2023-12-13 12:05:59', '2024-07-31 03:32:48'),
(108, 339, 104, 'Journal Voucher', 'জার্নাল ভাউচার', 'admin.journal-voucher-entry.index', NULL, 4, 1, 1, '2023-12-13 12:06:21', '2024-07-31 03:32:53'),
(109, 340, 104, 'Voucher Approve', 'ভাউচার অনুমোদন', 'admin.voucher-approve.index', NULL, 5, 1, 1, '2023-12-13 12:06:45', '2023-12-13 12:06:45'),
(110, 341, 104, 'Voucher Refuse', 'ভাউচার বাতিল', 'admin.voucher-reject.index', NULL, 6, 1, 1, '2023-12-13 12:07:04', '2023-12-13 12:07:04'),
(112, 343, 104, 'Automation Refuse', 'স্বয়ংক্রিয় বাতিল', 'admin.automation-reject.index', NULL, 8, 1, 1, '2023-12-13 12:09:41', '2023-12-13 12:09:41'),
(113, 371, 103, 'Reports', 'প্রতিবেদন', NULL, NULL, 2, 1, 1, '2023-12-13 16:37:50', '2023-12-13 16:37:50'),
(114, 372, 113, 'Chart of Accounts', 'হিসাবের তালিকা', 'admin.coa-list.index', NULL, 1, 1, 1, '2023-12-13 16:38:13', '2023-12-13 16:38:13'),
(115, 373, 113, 'Daily Voucher List', 'দৈনিক ভাউচার তালিকা', 'admin.voucher-list.index', NULL, 2, 1, 1, '2023-12-16 06:26:26', '2023-12-16 06:26:26'),
(116, 374, 113, 'Daily Cash Book', 'দৈনিক নগদ বই', 'admin.cash-book.index', NULL, 3, 1, 1, '2023-12-19 14:46:09', '2023-12-19 14:46:09'),
(117, 375, 113, 'Daily Bank Book', 'দৈনিক ব্যাংক বই', 'admin.bank-book.index', NULL, 4, 1, 1, '2023-12-19 14:46:38', '2023-12-19 14:46:38'),
(118, 376, 113, 'Transaction Ledger', 'লেনদেন লেজার', 'admin.transaction-ledger.index', NULL, 5, 1, 1, '2023-12-19 14:47:08', '2023-12-19 14:47:08'),
(119, 377, 113, 'Cash Flow Statement', 'নগদ প্রবাহ বিবরণী', 'admin.cash-flow-statement.index', NULL, 7, 1, 1, '2023-12-19 14:47:27', '2024-10-31 15:08:15'),
(120, 378, 113, 'General Ledger', 'সাধারণ লেজার', 'admin.general-ledger.index', NULL, 7, 1, 1, '2023-12-19 14:47:46', '2023-12-19 14:47:46'),
(121, 379, 113, 'Trial Balance', 'ট্রায়াল ব্যালেন্স', 'admin.trial-balance.index', NULL, 8, 1, 1, '2023-12-30 16:33:07', '2023-12-30 16:33:07'),
(122, 380, 113, 'Income Statement', 'আয় বিবরণী', 'admin.income-statement.index', NULL, 7, 1, 1, '2023-12-30 16:37:11', '2024-10-31 15:06:31'),
(123, 381, 73, 'Subscribers', 'সাবস্ক্রাইবার', 'admin.subscription.index', NULL, 13, 1, 1, '2024-01-23 04:24:23', '2024-01-23 04:24:23'),
(124, 382, 2, 'Admin Settings', 'অ্যাডমিন সেটিংস', 'admin.admin-settings.index', NULL, 6, 1, 1, '2024-02-27 10:29:25', '2024-02-27 10:29:25'),
(125, 383, 113, 'Balance Sheet', 'ব্যালেন্স শীট', 'admin.balance-sheet.index', NULL, 10, 1, 1, '2024-02-28 15:09:20', '2024-02-28 15:09:20'),
(126, 384, NULL, 'Clear cache', 'ক্যাশ পরিষ্কার করুন', 'admin.cache.clear', '<i class=\"fad fa-broom\"></i>', 18, 1, 1, '2024-03-03 04:17:45', '2026-07-16 03:56:10'),
(129, 392, 54, 'Invoice Profit Loss', 'ইনভয়েস লাভ-ক্ষতি', 'admin.profit-loss.index', NULL, 10, 1, 1, '2024-04-08 09:56:46', '2024-07-31 03:34:55'),
(130, 393, 8, 'Sizes', 'সাইজ', 'admin.size.index', NULL, 15, 0, 1, '2024-04-16 16:16:55', '2024-05-01 05:24:22'),
(131, 394, 8, 'Colors', 'রং', 'admin.color.index', NULL, 16, 0, 1, '2024-04-16 16:17:26', '2024-05-01 05:24:16'),
(135, 427, 73, 'Menu Setup', 'মেনু সেটআপ', 'admin.menu.index', NULL, 14, 1, 1, '2024-06-23 04:18:38', '2024-06-23 04:18:38'),
(136, 438, 73, 'Homepage Section', 'হোমপেজ সেকশন', 'admin.sections.index', NULL, 15, 1, 1, '2024-06-23 12:14:58', '2024-06-23 12:14:58'),
(148, 485, 151, 'Payment Request', 'পেমেন্ট অনুরোধ', 'admin.approve-payment.index', NULL, 9, 1, 1, '2024-07-23 17:56:48', '2024-07-30 09:06:53'),
(151, 494, 150, 'Transaction', 'লেনদেন', NULL, NULL, 1, 1, 1, '2024-07-29 02:20:43', '2024-07-29 02:20:43'),
(156, 517, 150, 'Reports', 'প্রতিবেদন', NULL, NULL, 2, 1, 1, '2024-07-30 09:08:40', '2024-07-30 09:08:40'),
(163, 529, 63, 'Order Receive', 'অর্ডার গ্রহণ', 'admin.order.index', NULL, 1, 1, 1, '2024-08-31 17:47:10', '2024-09-09 05:32:40'),
(164, 533, 63, 'Order List Report', 'অর্ডার তালিকা প্রতিবেদন', 'admin.order-list.index', NULL, 6, 0, 1, '2024-09-03 11:14:42', '2024-10-08 05:58:21'),
(165, 534, 63, 'Order Return', 'অর্ডার ফেরত', 'admin.order-return.index', NULL, 4, 0, 1, '2024-09-09 11:38:09', '2024-09-27 05:20:47'),
(166, 538, 63, 'Required Product', 'প্রয়োজনীয় পণ্য', 'admin.required-product.index', NULL, 9, 1, 1, '2024-09-10 13:39:43', '2024-09-27 05:24:20'),
(167, 539, 63, 'Areawise Orders', 'এলাকাভিত্তিক অর্ডার', 'admin.areawise-orders.index', NULL, 11, 1, 1, '2024-09-11 03:56:57', '2024-09-27 05:24:49'),
(168, 543, 54, 'Online Product Sales', 'অনলাইন পণ্য বিক্রয়', 'admin.product-wise-sales-summary.index', NULL, 14, 1, 1, '2024-09-17 08:03:38', '2024-10-13 15:46:26'),
(169, 544, 54, 'Online Area Sales', 'অনলাইন এলাকা বিক্রয়', 'admin.area-wise-sales-statement.index', NULL, 15, 1, 1, '2024-09-17 08:04:03', '2024-10-13 15:40:56'),
(170, 545, 54, 'Online Monthly Statement', 'অনলাইন মাসিক বিবরণী', 'admin.monthly-statement.index', NULL, 16, 1, 1, '2024-09-17 08:04:19', '2024-10-13 15:44:45'),
(172, 550, 63, 'Bulk Assign', 'বাল্ক বরাদ্দ', 'admin.order-assign.index', NULL, 3, 1, 1, '2024-09-23 13:09:08', '2024-10-06 11:10:45'),
(173, 554, 54, 'Online Store Sales', 'অনলাইন স্টোর বিক্রয়', 'admin.store-wise-sales-statement.index', NULL, 15, 1, 1, '2024-09-26 10:40:52', '2024-10-13 15:40:32'),
(174, 555, 63, 'Bulk Forward', 'বাল্ক ফরওয়ার্ড', 'admin.bulk-forward.index', NULL, 2, 1, 1, '2024-09-26 11:01:05', '2024-09-26 14:21:07'),
(175, 556, 63, 'Delivery Sheet', 'ডেলিভারি শিট', 'admin.on-route-orders.index', NULL, 7, 1, 1, '2024-09-26 11:03:19', '2024-09-27 05:21:51'),
(176, 557, 63, 'Bulk Delivery', 'বাল্ক ডেলিভারি', 'admin.order-status.index', NULL, 4, 1, 1, '2024-09-26 11:04:12', '2024-10-06 11:12:29'),
(177, 558, 63, 'Bulk Collection', 'বাল্ক আদায়', 'admin.order-collection.index', NULL, 4, 1, 1, '2024-09-26 11:04:59', '2024-10-06 11:13:11'),
(178, 559, 63, 'Storewise Orders', 'স্টোরভিত্তিক অর্ডার', 'admin.storewise-orders.index', NULL, 10, 1, 1, '2024-09-26 11:05:46', '2024-09-27 05:25:06'),
(180, 561, 54, 'Online Customer List', 'অনলাইন গ্রাহক তালিকা', 'admin.customer-list.index', NULL, 18, 1, 1, '2024-10-09 11:22:34', '2024-10-13 15:43:22'),
(181, 562, 54, 'Online Monthly Summary', 'অনলাইন মাসিক সারসংক্ষেপ', 'admin.monthly-summary-sheet.index', NULL, 19, 1, 1, '2024-10-09 11:22:57', '2024-10-13 15:44:16'),
(182, 563, 54, 'Online Monthly Chart', 'অনলাইন মাসিক চার্ট', 'admin.monthly-chart.index', NULL, 20, 1, 1, '2024-10-09 14:45:28', '2024-10-13 15:42:39'),
(189, 583, 63, 'Courier Assign', 'কুরিয়ার বরাদ্দ', 'admin.courier-assign.index', NULL, 12, 1, 1, '2024-10-24 09:47:20', '2024-10-24 09:47:20'),
(190, 584, 113, 'Receive Payment', 'পেমেন্ট গ্রহণ', 'admin.receive-payment.index', NULL, 7, 1, 1, '2024-10-31 15:07:01', '2024-10-31 15:07:01'),
(191, 586, 63, 'Pre Order Setup', 'প্রি-অর্ডার সেটআপ', 'admin.pre-order.index', NULL, 13, 1, 1, '2024-11-05 06:23:49', '2024-11-05 06:23:49'),
(192, 590, 63, 'Daily Collection Report', 'দৈনিক আদায় প্রতিবেদন', 'admin.collection-report.index', NULL, 14, 1, 1, '2024-11-16 12:05:24', '2024-11-16 12:05:24'),
(194, 595, 29, 'Out of Stock', 'স্টক শেষ', 'admin.stock-out.index', NULL, 2, 1, 1, '2025-04-20 13:08:59', '2025-04-20 13:08:59'),
(195, 596, 48, 'Running Sales Report', 'চলমান বিক্রয় প্রতিবেদন', 'admin.retail-sales-report.index', NULL, 13, 1, 1, '2025-05-05 05:42:20', '2025-05-05 05:42:20'),
(196, 597, 38, 'Retail Return', 'খুচরা বিক্রয় ফেরত', 'admin.retail-return.index', NULL, 14, 1, 1, '2025-05-13 08:44:34', '2025-05-13 08:44:34'),
(197, 609, 48, 'Retail Return Report', 'খুচরা ফেরত প্রতিবেদন', 'admin.retail-return-report.index', NULL, 14, 1, 1, '2025-05-28 09:38:20', '2025-05-28 09:38:30'),
(198, 610, NULL, 'CRM', 'কাস্টমার রিলেশনশিপ ম্যানেজমেন্ট', 'crm', '<i class=\"fad fa-user-friends\"></i>', 7, 1, 1, '2026-07-16 06:22:01', '2026-07-16 06:22:01'),
(199, 611, NULL, 'HRM & Payroll', 'হিউম্যান রিসোর্স & বেতন ব্যবস্থাপনা', 'hrm', '<i class=\"fad fa-user-tie\"></i>', 8, 1, 1, '2026-07-16 06:24:08', '2026-07-16 06:26:18'),
(200, 612, 198, 'Lead Management', 'লিড ব্যবস্থাপনা', 'admin.lead.index', NULL, 2, 1, 1, '2026-07-16 06:28:14', '2026-07-21 05:11:00'),
(201, 613, 199, 'Employee Management', 'কর্মচারী ব্যবস্থাপনা', 'admin.employee.index', NULL, 2, 1, 1, '2026-07-16 06:29:37', '2026-07-28 05:58:02'),
(202, 614, 198, 'Lead Source', 'লিডের উৎস', 'admin.lead-source.index', NULL, 2, 1, 1, '2026-07-16 06:31:42', '2026-07-19 11:05:22'),
(203, 615, 198, 'Lead Status', 'লিডের অবস্থা', 'admin.lead-status.index', NULL, 3, 1, 1, '2026-07-16 06:32:37', '2026-07-20 09:13:23'),
(204, 616, 198, 'Customer Management', 'গ্রাহক ব্যবস্থাপনা', 'admin.client.index', NULL, 4, 1, 1, '2026-07-16 06:33:06', '2026-07-21 04:02:13'),
(208, 620, 198, 'Meeting Schedule', 'মিটিং সময়সূচি', 'admin.meeting-schedule.index', NULL, 8, 1, 1, '2026-07-16 06:35:59', '2026-07-22 09:57:44'),
(211, 623, 198, 'Quotation', 'মূল্য প্রস্তাব', 'admin.quotation.index', NULL, 10, 1, 1, '2026-07-16 06:37:10', '2026-07-23 07:02:44'),
(221, 633, 198, 'CRM Dashboard', 'সিআরএম ড্যাশবোর্ড', 'admin.crm.dashboard', NULL, 1, 1, 1, '2026-07-16 06:41:34', '2026-07-21 05:50:33'),
(222, 634, 198, 'CRM Reports', 'সিআরএম প্রতিবেদন', 'admin.crm-report.index', NULL, 20, 1, 1, '2026-07-16 06:41:56', '2026-07-27 09:09:40'),
(225, 637, 199, 'Employee Attendance', 'কর্মচারীর উপস্থিতি', 'admin.employee-attendance.index', NULL, 4, 1, 1, '2026-07-16 06:46:37', '2026-07-28 11:39:10'),
(226, 638, 199, 'Leave Management', 'ছুটি ব্যবস্থাপনা', 'admin.employee-leave.index', NULL, 5, 1, 1, '2026-07-16 06:47:07', '2026-07-29 06:55:14'),
(227, 639, 199, 'Leave Application', 'ছুটির আবেদন', 'admin.employee-leave.create', NULL, 6, 1, 1, '2026-07-16 06:47:37', '2026-07-29 06:54:41'),
(228, 640, 199, 'Holiday Management', 'ছুটির তালিকা', 'admin.holiday.index', NULL, 7, 1, 1, '2026-07-16 06:48:31', '2026-07-29 08:34:12'),
(231, 643, 199, 'Payroll Management', 'বেতন ব্যবস্থাপনা', 'admin.payroll.index', NULL, 10, 1, 1, '2026-07-16 06:51:20', '2026-07-29 09:21:59'),
(232, 644, 199, 'Salary Structure', 'বেতন কাঠামো', 'admin.salary.structure', NULL, 11, 1, 1, '2026-07-16 06:51:47', '2026-08-04 06:26:47'),
(233, 645, 199, 'Generate Salary', 'বেতন তৈরি', 'admin.salary.generate', NULL, 12, 1, 1, '2026-07-16 06:52:16', '2026-08-04 07:03:27'),
(234, 646, 199, 'Salary Sheet', 'বেতন শীট', 'admin.salary.generate', NULL, 13, 1, 1, '2026-07-16 06:52:51', '2026-08-04 10:08:31'),
(236, 648, 199, 'Payslip', 'বেতন স্লিপ', 'admin.pay.slip', NULL, 14, 1, 1, '2026-07-16 06:54:31', '2026-08-04 11:15:29'),
(237, 649, 199, 'Bonus Management', 'বোনাস ব্যবস্থাপনা', 'admin.employee-bonus.index', NULL, 15, 1, 1, '2026-07-16 06:54:57', '2026-08-06 04:41:11'),
(238, 650, 199, 'Increment Management', 'ইনক্রিমেন্ট ব্যবস্থাপনা', 'admin.employee-increment.index', NULL, 16, 1, 1, '2026-07-16 06:55:21', '2026-08-06 06:03:46'),
(239, 651, 199, 'Loan Management', 'ঋণ ব্যবস্থাপনা', 'admin.employee-loan.index', NULL, 17, 1, 1, '2026-07-16 06:55:46', '2026-08-06 06:25:18'),
(241, 653, 199, 'Overtime Management', 'ওভারটাইম ব্যবস্থাপনা', 'admin.employee-overtime.index', NULL, 18, 1, 1, '2026-07-16 06:56:34', '2026-08-09 04:55:23'),
(242, 654, 199, 'Expense Management', 'ব্যয় ব্যবস্থাপনা', 'admin.expense.index', NULL, 18, 1, 1, '2026-07-16 06:57:08', '2026-08-09 06:08:53'),
(243, 655, 199, 'Employee Documents', 'কর্মচারীর ডকুমেন্ট', 'admin.documents.index', NULL, 19, 1, 1, '2026-07-16 06:57:39', '2026-08-09 06:53:45'),
(245, 657, 199, 'Termination', 'চাকরি সমাপ্তি', 'admin.termination.index', NULL, 23, 0, 1, '2026-07-16 08:44:10', '2026-09-23 10:20:00'),
(249, 661, 199, 'Performance Appraisal', 'কর্মদক্ষতা মূল্যায়ন', 'admin.appraisal.index', NULL, 27, 1, 1, '2026-07-16 08:45:44', '2026-08-09 10:26:27'),
(251, 663, 199, 'HR Dashboard', 'এইচআর ড্যাশবোর্ড', 'admin.hrm.dashboard', NULL, 1, 1, 1, '2026-07-16 08:46:26', '2026-07-28 06:15:04'),
(252, 664, 199, 'HR Reports', 'এইচআর প্রতিবেদন', 'admin.hrm.report', NULL, 30, 1, 1, '2026-07-16 08:46:46', '2026-08-10 10:13:52'),
(254, 676, 198, 'Customer Requirements', 'কাস্টমার চাহিদা', 'admin.customer-requirement.index', NULL, 10, 1, 1, '2026-07-21 05:08:08', '2026-09-27 12:37:03'),
(255, 714, 198, 'Enlisted New Client', 'নতুন গ্রাহক তালিকাভুক্ত', 'admin.enlisted.new', NULL, 2, 0, 1, '2026-08-15 09:39:19', '2026-09-23 10:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_actions`
--

CREATE TABLE `admin_menu_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `admin_menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `route` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu_actions`
--

INSERT INTO `admin_menu_actions` (`id`, `permission_id`, `admin_menu_id`, `name`, `route`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 7, 'Create', 'admin.admin-menu.create', 1, '2023-09-19 09:16:56', '2023-09-19 09:16:56'),
(2, 9, 7, 'store', 'admin.admin-menu.store', 1, '2023-09-19 09:17:06', '2023-09-19 09:17:06'),
(3, 10, 7, 'edit', 'admin.admin-menu.edit', 1, '2023-09-19 09:17:10', '2023-09-19 09:17:10'),
(4, 11, 7, 'update', 'admin.admin-menu.update', 1, '2023-09-19 09:17:20', '2023-09-19 09:17:20'),
(5, 12, 7, 'delete', 'admin.admin-menu.destroy', 1, '2023-09-19 09:17:25', '2023-09-19 09:17:25'),
(7, 14, 7, 'action view', 'admin.admin-menuAction.index', 1, '2023-09-19 09:18:18', '2023-09-19 09:18:18'),
(8, 15, 7, 'action create', 'admin.admin-menuAction.create', 1, '2023-09-19 09:18:26', '2023-09-19 09:18:26'),
(9, 16, 7, 'action store', 'admin.admin-menuAction.store', 1, '2023-09-19 09:18:33', '2023-09-19 09:18:33'),
(10, 17, 7, 'action edit', 'admin.admin-menuAction.edit', 1, '2023-09-19 09:18:41', '2023-09-19 09:18:41'),
(11, 18, 7, 'action update', 'admin.admin-menuAction.update', 1, '2023-09-19 09:18:49', '2023-09-19 09:18:49'),
(12, 19, 7, 'action delete', 'admin.admin-menuAction.destroy', 1, '2023-09-19 09:19:02', '2023-09-19 09:19:02'),
(23, 93, 41, 'create', 'admin.territory.create', 1, '2023-09-25 07:00:48', '2023-09-25 07:00:48'),
(24, 94, 41, 'store', 'admin.territory.store', 1, '2023-09-25 07:00:54', '2023-09-25 07:00:54'),
(25, 95, 41, 'edit', 'admin.territory.edit', 1, '2023-09-25 07:00:58', '2023-09-25 07:00:58'),
(26, 96, 41, 'update', 'admin.territory.update', 1, '2023-09-25 07:01:03', '2023-09-25 07:01:03'),
(27, 97, 41, 'delete', 'admin.territory.destroy', 1, '2023-09-25 07:01:09', '2023-09-25 07:01:09'),
(28, 98, 40, 'create', 'admin.area.create', 1, '2023-09-25 07:01:36', '2023-09-25 07:01:36'),
(29, 99, 40, 'store', 'admin.area.store', 1, '2023-09-25 07:01:43', '2023-09-25 07:01:43'),
(30, 100, 40, 'edit', 'admin.area.edit', 1, '2023-09-25 07:01:47', '2023-09-25 07:01:47'),
(31, 101, 40, 'update', 'admin.area.update', 1, '2023-09-25 07:01:52', '2023-09-25 07:01:52'),
(32, 102, 40, 'delete', 'admin.area.destroy', 1, '2023-09-25 07:01:57', '2023-09-25 07:01:57'),
(33, 103, 39, 'create', 'admin.region.create', 1, '2023-09-25 07:02:16', '2023-09-25 07:02:16'),
(34, 104, 39, 'store', 'admin.region.store', 1, '2023-09-25 07:02:22', '2023-09-25 07:02:22'),
(35, 105, 39, 'edit', 'admin.region.edit', 1, '2023-09-25 07:02:26', '2023-09-25 07:02:26'),
(36, 106, 39, 'update', 'admin.region.update', 1, '2023-09-25 07:02:33', '2023-09-25 07:02:33'),
(37, 107, 39, 'delete', 'admin.region.destroy', 1, '2023-09-25 07:02:39', '2023-09-25 07:02:39'),
(38, 108, 20, 'create', 'admin.vendor.create', 1, '2023-09-25 07:03:08', '2023-09-25 07:03:08'),
(39, 109, 20, 'store', 'admin.vendor.store', 1, '2023-09-25 07:03:14', '2023-09-25 07:03:14'),
(40, 110, 20, 'edit', 'admin.vendor.edit', 1, '2023-09-25 07:03:19', '2023-09-25 07:03:19'),
(41, 111, 20, 'update', 'admin.vendor.update', 1, '2023-09-25 07:03:24', '2023-09-25 07:03:24'),
(42, 112, 20, 'delete', 'admin.vendor.destroy', 1, '2023-09-25 07:03:29', '2023-09-25 07:03:29'),
(43, 113, 13, 'create', 'admin.staff.create', 1, '2023-09-25 07:03:49', '2023-09-25 07:03:49'),
(44, 114, 13, 'store', 'admin.staff.store', 1, '2023-09-25 07:03:54', '2023-09-25 07:03:54'),
(45, 115, 13, 'edit', 'admin.staff.edit', 1, '2023-09-25 07:03:58', '2023-09-25 07:03:58'),
(46, 116, 13, 'update', 'admin.staff.update', 1, '2023-09-25 07:04:04', '2023-09-25 07:04:04'),
(47, 117, 13, 'delete', 'admin.staff.destroy', 1, '2023-09-25 07:04:10', '2023-09-25 07:04:10'),
(48, 118, 11, 'create', 'admin.category.create', 1, '2023-09-25 07:04:55', '2023-09-25 07:04:55'),
(49, 119, 11, 'store', 'admin.category.store', 1, '2023-09-25 07:04:59', '2023-09-25 07:04:59'),
(50, 120, 11, 'edit', 'admin.category.edit', 1, '2023-09-25 07:05:03', '2023-09-25 07:05:03'),
(51, 121, 11, 'update', 'admin.category.update', 1, '2023-09-25 07:05:10', '2023-09-25 07:05:10'),
(52, 122, 11, 'delete', 'admin.category.destroy', 1, '2023-09-25 07:05:15', '2023-09-25 07:05:15'),
(53, 123, 10, 'create', 'admin.store.create', 1, '2023-09-25 07:05:43', '2023-09-25 07:05:43'),
(54, 124, 10, 'store', 'admin.store.store', 1, '2023-09-25 07:05:51', '2023-09-25 07:05:51'),
(55, 125, 10, 'edit', 'admin.store.edit', 1, '2023-09-25 07:05:55', '2023-09-25 07:05:55'),
(56, 126, 10, 'update', 'admin.store.update', 1, '2023-09-25 07:06:00', '2023-09-25 07:06:00'),
(57, 127, 10, 'delete', 'admin.store.destroy', 1, '2023-09-25 07:06:05', '2023-09-25 07:06:05'),
(58, 128, 6, 'create', 'admin.user.create', 1, '2023-09-25 07:06:29', '2023-09-25 07:06:29'),
(59, 129, 6, 'store', 'admin.user.store', 1, '2023-09-25 07:06:33', '2023-09-25 07:06:33'),
(60, 130, 6, 'edit', 'admin.user.edit', 1, '2023-09-25 07:06:37', '2023-09-25 07:06:37'),
(61, 131, 6, 'update', 'admin.user.update', 1, '2023-09-25 07:06:42', '2023-09-25 07:06:42'),
(62, 132, 6, 'delete', 'admin.user.destroy', 1, '2023-09-25 07:06:47', '2023-09-25 07:06:47'),
(63, 133, 5, 'create', 'admin.role.create', 1, '2023-09-25 07:07:07', '2023-09-25 07:07:07'),
(64, 134, 5, 'store', 'admin.role.store', 1, '2023-09-25 07:07:12', '2023-09-25 07:07:12'),
(65, 135, 5, 'edit', 'admin.role.edit', 1, '2023-09-25 07:07:17', '2023-09-25 07:07:17'),
(66, 136, 5, 'update', 'admin.role.update', 1, '2023-09-25 07:07:23', '2023-09-25 07:07:23'),
(67, 137, 5, 'delete', 'admin.role.destroy', 1, '2023-09-25 07:07:28', '2023-09-25 07:07:28'),
(68, 138, 4, 'create', 'admin.branch.create', 1, '2023-09-25 07:07:44', '2023-09-25 07:07:44'),
(69, 139, 4, 'store', 'admin.branch.store', 1, '2023-09-25 07:08:29', '2023-09-25 07:08:29'),
(70, 140, 4, 'edit', 'admin.branch.edit', 1, '2023-09-25 07:08:34', '2023-09-25 07:08:34'),
(71, 141, 4, 'update', 'admin.branch.update', 1, '2023-09-25 07:08:39', '2023-09-25 07:08:39'),
(72, 142, 4, 'delete', 'admin.branch.destroy', 1, '2023-09-25 07:08:44', '2023-09-25 07:08:44'),
(73, 143, 3, 'create', 'admin.company.create', 1, '2023-09-25 07:09:19', '2023-09-25 07:09:19'),
(74, 144, 3, 'store', 'admin.company.store', 1, '2023-09-25 07:09:24', '2023-09-25 07:09:24'),
(75, 145, 3, 'edit', 'admin.company.edit', 1, '2023-09-25 07:09:31', '2023-09-25 07:09:31'),
(76, 146, 3, 'update', 'admin.company.update', 1, '2023-09-25 07:09:36', '2023-09-25 07:09:36'),
(77, 147, 3, 'delete', 'admin.company.destroy', 1, '2023-09-25 07:09:41', '2023-09-25 07:09:41'),
(78, 148, 9, 'create', 'admin.group.create', 1, '2023-09-25 07:51:05', '2023-09-25 07:51:05'),
(79, 149, 9, 'store', 'admin.group.store', 1, '2023-09-25 07:51:10', '2023-09-25 07:51:10'),
(80, 150, 9, 'edit', 'admin.group.edit', 1, '2023-09-25 07:51:14', '2023-09-25 07:51:14'),
(81, 151, 9, 'update', 'admin.group.update', 1, '2023-09-25 07:51:20', '2023-09-25 07:51:20'),
(82, 152, 9, 'delete', 'admin.group.destroy', 1, '2023-09-25 07:51:28', '2023-09-25 07:51:28'),
(83, 153, 42, 'create', 'admin.client.create', 1, '2023-09-25 10:09:28', '2023-09-25 10:09:28'),
(84, 154, 42, 'store', 'admin.client.store', 1, '2023-09-25 10:09:33', '2023-09-25 10:09:33'),
(85, 155, 42, 'edit', 'admin.client.edit', 1, '2023-09-25 10:09:38', '2023-09-25 10:09:38'),
(86, 156, 42, 'update', 'admin.client.update', 1, '2023-09-25 10:09:42', '2023-09-25 10:09:42'),
(87, 157, 42, 'delete', 'admin.client.destroy', 1, '2023-09-25 10:09:49', '2023-09-25 10:09:49'),
(88, 158, 12, 'create', 'admin.product.create', 1, '2023-09-25 14:14:40', '2023-09-25 14:14:40'),
(89, 159, 12, 'store', 'admin.product.store', 1, '2023-09-25 14:14:46', '2023-09-25 14:14:46'),
(90, 160, 12, 'edit', 'admin.product.edit', 1, '2023-09-25 14:14:50', '2023-09-25 14:14:50'),
(91, 161, 12, 'update', 'admin.product.update', 1, '2023-09-25 14:14:55', '2023-09-25 14:14:55'),
(92, 162, 12, 'delete', 'admin.product.destroy', 1, '2023-09-25 14:15:02', '2023-09-25 14:15:02'),
(93, 163, 16, 'create', 'admin.group-target.create', 1, '2023-09-25 15:12:45', '2023-09-25 15:12:45'),
(94, 164, 16, 'store', 'admin.group-target.store', 1, '2023-09-25 15:12:50', '2023-09-25 15:12:50'),
(95, 165, 16, 'edit', 'admin.group-target.edit', 1, '2023-09-25 15:12:55', '2023-09-25 15:12:55'),
(96, 166, 16, 'update', 'admin.group-target.update', 1, '2023-09-25 15:13:02', '2023-09-25 15:13:02'),
(97, 167, 16, 'delete', 'admin.group-target.destroy', 1, '2023-09-25 15:13:32', '2023-09-25 15:13:32'),
(98, 169, 71, 'create', 'admin.vehicle.create', 1, '2023-09-28 06:49:24', '2023-09-28 06:49:24'),
(99, 170, 71, 'store', 'admin.vehicle.store', 1, '2023-09-28 06:49:29', '2023-09-28 06:49:29'),
(100, 171, 71, 'edit', 'admin.vehicle.edit', 1, '2023-09-28 06:49:33', '2023-09-28 06:49:33'),
(101, 172, 71, 'update', 'admin.vehicle.update', 1, '2023-09-28 06:49:38', '2023-09-28 06:49:38'),
(102, 173, 71, 'delete', 'admin.vehicle.destroy', 1, '2023-09-28 06:49:44', '2023-09-28 06:49:44'),
(103, 175, 21, 'create', 'admin.lifting.create', 1, '2023-09-30 11:29:14', '2023-09-30 11:29:14'),
(104, 176, 21, 'store', 'admin.lifting.store', 1, '2023-09-30 11:29:19', '2023-09-30 11:29:19'),
(105, 177, 21, 'edit', 'admin.lifting.edit', 1, '2023-09-30 11:29:23', '2023-09-30 11:29:23'),
(106, 178, 21, 'update', 'admin.lifting.update', 1, '2023-09-30 11:29:28', '2023-09-30 11:29:28'),
(107, 179, 21, 'delete', 'admin.lifting.destroy', 1, '2023-09-30 11:29:33', '2023-09-30 11:29:33'),
(108, 191, 74, 'create', 'admin.slider.create', 1, '2023-10-08 15:28:49', '2023-10-08 15:28:49'),
(109, 192, 74, 'store', 'admin.slider.store', 1, '2023-10-08 15:28:54', '2023-10-08 15:28:54'),
(110, 193, 74, 'edit', 'admin.slider.edit', 1, '2023-10-08 15:28:59', '2023-10-08 15:28:59'),
(111, 194, 74, 'update', 'admin.slider.update', 1, '2023-10-08 15:29:07', '2023-10-08 15:29:07'),
(112, 195, 74, 'delete', 'admin.slider.destroy', 1, '2023-10-08 15:29:15', '2023-10-08 15:29:15'),
(128, 211, 81, 'create', 'admin.client-message.create', 1, '2023-10-08 15:34:31', '2023-10-08 15:34:31'),
(129, 212, 81, 'store', 'admin.client-message.store', 1, '2023-10-08 15:34:36', '2023-10-08 15:34:36'),
(130, 213, 81, 'edit', 'admin.client-message.edit', 1, '2023-10-08 15:34:40', '2023-10-08 15:34:40'),
(131, 214, 81, 'update', 'admin.client-message.update', 1, '2023-10-08 15:34:44', '2023-10-08 15:34:44'),
(132, 215, 81, 'delete', 'admin.client-message.destroy', 1, '2023-10-08 15:34:49', '2023-10-08 15:34:49'),
(143, 227, 64, 'create', 'admin.offline-order.create', 1, '2023-10-09 03:43:02', '2023-10-09 03:43:02'),
(144, 228, 64, 'store', 'admin.offline-order.store', 1, '2023-10-09 03:43:07', '2023-10-09 03:43:07'),
(145, 229, 64, 'edit', 'admin.offline-order.edit', 1, '2023-10-09 03:43:11', '2023-10-09 03:43:11'),
(146, 230, 64, 'update', 'admin.offline-order.update', 1, '2023-10-09 03:43:19', '2023-10-09 03:43:19'),
(147, 231, 64, 'delete', 'admin.offline-order.destroy', 1, '2023-10-09 03:43:25', '2023-10-09 03:43:25'),
(148, 232, 64, 'print', 'admin.offline-order.show', 1, '2023-10-10 14:19:37', '2023-10-10 14:19:37'),
(149, 233, 43, 'create', 'admin.sales.create', 1, '2023-10-11 08:10:17', '2023-10-11 08:10:17'),
(150, 234, 43, 'store', 'admin.sales.store', 1, '2023-10-11 08:10:22', '2023-10-11 08:10:22'),
(151, 235, 43, 'edit', 'admin.sales.edit', 1, '2023-10-11 08:10:27', '2023-10-11 08:10:27'),
(152, 236, 43, 'update', 'admin.sales.update', 1, '2023-10-11 08:10:32', '2023-10-11 08:10:32'),
(153, 237, 43, 'delete', 'admin.sales.destroy', 1, '2023-10-11 08:10:37', '2023-10-11 08:10:37'),
(154, 238, 44, 'create', 'admin.collection.create', 1, '2023-10-14 16:50:47', '2023-10-14 16:50:47'),
(155, 239, 44, 'store', 'admin.collection.store', 1, '2023-10-14 16:50:51', '2023-10-14 16:50:51'),
(156, 240, 44, 'edit', 'admin.collection.edit', 1, '2023-10-14 16:50:56', '2023-10-14 16:50:56'),
(157, 241, 44, 'update', 'admin.collection.update', 1, '2023-10-14 16:51:00', '2023-10-14 16:51:00'),
(158, 242, 44, 'delete', 'admin.collection.destroy', 1, '2023-10-14 16:51:05', '2023-10-14 16:51:05'),
(159, 243, 46, 'create', 'admin.sales-return.create', 1, '2023-10-15 06:43:17', '2023-10-15 06:43:17'),
(160, 244, 46, 'store', 'admin.sales-return.store', 1, '2023-10-15 06:43:24', '2023-10-15 06:43:24'),
(161, 245, 46, 'edit', 'admin.sales-return.edit', 1, '2023-10-15 06:43:29', '2023-10-15 06:43:29'),
(162, 246, 46, 'update', 'admin.sales-return.update', 1, '2023-10-15 06:43:34', '2023-10-15 06:43:34'),
(163, 247, 46, 'delete', 'admin.sales-return.destroy', 1, '2023-10-15 06:43:39', '2023-10-15 06:43:39'),
(169, 253, 23, 'create', 'admin.vendor-payment.create', 1, '2023-10-16 09:19:38', '2023-10-16 09:19:38'),
(170, 254, 23, 'store', 'admin.vendor-payment.store', 1, '2023-10-16 09:19:42', '2023-10-16 09:19:42'),
(171, 255, 23, 'edit', 'admin.vendor-payment.edit', 1, '2023-10-16 09:19:46', '2023-10-16 09:19:46'),
(172, 256, 23, 'update', 'admin.vendor-payment.update', 1, '2023-10-16 09:19:51', '2023-10-16 09:19:51'),
(173, 257, 23, 'delete', 'admin.vendor-payment.destroy', 1, '2023-10-16 09:20:00', '2023-10-16 09:20:00'),
(182, 266, 47, 'View', 'admin.return-approve.show', 1, '2023-10-18 12:04:48', '2023-10-18 12:04:48'),
(183, 267, 47, 'Approve', 'admin.return-approve.edit', 1, '2023-10-18 12:05:03', '2023-10-18 12:05:03'),
(184, 268, 47, 'Reject', 'admin.return-approve.destroy', 1, '2023-10-18 12:05:12', '2023-10-18 12:05:12'),
(185, 269, 66, 'edit', 'admin.delivery.edit', 1, '2023-11-07 06:58:42', '2023-11-07 06:58:42'),
(186, 270, 66, 'store', 'admin.delivery.store', 1, '2023-11-07 07:01:19', '2023-11-07 07:01:19'),
(187, 271, 66, 'update', 'admin.delivery.update', 1, '2023-11-07 07:01:31', '2023-11-07 07:01:31'),
(188, 272, 66, 'delete', 'admin.delivery.destroy', 1, '2023-11-07 07:01:37', '2023-11-07 07:01:37'),
(189, 273, 66, 'create', 'admin.delivery.create', 1, '2023-11-07 08:01:58', '2023-11-07 08:01:58'),
(192, 276, 5, 'Permission Edit', 'admin.rolePermission.edit', 1, '2023-11-09 04:05:15', '2023-11-09 04:05:15'),
(193, 277, 5, 'Permission Update', 'admin.rolePermission.update', 1, '2023-11-09 04:05:28', '2023-11-09 04:05:28'),
(202, 286, 17, 'create', 'admin.client-price.create', 1, '2023-11-10 13:15:05', '2023-11-10 13:15:05'),
(203, 287, 17, 'store', 'admin.client-price.store', 1, '2023-11-10 13:15:12', '2023-11-10 13:15:12'),
(204, 288, 17, 'edit', 'admin.client-price.edit', 1, '2023-11-10 13:15:40', '2023-11-10 13:15:40'),
(205, 289, 17, 'update', 'admin.client-price.update', 1, '2023-11-10 13:15:44', '2023-11-10 13:15:44'),
(206, 290, 17, 'delete', 'admin.client-price.destroy', 1, '2023-11-10 13:15:50', '2023-11-10 13:15:50'),
(207, 293, 85, 'view', 'admin.online-order.edit', 1, '2023-11-16 12:01:31', '2023-11-16 12:01:31'),
(208, 294, 85, 'print', 'admin.online-order.show', 1, '2023-11-16 12:01:39', '2023-11-16 12:01:39'),
(211, 300, 89, 'Approve', 'admin.cancel-order.approve', 1, '2023-11-19 17:06:43', '2023-11-19 17:06:43'),
(212, 302, 90, 'create', 'admin.online-order-delivery.create', 1, '2023-11-19 17:08:03', '2023-11-19 17:08:03'),
(213, 303, 90, 'store', 'admin.online-order-delivery.store', 1, '2023-11-19 17:08:08', '2023-11-19 17:08:08'),
(214, 304, 90, 'edit', 'admin.online-order-delivery.edit', 1, '2023-11-19 17:08:12', '2023-11-19 17:08:12'),
(215, 305, 90, 'update', 'admin.online-order-delivery.update', 1, '2023-11-19 17:08:22', '2023-11-19 17:08:22'),
(216, 306, 90, 'delete', 'admin.online-order-delivery.destroy', 1, '2023-11-19 17:08:29', '2023-11-19 17:08:29'),
(217, 307, 90, 'print', 'admin.online-order-delivery.show', 1, '2023-11-19 17:09:04', '2023-11-19 17:09:04'),
(218, 309, 91, 'Update', 'admin.delivery-charge.update', 1, '2023-11-19 17:10:16', '2023-11-19 17:10:16'),
(225, 323, 45, 'create', 'admin.bulk-collection.create', 1, '2023-11-23 04:57:03', '2023-11-23 04:57:03'),
(226, 324, 45, 'store', 'admin.bulk-collection.store', 1, '2023-11-23 04:57:09', '2023-11-23 04:57:09'),
(227, 325, 45, 'edit', 'admin.bulk-collection.edit', 1, '2023-11-23 04:57:14', '2023-11-23 04:57:14'),
(228, 326, 45, 'update', 'admin.bulk-collection.update', 1, '2023-11-23 04:57:20', '2023-11-23 04:57:20'),
(229, 327, 45, 'delete', 'admin.bulk-collection.destroy', 1, '2023-11-23 04:57:29', '2023-11-23 04:57:29'),
(230, 328, 6, 'edit password', 'admin.user.password', 1, '2023-11-26 05:57:38', '2023-11-26 05:57:38'),
(231, 329, 6, 'update password', 'admin.user.password-update', 1, '2023-11-26 05:58:21', '2023-11-26 05:58:21'),
(232, 344, 105, 'store', 'admin.coa-setup.store', 1, '2023-12-13 12:12:03', '2023-12-13 12:12:03'),
(233, 345, 105, 'edit', 'admin.coa-setup.edit', 1, '2023-12-13 12:12:10', '2023-12-13 12:12:10'),
(234, 346, 105, 'update', 'admin.coa-setup.update', 1, '2023-12-13 12:12:17', '2023-12-13 12:12:17'),
(235, 347, 105, 'delete', 'admin.coa-setup.destroy', 1, '2023-12-13 12:12:25', '2023-12-13 12:12:25'),
(236, 348, 106, 'create', 'admin.debit-voucher-entry.create', 1, '2023-12-13 12:13:07', '2023-12-13 12:13:07'),
(237, 349, 106, 'store', 'admin.debit-voucher-entry.store', 1, '2023-12-13 12:13:16', '2023-12-13 12:13:16'),
(238, 350, 106, 'edit', 'admin.debit-voucher-entry.edit', 1, '2023-12-13 12:13:24', '2023-12-13 12:13:24'),
(239, 351, 106, 'update', 'admin.debit-voucher-entry.update', 1, '2023-12-13 12:13:31', '2023-12-13 12:13:31'),
(240, 352, 106, 'delete', 'admin.debit-voucher-entry.destroy', 1, '2023-12-13 12:13:38', '2023-12-13 12:13:38'),
(241, 353, 107, 'create', 'admin.credit-voucher-entry.create', 1, '2023-12-13 12:13:58', '2023-12-13 12:13:58'),
(242, 354, 107, 'store', 'admin.credit-voucher-entry.store', 1, '2023-12-13 12:14:08', '2023-12-13 12:14:08'),
(243, 355, 107, 'edit', 'admin.credit-voucher-entry.edit', 1, '2023-12-13 12:14:14', '2023-12-13 12:14:14'),
(244, 356, 107, 'update', 'admin.credit-voucher-entry.update', 1, '2023-12-13 12:14:21', '2023-12-13 12:14:21'),
(245, 357, 107, 'delete', 'admin.credit-voucher-entry.destroy', 1, '2023-12-13 12:14:27', '2023-12-13 12:14:27'),
(246, 358, 108, 'create', 'admin.journal-voucher-entry.create', 1, '2023-12-13 12:14:55', '2023-12-13 12:14:55'),
(247, 359, 108, 'store', 'admin.journal-voucher-entry.store', 1, '2023-12-13 12:15:01', '2023-12-13 12:15:01'),
(248, 360, 108, 'edit', 'admin.journal-voucher-entry.edit', 1, '2023-12-13 12:15:06', '2023-12-13 12:15:06'),
(249, 361, 108, 'update', 'admin.journal-voucher-entry.update', 1, '2023-12-13 12:15:12', '2023-12-13 12:15:12'),
(250, 362, 108, 'delete', 'admin.journal-voucher-entry.destroy', 1, '2023-12-13 12:15:18', '2023-12-13 12:15:18'),
(251, 363, 109, 'view', 'admin.voucher-approve.show', 1, '2023-12-13 12:16:48', '2023-12-13 12:16:48'),
(252, 364, 109, 'approve', 'admin.voucher-approve.edit', 1, '2023-12-13 12:16:56', '2023-12-13 12:16:56'),
(253, 365, 110, 'View', 'admin.voucher-reject.show', 1, '2023-12-13 12:17:48', '2023-12-13 12:17:48'),
(254, 366, 110, 'Refuse', 'admin.voucher-reject.edit', 1, '2023-12-13 12:18:00', '2023-12-13 12:18:00'),
(257, 369, 112, 'view', 'admin.automation-reject.show', 1, '2023-12-13 12:19:47', '2023-12-13 12:19:47'),
(258, 370, 112, 'Refuse', 'admin.automation-reject.edit', 1, '2023-12-13 12:19:54', '2023-12-13 12:20:22'),
(264, 395, 130, 'create', 'admin.size.create', 1, '2024-04-16 16:44:38', '2024-04-16 16:44:38'),
(265, 396, 130, 'store', 'admin.size.store', 1, '2024-04-16 16:44:43', '2024-04-16 16:44:43'),
(266, 397, 130, 'edit', 'admin.size.edit', 1, '2024-04-16 16:44:50', '2024-04-16 16:44:50'),
(267, 398, 130, 'update', 'admin.size.update', 1, '2024-04-16 16:44:55', '2024-04-16 16:44:55'),
(268, 399, 130, 'delete', 'admin.size.destroy', 1, '2024-04-16 16:45:02', '2024-04-16 16:45:02'),
(269, 400, 131, 'create', 'admin.color.create', 1, '2024-04-16 16:47:21', '2024-04-16 16:47:21'),
(270, 401, 131, 'store', 'admin.color.store', 1, '2024-04-16 16:47:28', '2024-04-16 16:47:28'),
(271, 402, 131, 'edit', 'admin.color.edit', 1, '2024-04-16 16:47:32', '2024-04-16 16:47:32'),
(272, 403, 131, 'update', 'admin.color.update', 1, '2024-04-16 16:47:38', '2024-04-16 16:47:38'),
(273, 404, 131, 'delete', 'admin.color.destroy', 1, '2024-04-16 16:47:45', '2024-04-16 16:47:45'),
(291, 425, 43, 'search edit', 'admin.sales.search-edit', 1, '2024-06-05 06:15:09', '2024-06-05 06:15:09'),
(292, 426, 66, 'vehicle start', 'admin.delivery.delivered', 1, '2024-06-06 13:22:34', '2024-06-06 13:22:34'),
(293, 428, 135, 'create', 'admin.menu.create', 1, '2024-06-23 04:19:24', '2024-06-23 04:19:24'),
(294, 429, 135, 'store', 'admin.menu.store', 1, '2024-06-23 04:19:31', '2024-06-23 04:19:31'),
(295, 430, 135, 'edit', 'admin.menu.edit', 1, '2024-06-23 04:19:36', '2024-06-23 04:19:36'),
(296, 431, 135, 'update', 'admin.menu.update', 1, '2024-06-23 04:19:43', '2024-06-23 04:19:43'),
(297, 432, 135, 'delete', 'admin.menu.destroy', 1, '2024-06-23 04:19:51', '2024-06-23 04:19:51'),
(298, 433, 135, 'view items', 'admin.menu-item.index', 1, '2024-06-23 04:25:39', '2024-06-23 04:25:39'),
(299, 434, 135, 'update items', 'admin.menu-item.update', 1, '2024-06-23 04:25:47', '2024-06-23 04:25:47'),
(300, 435, 135, 'serialize items', 'admin.menu-item.serialize', 1, '2024-06-23 04:27:02', '2024-06-23 04:27:02'),
(301, 436, 135, 'delete item', 'admin.menu-item.destroy', 1, '2024-06-23 04:27:40', '2024-06-23 04:27:40'),
(302, 437, 12, 'update attribute', 'admin.product.attributes', 1, '2024-06-23 11:11:49', '2024-06-23 11:11:49'),
(303, 439, 136, 'create', 'admin.sections.create', 1, '2024-06-23 12:15:14', '2024-06-23 12:15:14'),
(304, 440, 136, 'store', 'admin.sections.store', 1, '2024-06-23 12:15:18', '2024-06-23 12:15:18'),
(305, 441, 136, 'edit', 'admin.sections.edit', 1, '2024-06-23 12:15:22', '2024-06-23 12:15:22'),
(306, 442, 136, 'update', 'admin.sections.update', 1, '2024-06-23 12:15:27', '2024-06-23 12:15:27'),
(307, 443, 136, 'delete', 'admin.sections.destroy', 1, '2024-06-23 12:15:31', '2024-06-23 12:15:31'),
(367, 530, 163, 'create', 'admin.order.create', 1, '2024-08-31 17:47:26', '2024-08-31 17:47:26'),
(368, 531, 163, 'edit', 'admin.order.edit', 1, '2024-08-31 17:47:29', '2024-08-31 17:47:29'),
(369, 532, 163, 'delete', 'admin.order.destroy', 1, '2024-08-31 17:47:34', '2024-08-31 17:47:34'),
(370, 535, 165, 'create', 'admin.order-return.create', 1, '2024-09-09 11:38:29', '2024-09-09 11:38:29'),
(371, 536, 165, 'edit', 'admin.order-return.edit', 1, '2024-09-09 11:38:35', '2024-09-09 11:38:35'),
(372, 537, 165, 'delete', 'admin.order-return.destroy', 1, '2024-09-09 11:38:40', '2024-09-09 11:38:40'),
(373, 540, 1, 'edit status', 'admin.order-dashboard.edit', 1, '2024-09-11 04:31:15', '2024-09-11 04:31:15'),
(374, 541, 167, 'Single Area Orders', 'admin.areawise-order.index', 1, '2024-09-11 06:01:15', '2024-09-11 06:01:15'),
(375, 542, 1, 'update status', 'admin.order-dashboard.update', 1, '2024-09-11 10:31:37', '2024-09-11 10:31:37'),
(379, 551, 172, 'create', 'admin.order-assign.create', 1, '2024-09-23 13:09:24', '2024-09-23 13:09:24'),
(380, 552, 172, 'edit', 'admin.order-assign.edit', 1, '2024-09-23 13:09:28', '2024-09-23 13:09:28'),
(381, 553, 172, 'delete', 'admin.order-assign.destroy', 1, '2024-09-23 13:09:33', '2024-09-23 13:09:33'),
(395, 585, 190, 'view details', 'admin.receive-payment-head-details.index', 1, '2024-10-31 15:07:18', '2024-10-31 15:07:18'),
(396, 587, 191, 'create', 'admin.pre-order.create', 1, '2024-11-05 06:24:18', '2024-11-05 06:24:18'),
(397, 588, 191, 'edit', 'admin.pre-order.edit', 1, '2024-11-05 06:24:26', '2024-11-05 06:24:26'),
(398, 589, 191, 'delete', 'admin.pre-order.destroy', 1, '2024-11-05 06:24:34', '2024-11-05 06:24:34'),
(402, 598, 196, 'create', 'admin.retail-return.create', 1, '2025-05-13 08:44:52', '2025-05-13 08:44:52'),
(403, 599, 196, 'edit', 'admin.retail-return.edit', 1, '2025-05-13 08:44:56', '2025-05-13 08:44:56'),
(404, 600, 196, 'delete', 'admin.retail-return.destroy', 1, '2025-05-13 08:45:01', '2025-05-13 08:45:01'),
(405, 601, 1, 'Customer', 'Customer', 1, '2025-05-26 08:53:59', '2025-05-26 08:53:59'),
(406, 602, 1, 'Total Sale', 'Total Sale', 1, '2025-05-26 08:54:05', '2025-05-26 08:54:05'),
(407, 603, 1, 'Cash In', 'Cash In', 1, '2025-05-26 08:54:10', '2025-05-26 08:54:10'),
(408, 604, 1, 'Due', 'Due', 1, '2025-05-26 08:54:16', '2025-05-26 08:54:16'),
(409, 605, 1, 'Total Products', 'Total Products', 1, '2025-05-26 08:54:21', '2025-05-26 08:54:21'),
(410, 606, 1, 'Stock Value', 'Stock Value', 1, '2025-05-26 08:54:26', '2025-05-26 08:54:26'),
(411, 607, 1, 'Payment Due', 'Payment Due', 1, '2025-05-26 08:54:31', '2025-05-26 08:54:31'),
(412, 608, 1, 'Outstanding', 'Outstanding', 1, '2025-05-26 08:54:36', '2025-05-26 08:54:36'),
(414, 667, 202, 'edit', 'admin.lead-source.edit', 1, '2026-07-19 11:06:55', '2026-07-19 11:06:55'),
(415, 668, 202, 'create', 'admin.lead-source.create', 1, '2026-07-20 08:31:25', '2026-07-20 08:31:25'),
(416, 669, 203, 'create', 'admin.lead-status.create', 1, '2026-07-20 09:14:43', '2026-07-20 09:14:43'),
(417, 670, 203, 'edit', 'admin.lead-status.edit', 1, '2026-07-20 09:14:55', '2026-07-20 09:14:55'),
(418, 671, 200, 'create', 'admin.lead.create', 1, '2026-07-20 10:52:20', '2026-07-20 10:52:20'),
(419, 672, 200, 'edit', 'admin.lead.edit', 1, '2026-07-20 10:52:31', '2026-07-20 10:52:31'),
(420, 673, 200, 'show', 'admin.lead.show', 1, '2026-07-20 11:06:30', '2026-07-20 11:06:30'),
(421, 674, 200, 'store', 'admin.lead.store', 1, '2026-07-20 11:35:06', '2026-07-20 11:35:06'),
(422, 675, 200, 'update', 'admin.lead.update', 1, '2026-07-20 11:35:19', '2026-07-20 11:35:19'),
(423, 677, 208, 'create', 'admin.meeting-schedule.create', 1, '2026-07-22 09:59:07', '2026-07-22 09:59:07'),
(424, 678, 208, 'edit', 'admin.meeting-schedule.edit', 1, '2026-07-22 09:59:21', '2026-07-22 09:59:21'),
(425, 679, 211, 'edit', 'admin.quotation.edit', 1, '2026-07-23 09:00:34', '2026-07-23 09:00:34'),
(426, 680, 211, 'show', 'admin.quotation.show', 1, '2026-07-23 09:00:49', '2026-07-23 09:00:49'),
(427, 681, 211, 'create', 'admin.quotation.create', 1, '2026-07-23 09:01:04', '2026-07-23 09:01:04'),
(429, 683, 254, 'edit', 'admin.customer-requirement.edit', 1, '2026-07-27 05:37:52', '2026-07-27 05:37:52'),
(430, 684, 254, 'create', 'admin.customer-requirement.create', 1, '2026-07-27 05:38:06', '2026-07-27 05:38:06'),
(431, 685, 254, 'show', 'admin.customer-requirement.show', 1, '2026-07-27 06:53:16', '2026-07-27 06:53:16'),
(432, 686, 201, 'create', 'admin.employee.create', 1, '2026-07-28 05:41:58', '2026-07-28 05:41:58'),
(433, 687, 201, 'edit', 'admin.employee.edit', 1, '2026-07-28 05:42:10', '2026-07-28 05:42:10'),
(434, 688, 225, 'create', 'admin.employee-attendance.create', 1, '2026-07-28 11:40:14', '2026-07-28 11:40:14'),
(435, 690, 225, 'edit', 'admin.employee-attendance.edit', 1, '2026-07-28 11:40:31', '2026-07-28 11:40:31'),
(436, 691, 226, 'edit', 'admin.employee-leave.edit', 1, '2026-07-29 06:56:42', '2026-07-29 06:56:42'),
(437, 692, 228, 'edit', 'admin.holiday.edit', 1, '2026-07-29 08:34:42', '2026-07-29 08:34:42'),
(438, 693, 231, 'edit', 'admin.payroll.edit', 1, '2026-07-29 10:10:02', '2026-07-29 10:10:02'),
(439, 694, 231, 'pay', 'admin.payroll.update-status', 1, '2026-08-04 04:27:47', '2026-08-04 04:27:47'),
(440, 695, 232, 'certificate', 'admin.salary.structure.certificate', 1, '2026-08-04 06:30:26', '2026-08-04 06:30:26'),
(441, 696, 237, 'create', 'admin.employee-bonus.create', 1, '2026-08-06 04:54:43', '2026-08-06 04:54:43'),
(442, 697, 237, 'edit', 'admin.employee-bonus.edit', 1, '2026-08-06 05:44:17', '2026-08-06 05:44:17'),
(443, 698, 238, 'create', 'admin.employee-increment.create', 1, '2026-08-06 06:04:15', '2026-08-06 06:04:15'),
(444, 699, 238, 'edit', 'admin.employee-increment.edit', 1, '2026-08-06 06:04:28', '2026-08-06 06:04:28'),
(445, 700, 239, 'create', 'admin.employee-loan.create', 1, '2026-08-06 06:36:45', '2026-08-06 06:36:45'),
(446, 701, 239, 'edit', 'admin.employee-loan.edit', 1, '2026-08-06 06:36:55', '2026-08-06 06:36:55'),
(447, 702, 241, 'create', 'admin.employee-overtime.create', 1, '2026-08-09 04:55:52', '2026-08-09 04:55:52'),
(448, 703, 241, 'edit', 'admin.employee-overtime.edit', 1, '2026-08-09 04:56:03', '2026-08-09 04:56:03'),
(449, 704, 242, 'create', 'admin.expense.create', 1, '2026-08-09 06:09:36', '2026-08-09 06:09:36'),
(450, 705, 242, 'edit', 'admin.expense.edit', 1, '2026-08-09 06:09:48', '2026-08-09 06:09:48'),
(451, 706, 243, 'create', 'admin.documents.create', 1, '2026-08-09 06:54:09', '2026-08-09 06:54:09'),
(452, 707, 243, 'edit', 'admin.documents.edit', 1, '2026-08-09 06:54:20', '2026-08-09 06:54:20'),
(455, 710, 245, 'create', 'admin.termination.create', 1, '2026-08-09 09:29:25', '2026-08-09 09:29:25'),
(456, 711, 245, 'edit', 'admin.termination.edit', 1, '2026-08-09 09:29:37', '2026-08-09 09:29:37'),
(457, 712, 249, 'create', 'admin.appraisal.create', 1, '2026-08-09 10:26:53', '2026-08-09 10:26:53'),
(458, 713, 249, 'edit', 'admin.appraisal.edit', 1, '2026-08-09 10:27:06', '2026-08-09 10:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `secondary_color` varchar(255) DEFAULT NULL,
  `template_status` varchar(255) DEFAULT NULL,
  `body_bg` varchar(255) DEFAULT NULL,
  `card_bg` varchar(255) DEFAULT NULL,
  `title_bg` varchar(255) DEFAULT NULL,
  `primary_bg` varchar(255) DEFAULT NULL,
  `secondary_bg` varchar(255) DEFAULT NULL,
  `text1_color` varchar(255) DEFAULT NULL,
  `text2_color` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) DEFAULT NULL,
  `accounting` tinyint(4) NOT NULL DEFAULT 0,
  `invest_value` decimal(16,0) NOT NULL DEFAULT 0,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `logo`, `favicon`, `title`, `footer_text`, `secondary_color`, `template_status`, `body_bg`, `card_bg`, `title_bg`, `primary_bg`, `secondary_bg`, `text1_color`, `text2_color`, `primary_color`, `accounting`, `invest_value`, `store_id`, `facebook`, `twitter`, `linkedin`, `whatsapp`, `google`, `created_at`, `updated_at`) VALUES
(1, 'media/admin-setting//2026-11-03-hvDmHaZfLoWTxTo0qG4Cdhzr9IdcMNvLibQP2qNm.webp', 'media/admin-setting//2026-11-03-Qf0nfmuESxKTXct6qTPMzMG6QkSkAIDMWuznhVwG.webp', 'SM Group BD | Sparkling Engineering Solution | Grison Power Engineering. | MSI Corporation International', '© 2025 Developed by <a target=\"_blank\" href=\"http://www.technoparkbd.com/\">Techno Park Bangladesh</a>', '#ff6505', 'template2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '#198754', 1, 50000, 2, NULL, NULL, 'linkedin link diben', 'whatsapp link diben', NULL, '2023-09-19 09:03:18', '2026-11-03 09:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `incharge_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `shipping_charge` decimal(16,0) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `company_id`, `region_id`, `code`, `name`, `incharge_name`, `phone`, `email`, `address`, `shipping_charge`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(17, 1, 13, 'PF', 'Area One', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 2, '2024-09-08 07:16:59', '2024-07-13 12:44:28', '2024-09-08 07:16:59'),
(18, 1, 13, '05', 'Basabo - Kodomtola', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-08 07:15:23', '2024-09-27 07:47:19'),
(19, 1, 13, '01', 'Rampura - Aftab Nagor', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-08 07:15:36', '2024-09-23 10:00:59'),
(20, 1, 13, '06', 'Badda - Bosundhora', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-08 07:15:54', '2024-09-27 07:46:49'),
(21, 1, 13, '02', 'Rampura Bonosree', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-08 07:16:13', '2024-09-23 10:01:37'),
(22, 1, 13, '07', 'Golshan - Niketon', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-08 07:16:29', '2024-09-23 10:03:34'),
(23, 1, 13, '04', 'Khilgao - Shajahanpur', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-08 07:17:19', '2024-09-23 10:02:15'),
(24, 1, 13, '09', 'Mogbazae - Mohanogor', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-09 04:48:07', '2024-09-23 10:04:17'),
(25, 1, 13, '08', 'Banani - Baridhara', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-11 11:56:06', '2024-09-27 07:46:21'),
(26, 1, 13, '03', 'Dokkhin Bonosree', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-11 11:57:20', '2024-09-23 10:01:54'),
(27, 1, 13, '10', 'Motiijhil - Ploton', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-14 03:33:14', '2024-09-23 10:04:32'),
(28, 1, 13, '11', 'MouChak - Malibag', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:05:04', '2024-09-23 10:05:04'),
(29, 1, 13, '12', 'Kakrail - Fokirapul', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-23 10:05:17', '2024-09-23 10:08:28'),
(30, 1, 13, '13', 'Razarbag - Arambag', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:05:30', '2024-09-23 10:05:30'),
(31, 1, 13, '14', 'Baily Road - Shantinogor', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-23 10:05:49', '2024-09-27 07:46:05'),
(32, 1, 13, '15', 'Uttora Sector', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:06:09', '2024-09-23 10:06:09'),
(33, 1, 13, '16', 'Uttor khan - Dokkhin Khan', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:06:49', '2024-09-23 10:06:49'),
(34, 1, 13, '17', 'Askona - Airport', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-23 10:07:26', '2024-09-27 07:40:19'),
(35, 1, 13, '17', 'Khilkhet - Nikunjo', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-23 10:07:59', '2024-09-27 07:47:05'),
(36, 1, 13, '18', 'Bosila - Arshinogor', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-23 10:08:52', '2024-09-27 07:46:13'),
(37, 1, 13, '19', 'Dhonmondi - Jigatola', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-23 10:09:08', '2024-09-24 06:47:08'),
(38, 1, 13, '19', 'Mohammodpur', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:09:25', '2024-09-23 10:09:25'),
(39, 1, 13, '21', 'Shamoly', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:09:47', '2024-09-23 10:09:47'),
(40, 1, 13, '22', 'Kolabagan - Panthopoth', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-23 10:10:22', '2024-09-23 10:11:01'),
(41, 1, 13, '24', 'Green Road Kathal Bagan', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:11:56', '2024-09-23 10:11:56'),
(42, 1, 13, '25', 'Firmgate RazaBazar', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:12:46', '2024-09-23 10:12:46'),
(43, 1, 13, '26', 'Shabag - Tejturi Bazar', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:13:08', '2024-09-23 10:13:08'),
(44, 1, 13, '28', 'Nakhal pata - Tajkuni para', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:13:26', '2024-09-23 10:13:26'),
(45, 1, 13, '29', 'Adabor - Shaker Tek', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-23 10:13:43', '2024-09-27 07:40:08'),
(46, 1, 13, '30', 'Kollanpur - Darussalam', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:14:08', '2024-09-23 10:14:08'),
(47, 1, 13, '31', 'Majar Road - Technical - Paik Para', NULL, NULL, NULL, NULL, 80, 1, 2, 2, NULL, NULL, '2024-09-23 10:14:28', '2024-09-27 07:47:45'),
(48, 1, 13, '28', 'Mirpur 1, 2, 6,7', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:15:10', '2024-09-23 10:15:10'),
(49, 1, 13, '26', 'Mirpur 10, 11', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:15:32', '2024-09-23 10:15:32'),
(50, 1, 13, '11', 'Mirpur 12 - Rupnagar', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:15:47', '2024-09-23 10:15:47'),
(51, 1, 13, '11', 'Mirpur 13,14', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:15:59', '2024-09-23 10:15:59'),
(52, 1, 13, '11', 'Mirpur DOHS', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:16:12', '2024-09-23 10:16:12'),
(53, 1, 13, '11', 'Sewrapara -Agargao', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:16:23', '2024-09-23 10:16:23'),
(54, 1, 13, '11', 'Matikata - VasanTach', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:16:36', '2024-09-23 10:16:36'),
(55, 1, 13, '11', 'Kalshi - ECB', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:16:52', '2024-09-23 10:16:52'),
(56, 1, 13, '11', 'Bongshal - Noyabazar', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-23 10:17:06', '2024-09-24 06:45:27'),
(57, 1, 13, '11', 'Lokkhi Bazar - Sodor ghat', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:17:19', '2024-09-23 10:17:19'),
(58, 1, 13, '11', 'Wari - Gupibag', NULL, NULL, NULL, NULL, 80, 1, 2, 2, 159, '2026-03-14 13:40:46', '2024-09-23 10:17:42', '2026-03-14 13:40:46'),
(59, 1, 13, '11', 'Grandaria - Doyagong', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:17:55', '2024-09-23 10:17:55'),
(60, 1, 13, '11', 'Mugda - Manda', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:18:13', '2024-09-23 10:18:13'),
(61, 1, 13, '11', 'Jatrabari - Sonir akhra', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:18:25', '2024-09-23 10:18:25'),
(62, 1, 13, '11', 'Rayerbag - Matuile', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-23 10:18:38', '2024-09-23 10:18:38'),
(63, 1, 13, '11', 'Demra - Sttaff Quater', NULL, NULL, NULL, NULL, 80, 1, 2, 2, 159, '2026-03-14 13:40:48', '2024-09-23 10:18:50', '2026-03-14 13:40:48'),
(64, 1, 13, '11', 'Jorain- Postogola', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-09-24 06:42:26', '2024-09-24 06:42:26'),
(65, 1, 13, '11', 'English Road - Babu Bazar', NULL, NULL, NULL, NULL, NULL, 1, 2, 2, NULL, NULL, '2024-09-24 06:43:04', '2024-09-24 06:45:50'),
(66, 1, 13, '66', 'Azimpur- Lalbag', NULL, NULL, NULL, NULL, 80, 1, 2, NULL, NULL, NULL, '2024-09-27 06:10:50', '2024-09-27 06:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `company_id`, `name`, `type`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 'Pcs', 'Consumer', 1, 1, NULL, NULL, NULL, '2023-09-29 03:29:41', '2026-09-17 06:23:15'),
(11, 1, 'KG', 'Consumer', 1, 2, 159, NULL, NULL, '2024-07-25 05:18:31', '2025-05-23 09:47:32'),
(12, 1, 'Gm', 'Consumer', 1, 159, 159, NULL, NULL, '2025-05-23 09:49:12', '2025-05-23 09:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `trade_license` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `prefix`, `name`, `contact_person`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'AHQ', 'Shankhari Bazar', 'Mamunur Rashid', 'sales@salestrackerbd.com', '01844000103', NULL, 'https://sahebbazaar.com/', NULL, NULL, 'zz', 'Dhaka', 1, 1, 1, 1, NULL, '2023-09-23 06:52:33', '2025-04-28 11:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_collections`
--

CREATE TABLE `bulk_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL DEFAULT 'Cash',
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bulk_collection_lists`
--

CREATE TABLE `bulk_collection_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulk_collection_id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_amount` decimal(16,2) NOT NULL,
  `paid_amount` decimal(16,2) NOT NULL,
  `money_receipt` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `order` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `show_frontend` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `company_id`, `parent_id`, `name`, `slug`, `image`, `meta_title`, `meta_keyword`, `meta_description`, `featured`, `order`, `status`, `show_frontend`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(31, 1, NULL, 'Chicken Item', 'chicken-item', NULL, 'Poultry', NULL, NULL, 0, 0, 1, 1, 1, 1, 2, '2025-04-27 12:15:44', '2024-07-07 11:44:44', '2025-04-27 12:15:44'),
(43, 1, NULL, 'Frozen & Canned Foods', 'frozen-canned-foods', 'media/category/2025-10-07-HZOejrqEI2nV6w6Q3lklRY11XMUG4oDzh1die7ur.webp', 'Frozen Ready Foods', 'Frozen Foods', 'Frozen meals can be a nutritious option, especially if they\'re filled with vegetables, lean proteins, and whole grains', 0, 0, 1, 0, 1, 159, NULL, NULL, '2024-07-07 12:21:19', '2025-10-07 11:08:27'),
(44, 1, NULL, 'Dairy & Egg', 'dairy-egg', NULL, 'Dairy', NULL, NULL, 0, 0, 1, 0, 1, 159, NULL, NULL, '2024-07-07 12:21:32', '2025-04-29 14:37:36'),
(46, 1, 31, 'Sub Category', 'sub-category', NULL, NULL, NULL, NULL, 0, 0, 1, 1, 1, NULL, 2, '2024-07-25 10:21:01', '2024-07-25 07:20:11', '2024-07-25 10:21:01'),
(47, 1, NULL, 'Health & Wellness', 'health-wellness', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 2, NULL, NULL, NULL, '2025-04-27 12:15:26', '2025-04-27 13:22:18'),
(48, 1, 47, 'Herbal & Digestive Aids', 'herbal-digestive-aids', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 2, NULL, NULL, NULL, '2025-04-27 12:16:26', '2025-04-27 12:16:26'),
(49, 1, NULL, 'Beverages', 'beverages', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-28 11:16:06', '2025-04-28 11:16:06'),
(50, 1, 49, 'Coffee', 'coffee', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-28 11:16:40', '2025-04-28 11:16:40'),
(51, 1, NULL, 'Break Fast', 'break-fast', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-28 14:39:26', '2025-04-28 14:39:26'),
(52, 1, 51, 'Cereals', 'cereals', NULL, 'Dry Food', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-04-28 14:40:57', '2025-04-28 14:41:10'),
(53, 1, NULL, 'Snakes', 'snakes', NULL, 'Dry Food', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-28 15:10:41', '2025-04-28 15:10:41'),
(54, 1, 53, 'Chips& Pretzels', 'chips-pretzels', NULL, 'Dry Food', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-28 15:13:16', '2025-04-28 15:13:16'),
(55, 1, NULL, 'Energy Boosters', 'energy-boosters', NULL, 'Energy Drink', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-04-28 15:32:42', '2025-05-04 20:08:46'),
(56, 1, 49, 'Syrups & Powder Drinks', 'syrups-powder-drinks', NULL, 'Powder Drinks', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-28 16:00:59', '2025-04-28 16:00:59'),
(57, 1, NULL, 'Cooking', 'cooking', NULL, 'Cooking', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 12:35:11', '2025-04-29 12:35:11'),
(58, 1, 57, 'Cooking Oil', 'cooking-oil', NULL, 'Health Oil', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-04-29 12:36:12', '2026-02-23 15:09:23'),
(59, 1, 57, 'Atta Maida & Suji', 'atta-maida-suji', NULL, 'Healthy floor', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 12:40:09', '2025-04-29 12:40:09'),
(60, 1, 49, 'Tea', 'tea', NULL, 'Healthy Tea', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 13:05:34', '2025-04-29 13:05:34'),
(61, 1, 57, 'Rice', 'rice', NULL, 'Rice', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 13:09:59', '2025-04-29 13:09:59'),
(62, 1, 44, 'Powder & Milk', 'powder-milk', NULL, 'Powder', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 14:38:43', '2025-04-29 14:38:43'),
(63, 1, NULL, 'Sauces & Pickles', 'sauces-pickles', NULL, 'Sauces & Pickles', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 15:57:06', '2025-04-29 15:57:06'),
(64, 1, NULL, 'Daibetes Care', 'daibetes-care', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 16:04:53', '2025-04-29 16:04:53'),
(65, 1, NULL, 'Baby Products', 'baby-products-3', NULL, 'Baby Products', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-04-29 16:05:54', '2026-02-25 15:09:51'),
(66, 1, 65, 'Baby Milk', 'baby-milk', NULL, 'Drink', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 16:06:42', '2025-04-29 16:06:42'),
(67, 1, 57, 'Salt & Suger', 'salt-suger', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-29 16:18:39', '2025-04-29 16:18:39'),
(68, 1, 57, 'Rice', 'rice-2', NULL, 'Rice', NULL, NULL, 0, 0, 1, 0, 159, 159, 159, '2025-04-29 16:36:35', '2025-04-29 16:32:54', '2025-04-29 16:36:35'),
(69, 1, 51, 'Dips, Spreads& Syrups', 'dips-spreads-syrups', NULL, 'Dips, Spreads& Syrups', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-30 06:27:30', '2025-04-30 06:27:30'),
(70, 1, 53, 'Local Snakes', 'local-snakes', NULL, 'Local Snakes', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-30 07:19:11', '2025-04-30 07:19:11'),
(71, 1, 53, 'Noodles', 'noodles', NULL, 'Noodles', 'Noodles', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-04-30 08:55:32', '2025-04-30 08:55:32'),
(72, 1, 51, 'Jams & Jellies', 'jams-jellies', NULL, 'Jams & Jellies', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-01 09:27:57', '2025-05-01 09:27:57'),
(73, 1, 63, 'Pickles', 'pickles', NULL, 'Pickles', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-01 10:26:33', '2025-05-01 10:26:33'),
(74, 1, 63, 'Cooking Sauces', 'cooking-sauces', NULL, 'Cooking Sauces', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-01 10:27:42', '2025-05-01 10:27:42'),
(75, 1, 63, 'Tomato Sauces', 'tomato-sauces', NULL, 'Tomato Sauces', 'Tomato Sauces', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-01 10:36:14', '2025-05-01 10:36:14'),
(76, 1, 51, 'Honey', 'honey', NULL, 'Honey', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 07:41:18', '2025-05-02 07:41:18'),
(77, 1, NULL, 'Cleaning Supplies', 'cleaning-supplies', NULL, 'Cleaning Supplies', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 10:02:26', '2025-05-02 10:02:26'),
(78, 1, 77, 'Air Fresheners', 'air-fresheners', NULL, 'Air Fresheners', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 10:03:51', '2025-05-02 10:03:51'),
(79, 1, NULL, 'Personal Care', 'personal-care', NULL, 'Personal Care', 'Personal Care', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 10:18:27', '2025-05-02 10:18:27'),
(80, 1, 79, 'Oral Care', 'oral-care', NULL, 'Oral Care', 'Oral Care', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 10:19:12', '2025-05-02 10:19:12'),
(81, 1, 57, 'Spices', 'spices', NULL, 'Spices', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 10:41:18', '2025-05-02 10:41:18'),
(82, 1, NULL, 'Home Accessories', 'home-accessories', NULL, 'Home', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-02 11:25:24', '2025-08-20 07:52:23'),
(83, 1, 82, 'Glass Set', 'glass-set', NULL, 'Glass Set', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-02 13:18:08', '2025-05-02 13:18:08'),
(84, 1, 57, 'Ready MIx', 'ready-mix', NULL, 'Ready MIx', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-03 15:15:22', '2025-05-03 15:15:22'),
(85, 1, 57, 'Shemai & Suji', 'shemai-suji', NULL, 'Shemai & Suji', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-04 05:43:31', '2025-05-04 05:43:54'),
(86, 1, 57, 'Colors & Flavours', 'colors-flavours', NULL, 'Colors & Flavours', NULL, 'Colors & Flavours', 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-04 05:52:48', '2025-05-04 05:52:48'),
(87, 1, 57, 'Ghee', 'ghee', NULL, 'Ghee', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-04 06:40:01', '2025-05-04 06:40:01'),
(88, 1, 77, 'Laundry', 'laundry', NULL, 'Laundry', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-04 07:40:23', '2025-05-04 07:40:23'),
(89, 1, 79, 'Body Soap', 'body-soap', NULL, 'Body Care', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-04 13:02:39', '2025-05-05 21:03:29'),
(90, 1, 77, 'Toilet Cleaners', 'toilet-cleaners', NULL, 'Toilet Cleaners', 'Toilet Cleaners', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-04 14:01:54', '2025-05-04 14:01:54'),
(91, 1, 77, 'Dishwashing Supplies', 'dishwashing-supplies', NULL, 'Dishwashing Supplies', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-04 14:27:59', '2025-05-04 14:27:59'),
(92, 1, 53, 'Soup', 'soup', NULL, 'Soup', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-05 07:00:40', '2025-05-05 07:01:03'),
(93, 1, 79, 'Tissue & Wipes & Towel', 'tissue-wipes-towel', NULL, 'Tissue & Wipes & Towel', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-05 19:53:04', '2025-05-20 13:23:05'),
(94, 1, 79, 'Hand Wash', 'hand-wash', NULL, 'Hand Cleaner', 'Hand Wash', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-05 21:18:20', '2025-05-05 21:18:20'),
(95, 1, 77, 'Pest Control', 'pest-control', NULL, 'Pest Control', NULL, NULL, 0, 0, 1, 0, 159, 160, NULL, NULL, '2025-05-05 21:39:00', '2026-02-28 06:58:22'),
(96, 1, 53, 'Biscuits & Cookies', 'biscuits-cookies', NULL, 'Cookies', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-08 11:50:12', '2025-05-08 11:50:12'),
(97, 1, 79, 'Woman care', 'woman-care', NULL, 'Woman care', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-09 07:53:57', '2025-05-09 07:53:57'),
(98, 1, 57, 'Special Ingredients', 'special-ingredients', NULL, 'Special Ingredients', 'Special Ingredients', NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-09 09:22:32', '2025-05-09 09:22:32'),
(99, 1, 57, 'Dal or Lentil', 'dal-or-lentil', NULL, 'Dal or Lentil', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-09 11:13:30', '2025-05-09 11:13:30'),
(100, 1, 53, 'Pasta & Macaroni', 'pasta-macaroni', NULL, 'Pasta & Macaroni', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-09 11:17:00', '2025-05-09 11:17:00'),
(101, 1, 43, 'Canned Foods', 'canned-foods', NULL, 'Canned Foods', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-09 13:44:57', '2025-05-09 13:44:57'),
(102, 1, 44, 'Butter & Sour Cream', 'butter-sour-cream', NULL, 'Butter & Sour Cream', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-09 14:11:05', '2025-05-09 14:11:05'),
(103, 1, 82, 'Italiano Set', 'italiano-set', NULL, 'Italiano Set', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-10 08:18:35', '2025-05-10 08:18:35'),
(104, 1, 79, 'Body & Hair Oil', 'body-hair-oil', NULL, 'Hair Care & Body Care', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-11 09:50:24', '2025-05-11 10:13:45'),
(105, 1, 79, 'Men\'s Care', 'mens-care', NULL, 'Men\'s Care', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-11 09:52:00', '2025-05-11 09:52:00'),
(106, 1, 105, 'Shaving Needs', 'shaving-needs', NULL, 'Shaving Needs', NULL, NULL, 0, 0, 1, 0, 159, NULL, 159, '2025-05-11 11:10:15', '2025-05-11 11:07:05', '2025-05-11 11:10:15'),
(107, 1, NULL, 'RFL Group', 'rfl-group', NULL, 'Rfl Group', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-13 10:02:10', '2026-01-05 15:24:51'),
(108, 1, 65, 'Oral Care', 'oral-care-2', NULL, 'Oral Care', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-13 13:23:54', '2025-05-13 13:23:54'),
(109, 1, NULL, 'Candy & Chocolate', 'candy-chocolate', NULL, 'Candy & Chocolate', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-15 13:21:51', '2025-05-15 13:21:51'),
(110, 1, 109, 'Chocolates', 'chocolates', NULL, 'Chocolates', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-15 13:28:02', '2025-05-15 13:28:02'),
(111, 1, 43, 'Frozen Foods', 'frozen-foods', NULL, 'Frozen Foods', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-15 15:27:22', '2025-05-15 15:27:22'),
(112, 1, 79, 'Shampoo & Conditioner', 'shampoo-conditioner', NULL, 'Shampoo', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-16 15:17:44', '2025-05-20 08:55:27'),
(113, 1, 65, 'Baby Powder & Lotion& Oil & Cream', 'baby-powder-lotion-oil-cream', NULL, 'Baby Powder & Lotion& Oil', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-18 14:20:08', '2025-05-18 14:44:39'),
(114, 1, 65, 'Baby Soap & Shampoo& Wash', 'baby-soap-shampoo-wash', NULL, 'Baby Soap & Shampoo & Wash', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-18 14:21:05', '2025-05-19 15:33:39'),
(115, 1, 79, 'Deodorants', 'deodorants', NULL, 'Men & Woman Deodorants', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-19 13:29:25', '2025-05-19 13:29:25'),
(116, 1, 79, 'Powder & Cream', 'powder-cream', NULL, 'Powder & Cream', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-19 13:34:48', '2025-05-19 13:34:48'),
(117, 1, 79, 'Face Wash', 'face-wash', NULL, 'Face Wash', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-20 09:13:55', '2025-05-20 09:13:55'),
(118, 1, 65, 'Wipes & Cotton Buds', 'wipes-cotton-buds', NULL, 'Wipes & Cotton Buds', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-05-20 15:41:51', '2025-05-20 15:42:26'),
(119, 1, 49, 'Water', 'water', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 161, 161, NULL, NULL, '2025-05-21 10:29:38', '2025-05-21 10:29:52'),
(120, 1, 49, 'Juice & Smoody', 'juice-smoody', NULL, 'Juice & Smoody', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-21 16:02:59', '2025-05-21 16:02:59'),
(121, 1, 82, 'Carpet Texture', 'carpet-texture', NULL, 'Caepet Texture', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-22 08:54:12', '2025-05-22 08:54:12'),
(122, 1, 82, 'Flask', 'flask', NULL, 'Flask', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-22 10:27:01', '2025-05-22 10:27:01'),
(123, 1, 123, 'Knief & Sigar', 'knief-sigar', NULL, 'Knief & Sigar', NULL, NULL, 0, 0, 1, 0, 161, 159, NULL, NULL, '2025-05-22 12:37:25', '2025-12-04 09:50:58'),
(124, 1, 53, 'Ice Cream', 'ice-cream', NULL, 'Ice Cream', NULL, NULL, 0, 0, 1, 0, 2, NULL, NULL, NULL, '2025-05-23 14:17:43', '2025-05-23 14:17:43'),
(125, 1, 47, 'Keto Food', 'keto-food', NULL, 'Keto Food', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-24 13:12:29', '2025-05-24 13:12:29'),
(126, 1, 109, 'Candy', 'candy-2', NULL, 'Candy', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-24 16:25:16', '2025-05-24 16:25:16'),
(127, 1, 49, 'Soft Drinks', 'soft-drinks', NULL, 'Soft Drinks', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-05-25 16:57:45', '2025-05-25 16:57:45'),
(128, 1, 65, 'Diapers', 'diapers', NULL, 'Diapers', NULL, NULL, 0, 0, 1, 0, 2, NULL, NULL, NULL, '2025-05-28 17:35:15', '2025-05-28 17:35:15'),
(129, 1, 82, 'Umbrella', 'umbrella', NULL, 'Umbrella', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-06-04 02:33:38', '2025-06-04 02:33:38'),
(130, 1, 79, 'Hair Color', 'hair-color', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-06-06 11:22:49', '2025-06-06 11:23:07'),
(131, 1, 82, 'Toy', 'toy', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-06-06 15:49:30', '2025-06-06 15:49:30'),
(132, 1, 53, 'Cake\'s', 'cakes', NULL, 'Cake\'s', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-06-30 08:30:35', '2025-06-30 08:30:35'),
(133, 1, 79, 'Pain Balm', 'pain-balm', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-07-09 14:08:55', '2025-07-09 14:08:55'),
(134, 1, 65, 'Mumpot/Fiter', 'mumpotfiter', NULL, 'Mumpot', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-07-11 09:17:19', '2025-07-11 09:18:09'),
(135, 1, 82, 'Key Holder', 'key-holder', NULL, 'Keys and Bags Designer', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-07-18 09:19:19', '2025-07-18 09:19:19'),
(136, 1, 82, 'Baby', 'baby-9', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, 159, 159, '2026-04-08 10:36:16', '2025-07-21 11:34:47', '2026-04-08 10:36:16'),
(137, 1, 82, 'Blender', 'blender', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 160, 159, 159, '2025-12-05 09:29:59', '2025-07-30 08:16:26', '2025-12-05 09:29:59'),
(138, 1, 82, 'Agorbati & Candle', 'agorbati-candle', 'media/category//2025-07-30-FZaJDuGryiuqd5tQd5mplhOoKz3UolLfnUX8KQXL.webp', NULL, NULL, NULL, 0, 0, 1, 0, 160, NULL, NULL, NULL, '2025-07-30 08:37:39', '2025-07-30 08:37:39'),
(139, 1, 82, 'Cake Making Item', 'cake-making-item', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 160, 160, NULL, NULL, '2025-08-01 08:49:56', '2025-08-01 08:50:08'),
(140, 1, 82, 'Nepthonil', 'nepthonil', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-08-03 13:28:52', '2025-08-03 13:28:52'),
(141, 1, 82, 'Glass Wepper & Handle Brush', 'glass-wepper-handle-brush', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-08-12 14:22:04', '2025-08-12 14:22:04'),
(142, 1, 82, 'Hotpot', 'hotpot', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-08-20 09:12:10', '2025-08-20 09:12:10'),
(143, 1, 82, 'Bed Floor Jharu', 'bed-floor-jharu', NULL, 'Bed Floor Jharu', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-08-20 09:15:15', '2025-08-20 09:15:15'),
(144, 1, 82, 'Plate & Bowl', 'plate-bowl', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-08-20 10:52:42', '2025-08-20 16:09:21'),
(145, 1, 82, 'Cup & Mug', 'cup-mug', NULL, 'Cup & Mug', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-08-20 14:53:11', '2025-12-05 09:31:00'),
(146, 1, 82, 'Glass Made Porduct', 'glass-made-porduct', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, 159, '2026-01-30 14:05:35', '2025-08-21 13:40:27', '2026-01-30 14:05:35'),
(147, 1, 79, 'Body lotion', 'body-lotion', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 160, NULL, NULL, NULL, '2025-10-17 10:05:31', '2025-10-17 10:05:31'),
(148, 1, 79, 'Lip Blam', 'lip-blam', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-11-16 08:46:31', '2025-11-16 08:46:31'),
(149, 1, NULL, 'Kitchen Accessories', 'kitchen-accessories', NULL, 'Kitchen Accessories', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 09:55:23', '2025-12-04 09:55:23'),
(150, 1, 149, 'Knief & Sigar', 'knief-sigar-2', NULL, 'Knief & Sigar', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 09:55:39', '2025-12-04 09:55:39'),
(151, 1, 149, 'Chalni & Chakni & Cimta', 'chalni-chakni-cimta', NULL, 'Chalni', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-12-04 10:36:25', '2026-02-11 09:41:51'),
(152, 1, 79, 'Body Washer', 'body-washer', NULL, 'Body Washer', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 10:53:59', '2025-12-04 10:53:59'),
(153, 1, 149, 'Hand glubs', 'hand-glubs', NULL, 'Hand glubs', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 11:09:02', '2025-12-04 11:09:02'),
(154, 1, 149, 'Lemon Crusher', 'lemon-crusher', NULL, 'Lemon Crusher', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 11:12:50', '2025-12-04 11:12:50'),
(155, 1, 149, 'Salad Cutter', 'salad-cutter', NULL, 'Salad Cutter', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 11:19:34', '2025-12-04 11:19:34'),
(156, 1, 149, 'Dail Ghutni', 'dail-ghutni', NULL, 'Dail Ghutni', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 11:26:34', '2025-12-04 11:26:34'),
(157, 1, 149, 'Tab Washer', 'tab-washer', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 11:36:23', '2025-12-04 11:36:23'),
(158, 1, 149, 'Chopsticks', 'chopsticks', NULL, 'Chopsticks', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 11:42:31', '2025-12-04 11:42:31'),
(159, 1, 82, 'Wall Hook & Hoolder', 'wall-hook-hoolder', NULL, 'Wall Hook', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-12-04 11:51:45', '2025-12-04 16:22:00'),
(160, 1, 149, 'Barbique', 'barbique', NULL, 'Barbique Items', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 13:34:30', '2025-12-04 13:34:30'),
(161, 1, 82, 'Tiffin Box & Lunch Box', 'tiffin-box-lunch-box', NULL, 'Tiffin Box', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-12-04 14:36:40', '2025-12-05 08:31:27'),
(162, 1, 149, 'Masala Storage', 'masala-storage', NULL, 'Masala Storage', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 14:57:02', '2025-12-04 14:57:02'),
(163, 1, 82, 'Water botol & Designer Pot', 'water-botol-designer-pot', NULL, 'Water botol & Designer Pot', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-04 15:25:47', '2025-12-04 15:25:47'),
(164, 1, 203, 'Electronic Machines', 'electronic-machines', NULL, 'Electronic Machines', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2025-12-04 15:44:45', '2026-02-13 09:29:09'),
(165, 1, 82, 'Pa Gosoni', 'pa-gosoni', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-06 09:17:59', '2025-12-06 09:17:59'),
(166, 1, 149, 'Hata & Cheni', 'hata-cheni', NULL, 'Hata & Cheni', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-06 11:12:02', '2025-12-06 11:12:02'),
(167, 1, 82, 'Kelp & Rope', 'kelp-rope', NULL, 'Kelp & Rope', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-06 12:03:07', '2025-12-06 12:03:07'),
(168, 1, 149, 'Chamus & Kata Chamus', 'chamus-kata-chamus', NULL, 'Chamus & Kata Chamus', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-06 13:23:53', '2025-12-06 13:23:53'),
(169, 1, 149, 'Water Pureit', 'water-pureit', NULL, 'Water Pureit', NULL, NULL, 0, 0, 1, 0, 160, NULL, NULL, NULL, '2025-12-15 09:01:55', '2025-12-15 09:01:55'),
(170, 1, 65, 'Baby Products', 'baby-products-2', NULL, 'Baby Products', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-15 09:13:40', '2025-12-15 09:13:40'),
(171, 1, 82, 'Battery', 'battery', NULL, 'Battery', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2025-12-21 10:59:34', '2025-12-21 10:59:34'),
(172, 1, 107, 'Table & Chair', 'table-chair', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-05 15:25:59', '2026-01-05 15:25:59'),
(173, 1, 149, 'Chopping Board', 'chopping-board', NULL, 'Chopping Board', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-07 14:25:39', '2026-01-07 14:25:39'),
(174, 1, 149, 'Fry Pan', 'fry-pan', NULL, 'Fry Pan', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-07 14:56:37', '2026-01-07 14:56:37'),
(175, 1, 107, 'Toilet Brush', 'toilet-brush', NULL, 'Toilet Brush', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 14:17:52', '2026-01-08 14:17:52'),
(176, 1, 107, 'Flask & Hotpot', 'flask-hotpot', NULL, 'Flask& Hotpot', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-01-08 14:23:23', '2026-02-07 08:06:02'),
(177, 1, 107, 'Stool &  Tool', 'stool-tool', NULL, 'Stool &  Tool', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 14:29:38', '2026-01-08 14:29:38'),
(178, 1, 107, 'Rat Trap', 'rat-trap', NULL, 'Rat Trap', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 14:33:29', '2026-01-08 14:33:29'),
(179, 1, 107, 'Mesh & Chalni', 'mesh-chalni', NULL, 'Mesh & Chalni', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 14:37:18', '2026-01-08 14:37:18'),
(180, 1, 107, 'Balti & Mug', 'balti-mug', NULL, 'Balti & Mug', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 14:45:23', '2026-01-08 14:45:23'),
(181, 1, 107, 'Dustbin &  Duster', 'dustbin-duster', NULL, 'Dustbin &  Duster', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 14:57:21', '2026-01-08 14:57:21'),
(182, 1, 107, 'Tea Strainer', 'tea-strainer', NULL, 'Tea Strainer', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 15:01:47', '2026-01-08 15:01:47'),
(183, 1, 107, 'Air Tied Contaniar', 'air-tied-contaniar', NULL, 'Air Tied Contaniar', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 15:05:16', '2026-01-08 15:05:16'),
(184, 1, 107, 'Hotpot', 'hotpot-2', NULL, 'Hotpot', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 15:29:50', '2026-01-08 15:29:50'),
(185, 1, 107, 'Electic Kettle', 'electic-kettle', NULL, 'Electic Kettle', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-08 15:54:37', '2026-01-08 15:54:37'),
(186, 1, 203, 'Coffee Maker', 'coffee-maker', NULL, 'Coffee Maker', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-01-10 09:32:40', '2026-02-13 09:32:09'),
(187, 1, 149, 'Egg Bitar', 'egg-bitar', NULL, 'Egg Bitar', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-10 11:04:39', '2026-01-10 11:04:39'),
(188, 1, 149, 'Gas Lighter & Lighter', 'gas-lighter-lighter', NULL, 'Gas Lighter & Lighter', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-10 12:05:32', '2026-01-10 12:05:32'),
(189, 1, 79, 'Hot Bag', 'hot-bag', NULL, 'Hot Bag', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-10 14:33:22', '2026-01-10 14:33:22'),
(190, 1, 149, 'Measuring Cup', 'measuring-cup', NULL, 'Measuring Cup', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-01-10 15:53:55', '2026-01-10 15:54:25'),
(191, 1, 146, 'Glass Jug & Glass', 'glass-jug-glass', NULL, 'Glass Jug & Glass', NULL, NULL, 0, 0, 1, 0, 159, NULL, 159, '2026-01-30 13:58:44', '2026-01-30 13:53:44', '2026-01-30 13:58:44'),
(192, 1, 146, 'Glass Jug & Glass', 'glass-jug-glass-2', NULL, 'Glass Jug & Glass', NULL, NULL, 0, 0, 1, 0, 159, NULL, 159, '2026-01-30 14:01:37', '2026-01-30 13:59:01', '2026-01-30 14:01:37'),
(193, 1, NULL, 'Glass Made Porduct', 'glass-made-porduct-2', NULL, 'Glass Made Porduct', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-30 14:06:07', '2026-01-30 14:06:07'),
(194, 1, 193, 'Glass Jug & Glass', 'glass-jug-glass-3', NULL, 'Glass Jug & Glass', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-30 14:06:52', '2026-01-30 14:06:52'),
(195, 1, 82, 'Stand & Holder', 'stand-holder', NULL, 'Stand & Holder', NULL, NULL, 0, 0, 1, 0, 159, NULL, 159, '2026-01-30 14:40:27', '2026-01-30 14:39:40', '2026-01-30 14:40:27'),
(196, 1, 193, 'Short Glass', 'short-glass', NULL, 'Short Glass', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-31 08:41:21', '2026-01-31 08:41:21'),
(197, 1, 193, 'Bowl & Bati', 'bowl-bati', NULL, 'Bowl & Bati', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-01-31 10:23:22', '2026-01-31 10:23:22'),
(198, 1, 193, 'Cup Plate', 'cup-plate', NULL, 'Cup Plate', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-01-31 15:54:04', '2026-01-31 15:54:38'),
(199, 1, 107, 'Jug & Glass', 'jug-glass', NULL, 'Jug & Glass', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-06 10:49:09', '2026-02-06 10:49:09'),
(200, 1, 107, 'Water botol & Designer Pot', 'water-botol-designer-pot-2', NULL, 'Water botol & Designer Pot', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-06 15:57:13', '2026-02-06 15:57:13'),
(201, 1, 107, 'Flower Top & Busket', 'flower-top-busket', NULL, 'Flower Top & Busket', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-09 15:08:36', '2026-02-09 15:08:36'),
(202, 1, 149, 'Cooker', 'cooker', NULL, 'Cooker', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-13 09:15:32', '2026-02-13 09:15:32'),
(203, 1, NULL, 'Electronic Accessories', 'electronic-accessories', NULL, 'Electronic Accessories', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-02-13 09:28:43', '2026-02-13 09:28:49'),
(204, 1, 203, 'Blender', 'blender-2', NULL, 'Blender', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-13 09:34:25', '2026-02-13 09:34:25'),
(205, 1, 203, 'Rice Cooker', 'rice-cooker', NULL, 'Rice Cooker', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-13 09:51:57', '2026-02-13 09:51:57'),
(206, 1, 65, 'Baby Towel & Wips', 'baby-towel-wips', NULL, 'Baby Towel & Wips', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-25 15:24:35', '2026-02-25 15:24:35'),
(207, 1, 65, 'Baby Brush', 'baby-brush', NULL, 'Baby Brush', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-25 15:40:37', '2026-02-25 15:40:37'),
(208, 1, 65, 'Baby Cup & Bati & Chamus', 'baby-cup-bati-chamus', NULL, 'Baby Cup & Bati & Chamus', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-02-25 15:46:51', '2026-02-25 16:43:48'),
(209, 1, 65, 'Fiter Cleaner', 'fiter-cleaner', NULL, 'Fiter Cleaner', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-25 16:33:28', '2026-02-25 16:33:28'),
(210, 1, 82, 'Shoe Polish', 'shoe-polish', NULL, 'Shoe Polish', NULL, NULL, 0, 0, 1, 0, 159, NULL, NULL, NULL, '2026-02-26 15:56:46', '2026-02-26 15:56:46'),
(211, 1, 193, 'Plate', 'plate-2', NULL, 'Plate', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-03-10 08:18:09', '2026-03-10 08:18:46'),
(212, 1, 193, 'Designer Things', 'designer-things', NULL, 'Designer Things', NULL, NULL, 0, 0, 1, 0, 159, 159, NULL, NULL, '2026-03-10 08:28:46', '2026-04-08 09:16:23'),
(213, 1, 104, 'Hair Oil', 'hair-oil', NULL, NULL, NULL, NULL, 0, 0, 1, 0, 1, NULL, NULL, NULL, '2026-07-27 04:25:07', '2026-07-27 04:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `category_vendors`
--

CREATE TABLE `category_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_vendors`
--

INSERT INTO `category_vendors` (`id`, `category_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(26, 9, 1, '2023-10-19 06:38:23', '2023-10-19 06:38:23'),
(77, 31, 1, '2024-07-25 06:26:03', '2024-07-25 06:26:03'),
(80, 47, 1, '2025-04-27 12:15:26', '2025-04-27 12:15:26'),
(81, 48, 1, '2025-04-27 12:16:26', '2025-04-27 12:16:26'),
(82, 49, 2, '2025-04-28 11:16:06', '2025-04-28 11:16:06'),
(83, 51, 1, '2025-04-28 14:39:26', '2025-04-28 14:39:26'),
(85, 52, 1, '2025-04-28 14:41:10', '2025-04-28 14:41:10'),
(86, 53, 1, '2025-04-28 15:10:41', '2025-04-28 15:10:41'),
(87, 54, 1, '2025-04-28 15:13:16', '2025-04-28 15:13:16'),
(89, 56, 4, '2025-04-28 16:00:59', '2025-04-28 16:00:59'),
(90, 57, 3, '2025-04-29 12:35:11', '2025-04-29 12:35:11'),
(92, 59, 3, '2025-04-29 12:40:09', '2025-04-29 12:40:09'),
(93, 60, 3, '2025-04-29 13:05:34', '2025-04-29 13:05:34'),
(94, 61, 3, '2025-04-29 13:09:59', '2025-04-29 13:09:59'),
(95, 44, 1, '2025-04-29 14:37:36', '2025-04-29 14:37:36'),
(96, 62, 4, '2025-04-29 14:38:43', '2025-04-29 14:38:43'),
(97, 63, 4, '2025-04-29 15:57:06', '2025-04-29 15:57:06'),
(98, 64, 4, '2025-04-29 16:04:53', '2025-04-29 16:04:53'),
(99, 70, 7, '2025-04-30 07:19:11', '2025-04-30 07:19:11'),
(100, 71, 7, '2025-04-30 08:55:32', '2025-04-30 08:55:32'),
(101, 72, 7, '2025-05-01 09:27:57', '2025-05-01 09:27:57'),
(102, 76, 8, '2025-05-02 07:41:18', '2025-05-02 07:41:18'),
(103, 77, 8, '2025-05-02 10:02:26', '2025-05-02 10:02:26'),
(104, 78, 8, '2025-05-02 10:03:51', '2025-05-02 10:03:51'),
(106, 83, 10, '2025-05-02 13:18:08', '2025-05-02 13:18:08'),
(107, 55, 4, '2025-05-04 20:08:46', '2025-05-04 20:08:46'),
(108, 97, 7, '2025-05-09 07:53:57', '2025-05-09 07:53:57'),
(111, 119, 31, '2025-05-21 10:29:52', '2025-05-21 10:29:52'),
(112, 82, 10, '2025-08-20 07:52:23', '2025-08-20 07:52:23'),
(114, 43, 21, '2025-10-07 11:16:33', '2025-10-07 11:16:33'),
(116, 107, 10, '2026-01-05 15:24:51', '2026-01-05 15:24:51'),
(117, 58, 3, '2026-02-23 15:09:23', '2026-02-23 15:09:23'),
(118, 213, 1, '2026-07-27 04:25:07', '2026-07-27 04:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `chain_clients`
--

CREATE TABLE `chain_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_by` bigint(20) UNSIGNED DEFAULT NULL,
  `client_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `territory_id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `credit_limit` decimal(16,2) DEFAULT NULL,
  `bin_no` bigint(20) DEFAULT NULL,
  `chain_client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_chain` tinyint(4) NOT NULL DEFAULT 0,
  `is_vat` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_id`, `user_id`, `coa_setup_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `bin_no`, `chain_client_id`, `discount`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3032, 1, 147, 130, 52, NULL, 19, 58, 1, 'Frozen Foodi', NULL, '1111111111', NULL, NULL, 1000000.00, NULL, NULL, 0.00, 1, 0, 0, 1, 2, 1, '2025-04-30 08:08:20', '2024-10-13 17:27:48', '2025-04-30 08:08:20'),
(3033, 1, 170, 141, 60, NULL, 19, 58, 2, 'Wali', NULL, '01921588521', NULL, NULL, 10000.00, NULL, NULL, 0.00, 1, 0, 0, 1, 1, NULL, NULL, '2026-07-13 08:39:39', '2026-10-10 05:56:01'),
(3034, 1, 182, NULL, 60, NULL, 19, 58, 3, 'fffffffff', NULL, '33333', NULL, NULL, NULL, NULL, NULL, 0.00, 1, 0, 0, 1, NULL, 1, '2026-07-21 09:56:56', '2026-07-21 07:18:01', '2026-07-21 09:56:56'),
(3036, 1, 185, NULL, 62, NULL, 19, 58, 3, 'SGS', 'Techno Park', '019215554555', 'technoparkbd@gmail.com', 'aas', 0.00, 0, NULL, 0.00, 1, 0, 0, 1, 187, 1, '2026-09-09 07:11:15', '2026-07-21 10:05:00', '2026-09-09 07:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `client_categories`
--

CREATE TABLE `client_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_categories`
--

INSERT INTO `client_categories` (`id`, `company_id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'RETAILER', 1, 1, NULL, 2, '2024-05-12 04:55:39', '2023-09-23 15:05:44', '2024-05-12 04:55:39'),
(2, 1, 'DISTRIBUTOR', 1, 1, NULL, 2, '2024-05-12 04:55:39', '2023-09-23 15:05:10', '2024-05-12 04:55:39'),
(3, 1, 'HOTEL', 1, 1, 2, 2, '2024-05-12 04:55:39', '2023-09-23 15:05:27', '2024-05-12 04:55:39'),
(4, 1, 'CORPORATE', 1, 1, NULL, 2, '2024-05-12 04:55:39', '2023-09-23 15:05:59', '2024-05-12 04:55:39'),
(5, 1, 'OTHERS', 1, 1, NULL, 2, '2024-05-12 04:55:39', '2023-09-23 15:06:18', '2024-05-12 04:55:39'),
(6, 1, 'RESTAURANT', 1, 2, NULL, 2, '2024-05-12 04:55:39', '2023-11-07 08:19:04', '2024-05-12 04:55:39'),
(7, 1, 'Hospital', 1, 2, NULL, 2, '2024-05-12 04:55:39', '2023-11-07 08:19:33', '2024-05-12 04:55:39'),
(8, 1, 'Club', 1, 2, NULL, 2, '2024-05-12 04:55:39', '2023-11-13 04:32:44', '2024-05-12 04:55:39'),
(9, 1, 'Super Shop', 1, 2, NULL, 2, '2024-05-12 04:55:39', '2023-12-27 18:39:54', '2024-05-12 04:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `client_messages`
--

CREATE TABLE `client_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_messages`
--

INSERT INTO `client_messages` (`id`, `product_id`, `name`, `email`, `phone`, `address`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Daniel Edwards', 'danieledwards.web@gmail.com', '8453630323', 'New York . United States 10018', 'Hello,\r\n\r\nWe got your website information from the network administrator, and after testing it to ensure everything was functioning smoothly, we identified several SEO (Search Engine Optimization) related shortcomings. These are preventing your website from appearing on major search engines like Google, Bing, and Yahoo. Fixing these issues is both simple and crucial for increasing  your online   visibility.                                     \r\n                                                                                                                                                   \r\nPlease reply with your phone  number ,  time  zone, and  availability for a quick call so we can resolve this at the earliest for you.\r\n\r\nBest Regards,\r\nDaniel Edwards', 1, '2025-04-28 14:03:02', '2025-04-28 14:03:02'),
(2, NULL, 'Angela Britton', 'angelajbritton02@gmail.com', '0120212010', 'angelajbritton02@gmail.com', 'Hello There,\r\n\r\nI hope this email finds you well. I wanted to introduce our tailored SEO services designed to help businesses like yours improve online visibility and attract more local customers.\r\n\r\nWe specialize in proven strategies that enhance your Google rankings, drive organic traffic, and increase quality leads—all without unnecessary jargon or complexity.\r\n\r\nWould you be interested in learning more? I’d be happy to send you our SEO package details and pricing.\r\n\r\nLooking forward to your response!', 1, '2025-04-29 05:02:54', '2025-04-29 05:02:54'),
(3, NULL, 'Angela Britton', 'angelajbritton02@gmail.com', '0120212010', 'angelajbritton02@gmail.com', 'Hello There,\r\n\r\nI hope this email finds you well. I wanted to introduce our tailored SEO services designed to help businesses like yours improve online visibility and attract more local customers.\r\n\r\nWe specialize in proven strategies that enhance your Google rankings, drive organic traffic, and increase quality leads—all without unnecessary jargon or complexity.\r\n\r\nWould you be interested in learning more? I’d be happy to send you our SEO package details and pricing.\r\n\r\nLooking forward to your response!', 1, '2025-04-29 05:03:09', '2025-04-29 05:03:09'),
(4, NULL, 'Angela Britton', 'angelajbritton02@gmail.com', '012-021-2010', 'CA', 'Hello There,\r\n\r\nI hope this email finds you well. I wanted to introduce our tailored SEO services designed to help businesses like yours improve online visibility and attract more local customers.\r\n\r\nWe specialize in proven strategies that enhance your Google rankings, drive organic traffic, and increase quality leads—all without unnecessary jargon or complexity.\r\n\r\nWould you be interested in learning more? I’d be happy to send you our SEO package details and pricing.\r\n\r\nLooking forward to your response!', 1, '2025-05-03 11:40:59', '2025-05-03 11:40:59'),
(5, NULL, 'Angela Britton', 'angelajbritton02@gmail.com', '012-021-2010', 'CA', 'Hello There,\r\n\r\nI hope this email finds you well. I wanted to introduce our tailored SEO services designed to help businesses like yours improve online visibility and attract more local customers.\r\n\r\nWe specialize in proven strategies that enhance your Google rankings, drive organic traffic, and increase quality leads—all without unnecessary jargon or complexity.\r\n\r\nWould you be interested in learning more? I’d be happy to send you our SEO package details and pricing.\r\n\r\nLooking forward to your response!', 1, '2025-05-03 11:40:59', '2025-05-03 11:40:59'),
(6, NULL, 'Ankit S', 'letsgetuoptimize@gmail.com', '(949) 508-0277', 'Budapester Strasse 24', 'Hey team sahebbazaar.com,\r\n\r\nHope your doing well!\r\n\r\nI just following your website and realized that despite having a good design; but it was not ranking high on any of the Search Engines (Google, Yahoo & Bing) for most of the keywords related to your business.\r\n\r\nWe can place your website on Google\'s 1st page.\r\n\r\n*  Top ranking on Google search!\r\n*  Improve website clicks and views!\r\n*  Increase Your Leads, clients & Revenue!\r\n\r\nInterested? Please provide your name, contact information, and email.\r\n\r\nBests Regards,\r\nAnkit\r\nBest AI SEO Company\r\nAccounts Manager\r\nwww.bestaiseocompany.com\r\nPhone No: +1 (949) 508-0277', 1, '2025-05-21 16:34:54', '2025-05-21 16:34:54'),
(7, NULL, 'Daniel Edwards', 'danieledwards.web03@gmail.com', '8454479454', 'New York', 'Hello,\r\n\r\nWe have gathered important information regarding your website that could significantly impact your business growth.\r\n\r\nCurrently, your site is not appearing on major search engines like Google and Bing due to an incomplete SEO (Search Engine Optimization) setup. Completing these SEO steps is essential to making your website visible to your target audience and driving more traffic and business, which we believe was the main goal behind creating it.\r\n\r\nWe’d love to help you fix this. Please reply with your availability and a phone number so we can discuss the solution in detail.\r\n\r\nLooking forward to helping your business grow!\r\n\r\nBest regards,\r\nDaniel Edwards', 1, '2025-05-23 20:07:39', '2025-05-23 20:07:39'),
(8, NULL, 'Sam Williams', 'samwilliams152007@gmail.com', '7896541233', 'New York', 'Hi,\r\n\r\nLooking for a professional website and social media presence? We design stunning websites and help promote your products on Instagram and Facebook to grow your business. If you\'re interested in website design or social media marketing services, please reply to this email, and I will connect with you to discuss your work.\r\n\r\nBest Regards\r\nSam Williams', 1, '2025-06-04 20:37:52', '2025-06-04 20:37:52'),
(9, NULL, 'Logan Bradley', 'loganbradley.web@gmail.com', '8453774544', 'USA', 'Hi,\r\n\r\nYour website is currently struggling to appear in Google search results, largely due to strong competition from other businesses in your industry that have been online longer. As a result, your site isn’t ranking well, which leads to low traffic and a lack of conversions.\r\n\r\nWe have a proven solution to help overcome this challenge. Our strategies can position your website among the top 5 results on Google, helping you outperform competitors and attract more potential customers.\r\n\r\nTo discuss this solution in detail, please reply with your phone number and a suitable time for a quick conversation.\r\n\r\nThank you,\r\nLogan Bradley', 1, '2025-07-01 20:40:07', '2025-07-01 20:40:07'),
(10, NULL, 'Logan Bradley', 'loganbradley.web@gmail.com', '8453774544', 'USA', 'Hi,\r\n\r\nYour website is currently struggling to appear in Google search results, largely due to strong competition from other businesses in your industry that have been online longer. As a result, your site isn’t ranking well, which leads to low traffic and a lack of conversions.\r\n\r\nWe have a proven solution to help overcome this challenge. Our strategies can position your website among the top 5 results on Google, helping you outperform competitors and attract more potential customers.\r\n\r\nTo discuss this solution in detail, please reply with your phone number and a suitable time for a quick conversation.\r\n\r\nThank you,\r\nLogan Bradley', 1, '2025-07-01 20:40:07', '2025-07-01 20:40:07'),
(11, NULL, 'Susana Bettencourt', 'susana.bettencourt@googlemail.com', '141305242', '69 Rue De L\'epeule', 'Multiverse AI - The Only Platform That Gives You Access To Every Top AI Model — In Every Version — All Inside A Single, Beautifully Simple Dashboard.\r\n\r\nhttps://ai108.online/MultiverseAI\r\n\r\nChatGPT (3.5 → 4.5 → 4o → 5 → Turbo → Nano)\r\nGemini (1.5 Pro → 2.0 Flash)\r\nClaude (3 Opus → Sonnet → Haiku)\r\nGrok (1 through 4)\r\nDALL·E, Veo, Kling, ElevenLabs, DeepSeek, FLUX, LLaMA & more\r\nAnd yes — you get every future version included automatically.\r\n\r\nhttps://ai108.online/MultiverseAI\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nto UNSUBSCRIBE:\r\nhttps://ai108.online/unsubscribe?domain=sahebbazaar.com\r\nAddress: 108 West Street Comstock Park, MI 48721', 1, '2025-11-19 08:07:29', '2025-11-19 08:07:29'),
(12, NULL, 'Xavier Hugs', 'xavierhugs7278@gmail.com', '727-8', 'xavierhugs7278@gmail.com', 'Hey\r\n\r\nDo you have a minute?', 1, '2026-01-29 12:51:37', '2026-01-29 12:51:37'),
(13, NULL, 'Margaret Julia', 'yiyayova@gmail.com', '6143240224', '4164 Bates Brothers Road', 'Hello,\r\n\r\nWe have a special opportunity that could significantly boost traffic and visibility for your website sahebbazaar.com.\r\n\r\nWhat if you could drive real, targeted website traffic automatically using AI — without paid ads, complicated setups, or ongoing management?\r\n\r\nThat’s exactly what AI Traffic Whale delivers.\r\n\r\nAI Traffic Whale uses advanced AI technology to generate consistent, high-quality traffic from multiple sources, helping websites increase exposure, improve engagement, and grow faster — all on autopilot. No technical skills required, no monthly ad spend, and no complex tools to manage.\r\n\r\nYou set it up once, and the AI does the work for you.\r\n\r\n👉 See how it works here: https://traffic.vinhgrowth.com\r\n\r\nYou are receiving this message because we believe this offer may be relevant to your website.\r\n\r\nIf you do not wish to receive further communications from us, please click here to UNSUBSCRIBE:\r\n\r\nhttps://vinhgrowth.com/unsubscribe?domain=sahebbazaar.com\r\n\r\nAddress: 60 Crown Street, London\r\n\r\nLooking out for you,\r\n\r\nMargaret Julia', 1, '2026-02-02 09:23:37', '2026-02-02 09:23:37'),
(14, NULL, 'Marcos Healy', 'marcos.healy85@hotmail.com', '126693043', '55 Place Du Jeu De Paume', 'Hi from DreamProxies.com\r\n\r\nGreat proxies news: high-quality, fast and reliable private proxies now even cheaper!\r\n50% Cheaper - for all private proxies:\r\n\r\nhttps://tiny.cc/dreamproxies-coupons\r\n\r\nBrowse key features and benefits:\r\nFully Private, Premium Quality, Blazing Speed, Unlimited Bandwidth, Reliable Servers, Low Prices, Additional Offers and much more\r\n\r\n50% Sales for all proxy packs - at DreamProxies.com', 1, '2026-03-19 06:42:24', '2026-03-19 06:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `client_prices`
--

CREATE TABLE `client_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `default_price` decimal(16,2) NOT NULL,
  `client_price` decimal(16,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coa_setups`
--

CREATE TABLE `coa_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `head_code` bigint(20) NOT NULL,
  `head_name` varchar(255) NOT NULL,
  `transaction` tinyint(4) NOT NULL DEFAULT 0,
  `general` tinyint(4) NOT NULL DEFAULT 0,
  `head_type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `updateable` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coa_setups`
--

INSERT INTO `coa_setups` (`id`, `company_id`, `parent_id`, `head_code`, `head_name`, `transaction`, `general`, `head_type`, `status`, `updateable`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 'Assets', 0, 0, 'A', 1, 0, 1, NULL, NULL, NULL, '2023-12-07 07:14:30', '2023-12-07 07:14:30'),
(2, 1, NULL, 2, 'Liabilities', 0, 0, 'L', 1, 0, 1, 1, NULL, NULL, '2023-12-07 07:14:59', '2023-12-07 10:24:11'),
(3, 1, NULL, 3, 'Income', 0, 0, 'I', 1, 0, 1, NULL, NULL, NULL, '2023-12-07 07:17:15', '2023-12-07 07:17:15'),
(4, 1, NULL, 4, 'Expense', 0, 0, 'E', 1, 0, 1, 2, NULL, NULL, '2023-12-07 07:17:44', '2024-02-29 13:56:50'),
(18, 1, 1, 101, 'Current Asset', 0, 0, 'A', 1, 0, 1, 2, NULL, NULL, '2023-12-12 14:10:35', '2024-02-28 15:15:38'),
(19, 1, 18, 10101, 'Cash Receivable', 0, 1, 'A', 1, 0, 1, 2, NULL, NULL, '2023-12-12 14:12:01', '2024-02-03 11:21:41'),
(21, 1, 3, 301, 'Direct Income', 0, 0, 'I', 1, 0, 1, 2, NULL, NULL, '2023-12-12 15:55:05', '2023-12-30 06:50:11'),
(23, 1, 18, 10102, 'Cash In Hand', 0, 1, 'A', 1, 0, 1, 2, NULL, NULL, '2023-12-13 03:34:03', '2024-02-28 15:19:15'),
(24, 1, 18, 10103, 'Cash at Bank', 0, 1, 'A', 1, 0, 1, 2, NULL, NULL, '2023-12-13 12:55:18', '2024-02-29 13:26:34'),
(26, 1, 23, 1010201, 'Cash at Hand', 1, 0, 'A', 1, 1, 1, 1, NULL, NULL, '2023-12-13 12:57:46', '2025-04-15 06:31:51'),
(30, 1, 2, 201, 'Cash Payable', 0, 1, 'L', 1, 0, 1, 2, NULL, NULL, '2023-12-13 13:12:36', '2024-02-28 15:23:17'),
(32, 1, 21, 30102, 'Sales Return', 1, 1, 'I', 1, 0, 1, 1, NULL, NULL, '2023-12-13 15:39:24', '2023-12-13 15:39:36'),
(36, 1, 1, 102, 'Fixed Asset', 0, 0, 'A', 1, 0, 2, NULL, NULL, NULL, '2023-12-30 06:44:47', '2023-12-30 06:44:47'),
(37, 1, 36, 10201, 'Furniture', 0, 1, 'A', 1, 1, 2, 2, NULL, NULL, '2023-12-30 06:45:34', '2024-08-04 04:56:29'),
(42, 1, 3, 302, 'Indirect Income', 0, 1, 'I', 1, 1, 2, NULL, NULL, NULL, '2023-12-30 06:49:13', '2023-12-30 06:49:13'),
(46, 1, 36, 10202, 'IT Infrastructure', 0, 1, 'A', 1, 1, 2, NULL, NULL, NULL, '2023-12-30 07:23:04', '2023-12-30 07:23:04'),
(47, 1, 46, 1020201, 'Management Software', 1, 0, 'A', 1, 1, 2, 2, NULL, NULL, '2023-12-30 07:23:21', '2024-07-29 02:33:47'),
(52, 1, 46, 1020202, 'Compurter / Accessories', 1, 0, 'A', 1, 1, 2, 2, NULL, NULL, '2024-02-03 11:28:30', '2024-08-04 04:38:30'),
(78, 1, 21, 30103, 'Whole Sale', 1, 1, 'I', 1, 1, 2, 2, NULL, NULL, '2024-07-25 11:24:17', '2024-07-25 11:25:04'),
(79, 1, 21, 30104, 'Retail Sale', 1, 1, 'I', 1, 1, 2, NULL, NULL, NULL, '2024-07-25 11:24:36', '2024-07-25 11:24:36'),
(80, 1, 21, 30105, 'Online Sale', 1, 1, 'I', 1, 1, 2, 2, NULL, NULL, '2024-07-25 11:24:50', '2024-07-25 11:24:54'),
(91, 1, 42, 30201, 'Scrap Sales', 1, 0, 'I', 1, 1, 2, NULL, NULL, NULL, '2024-07-25 11:32:49', '2024-07-25 11:32:49'),
(101, 1, 37, 1020101, 'Office Furniture', 1, 0, 'A', 1, 1, 2, NULL, NULL, NULL, '2024-08-04 04:56:46', '2024-08-04 04:56:46'),
(102, 1, 36, 10203, 'Electronics Equipment', 0, 1, 'A', 1, 1, 2, NULL, NULL, NULL, '2024-08-04 05:02:13', '2024-08-04 05:02:13'),
(103, 1, 102, 1020301, 'AC / Fan / Accessories', 1, 0, 'A', 1, 1, 2, NULL, NULL, NULL, '2024-08-04 05:03:32', '2024-08-04 05:03:32'),
(118, 1, 4, 401, 'Administrative Expenses', 0, 1, 'E', 1, 1, 2, 159, NULL, NULL, '2024-08-31 17:01:33', '2025-11-12 13:01:26'),
(126, 1, 4, 402, 'Business Expence', 0, 1, 'E', 1, 1, 2, NULL, NULL, NULL, '2024-09-05 07:36:03', '2024-09-05 07:36:03'),
(127, 1, 126, 40201, 'Product Purchase', 1, 0, 'E', 1, 1, 2, NULL, NULL, NULL, '2024-09-05 07:36:17', '2024-09-05 07:36:17'),
(133, 1, 2, 202, 'Short Term Loan', 0, 0, 'L', 1, 1, 1, NULL, NULL, NULL, '2024-10-19 15:15:51', '2024-10-19 15:15:51'),
(140, 1, 24, 1010301, 'bkash - 01340674910', 1, 0, 'A', 1, 1, 2, 2, NULL, NULL, '2024-10-24 11:31:52', '2025-04-27 12:55:40'),
(141, 1, 19, 1010102, 'Retail Client', 1, 0, 'A', 1, 1, 2, NULL, NULL, NULL, '2024-10-26 05:51:27', '2024-10-26 05:51:27'),
(152, 1, 126, 40202, 'Product Sample', 1, 0, 'E', 1, 1, 2, NULL, NULL, NULL, '2024-11-07 10:24:31', '2024-11-07 10:24:31'),
(157, 1, 24, 1010302, 'DBBL', 1, 0, 'A', 1, 1, 2, NULL, NULL, NULL, '2025-04-27 12:56:11', '2025-04-27 12:56:11'),
(158, 1, 24, 1010303, 'Rocket', 1, 0, 'A', 1, 1, 2, NULL, NULL, NULL, '2025-04-27 12:56:34', '2025-04-27 12:56:34'),
(159, 1, 24, 1010304, 'Nagod', 1, 0, 'A', 1, 1, 2, NULL, NULL, NULL, '2025-04-27 12:56:57', '2025-04-27 12:56:57'),
(160, 1, 2, 203, 'Opening Balance', 0, 1, 'L', 1, 1, 2, 1, NULL, NULL, '2025-04-28 04:18:58', '2025-04-28 08:49:18'),
(163, 1, 160, 20301, 'Arnob Sur', 1, 0, 'L', 1, 1, 1, 1, NULL, NULL, '2025-04-28 08:49:29', '2025-04-28 12:10:32'),
(164, 1, 160, 20302, 'Rupa Sur', 1, 0, 'L', 1, 1, 1, 1, NULL, NULL, '2025-04-28 08:49:39', '2025-04-28 12:11:18'),
(165, 1, 160, 20303, 'Tithi Sur', 1, 0, 'L', 1, 1, 1, 1, NULL, NULL, '2025-04-28 08:50:05', '2025-04-28 12:11:52'),
(166, 1, 30, 20101, '3S Distributor', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-04-28 11:01:15', '2025-04-28 11:01:15'),
(167, 1, 30, 20102, 'Mac Coffee', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-04-28 11:05:44', '2025-04-28 11:05:44'),
(168, 1, 30, 20103, 'Bashundhara', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2025-04-28 13:03:25', '2025-04-28 13:03:25'),
(169, 1, 30, 20104, 'SS Distribution', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2025-04-28 13:04:16', '2025-04-28 13:04:16'),
(170, 1, 30, 20105, 'AcI Mashas Ma entre', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-04-29 17:00:28', '2025-04-29 17:00:28'),
(171, 1, 30, 20106, 'Rishad Enterprise', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-04-30 06:26:34', '2025-04-30 06:26:34'),
(172, 1, 30, 20107, 'Square Food and Beverage', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-04-30 06:51:16', '2025-05-14 16:03:53'),
(173, 1, 30, 20108, 'Dabour Company', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-02 07:40:35', '2025-05-02 10:30:06'),
(174, 1, 30, 20109, 'Iskon', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-02 10:29:50', '2025-05-02 10:30:12'),
(175, 1, 30, 20110, 'Rfl Italio Company', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-02 11:24:08', '2025-05-02 11:24:17'),
(176, 1, 30, 20111, 'Kohinoor chemical', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-05 13:13:43', '2025-05-05 13:13:54'),
(177, 1, 30, 20112, 'Nestle', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-05 13:44:44', '2025-05-05 13:44:44'),
(178, 1, 30, 20113, 'Fresh MGi', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-05 20:23:39', '2025-05-14 16:04:17'),
(179, 1, 30, 20114, 'Dettol', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-06 10:48:22', '2025-07-14 11:27:48'),
(180, 1, 30, 20115, 'Unilever Company ltd', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-07 15:23:02', '2025-05-07 15:23:10'),
(181, 1, 30, 20116, 'City Group', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-08 14:42:54', '2025-12-25 10:27:22'),
(182, 1, 30, 20117, 'Fortune Company', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-09 09:00:28', '2025-05-14 16:03:13'),
(183, 1, 118, 40101, 'Polithin Bag', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2025-05-10 12:10:25', '2026-02-10 16:31:54'),
(184, 1, 118, 40102, 'Wifi Bil', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2025-05-10 12:11:40', '2026-02-01 09:57:23'),
(185, 1, 30, 20118, 'Marcella Distribution', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-11 09:09:02', '2025-05-14 16:03:38'),
(186, 1, 21, 30106, 'Retail Return', 1, 1, 'I', 1, 1, 1, NULL, NULL, NULL, '2025-05-13 07:04:19', '2025-05-13 07:04:19'),
(187, 1, 30, 20119, 'Prestige Bengal LTd', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-14 16:02:52', '2025-05-14 16:04:54'),
(188, 1, 30, 20120, 'Kodomo Baby Care', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-14 16:25:49', '2025-05-14 16:25:49'),
(189, 1, 30, 20121, 'Golden Harvest', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-15 16:21:08', '2025-05-15 16:21:08'),
(190, 1, 30, 20122, 'Mousumi Entreprise', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-16 08:45:42', '2025-05-16 08:45:42'),
(191, 1, 30, 20123, 'Nivea Company', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-16 13:49:43', '2025-05-16 13:49:43'),
(192, 1, 30, 20124, 'International Distribution', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-17 09:01:00', '2025-05-17 09:01:00'),
(193, 1, 30, 20125, 'M/S Muhammad Corporation', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-17 15:51:15', '2025-05-19 14:07:18'),
(194, 1, 30, 20126, 'Pran  Agro Limited', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-18 15:22:38', '2025-12-25 10:30:41'),
(195, 1, 30, 20127, 'Vin Global Distribution', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-19 14:08:24', '2025-12-25 10:31:02'),
(196, 1, 30, 20128, 'SRF consumer limited', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-20 10:01:41', '2025-05-20 10:01:41'),
(197, 1, 30, 20129, 'Kodomo international limited', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-05-20 12:55:15', '2025-05-20 12:55:15'),
(198, 1, 30, 20130, 'Arla', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-21 09:40:51', '2025-05-22 09:55:07'),
(199, 1, 30, 20131, 'ASIM TRADES - FRESH', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-21 10:26:36', '2025-05-22 09:55:27'),
(200, 1, 30, 20132, 'GOLAM/Chakw Bazar', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-21 12:19:40', '2025-05-21 15:46:31'),
(201, 1, 30, 20133, 'Ratan Enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-21 15:45:55', '2025-05-21 15:46:10'),
(202, 1, 30, 20134, 'Deiyon Enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-22 07:03:34', '2025-07-16 14:42:19'),
(203, 1, 30, 20135, 'Sahalom Carpet', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-22 09:55:55', '2025-07-16 14:42:29'),
(204, 1, 30, 20136, 'Binimoy Traders', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-22 12:05:40', '2025-07-24 10:57:16'),
(205, 1, 30, 20137, 'Pran Group', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-23 12:13:28', '2025-07-24 10:57:40'),
(206, 1, 30, 20138, 'Igloo', 1, 0, 'L', 1, 1, 2, 159, NULL, NULL, '2025-05-23 14:57:42', '2025-05-24 07:37:28'),
(207, 1, 30, 20139, 'Igloo', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-24 07:36:46', '2025-05-24 07:36:59'),
(208, 1, 30, 20140, 'Imroj   Entreprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-24 08:48:22', '2025-05-24 09:53:49'),
(209, 1, 30, 20141, 'Olympic Industries limited', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-24 11:19:30', '2025-07-24 10:58:13'),
(210, 1, 30, 20142, 'Rakib Enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-24 11:47:20', '2025-05-24 12:40:32'),
(211, 1, 30, 20143, 'Mesas Asia Food Copr', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-24 13:46:04', '2025-07-24 10:58:36'),
(212, 1, 30, 20144, 'Aysha  trades', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-24 15:10:07', '2025-05-24 15:11:06'),
(213, 1, 30, 20145, 'New Zealand Dairy Products Bangladesh', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-25 07:46:44', '2025-05-25 13:21:48'),
(214, 1, 30, 20146, 'Brac Dailya and Food Project', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-25 08:28:46', '2025-05-25 13:22:35'),
(215, 1, 30, 20147, 'PRAN GROUP', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-05-25 11:22:43', '2025-05-25 13:22:59'),
(216, 1, 30, 20148, 'Coco cola Company', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-26 06:28:01', '2025-05-26 15:17:48'),
(217, 1, 30, 20149, 'Haque Biscuits', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-26 15:18:16', '2025-12-25 10:52:46'),
(218, 1, 30, 20150, 'mesas Imran', 1, 0, 'L', 1, 1, 2, 159, NULL, NULL, '2025-05-27 09:44:17', '2025-12-25 10:53:04'),
(219, 1, 30, 20151, 'Mesas M.S Enterprise', 1, 0, 'L', 1, 1, 2, 159, NULL, NULL, '2025-05-27 11:42:46', '2026-02-10 15:33:31'),
(220, 1, 30, 20152, 'Sabil Hasan', 1, 0, 'L', 1, 1, 2, 159, NULL, NULL, '2025-05-27 13:25:38', '2025-12-25 10:53:49'),
(221, 1, 30, 20153, 'ERFAN SUPER FOODS', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-28 06:28:56', '2025-12-25 10:54:14'),
(222, 1, 30, 20154, 'Bismilha Trad Center', 1, 0, 'L', 1, 1, 2, 159, NULL, NULL, '2025-05-28 12:29:31', '2025-12-25 10:54:40'),
(223, 1, 30, 20155, 'Kohinoor chemical Powder', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-31 08:05:04', '2025-05-31 09:46:58'),
(224, 1, 30, 20156, 'J&J  Shetaj Entreprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-05-31 15:16:01', '2025-12-25 10:55:06'),
(225, 1, 30, 20157, 'Intrenational Distribution', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2025-06-01 02:40:53', '2025-06-01 02:40:53'),
(226, 1, 30, 20158, 'Mesas afra rice', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-02 15:42:30', '2025-12-25 10:55:40'),
(227, 1, 30, 20159, 'Abul Khair Consumer Point', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-02 15:44:12', '2025-06-02 15:44:47'),
(228, 1, 30, 20160, 'Mesas Eya Rice Agency', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-03 08:54:14', '2025-06-03 08:54:35'),
(229, 1, 30, 20161, 'Moon Chata', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-04 02:52:12', '2025-12-25 11:10:55'),
(230, 1, 30, 20162, 'ISHIKA TRADING -TREET COM', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-04 08:33:17', '2025-06-05 15:16:57'),
(231, 1, 30, 20163, 'ANU RADHA BOJONALOY', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-04 10:08:57', '2025-06-05 15:17:10'),
(232, 1, 30, 20164, 'Akij Essential', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-05 15:18:15', '2025-12-25 11:11:46'),
(233, 1, 30, 20165, 'AS.A MOTIN ENTERPRISE', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-06-07 06:02:48', '2025-06-07 08:52:36'),
(234, 1, 30, 20166, 'Aarong Dairy', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-06-11 05:12:27', '2025-12-25 11:12:19'),
(235, 1, 30, 20167, 'MILK VITA', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-12 07:22:16', '2025-06-15 14:30:57'),
(236, 1, 30, 20168, 'Kazi & kazi Tea Estate Limited', 1, 0, 'L', 1, 1, 161, 159, NULL, NULL, '2025-06-14 06:51:43', '2025-06-15 14:31:09'),
(237, 1, 30, 20169, 'M/S AHMED TRADING', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-15 09:30:11', '2025-06-15 14:31:22'),
(238, 1, 30, 20170, 'Partex Beverge limited', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-16 11:56:01', '2025-06-16 11:56:38'),
(239, 1, 30, 20171, 'MASUD STORE', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-19 05:54:46', '2025-06-21 16:23:29'),
(240, 1, 30, 20172, 'Transcom Consumer Product Ltd', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-21 09:05:25', '2025-06-21 16:23:45'),
(241, 1, 30, 20173, 'Mahajabin.limited', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-22 06:21:32', '2025-06-23 14:57:16'),
(242, 1, 30, 20174, 'TAIFA Trading', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-23 02:54:19', '2025-06-23 14:57:45'),
(243, 1, 30, 20175, 'Family fair', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-23 03:37:16', '2025-06-23 14:58:38'),
(244, 1, 30, 20176, 'Modina baby store', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-23 03:46:08', '2025-06-23 14:59:03'),
(245, 1, 30, 20177, 'Shehtaj Enterprise', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-23 08:16:30', '2025-06-23 14:59:16'),
(246, 1, 30, 20178, 'Bombay Sweets', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-23 09:32:36', '2025-06-23 14:59:29'),
(247, 1, 30, 20179, 'Ispahani Tea Limited', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-23 15:00:53', '2025-06-23 15:01:03'),
(248, 1, 30, 20180, 'Anas enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-26 09:14:00', '2025-12-25 11:32:09'),
(249, 1, 30, 20181, 'JES International', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-06-28 08:46:18', '2025-12-25 11:32:25'),
(250, 1, 30, 20182, 'Akij Health Care', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-29 07:49:30', '2025-12-25 11:36:32'),
(251, 1, 30, 20183, 'Care nutrition limited', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-06-29 09:32:44', '2025-06-29 20:06:36'),
(252, 1, 30, 20184, 'M/S Tisa store', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-07-04 07:27:14', '2025-07-14 10:00:56'),
(253, 1, 30, 20185, 'Anfords Oral HyGine', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-07-14 10:01:57', '2025-12-25 15:14:20'),
(254, 1, 30, 20186, 'Noor Trades', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-07-16 14:55:17', '2025-12-25 15:14:33'),
(255, 1, 30, 20187, 'Cute Company', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-07-20 10:20:10', '2025-07-21 06:55:00'),
(256, 1, 30, 20188, 'Darkin Trade & Distribution', 1, 0, 'L', 1, 1, 160, 160, NULL, NULL, '2025-07-21 06:51:45', '2026-01-05 08:36:59'),
(257, 1, 30, 20189, 'Sarkar Enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-07-21 15:43:24', '2025-12-25 15:15:09'),
(258, 1, 30, 20190, 'Afifa trading', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-07-26 07:07:58', '2025-10-07 11:38:09'),
(259, 1, 30, 20191, 'Nasir Enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-07-26 11:26:01', '2025-12-25 15:17:16'),
(260, 1, 30, 20192, 'Nurtrimerchant International', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-07-28 16:03:03', '2025-07-28 16:03:17'),
(261, 1, 30, 20193, 'Sabbir store', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-07-30 09:37:18', '2025-12-25 15:18:04'),
(262, 1, 30, 20194, 'M/S HUMAYUN STORE', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-08-02 05:42:40', '2025-12-01 10:41:29'),
(263, 1, 30, 20195, 'DORCO', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-08-06 08:33:06', '2025-12-25 15:19:03'),
(264, 1, 30, 20196, 'Habil store', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-08-10 05:25:06', '2025-12-25 15:19:48'),
(265, 1, 30, 20197, 'M/S Mariom enterprice', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-08-11 10:10:03', '2025-12-25 15:20:44'),
(266, 1, 30, 20198, 'Haque food', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-08-14 07:24:19', '2025-12-25 15:20:59'),
(267, 1, 30, 20199, 'Amanah Trading Ltd', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-08-17 10:07:13', '2025-12-25 15:21:17'),
(268, 1, 30, 201100, 'Rediyent Care Limited', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-08-18 11:05:29', '2025-12-25 15:21:56'),
(269, 1, 30, 201101, 'Jansin health pvt limited', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-08-23 10:23:24', '2025-12-25 15:22:23'),
(270, 1, 30, 201102, 'Aashirbad', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-08-23 16:50:46', '2025-12-25 15:22:42'),
(271, 1, 30, 201103, 'N.Islam Enterprise', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-08-26 06:44:25', '2025-12-25 15:23:23'),
(272, 1, 30, 201104, 'SMC limited company', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-09-10 10:56:42', '2025-09-10 10:57:16'),
(273, 1, 30, 201105, 'Vin Global Distribution', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2025-09-15 06:58:45', '2025-09-15 06:58:45'),
(274, 1, 30, 201106, 'Nutrimerchant International', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-09-23 06:24:18', '2025-12-25 15:28:12'),
(275, 1, 30, 201107, 'M/S NEW SAHID TRADES', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-09-23 10:18:33', '2025-12-25 15:29:45'),
(276, 1, 30, 201108, 'Salam Enterprise', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-10-07 13:24:36', '2025-12-25 15:30:02'),
(277, 1, 30, 201109, 'SUMITT STORE', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-10-11 11:03:48', '2025-12-25 15:30:51'),
(278, 1, 30, 201110, 'Insaf Trading', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-10-12 08:17:19', '2025-12-25 15:31:03'),
(279, 1, 30, 201111, 'Nasir trading', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-10-13 11:01:03', '2025-12-25 15:31:30'),
(280, 1, 30, 201112, 'New Sohid traders', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2025-10-18 11:39:36', '2025-10-18 11:39:36'),
(281, 1, 30, 201113, 'M/S Sohag entreprise', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-10-19 04:45:35', '2025-12-25 15:33:13'),
(282, 1, 30, 201114, 'Abdul Motin enterprise', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2025-10-19 04:47:35', '2025-10-19 04:47:35'),
(283, 1, 30, 201115, 'POLAS TRADERS', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-10-19 04:49:17', '2025-12-25 15:33:40'),
(284, 1, 118, 40103, 'Computer  Expenses', 1, 0, 'E', 1, 1, 1, 159, NULL, NULL, '2025-11-08 08:44:24', '2026-04-13 14:30:08'),
(285, 1, 118, 40104, 'Puja Expense', 1, 0, 'E', 1, 1, 159, NULL, NULL, NULL, '2025-11-08 08:47:26', '2025-11-08 08:47:26'),
(286, 1, 30, 201116, 'Hahan Brother', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-11-17 07:29:49', '2025-12-25 15:35:07'),
(287, 1, 30, 201117, 'Confidence  Service', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-11-23 09:21:54', '2025-12-25 15:35:23'),
(288, 1, 30, 201118, 'NOBEL STORE', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-11-29 05:31:35', '2025-12-25 15:35:34'),
(289, 1, 30, 201119, 'INCEPTA PHARMACEUICALS LTD', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-11-29 10:16:48', '2025-12-25 15:35:47'),
(290, 1, 30, 201120, 'Rakit distribution', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-12-15 07:50:43', '2025-12-25 15:36:08'),
(291, 1, 30, 201121, 'M/S BASER&BROTHERS', 1, 0, 'L', 1, 1, 159, 159, NULL, NULL, '2025-12-18 09:11:52', '2025-12-25 15:36:28'),
(292, 1, 30, 201122, 'DRAGON COMPANY', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2025-12-25 06:18:59', '2025-12-25 15:36:37'),
(293, 1, 30, 201123, 'New Barisal Plastic Center', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2026-01-08 14:27:50', '2026-01-08 14:27:50'),
(294, 1, 30, 201124, 'M/S Rumi Enterprise', 1, 0, 'L', 1, 1, 160, 159, NULL, NULL, '2026-01-10 07:50:48', '2026-01-10 14:24:45'),
(295, 1, 30, 201125, 'Marico Distribution', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2026-01-12 14:01:24', '2026-01-12 14:01:24'),
(296, 1, 118, 40105, 'Electricity Bill', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2026-01-25 11:38:37', '2026-01-25 12:16:03'),
(297, 1, 4, 403, 'Stuff Salary', 0, 1, 'E', 1, 1, 159, 159, NULL, NULL, '2026-02-01 09:54:14', '2026-03-30 07:34:31'),
(298, 1, 297, 40301, 'Sima Baroy', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2026-02-01 09:54:41', '2026-02-01 10:02:08'),
(299, 1, 297, 40302, 'Subrona Sutru Dhar', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2026-02-01 10:02:41', '2026-04-23 09:26:00'),
(300, 1, 297, 40303, 'Susmita Mondol', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2026-02-01 10:03:01', '2026-02-01 16:24:38'),
(301, 1, 297, 40304, 'Jannat', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2026-02-01 16:16:09', '2026-02-01 16:21:34'),
(302, 1, 297, 40305, 'Nipu', 1, 0, 'E', 1, 1, 159, NULL, NULL, NULL, '2026-02-01 16:16:24', '2026-02-01 16:16:24'),
(303, 1, 30, 201126, 'A.K TRADING CORPORATION', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2026-02-13 08:22:56', '2026-02-13 08:22:56'),
(304, 1, 30, 201127, 'M/S MAA Enterprice', 1, 0, 'L', 1, 1, 160, NULL, NULL, NULL, '2026-02-19 07:06:27', '2026-02-19 07:06:27'),
(305, 1, 30, 201128, 'Mesas Brother Crokeries', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2026-03-10 08:23:09', '2026-03-10 08:23:09'),
(306, 1, 118, 40106, 'Shop Expenses', 1, 0, 'E', 1, 1, 159, NULL, NULL, NULL, '2026-03-15 10:42:46', '2026-03-15 10:42:46'),
(307, 1, 30, 201129, 'Mesas Naz Enterprise', 1, 0, 'L', 1, 1, 160, 160, NULL, NULL, '2026-03-16 08:15:17', '2026-03-16 08:16:03'),
(308, 1, 297, 40306, 'Shymol Sen', 1, 0, 'E', 1, 1, 159, NULL, NULL, NULL, '2026-03-18 17:03:14', '2026-03-18 17:03:14'),
(309, 1, 30, 201130, 'M/S Hasan Brothers Corp', 1, 0, 'L', 1, 1, 159, NULL, NULL, NULL, '2026-04-11 07:42:57', '2026-04-11 07:42:57'),
(310, 1, 297, 40307, 'Arko Ghosh', 1, 0, 'E', 1, 1, 159, 159, NULL, NULL, '2026-04-23 09:26:42', '2026-04-23 16:13:42'),
(311, 1, 297, 40308, 'Bishwajit Barmon', 1, 0, 'E', 1, 1, 159, NULL, NULL, NULL, '2026-04-23 09:29:14', '2026-04-23 09:29:14'),
(312, 1, 4, 404, 'Salary Expenses', 1, 1, 'E', 1, 1, 1, NULL, NULL, NULL, '2026-08-09 06:17:41', '2026-08-09 06:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `payment_no` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `collection_type` varchar(255) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `sales_id` bigint(20) UNSIGNED DEFAULT NULL,
  `on_return` tinyint(4) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `company_id`, `client_id`, `payment_no`, `payment_date`, `payment_type`, `collection_type`, `amount`, `remarks`, `sales_id`, `on_return`, `approved`, `approved_by`, `staff_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3033, 'STC2608000001', '2026-08-31', 'Cash', 'advance', 4.00, '22', NULL, 0, 0, NULL, 61, 187, NULL, NULL, NULL, '2026-08-31 06:28:12', '2026-08-31 06:28:12'),
(2, 1, 3033, 'STC2610000001', '2026-10-09', 'Cash', 'advance', 2230.00, NULL, NULL, 0, 0, NULL, 62, 1, NULL, NULL, NULL, '2026-10-09 04:08:35', '2026-10-09 04:08:35'),
(3, 1, 3033, 'STC2610000002', '2026-10-26', 'Cash', 'advance', 5000.00, NULL, NULL, 0, 0, NULL, 62, 1, NULL, NULL, NULL, '2026-10-26 04:30:48', '2026-10-26 04:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `collection_data`
--

CREATE TABLE `collection_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `trade_license` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `prefix`, `name`, `username`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `logo`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'MBRMS', 'M/S Buyzid Rubber', 'sahebbazaar', 'info@technoparkbd.com', '01552344239', '01552344239', 'Website: www.technoparkbd.com', '5', NULL, NULL, 'House # 10/B Road No 6, Dhaka 1205', 'media/company//2026-07-23-YzSlNBtshZ2ucbW5wSG5Sps3ZFtnjR91rbTqsl0Y.webp', 1, 1, NULL, NULL, '2023-09-23 06:52:33', '2026-09-14 07:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `title` text DEFAULT NULL,
  `address` text NOT NULL,
  `work_time` text NOT NULL,
  `primary_mobile` varchar(255) NOT NULL,
  `primary_email` varchar(255) NOT NULL,
  `secondary_mobile` varchar(255) DEFAULT NULL,
  `secondary_email` varchar(255) NOT NULL,
  `map_url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `heading`, `title`, `address`, `work_time`, `primary_mobile`, `primary_email`, `secondary_mobile`, `secondary_email`, `map_url`, `created_at`, `updated_at`) VALUES
(1, 'GET IN TOUCH', 'Don’t hesitate to contact us directly so that we can think together about a solution.', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\">৩১৬/২, ৬-বি, ডিআইটি রোড,  পূর্ব রামপুরা, ঢাকা-১২১৯।<br></p>', '<span segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">Monday to Friday</span><br segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><span segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">7 a.m. 12 p.m. – 1 p.m. 4 p.m.</span><br segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><br segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><span segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">Saturday</span><br segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><span segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" medium;\"=\"\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / .5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">8 a.m. 2 p.m.</span>', '01716918884', 'info@nijerbazarbd.com', NULL, 'sales@nijerbazarbd.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.6713598084884!2d90.41308638555972!3d23.759096033445807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8792521cc35%3A0xd5aaf741fec33d8e!2s316%2C%206%20DIT%20Rd%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1722152464023!5m2!1sen!2sbd', '2024-02-27 09:09:56', '2024-10-12 11:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `crm_customer_requirements`
--

CREATE TABLE `crm_customer_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_type` varchar(100) DEFAULT NULL,
  `related_module` varchar(100) DEFAULT NULL,
  `requirement_details` text DEFAULT NULL,
  `req_date` date NOT NULL,
  `record_time` time NOT NULL,
  `requirement_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Scheduled,2=Completed,3=Cancelled',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_customer_requirements`
--

INSERT INTO `crm_customer_requirements` (`id`, `lead_id`, `meeting_type`, `related_module`, `requirement_details`, `req_date`, `record_time`, `requirement_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'Online', 'Support', 'csadsada', '2026-07-22', '12:22:00', 2, 1, 1, '2026-07-22 09:55:07', '2026-07-27 06:26:55'),
(2, 1, 'Online', 'Production', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>adasd</td><td>sadas</td><td>dsad</td><td>sadas</td><td><br></td></tr><tr><td><br></td><td>dsads</td><td>dasd</td><td><br></td><td>asdasas</td></tr><tr><td>sadasds</td><td>dasda</td><td>sdas</td><td>asdad</td><td><br></td></tr><tr><td><br></td><td>dasd</td><td><br></td><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td><td>dasdas</td><td><br></td><td><br></td></tr><tr><td><br></td><td>dasd</td><td><br></td><td><br></td><td><br></td></tr></tbody></table><p><br></p>', '2026-07-27', '00:45:00', 1, 1, 1, '2026-07-27 06:48:31', '2026-07-27 06:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `crm_leads`
--

CREATE TABLE `crm_leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_no` varchar(50) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `lead_source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lead_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `proposal_value` double DEFAULT NULL,
  `expected_value` decimal(15,2) DEFAULT 0.00,
  `priority` enum('Low','Medium','High','Urgent') DEFAULT 'Medium',
  `follow_up_date` date DEFAULT NULL,
  `next_follow_up` datetime DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_leads`
--

INSERT INTO `crm_leads` (`id`, `lead_no`, `company_name`, `contact_person`, `mobile`, `email`, `website`, `lead_source_id`, `lead_status_id`, `assigned_to`, `proposal_value`, `expected_value`, `priority`, `follow_up_date`, `next_follow_up`, `address`, `city`, `district`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'LEAD000001', 'SKCK Company', 'Masud', '019215555555', 'technoparkbd@gmail.com', 'dfsdfsdf', 1, 2, 1, 55, 55.00, 'Low', '2026-07-20', '2026-07-21 00:00:00', 'gdfgd', NULL, NULL, 'ddfd', 1, 1, 1, '2026-07-20 10:37:25', '2026-07-20 11:16:56'),
(2, 'LEAD000002', 'Vanila', 'Techno Park', '019215555556', 'technoparkbd@gmail.com', 'dfsdfsdf', 1, 9, 1, 44, 33.00, 'Low', '2026-07-20', '2026-07-20 00:00:00', 'fvd', NULL, NULL, 'Hold as note', 1, 1, NULL, '2026-07-20 11:14:48', '2026-10-26 04:35:07'),
(3, 'LEAD000003', 'SGS', 'Techno Park', '019215554555', 'technoparkbd@gmail.com', 'dfsdfsdf', 1, 10, 1, 55, 55.00, 'Low', '2026-07-20', '2026-07-20 00:00:00', 'aas', NULL, NULL, 'adasd', 1, 1, NULL, '2026-07-20 11:25:19', '2026-07-21 10:05:00'),
(4, 'LEAD000004', 'GGG', 'Techno Park', '019215555555', 'nijer.bazar@gmail.com', 'www.salestracker.com', 1, 5, 1, 444, 44.00, 'Low', '2026-07-27', NULL, '316/2, Rampura Dhaka', NULL, NULL, 'Lead Medical Assistants perform administrative and certain clinical duties', 1, 1, 1, '2026-07-27 08:49:22', '2026-08-06 10:13:43'),
(5, 'LEAD000005', 'BUET', 'Shahinoor', '01712946541', 'karmakartushar517@yahoo.com', 'www.syntaxbd.com', 1, 1, 1, NULL, NULL, 'Low', '2026-09-05', '2026-09-05 00:00:00', 'Palashi, Dhaka', NULL, NULL, 'Goods For Selling', 1, 1, NULL, '2026-09-05 07:39:18', '2026-09-05 07:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead_sources`
--

CREATE TABLE `crm_lead_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `name_bn` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_lead_sources`
--

INSERT INTO `crm_lead_sources` (`id`, `code`, `name`, `name_bn`, `description`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'FB', 'Facebook', 'ফেসবুক', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'GOOGLE', 'Google Ads', 'গুগল বিজ্ঞাপন', 'dsfsdfsd', 1, NULL, NULL, NULL, NULL),
(3, 'WEB', 'Website', 'ওয়েবসাইট', NULL, 1, NULL, NULL, NULL, NULL),
(4, 'WA', 'WhatsApp', 'হোয়াটসঅ্যাপ', NULL, 1, NULL, NULL, NULL, NULL),
(5, 'REF', 'Referral', 'রেফারেল', NULL, 1, NULL, NULL, NULL, NULL),
(6, 'WALK', 'Walk-in Customer', 'সরাসরি গ্রাহক', NULL, 1, NULL, NULL, NULL, NULL),
(7, 'LINK', 'LinkedIn', 'লিংকডইন', NULL, 1, NULL, NULL, NULL, NULL),
(8, 'EMAIL', 'Email Marketing', 'ইমেইল মার্কেটিং', NULL, 1, NULL, NULL, NULL, NULL),
(9, 'YT', 'YouTube', 'ইউটিউব', NULL, 1, NULL, NULL, NULL, NULL),
(10, 'OTHER', 'Other', 'অন্যান্য', NULL, 1, NULL, NULL, NULL, NULL),
(11, 'Offcode33', 'Offline Marketing', NULL, 'hhhhhhh', 0, '2026-07-19 10:54:56', '2026-07-20 07:25:12', 1, 1),
(12, 'Offcode335', 'Offline Marketing5', NULL, 'xfdgdfgdfg', 0, '2026-07-19 10:57:46', '2026-07-19 12:02:03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead_statuses`
--

CREATE TABLE `crm_lead_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `name_bn` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT '#007bff',
  `sort_order` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_lead_statuses`
--

INSERT INTO `crm_lead_statuses` (`id`, `code`, `name`, `name_bn`, `color`, `sort_order`, `description`, `status`, `created_at`, `updated_at`, `updated_by`, `created_by`) VALUES
(1, 'NEW', 'New', 'নতুন', '#007bff', 1, NULL, 1, NULL, NULL, NULL, NULL),
(2, 'CONTACTED', 'Contacted', 'যোগাযোগ করা হয়েছে', '#17a2b8', 2, 'fdf', 1, NULL, NULL, NULL, NULL),
(3, 'FOLLOWUP', 'Follow-up', 'ফলো-আপ চলছে', '#ffc107', 3, 'fdf', 1, NULL, NULL, NULL, NULL),
(4, 'QUALIFIED', 'Qualified', 'যোগ্য', '#28a745', 4, 'fdfd', 1, NULL, NULL, NULL, NULL),
(5, 'PROPOSAL', 'Proposal Sent', 'প্রস্তাব পাঠানো হয়েছে', '#6610f2', 5, 'fdfd', 1, NULL, NULL, NULL, NULL),
(6, 'NEGOTIATION', 'Negotiation', 'আলোচনা চলছে', '#fd7e14', 6, NULL, 1, NULL, NULL, NULL, NULL),
(7, 'WON', 'Won', 'সফল', '#20c997', 7, NULL, 1, NULL, NULL, NULL, NULL),
(8, 'LOST', 'Lost', 'বাতিল', '#dc3545', 8, NULL, 1, NULL, NULL, NULL, NULL),
(9, 'HOLD', 'Hold', 'স্থগিত', '#6c757d', 9, NULL, 1, NULL, NULL, NULL, NULL),
(10, 'CONVERTED', 'Converted', 'গ্রাহকে রূপান্তরিত', '#198754', 10, 'sdsd', 1, NULL, '2026-07-20 09:17:09', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crm_meeting_schedules`
--

CREATE TABLE `crm_meeting_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_title` varchar(255) NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_type` varchar(100) DEFAULT NULL,
  `related_module` varchar(100) DEFAULT NULL,
  `meeting_details` text DEFAULT NULL,
  `meeting_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `meeting_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Scheduled,2=Completed,3=Cancelled',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_meeting_schedules`
--

INSERT INTO `crm_meeting_schedules` (`id`, `meeting_title`, `lead_id`, `meeting_type`, `related_module`, `meeting_details`, `meeting_date`, `start_time`, `end_time`, `meeting_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Demo meeting', 3, 'Online', 'Customer', 'csadsada', '2026-07-22', '12:22:00', '14:22:00', 2, 1, 1, '2026-07-22 09:55:07', '2026-07-22 10:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `crm_quotations`
--

CREATE TABLE `crm_quotations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` tinyint(4) NOT NULL DEFAULT 1,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `quotation` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `quotation_type` varchar(100) DEFAULT NULL,
  `total_amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_paid` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Pending,2=Approved,3=Rejected,4=Completed',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_quotations`
--

INSERT INTO `crm_quotations` (`id`, `company_id`, `product_type`, `store_id`, `staff_id`, `client_id`, `note`, `quotation`, `date`, `quotation_type`, `total_amount`, `discount`, `total_paid`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, 1, 2, 59, 1, NULL, 'QUOT2607000001', '2026-07-23', NULL, 33.00, 0.00, 0.00, 1, 1, 1, NULL, '2026-07-23 06:26:21', '2026-07-23 11:13:42', NULL),
(5, 1, 1, 2, 59, 1, 'This is your demo', 'QUOT2607000002', '2026-07-23', NULL, 18381.00, 9.00, 0.00, 1, 1, 1, NULL, '2026-07-23 06:55:18', '2026-07-23 11:06:32', NULL),
(6, 1, 1, 2, 59, 5, NULL, 'QUOT2609000001', '2026-09-05', NULL, 198.00, 0.00, 0.00, 1, 1, 1, NULL, '2026-09-05 07:44:06', '2026-09-06 11:34:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crm_quotation_details`
--

CREATE TABLE `crm_quotation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` tinyint(4) NOT NULL DEFAULT 1,
  `quotation_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` decimal(18,2) NOT NULL DEFAULT 0.00,
  `qty` decimal(18,2) NOT NULL DEFAULT 0.00,
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `returned_qty` decimal(18,2) NOT NULL DEFAULT 0.00,
  `returned_amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `is_return` tinyint(1) NOT NULL DEFAULT 0,
  `delivery_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Delivered,2=Partial',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_quotation_details`
--

INSERT INTO `crm_quotation_details` (`id`, `company_id`, `product_type`, `quotation_id`, `store_id`, `client_id`, `product_id`, `variant_id`, `order_product_id`, `rate`, `qty`, `amount`, `discount`, `returned_qty`, `returned_amount`, `is_return`, `delivery_status`, `created_at`, `updated_at`) VALUES
(10, 1, 1, 5, 2, 1, 2, NULL, NULL, 66.00, 1.00, 66.00, 0.03, 0.00, 0.00, 0, 0, '2026-07-23 11:06:32', '2026-07-23 11:06:32'),
(11, 1, 1, 5, 2, 1, 1, NULL, NULL, 33.00, 555.00, 18315.00, 8.97, 0.00, 0.00, 0, 0, '2026-07-23 11:06:32', '2026-07-23 11:06:32'),
(13, 1, 1, 4, 2, 1, 1, NULL, NULL, 33.00, 1.00, 33.00, 0.00, 0.00, 0.00, 0, 0, '2026-07-23 11:13:42', '2026-07-23 11:13:42'),
(16, 1, 1, 6, 2, 5, 2, NULL, NULL, 66.00, 2.00, 132.00, 0.00, 0.00, 0.00, 0, 0, '2026-09-06 11:34:19', '2026-09-06 11:34:19'),
(17, 1, 1, 6, 2, 5, 4, NULL, NULL, 33.00, 2.00, 66.00, 0.00, 0.00, 0.00, 0, 0, '2026-09-06 11:34:19', '2026-09-06 11:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_man_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charges`
--

CREATE TABLE `delivery_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inside_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `outside_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `upto` decimal(8,2) NOT NULL DEFAULT 0.00,
  `charge_for_extra` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_charges`
--

INSERT INTO `delivery_charges` (`id`, `inside_charge`, `outside_charge`, `upto`, `charge_for_extra`, `created_at`, `updated_at`) VALUES
(1, 80.00, 150.00, 0.00, 0.00, '2023-11-18 04:06:32', '2024-10-26 09:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_lists`
--

CREATE TABLE `delivery_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(16,2) NOT NULL,
  `qty` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `sales_list_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_men`
--

CREATE TABLE `delivery_men` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_men`
--

INSERT INTO `delivery_men` (`id`, `company_id`, `store_id`, `code`, `name`, `phone`, `address`, `email`, `national_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '1', 'Rampura Office Delivery', NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, '2024-10-25 08:41:58', '2024-10-25 08:41:58'),
(2, 1, 2, '2', 'siddik', '01753444229', NULL, NULL, NULL, 1, 152, 152, NULL, NULL, '2024-11-13 09:02:59', '2024-11-13 09:03:21'),
(3, 1, 2, '3', 'speedy express', NULL, NULL, NULL, NULL, 1, 152, NULL, NULL, NULL, '2024-11-22 07:56:04', '2024-11-22 07:56:04'),
(4, 1, 2, '4', 'showkot', '01812313265', NULL, NULL, NULL, 1, 152, NULL, NULL, NULL, '2024-12-03 10:57:42', '2024-12-03 10:57:42'),
(5, 1, 2, '5', 'siam', '01614681945', NULL, NULL, NULL, 1, 152, NULL, NULL, NULL, '2024-12-03 10:58:40', '2024-12-03 10:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `details_cards`
--

CREATE TABLE `details_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `serial` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `team_leader` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_sales_targets`
--

CREATE TABLE `group_sales_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `total_target` decimal(16,2) NOT NULL,
  `total_target_amount` decimal(16,2) NOT NULL,
  `target_type` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_sales_target_categories`
--

CREATE TABLE `group_sales_target_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_sales_target_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `target` decimal(16,2) NOT NULL,
  `target_amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_sections`
--

CREATE TABLE `home_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `banner_link` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sections`
--

INSERT INTO `home_sections` (`id`, `category_id`, `banner`, `banner_link`, `order`, `status`, `created_at`, `updated_at`) VALUES
(8, 44, NULL, NULL, 2, 0, '2024-07-25 06:58:39', '2025-05-03 13:02:39'),
(9, 43, NULL, NULL, 3, 0, '2024-07-25 06:58:45', '2025-05-03 13:02:41'),
(10, 65, NULL, NULL, 4, 0, '2025-05-03 10:54:50', '2025-05-03 13:02:42'),
(11, 57, NULL, NULL, 5, 0, '2025-05-03 12:42:19', '2025-05-09 11:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `home_section_sub_categories`
--

CREATE TABLE `home_section_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_section_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_section_sub_categories`
--

INSERT INTO `home_section_sub_categories` (`id`, `home_section_id`, `category_id`, `created_at`, `updated_at`) VALUES
(20, 10, 66, '2025-05-03 10:54:50', '2025-05-03 10:54:50'),
(24, 11, 84, '2025-05-03 16:16:05', '2025-05-03 16:16:05'),
(25, 11, 81, '2025-05-03 16:16:05', '2025-05-03 16:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_appraisal`
--

CREATE TABLE `hrm_employee_appraisal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `overall_rating` varchar(255) DEFAULT '0',
  `appraisal_period` varchar(255) DEFAULT '',
  `appraisal_date` date NOT NULL,
  `summary` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_appraisal`
--

INSERT INTO `hrm_employee_appraisal` (`id`, `employee_id`, `overall_rating`, `appraisal_period`, `appraisal_date`, `summary`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 62, '5', '6', '2026-08-09', 'FDSFS', 'Approved', 1, 1, '2026-08-09 10:49:58', '2026-08-09 10:58:15'),
(3, 63, '45', '5', '2026-08-09', 'dfgdfgfd', 'Pending', 1, NULL, '2026-08-09 10:53:40', '2026-08-09 10:53:40'),
(5, 52, '33', '33', '2026-08-09', '33', 'Pending', 1, NULL, '2026-08-09 10:58:06', '2026-08-09 10:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_attendances`
--

CREATE TABLE `hrm_employee_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `late_minutes` int(11) DEFAULT 0,
  `overtime_minutes` int(11) DEFAULT 0,
  `worked_hours` decimal(5,2) DEFAULT 0.00,
  `attendance_status` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_attendances`
--

INSERT INTO `hrm_employee_attendances` (`id`, `employee_id`, `attendance_date`, `check_in`, `check_out`, `late_minutes`, `overtime_minutes`, `worked_hours`, `attendance_status`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 60, '2026-07-28', '09:06:00', '23:18:00', 6, 318, 14.20, 'Present', 'this is', 1, 1, '2026-07-28 11:01:54', '2026-07-28 11:43:28'),
(2, 60, '2026-07-29', '10:15:00', '22:14:00', 75, 254, 11.98, 'Present', 'sdasdas', 1, NULL, '2026-07-29 04:14:55', '2026-07-29 04:14:55'),
(3, 63, '2026-07-29', '10:15:00', '22:14:00', 75, 254, 11.98, 'Present', 'sdasdas', 1, NULL, '2026-07-29 04:14:55', '2026-07-29 04:14:55'),
(4, 62, '2026-07-29', '10:15:00', '22:15:00', 75, 255, 12.00, 'Present', NULL, 1, NULL, '2026-07-29 04:15:18', '2026-07-29 04:15:18'),
(5, 62, '2026-07-29', '10:16:00', '22:16:00', 76, 256, 12.00, 'Present', 'ssaa', 1, NULL, '2026-07-29 04:16:27', '2026-07-29 04:16:27'),
(6, 62, '2026-07-29', '10:17:00', '22:17:00', 77, 257, 12.00, 'Present', 'aS', 1, NULL, '2026-07-29 04:17:09', '2026-07-29 04:17:09'),
(7, 61, '2026-07-29', '11:47:00', '23:48:00', 167, 348, 12.02, 'Leave', 'ssaa', 1, 1, '2026-07-29 06:01:35', '2026-08-04 11:52:21'),
(8, 59, '2026-07-29', '11:47:00', '23:48:00', 167, 348, 12.02, 'Absent', 'ssaa', 1, 1, '2026-07-29 06:01:37', '2026-09-14 00:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_bonuses`
--

CREATE TABLE `hrm_employee_bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `bonus_type` varchar(255) DEFAULT NULL,
  `payroll_month` varchar(255) DEFAULT NULL,
  `payroll_year` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_bonuses`
--

INSERT INTO `hrm_employee_bonuses` (`id`, `employee_id`, `bonus_type`, `payroll_month`, `payroll_year`, `amount`, `payment_date`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 63, 'Yearly', '1', '2026', 347.00, '2026-08-06', 'dsfsdfdf', 'Approved', 1, 1, '2026-08-06 05:01:56', '2026-08-06 05:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_documents`
--

CREATE TABLE `hrm_employee_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `document_type` varchar(255) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_link` varchar(255) DEFAULT NULL,
  `submit_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_documents`
--

INSERT INTO `hrm_employee_documents` (`id`, `employee_id`, `document_type`, `document_name`, `document_link`, `submit_date`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 60, 'Birth Certificate', 'sdfsd', 'https://technoparkbd.com/', '2026-08-09', 'ggggg', 'Pending', 1, 1, '2026-08-09 06:58:27', '2026-08-09 07:14:35'),
(3, 60, 'NID', 'asdsad', 'https://technoparkbd.com/', '2026-08-09', 'asdasda', 'Submitted', 1, 1, '2026-08-09 07:01:37', '2026-08-09 07:14:13'),
(4, 60, 'ALL', 'sdsds', 'https://technoparkbd.com/', '2026-08-09', 'fsfasf', 'Pending', 1, 1, '2026-08-09 07:17:01', '2026-09-22 06:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_holidays`
--

CREATE TABLE `hrm_employee_holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_type` varchar(100) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` decimal(5,2) NOT NULL DEFAULT 0.00,
  `repeat_yearly` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=No, 1=Yes',
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_holidays`
--

INSERT INTO `hrm_employee_holidays` (`id`, `company_id`, `holiday_name`, `holiday_type`, `from_date`, `to_date`, `total_days`, `repeat_yearly`, `branch_id`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'asdasdd', 'Public Holiday', '2026-07-29', '2026-07-31', 3.00, 1, NULL, 'sadadas', 1, 1, 1, '2026-07-29 07:25:40', '2026-07-29 08:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_increment`
--

CREATE TABLE `hrm_employee_increment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `increment_type` varchar(255) DEFAULT NULL,
  `payroll_month` varchar(255) DEFAULT NULL,
  `payroll_year` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_increment`
--

INSERT INTO `hrm_employee_increment` (`id`, `employee_id`, `increment_type`, `payroll_month`, `payroll_year`, `amount`, `payment_date`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 63, 'Yearly', '1', '2026', 347.00, '2026-08-06', 'dsfsdfdf', 'Pending', 1, 1, '2026-08-06 05:01:56', '2026-08-06 06:20:32'),
(2, 62, 'Festival', '1', '2026', 3444.00, '2026-08-06', 'xzcxcx', 'Approved', 1, NULL, '2026-08-06 06:05:16', '2026-08-06 06:05:16');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_leaves`
--

CREATE TABLE `hrm_employee_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` decimal(5,2) NOT NULL DEFAULT 0.00,
  `day_type` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_leaves`
--

INSERT INTO `hrm_employee_leaves` (`id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `total_days`, `day_type`, `reason`, `attachment`, `status`, `approved_by`, `approved_at`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 60, 'Casual Leave', '2026-07-29', '2026-07-29', 0.50, 'First Half', 'asdasdsads', NULL, 'Pending', NULL, NULL, 'sdsad', 1, NULL, '2026-07-29 06:52:01', '2026-07-29 06:52:01'),
(2, 60, 'Casual Leave', '2026-08-04', '2026-08-04', 0.50, 'First Half', 'dsadsadasd', NULL, 'Rejected', NULL, NULL, 'ddasd', 1, 1, '2026-07-29 06:53:03', '2026-08-04 03:52:13'),
(3, 60, 'Casual Leave', '2026-08-04', '2026-08-06', 2.00, 'Full Day', 'vdfvd', NULL, 'Pending', NULL, NULL, 'vdfvdf', 1, NULL, '2026-08-04 03:42:33', '2026-08-04 04:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_loan`
--

CREATE TABLE `hrm_employee_loan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `payroll_month` varchar(255) DEFAULT NULL,
  `payroll_year` varchar(255) DEFAULT NULL,
  `loan_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `installment_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_installments` decimal(12,2) NOT NULL DEFAULT 0.00,
  `loan_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_loan`
--

INSERT INTO `hrm_employee_loan` (`id`, `employee_id`, `loan_type`, `payroll_month`, `payroll_year`, `loan_amount`, `installment_amount`, `total_installments`, `loan_date`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 63, 'Personal Loan', '1', '2026', 555.00, 6.00, 350.00, '2026-08-06', 'fgdfd', 'Pending', 1, 1, '2026-08-06 06:37:19', '2026-08-06 10:47:22'),
(3, 63, 'Personal Loan', '1', '2026', 444.00, 8.00, 0.00, '2026-08-06', 'sdfsdf', 'Approved', 1, 1, '2026-08-06 06:43:34', '2026-08-10 05:54:20'),
(4, 60, 'Personal Loan', '1', '2026', 333.00, 33.00, 33.00, '2026-08-06', 'fdsfsdfs', 'Pending', 1, 1, '2026-08-06 07:01:16', '2026-08-06 07:01:43'),
(5, 63, 'Personal Loan', '4', '2026', 30.00, 10.00, 360.00, '2026-08-06', 'ddd', 'Approved', 1, NULL, '2026-08-06 10:48:13', '2026-08-10 05:54:32'),
(6, 60, 'Salary Advance', '1', '2026', 55.00, 34.00, 67.00, '2026-08-09', NULL, 'Pending', 1, NULL, '2026-08-09 04:14:38', '2026-08-09 04:14:38'),
(7, 60, 'Salary Advance', '1', '2026', 60000.00, 3000.00, 3100.00, '2026-10-05', NULL, 'Pending', 1, NULL, '2026-10-04 18:03:06', '2026-10-04 18:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_overtime`
--

CREATE TABLE `hrm_employee_overtime` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `overtime_type` varchar(255) DEFAULT NULL,
  `payroll_month` varchar(255) DEFAULT NULL,
  `payroll_year` varchar(255) DEFAULT NULL,
  `overtime_hour` decimal(12,2) NOT NULL DEFAULT 0.00,
  `overtime_rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `overtime_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `overtime_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_overtime`
--

INSERT INTO `hrm_employee_overtime` (`id`, `employee_id`, `overtime_type`, `payroll_month`, `payroll_year`, `overtime_hour`, `overtime_rate`, `overtime_amount`, `overtime_date`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 63, 'Regular Overtime', '1', '2026', 33.00, 6.00, 198.00, '2026-08-09', 'sdsds', 'Pending', 1, 1, '2026-08-09 05:02:00', '2026-08-09 05:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_payrolls`
--

CREATE TABLE `hrm_employee_payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `payroll_month` tinyint(4) NOT NULL,
  `payroll_year` year(4) NOT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `basic_salary` decimal(12,2) NOT NULL DEFAULT 0.00,
  `house_rent` decimal(12,2) NOT NULL DEFAULT 0.00,
  `medical_allowance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `conveyance_allowance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `food_allowance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `mobile_allowance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `other_allowance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `gross_salary` decimal(12,2) NOT NULL DEFAULT 0.00,
  `working_days` int(11) NOT NULL DEFAULT 0,
  `present_days` int(11) NOT NULL DEFAULT 0,
  `absent_days` int(11) NOT NULL DEFAULT 0,
  `leave_days` int(11) NOT NULL DEFAULT 0,
  `late_count` int(11) NOT NULL DEFAULT 0,
  `late_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `overtime_hours` decimal(8,2) NOT NULL DEFAULT 0.00,
  `overtime_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(12,2) NOT NULL DEFAULT 0.00,
  `provident_fund` decimal(12,2) NOT NULL DEFAULT 0.00,
  `loan_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `advance_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `attendance_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `other_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `festival_bonus` decimal(12,2) NOT NULL DEFAULT 0.00,
  `performance_bonus` decimal(12,2) NOT NULL DEFAULT 0.00,
  `commission` decimal(12,2) NOT NULL DEFAULT 0.00,
  `other_addition` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_addition` decimal(12,2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_payrolls`
--

INSERT INTO `hrm_employee_payrolls` (`id`, `employee_id`, `payroll_month`, `payroll_year`, `payment_type`, `basic_salary`, `house_rent`, `medical_allowance`, `conveyance_allowance`, `food_allowance`, `mobile_allowance`, `other_allowance`, `gross_salary`, `working_days`, `present_days`, `absent_days`, `leave_days`, `late_count`, `late_deduction`, `overtime_hours`, `overtime_amount`, `tax`, `provident_fund`, `loan_deduction`, `advance_deduction`, `attendance_deduction`, `other_deduction`, `total_deduction`, `festival_bonus`, `performance_bonus`, `commission`, `other_addition`, `total_addition`, `net_salary`, `payment_date`, `payment_method`, `bank_name`, `account_no`, `transaction_no`, `payment_status`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 63, 7, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'ffsdfsdfsdf', 1, NULL, '2026-08-04 04:07:22', '2026-08-04 07:12:54'),
(3, 62, 7, '2026', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'sdsdsds', 1, NULL, '2026-08-04 07:13:38', '2026-08-04 07:15:32'),
(4, 63, 7, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'asdasd', 1, 1, '2026-08-04 07:13:53', '2026-08-04 07:15:58'),
(5, 52, 7, '2026', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'asdasd', 1, NULL, '2026-08-04 07:14:36', '2026-08-04 07:15:52'),
(6, 61, 7, '2026', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'asdsad', 1, 1, '2026-08-04 07:14:48', '2026-08-04 07:15:45'),
(7, 59, 7, '2026', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'asdasd', 1, NULL, '2026-08-04 07:15:14', '2026-08-04 07:15:39'),
(8, 63, 8, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'Salary pay kora hoise sobar', 1, NULL, '2026-08-04 09:08:37', '2026-08-04 09:08:37'),
(9, 62, 8, '2026', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'Salary pay kora hoise sobar', 1, NULL, '2026-08-04 09:08:37', '2026-08-04 09:08:37'),
(10, 63, 8, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Pending', 'Salary pay kora hoise sobar', 1, 1, '2026-08-04 09:08:37', '2026-08-10 09:57:48'),
(11, 52, 8, '2026', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'Salary pay kora hoise sobar', 1, NULL, '2026-08-04 09:08:37', '2026-08-04 09:08:37'),
(12, 61, 8, '2026', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'Salary pay kora hoise sobar', 1, 1, '2026-08-04 09:08:37', '2026-08-04 09:08:37'),
(13, 59, 8, '2026', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'Salary pay kora hoise sobar', 1, NULL, '2026-08-04 09:08:37', '2026-08-04 09:08:37'),
(14, 63, 9, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'Salary', 1, NULL, '2026-08-04 09:10:56', '2026-08-04 09:10:56'),
(15, 62, 9, '2026', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'Salary', 1, NULL, '2026-08-04 09:10:56', '2026-08-04 09:10:56'),
(16, 63, 9, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'Salary', 1, 1, '2026-08-04 09:10:56', '2026-08-04 09:10:56'),
(17, 52, 9, '2026', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'Salary', 1, NULL, '2026-08-04 09:10:56', '2026-08-04 09:10:56'),
(18, 61, 9, '2026', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'Salary', 1, 1, '2026-08-04 09:10:56', '2026-08-04 09:10:56'),
(19, 59, 9, '2026', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'Salary', 1, NULL, '2026-08-04 09:10:56', '2026-08-04 09:10:56'),
(20, 63, 10, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:03', '2026-08-04 09:14:03'),
(21, 62, 10, '2026', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:03', '2026-08-04 09:14:03'),
(22, 63, 10, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, 1, '2026-08-04 09:14:03', '2026-08-04 09:14:03'),
(23, 52, 10, '2026', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:03', '2026-08-04 09:14:03'),
(24, 61, 10, '2026', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, 1, '2026-08-04 09:14:03', '2026-08-04 09:14:03'),
(25, 59, 10, '2026', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:03', '2026-08-04 09:14:03'),
(26, 63, 11, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:52', '2026-08-04 09:14:52'),
(27, 62, 11, '2026', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:52', '2026-08-04 09:14:52'),
(28, 63, 11, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, 1, '2026-08-04 09:14:52', '2026-08-04 09:14:52'),
(29, 52, 11, '2026', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:52', '2026-08-04 09:14:52'),
(30, 61, 11, '2026', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, 1, '2026-08-04 09:14:52', '2026-08-04 09:14:52'),
(31, 59, 11, '2026', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:14:52', '2026-08-04 09:14:52'),
(32, 63, 12, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'dsfsfsfsdf', 1, NULL, '2026-08-04 09:16:12', '2026-08-04 09:16:12'),
(33, 62, 12, '2026', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'dsfsfsfsdf', 1, NULL, '2026-08-04 09:16:12', '2026-08-04 09:16:12'),
(34, 63, 12, '2026', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'dsfsfsfsdf', 1, 1, '2026-08-04 09:16:12', '2026-08-04 09:16:12'),
(35, 52, 12, '2026', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'dsfsfsfsdf', 1, NULL, '2026-08-04 09:16:12', '2026-08-04 09:16:12'),
(36, 61, 12, '2026', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', 'dsfsfsfsdf', 1, 1, '2026-08-04 09:16:12', '2026-08-04 09:16:12'),
(37, 59, 12, '2026', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', 'dsfsfsfsdf', 1, NULL, '2026-08-04 09:16:12', '2026-08-04 09:16:12'),
(38, 63, 1, '2027', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:16:39', '2026-08-04 09:16:39'),
(39, 62, 1, '2027', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:16:39', '2026-08-04 09:16:39'),
(40, 63, 1, '2027', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, 1, '2026-08-04 09:16:39', '2026-08-04 09:16:39'),
(41, 52, 1, '2027', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:16:39', '2026-08-04 09:16:39'),
(42, 61, 1, '2027', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, 1, '2026-08-04 09:16:39', '2026-08-04 09:16:39'),
(43, 59, 1, '2027', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 09:16:39', '2026-08-04 09:16:39'),
(44, 63, 2, '2027', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 10:17:49', '2026-08-04 10:17:49'),
(45, 62, 2, '2027', 'Monthly', 44444.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 50609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 50609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 10:17:49', '2026-08-04 10:17:49'),
(46, 63, 2, '2027', 'Monthly', 10000.00, 5000.00, 3000.00, 0.00, 0.00, 0.00, 2000.00, 20000.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20000.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, 1, '2026-08-04 10:17:49', '2026-08-04 10:17:49'),
(47, 52, 2, '2027', 'Monthly', 55555.00, 5555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 61220.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 61220.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 10:17:49', '2026-08-04 10:17:49'),
(48, 61, 2, '2027', 'Monthly', 33333.00, 555.00, 55.00, 0.00, 0.00, 0.00, 55.00, 33998.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 33998.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, 1, '2026-08-04 10:17:49', '2026-08-04 10:17:49'),
(49, 59, 2, '2027', 'Monthly', 5555.00, 5555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 11720.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 11720.00, '2026-08-04', 'Cash', 'Rampura', 'AC#34334444432', NULL, 'Paid', NULL, 1, NULL, '2026-08-04 10:17:49', '2026-08-04 10:17:49'),
(50, 60, 7, '2026', 'Monthly', 44444.00, 555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 45609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 45609.00, '2026-08-04', 'Cash', NULL, NULL, NULL, 'Paid', NULL, 1, NULL, '2026-08-04 11:14:20', '2026-08-04 11:14:33'),
(51, 60, 9, '2026', 'Monthly', 44444.00, 555.00, 555.00, 0.00, 0.00, 0.00, 55.00, 45609.00, 0, 0, 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 45609.00, '2026-09-14', 'Cash', NULL, NULL, NULL, 'Pending', NULL, 174, NULL, '2026-09-14 07:26:09', '2026-09-14 07:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_resignation`
--

CREATE TABLE `hrm_employee_resignation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `notice_period` varchar(255) DEFAULT NULL,
  `resignation_date` date NOT NULL,
  `last_working_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_resignation`
--

INSERT INTO `hrm_employee_resignation` (`id`, `employee_id`, `notice_period`, `resignation_date`, `last_working_date`, `reason`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 60, '33', '2026-08-09', '2026-08-09', 'dfdfdf', 'Approved', 1, 1, '2026-08-09 09:14:27', '2026-08-09 09:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employee_termination`
--

CREATE TABLE `hrm_employee_termination` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `notice_period` varchar(255) DEFAULT NULL,
  `termination_date` date NOT NULL,
  `last_working_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_employee_termination`
--

INSERT INTO `hrm_employee_termination` (`id`, `employee_id`, `notice_period`, `termination_date`, `last_working_date`, `reason`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 63, '5', '2026-08-09', '2026-08-09', 'gggg', 'Approved', 1, 1, '2026-08-09 09:30:02', '2026-08-09 09:32:05'),
(3, 60, '1', '2026-09-23', '2026-09-23', NULL, 'Pending', 1, NULL, '2026-09-23 11:02:18', '2026-09-23 11:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_expense`
--

CREATE TABLE `hrm_expense` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_head_id` bigint(20) UNSIGNED NOT NULL,
  `expense_month` varchar(255) DEFAULT NULL,
  `expense_year` varchar(255) DEFAULT NULL,
  `expense_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `expense_date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrm_expense`
--

INSERT INTO `hrm_expense` (`id`, `expense_head_id`, `expense_month`, `expense_year`, `expense_amount`, `expense_date`, `remarks`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 126, '1', '2026', 66.00, '2026-08-09', 'sdasdasd', 'Approved', 1, 1, '2026-08-09 06:10:19', '2026-08-09 06:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `bkash` varchar(255) DEFAULT NULL,
  `rocket` varchar(255) DEFAULT NULL,
  `nagad` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investor_payments`
--

CREATE TABLE `investor_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `payment_no` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(16,0) NOT NULL,
  `deposit_type` varchar(255) NOT NULL,
  `bkash` varchar(255) DEFAULT NULL,
  `rocket` varchar(255) DEFAULT NULL,
  `nagad` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `data` text NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investor_profits`
--

CREATE TABLE `investor_profits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `total_profit` decimal(16,0) NOT NULL,
  `investor_percentage` decimal(16,0) NOT NULL,
  `total_share` int(11) NOT NULL,
  `amount` decimal(16,0) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investor_profit_lists`
--

CREATE TABLE `investor_profit_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_profit_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `share_qty` int(11) NOT NULL,
  `amount` decimal(16,0) NOT NULL,
  `deposited_amount` decimal(16,0) NOT NULL DEFAULT 0,
  `deposited` tinyint(4) NOT NULL DEFAULT 0,
  `deposit_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invests`
--

CREATE TABLE `invests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `invest_no` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(16,0) NOT NULL,
  `deposit_type` varchar(255) DEFAULT NULL,
  `bkash` varchar(255) DEFAULT NULL,
  `rocket` varchar(255) DEFAULT NULL,
  `nagad` varchar(255) DEFAULT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `sattled` tinyint(4) NOT NULL DEFAULT 0,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liftings`
--

CREATE TABLE `liftings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lifting_no` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL DEFAULT 'credit',
  `voucher_no` varchar(255) DEFAULT NULL,
  `lifting_date` date NOT NULL,
  `total_cost` decimal(16,2) NOT NULL,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `net_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_paid` decimal(16,2) NOT NULL DEFAULT 0.00,
  `return_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `return_paid` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liftings`
--

INSERT INTO `liftings` (`id`, `company_id`, `product_type`, `store_id`, `vendor_id`, `coa_setup_id`, `lifting_no`, `payment_type`, `voucher_no`, `lifting_date`, `total_cost`, `discount`, `net_amount`, `total_paid`, `return_amount`, `return_paid`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', 2, 1, NULL, 'STL2605000001', 'credit', NULL, '2026-05-07', 330.00, 0.00, 330.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-05-07 09:50:04', '2026-05-07 09:50:04'),
(2, 1, 'Consumer', 2, 66, NULL, 'STL2607000001', 'credit', NULL, '2026-07-07', 3300.00, 0.00, 3300.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-07-07 10:16:51', '2026-07-07 10:16:51'),
(3, 1, 'Consumer', 2, 1, NULL, 'STL2607000002', 'credit', '22', '2026-07-27', 5000.00, 0.00, 5000.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-07-27 04:28:41', '2026-07-27 04:28:41'),
(4, 1, 'Consumer', 2, 66, NULL, 'STL2609000001', 'credit', NULL, '2026-09-10', 5025.00, 0.00, 5025.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-09-10 10:59:37', '2026-09-10 10:59:37'),
(5, 1, 'Consumer', 2, 66, NULL, 'STL2609000002', 'credit', NULL, '2026-09-10', 3560.00, 0.00, 3560.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-09-10 11:00:19', '2026-09-10 11:00:19'),
(6, 1, 'Consumer', 2, 126, NULL, 'STL2609000003', 'credit', '68965899', '2026-09-14', 3300.00, 0.00, 3300.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-09-14 00:31:52', '2026-09-14 00:31:52'),
(7, 1, 'Consumer', 2, 59, 26, 'STL2609000004', 'cash', NULL, '2026-09-14', 5000.00, 0.00, 5000.00, 5000.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(8, 1, 'Consumer', 2, 1, NULL, 'STL2609000005', 'credit', NULL, '2026-09-14', 2063360.00, 0.00, 2063360.00, 0.00, 0.00, 0.00, 1, 176, NULL, NULL, NULL, '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(9, 1, 'Consumer', 2, 66, NULL, 'STL2609000006', 'credit', NULL, '2026-09-17', 470.00, 0.00, 470.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(10, 1, 'Consumer', 2, 126, NULL, 'STL2609000007', 'credit', NULL, '2026-09-21', 71200.00, 0.00, 71200.00, 0.00, 0.00, 0.00, 1, 1, NULL, NULL, NULL, '2026-09-21 06:54:43', '2026-09-21 06:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `lifting_documents`
--

CREATE TABLE `lifting_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lifting_products`
--

CREATE TABLE `lifting_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `lifting_price` decimal(16,2) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `qty` decimal(16,2) NOT NULL DEFAULT 1.00,
  `total_amount` decimal(16,2) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `net_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_paid` decimal(16,2) NOT NULL DEFAULT 0.00,
  `return_qty` decimal(8,2) NOT NULL DEFAULT 0.00,
  `return_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lifting_products`
--

INSERT INTO `lifting_products` (`id`, `lifting_id`, `company_id`, `store_id`, `vendor_id`, `product_id`, `variant_id`, `product_type`, `lifting_price`, `expiry_date`, `qty`, `total_amount`, `discount`, `net_amount`, `total_paid`, `return_qty`, `return_amount`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 1, NULL, 'Consumer', 33.00, NULL, 10.00, 330.00, 0.00, 330.00, 0.00, 0.00, 0.00, 1, 1, '2026-05-07 09:50:04', '2026-05-07 09:50:04'),
(2, 2, 1, 2, 66, 1, NULL, 'Consumer', 33.00, NULL, 100.00, 3300.00, 0.00, 3300.00, 0.00, 0.00, 0.00, 1, 1, '2026-07-07 10:16:51', '2026-07-07 10:16:51'),
(3, 3, 1, 2, 1, 3, NULL, 'Consumer', 50.00, NULL, 100.00, 5000.00, 0.00, 5000.00, 0.00, 0.00, 0.00, 1, 1, '2026-07-27 04:28:41', '2026-07-27 04:28:41'),
(4, 4, 1, 2, 66, 5, NULL, 'Consumer', 1005.00, NULL, 5.00, 5025.00, 0.00, 5025.00, 0.00, 0.00, 0.00, 1, 1, '2026-09-10 10:59:37', '2026-09-10 10:59:37'),
(5, 5, 1, 2, 66, 6, NULL, 'Consumer', 712.00, NULL, 5.00, 3560.00, 0.00, 3560.00, 0.00, 0.00, 0.00, 1, 1, '2026-09-10 11:00:19', '2026-09-10 11:00:19'),
(6, 6, 1, 2, 126, 1, NULL, 'Consumer', 33.00, NULL, 100.00, 3300.00, 0.00, 3300.00, 0.00, 0.00, 0.00, 1, 1, '2026-09-14 00:31:52', '2026-09-14 00:31:52'),
(7, 7, 1, 2, 59, 2, NULL, 'Consumer', 50.00, NULL, 100.00, 5000.00, 0.00, 5000.00, 5000.00, 0.00, 0.00, 1, 1, '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(8, 8, 1, 2, 1, 6, NULL, 'Consumer', 712.00, NULL, 2560.00, 1822720.00, 0.00, 1822720.00, 0.00, 0.00, 0.00, 1, 176, '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(9, 8, 1, 2, 1, 3, NULL, 'Consumer', 50.00, NULL, 2560.00, 128000.00, 0.00, 128000.00, 0.00, 0.00, 0.00, 1, 176, '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(10, 8, 1, 2, 1, 2, NULL, 'Consumer', 44.00, NULL, 2560.00, 112640.00, 0.00, 112640.00, 0.00, 0.00, 0.00, 1, 176, '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(11, 9, 1, 2, 66, 3, NULL, 'Consumer', 50.00, NULL, 5.00, 250.00, 0.00, 250.00, 0.00, 0.00, 0.00, 1, 1, '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(12, 9, 1, 2, 66, 2, NULL, 'Consumer', 44.00, NULL, 5.00, 220.00, 0.00, 220.00, 0.00, 0.00, 0.00, 1, 1, '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(13, 10, 1, 2, 126, 6, NULL, 'Consumer', 712.00, NULL, 100.00, 71200.00, 0.00, 71200.00, 0.00, 0.00, 0.00, 1, 1, '2026-09-21 06:54:43', '2026-09-21 06:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `lifting_returns`
--

CREATE TABLE `lifting_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lifting_returns`
--

INSERT INTO `lifting_returns` (`id`, `company_id`, `product_type`, `vendor_id`, `store_id`, `return_no`, `date`, `amount`, `remarks`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 1, 'Consumer', 15, 2, 'STR2506000001', '2025-06-15', 1140.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-06-15 08:28:30', '2025-06-15 08:28:30'),
(4, 1, 'Consumer', 50, 2, 'STR2506000002', '2025-06-19', 808.50, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-06-19 15:11:28', '2025-06-19 15:11:28'),
(5, 1, 'Consumer', 22, 2, 'STR2506000003', '2025-06-26', 1650.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-06-26 07:36:59', '2025-06-26 07:39:55'),
(6, 1, 'Consumer', 24, 2, 'STR2506000004', '2025-06-28', 1368.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-06-28 15:02:52', '2025-06-28 15:02:52'),
(7, 1, 'Consumer', 22, 2, 'STR2506000005', '2025-06-29', 5250.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-06-29 15:35:22', '2025-07-02 10:17:58'),
(8, 1, 'Consumer', 22, 2, 'STR2506000006', '2025-06-29', 6000.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-06-29 15:38:26', '2025-06-29 17:49:12'),
(9, 1, 'Consumer', 51, 2, 'STR2507000001', '2025-07-06', 1480.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-07-06 10:57:23', '2025-07-06 10:57:23'),
(10, 1, 'Consumer', 22, 2, 'STR2507000002', '2025-07-07', 4500.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-07-07 14:30:49', '2025-07-07 14:30:49'),
(11, 1, 'Consumer', 22, 2, 'STR2507000003', '2025-07-07', 3000.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-07-07 14:48:15', '2025-07-07 14:48:15'),
(12, 1, 'Consumer', 22, 2, 'STR2507000004', '2025-07-07', 1500.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-07-07 15:00:32', '2025-07-07 15:00:32'),
(14, 1, 'Consumer', 7, 2, 'STR2507000005', '2025-07-09', 1020.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-07-09 11:26:55', '2025-07-09 11:26:55'),
(15, 1, 'Consumer', 4, 2, 'STR2507000006', '2025-07-14', 3355.96, 'Cash Purchase', 159, 159, NULL, NULL, '2025-07-14 12:53:41', '2025-07-14 13:55:19'),
(16, 1, 'Consumer', 1, 2, 'STR2507000007', '2025-07-14', 868.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-07-14 12:54:33', '2025-07-14 14:23:33'),
(17, 1, 'Consumer', 51, 2, 'STR2507000008', '2025-07-24', 2483.60, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-07-24 13:10:00', '2025-07-24 13:10:00'),
(18, 1, 'Consumer', 8, 2, 'STR2508000001', '2025-08-07', 570.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-07 15:50:12', '2025-08-07 15:50:12'),
(19, 1, 'Consumer', 68, 2, 'STR2508000002', '2025-08-11', 80.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-08-11 13:34:24', '2025-08-11 13:41:23'),
(20, 1, 'Consumer', 22, 2, 'STR2508000003', '2025-08-15', 5080.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-15 11:11:09', '2025-08-15 11:11:09'),
(21, 1, 'Consumer', 41, 2, 'STR2508000004', '2025-08-16', 150.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-16 15:16:37', '2025-08-16 15:16:37'),
(22, 1, 'Consumer', 68, 2, 'STR2508000005', '2025-08-18', 75.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-18 09:05:02', '2025-08-18 09:05:02'),
(23, 1, 'Consumer', 10, 2, 'STR2508000006', '2025-08-18', 671.97, 'Cash Purchase', 159, 159, NULL, NULL, '2025-08-18 15:06:07', '2025-08-18 15:19:05'),
(24, 1, 'Consumer', 10, 2, 'STR2508000007', '2025-08-18', 180.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-08-18 15:16:10', '2025-08-18 15:19:52'),
(25, 1, 'Consumer', 10, 2, 'STR2508000008', '2025-08-18', 95.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-08-18 15:17:58', '2025-08-18 15:23:49'),
(26, 1, 'Consumer', 37, 2, 'STR2508000009', '2025-08-20', 175.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-20 08:02:18', '2025-08-20 08:02:18'),
(27, 1, 'Consumer', 22, 2, 'STR2508000010', '2025-08-23', 2700.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-23 13:46:35', '2025-08-23 13:46:35'),
(28, 1, 'Consumer', 38, 2, 'STR2508000011', '2025-08-26', 1158.17, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-26 13:00:39', '2025-08-26 13:00:39'),
(29, 1, 'Consumer', 38, 2, 'STR2508000012', '2025-08-26', 1061.20, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-26 13:01:53', '2025-08-26 13:01:53'),
(30, 1, 'Consumer', 68, 2, 'STR2508000013', '2025-08-27', 55.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-08-27 08:26:00', '2025-08-27 08:26:00'),
(31, 1, 'Consumer', 6, 2, 'STR2509000001', '2025-09-09', 580.00, 'Broken', 159, NULL, NULL, NULL, '2025-09-09 09:35:41', '2025-09-09 09:35:41'),
(32, 1, 'Consumer', 68, 2, 'STR2509000002', '2025-09-10', 30.00, 'Cash Purchase', 159, 159, NULL, NULL, '2025-09-10 08:47:10', '2025-09-10 09:03:11'),
(33, 1, 'Consumer', 68, 2, 'STR2509000003', '2025-09-10', 110.00, 'Broken', 159, 159, NULL, NULL, '2025-09-10 08:47:42', '2025-09-10 09:03:49'),
(34, 1, 'Consumer', 38, 2, 'STR2509000004', '2025-09-13', 235.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-09-13 11:45:26', '2025-09-13 11:45:26'),
(35, 1, 'Consumer', 72, 2, 'STR2509000005', '2025-09-21', 147.67, 'Broken', 159, NULL, NULL, NULL, '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(36, 1, 'Consumer', 65, 2, 'STR2509000006', '2025-09-24', 600.00, 'Cash Purchase', 159, NULL, NULL, NULL, '2025-09-24 11:24:42', '2025-09-24 11:24:42'),
(37, 1, 'Consumer', 12, 2, 'STR2510000001', '2025-10-05', 239.00, 'Broken', 159, NULL, NULL, NULL, '2025-10-05 10:03:22', '2025-10-05 10:03:22'),
(38, 1, 'Consumer', 62, 2, 'STR2510000002', '2025-10-11', 960.00, 'Broken', 159, NULL, NULL, NULL, '2025-10-11 09:25:08', '2025-10-11 09:25:08'),
(39, 1, 'Consumer', 90, 2, 'STR2510000003', '2025-10-12', 227.00, 'Broken', 159, NULL, NULL, NULL, '2025-10-12 10:39:43', '2025-10-12 10:39:43'),
(40, 1, 'Consumer', 12, 2, 'STR2510000004', '2025-10-12', 1092.00, 'Date Over', 159, 159, NULL, NULL, '2025-10-12 10:43:24', '2025-10-12 10:47:36'),
(41, 1, 'Consumer', 12, 2, 'STR2510000005', '2025-10-12', 2160.00, 'Date Over', 159, NULL, NULL, NULL, '2025-10-12 10:44:16', '2025-10-12 10:44:16'),
(42, 1, 'Consumer', 34, 2, 'STR2510000006', '2025-10-15', 1615.00, 'Date Over', 159, NULL, NULL, NULL, '2025-10-15 10:13:52', '2025-10-15 10:13:52'),
(43, 1, 'Consumer', 34, 2, 'STR2510000007', '2025-10-15', 159.00, 'Date Over', 159, NULL, NULL, NULL, '2025-10-15 10:14:47', '2025-10-15 10:14:47'),
(44, 1, 'Consumer', 24, 2, 'STR2510000008', '2025-10-18', 3957.60, 'Date Over', 159, 159, NULL, NULL, '2025-10-18 16:33:19', '2025-10-18 16:33:43'),
(45, 1, 'Consumer', 50, 2, 'STR2510000009', '2025-10-19', 791.20, 'Broken', 159, NULL, NULL, NULL, '2025-10-19 11:11:49', '2025-10-19 11:11:49'),
(46, 1, 'Consumer', 4, 2, 'STR2510000010', '2025-10-21', 2842.00, 'Date Over', 159, NULL, NULL, NULL, '2025-10-21 15:00:04', '2025-10-21 15:00:04'),
(47, 1, 'Consumer', 2, 2, 'STR2510000011', '2025-10-29', 4590.00, 'Broken', 159, 159, NULL, NULL, '2025-10-29 15:15:38', '2025-10-29 15:20:05'),
(48, 1, 'Consumer', 41, 2, 'STR2511000001', '2025-11-01', 300.00, 'Date Over', 159, 159, NULL, NULL, '2025-11-01 08:13:54', '2025-11-01 08:15:07'),
(49, 1, 'Consumer', 12, 2, 'STR2511000002', '2025-11-05', 1800.00, 'Date Over', 159, 159, NULL, NULL, '2025-11-05 08:31:15', '2025-11-05 08:43:04'),
(50, 1, 'Consumer', 12, 2, 'STR2511000003', '2025-11-05', 373.00, 'Date Over', 159, 159, NULL, NULL, '2025-11-05 08:45:23', '2025-11-05 08:46:50'),
(51, 1, 'Consumer', 12, 2, 'STR2511000004', '2025-11-05', 9036.00, 'Date Over', 159, NULL, NULL, NULL, '2025-11-05 08:48:51', '2025-11-05 08:48:51'),
(52, 1, 'Consumer', 12, 2, 'STR2511000005', '2025-11-05', 2178.00, 'Date Over', 159, NULL, NULL, NULL, '2025-11-05 08:49:57', '2025-11-05 08:49:57'),
(53, 1, 'Consumer', 24, 2, 'STR2511000006', '2025-11-05', 619.76, 'Date Over', 159, 159, NULL, NULL, '2025-11-05 08:58:09', '2025-11-05 08:58:55'),
(54, 1, 'Consumer', 90, 2, 'STR2511000007', '2025-11-09', 292.00, 'Broken', 159, NULL, NULL, NULL, '2025-11-09 10:18:21', '2025-11-09 10:18:21'),
(55, 1, 'Consumer', 12, 2, 'STR2511000008', '2025-11-09', 3755.00, 'Date Over', 159, 159, NULL, NULL, '2025-11-09 10:28:08', '2025-11-09 10:28:45'),
(56, 1, 'Consumer', 63, 2, 'STR2511000009', '2025-11-12', 1980.00, 'Date Over', 159, 159, NULL, NULL, '2025-11-12 14:43:30', '2025-11-12 14:46:58'),
(57, 1, 'Consumer', 7, 2, 'STR2511000010', '2025-11-13', 322.11, 'Date Over', 159, NULL, NULL, NULL, '2025-11-13 08:22:12', '2025-11-13 08:22:12'),
(58, 1, 'Consumer', 5, 2, 'STR2511000011', '2025-11-15', 52.00, 'Broken', 159, NULL, NULL, NULL, '2025-11-15 09:08:20', '2025-11-15 09:08:20'),
(59, 1, 'Consumer', 80, 2, 'STR2511000012', '2025-11-22', 570.00, 'Broken', 159, NULL, 159, '2025-11-22 08:13:11', '2025-11-22 08:12:07', '2025-11-22 08:13:11'),
(60, 1, 'Consumer', 12, 2, 'STR2511000013', '2025-11-23', 1800.00, 'Date Over', 159, NULL, NULL, NULL, '2025-11-23 08:04:54', '2025-11-23 08:04:54'),
(61, 1, 'Consumer', 72, 2, 'STR2511000014', '2025-11-29', 147.60, 'Date Over', 159, 159, NULL, NULL, '2025-11-29 07:54:26', '2025-11-29 08:01:45'),
(62, 1, 'Consumer', 72, 2, 'STR2511000015', '2025-11-29', 123.00, 'Date Over', 159, 159, NULL, NULL, '2025-11-29 07:55:06', '2025-11-29 08:01:35'),
(63, 1, 'Consumer', 72, 2, 'STR2511000016', '2025-11-29', 16.17, 'Date Over', 159, 159, NULL, NULL, '2025-11-29 07:56:16', '2025-11-29 07:59:59'),
(64, 1, 'Consumer', 37, 2, 'STR2511000017', '2025-11-29', 190.00, 'Broken', 159, NULL, NULL, NULL, '2025-11-29 14:10:32', '2025-11-29 14:10:32'),
(65, 1, 'Consumer', 78, 2, 'STR2512000001', '2025-12-01', 118.47, 'Date Over', 159, NULL, NULL, NULL, '2025-12-01 13:35:04', '2025-12-01 13:35:04'),
(66, 1, 'Consumer', 52, 2, 'STR2512000002', '2025-12-07', 2280.00, 'Broken', 159, NULL, NULL, NULL, '2025-12-07 13:58:57', '2025-12-07 13:58:57'),
(67, 1, 'Consumer', 4, 2, 'STR2512000003', '2025-12-08', 1784.77, 'Date Over', 159, 159, NULL, NULL, '2025-12-08 12:04:31', '2025-12-08 14:46:14'),
(68, 1, 'Consumer', 12, 2, 'STR2512000004', '2025-12-17', 1272.00, 'Date Over', 159, NULL, NULL, NULL, '2025-12-17 09:09:58', '2025-12-17 09:09:58'),
(69, 1, 'Consumer', 78, 2, 'STR2512000005', '2025-12-24', 668.04, 'Date Over', 159, 159, NULL, NULL, '2025-12-24 08:50:44', '2025-12-24 10:39:17'),
(70, 1, 'Consumer', 1, 2, 'STR2512000006', '2025-12-29', 1650.00, 'Date Over', 159, 159, NULL, NULL, '2025-12-29 09:19:43', '2025-12-29 09:23:19'),
(71, 1, 'Consumer', 24, 2, 'STR2512000007', '2025-12-29', 550.00, 'Date Over', 159, NULL, NULL, NULL, '2025-12-29 09:23:12', '2025-12-29 09:23:12'),
(72, 1, 'Consumer', 37, 2, 'STR2601000001', '2026-01-03', 375.00, 'Date Over', 159, NULL, NULL, NULL, '2026-01-03 12:03:04', '2026-01-03 12:03:04'),
(73, 1, 'Consumer', 24, 2, 'STR2601000002', '2026-01-03', 4208.82, 'Date Over', 159, NULL, NULL, NULL, '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(74, 1, 'Consumer', 51, 2, 'STR2601000003', '2026-01-08', 190.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-08 09:39:26', '2026-01-08 09:39:26'),
(75, 1, 'Consumer', 102, 2, 'STR2601000004', '2026-01-11', 3280.00, 'Broken', 159, 159, NULL, NULL, '2026-01-11 15:22:12', '2026-01-11 15:27:48'),
(76, 1, 'Consumer', 22, 2, 'STR2601000005', '2026-01-25', 690.00, 'Date Over', 159, 159, NULL, NULL, '2026-01-25 06:31:54', '2026-01-25 06:38:56'),
(80, 1, 'Consumer', 83, 2, 'STR2601000006', '2026-01-26', 2520.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-26 13:58:51', '2026-01-26 13:58:51'),
(81, 1, 'Consumer', 10, 2, 'STR2601000007', '2026-01-31', 10440.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 08:48:10', '2026-01-31 08:48:10'),
(82, 1, 'Consumer', 10, 2, 'STR2601000008', '2026-01-31', 4560.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 09:43:03', '2026-01-31 09:52:11'),
(87, 1, 'Consumer', 10, 2, 'STR2601000009', '2026-01-31', 3920.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 09:52:57', '2026-01-31 09:52:57'),
(88, 1, 'Consumer', 10, 2, 'STR2601000010', '2026-01-31', 3420.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 10:20:02', '2026-01-31 10:58:30'),
(89, 1, 'Consumer', 10, 2, 'STR2601000011', '2026-01-31', 1130.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 11:02:00', '2026-01-31 11:02:51'),
(90, 1, 'Consumer', 10, 2, 'STR2601000012', '2026-01-31', 3060.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 11:08:37', '2026-01-31 11:08:37'),
(91, 1, 'Consumer', 10, 2, 'STR2601000013', '2026-01-31', 2920.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 11:20:42', '2026-01-31 11:28:06'),
(92, 1, 'Consumer', 10, 2, 'STR2601000014', '2026-01-31', 2700.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 11:49:56', '2026-01-31 11:49:56'),
(94, 1, 'Consumer', 10, 2, 'STR2601000015', '2026-01-31', 2520.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 12:16:30', '2026-01-31 12:16:30'),
(95, 1, 'Consumer', 10, 2, 'STR2601000016', '2026-01-31', 4675.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 13:19:30', '2026-01-31 13:19:30'),
(96, 1, 'Consumer', 10, 2, 'STR2601000017', '2026-01-31', 5280.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 13:55:33', '2026-01-31 14:17:35'),
(97, 1, 'Consumer', 10, 2, 'STR2601000018', '2026-01-31', 4320.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 14:18:26', '2026-01-31 14:18:26'),
(98, 1, 'Consumer', 10, 2, 'STR2601000019', '2026-01-31', 1925.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 14:55:40', '2026-01-31 14:55:40'),
(99, 1, 'Consumer', 10, 2, 'STR2601000020', '2026-01-31', 2750.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 15:02:30', '2026-01-31 15:05:33'),
(100, 1, 'Consumer', 10, 2, 'STR2601000021', '2026-01-31', 2880.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 15:16:35', '2026-01-31 15:16:35'),
(101, 1, 'Consumer', 10, 2, 'STR2601000022', '2026-01-31', 1850.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 15:24:35', '2026-01-31 15:25:57'),
(102, 1, 'Consumer', 10, 2, 'STR2601000023', '2026-01-31', 1440.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 15:40:59', '2026-01-31 15:40:59'),
(103, 1, 'Consumer', 10, 2, 'STR2601000024', '2026-01-31', 2508.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 16:07:38', '2026-01-31 16:07:38'),
(104, 1, 'Consumer', 10, 2, 'STR2601000025', '2026-01-31', 4400.00, 'Broken', 159, NULL, NULL, NULL, '2026-01-31 16:20:39', '2026-01-31 16:20:39'),
(105, 1, 'Consumer', 10, 2, 'STR2601000026', '2026-01-31', 14720.00, 'Broken', 159, 159, NULL, NULL, '2026-01-31 16:34:14', '2026-01-31 16:35:54'),
(106, 1, 'Consumer', 10, 2, 'STR2602000001', '2026-02-01', 5354.35, 'Broken', 159, 159, NULL, NULL, '2026-02-01 07:46:27', '2026-02-01 07:53:16'),
(107, 1, 'Consumer', 10, 2, 'STR2602000002', '2026-02-01', 6563.56, 'Broken', 159, 159, NULL, NULL, '2026-02-01 08:53:52', '2026-02-01 10:04:34'),
(108, 1, 'Consumer', 10, 2, 'STR2602000003', '2026-02-01', 2940.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-01 10:05:22', '2026-02-01 10:05:22'),
(109, 1, 'Consumer', 10, 2, 'STR2602000004', '2026-02-01', 6683.55, 'Broken', 159, 159, NULL, NULL, '2026-02-01 10:25:12', '2026-02-01 11:11:44'),
(111, 1, 'Consumer', 10, 2, 'STR2602000005', '2026-02-01', 2500.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-01 10:27:51', '2026-02-01 10:27:51'),
(112, 1, 'Consumer', 10, 2, 'STR2602000006', '2026-02-01', 573.39, 'Broken', 159, 159, NULL, NULL, '2026-02-01 10:52:09', '2026-02-01 11:07:36'),
(113, 1, 'Consumer', 10, 2, 'STR2602000007', '2026-02-01', 3240.00, 'Broken', 159, 159, NULL, NULL, '2026-02-01 11:08:25', '2026-02-01 11:25:05'),
(115, 1, 'Consumer', 10, 2, 'STR2602000008', '2026-02-01', 1409.97, 'Broken', 159, NULL, NULL, NULL, '2026-02-01 12:11:42', '2026-02-01 12:11:42'),
(116, 1, 'Consumer', 10, 2, 'STR2602000009', '2026-02-01', 639.19, 'Date Over', 159, NULL, NULL, NULL, '2026-02-01 13:25:52', '2026-02-01 13:25:52'),
(117, 1, 'Consumer', 10, 2, 'STR2602000010', '2026-02-02', 3148.94, 'Broken', 159, NULL, NULL, NULL, '2026-02-02 08:17:44', '2026-02-02 08:17:44'),
(118, 1, 'Consumer', 10, 2, 'STR2602000011', '2026-02-02', 789.59, 'Broken', 159, 159, NULL, NULL, '2026-02-02 10:40:45', '2026-02-02 15:52:45'),
(119, 1, 'Consumer', 10, 2, 'STR2602000012', '2026-02-02', 290.00, 'Broken', 159, 159, NULL, NULL, '2026-02-02 15:48:38', '2026-02-02 15:53:17'),
(120, 1, 'Consumer', 123, 2, 'STR2602000013', '2026-02-02', 940.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-02 15:49:43', '2026-02-02 15:49:43'),
(121, 1, 'Consumer', 10, 2, 'STR2602000014', '2026-02-02', 470.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-02 15:50:13', '2026-02-02 15:50:13'),
(122, 1, 'Consumer', 123, 2, 'STR2602000015', '2026-02-02', 710.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-02 15:54:39', '2026-02-02 15:54:39'),
(123, 1, 'Consumer', 7, 2, 'STR2602000016', '2026-02-05', 1236.66, 'Broken', 159, 159, NULL, NULL, '2026-02-05 13:13:09', '2026-02-05 13:17:18'),
(124, 1, 'Consumer', 12, 2, 'STR2602000017', '2026-02-06', 690.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-06 10:41:48', '2026-02-06 10:41:48'),
(125, 1, 'Consumer', 86, 2, 'STR2602000018', '2026-02-07', 150.00, 'Broken', 159, NULL, 159, '2026-02-07 08:13:02', '2026-02-07 07:50:39', '2026-02-07 08:13:02'),
(126, 1, 'Consumer', 88, 2, 'STR2602000019', '2026-02-07', 80.00, 'Date Over', 159, NULL, NULL, NULL, '2026-02-07 09:58:46', '2026-02-07 09:58:46'),
(127, 1, 'Consumer', 88, 2, 'STR2602000020', '2026-02-07', 300.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-07 10:27:42', '2026-02-07 10:27:42'),
(128, 1, 'Consumer', 88, 2, 'STR2602000021', '2026-02-07', 240.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-07 10:33:16', '2026-02-07 10:33:16'),
(129, 1, 'Consumer', 88, 2, 'STR2602000022', '2026-02-07', 240.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-07 10:37:04', '2026-02-07 10:37:04'),
(132, 1, 'Consumer', 101, 2, 'STR2602000023', '2026-02-08', 6358.20, 'Broken', 159, 159, NULL, NULL, '2026-02-08 11:10:51', '2026-02-08 11:14:05'),
(133, 1, 'Consumer', 7, 2, 'STR2602000024', '2026-02-09', 2577.33, 'Broken', 159, NULL, NULL, NULL, '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(134, 1, 'Consumer', 80, 2, 'STR2602000025', '2026-02-10', 570.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-10 15:06:30', '2026-02-10 15:06:30'),
(135, 1, 'Consumer', 12, 2, 'STR2602000026', '2026-02-15', 76.00, 'Date Over', 159, NULL, NULL, NULL, '2026-02-15 11:19:57', '2026-02-15 11:19:57'),
(136, 1, 'Consumer', 83, 2, 'STR2602000027', '2026-02-19', 640.00, 'Date Over', 159, NULL, NULL, NULL, '2026-02-19 15:48:35', '2026-02-19 15:48:35'),
(138, 1, 'Consumer', 24, 2, 'STR2602000028', '2026-02-28', 6000.00, 'Broken', 159, NULL, NULL, NULL, '2026-02-28 08:41:48', '2026-02-28 08:41:48'),
(139, 1, 'Consumer', 45, 2, 'STR2603000001', '2026-03-01', 210.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-01 14:17:27', '2026-03-01 14:17:27'),
(140, 1, 'Consumer', 102, 2, 'STR2603000002', '2026-03-02', 1220.00, 'Broken', 159, NULL, NULL, NULL, '2026-03-02 09:37:26', '2026-03-02 09:37:26'),
(141, 1, 'Consumer', 68, 2, 'STR2603000003', '2026-03-02', 450.00, 'Broken', 159, NULL, NULL, NULL, '2026-03-02 13:51:26', '2026-03-02 13:51:26'),
(142, 1, 'Consumer', 12, 2, 'STR2603000004', '2026-03-06', 5520.00, 'Broken', 159, 159, NULL, NULL, '2026-03-06 14:42:23', '2026-03-06 15:13:49'),
(145, 1, 'Consumer', 72, 2, 'STR2603000005', '2026-03-07', 228.50, 'Broken', 159, NULL, NULL, NULL, '2026-03-07 10:33:00', '2026-03-07 10:33:00'),
(146, 1, 'Consumer', 37, 2, 'STR2603000006', '2026-03-10', 1080.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-10 11:41:16', '2026-03-10 11:41:16'),
(147, 1, 'Consumer', 12, 2, 'STR2603000007', '2026-03-11', 4770.00, 'Broken', 159, NULL, NULL, NULL, '2026-03-11 15:31:48', '2026-03-11 15:31:48'),
(148, 1, 'Consumer', 12, 2, 'STR2603000007', '2026-03-11', 4770.00, 'Broken', 159, NULL, 159, '2026-03-11 15:32:09', '2026-03-11 15:31:49', '2026-03-11 15:32:09'),
(149, 1, 'Consumer', 12, 2, 'STR2603000008', '2026-03-11', 1080.50, 'Date Over', 159, NULL, NULL, NULL, '2026-03-11 16:03:23', '2026-03-11 16:03:23'),
(150, 1, 'Consumer', 86, 2, 'STR2603000009', '2026-03-15', 190.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-15 13:24:11', '2026-03-15 13:24:11'),
(153, 1, 'Consumer', 88, 2, 'STR2603000010', '2026-03-16', 75.00, 'Date Over', 159, 159, NULL, NULL, '2026-03-16 09:21:51', '2026-03-16 09:36:45'),
(154, 1, 'Consumer', 88, 2, 'STR2603000011', '2026-03-16', 85.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-16 09:25:20', '2026-03-16 09:25:20'),
(155, 1, 'Consumer', 88, 2, 'STR2603000012', '2026-03-16', 85.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-16 09:38:12', '2026-03-16 09:38:12'),
(156, 1, 'Consumer', 88, 2, 'STR2603000013', '2026-03-16', 110.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-16 09:39:13', '2026-03-16 09:39:13'),
(157, 1, 'Consumer', 88, 2, 'STR2603000014', '2026-03-16', 67.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-16 09:40:16', '2026-03-16 09:40:16'),
(158, 1, 'Consumer', 88, 2, 'STR2603000015', '2026-03-16', 67.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-16 09:40:43', '2026-03-16 09:40:43'),
(159, 1, 'Consumer', 41, 2, 'STR2603000016', '2026-03-26', 378.00, 'Broken', 160, NULL, NULL, NULL, '2026-03-26 06:27:56', '2026-03-26 06:27:56'),
(160, 1, 'Consumer', 41, 2, 'STR2603000017', '2026-03-26', 588.00, 'Date Over', 160, NULL, 159, '2026-03-26 15:58:49', '2026-03-26 06:31:10', '2026-03-26 15:58:49'),
(161, 1, 'Consumer', 37, 2, 'STR2603000018', '2026-03-27', 430.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-27 09:16:46', '2026-03-27 09:16:46'),
(162, 1, 'Consumer', 37, 2, 'STR2603000019', '2026-03-27', 110.00, 'Broken', 159, NULL, NULL, NULL, '2026-03-27 09:17:17', '2026-03-27 09:17:17'),
(163, 1, 'Consumer', 88, 2, 'STR2603000020', '2026-03-30', 110.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-30 07:43:27', '2026-03-30 07:43:27'),
(164, 1, 'Consumer', 88, 2, 'STR2603000021', '2026-03-30', 60.00, 'Date Over', 159, 159, NULL, NULL, '2026-03-30 07:47:13', '2026-03-30 07:47:23'),
(165, 1, 'Consumer', 88, 2, 'STR2603000022', '2026-03-30', 100.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-30 07:48:11', '2026-03-30 07:48:11'),
(166, 1, 'Consumer', 1, 2, 'STR2603000023', '2026-03-30', 110.00, 'Date Over', 159, NULL, NULL, NULL, '2026-03-30 07:51:12', '2026-03-30 07:51:12'),
(167, 1, 'Consumer', 65, 2, 'STR2603000024', '2026-03-30', 3300.00, 'Broken', 159, NULL, 159, '2026-03-30 14:39:48', '2026-03-30 14:33:31', '2026-03-30 14:39:48'),
(168, 1, 'Consumer', 1, 2, 'STR2604000001', '2026-04-01', 990.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-01 16:06:32', '2026-04-01 16:06:32'),
(169, 1, 'Consumer', 79, 2, 'STR2604000002', '2026-04-04', 345.00, 'Date Over', 160, NULL, NULL, NULL, '2026-04-04 07:35:17', '2026-04-04 07:35:17'),
(170, 1, 'Consumer', 79, 2, 'STR2604000003', '2026-04-04', 375.00, 'Date Over', 160, NULL, NULL, NULL, '2026-04-04 07:36:28', '2026-04-04 07:36:28'),
(171, 1, 'Consumer', 79, 2, 'STR2604000004', '2026-04-04', 126.00, 'Date Over', 160, NULL, NULL, NULL, '2026-04-04 07:38:48', '2026-04-04 07:38:48'),
(176, 1, 'Consumer', 24, 2, 'STR2604000005', '2026-04-04', 1711.08, 'Date Over', 159, NULL, NULL, NULL, '2026-04-04 10:19:55', '2026-04-04 10:19:55'),
(178, 1, 'Consumer', 7, 2, 'STR2604000006', '2026-04-04', 484.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-04 10:22:51', '2026-04-04 10:22:51'),
(179, 1, 'Consumer', 46, 2, 'STR2604000007', '2026-04-04', 666.00, 'Date Over', 159, NULL, 159, '2026-04-04 11:05:27', '2026-04-04 11:03:12', '2026-04-04 11:05:27'),
(180, 1, 'Consumer', 66, 2, 'STR2604000008', '2026-04-04', 725.00, 'Date Over', 159, NULL, 159, '2026-04-04 11:07:32', '2026-04-04 11:06:07', '2026-04-04 11:07:32'),
(181, 1, 'Consumer', 46, 2, 'STR2604000009', '2026-04-04', 666.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-04 11:08:32', '2026-04-04 11:08:32'),
(182, 1, 'Consumer', 101, 2, 'STR2604000010', '2026-04-05', 864.00, 'Broken', 159, NULL, NULL, NULL, '2026-04-05 11:45:22', '2026-04-05 11:45:22'),
(183, 1, 'Consumer', 101, 2, 'STR2604000011', '2026-04-05', 864.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-05 11:48:51', '2026-04-05 11:48:51'),
(184, 1, 'Consumer', 12, 2, 'STR2604000012', '2026-04-05', 1836.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-05 13:16:47', '2026-04-05 13:16:47'),
(185, 1, 'Consumer', 12, 2, 'STR2604000013', '2026-04-05', 500.50, 'Date Over', 159, NULL, NULL, NULL, '2026-04-05 13:17:36', '2026-04-05 13:17:36'),
(186, 1, 'Consumer', 47, 2, 'STR2604000014', '2026-04-06', 390.00, 'Date Over', 159, 159, NULL, NULL, '2026-04-06 08:10:09', '2026-04-06 08:19:32'),
(187, 1, 'Consumer', 4, 2, 'STR2604000015', '2026-04-06', 603.00, 'Date Over', 159, 159, NULL, NULL, '2026-04-06 08:40:49', '2026-04-06 12:02:07'),
(188, 1, 'Consumer', 7, 2, 'STR2604000016', '2026-04-09', 1668.10, 'Date Over', 159, 159, NULL, NULL, '2026-04-09 08:18:47', '2026-04-09 08:23:35'),
(189, 1, 'Consumer', 19, 2, 'STR2604000017', '2026-04-10', 7304.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-10 11:04:06', '2026-04-10 11:04:06'),
(190, 1, 'Consumer', 25, 2, 'STR2604000018', '2026-04-11', 283.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-11 07:47:11', '2026-04-11 07:47:11'),
(191, 1, 'Consumer', 24, 2, 'STR2604000019', '2026-04-19', 349.20, 'Date Over', 159, NULL, NULL, NULL, '2026-04-19 10:02:17', '2026-04-19 10:02:17'),
(194, 1, 'Consumer', 88, 2, 'STR2604000020', '2026-04-20', 126.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-20 15:44:03', '2026-04-20 15:44:03'),
(195, 1, 'Consumer', 88, 2, 'STR2604000021', '2026-04-20', 320.00, 'Date Over', 159, NULL, NULL, NULL, '2026-04-20 15:48:42', '2026-04-20 15:48:42'),
(196, 1, 'Consumer', 7, 2, 'STR2604000022', '2026-04-25', 2224.13, 'Date Over', 159, 159, NULL, NULL, '2026-04-25 11:06:19', '2026-04-25 11:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `lifting_return_lists`
--

CREATE TABLE `lifting_return_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_return_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lifting_product_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lifting_price` decimal(16,2) NOT NULL,
  `qty` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `lifting_discount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lifting_return_lists`
--

INSERT INTO `lifting_return_lists` (`id`, `company_id`, `lifting_return_id`, `vendor_id`, `store_id`, `lifting_id`, `lifting_product_id`, `product_type`, `product_id`, `variant_id`, `lifting_price`, `qty`, `amount`, `lifting_discount`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 15, 2, 84, 2950, 'Consumer', 1014, NULL, 380.00, 3.00, 1140.00, 0.00, 'Cash Purchase', '2025-06-15 08:28:30', '2025-07-08 06:09:11'),
(3, 1, 4, 50, 2, 118, 3475, 'Consumer', 1304, NULL, 73.50, 11.00, 808.50, 0.00, 'Cash Purchase', '2025-06-19 15:11:28', '2025-07-08 06:09:11'),
(8, 1, 5, 22, 2, 268, 5524, 'Consumer', 1931, NULL, 150.00, 5.00, 750.00, 0.00, 'Cash Purchase', '2025-06-26 07:39:55', '2025-07-08 06:09:11'),
(9, 1, 5, 22, 2, 268, 5525, 'Consumer', 1930, NULL, 180.00, 5.00, 900.00, 0.00, 'Cash Purchase', '2025-06-26 07:39:55', '2025-07-08 06:09:11'),
(10, 1, 6, 24, 2, 270, 5620, 'Consumer', 1935, NULL, 342.00, 4.00, 1368.00, 0.00, 'Cash Purchase', '2025-06-28 15:02:52', '2025-07-08 06:09:11'),
(20, 1, 8, 22, 2, 268, 5537, 'Consumer', 1925, NULL, 750.00, 8.00, 6000.00, 0.00, 'Cash Purchase', '2025-06-29 17:49:12', '2025-07-08 06:09:11'),
(23, 1, 7, 22, 2, 268, 5536, 'Consumer', 1924, NULL, 750.00, 7.00, 5250.00, 0.00, 'Cash Purchase', '2025-07-02 10:17:58', '2025-07-08 06:09:11'),
(24, 1, 9, 51, 2, 170, 4496, 'Consumer', 1578, NULL, 220.00, 4.00, 880.00, 0.00, 'Cash Purchase', '2025-07-06 10:57:23', '2025-07-08 06:09:11'),
(25, 1, 9, 51, 2, 170, 4497, 'Consumer', 1579, NULL, 120.00, 5.00, 600.00, 0.00, 'Cash Purchase', '2025-07-06 10:57:23', '2025-07-08 06:09:11'),
(26, 1, 10, 22, 2, 305, 6159, 'Consumer', 1924, NULL, 750.00, 6.00, 4500.00, 0.00, 'Cash Purchase', '2025-07-07 14:30:49', '2025-07-08 06:09:11'),
(27, 1, 11, 22, 2, 304, 6156, 'Consumer', 1925, NULL, 750.00, 4.00, 3000.00, 0.00, 'Cash Purchase', '2025-07-07 14:48:15', '2025-07-08 06:09:11'),
(28, 1, 12, 22, 2, 304, 6157, 'Consumer', 2053, NULL, 750.00, 2.00, 1500.00, 0.00, 'Cash Purchase', '2025-07-07 15:00:32', '2025-07-08 06:09:11'),
(30, 1, 14, 7, 2, 19, 347, 'Consumer', 337, NULL, 85.00, 12.00, 1020.00, 0.00, 'Cash Purchase', '2025-07-09 11:26:55', '2025-07-09 11:26:55'),
(33, 1, 15, 4, 2, 8, 67, 'Consumer', 219, NULL, 712.00, 5.00, 3560.00, 204.04, 'Cash Purchase', '2025-07-14 13:55:19', '2025-07-14 13:55:19'),
(34, 1, 16, 1, 2, 5, 54, 'Consumer', 196, NULL, 868.00, 1.00, 868.00, 0.00, 'Cash Purchase', '2025-07-14 14:23:33', '2025-07-14 14:23:33'),
(35, 1, 17, 51, 2, 117, 3428, 'Consumer', 1282, NULL, 1.40, 1000.00, 1400.00, 0.00, 'Cash Purchase', '2025-07-24 13:10:00', '2025-07-24 13:10:00'),
(36, 1, 17, 51, 2, 170, 4489, 'Consumer', 1282, NULL, 1.40, 774.00, 1083.60, 0.00, 'Cash Purchase', '2025-07-24 13:10:00', '2025-07-24 13:10:00'),
(37, 1, 18, 8, 2, 515, 7946, 'Consumer', 288, NULL, 285.00, 2.00, 570.00, 0.00, 'Cash Purchase', '2025-08-07 15:50:12', '2025-08-07 15:50:12'),
(43, 1, 19, 68, 2, 361, 6485, 'Consumer', 2120, NULL, 25.00, 1.00, 25.00, 0.00, 'Cash Purchase', '2025-08-11 13:41:23', '2025-08-11 13:41:23'),
(44, 1, 19, 68, 2, 361, 6486, 'Consumer', 2121, NULL, 30.00, 1.00, 30.00, 0.00, 'Cash Purchase', '2025-08-11 13:41:23', '2025-08-11 13:41:23'),
(45, 1, 19, 68, 2, 361, 6487, 'Consumer', 2122, NULL, 25.00, 1.00, 25.00, 0.00, 'Cash Purchase', '2025-08-11 13:41:23', '2025-08-11 13:41:23'),
(46, 1, 20, 22, 2, 321, 6189, 'Consumer', 1713, NULL, 635.00, 8.00, 5080.00, 0.00, 'Cash Purchase', '2025-08-15 11:11:09', '2025-08-15 11:11:09'),
(47, 1, 21, 41, 2, 243, 5163, 'Consumer', 1782, NULL, 25.00, 6.00, 150.00, 0.00, 'Cash Purchase', '2025-08-16 15:16:37', '2025-08-16 15:16:37'),
(48, 1, 22, 68, 2, 361, 6488, 'Consumer', 2119, NULL, 25.00, 3.00, 75.00, 0.00, 'Cash Purchase', '2025-08-18 09:05:02', '2025-08-18 09:05:02'),
(55, 1, 23, 10, 2, 57, 2212, 'Consumer', 826, NULL, 212.00, 3.00, 636.00, 39.02, 'Cash Purchase', '2025-08-18 15:19:05', '2025-08-18 15:19:05'),
(56, 1, 23, 10, 2, 215, 4755, 'Consumer', 1684, NULL, 75.00, 1.00, 75.00, 0.01, 'Cash Purchase', '2025-08-18 15:19:05', '2025-08-18 15:19:05'),
(57, 1, 24, 10, 2, 50, 1845, 'Consumer', 773, NULL, 90.00, 2.00, 180.00, 0.00, 'Cash Purchase', '2025-08-18 15:19:52', '2025-08-18 15:19:52'),
(58, 1, 25, 10, 2, 53, 2142, 'Consumer', 818, NULL, 95.00, 1.00, 95.00, 0.00, 'Cash Purchase', '2025-08-18 15:23:49', '2025-08-18 15:23:49'),
(59, 1, 26, 37, 2, 429, 7209, 'Consumer', 2222, NULL, 25.00, 7.00, 175.00, 0.00, 'Cash Purchase', '2025-08-20 08:02:18', '2025-08-20 08:02:18'),
(60, 1, 27, 22, 2, 122, 3857, 'Consumer', 1328, NULL, 22.50, 120.00, 2700.00, 0.00, 'Cash Purchase', '2025-08-23 13:46:35', '2025-08-23 13:46:35'),
(61, 1, 28, 38, 2, 99, 3077, 'Consumer', 1150, NULL, 42.92, 28.00, 1201.76, 43.59, 'Cash Purchase', '2025-08-26 13:00:39', '2025-08-26 13:00:39'),
(62, 1, 29, 38, 2, 604, 8576, 'Consumer', 1148, NULL, 37.90, 28.00, 1061.20, 0.00, 'Cash Purchase', '2025-08-26 13:01:53', '2025-08-26 13:01:53'),
(63, 1, 30, 68, 2, 361, 6486, 'Consumer', 2121, NULL, 30.00, 1.00, 30.00, 0.00, 'Cash Purchase', '2025-08-27 08:26:00', '2025-08-27 08:26:00'),
(64, 1, 30, 68, 2, 361, 6488, 'Consumer', 2119, NULL, 25.00, 1.00, 25.00, 0.00, 'Cash Purchase', '2025-08-27 08:26:00', '2025-08-27 08:26:00'),
(65, 1, 31, 6, 2, 10, 77, 'Consumer', 234, NULL, 580.00, 1.00, 580.00, 0.00, 'Broken', '2025-09-09 09:35:41', '2025-09-09 09:35:41'),
(69, 1, 32, 68, 2, 361, 6486, 'Consumer', 2121, NULL, 30.00, 1.00, 30.00, 0.00, 'Cash Purchase', '2025-09-10 09:03:11', '2025-09-10 09:03:11'),
(70, 1, 33, 68, 2, 428, 7249, 'Consumer', 2218, NULL, 110.00, 1.00, 110.00, 0.00, 'Broken', '2025-09-10 09:03:49', '2025-09-10 09:03:49'),
(71, 1, 34, 38, 2, 604, 8577, 'Consumer', 1150, NULL, 47.00, 5.00, 235.00, 0.00, 'Cash Purchase', '2025-09-13 11:45:26', '2025-09-13 11:45:26'),
(72, 1, 35, 72, 2, 241, 5145, 'Consumer', 1773, NULL, 16.17, 1.00, 16.17, 0.00, 'Broken', '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(73, 1, 35, 72, 2, 241, 5146, 'Consumer', 1774, NULL, 16.17, 2.00, 32.34, 0.00, 'Broken', '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(74, 1, 35, 72, 2, 241, 5148, 'Consumer', 1771, NULL, 40.50, 1.00, 40.50, 0.00, 'Broken', '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(75, 1, 35, 72, 2, 241, 5149, 'Consumer', 1777, NULL, 42.50, 1.00, 42.50, 0.00, 'Broken', '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(76, 1, 35, 72, 2, 487, 7733, 'Consumer', 2354, NULL, 16.17, 1.00, 16.17, 0.00, 'Broken', '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(77, 1, 36, 65, 2, 417, 7077, 'Consumer', 2190, NULL, 150.00, 4.00, 600.00, 0.00, 'Cash Purchase', '2025-09-24 11:24:42', '2025-09-24 11:24:42'),
(78, 1, 37, 12, 2, 741, 10395, 'Consumer', 420, NULL, 239.00, 1.00, 239.00, 0.00, 'Broken', '2025-10-05 10:03:22', '2025-10-05 10:03:22'),
(79, 1, 38, 62, 2, 167, 4469, 'Consumer', 1572, NULL, 320.00, 3.00, 960.00, 0.00, 'Broken', '2025-10-11 09:25:08', '2025-10-11 09:25:08'),
(80, 1, 39, 90, 2, 863, 11988, 'Consumer', 1394, NULL, 227.00, 1.00, 227.00, 0.00, 'Broken', '2025-10-12 10:39:43', '2025-10-12 10:39:43'),
(82, 1, 41, 12, 2, 328, 6289, 'Consumer', 421, NULL, 180.00, 12.00, 2160.00, 0.00, 'Date Over', '2025-10-12 10:44:16', '2025-10-12 10:44:16'),
(83, 1, 40, 12, 2, 198, 4679, 'Consumer', 426, NULL, 364.00, 1.00, 364.00, 0.00, 'Date Over', '2025-10-12 10:47:36', '2025-10-12 10:47:36'),
(84, 1, 40, 12, 2, 702, 10136, 'Consumer', 426, NULL, 364.00, 2.00, 728.00, 0.00, 'Date Over', '2025-10-12 10:47:36', '2025-10-12 10:47:36'),
(85, 1, 42, 34, 2, 113, 3384, 'Consumer', 1228, NULL, 85.00, 19.00, 1615.00, 0.00, 'Date Over', '2025-10-15 10:13:52', '2025-10-15 10:13:52'),
(86, 1, 43, 34, 2, 113, 3387, 'Consumer', 419, NULL, 159.00, 1.00, 159.00, 0.00, 'Date Over', '2025-10-15 10:14:47', '2025-10-15 10:14:47'),
(88, 1, 44, 24, 2, 489, 7818, 'Consumer', 1488, NULL, 329.80, 12.00, 3957.60, 0.00, 'Date Over', '2025-10-18 16:33:43', '2025-10-18 16:33:43'),
(89, 1, 45, 50, 2, 360, 6472, 'Consumer', 2118, NULL, 158.24, 5.00, 791.20, 0.00, 'Broken', '2025-10-19 11:11:49', '2025-10-19 11:11:49'),
(90, 1, 46, 4, 2, 511, 7928, 'Consumer', 2387, NULL, 2842.00, 1.00, 2842.00, 0.00, 'Date Over', '2025-10-21 15:00:04', '2025-10-21 15:00:04'),
(94, 1, 47, 2, 2, 680, 9898, 'Consumer', 189, NULL, 765.00, 6.00, 4590.00, 0.00, 'Broken', '2025-10-29 15:20:05', '2025-10-29 15:20:05'),
(96, 1, 48, 41, 2, 213, 4750, 'Consumer', 1173, NULL, 30.00, 10.00, 300.00, 0.00, 'Date Over', '2025-11-01 08:15:07', '2025-11-01 08:15:07'),
(100, 1, 49, 12, 2, 971, 13013, 'Consumer', 2742, NULL, 180.00, 4.00, 720.00, 0.00, 'Date Over', '2025-11-05 08:43:04', '2025-11-05 08:43:04'),
(101, 1, 49, 12, 2, 1022, 13330, 'Consumer', 2742, NULL, 180.00, 6.00, 1080.00, 0.00, 'Date Over', '2025-11-05 08:43:04', '2025-11-05 08:43:04'),
(103, 1, 50, 12, 2, 449, 7324, 'Consumer', 405, NULL, 373.00, 1.00, 373.00, 0.00, 'Date Over', '2025-11-05 08:46:50', '2025-11-05 08:46:50'),
(104, 1, 51, 12, 2, 238, 5130, 'Consumer', 407, NULL, 753.00, 12.00, 9036.00, 0.00, 'Date Over', '2025-11-05 08:48:51', '2025-11-05 08:48:51'),
(105, 1, 52, 12, 2, 328, 6293, 'Consumer', 2085, NULL, 363.00, 2.00, 726.00, 0.00, 'Date Over', '2025-11-05 08:49:57', '2025-11-05 08:49:57'),
(106, 1, 52, 12, 2, 1022, 13329, 'Consumer', 2085, NULL, 363.00, 4.00, 1452.00, 0.00, 'Date Over', '2025-11-05 08:49:57', '2025-11-05 08:49:57'),
(109, 1, 53, 24, 2, 144, 4195, 'Consumer', 1487, NULL, 155.20, 4.00, 620.80, 1.04, 'Date Over', '2025-11-05 08:58:55', '2025-11-05 08:58:55'),
(110, 1, 54, 90, 2, 863, 11987, 'Consumer', 1397, NULL, 292.00, 1.00, 292.00, 0.00, 'Broken', '2025-11-09 10:18:21', '2025-11-09 10:18:21'),
(115, 1, 55, 12, 2, 23, 442, 'Consumer', 407, NULL, 753.00, 1.00, 753.00, 0.00, 'Date Over', '2025-11-09 10:28:45', '2025-11-09 10:28:45'),
(116, 1, 55, 12, 2, 741, 10398, 'Consumer', 1227, NULL, 450.00, 3.00, 1350.00, 0.00, 'Date Over', '2025-11-09 10:28:45', '2025-11-09 10:28:45'),
(117, 1, 55, 12, 2, 1044, 13595, 'Consumer', 417, NULL, 50.00, 4.00, 200.00, 0.00, 'Date Over', '2025-11-09 10:28:45', '2025-11-09 10:28:45'),
(118, 1, 55, 12, 2, 1044, 13598, 'Consumer', 2085, NULL, 363.00, 4.00, 1452.00, 0.00, 'Date Over', '2025-11-09 10:28:45', '2025-11-09 10:28:45'),
(122, 1, 56, 63, 2, 186, 4549, 'Consumer', 1614, NULL, 90.00, 22.00, 1980.00, 0.00, 'Date Over', '2025-11-12 14:46:58', '2025-11-12 14:46:58'),
(123, 1, 57, 7, 2, 20, 380, 'Consumer', 351, NULL, 42.00, 8.00, 336.00, 13.89, 'Date Over', '2025-11-13 08:22:12', '2025-11-13 08:22:12'),
(124, 1, 58, 5, 2, 661, 9635, 'Consumer', 821, NULL, 52.00, 1.00, 52.00, 0.00, 'Broken', '2025-11-15 09:08:20', '2025-11-15 09:08:20'),
(125, 1, 59, 80, 2, 600, 8553, 'Consumer', 2511, NULL, 38.00, 15.00, 570.00, 0.00, 'Broken', '2025-11-22 08:12:07', '2025-11-22 08:12:07'),
(132, 1, 63, 72, 2, 968, 12985, 'Consumer', 2354, NULL, 16.17, 1.00, 16.17, 0.00, 'Date Over', '2025-11-29 08:00:39', '2025-11-29 08:00:39'),
(134, 1, 62, 72, 2, 581, 8274, 'Consumer', 2495, NULL, 24.60, 5.00, 123.00, 0.00, 'Date Over', '2025-11-29 08:01:35', '2025-11-29 08:01:35'),
(135, 1, 61, 72, 2, 1080, 13860, 'Consumer', 1779, NULL, 24.60, 6.00, 147.60, 0.00, 'Date Over', '2025-11-29 08:01:45', '2025-11-29 08:01:45'),
(136, 1, 64, 37, 2, 1163, 14350, 'Consumer', 3187, NULL, 190.00, 1.00, 190.00, 0.00, 'Broken', '2025-11-29 14:10:32', '2025-11-29 14:10:32'),
(137, 1, 65, 78, 2, 465, 7448, 'Consumer', 2192, NULL, 15.43, 1.00, 15.43, 0.00, 'Date Over', '2025-12-01 13:35:04', '2025-12-01 13:35:04'),
(139, 1, 66, 52, 2, 119, 3499, 'Consumer', 1247, NULL, 380.00, 6.00, 2280.00, 0.00, 'Broken', '2025-12-07 13:58:57', '2025-12-07 13:58:57'),
(144, 1, 67, 4, 2, 8, 68, 'Consumer', 220, NULL, 88.00, 8.00, 704.00, 40.35, 'Date Over', '2025-12-08 14:47:52', '2025-12-08 14:47:52'),
(145, 1, 67, 4, 2, 464, 7522, 'Consumer', 220, NULL, 70.07, 16.00, 1121.12, 0.00, 'Date Over', '2025-12-08 14:47:52', '2025-12-08 14:47:52'),
(146, 1, 68, 12, 2, 369, 6685, 'Consumer', 2138, NULL, 424.00, 3.00, 1272.00, 0.00, 'Date Over', '2025-12-17 09:09:58', '2025-12-17 09:09:58'),
(160, 1, 69, 78, 2, 259, 5470, 'Consumer', 1886, NULL, 13.93, 2.00, 27.86, 0.00, 'Date Over', '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(161, 1, 69, 78, 2, 422, 7089, 'Consumer', 2195, NULL, 12.25, 2.00, 24.50, 0.00, 'Date Over', '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(162, 1, 69, 78, 2, 422, 7090, 'Consumer', 2194, NULL, 16.20, 14.00, 226.80, 0.00, 'Date Over', '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(163, 1, 69, 78, 2, 422, 7091, 'Consumer', 2193, NULL, 16.20, 6.00, 97.20, 0.00, 'Date Over', '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(164, 1, 69, 78, 2, 465, 7448, 'Consumer', 2192, NULL, 15.43, 1.00, 15.43, 0.00, 'Date Over', '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(165, 1, 69, 78, 2, 465, 7449, 'Consumer', 2279, NULL, 16.25, 17.00, 276.25, 0.00, 'Date Over', '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(167, 1, 71, 24, 2, 307, 6136, 'Consumer', 195, NULL, 550.00, 1.00, 550.00, 0.00, 'Date Over', '2025-12-29 09:23:12', '2025-12-29 09:23:12'),
(168, 1, 70, 1, 2, 5, 52, 'Consumer', 195, NULL, 550.00, 3.00, 1650.00, 0.00, 'Date Over', '2025-12-29 09:23:19', '2025-12-29 09:23:19'),
(169, 1, 72, 37, 2, 439, 7271, 'Consumer', 1115, NULL, 25.00, 8.00, 200.00, 0.00, 'Date Over', '2026-01-03 12:03:04', '2026-01-03 12:03:04'),
(170, 1, 72, 37, 2, 439, 7272, 'Consumer', 1116, NULL, 25.00, 7.00, 175.00, 0.00, 'Date Over', '2026-01-03 12:03:04', '2026-01-03 12:03:04'),
(171, 1, 73, 24, 2, 270, 5621, 'Consumer', 1934, NULL, 42.67, 1.00, 42.67, 0.00, 'Date Over', '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(172, 1, 73, 24, 2, 489, 7818, 'Consumer', 1488, NULL, 329.80, 12.00, 3957.60, 0.00, 'Date Over', '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(173, 1, 73, 24, 2, 1198, 14879, 'Consumer', 3229, NULL, 208.55, 1.00, 208.55, 0.00, 'Date Over', '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(174, 1, 74, 51, 2, 835, 11541, 'Consumer', 2867, NULL, 0.10, 1900.00, 190.00, 0.00, 'Broken', '2026-01-08 09:39:26', '2026-01-08 09:39:26'),
(176, 1, 75, 102, 2, 1068, 13811, 'Consumer', 3124, NULL, 820.00, 4.00, 3280.00, 0.00, 'Broken', '2026-01-11 15:27:48', '2026-01-11 15:27:48'),
(181, 1, 76, 22, 2, 122, 3880, 'Consumer', 1396, NULL, 230.00, 3.00, 690.00, 0.00, 'Date Over', '2026-01-25 06:38:56', '2026-01-25 06:38:56'),
(182, 1, 80, 83, 2, 1425, 15819, 'Consumer', 3477, NULL, 420.00, 6.00, 2520.00, 0.00, 'Broken', '2026-01-26 13:58:51', '2026-01-26 13:58:51'),
(183, 1, 81, 10, 2, 622, 9180, 'Consumer', 2610, NULL, 360.00, 29.00, 10440.00, 0.00, 'Broken', '2026-01-31 08:48:10', '2026-01-31 08:48:10'),
(190, 1, 82, 10, 2, 622, 9184, 'Consumer', 2614, NULL, 570.00, 8.00, 4560.00, 0.00, 'Broken', '2026-01-31 09:52:11', '2026-01-31 09:52:11'),
(191, 1, 87, 10, 2, 620, 9151, 'Consumer', 2595, NULL, 560.00, 7.00, 3920.00, 0.00, 'Broken', '2026-01-31 09:52:57', '2026-01-31 09:52:57'),
(195, 1, 88, 10, 2, 620, 9158, 'Consumer', 2602, NULL, 285.00, 12.00, 3420.00, 0.00, 'Broken', '2026-01-31 10:58:30', '2026-01-31 10:58:30'),
(197, 1, 89, 10, 2, 622, 9185, 'Consumer', 2615, NULL, 1130.00, 1.00, 1130.00, 0.00, 'Broken', '2026-01-31 11:02:51', '2026-01-31 11:02:51'),
(198, 1, 90, 10, 2, 622, 9186, 'Consumer', 2616, NULL, 1020.00, 3.00, 3060.00, 0.00, 'Broken', '2026-01-31 11:08:37', '2026-01-31 11:08:37'),
(203, 1, 91, 10, 2, 622, 9182, 'Consumer', 2612, NULL, 730.00, 4.00, 2920.00, 0.00, 'Broken', '2026-01-31 11:28:06', '2026-01-31 11:28:06'),
(204, 1, 92, 10, 2, 622, 9188, 'Consumer', 2618, NULL, 450.00, 6.00, 2700.00, 0.00, 'Broken', '2026-01-31 11:49:56', '2026-01-31 11:49:56'),
(206, 1, 94, 10, 2, 622, 9183, 'Consumer', 2613, NULL, 840.00, 3.00, 2520.00, 0.00, 'Broken', '2026-01-31 12:16:30', '2026-01-31 12:16:30'),
(207, 1, 95, 10, 2, 622, 9181, 'Consumer', 2611, NULL, 935.00, 5.00, 4675.00, 0.00, 'Broken', '2026-01-31 13:19:30', '2026-01-31 13:19:30'),
(209, 1, 96, 10, 2, 620, 9157, 'Consumer', 2601, NULL, 440.00, 12.00, 5280.00, 0.00, 'Broken', '2026-01-31 14:17:35', '2026-01-31 14:17:35'),
(210, 1, 97, 10, 2, 620, 9156, 'Consumer', 2600, NULL, 360.00, 12.00, 4320.00, 0.00, 'Broken', '2026-01-31 14:18:26', '2026-01-31 14:18:26'),
(211, 1, 98, 10, 2, 620, 9164, 'Consumer', 2608, NULL, 175.00, 11.00, 1925.00, 0.00, 'Broken', '2026-01-31 14:55:40', '2026-01-31 14:55:40'),
(213, 1, 99, 10, 2, 620, 9155, 'Consumer', 2599, NULL, 250.00, 11.00, 2750.00, 0.00, 'Broken', '2026-01-31 15:05:33', '2026-01-31 15:05:33'),
(214, 1, 100, 10, 2, 620, 9160, 'Consumer', 2604, NULL, 240.00, 12.00, 2880.00, 0.00, 'Broken', '2026-01-31 15:16:35', '2026-01-31 15:16:35'),
(217, 1, 101, 10, 2, 620, 9159, 'Consumer', 2603, NULL, 185.00, 10.00, 1850.00, 0.00, 'Broken', '2026-01-31 15:25:58', '2026-01-31 15:25:58'),
(218, 1, 102, 10, 2, 620, 9161, 'Consumer', 2605, NULL, 240.00, 6.00, 1440.00, 0.00, 'Broken', '2026-01-31 15:40:59', '2026-01-31 15:40:59'),
(219, 1, 103, 10, 2, 620, 9154, 'Consumer', 2598, NULL, 228.00, 11.00, 2508.00, 0.00, 'Broken', '2026-01-31 16:07:38', '2026-01-31 16:07:38'),
(220, 1, 104, 10, 2, 620, 9163, 'Consumer', 2607, NULL, 550.00, 8.00, 4400.00, 0.00, 'Broken', '2026-01-31 16:20:39', '2026-01-31 16:20:39'),
(222, 1, 105, 10, 2, 622, 9187, 'Consumer', 2617, NULL, 640.00, 23.00, 14720.00, 0.00, 'Broken', '2026-01-31 16:35:54', '2026-01-31 16:35:54'),
(225, 1, 106, 10, 2, 17, 241, 'Consumer', 305, NULL, 690.00, 4.00, 2760.00, 165.65, 'Broken', '2026-02-01 07:53:16', '2026-02-01 07:53:16'),
(226, 1, 106, 10, 2, 603, 8559, 'Consumer', 305, NULL, 690.00, 4.00, 2760.00, 0.00, 'Broken', '2026-02-01 07:53:16', '2026-02-01 07:53:16'),
(231, 1, 108, 10, 2, 603, 8558, 'Consumer', 303, NULL, 735.00, 4.00, 2940.00, 0.00, 'Broken', '2026-02-01 10:05:22', '2026-02-01 10:05:22'),
(240, 1, 111, 10, 2, 603, 8556, 'Consumer', 304, NULL, 500.00, 5.00, 2500.00, 0.00, 'Broken', '2026-02-01 10:27:51', '2026-02-01 10:27:51'),
(247, 1, 107, 10, 2, 17, 237, 'Consumer', 302, NULL, 610.00, 4.00, 2440.00, 146.44, 'Broken', '2026-02-01 10:36:11', '2026-02-01 10:36:11'),
(248, 1, 107, 10, 2, 603, 8560, 'Consumer', 302, NULL, 610.00, 7.00, 4270.00, 0.00, 'Broken', '2026-02-01 10:36:11', '2026-02-01 10:36:11'),
(252, 1, 112, 10, 2, 17, 238, 'Consumer', 301, NULL, 610.00, 1.00, 610.00, 36.61, 'Broken', '2026-02-01 11:07:36', '2026-02-01 11:07:36'),
(254, 1, 109, 10, 2, 17, 243, 'Consumer', 307, NULL, 980.00, 3.00, 2940.00, 176.45, 'Broken', '2026-02-01 11:11:44', '2026-02-01 11:11:44'),
(255, 1, 109, 10, 2, 603, 8561, 'Consumer', 307, NULL, 980.00, 4.00, 3920.00, 0.00, 'Broken', '2026-02-01 11:11:44', '2026-02-01 11:11:44'),
(257, 1, 113, 10, 2, 620, 9152, 'Consumer', 2596, NULL, 540.00, 6.00, 3240.00, 0.00, 'Broken', '2026-02-01 11:25:05', '2026-02-01 11:25:05'),
(259, 1, 115, 10, 2, 17, 245, 'Consumer', 309, NULL, 500.00, 3.00, 1500.00, 90.03, 'Broken', '2026-02-01 12:11:42', '2026-02-01 12:11:42'),
(260, 1, 116, 10, 2, 17, 247, 'Consumer', 311, NULL, 340.00, 2.00, 680.00, 40.81, 'Date Over', '2026-02-01 13:25:52', '2026-02-01 13:25:52'),
(261, 1, 117, 10, 2, 17, 235, 'Consumer', 298, NULL, 3350.00, 1.00, 3350.00, 201.06, 'Broken', '2026-02-02 08:17:44', '2026-02-02 08:17:44'),
(264, 1, 120, 123, 2, 1371, 15552, 'Consumer', 2879, NULL, 470.00, 2.00, 940.00, 0.00, 'Broken', '2026-02-02 15:49:43', '2026-02-02 15:49:43'),
(265, 1, 121, 10, 2, 838, 11620, 'Consumer', 2879, NULL, 470.00, 1.00, 470.00, 0.00, 'Broken', '2026-02-02 15:50:13', '2026-02-02 15:50:13'),
(266, 1, 118, 10, 2, 17, 248, 'Consumer', 312, NULL, 420.00, 2.00, 840.00, 50.41, 'Broken', '2026-02-02 15:52:45', '2026-02-02 15:52:45'),
(267, 1, 119, 10, 2, 838, 11614, 'Consumer', 2874, NULL, 290.00, 1.00, 290.00, 0.00, 'Broken', '2026-02-02 15:53:17', '2026-02-02 15:53:17'),
(268, 1, 122, 123, 2, 1371, 15553, 'Consumer', 3385, NULL, 710.00, 1.00, 710.00, 0.00, 'Broken', '2026-02-02 15:54:39', '2026-02-02 15:54:39'),
(274, 1, 124, 12, 2, 741, 10398, 'Consumer', 1227, NULL, 450.00, 1.00, 450.00, 0.00, 'Broken', '2026-02-06 10:41:48', '2026-02-06 10:41:48'),
(275, 1, 124, 12, 2, 1451, 15918, 'Consumer', 2217, NULL, 4.00, 60.00, 240.00, 0.00, 'Broken', '2026-02-06 10:41:48', '2026-02-06 10:41:48'),
(276, 1, 125, 86, 2, 1107, 14008, 'Consumer', 2124, NULL, 150.00, 1.00, 150.00, 0.00, 'Broken', '2026-02-07 07:50:39', '2026-02-07 07:50:39'),
(277, 1, 126, 88, 2, 1313, 15320, 'Consumer', 3305, NULL, 30.00, 1.00, 30.00, 0.00, 'Date Over', '2026-02-07 09:58:46', '2026-02-07 09:58:46'),
(278, 1, 126, 88, 2, 1336, 15392, 'Consumer', 3304, NULL, 25.00, 2.00, 50.00, 0.00, 'Date Over', '2026-02-07 09:58:46', '2026-02-07 09:58:46'),
(279, 1, 127, 88, 2, 1336, 15395, 'Consumer', 3336, NULL, 300.00, 1.00, 300.00, 0.00, 'Broken', '2026-02-07 10:27:42', '2026-02-07 10:27:42'),
(280, 1, 128, 88, 2, 1313, 15328, 'Consumer', 3326, NULL, 240.00, 1.00, 240.00, 0.00, 'Broken', '2026-02-07 10:33:16', '2026-02-07 10:33:16'),
(281, 1, 129, 88, 2, 1313, 15329, 'Consumer', 3327, NULL, 240.00, 1.00, 240.00, 0.00, 'Broken', '2026-02-07 10:37:04', '2026-02-07 10:37:04'),
(295, 1, 132, 101, 2, 668, 9722, 'Consumer', 2689, NULL, 324.00, 6.00, 1944.00, 0.00, 'Broken', '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(296, 1, 132, 101, 2, 668, 9723, 'Consumer', 2690, NULL, 270.00, 6.00, 1620.00, 0.00, 'Broken', '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(297, 1, 132, 101, 2, 852, 11952, 'Consumer', 2912, NULL, 303.60, 2.00, 607.20, 0.00, 'Broken', '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(298, 1, 132, 101, 2, 852, 11953, 'Consumer', 2913, NULL, 297.00, 1.00, 297.00, 0.00, 'Broken', '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(299, 1, 132, 101, 2, 852, 11957, 'Consumer', 2916, NULL, 945.00, 2.00, 1890.00, 0.00, 'Broken', '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(300, 1, 133, 7, 2, 593, 8502, 'Consumer', 248, NULL, 83.00, 3.00, 249.00, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(301, 1, 133, 7, 2, 593, 8503, 'Consumer', 253, NULL, 122.40, 1.00, 122.40, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(302, 1, 133, 7, 2, 593, 8504, 'Consumer', 254, NULL, 233.00, 2.00, 466.00, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(303, 1, 133, 7, 2, 593, 8505, 'Consumer', 2501, NULL, 276.43, 1.00, 276.43, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(304, 1, 133, 7, 2, 593, 8506, 'Consumer', 251, NULL, 69.25, 2.00, 138.50, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(305, 1, 133, 7, 2, 593, 8510, 'Consumer', 257, NULL, 43.00, 8.00, 344.00, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(306, 1, 133, 7, 2, 593, 8511, 'Consumer', 252, NULL, 74.50, 2.00, 149.00, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(307, 1, 133, 7, 2, 593, 8513, 'Consumer', 249, NULL, 153.00, 3.00, 459.00, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(308, 1, 133, 7, 2, 593, 8514, 'Consumer', 255, NULL, 186.50, 2.00, 373.00, 0.00, 'Broken', '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(309, 1, 134, 80, 2, 600, 8553, 'Consumer', 2511, NULL, 38.00, 15.00, 570.00, 0.00, 'Broken', '2026-02-10 15:06:30', '2026-02-10 15:06:30'),
(310, 1, 135, 12, 2, 1438, 15881, 'Consumer', 2217, NULL, 4.00, 19.00, 76.00, 0.00, 'Date Over', '2026-02-15 11:19:57', '2026-02-15 11:19:57'),
(311, 1, 136, 83, 2, 302, 6077, 'Consumer', 2050, NULL, 320.00, 2.00, 640.00, 0.00, 'Date Over', '2026-02-19 15:48:35', '2026-02-19 15:48:35'),
(314, 1, 138, 24, 2, 944, 12747, 'Consumer', 927, NULL, 600.00, 2.00, 1200.00, 0.00, 'Broken', '2026-02-28 08:41:48', '2026-02-28 08:41:48'),
(315, 1, 138, 24, 2, 944, 12748, 'Consumer', 926, NULL, 600.00, 8.00, 4800.00, 0.00, 'Broken', '2026-02-28 08:41:48', '2026-02-28 08:41:48'),
(316, 1, 139, 45, 2, 746, 10504, 'Consumer', 2787, NULL, 210.00, 1.00, 210.00, 0.00, 'Date Over', '2026-03-01 14:17:27', '2026-03-01 14:17:27'),
(317, 1, 140, 102, 2, 1068, 13816, 'Consumer', 1713, NULL, 610.00, 2.00, 1220.00, 0.00, 'Broken', '2026-03-02 09:37:26', '2026-03-02 09:37:26'),
(318, 1, 141, 68, 2, 361, 6489, 'Consumer', 2124, NULL, 150.00, 1.00, 150.00, 0.00, 'Broken', '2026-03-02 13:51:26', '2026-03-02 13:51:26'),
(319, 1, 141, 68, 2, 1312, 15319, 'Consumer', 2123, NULL, 150.00, 2.00, 300.00, 0.00, 'Broken', '2026-03-02 13:51:26', '2026-03-02 13:51:26'),
(361, 1, 142, 12, 2, 842, 11777, 'Consumer', 2742, NULL, 180.00, 2.00, 360.00, 0.00, 'Broken', '2026-03-06 15:13:49', '2026-03-06 15:13:49'),
(362, 1, 142, 12, 2, 971, 13013, 'Consumer', 2742, NULL, 180.00, 2.00, 360.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(363, 1, 142, 12, 2, 1130, 14177, 'Consumer', 2742, NULL, 180.00, 12.00, 2160.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(364, 1, 142, 12, 2, 1258, 15135, 'Consumer', 2742, NULL, 180.00, 5.00, 900.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(365, 1, 142, 12, 2, 1401, 15724, 'Consumer', 2742, NULL, 180.00, 3.00, 540.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(366, 1, 142, 12, 2, 1401, 15728, 'Consumer', 2217, NULL, 4.00, 26.00, 104.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(367, 1, 142, 12, 2, 1438, 15881, 'Consumer', 2217, NULL, 4.00, 11.00, 44.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(368, 1, 142, 12, 2, 1451, 15918, 'Consumer', 2217, NULL, 4.00, 83.00, 332.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(369, 1, 142, 12, 2, 1664, 16942, 'Consumer', 2742, NULL, 180.00, 4.00, 720.00, 0.00, 'Broken', '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(374, 1, 145, 72, 2, 1080, 13859, 'Consumer', 1780, NULL, 24.60, 5.00, 123.00, 0.00, 'Broken', '2026-03-07 10:33:00', '2026-03-07 10:33:00'),
(375, 1, 145, 72, 2, 1433, 15856, 'Consumer', 2839, NULL, 16.25, 4.00, 65.00, 0.00, 'Broken', '2026-03-07 10:33:00', '2026-03-07 10:33:00'),
(376, 1, 145, 72, 2, 1675, 16975, 'Consumer', 1771, NULL, 40.50, 1.00, 40.50, 0.00, 'Broken', '2026-03-07 10:33:00', '2026-03-07 10:33:00'),
(377, 1, 146, 37, 2, 770, 10920, 'Consumer', 2823, NULL, 180.00, 6.00, 1080.00, 0.00, 'Date Over', '2026-03-10 11:41:16', '2026-03-10 11:41:16'),
(378, 1, 147, 12, 2, 545, 8096, 'Consumer', 2445, NULL, 1590.00, 3.00, 4770.00, 0.00, 'Broken', '2026-03-11 15:31:48', '2026-03-11 15:31:48'),
(379, 1, 148, 12, 2, 545, 8096, 'Consumer', 2445, NULL, 1590.00, 3.00, 4770.00, 0.00, 'Broken', '2026-03-11 15:31:49', '2026-03-11 15:31:49'),
(380, 1, 149, 12, 2, 1283, 15213, 'Consumer', 3169, NULL, 45.00, 23.00, 1035.00, 0.00, 'Date Over', '2026-03-11 16:03:23', '2026-03-11 16:03:23'),
(381, 1, 149, 12, 2, 1309, 15313, 'Consumer', 3322, NULL, 45.50, 1.00, 45.50, 0.00, 'Date Over', '2026-03-11 16:03:23', '2026-03-11 16:03:23'),
(382, 1, 150, 86, 2, 1629, 16809, 'Consumer', 2120, NULL, 25.00, 1.00, 25.00, 0.00, 'Date Over', '2026-03-15 13:24:11', '2026-03-15 13:24:11'),
(383, 1, 150, 86, 2, 1629, 16810, 'Consumer', 2121, NULL, 30.00, 1.00, 30.00, 0.00, 'Date Over', '2026-03-15 13:24:11', '2026-03-15 13:24:11'),
(384, 1, 150, 86, 2, 1629, 16811, 'Consumer', 2119, NULL, 25.00, 1.00, 25.00, 0.00, 'Date Over', '2026-03-15 13:24:11', '2026-03-15 13:24:11'),
(385, 1, 150, 86, 2, 1727, 17225, 'Consumer', 2218, NULL, 110.00, 1.00, 110.00, 0.00, 'Date Over', '2026-03-15 13:24:11', '2026-03-15 13:24:11'),
(407, 1, 154, 88, 2, 1581, 16584, 'Consumer', 3255, NULL, 85.00, 1.00, 85.00, 0.00, 'Date Over', '2026-03-16 09:25:21', '2026-03-16 09:25:21'),
(420, 1, 153, 88, 2, 1287, 15234, 'Consumer', 3304, NULL, 25.00, 3.00, 75.00, 0.00, 'Date Over', '2026-03-16 09:36:45', '2026-03-16 09:36:45'),
(421, 1, 155, 88, 2, 1581, 16585, 'Consumer', 3256, NULL, 85.00, 1.00, 85.00, 0.00, 'Date Over', '2026-03-16 09:38:12', '2026-03-16 09:38:12'),
(422, 1, 156, 88, 2, 1287, 15228, 'Consumer', 3248, NULL, 110.00, 1.00, 110.00, 0.00, 'Date Over', '2026-03-16 09:39:13', '2026-03-16 09:39:13'),
(423, 1, 157, 88, 2, 1313, 15325, 'Consumer', 3306, NULL, 67.00, 1.00, 67.00, 0.00, 'Date Over', '2026-03-16 09:40:16', '2026-03-16 09:40:16'),
(424, 1, 158, 88, 2, 1287, 15237, 'Consumer', 3307, NULL, 67.00, 1.00, 67.00, 0.00, 'Date Over', '2026-03-16 09:40:43', '2026-03-16 09:40:43'),
(425, 1, 159, 41, 2, 814, 11381, 'Consumer', 1597, NULL, 63.00, 6.00, 378.00, 0.00, 'Broken', '2026-03-26 06:27:56', '2026-03-26 06:27:56'),
(426, 1, 160, 41, 2, 615, 9134, 'Consumer', 1600, NULL, 42.00, 6.00, 252.00, 0.00, 'Date Over', '2026-03-26 06:31:10', '2026-03-26 06:31:10'),
(427, 1, 160, 41, 2, 1041, 13502, 'Consumer', 1600, NULL, 42.00, 8.00, 336.00, 0.00, 'Date Over', '2026-03-26 06:31:10', '2026-03-26 06:31:10'),
(428, 1, 161, 37, 2, 96, 3000, 'Consumer', 1120, NULL, 215.00, 1.00, 215.00, 0.00, 'Date Over', '2026-03-27 09:16:46', '2026-03-27 09:16:46'),
(429, 1, 161, 37, 2, 96, 3001, 'Consumer', 1119, NULL, 215.00, 1.00, 215.00, 0.00, 'Date Over', '2026-03-27 09:16:46', '2026-03-27 09:16:46'),
(430, 1, 162, 37, 2, 1252, 15105, 'Consumer', 1112, NULL, 110.00, 1.00, 110.00, 0.00, 'Broken', '2026-03-27 09:17:17', '2026-03-27 09:17:17'),
(431, 1, 163, 88, 2, 1336, 15390, 'Consumer', 3249, NULL, 110.00, 1.00, 110.00, 0.00, 'Date Over', '2026-03-30 07:43:27', '2026-03-30 07:43:27'),
(433, 1, 164, 88, 2, 1685, 17032, 'Consumer', 3305, NULL, 30.00, 2.00, 60.00, 0.00, 'Date Over', '2026-03-30 07:47:23', '2026-03-30 07:47:23'),
(434, 1, 165, 88, 2, 1637, 16826, 'Consumer', 3326, NULL, 20.00, 5.00, 100.00, 0.00, 'Date Over', '2026-03-30 07:48:11', '2026-03-30 07:48:11'),
(435, 1, 166, 1, 2, 1221, 14996, 'Consumer', 3248, NULL, 110.00, 1.00, 110.00, 0.00, 'Date Over', '2026-03-30 07:51:12', '2026-03-30 07:51:12'),
(436, 1, 167, 65, 2, 1769, 17416, 'Consumer', 3902, NULL, 1100.00, 3.00, 3300.00, 0.00, 'Broken', '2026-03-30 14:33:31', '2026-03-30 14:33:31'),
(437, 1, 168, 1, 2, 146, 4243, 'Consumer', 1505, NULL, 480.00, 1.00, 480.00, 0.00, 'Date Over', '2026-04-01 16:06:32', '2026-04-01 16:06:32'),
(438, 1, 168, 1, 2, 1771, 17421, 'Consumer', 1505, NULL, 510.00, 1.00, 510.00, 0.00, 'Date Over', '2026-04-01 16:06:32', '2026-04-01 16:06:32'),
(439, 1, 169, 79, 2, 1109, 14011, 'Consumer', 3100, NULL, 115.00, 3.00, 345.00, 0.00, 'Date Over', '2026-04-04 07:35:17', '2026-04-04 07:35:17'),
(440, 1, 170, 79, 2, 1033, 13454, 'Consumer', 3101, NULL, 125.00, 3.00, 375.00, 0.00, 'Date Over', '2026-04-04 07:36:28', '2026-04-04 07:36:28'),
(441, 1, 171, 79, 2, 923, 12542, 'Consumer', 2580, NULL, 42.00, 3.00, 126.00, 0.00, 'Date Over', '2026-04-04 07:38:48', '2026-04-04 07:38:48'),
(446, 1, 176, 24, 2, 1198, 14880, 'Consumer', 3230, NULL, 190.12, 9.00, 1711.08, 0.00, 'Date Over', '2026-04-04 10:19:55', '2026-04-04 10:19:55'),
(448, 1, 178, 7, 2, 19, 340, 'Consumer', 330, NULL, 60.50, 8.00, 484.00, 0.00, 'Date Over', '2026-04-04 10:22:51', '2026-04-04 10:22:51'),
(449, 1, 179, 46, 2, 111, 3165, 'Consumer', 1207, NULL, 666.00, 1.00, 666.00, 0.00, 'Date Over', '2026-04-04 11:03:12', '2026-04-04 11:03:12'),
(450, 1, 180, 66, 2, 1417, 15789, 'Consumer', 1207, NULL, 725.00, 1.00, 725.00, 0.00, 'Date Over', '2026-04-04 11:06:07', '2026-04-04 11:06:07'),
(451, 1, 181, 46, 2, 111, 3165, 'Consumer', 1207, NULL, 666.00, 1.00, 666.00, 0.00, 'Date Over', '2026-04-04 11:08:32', '2026-04-04 11:08:32'),
(452, 1, 182, 101, 2, 1521, 16282, 'Consumer', 2915, NULL, 216.00, 4.00, 864.00, 0.00, 'Broken', '2026-04-05 11:45:22', '2026-04-05 11:45:22'),
(453, 1, 183, 101, 2, 1521, 16278, 'Consumer', 3595, NULL, 216.00, 4.00, 864.00, 0.00, 'Date Over', '2026-04-05 11:48:51', '2026-04-05 11:48:51'),
(454, 1, 184, 12, 2, 781, 11171, 'Consumer', 2516, NULL, 612.00, 1.00, 612.00, 0.00, 'Date Over', '2026-04-05 13:16:47', '2026-04-05 13:16:47'),
(455, 1, 184, 12, 2, 1283, 15208, 'Consumer', 2516, NULL, 612.00, 2.00, 1224.00, 0.00, 'Date Over', '2026-04-05 13:16:47', '2026-04-05 13:16:47'),
(456, 1, 185, 12, 2, 1309, 15313, 'Consumer', 3322, NULL, 45.50, 11.00, 500.50, 0.00, 'Date Over', '2026-04-05 13:17:36', '2026-04-05 13:17:36'),
(458, 1, 186, 47, 2, 199, 4693, 'Consumer', 1663, NULL, 90.00, 4.00, 360.00, 0.00, 'Date Over', '2026-04-06 08:19:32', '2026-04-06 08:19:32'),
(459, 1, 186, 47, 2, 1405, 15735, 'Consumer', 2465, NULL, 30.00, 1.00, 30.00, 0.00, 'Date Over', '2026-04-06 08:19:32', '2026-04-06 08:19:32'),
(461, 1, 187, 4, 2, 9, 71, 'Consumer', 200, NULL, 603.00, 1.00, 603.00, 0.00, 'Date Over', '2026-04-06 12:02:07', '2026-04-06 12:02:07'),
(463, 1, 188, 7, 2, 20, 390, 'Consumer', 361, NULL, 580.00, 3.00, 1740.00, 71.90, 'Date Over', '2026-04-09 08:23:36', '2026-04-09 08:23:36'),
(464, 1, 189, 19, 2, 562, 8175, 'Consumer', 2459, NULL, 534.00, 6.00, 3204.00, 0.00, 'Date Over', '2026-04-10 11:04:06', '2026-04-10 11:04:06'),
(465, 1, 189, 19, 2, 562, 8176, 'Consumer', 2461, NULL, 690.00, 5.00, 3450.00, 0.00, 'Date Over', '2026-04-10 11:04:06', '2026-04-10 11:04:06'),
(466, 1, 189, 19, 2, 562, 8177, 'Consumer', 2460, NULL, 650.00, 1.00, 650.00, 0.00, 'Date Over', '2026-04-10 11:04:06', '2026-04-10 11:04:06'),
(467, 1, 190, 25, 2, 1200, 14888, 'Consumer', 3231, NULL, 283.00, 1.00, 283.00, 0.00, 'Date Over', '2026-04-11 07:47:12', '2026-04-11 07:47:12'),
(468, 1, 191, 24, 2, 1796, 17547, 'Consumer', 3948, NULL, 23.28, 15.00, 349.20, 0.00, 'Date Over', '2026-04-19 10:02:17', '2026-04-19 10:02:17'),
(471, 1, 194, 88, 2, 1685, 17030, 'Consumer', 3694, NULL, 42.00, 3.00, 126.00, 0.00, 'Date Over', '2026-04-20 15:44:03', '2026-04-20 15:44:03'),
(472, 1, 195, 88, 2, 1512, 16243, 'Consumer', 3252, NULL, 160.00, 2.00, 320.00, 0.00, 'Date Over', '2026-04-20 15:48:42', '2026-04-20 15:48:42'),
(475, 1, 196, 7, 2, 20, 390, 'Consumer', 361, NULL, 580.00, 4.00, 2320.00, 95.87, 'Date Over', '2026-04-25 11:10:36', '2026-04-25 11:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `lifting_return_payments`
--

CREATE TABLE `lifting_return_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lifting_return_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lifting_return_payments`
--

INSERT INTO `lifting_return_payments` (`id`, `lifting_return_id`, `lifting_id`, `amount`, `created_at`, `updated_at`) VALUES
(6, 15, 8, 3355.96, '2025-07-14 13:55:19', '2025-07-14 13:55:19'),
(7, 16, 5, 868.00, '2025-07-14 14:23:34', '2025-07-14 14:23:34'),
(8, 17, 117, 1400.00, '2025-07-24 13:10:00', '2025-07-24 13:10:00'),
(9, 17, 170, 2563.60, '2025-07-24 13:10:00', '2025-07-24 13:10:00'),
(10, 18, 515, 570.00, '2025-08-07 15:50:12', '2025-08-07 15:50:12'),
(13, 19, 361, 80.00, '2025-08-11 13:41:23', '2025-08-11 13:41:23'),
(14, 20, 321, 5080.00, '2025-08-15 11:11:09', '2025-08-15 11:11:09'),
(15, 21, 243, 150.00, '2025-08-16 15:16:37', '2025-08-16 15:16:37'),
(16, 22, 361, 75.00, '2025-08-18 09:05:02', '2025-08-18 09:05:02'),
(23, 23, 57, 596.98, '2025-08-18 15:19:05', '2025-08-18 15:19:05'),
(24, 23, 215, 74.99, '2025-08-18 15:19:05', '2025-08-18 15:19:05'),
(25, 24, 50, 180.00, '2025-08-18 15:19:52', '2025-08-18 15:19:52'),
(26, 25, 53, 95.00, '2025-08-18 15:23:49', '2025-08-18 15:23:49'),
(27, 26, 429, 175.00, '2025-08-20 08:02:18', '2025-08-20 08:02:18'),
(28, 27, 122, 2700.00, '2025-08-23 13:46:35', '2025-08-23 13:46:35'),
(29, 28, 99, 1158.17, '2025-08-26 13:00:39', '2025-08-26 13:00:39'),
(30, 29, 604, 1061.20, '2025-08-26 13:01:53', '2025-08-26 13:01:53'),
(31, 30, 361, 55.00, '2025-08-27 08:26:00', '2025-08-27 08:26:00'),
(32, 31, 10, 580.00, '2025-09-09 09:35:41', '2025-09-09 09:35:41'),
(36, 32, 361, 30.00, '2025-09-10 09:03:11', '2025-09-10 09:03:11'),
(37, 33, 428, 110.00, '2025-09-10 09:03:49', '2025-09-10 09:03:49'),
(38, 34, 604, 235.00, '2025-09-13 11:45:26', '2025-09-13 11:45:26'),
(39, 35, 241, 131.50, '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(40, 35, 487, 16.17, '2025-09-21 09:03:33', '2025-09-21 09:03:33'),
(41, 36, 417, 600.00, '2025-09-24 11:24:42', '2025-09-24 11:24:42'),
(42, 37, 741, 239.00, '2025-10-05 10:03:22', '2025-10-05 10:03:22'),
(43, 38, 167, 960.00, '2025-10-11 09:25:08', '2025-10-11 09:25:08'),
(44, 39, 863, 227.00, '2025-10-12 10:39:43', '2025-10-12 10:39:43'),
(46, 41, 328, 2160.00, '2025-10-12 10:44:16', '2025-10-12 10:44:16'),
(47, 40, 198, 364.00, '2025-10-12 10:47:36', '2025-10-12 10:47:36'),
(48, 40, 702, 728.00, '2025-10-12 10:47:36', '2025-10-12 10:47:36'),
(49, 42, 113, 1615.00, '2025-10-15 10:13:52', '2025-10-15 10:13:52'),
(50, 43, 113, 159.00, '2025-10-15 10:14:47', '2025-10-15 10:14:47'),
(52, 44, 489, 3957.60, '2025-10-18 16:33:43', '2025-10-18 16:33:43'),
(53, 45, 360, 791.20, '2025-10-19 11:11:49', '2025-10-19 11:11:49'),
(54, 46, 511, 2842.00, '2025-10-21 15:00:05', '2025-10-21 15:00:05'),
(58, 47, 680, 4590.00, '2025-10-29 15:20:05', '2025-10-29 15:20:05'),
(60, 48, 213, 300.00, '2025-11-01 08:15:07', '2025-11-01 08:15:07'),
(63, 49, 971, 720.00, '2025-11-05 08:43:04', '2025-11-05 08:43:04'),
(65, 50, 449, 373.00, '2025-11-05 08:46:50', '2025-11-05 08:46:50'),
(66, 51, 238, 9036.00, '2025-11-05 08:48:51', '2025-11-05 08:48:51'),
(67, 52, 328, 726.00, '2025-11-05 08:49:57', '2025-11-05 08:49:57'),
(70, 53, 144, 619.76, '2025-11-05 08:58:55', '2025-11-05 08:58:55'),
(71, 54, 863, 292.00, '2025-11-09 10:18:21', '2025-11-09 10:18:21'),
(74, 55, 23, 753.00, '2025-11-09 10:28:46', '2025-11-09 10:28:46'),
(75, 55, 741, 1350.00, '2025-11-09 10:28:46', '2025-11-09 10:28:46'),
(79, 56, 186, 1980.00, '2025-11-12 14:46:58', '2025-11-12 14:46:58'),
(80, 57, 20, 322.11, '2025-11-13 08:22:13', '2025-11-13 08:22:13'),
(81, 58, 661, 52.00, '2025-11-15 09:08:20', '2025-11-15 09:08:20'),
(82, 59, 600, 570.00, '2025-11-22 08:12:07', '2025-11-22 08:12:07'),
(88, 63, 968, 16.17, '2025-11-29 08:00:39', '2025-11-29 08:00:39'),
(90, 62, 581, 123.00, '2025-11-29 08:01:35', '2025-11-29 08:01:35'),
(91, 61, 1080, 147.60, '2025-11-29 08:01:46', '2025-11-29 08:01:46'),
(92, 64, 1163, 190.00, '2025-11-29 14:10:32', '2025-11-29 14:10:32'),
(93, 65, 465, 15.43, '2025-12-01 13:35:04', '2025-12-01 13:35:04'),
(94, 65, 1183, 103.04, '2025-12-01 13:35:04', '2025-12-01 13:35:04'),
(95, 66, 119, 2280.00, '2025-12-07 13:58:57', '2025-12-07 13:58:57'),
(100, 67, 8, 663.65, '2025-12-08 14:47:52', '2025-12-08 14:47:52'),
(101, 67, 464, 1121.12, '2025-12-08 14:47:52', '2025-12-08 14:47:52'),
(102, 68, 369, 1272.00, '2025-12-17 09:09:58', '2025-12-17 09:09:58'),
(110, 69, 259, 27.86, '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(111, 69, 422, 348.50, '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(112, 69, 465, 291.68, '2025-12-24 10:39:17', '2025-12-24 10:39:17'),
(114, 71, 307, 550.00, '2025-12-29 09:23:12', '2025-12-29 09:23:12'),
(115, 70, 5, 1650.00, '2025-12-29 09:23:19', '2025-12-29 09:23:19'),
(116, 72, 439, 375.00, '2026-01-03 12:03:04', '2026-01-03 12:03:04'),
(117, 73, 270, 1410.67, '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(118, 73, 489, 3957.60, '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(119, 73, 1198, 208.55, '2026-01-03 12:13:00', '2026-01-03 12:13:00'),
(120, 74, 835, 190.00, '2026-01-08 09:39:26', '2026-01-08 09:39:26'),
(122, 75, 1068, 3280.00, '2026-01-11 15:27:48', '2026-01-11 15:27:48'),
(124, 76, 122, 690.00, '2026-01-25 06:38:56', '2026-01-25 06:38:56'),
(125, 80, 1425, 2520.00, '2026-01-26 13:58:51', '2026-01-26 13:58:51'),
(126, 81, 622, 10440.00, '2026-01-31 08:48:10', '2026-01-31 08:48:10'),
(129, 82, 622, 4560.00, '2026-01-31 09:52:11', '2026-01-31 09:52:11'),
(130, 87, 620, 3920.00, '2026-01-31 09:52:57', '2026-01-31 09:52:57'),
(134, 88, 620, 3420.00, '2026-01-31 10:58:30', '2026-01-31 10:58:30'),
(136, 89, 622, 1130.00, '2026-01-31 11:02:51', '2026-01-31 11:02:51'),
(137, 90, 622, 3060.00, '2026-01-31 11:08:37', '2026-01-31 11:08:37'),
(142, 91, 622, 2920.00, '2026-01-31 11:28:06', '2026-01-31 11:28:06'),
(143, 92, 622, 2700.00, '2026-01-31 11:49:56', '2026-01-31 11:49:56'),
(144, 94, 622, 2520.00, '2026-01-31 12:16:30', '2026-01-31 12:16:30'),
(145, 95, 622, 4675.00, '2026-01-31 13:19:30', '2026-01-31 13:19:30'),
(147, 96, 620, 5280.00, '2026-01-31 14:17:35', '2026-01-31 14:17:35'),
(148, 97, 620, 4320.00, '2026-01-31 14:18:26', '2026-01-31 14:18:26'),
(149, 98, 620, 1925.00, '2026-01-31 14:55:40', '2026-01-31 14:55:40'),
(151, 99, 620, 2750.00, '2026-01-31 15:05:33', '2026-01-31 15:05:33'),
(152, 100, 620, 2880.00, '2026-01-31 15:16:35', '2026-01-31 15:16:35'),
(155, 101, 620, 1850.00, '2026-01-31 15:25:58', '2026-01-31 15:25:58'),
(156, 102, 620, 1440.00, '2026-01-31 15:40:59', '2026-01-31 15:40:59'),
(157, 103, 620, 2508.00, '2026-01-31 16:07:38', '2026-01-31 16:07:38'),
(158, 104, 620, 4400.00, '2026-01-31 16:20:40', '2026-01-31 16:20:40'),
(160, 105, 622, 14720.00, '2026-01-31 16:35:54', '2026-01-31 16:35:54'),
(163, 106, 17, 2594.35, '2026-02-01 07:53:16', '2026-02-01 07:53:16'),
(164, 106, 603, 2760.00, '2026-02-01 07:53:16', '2026-02-01 07:53:16'),
(169, 108, 603, 2940.00, '2026-02-01 10:05:22', '2026-02-01 10:05:22'),
(176, 111, 603, 2500.00, '2026-02-01 10:27:51', '2026-02-01 10:27:51'),
(183, 107, 17, 2293.56, '2026-02-01 10:36:12', '2026-02-01 10:36:12'),
(184, 107, 603, 4270.00, '2026-02-01 10:36:12', '2026-02-01 10:36:12'),
(188, 112, 17, 573.39, '2026-02-01 11:07:36', '2026-02-01 11:07:36'),
(190, 109, 17, 2763.55, '2026-02-01 11:11:44', '2026-02-01 11:11:44'),
(191, 109, 603, 3920.00, '2026-02-01 11:11:44', '2026-02-01 11:11:44'),
(193, 113, 620, 3240.00, '2026-02-01 11:25:05', '2026-02-01 11:25:05'),
(194, 115, 17, 1409.97, '2026-02-01 12:11:42', '2026-02-01 12:11:42'),
(195, 116, 17, 639.19, '2026-02-01 13:25:52', '2026-02-01 13:25:52'),
(196, 117, 17, 3148.94, '2026-02-02 08:17:44', '2026-02-02 08:17:44'),
(199, 120, 1371, 940.00, '2026-02-02 15:49:43', '2026-02-02 15:49:43'),
(200, 121, 838, 470.00, '2026-02-02 15:50:13', '2026-02-02 15:50:13'),
(201, 118, 17, 789.59, '2026-02-02 15:52:45', '2026-02-02 15:52:45'),
(202, 119, 838, 290.00, '2026-02-02 15:53:17', '2026-02-02 15:53:17'),
(203, 122, 1371, 710.00, '2026-02-02 15:54:39', '2026-02-02 15:54:39'),
(204, 124, 741, 450.00, '2026-02-06 10:41:48', '2026-02-06 10:41:48'),
(205, 124, 1451, 240.00, '2026-02-06 10:41:48', '2026-02-06 10:41:48'),
(206, 125, 1107, 150.00, '2026-02-07 07:50:39', '2026-02-07 07:50:39'),
(207, 126, 1313, 30.00, '2026-02-07 09:58:46', '2026-02-07 09:58:46'),
(208, 126, 1336, 50.00, '2026-02-07 09:58:46', '2026-02-07 09:58:46'),
(209, 127, 1336, 300.00, '2026-02-07 10:27:42', '2026-02-07 10:27:42'),
(210, 128, 1313, 240.00, '2026-02-07 10:33:16', '2026-02-07 10:33:16'),
(211, 129, 1313, 240.00, '2026-02-07 10:37:04', '2026-02-07 10:37:04'),
(214, 132, 668, 3564.00, '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(215, 132, 852, 2794.20, '2026-02-08 11:14:05', '2026-02-08 11:14:05'),
(216, 133, 593, 2577.33, '2026-02-09 11:54:49', '2026-02-09 11:54:49'),
(217, 134, 600, 570.00, '2026-02-10 15:06:30', '2026-02-10 15:06:30'),
(218, 135, 1438, 76.00, '2026-02-15 11:19:57', '2026-02-15 11:19:57'),
(219, 136, 302, 640.00, '2026-02-19 15:48:35', '2026-02-19 15:48:35'),
(220, 138, 944, 6000.00, '2026-02-28 08:41:48', '2026-02-28 08:41:48'),
(221, 139, 746, 210.00, '2026-03-01 14:17:27', '2026-03-01 14:17:27'),
(222, 140, 1068, 1220.00, '2026-03-02 09:37:26', '2026-03-02 09:37:26'),
(223, 141, 361, 150.00, '2026-03-02 13:51:26', '2026-03-02 13:51:26'),
(224, 141, 1312, 300.00, '2026-03-02 13:51:26', '2026-03-02 13:51:26'),
(249, 142, 842, 360.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(250, 142, 971, 360.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(251, 142, 1130, 2160.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(252, 142, 1258, 900.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(253, 142, 1401, 644.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(254, 142, 1438, 44.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(255, 142, 1451, 332.00, '2026-03-06 15:13:50', '2026-03-06 15:13:50'),
(256, 145, 1080, 123.00, '2026-03-07 10:33:00', '2026-03-07 10:33:00'),
(257, 145, 1433, 65.00, '2026-03-07 10:33:00', '2026-03-07 10:33:00'),
(258, 146, 770, 1080.00, '2026-03-10 11:41:16', '2026-03-10 11:41:16'),
(259, 147, 545, 4770.00, '2026-03-11 15:31:49', '2026-03-11 15:31:49'),
(260, 149, 1283, 1035.00, '2026-03-11 16:03:23', '2026-03-11 16:03:23'),
(261, 149, 1309, 45.50, '2026-03-11 16:03:23', '2026-03-11 16:03:23'),
(262, 150, 1629, 80.00, '2026-03-15 13:24:11', '2026-03-15 13:24:11'),
(266, 154, 1581, 85.00, '2026-03-16 09:25:21', '2026-03-16 09:25:21'),
(271, 153, 1287, 75.00, '2026-03-16 09:36:45', '2026-03-16 09:36:45'),
(272, 155, 1581, 85.00, '2026-03-16 09:38:12', '2026-03-16 09:38:12'),
(273, 156, 1287, 110.00, '2026-03-16 09:39:13', '2026-03-16 09:39:13'),
(274, 157, 1313, 67.00, '2026-03-16 09:40:16', '2026-03-16 09:40:16'),
(275, 158, 1287, 67.00, '2026-03-16 09:40:43', '2026-03-16 09:40:43'),
(276, 159, 814, 378.00, '2026-03-26 06:27:56', '2026-03-26 06:27:56'),
(277, 160, 615, 252.00, '2026-03-26 06:31:10', '2026-03-26 06:31:10'),
(278, 160, 1041, 336.00, '2026-03-26 06:31:10', '2026-03-26 06:31:10'),
(279, 161, 96, 430.00, '2026-03-27 09:16:46', '2026-03-27 09:16:46'),
(280, 162, 1252, 110.00, '2026-03-27 09:17:17', '2026-03-27 09:17:17'),
(281, 163, 1336, 110.00, '2026-03-30 07:43:27', '2026-03-30 07:43:27'),
(283, 164, 1685, 60.00, '2026-03-30 07:47:23', '2026-03-30 07:47:23'),
(284, 165, 1637, 100.00, '2026-03-30 07:48:11', '2026-03-30 07:48:11'),
(285, 166, 1221, 110.00, '2026-03-30 07:51:12', '2026-03-30 07:51:12'),
(286, 168, 146, 480.00, '2026-04-01 16:06:32', '2026-04-01 16:06:32'),
(287, 168, 1771, 510.00, '2026-04-01 16:06:32', '2026-04-01 16:06:32'),
(288, 169, 1109, 345.00, '2026-04-04 07:35:17', '2026-04-04 07:35:17'),
(289, 170, 1033, 375.00, '2026-04-04 07:36:28', '2026-04-04 07:36:28'),
(290, 171, 923, 126.00, '2026-04-04 07:38:48', '2026-04-04 07:38:48'),
(291, 176, 1198, 1711.08, '2026-04-04 10:19:55', '2026-04-04 10:19:55'),
(292, 178, 19, 1504.00, '2026-04-04 10:22:51', '2026-04-04 10:22:51'),
(293, 179, 111, 666.00, '2026-04-04 11:03:12', '2026-04-04 11:03:12'),
(294, 180, 1417, 725.00, '2026-04-04 11:06:07', '2026-04-04 11:06:07'),
(295, 181, 111, 666.00, '2026-04-04 11:08:32', '2026-04-04 11:08:32'),
(296, 182, 1521, 864.00, '2026-04-05 11:45:22', '2026-04-05 11:45:22'),
(297, 183, 1521, 864.00, '2026-04-05 11:48:51', '2026-04-05 11:48:51'),
(298, 184, 781, 612.00, '2026-04-05 13:16:47', '2026-04-05 13:16:47'),
(299, 184, 1283, 1224.00, '2026-04-05 13:16:47', '2026-04-05 13:16:47'),
(300, 185, 1309, 500.50, '2026-04-05 13:17:36', '2026-04-05 13:17:36'),
(302, 186, 199, 360.00, '2026-04-06 08:19:33', '2026-04-06 08:19:33'),
(303, 186, 1405, 30.00, '2026-04-06 08:19:33', '2026-04-06 08:19:33'),
(305, 187, 9, 603.00, '2026-04-06 12:02:08', '2026-04-06 12:02:08'),
(307, 188, 20, 1668.10, '2026-04-09 08:23:36', '2026-04-09 08:23:36'),
(308, 189, 562, 7304.00, '2026-04-10 11:04:06', '2026-04-10 11:04:06'),
(309, 190, 1200, 283.00, '2026-04-11 07:47:12', '2026-04-11 07:47:12'),
(310, 191, 1796, 349.20, '2026-04-19 10:02:17', '2026-04-19 10:02:17'),
(311, 194, 1685, 126.00, '2026-04-20 15:44:03', '2026-04-20 15:44:03'),
(312, 195, 1512, 320.00, '2026-04-20 15:48:42', '2026-04-20 15:48:42'),
(315, 196, 20, 2224.13, '2026-04-25 11:10:36', '2026-04-25 11:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `delivery_charge` int(11) NOT NULL DEFAULT 0,
  `district` tinyint(4) NOT NULL DEFAULT 0,
  `thana` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `parent_id`, `name`, `delivery_charge`, `district`, `thana`, `created_at`, `updated_at`) VALUES
(13, NULL, 'Dhaka', 60, 0, 0, '2023-02-02 09:23:07', '2023-07-29 09:19:33'),
(14, NULL, 'Rajshahi', 120, 0, 0, '2023-02-02 09:23:30', '2023-07-29 09:20:36'),
(15, NULL, 'Rangpur', 120, 0, 0, '2023-02-02 09:23:45', '2023-07-29 09:20:54'),
(16, NULL, 'Mymensingh', 120, 0, 0, '2023-02-02 09:23:54', '2023-07-29 09:20:03'),
(17, NULL, 'Sylhet', 120, 0, 0, '2023-02-02 09:24:12', '2023-07-29 09:20:13'),
(18, NULL, 'Khulna', 120, 0, 0, '2023-02-02 09:24:30', '2023-07-29 09:19:50'),
(19, NULL, 'Barisal', 120, 0, 0, '2023-02-02 09:24:39', '2023-07-29 09:21:06'),
(20, NULL, 'Chittagong', 120, 0, 0, '2023-02-02 09:24:49', '2023-07-29 09:18:42'),
(28, 19, 'Barguna', 0, 1, 0, NULL, NULL),
(29, 19, 'Barisal', 0, 1, 0, NULL, NULL),
(30, 19, 'Bhola', 0, 1, 0, NULL, NULL),
(31, 19, 'Jhalokati', 0, 1, 0, NULL, NULL),
(32, 19, 'Patuakhali', 0, 1, 0, NULL, NULL),
(33, 19, 'Pirojpur', 0, 1, 0, NULL, NULL),
(34, 20, 'Bandarban', 0, 1, 0, NULL, NULL),
(35, 20, 'Brahmanbaria', 0, 1, 0, NULL, NULL),
(36, 20, 'Chandpur', 0, 1, 0, NULL, NULL),
(37, 20, 'Chittagong', 0, 1, 0, NULL, NULL),
(38, 20, 'Comilla', 0, 1, 0, NULL, NULL),
(39, 20, 'Cox\'s Bazar', 0, 1, 0, NULL, NULL),
(40, 20, 'Feni', 0, 1, 0, NULL, NULL),
(41, 20, 'Khagrachhari', 0, 1, 0, NULL, NULL),
(42, 20, 'Lakshmipur', 0, 1, 0, NULL, NULL),
(43, 20, 'Noakhali', 0, 1, 0, NULL, NULL),
(44, 20, 'Rangamati', 0, 1, 0, NULL, NULL),
(45, 13, 'Dhaka', 0, 1, 0, NULL, NULL),
(46, 13, 'Faridpur', 0, 1, 0, NULL, NULL),
(47, 13, 'Gazipur', 0, 1, 0, NULL, NULL),
(48, 13, 'Gopalganj', 0, 1, 0, NULL, NULL),
(49, 13, 'Jamalpur', 0, 1, 0, NULL, NULL),
(50, 13, 'Kishoreganj', 0, 1, 0, NULL, NULL),
(51, 13, 'Madaripur', 0, 1, 0, NULL, NULL),
(52, 13, 'Manikganj', 0, 1, 0, NULL, NULL),
(53, 13, 'Munshiganj', 0, 1, 0, NULL, NULL),
(54, 13, 'Mymensingh', 0, 1, 0, NULL, NULL),
(55, 13, 'Narayanganj', 0, 1, 0, NULL, NULL),
(56, 13, 'Narsingdi', 0, 1, 0, NULL, NULL),
(57, 13, 'Netrokona', 0, 1, 0, NULL, NULL),
(58, 13, 'Rajbari', 0, 1, 0, NULL, NULL),
(59, 13, 'Shariatpur', 0, 1, 0, NULL, NULL),
(60, 13, 'Sherpur', 0, 1, 0, NULL, NULL),
(61, 13, 'Tangail', 0, 1, 0, NULL, NULL),
(62, 18, 'Bagerhat', 0, 1, 0, NULL, NULL),
(63, 18, 'Chuadanga', 0, 1, 0, NULL, NULL),
(64, 18, 'Jessore', 0, 1, 0, NULL, NULL),
(65, 18, 'Jhenaidah', 0, 1, 0, NULL, NULL),
(66, 18, 'Khulna', 0, 1, 0, NULL, NULL),
(67, 18, 'Kushtia', 0, 1, 0, NULL, NULL),
(68, 18, 'Magura', 0, 1, 0, NULL, NULL),
(69, 18, 'Meherpur', 0, 1, 0, NULL, NULL),
(70, 18, 'Narail', 0, 1, 0, NULL, NULL),
(71, 18, 'Satkhira', 0, 1, 0, NULL, NULL),
(72, 14, 'Bogra', 0, 1, 0, NULL, NULL),
(73, 14, 'Joypurhat', 0, 1, 0, NULL, NULL),
(74, 14, 'Naogaon', 0, 1, 0, NULL, NULL),
(75, 14, 'Natore', 0, 1, 0, NULL, NULL),
(76, 14, 'Nawabganj', 0, 1, 0, NULL, NULL),
(77, 14, 'Pabna', 0, 1, 0, NULL, NULL),
(78, 14, 'Rajshahi', 0, 1, 0, NULL, NULL),
(79, 14, 'Sirajganj', 0, 1, 0, NULL, NULL),
(80, 15, 'Dinajpur', 0, 1, 0, NULL, NULL),
(81, 15, 'Gaibandha', 0, 1, 0, NULL, NULL),
(82, 15, 'Kurigram', 0, 1, 0, NULL, NULL),
(83, 15, 'Lalmonirhat', 0, 1, 0, NULL, NULL),
(84, 15, 'Nilphamari', 0, 1, 0, NULL, NULL),
(85, 15, 'Panchagarh', 0, 1, 0, NULL, NULL),
(86, 15, 'Rangpur', 0, 1, 0, NULL, NULL),
(87, 15, 'Thakurgaon', 0, 1, 0, NULL, NULL),
(88, 17, 'Habiganj', 0, 1, 0, NULL, NULL),
(89, 17, 'Moulvibazar', 0, 1, 0, NULL, NULL),
(90, 17, 'Sunamganj', 0, 1, 0, NULL, NULL),
(91, 17, 'Sylhet', 0, 1, 0, NULL, NULL),
(92, 73, 'Akkelpur', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(93, 73, 'Joypurhat Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(94, 73, 'Kalai ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(95, 73, 'Khetlal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(96, 73, 'Panchbibi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(97, 72, 'Adamdighi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(98, 72, 'Bogra Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(99, 72, 'Dhunat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(100, 72, 'Dhupchanchia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(101, 72, 'Gabtali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(102, 72, 'Kahaloo ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(103, 72, 'Nandigram ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(104, 72, 'Sariakandi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(105, 72, 'Shajahanpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(106, 72, 'Sherpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(107, 72, 'Shibganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(108, 72, 'Sonatola ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(109, 74, 'Atrai ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(110, 74, 'Badalgachhi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(111, 74, 'Manda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(112, 74, 'Dhamoirhat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(113, 74, 'Mohadevpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(114, 74, 'Naogaon Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(115, 74, 'Niamatpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(116, 74, 'Patnitala ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(117, 74, 'Porsha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(118, 74, 'Raninagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(119, 74, 'Sapahar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(120, 75, 'Bagatipara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(121, 75, 'Baraigram ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(122, 75, 'Gurudaspur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(123, 75, 'Lalpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(124, 75, 'Natore Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(125, 75, 'Singra ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(126, 75, 'Naldanga ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(127, 76, 'Bholahat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(128, 76, 'Gomastapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(129, 76, 'Nachole ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(130, 76, 'Nawabganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(131, 76, 'Shibganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(132, 77, 'Ataikula ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(133, 77, 'Atgharia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(134, 77, 'Bera ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(135, 77, 'Bhangura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(136, 77, 'Chatmohar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(137, 77, 'Faridpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(138, 77, 'Ishwardi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(139, 77, 'Pabna Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(140, 77, 'Santhia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(141, 77, 'Sujanagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(142, 79, 'Belkuchi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(143, 79, 'Chauhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(144, 79, 'Kamarkhanda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(145, 79, 'Kazipur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(146, 79, 'Raiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(147, 79, 'Shahjadpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(148, 79, 'Sirajganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(149, 79, 'Tarash ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(150, 79, 'Ullahpara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(151, 78, 'Bagha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(152, 78, 'Bagmara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(153, 78, 'Charghat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(154, 78, 'Durgapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(155, 78, 'Godagari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(156, 78, 'Mohanpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(157, 78, 'Paba ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(158, 78, 'Puthia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(159, 78, 'Tanore ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(160, 78, 'Boalia Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(161, 78, 'Matihar Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(162, 78, 'Rajpara Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(163, 78, 'Shah Mokdum Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(164, 80, 'Birampur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(165, 80, 'Birganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(166, 80, 'Biral ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(167, 80, 'Bochaganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(168, 80, 'Chirirbandar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(169, 80, 'Phulbari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(170, 80, 'Ghoraghat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(171, 80, 'Hakimpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(172, 80, 'Kaharole ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(173, 80, 'Khansama ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(174, 80, 'Dinajpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(175, 80, 'Nawabganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(176, 80, 'Parbatipur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(177, 81, 'Phulchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(178, 81, 'Gaibandha Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(179, 81, 'Gobindaganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(180, 81, 'Palashbari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(181, 81, 'Sadullapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(182, 81, 'Sughatta ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(183, 81, 'Sundarganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(184, 82, 'Bhurungamari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(185, 82, 'Char Rajibpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(186, 82, 'Chilmari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(187, 82, 'Phulbari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(188, 82, 'Kurigram Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(189, 82, 'Nageshwari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(190, 82, 'Rajarhat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(191, 82, 'Raomari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(192, 82, 'Ulipur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(193, 83, 'Aditmari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(194, 83, 'Hatibandha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(195, 83, 'Kaliganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(196, 83, 'Lalmonirhat Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(197, 83, 'Patgram ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(198, 84, 'Dimla ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(199, 84, 'Domar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(200, 84, 'Jaldhaka ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(201, 84, 'Kishoreganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(202, 84, 'Nilphamari Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(203, 84, 'Saidpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(204, 85, 'Atwari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(205, 85, 'Boda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(206, 85, 'Debiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(207, 85, 'Panchagarh Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(208, 85, 'Tetulia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(209, 86, 'Badarganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(210, 86, 'Gangachhara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(211, 86, 'Kaunia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(212, 86, 'Rangpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(213, 86, 'Mithapukur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(214, 86, 'Pirgachha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(215, 86, 'Pirganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(216, 86, 'Taraganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(217, 87, 'Baliadangi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(218, 87, 'Haripur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(219, 87, 'Pirganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(220, 87, 'Ranisankail ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(221, 87, 'Thakurgaon Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(222, 28, 'Amtali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(223, 28, 'Bamna ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(224, 28, 'Barguna Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(225, 28, 'Betagi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(226, 28, 'Patharghata ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(227, 28, 'Taltoli ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(228, 29, 'Agailjhara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(229, 29, 'Babuganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(230, 29, 'Bakerganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(231, 29, 'Banaripara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(232, 29, 'Gaurnadi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(233, 29, 'Hizla ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(234, 29, 'Barisal Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(235, 29, 'Mehendiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(236, 29, 'Muladi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(237, 29, 'Wazirpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(238, 30, 'Bhola Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(239, 30, 'Burhanuddin ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(240, 30, 'Char Fasson ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(241, 30, 'Daulatkhan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(242, 30, 'Lalmohan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(243, 30, 'Manpura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(244, 30, 'Tazumuddin ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(245, 31, 'Jhalokati Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(246, 31, 'Kathalia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(247, 31, 'Nalchity ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(248, 31, 'Rajapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(249, 32, 'Bauphal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(250, 32, 'Dashmina ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(251, 32, 'Galachipa ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(252, 32, 'Kalapara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(253, 32, 'Mirzaganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(254, 32, 'Patuakhali Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(255, 32, 'Rangabali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(256, 32, 'Dumki ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(257, 33, 'Bhandaria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(258, 33, 'Kawkhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(259, 33, 'Mathbaria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(260, 33, 'Nazirpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(261, 33, 'Pirojpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(262, 33, 'Nesarabad (Swarupkati) ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(263, 33, 'Zianagor ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(264, 34, 'Ali Kadam ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(265, 34, 'Bandarban Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(266, 34, 'Lama ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(267, 34, 'Naikhongchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(268, 34, 'Rowangchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(269, 34, 'Ruma ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(270, 34, 'Thanchi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(271, 35, 'Akhaura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(272, 35, 'Bancharampur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(273, 35, 'Brahmanbaria Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(274, 35, 'Kasba ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(275, 35, 'Nabinagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(276, 35, 'Nasirnagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(277, 35, 'Sarail ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(278, 35, 'Ashuganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(279, 35, 'Bijoynagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(280, 36, 'Chandpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(281, 36, 'Faridganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(282, 36, 'Haimchar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(283, 36, 'Haziganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(284, 36, 'Kachua ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(285, 36, 'Matlab Dakshin ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(286, 36, 'Matlab Uttar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(287, 36, 'Shahrasti ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(288, 37, 'Anwara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(289, 37, 'Banshkhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(290, 37, 'Boalkhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(291, 37, 'Chandanaish ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(292, 37, 'Fatikchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(293, 37, 'Hathazari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(294, 37, 'Lohagara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(295, 37, 'Mirsharai ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(296, 37, 'Patiya ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(297, 37, 'Rangunia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(298, 37, 'Raozan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(299, 37, 'Sandwip ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(300, 37, 'Satkania ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(301, 37, 'Sitakunda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(302, 37, 'Bandor (Chittagong Port) Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(303, 37, 'Chandgaon Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(304, 37, 'Double Mooring Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(305, 37, 'Kotwali Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(306, 37, 'Pahartali Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(307, 37, 'Panchlaish Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(308, 38, 'Barura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(309, 38, 'Brahmanpara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(310, 38, 'Burichang ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(311, 38, 'Chandina ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(312, 38, 'Chauddagram ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(313, 38, 'Daudkandi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(314, 38, 'Debidwar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(315, 38, 'Homna ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(316, 38, 'Laksam ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(317, 38, 'Muradnagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(318, 38, 'Nangalkot ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(319, 38, 'Comilla Adarsha Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(320, 38, 'Meghna ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(321, 38, 'Titas ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(322, 38, 'Monohargonj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(323, 38, 'Comilla Sadar Dakshin ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(324, 39, 'Chakaria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(325, 39, 'Cox\'s Bazar Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(326, 39, 'Kutubdia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(327, 39, 'Maheshkhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(328, 39, 'Ramu ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(329, 39, 'Teknaf ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(330, 39, 'Ukhia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(331, 39, 'Pekua ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(332, 40, 'Chhagalnaiya ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(333, 40, 'Daganbhuiyan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(334, 40, 'Feni Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(335, 40, 'Parshuram ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(336, 40, 'Sonagazi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(337, 40, 'Fulgazi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(338, 41, 'Dighinala ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(339, 41, 'Khagrachhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(340, 41, 'Lakshmichhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(341, 41, 'Mahalchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(342, 41, 'Manikchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(343, 41, 'Matiranga ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(344, 41, 'Panchhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(345, 41, 'Ramgarh ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(346, 42, 'Lakshmipur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(347, 42, 'Raipur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(348, 42, 'Ramganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(349, 42, 'Ramgati ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(350, 42, 'Kamalnagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(351, 43, 'Begumganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(352, 43, 'Noakhali Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(353, 43, 'Chatkhil ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(354, 43, 'Companiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(355, 43, 'Hatiya ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(356, 43, 'Senbagh ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(357, 43, 'Sonaimuri ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(358, 43, 'Subarnachar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(359, 43, 'Kabirhat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(360, 44, 'Bagaichhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(361, 44, 'Barkal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(362, 44, 'Kawkhali (Betbunia) ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(363, 44, 'Belaichhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(364, 44, 'Kaptai ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(365, 44, 'Juraichhari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(366, 44, 'Langadu ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(367, 44, 'Naniyachar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(368, 44, 'Rajasthali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(369, 44, 'Rangamati Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(370, 45, 'Dhamrai ', 100, 0, 1, NULL, '2023-08-14 07:55:43'),
(371, 45, 'Dohar ', 100, 0, 1, NULL, '2023-08-14 07:55:43'),
(372, 45, 'Dhaka City Corporation Area', 80, 0, 1, NULL, '2023-08-14 07:55:43'),
(373, 45, 'Keraniganj ', 100, 0, 1, NULL, '2023-08-14 07:55:43'),
(374, 45, 'Nawabganj ', 100, 0, 1, NULL, '2023-08-14 07:55:43'),
(375, 45, 'Savar ', 100, 0, 1, NULL, '2023-08-14 07:55:43'),
(376, 46, 'Alfadanga ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(377, 46, 'Bhanga ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(378, 46, 'Boalmari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(379, 46, 'Charbhadrasan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(380, 46, 'Faridpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(381, 46, 'Madhukhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(382, 46, 'Nagarkanda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(383, 46, 'Sadarpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(384, 46, 'Saltha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(385, 47, 'Gazipur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(386, 47, 'Kaliakair ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(387, 47, 'Kaliganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(388, 47, 'Kapasia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(389, 47, 'Sreepur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(390, 48, 'Gopalganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(391, 48, 'Kashiani ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(392, 48, 'Kotalipara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(393, 48, 'Muksudpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(394, 48, 'Tungipara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(395, 49, 'Baksiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(396, 49, 'Dewanganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(397, 49, 'Islampur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(398, 49, 'Jamalpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(399, 49, 'Madarganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(400, 49, 'Melandaha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(401, 49, 'Sarishabari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(402, 50, 'Astagram ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(403, 50, 'Bajitpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(404, 50, 'Bhairab ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(405, 50, 'Hossainpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(406, 50, 'Itna ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(407, 50, 'Karimganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(408, 50, 'Katiadi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(409, 50, 'Kishoreganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(410, 50, 'Kuliarchar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(411, 50, 'Mithamain ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(412, 50, 'Nikli ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(413, 50, 'Pakundia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(414, 50, 'Tarail ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(415, 51, 'Rajoir ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(416, 51, 'Madaripur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(417, 51, 'Kalkini ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(418, 51, 'Shibchar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(419, 52, 'Daulatpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(420, 52, 'Ghior ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(421, 52, 'Harirampur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(422, 52, 'Manikgonj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(423, 52, 'Saturia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(424, 52, 'Shivalaya ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(425, 52, 'Singair ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(426, 53, 'Gazaria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(427, 53, 'Lohajang ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(428, 53, 'Munshiganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(429, 53, 'Sirajdikhan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(430, 53, 'Sreenagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(431, 53, 'Tongibari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(432, 54, 'Bhaluka ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(433, 54, 'Dhobaura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(434, 54, 'Fulbaria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(435, 54, 'Gaffargaon ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(436, 54, 'Gauripur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(437, 54, 'Haluaghat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(438, 54, 'Ishwarganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(439, 54, 'Mymensingh Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(440, 54, 'Muktagachha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(441, 54, 'Nandail ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(442, 54, 'Phulpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(443, 54, 'Trishal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(444, 54, 'Tara Khanda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(445, 55, 'Araihazar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(446, 55, 'Bandar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(447, 55, 'Narayanganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(448, 55, 'Rupganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(449, 55, 'Sonargaon ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(450, 57, 'Atpara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(451, 57, 'Barhatta ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(452, 57, 'Durgapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(453, 57, 'Khaliajuri ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(454, 57, 'Kalmakanda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(455, 57, 'Kendua ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(456, 57, 'Madan ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(457, 57, 'Mohanganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(458, 57, 'Netrokona Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(459, 57, 'Purbadhala ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(460, 58, 'Baliakandi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(461, 58, 'Goalandaghat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(462, 58, 'Pangsha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(463, 58, 'Rajbari Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(464, 58, 'Kalukhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(465, 59, 'Bhedarganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(466, 59, 'Damudya ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(467, 59, 'Gosairhat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(468, 59, 'Naria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(469, 59, 'Shariatpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(470, 59, 'Zanjira ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(471, 59, 'Shakhipur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(472, 60, 'Jhenaigati ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(473, 60, 'Nakla ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(474, 60, 'Nalitabari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(475, 60, 'Sherpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(476, 60, 'Sreebardi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(477, 61, 'Gopalpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(478, 61, 'Basail ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(479, 61, 'Bhuapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(480, 61, 'Delduar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(481, 61, 'Ghatail ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(482, 61, 'Kalihati ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(483, 61, 'Madhupur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(484, 61, 'Mirzapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(485, 61, 'Nagarpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(486, 61, 'Sakhipur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(487, 61, 'Dhanbari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(488, 61, 'Tangail Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(489, 56, 'Narsingdi Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(490, 56, 'Belabo ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(491, 56, 'Monohardi ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(492, 56, 'Palash ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(493, 56, 'Raipura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(494, 56, 'Shibpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(495, 62, 'Bagerhat Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(496, 62, 'Chitalmari ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(497, 62, 'Fakirhat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(498, 62, 'Kachua ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(499, 62, 'Mollahat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(500, 62, 'Mongla ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(501, 62, 'Morrelganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(502, 62, 'Rampal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(503, 62, 'Sarankhola ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(504, 63, 'Alamdanga ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(505, 63, 'Chuadanga Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(506, 63, 'Damurhuda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(507, 63, 'Jibannagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(508, 64, 'Abhaynagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(509, 64, 'Bagherpara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(510, 64, 'Chaugachha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(511, 64, 'Jhikargachha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(512, 64, 'Keshabpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(513, 64, 'Jessore Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(514, 64, 'Manirampur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(515, 64, 'Sharsha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(516, 65, 'Harinakunda ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(517, 65, 'Jhenaidah Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(518, 65, 'Kaliganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(519, 65, 'Kotchandpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(520, 65, 'Maheshpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(521, 65, 'Shailkupa ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(522, 66, 'Batiaghata ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(523, 66, 'Dacope ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(524, 66, 'Dumuria ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(525, 66, 'Dighalia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(526, 66, 'Koyra ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(527, 66, 'Paikgachha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(528, 66, 'Phultala ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(529, 66, 'Rupsha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(530, 66, 'Terokhada ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(531, 66, 'Daulatpur Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(532, 66, 'Khalishpur Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(533, 66, 'Khan Jahan Ali Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(534, 66, 'Kotwali Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(535, 66, 'Sonadanga Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(536, 66, 'Harintana Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(537, 67, 'Bheramara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(538, 67, 'Daulatpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(539, 67, 'Khoksa ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(540, 67, 'Kumarkhali ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(541, 67, 'Kushtia Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(542, 67, 'Mirpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(543, 67, 'Shekhpara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(544, 68, 'Magura Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(545, 68, 'Mohammadpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(546, 68, 'Shalikha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(547, 68, 'Sreepur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(548, 69, 'Gangni ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(549, 69, 'Meherpur Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(550, 69, 'Mujibnagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(551, 70, 'Kalia ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(552, 70, 'Lohagara ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(553, 70, 'Narail Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(554, 70, 'Naragati Thana', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(555, 71, 'Assasuni ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(556, 71, 'Debhata ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(557, 71, 'Kalaroa ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(558, 71, 'Kaliganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(559, 71, 'Satkhira Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(560, 71, 'Shyamnagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(561, 71, 'Tala ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(562, 88, 'Ajmiriganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(563, 88, 'Bahubal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(564, 88, 'Baniyachong ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(565, 88, 'Chunarughat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(566, 88, 'Habiganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(567, 88, 'Lakhai ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(568, 88, 'Madhabpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(569, 88, 'Nabiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(570, 89, 'Barlekha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(571, 89, 'Kamalganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(572, 89, 'Kulaura ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(573, 89, 'Moulvibazar Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(574, 89, 'Rajnagar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(575, 89, 'Sreemangal ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(576, 89, 'Juri ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(577, 90, 'Bishwamvarpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(578, 90, 'Chhatak ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(579, 90, 'Derai ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(580, 90, 'Dharampasha ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(581, 90, 'Dowarabazar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(582, 90, 'Jagannathpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(583, 90, 'Jamalganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(584, 90, 'Sullah ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(585, 90, 'Sunamganj Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(586, 90, 'Tahirpur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(587, 90, 'South Sunamganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(588, 91, 'Balaganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(589, 91, 'Beanibazar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(590, 91, 'Bishwanath ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(591, 91, 'Companigonj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(592, 91, 'Fenchuganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(593, 91, 'Golapganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(594, 91, 'Gowainghat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(595, 91, 'Jaintiapur ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(596, 91, 'Kanaighat ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(597, 91, 'Sylhet Sadar ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(598, 91, 'Zakiganj ', 120, 0, 1, NULL, '2023-08-14 07:55:43'),
(599, 91, 'South Shurma ', 120, 0, 1, NULL, '2023-08-14 07:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL DEFAULT 'header',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Header Menu', 'header', 1, '2024-06-23 04:28:30', '2024-06-23 04:28:30'),
(2, 'Sidebar Menu', 'sidebar', 1, '2024-06-23 05:32:14', '2024-06-23 05:32:14'),
(3, 'Information', 'footer', 1, '2024-06-23 11:57:52', '2024-06-23 11:57:52'),
(4, 'Support and services', 'footer', 1, '2024-06-23 11:58:17', '2024-06-23 11:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_page` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `category_id`, `page_id`, `custom_page`, `order`, `status`, `created_at`, `updated_at`) VALUES
(123, 2, NULL, 43, NULL, NULL, 9, 1, '2024-07-07 12:22:14', '2024-07-07 12:22:14'),
(124, 2, NULL, 44, NULL, NULL, 10, 1, '2024-07-07 12:22:14', '2024-07-07 12:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_26_070249_create_permission_tables', 1),
(6, '2023_04_29_104538_create_admin_menus_table', 1),
(7, '2023_04_30_095422_create_jobs_table', 1),
(8, '2023_06_04_103415_create_admin_menu_actions_table', 1),
(9, '2023_07_16_193339_create_settings_table', 1),
(11, '2023_08_05_220022_create_menus_table', 1),
(12, '2023_08_05_220028_create_menu_items_table', 1),
(13, '2023_08_08_095304_create_admin_settings_table', 1),
(14, '2023_08_09_115019_create_categories_table', 1),
(15, '2023_08_09_161545_create_products_table', 1),
(16, '2023_08_09_163637_create_brands_table', 1),
(17, '2023_08_09_175745_create_product_prices_table', 1),
(20, '2023_08_23_083356_create_portfolios_table', 1),
(21, '2023_08_30_114536_create_home_product_sections_table', 1),
(22, '2023_09_02_152658_create_attributes_table', 1),
(23, '2023_09_02_153152_create_attribute_values_table', 1),
(25, '2023_09_06_182742_create_shipping_addresses_table', 1),
(26, '2023_09_09_111028_create_locations_table', 1),
(27, '2023_09_09_183847_create_wishlists_table', 1),
(28, '2023_09_12_122146_create_flashdeals_table', 1),
(30, '2023_09_13_175745_create_reviews_table', 1),
(31, '2023_09_19_135706_create_companies_table', 1),
(32, '2023_09_19_141057_create_branches_table', 1),
(33, '2023_09_19_141630_create_stores_table', 1),
(34, '2023_09_20_105200_create_sliders_table', 1),
(35, '2023_09_23_101053_create_staff_table', 1),
(36, '2023_09_23_111539_create_regions_table', 1),
(37, '2023_09_23_123145_create_areas_table', 1),
(38, '2023_09_23_131123_create_territories_table', 1),
(39, '2023_09_23_181613_create_client_categories_table', 1),
(40, '2023_09_25_100436_create_chain_clients_table', 1),
(41, '2023_09_25_103202_create_vendors_table', 1),
(42, '2023_09_25_122043_create_category_vendors_table', 1),
(43, '2023_09_25_133234_create_groups_table', 1),
(44, '2023_09_25_133955_create_group_members_table', 1),
(45, '2023_09_25_155205_create_clients_table', 1),
(48, '2023_09_28_123659_create_vehicles_table', 1),
(53, '2023_10_03_165212_create_static_site_items_table', 1),
(54, '2023_10_03_172718_create_special_food_items_table', 1),
(55, '2023_10_03_182643_create_details_cards_table', 1),
(56, '2023_10_03_213106_create_showcase_items_table', 1),
(57, '2023_10_03_222638_create_client_messages_table', 1),
(58, '2023_10_03_224230_create_contacts_table', 1),
(59, '2023_10_04_081821_create_testimonials_table', 1),
(60, '2023_10_04_085027_create_abouts_table', 1),
(61, '2023_10_04_093333_create_social_works_table', 1),
(101, '2023_09_05_104150_create_product_stocks_table', 22),
(102, '2023_09_12_122242_create_flashdeal_products_table', 23),
(103, '2023_09_25_203513_create_group_sales_targets_table', 24),
(104, '2023_09_25_203644_create_group_sales_target_categories_table', 25),
(105, '2023_09_29_213551_create_client_prices_table', 26),
(106, '2023_09_30_152737_create_liftings_table', 27),
(107, '2023_09_30_152744_create_lifting_products_table', 28),
(108, '2023_09_30_162737_create_lifting_documents_table', 29),
(109, '2023_10_11_125908_create_sales_table', 30),
(110, '2023_10_11_125939_create_sales_lists_table', 31),
(111, '2023_10_12_175550_create_sales_product_data_table', 32),
(112, '2023_10_11_130353_create_collections_table', 33),
(113, '2023_10_15_090533_create_collection_data_table', 34),
(114, '2023_10_15_125909_create_sales_returns_table', 35),
(115, '2023_10_15_131506_create_sales_return_lists_table', 36),
(116, '2023_10_16_103106_create_lifting_returns_table', 37),
(117, '2023_10_16_103114_create_lifting_return_lists_table', 38),
(118, '2023_10_16_144752_create_vendor_payments_table', 39),
(119, '2023_10_16_145441_create_vendor_payment_data_table', 40),
(120, '2023_10_17_213643_create_deliveries_table', 41),
(121, '2023_10_17_213739_create_delivery_lists_table', 42),
(124, '2023_10_18_102801_create_transfers_table', 45),
(125, '2023_10_18_102810_create_transfer_products_table', 46),
(126, '2023_10_31_182322_create_transfer_data_table', 47),
(127, '2023_08_10_115126_create_orders_table', 48),
(128, '2023_08_10_115133_create_order_products_table', 49),
(129, '2023_11_01_182317_create_order_data_table', 50),
(130, '2023_08_02_000217_create_pages_table', 51),
(131, '2023_10_11_126050_create_sales_product_data_table', 52),
(132, '2024_04_16_222142_create_sizes_table', 53),
(133, '2024_04_16_222147_create_colors_table', 54),
(134, '2024_04_16_222206_create_product_sizes_table', 55),
(135, '2024_04_16_222214_create_product_colors_table', 56),
(136, '2023_11_15_110009_create_access_logs_table', 57),
(137, '2023_11_18_093933_create_delivery_charges_table', 57),
(138, '2023_11_18_181012_create_online_deliveries_table', 57),
(139, '2023_11_18_181300_create_online_delivery_lists_table', 57),
(140, '2023_11_21_101830_create_bulk_collections_table', 57),
(141, '2023_11_21_102651_create_bulk_collection_lists_table', 57),
(142, '2023_12_07_101641_create_coa_setups_table', 57),
(143, '2023_12_10_095150_create_account_transaction_autos_table', 57),
(144, '2023_12_10_095155_create_account_transactions_table', 57),
(145, '2024_01_17_171931_create_subscriptions_table', 57),
(146, '2024_05_01_125604_create_product_skus_table', 58),
(147, '2024_06_22_193709_create_menus_table', 59),
(148, '2024_06_22_193715_create_menu_items_table', 59),
(149, '2024_06_23_182216_create_home_sections_table', 60),
(150, '2024_06_23_182258_create_home_section_sub_categories_table', 60),
(151, '2024_07_11_113556_create_investors_table', 61),
(152, '2024_07_11_113626_create_investor_products_table', 61),
(154, '2024_07_17_181743_create_investor_payments_table', 62),
(159, '2024_07_20_104132_create_invests_table', 63),
(161, '2024_07_20_124050_create_wallets_table', 64),
(167, '2024_07_24_110633_create_investor_sattlements_table', 66),
(168, '2024_07_24_110638_create_investor_sattlement_lists_table', 66),
(169, '2024_07_22_144650_create_investor_profits_table', 67),
(170, '2024_07_23_090935_create_investor_profit_lists_table', 68),
(171, '2023_09_19_241630_create_store_areas_table', 69),
(172, '2024_09_23_130339_create_delivery_men_table', 70),
(175, '2024_09_23_170039_create_assign_orders_table', 71),
(176, '2024_09_23_170043_create_assign_order_lists_table', 71),
(177, '2023_08_09_161546_create_product_vendors_table', 72),
(178, '2024_09_22_145154_create_investors_table', 73),
(179, '2024_09_22_145251_create_invests_table', 73),
(180, '2024_09_22_162233_create_wallets_table', 74),
(181, '2024_09_22_175429_create_investor_profits_table', 74),
(182, '2024_09_22_175614_create_investor_profit_lists_table', 74),
(183, '2024_09_23_095148_create_investor_payments_table', 74),
(204, '2024_09_12_101532_create_retail_sales_table', 75),
(205, '2024_09_12_101640_create_retail_sale_lists_table', 75),
(206, '2024_11_02_183756_create_pre_order_setups_table', 75),
(207, '2024_11_02_184221_create_pre_order_sections_table', 75),
(208, '2025_05_12_160258_create_retail_returns_table', 75),
(209, '2025_05_12_160311_create_retail_return_lists_table', 75),
(210, '2025_07_12_170859_create_lifting_return_payments_table', 76),
(211, '2025_11_30_122204_create_stocks_table', 77);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 75),
(1, 'App\\Models\\User', 157),
(4, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 67),
(8, 'App\\Models\\User', 68),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 26),
(11, 'App\\Models\\User', 41),
(11, 'App\\Models\\User', 42),
(11, 'App\\Models\\User', 43),
(11, 'App\\Models\\User', 44),
(11, 'App\\Models\\User', 45),
(11, 'App\\Models\\User', 46),
(11, 'App\\Models\\User', 47),
(11, 'App\\Models\\User', 48),
(11, 'App\\Models\\User', 49),
(11, 'App\\Models\\User', 50),
(11, 'App\\Models\\User', 51),
(11, 'App\\Models\\User', 52),
(11, 'App\\Models\\User', 53),
(11, 'App\\Models\\User', 54),
(11, 'App\\Models\\User', 55),
(11, 'App\\Models\\User', 56),
(11, 'App\\Models\\User', 57),
(11, 'App\\Models\\User', 58),
(11, 'App\\Models\\User', 59),
(11, 'App\\Models\\User', 60),
(11, 'App\\Models\\User', 61),
(11, 'App\\Models\\User', 62),
(11, 'App\\Models\\User', 63),
(11, 'App\\Models\\User', 64),
(11, 'App\\Models\\User', 65),
(11, 'App\\Models\\User', 66),
(11, 'App\\Models\\User', 69),
(11, 'App\\Models\\User', 70),
(11, 'App\\Models\\User', 71),
(11, 'App\\Models\\User', 72),
(11, 'App\\Models\\User', 76),
(11, 'App\\Models\\User', 77),
(11, 'App\\Models\\User', 78),
(11, 'App\\Models\\User', 79),
(11, 'App\\Models\\User', 147),
(11, 'App\\Models\\User', 170),
(11, 'App\\Models\\User', 182),
(12, 'App\\Models\\User', 128),
(12, 'App\\Models\\User', 129),
(12, 'App\\Models\\User', 131),
(12, 'App\\Models\\User', 133),
(12, 'App\\Models\\User', 134),
(12, 'App\\Models\\User', 135),
(12, 'App\\Models\\User', 136),
(12, 'App\\Models\\User', 137),
(12, 'App\\Models\\User', 149),
(12, 'App\\Models\\User', 150),
(12, 'App\\Models\\User', 151),
(12, 'App\\Models\\User', 154),
(13, 'App\\Models\\User', 139),
(13, 'App\\Models\\User', 140),
(13, 'App\\Models\\User', 141),
(13, 'App\\Models\\User', 153),
(13, 'App\\Models\\User', 156),
(13, 'App\\Models\\User', 175),
(14, 'App\\Models\\User', 142),
(14, 'App\\Models\\User', 172),
(15, 'App\\Models\\User', 143),
(15, 'App\\Models\\User', 152),
(15, 'App\\Models\\User', 159),
(15, 'App\\Models\\User', 161),
(16, 'App\\Models\\User', 145),
(16, 'App\\Models\\User', 146),
(16, 'App\\Models\\User', 177),
(17, 'App\\Models\\User', 2),
(17, 'App\\Models\\User', 176),
(18, 'App\\Models\\User', 160),
(18, 'App\\Models\\User', 171),
(19, 'App\\Models\\User', 174),
(20, 'App\\Models\\User', 173),
(21, 'App\\Models\\User', 180),
(22, 'App\\Models\\User', 179),
(23, 'App\\Models\\User', 178),
(24, 'App\\Models\\User', 181),
(25, 'App\\Models\\User', 186),
(26, 'App\\Models\\User', 187);

-- --------------------------------------------------------

--
-- Table structure for table `online_deliveries`
--

CREATE TABLE `online_deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_man_id` bigint(20) UNSIGNED NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_delivery_lists`
--

CREATE TABLE `online_delivery_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `online_delivery_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `discount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_code` varchar(255) NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `potential_delivery_date` date DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `shipping_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_charge` decimal(16,0) DEFAULT NULL,
  `sub_total` decimal(16,0) NOT NULL,
  `discount` decimal(16,0) NOT NULL DEFAULT 0,
  `total` decimal(16,0) NOT NULL,
  `paid` decimal(16,0) NOT NULL,
  `due` decimal(16,0) NOT NULL DEFAULT 0,
  `receive` decimal(16,0) DEFAULT NULL,
  `total_return` decimal(16,0) NOT NULL DEFAULT 0,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_man_id` bigint(20) UNSIGNED DEFAULT NULL,
  `collected` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `courier_assigned` tinyint(1) NOT NULL DEFAULT 0,
  `order_type` varchar(255) NOT NULL DEFAULT 'offline',
  `pre_order` tinyint(1) NOT NULL DEFAULT 0,
  `pending_at` timestamp NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `processing_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `collected_at` date DEFAULT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `return_at` timestamp NULL DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `cancel_approve` tinyint(4) NOT NULL DEFAULT 0,
  `gate_pass` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `company_id`, `client_id`, `customer_id`, `order_code`, `store_id`, `invoice`, `date`, `potential_delivery_date`, `user_name`, `user_phone`, `shipping_address_id`, `shipping_address`, `area_id`, `shipping_charge`, `sub_total`, `discount`, `total`, `paid`, `due`, `receive`, `total_return`, `payment_method`, `coupon_id`, `delivery_man_id`, `collected`, `status`, `courier_assigned`, `order_type`, `pre_order`, `pending_at`, `confirmed_at`, `processing_at`, `delivered_at`, `collected_at`, `canceled_at`, `return_at`, `order_note`, `cancel_approve`, `gate_pass`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 163, 'R962168', NULL, 'STOS2025060001', '2025-06-03', '2025-06-03', 'hiui', '01757839516', 1, 'Kechuatoil, Kharkhari, Dhamrai , Dhaka, Dhaka', NULL, 80, 640, 0, 720, 0, 720, NULL, 0, 'bkash Payment', NULL, NULL, 0, 'Pending', 0, 'online', 0, '2025-06-03 10:04:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2025-06-03 10:04:52', '2025-06-03 10:04:52'),
(2, 1, NULL, 164, 'R547531', NULL, 'STOS2025090001', '2025-09-02', '2025-09-02', 'Topsy Roy Rakhi', '01551815359', 2, '23 No. Larmini Street, Flat- F2, Navana Celestial, Wari, Dhaka-1203, Dhaka City Corporation Area, Dhaka, Dhaka', NULL, 80, 385, 5, 465, 0, 460, NULL, 0, 'Cash on Delivery', NULL, NULL, 0, 'Pending', 0, 'online', 0, '2025-09-02 12:39:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2025-09-02 12:39:29', '2025-09-02 12:39:29'),
(3, 1, NULL, 166, 'R426274', NULL, 'STOS2026010001', '2026-01-16', '2026-01-16', 'Afsana Begum', '01819083337', 3, 'Apartment A5,House 345, road 12 block D, Bashundhara r/a, Dhaka City Corporation Area, Dhaka, Dhaka', NULL, 80, 625, 0, 705, 0, 705, NULL, 0, 'Cash on Delivery', NULL, NULL, 0, 'Pending', 0, 'online', 0, '2026-01-16 13:27:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2026-01-16 13:27:05', '2026-01-16 13:27:05'),
(4, 1, NULL, 167, 'R783703', NULL, 'STOS2026010002', '2026-01-22', '2026-01-22', 'Shawon islam', '01989098064', 4, 'Chandra baroipara, club math, Kaliakair , Gazipur, Dhaka', NULL, 80, 100, 0, 180, 0, 180, NULL, 0, 'Cash on Delivery', NULL, NULL, 0, 'Pending', 0, 'online', 0, '2026-01-22 16:50:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2026-01-22 16:50:50', '2026-01-22 16:50:50'),
(5, 1, NULL, 168, 'R984002', NULL, 'STOS2026020001', '2026-02-22', '2026-02-22', 'Fahad Ahmed', '01300016724', 5, 'Inside Rahattarpul, 18 Number ward, East Bakalia Depoti Road Majer Rasta Chattogram, Chandgaon Thana, Chittagong, Chittagong', NULL, 80, 615, 5, 695, 0, 690, NULL, 0, 'Cash on Delivery', NULL, NULL, 0, 'Pending', 0, 'online', 0, '2026-02-21 21:25:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(6, 1, NULL, 169, 'R548436', NULL, 'STOS2026040001', '2026-04-04', '2026-04-04', 'Abdullah Mahin', '01634191548', 6, 'Tower madrasa Paler bazar daudkandi Cumilla, Daudkandi , Comilla, Chittagong', NULL, 80, 140, 0, 220, 0, 220, NULL, 0, 'Cash on Delivery', NULL, NULL, 0, 'Pending', 0, 'online', 0, '2026-04-04 06:48:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2026-04-04 06:48:00', '2026-04-04 06:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `choose_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(16,2) DEFAULT 0.00,
  `subtotal` decimal(16,2) NOT NULL DEFAULT 0.00,
  `return_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `quantity` decimal(16,2) NOT NULL,
  `delivered` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `variant_id`, `choose_options`, `sku`, `discount`, `sale_price`, `subtotal`, `return_amount`, `quantity`, `delivered`, `created_at`, `updated_at`) VALUES
(1, 1, 191, NULL, '[]', NULL, 0.00, 320.00, 640.00, 0.00, 2.00, 0, '2025-06-03 10:04:52', '2025-06-03 10:04:52'),
(2, 2, 2503, NULL, '[]', NULL, 0.00, 10.00, 200.00, 0.00, 20.00, 0, '2025-09-02 12:39:29', '2025-09-02 12:39:29'),
(3, 2, 1740, NULL, '[]', NULL, 5.00, 185.00, 180.00, 0.00, 1.00, 0, '2025-09-02 12:39:29', '2025-09-02 12:39:29'),
(4, 3, 3342, NULL, '[]', NULL, 0.00, 125.00, 625.00, 0.00, 5.00, 0, '2026-01-16 13:27:05', '2026-01-16 13:27:05'),
(5, 4, 2397, NULL, '[]', NULL, 0.00, 20.00, 100.00, 0.00, 5.00, 0, '2026-01-22 16:50:50', '2026-01-22 16:50:50'),
(6, 5, 2397, NULL, '[]', NULL, 0.00, 20.00, 360.00, 0.00, 18.00, 0, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(7, 5, 2565, NULL, '[]', NULL, 0.00, 20.00, 80.00, 0.00, 4.00, 0, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(8, 5, 1454, NULL, '[]', NULL, 5.00, 65.00, 60.00, 0.00, 1.00, 0, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(9, 5, 3272, NULL, '[]', NULL, 0.00, 110.00, 110.00, 0.00, 1.00, 0, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(10, 6, 3772, NULL, '[]', NULL, 0.00, 70.00, 140.00, 0.00, 2.00, 0, '2026-04-04 06:48:00', '2026-04-04 06:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `sub_title`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Terms & Conditions', 'TERMS & CONDITIONS', 'terms-conditions', '<p>BRB Cable Industries Ltd. a private Limited Company was established with a view to manufacture Wires &amp; Cables in 1978. After successful incorporation, BRB starts its commercial production in 1980. During the year 2000 BRB launched its PVC Cables Plant for producing up to 33KV Cables along with XLPE insulated HT Cables, FRLS Cables and Aluminum Conductors up to 132KV. Moreover, Super Enameled Copper Wire Plant &amp; Instrumentation Cables were launched during this time. At this age BRB introduces C.C.V Plant (Catenary Continuous Vulcanization) for the first time in Bangladesh<br></p>', 1, '2023-11-27 15:00:21', '2024-05-13 06:28:16'),
(2, 'Privacy Policy', 'Privacy Policy', 'privacy-policy', '<p style=\"outline: 0px; padding: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px;\">Nijer Bazar<br></p>', 1, '2023-11-27 15:11:23', '2024-10-12 11:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'web', '2023-09-19 09:04:28', '2023-09-19 09:04:28'),
(2, 'System Setting', 'web', '2023-09-19 09:05:17', '2023-09-19 09:05:17'),
(3, 'Company Setup', 'web', '2023-09-19 09:05:30', '2023-09-19 09:05:30'),
(4, 'Branch Setup', 'web', '2023-09-19 09:05:39', '2023-09-19 09:05:39'),
(5, 'Role Setup', 'web', '2023-09-19 09:05:48', '2023-09-19 09:05:48'),
(6, 'User Setup', 'web', '2023-09-19 09:05:54', '2023-09-19 09:05:54'),
(7, 'Menu Setup', 'web', '2023-09-19 09:06:24', '2023-09-19 09:06:24'),
(8, 'admin.admin-menu.create', 'web', '2023-09-19 09:16:56', '2023-09-19 09:16:56'),
(9, 'admin.admin-menu.store', 'web', '2023-09-19 09:17:06', '2023-09-19 09:17:06'),
(10, 'admin.admin-menu.edit', 'web', '2023-09-19 09:17:10', '2023-09-19 09:17:10'),
(11, 'admin.admin-menu.update', 'web', '2023-09-19 09:17:20', '2023-09-19 09:17:20'),
(12, 'admin.admin-menu.destroy', 'web', '2023-09-19 09:17:25', '2023-09-19 09:17:25'),
(14, 'admin.admin-menuAction.index', 'web', '2023-09-19 09:18:18', '2023-09-19 09:18:18'),
(15, 'admin.admin-menuAction.create', 'web', '2023-09-19 09:18:26', '2023-09-19 09:18:26'),
(16, 'admin.admin-menuAction.store', 'web', '2023-09-19 09:18:33', '2023-09-19 09:18:33'),
(17, 'admin.admin-menuAction.edit', 'web', '2023-09-19 09:18:41', '2023-09-19 09:18:41'),
(18, 'admin.admin-menuAction.update', 'web', '2023-09-19 09:18:49', '2023-09-19 09:18:49'),
(19, 'admin.admin-menuAction.destroy', 'web', '2023-09-19 09:19:02', '2023-09-19 09:19:02'),
(20, 'Product Management', 'web', '2023-09-19 09:20:32', '2026-07-16 03:45:48'),
(21, 'Sales Group', 'web', '2023-09-19 09:20:46', '2023-09-23 14:50:24'),
(22, 'Store Setup', 'web', '2023-09-19 09:20:59', '2023-09-19 09:20:59'),
(23, 'admin.category.index', 'web', '2023-09-19 09:21:10', '2024-10-12 11:31:46'),
(24, 'Product Setup', 'web', '2023-09-19 09:21:19', '2023-09-19 09:21:19'),
(25, 'Staff Setup', 'web', '2023-09-19 09:21:25', '2023-09-19 09:21:25'),
(26, 'Product List', 'web', '2023-09-19 09:21:36', '2023-09-19 09:21:36'),
(27, 'System Configuration', 'web', '2023-09-19 09:22:02', '2023-09-19 09:22:02'),
(28, 'Group Sales Target', 'web', '2023-09-19 09:22:23', '2023-09-19 09:22:23'),
(29, 'Client Price Setup', 'web', '2023-09-19 09:22:33', '2023-09-19 09:22:33'),
(30, 'Purchase Management', 'web', '2023-09-19 09:23:13', '2026-07-16 03:47:03'),
(31, 'Transaction', 'web', '2023-09-19 09:23:22', '2023-09-19 09:23:22'),
(32, 'Vendor Setup', 'web', '2023-09-19 09:23:31', '2023-09-19 09:23:31'),
(33, 'admin.lifting.index', 'web', '2023-09-19 09:23:43', '2024-07-31 03:24:18'),
(35, 'Vendor Payment', 'web', '2023-09-19 09:24:05', '2023-09-19 09:24:05'),
(36, 'Reports', 'web', '2023-09-19 09:24:13', '2023-09-19 09:24:13'),
(37, 'admin.lifting-history.index', 'web', '2023-09-19 09:24:28', '2024-07-31 03:25:52'),
(39, 'admin.vendor-payment-history.index', 'web', '2023-09-19 09:24:54', '2024-07-31 03:27:00'),
(40, 'Vendor Statement', 'web', '2023-09-19 09:25:06', '2023-09-19 09:25:06'),
(41, 'Inventory Management', 'web', '2023-09-19 09:25:29', '2026-07-16 04:04:54'),
(46, 'Closing Stock', 'web', '2023-09-19 09:26:33', '2023-09-19 09:26:33'),
(47, 'Stock Status', 'web', '2023-09-19 09:26:45', '2023-09-19 09:26:45'),
(49, 'Sales Management', 'web', '2023-09-19 09:28:03', '2023-09-19 09:28:03'),
(50, 'Transaction 3', 'web', '2023-09-19 09:28:16', '2023-09-19 09:28:16'),
(51, 'Region Setup', 'web', '2023-09-19 09:28:49', '2023-09-19 09:28:49'),
(52, 'Area Setup', 'web', '2023-09-19 09:29:03', '2023-09-19 09:29:03'),
(53, 'admin.territory.index', 'web', '2023-09-19 09:29:15', '2026-07-18 09:31:40'),
(54, 'Client Setup', 'web', '2023-09-19 09:29:28', '2023-09-19 09:29:28'),
(55, 'admin.sales.index', 'web', '2023-09-19 09:29:42', '2025-04-13 12:09:37'),
(56, 'admin.collection.index', 'web', '2023-09-19 09:29:54', '2025-04-13 12:10:05'),
(57, 'Bulk Collection', 'web', '2023-09-19 09:30:07', '2023-09-19 09:30:07'),
(58, 'Sales Return', 'web', '2023-09-19 09:30:21', '2023-09-19 09:30:21'),
(59, 'Return Approval', 'web', '2023-09-19 09:30:32', '2023-09-19 09:30:32'),
(60, 'Reports 3', 'web', '2023-09-19 09:30:42', '2023-09-19 09:30:42'),
(61, 'admin.sales-history.index', 'web', '2023-09-19 09:30:51', '2024-07-31 03:30:07'),
(62, 'admin.collection-history.index', 'web', '2023-09-19 09:31:08', '2024-07-31 03:30:14'),
(64, 'Client Statement', 'web', '2023-09-19 09:31:39', '2023-09-19 09:31:39'),
(65, 'Client List', 'web', '2023-09-19 09:31:52', '2023-09-19 09:31:52'),
(67, 'Payment Analysis', 'web', '2023-09-19 09:33:39', '2023-09-19 09:33:39'),
(68, 'Stock Valuation', 'web', '2023-09-19 09:33:47', '2023-09-19 09:33:47'),
(69, 'admin.sales-target-achivement.index', 'web', '2023-09-19 09:33:56', '2024-07-31 03:33:39'),
(70, 'Sales Contribution', 'web', '2023-09-19 09:34:06', '2023-09-19 09:34:06'),
(71, 'admin.sales-realization.index', 'web', '2023-09-19 09:34:14', '2024-07-31 03:34:16'),
(72, 'Sales Ageing Report', 'web', '2023-09-19 09:34:41', '2023-09-19 09:34:41'),
(73, 'Client Outstanding', 'web', '2023-09-19 09:34:53', '2023-10-29 17:09:15'),
(74, 'Product Profit', 'web', '2023-09-19 09:35:10', '2023-11-02 10:03:23'),
(76, 'Offline Order', 'web', '2023-09-19 09:36:18', '2023-09-23 10:00:01'),
(78, 'Prepare Gatepass', 'web', '2023-09-19 09:38:15', '2023-10-18 13:57:45'),
(80, 'Delivery Statement', 'web', '2023-09-19 09:38:34', '2023-10-18 13:58:25'),
(93, 'admin.territory.create', 'web', '2023-09-25 07:00:48', '2023-09-25 07:00:48'),
(94, 'admin.territory.store', 'web', '2023-09-25 07:00:54', '2023-09-25 07:00:54'),
(95, 'admin.territory.edit', 'web', '2023-09-25 07:00:58', '2023-09-25 07:00:58'),
(96, 'admin.territory.update', 'web', '2023-09-25 07:01:03', '2023-09-25 07:01:03'),
(97, 'admin.territory.destroy', 'web', '2023-09-25 07:01:09', '2023-09-25 07:01:09'),
(98, 'admin.area.create', 'web', '2023-09-25 07:01:36', '2023-09-25 07:01:36'),
(99, 'admin.area.store', 'web', '2023-09-25 07:01:43', '2023-09-25 07:01:43'),
(100, 'admin.area.edit', 'web', '2023-09-25 07:01:47', '2023-09-25 07:01:47'),
(101, 'admin.area.update', 'web', '2023-09-25 07:01:52', '2023-09-25 07:01:52'),
(102, 'admin.area.destroy', 'web', '2023-09-25 07:01:57', '2023-09-25 07:01:57'),
(103, 'admin.region.create', 'web', '2023-09-25 07:02:16', '2023-09-25 07:02:16'),
(104, 'admin.region.store', 'web', '2023-09-25 07:02:22', '2023-09-25 07:02:22'),
(105, 'admin.region.edit', 'web', '2023-09-25 07:02:26', '2023-09-25 07:02:26'),
(106, 'admin.region.update', 'web', '2023-09-25 07:02:33', '2023-09-25 07:02:33'),
(107, 'admin.region.destroy', 'web', '2023-09-25 07:02:39', '2023-09-25 07:02:39'),
(108, 'admin.vendor.create', 'web', '2023-09-25 07:03:08', '2023-09-25 07:03:08'),
(109, 'admin.vendor.store', 'web', '2023-09-25 07:03:14', '2023-09-25 07:03:14'),
(110, 'admin.vendor.edit', 'web', '2023-09-25 07:03:19', '2023-09-25 07:03:19'),
(111, 'admin.vendor.update', 'web', '2023-09-25 07:03:24', '2023-09-25 07:03:24'),
(112, 'admin.vendor.destroy', 'web', '2023-09-25 07:03:29', '2023-09-25 07:03:29'),
(113, 'admin.staff.create', 'web', '2023-09-25 07:03:49', '2023-09-25 07:03:49'),
(114, 'admin.staff.store', 'web', '2023-09-25 07:03:54', '2023-09-25 07:03:54'),
(115, 'admin.staff.edit', 'web', '2023-09-25 07:03:58', '2023-09-25 07:03:58'),
(116, 'admin.staff.update', 'web', '2023-09-25 07:04:04', '2023-09-25 07:04:04'),
(117, 'admin.staff.destroy', 'web', '2023-09-25 07:04:10', '2023-09-25 07:04:10'),
(118, 'admin.category.create', 'web', '2023-09-25 07:04:55', '2023-09-25 07:04:55'),
(119, 'admin.category.store', 'web', '2023-09-25 07:04:59', '2023-09-25 07:04:59'),
(120, 'admin.category.edit', 'web', '2023-09-25 07:05:03', '2023-09-25 07:05:03'),
(121, 'admin.category.update', 'web', '2023-09-25 07:05:10', '2023-09-25 07:05:10'),
(122, 'admin.category.destroy', 'web', '2023-09-25 07:05:15', '2023-09-25 07:05:15'),
(123, 'admin.store.create', 'web', '2023-09-25 07:05:43', '2023-09-25 07:05:43'),
(124, 'admin.store.store', 'web', '2023-09-25 07:05:51', '2023-09-25 07:05:51'),
(125, 'admin.store.edit', 'web', '2023-09-25 07:05:55', '2023-09-25 07:05:55'),
(126, 'admin.store.update', 'web', '2023-09-25 07:06:00', '2023-09-25 07:06:00'),
(127, 'admin.store.destroy', 'web', '2023-09-25 07:06:05', '2023-09-25 07:06:05'),
(128, 'admin.user.create', 'web', '2023-09-25 07:06:29', '2023-09-25 07:06:29'),
(129, 'admin.user.store', 'web', '2023-09-25 07:06:33', '2023-09-25 07:06:33'),
(130, 'admin.user.edit', 'web', '2023-09-25 07:06:37', '2023-09-25 07:06:37'),
(131, 'admin.user.update', 'web', '2023-09-25 07:06:42', '2023-09-25 07:06:42'),
(132, 'admin.user.destroy', 'web', '2023-09-25 07:06:47', '2023-09-25 07:06:47'),
(133, 'admin.role.create', 'web', '2023-09-25 07:07:07', '2023-09-25 07:07:07'),
(134, 'admin.role.store', 'web', '2023-09-25 07:07:12', '2023-09-25 07:07:12'),
(135, 'admin.role.edit', 'web', '2023-09-25 07:07:17', '2023-09-25 07:07:17'),
(136, 'admin.role.update', 'web', '2023-09-25 07:07:23', '2023-09-25 07:07:23'),
(137, 'admin.role.destroy', 'web', '2023-09-25 07:07:28', '2023-09-25 07:07:28'),
(138, 'admin.branch.create', 'web', '2023-09-25 07:07:44', '2023-09-25 07:07:44'),
(139, 'admin.branch.store', 'web', '2023-09-25 07:08:29', '2023-09-25 07:08:29'),
(140, 'admin.branch.edit', 'web', '2023-09-25 07:08:34', '2023-09-25 07:08:34'),
(141, 'admin.branch.update', 'web', '2023-09-25 07:08:39', '2023-09-25 07:08:39'),
(142, 'admin.branch.destroy', 'web', '2023-09-25 07:08:44', '2023-09-25 07:08:44'),
(143, 'admin.company.create', 'web', '2023-09-25 07:09:19', '2023-09-25 07:09:19'),
(144, 'admin.company.store', 'web', '2023-09-25 07:09:24', '2023-09-25 07:09:24'),
(145, 'admin.company.edit', 'web', '2023-09-25 07:09:31', '2023-09-25 07:09:31'),
(146, 'admin.company.update', 'web', '2023-09-25 07:09:36', '2023-09-25 07:09:36'),
(147, 'admin.company.destroy', 'web', '2023-09-25 07:09:41', '2023-09-25 07:09:41'),
(148, 'admin.group.create', 'web', '2023-09-25 07:51:05', '2023-09-25 07:51:05'),
(149, 'admin.group.store', 'web', '2023-09-25 07:51:10', '2023-09-25 07:51:10'),
(150, 'admin.group.edit', 'web', '2023-09-25 07:51:14', '2023-09-25 07:51:14'),
(151, 'admin.group.update', 'web', '2023-09-25 07:51:20', '2023-09-25 07:51:20'),
(152, 'admin.group.destroy', 'web', '2023-09-25 07:51:28', '2023-09-25 07:51:28'),
(153, 'admin.client.create', 'web', '2023-09-25 10:09:28', '2023-09-25 10:09:28'),
(154, 'admin.client.store', 'web', '2023-09-25 10:09:33', '2023-09-25 10:09:33'),
(155, 'admin.client.edit', 'web', '2023-09-25 10:09:38', '2023-09-25 10:09:38'),
(156, 'admin.client.update', 'web', '2023-09-25 10:09:42', '2023-09-25 10:09:42'),
(157, 'admin.client.destroy', 'web', '2023-09-25 10:09:49', '2023-09-25 10:09:49'),
(158, 'admin.product.create', 'web', '2023-09-25 14:14:40', '2023-09-25 14:14:40'),
(159, 'admin.product.store', 'web', '2023-09-25 14:14:46', '2023-09-25 14:14:46'),
(160, 'admin.product.edit', 'web', '2023-09-25 14:14:50', '2023-09-25 14:14:50'),
(161, 'admin.product.update', 'web', '2023-09-25 14:14:55', '2023-09-25 14:14:55'),
(162, 'admin.product.destroy', 'web', '2023-09-25 14:15:02', '2023-09-25 14:15:02'),
(163, 'admin.group-target.create', 'web', '2023-09-25 15:12:45', '2023-09-25 15:12:45'),
(164, 'admin.group-target.store', 'web', '2023-09-25 15:12:50', '2023-09-25 15:12:50'),
(165, 'admin.group-target.edit', 'web', '2023-09-25 15:12:55', '2023-09-25 15:12:55'),
(166, 'admin.group-target.update', 'web', '2023-09-25 15:13:02', '2023-09-25 15:13:02'),
(167, 'admin.group-target.destroy', 'web', '2023-09-25 15:13:32', '2023-09-25 15:13:32'),
(168, 'Vehicle Setup', 'web', '2023-09-28 06:35:35', '2023-09-28 06:35:35'),
(169, 'admin.vehicle.create', 'web', '2023-09-28 06:49:24', '2023-09-28 06:49:24'),
(170, 'admin.vehicle.store', 'web', '2023-09-28 06:49:29', '2023-09-28 06:49:29'),
(171, 'admin.vehicle.edit', 'web', '2023-09-28 06:49:33', '2023-09-28 06:49:33'),
(172, 'admin.vehicle.update', 'web', '2023-09-28 06:49:38', '2023-09-28 06:49:38'),
(173, 'admin.vehicle.destroy', 'web', '2023-09-28 06:49:44', '2023-09-28 06:49:44'),
(175, 'admin.lifting.create', 'web', '2023-09-30 11:29:14', '2023-09-30 11:29:14'),
(176, 'admin.lifting.store', 'web', '2023-09-30 11:29:19', '2023-09-30 11:29:19'),
(177, 'admin.lifting.edit', 'web', '2023-09-30 11:29:23', '2023-09-30 11:29:23'),
(178, 'admin.lifting.update', 'web', '2023-09-30 11:29:27', '2023-09-30 11:29:27'),
(179, 'admin.lifting.destroy', 'web', '2023-09-30 11:29:33', '2023-09-30 11:29:33'),
(180, 'Website Management', 'web', '2023-10-08 15:08:32', '2026-07-16 03:55:18'),
(181, 'Slider', 'web', '2023-10-08 15:09:27', '2023-10-08 15:14:11'),
(188, 'Client Message', 'web', '2023-10-08 15:25:53', '2023-10-08 15:25:53'),
(191, 'admin.slider.create', 'web', '2023-10-08 15:28:49', '2023-10-08 15:28:49'),
(192, 'admin.slider.store', 'web', '2023-10-08 15:28:54', '2023-10-08 15:28:54'),
(193, 'admin.slider.edit', 'web', '2023-10-08 15:28:59', '2023-10-08 15:28:59'),
(194, 'admin.slider.update', 'web', '2023-10-08 15:29:07', '2023-10-08 15:29:07'),
(195, 'admin.slider.destroy', 'web', '2023-10-08 15:29:15', '2023-10-08 15:29:15'),
(211, 'admin.client-message.create', 'web', '2023-10-08 15:34:31', '2023-10-08 15:34:31'),
(212, 'admin.client-message.store', 'web', '2023-10-08 15:34:36', '2023-10-08 15:34:36'),
(213, 'admin.client-message.edit', 'web', '2023-10-08 15:34:40', '2023-10-08 15:34:40'),
(214, 'admin.client-message.update', 'web', '2023-10-08 15:34:44', '2023-10-08 15:34:44'),
(215, 'admin.client-message.destroy', 'web', '2023-10-08 15:34:49', '2023-10-08 15:34:49'),
(226, 'Site Settings', 'web', '2023-10-08 15:50:45', '2023-10-08 15:50:45'),
(227, 'admin.offline-order.create', 'web', '2023-10-09 03:43:02', '2023-10-09 03:43:02'),
(228, 'admin.offline-order.store', 'web', '2023-10-09 03:43:07', '2023-10-09 03:43:07'),
(229, 'admin.offline-order.edit', 'web', '2023-10-09 03:43:11', '2023-10-09 03:43:11'),
(230, 'admin.offline-order.update', 'web', '2023-10-09 03:43:19', '2023-10-09 03:43:19'),
(231, 'admin.offline-order.destroy', 'web', '2023-10-09 03:43:25', '2023-10-09 03:43:25'),
(232, 'admin.offline-order.show', 'web', '2023-10-10 14:19:37', '2023-10-10 14:19:37'),
(233, 'admin.sales.create', 'web', '2023-10-11 08:10:17', '2023-10-11 08:10:17'),
(234, 'admin.sales.store', 'web', '2023-10-11 08:10:22', '2023-10-11 08:10:22'),
(235, 'admin.sales.edit', 'web', '2023-10-11 08:10:27', '2023-10-11 08:10:27'),
(236, 'admin.sales.update', 'web', '2023-10-11 08:10:32', '2023-10-11 08:10:32'),
(237, 'admin.sales.destroy', 'web', '2023-10-11 08:10:37', '2023-10-11 08:10:37'),
(238, 'admin.collection.create', 'web', '2023-10-14 16:50:47', '2023-10-14 16:50:47'),
(239, 'admin.collection.store', 'web', '2023-10-14 16:50:51', '2023-10-14 16:50:51'),
(240, 'admin.collection.edit', 'web', '2023-10-14 16:50:56', '2023-10-14 16:50:56'),
(241, 'admin.collection.update', 'web', '2023-10-14 16:51:00', '2023-10-14 16:51:00'),
(242, 'admin.collection.destroy', 'web', '2023-10-14 16:51:05', '2023-10-14 16:51:05'),
(243, 'admin.sales-return.create', 'web', '2023-10-15 06:43:17', '2023-10-15 06:43:17'),
(244, 'admin.sales-return.store', 'web', '2023-10-15 06:43:24', '2023-10-15 06:43:24'),
(245, 'admin.sales-return.edit', 'web', '2023-10-15 06:43:29', '2023-10-15 06:43:29'),
(246, 'admin.sales-return.update', 'web', '2023-10-15 06:43:34', '2023-10-15 06:43:34'),
(247, 'admin.sales-return.destroy', 'web', '2023-10-15 06:43:39', '2023-10-15 06:43:39'),
(253, 'admin.vendor-payment.create', 'web', '2023-10-16 09:19:38', '2023-10-16 09:19:38'),
(254, 'admin.vendor-payment.store', 'web', '2023-10-16 09:19:42', '2023-10-16 09:19:42'),
(255, 'admin.vendor-payment.edit', 'web', '2023-10-16 09:19:46', '2023-10-16 09:19:46'),
(256, 'admin.vendor-payment.update', 'web', '2023-10-16 09:19:51', '2023-10-16 09:19:51'),
(257, 'admin.vendor-payment.destroy', 'web', '2023-10-16 09:20:00', '2023-10-16 09:20:00'),
(266, 'admin.return-approve.show', 'web', '2023-10-18 12:04:48', '2023-10-18 12:04:48'),
(267, 'admin.return-approve.edit', 'web', '2023-10-18 12:05:03', '2023-10-18 12:05:03'),
(268, 'admin.return-approve.destroy', 'web', '2023-10-18 12:05:12', '2023-10-18 12:05:12'),
(269, 'admin.delivery.edit', 'web', '2023-11-07 06:58:42', '2023-11-07 06:58:42'),
(270, 'admin.delivery.store', 'web', '2023-11-07 07:01:19', '2023-11-07 07:01:19'),
(271, 'admin.delivery.update', 'web', '2023-11-07 07:01:31', '2023-11-07 07:01:31'),
(272, 'admin.delivery.destroy', 'web', '2023-11-07 07:01:37', '2023-11-07 07:01:37'),
(273, 'admin.delivery.create', 'web', '2023-11-07 08:01:58', '2023-11-07 08:01:58'),
(276, 'admin.rolePermission.edit', 'web', '2023-11-09 04:05:15', '2023-11-09 04:05:15'),
(277, 'admin.rolePermission.update', 'web', '2023-11-09 04:05:28', '2023-11-09 04:05:28'),
(286, 'admin.client-price.create', 'web', '2023-11-10 13:15:05', '2023-11-10 13:15:05'),
(287, 'admin.client-price.store', 'web', '2023-11-10 13:15:12', '2023-11-10 13:15:12'),
(288, 'admin.client-price.edit', 'web', '2023-11-10 13:15:40', '2023-11-10 13:15:40'),
(289, 'admin.client-price.update', 'web', '2023-11-10 13:15:44', '2023-11-10 13:15:44'),
(290, 'admin.client-price.destroy', 'web', '2023-11-10 13:15:50', '2023-11-10 13:15:50'),
(291, 'admin.online-order.index', 'web', '2023-11-16 11:58:49', '2024-09-10 10:35:40'),
(292, 'Client Request', 'web', '2023-11-16 12:00:00', '2023-11-16 12:00:00'),
(293, 'admin.online-order.edit', 'web', '2023-11-16 12:01:31', '2023-11-16 12:01:31'),
(294, 'admin.online-order.show', 'web', '2023-11-16 12:01:39', '2023-11-16 12:01:39'),
(295, 'Access Log', 'web', '2023-11-16 12:02:14', '2023-11-16 12:02:14'),
(296, 'Online Dashboard', 'web', '2023-11-19 17:02:39', '2023-11-20 12:07:30'),
(299, 'Cancelled Order', 'web', '2023-11-19 17:06:14', '2023-11-20 12:12:40'),
(300, 'admin.cancel-order.approve', 'web', '2023-11-19 17:06:43', '2023-11-19 17:06:43'),
(301, 'Delivery Gatepass', 'web', '2023-11-19 17:07:36', '2023-11-20 12:10:17'),
(302, 'admin.online-order-delivery.create', 'web', '2023-11-19 17:08:03', '2023-11-19 17:08:03'),
(303, 'admin.online-order-delivery.store', 'web', '2023-11-19 17:08:08', '2023-11-19 17:08:08'),
(304, 'admin.online-order-delivery.edit', 'web', '2023-11-19 17:08:12', '2023-11-19 17:08:12'),
(305, 'admin.online-order-delivery.update', 'web', '2023-11-19 17:08:22', '2023-11-19 17:08:22'),
(306, 'admin.online-order-delivery.destroy', 'web', '2023-11-19 17:08:29', '2023-11-19 17:08:29'),
(307, 'admin.online-order-delivery.show', 'web', '2023-11-19 17:09:04', '2023-11-19 17:09:04'),
(308, 'Delivery Charge', 'web', '2023-11-19 17:09:47', '2023-11-19 17:09:47'),
(309, 'admin.delivery-charge.update', 'web', '2023-11-19 17:10:16', '2023-11-19 17:10:16'),
(323, 'admin.bulk-collection.create', 'web', '2023-11-23 04:57:03', '2023-11-23 04:57:03'),
(324, 'admin.bulk-collection.store', 'web', '2023-11-23 04:57:09', '2023-11-23 04:57:09'),
(325, 'admin.bulk-collection.edit', 'web', '2023-11-23 04:57:14', '2023-11-23 04:57:14'),
(326, 'admin.bulk-collection.update', 'web', '2023-11-23 04:57:20', '2023-11-23 04:57:20'),
(327, 'admin.bulk-collection.destroy', 'web', '2023-11-23 04:57:29', '2023-11-23 04:57:29'),
(328, 'admin.user.password', 'web', '2023-11-26 05:57:38', '2023-11-26 05:57:38'),
(329, 'admin.user.password-update', 'web', '2023-11-26 05:58:21', '2023-11-26 05:58:21'),
(330, 'admin.salesman-flowchart.index', 'web', '2023-11-26 11:18:53', '2024-07-31 03:30:34'),
(331, 'Client Sales Flow', 'web', '2023-11-27 08:53:49', '2023-11-27 08:53:49'),
(332, 'Online Sales History', 'web', '2023-11-27 11:16:13', '2023-11-27 11:16:13'),
(333, 'Page Setup', 'web', '2023-11-27 14:58:52', '2023-11-27 14:58:52'),
(334, 'General Accounting', 'web', '2023-12-13 12:04:08', '2023-12-13 12:04:08'),
(335, 'Transaction 4', 'web', '2023-12-13 12:04:34', '2023-12-13 12:04:34'),
(336, 'Chart of Accounts', 'web', '2023-12-13 12:05:02', '2023-12-13 12:05:02'),
(337, 'admin.debit-voucher-entry.index', 'web', '2023-12-13 12:05:40', '2024-07-31 03:32:43'),
(338, 'admin.credit-voucher-entry.index', 'web', '2023-12-13 12:05:59', '2024-07-31 03:32:48'),
(339, 'admin.journal-voucher-entry.index', 'web', '2023-12-13 12:06:21', '2024-07-31 03:32:53'),
(340, 'Voucher Approve', 'web', '2023-12-13 12:06:45', '2023-12-13 12:06:45'),
(341, 'Voucher Refuse', 'web', '2023-12-13 12:07:04', '2023-12-13 12:07:04'),
(343, 'Automation Refuse', 'web', '2023-12-13 12:09:41', '2023-12-13 12:09:41'),
(344, 'admin.coa-setup.store', 'web', '2023-12-13 12:12:03', '2023-12-13 12:12:03'),
(345, 'admin.coa-setup.edit', 'web', '2023-12-13 12:12:10', '2023-12-13 12:12:10'),
(346, 'admin.coa-setup.update', 'web', '2023-12-13 12:12:17', '2023-12-13 12:12:17'),
(347, 'admin.coa-setup.destroy', 'web', '2023-12-13 12:12:25', '2023-12-13 12:12:25'),
(348, 'admin.debit-voucher-entry.create', 'web', '2023-12-13 12:13:07', '2023-12-13 12:13:07'),
(349, 'admin.debit-voucher-entry.store', 'web', '2023-12-13 12:13:16', '2023-12-13 12:13:16'),
(350, 'admin.debit-voucher-entry.edit', 'web', '2023-12-13 12:13:24', '2023-12-13 12:13:24'),
(351, 'admin.debit-voucher-entry.update', 'web', '2023-12-13 12:13:30', '2023-12-13 12:13:30'),
(352, 'admin.debit-voucher-entry.destroy', 'web', '2023-12-13 12:13:38', '2023-12-13 12:13:38'),
(353, 'admin.credit-voucher-entry.create', 'web', '2023-12-13 12:13:58', '2023-12-13 12:13:58'),
(354, 'admin.credit-voucher-entry.store', 'web', '2023-12-13 12:14:08', '2023-12-13 12:14:08'),
(355, 'admin.credit-voucher-entry.edit', 'web', '2023-12-13 12:14:14', '2023-12-13 12:14:14'),
(356, 'admin.credit-voucher-entry.update', 'web', '2023-12-13 12:14:21', '2023-12-13 12:14:21'),
(357, 'admin.credit-voucher-entry.destroy', 'web', '2023-12-13 12:14:27', '2023-12-13 12:14:27'),
(358, 'admin.journal-voucher-entry.create', 'web', '2023-12-13 12:14:55', '2023-12-13 12:14:55'),
(359, 'admin.journal-voucher-entry.store', 'web', '2023-12-13 12:15:01', '2023-12-13 12:15:01'),
(360, 'admin.journal-voucher-entry.edit', 'web', '2023-12-13 12:15:06', '2023-12-13 12:15:06'),
(361, 'admin.journal-voucher-entry.update', 'web', '2023-12-13 12:15:12', '2023-12-13 12:15:12'),
(362, 'admin.journal-voucher-entry.destroy', 'web', '2023-12-13 12:15:18', '2023-12-13 12:15:18'),
(363, 'admin.voucher-approve.show', 'web', '2023-12-13 12:16:48', '2023-12-13 12:16:48'),
(364, 'admin.voucher-approve.edit', 'web', '2023-12-13 12:16:56', '2023-12-13 12:16:56'),
(365, 'admin.voucher-reject.show', 'web', '2023-12-13 12:17:48', '2023-12-13 12:17:48'),
(366, 'admin.voucher-reject.edit', 'web', '2023-12-13 12:18:00', '2023-12-13 12:18:00'),
(369, 'admin.automation-reject.show', 'web', '2023-12-13 12:19:47', '2023-12-13 12:19:47'),
(370, 'admin.automation-reject.edit', 'web', '2023-12-13 12:19:54', '2023-12-13 12:20:22'),
(371, 'Reports 4', 'web', '2023-12-13 16:37:50', '2023-12-13 16:37:50'),
(372, 'Chart of Accounts 2', 'web', '2023-12-13 16:38:13', '2023-12-13 16:38:13'),
(373, 'Daily Voucher List', 'web', '2023-12-16 06:26:26', '2023-12-16 06:26:26'),
(374, 'Daily Cash Book', 'web', '2023-12-19 14:46:09', '2023-12-19 14:46:09'),
(375, 'Daily Bank Book', 'web', '2023-12-19 14:46:38', '2023-12-19 14:46:38'),
(376, 'Transaction Ledger', 'web', '2023-12-19 14:47:08', '2023-12-19 14:47:08'),
(377, 'Cash Flow Statement', 'web', '2023-12-19 14:47:26', '2023-12-19 14:47:26'),
(378, 'General Ledger', 'web', '2023-12-19 14:47:45', '2023-12-19 14:47:45'),
(379, 'Trial Balance', 'web', '2023-12-30 16:33:07', '2023-12-30 16:33:07'),
(380, 'Income Statement', 'web', '2023-12-30 16:37:10', '2023-12-30 16:37:10'),
(381, 'Subscribers', 'web', '2024-01-23 04:24:23', '2024-01-23 04:24:23'),
(382, 'Admin Settings', 'web', '2024-02-27 10:29:24', '2024-02-27 10:29:24'),
(383, 'Balance Sheet', 'web', '2024-02-28 15:09:20', '2024-02-28 15:09:20'),
(384, 'Clear cache', 'web', '2024-03-03 04:17:45', '2024-03-03 04:17:45'),
(392, 'admin.profit-loss.index', 'web', '2024-04-08 09:56:46', '2024-07-31 03:34:55'),
(393, 'Sizes', 'web', '2024-04-16 16:16:55', '2024-04-16 16:16:55'),
(394, 'Colors', 'web', '2024-04-16 16:17:26', '2024-04-16 16:17:26'),
(395, 'admin.size.create', 'web', '2024-04-16 16:44:38', '2024-04-16 16:44:38'),
(396, 'admin.size.store', 'web', '2024-04-16 16:44:43', '2024-04-16 16:44:43'),
(397, 'admin.size.edit', 'web', '2024-04-16 16:44:50', '2024-04-16 16:44:50'),
(398, 'admin.size.update', 'web', '2024-04-16 16:44:55', '2024-04-16 16:44:55'),
(399, 'admin.size.destroy', 'web', '2024-04-16 16:45:02', '2024-04-16 16:45:02'),
(400, 'admin.color.create', 'web', '2024-04-16 16:47:21', '2024-04-16 16:47:21'),
(401, 'admin.color.store', 'web', '2024-04-16 16:47:28', '2024-04-16 16:47:28'),
(402, 'admin.color.edit', 'web', '2024-04-16 16:47:32', '2024-04-16 16:47:32'),
(403, 'admin.color.update', 'web', '2024-04-16 16:47:38', '2024-04-16 16:47:38'),
(404, 'admin.color.destroy', 'web', '2024-04-16 16:47:45', '2024-04-16 16:47:45'),
(425, 'admin.sales.search-edit', 'web', '2024-06-05 06:15:09', '2024-06-05 06:15:09'),
(426, 'admin.delivery.delivered', 'web', '2024-06-06 13:22:34', '2024-06-06 13:22:34'),
(427, 'Menu Setup 2', 'web', '2024-06-23 04:18:38', '2024-06-23 04:18:38'),
(428, 'admin.menu.create', 'web', '2024-06-23 04:19:24', '2024-06-23 04:19:24'),
(429, 'admin.menu.store', 'web', '2024-06-23 04:19:31', '2024-06-23 04:19:31'),
(430, 'admin.menu.edit', 'web', '2024-06-23 04:19:36', '2024-06-23 04:19:36'),
(431, 'admin.menu.update', 'web', '2024-06-23 04:19:43', '2024-06-23 04:19:43'),
(432, 'admin.menu.destroy', 'web', '2024-06-23 04:19:51', '2024-06-23 04:19:51'),
(433, 'admin.menu-item.index', 'web', '2024-06-23 04:25:39', '2024-06-23 04:25:39'),
(434, 'admin.menu-item.update', 'web', '2024-06-23 04:25:47', '2024-06-23 04:25:47'),
(435, 'admin.menu-item.serialize', 'web', '2024-06-23 04:27:02', '2024-06-23 04:27:02'),
(436, 'admin.menu-item.destroy', 'web', '2024-06-23 04:27:40', '2024-06-23 04:27:40'),
(437, 'admin.product.attributes', 'web', '2024-06-23 11:11:49', '2024-06-23 11:11:49'),
(438, 'Homepage Section', 'web', '2024-06-23 12:14:58', '2024-06-23 12:14:58'),
(439, 'admin.sections.create', 'web', '2024-06-23 12:15:14', '2024-06-23 12:15:14'),
(440, 'admin.sections.store', 'web', '2024-06-23 12:15:18', '2024-06-23 12:15:18'),
(441, 'admin.sections.edit', 'web', '2024-06-23 12:15:22', '2024-06-23 12:15:22'),
(442, 'admin.sections.update', 'web', '2024-06-23 12:15:26', '2024-06-23 12:15:26'),
(443, 'admin.sections.destroy', 'web', '2024-06-23 12:15:31', '2024-06-23 12:15:31'),
(485, 'admin.approve-payment.index', 'web', '2024-07-23 17:56:48', '2024-07-30 09:06:53'),
(494, 'Transaction 6', 'web', '2024-07-29 02:20:43', '2024-07-29 02:20:43'),
(517, 'Reports 5', 'web', '2024-07-30 09:08:40', '2024-07-30 09:08:40'),
(529, 'admin.order.index', 'web', '2024-08-31 17:47:10', '2024-09-09 05:32:40'),
(530, 'admin.order.create', 'web', '2024-08-31 17:47:26', '2024-08-31 17:47:26'),
(531, 'admin.order.edit', 'web', '2024-08-31 17:47:29', '2024-08-31 17:47:29'),
(532, 'admin.order.destroy', 'web', '2024-08-31 17:47:34', '2024-08-31 17:47:34'),
(533, 'Order List Report', 'web', '2024-09-03 11:14:42', '2024-09-03 11:14:42'),
(534, 'Order Return', 'web', '2024-09-09 11:38:09', '2024-09-09 11:38:09'),
(535, 'admin.order-return.create', 'web', '2024-09-09 11:38:29', '2024-09-09 11:38:29'),
(536, 'admin.order-return.edit', 'web', '2024-09-09 11:38:35', '2024-09-09 11:38:35'),
(537, 'admin.order-return.destroy', 'web', '2024-09-09 11:38:40', '2024-09-09 11:38:40'),
(538, 'admin.required-product.index', 'web', '2024-09-10 13:39:43', '2024-09-11 04:31:38'),
(539, 'admin.areawise-orders.index', 'web', '2024-09-11 03:56:56', '2024-09-27 05:24:49'),
(540, 'admin.order-dashboard.edit', 'web', '2024-09-11 04:31:15', '2024-09-11 04:31:15'),
(541, 'admin.areawise-order.index', 'web', '2024-09-11 06:01:15', '2024-09-11 06:01:15'),
(542, 'admin.order-dashboard.update', 'web', '2024-09-11 10:31:37', '2024-09-11 10:31:37'),
(543, 'admin.product-wise-sales-summary.index', 'web', '2024-09-17 08:03:38', '2024-10-13 15:46:26'),
(544, 'admin.area-wise-sales-statement.index', 'web', '2024-09-17 08:04:03', '2024-10-13 15:40:56'),
(545, 'admin.monthly-statement.index', 'web', '2024-09-17 08:04:19', '2024-10-13 15:44:45'),
(550, 'admin.order-assign.index', 'web', '2024-09-23 13:09:08', '2024-10-06 11:10:45'),
(551, 'admin.order-assign.create', 'web', '2024-09-23 13:09:24', '2024-09-23 13:09:24'),
(552, 'admin.order-assign.edit', 'web', '2024-09-23 13:09:28', '2024-09-23 13:09:28'),
(553, 'admin.order-assign.destroy', 'web', '2024-09-23 13:09:33', '2024-09-23 13:09:33'),
(554, 'admin.store-wise-sales-statement.index', 'web', '2024-09-26 10:40:52', '2024-10-13 15:40:32'),
(555, 'Bulk Forward', 'web', '2024-09-26 11:01:05', '2024-09-26 11:01:05'),
(556, 'admin.on-route-orders.index', 'web', '2024-09-26 11:03:19', '2024-09-27 05:21:51'),
(557, 'admin.order-status.index', 'web', '2024-09-26 11:04:12', '2024-10-06 11:10:16'),
(558, 'Bulk Collection 2', 'web', '2024-09-26 11:04:59', '2024-09-26 11:04:59'),
(559, 'admin.storewise-orders.index', 'web', '2024-09-26 11:05:46', '2024-09-27 05:25:06'),
(561, 'admin.customer-list.index', 'web', '2024-10-09 11:22:34', '2024-10-13 15:43:22'),
(562, 'admin.monthly-summary-sheet.index', 'web', '2024-10-09 11:22:57', '2024-10-13 15:44:16'),
(563, 'admin.monthly-chart.index', 'web', '2024-10-09 14:45:28', '2024-10-13 15:42:39'),
(583, 'Courier Assign', 'web', '2024-10-24 09:47:20', '2024-10-24 09:47:20'),
(584, 'Receive Payment', 'web', '2024-10-31 15:07:01', '2024-10-31 15:07:01'),
(585, 'admin.receive-payment-head-details.index', 'web', '2024-10-31 15:07:18', '2024-10-31 15:07:18'),
(586, 'Pre Order Setup', 'web', '2024-11-05 06:23:49', '2024-11-05 06:23:49'),
(587, 'admin.pre-order.create', 'web', '2024-11-05 06:24:18', '2024-11-05 06:24:18'),
(588, 'admin.pre-order.edit', 'web', '2024-11-05 06:24:26', '2024-11-05 06:24:26'),
(589, 'admin.pre-order.destroy', 'web', '2024-11-05 06:24:34', '2024-11-05 06:24:34'),
(590, 'Daily Collection Report', 'web', '2024-11-16 12:05:24', '2024-11-16 12:05:24'),
(595, 'Out of Stock', 'web', '2025-04-20 13:08:59', '2025-04-20 13:08:59'),
(596, 'Running Sales Report', 'web', '2025-05-05 05:42:20', '2025-05-05 05:42:20'),
(597, 'Retail Return', 'web', '2025-05-13 08:44:34', '2025-05-13 08:44:34'),
(598, 'admin.retail-return.create', 'web', '2025-05-13 08:44:52', '2025-05-13 08:44:52'),
(599, 'admin.retail-return.edit', 'web', '2025-05-13 08:44:56', '2025-05-13 08:44:56'),
(600, 'admin.retail-return.destroy', 'web', '2025-05-13 08:45:01', '2025-05-13 08:45:01'),
(601, 'Customer', 'web', '2025-05-26 08:53:59', '2025-05-26 08:53:59'),
(602, 'Total Sale', 'web', '2025-05-26 08:54:05', '2025-05-26 08:54:05'),
(603, 'Cash In', 'web', '2025-05-26 08:54:10', '2025-05-26 08:54:10'),
(604, 'Due', 'web', '2025-05-26 08:54:16', '2025-05-26 08:54:16'),
(605, 'Total Products', 'web', '2025-05-26 08:54:21', '2025-05-26 08:54:21'),
(606, 'Stock Value', 'web', '2025-05-26 08:54:26', '2025-05-26 08:54:26'),
(607, 'Payment Due', 'web', '2025-05-26 08:54:31', '2025-05-26 08:54:31'),
(608, 'Outstanding', 'web', '2025-05-26 08:54:36', '2025-05-26 08:54:36'),
(609, 'admin.retail-return-report.index', 'web', '2025-05-28 09:38:20', '2025-05-28 09:38:30'),
(610, 'CRM', 'web', '2026-07-16 06:22:01', '2026-07-16 06:22:01'),
(611, 'HRM & Payroll', 'web', '2026-07-16 06:24:05', '2026-07-16 06:24:05'),
(612, 'Lead Management', 'web', '2026-07-16 06:28:12', '2026-07-16 06:28:12'),
(613, 'Employee Management', 'web', '2026-07-16 06:29:37', '2026-07-16 06:29:37'),
(614, 'Lead Source', 'web', '2026-07-16 06:31:41', '2026-07-16 06:31:41'),
(615, 'Lead Status', 'web', '2026-07-16 06:32:36', '2026-07-16 06:32:36'),
(616, 'Customer Management', 'web', '2026-07-16 06:33:05', '2026-07-16 06:33:05'),
(620, 'Meeting Schedule', 'web', '2026-07-16 06:35:58', '2026-07-16 06:35:58'),
(623, 'Quotation', 'web', '2026-07-16 06:37:09', '2026-07-16 06:37:09'),
(633, 'CRM Dashboard', 'web', '2026-07-16 06:41:34', '2026-07-16 06:41:34'),
(634, 'CRM Reports', 'web', '2026-07-16 06:41:56', '2026-07-16 06:41:56'),
(637, 'Employee Attendance', 'web', '2026-07-16 06:46:36', '2026-07-16 06:46:36'),
(638, 'Leave Management', 'web', '2026-07-16 06:47:06', '2026-07-16 06:47:06'),
(639, 'Leave Application', 'web', '2026-07-16 06:47:36', '2026-07-16 06:47:36'),
(640, 'admin.holiday.index', 'web', '2026-07-16 06:48:31', '2026-07-29 08:34:12'),
(643, 'Payroll Management', 'web', '2026-07-16 06:51:20', '2026-07-16 06:51:20'),
(644, 'Salary Structure', 'web', '2026-07-16 06:51:46', '2026-07-16 06:51:46'),
(645, 'Generate Salary', 'web', '2026-07-16 06:52:15', '2026-07-16 06:52:15'),
(646, 'Salary Sheet', 'web', '2026-07-16 06:52:51', '2026-07-16 06:52:51'),
(648, 'Payslip', 'web', '2026-07-16 06:54:29', '2026-07-16 06:54:29'),
(649, 'Bonus Management', 'web', '2026-07-16 06:54:56', '2026-07-16 06:54:56'),
(650, 'Increment Management', 'web', '2026-07-16 06:55:20', '2026-07-16 06:55:20'),
(651, 'Loan Management', 'web', '2026-07-16 06:55:45', '2026-07-16 06:55:45'),
(653, 'Overtime Management', 'web', '2026-07-16 06:56:34', '2026-07-16 06:56:34'),
(654, 'Expense Management', 'web', '2026-07-16 06:57:08', '2026-08-09 05:07:02'),
(655, 'Employee Documents', 'web', '2026-07-16 06:57:38', '2026-07-16 06:57:38'),
(657, 'Termination', 'web', '2026-07-16 08:44:09', '2026-07-16 08:44:09'),
(661, 'Performance Appraisal', 'web', '2026-07-16 08:45:43', '2026-07-16 08:45:43'),
(663, 'HR Dashboard', 'web', '2026-07-16 08:46:25', '2026-07-16 08:46:25'),
(664, 'HR Reports', 'web', '2026-07-16 08:46:46', '2026-07-16 08:46:46'),
(667, 'admin.lead-source.edit', 'web', '2026-07-19 11:06:54', '2026-07-19 11:06:54'),
(668, 'admin.lead-source.create', 'web', '2026-07-20 08:31:24', '2026-07-20 08:31:24'),
(669, 'admin.lead-status.create', 'web', '2026-07-20 09:14:43', '2026-07-20 09:14:43'),
(670, 'admin.lead-status.edit', 'web', '2026-07-20 09:14:55', '2026-07-20 09:14:55'),
(671, 'admin.lead.create', 'web', '2026-07-20 10:52:20', '2026-07-20 10:52:20'),
(672, 'admin.lead.edit', 'web', '2026-07-20 10:52:31', '2026-07-20 10:52:31'),
(673, 'admin.lead.show', 'web', '2026-07-20 11:06:30', '2026-07-20 11:06:30'),
(674, 'admin.lead.store', 'web', '2026-07-20 11:35:05', '2026-07-20 11:35:05'),
(675, 'admin.lead.update', 'web', '2026-07-20 11:35:18', '2026-07-20 11:35:18'),
(676, 'Customer Requirements', 'web', '2026-07-21 05:08:08', '2026-07-21 05:08:08'),
(677, 'admin.meeting-schedule.create', 'web', '2026-07-22 09:59:06', '2026-07-22 09:59:06'),
(678, 'admin.meeting-schedule.edit', 'web', '2026-07-22 09:59:21', '2026-07-22 09:59:21'),
(679, 'admin.quotation.edit', 'web', '2026-07-23 09:00:34', '2026-07-23 09:00:34'),
(680, 'admin.quotation.show', 'web', '2026-07-23 09:00:49', '2026-07-23 09:00:49'),
(681, 'admin.quotation.create', 'web', '2026-07-23 09:01:03', '2026-07-23 09:01:03'),
(683, 'admin.customer-requirement.edit', 'web', '2026-07-27 05:37:52', '2026-07-27 05:37:52'),
(684, 'admin.customer-requirement.create', 'web', '2026-07-27 05:38:05', '2026-07-27 05:38:05'),
(685, 'admin.customer-requirement.show', 'web', '2026-07-27 06:53:15', '2026-07-27 06:53:15'),
(686, 'admin.employee.create', 'web', '2026-07-28 05:41:58', '2026-07-28 05:41:58'),
(687, 'admin.employee.edit', 'web', '2026-07-28 05:42:09', '2026-07-28 05:42:09'),
(688, 'admin.employee-attendance.create', 'web', '2026-07-28 11:40:14', '2026-07-28 11:40:14'),
(690, 'admin.employee-attendance.edit', 'web', '2026-07-28 11:40:31', '2026-07-28 11:40:31'),
(691, 'admin.employee-leave.edit', 'web', '2026-07-29 06:56:41', '2026-07-29 06:56:41'),
(692, 'admin.holiday.edit', 'web', '2026-07-29 08:34:41', '2026-07-29 08:34:41'),
(693, 'admin.payroll.edit', 'web', '2026-07-29 10:10:02', '2026-07-29 10:10:02'),
(694, 'admin.payroll.update-status', 'web', '2026-08-04 04:27:47', '2026-08-04 04:27:47'),
(695, 'admin.salary.structure.certificate', 'web', '2026-08-04 06:30:26', '2026-08-04 06:30:26'),
(696, 'admin.employee-bonus.create', 'web', '2026-08-06 04:54:42', '2026-08-06 04:54:42'),
(697, 'admin.employee-bonus.edit', 'web', '2026-08-06 05:44:16', '2026-08-06 05:44:16'),
(698, 'admin.employee-increment.create', 'web', '2026-08-06 06:04:14', '2026-08-06 06:04:14'),
(699, 'admin.employee-increment.edit', 'web', '2026-08-06 06:04:28', '2026-08-06 06:04:28'),
(700, 'admin.employee-loan.create', 'web', '2026-08-06 06:36:44', '2026-08-06 06:36:44'),
(701, 'admin.employee-loan.edit', 'web', '2026-08-06 06:36:54', '2026-08-06 06:36:54'),
(702, 'admin.employee-overtime.create', 'web', '2026-08-09 04:55:52', '2026-08-09 04:55:52'),
(703, 'admin.employee-overtime.edit', 'web', '2026-08-09 04:56:02', '2026-08-09 04:56:02'),
(704, 'admin.expense.create', 'web', '2026-08-09 06:09:36', '2026-08-09 06:09:36'),
(705, 'admin.expense.edit', 'web', '2026-08-09 06:09:48', '2026-08-09 06:09:48'),
(706, 'admin.documents.create', 'web', '2026-08-09 06:54:08', '2026-08-09 06:54:08'),
(707, 'admin.documents.edit', 'web', '2026-08-09 06:54:19', '2026-08-09 06:54:19'),
(710, 'admin.termination.create', 'web', '2026-08-09 09:29:24', '2026-08-09 09:29:24'),
(711, 'admin.termination.edit', 'web', '2026-08-09 09:29:36', '2026-08-09 09:29:36'),
(712, 'admin.appraisal.create', 'web', '2026-08-09 10:26:53', '2026-08-09 10:26:53'),
(713, 'admin.appraisal.edit', 'web', '2026-08-09 10:27:05', '2026-08-09 10:27:05'),
(714, 'Enlisted New Client', 'web', '2026-08-15 09:39:19', '2026-08-15 09:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `video_id` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_order_sections`
--

CREATE TABLE `pre_order_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pre_order_setup_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `list` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_order_setups`
--

CREATE TABLE `pre_order_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `more_images` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `additional_info` longtext DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `alert_quantity` bigint(20) DEFAULT NULL,
  `min_order` bigint(20) NOT NULL DEFAULT 1,
  `max_order` bigint(20) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `video_id` varchar(255) DEFAULT NULL,
  `ctn_size` float NOT NULL DEFAULT 0,
  `attributes` text DEFAULT NULL,
  `choice_options` text DEFAULT NULL,
  `stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `trending` tinyint(4) NOT NULL DEFAULT 0,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `top_rated` tinyint(4) NOT NULL DEFAULT 0,
  `best_selling` tinyint(4) NOT NULL DEFAULT 0,
  `serial` int(11) NOT NULL DEFAULT 0,
  `allowed_investor` int(11) NOT NULL DEFAULT 1,
  `shared_profit` decimal(16,2) DEFAULT NULL,
  `show_on_website` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `product_type`, `vendor_id`, `attribute_id`, `category_id`, `brand_id`, `name`, `code`, `slug`, `thumbnail`, `more_images`, `short_description`, `description`, `additional_info`, `meta_title`, `meta_description`, `meta_keyword`, `alert_quantity`, `min_order`, `max_order`, `video`, `video_id`, `ctn_size`, `attributes`, `choice_options`, `stock`, `status`, `trending`, `featured`, `top_rated`, `best_selling`, `serial`, `allowed_investor`, `shared_profit`, `show_on_website`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', NULL, 11, 43, NULL, 'Test', 'test', 'test', 'media/product//2026-05-07-2GgJIyuH0ujtj2tHSeASmHrmXFZzjepRdl5D5OYI.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 194.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, NULL, NULL, NULL, '2026-05-07 07:42:47', '2026-09-14 01:01:20'),
(2, 1, 'Consumer', NULL, 11, 47, NULL, 'Mango', 'mng', 'mango-1', 'media/product//2026-07-23-jDsflBzX68L8KSVLTsQbo7vzyUyjArJPc8AyIKi6.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 2664.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, 1, NULL, NULL, '2026-07-23 09:34:38', '2026-09-17 06:20:50'),
(3, 1, 'Consumer', NULL, 12, 101, NULL, 'Hair Oil 100ml', 'barcode123', 'hair-oil-100ml-1', 'media/product//2026-08-15-M6wGfhOAfXSHdh94rTSjFA0KttRJbBWbLxB8Xq4y.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33223, 1, NULL, NULL, NULL, 0, NULL, NULL, 2659.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, 1, NULL, NULL, '2026-07-27 04:27:44', '2026-09-17 06:20:50'),
(4, 1, 'Consumer', NULL, 12, 101, NULL, 'sdfd', '333', 'sdfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 0.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, NULL, NULL, NULL, '2026-08-15 10:56:12', '2026-08-15 10:56:12'),
(5, 1, 'Consumer', NULL, 2, 62, NULL, 'polo', '9417', 'polo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 4.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, NULL, NULL, NULL, '2026-09-10 10:57:34', '2026-09-10 11:05:44'),
(6, 1, 'Consumer', NULL, 2, 102, NULL, 'belt', '11075', 'belt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 2664.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, NULL, NULL, NULL, '2026-09-10 10:58:22', '2026-09-21 06:54:43'),
(7, 1, 'Consumer', NULL, 2, 77, NULL, 'Hot water bag', '2233', 'hot-water-bag', 'media/product//2026-09-17-eQBogBI0xaUn16A5eVBhrYGp9gfWiyZfTcQM2aKD.webp', 'media/product//2026-09-17-jFlkZ7FqYSfbInQUGBmeg0c02z6uFP3PrT9K70Mr.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, 0.00, 1, 0, 0, 0, 0, 0, 1, NULL, 1, 1, NULL, NULL, NULL, '2026-09-17 07:07:02', '2026-09-17 07:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_price` decimal(16,2) NOT NULL,
  `sale_price` decimal(16,2) NOT NULL,
  `online_price` decimal(8,2) DEFAULT NULL,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `discount_tk` decimal(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `lifting_price`, `sale_price`, `online_price`, `discount`, `discount_tk`, `created_at`, `updated_at`) VALUES
(1, 1, 33.00, 33.00, 33.00, 0.00, 0.00, '2026-05-07 07:42:47', '2026-05-07 07:42:47'),
(2, 2, 44.00, 66.00, 77.00, 0.00, 0.00, '2026-07-23 09:34:38', '2026-07-23 09:34:58'),
(3, 3, 50.00, 90.00, 100.00, 0.00, 0.00, '2026-07-27 04:27:44', '2026-07-27 04:27:44'),
(4, 4, 33.00, 33.00, 33.00, 0.00, 0.00, '2026-08-15 10:56:12', '2026-08-15 10:56:12'),
(5, 5, 1005.00, 0.00, 1595.00, 0.00, 0.00, '2026-09-10 10:57:34', '2026-09-10 10:57:34'),
(6, 6, 712.00, 0.00, 1095.00, 0.00, 0.00, '2026-09-10 10:58:22', '2026-09-10 10:58:22'),
(7, 7, 150.00, 8680.00, 29960.00, 0.00, 0.00, '2026-09-17 07:07:02', '2026-09-17 07:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_skus`
--

CREATE TABLE `product_skus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant` varchar(255) NOT NULL,
  `lifting_price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `price` decimal(16,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `discount_tk` decimal(16,2) NOT NULL DEFAULT 0.00,
  `sku` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_vendors`
--

CREATE TABLE `product_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `incharge_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `company_id`, `code`, `name`, `incharge_name`, `phone`, `email`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(13, 1, 'PF', 'Region One', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2024-07-13 12:44:10', '2024-07-13 12:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `retail_returns`
--

CREATE TABLE `retail_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `retail_sale_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT 0,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reject` tinyint(1) NOT NULL DEFAULT 0,
  `reject_by` bigint(20) UNSIGNED DEFAULT NULL,
  `accounts_approve` tinyint(1) NOT NULL DEFAULT 0,
  `accounts_approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retail_returns`
--

INSERT INTO `retail_returns` (`id`, `company_id`, `product_type`, `retail_sale_id`, `store_id`, `return_no`, `client_name`, `client_phone`, `date`, `amount`, `remarks`, `approve`, `approve_by`, `reject`, `reject_by`, `accounts_approve`, `accounts_approve_by`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 1, 'Consumer', 706, 2, 'RR25050001', NULL, NULL, '2025-05-31', 25.00, 'Dry Store', 0, NULL, 0, NULL, 0, NULL, 159, NULL, 159, '2025-05-31 09:04:08', '2025-05-31 09:03:20', '2025-05-31 09:04:08'),
(4, 1, 'Consumer', 1702, 2, 'RR25060001', NULL, NULL, '2025-06-07', 140.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, 159, '2025-06-08 10:55:25', '2025-06-08 10:54:23', '2025-06-08 10:55:25'),
(5, 1, 'Consumer', 1702, 2, 'RR25060002', NULL, NULL, '2025-06-06', 140.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-06-09 11:57:35', '2025-06-09 11:57:35'),
(6, 1, 'Consumer', 2081, 2, 'RR25060003', NULL, NULL, '2025-06-12', 620.00, 'Dry Store', 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-06-12 15:45:06', '2025-06-12 15:45:06'),
(7, 1, 'Consumer', 2223, 2, 'RR25060004', NULL, '01710295004', '2025-06-15', 100.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-06-15 09:41:13', '2025-06-15 09:41:13'),
(8, 1, 'Consumer', 616, 2, 'RR25060005', NULL, NULL, '2025-06-18', 60.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, 159, NULL, NULL, '2025-06-18 10:50:16', '2025-06-18 15:39:56'),
(9, 1, 'Consumer', 2401, 2, 'RR25060006', NULL, '01914227770', '2025-06-19', 95.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-06-19 14:01:04', '2025-06-19 14:01:04'),
(10, 1, 'Consumer', 2816, 2, 'RR25060007', NULL, NULL, '2025-06-20', 160.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, 159, 2, '2025-06-20 15:12:57', '2025-06-20 15:04:08', '2025-06-20 15:12:57'),
(11, 1, 'Consumer', 2816, 2, 'RR25060008', NULL, NULL, '2025-06-20', 160.00, NULL, 0, NULL, 0, NULL, 0, NULL, 2, 159, NULL, NULL, '2025-06-20 15:15:04', '2025-06-21 07:23:12'),
(12, 1, 'Consumer', 2992, 2, 'RR25060009', NULL, NULL, '2025-06-21', 310.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-06-21 07:25:18', '2025-06-21 07:25:18'),
(13, 1, 'Consumer', 2958, 2, 'RR25060010', NULL, NULL, '2025-06-21', 85.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-06-21 15:07:47', '2025-06-21 15:07:47'),
(14, 1, 'Consumer', 4336, 2, 'RR25070001', NULL, NULL, '2025-07-04', 330.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-04 10:39:01', '2025-07-04 10:39:01'),
(15, 1, 'Consumer', 4084, 2, 'RR25070002', NULL, NULL, '2025-07-04', 178.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-04 12:04:44', '2025-07-04 12:04:44'),
(16, 1, 'Consumer', 4310, 2, 'RR25070003', NULL, NULL, '2025-07-07', 80.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-07 16:21:45', '2025-07-07 16:21:45'),
(17, 1, 'Consumer', 4715, 2, 'RR25070004', 'Shamol sen', '01913376702', '2025-07-09', 10.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-09 10:53:36', '2025-07-09 10:53:36'),
(18, 1, 'Consumer', 4909, 2, 'RR25070005', 'Shamol sen', '01913376702', '2025-07-11', 20.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-11 11:17:25', '2025-07-11 11:17:25'),
(19, 1, 'Consumer', 4962, 2, 'RR25070006', NULL, NULL, '2025-07-11', 400.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-11 15:53:01', '2025-07-11 15:53:01'),
(20, 1, 'Consumer', 4697, 2, 'RR25070007', NULL, '01732324603', '2025-07-13', 140.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-13 12:49:32', '2025-07-13 12:49:32'),
(21, 1, 'Consumer', 5391, 2, 'RR25070008', NULL, NULL, '2025-07-17', 240.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-17 15:25:34', '2025-07-17 15:25:34'),
(22, 1, 'Consumer', 4832, 2, 'RR25070009', NULL, '01911500385', '2025-07-20', 85.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-20 07:54:25', '2025-07-20 07:54:25'),
(23, 1, 'Consumer', 6002, 2, 'RR25070010', NULL, '01911500385', '2025-07-20', 415.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-20 13:45:17', '2025-07-20 13:45:17'),
(24, 1, 'Consumer', 6193, 2, 'RR25070011', NULL, NULL, '2025-07-21', 130.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-07-23 09:31:22', '2025-07-23 09:31:22'),
(25, 1, 'Consumer', 6471, 2, 'RR25070012', NULL, NULL, '2025-07-27', 105.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-27 16:37:53', '2025-07-27 16:37:53'),
(26, 1, 'Consumer', 6891, 2, 'RR25070013', NULL, NULL, '2025-07-30', 310.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-07-30 07:08:51', '2025-07-30 07:08:51'),
(27, 1, 'Consumer', 7127, 2, 'RR25070014', NULL, NULL, '2025-07-31', 300.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-07-31 13:30:12', '2025-07-31 13:30:12'),
(28, 1, 'Consumer', 7191, 2, 'RR25080001', NULL, NULL, '2025-08-01', 140.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-08-01 08:16:26', '2025-08-01 08:16:26'),
(29, 1, 'Consumer', 6503, 2, 'RR25080002', NULL, NULL, '2025-08-01', 225.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-08-01 08:25:11', '2025-08-01 08:25:11'),
(30, 1, 'Consumer', 5203, 2, 'RR25080003', NULL, NULL, '2025-08-01', 590.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-08-01 08:33:35', '2025-08-01 08:33:35'),
(31, 1, 'Consumer', 7395, 2, 'RR25080004', NULL, NULL, '2025-08-02', 430.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-02 09:29:59', '2025-08-02 09:29:59'),
(32, 1, 'Consumer', 7165, 2, 'RR25080005', 'Dipti', NULL, '2025-08-04', 470.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-04 14:16:19', '2025-08-04 14:16:19'),
(33, 1, 'Consumer', 7799, 2, 'RR25080006', NULL, NULL, '2025-08-07', 210.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-08-07 12:13:36', '2025-08-07 12:13:36'),
(34, 1, 'Consumer', 7553, 2, 'RR25080007', NULL, NULL, '2025-08-10', 153.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-10 14:43:16', '2025-08-10 14:43:16'),
(35, 1, 'Consumer', 8546, 2, 'RR25080008', NULL, NULL, '2025-08-12', 617.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, 159, '2025-08-12 08:59:48', '2025-08-12 07:52:09', '2025-08-12 08:59:48'),
(36, 1, 'Consumer', 8546, 2, 'RR25080009', NULL, NULL, '2025-08-12', 617.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, 159, '2025-08-12 08:59:41', '2025-08-12 07:52:10', '2025-08-12 08:59:41'),
(37, 1, 'Consumer', 8546, 2, 'RR25080010', NULL, NULL, '2025-08-12', 617.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-12 09:09:14', '2025-08-12 09:09:14'),
(38, 1, 'Consumer', 9306, 2, 'RR25080011', NULL, '01715296176', '2025-08-17', 85.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-17 09:15:42', '2025-08-17 09:15:42'),
(39, 1, 'Consumer', 9306, 2, 'RR25080012', NULL, '01715296176', '2025-08-17', 85.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-17 09:18:10', '2025-08-17 09:18:10'),
(40, 1, 'Consumer', 9602, 2, 'RR25080013', NULL, NULL, '2025-08-18', 210.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-08-18 08:27:47', '2025-08-18 08:27:47'),
(41, 1, 'Consumer', 9919, 2, 'RR25080014', NULL, NULL, '2025-08-21', 1050.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-21 13:52:38', '2025-08-21 13:52:38'),
(42, 1, 'Consumer', 9931, 2, 'RR25080015', NULL, NULL, '2025-08-21', 60.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-21 14:38:44', '2025-08-21 14:38:44'),
(43, 1, 'Consumer', 9163, 2, 'RR25080016', NULL, NULL, '2025-08-24', 45.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-24 14:39:42', '2025-08-24 14:39:42'),
(44, 1, 'Consumer', 11327, 2, 'RR25080017', NULL, NULL, '2025-08-31', 290.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-08-31 08:23:27', '2025-08-31 08:23:27'),
(45, 1, 'Consumer', 223, 2, 'RR25080018', 'KALIMONDIR', NULL, '2025-08-31', 3480.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-08-31 10:00:06', '2025-08-31 10:00:06'),
(46, 1, 'Consumer', 11460, 2, 'RR25090001', NULL, NULL, '2025-09-01', 2050.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-09-01 13:57:02', '2025-09-01 13:57:02'),
(47, 1, 'Consumer', 11794, 2, 'RR25090002', NULL, NULL, '2025-09-03', 85.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-09-03 16:27:36', '2025-09-03 16:27:36'),
(48, 1, 'Consumer', 12135, 2, 'RR25090003', NULL, NULL, '2025-09-06', 230.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-09-06 08:03:30', '2025-09-06 08:03:30'),
(49, 1, 'Consumer', 12327, 2, 'RR25090004', NULL, NULL, '2025-09-06', 1720.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-09-06 16:14:51', '2025-09-06 16:14:51'),
(50, 1, 'Consumer', 13381, 2, 'RR25090005', NULL, NULL, '2025-09-15', 360.09, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-09-15 09:59:23', '2025-09-15 09:59:23'),
(51, 1, 'Consumer', 13397, 2, 'RR25090006', NULL, NULL, '2025-09-15', 617.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-09-15 13:43:30', '2025-09-15 13:43:30'),
(52, 1, 'Consumer', 13388, 2, 'RR25090007', NULL, NULL, '2025-09-17', 247.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-09-17 07:58:56', '2025-09-17 07:58:56'),
(53, 1, 'Consumer', 14675, 2, 'RR25090008', NULL, NULL, '2025-09-24', 200.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-09-24 06:11:30', '2025-09-24 06:11:30'),
(54, 1, 'Consumer', 14328, 2, 'RR25090009', NULL, NULL, '2025-09-24', 430.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-09-24 13:16:04', '2025-09-24 13:16:04'),
(55, 1, 'Consumer', 15735, 2, 'RR25100001', NULL, NULL, '2025-10-01', 260.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-10-01 06:11:19', '2025-10-01 06:11:19'),
(56, 1, 'Consumer', 16062, 2, 'RR25100002', NULL, NULL, '2025-10-06', 600.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, 159, NULL, NULL, '2025-10-06 09:38:46', '2025-10-06 15:46:56'),
(57, 1, 'Consumer', 16543, 2, 'RR25100003', NULL, NULL, '2025-10-10', 74.07, NULL, 0, NULL, 0, NULL, 0, NULL, 160, 160, NULL, NULL, '2025-10-10 05:50:49', '2025-10-10 10:04:40'),
(58, 1, 'Consumer', 16597, 2, 'RR25100004', NULL, NULL, '2025-10-11', 260.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, 159, 159, '2025-10-11 09:50:03', '2025-10-11 09:14:11', '2025-10-11 09:50:03'),
(59, 1, 'Consumer', 16597, 2, 'RR25100005', NULL, NULL, '2025-10-11', 260.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-10-11 09:55:17', '2025-10-11 09:55:17'),
(60, 1, 'Consumer', 17923, 2, 'RR25100006', NULL, NULL, '2025-10-20', 385.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-10-20 07:25:10', '2025-10-20 07:25:10'),
(61, 1, 'Consumer', 17953, 2, 'RR25100007', NULL, NULL, '2025-10-20', 475.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-10-20 08:48:29', '2025-10-20 08:48:29'),
(62, 1, 'Consumer', 18405, 2, 'RR25100008', NULL, NULL, '2025-10-24', 110.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-10-24 08:12:11', '2025-10-24 08:12:11'),
(63, 1, 'Consumer', 17658, 2, 'RR25100009', NULL, NULL, '2025-10-31', 250.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-10-31 11:01:44', '2025-10-31 11:01:44'),
(64, 1, 'Consumer', 19264, 2, 'RR25110001', NULL, NULL, '2025-11-01', 400.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-01 14:18:33', '2025-11-01 14:18:33'),
(65, 1, 'Consumer', 19557, 2, 'RR25110002', NULL, NULL, '2025-11-03', 70.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-03 09:32:44', '2025-11-03 09:32:44'),
(66, 1, 'Consumer', 19484, 2, 'RR25110003', NULL, NULL, '2025-11-13', 250.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-13 15:07:51', '2025-11-13 15:07:51'),
(67, 1, 'Consumer', 20488, 2, 'RR25110004', NULL, NULL, '2025-11-13', 510.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-13 16:31:34', '2025-11-13 16:31:34'),
(68, 1, 'Consumer', 19609, 2, 'RR25110005', NULL, NULL, '2025-11-15', 100.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-15 12:47:03', '2025-11-15 12:47:03'),
(69, 1, 'Consumer', 21047, 2, 'RR25110006', NULL, NULL, '2025-11-17', 620.00, 'RS25111733', 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-11-17 07:18:24', '2025-11-17 07:18:24'),
(70, 1, 'Consumer', 21019, 2, 'RR25110007', NULL, NULL, '2025-11-17', 750.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-17 12:22:58', '2025-11-17 12:22:58'),
(71, 1, 'Consumer', 21264, 2, 'RR25110008', NULL, NULL, '2025-11-19', 350.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-11-19 05:28:13', '2025-11-19 05:28:13'),
(72, 1, 'Consumer', 20288, 2, 'RR25110009', NULL, NULL, '2025-11-19', 230.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-19 10:24:13', '2025-11-19 10:24:13'),
(73, 1, 'Consumer', 21580, 2, 'RR25110010', NULL, '01308752410', '2025-11-22', 205.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-22 17:04:14', '2025-11-22 17:04:14'),
(74, 1, 'Consumer', 21714, 2, 'RR25110011', NULL, NULL, '2025-11-27', 1300.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-27 14:34:34', '2025-11-27 14:34:34'),
(75, 1, 'Consumer', 21714, 2, 'RR25110012', NULL, NULL, '2025-11-27', 650.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-27 14:34:44', '2025-11-27 14:34:44'),
(76, 1, 'Consumer', 22428, 2, 'RR25110013', NULL, NULL, '2025-11-30', 430.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-11-30 13:45:15', '2025-11-30 13:45:15'),
(77, 1, 'Consumer', 22618, 2, 'RR25120001', NULL, NULL, '2025-12-03', 750.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-03 12:57:30', '2025-12-03 12:57:30'),
(78, 1, 'Consumer', 22764, 2, 'RR25120002', NULL, NULL, '2025-12-04', 430.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-12-04 06:54:37', '2025-12-04 06:54:37'),
(79, 1, 'Consumer', 23262, 2, 'RR25120003', NULL, NULL, '2025-12-10', 200.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-12-10 05:33:59', '2025-12-10 05:33:59'),
(80, 1, 'Consumer', 23175, 2, 'RR25120004', NULL, NULL, '2025-12-10', 90.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-12-10 06:45:43', '2025-12-10 06:45:43'),
(81, 1, 'Consumer', 23305, 2, 'RR25120005', NULL, NULL, '2025-12-10', 395.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-12-10 08:10:46', '2025-12-10 08:10:46'),
(82, 1, 'Consumer', 23110, 2, 'RR25120006', NULL, NULL, '2025-12-10', 1220.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-10 10:44:24', '2025-12-10 10:44:24'),
(83, 1, 'Consumer', 23149, 2, 'RR25120007', NULL, NULL, '2025-12-13', 465.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-13 16:16:34', '2025-12-13 16:16:34'),
(84, 1, 'Consumer', 24206, 2, 'RR25120008', NULL, NULL, '2025-12-18', 620.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-18 16:17:36', '2025-12-18 16:17:36'),
(85, 1, 'Consumer', 24197, 2, 'RR25120009', NULL, NULL, '2025-12-22', 370.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-22 12:46:41', '2025-12-22 12:46:41'),
(86, 1, 'Consumer', 24365, 2, 'RR25120010', NULL, NULL, '2025-12-27', 980.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2025-12-27 09:51:41', '2025-12-27 09:51:41'),
(87, 1, 'Consumer', 25229, 2, 'RR25120011', NULL, NULL, '2025-12-28', 200.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-28 14:05:45', '2025-12-28 14:05:45'),
(88, 1, 'Consumer', 25369, 2, 'RR25120012', NULL, NULL, '2025-12-29', 310.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-29 10:11:53', '2025-12-29 10:11:53'),
(89, 1, 'Consumer', 25259, 2, 'RR25120013', NULL, NULL, '2025-12-29', 260.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-29 15:11:38', '2025-12-29 15:11:38'),
(90, 1, 'Consumer', 25276, 2, 'RR25120014', NULL, NULL, '2025-12-29', 170.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2025-12-29 15:33:04', '2025-12-29 15:33:04'),
(91, 1, 'Consumer', 25646, 2, 'RR26010001', NULL, NULL, '2026-01-02', 390.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-01-02 08:18:26', '2026-01-02 08:18:26'),
(92, 1, 'Consumer', 25677, 2, 'RR26010002', NULL, NULL, '2026-01-02', 410.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-02 15:39:40', '2026-01-02 15:39:40'),
(93, 1, 'Consumer', 24686, 2, 'RR26010003', NULL, NULL, '2026-01-04', 130.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-04 15:20:33', '2026-01-04 15:20:33'),
(94, 1, 'Consumer', 26011, 2, 'RR26010004', NULL, NULL, '2026-01-05', 825.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-05 16:15:46', '2026-01-05 16:15:46'),
(95, 1, 'Consumer', 26063, 2, 'RR26010005', NULL, NULL, '2026-01-06', 850.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-01-06 09:29:50', '2026-01-06 09:29:50'),
(96, 1, 'Consumer', 25888, 2, 'RR26010006', NULL, NULL, '2026-01-07', 270.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-01-07 08:14:05', '2026-01-07 08:14:05'),
(97, 1, 'Consumer', 26115, 2, 'RR26010007', NULL, NULL, '2026-01-12', 120.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-12 15:52:39', '2026-01-12 15:52:39'),
(98, 1, 'Consumer', 26958, 2, 'RR26010008', NULL, NULL, '2026-01-14', 60.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-01-14 08:11:26', '2026-01-14 08:11:26'),
(99, 1, 'Consumer', 26272, 2, 'RR26010009', NULL, NULL, '2026-01-15', 445.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, 159, 159, '2026-01-15 09:04:08', '2026-01-15 03:55:29', '2026-01-15 09:04:08'),
(100, 1, 'Consumer', 26272, 2, 'RR26010010', NULL, NULL, '2026-01-15', 0.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, 159, '2026-01-15 07:49:57', '2026-01-15 03:56:43', '2026-01-15 07:49:57'),
(101, 1, 'Consumer', 23089, 2, 'RR26010011', NULL, NULL, '2026-01-18', 300.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-18 13:42:05', '2026-01-18 13:42:05'),
(102, 1, 'Consumer', 23089, 2, 'RR26010012', NULL, NULL, '2026-01-18', 300.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-18 13:42:05', '2026-01-18 13:42:05'),
(103, 1, 'Consumer', 28583, 2, 'RR26010013', NULL, NULL, '2026-01-30', 35.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-01-30 15:02:23', '2026-01-30 15:02:23'),
(104, 1, 'Consumer', 28675, 2, 'RR26020001', NULL, NULL, '2026-02-02', 110.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-02-02 04:51:38', '2026-02-02 04:51:38'),
(105, 1, 'Consumer', 26298, 2, 'RR26020002', NULL, NULL, '2026-02-05', 70.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-02-05 09:03:12', '2026-02-05 09:03:12'),
(106, 1, 'Consumer', 29878, 2, 'RR26020003', NULL, NULL, '2026-02-11', 260.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-02-11 05:29:51', '2026-02-11 05:29:51'),
(107, 1, 'Consumer', 29532, 2, 'RR26020004', NULL, NULL, '2026-02-15', 2800.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-02-15 10:27:37', '2026-02-15 10:27:37'),
(108, 1, 'Consumer', 30680, 2, 'RR26020005', NULL, NULL, '2026-02-21', 1850.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, 159, NULL, NULL, '2026-02-21 14:02:24', '2026-03-20 17:07:12'),
(109, 1, 'Consumer', 32488, 2, 'RR26030001', NULL, NULL, '2026-03-07', 720.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-03-07 12:41:26', '2026-03-07 12:41:26'),
(110, 1, 'Consumer', 32926, 2, 'RR26030002', NULL, NULL, '2026-03-11', 880.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-03-11 13:53:11', '2026-03-11 13:53:11'),
(111, 1, 'Consumer', 33329, 2, 'RR26030003', NULL, NULL, '2026-03-17', 70.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-03-17 15:53:35', '2026-03-17 15:53:35'),
(112, 1, 'Consumer', 33966, 2, 'RR26030004', 'Aashirbad', NULL, '2026-03-19', 60.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, 159, NULL, NULL, '2026-03-19 17:43:32', '2026-03-23 09:27:14'),
(113, 1, 'Consumer', 33966, 2, 'RR26030005', 'Aashirbad', NULL, '2026-03-19', 60.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, 159, '2026-03-23 09:27:04', '2026-03-19 17:43:32', '2026-03-23 09:27:04'),
(114, 1, 'Consumer', 30212, 2, 'RR26030006', NULL, NULL, '2026-03-20', 520.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-03-20 07:12:29', '2026-03-20 07:12:29'),
(115, 1, 'Consumer', 34390, 2, 'RR26030007', NULL, NULL, '2026-03-21', 600.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-03-21 14:01:41', '2026-03-21 14:01:41'),
(116, 1, 'Consumer', 34728, 2, 'RR26030008', NULL, NULL, '2026-03-25', 90.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-03-25 10:43:14', '2026-03-25 10:43:14'),
(117, 1, 'Consumer', 35256, 2, 'RR26030009', NULL, NULL, '2026-03-30', 942.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-03-30 06:28:59', '2026-03-30 06:28:59'),
(118, 1, 'Consumer', 35557, 2, 'RR26040001', NULL, NULL, '2026-04-02', 60.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-04-02 13:29:29', '2026-04-02 13:29:29'),
(119, 1, 'Consumer', 36434, 2, 'RR26040002', NULL, NULL, '2026-04-09', 800.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-04-09 12:47:23', '2026-04-09 12:47:23'),
(120, 1, 'Consumer', 37477, 2, 'RR26040003', NULL, NULL, '2026-04-18', 70.00, NULL, 0, NULL, 0, NULL, 0, NULL, 160, NULL, NULL, NULL, '2026-04-18 07:34:34', '2026-04-18 07:34:34'),
(121, 1, 'Consumer', 36960, 2, 'RR26040004', NULL, NULL, '2026-04-18', 1470.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-04-18 11:03:56', '2026-04-18 11:03:56'),
(122, 1, 'Consumer', 37664, 2, 'RR26040005', NULL, NULL, '2026-04-18', 234.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-04-18 14:23:44', '2026-04-18 14:23:44'),
(123, 1, 'Consumer', 37629, 2, 'RR26040006', NULL, NULL, '2026-04-18', 185.00, NULL, 0, NULL, 0, NULL, 0, NULL, 159, NULL, NULL, NULL, '2026-04-18 14:26:42', '2026-04-18 14:26:42'),
(124, 1, 'Consumer', 1, 2, 'RR26050001', 'cffff', NULL, '2026-05-13', 66.00, NULL, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, '2026-05-13 05:42:09', '2026-05-13 05:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `retail_return_lists`
--

CREATE TABLE `retail_return_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `retail_return_id` bigint(20) UNSIGNED NOT NULL,
  `retail_sale_list_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `qty` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `product_discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `sales_discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retail_return_lists`
--

INSERT INTO `retail_return_lists` (`id`, `company_id`, `product_type`, `retail_return_id`, `retail_sale_list_id`, `product_id`, `variant_id`, `store_id`, `price`, `qty`, `amount`, `product_discount`, `sales_discount`, `created_at`, `updated_at`) VALUES
(3, 1, 'Consumer', 3, 1862, 1232, NULL, 2, 25.00, 1.00, 25.00, 0.00, 0.00, '2025-05-31 09:03:20', '2025-05-31 09:03:20'),
(4, 1, 'Consumer', 4, 4359, 1579, NULL, 2, 140.00, 1.00, 140.00, 0.00, 0.00, '2025-06-08 10:54:23', '2025-06-08 10:54:23'),
(5, 1, 'Consumer', 5, 4359, 1579, NULL, 2, 140.00, 1.00, 140.00, 0.00, 0.00, '2025-06-09 11:57:35', '2025-06-09 11:57:35'),
(6, 1, 'Consumer', 6, 5152, 234, NULL, 2, 620.00, 1.00, 620.00, 0.00, 0.00, '2025-06-12 15:45:06', '2025-06-12 15:45:06'),
(7, 1, 'Consumer', 7, 5473, 907, NULL, 2, 50.00, 2.00, 100.00, 0.00, 0.00, '2025-06-15 09:41:13', '2025-06-15 09:41:13'),
(9, 1, 'Consumer', 8, 1491, 1071, NULL, 2, 20.00, 3.00, 60.00, 0.00, 0.00, '2025-06-18 15:39:56', '2025-06-18 15:39:56'),
(10, 1, 'Consumer', 9, 5827, 1374, NULL, 2, 95.00, 1.00, 95.00, 0.00, 0.00, '2025-06-19 14:01:04', '2025-06-19 14:01:04'),
(12, 1, 'Consumer', 10, 6706, 731, NULL, 2, 160.00, 1.00, 160.00, 0.00, 0.00, '2025-06-20 15:08:21', '2025-06-20 15:08:21'),
(15, 1, 'Consumer', 12, 7091, 567, NULL, 2, 310.00, 1.00, 310.00, 0.00, 0.00, '2025-06-21 07:25:18', '2025-06-21 07:25:18'),
(17, 1, 'Consumer', 13, 7015, 816, NULL, 2, 85.00, 1.00, 85.00, 0.00, 0.00, '2025-06-21 15:07:47', '2025-06-21 15:07:47'),
(18, 1, 'Consumer', 11, 6706, 731, NULL, 2, 160.00, 1.00, 160.00, 0.00, 0.00, '2025-06-24 05:58:24', '2025-06-24 05:58:24'),
(19, 1, 'Consumer', 14, 9901, 2021, NULL, 2, 330.00, 1.00, 330.00, 0.00, 0.00, '2025-07-04 10:39:01', '2025-07-04 10:39:01'),
(20, 1, 'Consumer', 15, 9360, 496, NULL, 2, 48.00, 1.00, 48.00, 0.00, 0.00, '2025-07-04 12:04:44', '2025-07-04 12:04:44'),
(21, 1, 'Consumer', 15, 9361, 289, NULL, 2, 130.00, 1.00, 130.00, 0.00, 0.00, '2025-07-04 12:04:44', '2025-07-04 12:04:44'),
(22, 1, 'Consumer', 16, 9849, 1097, NULL, 2, 80.00, 1.00, 80.00, 0.00, 0.00, '2025-07-07 16:21:45', '2025-07-07 16:21:45'),
(23, 1, 'Consumer', 17, 10705, 1783, NULL, 2, 10.00, 1.00, 10.00, 0.00, 0.00, '2025-07-09 10:53:36', '2025-07-09 10:53:36'),
(24, 1, 'Consumer', 18, 11219, 2090, NULL, 2, 10.00, 1.00, 10.00, 0.00, 0.00, '2025-07-11 11:17:25', '2025-07-11 11:17:25'),
(25, 1, 'Consumer', 18, 11220, 2089, NULL, 2, 10.00, 1.00, 10.00, 0.00, 0.00, '2025-07-11 11:17:25', '2025-07-11 11:17:25'),
(26, 1, 'Consumer', 19, 11739, 1370, NULL, 2, 0.80, 500.00, 400.00, 0.00, 0.00, '2025-07-11 15:53:01', '2025-07-11 15:53:01'),
(27, 1, 'Consumer', 20, 10675, 1727, NULL, 2, 140.00, 1.00, 140.00, 0.00, 0.00, '2025-07-13 12:49:32', '2025-07-13 12:49:32'),
(28, 1, 'Consumer', 21, 12296, 1297, NULL, 2, 120.00, 2.00, 240.00, 0.00, 0.00, '2025-07-17 15:25:34', '2025-07-17 15:25:34'),
(29, 1, 'Consumer', 22, 11031, 1587, NULL, 2, 85.00, 1.00, 85.00, 0.00, 0.00, '2025-07-20 07:54:25', '2025-07-20 07:54:25'),
(30, 1, 'Consumer', 23, 13577, 917, NULL, 2, 415.00, 1.00, 415.00, 0.00, 0.00, '2025-07-20 13:45:17', '2025-07-20 13:45:17'),
(31, 1, 'Consumer', 24, 14040, 464, NULL, 2, 130.00, 1.00, 130.00, 0.00, 0.00, '2025-07-23 09:31:22', '2025-07-23 09:31:22'),
(32, 1, 'Consumer', 25, 14637, 773, NULL, 2, 105.00, 1.00, 105.00, 0.00, 0.00, '2025-07-27 16:37:53', '2025-07-27 16:37:53'),
(33, 1, 'Consumer', 26, 15461, 876, NULL, 2, 310.00, 1.00, 310.00, 0.00, 0.00, '2025-07-30 07:08:51', '2025-07-30 07:08:51'),
(34, 1, 'Consumer', 27, 16038, 288, NULL, 2, 300.00, 1.00, 300.00, 0.00, 0.00, '2025-07-31 13:30:12', '2025-07-31 13:30:12'),
(35, 1, 'Consumer', 28, 16161, 497, NULL, 2, 140.00, 1.00, 140.00, 0.00, 0.00, '2025-08-01 08:16:26', '2025-08-01 08:16:26'),
(36, 1, 'Consumer', 29, 14705, 563, NULL, 2, 45.00, 1.00, 45.00, 0.00, 0.00, '2025-08-01 08:25:11', '2025-08-01 08:25:11'),
(37, 1, 'Consumer', 29, 14706, 205, NULL, 2, 50.00, 1.00, 50.00, 0.00, 0.00, '2025-08-01 08:25:11', '2025-08-01 08:25:11'),
(38, 1, 'Consumer', 29, 14707, 207, NULL, 2, 65.00, 2.00, 130.00, 0.00, 0.00, '2025-08-01 08:25:11', '2025-08-01 08:25:11'),
(39, 1, 'Consumer', 30, 11898, 1184, NULL, 2, 590.00, 1.00, 590.00, 0.00, 0.00, '2025-08-01 08:33:35', '2025-08-01 08:33:35'),
(40, 1, 'Consumer', 31, 16626, 1562, NULL, 2, 430.00, 1.00, 430.00, 0.00, 0.00, '2025-08-02 09:29:59', '2025-08-02 09:29:59'),
(41, 1, 'Consumer', 32, 16113, 1075, NULL, 2, 470.00, 1.00, 470.00, 0.00, 0.00, '2025-08-04 14:16:19', '2025-08-04 14:16:19'),
(42, 1, 'Consumer', 33, 17546, 1945, NULL, 2, 210.00, 1.00, 210.00, 0.00, 0.00, '2025-08-07 12:13:36', '2025-08-07 12:13:36'),
(43, 1, 'Consumer', 34, 16988, 1686, NULL, 2, 153.00, 1.00, 153.00, 0.00, 0.00, '2025-08-10 14:43:16', '2025-08-10 14:43:16'),
(44, 1, 'Consumer', 35, 19190, 901, NULL, 2, 617.00, 1.00, 617.00, 0.00, 0.00, '2025-08-12 07:52:09', '2025-08-12 07:52:09'),
(45, 1, 'Consumer', 36, 19190, 901, NULL, 2, 617.00, 1.00, 617.00, 0.00, 0.00, '2025-08-12 07:52:10', '2025-08-12 07:52:10'),
(46, 1, 'Consumer', 37, 19190, 901, NULL, 2, 617.00, 1.00, 617.00, 0.00, 0.00, '2025-08-12 09:09:14', '2025-08-12 09:09:14'),
(47, 1, 'Consumer', 38, 20903, 1585, NULL, 2, 85.00, 1.00, 85.00, 0.00, 0.00, '2025-08-17 09:15:42', '2025-08-17 09:15:42'),
(48, 1, 'Consumer', 39, 20903, 1585, NULL, 2, 85.00, 1.00, 85.00, 0.00, 0.00, '2025-08-17 09:18:10', '2025-08-17 09:18:10'),
(49, 1, 'Consumer', 40, 21533, 951, NULL, 2, 210.00, 1.00, 210.00, 0.00, 0.00, '2025-08-18 08:27:47', '2025-08-18 08:27:47'),
(50, 1, 'Consumer', 41, 22191, 401, NULL, 2, 1050.00, 1.00, 1050.00, 0.00, 0.00, '2025-08-21 13:52:38', '2025-08-21 13:52:38'),
(51, 1, 'Consumer', 42, 22207, 1589, NULL, 2, 60.00, 1.00, 60.00, 0.00, 0.00, '2025-08-21 14:38:44', '2025-08-21 14:38:44'),
(52, 1, 'Consumer', 43, 20528, 1289, NULL, 2, 0.45, 100.00, 45.00, 0.00, 0.00, '2025-08-24 14:39:42', '2025-08-24 14:39:42'),
(53, 1, 'Consumer', 44, 25047, 1943, NULL, 2, 290.00, 1.00, 290.00, 0.00, 0.00, '2025-08-31 08:23:27', '2025-08-31 08:23:27'),
(54, 1, 'Consumer', 45, 477, 550, NULL, 2, 145.00, 24.00, 3480.00, 0.00, 0.00, '2025-08-31 10:00:06', '2025-08-31 10:00:06'),
(55, 1, 'Consumer', 46, 25318, 1506, NULL, 2, 2050.00, 1.00, 2050.00, 0.00, 0.00, '2025-09-01 13:57:02', '2025-09-01 13:57:02'),
(56, 1, 'Consumer', 47, 25931, 526, NULL, 2, 85.00, 1.00, 85.00, 0.00, 0.00, '2025-09-03 16:27:36', '2025-09-03 16:27:36'),
(57, 1, 'Consumer', 48, 26673, 925, NULL, 2, 230.00, 1.00, 230.00, 0.00, 0.00, '2025-09-06 08:03:30', '2025-09-06 08:03:30'),
(58, 1, 'Consumer', 49, 26941, 400, NULL, 2, 860.00, 2.00, 1720.00, 0.00, 0.00, '2025-09-06 16:14:51', '2025-09-06 16:14:51'),
(59, 1, 'Consumer', 50, 29005, 1162, NULL, 2, 360.09, 1.00, 360.09, 0.00, 4.91, '2025-09-15 09:59:23', '2025-09-15 09:59:23'),
(60, 1, 'Consumer', 51, 29034, 901, NULL, 2, 617.00, 1.00, 617.00, 0.00, 0.00, '2025-09-15 13:43:30', '2025-09-15 13:43:30'),
(61, 1, 'Consumer', 52, 29022, 2068, NULL, 2, 13.00, 19.00, 247.00, 0.00, 0.00, '2025-09-17 07:58:56', '2025-09-17 07:58:56'),
(62, 1, 'Consumer', 53, 31608, 2406, NULL, 2, 50.00, 4.00, 200.00, 0.00, 0.00, '2025-09-24 06:11:30', '2025-09-24 06:11:30'),
(63, 1, 'Consumer', 54, 30941, 1828, NULL, 2, 430.00, 1.00, 430.00, 0.00, 0.00, '2025-09-24 13:16:04', '2025-09-24 13:16:04'),
(64, 1, 'Consumer', 55, 33776, 576, NULL, 2, 260.00, 1.00, 260.00, 0.00, 0.00, '2025-10-01 06:11:19', '2025-10-01 06:11:19'),
(66, 1, 'Consumer', 56, 34402, 2637, NULL, 2, 600.00, 1.00, 600.00, 0.00, 0.00, '2025-10-06 15:46:56', '2025-10-06 15:46:56'),
(68, 1, 'Consumer', 57, 35432, 273, NULL, 2, 74.07, 1.00, 74.07, 0.00, 0.93, '2025-10-10 10:04:40', '2025-10-10 10:04:40'),
(76, 1, 'Consumer', 58, 35551, 820, NULL, 2, 130.00, 2.00, 260.00, 0.00, 0.00, '2025-10-11 09:47:25', '2025-10-11 09:47:25'),
(77, 1, 'Consumer', 59, 35551, 820, NULL, 2, 130.00, 2.00, 260.00, 0.00, 0.00, '2025-10-11 09:55:17', '2025-10-11 09:55:17'),
(78, 1, 'Consumer', 60, 38426, 393, NULL, 2, 385.00, 1.00, 385.00, 0.00, 0.00, '2025-10-20 07:25:10', '2025-10-20 07:25:10'),
(79, 1, 'Consumer', 61, 38488, 390, NULL, 2, 475.00, 1.00, 475.00, 0.00, 0.00, '2025-10-20 08:48:29', '2025-10-20 08:48:29'),
(80, 1, 'Consumer', 62, 39385, 1000, NULL, 2, 110.00, 1.00, 110.00, 0.00, 0.00, '2025-10-24 08:12:11', '2025-10-24 08:12:11'),
(81, 1, 'Consumer', 63, 37862, 2949, NULL, 2, 250.00, 1.00, 250.00, 0.00, 0.00, '2025-10-31 11:01:44', '2025-10-31 11:01:44'),
(82, 1, 'Consumer', 64, 41360, 2878, NULL, 2, 400.00, 1.00, 400.00, 0.00, 0.00, '2025-11-01 14:18:33', '2025-11-01 14:18:33'),
(83, 1, 'Consumer', 65, 41933, 317, NULL, 2, 70.00, 1.00, 70.00, 0.00, 0.00, '2025-11-03 09:32:44', '2025-11-03 09:32:44'),
(84, 1, 'Consumer', 66, 41733, 2949, NULL, 2, 250.00, 1.00, 250.00, 0.00, 0.00, '2025-11-13 15:07:51', '2025-11-13 15:07:51'),
(85, 1, 'Consumer', 67, 43998, 396, NULL, 2, 510.00, 1.00, 510.00, 0.00, 0.00, '2025-11-13 16:31:34', '2025-11-13 16:31:34'),
(86, 1, 'Consumer', 68, 42041, 2770, NULL, 2, 100.00, 1.00, 100.00, 0.00, 0.00, '2025-11-15 12:47:03', '2025-11-15 12:47:03'),
(87, 1, 'Consumer', 69, 45230, 2526, NULL, 2, 620.00, 1.00, 620.00, 0.00, 0.00, '2025-11-17 07:18:24', '2025-11-17 07:18:24'),
(88, 1, 'Consumer', 70, 45175, 3147, NULL, 2, 750.00, 1.00, 750.00, 0.00, 0.00, '2025-11-17 12:22:58', '2025-11-17 12:22:58'),
(89, 1, 'Consumer', 71, 45730, 1611, NULL, 2, 350.00, 1.00, 350.00, 0.00, 0.00, '2025-11-19 05:28:13', '2025-11-19 05:28:13'),
(90, 1, 'Consumer', 72, 43585, 2963, NULL, 2, 230.00, 1.00, 230.00, 0.00, 0.00, '2025-11-19 10:24:13', '2025-11-19 10:24:13'),
(91, 1, 'Consumer', 73, 46406, 1647, NULL, 2, 205.00, 1.00, 205.00, 0.00, 0.00, '2025-11-22 17:04:14', '2025-11-22 17:04:14'),
(92, 1, 'Consumer', 74, 46698, 384, NULL, 2, 650.00, 2.00, 1300.00, 0.00, 0.00, '2025-11-27 14:34:34', '2025-11-27 14:34:34'),
(93, 1, 'Consumer', 75, 46698, 384, NULL, 2, 650.00, 1.00, 650.00, 0.00, 0.00, '2025-11-27 14:34:44', '2025-11-27 14:34:44'),
(94, 1, 'Consumer', 76, 48255, 1828, NULL, 2, 430.00, 1.00, 430.00, 0.00, 0.00, '2025-11-30 13:45:15', '2025-11-30 13:45:15'),
(95, 1, 'Consumer', 77, 48729, 3148, NULL, 2, 750.00, 1.00, 750.00, 0.00, 0.00, '2025-12-03 12:57:30', '2025-12-03 12:57:30'),
(96, 1, 'Consumer', 78, 49042, 1828, NULL, 2, 430.00, 1.00, 430.00, 0.00, 0.00, '2025-12-04 06:54:37', '2025-12-04 06:54:37'),
(97, 1, 'Consumer', 79, 50112, 1929, NULL, 2, 200.00, 1.00, 200.00, 0.00, 0.00, '2025-12-10 05:33:59', '2025-12-10 05:33:59'),
(98, 1, 'Consumer', 80, 49926, 2872, NULL, 2, 90.00, 1.00, 90.00, 0.00, 0.00, '2025-12-10 06:45:43', '2025-12-10 06:45:43'),
(99, 1, 'Consumer', 81, 50208, 405, NULL, 2, 395.00, 1.00, 395.00, 0.00, 0.00, '2025-12-10 08:10:46', '2025-12-10 08:10:46'),
(100, 1, 'Consumer', 82, 49806, 1180, NULL, 2, 1220.00, 1.00, 1220.00, 0.00, 0.00, '2025-12-10 10:44:24', '2025-12-10 10:44:24'),
(101, 1, 'Consumer', 83, 49872, 415, NULL, 2, 465.00, 1.00, 465.00, 0.00, 0.00, '2025-12-13 16:16:34', '2025-12-13 16:16:34'),
(102, 1, 'Consumer', 84, 52257, 1179, NULL, 2, 620.00, 1.00, 620.00, 0.00, 0.00, '2025-12-18 16:17:36', '2025-12-18 16:17:36'),
(103, 1, 'Consumer', 85, 52244, 3279, NULL, 2, 370.00, 1.00, 370.00, 0.00, 0.00, '2025-12-22 12:46:41', '2025-12-22 12:46:41'),
(104, 1, 'Consumer', 86, 52693, 2318, NULL, 2, 980.00, 1.00, 980.00, 0.00, 0.00, '2025-12-27 09:51:41', '2025-12-27 09:51:41'),
(105, 1, 'Consumer', 87, 54675, 2650, NULL, 2, 200.00, 1.00, 200.00, 0.00, 0.00, '2025-12-28 14:05:45', '2025-12-28 14:05:45'),
(106, 1, 'Consumer', 88, 54992, 380, NULL, 2, 310.00, 1.00, 310.00, 0.00, 0.00, '2025-12-29 10:11:53', '2025-12-29 10:11:53'),
(107, 1, 'Consumer', 89, 54747, 2180, NULL, 2, 260.00, 1.00, 260.00, 0.00, 0.00, '2025-12-29 15:11:38', '2025-12-29 15:11:38'),
(108, 1, 'Consumer', 90, 54796, 3003, NULL, 2, 170.00, 1.00, 170.00, 0.00, 0.00, '2025-12-29 15:33:04', '2025-12-29 15:33:04'),
(109, 1, 'Consumer', 91, 55650, 2635, NULL, 2, 390.00, 1.00, 390.00, 0.00, 0.00, '2026-01-02 08:18:26', '2026-01-02 08:18:26'),
(110, 1, 'Consumer', 92, 55732, 2844, NULL, 2, 410.00, 1.00, 410.00, 0.00, 0.00, '2026-01-02 15:39:40', '2026-01-02 15:39:40'),
(111, 1, 'Consumer', 93, 53403, 3152, NULL, 2, 130.00, 1.00, 130.00, 0.00, 0.00, '2026-01-04 15:20:33', '2026-01-04 15:20:33'),
(112, 1, 'Consumer', 94, 56510, 1509, NULL, 2, 825.00, 1.00, 825.00, 0.00, 0.00, '2026-01-05 16:15:46', '2026-01-05 16:15:46'),
(113, 1, 'Consumer', 95, 56622, 1358, NULL, 2, 850.00, 1.00, 850.00, 0.00, 0.00, '2026-01-06 09:29:50', '2026-01-06 09:29:50'),
(114, 1, 'Consumer', 96, 56231, 823, NULL, 2, 135.00, 2.00, 270.00, 0.00, 0.00, '2026-01-07 08:14:05', '2026-01-07 08:14:05'),
(115, 1, 'Consumer', 97, 56744, 3295, NULL, 2, 120.00, 1.00, 120.00, 0.00, 0.00, '2026-01-12 15:52:39', '2026-01-12 15:52:39'),
(116, 1, 'Consumer', 98, 58570, 2493, NULL, 2, 60.00, 1.00, 60.00, 0.00, 0.00, '2026-01-14 08:11:26', '2026-01-14 08:11:26'),
(120, 1, 'Consumer', 99, 57047, 395, NULL, 2, 445.00, 1.00, 445.00, 0.00, 0.00, '2026-01-15 07:50:22', '2026-01-15 07:50:22'),
(121, 1, 'Consumer', 101, 49769, 1958, NULL, 2, 300.00, 1.00, 300.00, 0.00, 0.00, '2026-01-18 13:42:05', '2026-01-18 13:42:05'),
(122, 1, 'Consumer', 102, 49769, 1958, NULL, 2, 300.00, 1.00, 300.00, 0.00, 0.00, '2026-01-18 13:42:05', '2026-01-18 13:42:05'),
(123, 1, 'Consumer', 103, 62173, 2191, NULL, 2, 35.00, 1.00, 35.00, 0.00, 0.00, '2026-01-30 15:02:23', '2026-01-30 15:02:23'),
(124, 1, 'Consumer', 104, 62366, 3340, NULL, 2, 110.00, 1.00, 110.00, 0.00, 0.00, '2026-02-02 04:51:38', '2026-02-02 04:51:38'),
(125, 1, 'Consumer', 105, 57114, 2217, NULL, 2, 5.00, 14.00, 70.00, 0.00, 0.00, '2026-02-05 09:03:12', '2026-02-05 09:03:12'),
(126, 1, 'Consumer', 106, 65381, 824, NULL, 2, 260.00, 1.00, 260.00, 0.00, 0.00, '2026-02-11 05:29:51', '2026-02-11 05:29:51'),
(127, 1, 'Consumer', 107, 64448, 404, NULL, 2, 1400.00, 2.00, 2800.00, 0.00, 0.00, '2026-02-15 10:27:37', '2026-02-15 10:27:37'),
(129, 1, 'Consumer', 109, 71572, 926, NULL, 2, 720.00, 1.00, 720.00, 0.00, 0.00, '2026-03-07 12:41:26', '2026-03-07 12:41:26'),
(130, 1, 'Consumer', 110, 72559, 2316, NULL, 2, 880.00, 1.00, 880.00, 0.00, 0.00, '2026-03-11 13:53:11', '2026-03-11 13:53:11'),
(131, 1, 'Consumer', 111, 73515, 2448, NULL, 2, 70.00, 1.00, 70.00, 0.00, 0.00, '2026-03-17 15:53:35', '2026-03-17 15:53:35'),
(133, 1, 'Consumer', 113, 75144, 3842, NULL, 2, 60.00, 1.00, 60.00, 0.00, 0.00, '2026-03-19 17:43:32', '2026-03-19 17:43:32'),
(134, 1, 'Consumer', 114, 66264, 3474, NULL, 2, 520.00, 1.00, 520.00, 0.00, 0.00, '2026-03-20 07:12:29', '2026-03-20 07:12:29'),
(135, 1, 'Consumer', 108, 67466, 3542, NULL, 2, 1850.00, 1.00, 1850.00, 0.00, 0.00, '2026-03-20 17:07:12', '2026-03-20 17:07:12'),
(136, 1, 'Consumer', 115, 76103, 3002, NULL, 2, 600.00, 1.00, 600.00, 0.00, 0.00, '2026-03-21 14:01:41', '2026-03-21 14:01:41'),
(137, 1, 'Consumer', 112, 75144, 3842, NULL, 2, 60.00, 1.00, 60.00, 0.00, 0.00, '2026-03-23 09:27:14', '2026-03-23 09:27:14'),
(138, 1, 'Consumer', 116, 76924, 611, NULL, 2, 45.00, 2.00, 90.00, 0.00, 0.00, '2026-03-25 10:43:14', '2026-03-25 10:43:14'),
(139, 1, 'Consumer', 117, 78049, 613, NULL, 2, 157.00, 6.00, 942.00, 0.00, 0.00, '2026-03-30 06:28:59', '2026-03-30 06:28:59'),
(140, 1, 'Consumer', 118, 78662, 1203, NULL, 2, 60.00, 1.00, 60.00, 0.00, 0.00, '2026-04-02 13:29:29', '2026-04-02 13:29:29'),
(141, 1, 'Consumer', 119, 80730, 416, NULL, 2, 55.00, 5.00, 275.00, 0.00, 0.00, '2026-04-09 12:47:23', '2026-04-09 12:47:23'),
(142, 1, 'Consumer', 119, 80731, 2117, NULL, 2, 50.00, 5.00, 250.00, 0.00, 0.00, '2026-04-09 12:47:23', '2026-04-09 12:47:23'),
(143, 1, 'Consumer', 119, 80732, 417, NULL, 2, 55.00, 5.00, 275.00, 0.00, 0.00, '2026-04-09 12:47:23', '2026-04-09 12:47:23'),
(144, 1, 'Consumer', 120, 83062, 1188, NULL, 2, 70.00, 1.00, 70.00, 0.00, 0.00, '2026-04-18 07:34:34', '2026-04-18 07:34:34'),
(145, 1, 'Consumer', 121, 81956, 3937, NULL, 2, 1470.00, 1.00, 1470.00, 0.00, 0.00, '2026-04-18 11:03:56', '2026-04-18 11:03:56'),
(146, 1, 'Consumer', 122, 83501, 884, NULL, 2, 234.00, 1.00, 234.00, 0.00, 0.00, '2026-04-18 14:23:44', '2026-04-18 14:23:44'),
(147, 1, 'Consumer', 123, 83392, 267, NULL, 2, 185.00, 1.00, 185.00, 0.00, 0.00, '2026-04-18 14:26:42', '2026-04-18 14:26:42'),
(148, 1, 'Consumer', 124, 1, 1, NULL, 2, 33.00, 2.00, 66.00, 0.00, 0.00, '2026-05-13 05:42:11', '2026-05-13 05:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `retail_sales`
--

CREATE TABLE `retail_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `payment_type` varchar(255) DEFAULT NULL,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `retail_return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `total_amount` decimal(16,2) NOT NULL,
  `product_discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `net_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `return_deduction` decimal(16,2) NOT NULL DEFAULT 0.00,
  `receive_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `change_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retail_sales`
--

INSERT INTO `retail_sales` (`id`, `company_id`, `product_type`, `payment_type`, `coa_setup_id`, `retail_return_id`, `store_id`, `invoice`, `date`, `client_name`, `client_phone`, `total_amount`, `product_discount`, `discount`, `net_amount`, `return_deduction`, `receive_amount`, `change_amount`, `status`, `staff_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', NULL, 26, NULL, 2, 'RS26050001', '2026-05-13', 'cffff', NULL, 66.00, 0.00, 0.00, 66.00, 0.00, 66.00, 0.00, 1, NULL, 1, NULL, NULL, NULL, '2026-05-13 05:16:39', '2026-05-13 05:16:39'),
(2, 1, 'Consumer', NULL, 26, NULL, 2, 'RS26070001', '2026-07-07', 'www', '333', 33.00, 0.00, 0.00, 33.00, 0.00, 33.00, 0.00, 1, NULL, 1, NULL, NULL, NULL, '2026-07-07 10:15:58', '2026-07-07 10:15:58'),
(3, 1, 'Consumer', NULL, 26, NULL, 2, 'RS26070002', '2026-07-13', 'w', '33333', 33.00, 0.00, 0.00, 33.00, 0.00, 66.00, 0.00, 1, NULL, 1, NULL, NULL, NULL, '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(4, 1, 'Consumer', NULL, 26, NULL, 2, 'RS26090001', '2026-09-06', 'dfsfs', '01010', 665.00, 0.00, 0.00, 665.00, 0.00, 665.00, 0.00, 1, NULL, 1, NULL, NULL, NULL, '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(5, 1, 'Consumer', NULL, 26, NULL, 2, 'RS26090002', '2026-09-10', NULL, NULL, 2690.00, 0.00, 0.00, 2690.00, 0.00, 2690.00, 0.00, 1, NULL, 1, NULL, NULL, NULL, '2026-09-10 11:05:43', '2026-09-10 11:05:43'),
(6, 1, 'Consumer', NULL, 26, NULL, 2, 'RS26090003', '2026-09-14', 'Sumon', '017788557885', 540.00, 0.00, 0.00, 540.00, 0.00, 1000.00, 460.00, 1, NULL, 1, NULL, NULL, NULL, '2026-09-14 01:01:20', '2026-09-14 01:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `retail_sale_lists`
--

CREATE TABLE `retail_sale_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `retail_sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` decimal(16,2) NOT NULL,
  `qty` decimal(16,2) NOT NULL,
  `product_discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `amount` decimal(16,2) NOT NULL,
  `returned_qty` decimal(16,2) NOT NULL DEFAULT 0.00,
  `returned_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retail_sale_lists`
--

INSERT INTO `retail_sale_lists` (`id`, `company_id`, `product_type`, `retail_sale_id`, `product_id`, `variant_id`, `rate`, `qty`, `product_discount`, `discount`, `amount`, `returned_qty`, `returned_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', 1, 1, NULL, 33.00, 2.00, 0.00, 0.00, 66.00, 2.00, 66.00, '2026-05-13 05:16:41', '2026-05-13 05:42:12'),
(2, 1, 'Consumer', 2, 1, NULL, 33.00, 1.00, 0.00, 0.00, 33.00, 0.00, 0.00, '2026-07-07 10:15:58', '2026-07-07 10:15:58'),
(3, 1, 'Consumer', 3, 1, NULL, 33.00, 1.00, 0.00, 0.00, 33.00, 0.00, 0.00, '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(4, 1, 'Consumer', 3, 1, NULL, 33.00, 1.00, 0.00, 0.00, 33.00, 0.00, 0.00, '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(5, 1, 'Consumer', 4, 1, NULL, 33.00, 5.00, 0.00, 0.00, 165.00, 0.00, 0.00, '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(6, 1, 'Consumer', 4, 3, NULL, 100.00, 5.00, 0.00, 0.00, 500.00, 0.00, 0.00, '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(7, 1, 'Consumer', 5, 6, NULL, 1095.00, 1.00, 0.00, 0.00, 1095.00, 0.00, 0.00, '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(8, 1, 'Consumer', 5, 5, NULL, 1595.00, 1.00, 0.00, 0.00, 1595.00, 0.00, 0.00, '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(9, 1, 'Consumer', 6, 1, NULL, 33.00, 11.00, 0.00, 0.00, 363.00, 0.00, 0.00, '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(10, 1, 'Consumer', 6, 3, NULL, 100.00, 1.00, 0.00, 0.00, 100.00, 0.00, 0.00, '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(11, 1, 'Consumer', 6, 2, NULL, 77.00, 1.00, 0.00, 0.00, 77.00, 0.00, 0.00, '2026-09-14 01:01:20', '2026-09-14 01:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `star` tinyint(4) NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `company_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'System Admin', 'web', '2023-10-24 06:03:09', '2023-10-24 06:03:09'),
(10, NULL, 'Software Admin', 'web', '2023-11-09 03:59:06', '2023-11-09 03:59:06'),
(11, NULL, 'Client', 'web', '2023-11-22 17:17:13', '2023-11-22 17:17:13'),
(12, NULL, 'Investor', 'web', '2024-07-11 06:16:55', '2024-07-11 06:16:55'),
(13, 1, 'CRM', 'web', '2024-09-02 13:08:43', '2026-07-16 09:01:28'),
(14, NULL, 'Inventory Management', 'web', '2024-09-23 13:07:02', '2026-07-16 09:01:05'),
(15, 1, 'Admin', 'web', '2024-09-28 08:21:57', '2024-09-28 08:21:57'),
(16, NULL, 'Product Management', 'web', '2024-10-06 14:28:11', '2026-07-16 09:00:14'),
(17, 1, 'Purchase Management', 'web', '2025-04-27 11:12:01', '2026-07-16 08:59:39'),
(18, 1, 'Sales Management', 'web', '2025-04-27 11:13:05', '2026-07-16 08:57:09'),
(19, NULL, 'HRM & Payroll', 'web', '2026-07-16 09:01:56', '2026-07-16 09:01:56'),
(20, NULL, 'General Accounting', 'web', '2026-07-16 09:02:06', '2026-07-16 09:02:06'),
(21, NULL, 'Business Reports', 'web', '2026-07-16 09:02:20', '2026-07-16 09:02:20'),
(22, NULL, 'Order Management', 'web', '2026-07-16 09:02:29', '2026-07-16 09:02:29'),
(23, NULL, 'Website Management', 'web', '2026-07-16 09:02:39', '2026-07-16 09:02:39'),
(24, NULL, 'Settings', 'web', '2026-07-16 09:39:07', '2026-07-16 09:39:07'),
(25, 1, 'Basic', 'web', '2026-08-15 08:05:50', '2026-08-15 08:05:50'),
(26, 1, 'Advance', 'web', '2026-08-15 08:05:58', '2026-08-15 08:05:58'),
(27, 1, 'Company Admin', 'web', '2026-09-10 08:22:21', '2026-09-10 08:22:21'),
(28, 1, 'dhfjg', 'web', '2026-10-05 04:13:44', '2026-10-05 04:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 10),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(2, 1),
(2, 10),
(2, 15),
(2, 24),
(2, 25),
(2, 26),
(3, 10),
(3, 24),
(3, 25),
(3, 26),
(4, 10),
(4, 24),
(4, 25),
(4, 26),
(5, 1),
(5, 10),
(5, 15),
(5, 24),
(5, 25),
(5, 26),
(6, 1),
(6, 10),
(6, 15),
(6, 24),
(6, 25),
(6, 26),
(7, 10),
(7, 24),
(7, 26),
(8, 10),
(8, 24),
(8, 26),
(9, 10),
(9, 24),
(9, 26),
(10, 10),
(10, 24),
(10, 26),
(11, 10),
(11, 24),
(11, 26),
(12, 10),
(12, 24),
(12, 26),
(14, 10),
(14, 24),
(14, 26),
(15, 10),
(15, 24),
(15, 26),
(16, 10),
(16, 24),
(16, 26),
(17, 10),
(17, 24),
(17, 26),
(18, 10),
(18, 24),
(18, 26),
(19, 10),
(19, 24),
(19, 26),
(20, 1),
(20, 10),
(20, 15),
(20, 16),
(20, 25),
(20, 26),
(21, 10),
(22, 1),
(22, 10),
(22, 15),
(22, 16),
(22, 25),
(22, 26),
(23, 1),
(23, 10),
(23, 15),
(23, 16),
(23, 25),
(23, 26),
(24, 1),
(24, 10),
(24, 15),
(24, 16),
(24, 25),
(24, 26),
(25, 1),
(25, 10),
(25, 15),
(25, 16),
(25, 25),
(25, 26),
(26, 1),
(26, 10),
(26, 15),
(26, 16),
(26, 25),
(26, 26),
(27, 10),
(28, 10),
(29, 10),
(30, 1),
(30, 10),
(30, 15),
(30, 17),
(30, 25),
(30, 26),
(31, 1),
(31, 10),
(31, 15),
(31, 16),
(31, 17),
(31, 25),
(31, 26),
(32, 1),
(32, 10),
(32, 15),
(32, 16),
(32, 17),
(32, 25),
(32, 26),
(33, 1),
(33, 10),
(33, 15),
(33, 16),
(33, 17),
(33, 25),
(33, 26),
(35, 1),
(35, 10),
(35, 15),
(35, 16),
(35, 17),
(35, 25),
(35, 26),
(36, 1),
(36, 10),
(36, 15),
(36, 16),
(36, 17),
(36, 25),
(36, 26),
(37, 1),
(37, 10),
(37, 15),
(37, 16),
(37, 17),
(37, 25),
(37, 26),
(39, 1),
(39, 10),
(39, 15),
(39, 16),
(39, 17),
(39, 25),
(39, 26),
(40, 1),
(40, 10),
(40, 15),
(40, 16),
(40, 17),
(40, 25),
(40, 26),
(41, 1),
(41, 10),
(41, 14),
(41, 15),
(41, 26),
(47, 1),
(47, 10),
(47, 14),
(47, 15),
(47, 16),
(47, 26),
(49, 1),
(49, 10),
(49, 15),
(49, 18),
(49, 25),
(49, 26),
(50, 1),
(50, 10),
(50, 15),
(50, 18),
(50, 25),
(50, 26),
(51, 10),
(52, 1),
(52, 10),
(52, 15),
(52, 16),
(52, 25),
(52, 26),
(53, 10),
(53, 15),
(53, 16),
(53, 25),
(53, 26),
(54, 1),
(54, 10),
(54, 15),
(54, 18),
(54, 25),
(54, 26),
(55, 1),
(55, 10),
(55, 15),
(55, 18),
(55, 25),
(55, 26),
(56, 1),
(56, 10),
(56, 15),
(56, 18),
(56, 25),
(56, 26),
(57, 10),
(58, 1),
(58, 10),
(58, 15),
(58, 18),
(58, 25),
(58, 26),
(59, 1),
(59, 10),
(59, 15),
(59, 18),
(59, 26),
(60, 1),
(60, 10),
(60, 15),
(60, 18),
(60, 25),
(60, 26),
(61, 1),
(61, 10),
(61, 15),
(61, 18),
(61, 25),
(61, 26),
(62, 1),
(62, 10),
(62, 15),
(62, 18),
(62, 25),
(62, 26),
(64, 1),
(64, 10),
(64, 15),
(64, 18),
(64, 25),
(64, 26),
(65, 1),
(65, 10),
(65, 15),
(65, 18),
(65, 25),
(65, 26),
(67, 1),
(67, 10),
(67, 15),
(67, 21),
(67, 25),
(67, 26),
(68, 1),
(68, 10),
(68, 14),
(68, 15),
(68, 16),
(68, 26),
(69, 10),
(70, 1),
(70, 10),
(70, 15),
(70, 21),
(70, 25),
(70, 26),
(71, 1),
(71, 10),
(71, 15),
(71, 21),
(71, 25),
(71, 26),
(72, 1),
(72, 10),
(72, 15),
(72, 21),
(72, 25),
(72, 26),
(73, 1),
(73, 10),
(73, 15),
(73, 21),
(73, 25),
(73, 26),
(74, 1),
(74, 10),
(74, 15),
(74, 21),
(74, 25),
(74, 26),
(76, 10),
(78, 10),
(80, 1),
(80, 10),
(80, 15),
(80, 18),
(80, 26),
(93, 10),
(93, 15),
(93, 16),
(93, 25),
(93, 26),
(94, 10),
(94, 15),
(94, 16),
(94, 25),
(94, 26),
(95, 10),
(95, 15),
(95, 16),
(95, 25),
(95, 26),
(96, 10),
(96, 15),
(96, 16),
(96, 25),
(96, 26),
(97, 10),
(97, 15),
(97, 16),
(97, 25),
(97, 26),
(98, 1),
(98, 10),
(98, 15),
(98, 16),
(98, 25),
(98, 26),
(99, 1),
(99, 10),
(99, 15),
(99, 16),
(99, 25),
(99, 26),
(100, 1),
(100, 10),
(100, 15),
(100, 16),
(100, 25),
(100, 26),
(101, 1),
(101, 10),
(101, 15),
(101, 16),
(101, 25),
(101, 26),
(102, 1),
(102, 10),
(102, 15),
(102, 16),
(102, 25),
(102, 26),
(103, 10),
(104, 10),
(105, 10),
(106, 10),
(107, 10),
(108, 1),
(108, 10),
(108, 15),
(108, 16),
(108, 17),
(108, 25),
(108, 26),
(109, 1),
(109, 10),
(109, 15),
(109, 16),
(109, 17),
(109, 25),
(109, 26),
(110, 1),
(110, 10),
(110, 15),
(110, 16),
(110, 17),
(110, 25),
(110, 26),
(111, 1),
(111, 10),
(111, 15),
(111, 16),
(111, 17),
(111, 25),
(111, 26),
(112, 1),
(112, 10),
(112, 15),
(112, 16),
(112, 17),
(112, 25),
(112, 26),
(113, 1),
(113, 10),
(113, 15),
(113, 16),
(113, 25),
(113, 26),
(114, 1),
(114, 10),
(114, 15),
(114, 16),
(114, 25),
(114, 26),
(115, 1),
(115, 10),
(115, 15),
(115, 16),
(115, 25),
(115, 26),
(116, 1),
(116, 10),
(116, 15),
(116, 16),
(116, 25),
(116, 26),
(117, 1),
(117, 10),
(117, 15),
(117, 16),
(117, 25),
(117, 26),
(118, 1),
(118, 10),
(118, 15),
(118, 16),
(118, 25),
(118, 26),
(119, 1),
(119, 10),
(119, 15),
(119, 16),
(119, 25),
(119, 26),
(120, 1),
(120, 10),
(120, 15),
(120, 16),
(120, 25),
(120, 26),
(121, 1),
(121, 10),
(121, 15),
(121, 16),
(121, 25),
(121, 26),
(122, 1),
(122, 10),
(122, 15),
(122, 16),
(122, 25),
(122, 26),
(123, 1),
(123, 10),
(123, 15),
(123, 16),
(123, 25),
(123, 26),
(124, 1),
(124, 10),
(124, 15),
(124, 16),
(124, 25),
(124, 26),
(125, 1),
(125, 10),
(125, 15),
(125, 16),
(125, 25),
(125, 26),
(126, 1),
(126, 10),
(126, 15),
(126, 16),
(126, 25),
(126, 26),
(127, 1),
(127, 10),
(127, 15),
(127, 16),
(127, 25),
(127, 26),
(128, 1),
(128, 10),
(128, 15),
(128, 24),
(128, 25),
(128, 26),
(129, 1),
(129, 10),
(129, 15),
(129, 24),
(129, 25),
(129, 26),
(130, 1),
(130, 10),
(130, 15),
(130, 24),
(130, 25),
(130, 26),
(131, 1),
(131, 10),
(131, 15),
(131, 24),
(131, 25),
(131, 26),
(132, 1),
(132, 10),
(132, 15),
(132, 24),
(132, 25),
(132, 26),
(133, 1),
(133, 10),
(133, 15),
(133, 24),
(133, 25),
(133, 26),
(134, 1),
(134, 10),
(134, 15),
(134, 24),
(134, 25),
(134, 26),
(135, 1),
(135, 10),
(135, 15),
(135, 24),
(135, 25),
(135, 26),
(136, 1),
(136, 10),
(136, 15),
(136, 24),
(136, 25),
(136, 26),
(137, 1),
(137, 10),
(137, 15),
(137, 24),
(137, 25),
(137, 26),
(138, 10),
(138, 24),
(138, 25),
(138, 26),
(139, 10),
(139, 24),
(139, 25),
(139, 26),
(140, 10),
(140, 24),
(140, 25),
(140, 26),
(141, 10),
(141, 24),
(141, 25),
(141, 26),
(142, 10),
(142, 24),
(142, 25),
(142, 26),
(143, 10),
(143, 24),
(143, 25),
(143, 26),
(144, 10),
(144, 24),
(144, 25),
(144, 26),
(145, 10),
(145, 24),
(145, 25),
(145, 26),
(146, 10),
(146, 24),
(146, 25),
(146, 26),
(147, 10),
(147, 24),
(147, 25),
(147, 26),
(148, 10),
(149, 10),
(150, 10),
(151, 10),
(152, 10),
(153, 1),
(153, 10),
(153, 15),
(153, 18),
(153, 25),
(153, 26),
(154, 1),
(154, 10),
(154, 15),
(154, 18),
(154, 25),
(154, 26),
(155, 1),
(155, 10),
(155, 15),
(155, 18),
(155, 25),
(155, 26),
(156, 1),
(156, 10),
(156, 15),
(156, 18),
(156, 25),
(156, 26),
(157, 1),
(157, 10),
(157, 15),
(157, 18),
(157, 25),
(157, 26),
(158, 1),
(158, 10),
(158, 15),
(158, 16),
(158, 25),
(158, 26),
(159, 1),
(159, 10),
(159, 15),
(159, 16),
(159, 25),
(159, 26),
(160, 1),
(160, 10),
(160, 15),
(160, 16),
(160, 25),
(160, 26),
(161, 1),
(161, 10),
(161, 15),
(161, 16),
(161, 25),
(161, 26),
(162, 1),
(162, 10),
(162, 15),
(162, 16),
(162, 25),
(162, 26),
(163, 10),
(164, 10),
(165, 10),
(166, 10),
(167, 10),
(168, 10),
(169, 10),
(170, 10),
(171, 10),
(172, 10),
(173, 10),
(175, 1),
(175, 10),
(175, 15),
(175, 16),
(175, 17),
(175, 25),
(175, 26),
(176, 1),
(176, 10),
(176, 15),
(176, 16),
(176, 17),
(176, 25),
(176, 26),
(177, 1),
(177, 10),
(177, 15),
(177, 16),
(177, 17),
(177, 25),
(177, 26),
(178, 1),
(178, 10),
(178, 15),
(178, 16),
(178, 17),
(178, 25),
(178, 26),
(179, 1),
(179, 10),
(179, 15),
(179, 16),
(179, 17),
(179, 25),
(179, 26),
(180, 1),
(180, 10),
(180, 15),
(180, 23),
(180, 26),
(181, 1),
(181, 10),
(181, 23),
(181, 26),
(188, 1),
(188, 10),
(188, 23),
(188, 26),
(191, 1),
(191, 10),
(191, 23),
(191, 26),
(192, 1),
(192, 10),
(192, 23),
(192, 26),
(193, 1),
(193, 10),
(193, 23),
(193, 26),
(194, 1),
(194, 10),
(194, 23),
(194, 26),
(195, 1),
(195, 10),
(195, 23),
(195, 26),
(211, 1),
(211, 10),
(211, 23),
(211, 26),
(212, 1),
(212, 10),
(212, 23),
(212, 26),
(213, 1),
(213, 10),
(213, 23),
(213, 26),
(214, 1),
(214, 10),
(214, 23),
(214, 26),
(215, 1),
(215, 10),
(215, 23),
(215, 26),
(226, 1),
(226, 10),
(226, 23),
(226, 26),
(227, 10),
(228, 10),
(229, 10),
(230, 10),
(231, 10),
(232, 10),
(233, 1),
(233, 10),
(233, 15),
(233, 18),
(233, 25),
(233, 26),
(234, 1),
(234, 10),
(234, 15),
(234, 18),
(234, 25),
(234, 26),
(235, 1),
(235, 10),
(235, 15),
(235, 18),
(235, 25),
(235, 26),
(236, 1),
(236, 10),
(236, 15),
(236, 18),
(236, 25),
(236, 26),
(237, 1),
(237, 10),
(237, 15),
(237, 18),
(237, 25),
(237, 26),
(238, 1),
(238, 10),
(238, 15),
(238, 18),
(238, 25),
(238, 26),
(239, 1),
(239, 10),
(239, 15),
(239, 18),
(239, 25),
(239, 26),
(240, 1),
(240, 10),
(240, 15),
(240, 18),
(240, 25),
(240, 26),
(241, 1),
(241, 10),
(241, 15),
(241, 18),
(241, 25),
(241, 26),
(242, 1),
(242, 10),
(242, 15),
(242, 18),
(242, 25),
(242, 26),
(243, 1),
(243, 10),
(243, 15),
(243, 18),
(243, 25),
(243, 26),
(244, 1),
(244, 10),
(244, 15),
(244, 18),
(244, 25),
(244, 26),
(245, 1),
(245, 10),
(245, 15),
(245, 18),
(245, 25),
(245, 26),
(246, 1),
(246, 10),
(246, 15),
(246, 18),
(246, 25),
(246, 26),
(247, 1),
(247, 10),
(247, 15),
(247, 18),
(247, 25),
(247, 26),
(253, 1),
(253, 10),
(253, 15),
(253, 16),
(253, 17),
(253, 25),
(253, 26),
(254, 1),
(254, 10),
(254, 15),
(254, 16),
(254, 17),
(254, 25),
(254, 26),
(255, 1),
(255, 10),
(255, 15),
(255, 16),
(255, 17),
(255, 25),
(255, 26),
(256, 1),
(256, 10),
(256, 15),
(256, 16),
(256, 17),
(256, 25),
(256, 26),
(257, 1),
(257, 10),
(257, 15),
(257, 16),
(257, 17),
(257, 25),
(257, 26),
(266, 1),
(266, 10),
(266, 15),
(266, 18),
(266, 26),
(267, 1),
(267, 10),
(267, 15),
(267, 18),
(267, 26),
(268, 1),
(268, 10),
(268, 15),
(268, 18),
(268, 26),
(269, 10),
(270, 10),
(271, 10),
(272, 10),
(273, 10),
(276, 1),
(276, 10),
(276, 15),
(276, 24),
(276, 25),
(276, 26),
(277, 1),
(277, 10),
(277, 15),
(277, 24),
(277, 25),
(277, 26),
(286, 10),
(287, 10),
(288, 10),
(289, 10),
(290, 10),
(291, 1),
(291, 10),
(291, 15),
(291, 22),
(291, 26),
(292, 10),
(292, 15),
(292, 22),
(292, 26),
(293, 1),
(293, 10),
(293, 15),
(293, 22),
(293, 26),
(294, 1),
(294, 10),
(294, 15),
(294, 22),
(294, 26),
(295, 1),
(295, 10),
(295, 15),
(295, 21),
(295, 25),
(295, 26),
(296, 10),
(299, 10),
(300, 10),
(301, 10),
(302, 10),
(303, 10),
(304, 10),
(305, 10),
(306, 10),
(307, 10),
(308, 10),
(308, 15),
(308, 22),
(308, 26),
(309, 10),
(309, 15),
(309, 22),
(309, 26),
(323, 10),
(324, 10),
(325, 10),
(326, 10),
(327, 10),
(328, 1),
(328, 10),
(328, 15),
(328, 24),
(328, 25),
(328, 26),
(329, 1),
(329, 10),
(329, 15),
(329, 24),
(329, 25),
(329, 26),
(330, 1),
(330, 10),
(330, 15),
(330, 18),
(330, 26),
(331, 1),
(331, 10),
(331, 15),
(331, 18),
(331, 26),
(332, 1),
(332, 10),
(332, 15),
(332, 21),
(332, 25),
(332, 26),
(333, 1),
(333, 10),
(333, 23),
(333, 26),
(334, 1),
(334, 10),
(334, 15),
(334, 20),
(334, 25),
(334, 26),
(335, 1),
(335, 10),
(335, 15),
(335, 20),
(335, 25),
(335, 26),
(336, 1),
(336, 10),
(336, 15),
(336, 20),
(336, 25),
(336, 26),
(337, 1),
(337, 10),
(337, 15),
(337, 20),
(337, 25),
(337, 26),
(338, 1),
(338, 10),
(338, 15),
(338, 20),
(338, 25),
(338, 26),
(339, 1),
(339, 10),
(339, 15),
(339, 20),
(339, 25),
(339, 26),
(340, 1),
(340, 10),
(340, 15),
(340, 20),
(340, 26),
(341, 1),
(341, 10),
(341, 15),
(341, 20),
(341, 26),
(343, 1),
(343, 10),
(343, 15),
(343, 20),
(343, 26),
(344, 1),
(344, 10),
(344, 15),
(344, 20),
(344, 25),
(344, 26),
(345, 1),
(345, 10),
(345, 15),
(345, 20),
(345, 25),
(345, 26),
(346, 1),
(346, 10),
(346, 15),
(346, 20),
(346, 25),
(346, 26),
(347, 1),
(347, 10),
(347, 15),
(347, 20),
(347, 25),
(347, 26),
(348, 1),
(348, 10),
(348, 15),
(348, 20),
(348, 25),
(348, 26),
(349, 1),
(349, 10),
(349, 15),
(349, 20),
(349, 25),
(349, 26),
(350, 1),
(350, 10),
(350, 15),
(350, 20),
(350, 25),
(350, 26),
(351, 1),
(351, 10),
(351, 15),
(351, 20),
(351, 25),
(351, 26),
(352, 1),
(352, 10),
(352, 15),
(352, 20),
(352, 25),
(352, 26),
(353, 1),
(353, 10),
(353, 15),
(353, 20),
(353, 25),
(353, 26),
(354, 1),
(354, 10),
(354, 15),
(354, 20),
(354, 25),
(354, 26),
(355, 1),
(355, 10),
(355, 15),
(355, 20),
(355, 25),
(355, 26),
(356, 1),
(356, 10),
(356, 15),
(356, 20),
(356, 25),
(356, 26),
(357, 1),
(357, 10),
(357, 15),
(357, 20),
(357, 25),
(357, 26),
(358, 1),
(358, 10),
(358, 15),
(358, 20),
(358, 25),
(358, 26),
(359, 1),
(359, 10),
(359, 15),
(359, 20),
(359, 25),
(359, 26),
(360, 1),
(360, 10),
(360, 15),
(360, 20),
(360, 25),
(360, 26),
(361, 1),
(361, 10),
(361, 15),
(361, 20),
(361, 25),
(361, 26),
(362, 1),
(362, 10),
(362, 15),
(362, 20),
(362, 25),
(362, 26),
(363, 1),
(363, 10),
(363, 15),
(363, 20),
(363, 26),
(364, 1),
(364, 10),
(364, 15),
(364, 20),
(364, 26),
(365, 1),
(365, 10),
(365, 15),
(365, 20),
(365, 26),
(366, 1),
(366, 10),
(366, 15),
(366, 20),
(366, 26),
(369, 1),
(369, 10),
(369, 15),
(369, 20),
(369, 26),
(370, 1),
(370, 10),
(370, 15),
(370, 20),
(370, 26),
(371, 1),
(371, 10),
(371, 15),
(371, 20),
(371, 25),
(371, 26),
(372, 1),
(372, 10),
(372, 15),
(372, 20),
(372, 25),
(372, 26),
(373, 1),
(373, 10),
(373, 15),
(373, 20),
(373, 25),
(373, 26),
(374, 1),
(374, 10),
(374, 15),
(374, 20),
(374, 25),
(374, 26),
(375, 1),
(375, 10),
(375, 15),
(375, 20),
(375, 25),
(375, 26),
(376, 1),
(376, 10),
(376, 15),
(376, 20),
(376, 25),
(376, 26),
(377, 1),
(377, 10),
(377, 15),
(377, 20),
(377, 25),
(377, 26),
(378, 1),
(378, 10),
(378, 15),
(378, 20),
(378, 25),
(378, 26),
(379, 1),
(379, 10),
(379, 15),
(379, 20),
(379, 25),
(379, 26),
(380, 1),
(380, 10),
(380, 15),
(380, 20),
(380, 25),
(380, 26),
(381, 1),
(381, 10),
(381, 23),
(381, 26),
(382, 10),
(382, 24),
(382, 25),
(382, 26),
(383, 1),
(383, 10),
(383, 15),
(383, 20),
(383, 25),
(383, 26),
(384, 1),
(384, 10),
(384, 15),
(384, 26),
(392, 1),
(392, 10),
(392, 15),
(392, 21),
(392, 25),
(392, 26),
(393, 10),
(394, 10),
(395, 10),
(396, 10),
(397, 10),
(398, 10),
(399, 10),
(400, 10),
(401, 10),
(402, 10),
(403, 10),
(404, 10),
(425, 1),
(425, 10),
(425, 15),
(425, 18),
(425, 25),
(425, 26),
(426, 10),
(427, 1),
(427, 10),
(427, 23),
(427, 26),
(428, 1),
(428, 10),
(428, 23),
(428, 26),
(429, 1),
(429, 10),
(429, 23),
(429, 26),
(430, 1),
(430, 10),
(430, 23),
(430, 26),
(431, 1),
(431, 10),
(431, 23),
(431, 26),
(432, 1),
(432, 10),
(432, 23),
(432, 26),
(433, 1),
(433, 10),
(433, 23),
(433, 26),
(434, 1),
(434, 10),
(434, 23),
(434, 26),
(435, 1),
(435, 10),
(435, 23),
(435, 26),
(436, 1),
(436, 10),
(436, 23),
(436, 26),
(437, 1),
(437, 10),
(437, 15),
(437, 16),
(437, 25),
(437, 26),
(438, 1),
(438, 10),
(438, 23),
(438, 26),
(439, 1),
(439, 10),
(439, 23),
(439, 26),
(440, 1),
(440, 10),
(440, 23),
(440, 26),
(441, 1),
(441, 10),
(441, 23),
(441, 26),
(442, 1),
(442, 10),
(442, 23),
(442, 26),
(443, 1),
(443, 10),
(443, 23),
(443, 26),
(475, 10),
(485, 10),
(487, 10),
(494, 10),
(517, 10),
(529, 1),
(529, 10),
(529, 15),
(529, 22),
(529, 26),
(530, 1),
(530, 10),
(530, 15),
(530, 22),
(530, 26),
(531, 1),
(531, 10),
(531, 15),
(531, 22),
(531, 26),
(532, 1),
(532, 10),
(532, 15),
(532, 22),
(532, 26),
(533, 10),
(534, 10),
(535, 10),
(536, 10),
(537, 10),
(538, 1),
(538, 10),
(538, 14),
(538, 15),
(538, 22),
(538, 26),
(539, 1),
(539, 10),
(539, 14),
(539, 15),
(539, 22),
(539, 26),
(540, 1),
(540, 10),
(540, 14),
(540, 15),
(540, 16),
(540, 17),
(540, 18),
(540, 19),
(540, 21),
(540, 25),
(540, 26),
(541, 1),
(541, 10),
(541, 14),
(541, 15),
(541, 22),
(541, 26),
(542, 1),
(542, 10),
(542, 14),
(542, 15),
(542, 16),
(542, 17),
(542, 19),
(542, 21),
(542, 25),
(542, 26),
(543, 1),
(543, 10),
(543, 15),
(543, 21),
(543, 25),
(543, 26),
(544, 1),
(544, 10),
(544, 15),
(544, 21),
(544, 25),
(544, 26),
(545, 1),
(545, 10),
(545, 15),
(545, 21),
(545, 25),
(545, 26),
(550, 1),
(550, 10),
(550, 14),
(550, 15),
(550, 22),
(550, 26),
(551, 1),
(551, 10),
(551, 14),
(551, 15),
(551, 22),
(551, 26),
(552, 1),
(552, 10),
(552, 14),
(552, 15),
(552, 22),
(552, 26),
(553, 1),
(553, 10),
(553, 14),
(553, 15),
(553, 22),
(553, 26),
(554, 1),
(554, 10),
(554, 15),
(554, 21),
(554, 25),
(554, 26),
(555, 1),
(555, 10),
(555, 15),
(555, 22),
(555, 26),
(556, 1),
(556, 10),
(556, 14),
(556, 15),
(556, 22),
(556, 26),
(557, 1),
(557, 10),
(557, 14),
(557, 15),
(557, 22),
(557, 26),
(558, 1),
(558, 10),
(558, 15),
(558, 22),
(558, 26),
(559, 1),
(559, 10),
(559, 15),
(559, 22),
(559, 26),
(561, 1),
(561, 10),
(561, 15),
(561, 21),
(561, 25),
(561, 26),
(562, 1),
(562, 10),
(562, 15),
(562, 21),
(562, 25),
(562, 26),
(563, 1),
(563, 10),
(563, 15),
(563, 21),
(563, 25),
(563, 26),
(583, 1),
(583, 10),
(583, 15),
(583, 22),
(583, 26),
(584, 1),
(584, 10),
(584, 15),
(584, 20),
(584, 25),
(584, 26),
(585, 1),
(585, 10),
(585, 15),
(585, 20),
(585, 25),
(585, 26),
(586, 1),
(586, 10),
(586, 15),
(586, 22),
(586, 26),
(587, 1),
(587, 10),
(587, 15),
(587, 22),
(587, 26),
(588, 1),
(588, 10),
(588, 15),
(588, 22),
(588, 26),
(589, 1),
(589, 10),
(589, 15),
(589, 22),
(589, 26),
(590, 1),
(590, 10),
(590, 15),
(590, 22),
(590, 26),
(595, 1),
(595, 10),
(595, 15),
(595, 26),
(596, 1),
(596, 10),
(596, 15),
(596, 18),
(596, 26),
(597, 1),
(597, 10),
(597, 15),
(597, 18),
(597, 26),
(598, 1),
(598, 10),
(598, 15),
(598, 18),
(598, 26),
(599, 1),
(599, 10),
(599, 15),
(599, 18),
(599, 26),
(600, 1),
(600, 10),
(600, 15),
(600, 18),
(600, 26),
(601, 10),
(601, 19),
(601, 21),
(601, 25),
(601, 26),
(602, 10),
(602, 19),
(602, 21),
(602, 25),
(602, 26),
(603, 10),
(603, 19),
(603, 21),
(603, 25),
(603, 26),
(604, 10),
(604, 19),
(604, 21),
(604, 25),
(604, 26),
(605, 10),
(605, 19),
(605, 21),
(605, 25),
(605, 26),
(606, 10),
(606, 19),
(606, 21),
(606, 25),
(606, 26),
(607, 10),
(607, 19),
(607, 21),
(607, 25),
(607, 26),
(608, 10),
(608, 19),
(608, 21),
(608, 25),
(608, 26),
(609, 1),
(609, 10),
(609, 18),
(609, 26),
(610, 10),
(610, 13),
(610, 25),
(610, 26),
(611, 10),
(611, 19),
(611, 25),
(611, 26),
(612, 10),
(612, 13),
(612, 25),
(612, 26),
(613, 10),
(613, 19),
(613, 26),
(614, 10),
(614, 13),
(614, 25),
(614, 26),
(615, 10),
(615, 13),
(615, 25),
(615, 26),
(616, 10),
(616, 13),
(616, 25),
(616, 26),
(620, 10),
(620, 13),
(620, 25),
(620, 26),
(623, 10),
(623, 13),
(623, 25),
(623, 26),
(633, 10),
(633, 13),
(633, 25),
(633, 26),
(634, 10),
(634, 13),
(634, 25),
(634, 26),
(637, 10),
(637, 19),
(637, 26),
(638, 10),
(638, 19),
(638, 26),
(639, 10),
(639, 19),
(639, 26),
(640, 10),
(640, 19),
(640, 26),
(643, 10),
(643, 19),
(643, 26),
(644, 10),
(644, 19),
(644, 26),
(645, 10),
(645, 19),
(645, 26),
(646, 10),
(646, 19),
(646, 26),
(648, 10),
(648, 19),
(648, 26),
(649, 10),
(649, 19),
(649, 26),
(650, 10),
(650, 19),
(650, 26),
(651, 10),
(651, 19),
(651, 26),
(653, 10),
(653, 19),
(653, 26),
(654, 10),
(654, 19),
(654, 25),
(654, 26),
(655, 10),
(655, 19),
(655, 26),
(657, 10),
(657, 19),
(657, 26),
(661, 10),
(661, 19),
(661, 26),
(663, 10),
(663, 19),
(663, 26),
(664, 10),
(664, 19),
(664, 26),
(667, 10),
(667, 13),
(667, 25),
(667, 26),
(668, 10),
(668, 13),
(668, 25),
(668, 26),
(669, 10),
(669, 25),
(669, 26),
(670, 10),
(670, 25),
(670, 26),
(671, 10),
(671, 25),
(671, 26),
(672, 10),
(672, 25),
(672, 26),
(673, 10),
(673, 25),
(673, 26),
(674, 10),
(674, 25),
(674, 26),
(675, 10),
(675, 25),
(675, 26),
(676, 10),
(676, 25),
(676, 26),
(677, 10),
(677, 25),
(677, 26),
(678, 10),
(678, 25),
(678, 26),
(679, 10),
(679, 25),
(679, 26),
(680, 10),
(680, 25),
(680, 26),
(681, 10),
(681, 25),
(681, 26),
(683, 10),
(683, 25),
(683, 26),
(684, 10),
(684, 25),
(684, 26),
(685, 10),
(685, 25),
(685, 26),
(686, 10),
(686, 26),
(687, 10),
(687, 26),
(688, 10),
(688, 26),
(690, 10),
(690, 26),
(691, 10),
(691, 26),
(692, 10),
(692, 26),
(693, 10),
(693, 26),
(694, 10),
(694, 26),
(695, 10),
(695, 26),
(696, 10),
(696, 26),
(697, 10),
(697, 26),
(698, 10),
(698, 26),
(699, 10),
(699, 26),
(700, 10),
(700, 26),
(701, 10),
(701, 26),
(702, 10),
(702, 26),
(703, 10),
(703, 26),
(704, 10),
(704, 25),
(704, 26),
(705, 10),
(705, 25),
(705, 26),
(706, 10),
(706, 26),
(707, 10),
(707, 26),
(710, 10),
(710, 26),
(711, 10),
(711, 26),
(712, 10),
(712, 26),
(713, 10),
(713, 26),
(714, 10);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `sales_type` varchar(255) NOT NULL,
  `total_amount` decimal(16,2) NOT NULL,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_paid` decimal(16,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `company_id`, `product_type`, `store_id`, `client_id`, `coa_setup_id`, `invoice`, `date`, `sales_type`, `total_amount`, `discount`, `total_paid`, `status`, `staff_id`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', 2, 3033, NULL, 'STS2607000001', '2026-07-13', 'credit', 33.00, 3.00, 0.00, 1, 60, 1, NULL, NULL, NULL, '2026-07-13 08:42:31', '2026-07-13 08:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `sales_lists`
--

CREATE TABLE `sales_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` decimal(16,2) NOT NULL,
  `qty` decimal(16,2) NOT NULL,
  `returned_qty` decimal(16,2) NOT NULL DEFAULT 0.00,
  `returned_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `amount` decimal(16,2) NOT NULL,
  `is_return` tinyint(4) NOT NULL DEFAULT 0,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_lists`
--

INSERT INTO `sales_lists` (`id`, `company_id`, `product_type`, `sales_id`, `store_id`, `client_id`, `product_id`, `variant_id`, `order_product_id`, `rate`, `qty`, `returned_qty`, `returned_amount`, `discount`, `amount`, `is_return`, `delivery_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', 1, 2, 3033, 1, NULL, NULL, 33.00, 1.00, 0.00, 0.00, 3.00, 33.00, 0, 'Pending', '2026-07-13 08:42:31', '2026-07-13 08:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `sales_product_data`
--

CREATE TABLE `sales_product_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reject` tinyint(4) NOT NULL DEFAULT 0,
  `reject_by` bigint(20) UNSIGNED DEFAULT NULL,
  `accounts_approve` tinyint(4) NOT NULL DEFAULT 0,
  `accounts_approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `collection_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_lists`
--

CREATE TABLE `sales_return_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `sales_return_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sales_list_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `qty` decimal(16,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `sales_discount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `primary_mobile` varchar(255) DEFAULT NULL,
  `secondary_mobile` varchar(255) DEFAULT NULL,
  `primary_email` varchar(255) DEFAULT NULL,
  `secondary_email` varchar(255) DEFAULT NULL,
  `office_time` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image` text DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `favicon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `facebook_page` varchar(255) DEFAULT NULL,
  `facebook_group` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `banner_one` varchar(255) DEFAULT NULL,
  `banner_one_link` varchar(255) DEFAULT NULL,
  `banner_two` varchar(255) DEFAULT NULL,
  `banner_two_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `title`, `primary_mobile`, `secondary_mobile`, `primary_email`, `secondary_email`, `office_time`, `address`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `meta_image`, `google_map`, `favicon`, `logo`, `footer_logo`, `placeholder`, `facebook_page`, `facebook_group`, `youtube`, `twitter`, `linkedin`, `google`, `whatsapp`, `instagram`, `pinterest`, `banner_one`, `banner_one_link`, `banner_two`, `banner_two_link`, `created_at`, `updated_at`) VALUES
(1, 'SM Group BD | Sparkling Engineering Solution | Grison Power Engineering. | MSI Corporation International', 'SM Group BD | Sparkling Engineering Solution | Grison Power Engineering. | MSI Corporation International', '01775-882040', '01625-286825', 'info@smgroupbangladesh.com', 'hr@smgroupbangladesh.com', NULL, 'House #10 Road-4, Shenpara, Parbota Mirpur-10, Dhaka-1216.', 'Electrical power equipment, engineering and services for industry, utilities and commercial projects across Bangladesh.', NULL, '01775-882040', 'Our Sister Concern of SM Group Bangladesh: \r\nSparkling Engineering Solution.\r\nGrison Power Engineering.\r\nMSI Corporation International.\r\nGrison Power Engineering – GPE was established in the year 2020 as Supplier &\r\nconstructors with an aim to serve the nation professionally in the fields of Civil,\r\nElectrical, Mechanical and LPG Engineering. Over the years we have completed\r\nnumerous Commercial & Industrial Projects of National Importance.', 'media/default//2026-11-03-aTFDtiqJ0SdTFKFZxJ47rW4wCPQr9iC3ehjajAEE.webp', NULL, 'media/default//2026-11-03-1MthSqOB1Gk9NswWzGxS7IU7eG72PMKRigpBKqGE.webp', 'media/default//2026-11-03-Ofdg1bz6KiCT5O8siDxCZHxxeuyfnzLWPYjUZw2B.webp', 'media/default//2026-11-03-weOoB7bkfIjt8DsXqEG8QrsBeVmxHO075hrwnfkW.webp', 'media/default//2026-11-03-VErgQ2dRjFJJZvNz5JXQbmsxRoUGklETjHeyNlrV.webp', 'aikhane fb link diben', NULL, 'aikhane youtube link diben', '#', 'aikhane linkedin link diben', '#', '#', NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-08 16:05:10', '2026-11-03 10:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_type` varchar(255) NOT NULL DEFAULT 'home',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `upozila_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `user_id`, `address_type`, `name`, `email`, `phone`, `street`, `address`, `division_id`, `district_id`, `upozila_id`, `created_at`, `updated_at`) VALUES
(1, 163, 'home', 'hiui', 'shahadat80@gmail.com', '01757839516', 'Kechuatoil, Kharkhari', 'Kechuatoil, Kharkhari, Dhamrai , Dhaka, Dhaka', 13, 45, 370, '2025-06-03 10:04:52', '2025-06-03 10:04:52'),
(2, 164, 'home', 'Topsy Roy Rakhi', 'topsyroy9@gmail.com', '01551815359', '23 No. Larmini Street, Flat- F2, Navana Celestial, Wari, Dhaka-1203', '23 No. Larmini Street, Flat- F2, Navana Celestial, Wari, Dhaka-1203, Dhaka City Corporation Area, Dhaka, Dhaka', 13, 45, 372, '2025-09-02 12:39:29', '2025-09-02 12:39:29'),
(3, 166, 'home', 'Afsana Begum', 'ukhasn@yahoo.com', '01819083337', 'Apartment A5,House 345, road 12 block D, Bashundhara r/a', 'Apartment A5,House 345, road 12 block D, Bashundhara r/a, Dhaka City Corporation Area, Dhaka, Dhaka', 13, 45, 372, '2026-01-16 13:27:05', '2026-01-16 13:27:05'),
(4, 167, 'office', 'Shawon islam', 'rs6520375@gmail.com', '01989098064', 'Chandra baroipara, club math', 'Chandra baroipara, club math, Kaliakair , Gazipur, Dhaka', 13, 47, 386, '2026-01-22 16:50:50', '2026-01-22 16:50:50'),
(5, 168, 'home', 'Fahad Ahmed', 'aheedulislamfahad@gmail.com', '01300016724', 'Inside Rahattarpul, 18 Number ward, East Bakalia Depoti Road Majer Rasta Chattogram', 'Inside Rahattarpul, 18 Number ward, East Bakalia Depoti Road Majer Rasta Chattogram, Chandgaon Thana, Chittagong, Chittagong', 20, 37, 303, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(6, 169, 'home', 'Abdullah Mahin', 'nmdloverboy12345@gmail.com', '01634191548', 'Tower madrasa Paler bazar daudkandi Cumilla', 'Tower madrasa Paler bazar daudkandi Cumilla, Daudkandi , Comilla, Chittagong', 20, 38, 313, '2026-04-04 06:48:00', '2026-04-04 06:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `showcase_items`
--

CREATE TABLE `showcase_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `serial` bigint(20) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `show_btn` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `heading`, `title`, `image`, `show_btn`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Solar power business.', 'Sparkling Engineering Solution', 'media/slider//2026-11-04-sQHG0rvLZM2jhhkgG25kDqipCnUUbpN2klxjcOGy.webp', 1, 1, '2023-12-30 18:33:26', '2026-11-04 10:53:52'),
(11, 'Electrical, civil and mechanical supplier and installation contractors.', 'Grison Power Engineering', 'media/slider//2026-11-04-t9iQ7gKqKwnxdwT8sNcFg8OhS9A0We99rpLmKrBL.webp', 1, 1, '2024-07-07 11:39:40', '2026-11-04 10:54:23'),
(12, 'Real estate business.', 'MSI Corporation International', 'media/slider//2026-11-04-ZCJe6NsgM6nIflUL2HINek1b4YCDegHe5Bp05pXX.webp', 1, 1, '2026-11-04 06:36:32', '2026-11-04 10:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `social_works`
--

CREATE TABLE `social_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `serial` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_food_items`
--

CREATE TABLE `special_food_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `serial` bigint(20) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `ac_no` varchar(255) DEFAULT NULL,
  `ac_branch` varchar(255) DEFAULT NULL,
  `basic_salary` double DEFAULT 0,
  `house_rent` double DEFAULT 0,
  `medical_allowance` double DEFAULT 0,
  `others` double DEFAULT 0,
  `deducted` double DEFAULT 0,
  `increment_percent` double DEFAULT 0,
  `increment_amount` double DEFAULT 0,
  `total_salary` double DEFAULT 0,
  `leave_balance` double DEFAULT 0,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `company_id`, `branch_id`, `code`, `name`, `short_name`, `designation`, `phone`, `address`, `email`, `national_id`, `joining_date`, `ac_no`, `ac_branch`, `basic_salary`, `house_rent`, `medical_allowance`, `others`, `deducted`, `increment_percent`, `increment_amount`, `total_salary`, `leave_balance`, `type`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(52, 1, 1, '10013', 'Office Sale', 'Office Sale', NULL, '017', NULL, NULL, NULL, '2024-02-03', NULL, NULL, 55555, 5555, 55, 55, NULL, NULL, NULL, 6666, 0, 'sales', 1, 2, 2, 1, '2025-04-28 09:53:34', '2024-02-03 11:09:05', '2025-04-28 09:53:34'),
(59, 1, 1, 'Shimul', 'Shimul', 'Shimul', 'Sr. HR', '01303740757', '316/2, Rampura Dhaka', 'nijer.bazar@gmail.com', '333333333333333333333', '2025-04-28', 'AC#34334444432', 'Rampura', 5555, 5555, 555, 55, NULL, NULL, NULL, 77777, 0, 'general', 1, 1, 1, NULL, NULL, '2025-04-28 08:36:01', '2026-10-11 05:43:48'),
(60, 1, 1, 'Arnob Sur', 'Arnob Sur', 'Arnob Sur', NULL, NULL, NULL, NULL, NULL, '2025-04-28', NULL, NULL, 44444, 555, 555, 55, NULL, NULL, 0, 8888, 3, 'sales', 1, 1, 1, NULL, NULL, '2025-04-28 08:36:32', '2026-08-04 03:29:48'),
(61, 1, 1, 'C100', 'Shamol', 'Shamol', 'Sales Office', NULL, NULL, NULL, NULL, '2025-04-28', NULL, NULL, 33333, 555, 55, 55, NULL, NULL, NULL, 88888, 0, 'sales', 1, 1, 2, NULL, NULL, '2025-04-28 11:31:36', '2025-06-16 13:33:37'),
(62, 1, 1, 'Dipu', 'Dipu', 'Dipu', NULL, NULL, NULL, NULL, NULL, '2025-05-10', NULL, NULL, 44444, 5555, 555, 55, NULL, NULL, NULL, 88888, 0, 'sales', 1, 159, NULL, NULL, NULL, '2025-05-10 12:24:46', '2025-05-10 12:24:46'),
(63, 1, 1, 'digt233', 'Mozammel', 'Mozammel', 'DME', '01303740757', '316/2, Rampura Dhaka', 'nijer.bazar@gmail.com', NULL, '2026-05-01', 'AC#34334444432', 'Rampura', 10000, 5000, 3000, 2000, NULL, NULL, 0, 20000, 0, 'digital', 1, 1, NULL, NULL, NULL, '2026-07-28 05:24:07', '2026-07-28 05:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `static_site_items`
--

CREATE TABLE `static_site_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `testimonial_title` varchar(255) NOT NULL,
  `details_video_url` varchar(255) DEFAULT NULL,
  `products_title` varchar(255) NOT NULL,
  `header_bg_image` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `welcome_image` varchar(255) NOT NULL,
  `testimonial_image` varchar(255) NOT NULL,
  `x_separator_image` varchar(255) NOT NULL,
  `y_separator_image` varchar(255) NOT NULL,
  `shop_button_link` varchar(255) DEFAULT NULL,
  `contact_button_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `type` enum('in','out','reserve','release') NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `date`, `store_id`, `product_id`, `qty`, `unit_price`, `type`, `reference`, `note`, `created_at`, `updated_at`) VALUES
(1, '2026-05-07', 2, 1, 10.00, 33.00, 'in', 'Purchase #STL2605000001', 'Stock increased from purchase', '2026-05-07 09:50:05', '2026-05-07 09:50:05'),
(2, '2026-05-13', 2, 1, 2.00, 33.00, 'out', 'Retail Sale #RS26050001', 'Stock decreased due to retail sale', '2026-05-13 05:16:41', '2026-05-13 05:16:41'),
(3, '2026-05-13', 2, 1, 2.00, 33.00, 'in', 'Retail Return #RR26050001', 'Stock increased due to retail return', '2026-05-13 05:42:12', '2026-05-13 05:42:12'),
(4, '2026-07-07', 2, 1, 1.00, 33.00, 'out', 'Retail Sale #RS26070001', 'Stock decreased due to retail sale', '2026-07-07 10:15:58', '2026-07-07 10:15:58'),
(5, '2026-07-07', 2, 1, 100.00, 33.00, 'in', 'Purchase #STL2607000001', 'Stock increased from purchase', '2026-07-07 10:16:51', '2026-07-07 10:16:51'),
(6, '2026-07-13', 2, 1, 1.00, 33.00, 'out', 'Retail Sale #RS26070002', 'Stock decreased due to retail sale', '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(7, '2026-07-13', 2, 1, 1.00, 33.00, 'out', 'Retail Sale #RS26070002', 'Stock decreased due to retail sale', '2026-07-13 08:26:24', '2026-07-13 08:26:24'),
(8, '2026-07-27', 2, 3, 100.00, 50.00, 'in', 'Purchase #STL2607000002', 'Stock increased from purchase', '2026-07-27 04:28:41', '2026-07-27 04:28:41'),
(9, '2026-09-06', 2, 1, 5.00, 33.00, 'out', 'Retail Sale #RS26090001', 'Stock decreased due to retail sale', '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(10, '2026-09-06', 2, 3, 5.00, 100.00, 'out', 'Retail Sale #RS26090001', 'Stock decreased due to retail sale', '2026-09-06 11:39:53', '2026-09-06 11:39:53'),
(11, '2026-09-10', 2, 5, 5.00, 1005.00, 'in', 'Purchase #STL2609000001', 'Stock increased from purchase', '2026-09-10 10:59:37', '2026-09-10 10:59:37'),
(12, '2026-09-10', 2, 6, 5.00, 712.00, 'in', 'Purchase #STL2609000002', 'Stock increased from purchase', '2026-09-10 11:00:19', '2026-09-10 11:00:19'),
(13, '2026-09-10', 2, 6, 1.00, 1095.00, 'out', 'Retail Sale #RS26090002', 'Stock decreased due to retail sale', '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(14, '2026-09-10', 2, 5, 1.00, 1595.00, 'out', 'Retail Sale #RS26090002', 'Stock decreased due to retail sale', '2026-09-10 11:05:44', '2026-09-10 11:05:44'),
(15, '2026-09-14', 2, 1, 100.00, 33.00, 'in', 'Purchase #STL2609000003', 'Stock increased from purchase', '2026-09-14 00:31:52', '2026-09-14 00:31:52'),
(16, '2026-09-14', 2, 2, 100.00, 50.00, 'in', 'Purchase #STL2609000004', 'Stock increased from purchase', '2026-09-14 00:34:32', '2026-09-14 00:34:32'),
(17, '2026-09-14', 2, 1, 11.00, 33.00, 'out', 'Retail Sale #RS26090003', 'Stock decreased due to retail sale', '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(18, '2026-09-14', 2, 3, 1.00, 100.00, 'out', 'Retail Sale #RS26090003', 'Stock decreased due to retail sale', '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(19, '2026-09-14', 2, 2, 1.00, 77.00, 'out', 'Retail Sale #RS26090003', 'Stock decreased due to retail sale', '2026-09-14 01:01:20', '2026-09-14 01:01:20'),
(20, '2026-09-14', 2, 6, 2560.00, 712.00, 'in', 'Purchase #STL2609000005', 'Stock increased from purchase', '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(21, '2026-09-14', 2, 3, 2560.00, 50.00, 'in', 'Purchase #STL2609000005', 'Stock increased from purchase', '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(22, '2026-09-14', 2, 2, 2560.00, 44.00, 'in', 'Purchase #STL2609000005', 'Stock increased from purchase', '2026-09-14 07:29:30', '2026-09-14 07:29:30'),
(23, '2026-09-17', 2, 3, 5.00, 50.00, 'in', 'Purchase #STL2609000006', 'Stock increased from purchase', '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(24, '2026-09-17', 2, 2, 5.00, 44.00, 'in', 'Purchase #STL2609000006', 'Stock increased from purchase', '2026-09-17 06:20:50', '2026-09-17 06:20:50'),
(25, '2026-09-21', 2, 6, 100.00, 712.00, 'in', 'Purchase #STL2609000007', 'Stock increased from purchase', '2026-09-21 06:54:43', '2026-09-21 06:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `company_id`, `branch_id`, `code`, `type`, `name`, `address`, `remarks`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'HQ', 'Product Stock', 'Shankhari Bazar', 'Dhaka', 'Dry Store', 1, 1, 2, NULL, NULL, '2023-10-24 09:26:05', '2025-04-27 10:55:02'),
(11, 1, 1, 'Uttara', 'Product Stock', 'Uttara Store', 'Uttara', 'remarks', 0, 2, 2, 2, '2025-04-27 10:54:10', '2024-09-11 04:24:16', '2025-04-27 10:54:10'),
(12, 1, 1, '03', 'Product Stock', 'Mirpur - Gabtoli', 'Mirpur', 'ddd', 0, 2, 2, 2, '2025-04-27 10:54:14', '2024-09-23 10:23:08', '2025-04-27 10:54:14'),
(13, 1, 1, '3', 'Product Stock', 'Jatrabari', 'Jatrabari', 'Jatrabari', 0, 2, 2, 2, '2025-04-27 10:54:18', '2024-10-02 09:57:00', '2025-04-27 10:54:18'),
(14, 1, 1, '4', 'Product Stock', 'Old Dhaka', 'Old Dhaka', 'Old Dhaka', 0, 2, 2, 2, '2025-04-27 10:54:22', '2024-10-02 09:58:30', '2025-04-27 10:54:22'),
(15, 1, 1, '5', 'Product Stock', 'Dhonmondi Mohammodpur', 'Dhonmondi', 'Dhonmondi', 0, 2, 2, 2, '2025-04-27 10:54:26', '2024-10-02 10:00:20', '2025-04-27 10:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `store_areas`
--

CREATE TABLE `store_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_areas`
--

INSERT INTO `store_areas` (`id`, `store_id`, `area_id`, `created_at`, `updated_at`) VALUES
(8, 11, 33, '2024-09-23 10:19:34', '2024-09-23 10:19:34'),
(9, 11, 32, '2024-09-23 10:19:34', '2024-09-23 10:19:34'),
(70, 13, 63, '2024-10-02 10:12:17', '2024-10-02 10:12:17'),
(71, 13, 61, '2024-10-02 10:12:17', '2024-10-02 10:12:17'),
(72, 13, 64, '2024-10-02 10:12:17', '2024-10-02 10:12:17'),
(73, 13, 60, '2024-10-02 10:12:17', '2024-10-02 10:12:17'),
(74, 13, 62, '2024-10-02 10:12:17', '2024-10-02 10:12:17'),
(81, 12, 45, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(82, 12, 55, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(83, 12, 46, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(84, 12, 47, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(85, 12, 54, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(86, 12, 48, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(87, 12, 49, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(88, 12, 50, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(89, 12, 51, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(90, 12, 52, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(91, 12, 53, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(92, 12, 39, '2024-10-02 13:03:04', '2024-10-02 13:03:04'),
(93, 15, 36, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(94, 15, 37, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(95, 15, 42, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(96, 15, 41, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(97, 15, 40, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(98, 15, 38, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(99, 15, 43, '2024-10-02 13:03:56', '2024-10-02 13:03:56'),
(100, 14, 66, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(101, 14, 56, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(102, 14, 65, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(103, 14, 59, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(104, 14, 29, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(105, 14, 57, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(106, 14, 27, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(107, 14, 58, '2024-10-02 13:04:45', '2024-10-02 13:04:45'),
(120, 2, 20, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(121, 2, 31, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(122, 2, 25, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(123, 2, 18, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(124, 2, 26, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(125, 2, 22, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(126, 2, 23, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(127, 2, 24, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(128, 2, 28, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(129, 2, 19, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(130, 2, 21, '2025-04-27 10:55:02', '2025-04-27 10:55:02'),
(131, 2, 30, '2025-04-27 10:55:02', '2025-04-27 10:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '0184468980@dipok', NULL, NULL, '2025-05-04 21:58:59', '2025-05-04 21:58:59'),
(2, 'akhizhillick@gmail.com', NULL, NULL, '2025-05-29 11:38:02', '2025-05-29 11:38:02'),
(3, 'pandabsarker10@gmail.com', NULL, NULL, '2025-05-30 18:19:23', '2025-05-30 18:19:23'),
(4, 'ajoydatta20011@gmail.com', NULL, NULL, '2025-06-05 09:13:54', '2025-06-05 09:13:54'),
(5, 'suma72196@gmail.com', NULL, NULL, '2025-08-09 07:30:50', '2025-08-09 07:30:50'),
(6, 'aslam.sujoy@gmail.co', NULL, NULL, '2025-08-09 07:32:33', '2025-08-09 07:32:33'),
(7, 'aslam.sujoy@gmail.com', NULL, NULL, '2025-08-09 09:51:00', '2025-08-09 09:51:00'),
(8, 'sonjoy99000@gmail.com', NULL, NULL, '2025-10-30 11:46:07', '2025-10-30 11:46:07'),
(9, 'iqtnlgtk@testform.xyz', NULL, NULL, '2025-11-16 21:22:04', '2025-11-16 21:22:04'),
(10, 'goksxzpz@testform.xyz', NULL, NULL, '2025-11-16 21:22:07', '2025-11-16 21:22:07'),
(11, 'jwvjodws@testform.xyz', NULL, NULL, '2025-11-16 21:22:07', '2025-11-16 21:22:07'),
(12, 'tznmymtj@testform.xyz', NULL, NULL, '2025-12-29 22:55:09', '2025-12-29 22:55:09'),
(13, 'muirixld@testform.xyz', NULL, NULL, '2025-12-29 22:58:10', '2025-12-29 22:58:10'),
(14, 'quieurjq@checkyourform.xyz', NULL, NULL, '2026-02-01 00:53:36', '2026-02-01 00:53:36'),
(15, 'wuenmdef@checkyourform.xyz', NULL, NULL, '2026-02-01 00:54:00', '2026-02-01 00:54:00'),
(16, 'nmdloverboy12345@gmail.com', NULL, NULL, '2026-04-04 06:54:15', '2026-04-04 06:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `territories`
--

CREATE TABLE `territories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `incharge_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `territories`
--

INSERT INTO `territories` (`id`, `company_id`, `area_id`, `code`, `name`, `incharge_name`, `phone`, `email`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(57, 1, 17, 'PF', 'Territory One', NULL, NULL, NULL, NULL, 1, 1, NULL, 2, '2024-09-08 07:16:59', '2024-07-13 12:44:50', '2024-09-08 07:16:59'),
(58, 1, 19, 'T', 'Jamtola', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2024-10-13 17:25:31', '2026-07-13 08:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` text NOT NULL,
  `short_description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `serial` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `transfer_no` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `host_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reject` tinyint(4) NOT NULL DEFAULT 0,
  `reject_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_products`
--

CREATE TABLE `transfer_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'Consumer',
  `transfer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` decimal(16,2) NOT NULL,
  `is_back` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `area_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `branch_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `store_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_staff` tinyint(4) NOT NULL DEFAULT 0,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `otp_expire` datetime NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `company_id`, `name`, `user_name`, `email`, `phone`, `address`, `image`, `cover_image`, `area_id`, `branch_id`, `store_id`, `status`, `is_staff`, `staff_id`, `email_verified_at`, `otp`, `otp_expire`, `password`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, 'backend/images/avatar/profile-Rs9vTSsramG8gz5VkSru5dOnBS6LrKURVH0Imo1U.jpg', 'backend/images/avatar/cover-rQ6njzwB14WniZM5k17ASTLX7wB66R2spVUy7der.png', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2023-11-24 11:04:22', '$2a$12$yxZO/Kv/5ANCuMMA/QJD2eVwPNj9BSyDwdTJCdzVpedljgS8qGi0e', NULL, NULL, 1, NULL, NULL, '2023-10-24 06:03:09', '2026-11-03 09:06:39'),
(2, 1, 1, 'Shimul', 'Shimul', 'info@sahebbazaar.com', '01715227149', 'Rampura, Dhaka', 'backend/images/avatar/profile-DL2pMk5cc2COZI24cXBoVdmIAS5iCGVvscnsT6At.webp', 'backend/images/avatar/cover-6yCWR2Fx8T4X6b5jNClMz71AvciWD9qG3FjtgioE.jpg', NULL, '[\"1\"]', '[\"2\"]', 1, 1, 59, NULL, NULL, '2023-11-24 11:04:22', '$2y$10$7frEMDiVrrXW0r9mnLIkren/K4HaSlwVlR3B3dqaKqiDBY5kJt.bW', NULL, 1, 159, NULL, NULL, '2023-09-23 06:52:33', '2026-04-08 11:33:50'),
(159, 1, 1, 'Arnob Sur', 'Arnob', 'arnabsurarnabsur@gmail.com', '01567963270', '63 Shankhari bazar, Dhaka-1100', 'backend/images/avatar/profile-2KHPX9ecY62gPTtVTwTF1ZrTGvZWi7BEjn1bpSf3.webp', NULL, NULL, '[\"1\"]', '[\"2\"]', 1, 1, 60, NULL, NULL, '2025-04-27 19:04:41', '$2y$10$wo8dUR0ZfHjU.GC72.r75uBZgdXZao5ZTGO6dcNacXgGl.MeRU2GC', NULL, 2, 2, NULL, NULL, '2025-04-27 13:04:41', '2026-04-08 11:40:36'),
(160, 1, 1, 'Shamol Sen', 'Shamol', NULL, NULL, NULL, NULL, NULL, NULL, '[\"1\"]', '[\"2\"]', 1, 1, 61, NULL, NULL, '2025-04-28 17:53:20', '$2y$10$iX9c44WlIupd9VWRUIMMa.K78FdfGEqfrhg70oqPuqG.RO8QA1C1C', NULL, 1, 2, NULL, NULL, '2025-04-28 11:53:20', '2025-06-18 06:17:54'),
(161, 1, 1, 'Dipu Sur', 'Dipu', NULL, '01765213120', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 62, NULL, NULL, '2025-05-10 18:23:23', '$2y$10$s5O9i67JMB5iMTcUq/QrO.iyGGiEVchO1ct3Hq6rF066qr9Rj7nda', NULL, 159, 159, NULL, NULL, '2025-05-10 12:23:23', '2025-05-25 09:02:29'),
(163, 0, NULL, 'hiui', NULL, 'shahadat80@gmail.com', '01757839516', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2025-06-03 16:04:52', '$2y$10$kcMWuE/GLuJyIJU/QSzDAezYajCzmRxs0zK.3.qxSnLJejqqzyCLe', NULL, NULL, NULL, NULL, NULL, '2025-06-03 10:04:52', '2025-06-03 10:04:52'),
(164, 0, NULL, 'Topsy Roy Rakhi', NULL, 'topsyroy9@gmail.com', '01551815359', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2025-09-02 18:39:29', '$2y$10$F/wPLaLPEksnir8PbBccUOMlN/QdcVzS289uZsgqqAHHai61R7Qa2', NULL, NULL, NULL, NULL, NULL, '2025-09-02 12:39:29', '2025-09-02 12:39:29'),
(166, 0, NULL, 'Afsana Begum', NULL, 'ukhasn@yahoo.com', '01819083337', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-01-16 19:27:05', '$2y$10$Oqw2bJ6kSsm9fnCxQeEe8OlvkzNT81dW.kgVCFZzImxL9yxGquqjW', NULL, NULL, NULL, NULL, NULL, '2026-01-16 13:27:05', '2026-01-16 13:27:05'),
(167, 0, NULL, 'Shawon islam', NULL, 'rs6520375@gmail.com', '01989098064', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-01-22 22:50:50', '$2y$10$nP7nKvIU/7/XP5A7PzA9WObMe4CKrrU1dqQxEBf8b72fG26rAFwNa', NULL, NULL, NULL, NULL, NULL, '2026-01-22 16:50:50', '2026-01-22 16:50:50'),
(168, 0, NULL, 'Fahad Ahmed', NULL, 'aheedulislamfahad@gmail.com', '01300016724', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-02-22 03:25:37', '$2y$10$bhq5qqDv4kAl2AVTojZ6r.W4GTueb9DpSKMobQWIUJNiSNR8ZEpiW', NULL, NULL, NULL, NULL, NULL, '2026-02-21 21:25:37', '2026-02-21 21:25:37'),
(169, 0, NULL, 'Abdullah Mahin', NULL, 'nmdloverboy12345@gmail.com', '01634191548', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-04-04 12:48:00', '$2y$10$.E84o5M2kpLjworo8XmtZ./lqeKTJGHeQ8WY.uNIQVNh8kYW7Fun2', NULL, NULL, NULL, NULL, NULL, '2026-04-04 06:48:00', '2026-04-04 06:48:00'),
(170, 2, 1, 'Wali', '01921588521', NULL, '01921588521', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-13 14:39:39', '$2y$10$PwhCUYA75Rw49JKVY4IhzemBDQByvJkOse7Cow382.9wRrtOtF3/q', NULL, 1, NULL, NULL, NULL, '2026-07-13 08:39:39', '2026-07-13 08:39:39'),
(171, 1, 1, 'sales', 'sales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:18:09', '$2y$10$q/NixzyfsV7D0SNAvyzVw.TtdBe7pfNQeSU.dycl7o9g7Ah0ns5b6', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:18:09', '2026-07-16 09:18:09'),
(172, 1, 1, 'inventory', 'inventory', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:20:05', '$2y$10$LgGG3ac/dqNGvFZ39rM.LeenFqoC.rf4X8Boe2Ecbj2SVjdko4YKK', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:20:05', '2026-07-16 09:20:05'),
(173, 1, 1, 'accounts', 'accounts', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:21:25', '$2y$10$k9JiOyYn5aM2fwhKj4VXv.UrxdUEFd6jCEH9Mp7AeyOKfIcFWhnC.', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:21:25', '2026-07-16 09:21:25'),
(174, 1, 1, 'hrm', 'hrm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:24:02', '$2y$10$BZhTqlKw8CSd8q0RJ3Ju2e5BD8Bwb7Esr5w4TU84SOjvwENG6IRuO', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:24:02', '2026-07-16 09:24:02'),
(175, 1, 1, 'crm', 'crm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:24:32', '$2y$10$9VeREAmvtgqbzpjc9s.e9ODRgjNDWNlXAfFyxw3nT1lmDmTSHqzPe', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:24:32', '2026-07-16 09:24:32'),
(176, 1, 1, 'purchase', 'purchase', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:24:57', '$2y$10$CJuQqSox1heneBmfB6dOqeVwqrt/t8MC92Pt.j8YQAnISnfydhvsK', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:24:57', '2026-07-16 09:24:57'),
(177, 1, 1, 'production', 'production', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:25:42', '$2y$10$.taQ2QXLO5Keo.lPbo5M0.SNkvN5g/WGLSx3VK4vZjwrVbdYNwBse', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:25:42', '2026-07-16 09:25:42'),
(178, 1, 1, 'website', 'website', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:45:55', '$2y$10$Fc3gXSWGAJHM490VhJhW1eOJ54YMgJC8dAP6KMIWM87GKPlplCbT2', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:45:55', '2026-07-16 09:45:55'),
(179, 1, 1, 'orders', 'orders', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:46:19', '$2y$10$E02dzM6NrKTI5Af3Zm9oa.hVjH7wXfFakyB2KvvplumqzPaTfCpf.', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:46:19', '2026-07-16 09:46:19'),
(180, 1, 1, 'reports', 'reports', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:46:55', '$2y$10$K5f9OVrMh0yZsOKDucwxJ.orWGPA0L6tiAZxTWeISnzfDhvtG98qK', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:46:55', '2026-07-16 09:46:55'),
(181, 1, 1, 'settings', 'settings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-16 15:47:29', '$2y$10$9YPk05fOpDqdD/hi85UTNengxo6q1CZG7UOAIBSzySZPH4MktjZzq', NULL, 1, NULL, NULL, NULL, '2026-07-16 09:47:29', '2026-07-16 09:47:29'),
(182, 2, 1, 'fffffffff', '33333', NULL, '33333', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-21 13:18:01', '$2y$10$7FfGIcAJoirwX1Ic4KE94ukpQ0G1QVkfyErF4.teqHMNiFgtIDLd.', NULL, 1, NULL, 1, '2026-07-21 09:56:56', '2026-07-21 07:18:01', '2026-07-21 09:56:56'),
(185, 2, 1, 'SGS', '019215554555', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-07-21 16:05:00', '$2y$10$OwJTRNDR75EiXiPh2Anv2.5NJv96FyUCVp4iWCkja0zbSJOWCyKJW', NULL, 1, NULL, 1, '2026-09-09 07:11:15', '2026-07-21 10:05:00', '2026-09-09 07:11:15'),
(186, 1, 1, 'Basic', 'basic', 'basic@gmail.com', '01303740757', NULL, 'backend/images/avatar/profile-UwrR5g1HptZL7jhhd0Ci8nwLjIDy56dHr7QFtVry.jpeg', 'backend/images/avatar/cover-8mwqRjhBNyve8DI6vaOe8pw9MEjHFQAmehMaXvvu.jpeg', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-08-15 14:07:03', '$2y$10$03GrLS6HcTqjQ2aGW.iZv.pKOpcHUr0TncQob11BMsyqE14OEJX3u', NULL, 1, NULL, NULL, NULL, '2026-08-15 08:07:03', '2026-08-15 08:21:30'),
(187, 1, 1, 'Advance', 'advance', 'advance@gmail.com', '01303740756', NULL, 'backend/images/avatar/profile-4FwtazuhMUWLPqBK4fi4aPDd7JKZBZyOXfPat4Oh.jpeg', 'backend/images/avatar/cover-pFetVXDKaRM7kqTEIJmp4O8YWXEj3KubbG6gpu1w.jpeg', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, '2026-08-15 14:08:11', '$2y$10$eWtxWHMcDUprjU7hawdKL.Ia7Z40zda0M08HaoT0FP.qd96BFzMLu', NULL, 1, 1, NULL, NULL, '2026-08-15 08:08:11', '2026-08-15 08:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `company_id`, `type`, `registration_no`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(11, 1, 'Frozen Pickup', 'Dhaka Metro Sha 11-1969', 1, 2, NULL, NULL, NULL, '2024-06-08 08:59:24', '2024-06-08 08:59:24'),
(12, 1, 'Frozen Pickup', 'Dhaka Metro Sha 11-3080', 1, 2, NULL, NULL, NULL, '2024-06-08 08:59:39', '2024-06-08 08:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `coa_setup_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `company_id`, `coa_setup_id`, `code`, `name`, `contact_person`, `email`, `phone`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 166, 'V0001', '3S Distributor', NULL, NULL, '01728636977', 'Jatrabri', 1, 2, 159, NULL, NULL, '2025-04-27 12:02:52', '2025-04-28 11:02:16'),
(2, 1, 167, 'V0002', 'Mac Coffee', NULL, NULL, NULL, NULL, 1, 159, 160, NULL, NULL, '2025-04-28 11:15:24', '2025-04-28 13:05:35'),
(3, 1, 168, 'V0003', 'Bashundhara', NULL, NULL, NULL, NULL, 1, 160, NULL, NULL, NULL, '2025-04-28 13:05:22', '2025-04-28 13:05:22'),
(4, 1, 169, 'V0004', 'SS Distribution', NULL, NULL, NULL, NULL, 1, 160, NULL, NULL, NULL, '2025-04-28 13:06:19', '2025-04-28 13:06:19'),
(5, 1, 170, 'V0005', 'AcI Mashas Ma entre', '01408296010', NULL, '01626059232', NULL, 1, 159, NULL, NULL, NULL, '2025-04-29 17:00:28', '2025-04-29 17:00:28'),
(6, 1, 171, 'V0006', 'Rishad Enterprise', NULL, NULL, NULL, NULL, 1, 159, NULL, NULL, NULL, '2025-04-30 06:26:34', '2025-04-30 06:26:34'),
(7, 1, 172, 'V0019', 'Square Food and Beverage', '01742506569', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-04-30 06:51:16', '2025-07-24 10:56:41'),
(8, 1, 173, 'V0007', 'Dabour Company', 'SMP entreprise', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-05-02 07:40:35', '2025-05-05 13:14:29'),
(9, 1, 174, 'V0008', 'Iskon', 'shop', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-05-02 10:29:50', '2025-05-05 13:14:14'),
(10, 1, 175, 'V0009', 'Rfl Italio Company', 'Najrul', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-05-02 11:24:08', '2025-05-02 11:24:17'),
(11, 1, 176, 'V0010', 'Kohinoor chemical', NULL, NULL, 'Kohinoor chemical', '36,Sohid Tajuddin Ahamed Sorani Dhaka-1208', 1, 159, 159, NULL, NULL, '2025-05-05 13:13:43', '2025-05-31 09:49:20'),
(12, 1, 177, 'V0011', 'Nestle', NULL, NULL, NULL, NULL, 1, 159, NULL, NULL, NULL, '2025-05-05 13:44:44', '2025-05-05 13:44:44'),
(13, 1, 178, 'V0012', 'Fresh MGi', 'Sanjid Enterprise', NULL, '01832716879', '46/47 DIT plot Gandaria', 1, 159, 159, NULL, NULL, '2025-05-05 20:23:39', '2025-07-16 12:53:46'),
(14, 1, 179, 'V0013', 'Dettol', 'MR Sahag', NULL, '01966339103', NULL, 1, 159, 159, NULL, NULL, '2025-05-06 10:48:22', '2025-07-14 11:27:48'),
(15, 1, 180, 'V0014', 'Unilever Company ltd', 'Sagor', NULL, 'Unilever Company ltd', NULL, 1, 159, 159, NULL, NULL, '2025-05-07 15:23:02', '2025-05-14 16:04:29'),
(16, 1, 181, 'V0015', 'City Group', NULL, NULL, 'City Group', NULL, 1, 159, 159, NULL, NULL, '2025-05-08 14:42:54', '2025-12-25 10:27:22'),
(17, 1, 182, 'V0016', 'Fortune Company', NULL, NULL, 'Fortune Company', NULL, 1, 159, 159, NULL, NULL, '2025-05-09 09:00:28', '2025-12-25 10:27:38'),
(18, 1, 185, 'V0017', 'Marcella Distribution', NULL, NULL, 'Marcella Distribution', NULL, 1, 159, 159, NULL, NULL, '2025-05-11 09:09:02', '2025-12-25 10:28:04'),
(19, 1, 187, 'V0018', 'Prestige Bengal LTd', 'Prestige Bengal LTd', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-05-14 16:02:52', '2025-12-25 10:28:15'),
(20, 1, 188, 'V0020', 'Kodomo Baby Care', 'Kodomo Baby Care', NULL, NULL, NULL, 1, 159, NULL, NULL, NULL, '2025-05-14 16:25:49', '2025-05-14 16:25:49'),
(21, 1, 189, 'V0021', 'Golden Harvest', NULL, NULL, 'Golden Harvest', NULL, 1, 159, NULL, NULL, NULL, '2025-05-15 16:21:08', '2025-05-15 16:21:08'),
(22, 1, 190, 'V0022', 'Mousumi Entreprise', NULL, NULL, 'Mousumi Entreprise', NULL, 1, 159, NULL, NULL, NULL, '2025-05-16 08:45:42', '2025-05-16 08:45:42'),
(23, 1, 191, 'V0023', 'Nivea Company', NULL, NULL, 'Nivea Company', NULL, 1, 159, NULL, NULL, NULL, '2025-05-16 13:49:43', '2025-05-16 13:49:43'),
(24, 1, 192, 'V0024', 'International Distribution', 'International Distribution', NULL, NULL, NULL, 1, 159, NULL, NULL, NULL, '2025-05-17 09:01:00', '2025-05-17 09:01:00'),
(25, 1, 193, 'V0025', 'M/S Muhammad Corporation', 'M/S Muhammad Corporation', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-05-17 15:51:15', '2025-12-25 10:28:41'),
(26, 1, 194, 'V0026', 'Pran  Agro Limited', NULL, NULL, 'Pran  Agro Limited', NULL, 1, 159, 159, NULL, NULL, '2025-05-18 15:22:38', '2025-12-25 10:30:41'),
(27, 1, 195, 'V0027', 'Vin Global Distribution', NULL, NULL, 'Vin Global Distribution', NULL, 1, 159, 159, NULL, NULL, '2025-05-19 14:08:24', '2025-12-25 10:31:02'),
(28, 1, 196, 'V0028', 'SRF consumer limited', NULL, NULL, 'SRF consumer limited', NULL, 1, 159, NULL, NULL, NULL, '2025-05-20 10:01:41', '2025-05-20 10:01:41'),
(29, 1, 197, 'V0029', 'Kodomo international limited', NULL, NULL, 'Kodomo international limited', NULL, 1, 159, NULL, NULL, NULL, '2025-05-20 12:55:15', '2025-05-20 12:55:15'),
(30, 1, 198, 'V0030', 'Arla', 'Sayem', NULL, '01873815852', NULL, 1, 161, 159, NULL, NULL, '2025-05-21 09:40:51', '2025-07-16 14:12:48'),
(31, 1, 199, 'V0031', 'ASIM TRADES - FRESH', 'kader', NULL, '01777888301/01794453773', '30/2 sk DAS ROAD GANDARIEA', 1, 161, 159, NULL, NULL, '2025-05-21 10:26:36', '2025-07-16 14:13:08'),
(32, 1, 200, 'V0032', 'GOLAM/Chakw Bazar', 'pabel', NULL, '01757698355', 'Moulovi bazar', 1, 161, 159, NULL, NULL, '2025-05-21 12:19:40', '2025-07-16 14:13:22'),
(33, 1, 201, 'V0033', 'Ratan Enterprise', 'Ratan', NULL, '01712955013/0712343546/01727049917', '5/10 Karim  Mension, Isalmpur', 1, 159, 159, NULL, NULL, '2025-05-21 15:45:55', '2025-07-24 10:51:01'),
(34, 1, 202, 'V0034', 'Deiyon Enterprise', NULL, NULL, 'Deiyon Enterprise', NULL, 1, 159, 159, NULL, NULL, '2025-05-22 07:03:34', '2025-07-16 14:42:19'),
(35, 1, 203, 'V0035', 'Sahalom Carpet', NULL, NULL, 'Sahalom Carpet', NULL, 1, 159, 159, NULL, NULL, '2025-05-22 09:55:55', '2025-07-16 14:42:29'),
(36, 1, 204, 'V0036', 'Binimoy Traders', 'Ranok', NULL, '01735244055/01816662051/', '147/148 Mitford Road Dhaka-1100', 1, 161, 159, NULL, NULL, '2025-05-22 12:05:40', '2025-07-24 10:57:16'),
(37, 1, 205, 'V0037', 'Pran Group', NULL, NULL, 'Pran Group', NULL, 1, 159, 159, NULL, NULL, '2025-05-23 12:13:28', '2025-07-24 10:57:40'),
(38, 1, 206, 'V0038', 'Igloo', 'Mahamudul', NULL, '01952434781', NULL, 1, 2, 159, NULL, NULL, '2025-05-23 14:57:42', '2025-07-24 10:57:51'),
(40, 1, 208, 'V0039', 'Imroj   Entreprise', NULL, NULL, 'Imroj   Entreprise', '44 Molobi Bazar , Dhaka', 1, 159, 159, NULL, NULL, '2025-05-24 08:48:22', '2025-07-24 10:58:02'),
(41, 1, 209, 'V0040', 'Olympic Industries limited', 'Saidul islam', NULL, '01894809787', NULL, 1, 159, 159, NULL, NULL, '2025-05-24 11:19:30', '2025-07-24 10:58:13'),
(42, 1, 210, 'V0041', 'Rakib Enterprise', 'ASHIF', NULL, '01734722892/01567813988', '2/4 Nazimuddin Road', 1, 159, 159, NULL, NULL, '2025-05-24 11:47:20', '2025-07-24 10:58:25'),
(43, 1, 211, 'V0042', 'Mesas Asia Food Copr', NULL, NULL, 'Moilobi Bazar', NULL, 1, 159, 159, NULL, NULL, '2025-05-24 13:46:04', '2025-07-24 10:58:36'),
(44, 1, 212, 'V0043', 'Aysha  trades', NULL, NULL, 'Aysha  trades', '10/3 moilobi bazzr', 1, 159, 159, NULL, NULL, '2025-05-24 15:10:07', '2025-07-24 10:58:48'),
(45, 1, 213, 'V0044', 'New Zealand Dairy Products Bangladesh', 'RASEL MIA', NULL, '01631260139', 'Begam Bazar,Chakbazar-1211 Lalbag Dhakaa', 1, 161, 159, NULL, NULL, '2025-05-25 07:46:44', '2025-07-24 11:00:03'),
(46, 1, 214, 'V0045', 'Brac Dailya and Food Project', NULL, NULL, '88-02-22289265-72', 'Kadariea Tower 28/8B,Mhakhali, Dhaka-1212', 1, 161, 159, NULL, NULL, '2025-05-25 08:28:46', '2025-07-24 11:00:24'),
(47, 1, 215, 'V0046', 'PRAN GROUP', 'IMRAN', NULL, '01313075525', '105/ MODDO BADDA-DHAKA-1212', 1, 161, 159, NULL, NULL, '2025-05-25 11:22:43', '2025-07-24 11:00:36'),
(48, 1, 216, 'V0047', 'Coco cola Company', 'Imran traders', NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-05-26 06:28:01', '2025-07-24 11:00:59'),
(49, 1, 217, 'V0048', 'Haque Biscuits', NULL, NULL, 'Haque Biscuits', NULL, 1, 159, 159, NULL, NULL, '2025-05-26 15:18:16', '2025-12-25 10:52:46'),
(50, 1, 218, 'V0049', 'mesas Imran', 'chalam Miya', NULL, '01711980175', 'Moilobi Bazar', 1, 2, 159, NULL, NULL, '2025-05-27 09:44:18', '2025-12-25 10:53:04'),
(51, 1, 219, 'V0050', 'Mesas M.S Enterprise', '0', NULL, '01687610357', '39/1 Moilobi Bazar,Dhaka', 1, 2, 159, NULL, NULL, '2025-05-27 11:42:46', '2026-02-10 15:33:31'),
(52, 1, 220, 'V0051', 'Sabil Hasan', 'SABIL HASAN', NULL, '01703806205/01789421695', 'MITFORD BISMILLA TOWER-1100', 1, 2, 159, NULL, NULL, '2025-05-27 13:25:38', '2025-12-25 10:53:49'),
(53, 1, 221, 'V0052', 'ERFAN SUPER FOODS', 'ERFAN', NULL, '029632516/09678771777', 'Noor tower level-14, Bir uttom Cr Dutta Rood DHAKA1205', 1, 159, 159, NULL, NULL, '2025-05-28 06:28:56', '2025-12-25 10:54:14'),
(54, 1, 222, 'V0053', 'Bismilha Trad Center', NULL, NULL, '01813370050/0257312541', '69/701Moulovi bazar', 1, 2, 159, NULL, NULL, '2025-05-28 12:29:31', '2025-12-25 10:54:40'),
(56, 1, 224, 'V0054', 'J&J  Shetaj Entreprise', NULL, NULL, NULL, '1 no doyaganj ,Jatrabari', 1, 159, 159, NULL, NULL, '2025-05-31 15:16:01', '2025-12-25 10:55:06'),
(58, 1, 226, 'V0055', 'Mesas afra rice', NULL, NULL, NULL, '19 no babubazer', 1, 159, 159, NULL, NULL, '2025-06-02 15:42:30', '2025-12-25 10:55:40'),
(59, 1, 227, 'V0056', 'Abul Khair Consumer Point', NULL, NULL, NULL, 'Dhaka Office', 1, 159, 159, NULL, NULL, '2025-06-02 15:44:12', '2025-12-25 10:55:56'),
(60, 1, 228, 'V0057', 'Mesas Eya Rice Agency', NULL, NULL, NULL, '2 no Kazi jiya Babubazer', 1, 159, 159, NULL, NULL, '2025-06-03 08:54:14', '2025-12-25 11:10:34'),
(61, 1, 229, 'V0058', 'Moon Chata', NULL, NULL, 'Moon Chata', '146/147/148 Bismilla Tower', 1, 159, 159, NULL, NULL, '2025-06-04 02:52:12', '2025-12-25 11:10:55'),
(62, 1, 230, 'V0059', 'ISHIKA TRADING -TREET COM', 'MOSTAFA', NULL, '01830488749', '277/Fokirapur,Mottizil', 1, 159, 159, NULL, NULL, '2025-06-04 08:33:17', '2025-12-25 11:11:11'),
(63, 1, 231, 'V0060', 'ANU RADHA BOJONALOY', 'ABI', NULL, '01709794498/01638672692', '109/ TATI BAZAR DHAKA-1100', 1, 159, 159, NULL, NULL, '2025-06-04 10:08:57', '2025-12-25 11:11:32'),
(64, 1, 232, 'V0061', 'Akij Essential', NULL, NULL, NULL, 'Vit Uttam Tejgoan', 1, 159, 159, NULL, NULL, '2025-06-05 15:18:15', '2025-12-25 11:11:46'),
(65, 1, 233, 'V0062', 'AS.A MOTIN ENTERPRISE', 'Motin', NULL, '01673897619/01995366744', '1/2 no, Dokan Bismillaha tower, Dhaka -1100', 1, 161, 159, NULL, NULL, '2025-06-07 06:02:48', '2025-12-25 11:12:05'),
(66, 1, 234, 'V0063', 'Aarong Dairy', 'Md.Shakhaowat Hossain/ Sr.Tusar', NULL, '01329650843/01616765359', '66, Bir Uttam Ak Khandakar Road Mohakhali, Dhaka-1212', 1, 161, 159, NULL, NULL, '2025-06-11 05:12:27', '2025-12-25 11:12:19'),
(67, 1, 235, 'V0064', 'MILK VITA', 'IMRAN', NULL, '01726089747', 'KASAI TOLI NAWYA BAZAR', 1, 159, 159, NULL, NULL, '2025-06-12 07:22:16', '2025-12-25 11:12:34'),
(68, 1, 236, 'V0065', 'Kazi & kazi Tea Estate Limited', 'Manager-korim bi', NULL, '01918831025', 'MOHAMMADPUR DHAKA-1207', 1, 161, 159, NULL, NULL, '2025-06-14 06:51:43', '2025-12-25 11:12:54'),
(69, 1, 237, 'V0066', 'M/S AHMED TRADING', 'AHMED', NULL, '01670857216', 'GANDARIA-DHAKA-1204', 1, 159, 159, NULL, NULL, '2025-06-15 09:30:11', '2025-12-25 11:19:13'),
(70, 1, 238, 'V0067', 'Partex Beverge limited', 'Mesas moriyom', NULL, '01757616193', 'Simson Road ,Sodorghat', 1, 159, 159, NULL, NULL, '2025-06-16 11:56:01', '2025-12-25 11:19:36'),
(71, 1, 239, 'V0068', 'MASUD STORE', 'SOSHAN', NULL, '01816700125/01991999351', 'ALU BAZAR, DHAKA-1000', 1, 160, 159, NULL, NULL, '2025-06-19 05:54:46', '2025-12-25 11:23:18'),
(72, 1, 240, 'V0069', 'Transcom Consumer Product Ltd', 'Transcom', NULL, '01911110390/ 01915411508', 'Mohakhali Dhaka', 1, 159, 159, NULL, NULL, '2025-06-21 09:05:25', '2025-12-25 11:28:27'),
(73, 1, 241, 'V0070', 'Mahajabin.limited', 'Mahajabin', NULL, '01841270749/01975104404', '60/70 Moylabi bazar', 1, 160, 159, NULL, NULL, '2025-06-22 06:21:32', '2025-12-25 11:28:54'),
(74, 1, 242, 'V0071', 'TAIFA Trading', 'TAIFA', NULL, '01928914377 / 01886629378', '147/148 Bismillah Mitford-1100', 1, 160, 159, NULL, NULL, '2025-06-23 02:54:19', '2025-12-25 11:29:30'),
(75, 1, 243, 'V0072', 'Family fair', 'FAMILY', NULL, '01761575872 / 01821186999', '147/148 Mitford Road Dhaka-1100', 1, 160, 159, NULL, NULL, '2025-06-23 03:37:16', '2025-12-25 11:29:47'),
(76, 1, 244, 'V0073', 'Modina baby store', 'MODINA', NULL, '01621256444 / 01762039596', '2, Chakbazar Dhaka-1211', 1, 160, 159, NULL, NULL, '2025-06-23 03:46:08', '2025-12-25 11:30:05'),
(77, 1, 245, 'V0074', 'Shehtaj Enterprise', 'Shehtaj', NULL, '01670787949 / 01851136469', 'Doyaganj Bazar', 1, 160, 159, NULL, NULL, '2025-06-23 08:16:30', '2025-12-25 11:30:46'),
(78, 1, 246, 'V0075', 'Bombay Sweets', 'Md.Monir', NULL, '01844237541', 'Sampure-1204', 1, 160, 159, NULL, NULL, '2025-06-23 09:32:36', '2025-12-25 11:31:28'),
(79, 1, 247, 'V0076', 'Ispahani Tea Limited', NULL, NULL, NULL, 'Dupkhola', 1, 159, 159, NULL, NULL, '2025-06-23 15:00:53', '2025-12-25 11:31:53'),
(80, 1, 248, 'V0077', 'Anas enterprise', 'Anas', NULL, '01686126833', 'jurain 125/2 alam super market', 1, 159, 159, NULL, NULL, '2025-06-26 09:14:00', '2025-12-25 11:32:09'),
(81, 1, 249, 'V0078', 'JES International', 'jes', NULL, '01678537070/01819476020', '35,chawak circular road .', 1, 159, 159, NULL, NULL, '2025-06-28 08:46:18', '2025-12-25 11:32:25'),
(82, 1, 250, 'V0079', 'Akij Health Care', NULL, NULL, '01963375026', NULL, 1, 160, 159, NULL, NULL, '2025-06-29 07:49:30', '2025-12-25 11:36:32'),
(83, 1, 251, 'V0080', 'Care nutrition limited', 'Pranto banik', NULL, '01643557687', 'NARAYANGONG', 1, 160, 159, NULL, NULL, '2025-06-29 09:32:44', '2025-12-25 15:12:17'),
(84, 1, 252, 'V0081', 'M/S Tisa store', 'Tisa', NULL, '01716283103/01919283103', 'BEGOM BAZAR-1100', 1, 160, 159, NULL, NULL, '2025-07-04 07:27:14', '2025-12-25 15:12:32'),
(85, 1, 253, 'V0082', 'Anfords Oral HyGine', NULL, NULL, '01922118068', NULL, 1, 159, 159, NULL, NULL, '2025-07-14 10:01:57', '2025-12-25 15:14:20'),
(86, 1, 254, 'V0083', 'Noor Trades', NULL, NULL, '01670798705', NULL, 1, 159, 159, NULL, NULL, '2025-07-16 14:55:17', '2025-12-25 15:14:33'),
(87, 1, 255, 'V0084', 'Cute Company', NULL, NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-07-20 10:20:10', '2025-12-25 15:14:42'),
(88, 1, 256, 'V0085', 'Darkin Trade & Distribution', 'Sadzzad BI D.S', NULL, '01317568595', 'Moulovibazar-1211', 1, 160, 160, NULL, NULL, '2025-07-21 06:51:45', '2026-01-05 08:36:59'),
(89, 1, 257, 'V0086', 'Sarkar Enterprise', NULL, NULL, '01967574739', NULL, 1, 159, 159, NULL, NULL, '2025-07-21 15:43:24', '2025-12-25 15:15:09'),
(90, 1, 258, 'V0087', 'Afifa trading', 'Didar hossain', NULL, '01799919394', 'keranigong Dhaka-1310', 1, 160, 159, NULL, NULL, '2025-07-26 07:07:58', '2025-12-25 15:16:58'),
(91, 1, 259, 'V0088', 'Nasir Enterprise', NULL, NULL, '01636828132', '37 Distrilari Road,Gandariya', 1, 159, 159, NULL, NULL, '2025-07-26 11:26:01', '2025-12-25 15:17:16'),
(92, 1, 260, 'V0089', 'Nurtrimerchant International', NULL, NULL, '01704188535', '161 ,Motijheel C/A', 1, 159, 159, NULL, NULL, '2025-07-28 16:03:03', '2025-12-25 15:17:45'),
(93, 1, 261, 'V0090', 'Sabbir store', 'sabbir', NULL, '01752787895/ 01759184183', 'Moulovi bazar', 1, 160, 159, NULL, NULL, '2025-07-30 09:37:18', '2025-12-25 15:18:04'),
(94, 1, 262, 'V0091', 'M/S HUMAYUN STORE', 'Humayun', NULL, '01927387260', '92, gopi nagor road-dhaka-1203', 1, 160, 159, NULL, NULL, '2025-08-02 05:42:40', '2025-12-25 15:18:44'),
(95, 1, 263, 'V0092', 'DORCO', 'Nazmil hasan', NULL, '01977387746', 'Tejgaon', 1, 160, 159, NULL, NULL, '2025-08-06 08:33:06', '2025-12-25 15:19:28'),
(96, 1, 264, 'V0093', 'Habil store', 'Bilal', NULL, '01885019539', 'LALBAG DHAKA-1211', 1, 160, 159, NULL, NULL, '2025-08-10 05:25:06', '2025-12-25 15:20:09'),
(97, 1, 265, 'V0094', 'M/S Mariom enterprice', 'MD.FOYZUL JWEAL', NULL, '01757616193', 'SADARGHAT.DHAKA-1100', 1, 160, 159, NULL, NULL, '2025-08-11 10:10:03', '2025-12-25 15:20:44'),
(98, 1, 266, 'V0095', 'Haque food', 'Haque', NULL, '028891540', '340\' Tajgong area-Dhaka-1208', 1, 160, 159, NULL, NULL, '2025-08-14 07:24:19', '2025-12-25 15:20:59'),
(99, 1, 267, 'V0096', 'Amanah Trading Ltd', 'Amanah', NULL, NULL, 'Moulovi bazar', 1, 159, 159, NULL, NULL, '2025-08-17 10:07:13', '2025-12-25 15:21:36'),
(100, 1, 268, 'V0097', 'Rediyent Care Limited', NULL, NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-08-18 11:05:29', '2025-12-25 15:22:08'),
(101, 1, 269, 'V0098', 'Jansin health pvt limited', 'Jansin', NULL, '02-9514902', '2/c,purana paltan', 1, 159, 159, NULL, NULL, '2025-08-23 10:23:24', '2025-12-25 15:22:23'),
(102, 1, 270, 'V0099', 'Aashirbad', NULL, NULL, NULL, NULL, 1, 159, 159, NULL, NULL, '2025-08-23 16:50:46', '2025-12-25 15:22:42'),
(103, 1, 271, 'V0100', 'N.Islam Enterprise', 'Islam', NULL, '01751739498', 'Begam Bazar,Chakbazar-1211 Lalbag Dhakaa', 1, 160, 159, NULL, NULL, '2025-08-26 06:44:25', '2025-12-25 15:23:23'),
(104, 1, 272, 'V0101', 'SMC limited company', 'Sahadat bi', NULL, '01946364593', 'Jatrabri Dhaka', 1, 159, 159, NULL, NULL, '2025-09-10 10:56:42', '2025-12-25 15:26:48'),
(105, 1, 273, 'SCS-27', 'Vin Global Distribution', 'vin', NULL, '+88-57315492, 57315271', 'Bagum bazar', 1, 160, NULL, 159, '2025-12-25 15:27:46', '2025-09-15 06:58:45', '2025-12-25 15:27:46'),
(106, 1, 274, 'V0102', 'Nutrimerchant International', 'Hasan Ali', NULL, '01752-737894', 'Motijheel-Dhaka,1000', 1, 160, 159, NULL, NULL, '2025-09-23 06:24:18', '2025-12-25 15:28:12'),
(107, 1, 275, 'V0103', 'M/S NEW SAHID TRADES', 'SHAHID BI', NULL, '01723378823', '8/1 Moylabi bazar', 1, 160, 159, NULL, NULL, '2025-09-23 10:18:33', '2025-12-25 15:29:45'),
(108, 1, 276, 'V0104', 'Salam Enterprise', NULL, NULL, '01968441637', '135 Majed Sordar  Road , Dhaka 1100', 1, 159, 159, NULL, NULL, '2025-10-07 13:24:36', '2025-12-25 15:30:02'),
(109, 1, 277, 'V0105', 'SUMITT STORE', 'SUMIT', NULL, '01903500102/01642366959', 'Moylovi bazar', 1, 159, 159, NULL, NULL, '2025-10-11 11:03:48', '2025-12-25 15:30:51'),
(110, 1, 278, 'V0106', 'Insaf Trading', 'Insaf', NULL, '01710681166/01966182380', 'Moulovibazar-1211', 1, 160, 159, NULL, NULL, '2025-10-12 08:17:19', '2025-12-25 15:31:15'),
(111, 1, 279, 'V0107', 'Nasir trading', 'Nasir', NULL, '01636828132', 'Gandariea old dhaka', 1, 160, 159, NULL, NULL, '2025-10-13 11:01:03', '2025-12-25 15:31:30'),
(112, 1, 280, 'SCS-28', 'New Sohid traders', 'SOHID', NULL, '01935948640', 'Moulovibazar-1211', 1, 160, NULL, 159, '2025-12-25 15:31:39', '2025-10-18 11:39:36', '2025-12-25 15:31:39'),
(113, 1, 281, 'V0108', 'M/S Sohag entreprise', 'sohag', NULL, '01641955589', 'Moulovibazar-1211', 1, 160, 159, NULL, NULL, '2025-10-19 04:45:35', '2025-12-25 15:33:13'),
(114, 1, 282, 'SCS-30', 'Abdul Motin enterprise', 'Motin', NULL, '01701881006', 'Moulovibazar-1211', 1, 160, NULL, 159, '2025-12-25 15:33:21', '2025-10-19 04:47:35', '2025-12-25 15:33:21'),
(115, 1, 283, 'V0109', 'POLAS TRADERS', 'POLAS', NULL, '01918981019', 'Moulovibazar-1211', 1, 160, 159, NULL, NULL, '2025-10-19 04:49:17', '2025-12-25 15:33:40'),
(116, 1, 286, 'V0110', 'Hahan Brother', 'Nazmul hasan', NULL, '01627436474', '27\' Beagoum Bazar', 1, 160, 159, NULL, NULL, '2025-11-17 07:29:49', '2025-12-25 15:35:07'),
(117, 1, 287, 'V0111', 'Confidence  Service', NULL, NULL, '01834232377', '27 Central Road New Market, Dhaka', 1, 159, 159, NULL, NULL, '2025-11-23 09:21:54', '2025-12-25 15:35:23'),
(118, 1, 288, 'V0112', 'NOBEL STORE', 'Mr. Nobel. Sikhdar', NULL, '01771275844', 'Wari-Dhaka', 1, 160, 159, NULL, NULL, '2025-11-29 05:31:35', '2025-12-29 09:10:03'),
(119, 1, 289, 'V0113', 'INCEPTA PHARMACEUICALS LTD', 'INCEPTA', NULL, '01600731266', 'KERANIGONJ DHAKD-1100', 1, 159, 159, NULL, NULL, '2025-11-29 10:16:48', '2025-12-25 15:35:56'),
(120, 1, 290, 'V0114', 'Rakit distribution', 'Sohag bi', NULL, '01767593530', '26\' Beagoum Bazar', 1, 160, 159, NULL, NULL, '2025-12-15 07:50:43', '2025-12-25 15:36:15'),
(121, 1, 291, 'V0115', 'M/S BASER&BROTHERS', 'BASER', NULL, '01961863745', 'ROKON PURE', 1, 159, 159, NULL, NULL, '2025-12-18 09:11:52', '2025-12-25 15:36:28'),
(122, 1, 292, 'V0116', 'DRAGON COMPANY', 'RAJIB BI', NULL, '01718-234237', 'Moylovi bazar-12 DHAKA', 1, 160, 159, NULL, NULL, '2025-12-25 06:18:59', '2025-12-25 15:36:43'),
(123, 1, 293, 'V0117', 'New Barisal Plastic Center', NULL, NULL, '01720673466', NULL, 1, 159, NULL, NULL, NULL, '2026-01-08 14:27:50', '2026-01-08 14:27:50'),
(124, 1, 294, 'V0118', 'M/S Rumi Enterprise', 'RUMI', NULL, '01879398585', 'LAXMI BAZAR', 1, 160, 159, NULL, NULL, '2026-01-10 07:50:48', '2026-01-10 14:24:45'),
(125, 1, 295, 'V0119', 'Marico Distribution', NULL, NULL, '01710289602', '94 Mirhajirbag, Dhaka', 1, 159, NULL, NULL, NULL, '2026-01-12 14:01:24', '2026-01-12 14:01:24'),
(126, 1, 303, 'V0119', 'A.K TRADING CORPORATION', 'AK TRADING', NULL, '01915603765/01911886341', '57-58 Mitford Road ,Dhaka', 1, 160, NULL, NULL, NULL, '2026-02-13 08:22:56', '2026-02-13 08:22:56'),
(127, 1, 304, 'V0120', 'M/S MAA Enterprice', 'maa', NULL, '01408296010', '22/1 Dupkhola Dhaka 1100', 1, 160, NULL, NULL, NULL, '2026-02-19 07:06:27', '2026-02-19 07:06:27'),
(128, 1, 305, 'V0121', 'Mesas Brother Crokeries', NULL, NULL, '01975009122/01999911982', '146-148 Mitford, Dhaka-1100', 1, 159, NULL, NULL, NULL, '2026-03-10 08:23:09', '2026-03-10 08:23:09'),
(129, 1, 307, 'V0122', 'Mesas Naz Enterprise', 'rakin 01405594148', NULL, '01781814878/01892108564', NULL, 1, 160, 160, NULL, NULL, '2026-03-16 08:15:17', '2026-03-16 08:16:03'),
(130, 1, 309, 'V0123', 'M/S Hasan Brothers Corp', 'Yeasin', NULL, NULL, NULL, 1, 159, NULL, 159, '2026-04-11 07:45:06', '2026-04-11 07:42:57', '2026-04-11 07:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payments`
--

CREATE TABLE `vendor_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lifting_return_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_no` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_payments`
--

INSERT INTO `vendor_payments` (`id`, `company_id`, `vendor_id`, `lifting_id`, `lifting_return_id`, `payment_no`, `payment_date`, `payment_type`, `type`, `amount`, `remarks`, `approved`, `approved_by`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 59, 7, NULL, 'STP2609000001', '2026-09-14', 'cash', 'payment', 5000.00, 'Cash Purchase', 0, NULL, 1, NULL, NULL, NULL, '2026-09-14 00:34:32', '2026-09-14 00:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payment_data`
--

CREATE TABLE `vendor_payment_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_payment_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED NOT NULL,
  `paid` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_payment_data`
--

INSERT INTO `vendor_payment_data` (`id`, `vendor_payment_id`, `lifting_id`, `paid`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 5000.00, '2026-09-14 00:34:32', '2026-09-14 00:34:32');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_all_sales` (
`product_id` bigint(20) unsigned
,`product_name` varchar(255)
,`product_code` varchar(255)
,`category_id` bigint(20) unsigned
,`category_name` varchar(255)
,`attribute_name` varchar(255)
,`rate` decimal(16,2)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
,`store_id` bigint(20) unsigned
,`date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_client_collections`
-- (See below for the actual view)
--
CREATE TABLE `view_client_collections` (
`client_id` bigint(20) unsigned
,`payment_date` date
,`collection_type` varchar(255)
,`amount` decimal(16,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_client_realization_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_client_realization_sales` (
`company_id` bigint(20) unsigned
,`client_id` bigint(20) unsigned
,`client_category_id` bigint(20) unsigned
,`client_category_name` varchar(255)
,`client_name` varchar(255)
,`client_phone` varchar(255)
,`client_code` bigint(20)
,`region_id` bigint(20) unsigned
,`region_name` varchar(255)
,`area_id` bigint(20) unsigned
,`area_name` varchar(255)
,`territory_id` bigint(20) unsigned
,`territory_name` varchar(255)
,`date` date
,`amount` decimal(17,2)
,`total_paid` decimal(16,2)
,`staff_id` bigint(20) unsigned
,`staff_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_client_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_client_returns` (
`company_id` bigint(20) unsigned
,`client_id` bigint(20) unsigned
,`client_category_id` bigint(20) unsigned
,`client_category_name` varchar(255)
,`date` date
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_client_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_client_sales` (
`company_id` bigint(20) unsigned
,`client_id` bigint(20) unsigned
,`client_category_id` bigint(20) unsigned
,`client_category_name` varchar(255)
,`client_name` varchar(255)
,`client_phone` varchar(255)
,`client_code` bigint(20)
,`region_id` bigint(20) unsigned
,`region_name` varchar(255)
,`area_id` bigint(20) unsigned
,`area_name` varchar(255)
,`territory_id` bigint(20) unsigned
,`territory_name` varchar(255)
,`date` date
,`amount` decimal(40,2)
,`total_paid` decimal(16,2)
,`staff_id` bigint(20) unsigned
,`staff_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_collectionable_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_collectionable_sales` (
`id` bigint(20) unsigned
,`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`client_id` bigint(20) unsigned
,`client_name` varchar(255)
,`invoice` varchar(255)
,`date` date
,`total_amount` decimal(16,2)
,`total_paid` decimal(16,2)
,`discount` decimal(16,2)
,`returned_amount` decimal(38,2)
,`collectionable_amount` decimal(41,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_collection_history`
-- (See below for the actual view)
--
CREATE TABLE `view_collection_history` (
`company_id` bigint(20) unsigned
,`collection_type` varchar(255)
,`payment_no` varchar(255)
,`payment_type` varchar(255)
,`amount` decimal(16,2)
,`date` date
,`client_id` bigint(20) unsigned
,`client_name` varchar(255)
,`client_category_name` varchar(255)
,`region_id` bigint(20) unsigned
,`area_id` bigint(20) unsigned
,`area_name` varchar(255)
,`territory_id` bigint(20) unsigned
,`territory_name` varchar(255)
,`staff_id` bigint(20) unsigned
,`staff_name` varchar(255)
,`created_by` bigint(20) unsigned
,`entry_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_liftings`
-- (See below for the actual view)
--
CREATE TABLE `view_liftings` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`name` varchar(255)
,`code` varchar(255)
,`alert_quantity` bigint(20)
,`shared_profit` decimal(16,2)
,`variant_id` bigint(20) unsigned
,`attribute_name` varchar(255)
,`category_id` bigint(20) unsigned
,`category_name` varchar(255)
,`sale_price` decimal(16,2)
,`online_price` decimal(8,2)
,`sku_id` bigint(20) unsigned
,`sku` varchar(255)
,`variant_price` decimal(16,2)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lifting_and_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_lifting_and_returns` (
`id` bigint(20) unsigned
,`company_id` bigint(20) unsigned
,`lifting_no` varchar(255)
,`date` date
,`store_id` bigint(20) unsigned
,`vendor_id` bigint(20) unsigned
,`total_amount` decimal(38,2)
,`discount` decimal(38,2)
,`payable_amount` decimal(39,2)
,`return_amount` decimal(48,2)
,`total_paid` decimal(16,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lifting_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_lifting_returns` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`sku_id` bigint(20) unsigned
,`sku` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_online_all_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_online_all_sales` (
`order_id` bigint(20) unsigned
,`order_product_id` bigint(20) unsigned
,`company_id` bigint(20) unsigned
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`sku_id` bigint(20) unsigned
,`category_id` bigint(20) unsigned
,`name` varchar(255)
,`code` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(18,2)
,`return_amount` decimal(16,2)
,`date` date
,`store_id` bigint(20) unsigned
,`status` varchar(255)
,`area_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_online_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_online_returns` (
`company_id` bigint(20) unsigned
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`sku_id` bigint(20) unsigned
,`category_id` bigint(20) unsigned
,`name` varchar(255)
,`code` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(16,2)
,`date` date
,`store_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_online_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_online_sales` (
`order_id` bigint(20) unsigned
,`order_product_id` bigint(20) unsigned
,`company_id` bigint(20) unsigned
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`sku_id` bigint(20) unsigned
,`category_id` bigint(20) unsigned
,`name` varchar(255)
,`code` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(18,2)
,`date` date
,`store_id` bigint(20) unsigned
,`status` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_payments`
-- (See below for the actual view)
--
CREATE TABLE `view_payments` (
`company_id` bigint(20) unsigned
,`vendor_id` bigint(20) unsigned
,`payment_no` varchar(255)
,`date` date
,`payment_type` varchar(255)
,`type` varchar(255)
,`amount` decimal(16,2)
,`vendor_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_product_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_product_returns` (
`company_id` bigint(20) unsigned
,`product_id` bigint(20) unsigned
,`category_id` bigint(20) unsigned
,`name` varchar(255)
,`code` varchar(255)
,`date` date
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_product_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_product_sales` (
`company_id` bigint(20) unsigned
,`client_id` bigint(20) unsigned
,`client_category_id` bigint(20) unsigned
,`client_category_name` varchar(255)
,`client_name` varchar(255)
,`client_phone` varchar(255)
,`client_code` bigint(20)
,`region_id` bigint(20) unsigned
,`region_name` varchar(255)
,`area_id` bigint(20) unsigned
,`area_name` varchar(255)
,`territory_id` bigint(20) unsigned
,`territory_name` varchar(255)
,`date` date
,`amount` decimal(40,2)
,`total_paid` decimal(16,2)
,`staff_id` bigint(20) unsigned
,`staff_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_retail_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_retail_returns` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`name` varchar(255)
,`category_id` bigint(20) unsigned
,`category_name` varchar(255)
,`sku_id` bigint(20) unsigned
,`sku` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_retail_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_retail_sales` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`retail_sale_id` bigint(20) unsigned
,`product_id` bigint(20) unsigned
,`sku_id` bigint(20) unsigned
,`rate` decimal(16,2)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_retail_sales_all`
-- (See below for the actual view)
--
CREATE TABLE `view_retail_sales_all` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`retail_sale_id` bigint(20) unsigned
,`product_id` bigint(20) unsigned
,`sku_id` bigint(20) unsigned
,`rate` decimal(16,2)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sales`
-- (See below for the actual view)
--
CREATE TABLE `view_sales` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`region_id` bigint(20) unsigned
,`area_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`sales_type` varchar(255)
,`product_id` bigint(20) unsigned
,`name` varchar(255)
,`category_id` bigint(20) unsigned
,`category_name` varchar(255)
,`sku_id` bigint(20) unsigned
,`sku` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
,`returned_qty` decimal(16,2)
,`returned_amount` decimal(16,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sales_history`
-- (See below for the actual view)
--
CREATE TABLE `view_sales_history` (
`company_id` bigint(20) unsigned
,`product_id` bigint(20) unsigned
,`sales_id` bigint(20) unsigned
,`product_name` varchar(255)
,`product_code` varchar(255)
,`category_id` bigint(20) unsigned
,`product_vendor_name` varchar(255)
,`category_name` varchar(255)
,`attribute_name` varchar(255)
,`rate` decimal(16,2)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
,`store_id` bigint(20) unsigned
,`staff_id` bigint(20) unsigned
,`staff_name` varchar(255)
,`client_id` bigint(20) unsigned
,`client_name` varchar(255)
,`client_category_name` varchar(255)
,`region_id` bigint(20) unsigned
,`area_name` varchar(255)
,`area_id` bigint(20) unsigned
,`territory_id` bigint(20) unsigned
,`territory_name` varchar(255)
,`invoice` varchar(255)
,`date` date
,`sales_type` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sales_returns`
-- (See below for the actual view)
--
CREATE TABLE `view_sales_returns` (
`company_id` bigint(20) unsigned
,`store_id` bigint(20) unsigned
,`region_id` bigint(20) unsigned
,`area_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`name` varchar(255)
,`category_id` bigint(20) unsigned
,`category_name` varchar(255)
,`sku_id` bigint(20) unsigned
,`sku` varchar(255)
,`qty` decimal(16,2)
,`amount` decimal(17,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transfers`
-- (See below for the actual view)
--
CREATE TABLE `view_transfers` (
`company_id` bigint(20) unsigned
,`host_id` bigint(20) unsigned
,`destination_id` bigint(20) unsigned
,`date` date
,`product_type` varchar(255)
,`product_id` bigint(20) unsigned
,`name` varchar(255)
,`category_id` bigint(20) unsigned
,`category_name` varchar(255)
,`sku_id` bigint(20) unsigned
,`sku` varchar(255)
,`qty` decimal(16,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_trial_balance`
-- (See below for the actual view)
--
CREATE TABLE `view_trial_balance` (
`voucher_type` varchar(20)
,`voucher_no` varchar(255)
,`voucher_date` date
,`coa_setup_id` bigint(20) unsigned
,`coa_head_code` bigint(20)
,`debit_amount` decimal(16,2)
,`credit_amount` decimal(16,2)
,`transaction` tinyint(4)
,`general` tinyint(4)
,`parent_id` bigint(20) unsigned
,`head_type` varchar(255)
,`head_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `invest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `investor_profit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `investor_payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sattlement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount_in` decimal(16,0) NOT NULL DEFAULT 0,
  `amount_out` decimal(16,0) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 169, 3874, '2026-04-04 06:55:15', '2026-04-04 06:55:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_logs`
--
ALTER TABLE `access_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_transactions`
--
ALTER TABLE `account_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_transactions_account_transaction_auto_id_foreign` (`account_transaction_auto_id`);

--
-- Indexes for table `account_transaction_autos`
--
ALTER TABLE `account_transaction_autos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu_actions`
--
ALTER TABLE `admin_menu_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulk_collections`
--
ALTER TABLE `bulk_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulk_collection_lists`
--
ALTER TABLE `bulk_collection_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bulk_collection_lists_bulk_collection_id_foreign` (`bulk_collection_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_vendors`
--
ALTER TABLE `category_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chain_clients`
--
ALTER TABLE `chain_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_categories`
--
ALTER TABLE `client_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_messages`
--
ALTER TABLE `client_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_prices`
--
ALTER TABLE `client_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_prices_client_id_foreign` (`client_id`),
  ADD KEY `client_prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `coa_setups`
--
ALTER TABLE `coa_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_data`
--
ALTER TABLE `collection_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_data_collection_id_foreign` (`collection_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_customer_requirements`
--
ALTER TABLE `crm_customer_requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_leads`
--
ALTER TABLE `crm_leads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lead_no` (`lead_no`),
  ADD KEY `fk_lead_source` (`lead_source_id`),
  ADD KEY `fk_lead_status` (`lead_status_id`);

--
-- Indexes for table `crm_lead_sources`
--
ALTER TABLE `crm_lead_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_lead_statuses`
--
ALTER TABLE `crm_lead_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_meeting_schedules`
--
ALTER TABLE `crm_meeting_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `crm_quotations`
--
ALTER TABLE `crm_quotations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quotation` (`quotation`),
  ADD KEY `idx_company` (`company_id`),
  ADD KEY `idx_store` (`store_id`),
  ADD KEY `idx_staff` (`staff_id`),
  ADD KEY `idx_client` (`client_id`),
  ADD KEY `idx_quotation` (`quotation`),
  ADD KEY `idx_date` (`date`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `crm_quotation_details`
--
ALTER TABLE `crm_quotation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_quotation` (`quotation_id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_variant` (`variant_id`),
  ADD KEY `idx_client` (`client_id`),
  ADD KEY `idx_store` (`store_id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deliveries_serial_no_unique` (`serial_no`);

--
-- Indexes for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_lists`
--
ALTER TABLE `delivery_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_lists_delivery_id_foreign` (`delivery_id`);

--
-- Indexes for table `delivery_men`
--
ALTER TABLE `delivery_men`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details_cards`
--
ALTER TABLE `details_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_members_group_id_foreign` (`group_id`);

--
-- Indexes for table `group_sales_targets`
--
ALTER TABLE `group_sales_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_sales_targets_group_id_foreign` (`group_id`);

--
-- Indexes for table `group_sales_target_categories`
--
ALTER TABLE `group_sales_target_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_sales_target_categories_group_sales_target_id_foreign` (`group_sales_target_id`);

--
-- Indexes for table `home_sections`
--
ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_section_sub_categories`
--
ALTER TABLE `home_section_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_section_sub_categories_home_section_id_foreign` (`home_section_id`);

--
-- Indexes for table `hrm_employee_appraisal`
--
ALTER TABLE `hrm_employee_appraisal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_attendances`
--
ALTER TABLE `hrm_employee_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_employee_id` (`employee_id`),
  ADD KEY `idx_attendance_date` (`attendance_date`),
  ADD KEY `idx_status` (`attendance_status`);

--
-- Indexes for table `hrm_employee_bonuses`
--
ALTER TABLE `hrm_employee_bonuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `payroll_month` (`payroll_month`),
  ADD KEY `payroll_year` (`payroll_year`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_documents`
--
ALTER TABLE `hrm_employee_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_holidays`
--
ALTER TABLE `hrm_employee_holidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_company` (`company_id`),
  ADD KEY `idx_branch` (`branch_id`);

--
-- Indexes for table `hrm_employee_increment`
--
ALTER TABLE `hrm_employee_increment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `payroll_month` (`payroll_month`),
  ADD KEY `payroll_year` (`payroll_year`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_leaves`
--
ALTER TABLE `hrm_employee_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrm_employee_loan`
--
ALTER TABLE `hrm_employee_loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `payroll_month` (`payroll_month`),
  ADD KEY `payroll_year` (`payroll_year`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_overtime`
--
ALTER TABLE `hrm_employee_overtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `payroll_month` (`payroll_month`),
  ADD KEY `payroll_year` (`payroll_year`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_payrolls`
--
ALTER TABLE `hrm_employee_payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrm_employee_resignation`
--
ALTER TABLE `hrm_employee_resignation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_employee_termination`
--
ALTER TABLE `hrm_employee_termination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `hrm_expense`
--
ALTER TABLE `hrm_expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_head_id` (`expense_head_id`),
  ADD KEY `expense_month` (`expense_month`),
  ADD KEY `expense_year` (`expense_year`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investors_user_id_foreign` (`user_id`);

--
-- Indexes for table `investor_payments`
--
ALTER TABLE `investor_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investor_payments_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `investor_profits`
--
ALTER TABLE `investor_profits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `investor_profits_serial_no_unique` (`serial_no`);

--
-- Indexes for table `investor_profit_lists`
--
ALTER TABLE `investor_profit_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investor_profit_lists_investor_profit_id_foreign` (`investor_profit_id`),
  ADD KEY `investor_profit_lists_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `invests`
--
ALTER TABLE `invests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invests_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `liftings`
--
ALTER TABLE `liftings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liftings_company_id_foreign` (`company_id`);

--
-- Indexes for table `lifting_documents`
--
ALTER TABLE `lifting_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lifting_documents_lifting_id_foreign` (`lifting_id`);

--
-- Indexes for table `lifting_products`
--
ALTER TABLE `lifting_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lifting_products_lifting_id_foreign` (`lifting_id`);

--
-- Indexes for table `lifting_returns`
--
ALTER TABLE `lifting_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifting_return_lists`
--
ALTER TABLE `lifting_return_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lifting_return_lists_lifting_return_id_foreign` (`lifting_return_id`);

--
-- Indexes for table `lifting_return_payments`
--
ALTER TABLE `lifting_return_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lifting_return_payments_lifting_return_id_foreign` (`lifting_return_id`),
  ADD KEY `lifting_return_payments_lifting_id_foreign` (`lifting_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `online_deliveries`
--
ALTER TABLE `online_deliveries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `online_deliveries_serial_no_unique` (`serial_no`);

--
-- Indexes for table `online_delivery_lists`
--
ALTER TABLE `online_delivery_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `online_delivery_lists_online_delivery_id_foreign` (`online_delivery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_name_unique` (`name`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_order_sections`
--
ALTER TABLE `pre_order_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_order_sections_pre_order_setup_id_foreign` (`pre_order_setup_id`);

--
-- Indexes for table `pre_order_setups`
--
ALTER TABLE `pre_order_setups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_skus`
--
ALTER TABLE `product_skus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_skus_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_vendors`
--
ALTER TABLE `product_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_returns`
--
ALTER TABLE `retail_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_return_lists`
--
ALTER TABLE `retail_return_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retail_return_lists_retail_return_id_foreign` (`retail_return_id`);

--
-- Indexes for table `retail_sales`
--
ALTER TABLE `retail_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_sale_lists`
--
ALTER TABLE `retail_sale_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retail_sale_lists_retail_sale_id_foreign` (`retail_sale_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_lists`
--
ALTER TABLE `sales_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_lists_sales_id_foreign` (`sales_id`);

--
-- Indexes for table `sales_product_data`
--
ALTER TABLE `sales_product_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_product_data_sales_id_foreign` (`sales_id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return_lists`
--
ALTER TABLE `sales_return_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_return_lists_sales_return_id_foreign` (`sales_return_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showcase_items`
--
ALTER TABLE `showcase_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_works`
--
ALTER TABLE `social_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_food_items`
--
ALTER TABLE `special_food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_site_items`
--
ALTER TABLE `static_site_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_store_id_foreign` (`store_id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_areas`
--
ALTER TABLE `store_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_areas_store_id_foreign` (`store_id`),
  ADD KEY `store_areas_area_id_foreign` (`area_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_email_unique` (`email`);

--
-- Indexes for table `territories`
--
ALTER TABLE `territories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfers_transfer_no_unique` (`transfer_no`);

--
-- Indexes for table `transfer_products`
--
ALTER TABLE `transfer_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_products_transfer_id_foreign` (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_company_id_foreign` (`company_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_payments`
--
ALTER TABLE `vendor_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_payment_data`
--
ALTER TABLE `vendor_payment_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_payment_data_vendor_payment_id_foreign` (`vendor_payment_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `access_logs`
--
ALTER TABLE `access_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `account_transactions`
--
ALTER TABLE `account_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `account_transaction_autos`
--
ALTER TABLE `account_transaction_autos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `admin_menu_actions`
--
ALTER TABLE `admin_menu_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bulk_collections`
--
ALTER TABLE `bulk_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bulk_collection_lists`
--
ALTER TABLE `bulk_collection_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `category_vendors`
--
ALTER TABLE `category_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `chain_clients`
--
ALTER TABLE `chain_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3037;

--
-- AUTO_INCREMENT for table `client_categories`
--
ALTER TABLE `client_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_messages`
--
ALTER TABLE `client_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client_prices`
--
ALTER TABLE `client_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `coa_setups`
--
ALTER TABLE `coa_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collection_data`
--
ALTER TABLE `collection_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crm_customer_requirements`
--
ALTER TABLE `crm_customer_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crm_leads`
--
ALTER TABLE `crm_leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `crm_lead_sources`
--
ALTER TABLE `crm_lead_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `crm_lead_statuses`
--
ALTER TABLE `crm_lead_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `crm_meeting_schedules`
--
ALTER TABLE `crm_meeting_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crm_quotations`
--
ALTER TABLE `crm_quotations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crm_quotation_details`
--
ALTER TABLE `crm_quotation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_lists`
--
ALTER TABLE `delivery_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_men`
--
ALTER TABLE `delivery_men`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `details_cards`
--
ALTER TABLE `details_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `group_sales_targets`
--
ALTER TABLE `group_sales_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group_sales_target_categories`
--
ALTER TABLE `group_sales_target_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `home_sections`
--
ALTER TABLE `home_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `home_section_sub_categories`
--
ALTER TABLE `home_section_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hrm_employee_appraisal`
--
ALTER TABLE `hrm_employee_appraisal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrm_employee_attendances`
--
ALTER TABLE `hrm_employee_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hrm_employee_bonuses`
--
ALTER TABLE `hrm_employee_bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrm_employee_documents`
--
ALTER TABLE `hrm_employee_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrm_employee_holidays`
--
ALTER TABLE `hrm_employee_holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrm_employee_increment`
--
ALTER TABLE `hrm_employee_increment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrm_employee_leaves`
--
ALTER TABLE `hrm_employee_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hrm_employee_loan`
--
ALTER TABLE `hrm_employee_loan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrm_employee_overtime`
--
ALTER TABLE `hrm_employee_overtime`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrm_employee_payrolls`
--
ALTER TABLE `hrm_employee_payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `hrm_employee_resignation`
--
ALTER TABLE `hrm_employee_resignation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrm_employee_termination`
--
ALTER TABLE `hrm_employee_termination`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hrm_expense`
--
ALTER TABLE `hrm_expense`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investor_payments`
--
ALTER TABLE `investor_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investor_profits`
--
ALTER TABLE `investor_profits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investor_profit_lists`
--
ALTER TABLE `investor_profit_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invests`
--
ALTER TABLE `invests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liftings`
--
ALTER TABLE `liftings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lifting_documents`
--
ALTER TABLE `lifting_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lifting_products`
--
ALTER TABLE `lifting_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lifting_returns`
--
ALTER TABLE `lifting_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `lifting_return_lists`
--
ALTER TABLE `lifting_return_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT for table `lifting_return_payments`
--
ALTER TABLE `lifting_return_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `online_deliveries`
--
ALTER TABLE `online_deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_delivery_lists`
--
ALTER TABLE `online_delivery_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=715;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_order_sections`
--
ALTER TABLE `pre_order_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_order_setups`
--
ALTER TABLE `pre_order_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_skus`
--
ALTER TABLE `product_skus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_vendors`
--
ALTER TABLE `product_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `retail_returns`
--
ALTER TABLE `retail_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `retail_return_lists`
--
ALTER TABLE `retail_return_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `retail_sales`
--
ALTER TABLE `retail_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `retail_sale_lists`
--
ALTER TABLE `retail_sale_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_lists`
--
ALTER TABLE `sales_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_product_data`
--
ALTER TABLE `sales_product_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return_lists`
--
ALTER TABLE `sales_return_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `showcase_items`
--
ALTER TABLE `showcase_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `social_works`
--
ALTER TABLE `social_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `special_food_items`
--
ALTER TABLE `special_food_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `static_site_items`
--
ALTER TABLE `static_site_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store_areas`
--
ALTER TABLE `store_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `territories`
--
ALTER TABLE `territories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_products`
--
ALTER TABLE `transfer_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `vendor_payments`
--
ALTER TABLE `vendor_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_payment_data`
--
ALTER TABLE `vendor_payment_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- Structure for view `view_all_sales`
--
DROP TABLE IF EXISTS `view_all_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all_sales`  AS SELECT `sales_lists`.`product_id` AS `product_id`, `products`.`name` AS `product_name`, `products`.`code` AS `product_code`, `products`.`category_id` AS `category_id`, `categories`.`name` AS `category_name`, `attributes`.`name` AS `attribute_name`, `sales_lists`.`rate` AS `rate`, `sales_lists`.`qty` AS `qty`, `sales_lists`.`amount`- `sales_lists`.`discount` AS `amount`, `sales`.`store_id` AS `store_id`, `sales`.`date` AS `date` FROM ((((`sales_lists` left join `sales` on(`sales`.`id` = `sales_lists`.`sales_id` and `sales`.`deleted_at` is null)) left join `products` on(`products`.`id` = `sales_lists`.`product_id`)) left join `attributes` on(`attributes`.`id` = `products`.`attribute_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_client_collections`
--
DROP TABLE IF EXISTS `view_client_collections`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_client_collections`  AS SELECT `clients`.`id` AS `client_id`, `collections`.`payment_date` AS `payment_date`, `collections`.`collection_type` AS `collection_type`, `collections`.`amount` AS `amount` FROM (`clients` left join `collections` on(`clients`.`id` = `collections`.`client_id` and `collections`.`collection_type` <> 'adjust' and `collections`.`deleted_at` is null)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_client_realization_sales`
--
DROP TABLE IF EXISTS `view_client_realization_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_client_realization_sales`  AS SELECT `sales`.`company_id` AS `company_id`, `sales`.`client_id` AS `client_id`, `clients`.`client_category_id` AS `client_category_id`, `client_categories`.`name` AS `client_category_name`, `clients`.`name` AS `client_name`, `clients`.`phone` AS `client_phone`, `clients`.`code` AS `client_code`, `areas`.`region_id` AS `region_id`, `regions`.`name` AS `region_name`, `clients`.`area_id` AS `area_id`, `areas`.`name` AS `area_name`, `clients`.`territory_id` AS `territory_id`, `territories`.`name` AS `territory_name`, `sales`.`date` AS `date`, `sales`.`total_amount`- `sales`.`discount` AS `amount`, `sales`.`total_paid` AS `total_paid`, `sales`.`staff_id` AS `staff_id`, `staff`.`name` AS `staff_name` FROM ((((((`sales` left join `clients` on(`clients`.`id` = `sales`.`client_id`)) left join `areas` on(`areas`.`id` = `clients`.`area_id`)) left join `regions` on(`regions`.`id` = `areas`.`region_id`)) left join `territories` on(`territories`.`id` = `clients`.`territory_id`)) left join `staff` on(`staff`.`id` = `sales`.`staff_id`)) left join `client_categories` on(`client_categories`.`id` = `clients`.`client_category_id`)) WHERE `clients`.`deleted_at` is null AND `sales`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_client_returns`
--
DROP TABLE IF EXISTS `view_client_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_client_returns`  AS SELECT `clients`.`company_id` AS `company_id`, `clients`.`id` AS `client_id`, `client_categories`.`id` AS `client_category_id`, `client_categories`.`name` AS `client_category_name`, `sales_returns`.`date` AS `date`, `sales_return_lists`.`amount`- `sales_return_lists`.`sales_discount` AS `amount` FROM (((`clients` left join `sales_returns` on(`clients`.`id` = `sales_returns`.`client_id` and `sales_returns`.`deleted_at` is null)) left join `client_categories` on(`client_categories`.`id` = `clients`.`client_category_id` and `client_categories`.`deleted_at` is null)) left join `sales_return_lists` on(`sales_returns`.`id` = `sales_return_lists`.`sales_return_id`)) WHERE `clients`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_client_sales`
--
DROP TABLE IF EXISTS `view_client_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_client_sales`  AS SELECT `sales_lists`.`company_id` AS `company_id`, `sales_lists`.`client_id` AS `client_id`, `client_categories`.`id` AS `client_category_id`, `client_categories`.`name` AS `client_category_name`, `clients`.`name` AS `client_name`, `clients`.`phone` AS `client_phone`, `clients`.`code` AS `client_code`, `regions`.`id` AS `region_id`, `regions`.`name` AS `region_name`, `areas`.`id` AS `area_id`, `areas`.`name` AS `area_name`, `territories`.`id` AS `territory_id`, `territories`.`name` AS `territory_name`, `sales`.`date` AS `date`, sum(`sales_lists`.`amount`) - sum(`sales_lists`.`discount`) - sum(`sales_lists`.`returned_amount`) AS `amount`, `sales`.`total_paid` AS `total_paid`, `staff`.`id` AS `staff_id`, `staff`.`name` AS `staff_name` FROM (((((((`sales_lists` left join `sales` on(`sales`.`id` = `sales_lists`.`sales_id`)) left join `clients` on(`clients`.`id` = `sales`.`client_id`)) left join `staff` on(`staff`.`id` = `sales`.`staff_id` and `staff`.`deleted_at` is null)) left join `client_categories` on(`client_categories`.`id` = `clients`.`client_category_id` and `client_categories`.`deleted_at` is null)) left join `areas` on(`areas`.`id` = `clients`.`area_id` and `areas`.`deleted_at` is null)) left join `regions` on(`regions`.`id` = `areas`.`region_id` and `regions`.`deleted_at` is null)) left join `territories` on(`territories`.`id` = `clients`.`territory_id` and `territories`.`deleted_at` is null)) WHERE `sales`.`deleted_at` is null AND `clients`.`deleted_at` is null GROUP BY `sales_lists`.`sales_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_collectionable_sales`
--
DROP TABLE IF EXISTS `view_collectionable_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_collectionable_sales`  AS SELECT `sales`.`id` AS `id`, `sales`.`company_id` AS `company_id`, `sales`.`store_id` AS `store_id`, `sales`.`client_id` AS `client_id`, `clients`.`name` AS `client_name`, `sales`.`invoice` AS `invoice`, `sales`.`date` AS `date`, `sales`.`total_amount` AS `total_amount`, `sales`.`total_paid` AS `total_paid`, `sales`.`discount` AS `discount`, sum(`sales_lists`.`returned_amount`) AS `returned_amount`, `sales`.`total_amount`- sum(`sales_lists`.`returned_amount`) - `sales`.`discount` - `sales`.`total_paid` AS `collectionable_amount` FROM ((`sales_lists` left join `clients` on(`clients`.`id` = `sales_lists`.`client_id`)) left join `sales` on(`sales`.`id` = `sales_lists`.`sales_id`)) WHERE `sales`.`deleted_at` is null GROUP BY `sales`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_collection_history`
--
DROP TABLE IF EXISTS `view_collection_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_collection_history`  AS SELECT `collections`.`company_id` AS `company_id`, `collections`.`collection_type` AS `collection_type`, `collections`.`payment_no` AS `payment_no`, `collections`.`payment_type` AS `payment_type`, `collections`.`amount` AS `amount`, `collections`.`payment_date` AS `date`, `collections`.`client_id` AS `client_id`, `clients`.`name` AS `client_name`, `client_categories`.`name` AS `client_category_name`, `areas`.`region_id` AS `region_id`, `clients`.`area_id` AS `area_id`, `areas`.`name` AS `area_name`, `clients`.`territory_id` AS `territory_id`, `territories`.`name` AS `territory_name`, `staff`.`id` AS `staff_id`, `staff`.`name` AS `staff_name`, `collections`.`created_by` AS `created_by`, `users`.`name` AS `entry_name` FROM ((((((`collections` left join `clients` on(`clients`.`id` = `collections`.`client_id`)) left join `client_categories` on(`client_categories`.`id` = `clients`.`client_category_id`)) left join `areas` on(`areas`.`id` = `clients`.`area_id`)) left join `territories` on(`territories`.`id` = `clients`.`territory_id`)) left join `staff` on(`staff`.`id` = `collections`.`staff_id`)) left join `users` on(`users`.`id` = `collections`.`created_by`)) WHERE `collections`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_liftings`
--
DROP TABLE IF EXISTS `view_liftings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_liftings`  AS SELECT `liftings`.`company_id` AS `company_id`, `liftings`.`store_id` AS `store_id`, `liftings`.`lifting_date` AS `date`, `liftings`.`product_type` AS `product_type`, `lifting_products`.`product_id` AS `product_id`, `products`.`name` AS `name`, `products`.`code` AS `code`, `products`.`alert_quantity` AS `alert_quantity`, `products`.`shared_profit` AS `shared_profit`, `lifting_products`.`variant_id` AS `variant_id`, `attributes`.`name` AS `attribute_name`, `categories`.`id` AS `category_id`, `categories`.`name` AS `category_name`, `product_prices`.`sale_price` AS `sale_price`, `product_prices`.`online_price` AS `online_price`, `product_skus`.`id` AS `sku_id`, `product_skus`.`sku` AS `sku`, `product_skus`.`price` AS `variant_price`, `lifting_products`.`qty` AS `qty`, `lifting_products`.`total_amount`- `lifting_products`.`discount` AS `amount` FROM ((((((`lifting_products` left join `products` on(`products`.`id` = `lifting_products`.`product_id`)) left join `product_prices` on(`product_prices`.`product_id` = `products`.`id`)) left join `attributes` on(`attributes`.`id` = `products`.`attribute_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) left join `product_skus` on(`product_skus`.`id` = `lifting_products`.`variant_id`)) left join `liftings` on(`liftings`.`id` = `lifting_products`.`lifting_id`)) WHERE `liftings`.`deleted_at` is null AND `products`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_lifting_and_returns`
--
DROP TABLE IF EXISTS `view_lifting_and_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_lifting_and_returns`  AS SELECT `liftings`.`id` AS `id`, `liftings`.`company_id` AS `company_id`, `liftings`.`lifting_no` AS `lifting_no`, `liftings`.`lifting_date` AS `date`, `liftings`.`store_id` AS `store_id`, `liftings`.`vendor_id` AS `vendor_id`, sum(`lifting_products`.`total_amount`) AS `total_amount`, sum(`lifting_products`.`discount`) AS `discount`, sum(`lifting_products`.`total_amount`) - sum(`lifting_products`.`discount`) AS `payable_amount`, round(sum((`lifting_products`.`total_amount` - `lifting_products`.`discount`) / `lifting_products`.`qty` * `lifting_products`.`return_qty`),2) AS `return_amount`, `liftings`.`total_paid` AS `total_paid` FROM (`lifting_products` left join `liftings` on(`liftings`.`id` = `lifting_products`.`lifting_id`)) WHERE `liftings`.`deleted_at` is null GROUP BY `lifting_products`.`lifting_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_lifting_returns`
--
DROP TABLE IF EXISTS `view_lifting_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_lifting_returns`  AS SELECT `lifting_returns`.`company_id` AS `company_id`, `lifting_returns`.`store_id` AS `store_id`, `lifting_returns`.`date` AS `date`, `lifting_returns`.`product_type` AS `product_type`, `lifting_return_lists`.`product_id` AS `product_id`, `product_skus`.`id` AS `sku_id`, `product_skus`.`sku` AS `sku`, `lifting_return_lists`.`qty` AS `qty`, `lifting_return_lists`.`amount`- `lifting_return_lists`.`lifting_discount` AS `amount` FROM (((`lifting_return_lists` left join `products` on(`products`.`id` = `lifting_return_lists`.`product_id`)) left join `product_skus` on(`product_skus`.`id` = `lifting_return_lists`.`variant_id`)) left join `lifting_returns` on(`lifting_returns`.`id` = `lifting_return_lists`.`lifting_return_id`)) WHERE `lifting_returns`.`deleted_at` is null AND `products`.`deleted_at` is null AND `products`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_online_all_sales`
--
DROP TABLE IF EXISTS `view_online_all_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_online_all_sales`  AS SELECT `order_products`.`order_id` AS `order_id`, `order_products`.`id` AS `order_product_id`, `products`.`company_id` AS `company_id`, `products`.`product_type` AS `product_type`, `order_products`.`product_id` AS `product_id`, `order_products`.`variant_id` AS `sku_id`, `products`.`category_id` AS `category_id`, `products`.`name` AS `name`, `products`.`code` AS `code`, `order_products`.`quantity` AS `qty`, `order_products`.`subtotal`- `order_products`.`return_amount` - `order_products`.`discount` AS `amount`, `order_products`.`return_amount` AS `return_amount`, `orders`.`date` AS `date`, `orders`.`store_id` AS `store_id`, `orders`.`status` AS `status`, `orders`.`area_id` AS `area_id` FROM ((`order_products` left join `products` on(`products`.`id` = `order_products`.`product_id`)) left join `orders` on(`orders`.`id` = `order_products`.`order_id`)) WHERE `orders`.`deleted_at` is null AND `products`.`deleted_at` is null AND `products`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_online_returns`
--
DROP TABLE IF EXISTS `view_online_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_online_returns`  AS SELECT `products`.`company_id` AS `company_id`, `products`.`product_type` AS `product_type`, `order_products`.`product_id` AS `product_id`, `order_products`.`variant_id` AS `sku_id`, `products`.`category_id` AS `category_id`, `products`.`name` AS `name`, `products`.`code` AS `code`, `order_products`.`quantity` AS `qty`, `order_products`.`subtotal` AS `amount`, `orders`.`date` AS `date`, `orders`.`store_id` AS `store_id` FROM ((`order_products` left join `products` on(`products`.`id` = `order_products`.`product_id`)) left join `orders` on(`orders`.`id` = `order_products`.`order_id`)) WHERE `orders`.`deleted_at` is null AND `orders`.`status` = 'Returned' OR `orders`.`status` = 'Cancelled' AND `products`.`deleted_at` is null AND `products`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_online_sales`
--
DROP TABLE IF EXISTS `view_online_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_online_sales`  AS SELECT `order_products`.`order_id` AS `order_id`, `order_products`.`id` AS `order_product_id`, `products`.`company_id` AS `company_id`, `products`.`product_type` AS `product_type`, `order_products`.`product_id` AS `product_id`, `order_products`.`variant_id` AS `sku_id`, `products`.`category_id` AS `category_id`, `products`.`name` AS `name`, `products`.`code` AS `code`, `order_products`.`quantity` AS `qty`, `order_products`.`subtotal`- `order_products`.`return_amount` - `order_products`.`discount` AS `amount`, `orders`.`date` AS `date`, `orders`.`store_id` AS `store_id`, `orders`.`status` AS `status` FROM ((`order_products` left join `products` on(`products`.`id` = `order_products`.`product_id`)) left join `orders` on(`orders`.`id` = `order_products`.`order_id`)) WHERE `orders`.`deleted_at` is null AND `products`.`deleted_at` is null AND `products`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_payments`
--
DROP TABLE IF EXISTS `view_payments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_payments`  AS SELECT `vendor_payments`.`company_id` AS `company_id`, `vendor_payments`.`vendor_id` AS `vendor_id`, `vendor_payments`.`payment_no` AS `payment_no`, `vendor_payments`.`payment_date` AS `date`, `vendor_payments`.`payment_type` AS `payment_type`, `vendor_payments`.`type` AS `type`, `vendor_payments`.`amount` AS `amount`, `vendors`.`name` AS `vendor_name` FROM (`vendor_payments` left join `vendors` on(`vendors`.`id` = `vendor_payments`.`vendor_id`)) WHERE `vendor_payments`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_product_returns`
--
DROP TABLE IF EXISTS `view_product_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_product_returns`  AS SELECT `products`.`company_id` AS `company_id`, `products`.`id` AS `product_id`, `products`.`category_id` AS `category_id`, `products`.`name` AS `name`, `products`.`code` AS `code`, `sales_returns`.`date` AS `date`, `sales_return_lists`.`qty` AS `qty`, `sales_return_lists`.`amount`- `sales_return_lists`.`sales_discount` AS `amount` FROM ((`products` left join `sales_return_lists` on(`products`.`id` = `sales_return_lists`.`product_id`)) left join `sales_returns` on(`sales_returns`.`id` = `sales_return_lists`.`sales_return_id` and `sales_returns`.`deleted_at` is null)) WHERE `products`.`deleted_at` is null AND `products`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_product_sales`
--
DROP TABLE IF EXISTS `view_product_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_product_sales`  AS SELECT `sales_lists`.`company_id` AS `company_id`, `sales_lists`.`client_id` AS `client_id`, `client_categories`.`id` AS `client_category_id`, `client_categories`.`name` AS `client_category_name`, `clients`.`name` AS `client_name`, `clients`.`phone` AS `client_phone`, `clients`.`code` AS `client_code`, `regions`.`id` AS `region_id`, `regions`.`name` AS `region_name`, `areas`.`id` AS `area_id`, `areas`.`name` AS `area_name`, `territories`.`id` AS `territory_id`, `territories`.`name` AS `territory_name`, `sales`.`date` AS `date`, sum(`sales_lists`.`amount`) - sum(`sales_lists`.`discount`) - sum(`sales_lists`.`returned_amount`) AS `amount`, `sales`.`total_paid` AS `total_paid`, `staff`.`id` AS `staff_id`, `staff`.`name` AS `staff_name` FROM (((((((`sales_lists` left join `sales` on(`sales`.`id` = `sales_lists`.`sales_id`)) left join `clients` on(`clients`.`id` = `sales`.`client_id`)) left join `staff` on(`staff`.`id` = `sales`.`staff_id` and `staff`.`deleted_at` is null)) left join `client_categories` on(`client_categories`.`id` = `clients`.`client_category_id` and `client_categories`.`deleted_at` is null)) left join `areas` on(`areas`.`id` = `clients`.`area_id` and `areas`.`deleted_at` is null)) left join `regions` on(`regions`.`id` = `areas`.`region_id` and `regions`.`deleted_at` is null)) left join `territories` on(`territories`.`id` = `clients`.`territory_id` and `territories`.`deleted_at` is null)) WHERE `sales`.`deleted_at` is null AND `clients`.`deleted_at` is null GROUP BY `sales_lists`.`sales_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_retail_returns`
--
DROP TABLE IF EXISTS `view_retail_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_retail_returns`  AS SELECT `retail_returns`.`company_id` AS `company_id`, `retail_returns`.`store_id` AS `store_id`, `retail_returns`.`date` AS `date`, `retail_returns`.`product_type` AS `product_type`, `retail_return_lists`.`product_id` AS `product_id`, `products`.`name` AS `name`, `categories`.`id` AS `category_id`, `categories`.`name` AS `category_name`, `product_skus`.`id` AS `sku_id`, `product_skus`.`sku` AS `sku`, `retail_return_lists`.`qty` AS `qty`, `retail_return_lists`.`amount`- `retail_return_lists`.`sales_discount` AS `amount` FROM ((((`retail_return_lists` left join `products` on(`products`.`id` = `retail_return_lists`.`product_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) left join `product_skus` on(`product_skus`.`id` = `retail_return_lists`.`variant_id`)) left join `retail_returns` on(`retail_returns`.`id` = `retail_return_lists`.`retail_return_id`)) WHERE `retail_returns`.`deleted_at` is null AND `products`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_retail_sales`
--
DROP TABLE IF EXISTS `view_retail_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_retail_sales`  AS SELECT `retail_sale_lists`.`company_id` AS `company_id`, `retail_sales`.`store_id` AS `store_id`, `retail_sales`.`date` AS `date`, `retail_sale_lists`.`product_type` AS `product_type`, `retail_sale_lists`.`retail_sale_id` AS `retail_sale_id`, `retail_sale_lists`.`product_id` AS `product_id`, `retail_sale_lists`.`variant_id` AS `sku_id`, `retail_sale_lists`.`rate` AS `rate`, `retail_sale_lists`.`qty` AS `qty`, `retail_sale_lists`.`amount`- `retail_sale_lists`.`discount` AS `amount` FROM ((`retail_sale_lists` left join `products` on(`products`.`id` = `retail_sale_lists`.`product_id`)) left join `retail_sales` on(`retail_sales`.`id` = `retail_sale_lists`.`retail_sale_id`)) WHERE `retail_sales`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_retail_sales_all`
--
DROP TABLE IF EXISTS `view_retail_sales_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_retail_sales_all`  AS SELECT `retail_sale_lists`.`company_id` AS `company_id`, `retail_sales`.`store_id` AS `store_id`, `retail_sales`.`date` AS `date`, `retail_sale_lists`.`product_type` AS `product_type`, `retail_sale_lists`.`retail_sale_id` AS `retail_sale_id`, `retail_sale_lists`.`product_id` AS `product_id`, `retail_sale_lists`.`variant_id` AS `sku_id`, `retail_sale_lists`.`rate` AS `rate`, `retail_sale_lists`.`qty` AS `qty`, `retail_sale_lists`.`amount`- `retail_sale_lists`.`discount` AS `amount` FROM ((`retail_sale_lists` left join `products` on(`products`.`id` = `retail_sale_lists`.`product_id`)) left join `retail_sales` on(`retail_sales`.`id` = `retail_sale_lists`.`retail_sale_id`)) WHERE `retail_sales`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_sales`
--
DROP TABLE IF EXISTS `view_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sales`  AS SELECT `sales`.`company_id` AS `company_id`, `sales`.`store_id` AS `store_id`, `regions`.`id` AS `region_id`, `clients`.`area_id` AS `area_id`, `sales`.`date` AS `date`, `sales`.`product_type` AS `product_type`, `sales`.`sales_type` AS `sales_type`, `sales_lists`.`product_id` AS `product_id`, `products`.`name` AS `name`, `categories`.`id` AS `category_id`, `categories`.`name` AS `category_name`, `product_skus`.`id` AS `sku_id`, `product_skus`.`sku` AS `sku`, `sales_lists`.`qty` AS `qty`, `sales_lists`.`amount`- `sales_lists`.`discount` AS `amount`, `sales_lists`.`returned_qty` AS `returned_qty`, `sales_lists`.`returned_amount` AS `returned_amount` FROM (((((((`sales_lists` left join `products` on(`products`.`id` = `sales_lists`.`product_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) left join `product_skus` on(`product_skus`.`id` = `sales_lists`.`variant_id`)) left join `clients` on(`clients`.`id` = `sales_lists`.`client_id`)) left join `areas` on(`areas`.`id` = `clients`.`area_id`)) left join `regions` on(`regions`.`id` = `areas`.`region_id`)) left join `sales` on(`sales`.`id` = `sales_lists`.`sales_id`)) WHERE `sales`.`deleted_at` is null AND `products`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_sales_history`
--
DROP TABLE IF EXISTS `view_sales_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sales_history`  AS SELECT `sales_lists`.`company_id` AS `company_id`, `sales_lists`.`product_id` AS `product_id`, `sales_lists`.`sales_id` AS `sales_id`, `products`.`name` AS `product_name`, `products`.`code` AS `product_code`, `products`.`category_id` AS `category_id`, `vendors`.`name` AS `product_vendor_name`, `categories`.`name` AS `category_name`, `attributes`.`name` AS `attribute_name`, `sales_lists`.`rate` AS `rate`, `sales_lists`.`qty` AS `qty`, `sales_lists`.`amount`- `sales_lists`.`discount` AS `amount`, `sales`.`store_id` AS `store_id`, `sales`.`staff_id` AS `staff_id`, `staff`.`name` AS `staff_name`, `sales`.`client_id` AS `client_id`, `clients`.`name` AS `client_name`, `client_categories`.`name` AS `client_category_name`, `areas`.`region_id` AS `region_id`, `areas`.`name` AS `area_name`, `clients`.`area_id` AS `area_id`, `clients`.`territory_id` AS `territory_id`, `territories`.`name` AS `territory_name`, `sales`.`invoice` AS `invoice`, `sales`.`date` AS `date`, `sales`.`sales_type` AS `sales_type` FROM ((((((((((`sales_lists` left join `sales` on(`sales`.`id` = `sales_lists`.`sales_id` and `sales`.`deleted_at` is null)) left join `staff` on(`staff`.`id` = `sales`.`staff_id`)) left join `clients` on(`clients`.`id` = `sales_lists`.`client_id`)) left join `areas` on(`areas`.`id` = `clients`.`area_id`)) left join `products` on(`products`.`id` = `sales_lists`.`product_id`)) left join `attributes` on(`attributes`.`id` = `products`.`attribute_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) left join `client_categories` on(`client_categories`.`id` = `clients`.`client_category_id`)) left join `vendors` on(`vendors`.`id` = `products`.`vendor_id`)) left join `territories` on(`territories`.`id` = `clients`.`territory_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_sales_returns`
--
DROP TABLE IF EXISTS `view_sales_returns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sales_returns`  AS SELECT `sales_returns`.`company_id` AS `company_id`, `sales_returns`.`store_id` AS `store_id`, `regions`.`id` AS `region_id`, `clients`.`area_id` AS `area_id`, `sales_returns`.`date` AS `date`, `sales_returns`.`product_type` AS `product_type`, `sales_return_lists`.`product_id` AS `product_id`, `products`.`name` AS `name`, `categories`.`id` AS `category_id`, `categories`.`name` AS `category_name`, `product_skus`.`id` AS `sku_id`, `product_skus`.`sku` AS `sku`, `sales_return_lists`.`qty` AS `qty`, `sales_return_lists`.`amount`- `sales_return_lists`.`sales_discount` AS `amount` FROM (((((((`sales_return_lists` left join `products` on(`products`.`id` = `sales_return_lists`.`product_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) left join `product_skus` on(`product_skus`.`id` = `sales_return_lists`.`variant_id`)) left join `clients` on(`clients`.`id` = `sales_return_lists`.`client_id`)) left join `areas` on(`areas`.`id` = `clients`.`area_id`)) left join `regions` on(`regions`.`id` = `areas`.`region_id`)) left join `sales_returns` on(`sales_returns`.`id` = `sales_return_lists`.`sales_return_id`)) WHERE `sales_returns`.`deleted_at` is null AND `sales_returns`.`approve` = 1 AND `sales_returns`.`reject` = 0 AND `products`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_transfers`
--
DROP TABLE IF EXISTS `view_transfers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transfers`  AS SELECT `transfers`.`company_id` AS `company_id`, `transfers`.`host_id` AS `host_id`, `transfers`.`destination_id` AS `destination_id`, `transfers`.`date` AS `date`, `transfers`.`product_type` AS `product_type`, `transfer_products`.`product_id` AS `product_id`, `products`.`name` AS `name`, `categories`.`id` AS `category_id`, `categories`.`name` AS `category_name`, `product_skus`.`id` AS `sku_id`, `product_skus`.`sku` AS `sku`, `transfer_products`.`qty` AS `qty` FROM ((((`transfer_products` left join `products` on(`products`.`id` = `transfer_products`.`product_id`)) left join `categories` on(`categories`.`id` = `products`.`category_id`)) left join `product_skus` on(`product_skus`.`id` = `transfer_products`.`variant_id`)) left join `transfers` on(`transfers`.`id` = `transfer_products`.`transfer_id`)) WHERE `transfers`.`deleted_at` is null AND `transfers`.`reject` = 0 AND `transfer_products`.`is_back` = 0 AND `products`.`deleted_at` is null AND `products`.`status` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `view_trial_balance`
--
DROP TABLE IF EXISTS `view_trial_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_trial_balance`  AS SELECT `account_transactions`.`voucher_type` AS `voucher_type`, `account_transactions`.`voucher_no` AS `voucher_no`, `account_transactions`.`voucher_date` AS `voucher_date`, `account_transactions`.`coa_setup_id` AS `coa_setup_id`, `account_transactions`.`coa_head_code` AS `coa_head_code`, `account_transactions`.`debit_amount` AS `debit_amount`, `account_transactions`.`credit_amount` AS `credit_amount`, `coa_setups`.`transaction` AS `transaction`, `coa_setups`.`general` AS `general`, `coa_setups`.`parent_id` AS `parent_id`, `coa_setups`.`head_type` AS `head_type`, `coa_setups`.`head_name` AS `head_name` FROM (`account_transactions` left join `coa_setups` on(`coa_setups`.`id` = `account_transactions`.`coa_setup_id`)) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_transactions`
--
ALTER TABLE `account_transactions`
  ADD CONSTRAINT `account_transactions_account_transaction_auto_id_foreign` FOREIGN KEY (`account_transaction_auto_id`) REFERENCES `account_transaction_autos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bulk_collection_lists`
--
ALTER TABLE `bulk_collection_lists`
  ADD CONSTRAINT `bulk_collection_lists_bulk_collection_id_foreign` FOREIGN KEY (`bulk_collection_id`) REFERENCES `bulk_collections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_prices`
--
ALTER TABLE `client_prices`
  ADD CONSTRAINT `client_prices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collection_data`
--
ALTER TABLE `collection_data`
  ADD CONSTRAINT `collection_data_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_leads`
--
ALTER TABLE `crm_leads`
  ADD CONSTRAINT `fk_lead_source` FOREIGN KEY (`lead_source_id`) REFERENCES `crm_lead_sources` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_lead_status` FOREIGN KEY (`lead_status_id`) REFERENCES `crm_lead_statuses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `crm_meeting_schedules`
--
ALTER TABLE `crm_meeting_schedules`
  ADD CONSTRAINT `fk_meeting_lead` FOREIGN KEY (`lead_id`) REFERENCES `crm_leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_quotation_details`
--
ALTER TABLE `crm_quotation_details`
  ADD CONSTRAINT `fk_quotation_details_quotation` FOREIGN KEY (`quotation_id`) REFERENCES `crm_quotations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_lists`
--
ALTER TABLE `delivery_lists`
  ADD CONSTRAINT `delivery_lists_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_sales_targets`
--
ALTER TABLE `group_sales_targets`
  ADD CONSTRAINT `group_sales_targets_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_sales_target_categories`
--
ALTER TABLE `group_sales_target_categories`
  ADD CONSTRAINT `group_sales_target_categories_group_sales_target_id_foreign` FOREIGN KEY (`group_sales_target_id`) REFERENCES `group_sales_targets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `home_section_sub_categories`
--
ALTER TABLE `home_section_sub_categories`
  ADD CONSTRAINT `home_section_sub_categories_home_section_id_foreign` FOREIGN KEY (`home_section_id`) REFERENCES `home_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investors`
--
ALTER TABLE `investors`
  ADD CONSTRAINT `investors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investor_payments`
--
ALTER TABLE `investor_payments`
  ADD CONSTRAINT `investor_payments_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investor_profit_lists`
--
ALTER TABLE `investor_profit_lists`
  ADD CONSTRAINT `investor_profit_lists_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `investor_profit_lists_investor_profit_id_foreign` FOREIGN KEY (`investor_profit_id`) REFERENCES `investor_profits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invests`
--
ALTER TABLE `invests`
  ADD CONSTRAINT `invests_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liftings`
--
ALTER TABLE `liftings`
  ADD CONSTRAINT `liftings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lifting_documents`
--
ALTER TABLE `lifting_documents`
  ADD CONSTRAINT `lifting_documents_lifting_id_foreign` FOREIGN KEY (`lifting_id`) REFERENCES `liftings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lifting_products`
--
ALTER TABLE `lifting_products`
  ADD CONSTRAINT `lifting_products_lifting_id_foreign` FOREIGN KEY (`lifting_id`) REFERENCES `liftings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lifting_return_lists`
--
ALTER TABLE `lifting_return_lists`
  ADD CONSTRAINT `lifting_return_lists_lifting_return_id_foreign` FOREIGN KEY (`lifting_return_id`) REFERENCES `lifting_returns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
