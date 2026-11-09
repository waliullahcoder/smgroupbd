-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 09:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_tracker`
--

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
(1, 'WELCOME TO BONTON FOODS', '<div>Welcome to Bonton Foods Limited. We are a company founded and established in Dhaka, BD, created with the purpose of supplying food products to satisfy the continuous and timely stock replenishment of the food industry. We have several years of experience supplying the best products, with the highest quality and the best prices in the market. We are leading company in the marketing and distribution of meat products, dairy products and other products derived from grains and cereals, such as corn and quinoa.</div><div><br></div><div>We are proud and privileged for the support from our suppliers, for the fresh and quality in all our products and for the outstanding human capital who has allowed&nbsp;&nbsp;Bonton Foods Limited. a positive and outstanding expansion of the local market.</div><div><br></div><div>But beyond this, we are pleased that our highly trained and qualified staff is always ready to meet all your needs with a great willingness to build an excellent business relationship with our suppliers and customers that lasts over time.</div>', 'SHOP WITH US, RESTOCK YOUR INVENTORY QUICK & EASY.', 'OUR VISION', '&nbsp;Bonton Foods Limited&nbsp;was born with the intention of inspiring our customers towards a healthier lifestyle by offering high quality products. This lifestyle is not only nutritious and great tasting, but also practical.', 'OUR MISSION', 'Our company plans on achieving our vision by partnering with the largest and grain agriculture in Bangladesh,', 'SOCIAL WORKING', 'BONTON FOODS LIMITED - ALWAYS, CLOSE TO YOU.', '<div>We are proud to sponsor the Fundación Franlanqui, a non-profit organization founded more than 5 years ago, made up of a group of people dedicated to help other people who have become homeless or low-income people, by the donation of clothes, medicines, food, water or even economic resources needed to handle health issues. You can be a part of this!, Join us!</div><div><br></div>', 'http://localhost/technoparkbd/public/', '2023-10-04 03:28:29', '2023-10-18 14:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `admin_menus` (`id`, `permission_id`, `parent_id`, `name`, `route`, `icon`, `order`, `status`, `delete`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Dashboard', 'admin.dashboard', '<i class=\"fad fa-tachometer-alt-fastest\"></i>', 1, 1, 1, '2023-09-19 09:04:28', '2023-09-19 09:04:28'),
(2, 2, NULL, 'System Setting', NULL, '<i class=\"fad fa-users-cog\"></i>', 2, 1, 1, '2023-09-19 09:05:17', '2023-09-19 09:05:17'),
(3, 3, 2, 'Company Setup', 'admin.company.index', NULL, 1, 1, 1, '2023-09-19 09:05:30', '2023-09-19 09:11:55'),
(4, 4, 2, 'Branch Setup', 'admin.branch.index', NULL, 2, 1, 1, '2023-09-19 09:05:39', '2023-09-19 09:12:52'),
(5, 5, 2, 'Role Setup', 'admin.role.index', NULL, 3, 1, 1, '2023-09-19 09:05:48', '2023-09-19 09:13:04'),
(6, 6, 2, 'User Setup', 'admin.user.index', NULL, 4, 1, 1, '2023-09-19 09:05:55', '2023-09-19 09:15:19'),
(7, 7, 2, 'Menu Setup', 'admin.admin-menu.index', NULL, 5, 1, 1, '2023-09-19 09:06:24', '2023-09-19 09:15:35'),
(8, 20, NULL, 'System Setup', NULL, '<i class=\"fad fa-tools\"></i>', 3, 1, 1, '2023-09-19 09:20:32', '2023-09-19 09:20:32'),
(9, 21, 8, 'Sales Group', 'admin.group.index', NULL, 5, 1, 1, '2023-09-19 09:20:46', '2023-09-25 07:50:45'),
(10, 22, 8, 'Store Setup', 'admin.store.index', NULL, 3, 1, 1, '2023-09-19 09:20:59', '2023-09-23 14:49:13'),
(11, 23, 8, 'Product Type', 'admin.category.index', NULL, 8, 1, 1, '2023-09-19 09:21:10', '2023-09-25 05:49:47'),
(12, 24, 8, 'Product Setup', 'admin.product.index', NULL, 9, 1, 1, '2023-09-19 09:21:19', '2023-09-25 14:14:03'),
(13, 25, 8, 'Staff Setup', 'admin.staff.index', NULL, 4, 1, 1, '2023-09-19 09:21:25', '2023-09-23 14:49:31'),
(14, 26, 8, 'Product List', 'admin.product-list.index', NULL, 10, 1, 1, '2023-09-19 09:21:36', '2023-09-30 06:36:17'),
(15, 27, NULL, 'System Configuration', NULL, '<i class=\"fad fa-sliders-h\"></i>', 4, 1, 1, '2023-09-19 09:22:02', '2023-09-19 09:22:02'),
(16, 28, 15, 'Group Sales Target', 'admin.group-target.index', NULL, 1, 1, 1, '2023-09-19 09:22:23', '2023-09-25 15:11:07'),
(17, 29, 15, 'Client Price Setup', 'admin.client-price.index', NULL, 2, 1, 1, '2023-09-19 09:22:33', '2023-09-29 15:44:08'),
(18, 30, NULL, 'Procurement', NULL, '<i class=\"fad fa-cogs\"></i>', 5, 1, 1, '2023-09-19 09:23:13', '2023-09-19 09:23:13'),
(19, 31, 18, 'Transaction', NULL, NULL, 1, 1, 1, '2023-09-19 09:23:22', '2023-09-19 09:23:22'),
(20, 32, 19, 'Vendor Setup', 'admin.vendor.index', NULL, 1, 1, 1, '2023-09-19 09:23:31', '2023-09-25 04:28:11'),
(21, 33, 19, 'Product Lifting', 'admin.lifting.index', NULL, 2, 1, 1, '2023-09-19 09:23:43', '2023-09-30 10:24:00'),
(22, 34, 19, 'Purchase Return', 'admin.lifting-return.index', NULL, 3, 1, 1, '2023-09-19 09:23:55', '2023-10-16 04:46:40'),
(23, 35, 19, 'Vendor Payment', 'admin.vendor-payment.index', NULL, 4, 1, 1, '2023-09-19 09:24:05', '2023-10-16 09:18:55'),
(24, 36, 18, 'Reports', NULL, NULL, 2, 1, 1, '2023-09-19 09:24:13', '2023-09-19 09:24:13'),
(25, 37, 24, 'Lifting History', 'admin.lifting-history.index', NULL, 1, 1, 1, '2023-09-19 09:24:28', '2023-10-02 09:55:22'),
(26, 38, 24, 'Return History', NULL, NULL, 2, 1, 1, '2023-09-19 09:24:36', '2023-09-19 09:24:36'),
(27, 39, 24, 'Payment History', NULL, NULL, 3, 1, 1, '2023-09-19 09:24:54', '2023-09-19 09:24:54'),
(28, 40, 24, 'Vendor Statement', NULL, NULL, 4, 1, 1, '2023-09-19 09:25:06', '2023-09-19 09:25:06'),
(29, 41, NULL, 'Inventory', NULL, '<i class=\"fad fa-analytics\"></i>', 6, 1, 1, '2023-09-19 09:25:29', '2023-09-19 09:25:29'),
(30, 42, 29, 'Transaction', NULL, NULL, 1, 1, 1, '2023-09-19 09:25:38', '2023-09-19 09:25:38'),
(31, 43, 30, 'Product Transfer', 'admin.transfer.index', NULL, 1, 1, 1, '2023-09-19 09:25:55', '2023-10-18 05:08:37'),
(32, 44, 30, 'Transfer Receive', 'admin.transfer-receive.index', NULL, 2, 1, 1, '2023-09-19 09:26:05', '2023-10-18 09:46:37'),
(33, 45, 29, 'Reports', NULL, NULL, 2, 1, 1, '2023-09-19 09:26:14', '2023-09-19 09:26:14'),
(34, 46, 33, 'Closing Stock', NULL, NULL, 1, 1, 1, '2023-09-19 09:26:33', '2023-09-19 09:26:33'),
(35, 47, 33, 'Stock Status', NULL, NULL, 2, 1, 1, '2023-09-19 09:26:45', '2023-09-19 09:26:45'),
(36, 48, 33, 'Transfer Log', NULL, NULL, 3, 1, 1, '2023-09-19 09:26:55', '2023-09-19 09:26:55'),
(37, 49, NULL, 'Sales Management', NULL, '<i class=\"fad fa-tasks\"></i>', 7, 1, 1, '2023-09-19 09:28:03', '2023-09-19 09:28:03'),
(38, 50, 37, 'Transaction', NULL, NULL, 1, 1, 1, '2023-09-19 09:28:16', '2023-09-19 09:28:16'),
(39, 51, 8, 'Region Setup', 'admin.region.index', NULL, 0, 1, 1, '2023-09-19 09:28:49', '2023-09-23 14:48:10'),
(40, 52, 8, 'Area Setup', 'admin.area.index', NULL, 1, 1, 1, '2023-09-19 09:29:03', '2023-09-23 14:48:28'),
(41, 53, 8, 'Territory Setup', 'admin.territory.index', NULL, 2, 1, 1, '2023-09-19 09:29:15', '2023-09-23 14:48:48'),
(42, 54, 38, 'Client Setup', 'admin.client.index', NULL, 0, 1, 1, '2023-09-19 09:29:28', '2023-10-13 04:45:32'),
(43, 55, 38, 'Daily Sales', 'admin.sales.index', NULL, 5, 1, 1, '2023-09-19 09:29:42', '2023-10-11 08:09:49'),
(44, 56, 38, 'Daily Collection', 'admin.collection.index', NULL, 6, 1, 1, '2023-09-19 09:29:54', '2023-10-14 15:58:54'),
(45, 57, 38, 'Bulk Collection', NULL, NULL, 7, 1, 1, '2023-09-19 09:30:07', '2023-09-19 09:30:07'),
(46, 58, 38, 'Sales Return', 'admin.sales-return.index', NULL, 8, 1, 1, '2023-09-19 09:30:21', '2023-10-15 06:42:46'),
(47, 59, 38, 'Return Approval', 'admin.return-approve.index', NULL, 9, 1, 1, '2023-09-19 09:30:32', '2023-10-18 12:04:00'),
(48, 60, 37, 'Reports', NULL, NULL, 2, 1, 1, '2023-09-19 09:30:42', '2023-09-19 09:30:42'),
(49, 61, 48, 'Sales History', 'admin.sales-history.index', NULL, 1, 1, 1, '2023-09-19 09:30:51', '2023-10-14 05:42:52'),
(50, 62, 48, 'Collection History', NULL, NULL, 2, 1, 1, '2023-09-19 09:31:08', '2023-09-19 09:31:08'),
(51, 63, 48, 'Return History', NULL, NULL, 3, 1, 1, '2023-09-19 09:31:21', '2023-09-19 09:31:21'),
(52, 64, 48, 'Client Statement', NULL, NULL, 4, 1, 1, '2023-09-19 09:31:39', '2023-09-19 09:31:39'),
(53, 65, 48, 'Client List', 'admin.client-list.index', NULL, 5, 1, 1, '2023-09-19 09:31:52', '2023-10-03 11:08:14'),
(54, 66, NULL, 'Business Analysis', NULL, '<i class=\"fad fa-chart-pie\"></i>', 8, 1, 1, '2023-09-19 09:33:29', '2023-09-19 09:33:29'),
(55, 67, 54, 'Payment Analysis', NULL, NULL, 1, 1, 1, '2023-09-19 09:33:39', '2023-09-19 09:33:39'),
(56, 68, 54, 'Stock Valuation', NULL, NULL, 2, 1, 1, '2023-09-19 09:33:47', '2023-09-19 09:33:47'),
(57, 69, 54, 'Sales Target & Achievement', NULL, NULL, 3, 1, 1, '2023-09-19 09:33:56', '2023-09-19 09:33:56'),
(58, 70, 54, 'Sales Contribution', NULL, NULL, 4, 1, 1, '2023-09-19 09:34:06', '2023-09-19 09:34:06'),
(59, 71, 54, 'Sales Realization Analysis', NULL, NULL, 5, 1, 1, '2023-09-19 09:34:14', '2023-09-19 09:34:14'),
(60, 72, 54, 'Sales Ageing Report', NULL, NULL, 6, 1, 1, '2023-09-19 09:34:41', '2023-09-19 09:34:41'),
(61, 73, 54, 'Dealer Outstanding', NULL, NULL, 7, 1, 1, '2023-09-19 09:34:53', '2023-09-19 09:34:53'),
(62, 74, 54, 'Product Sales Profit', NULL, NULL, 8, 1, 1, '2023-09-19 09:35:10', '2023-09-19 09:35:10'),
(63, 75, NULL, 'Online Order', NULL, '<i class=\"fad fa-boxes\"></i>', 9, 1, 1, '2023-09-19 09:36:07', '2023-09-19 09:36:07'),
(64, 76, 38, 'Offline Order', 'admin.offline-order.index', NULL, 1, 1, 1, '2023-09-19 09:36:18', '2023-10-09 03:42:43'),
(66, 78, 38, 'Prepare Gatepass', 'admin.delivery.index', NULL, 10, 1, 1, '2023-09-19 09:38:15', '2023-10-18 13:57:45'),
(68, 80, 48, 'Delivery Statement', NULL, NULL, 10, 1, 1, '2023-09-19 09:38:34', '2023-10-18 13:58:25'),
(69, 81, 8, 'Client Chain', 'admin.chain-client.index', NULL, 7, 1, 1, '2023-09-23 10:02:09', '2023-09-25 04:14:41'),
(70, 82, 8, 'Client Type', 'admin.client-category.index', NULL, 6, 1, 1, '2023-09-23 10:02:20', '2023-09-23 14:51:25'),
(71, 168, 8, 'Vehicle Setup', 'admin.vehicle.index', NULL, 11, 1, 1, '2023-09-28 06:35:35', '2023-09-28 07:48:02'),
(72, 174, 8, 'Measurement Unit', 'admin.attribute.index', NULL, 12, 1, 1, '2023-09-29 03:11:33', '2023-09-29 03:12:05'),
(73, 180, NULL, 'Website CMS', NULL, '<i class=\"fad fa-window-alt\"></i>', 11, 1, 1, '2023-10-08 15:08:32', '2023-10-08 15:08:32'),
(74, 181, 73, 'Slider', 'admin.slider.index', NULL, 1, 1, 1, '2023-10-08 15:09:27', '2023-10-08 15:14:11'),
(75, 182, 73, 'Site Items', 'admin.site-item.index', NULL, 2, 1, 1, '2023-10-08 15:22:26', '2023-10-08 15:22:26'),
(76, 183, 73, 'Special Item', 'admin.special-food-item.index', NULL, 3, 1, 1, '2023-10-08 15:23:04', '2023-10-18 13:55:44'),
(77, 184, 73, 'Social Working', 'admin.social-working.index', NULL, 4, 1, 1, '2023-10-08 15:23:47', '2023-10-08 15:23:47'),
(78, 185, 73, 'About', 'admin.about.index', NULL, 5, 1, 1, '2023-10-08 15:24:06', '2023-10-08 15:24:06'),
(79, 186, 73, 'Contact', 'admin.contact.index', NULL, 6, 1, 1, '2023-10-08 15:24:27', '2023-10-08 15:24:27'),
(80, 187, 73, 'Testimonial', 'admin.testimonial.index', NULL, 7, 1, 1, '2023-10-08 15:24:57', '2023-10-08 15:24:57'),
(81, 188, 73, 'Client Message', 'admin.client-message.index', NULL, 8, 1, 1, '2023-10-08 15:25:53', '2023-10-08 15:25:53'),
(82, 189, 73, 'Showcase Items', 'admin.showcase-item.index', NULL, 9, 1, 1, '2023-10-08 15:26:21', '2023-10-08 15:26:21'),
(83, 190, 73, 'Details Card', 'admin.details-card.index', NULL, 10, 1, 1, '2023-10-08 15:26:50', '2023-10-08 15:26:50'),
(84, 226, 73, 'Site Settings', 'admin.settings.index', NULL, 11, 1, 1, '2023-10-08 15:50:46', '2023-10-08 15:50:46');

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
(13, 83, 70, 'create', 'admin.client-category.create', 1, '2023-09-25 06:58:14', '2023-09-25 06:58:14'),
(14, 84, 70, 'store', 'admin.client-category.store', 1, '2023-09-25 06:58:24', '2023-09-25 06:58:24'),
(15, 85, 70, 'edit', 'admin.client-category.edit', 1, '2023-09-25 06:58:31', '2023-09-25 06:58:31'),
(16, 86, 70, 'update', 'admin.client-category.update', 1, '2023-09-25 06:58:41', '2023-09-25 06:58:41'),
(17, 87, 70, 'delete', 'admin.client-category.destroy', 1, '2023-09-25 06:58:49', '2023-09-25 06:58:49'),
(18, 88, 69, 'create', 'admin.chain-client.create', 1, '2023-09-25 06:59:35', '2023-09-25 06:59:35'),
(19, 89, 69, 'store', 'admin.chain-client.store', 1, '2023-09-25 06:59:50', '2023-09-25 06:59:50'),
(20, 90, 69, 'edit', 'admin.chain-client.edit', 1, '2023-09-25 06:59:55', '2023-09-25 06:59:55'),
(21, 91, 69, 'update', 'admin.chain-client.update', 1, '2023-09-25 07:00:02', '2023-09-25 07:00:02'),
(22, 92, 69, 'delete', 'admin.chain-client.destroy', 1, '2023-09-25 07:00:19', '2023-09-25 07:00:19'),
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
(113, 196, 76, 'create', 'admin.special-food-item.create', 1, '2023-10-08 15:30:28', '2023-10-08 15:30:28'),
(114, 197, 76, 'store', 'admin.special-food-item.store', 1, '2023-10-08 15:30:37', '2023-10-08 15:30:37'),
(115, 198, 76, 'edit', 'admin.special-food-item.edit', 1, '2023-10-08 15:30:41', '2023-10-08 15:30:41'),
(116, 199, 76, 'update', 'admin.special-food-item.update', 1, '2023-10-08 15:30:47', '2023-10-08 15:30:47'),
(117, 200, 76, 'delete', 'admin.special-food-item.destroy', 1, '2023-10-08 15:30:51', '2023-10-08 15:30:51'),
(118, 201, 77, 'create', 'admin.social-working.create', 1, '2023-10-08 15:31:27', '2023-10-08 15:31:27'),
(119, 202, 77, 'store', 'admin.social-working.store', 1, '2023-10-08 15:31:31', '2023-10-08 15:31:31'),
(120, 203, 77, 'edit', 'admin.social-working.edit', 1, '2023-10-08 15:31:36', '2023-10-08 15:31:36'),
(121, 204, 77, 'update', 'admin.social-working.update', 1, '2023-10-08 15:31:41', '2023-10-08 15:31:41'),
(122, 205, 77, 'delete', 'admin.social-working.destroy', 1, '2023-10-08 15:31:45', '2023-10-08 15:31:45'),
(123, 206, 80, 'create', 'admin.testimonial.create', 1, '2023-10-08 15:33:23', '2023-10-08 15:33:23'),
(124, 207, 80, 'store', 'admin.testimonial.store', 1, '2023-10-08 15:33:28', '2023-10-08 15:33:28'),
(125, 208, 80, 'edit', 'admin.testimonial.edit', 1, '2023-10-08 15:33:32', '2023-10-08 15:33:32'),
(126, 209, 80, 'update', 'admin.testimonial.update', 1, '2023-10-08 15:33:37', '2023-10-08 15:33:37'),
(127, 210, 80, 'delete', 'admin.testimonial.destroy', 1, '2023-10-08 15:34:02', '2023-10-08 15:34:02'),
(128, 211, 81, 'create', 'admin.client-message.create', 1, '2023-10-08 15:34:31', '2023-10-08 15:34:31'),
(129, 212, 81, 'store', 'admin.client-message.store', 1, '2023-10-08 15:34:36', '2023-10-08 15:34:36'),
(130, 213, 81, 'edit', 'admin.client-message.edit', 1, '2023-10-08 15:34:40', '2023-10-08 15:34:40'),
(131, 214, 81, 'update', 'admin.client-message.update', 1, '2023-10-08 15:34:44', '2023-10-08 15:34:44'),
(132, 215, 81, 'delete', 'admin.client-message.destroy', 1, '2023-10-08 15:34:49', '2023-10-08 15:34:49'),
(133, 216, 82, 'create', 'admin.showcase-item.create', 1, '2023-10-08 15:35:20', '2023-10-08 15:35:20'),
(134, 217, 82, 'store', 'admin.showcase-item.store', 1, '2023-10-08 15:35:24', '2023-10-08 15:35:24'),
(135, 218, 82, 'edit', 'admin.showcase-item.edit', 1, '2023-10-08 15:35:28', '2023-10-08 15:35:28'),
(136, 219, 82, 'update', 'admin.showcase-item.update', 1, '2023-10-08 15:35:33', '2023-10-08 15:35:33'),
(137, 220, 82, 'delete', 'admin.showcase-item.destroy', 1, '2023-10-08 15:35:39', '2023-10-08 15:35:39'),
(138, 221, 83, 'create', 'admin.details-card.create', 1, '2023-10-08 15:36:04', '2023-10-08 15:36:04'),
(139, 222, 83, 'store', 'admin.details-card.store', 1, '2023-10-08 15:36:09', '2023-10-08 15:36:09'),
(140, 223, 83, 'edit', 'admin.details-card.edit', 1, '2023-10-08 15:36:13', '2023-10-08 15:36:13'),
(141, 224, 83, 'update', 'admin.details-card.update', 1, '2023-10-08 15:36:17', '2023-10-08 15:36:17'),
(142, 225, 83, 'delete', 'admin.details-card.destroy', 1, '2023-10-08 15:36:22', '2023-10-08 15:36:22'),
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
(164, 248, 22, 'create', 'admin.lifting-return.create', 1, '2023-10-16 04:47:09', '2023-10-16 04:47:09'),
(165, 249, 22, 'store', 'admin.lifting-return.store', 1, '2023-10-16 04:47:15', '2023-10-16 04:47:15'),
(166, 250, 22, 'edit', 'admin.lifting-return.edit', 1, '2023-10-16 04:47:19', '2023-10-16 04:47:19'),
(167, 251, 22, 'update', 'admin.lifting-return.update', 1, '2023-10-16 04:47:28', '2023-10-16 04:47:28'),
(168, 252, 22, 'delete', 'admin.lifting-return.destroy', 1, '2023-10-16 04:47:34', '2023-10-16 04:47:34'),
(169, 253, 23, 'create', 'admin.vendor-payment.create', 1, '2023-10-16 09:19:38', '2023-10-16 09:19:38'),
(170, 254, 23, 'store', 'admin.vendor-payment.store', 1, '2023-10-16 09:19:42', '2023-10-16 09:19:42'),
(171, 255, 23, 'edit', 'admin.vendor-payment.edit', 1, '2023-10-16 09:19:46', '2023-10-16 09:19:46'),
(172, 256, 23, 'update', 'admin.vendor-payment.update', 1, '2023-10-16 09:19:51', '2023-10-16 09:19:51'),
(173, 257, 23, 'delete', 'admin.vendor-payment.destroy', 1, '2023-10-16 09:20:00', '2023-10-16 09:20:00'),
(174, 258, 31, 'create', 'admin.transfer.create', 1, '2023-10-18 05:08:51', '2023-10-18 05:08:51'),
(175, 259, 31, 'store', 'admin.transfer.store', 1, '2023-10-18 05:09:01', '2023-10-18 05:09:01'),
(176, 260, 31, 'edit', 'admin.transfer.edit', 1, '2023-10-18 05:09:05', '2023-10-18 05:09:05'),
(177, 261, 31, 'update', 'admin.transfer.update', 1, '2023-10-18 05:09:22', '2023-10-18 05:09:22'),
(178, 262, 31, 'delete', 'admin.transfer.destroy', 1, '2023-10-18 05:09:29', '2023-10-18 05:09:29'),
(179, 263, 32, 'view', 'admin.transfer-receive.show', 1, '2023-10-18 09:47:14', '2023-10-18 09:47:14'),
(180, 264, 32, 'approve', 'admin.transfer-receive.edit', 1, '2023-10-18 09:47:49', '2023-10-18 09:47:49'),
(181, 265, 32, 'reject', 'admin.transfer-receive.destroy', 1, '2023-10-18 09:48:01', '2023-10-18 09:48:01'),
(182, 266, 47, 'View', 'admin.return-approve.show', 1, '2023-10-18 12:04:48', '2023-10-18 12:04:48'),
(183, 267, 47, 'Approve', 'admin.return-approve.edit', 1, '2023-10-18 12:05:03', '2023-10-18 12:05:03'),
(184, 268, 47, 'Reject', 'admin.return-approve.destroy', 1, '2023-10-18 12:05:12', '2023-10-18 12:05:12');

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
  `primary_color` varchar(255) DEFAULT NULL,
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

INSERT INTO `admin_settings` (`id`, `logo`, `favicon`, `title`, `footer_text`, `secondary_color`, `primary_color`, `facebook`, `twitter`, `linkedin`, `whatsapp`, `google`, `created_at`, `updated_at`) VALUES
(1, 'media/admin-setting/2023-09-23-3cpng5VkVeF3H5QdImA48UqayKHvaMFmE0Oa1hMd.webp', 'media/admin-setting/2023-09-23-W0tqCHUTyTH21FGWpGwiiCfvF4p4dpXrdd7YWuCp.webp', 'Sales Tracker', '© 2023 Developed by <a target=\"_blank\" href=\"http://www.technoparkbd.com/\">Techno Park Bangladesh</a>', '#cc0808', '#ee0104', NULL, NULL, NULL, NULL, NULL, '2023-09-19 09:03:18', '2023-09-28 08:07:16');

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

INSERT INTO `areas` (`id`, `company_id`, `region_id`, `code`, `name`, `incharge_name`, `phone`, `email`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'prefix', 'Dhanmondi', 'xxx', '111', 'admin@gmail.com', 'address will goes here', 1, 1, NULL, NULL, NULL, '2023-09-23 08:23:48', '2023-09-23 08:23:48'),
(3, 1, 1, 'KH', 'Khilgaon', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:16:14', '2023-09-23 16:21:38'),
(4, 1, 1, 'UT', 'Uttara', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:22:18', '2023-09-23 16:22:18'),
(5, 1, 1, 'GU', 'Gulshan', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:22:36', '2023-09-23 16:22:36'),
(6, 1, 1, 'MR', 'Mirpur', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:22:54', '2023-09-23 16:22:54'),
(7, 1, 6, 'CTGA', 'Chattogram', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:23:21', '2023-09-24 04:16:36'),
(8, 1, 1, 'NM', 'New Market', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:23:43', '2023-09-23 16:23:55'),
(9, 1, 2, 'MYMA', 'Mymensingh', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:24:18', '2023-09-24 04:18:15'),
(10, 1, 1, 'DGA', 'Dhaka General', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:24:54', '2023-09-23 16:24:54'),
(11, 1, 7, 'NBA', 'North Bangal', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:19:23', '2023-09-24 04:19:23'),
(12, 1, 8, 'SBA', 'South Bangal', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:19:48', '2023-09-24 04:19:48'),
(13, 1, 9, 'SYLA', 'Sylhet', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:20:35', '2023-09-24 04:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
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

INSERT INTO `attributes` (`id`, `company_id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'KG', 1, 1, NULL, NULL, NULL, '2023-09-29 03:25:25', '2023-09-29 03:25:25'),
(2, 1, 'Pcs', 1, 1, NULL, NULL, NULL, '2023-09-29 03:29:41', '2023-09-29 03:29:41');

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
(1, 1, 'BFHO', 'Head Office', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Suite # M-10, Level-10, Gulfeshan Plaza, Moghbazar, Dhaka-1217', 1, 1, NULL, 1, NULL, '2023-09-23 06:52:33', '2023-10-02 03:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
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
(5, 1, NULL, 'Potatoes', 'potatoes', 'media/category/2023-10-19-8VfG4J76DAFQU5ME6CMlw4zxKoZc6wIYnFdKh7KN.webp', NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, NULL, NULL, '2023-09-26 04:09:27', '2023-10-19 06:41:35'),
(6, 1, NULL, 'Vegetables', 'vegetables', 'media/category/2023-10-19-C2MXjmlMd6fqKj2uuSzjEgg0UewvLDZwE9d7Xp6I.webp', NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, NULL, NULL, '2023-09-26 04:09:58', '2023-10-19 06:32:50'),
(7, 1, NULL, 'Poultry', 'poultry', 'media/category/2023-10-19-4rSUw5gqij8K712Y35jctBPQLKELZXlzXPtSlx6L.webp', NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, NULL, NULL, '2023-10-02 08:48:33', '2023-10-19 06:33:45'),
(8, 1, NULL, 'Dairy', 'dairy', 'media/category/2023-10-19-WB113DAyHZTdjX8FJWUlF2Vq4qoNeAGJLnzZ437w.webp', NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, NULL, NULL, '2023-10-13 04:53:11', '2023-10-19 06:40:19'),
(9, 1, NULL, 'Seafood', 'seafood', 'media/category/2023-10-19-faWQr85XHGLsQ4N7c1xay0NkXC3tbmLoIYSOUDO6.webp', NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, NULL, NULL, '2023-10-13 04:53:41', '2023-10-19 06:38:23');

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
(24, 6, 1, '2023-10-19 06:32:50', '2023-10-19 06:32:50'),
(25, 7, 1, '2023-10-19 06:33:45', '2023-10-19 06:33:45'),
(26, 9, 1, '2023-10-19 06:38:23', '2023-10-19 06:38:23'),
(27, 8, 1, '2023-10-19 06:40:19', '2023-10-19 06:40:19'),
(28, 5, 1, '2023-10-19 06:41:35', '2023-10-19 06:41:35');

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
  `reference_by` bigint(20) UNSIGNED DEFAULT NULL,
  `client_category_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `territory_id` bigint(20) UNSIGNED NOT NULL,
  `code` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `credit_limit` double(8,2) DEFAULT NULL,
  `chain_client_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 13, 25, 102051001, 'A & W Restaurant (Gulshan)', NULL, '1191803381', NULL, '54 Gulshan-01  Dhaka', 150000.00, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2, 1, 6, 1, 13, 25, 102051004, 'Fruits & Flavour Ltd.(Yummy Yummy)', 'Mr. Sah Alom', '1613222198', NULL, 'Plot # 14.Road # 09  Block # D  Mirpur-11 Dhaka-1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(3, 1, 6, 1, 13, 25, 102051008, 'Shopnil Restaurant (Tangail)', NULL, '1812829898', NULL, 'Tangail Sadar Tangail', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(4, 1, 6, 1, 13, 25, 102051009, 'Indian Spicy King (Jamuna)', 'Mr Rassel', '1911684070', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(5, 1, 6, 1, 13, 25, 102051017, 'Shawarma House (Ramna)', 'Mr. Taskin', '29331014', NULL, 'Ramna  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(6, 1, 6, 1, 13, 25, 102051018, 'Tast of Indian Food (Jamuna)', 'MD. Mizan', '1720983294', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(7, 1, 6, 1, 13, 25, 102051023, 'Red Chicken Ltd', 'Mr. Imran', '1782090866', NULL, 'Uttara  Dhaka', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(8, 1, 6, 1, 13, 25, 102051025, 'Shopno Taste (Uttara-Rajlokkhi)', 'Mr. Kabir', '1313055271', NULL, 'Plot-32/D&E  Natore Tower  4th Floor  Road-02  Sector-03  Rajlaxmi  Uttara  Dhaka 1230', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(9, 1, 6, 1, 13, 25, 102051026, 'Criss Cardiac Grill (Jamuna)', 'Mr. Shoyeb', '1943791921', NULL, 'Jamuna Future Park  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(10, 1, 6, 1, 13, 25, 102051030, 'Fire On Ice (Uttara)', NULL, '27911213', NULL, 'Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(11, 1, 6, 1, 13, 25, 102051032, 'Banolota Cafe (Pabna)', NULL, '1741499505', NULL, 'Pabna Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(12, 1, 6, 1, 13, 25, 102051037, 'Adonize (Gulshan)', NULL, '1623183125', NULL, 'Gulshan Pink City Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(13, 1, 6, 1, 13, 25, 102051039, 'Mirage', 'Mr. Hadi', '1511216112', NULL, 'Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(14, 1, 6, 1, 13, 25, 102051043, 'Washington Hotel', NULL, NULL, NULL, 'Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(15, 1, 6, 1, 13, 25, 102051045, 'Sauslys Food (Banani)', NULL, '1716790471', NULL, 'Road # 11  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(16, 1, 6, 1, 13, 25, 102051050, 'Chicken Hut (Norshingdi)', NULL, '1730969192', NULL, 'Norshingdi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(17, 1, 6, 1, 13, 25, 102051051, 'Banalota Cafe Shop (Mirpur-11/5)', NULL, '1741499505', NULL, 'Mirpur-11/5  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(18, 1, 6, 1, 13, 25, 102051053, 'Kabab Factory (Gulshan)', 'Mr. Jahangir', '1912390308', NULL, 'Gulshan-02 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(19, 1, 6, 1, 13, 25, 102051054, 'Shawarma House new  (Bashundhara)', NULL, '1790735061', NULL, 'Bashundhara Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(20, 1, 6, 1, 13, 25, 102051055, 'Meat Lovers (Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(21, 1, 6, 1, 13, 25, 102051064, 'Quick Bite (Mirpur)', 'Mr. Sah Alom', '1614351516', NULL, 'Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(22, 1, 6, 1, 13, 25, 102051065, 'Fat Burger (Niketon)', NULL, '1719211785', NULL, 'Road # 02 Niketon  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(23, 1, 6, 1, 13, 25, 102051067, 'Nirzhor Food Product (Noakhali)', 'Mr. Nahid', '1846937260', NULL, 'Companygonj  Nowakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(24, 1, 6, 1, 13, 25, 102051071, 'Spicy Chicken (Aftab)', NULL, '1864262823', NULL, 'Aftab Nagar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(25, 1, 6, 1, 13, 25, 102051075, 'Spicy & Pizza (N.Gonj)', 'Mr. Hanif', '1710595550', NULL, 'Narayangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(26, 1, 6, 1, 13, 25, 102051079, 'Tangail Fast Food (Tangail)', NULL, '1986709121', NULL, 'Tangail Sadar  Tangail', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(27, 1, 6, 1, 13, 25, 102051081, 'Mesquit Grill (Uttara)', NULL, '1789200280', NULL, 'House-25 (Lift-03) Rabindra Sarani Sector-03 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(28, 1, 6, 1, 13, 25, 102051082, 'Chicken World (Banasree)', NULL, NULL, NULL, 'Banasree  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(29, 1, 6, 1, 13, 25, 102051084, 'Rigs Inn', NULL, '29847322', NULL, 'Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(30, 1, 6, 1, 13, 25, 102051087, 'Indian Kitchen (Jamuna)', 'Madam', '1874624180', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(31, 1, 6, 1, 13, 25, 102051088, 'Cool Cafe (Uttara)', 'Mr. Hasan', '01817591466  01810020068', NULL, 'plot-1  Road-1  Sector-11  Uttara', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(32, 1, 6, 1, 13, 25, 102051090, 'S.F.C (Natun Bazar)', 'Mr. Ibrahim', '1916383838', NULL, 'Natun Bazar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(33, 1, 6, 1, 13, 25, 102051091, 'Indian Masala (Jamuna)', 'Mr. Sanwar', '1951700891', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(34, 1, 6, 1, 13, 25, 102051034, 'Shawarma King (Khilgoan)', NULL, '1616441615', NULL, 'Khilgoan  Taltola Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(35, 1, 6, 1, 13, 25, 102051058, 'Indian Dusa House(Jamuna)', 'Mr.Jakir', '1712496548', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(36, 1, 6, 1, 13, 25, 102051085, 'Melange (Banani)', 'Mr. Samsu', '1759695578', NULL, 'Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(37, 1, 6, 1, 13, 25, 102051089, 'Kabab Factory (Uttara)', 'Mr. Mohon', '1861381477', NULL, 'Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(38, 1, 6, 1, 13, 25, 102051095, 'Dessert Zone (B.City)', NULL, '01967-972264', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(39, 1, 6, 1, 13, 25, 102051097, 'Asain Fast Food', 'Mr  Toby', '1777654340', NULL, 'Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(40, 1, 6, 1, 13, 25, 102051099, 'Spicy Fried Chicken(B.C)', NULL, NULL, NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(41, 1, 6, 1, 13, 25, 102051100, 'Masala Express (Mirpur-1)', NULL, '1781532428', NULL, 'Mirpur-01  Sony Cinema Hall', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(42, 1, 6, 1, 13, 25, 102051102, 'Showrma House (Banasree)', NULL, '1841037548', NULL, 'Banasree  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(43, 1, 6, 1, 13, 25, 102051105, 'Z.F.C (Natun Bazar)', 'Mr. Jahid', '1636695867', NULL, 'Natun Bazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(44, 1, 6, 1, 13, 25, 102051106, 'Tandury Grill (Jamuna)', 'Mr. Masum', '1811165335', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(45, 1, 6, 1, 13, 25, 102051107, 'Wow Burger (Uttara)', NULL, NULL, NULL, 'Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(46, 1, 6, 1, 13, 25, 102051108, 'Showrma House (Pallabi)', NULL, '1706311011', NULL, 'Mirpur-11.5  Busstand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(47, 1, 6, 1, 13, 25, 102051109, 'Arabian Master(Lalbag)', 'Mr. Tarque', '1700500078', NULL, '1/2 No.Lalbag Road  Dhaka-1211.', 250000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(48, 1, 6, 1, 13, 25, 102051111, 'Cafe Bellisimu (Banani)', NULL, NULL, NULL, 'Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(49, 1, 6, 1, 13, 25, 102051113, 'Food Choice (Uttara)', NULL, NULL, NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(50, 1, 6, 1, 13, 25, 102051114, 'Shawarma House (Uttara)', NULL, '1798257591', NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(51, 1, 6, 1, 13, 25, 102051115, 'AFC (Aftab Nagar)', NULL, '1925509607', NULL, 'Aftab Nagar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(52, 1, 6, 1, 13, 25, 102051116, 'Burger Lab (Bashundhara)', 'Mr. Mufti', '170,404,037,001,674,000,000', NULL, 'Bashundhara Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(53, 1, 6, 1, 13, 25, 102051117, 'Indian Spicy (Uttara)', NULL, '1674596531', NULL, 'Sector 3  Shopno Food Court Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(54, 1, 6, 1, 13, 25, 102051120, 'Candle Light Food Corner (Monipur)', 'Mr.Tapos Pal', '1714752222', NULL, '401  Monipur maikala', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(55, 1, 6, 1, 13, 25, 102051137, 'Euro Hut (Rapa Plaza)', 'Mr. Ripon', '1925727499', NULL, 'Rapa Plaza  Shop No. 31  H No. 1  R No. 10  1 Road No. 16  Dhanmondi Dhaka-1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(56, 1, 6, 1, 13, 25, 102051145, 'Road House (Elepent Road)', 'Mr. Arif', '1678115011', NULL, 'Elephent Road  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(57, 1, 6, 1, 13, 25, 102051146, 'Fahim ganaral Store', NULL, '1711126183', NULL, 'Kacha bazar  Gulshan-2  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(58, 1, 6, 1, 13, 25, 102051148, 'Full kuchi Restaurant (Mirpur)', NULL, NULL, NULL, 'Mirpur-11.5', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(59, 1, 6, 1, 13, 25, 102051163, 'Classic Showrma(Gulshan-01)', NULL, '1753451284', NULL, 'Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(60, 1, 6, 1, 13, 25, 102051061, 'Red Chilly (Uttara)', 'Mr. Rashed', '1621534947', NULL, 'Kashai Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(61, 1, 6, 1, 13, 25, 102051066, 'River Cafe (Barishal)', 'Mr.Zia', '1717578611', NULL, 'Barishal', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(62, 1, 6, 1, 13, 25, 102051077, 'D 85 (Banani)', 'Mr. Mithu', '1676858585', NULL, 'Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(63, 1, 6, 1, 13, 25, 102051078, 'L.F.C (Jamuna)', 'Mr  Mahabub', '1928141281', NULL, 'Jamuna Future Park Kuril', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(64, 1, 6, 1, 13, 25, 102051201, 'SA Hoq Stationiry', NULL, '1916220888', NULL, 'Scholl rood Mohakhali.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(65, 1, 6, 1, 13, 25, 102051219, 'Sung Garden (Bijoy Nogor)', NULL, '1757930076', NULL, '15/5 Bijoy Nogor  Akota tower  Dhaka-1000', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(66, 1, 6, 1, 13, 25, 102051220, 'Western Grill (Eskaton)', NULL, '1972202802', NULL, 'Eskaton  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(67, 1, 6, 1, 13, 25, 102051221, 'Hot Masala (J.F)', NULL, '1712389985', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(68, 1, 6, 1, 13, 25, 102051223, 'Brooklin Bristro (Shewrapara)', NULL, '1768338488', NULL, 'Shawrapara Busstand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(69, 1, 6, 1, 13, 25, 102051225, 'Spicy & Pickle (Kamalapur)', 'Mr. Shamim', '1629026737', NULL, 'Kamalapur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(70, 1, 6, 1, 13, 25, 102051226, 'Spicy & Pickle (Mirpur)', 'Mr. Shamim', '1926667769', NULL, 'Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(71, 1, 6, 1, 13, 25, 102051228, 'The Lamb Music', NULL, NULL, NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(72, 1, 6, 1, 13, 25, 102051229, 'Clinic Cafe(Dhanmondi)', NULL, '1956499665', NULL, 'Nizam Shankar Plaza  2 Satmasjid Road  Dhaka 1209', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(73, 1, 6, 1, 13, 25, 102051233, 'Helvetia Fried Chicken', 'Mr. Kajal', '1711548598', NULL, 'Tejgoan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(74, 1, 6, 1, 13, 25, 102051237, 'Viapiano Restaurant (Dhanmondi)', NULL, NULL, NULL, 'Road No # 9/A  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(75, 1, 6, 1, 13, 25, 102051242, 'Fish & Co', 'Mr  Toby/ Mr. Morshed', '01787680269  01708165260', NULL, 'Gulshan Avenue  Gulshan-1  Dhaka', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(76, 1, 6, 1, 13, 25, 102051024, 'Tokyo Foods', 'Mr. Sohid', '1924707326', NULL, 'Maizdi  Noakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(77, 1, 6, 1, 13, 25, 102051060, 'Trust Showrma House (Nikunjo)', 'Mr. Shohag', '1714455350', NULL, 'Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(78, 1, 6, 1, 13, 25, 102051101, 'Adda (Narayanganj)', NULL, '1765578516', NULL, 'Narangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(79, 1, 6, 1, 13, 25, 102051236, 'Poopies Restaurant', NULL, NULL, NULL, 'Satmosjid Road Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(80, 1, 6, 1, 13, 25, 102051238, 'Eat Ate Restaurant (Mirpur-14)', NULL, '1680824668', NULL, 'Mirpur-14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(81, 1, 6, 1, 13, 25, 102051239, 'Sauslys Food (Dhanmondi)', 'Mr. Mohoshin', '1846230307', NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(82, 1, 6, 1, 13, 25, 102051244, 'KAVEYA Fast Food', NULL, '1817530294', NULL, 'Uttara  Tongi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(83, 1, 6, 1, 13, 25, 102051245, 'Hot Spicy Masala', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(84, 1, 6, 1, 13, 25, 102051247, 'Sharang Food', NULL, NULL, NULL, 'Sainik Club Banani Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(85, 1, 6, 1, 13, 25, 102051250, 'Candel Light Cafe (Mirpur-10)', NULL, NULL, NULL, 'Mirpur-10  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(86, 1, 6, 1, 13, 25, 102051256, 'American Burger (Gul-2)', NULL, NULL, NULL, 'Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(87, 1, 6, 1, 13, 25, 102051258, 'City Fried Chicken(Mirpur-2)', NULL, NULL, NULL, 'Mirpur-02  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(88, 1, 6, 1, 13, 25, 102051259, 'Laziz (B.City)', NULL, '01720-338903', NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(89, 1, 6, 1, 13, 25, 102051260, 'Indian Hot Masala (B.City)', NULL, '01814-503935', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(90, 1, 6, 1, 13, 25, 102051262, 'Banolota Food Palace (Mirpur-11)', 'Mr. Tareq', '1938830711', NULL, 'Mirpur-11 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(91, 1, 6, 1, 13, 25, 102051263, 'Dilli Darbar (B.City)', 'Mr. Arif  Manager', '1611065846', NULL, 'Bashundhara City  Dhaka', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(92, 1, 6, 1, 13, 25, 102051265, 'Indian Masala (B.City)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(93, 1, 6, 1, 13, 25, 102051268, 'Palm View Restaurant', NULL, NULL, NULL, 'Joar Shahara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(94, 1, 6, 1, 13, 25, 102051269, 'Spicy Cafe (Rajshahi)', 'Mr. Monir', '1924101606', NULL, 'Rajshahi Sadar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(95, 1, 6, 1, 13, 25, 102051273, 'Taco Bell (B.City)', NULL, '1813370136', NULL, 'Level # 8  Block # C Shop # 35 36 Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(96, 1, 6, 1, 13, 25, 102051274, 'Bangladesh Fried Chicken', NULL, '1778977489', NULL, 'Kakrail  Razmony  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(97, 1, 6, 1, 13, 25, 102051284, 'Spicy King (B.City)', NULL, '01914-191035', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(98, 1, 6, 1, 13, 25, 102051291, 'Best Agro Distribution', 'Mr. Shariful', '1678062011', NULL, 'Chittagong', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(99, 1, 6, 1, 13, 25, 102051059, 'TFC (Niketon)', 'Mr. Yesuf Ali', '01730319738/01974275555', NULL, 'Niketon Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(100, 1, 6, 1, 13, 25, 102051074, 'Western Grill (Dhanmondi)', 'Mr. Dipu', '1947682639', NULL, 'House-3/A  Road-4  Dhanmondi  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(101, 1, 6, 1, 13, 25, 102051086, 'Snoopy (N.Ganj)', NULL, '1625158509', NULL, 'Santona Market(3rd floor)  Chashara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(102, 1, 6, 1, 13, 25, 102051096, 'Lafiesta (Malibag)', NULL, '1731558773', NULL, 'Malibag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(103, 1, 6, 1, 13, 25, 102051292, 'Others (F.F)', NULL, NULL, NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(104, 1, 6, 1, 13, 25, 102051293, 'Burger & Bost (Mohammadpur)', NULL, NULL, NULL, 'Tajmohol Road Mohammadpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(105, 1, 6, 1, 13, 25, 102051296, 'Dhaka Fried Chicken (Malibagh)', NULL, '1676328570', NULL, 'Malibag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(106, 1, 6, 1, 13, 25, 102051303, 'Capricons World (Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(107, 1, 6, 1, 13, 25, 102051306, 'Crispy Bite', NULL, NULL, NULL, 'Khalpar  Uttara-12   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(108, 1, 6, 1, 13, 25, 102051307, 'Sub Factory (Banani)', NULL, NULL, NULL, 'Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(109, 1, 6, 1, 13, 25, 102051309, 'Supreem Dinner (Mirpur-1)', NULL, '1730440571', NULL, 'Beside of Sony Cinema Hall Mirpur- 01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(110, 1, 6, 1, 13, 25, 102051310, 'Boomers Cafe (Baily Road)', 'Mr. Amar', '29348018', NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(111, 1, 6, 1, 13, 25, 102051312, 'Fried Hut (B.City)', 'Mr. Belal', '1711027517', NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(112, 1, 6, 1, 13, 25, 102051318, 'MnM (Bcity)', NULL, NULL, NULL, 'Bashundhara City   Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(113, 1, 6, 1, 13, 25, 102051322, 'Dhaka Fried Chicken ( Baily Road)', NULL, NULL, NULL, 'Baily Road   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(114, 1, 6, 1, 13, 25, 102051324, 'BRAC Chicken', NULL, '173078401', NULL, 'Kaderia tower   Mohakhali  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(115, 1, 6, 1, 13, 25, 102051325, 'Bella Vita Pizario (Baridhara)', NULL, NULL, NULL, 'Bashundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(116, 1, 6, 1, 13, 25, 102051326, 'Red Cherry (Mirpur-10)', NULL, NULL, NULL, 'Mirpur-10  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(117, 1, 6, 1, 13, 25, 102051327, 'Capricons (Jahangir Gate)', 'Mr Sohel Rana', '1734945946', NULL, 'Jahangir Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(118, 1, 6, 1, 13, 25, 102051329, 'Food Haven (Jamuna)', 'Mr. Jahangir', '1812056500', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(119, 1, 6, 1, 13, 25, 102051331, 'Cafe De Partex (Tejgaon)', 'Mr. Suruj Ali', '1730377220', NULL, 'Anik Tower  Gate # 04  Niketon Beside of Brac Bank  Tejgaon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(120, 1, 6, 1, 13, 25, 102051334, 'Grand Lake View Hotel', NULL, NULL, NULL, 'House # 14  Road # 5/A Sector # 11  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(121, 1, 6, 1, 13, 25, 102051336, 'Yellow Cafe', 'Mr. Jamal  raihan', '1628812505', NULL, 'House 17 Bir Uttam AK Rob road  Dhanmondi-2  Dhaka 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(122, 1, 6, 1, 13, 25, 102051337, 'D Smaak Cafe (Dhanmondi)', NULL, '1796491883', NULL, '49/A  (736) Rangs K.B Square (9th Floor) Satmasjid Road  Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(123, 1, 6, 1, 13, 25, 102051027, 'Brost & Kabab (Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(124, 1, 6, 1, 13, 25, 102051046, 'Showpno Test (Banasree)', 'Mr. Kabir', '1928645978', NULL, 'Banasree  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(125, 1, 6, 1, 13, 25, 102051047, 'Crispy Cool (Dhanmondi)', 'Mr. Amin', '1977428169', NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(126, 1, 6, 1, 13, 25, 102051063, 'BDFC (Badda)', 'Mr. Foysal', '1614333203', NULL, 'Shahjahadpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(127, 1, 6, 1, 13, 25, 102051068, 'Saad Musa Centre', 'Mr. Ponir', '1955562327', NULL, 'Baridhara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(128, 1, 6, 1, 13, 25, 102051073, 'S.F.C (Uttara)', 'Mr. Ahsan', '1757037418', NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(129, 1, 6, 1, 13, 25, 102051149, 'Belpiato (Mohammadpur)', NULL, NULL, NULL, 'Shakhertek  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(130, 1, 6, 1, 13, 25, 102051222, 'Albino (Jamuna)', 'Mr. Mahabub', '1777787332', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(131, 1, 6, 1, 13, 25, 102051042, 'Sauslys Food (Gulshan)', NULL, '1720096671', NULL, 'Gulshan-02  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(132, 1, 6, 1, 13, 25, 102051076, 'Indian Food Zone (Gul)', NULL, NULL, NULL, 'Gulshan-02 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(133, 1, 6, 1, 13, 25, 102051098, 'Shawarma House(Mirpur-1)', NULL, '1913511995', NULL, 'Oposit of Sony Cinama hall ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(134, 1, 6, 1, 13, 25, 102051266, 'Hello Fried Chicken', 'Mr. Maruf', '1755657076', NULL, 'House # G 49  Road # 14 Niketon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(135, 1, 6, 1, 13, 25, 102051339, 'London Pizza (N.Ganj)', NULL, NULL, NULL, 'Narayangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(136, 1, 6, 1, 13, 25, 102051340, 'Capricons World (Baridhara)', NULL, NULL, NULL, 'Baridhara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(137, 1, 6, 1, 13, 25, 102051341, 'Pizza End (Gazipura)', NULL, '1716102411', NULL, '107 Gazipura Tongi Gazipur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(138, 1, 6, 1, 13, 25, 102051342, 'Pizza End (Uttara)', NULL, '1716036699', NULL, 'Azampur  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(139, 1, 6, 1, 13, 25, 102051343, 'Ashik Traders (DCC)', NULL, NULL, NULL, '115 DCC Kacha Market Gulshan-01  Dhaka-1212', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(140, 1, 6, 1, 13, 25, 102051344, 'Crisp (100 Feet Chefs table)', NULL, '1914001497', NULL, 'United City  Madani Avenue  100 Feet Road  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(141, 1, 6, 1, 13, 25, 102051345, 'PBS (Shantinagar)', NULL, '1723981186', NULL, '43 Shantinagar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(142, 1, 6, 1, 13, 25, 102051346, 'Re-Eat (Uttara)', NULL, NULL, NULL, 'Sector # 06  Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(143, 1, 6, 1, 13, 25, 102051347, 'Eat Street', NULL, '1778860600', NULL, 'Taltola   Khilgoanj  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(144, 1, 6, 1, 13, 25, 102051348, 'P.B.S (Uttara)', NULL, NULL, NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(145, 1, 6, 1, 13, 25, 102051350, 'Soul Time', NULL, NULL, NULL, 'A.R Plaza (Ground Floor) House# 02 Road#14 Dhanmondi Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(146, 1, 6, 1, 13, 25, 102051351, 'Chew Junior', NULL, NULL, NULL, 'Gulshan Avenue Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(147, 1, 6, 1, 13, 25, 102051352, 'ARNICS DISTRIBUTIONS', 'Mr. Shawon', '1939900018', NULL, 'Sher Shah Suri Road Md.pur Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(148, 1, 6, 1, 13, 25, 102051353, 'Bulls N Barrels (Gulshan-2)', NULL, '1935555111', NULL, 'House # 24  Road # 36', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(149, 1, 6, 1, 13, 25, 102051354, 'Student Cafe (Jamuna)', NULL, '1794288513', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(150, 1, 6, 1, 13, 25, 102051355, 'The Oriental Lounge', NULL, '1955800600', NULL, 'House-133  Road-12 Block-E  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(151, 1, 6, 1, 13, 25, 102051356, 'Open Lounge', NULL, NULL, NULL, 'House-104/E  Road-13  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(152, 1, 6, 1, 13, 25, 102051357, 'Rash & Rown (Mazar Road)', 'Mr. Atik', '1917325806', NULL, '36  B-B 2nd colony Mazar Road(Police Fari Goly) Mirpur', 400000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(153, 1, 6, 1, 13, 25, 102051358, 'Chicken Hut (Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(154, 1, 6, 1, 13, 25, 102051360, 'Shawarma K (Banasree)', NULL, '1616441615', NULL, 'H  # 01  R # 01  Block-F Avenue Road  Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(155, 1, 6, 1, 13, 25, 102051361, 'The Break (Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(156, 1, 6, 1, 13, 25, 102051362, 'Belicioso Fast Food (Banasree)', NULL, '1732234784', NULL, 'House-27  Road-05  Block-C Banasree Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(157, 1, 6, 1, 13, 25, 102051364, 'Dilli Darbar (Police Plaza)', NULL, '1711286332', NULL, 'Police Plaza  Gulshan-1 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(158, 1, 6, 1, 13, 25, 102051002, 'A & W Restaurant (Dhanmondi)', NULL, '01844-000102', NULL, 'House No# 39/C  1st Floor  Road No#14/A  Satmasjid Road  Dhaka 1209', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(159, 1, 6, 1, 13, 25, 102051029, 'Mac N Jack (Uttara)', 'Mr. Mamun', '1937575577', NULL, 'Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(160, 1, 6, 1, 13, 25, 102051031, 'Smoke Music Cafe', NULL, '1930004040', NULL, 'Road # 11 Banani Dhaka', 120000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(161, 1, 6, 1, 13, 25, 102051033, 'Chic\'s N Burg\'s (Uttara)', NULL, '01847067806  01746686479', NULL, 'Sector-07 Road-05 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(162, 1, 6, 1, 13, 25, 102051041, 'Naga-Inc', NULL, NULL, NULL, 'Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(163, 1, 6, 1, 13, 25, 102051264, 'Indian Spicy (Bcity)', 'Mr. Apu', '1762522768', NULL, 'Bashundhara City Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(164, 1, 6, 1, 13, 25, 102051311, 'Transcom Foods Ltd', 'Mr. MAHIUDDIN', '01684-274749', NULL, 'SE(F) - 5  Bir Uttam Mir Shawkat Ali Shorok  (Gulshan Avenue)  Gulshan - 1  Dhaka - 1212.', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(165, 1, 6, 1, 13, 25, 102051363, 'Test of Twist', NULL, NULL, NULL, 'Laxmi Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(166, 1, 6, 1, 13, 25, 102051368, 'Home Bound (Gulshan)', NULL, NULL, NULL, 'Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(167, 1, 6, 1, 13, 25, 102051370, 'Food Fiesta (Dhanmondi-27)', NULL, NULL, NULL, 'Zenetic Plaza  Dhanmondi-27', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(168, 1, 6, 1, 13, 25, 102051371, 'Maxi Fried Chicken (Shaymoli)', NULL, NULL, NULL, 'Shamoli Cinema Hall', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(169, 1, 6, 1, 13, 25, 102051373, 'Hamim Khan Store (KB)', 'Mr. Iqbal Hossain', '1811632911', NULL, '214 Kitchen Market(1st floor)  Kawran Bazar Dhaka-1215', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(170, 1, 6, 1, 13, 25, 102051374, 'Mad Chef (Dhanmondi)', 'Mr. Polen', '1779816579', NULL, '3/A  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(171, 1, 6, 1, 13, 25, 102051376, 'Iram Cafe', NULL, '1981913101', NULL, 'House-11  Road-67 Apartment-5/AB', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(172, 1, 6, 1, 13, 25, 102051377, 'Aesome (Mirpur-1)', NULL, NULL, NULL, 'Darus Salam Road  Mirpur-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(173, 1, 6, 1, 13, 25, 102051378, 'BDFC (Link Road)', 'Mr. Monir(MD)', '1881036901', NULL, 'Badda Link Road Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(174, 1, 6, 1, 13, 25, 102051379, 'Arong (Gulshan)', NULL, '1622921770', NULL, 'Gulshan Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(175, 1, 6, 1, 13, 25, 102051381, 'Arong (Asad Gate)', NULL, '1730305795', NULL, 'Asad Gate Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(176, 1, 6, 1, 13, 25, 102051382, 'Shawarma House (Hatirpool)', NULL, '1911739499', NULL, 'Hatirpool  Dhaka', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(177, 1, 6, 1, 13, 25, 102051384, 'Arong (Mogbazar)', 'Mr. Suvro', '1682840168', NULL, 'Mog Bazar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(178, 1, 6, 1, 13, 25, 102051387, 'Arong(Grass Roots Cafe)', 'Mr. Suvro', '1730305796', NULL, 'Mirpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(179, 1, 6, 1, 13, 25, 102051390, 'Pizza End (Asulia)', NULL, '1714351488', NULL, 'Asulia Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(180, 1, 6, 1, 13, 25, 102052268, 'Cafe Birulia (Mirpur)', NULL, '1552432943', NULL, 'Mazar Road  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(181, 1, 6, 1, 13, 25, 102051391, 'Lucias Pizza (Jamuna)', 'Mr. Rassel', '1911684070', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(182, 1, 6, 1, 13, 25, 102051392, 'Shopno Test (Sector-11)', 'Mr. Kabir', '1928645978', NULL, 'Sector-11 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(183, 1, 6, 1, 13, 25, 102051393, 'Princh Kitchen (Shaymoli)', 'Mr. Jahid', '29134333', NULL, 'Shamoli Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(184, 1, 6, 1, 13, 25, 102051396, 'Spice Restaurant (Airport)', NULL, '1725528351', NULL, 'House-7 Road-89  Sector-04 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(185, 1, 6, 1, 13, 25, 102051397, 'Euro Hut (Dhanmondi)', 'Mr. Mehedi', '1720239016', NULL, 'H No.: 61  R No.: 6/A  Anam Rangs Plaza  Satmasjid Road  Dhanmondi  Dhanmondi-1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(186, 1, 6, 1, 13, 25, 102051398, 'E.F.C (Doxin Khan)', NULL, NULL, NULL, '90  L.K Plaza  Doxin Khan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(187, 1, 6, 1, 13, 25, 102051399, 'Hot Box (Uttara)', NULL, NULL, NULL, 'House-25  Road-18  Sector-03 Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(188, 1, 6, 1, 13, 25, 102051400, 'Food Hill (Police Plaza)', NULL, NULL, NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(189, 1, 6, 1, 13, 25, 102051402, 'Food Factory (Uttara)', NULL, NULL, NULL, 'Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(190, 1, 6, 1, 13, 25, 102051403, 'Delycious Sweets', 'Mr.Joshaf.', '1911593521', NULL, 'Mohakhali D.O.H.S', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(191, 1, 6, 1, 13, 25, 102051040, 'Dhakaiya (Bcity)', 'Mr. Ibrahim', '1732310457', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(192, 1, 6, 1, 13, 25, 102051104, 'Z.F.C (Kochukhat)', NULL, '1682323853', NULL, 'Kochukhat', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(193, 1, 6, 1, 13, 25, 102051261, 'Smell & Smile (Malibagh)', NULL, '1759254377', NULL, '101 Malibag Chowdhury Para', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(194, 1, 6, 1, 13, 25, 102051295, 'Baishakhi (B.City)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(195, 1, 6, 1, 13, 25, 102051308, 'Indian Spicy Chicken (Mirpur)', NULL, '1722277667', NULL, 'Road # 04 Section # A Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(196, 1, 6, 1, 13, 25, 102051369, 'Wendys Fast Food (Dhanmondi)', NULL, '01714-066150', NULL, 'Arang (Asad Gate)  Mirpur road  Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(197, 1, 6, 1, 13, 25, 102051380, 'Preetom Burger (Banani)', NULL, '1911338467', NULL, 'A L Complex House-78/7 (4th floor) Chairman Bari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(198, 1, 6, 1, 13, 25, 102051394, 'Western Grill (Mirpur-2)', 'Mr. Reza', '1940762452', NULL, 'Mirpur-02  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(199, 1, 6, 1, 13, 25, 102051405, 'Kutumbari (Tangail)', 'Mr. Alom', '1683058989', NULL, 'Akur Takur para  Tangail', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(200, 1, 6, 1, 13, 25, 102051407, 'Sub Lovers (Anonna Market)', 'Mr. Dipu', '1842183349', NULL, 'Baridhara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(201, 1, 6, 1, 13, 25, 102051409, 'Sub Lovers (Police Plaza)', NULL, '1874609814', NULL, 'Police Plaza Concord Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(202, 1, 6, 1, 13, 25, 102051410, 'American Captain (Mirpur-6)', NULL, '1732038515', NULL, 'House-9/10 Road-15 Block-D Section-06 Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(203, 1, 6, 1, 13, 25, 102051411, 'Chicken Hut (Mirpur-1)', NULL, '1559024588', NULL, 'Majar Road  Mirpur-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(204, 1, 6, 1, 13, 25, 102051419, 'Kabab Express (Shaymoli)', NULL, NULL, NULL, '8/1 Shamoli Link Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(205, 1, 6, 1, 13, 25, 102051420, 'Hot Plate (Uttara)', 'Mr. Nurul', '1634176688', NULL, 'Sector-03  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(206, 1, 6, 1, 13, 25, 102051421, 'Beans & Aroma (Uttara)', NULL, '1841401746', NULL, 'House - 09  Road - 18 Sector - 03  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(207, 1, 6, 1, 13, 25, 102051422, 'Sub Zone (Taltola)', 'Mr. Redwan', '1788777666', NULL, 'Khilgoan Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(208, 1, 6, 1, 13, 25, 102051424, 'Kiva Han (Gulshan)', 'Emon', '01683550186  01716075873', NULL, 'Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(209, 1, 6, 1, 13, 25, 102051426, 'Hotel Bengal (Gul-02)', NULL, '1622666631', NULL, 'Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(210, 1, 6, 1, 13, 25, 102051427, 'Iron Chef (Jamuna)', 'Mr. Jahid', '1819277540', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(211, 1, 6, 1, 13, 25, 102051428, 'Taste Of Indian Spicy (J.F)', NULL, '1720983294', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(212, 1, 6, 1, 13, 25, 102051430, 'S.F.C (Askona)', NULL, NULL, NULL, 'Haji camp Askona', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(213, 1, 6, 1, 13, 25, 102051431, 'New Wow Chicken (Mirpur-1)', NULL, NULL, NULL, 'House-16  Block-E  Avenue-03', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(214, 1, 6, 1, 13, 25, 102051432, 'Captains World', NULL, NULL, NULL, 'Jahangir Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(215, 1, 6, 1, 13, 25, 102051433, 'Shawarma King (Banasree)', NULL, '1552392777', NULL, 'Banasree F Block  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(216, 1, 6, 1, 13, 25, 102051434, 'Terrace Garden (Uttara)', NULL, NULL, NULL, 'Road-06 House-71 Sector-12 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(217, 1, 6, 1, 13, 25, 102051435, 'Kings Burger (jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(218, 1, 6, 1, 13, 25, 102051436, 'Cafe Selfe ((Mohammadpur)', NULL, '1712989838', NULL, 'Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(219, 1, 6, 1, 13, 25, 102051003, 'Adonize Foods (BGB Gate)', NULL, '1707001475', NULL, 'BGB Gate  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(220, 1, 6, 1, 13, 25, 102051005, 'Bella Italia (Gulshan)', 'Mr. Sohid', '29851479', NULL, 'Gulshan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(221, 1, 6, 1, 13, 25, 102051006, 'Bella Italia (Dhanmondi)', NULL, '01771-077001', NULL, 'Dhanmondi ADC Empire Plaza  (1st Floor)  Plot 91  Road 12/A  Satmasjid Road   Dhanmondi  Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(222, 1, 6, 1, 13, 25, 102051007, 'Thirty Three Restaurant', 'Mr. Ratan', '29331014', NULL, 'Baily Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(223, 1, 6, 1, 13, 25, 102051010, 'Pizza Palace (Banasree)', 'Mr.Saleh', '1724290991', NULL, 'House # 35  Road # 04 Block # C Rampura Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(224, 1, 6, 1, 13, 25, 102051011, 'Saltz (Gulshan-2)', NULL, '1319783330', NULL, 'Road # 62  Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(225, 1, 6, 1, 13, 25, 102051012, 'Fuwang Powling & Service Ltd', NULL, NULL, NULL, 'Tejgoan Link Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(226, 1, 6, 1, 13, 25, 102051013, 'Dhaka Bank Ltd', NULL, '1717036799', NULL, 'Gulshan-1 branch  Gulshan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(227, 1, 6, 1, 13, 25, 102051014, 'German Club', 'Mr. Gilbut', '01953865428/01717182329', NULL, 'Road # 104  Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(228, 1, 6, 1, 13, 25, 102051019, 'La for cita', NULL, '29896526', NULL, 'Gulshan-02  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(229, 1, 6, 1, 13, 25, 102051020, 'Zoook', 'Mr. Faysal', '1712046152', NULL, 'Pink City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(230, 1, 6, 1, 13, 25, 102051021, 'Sharma N Pizza (Mirpur)', NULL, NULL, NULL, 'Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(231, 1, 6, 1, 13, 25, 102051022, 'Fridays Fast Food (Jamuna)', 'Mr. Nadif', '1917144955', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(232, 1, 6, 1, 13, 25, 102051028, 'Drumstick (Jamuna)', NULL, '1682066056', NULL, 'Jamuna Future Park  Kuril  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(233, 1, 6, 1, 13, 25, 102051044, 'Taste Bird', NULL, NULL, NULL, 'Road-12 Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(234, 1, 6, 1, 13, 25, 102051048, 'M.F.C (Baridhara)', NULL, NULL, NULL, 'Baridhara  Basundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(235, 1, 6, 1, 13, 25, 102051052, 'Atthin Restaurent(Banani)', 'Mr. Mahafuz', '01927671136/01933776094', NULL, 'House-09 Road-27  Banani Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(236, 1, 6, 1, 13, 25, 102051094, 'Shawarma House (Jamuna)', 'Mr. Mizan', '01911374442 /01797294267', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(237, 1, 6, 1, 13, 25, 102051314, 'Indian Spicy Masala (B.City)', NULL, '1778972074', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(238, 1, 6, 1, 13, 25, 102051429, 'Indian Dosa Ghar (J.F)', 'Mr. Jakir', '1712496548', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(239, 1, 6, 1, 13, 25, 102051437, 'C.K (Jamuna)', NULL, NULL, NULL, 'Shop-48  Block-C Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(240, 1, 6, 1, 13, 25, 102051439, 'Tongue & Tummy (Bcity)', 'Mr. Samendranath', '01639768937/01734309887', NULL, 'Bashundhara City  Dhaka', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(241, 1, 6, 1, 13, 25, 102051440, 'Sauslys Food (Uttara)', NULL, '1715689654', NULL, 'Goriber Newaj Road  Popular Diagnostic Centre OppositeUttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(242, 1, 6, 1, 13, 25, 102051442, 'Bhojon Bilash (Rampura)', NULL, NULL, NULL, 'Rampura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(243, 1, 6, 1, 13, 25, 102051443, 'Burger Zone(Uttara)', NULL, NULL, NULL, 'Rajloxmi  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(244, 1, 6, 1, 13, 25, 102051445, 'American Blend (Bashundhara)', NULL, '1758882161', NULL, 'Nasor Heveily  Tower  Bashudhara R/A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(245, 1, 6, 1, 13, 25, 102051446, 'Max Cafe (Jatrabari)', NULL, NULL, NULL, 'Jatrabari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(246, 1, 6, 1, 13, 25, 102051448, 'Line & Fine (banani)', NULL, NULL, NULL, 'House-24  Road-08 Block-F  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(247, 1, 6, 1, 13, 25, 102051449, 'Premium Sweets(Gulshan-02)', NULL, '1790891168', NULL, 'Gulshan-02 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(248, 1, 6, 1, 13, 25, 102051450, 'M.G.H Restaurant Ltd. (Nando\'s)', 'Ms. Faria', '1777711615', NULL, 'Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(249, 1, 6, 1, 13, 25, 102051451, 'M.G.H Restaurant Ltd.(Nando\'s)', NULL, NULL, NULL, 'Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(250, 1, 6, 1, 13, 25, 102051452, 'M.G.H Restaurant Ltd.(Nando\'s)', 'Ms. Faria', NULL, NULL, 'Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(251, 1, 6, 1, 13, 25, 102051453, 'M.G.H Restaurant Ltd.(Nando\'s)', NULL, NULL, NULL, 'Dhanmondi-27  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(252, 1, 6, 1, 13, 25, 102051456, 'Bel Cibo (Azimpur)', NULL, NULL, NULL, '44/H Belly Garden Azimpur(Sapra Masjid)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(253, 1, 6, 1, 13, 25, 102051458, 'M.F.C (Mirpur-10)', NULL, NULL, NULL, 'Mirpur-10', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(254, 1, 6, 1, 13, 25, 102051036, 'Flavour Music Cafe', 'Mr. Asad', '1774889131', NULL, 'Dhanmondi Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(255, 1, 6, 1, 13, 25, 102051365, 'Hungry Anger (Dhanmondi)', NULL, NULL, NULL, 'Raifel Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(256, 1, 6, 1, 13, 25, 102051366, 'Japanees Cuisine (Dhanmondi)', NULL, NULL, NULL, 'Raifel Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(257, 1, 6, 1, 13, 25, 102051367, 'The Prominent Food (Dhan)', NULL, '1631137460', NULL, 'Raifel Square Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(258, 1, 6, 1, 13, 25, 102051414, 'Flames (Police Plaza)', NULL, NULL, NULL, 'Shop-569 Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(259, 1, 6, 1, 13, 25, 102051457, 'Hand Shake Restaurant(Uttara)', 'Mr. Shumon', '1819260686', NULL, '30 Shahjalal Avenue  Sector-04 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(260, 1, 6, 1, 13, 25, 102051459, 'Uni Cafe (Panthopath)', NULL, '1841144000', NULL, 'Beside Square Hospital  Panthopath  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(261, 1, 6, 1, 13, 25, 102051460, 'Street B.B.Q (Baridhara)', NULL, '1726456088', NULL, 'Bashundhara R/A  Opposite of Bashundhara Convention City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(262, 1, 6, 1, 13, 25, 102051461, 'Hot Pizza (Uttara)', NULL, NULL, NULL, 'Sector-03 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(263, 1, 6, 1, 13, 25, 102051464, 'Slice of Slice (Jamuna)', 'Mr. Jakir', '1712496548', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(264, 1, 6, 1, 13, 25, 102051465, 'Royal Restaurant (Narayanganj)', NULL, '1672106189', NULL, 'Md Square  Holding-208  mBahasha Shoinik road  Chasara  Balurmath  Narayanganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(265, 1, 6, 1, 13, 25, 102051467, 'R Yummy Yummy (B.Baria)', NULL, NULL, NULL, 'Barmmanbaria', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(266, 1, 6, 1, 13, 25, 102051468, 'Grill King (Shahbag)', NULL, NULL, NULL, 'Shahbag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(267, 1, 6, 1, 13, 25, 102051469, 'Mad Chef (Banani)', 'Mr. Ripon', '1799000007', NULL, 'House-06 Road-17 Block-E  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(268, 1, 6, 1, 13, 25, 102051470, 'Premium Sweet (Gulshan-01)', NULL, NULL, NULL, 'Gulshan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(269, 1, 6, 1, 13, 25, 102051471, 'Sauslys Food (Panthopath)', NULL, '29126821', NULL, 'Panthopath  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(270, 1, 6, 1, 13, 25, 102051472, 'Food 4U (Mirpur)', NULL, NULL, NULL, 'Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(271, 1, 6, 1, 13, 25, 102051473, 'BDFC (Gazipur)', NULL, '1718281652', NULL, 'Gazipur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(272, 1, 6, 1, 13, 25, 102051474, 'Bismilla Fresh Food(Tongi)', NULL, '1785032392', NULL, 'Mutter Bari Road Tongi College Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(273, 1, 6, 1, 13, 25, 102051475, 'Hotel Six Season', NULL, '1987009805', NULL, 'Gulshan-2  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(274, 1, 6, 1, 13, 25, 102051477, 'The Flamingo 7 Zone Cafe', NULL, NULL, NULL, 'House-88  Road-23 Block-A Banani Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(275, 1, 6, 1, 13, 25, 102051481, 'Al-Amar (Dhanmondi)', NULL, '01745-563819', NULL, 'Dhanmondi-27  Opposit of Meena Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(276, 1, 6, 1, 13, 25, 102051057, 'Showpno Test (Basabo)', 'Mr. Kabir', '1928645978', NULL, 'Basaba  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(277, 1, 6, 1, 13, 25, 102051062, 'Qusedilla (Banani)', 'Mr. Jahangir', '1764480145', NULL, 'Road # 12/11 Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(278, 1, 6, 1, 13, 25, 102051072, 'Mughal Bistro (Jamuna)', 'Owner', '1814306050', NULL, 'Jamuna Future Park Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(279, 1, 6, 1, 13, 25, 102051103, 'Cafe Hello (Dhanmondi)', NULL, '01780-011587', NULL, '49/A Satmasjid Road  Dhaka 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(280, 1, 6, 1, 13, 25, 102051246, 'Wow Burger', NULL, NULL, NULL, 'Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(281, 1, 6, 1, 13, 25, 102051282, 'Heritage Pizza', NULL, '1786064031', NULL, '187 Elepent Road  Raj Complex  Dhanmondi  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(282, 1, 6, 1, 13, 25, 102051283, 'Haritage Pizza', NULL, NULL, NULL, '187 Elepent Road Raj Complex', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(283, 1, 6, 1, 13, 25, 102051483, 'Foody (Banani)', 'Mr. Salam', '1939900061', NULL, 'House-100  Road-11 Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(284, 1, 6, 1, 13, 25, 102051484, 'Chefs Kitchen (Police Plaza)', NULL, '1762198844', NULL, 'Police Plaza Gulshan-01  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(285, 1, 6, 1, 13, 25, 102051485, 'Dhanmondi Club', NULL, NULL, NULL, 'Metro Shopping Mall Level-6)  House-01  # (New)  Rd No: 12  Dhanmondi-1209 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(286, 1, 6, 1, 13, 25, 102051487, 'Famous Sabooy (Banasree)', NULL, '1629354121', NULL, '10 Tola Market(1st floor) Doxin Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(287, 1, 6, 1, 13, 25, 102051488, 'Indian Spicy Masala(Mirpur)', NULL, NULL, NULL, 'Road # 02 Section # 02 Block # G Mirpur # 02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(288, 1, 6, 1, 13, 25, 102051490, 'Harvest Restaurant', NULL, '1622225533', NULL, 'House-7  Road-14-C  Sector-4  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(289, 1, 6, 1, 13, 25, 102051494, 'Shawrma house (Bcity)', NULL, NULL, NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(290, 1, 6, 1, 13, 25, 102051496, 'The Ground', NULL, '1722667503', NULL, 'House # 146/2 Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(291, 1, 6, 1, 13, 25, 102051502, 'Hot N Roll (Dhanmondi)', NULL, NULL, NULL, 'Rifle Square  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(292, 1, 6, 1, 13, 25, 102051510, 'Gasoline (Dhanmondi)', NULL, NULL, NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(293, 1, 6, 1, 13, 25, 102051497, 'Cafe Food King (Gandaria)', NULL, NULL, NULL, 'Gadaria  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(294, 1, 6, 1, 13, 25, 102051499, 'M/S Motalib Store (Central Zail)', 'Mr. Motalib', '1977954728', NULL, 'Central Zail', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(295, 1, 6, 1, 13, 25, 102051501, 'Shahjalal Banizzo Bitan (Mirpur-11)', NULL, '1941127989', NULL, 'Kacha Bazar Mirpur-11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(296, 1, 6, 1, 13, 25, 102051503, 'Al Fresco (Dhanmondi)', NULL, '1843795102', NULL, 'Dhanmondi 3/A Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(297, 1, 6, 1, 13, 25, 102051504, 'Dhaka Fried Chicken(Wari)', NULL, '1676328572', NULL, 'Wari  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(298, 1, 6, 1, 13, 25, 102051506, 'Cloud Restaurant (Banani)', NULL, '1916655678', NULL, 'Road-11  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(299, 1, 6, 1, 13, 25, 102051508, 'Hotel Fars (Polton)', 'Mr. Jahid', '1924026218', NULL, 'Polton  Near Marchentile Bank', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(300, 1, 6, 1, 13, 25, 102051509, 'Mr.Ashraf(B.City)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(301, 1, 6, 1, 13, 25, 102051512, 'Shawarma House(Baily Road)', NULL, '1711120339', NULL, 'Baily Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(302, 1, 6, 1, 13, 25, 102051513, 'Cafe Express (Adabor)', NULL, '1624954931', NULL, 'Adabor  Shamoli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(303, 1, 6, 1, 13, 25, 102051514, 'Platinum Sweets (Banani)', 'Rahman', '1922110987', NULL, 'Road-11  Banani Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(304, 1, 6, 1, 13, 25, 102051515, 'Mughal Sweets (Karwan Bazaar)', NULL, NULL, NULL, 'Karwan Bazaar  Near Star Kabab', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(305, 1, 6, 1, 13, 25, 102051516, 'Snacks Hut (Dhanmondi)', NULL, '1766553000', NULL, 'Dhanmondi  Shonkor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(306, 1, 6, 1, 13, 25, 102051517, 'Red Box (Manik Nagar)', NULL, '1623397808', NULL, 'Manik Nagar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(307, 1, 6, 1, 13, 25, 102051518, 'Blockbuster Cinema Hall (Jamuna)', 'Mr. Bokul', '1777130775', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(308, 1, 6, 1, 13, 25, 102051521, 'Aroma Life Kitchen(Zigatola)', NULL, NULL, NULL, 'Zigatola Bus Stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(309, 1, 6, 1, 13, 25, 102051522, 'Oreano(Zigatola)', NULL, '1676767806', NULL, 'Zigatola Busstand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(310, 1, 6, 1, 13, 25, 102051523, 'Cafe Food Land(Wari)', 'Mr  Lincon', '1734266666', NULL, 'Wari  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(311, 1, 6, 1, 13, 25, 102051524, 'Red Res (Mohammadpur)', 'Mr. Mamun', '1841885885', NULL, 'Mohammadpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(312, 1, 6, 1, 13, 25, 102051525, 'Juice & Juicy ( Hatirpool)', NULL, NULL, NULL, 'Hatirpul  Elephant Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(313, 1, 6, 1, 13, 25, 102051526, 'Ala Uddin Traders (DCC)', NULL, NULL, NULL, 'DCC Market Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(314, 1, 6, 1, 13, 25, 102051527, 'Spicy Nine(Wari)', NULL, NULL, NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(315, 1, 6, 1, 13, 25, 102051529, 'Nayma Store (Taltola)', NULL, NULL, NULL, 'Taltola  Khilgaon', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(316, 1, 6, 1, 13, 25, 102051530, 'Pizza & Pasta (Mirpur-2)', NULL, '1754302696', NULL, 'Mirpur-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(317, 1, 6, 1, 13, 25, 102051531, 'Platinum Residence Hotel', NULL, NULL, NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(318, 1, 6, 1, 13, 25, 102051533, 'Adonize ( Rapa Plaza)', 'Mr  Dipu', NULL, NULL, 'Plot 01  Road Old 27 New 16  Dhanmondi R/A  Dhanmondi-27', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(319, 1, 6, 1, 13, 25, 102051534, 'Spicy (Banasree)', NULL, '01835290066   01914800248', NULL, 'Banasree  Rampura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(320, 1, 6, 1, 13, 25, 102051535, 'Dominus Pizza (B.City)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(321, 1, 6, 1, 13, 25, 102051536, 'Flavour Cafe (Banani)', NULL, NULL, NULL, 'House-08  Road-13/C  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(322, 1, 6, 1, 13, 25, 102051537, 'Mizan Traders(DCC)', NULL, '1915493536', NULL, 'DCC Market Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(323, 1, 6, 1, 13, 25, 102051538, 'Q.F.C (Tikatoli)', NULL, '1736119933', NULL, 'Tikatoli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(324, 1, 6, 1, 13, 25, 102051540, 'Comic Cafe (Goran)', NULL, '1924800881', NULL, '340 East Goran  Haji Masjid', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(325, 1, 6, 1, 13, 25, 102051541, 'Emotion Restaurant(Uttara)', 'Mr. Rana', '1767802557', NULL, 'Garib E Newaz Road Sector-11 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(326, 1, 6, 1, 13, 25, 102051542, 'Okra Res (dhanmondi)', NULL, NULL, NULL, '4th floor  Air Plaza  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(327, 1, 6, 1, 13, 25, 102051544, 'Showrma King (Dhanmondi)', NULL, '1616441619', NULL, 'H # 46 ( L3)  Rupayan ZA Plaza  9/A  Dhanmondi ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(328, 1, 6, 1, 13, 25, 102051547, 'Azmari Bazar (Md.Pur)', NULL, NULL, NULL, 'Besid Suchona Community Center', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(329, 1, 6, 1, 13, 25, 102051408, 'Anannya Cuisine (Narshingdi)', NULL, '1785811828', NULL, 'Narsingdi Sadar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(330, 1, 6, 1, 13, 25, 102051500, 'Jenny\'s Kitchen', NULL, NULL, NULL, 'Jamuna Future park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(331, 1, 6, 1, 13, 25, 102051548, 'Fantasia Food (Taltola)', NULL, '1745662907', NULL, 'Khilgoan (Taltola)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(332, 1, 6, 1, 13, 25, 102051549, 'Cuppa Coffee Lounge (Gulshan-2)', NULL, '1733522729', NULL, 'Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(333, 1, 6, 1, 13, 25, 102051550, 'Street Shawarma (Baily Road)', NULL, NULL, NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(334, 1, 6, 1, 13, 25, 102051551, 'L.F.C (B.city)', 'Mr. Mahabub', NULL, NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(335, 1, 6, 1, 13, 25, 102051552, 'Juicy & Juicy (Mirpur DOHS)', 'Kamruzzaman', '1553292222', NULL, 'DOHS', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(336, 1, 6, 1, 13, 25, 102051553, 'Juice Garden (Tokyo Square)', 'Mr. Shamim', '1724904109', NULL, 'Tokyo Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(337, 1, 6, 1, 13, 25, 102051554, 'Formuza Q Q (Dhan)', 'Mr. Roni', '1730472168', NULL, 'Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(338, 1, 6, 1, 13, 25, 102051555, 'Others(Uttara)', NULL, NULL, NULL, 'House-18 Road-15 Sector-04 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(339, 1, 6, 1, 13, 25, 102051556, 'Radi mart', NULL, NULL, NULL, 'Mirpur Cantonment', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(340, 1, 6, 1, 13, 25, 102051558, 'The Shawrma House', NULL, '29331014', NULL, 'Ramna', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(341, 1, 6, 1, 13, 25, 102051560, 'Garlic & Ginger (Jamuna)', 'Mr  Parvez', '193397194', NULL, 'Jamuna Future Park  Kuril  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(342, 1, 6, 1, 13, 25, 102051562, 'Hot Pizza (Shaymoli)', NULL, NULL, NULL, 'Shamoli Squar Market  Shamoli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(343, 1, 6, 1, 13, 25, 102051563, 'Mad Chef(Uttara)', NULL, '1764244343', NULL, 'Jowel Tower  House-34 Floor(4th) Sector-11 Goreb E Newaz Avenue', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(344, 1, 6, 1, 13, 25, 102051565, 'Fork over Knife (Uttara)', NULL, '1670248146', NULL, 'Sector-03 Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(345, 1, 6, 1, 13, 25, 102051566, 'Tasty Bite(Gulshan)', NULL, '1712602844', NULL, 'House # 1/A  Road # 16 Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(346, 1, 6, 1, 13, 25, 102051567, 'Harvest Kitchen (Ashkuna)', NULL, NULL, NULL, 'Kamaruddin Tower Ashkuna  Hazi Camp  Airport', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(347, 1, 6, 1, 13, 25, 102051568, 'Arong (uttara)', 'Mr. Musa', '1686723828', NULL, 'Uttara  Jashimuddin', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(348, 1, 6, 1, 13, 25, 102051569, 'Star Chilly (Mirpur-10)', NULL, NULL, NULL, 'Mirpur 10', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(349, 1, 6, 1, 13, 25, 102051570, 'Ratatouille (uttara)', 'Mr. Morshed', '1923760879', NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(350, 1, 6, 1, 13, 25, 102051571, 'Broast & Grill (Bcity)', NULL, '1723895772', NULL, 'Bashundhara city Food Court', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(351, 1, 6, 1, 13, 25, 102051572, 'Frog over Knife (Uttara)', NULL, NULL, NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(352, 1, 6, 1, 13, 25, 102051573, 'Peri Peri (Md.Pur)', 'Mr. Nasir', '1734656601', NULL, 'Md.Pur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(353, 1, 6, 1, 13, 25, 102051576, 'Farid', 'Mr. Farid', '1977515155', NULL, 'Buddha Temple  Merul Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(354, 1, 6, 1, 13, 25, 102051577, 'Spicy Chicken Masala', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(355, 1, 6, 1, 13, 25, 102051579, 'Fazitaas (Mohammadpur)', NULL, '1911733167', NULL, 'Opposit of Monsurabad Mosjid  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(356, 1, 6, 1, 13, 25, 102051580, 'Bhooter bari (Dhan)', 'Mr. ASIF', '1912057025', NULL, 'House: 1/5  Road: 7 Block-D  Dhanmondi  Dhaka-1207', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(357, 1, 6, 1, 13, 25, 102051582, 'Corn Carnival (Ctg)', 'Mr. Kader', '1631388502', NULL, 'Store:  Rupali Cold Storage  Sagorika  Chittagong  01841606606', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(358, 1, 6, 1, 13, 25, 102051583, 'Sub Lovers Fast Food', 'Mr. Dipu', '1745565398', NULL, 'Khilgaon  taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(359, 1, 6, 1, 13, 25, 102051519, 'Cold Stone(Gulshan)', NULL, NULL, NULL, 'Opposite of Fish & Co. Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(360, 1, 6, 1, 13, 25, 102051578, 'Gogon Food (Mir)', NULL, '1915877532', NULL, 'Shop # 2 Stadium market  Proshika road  Mirpur-2  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(361, 1, 6, 1, 13, 25, 102051584, 'Squeeze Season ( Police Plaza)', NULL, NULL, NULL, 'Police Plaza Concord  Gulshan-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(362, 1, 6, 1, 13, 25, 102051585, 'Star Cineplex (B.city)', 'Ms. Salma', '1755625489', NULL, 'Panthapath  B city', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(363, 1, 6, 1, 13, 25, 102051586, 'Trust Showrma(Mirpur DOHS Gate)', 'Mr. Morshed', '1611146780', NULL, 'Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(364, 1, 6, 1, 13, 25, 102051587, 'Drinkit (Dhanmondi)', NULL, '1877349427', NULL, 'Momotaz Plaza House-07 Road-04', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(365, 1, 6, 1, 13, 25, 102051588, 'Shariatpuri Enterprse (Banani)', NULL, '1942068555', NULL, 'Banani Kacha Bazar  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(366, 1, 6, 1, 13, 25, 102051589, 'American Burger(Md.Pur)', NULL, NULL, NULL, 'Mohammadpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(367, 1, 6, 1, 13, 25, 102051590, 'Bhooter Bari (Lalbag)', 'Mr. Sumon', '1990505686', NULL, 'Lalbag', 400000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(368, 1, 6, 1, 13, 25, 102051593, 'Indian Hot Spicy (Bcity)', NULL, '01820-101172', NULL, 'Boshundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(369, 1, 6, 1, 13, 25, 102051594, 'Crispy World (Bcity)', NULL, NULL, NULL, 'Boshudhara City', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(370, 1, 6, 1, 13, 25, 102051597, 'Bangla Burger  (Mirpur-10)', 'Mr. Shamim', '1926667769', NULL, 'House-66 Block-A Sector-06  Avenue-5 Mirpur-10', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(371, 1, 6, 1, 13, 25, 102051598, 'AFC (M.Pur)', NULL, NULL, NULL, 'Commerce College  Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(372, 1, 6, 1, 13, 25, 102051599, 'N.F.C (Police Plaza)', NULL, NULL, NULL, 'Police Plaza  Gulshan-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(373, 1, 6, 1, 13, 25, 102051600, 'Calfornia fried (Dhanmondi)', 'Mr. Rashid', '1992043903', NULL, 'Dhamondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(374, 1, 6, 1, 13, 25, 102051603, 'Ratul Super Store (Bashundhara Gate)', 'Mr  Ratul', '1857422002', NULL, 'Beside Icon Center  Opposite of Bashundhara Gate ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(375, 1, 6, 1, 13, 25, 102051604, 'BCH (Khilkhet)', NULL, '1722886018', NULL, 'Ka 161/2/A Madda Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(376, 1, 6, 1, 13, 25, 102051605, 'Sweet Heart', NULL, NULL, NULL, 'Lalbag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(377, 1, 6, 1, 13, 25, 102051606, 'Meem International', 'Mr. Kader', '1737024960', NULL, 'KA 90/1 South Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(378, 1, 6, 1, 13, 25, 102051607, 'Dilli Darbar (Taltola)', NULL, NULL, NULL, 'Taltola  Malibagh', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(379, 1, 6, 1, 13, 25, 102051608, 'Omera Cafe', NULL, '01673-970857', NULL, 'SW(G)-8  Bir uttam  Mir Shaowkat Road  Gulshan-1 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(380, 1, 6, 1, 13, 25, 102051609, 'Food Lovers (Police Plaza)', NULL, '1711286332', NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(381, 1, 6, 1, 13, 25, 102051610, 'Chicken Hut (Farmgate)', NULL, NULL, NULL, 'Farmgate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(382, 1, 6, 1, 13, 25, 102051611, 'Standard Charterd Bank', NULL, NULL, NULL, 'Karwan Bazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(383, 1, 6, 1, 13, 25, 102051612, 'Mrs Adeel (BC)', 'Mr. Alomgir-Igloo', NULL, NULL, 'Bashundhara City', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(384, 1, 6, 1, 13, 25, 102051614, 'Food Castle (Mirpur-1)', NULL, '1711086635', NULL, 'Opposit of panir tanki Mirpur-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(385, 1, 6, 1, 13, 25, 102051520, 'Shawarma House(Taltola)', NULL, '1723382252', NULL, 'Khilgoan  Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(386, 1, 6, 1, 13, 25, 102051615, 'Mexicana Fried Chicken (Shaymoli)', NULL, NULL, NULL, 'Square Market  Shyamoli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(387, 1, 6, 1, 13, 25, 102051617, 'Ci Gusta', 'Mr  Monir', '1977332203', NULL, 'Road#12 House#133 Banani', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(388, 1, 6, 1, 13, 25, 102051620, 'Food Club (300 Feet)', NULL, NULL, NULL, '300 feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(389, 1, 6, 1, 13, 25, 102051625, 'Polash (B.city)', NULL, NULL, NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(390, 1, 6, 1, 13, 25, 102051626, 'Taco Inn', NULL, '01978-226466', NULL, '45 Gaushul Azam Ave Sector-14 Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(391, 1, 6, 1, 13, 25, 102051628, 'Rasuba Restaurant', NULL, NULL, NULL, 'Plot-14  Sec-11  Road-10  Uttara-14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(392, 1, 6, 1, 13, 25, 102051629, 'Hotel Nordic', NULL, NULL, NULL, 'Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(393, 1, 6, 1, 13, 25, 102051630, 'Royal Food (Uttara)', NULL, NULL, NULL, 'Sectro-12 Uttara Under Royal Club', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(394, 1, 6, 1, 13, 25, 102051631, 'Royal Store (Karwanbazar)', 'Mr. Hasan', '1619887687', NULL, 'Karwan Bazar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(395, 1, 6, 1, 13, 25, 102051632, 'Cheek Inn (Taltola)', NULL, '1792503040', NULL, 'Taltola Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(396, 1, 6, 1, 13, 25, 102051633, 'Food Pavillion (Shyamoli)', NULL, NULL, NULL, 'Shyamoli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(397, 1, 6, 1, 13, 25, 102051635, 'Premium Sweets (uttara)', NULL, NULL, NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(398, 1, 6, 1, 13, 25, 102051636, 'Hot Pizza (Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park  Bashundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(399, 1, 6, 1, 13, 25, 102051638, 'City Fried (Shaymoli)', NULL, '1715416528', NULL, '22/12 Mirpur Road Opposit Shisu Mela', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(400, 1, 6, 1, 13, 25, 102051639, 'Juel Traders (DCC)', NULL, '1970986500', NULL, 'DCC Market Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(401, 1, 6, 1, 13, 25, 102051640, 'StarBean Coffee', NULL, NULL, NULL, 'House-1  Road-5  Sec-1  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(402, 1, 6, 1, 13, 25, 102051641, 'Grill & Burger (300 Feet)', NULL, NULL, NULL, '300 ft  Bashudhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(403, 1, 6, 1, 13, 25, 102051643, 'Spicy Masala (B.City)', NULL, '01828-159872', NULL, 'Bashundhara city  Panthapath', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(404, 1, 6, 1, 13, 25, 102051644, 'Stack House', NULL, NULL, NULL, 'Road-92  Gulshan-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(405, 1, 6, 1, 13, 25, 102051646, 'Coffee & Burger (BCity)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(406, 1, 6, 1, 13, 25, 102051649, 'Fork Road (Mirpur-6)', NULL, NULL, NULL, 'In Front Of popular Hospital Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(407, 1, 6, 1, 13, 25, 102051650, 'Cafe De Cold (Mirpur-6)', NULL, '1961087853', NULL, 'Plot-52  Ave-5  Block-A  Sec-6  Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(408, 1, 6, 1, 13, 25, 102051651, 'Cafe A Meeting', 'Mr. Imran', '1970003139', NULL, 'Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(409, 1, 6, 1, 13, 25, 102051653, 'Polash (Bcity)', NULL, NULL, NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(410, 1, 6, 1, 13, 25, 102051656, 'Grill King (Shaymoli)', NULL, '1793116277', NULL, 'Beside Shyamoli Field', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(411, 1, 6, 1, 13, 25, 102051663, 'Sub Lover\'s  (Khilgaon)', NULL, '1745565398', NULL, 'Khilgaon  Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(412, 1, 6, 1, 13, 25, 102051655, 'Fried King (B.City)', NULL, '1726908996', NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(413, 1, 6, 1, 13, 25, 102051657, 'Millinium (Narayanganj)', 'Mr. Tonoy', '1712889642', NULL, 'N.Gonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(414, 1, 6, 1, 13, 25, 102051658, 'Peprika Restaurant', 'Mr. Ashique', '1819501806', NULL, 'House 55  4/A  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(415, 1, 6, 1, 13, 25, 102051661, 'Florentine (Tejgaon)', NULL, '1811216285', NULL, 'Near Shanta Tower  Patrol Pump', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(416, 1, 6, 1, 13, 25, 102051665, 'Invite (Mirpur DOHS)', 'Mr. Hossain', '1627429854', NULL, 'Mirpur  DOHS', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(417, 1, 6, 1, 13, 25, 102051666, 'Shopon General Store (Mohammadpur)', NULL, '1536178516', NULL, 'Mohammad pur  Town Hall Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(418, 1, 6, 1, 13, 25, 102051667, 'Hashem', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(419, 1, 6, 1, 13, 25, 102051668, 'Chocolate Cafes Bangladesh Ltd', NULL, NULL, NULL, 'Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(420, 1, 6, 1, 13, 25, 102051669, 'Mr.Rashed(Staff Quater)', NULL, '1745320073', NULL, 'Staff Quater', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(421, 1, 6, 1, 13, 25, 102051673, 'Shopno Taste (Banani)', 'Mr. Kabir', '1928645978', NULL, 'Road - 11  Banani Bridge', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(422, 1, 6, 1, 13, 25, 102051674, 'C F C (Kollanpur)', NULL, '1670922128', NULL, 'Kollanpur Bridge', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(423, 1, 6, 1, 13, 25, 102051675, 'Spicy Chicken (Mirpur)', NULL, NULL, NULL, 'Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(424, 1, 6, 1, 13, 25, 102051676, 'Shawarma Village (Mohammadpur)', NULL, NULL, NULL, 'Tajmohol road  Mohammadpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(425, 1, 6, 1, 13, 25, 102051678, 'Air Cafe (Old Airport)', NULL, '1703861495', NULL, 'Old Airport  Tejgaon  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(426, 1, 6, 1, 13, 25, 102051679, 'Gloria Jeans (gulshan-1)', 'Mr. Apu', '1919198694', NULL, 'Gulshan-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(427, 1, 6, 1, 13, 25, 102051680, 'Cafe Wanderlust (Mirpur-2)', NULL, '1976887879', NULL, '1 No Gate Stadium Mirpur-02 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(428, 1, 6, 1, 13, 25, 102051681, 'Aara Restaurant(Mohakhali)', 'Mr. Mohoshin', '1730464394', NULL, 'Mohakhali Railgate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(429, 1, 6, 1, 13, 25, 102051682, 'Bengal Canary (Gulshan-01)', 'Mr. Arif', '1622666671', NULL, 'Beside A & W Office Mohakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(430, 1, 6, 1, 13, 25, 102051683, 'Chicken Bazer', NULL, '1915718119', NULL, 'Norshigndi', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(431, 1, 6, 1, 13, 25, 102051684, 'Fast Way (Police Plaza)', NULL, NULL, NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(432, 1, 6, 1, 13, 25, 102051687, 'Oyester (Baily Road)', NULL, NULL, NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(433, 1, 6, 1, 13, 25, 102051688, 'Cafe Mango (Dhanmondi)', 'Mr. Zumma', '1706499769', NULL, 'House-58 Road-15/A Beside Drik Galary Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(434, 1, 6, 1, 13, 25, 102051689, 'Food Express (Police Plaza)', NULL, NULL, NULL, 'Police Plaza Concord', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(435, 1, 6, 1, 13, 25, 102051690, 'Bookle (Karwan)', 'Mr  Bookle', NULL, NULL, 'Karwan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(436, 1, 6, 1, 13, 25, 102051695, 'J B Traders', NULL, '1715561290', NULL, 'DCC Market', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(437, 1, 6, 1, 13, 25, 102051696, 'Dilli Ka Dhaba(Police Plaza)', NULL, NULL, NULL, 'Police Plaza Concord', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(438, 1, 6, 1, 13, 25, 102051697, 'Mr.Jabed(Taltola)', 'Mr. Jabed', '1859673755', NULL, 'Khilgoan  Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(439, 1, 6, 1, 13, 25, 102051698, 'Igloo Foods', NULL, '1618003719', NULL, 'Karwan Bazar Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(440, 1, 6, 1, 13, 25, 102051700, 'Juice Fectory (Cantonment)', 'Maruf', '1611652162', NULL, 'CSD Gaison  Dhaka Cantonment', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(441, 1, 6, 1, 13, 25, 102051647, 'Ideal World(Aftab)', NULL, '01736-611431', NULL, 'Aftab Nagar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(442, 1, 6, 1, 13, 25, 102051654, 'Sub Zone (300 Feet)', NULL, NULL, NULL, '300 feet  Bashindhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(443, 1, 6, 1, 13, 25, 102051692, 'Fasturant (D.U)', 'Mr. Lincon', '1884000777', NULL, 'Dhaka University', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(444, 1, 6, 1, 13, 25, 102051694, 'Basmoti Restaurant', NULL, NULL, NULL, 'Razuk Trade Center(1st floor)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(445, 1, 6, 1, 13, 25, 102051702, 'Showrma Club (Rifle Square)', NULL, NULL, NULL, 'Rifle Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(446, 1, 6, 1, 13, 25, 102051703, 'Golden Tulip (Banani)', NULL, '1777734795', NULL, 'House # 84  Road # 07  Block # H Banani Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(447, 1, 6, 1, 13, 25, 102051705, 'Red Food(Uttara)', NULL, NULL, NULL, 'Flot-32 Road-2/B Sec-15/C  Diabari Bottola Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(448, 1, 6, 1, 13, 25, 102051707, 'Black Pepper(1st floor)', NULL, '1956777444', NULL, 'House-23 Road-09  Shekher tek', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(449, 1, 6, 1, 13, 25, 102051708, 'Baba Raffi', 'Mr  Egag', '1927499238', NULL, 'Bashundhara Group Headquarter-02 Bashundhara', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(450, 1, 6, 1, 13, 25, 102051709, 'Eat & Drink(Link Road)', NULL, NULL, NULL, 'Link Road Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(451, 1, 6, 1, 13, 25, 102051711, 'Cosmo Center(Ramna)', NULL, NULL, NULL, 'Beside of Showrma House(Ram)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(452, 1, 6, 1, 13, 25, 102051712, 'Pizza Bar(banani)', NULL, NULL, NULL, 'House-107 Road-04  Block-B Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(453, 1, 6, 1, 13, 25, 102051713, 'Bogura Fast Food', NULL, '1751623891', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(454, 1, 6, 1, 13, 25, 102051714, 'Road House Cafe', NULL, '1625606757', NULL, 'Bashundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(455, 1, 6, 1, 13, 25, 102051715, 'Bhai Bhai Store(Banani)', NULL, NULL, NULL, 'Shop No-91  Banani Kacha Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(456, 1, 6, 1, 13, 25, 102051716, 'Mr.Burger (Taltola)', NULL, '1874660055', NULL, 'Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(457, 1, 6, 1, 13, 25, 102051718, 'Rojak Cafe(Banani)', NULL, NULL, NULL, 'Villa azur Building 2nd Floor  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(458, 1, 6, 1, 13, 25, 102051719, 'Mr Kawsar(Eden College)', NULL, NULL, NULL, 'Eden College', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(459, 1, 6, 1, 13, 25, 102051721, 'Fried King (Green Road)', NULL, NULL, NULL, 'Green Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(460, 1, 6, 1, 13, 25, 102051723, 'Omega 03 Sea Food (Dhanmondi)', NULL, NULL, NULL, 'Rangs Nasim Square  12th Floor  House 275/D  Road 27  Dhanmondi Dhaka-1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(461, 1, 6, 1, 13, 25, 102051724, 'Doner & Gyrox(Banani)', NULL, NULL, NULL, '6 Kamal Ataturk Avenue', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(462, 1, 6, 1, 13, 25, 102051726, 'Sarinda Group (Mymenshing)', 'Mr. Abir', '1712904156', NULL, 'House-11  C.K Ghosh Road  Mymenshing Sadar', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(463, 1, 6, 1, 13, 25, 102051727, 'Lucious Pizza (Bcity)', NULL, NULL, NULL, 'Bashundhara City', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(464, 1, 6, 1, 13, 25, 102051728, 'Hot Cafe (Police Plaza)', NULL, NULL, NULL, 'Police Plaza Concord', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(465, 1, 6, 1, 13, 25, 102051733, 'Royal(Aftab Nagar)', NULL, NULL, NULL, 'Aftab Nagar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(466, 1, 6, 1, 13, 25, 102051738, 'Tuhin Traders(DCC)', NULL, '1842960952', NULL, 'DCC Market(Gulshan-01)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(467, 1, 6, 1, 13, 25, 102051729, 'Gurmat Burger(Mogbazar)', NULL, NULL, NULL, 'Mog Bazar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(468, 1, 6, 1, 13, 25, 102051734, 'Diya\'s Kitchen(Banani)', 'Mr  Arif', '1676213182', NULL, 'House-02 Road-08  Block-D Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(469, 1, 6, 1, 13, 25, 102051739, 'Yster(B.City)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(470, 1, 6, 1, 13, 25, 102051741, 'Society Traders (Mohammadur)', NULL, '1775573377', NULL, 'House-57 Road-06  Mohammadur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(471, 1, 6, 1, 13, 25, 102051743, 'Sawasdee(Baily Road)', NULL, NULL, NULL, 'Baily Road ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(472, 1, 6, 1, 13, 25, 102051744, 'Cafe Marinade(Basabo)', NULL, '1711993735', NULL, '67/4 North Basabo Bow Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(473, 1, 6, 1, 13, 25, 102051747, 'City Fruit Juice', NULL, '1689223375', NULL, 'Narinda  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(474, 1, 6, 1, 13, 25, 102051749, 'Pizzaria (Md.Mamon)', NULL, NULL, NULL, '300 Feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(475, 1, 6, 1, 13, 25, 102051752, 'Dawat Resturant(Lalbag)', NULL, NULL, NULL, 'Lalbag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(476, 1, 6, 1, 13, 25, 102051753, 'C.F.C (Mirpur-1)', NULL, '1716381990', NULL, 'Mirpur-1 Bus stand  Ansar Camp Gate Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(477, 1, 6, 1, 13, 25, 102051754, 'Sugar & Spice (Dhanmondi)', NULL, '1798101010', NULL, 'Near Herfy', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(478, 1, 6, 1, 13, 25, 102051755, 'Dalas(Baridhara)', NULL, NULL, NULL, 'Annaya Shopping Complex Road-13 Baridhara DOHS', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(479, 1, 6, 1, 13, 25, 102051756, 'Hang Out (Baridhara)', NULL, '1726176226', NULL, 'Ananna Shopping Complex  Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(480, 1, 6, 1, 13, 25, 102051757, 'Tortillas(Bashundhara)', NULL, NULL, NULL, 'House-80 Road-03 Block-C Bashundhara R/A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(481, 1, 6, 1, 13, 25, 102051758, 'Panthashala Restaurant (Panthopath)', NULL, '01747-447700', NULL, '57/8 Tejturi Bazar Chawk lane  East Raza Bazar (Panthopath Signal)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(482, 1, 6, 1, 13, 25, 102051759, 'Dilli Darbar(Mirpur-02)', NULL, NULL, NULL, 'Mirpur-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(483, 1, 6, 1, 13, 25, 102051760, 'Bismllah Fast Food(Utt)', NULL, NULL, NULL, 'North Tower  House Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(484, 1, 6, 1, 13, 25, 102051761, 'Onisha Enterprize', NULL, NULL, NULL, 'Karwan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(485, 1, 6, 1, 13, 25, 102051762, 'Bunkers(Taltola)', 'Mr. Sahanewaz', '1704961300', NULL, '377/B (2nd floor) Khilgoan Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(486, 1, 6, 1, 13, 25, 102051767, 'New Chadpur Traders(Dhan)', NULL, '01670699901  01911286062', NULL, 'Rifle Square Zigatola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(487, 1, 6, 1, 13, 25, 102051769, 'Prime Bread & Chicken (Donia)', NULL, '1609898047', NULL, '459 Donia Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(488, 1, 6, 1, 13, 25, 102051770, 'One Bite Pizza (Mirpur-13)', NULL, '1764858585', NULL, '1103. Rupayon Nowfa Plaza (1st Floor)  Ibrahimpur  Dhaka-1206', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(489, 1, 6, 1, 13, 25, 102051771, 'Food House (Aftab Nagar)', NULL, NULL, NULL, 'Aftab Nagar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(490, 1, 6, 1, 13, 25, 102051772, 'Dhaka Fried(Kakrail)', NULL, NULL, NULL, 'Kakral  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(491, 1, 6, 1, 13, 25, 102051773, 'The Kitchen', NULL, NULL, NULL, 'Bangla Motor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(492, 1, 6, 1, 13, 25, 102051775, 'New Asian Fast Food', NULL, '185101365', NULL, 'Bastola Noorerchala', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(493, 1, 6, 1, 13, 25, 102051779, 'Faruk Chinese Corner (Mirpur-11)', 'Mr. Mamun', '1759908742', NULL, 'Kacha Bazar Mirpur-11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(494, 1, 6, 1, 13, 25, 102051783, 'The Rain Tree(Banani)', NULL, '1951177507', NULL, 'House-49 Road-27 Block-K  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(495, 1, 6, 1, 13, 25, 102051786, 'Twisted Recipe(Nikunja)', NULL, '1711081672', NULL, 'Plot-2/C Road-18 Nikunja', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(496, 1, 6, 1, 13, 25, 102051730, 'Al Amar (Dhanmondii)', NULL, NULL, NULL, '275/D  Rangs Nasim Square  4th Floor  27 Dhanmondi  Road No.16 Dhaka-1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(497, 1, 6, 1, 13, 25, 102051750, 'Redious', NULL, NULL, NULL, 'Gulshan-01 Bank Asia Building  4th Flour', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(498, 1, 6, 1, 13, 25, 102051774, 'Fantasium (Pink City)', NULL, '1730020200', NULL, 'Pink City Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(499, 1, 6, 1, 13, 25, 102051781, 'Red Window (Dhanmondi)', NULL, '1684300939', NULL, 'House-19/A Road-16(Old-27)  Dhanmondi R/A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(500, 1, 6, 1, 13, 25, 102051784, 'Welcome Fast Food', NULL, NULL, NULL, 'I.C.D.B - Mohakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(501, 1, 6, 1, 13, 25, 102051787, 'Green Point(Uttara)', 'Mr. Khalil', '1787872204', NULL, 'House-3 Road-13 Sector-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(502, 1, 6, 1, 13, 25, 102051788, 'Chile Kota 2nd floor(Banani)', NULL, NULL, NULL, 'House-66 Road-10 Block-D  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(503, 1, 6, 1, 13, 25, 102051789, 'Shawarma House(Dholaipar)', 'Jishan', '01929374427/01715108299', NULL, 'Dholaipar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(504, 1, 6, 1, 13, 25, 102051790, 'Billal Enterprise(K.B))', NULL, '1799781561', NULL, 'Karwan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(505, 1, 6, 1, 13, 25, 102051792, 'Cafe Wake Up(Mirpur DOHS)', NULL, '1994999678', NULL, '279/9 Manikdi  DOHS Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(506, 1, 6, 1, 13, 25, 102051793, 'Nasim Chainess(Mirpur-1)', NULL, '1718330134', NULL, 'Mirpur-01  beside of suprim Dinner', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(507, 1, 6, 1, 13, 25, 102051794, 'Ozz Cafe (Dhanmond)', NULL, NULL, NULL, 'House-133 Road-9/A Shankar Bus Stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(508, 1, 6, 1, 13, 25, 102051795, 'Mr. Manik Foods(Uttara)', 'Mr. Manik', '1980535362', NULL, 'House-04 Road-Rabindra Sharani  Sec-07 Uttara ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(509, 1, 6, 1, 13, 25, 102051796, 'Coffee Bean & Tea Leaf(Gulshan)', 'Mr. Kawsar', '1682883090', NULL, 'Gulshan-02  Opposit of Agora', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(510, 1, 6, 1, 13, 25, 102051797, 'Razpoot(Police Plaza)', NULL, NULL, NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(511, 1, 6, 1, 13, 25, 102051798, 'Al Baik(Dhanmondi)', NULL, NULL, NULL, 'House-81 Road-8/A  Satmasjid Road Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(512, 1, 6, 1, 13, 25, 102051799, 'Bhooter Bari(Golapbag)', 'Mr Swapan', NULL, NULL, 'Golapbag Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(513, 1, 6, 1, 13, 25, 102051803, 'Jalapeno(Taltola)', NULL, '1676048276', NULL, '373/B Shotodol Rose Height Taltola ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(514, 1, 6, 1, 13, 25, 102051805, 'Hotel Progoti In Ltd', NULL, '1708555694', NULL, 'Ka-74/B Progoti Sarani Kuril', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(515, 1, 6, 1, 13, 25, 102051812, 'Dhaka Departmental Store (Newmarket)', NULL, '1711587384', NULL, 'New Market Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(516, 1, 6, 1, 13, 25, 102051813, 'Yo Momo(Zigatola)', 'Mr. Parvez', NULL, NULL, 'Zigatola Busstand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(517, 1, 6, 1, 13, 25, 102051815, 'Halum(Lalbag)', NULL, '1929294030', NULL, 'Lalbag Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(518, 1, 6, 1, 13, 25, 102051819, 'Pizza House(Hatirpul)', NULL, NULL, NULL, 'Hatirpul Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(519, 1, 6, 1, 13, 25, 102051745, 'Meat Food Cafe (Mirpur-60 Feet)', NULL, '1647377362', NULL, 'Sheal bari beside of Monipur School', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(520, 1, 6, 1, 13, 25, 102051751, 'SP Masala (Dhanmondi)', NULL, '01610-405500', NULL, '13/A meher palaza road-5 Mirpur road  Dhanmondi-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(521, 1, 6, 1, 13, 25, 102051764, 'Chadpur Trading(K.B))', 'Mr. Hasan', '1620602635', NULL, 'Karwan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(522, 1, 6, 1, 13, 25, 102051765, 'Sub Lovers(Wari)', NULL, NULL, NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(523, 1, 6, 1, 13, 25, 102051808, 'Juicy & Juicy(Uttara)', NULL, NULL, NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(524, 1, 6, 1, 13, 25, 102051814, 'Get & Eat(Uttara)', NULL, NULL, NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(525, 1, 6, 1, 13, 25, 102051816, 'Little Italia(Asulia)', NULL, '1711627712', NULL, 'Asulia', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(526, 1, 6, 1, 13, 25, 102051817, 'Deck-13 (Dhanmondi)', 'Shipon Chef', '1983383007', NULL, '67 Navana GH Heights  Satmosjd Road ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(527, 1, 6, 1, 13, 25, 102051821, 'Mozabite(Wari)', NULL, '1791620205', NULL, 'Mr.Dipu Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(528, 1, 6, 1, 13, 25, 102051825, 'Al Fresco (Banani)', NULL, NULL, NULL, 'House-17 Road-11 Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(529, 1, 6, 1, 13, 25, 102051827, 'Dark House(Lalbag)', NULL, '1855655536', NULL, 'Lalbagh  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(530, 1, 6, 1, 13, 25, 102051828, 'Bismillah fast (Tongi)', NULL, '1733661850', NULL, 'Tongi   Collage Gate  Gazipur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(531, 1, 6, 1, 13, 25, 102051829, 'Shawarma House(Sylhet)', NULL, '1775616761', NULL, 'Holding No 803/805  Near Jama Masjid  Sylhet Sadar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(532, 1, 6, 1, 13, 25, 102051830, 'BDFC (Khilkhet)', NULL, NULL, NULL, 'Khilkhat Railgate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(533, 1, 6, 1, 13, 25, 102051832, 'Candy Crush(Wari)', NULL, NULL, NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(534, 1, 6, 1, 13, 25, 102051833, 'The Hunger(Uttara)', NULL, '1729979443', NULL, 'Shop-815 Grand Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(535, 1, 6, 1, 13, 25, 102051836, 'Vojon Roshik(Uttara)', NULL, '1640607381', NULL, 'Plot# 16  Road#2/A  Shop#01  Block#C/1  Uttara  Dia Bari ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(536, 1, 6, 1, 13, 25, 102051837, 'Khanas', 'Mr. Dipu', '1765421245', NULL, 'Behind of Appolo Hospital  Baridhara', 400000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(537, 1, 6, 1, 13, 25, 102051838, 'C Minor', NULL, '01760-445559', NULL, '55  Satmosjid road  Zigatola Bus stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(538, 1, 6, 1, 13, 25, 102051840, 'Food Home(Uttara)', NULL, '1798034824', NULL, 'Zam Zam Tower Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(539, 1, 6, 1, 13, 25, 102051841, 'Cafe Cherry Drops (Taltola)', 'Mr. Milon', '1932928773', NULL, '572/A  Block-C  Khilgaon  Opposite Of Projapoti', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(540, 1, 6, 1, 13, 25, 102051843, 'Floor-6 Re Lodad(banani)', NULL, '1947454719', NULL, 'House-54 Road-11 Block-C  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(541, 1, 6, 1, 13, 25, 102051845, 'Pizza Guy(Banani)', NULL, ':01682033206', NULL, 'Kamal Attaturk Avenue Lavel-09', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(542, 1, 6, 1, 13, 25, 102051848, 'Hello Restaurant(B.Baria)', NULL, '1813653398', NULL, 'Halder Para B.Baria  01703324922 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(543, 1, 6, 1, 13, 25, 102051850, 'Harly Parly(Uttara)', NULL, NULL, NULL, 'Sector-03  Shopno Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(544, 1, 6, 1, 13, 25, 102051851, 'Tex Mex (Uttara)', 'Mr. Sohel', '1711236974', NULL, 'Sector-12 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(545, 1, 6, 1, 13, 25, 102051844, 'Fast Way(basabo)', NULL, '1927126799', NULL, 'Basabo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(546, 1, 6, 1, 13, 25, 102051847, 'Angry Burger(Kamranggirchar)', NULL, NULL, NULL, 'Kamranggrchar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(547, 1, 6, 1, 13, 25, 102051849, 'Khati Bazar (Dhanmondi)', NULL, '01970-713744', NULL, 'House-133  Road-9/A  Shankar  Dhanmondi  Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(548, 1, 6, 1, 13, 25, 102051852, 'Sector 7 Restaurant(Uttara)', NULL, '1739810448', NULL, 'Azampur Petrol Pump', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(549, 1, 6, 1, 13, 25, 102051854, 'Cafe Tidbit(Uttara)', NULL, NULL, NULL, 'Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(550, 1, 6, 1, 13, 25, 102051855, 'Food Hill (Nekaton)', NULL, NULL, NULL, 'Tejgoan Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(551, 1, 6, 1, 13, 25, 102051856, 'Doi Poska (Mirpur-2)', NULL, '1830016647', NULL, 'Mirpur-02 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(552, 1, 6, 1, 13, 25, 102051857, 'Shawarma House (Banani)', NULL, '1925940017', NULL, 'Road-11 Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(553, 1, 6, 1, 13, 25, 102051859, 'Shawarma House(Dhanmondi)', NULL, '1731840140', NULL, 'Dhanmondi Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(554, 1, 6, 1, 13, 25, 102051860, 'Momo Express (Nikunjo)', 'Riaz', '1611139135', NULL, 'Road-16  Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(555, 1, 6, 1, 13, 25, 102051861, 'Frankis(Rifel Square)', NULL, NULL, NULL, 'Rifel Square  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(556, 1, 6, 1, 13, 25, 102051864, 'Kamola Trading (K.B)', NULL, '1726941370', NULL, 'Karwan Bazar  kithen market', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(557, 1, 6, 1, 13, 25, 102051865, 'Coffeelious Coffee(Baily Road)', NULL, '1615998996', NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(558, 1, 6, 1, 13, 25, 102051866, 'Savore Chicken (Wari)', NULL, '1768922222', NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(559, 1, 6, 1, 13, 25, 102051868, 'Food Bowl Cafe(Moghbazar)', NULL, '1819230317', NULL, 'Hoque Tower 253 Mogbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(560, 1, 6, 1, 13, 25, 102051869, 'Uni Cafe (Wari)', 'Mr. Rakib', '1847052250', NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(561, 1, 6, 1, 13, 25, 102051870, 'Legend Cafe(Uttara)', NULL, '1630688204', NULL, 'House-49 Road-02 Sector-05', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(562, 1, 6, 1, 13, 25, 102051873, 'Cafe Hang Over(Tongi)', NULL, '1318483236', NULL, 'Rabndra Plaza Tongi College Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(563, 1, 6, 1, 13, 25, 102051874, 'Princh Food (Rifle Square)', NULL, '1715561266', NULL, 'Rifle Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(564, 1, 6, 1, 13, 25, 102051875, 'Bazzarmama.Com', NULL, '1618206600', NULL, '161/7 Manikdi Canttonment', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(565, 1, 6, 1, 13, 25, 102051876, 'Frozen Scoop(Faridpur)', 'Mr.Zakir', '1711240092', NULL, 'Faridpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(566, 1, 6, 1, 13, 25, 102051877, 'Kabab Express(Rifle Square)', NULL, NULL, NULL, 'Rifle Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(567, 1, 6, 1, 13, 25, 102051878, 'Grand Hall (N.Ganj)', NULL, '1829204374', NULL, 'Popular Hospital Chashara    N.Gonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(568, 1, 6, 1, 13, 25, 102051880, 'Cafe Orchid(Mugdapara)', NULL, '1776484047', NULL, '1/30 GA Wasa Road  Mugdarapara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(569, 1, 6, 1, 13, 25, 102051881, 'Pizza Zone(Uttara)', NULL, '1729244267', NULL, 'Road-123 Sector-10 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(570, 1, 6, 1, 13, 25, 102051883, 'Cafe Cookers(K.B)', NULL, NULL, NULL, 'Karwan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(571, 1, 6, 1, 13, 25, 102051884, 'Grilled (Dhanmondi)', NULL, '01928391304 /01931995730', NULL, 'House-21/A Road-16 Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(572, 1, 6, 1, 13, 25, 102051886, 'Lota Store(Gulshan)', NULL, '1911691936', NULL, 'DCC Market Gulshan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(573, 1, 6, 1, 13, 25, 102051889, 'Bar Code(Uttara)', 'Mr. Mikel', '1626813424', NULL, 'House-26 Sector-07  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(574, 1, 6, 1, 13, 25, 102051890, 'Mr Bappy(Cocacola)', NULL, NULL, NULL, 'Gulshan-01 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(575, 1, 6, 1, 13, 25, 102051882, 'Re Eat (Malibag)', NULL, NULL, NULL, 'Malibag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(576, 1, 6, 1, 13, 25, 102051885, 'Fresh Fish & Grill (300 Feet)', NULL, '1817099425', NULL, 'Kuril  300Fit', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(577, 1, 6, 1, 13, 25, 102051887, 'TBC (Dhanmondi)', NULL, '1920820939', NULL, 'Dhanmondi Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(578, 1, 6, 1, 13, 25, 102051888, 'Mad Chef (Mirpur-10)', 'Mr. Ripon', '1787754390', NULL, 'Lebel-3 Flot-13 Sanpara Parbata  Sector-10 Mirpur', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(579, 1, 6, 1, 13, 25, 102051892, 'Le-Kabab(Jamuna)', 'Mr. Kabir', '1716309817', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(580, 1, 6, 1, 13, 25, 102051893, 'Poopise(Md.Pur)', NULL, '1715985365', NULL, 'Iqbal Road Post Office Golli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(581, 1, 6, 1, 13, 25, 102051895, 'Krazy Wings(Uttara)', NULL, NULL, NULL, 'Shop No-805  Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(582, 1, 6, 1, 13, 25, 102051896, 'Servilence(Taltola)', 'Mr. Milon', '1932928773', NULL, '572/A  Block-C Khilgoan', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(583, 1, 6, 1, 13, 25, 102051897, 'Pine Wood Cafe (Dhanmondi)', 'Sayedur Rahman Masud', '1914426939', NULL, 'House-19  Road-12  Mirpur road  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(584, 1, 6, 1, 13, 25, 102051898, 'Cold Stone (Dhanmondi)', NULL, NULL, NULL, 'Dhanmond 27  Dhanmond', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(585, 1, 6, 1, 13, 25, 102051899, 'Food Place(Uttara)', NULL, '1741952780', NULL, 'House-55(3rd floor)  Shonim Tower Sec-12 Shah mokhdum Avenue', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(586, 1, 6, 1, 13, 25, 102051900, 'Mela Foods(N.Gonj)', NULL, '1612813305', NULL, 'Chashara  Narayangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(587, 1, 6, 1, 13, 25, 102051901, 'L.P Traders(Link Road)', NULL, '1682921514', NULL, 'Link Road  Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(588, 1, 6, 1, 13, 25, 102051902, 'Mayer Doa(Uttar Badda)', NULL, '1953510183', NULL, 'Hossain Market  Uttar Badda', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(589, 1, 6, 1, 13, 25, 102051903, 'Sub Station(Azimpur)', NULL, NULL, NULL, 'Eden College  Azimpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(590, 1, 6, 1, 13, 25, 102051904, 'Coffee Booth (Narinda)', NULL, NULL, NULL, 'Narinda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(591, 1, 6, 1, 13, 25, 102051909, 'Wake Up Cafe', NULL, '1913369299', NULL, 'House-32 Road-20 Sector-03 Uttara ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(592, 1, 6, 1, 13, 25, 102051910, 'Mid night sun ( Bcity)', NULL, NULL, NULL, 'Basundhara city  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(593, 1, 6, 1, 13, 25, 102051911, 'Sanays Kitchen', NULL, '1612068624', NULL, 'Sima Blossom (7th floor)  H-3  R-27  Dhanmondi  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(594, 1, 6, 1, 13, 25, 102051912, 'Chicken Valley(Mirpur)', NULL, '1716865577', NULL, 'Mirpur-02  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(595, 1, 6, 1, 13, 25, 102051913, 'Food Point((Uttara)', NULL, '1633095044', NULL, 'House-69  Sector-12 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(596, 1, 6, 1, 13, 25, 102051916, 'Afgan Grill (Wari)', NULL, '1708528888', NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(597, 1, 6, 1, 13, 25, 102051918, 'Cafe Emoji(Md.Pur)', NULL, '1973336654', NULL, 'Tajmohol Road Opposit Residentiial School ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(598, 1, 6, 1, 13, 25, 102051920, 'Pizza Italiana(Gulshan)', NULL, '1857111061', NULL, 'MCC Building(2nd Floor)  House-76 Road-127', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(599, 1, 6, 1, 13, 25, 102051921, 'Spice9 (Wari)', NULL, NULL, NULL, 'Wari  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(600, 1, 6, 1, 13, 25, 102051922, 'Cafe GQ Premium(Dhan)', NULL, NULL, NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(601, 1, 6, 1, 13, 25, 102051923, 'Gambler', NULL, '1715424288', NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(602, 1, 6, 1, 13, 25, 102051925, 'Roaster Cafe(Baily Road)', NULL, '1825218365', NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(603, 1, 6, 1, 13, 25, 102051927, 'Apon Coffee House(Taltola)', NULL, '1717611339', NULL, 'Khilgoan  Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(604, 1, 6, 1, 13, 25, 102051928, 'Food Fantasy(Uttara)', NULL, '1685183276', NULL, 'Shop-803  Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(605, 1, 6, 1, 13, 25, 102051914, 'Cheese Gallery (Dhanmondi)', 'Mr  Zakir', '1768234111', NULL, 'Dhanmondi', 600000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(606, 1, 6, 1, 13, 25, 102051924, 'Eat & Fresh', NULL, NULL, NULL, 'Brac University   Mohakhali   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(607, 1, 6, 1, 13, 25, 102051926, 'Hot Pizza (Gazipura)', NULL, '1688385101', NULL, '109 Vashan Road Gazipura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(608, 1, 6, 1, 13, 25, 102051930, 'Saan Cafe(Elephant Road)', 'Mr. Jakir', '1674628553', NULL, '347 Elephant Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(609, 1, 6, 1, 13, 25, 102051931, 'Sweetin Coffee (Dhanmondi)', NULL, '01886-871888', NULL, 'Level-08  67 Satmosjid Road  Navana GH Heights', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(610, 1, 6, 1, 13, 25, 102051932, 'Chillox(Mohakhali)', 'Mr. Pranta', '1638036014', NULL, 'Beside of BRAC University', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(611, 1, 6, 1, 13, 25, 102051935, 'Real Pizza(Dhanmondi)', NULL, NULL, NULL, 'Dhanmondi Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(612, 1, 6, 1, 13, 25, 102051936, 'Madina Store(Jail Gate)', NULL, '01889988718 /01551813548', NULL, 'Jail Gate Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(613, 1, 6, 1, 13, 25, 102051937, 'Coriander (Baily Road)', 'Mr. Sumon', '1633002222', NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(614, 1, 6, 1, 13, 25, 102051938, 'Food Lovers Cafe(Gulshan)', 'Mr. Suvro', '1730305798', NULL, 'Opposite of Agora', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(615, 1, 6, 1, 13, 25, 102051939, 'Pizza Hot(Norshingdi)', 'Mr. Kazol', '1713519786', NULL, 'Norshingdi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(616, 1, 6, 1, 13, 25, 102051940, 'The Fumez(Gulshan)', NULL, '1950715051', NULL, 'Agora (Lifter-03) Gulshan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(617, 1, 6, 1, 13, 25, 102051941, 'Chillox( Dhanmondi)', 'Mr. Prashanta', '1973109911', NULL, 'Level - 3  AMM Center  56/A Rd 3A  Dhaka 1209', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(618, 1, 6, 1, 13, 25, 102051942, 'Lets Grill (Dhanmondi)', NULL, NULL, NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(619, 1, 6, 1, 13, 25, 102051943, 'Mim General Store (Mohammadpur)', NULL, '1911391470', NULL, 'Town Hall Market  Md.Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(620, 1, 6, 1, 13, 25, 102051944, 'Sakib-75 Restaurant', NULL, '1715076761', NULL, 'Rabiul Plaza  Mazar Road  Mirpur-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(621, 1, 6, 1, 13, 25, 102051946, 'HN Enterprise', 'Mr. Nazmul', '1932913038', NULL, 'Amtoli  (Kacha Bazar)  Mahakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(622, 1, 6, 1, 13, 25, 102051947, 'Dhaka Marketing (Newmarket)', 'Mr. Jamal', '1711587384', NULL, 'New Market   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(623, 1, 6, 1, 13, 25, 102051948, 'A One Food & Pastry (Azimpur)', NULL, '1812168000', NULL, '104 Azimpur   Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(624, 1, 6, 1, 13, 25, 102051949, 'Comic Cafe(wari)', 'Mr. Alauddin', '1924800881', NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(625, 1, 6, 1, 13, 25, 102051950, 'Foodies Haat(Dhanmondi)', NULL, '1686663568', NULL, 'House No: 46  Road No: 6  Dhanmondi  Dhaka 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(626, 1, 6, 1, 13, 25, 102051952, 'Basilico (Taltola)', 'Mr. Yousuf', '1677078855', NULL, '399/B Shahid Baki Road  Malibag.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(627, 1, 6, 1, 13, 25, 102051953, 'Showrma Hut(Banani)', NULL, '1611888288', NULL, 'Banani Kamal Attaturk Avenue', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(628, 1, 6, 1, 13, 25, 102051954, 'Forked Restaurant(Khilgoan)', NULL, '1718739333', NULL, 'Khidmah Hospiital', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(629, 1, 6, 1, 13, 25, 102051955, 'GREENLAND SERVICES LTD (Gulshan)', 'Mr. Sabuj', '1709991007', NULL, 'Plot-SW(H)8 A (Old)1(A) New Biruttam Mirshowkat SarakGulshan-1; Gulshan PS; Dhaka-1212', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(630, 1, 6, 1, 13, 25, 102051956, 'Doi Poska(Mirpur-11.5)', NULL, '1672449811', NULL, 'Mirpur-11.5', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(631, 1, 6, 1, 13, 25, 102051957, 'Jalpie Restaurant(Mogbazar)', NULL, NULL, NULL, 'Mog Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(632, 1, 6, 1, 13, 25, 102051959, 'Sub Lovers(Uttara)', NULL, NULL, NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(633, 1, 6, 1, 13, 25, 102051963, 'Adonize Foods (Lalbag)', 'Mr. Dipu', '1707001475', NULL, 'Lalbag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(634, 1, 6, 1, 13, 25, 102051964, 'Tong Restaurant(Baridhara)', 'Mr. Shohag', '1918401405', NULL, 'Bashundhara  Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(635, 1, 6, 1, 13, 25, 102051966, 'Strom In a Cup(Dhanmondi)', 'Mr. Mahabub', '1842253893', NULL, 'House No: 1  5th Floor  Aarong Top Floor  Road No: 2  Dhanmondi ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(636, 1, 6, 1, 13, 25, 102051917, 'Tejpata Restaurant(Bangla Motor)', 'Mr. Mohoshin', '1712675557', NULL, 'Bangla Motor  The Kitchen Building  Banglamotor  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(637, 1, 6, 1, 13, 25, 102051933, 'Cafe GQ Premium (Md.Pur)', NULL, NULL, NULL, 'U/64  Nurjahan Road  Mohammadpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(638, 1, 6, 1, 13, 25, 102051951, 'Panas pani(Rifle Square)', NULL, NULL, NULL, 'Rifle Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(639, 1, 6, 1, 13, 25, 102051958, 'Mr Kaium(Rifle Square)', NULL, NULL, NULL, 'Rifle Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(640, 1, 6, 1, 13, 25, 102051967, 'Master Bite (Dhanmondi)', NULL, '01709-095115', NULL, 'Dhanmondi  Chillox Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(641, 1, 6, 1, 13, 25, 102051968, 'Helall Baniti (Newmarket)', NULL, NULL, NULL, 'New Market  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(642, 1, 6, 1, 13, 25, 102051969, 'The Miror(Dhan)', NULL, '7177056713', NULL, 'House-12 Road-08 Shekjamal Club', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(643, 1, 6, 1, 13, 25, 102051971, 'Sung Garden (Eskaton)', 'Mr. Aminul', '1708515071', NULL, '6/A Eskaton Garden', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(644, 1, 6, 1, 13, 25, 102051975, 'Shadat Store (Mohammadpur)', NULL, '1689056541', NULL, 'Town Hall Bazar  MD.Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(645, 1, 6, 1, 13, 25, 102051976, 'Taxi Burger(Zam Zam Tower)', NULL, NULL, NULL, 'Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(646, 1, 6, 1, 13, 25, 102051977, 'Pavilion Cafe(Uttara)', NULL, NULL, NULL, 'Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(647, 1, 6, 1, 13, 25, 102051978, 'Chader Pahar(N.Ganj)', NULL, NULL, NULL, 'Chashara  Narayangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(648, 1, 6, 1, 13, 25, 102051979, 'Burger Khor(Mirpur-1)', NULL, '1756633242', NULL, 'House-20  Section-01  Block-F Road-06', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(649, 1, 6, 1, 13, 25, 102051980, 'Food buzz(Banasree)', NULL, '1955323406', NULL, '63 South Banasree Main Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(650, 1, 6, 1, 13, 25, 102051981, 'Subway Zone(uttara)', NULL, NULL, NULL, 'Shopno Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(651, 1, 6, 1, 13, 25, 102051982, 'Fire Stone(Lalbag)', 'Mr. Mehedi', '1925008992', NULL, 'Lalbag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(652, 1, 6, 1, 13, 25, 102051985, 'Shikha Horlics', NULL, NULL, NULL, 'BGB Squer  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(653, 1, 6, 1, 13, 25, 102051986, 'The Roof Restaurant(Uttara)', NULL, '1612068624', NULL, 'H-20 Sec-11 Sonargoan Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(654, 1, 6, 1, 13, 25, 102051988, 'Devil\'s Factory (Dhanmondi)', NULL, '01736-172034', NULL, 'Rangs KB Square  Satmasjid Road  Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(655, 1, 6, 1, 13, 25, 102051989, 'Rice N Noodles(Uttara)', 'Mr. Salauddin', '1748186810', NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(656, 1, 6, 1, 13, 25, 102051993, 'Mumin Foods(Uttara)', 'Mr. Jibon', '161992730', NULL, 'H-08 R-1/B Sector-09', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(657, 1, 6, 1, 13, 25, 102051994, 'Army Golf Cafe (Baridhara)', NULL, '1922893936', NULL, 'Zohar Shara  Baridhara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(658, 1, 6, 1, 13, 25, 102051995, 'Eat N Enjoy(Taltola)', NULL, NULL, NULL, 'Taltola Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(659, 1, 6, 1, 13, 25, 102051996, 'Relax Coffee (Mohammadpur)', NULL, NULL, NULL, 'Mohammadpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(660, 1, 6, 1, 13, 25, 102051997, 'Hasan Enterprise(Uttara)', NULL, '1883261282', NULL, '77 78 Kusol Center Rajlokhi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(661, 1, 6, 1, 13, 25, 102051999, 'Roaster Cafe (Panthopath)', NULL, '1817080711', NULL, 'Panthopath Near Square Hospital', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(662, 1, 6, 1, 13, 25, 102052001, 'ZFC (Nikunjo)', NULL, NULL, NULL, 'Road-05 Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(663, 1, 6, 1, 13, 25, 102052002, 'PavilionRestaurant & Cafe', NULL, '1795072030', NULL, 'House-17 Level-04 Sector-13', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(664, 1, 6, 1, 13, 25, 102052003, 'Comic Cafe(Dhan)', 'Mr. Alauddin', '01924800881/01704194667', NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(665, 1, 6, 1, 13, 25, 102051992, 'Mealson Vans (Rajshahi)', 'Mr. Raj', '17129670', NULL, 'Rajshahi Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(666, 1, 6, 1, 13, 25, 102052000, 'SABROSO (Dhanmondi)', 'Mr. Arif', '1776747288', NULL, 'House-67 Level-07 Navana GH Heights  Sankar Shatmosjid Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(667, 1, 6, 1, 13, 25, 102052004, 'Mr.Kabir', NULL, '1680496691', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(668, 1, 6, 1, 13, 25, 102052006, 'Mr.Mozzam', NULL, NULL, NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(669, 1, 6, 1, 13, 25, 102052008, 'Areana Cafe Lounge(Mdpur)', NULL, NULL, NULL, 'Green Tower  Gapan Garden  Shooping Mall(3rd Floor)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(670, 1, 6, 1, 13, 25, 102052009, 'Shika Horlics(Baily)', NULL, NULL, NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(671, 1, 6, 1, 13, 25, 102052010, 'Kabab Factory(Jamuna)', 'Mr. Parvez', '193397194', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(672, 1, 6, 1, 13, 25, 102052011, '2.0 Cafe (Dhan)', 'Mr. Yousuf', '1715928885', NULL, 'Road-02  Kazi Tower Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(673, 1, 6, 1, 13, 25, 102052014, 'Backbenchers (Md.Pur)', NULL, '1794093085', NULL, '27 Probal Housing Ring Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(674, 1, 6, 1, 13, 25, 102052016, 'Chef Cuisine (Dhanmondi)', NULL, '01618-278845', NULL, '9/A  KB Square  Dhanmondi  Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(675, 1, 6, 1, 13, 25, 102052019, 'Mr Saidul(Uttara)', NULL, '1707072552', NULL, 'Sector-14 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(676, 1, 6, 1, 13, 25, 102052021, 'Real Kazi(Palton)', NULL, '1712372833', NULL, '41/3-4 Purana Palton', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(677, 1, 6, 1, 13, 25, 102052023, 'Cave Way (N.Ganj)', NULL, '1627363713', NULL, 'Chashara  Narayan Gonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(678, 1, 6, 1, 13, 25, 102052025, 'Turkis Kebab Pizza (Uttara)', NULL, '1714826685', NULL, 'Jashim Uddin Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(679, 1, 6, 1, 13, 25, 102052026, 'Hard Core Chef(Uttara)', 'Mr. Mizan', '1689713654', NULL, 'Gausal Azam Avenue Sec-13', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(680, 1, 6, 1, 13, 25, 102052029, 'Cloud Flame(Taltola)', NULL, NULL, NULL, 'Khilgoan  Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(681, 1, 6, 1, 13, 25, 102052030, 'Appolo Adda(Baridhara)', 'Mr. Prodip', '1819095242', NULL, 'Dhali Bari  Bashundhara Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(682, 1, 6, 1, 13, 25, 102052031, 'Rock N Roll(Uttara)', NULL, '1971560196', NULL, 'House-16 Floor-B1  Road-09 Sec-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(683, 1, 6, 1, 13, 25, 102052032, 'Apon Coffee House (Dhanmondi)', NULL, '1789165972', NULL, 'Momotaz Plaza  Dhanmondi-4  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(684, 1, 6, 1, 13, 25, 102052033, 'Talash Kitchen(Mirpur)', NULL, '1911148277', NULL, 'Mirpur  DOHS', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(685, 1, 6, 1, 13, 25, 102052034, 'Food Fantasy Cafeteria(Uttara)', NULL, NULL, NULL, 'Rajuk Commercial Complex Level-05(Lift-04) Azimpur  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(686, 1, 6, 1, 13, 25, 102052035, 'Buddys Cafe(Mirpur)', NULL, '1676042115', NULL, 'House-52 Sec-06  Block-A  Avenue-05', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(687, 1, 6, 1, 13, 25, 102052036, 'Burger Station(Kalshi)', NULL, '1710974556', NULL, 'Kalshi  Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(688, 1, 6, 1, 13, 25, 102052037, 'Hazi Mizan (Kawran Bazar)', NULL, '1813061968', NULL, 'Karwan Bazra  Dhaka', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(689, 1, 6, 1, 13, 25, 102052039, 'Tex Mex (Mirpur)', 'Mr. Sohel', '1711236974', NULL, 'Kalshi Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(690, 1, 6, 1, 13, 25, 102052042, 'Popeyes(Jamuna)', NULL, '1634141671', NULL, 'Shop 65/66  Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(691, 1, 6, 1, 13, 25, 102052043, 'The Chille Park(Uttara)', NULL, '1686423720', NULL, 'Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(692, 1, 6, 1, 13, 25, 102052047, 'Take & Test(Uttara)', NULL, NULL, NULL, 'Zam Zam Tower  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(693, 1, 6, 1, 13, 25, 102052013, 'Yum Yum (Zigatola)', NULL, NULL, NULL, 'Zigatola Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(694, 1, 6, 1, 13, 25, 102052024, 'Cafe Rio (Zigatola)', NULL, NULL, NULL, 'Zigatola   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(695, 1, 6, 1, 13, 25, 102052038, 'Sky View (Nowakhali)', 'Mr. Mossarraf Hossain', '1828134121', NULL, 'Maizdi  Nowakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(696, 1, 6, 1, 13, 25, 102052040, 'Disney Dine(Mohammadpur)', 'Mr. Abbas', '1777119203', NULL, 'Nooren Tower  Shia Masjid  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(697, 1, 6, 1, 13, 25, 102052048, 'Le Pizzaria(Dhanmondi)', NULL, '1780709189', NULL, 'Zigatola  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(698, 1, 6, 1, 13, 25, 102052049, 'Kudos (Dhanmondi)', NULL, '1712733750', NULL, '1/5  Block-D  lalmatia  Dhaka 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(699, 1, 6, 1, 13, 25, 102052053, 'Pie Top', NULL, '1853752585', NULL, 'H-11  B-H  Banasree  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(700, 1, 6, 1, 13, 25, 102052054, 'Food Fantasy(N.Ganj)', NULL, NULL, NULL, 'Tokyo Plaza 69  Bongo Bondhu Road  DIT N.Gonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(701, 1, 6, 1, 13, 25, 102052056, 'Snack & Shake(Baily Road)', NULL, '1756006341', NULL, 'Kali Mandir  Shideswari  Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(702, 1, 6, 1, 13, 25, 102052057, 'Mojibor Traders(DCC)', NULL, '1736271727', NULL, 'DCC Market  Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(703, 1, 6, 1, 13, 25, 102052058, 'Fazitaas (Taltola)', NULL, '1740529532', NULL, 'Taltola  Khilgaon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(704, 1, 6, 1, 13, 25, 102052059, 'Global Distribution', 'Mr. Jashim', '1617429894', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(705, 1, 6, 1, 13, 25, 102052060, 'Eva Burger(Polton)', 'Mr. Rony', '1727476082', NULL, '37/2 Purana Polton  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(706, 1, 6, 1, 13, 25, 102052061, 'Wild Fork(Mohammadpur)', 'Mr. Halim', '1686957944', NULL, 'Tajmohol Road  Md.Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(707, 1, 6, 1, 13, 25, 102052062, 'Mr. Anik', NULL, '1775569499', NULL, 'Tejgaon  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(708, 1, 6, 1, 13, 25, 102052063, 'Bistro Fantastic', NULL, NULL, NULL, '3  Mohakhali  Venture Tower{Opposit of Bono bhaban)  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(709, 1, 6, 1, 13, 25, 102052064, 'Shopno Test(Askona)', 'Mr. Kabir', '1928645978', NULL, 'Askona Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(710, 1, 6, 1, 13, 25, 102052065, 'Pizzawala (Dhanmondi)', NULL, '1717083676', NULL, 'House - 39/A  Road-8  Dhanmondi  Dhaka -1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(711, 1, 6, 1, 13, 25, 102052066, 'Azzurri cucina Italiano', NULL, NULL, NULL, 'House# 57  Road# 13/E  Banani  Dhaka-1213', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(712, 1, 6, 1, 13, 25, 102052067, 'Dhaka Biriani House', NULL, '1735154339', NULL, 'Azimpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(713, 1, 6, 1, 13, 25, 102052070, '2 Go Restaurant(Mirpur-1)', NULL, NULL, NULL, '2/7-K Tolarbag 1st lane  Mirpur-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(714, 1, 6, 1, 13, 25, 102052071, 'Sandwich Slice (Uttara)', NULL, '1689494388', NULL, 'House-01 Road-7/A Sector-05', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(715, 1, 6, 1, 13, 25, 102052072, 'Brothers Cafe(Farmgate)', NULL, '1788985819', NULL, '49/A east tejturi bazar  Tejgoan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(716, 1, 6, 1, 13, 25, 102052074, 'Club 13 (Mirpur)', 'Mr. Rashed', '1728764776', NULL, 'House-60  Road-2  Rupnagar  Abashik area', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(717, 1, 6, 1, 13, 25, 102052075, 'poopys (Syedsary)', NULL, NULL, NULL, 'Syedsary  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(718, 1, 6, 1, 13, 25, 102052076, 'Le-Vie Sky Dinner', NULL, '1776435420', NULL, 'House-44 Road-02 Floor-13 Kazi Tower Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(719, 1, 6, 1, 13, 25, 102052078, 'Wanted Burger(Uttara)', NULL, NULL, NULL, 'House-01  Road-7/A  Sector-05', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(720, 1, 6, 1, 13, 25, 102052079, 'Formuza QQ (Kalshi)', NULL, NULL, NULL, 'Kalshi  Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(721, 1, 6, 1, 13, 25, 102052080, 'Suchili(Zigatola)', NULL, NULL, NULL, '60  Sat Mosjid Road   Keari Cresent Zigatola Bus Stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(722, 1, 6, 1, 13, 25, 102052081, 'Wow Restaurant(Lalbag)', 'Mr.Iqbal', '1855459088', NULL, 'Madrasha Road Lalbag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(723, 1, 6, 1, 13, 25, 102052018, 'Food Enginearing (Mirpur 60 Feet)', 'Mr. Foysal', '1929041115', NULL, '264/4/A Middle Pirerbag', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(724, 1, 6, 1, 13, 25, 102052046, 'Dusa Masala', NULL, '1930819905', NULL, 'Tongi  Gazipur   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(725, 1, 6, 1, 13, 25, 102052077, 'Cafe & Coffee Solution', NULL, '1719090903', NULL, 'House-110 Road-07 Block-H  South Banasree ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(726, 1, 6, 1, 13, 25, 102052083, 'Food Book(Banani)', NULL, '1713443322', NULL, 'House-32 Level-03 Block-D Road-11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(727, 1, 6, 1, 13, 25, 102052084, '3 Food (Mirpur-14)', NULL, '01863059249/ 01730586193', NULL, 'Sun Electronics  Beaside Mili Super Market  Mirpur-14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(728, 1, 6, 1, 13, 25, 102052086, 'Fries & Buns(Uttara)', NULL, NULL, NULL, 'House-08 Road-05  Sector-13', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(729, 1, 6, 1, 13, 25, 102052089, 'Chef\'s House(Uttara)', NULL, '1712374105', NULL, 'House-61  Road-02 Sector-04', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(730, 1, 6, 1, 13, 25, 102052090, 'Anondo Hotel(Farmgate)', NULL, '1752902320', NULL, 'Tejturi Bazar  Farmgate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(731, 1, 6, 1, 13, 25, 102052092, 'Hello Sir(Mirpur-2)', NULL, '1961100116', NULL, 'Shop-05 Mirpur-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(732, 1, 6, 1, 13, 25, 102052094, 'Food Village(Uttara)', NULL, NULL, NULL, 'Zam Zam Tower  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(733, 1, 6, 1, 13, 25, 102052095, 'Pancho Banjon(Uttara)', NULL, '1742250514', NULL, 'Road-06 Sector-13 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(734, 1, 6, 1, 13, 25, 102052097, 'Go Go Gaga(Uttara)', NULL, NULL, NULL, 'Zam Zam Tower Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(735, 1, 6, 1, 13, 25, 102052098, 'Bazar Mama.Com', NULL, '1618206600', NULL, 'ECB Chattor Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(736, 1, 6, 1, 13, 25, 102052099, 'Crezy Burger', NULL, '1794727401', NULL, 'Dhanmondi-15( BFC building).Level-7.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(737, 1, 6, 1, 13, 25, 102052101, 'Amontron (B.City)', NULL, '01819-887776', NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(738, 1, 6, 1, 13, 25, 102052102, 'Foodgeek(Mohammadpur)', NULL, NULL, NULL, '15/6  Block-C Tajmahal Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(739, 1, 6, 1, 13, 25, 102052103, 'M Cafe(Kalabagan)', NULL, '1705466444', NULL, '14  Mirpur road  Kalabagan  Dhanmondi  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(740, 1, 6, 1, 13, 25, 102052104, 'Take Way (kornofuly)', NULL, NULL, NULL, 'Kornofuly Garden City  Kakrail', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(741, 1, 6, 1, 13, 25, 102052105, 'Formuza( R.Square)', NULL, NULL, NULL, 'R. Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(742, 1, 6, 1, 13, 25, 102052107, 'Melt Town(Dhanmondi)', 'Tajin', '1711875376', NULL, 'Satmosjid Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(743, 1, 6, 1, 13, 25, 102052108, 'Green Yard Restaurant(Uttara)', NULL, NULL, NULL, '41 Garib-E-Newaz Avenue Sec-11 Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(744, 1, 6, 1, 13, 25, 102052110, 'B Cafe (Lalbag)', NULL, '1754282499', NULL, 'Lalbag Chowrasta  1st floor(Apex)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(745, 1, 6, 1, 13, 25, 102052111, 'Beaking Food(Uttara0', NULL, NULL, NULL, 'Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(746, 1, 6, 1, 13, 25, 102052112, 'Spicy-6 (Mohammadpur)', 'Mr. Evan', '1630693999', NULL, 'House-16/A-1 Ring Road Md.Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(747, 1, 6, 1, 13, 25, 102052115, 'Chillox (Banani)', 'Mr. Pranta', '1638036014', NULL, 'Kamal Ataturk Avenue   Banani   Dhaka', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(748, 1, 6, 1, 13, 25, 102052116, 'Shopno Test(Malibag)', 'Mr. Kabir', '1928645978', NULL, 'Hosaf Tower  Malibag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(749, 1, 6, 1, 13, 25, 102052120, 'Mila Fast Food(Bogra)', 'Mrs. Mila', '1711592459', NULL, 'Bogra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(750, 1, 6, 1, 13, 25, 102052028, 'Food Bug(Nikunjo)', NULL, '1743101620', NULL, 'House-43  Road-09 Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(751, 1, 6, 1, 13, 25, 102052073, 'Akota Chicken House', NULL, '1839657864', NULL, 'DCC Market  Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(752, 1, 6, 1, 13, 25, 102052096, 'Albee Restaurant (Dhanmondi)', NULL, NULL, NULL, 'KFC Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(753, 1, 6, 1, 13, 25, 102052106, 'Rocking Chef (Kalshi)', NULL, NULL, NULL, 'Kalshi Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(754, 1, 6, 1, 13, 25, 102052113, 'Ten-11 (Newmarket)', NULL, '1819806669', NULL, 'New Market  Gate-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(755, 1, 6, 1, 13, 25, 102052117, 'Ecstasy Cafe(Jamuna)', NULL, NULL, NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(756, 1, 6, 1, 13, 25, 102052118, 'Mazada Cafe(Dhan)', NULL, '1883002077', NULL, 'Shop# 105-107 Nizam Shankar Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(757, 1, 6, 1, 13, 25, 102052121, 'Yumient Restaurant(Dhan)', 'Mr  Ruhul', '1777669911', NULL, 'Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(758, 1, 6, 1, 13, 25, 102052122, 'BD K', NULL, '01716226687/0168968019', NULL, '4/47/1 Hasam Khan Road Rayea Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(759, 1, 6, 1, 13, 25, 102052123, 'Plated (Bashundhara)', 'Mr. Belal', '1774678409', NULL, 'Metro Kitchen Bashundhara R/A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(760, 1, 6, 1, 13, 25, 102052124, 'Khanas Restaurant(Dhanmondi)', NULL, '1712733750', NULL, 'Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(761, 1, 6, 1, 13, 25, 102052125, 'Mr Didar (Police Plaza)', NULL, NULL, NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(762, 1, 6, 1, 13, 25, 102052126, 'Agro Co. (N.Ganj)', NULL, NULL, NULL, 'Narayangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(763, 1, 6, 1, 13, 25, 102052127, 'Kamal Mangso Bitan', 'Mr  Kamal', '1911445856', NULL, 'Sec-11 Block-13 Ave-03 Mirpur-11', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(764, 1, 6, 1, 13, 25, 102052128, 'Mr. Voottu (Mirpur)', 'Mr. Voutto', '1750155479', NULL, 'Sec-11  Block-13  Ave.-03  Mirpur-11', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(765, 1, 6, 1, 13, 25, 102052129, 'Mr Sajib (Uttara)', NULL, '1673726201', NULL, 'Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(766, 1, 6, 1, 13, 25, 102052131, 'Khan Protin House(Uttara)', NULL, '1763777555', NULL, '12 No. Khalpar Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(767, 1, 6, 1, 13, 25, 102052132, 'Back Bencers (Mohammadpur)', NULL, NULL, NULL, 'Mohammadpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(768, 1, 6, 1, 13, 25, 102052134, 'Cheese Bite(Banasree)', NULL, NULL, NULL, 'House # 19  Road # 05  Block # D  Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(769, 1, 6, 1, 13, 25, 102052135, 'Cheese Bite(Malibag)', 'Mr. Mohoshin', '1828367353', NULL, 'Showpno Supper Shop Food Court Malibag More', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(770, 1, 6, 1, 13, 25, 102052136, 'Friends Kitchen(Banani)', NULL, '1914479230', NULL, 'House-28  Road-17/A Block-E', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(771, 1, 6, 1, 13, 25, 102052137, 'Showrma House(Banani)', NULL, NULL, NULL, 'Ahmed Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(772, 1, 6, 1, 13, 25, 102052138, 'Luchi Chuf(Baridhara)', NULL, NULL, NULL, 'Bashundhara Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(773, 1, 6, 1, 13, 25, 102052139, 'Mowshumi General Store (Mowlavibazar)', NULL, '1876278865', NULL, 'Opposit of Central Jail', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(774, 1, 6, 1, 13, 25, 102052142, 'Blasta', NULL, '1711518492', NULL, '239/3 Middle pirerbag  60 feet Road Mirpur.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(775, 1, 6, 1, 13, 25, 102052144, 'Burger House (Mohammadpur)', NULL, '1700809795', NULL, '10 Mosjid Market  Shakertek  Shop-22', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(776, 1, 6, 1, 13, 25, 102052145, 'HANSA A Premium Rasidance', 'Mr. Arif', '1708800743', NULL, 'Plot # 3 & 5  Road-10/A Sector-09  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(777, 1, 6, 1, 13, 25, 102052146, 'The Pabulum (Shantinagar)', 'Mr. Ratan', '1912645814', NULL, '41  Kulsum Tower  Shantinagar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(778, 1, 6, 1, 13, 25, 102052149, 'Md. Faridul Islam(Banani)', NULL, '1769702795', NULL, 'Sports Complex Cafeteria  Naval Head Quarter  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(779, 1, 6, 1, 13, 25, 102052152, 'Burger Hot (Basabo)', NULL, NULL, NULL, 'Basabo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(780, 1, 6, 1, 13, 25, 102052154, 'Food Express (Baily Road)', 'Mr. Sajjad', '1965555444', NULL, '10 natak sarani gold place  3rd floor ramna PS  Dhaka 1000 BIN:0011408590208', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(781, 1, 6, 1, 13, 25, 102052155, 'Hidden Food (Mirpur-6)', NULL, '1866806177', NULL, 'House-06  Road-10 Sec-06 Block-C', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(782, 1, 6, 1, 13, 25, 102052147, 'PQS Food Gallery', NULL, NULL, NULL, '353/A  Khilgoan  Tilpapara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(783, 1, 6, 1, 13, 25, 102052148, 'Ice & Juice(Dhanmondi-27)', 'Mr. Sanjoy Raj', '1929988138', NULL, 'Dhanmondi-27', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(784, 1, 6, 1, 13, 25, 102052150, 'Bar Code (Banani)', 'Mr. Mikel', '01626813424  01735986411', NULL, 'House-55  Road-21 Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(785, 1, 6, 1, 13, 25, 102052153, 'Bhai Bhai Mangsho Bitan', NULL, '1909083171', NULL, 'Gazipur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(786, 1, 6, 1, 13, 25, 102052158, 'Butter the Bakery(Banani)', 'Mr. Sohel', '1729247267', NULL, 'Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(787, 1, 6, 1, 13, 25, 102052159, 'Ak Traders (Jatrabari)', NULL, '1819608114', NULL, '142  Noyanagar Kazla', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(788, 1, 6, 1, 13, 25, 102052160, 'Poopyes (wari)', NULL, '1686825418', NULL, 'Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(789, 1, 6, 1, 13, 25, 102052162, 'Canton House (Uttara)', NULL, NULL, NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(790, 1, 6, 1, 13, 25, 102052164, 'Food House (Mohammadpur)', NULL, '1700523290', NULL, '22/15 Khilji Road   Md Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(791, 1, 6, 1, 13, 25, 102052165, 'Kazi Kitchen (Uttara)', NULL, '1770844900', NULL, 'Chawrasta opposit of Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(792, 1, 6, 1, 13, 25, 102052166, 'Pizza live (Paribag)', NULL, NULL, NULL, 'Paribag   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(793, 1, 6, 1, 13, 25, 102052167, 'Bunkers Restaurant (Dhanmondi)', 'Mr. Sahanawaj', '1707733167', NULL, '755  Rowsonara green tower  Satmosjid Road ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(794, 1, 6, 1, 13, 25, 102052168, 'Take Out (Banani)', 'Mr. Sumon', '184722196', NULL, 'Abedin Tower (1st Floor)  Kamal Ataturk Road  Banani', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(795, 1, 6, 1, 13, 25, 102052169, 'Salt Lick (Dhan)', NULL, NULL, NULL, 'Kazi Tower   Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(796, 1, 6, 1, 13, 25, 102052170, 'Garlic & Ginger ( Dhan)', 'Mr.Parvez', '1759434846', NULL, 'H # 54  R # 10/A  (7th floor)  Dhanmondi  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(797, 1, 6, 1, 13, 25, 102052171, 'Gardenia (Eskaton)', 'Mr. Anas', '1977366619', NULL, '20  New Eskaton Garden Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(798, 1, 6, 1, 13, 25, 102052172, 'Sompod Restaurant(Norshingdi)', NULL, NULL, NULL, 'Norshingdi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(799, 1, 6, 1, 13, 25, 102052173, 'Take Out (Uttara)', 'Mr. Ruhul', '1847227198', NULL, 'Uttara Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(800, 1, 6, 1, 13, 25, 102052174, 'Take Out (Dhan)', NULL, NULL, NULL, 'Satmosjid Road  Dhanmondi', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(801, 1, 6, 1, 13, 25, 102052175, 'Supreem Dinner -03', NULL, '1919351744', NULL, 'Nasim Tower Plot-25 Mirpur-01 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(802, 1, 6, 1, 13, 25, 102052176, 'Secret Recipe (Rajshahi)', NULL, NULL, NULL, 'Alchemist Nourishments Ltd  Colino\'s  Rajshahi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(803, 1, 6, 1, 13, 25, 102052177, 'Wing Bowen Restaurant', NULL, '1677701603', NULL, 'House-26 Road-18 Sec-03', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(804, 1, 6, 1, 13, 25, 102052271, 'Crazy Wings(baridhara)', NULL, '1819211744', NULL, 'Urban Void Food Court  Shop # 04  Bashundhara Gate  Bashundhara R/A  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(805, 1, 6, 1, 13, 25, 102052252, 'KPR Restaurant & Cafe', 'Mr. Palash', '1710483341', NULL, 'Uni Cafe Building Panthapath  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(806, 1, 6, 1, 13, 25, 102052742, 'Sub Lovers (Rapa Plaza)', 'Shah Alom', '1753498378', NULL, 'Rapa Plaza  Dhanmondi 27  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(807, 1, 6, 1, 13, 25, 102052178, 'Mr. Manik Foods (Dhanmondi)', 'Mr. Manik', '1913213949', NULL, 'Shimanto Somvar  Shop-9003  Level-09', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(808, 1, 6, 1, 13, 25, 102052179, 'Y BB', NULL, '1676757283', NULL, NULL, 6000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(809, 1, 6, 1, 13, 25, 102052180, 'YBB Corporation (Badda)', 'Mr. Yeasin Bhuiyan babu', '1753158616', NULL, 'Noyon Biriyani Goli  Link Road  Badda  Dhaka-1212', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(810, 1, 6, 1, 13, 25, 102052181, 'Take out (Ctg)', 'Mr. Zahidul Islam', '01847227196/01847227196', NULL, 'Impluse City Center  Level-2  O.R Nizam Road  Chittagong', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(811, 1, 6, 1, 13, 25, 102052183, 'Mr. Emon', 'Emon', '1884371654', NULL, 'Moulovibazar.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(812, 1, 6, 1, 13, 25, 102052187, 'Dhaka Foods', 'Mr. Nurul', '1709603722', NULL, 'Basundhara Gate  Bashundhara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(813, 1, 6, 1, 13, 25, 102052188, 'EL Dorado Revised', 'Mr. Agig', '1712174287', NULL, 'Bashundhara Gate  Bashundhara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(814, 1, 6, 1, 13, 25, 102052189, 'Kitchen Ette', 'Rashed Hasan', '1751414243', NULL, 'Kuratoli  Biside AIUB  Kuril Bishowaroad  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(815, 1, 6, 1, 13, 25, 102052191, 'Dipsy Dos (Mir)', NULL, '1980162594', NULL, 'DOHS  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(816, 1, 6, 1, 13, 25, 102052192, 'Helvetia Restaurant (Uttara)', 'Mr. Shohan', '1819260686', NULL, 'House-12(2nd flor) Road-19 Sector-14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(817, 1, 6, 1, 13, 25, 102052193, 'Smoothy 360 (Taltola)', 'Mr. Jony', '1756219651', NULL, 'Khilgaon  Taltola. Dhaka-1219', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(818, 1, 6, 1, 13, 25, 102052195, 'Tray Story (Taltola)', 'Mr. Tauhid', '1734010616', NULL, '920 Shahid Baki Road  Khilgoan  Taltola  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(819, 1, 6, 1, 13, 25, 102052196, 'Star Kitchen (Kalabagan)', NULL, NULL, NULL, 'Kalabagan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(820, 1, 6, 1, 13, 25, 102052197, 'Mad Chef X (Gulshan)', NULL, '1838620790', NULL, 'Uni Mart Building  Gulshan-2  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(821, 1, 6, 1, 13, 25, 102052198, 'Sub Way Rastaurant', NULL, '1788436705', NULL, 'House- 51  Road- 13  Sector- 11  Uttara  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(822, 1, 6, 1, 13, 25, 102052199, 'Fisher Village (Manikganj)', 'Mr. Sumon', '1749631678', NULL, 'Manikganj Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(823, 1, 6, 1, 13, 25, 102052200, 'Wind Blos(Uttara)', NULL, '1677701603', NULL, 'House-26  Road-18  Sector-3  Uttara. Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(824, 1, 6, 1, 13, 25, 102052204, 'Super Hit', NULL, NULL, NULL, 'Kazi Asparagas  Uttara  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(825, 1, 6, 1, 13, 25, 102052205, 'Khatir', NULL, '1914104433', NULL, 'Zam Zam Tower  Uttara  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(826, 1, 6, 1, 13, 25, 102052206, 'Yum Burger', NULL, '1632114152', NULL, 'Plot-04 Road-03 Sector-13 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(827, 1, 6, 1, 13, 25, 102052208, 'Mr Onindo', NULL, '1711924643', NULL, 'Buddo Mondir  Khilgoan', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(828, 1, 6, 1, 13, 25, 102052209, 'Saan Cafe', NULL, '1708535335', NULL, 'Baily Road', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(829, 1, 6, 1, 13, 25, 102052210, 'Farhan Trade', 'Mr.Rafik', '1521108584', NULL, 'Begunbari Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(830, 1, 6, 1, 13, 25, 102052212, 'Indian Spicy Chicken (Nikunja)', NULL, '1914519420', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(831, 1, 6, 1, 13, 25, 102052214, 'Dowla Traders', 'Siraz', '1717388770', NULL, '137/3 Middle Badda  Gulshan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(832, 1, 6, 1, 13, 25, 102052274, 'HANGOVER', 'Mr. Salauddin', '1748186810', NULL, 'House # 01  Road # 02  Sec # 03  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(833, 1, 6, 1, 13, 25, 102052182, 'Cracke Shacke', 'Mr. Shiblee', '1778045802', NULL, 'Unimart Building  2nd Floor  Gulshan-2  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(834, 1, 6, 1, 13, 25, 102052186, 'Harun', 'Harun', '1764168361', NULL, 'Mohakhali   Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(835, 1, 6, 1, 13, 25, 102052190, 'Burger a Kellafote', NULL, '1971883713', NULL, 'Kella Road  Lalbagh  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(836, 1, 6, 1, 13, 25, 102052218, 'Nowab Indian Restaurant (Jamuna)', 'Mr. Rakib', '1727412269', NULL, 'Jamun Future Park ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(837, 1, 6, 1, 13, 25, 102052219, 'Attain Cafe & Lounge(Gul-02)', NULL, '1834328366', NULL, '3rd Floor (UniMart Building)  Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(838, 1, 6, 1, 13, 25, 102052220, 'Taxi Burger (ECB)', NULL, NULL, NULL, 'Mirpur Kazi Island Foot', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(839, 1, 6, 1, 13, 25, 102052194, 'Treat N Eat (Kalabagan)', NULL, '1616929290', NULL, '56/8  1st Floor  Lake Circus  Kalabagan. Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(840, 1, 6, 1, 13, 25, 102052207, 'Mr Gosto (ECB)', 'Imam Babu', '1675906533', NULL, 'ECB Sottor Bus Stand  Cantonment Mirpur-14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(841, 1, 6, 1, 13, 25, 102052213, 'MD Treaders', NULL, '1915493536', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(842, 1, 6, 1, 13, 25, 102052215, 'Bappi Store (kaptan bazar)', NULL, '1919914752', NULL, 'Kaptan Bazar  Mudi Market Near Shohagh Hotel.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(843, 1, 6, 1, 13, 25, 102052216, 'Rahbar General Store', NULL, '1627514419', NULL, '540 South Dhonia  Shahi Masjid Road  Dhaka-1236', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(844, 1, 6, 1, 13, 25, 102052217, 'Pronoy Coffee shop (Narshingdi)', 'Pronoy', '1634619620', NULL, 'Dream holiday park  Puchdona   Narsingdi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(845, 1, 6, 1, 13, 25, 102052223, 'Taza Fal-1 (Simanto Square)', 'Md. Ismail', '1687880812', NULL, '2nd Floor  Simanto squar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(846, 1, 6, 1, 13, 25, 102052224, 'Chicken King', 'Mr. Kabir', '1928645978', NULL, 'Thana Road  Uttar Badda  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(847, 1, 6, 1, 13, 25, 102052225, 'Cafe Adda (Jhenaidaha)', 'Mr Raihan', '1716451013', NULL, 'Jhenaidaha Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(848, 1, 6, 1, 13, 25, 102052226, 'Mr. Rahat (Khilgaon)', 'Rahat', '1997722846', NULL, 'House-354  Road-20  Tilpapara  Khilgaon  Dhaka-1219', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(849, 1, 6, 1, 13, 25, 102052227, 'Merriment Restaurant', NULL, NULL, NULL, 'House-05  Sonargaon Road  Sec-07  Uttara  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(850, 1, 6, 1, 13, 25, 102052228, 'Ratul Trading (KB)', 'Mr. Imran', '1859222780', NULL, 'Kitchen Market  Level-2  Karwan Bazar', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(851, 1, 6, 1, 13, 25, 102052230, 'Dining Lounge (Wari)', NULL, '1911334415', NULL, '8/1  Ranking Street  Wari  Dhaka-1203', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(852, 1, 6, 1, 13, 25, 102052231, 'Falafel Point', NULL, '1834739973', NULL, 'Badda Gudaraghat  Lake er par.', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(853, 1, 6, 1, 13, 25, 102052232, 'Muskan Food Shop', 'Kamal', '1820211373', NULL, '12  Rifel Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(854, 1, 6, 1, 13, 25, 102052233, 'New Italia (Ashulia)', NULL, '1758000751', NULL, 'Asulia  Savar  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(855, 1, 6, 1, 13, 25, 102052234, 'Maple Leaf', NULL, '1966667658', NULL, 'House-13  Road-1 Sector-1  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(856, 1, 6, 1, 13, 25, 102052237, 'Abrar Treaders (Badda)', 'Zahid Iqbal', '1813762822', NULL, 'Bepari Tower  Middle badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(857, 1, 6, 1, 13, 25, 102052238, 'New Coffee House (Dhanmondi)', NULL, '1674528473', NULL, 'Subhanbagh  Mirpur road  Dhanmondi Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(858, 1, 6, 1, 13, 25, 102052240, 'Ala-Uddin Treaders', 'Alauddin', '1713461570', NULL, 'DCC Market  Gulshan-1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(859, 1, 6, 1, 13, 25, 102052275, 'Showpno Show Room (Gul)', 'Mr. Rashed', '1712083608', NULL, 'Hosna Tower  Opposite of AB Bank  Gulshan Avenue Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(860, 1, 6, 1, 13, 25, 102052202, 'Tuspany', NULL, '1755627137', NULL, 'House-101  Road- 13/A  Block-C  Banani. Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(861, 1, 6, 1, 13, 25, 102052203, 'Food Grace', NULL, '1878460713', NULL, 'kazi food island  uttara  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(862, 1, 6, 1, 13, 25, 102052211, 'Salauddin Trade', 'Mr.Salauddin', NULL, NULL, 'Lalbag Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(863, 1, 6, 1, 13, 25, 102052222, 'Food Square', 'Rocky', '1812988151', NULL, 'Road-01  House-55  Sector-9  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(864, 1, 6, 1, 13, 25, 102052242, 'Coffee Buzz(Panthopath)', NULL, '1316240883', NULL, '63/C Lake Sarkas Road  West Panthopath', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(865, 1, 6, 1, 13, 25, 102052244, 'Jeppin cafe (Mirpur DOHS)', NULL, '1644988125', NULL, 'DOHS  Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(866, 1, 6, 1, 13, 25, 102052248, 'Mr. Azam', 'Mr. Azam', NULL, NULL, 'Taltola  Khilgaon  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(867, 1, 6, 1, 13, 25, 102052250, 'Rainbow Enterprise', 'Mr. Sarad', NULL, NULL, 'Safe & Fresh  Kawranbazar  Dhaka', 800000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(868, 1, 6, 1, 13, 25, 102052184, 'Showrma Kebaish house', NULL, '29663060', NULL, '185  Rose View Plaza  Hatirpur  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(869, 1, 6, 1, 13, 25, 102052201, 'Meal Deal (Bashundhara)', NULL, NULL, NULL, 'Bashundhara Gate. Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(870, 1, 6, 1, 13, 25, 102052221, 'Muslim Biriani House', NULL, '1817019321', NULL, 'Md.Pur  Tajmahal Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(871, 1, 6, 1, 13, 25, 102052229, 'Loca Cafe & Restaurent', NULL, '1774955083', NULL, 'KA-11  Basundhara Gate  7th Floor  Opposite of Burger King  Dhaka-1229', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(872, 1, 6, 1, 13, 25, 102052235, 'Sorriso Restaurant', NULL, NULL, NULL, 'Bashundhara R/A  Opposite of Loca Cafe.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(873, 1, 6, 1, 13, 25, 102052236, 'Mr. Shafiq', NULL, '1991196708', NULL, 'Baridhara  Bashundhara  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(874, 1, 6, 1, 13, 25, 102052239, 'Kashundi Restaurant', 'Jubayer', '1926690971', NULL, 'NSU Canteen  Bashundhara R/A. Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(875, 1, 6, 1, 13, 25, 102052241, 'Sub Lovers (Bashundhara)', NULL, '1707001475', NULL, 'Bashundhara Road ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(876, 1, 6, 1, 13, 25, 102052243, 'Mayer Doa (Kuril)', NULL, '1718747341', NULL, 'Kuril Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(877, 1, 6, 1, 13, 25, 102052245, 'Blasta Burger & Chicken (Mirpur-60 Feet)', NULL, '1742267375', NULL, 'Pirerbug 60 feet  Pabna Goli', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(878, 1, 6, 1, 13, 25, 102052246, 'Starbucks (Motijheel)', NULL, NULL, NULL, 'Motijheel  dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(879, 1, 6, 1, 13, 25, 102052247, 'Fork & Knief', NULL, '1913514121', NULL, 'House-35  Road- 02  Kazi Tower  Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(880, 1, 6, 1, 13, 25, 102052251, 'Showpno Show Room (Mirpur)', 'Mr. Shahdat', '1716095360', NULL, 'Goalchakkar  Site of Apex/Adarsha School  Mirpur-10  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(881, 1, 6, 1, 13, 25, 102052254, 'Chadpur Traders (Tal)', NULL, '1758544123', NULL, 'Khilgaon  Taltola  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(882, 1, 6, 1, 13, 25, 102052255, 'Pizza Bazar (Kakrail)', NULL, '1758544123', NULL, 'Karnafuli Garden City  Kakrail  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(883, 1, 6, 1, 13, 25, 102052257, 'Zia General Store (Gul)', NULL, NULL, NULL, 'DCC Market  Gulshan-1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(884, 1, 6, 1, 13, 25, 102052258, 'Test Bust', NULL, NULL, NULL, 'Zam Zam Tower  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(885, 1, 6, 1, 13, 25, 102052261, 'Burger Queen', NULL, '1746312434', NULL, 'Shiddeswari Near Poopeyes', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(886, 1, 6, 1, 13, 25, 102052263, 'Khandani Voj (Panthopath)', NULL, '1775569202', NULL, '78- Green Road  Farmgate  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(887, 1, 6, 1, 13, 25, 102052267, 'Sublation', 'Mr. maruf', '1830485147', NULL, 'Kuratoli  kuril  Dhaka (Near AIUB)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(888, 1, 6, 1, 13, 25, 102052277, 'Niloy Protein House (N.Ganj)', 'Mr. Niloy', NULL, NULL, 'Chashara  Narayanganj', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(889, 1, 6, 1, 13, 25, 102052279, 'Dhaka Fried Chicken (Mohammadpur)', NULL, '1680041750', NULL, 'House# 8  Main Road  Mohammadia Housing Ltd  Mohammad Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(890, 1, 6, 1, 13, 25, 102052185, 'SZ Food Junction', 'Omar Faruk', '01789977660  01642320036', NULL, 'Kazi asparagus Food Island  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(891, 1, 6, 1, 13, 25, 102052259, 'Al-Madina Dosa Masala (Uttara)', NULL, '1717527742', NULL, 'House #10 Sector #3 Road #9 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(892, 1, 6, 1, 13, 25, 102052265, 'Waffled', NULL, '1741177879', NULL, 'Zigatala Bus Stand  Apex Building (2nd Floor)  Dhanmondi  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(893, 1, 6, 1, 13, 25, 102052269, 'Meat House (Zigatola)', 'Mr.Nazmul', '1932913038', NULL, 'Zigatola Post Office  Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(894, 1, 6, 1, 13, 25, 102052270, 'Jacinta Multi Cuisine & Restaurant', 'MD. Ramjan Ali', '1958251567', NULL, 'KA-78 Sar Bhaban Progati  Sarani Main Road  Dhaka-1229', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(895, 1, 6, 1, 13, 25, 102052273, 'Khan General Store', NULL, '1732989275', NULL, 'Metro kitchen  Dhalibari Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(896, 1, 6, 1, 13, 25, 102052278, 'Confidence Delivery', NULL, '1786477214', NULL, 'Dali Bari  Opposite of Plated  Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(897, 1, 6, 1, 13, 25, 102052282, 'Al-Amin Traders (K B)', 'Mr. Rubel', '1924537291', NULL, 'Kawron Bazar  Near Chadpur Traders', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(898, 1, 6, 1, 13, 25, 102052284, 'Mr. Babu', NULL, '1753158616', NULL, 'DCC Market  Gulshan-1', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(899, 1, 6, 1, 13, 25, 102052287, 'Bhai Bhai General Store (Gulsan)', NULL, NULL, NULL, 'Gulsan-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(900, 1, 6, 1, 13, 25, 102052288, 'Burger Mania (Bashundhara)', 'Mr. Azad', '1625235175', NULL, 'House # 02  Block # A  Basundhara R/A  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(901, 1, 6, 1, 13, 25, 102052289, 'M M Cafe (Kalshi)', NULL, '1718269596', NULL, 'Kalshi  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(902, 1, 6, 1, 13, 25, 102052290, 'Moon Star (DCC)', NULL, '1935404474', NULL, 'DCC MArket  Gulshan-01  Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(903, 1, 6, 1, 13, 25, 102052291, 'Mad Chef Ware House', 'Mr.Atik', '01753192498  01734602071', NULL, 'Momotaz Uddin Kasa Bazar  Dorjibari  99 Market Solmaid Basundhara', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(904, 1, 6, 1, 13, 25, 102052293, 'Mowbon.Dhanmondi', NULL, '1739732321', NULL, 'Momtaz.Palaza.Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(905, 1, 6, 1, 13, 25, 102052295, 'Shakill', NULL, '1872222339', NULL, 'Gulshan.1  D C C Market Kachabajar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(906, 1, 6, 1, 13, 25, 102052296, 'Mamun Corporate', 'Mr. Mamun', '1951407513', NULL, 'DCC Market  Gulshan-01  Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(907, 1, 6, 1, 13, 25, 102052297, 'Bakers and Roastars', 'Billal Hossian', '1673076659', NULL, 'House#99.Road11/A  Satmosjid  Road.   Dhanmondi Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(908, 1, 6, 1, 13, 25, 102052301, 'Sonali Traders (Taltola)', 'Alamgir', '1921089522', NULL, 'Taltola City Super Market  Opposide Of Nayma Store', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(909, 1, 6, 1, 13, 25, 102052305, 'Hungry Max (Mirpur-60 Feet)', NULL, '1631227116', NULL, 'Mirpur  60 Feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(910, 1, 6, 1, 13, 25, 102052308, 'Mr. Asif (Police Plaza)', 'Mr. Asif', '1717571667', NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(911, 1, 6, 1, 13, 25, 102052309, '3 Food (ECB Branch)', 'Answar', '1718180310', NULL, 'High Dream Building  Mati kata Road  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(912, 1, 6, 1, 13, 25, 102052313, 'Dhakaiya Dine (Lalbag)', 'Rezoan', '1726200097', NULL, '9/3 Husnedalan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(913, 1, 6, 1, 13, 25, 102052314, 'Yumint2', NULL, '1777669911', NULL, 'Shoniakra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(914, 1, 6, 1, 13, 25, 102052315, 'Smart Burger (Mirpur DOHS)', 'Delowar', '1711229469', NULL, 'DOHS  Mirpur (Beside Jeppin Cafe)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(915, 1, 6, 1, 13, 25, 102052317, 'Rainy Roof Restaurant (Karwanbazar)', NULL, '1973277638', NULL, '7-9 BTMC Bhaban  12 Floor  Roof Top  Karwanbazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(916, 1, 6, 1, 13, 25, 102052249, 'Azmeri Treaders (Jatrabari)', 'Mr Saiful', '1766674110', NULL, 'Jatrabari  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(917, 1, 6, 1, 13, 25, 102052253, 'Oasis (Dhanmondi)', 'Anwer', '1944541842', NULL, 'H # 18  R # 6  Dhanmondi Plaza  Mirpur Road  Dhanmondi R/A  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(918, 1, 6, 1, 13, 25, 102052294, 'Mr.Burgar(Dhanmondi)', NULL, '1791752834', NULL, 'Hous#39.Rod#2  .Lilyrin Tower  3rd# Fllor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(919, 1, 6, 1, 13, 25, 102052298, 'Burger Queen (Mirpur-2)', NULL, NULL, NULL, 'Hazi Road  Near Sheyal Baarimor  Mirpur-2  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(920, 1, 6, 1, 13, 25, 102052310, 'Banee\'s Creation(Mirpur-1)', NULL, '1708672484', NULL, 'Bashiruddin High School Road  Salim Uddin Market Mirpur-01', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(921, 1, 6, 1, 13, 25, 102052311, 'Taste CO. (Kalshi)', NULL, NULL, NULL, 'Mirpur Kalshi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(922, 1, 6, 1, 13, 25, 102052316, 'Shawarma house(Taltola)', NULL, '1723382252', NULL, 'Taltola .House371/B  .1StFloor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(923, 1, 6, 1, 13, 25, 102052318, 'Cafe D Cold (Mohammadpur)', NULL, '1797837975', NULL, 'Mohamdpur. Nurjahan Rood', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(924, 1, 6, 1, 13, 25, 102052319, 'Transcom ( KFC Bangladesh Ltd.)', 'Mr. Reza', NULL, NULL, 'Gulshan-1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(925, 1, 6, 1, 13, 25, 102052320, 'Tiffin Box Ltd', 'Mr.Farid', '1708132121', NULL, 'Plot-68  Road-11  Block-H  Banani  PS; Dhaka-1213', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(926, 1, 6, 1, 13, 25, 102052322, 'Bill Patto', NULL, '1711193342', NULL, 'Fridpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(927, 1, 6, 1, 13, 25, 102052323, 'Pizza Wala (Gulsan)', NULL, '1938888079', NULL, '106# Hosna Center Gulsan  Avenue Dhaka-1212   Inside Swapno Markentile Bank Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(928, 1, 6, 1, 13, 25, 102052325, 'Hotel Momo Inn (Bogura)', NULL, '1730726204', NULL, 'Nawda Para  TMSS  Bogura  Mob: 01313780301  01725241629', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(929, 1, 6, 1, 13, 25, 102052326, 'Food Dude (Taltola)', NULL, NULL, NULL, 'Taltola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(930, 1, 6, 1, 13, 25, 102052327, 'Jhalmuri  (Baily Road)', NULL, '1687253461', NULL, 'BaliRoad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(931, 1, 6, 1, 13, 25, 102052328, 'Mexi In Corner (Gulshan2)', NULL, '1822033044', NULL, 'Pinkcity Market .4TH Floor. Shop No3.Gulshan2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(932, 1, 6, 1, 13, 25, 102052331, 'Smores Cafe Restaurant (Dhanmondi)', 'Mr. Raju', '1684425849', NULL, 'Rangs Fortunne Square Level3.Dhanmondi2.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(933, 1, 6, 1, 13, 25, 102052334, 'Mr.Omar Faruk', NULL, NULL, NULL, 'Zigatola  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(934, 1, 6, 1, 13, 25, 102052336, 'Cheese Express(Md.Pur)', NULL, NULL, NULL, 'Md.Pur Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(935, 1, 6, 1, 13, 25, 102052338, 'Formuza Q Q (Science Lab)', NULL, '1762002180', NULL, 'Bosundhara Goli. Pringgon Market  Fast Floor. Science Lab Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(936, 1, 6, 1, 13, 25, 102052339, 'Bhooter Bari (Beily Road)', NULL, '1772009299', NULL, 'Beily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(937, 1, 6, 1, 13, 25, 102052340, 'N Pizzariya  (Tongi Gazipur)', 'Alomgir Hossain', '1883142124', NULL, 'Ovijan 98.Tongi College Rood.Auchpara Tongi Gazipura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(938, 1, 6, 1, 13, 25, 102052341, 'Zaraas  Cafe (Bashabo)', NULL, '1788777447', NULL, '161 South Bashabo Be Side WahabColony Depot', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(939, 1, 6, 1, 13, 25, 102052342, 'Indian Spicy Massala (Shahjadpur)', 'Monir', '01754262820/01746269067', NULL, 'Biside The Confidence Towar.Shadatpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(940, 1, 6, 1, 13, 25, 102052344, 'Tongue& Tummy (Raifel Square)', NULL, '1712966572', NULL, 'Dhanmondi 2.Simanto Towar 9 Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(941, 1, 6, 1, 13, 25, 102052345, 'Spice Kuji (Bcity)', NULL, NULL, NULL, 'Basundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(942, 1, 6, 1, 13, 25, 102052349, 'Nobi Enterprise (K.B)', NULL, '1937080451', NULL, 'Karwanbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(943, 1, 6, 1, 13, 25, 102052350, 'Jahangir Enterprise', NULL, '1711274984', NULL, 'Karonbazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(944, 1, 6, 1, 13, 25, 102052352, 'Riyad (Karwabazar)', NULL, '1813564787', NULL, 'Karwabazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(945, 1, 6, 1, 13, 25, 102052354, 'Meherun  Enterprice', NULL, '1711025042', NULL, 'Gulshan 1.D C C Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(946, 1, 6, 1, 13, 25, 102052256, 'Shojib Store (Uttara)', NULL, '248956354', NULL, 'Kushal Center  Rajlaxmi (Under Ground)  Uttara  Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(947, 1, 6, 1, 13, 25, 102052283, 'Hungrila (Bashundhara)', 'Mr.Sumon', '1798372874', NULL, 'Bashundhara.Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(948, 1, 6, 1, 13, 25, 102052299, 'Mr. Monir (Utta)', NULL, NULL, NULL, 'Sector-12  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(949, 1, 6, 1, 13, 25, 102052312, 'Fridays Fast Food (Gulsan -1)', 'Mr. Rasel', '1844485326', NULL, '66# Guylsan Avineu  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(950, 1, 6, 1, 13, 25, 102052330, 'Perk N Smirk (Zigatola)', NULL, '1648485298', NULL, 'Zigatola Bus Stand.Keari Crescent 6th Floor Same Building Of Gamblers Yumient and Trump Cafe', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(951, 1, 6, 1, 13, 25, 102052333, 'Chui Jhall (Mohamdpur)', 'Masud', '1671852279', NULL, 'Collage Gate 1/1.Mukti Zodda Tawor (Mohamdpur)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(952, 1, 6, 1, 13, 25, 102052335, 'Noakhali General Store( KB)', NULL, '1712158508', NULL, 'Kawran Bazar', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(953, 1, 6, 1, 13, 25, 102052337, 'Seagul B D R  Bazzar (Uttara)', NULL, '01948857180 /01771778926', NULL, 'B DR Bazzar .Uttra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(954, 1, 6, 1, 13, 25, 102052343, 'Stake Republic(Gul)', NULL, '1935555111', NULL, 'House # 24  Road # 36', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(955, 1, 6, 1, 13, 25, 102052347, 'Lanta Service', NULL, '1819277540', NULL, 'Safe N fresh  Karwanbazar', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(956, 1, 6, 1, 13, 25, 102052351, 'Mr Mahamud', NULL, '1811144410', NULL, 'Abdulla Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(957, 1, 6, 1, 13, 25, 102052356, 'Mr Nati (Section Bazzar)', NULL, '1728432027', NULL, 'Kamrangi Chor. Section Bazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(958, 1, 6, 1, 13, 25, 102052362, 'Kalam (Karwanbazar)', 'Kalam', '1790598556', NULL, 'Karwanbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(959, 1, 6, 1, 13, 25, 102052364, 'Mr  Shiraj (Mohammadpur)', NULL, NULL, NULL, 'Mohammdpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(960, 1, 6, 1, 13, 25, 102052365, 'Mr Barkot (Shantingor Bazzar)', NULL, NULL, NULL, 'Shantingor  Bazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(961, 1, 6, 1, 13, 25, 102052367, 'Hungri  Man  (Motalab Plaza)', NULL, '1624556600', NULL, 'Motalab Plaza  Hatirpool  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(962, 1, 6, 1, 13, 25, 102052368, 'Starkul Buzz(Badda)', NULL, '1823010327', NULL, '100 Food World   United University', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(963, 1, 6, 1, 13, 25, 102052369, 'Nurani Hotel & Resturant (Azimpur)', NULL, '1918440605', NULL, 'Azimpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(964, 1, 6, 1, 13, 25, 102052371, 'Chillox Store', NULL, '1638036014', NULL, 'Rahul Mambar Bari.Bul Bular Market.Bruya Khikhet.Rejenshi Market Near', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(965, 1, 6, 1, 13, 25, 102052372, 'Masum (Kawranbazar)', NULL, '1739699260', NULL, 'Kawranbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(966, 1, 6, 1, 13, 25, 102052376, 'Mr Faruq (Mohammdpur)', NULL, NULL, NULL, 'Mohammdpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(967, 1, 6, 1, 13, 25, 102052381, 'Green Leaf Cafe', NULL, '1317462236', NULL, 'House No-44(Gate 02) Rabindrasarni  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(968, 1, 6, 1, 13, 25, 102052383, 'Bismillah Mangsho Bitan(Mirpur10)', 'Mr Shukkur', '1729784146', NULL, 'Mirpur 10 .Idiyal School & College', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(969, 1, 6, 1, 13, 25, 102052384, 'Signature Club (Raifel  Squir)', NULL, '1911234682', NULL, 'Raifel Squir .Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(970, 1, 6, 1, 13, 25, 102052385, 'Bismillah Hotel &Resturant(sadarghat)', NULL, '1919009889', NULL, 'Sadarghat', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(971, 1, 6, 1, 13, 25, 102052386, 'Nurani Hotel & Resturant (Azimpur)', NULL, '1918440605', NULL, 'Azimpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(972, 1, 6, 1, 13, 25, 102052389, 'Mr Mamun (Mirpur)', NULL, NULL, NULL, 'Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(973, 1, 6, 1, 13, 25, 102052393, 'Bistro 53 (Motijheel)', NULL, '1931135295', NULL, 'Elite House53. Motijheel', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(974, 1, 6, 1, 13, 25, 102052394, 'The foodist (khilkhet)', 'Mr. Monir', '1531724700', NULL, 'Khilkhet tetultala Opposite Merin Hospital', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(975, 1, 6, 1, 13, 25, 102052396, 'Sub Waye Grill (Bcity)', NULL, '1977428169', NULL, 'Basundhara (B C)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(976, 1, 6, 1, 13, 25, 102052260, 'Edith- Bon Foods (Banani)', NULL, '1714131444', NULL, 'House-71  Road-11  Block-D  Banani  (National Bank Building)  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(977, 1, 6, 1, 13, 25, 102052272, 'Mr. Mannan', NULL, '1732989275', NULL, 'Notun Bazar', 0.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(978, 1, 6, 1, 13, 25, 102052286, 'Pizza Lab (Bashundhara)', NULL, '170,404,037,001,674,000,000', NULL, 'Basundhara  Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(979, 1, 6, 1, 13, 25, 102052300, 'Mr. Abul Hossain (Sylhet)', 'Abul Hossain  Md. Nazrul Islam', '1715389266', NULL, 'Tamabil road  Shibgonj Bazar  Sylhet  01711435929  01818111399', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(980, 1, 6, 1, 13, 25, 102052321, 'Preetom Store (Banani)', NULL, '1911338467', NULL, 'A L Complex  House No# 78/7  4 Floor  Chairman  Bari  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(981, 1, 6, 1, 13, 25, 102052332, 'Ma Tadars (Gulshan1)', NULL, '1761747100', NULL, 'Gulshan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(982, 1, 6, 1, 13, 25, 102052348, 'Sayed Enterprise (K.B)', 'Sayed', '1715641768', NULL, 'Karonbazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(983, 1, 6, 1, 13, 25, 102052355, 'Mr Masum (Karwanbazar)', NULL, '1739699260', NULL, 'Karwanbazar', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(984, 1, 6, 1, 13, 25, 102052374, 'Mr Arju (Mirpur11)', NULL, '1676211578', NULL, 'Mirpur11', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(985, 1, 6, 1, 13, 25, 102052377, 'Mr Faruq (Nababgoni Bazzar)', NULL, '1925811918', NULL, 'Nababgoni Bazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(986, 1, 6, 1, 13, 25, 102052378, 'Mr Aminul (Dhalibari Bazar)', NULL, NULL, NULL, 'Dhalibari Bazar', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(987, 1, 6, 1, 13, 25, 102052392, 'Mr Munna(Ibrahimpur)', NULL, '1718332688', NULL, 'Ibrahimpur.kachukhat', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(988, 1, 6, 1, 13, 25, 102052397, 'Abul Khayer (Mirpur-2)', NULL, '1916458166', NULL, 'Mirpur 2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(989, 1, 6, 1, 13, 25, 102052399, 'Imran Kasay(uttara)', NULL, NULL, NULL, 'Uttara Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(990, 1, 6, 1, 13, 25, 102052401, 'Mr.Panna (Motijheel)', 'Panna', '1615706321', NULL, 'Motijheel', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(991, 1, 6, 1, 13, 25, 102052402, 'Mr Faruq (Hemayetpur)', NULL, '1790322804', NULL, 'Hemayetpur', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(992, 1, 6, 1, 13, 25, 102052404, 'Mr Khokon(Utt)', NULL, '1986836244', NULL, 'Uttara', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(993, 1, 6, 1, 13, 25, 102052405, 'Mr Rubel (Dhan)', NULL, NULL, NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(994, 1, 6, 1, 13, 25, 102052406, 'Arfat (Ban)', NULL, '1949653487', NULL, 'Road 11 (Banani)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(995, 1, 6, 1, 13, 25, 102052407, 'Mr Sayed (Chittagong)', NULL, NULL, NULL, 'Chittagong', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(996, 1, 6, 1, 13, 25, 102052410, 'Al Amin (Mirpur10)', NULL, NULL, NULL, 'Mirpur10', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(997, 1, 6, 1, 13, 25, 102052411, 'It Out (Panthopath)', NULL, '1991642848', NULL, 'Panthopath  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(998, 1, 6, 1, 13, 25, 102052412, 'Till Out (Mirpur 60 Feet)', NULL, '1711518492', NULL, 'Mirpur  60 Feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(999, 1, 6, 1, 13, 25, 102052413, 'Enayet (Gulshan)', NULL, '1776456750', NULL, 'DCC Market Gulshan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1000, 1, 6, 1, 13, 25, 102052414, 'Cafe Cherry Drops (Dhanmondi)', NULL, '01623810382  01683655748', NULL, 'H.no35  Ahmed and Kazi tower  Level 5  Road 2 Next to Riffles/Shimant  Dhanmondi R/A  Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1001, 1, 6, 1, 13, 25, 102052416, 'Back Way German Food (Mirpur DOHS)', NULL, '1723406657', NULL, 'R/D  Road 2 House 55 .Mirpur DOSH Chatter', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1002, 1, 6, 1, 13, 25, 102052417, 'Astana Cafe (Gabtoly)', 'Tony', '01685252323  01818014776', NULL, 'Khalek Plaza  Shop- 110', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1003, 1, 6, 1, 13, 25, 102052418, 'Pizza Queen(Mirpur-2)', 'Mr. Atiqur Rahman', '1675186831', NULL, 'Dhaka Commerce Collage Road  Mirpur-2  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1004, 1, 6, 1, 13, 25, 102052419, 'S A Traders(Gul)', NULL, NULL, NULL, 'DCC Market  Gulshan-01', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1005, 1, 6, 1, 13, 25, 102052422, 'EJab Group (Uttara)', NULL, '1991710022', NULL, 'House Building Sector-07  Uttara', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1006, 1, 6, 1, 13, 25, 102052262, 'Easy Delivery (Kuril)', NULL, '1759552926', NULL, '300 Feet Road  Beside ICCB  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1007, 1, 6, 1, 13, 25, 102052264, 'Alif Garden', NULL, NULL, NULL, 'House-24  Road# 01  Nikunja 02  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1008, 1, 6, 1, 13, 25, 102052266, 'Cheese Gallery (Uttara)', 'Mr. Oli', '1775842478', NULL, 'House # 26  Road # 22  Sector # 14  Uttara  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1009, 1, 6, 1, 13, 25, 102052276, 'The Courtyard Bazar (Gulshan- 2)', 'MKr. Labid', '1687876987', NULL, 'Road # 112  House # 21  Gulshan-02', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1010, 1, 6, 1, 13, 25, 102052280, 'The Pizza Box (Ban)', NULL, '1780709189', NULL, '1st Floor   16 Kemal Ataturk Avenue  Beside of Chillox  Dhaka-1213', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1011, 1, 6, 1, 13, 25, 102052281, 'Kindred Cafe Bakery (Abdullahpur)', 'Mr.Asif Adnan', '01827131565/01904440032', NULL, 'House#51 Bamnertak Mainroad  East West Human Resource Gate.Ranvola Bottola AIUBAT University Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1012, 1, 6, 1, 13, 25, 102052302, 'Hard World(Dhan)', NULL, '1956777444', NULL, 'Road#67  G.Hight Satmosjid  Road#', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1013, 1, 6, 1, 13, 25, 102052345, 'Onisha Enterprise', 'Dulal', '1953211565', NULL, 'Mirpur-6', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1014, 1, 6, 1, 13, 25, 102052363, 'Mr  Murad  (Mohammdpur)', NULL, NULL, NULL, 'Mohammdpur', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1015, 1, 6, 1, 13, 25, 102052390, 'Mr Kabir (Mirpur13)', NULL, '1674411403', NULL, 'Mirpur 13. Bazzar', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1016, 1, 6, 1, 13, 25, 102052408, 'Mr. Mostafa (Sukrabad)', NULL, '1717830409', NULL, 'Sukrabad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1017, 1, 6, 1, 13, 25, 102052409, 'Mr Anowar (Sukrabad)', NULL, '1791266224', NULL, 'Sukrabad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1018, 1, 6, 1, 13, 25, 102052420, 'Salim Enterprise(Gul)', 'Mr.Dalim', NULL, NULL, 'DCC Market Shop-11 Gulshan-01', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1019, 1, 6, 1, 13, 25, 102052423, 'Autograph Restaurant(Baily Road)', NULL, '1633002222', NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1020, 1, 6, 1, 13, 25, 102052425, 'BAF Officers Mess', 'Mr. Jabed', '1720678360', NULL, 'Felcon tower  Tejgoan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1021, 1, 6, 1, 13, 25, 102052426, 'Prime Cafe(Uttara)', NULL, '1318534105', NULL, 'House-1 Road-21 Sector-04  Matir Mosjid  Prime Bank cantten  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1022, 1, 6, 1, 13, 25, 102052427, 'Signature Club(Rifle Square)', NULL, '1911234682', NULL, 'Rifle Square New Building  Lift/9 Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1023, 1, 6, 1, 13, 25, 102052428, 'Havelli (Kafrul)', NULL, '1515255229', NULL, '575/3 North Kafrul Cantonment', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1024, 1, 6, 1, 13, 25, 102052431, 'Goolpatar Chouny(Uttara)', NULL, '1673593225', NULL, 'Plot-38 Road-02 Sector-03', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1025, 1, 6, 1, 13, 25, 102052433, 'M.R.T Group(Mirpur-1)', 'Md.Uzzal Islam', '01304472793  01889720882', NULL, 'House-321/7/6 Road-1st Colony  Section-01 Mirpur-1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1026, 1, 6, 1, 13, 25, 102052434, 'Protidin Family Needs(Banasree)', NULL, '1749354740', NULL, 'House-07 Road-04 Block-H  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1027, 1, 6, 1, 13, 25, 102052435, 'Star Cineplex (Raifel Square)', 'Jahangir', '1738238935', NULL, 'Raifel  Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1028, 1, 6, 1, 13, 25, 102052438, 'Eat N Out(Dhanmondi)', NULL, '1614119301', NULL, 'Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1029, 1, 6, 1, 13, 25, 102052441, 'Helal Baniat Store(Dhn)', NULL, NULL, NULL, 'New Market  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1030, 1, 6, 1, 13, 25, 102052443, 'Mr Farhan(Mirpur-1)', NULL, '1680667597', NULL, 'Mazar Road Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1031, 1, 6, 1, 13, 25, 102052444, 'Food Garden(Kallanpur)', NULL, '1724229793', NULL, 'Khalek Pump Supper Sony Counter', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1032, 1, 6, 1, 13, 25, 102052445, 'Maa General Store(Aftab)', NULL, '1951399753', NULL, 'House-02 Block-B Aftab Nagar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1033, 1, 6, 1, 13, 25, 102052446, 'Khana Pina(Tongi)', NULL, '1716696663', NULL, 'Tongi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1034, 1, 6, 1, 13, 25, 102052285, 'Rendi due (Lalmatia)', NULL, '1913988192', NULL, 'Lalmatia Ansar Camp Block#D  House#6/1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1035, 1, 6, 1, 13, 25, 102052307, 'Inista Food (Uttara)', 'Mr. Mohon', NULL, NULL, 'Uttara  Sec#7  House#1 opposide of Kabab factory', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1036, 1, 6, 1, 13, 25, 102052324, 'Southeast Bank', NULL, NULL, NULL, 'Mogbazar Ladis Branch', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1037, 1, 6, 1, 13, 25, 102052346, 'Onisha Enterprise (Mirpur-6)', 'Mr. Dulal', '1953211565', NULL, 'Mirpur 6', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1038, 1, 6, 1, 13, 25, 102052353, 'TK Milan (Donia)', 'Tarik Hasan', '1790121681', NULL, '430 nayapara Dania Dhaka 1236', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1039, 1, 6, 1, 13, 25, 102052366, 'Shojib (Bijoyshrni)', NULL, NULL, NULL, 'Bijoyshrni', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1040, 1, 6, 1, 13, 25, 102052370, 'Mr Monir (Hemayet Pur)', NULL, NULL, NULL, 'Hemayet Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1041, 1, 6, 1, 13, 25, 102052373, 'Sujn (Hemayet Pur)', NULL, NULL, NULL, 'Hemayet Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1042, 1, 6, 1, 13, 25, 102052379, 'Kamal  (Taltola Chorasta)', NULL, '1977752717', NULL, 'Taltola Chorasta', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1043, 1, 6, 1, 13, 25, 102052391, 'Chill Out Ltd (Mirpur60 Feet)', NULL, '01711285082/01742509509', NULL, '241/1Ground Floor .South Pirerbagh.Mirpur 60 Feet Rood  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1044, 1, 6, 1, 13, 25, 102052400, 'Mad Cheef (Chittagong)', NULL, NULL, NULL, 'Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1045, 1, 6, 1, 13, 25, 102052403, 'Preetom Burger (Bashundhara)', NULL, '1737191252', NULL, 'Rajbari Food Court  Plot 100  Road 2  Block A  Bashundhara R/A Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1046, 1, 6, 1, 13, 25, 102052415, 'Poopies (Khilgoan)', NULL, '1908672740', NULL, 'Khilgoan', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1047, 1, 6, 1, 13, 25, 102052421, 'Muniba Traders(Gul)', NULL, NULL, NULL, 'House-16 Road-10 Flat-(NW-2)  Gulshan-01', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1048, 1, 6, 1, 13, 25, 102052424, 'M R Corner(Gul)', NULL, NULL, NULL, 'DCC Market Gulshan-01', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1049, 1, 6, 1, 13, 25, 102052429, 'Street Oven(Dhanmondi)', NULL, '1671182292', NULL, 'House-38  Road-9/A', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1050, 1, 6, 1, 13, 25, 102052430, 'M R Enterprise(Shanti Nagar)', 'Mr.Motiur Rahman', '1818251139', NULL, 'Shanti Nagar Kaca Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1051, 1, 6, 1, 13, 25, 102052436, 'Chillox(Uttara)', NULL, NULL, NULL, 'Uttara  Beside of KFC', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1052, 1, 6, 1, 13, 25, 102052437, 'Reza Enterprise(DCC)', NULL, '1977515155', NULL, 'DCC Market  Gulshan-01', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1053, 1, 6, 1, 13, 25, 102052440, 'Hirazeel Restaurant (Motijheel)', NULL, '1917716611', NULL, 'Motijeel Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1054, 1, 6, 1, 13, 25, 102052447, 'Al Khairia Cafe & Restaurant(Rampura)', NULL, '1711970544', NULL, '6/EF West Rampura DIT Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1055, 1, 6, 1, 13, 25, 102052448, 'Pizza House(Hatirpul)', NULL, '1991144231', NULL, 'Hatirpul', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1056, 1, 6, 1, 13, 25, 102052449, 'Indian Spicy (Mohammadpur)', 'Mehdi', '1686399484', NULL, 'Tazmohol Road Md.Pur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1057, 1, 6, 1, 13, 25, 102052450, 'Kids Funville(Mohammadpur)', NULL, '1819212939', NULL, 'Tokyo Square(9th Floor)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1058, 1, 6, 1, 13, 25, 102052451, 'TR Mehfil Restaurant(Utt)', NULL, '168,009,914,501,643,000,000', NULL, 'Atiq Tower93rd Floor) 67/B Rabindro Sharoni Road  Uttara Dhaka-1230', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1059, 1, 6, 1, 13, 25, 102052452, 'Ambroasia(Baily Road)', NULL, NULL, NULL, 'Baily Road Beside of KFC', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1060, 1, 6, 1, 13, 25, 102052453, 'Mokbul Store (New Market)', NULL, '1978615528', NULL, 'Shop No 31 New Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1061, 1, 6, 1, 13, 25, 102052454, 'Burger Licious Store (Wari)', NULL, '1885566393', NULL, '29 Rose Belly Shopping Mall  Gulistan Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1062, 1, 6, 1, 13, 25, 102052455, 'PizzaBurg (Dhanmondi)', NULL, '01705-219509', NULL, 'Star Kabab(1st floor) Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1063, 1, 6, 1, 13, 25, 102052458, 'Cafe 5 (Elephant Road)', NULL, '1613033233', NULL, '156  Elephant Road Hatirpool More', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1064, 1, 6, 1, 13, 25, 102052459, 'Long Beach Suites Dhaka', NULL, '1966004918', NULL, '4g  Winter Garden Road-104  Gulshan-02', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1065, 1, 6, 1, 13, 25, 102052460, 'Supreem Dinner(Mirpur-06)', NULL, NULL, NULL, 'Mirpur-06 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1066, 1, 6, 1, 13, 25, 102052461, 'Grace 21 Smart Hotel (Nikunja 2)', NULL, '1700707733', NULL, 'Road No 21.House No 1&3 Khilket Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1067, 1, 6, 1, 13, 25, 102052292, 'Biker Cafe & Resturant (Wari)', NULL, '1914624742', NULL, 'Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1068, 1, 6, 1, 13, 25, 102052304, 'Showrma House (Uttara)', NULL, NULL, NULL, 'Uttara  Sector-12   Moylar More', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1069, 1, 6, 1, 13, 25, 102052329, 'Chocolate Carnivall (Zigatola)', NULL, '1851576779', NULL, 'Chillox Building 1st floor Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1070, 1, 6, 1, 13, 25, 102052456, 'PizzaBurg (Uttara)', NULL, '01870-832155', NULL, 'plot No  41 Gareeb-e-Nawaz Ave  Dhaka:1230 1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1071, 1, 6, 1, 13, 25, 102052457, 'PizzaBurg (Mirpur-2)', NULL, '01908-327868', NULL, 'Avenue Road Section:2   Block: A  Avenue:1   House: 12/1  Dhaka-1216', 550000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1072, 1, 6, 1, 13, 25, 102052462, 'Kabir Corporation(Gul)', NULL, '1951407513', NULL, 'DCC Market', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1073, 1, 6, 1, 13, 25, 102052463, 'Shonjoy Meet (Gulshan 1 D C C Market)', NULL, '1733015288', NULL, 'Gulshan 1 D C C Market', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1074, 1, 6, 1, 13, 25, 102052464, 'Kashay Mojibor (Utt)', NULL, '1757168812', NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1075, 1, 6, 1, 13, 25, 102052465, 'Mr Masum Billa  (Gandaria)', NULL, '1977245524', NULL, 'Gandariya', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1076, 1, 6, 1, 13, 25, 102052466, 'Cafe Milano (Banani)', NULL, '1771030408', NULL, 'Road-11 Nandos Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1077, 1, 6, 1, 13, 25, 102052467, 'Indian Spicy Chicken(Badda)', NULL, '1305640422', NULL, 'Beside of Cambrian College', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1078, 1, 6, 1, 13, 25, 102052468, 'Banga Bakers Ltd.', 'Supply Chain Manager  Mr. Sohel Rana', '1704133757', NULL, 'Head Office: PRAN-RFL Center  105  Middle Badda  Dhaka-1212', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1079, 1, 6, 1, 13, 25, 102052469, 'Club Mix (Mohammadpur)', NULL, '1752523374', NULL, 'Block C.Tajzmohol Road. Mohammdpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1080, 1, 6, 1, 13, 25, 102052471, 'Ambrosia (Dhanmondi)', 'Asif', '1712630715', NULL, 'Road  #19  .House#170 . 19# Starkababer Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1081, 1, 6, 1, 13, 25, 102052472, 'Cafe Indipendence(Tongi)', 'Mr Tajul', '1638060793', NULL, 'Tongi College Gate', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1082, 1, 6, 1, 13, 25, 102052473, 'Smoks Man (Banani)', NULL, NULL, NULL, 'House#82. Road #5 .Block #F.Infront Of Banani Model School', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1083, 1, 6, 1, 13, 25, 102052474, 'Babuland(Uttara)', NULL, '1724492243', NULL, 'House Building Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1084, 1, 6, 1, 13, 25, 102052475, 'Street Oven (Bashundhara)', NULL, '1313025905', NULL, 'Ka-9/A The Kings Food Court Shop-06  Bashundhara Main Gate', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1085, 1, 6, 1, 13, 25, 102052477, 'Mr Khaled (Fridpur)', NULL, NULL, NULL, 'Fridpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1086, 1, 6, 1, 13, 25, 102052478, 'M/S Tofazzal Tadars (Mirpur 1)', NULL, '1712159034', NULL, 'College Market.Mazar Road', 0.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1087, 1, 6, 1, 13, 25, 102052479, 'M/S Tofazzal Tadars (Mirpur 1)', NULL, '1712159034', NULL, 'College Market . Mazar Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1088, 1, 6, 1, 13, 25, 102052481, 'Pasta Hut (Baily road)', NULL, '1625461293', NULL, 'Baliroad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1089, 1, 6, 1, 13, 25, 102052482, 'Club Lovello Cafe (Banani)', NULL, '1841102415', NULL, 'Banani 11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1090, 1, 6, 1, 13, 25, 102052483, 'Ashraful Entarprise (JFP)', 'Mr. Shimul', '1912042799', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1091, 1, 6, 1, 13, 25, 102052484, 'Legent Finest(Uttara)', NULL, NULL, NULL, 'House-49 Road-02 Sector-05', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1092, 1, 6, 1, 13, 25, 102052485, 'Mr.Deloar(Police Plaza)', NULL, '1977994141', NULL, 'Police Plaza Concord', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1093, 1, 6, 1, 13, 25, 102052486, 'Noor Trade(Badda)', NULL, '1678662463', NULL, 'Ka-224/1 Kuril Scool Kuril Badda', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1094, 1, 6, 1, 13, 25, 102052488, 'Cheez & Beanz (Mohammdpur)', NULL, '1711171226', NULL, '15/6 Block C Tajmo Road.Mohammdpur Dhaka 1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1095, 1, 6, 1, 13, 25, 102052303, 'Cafe Dine Part(Mugbajar)', NULL, '1744316100', NULL, 'Mugbajar#Eskaton', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1096, 1, 6, 1, 13, 25, 102052306, 'M/S Tahsin Enterprise(Mohammadpur)', 'Md.Zakir Hosain', '1732171519', NULL, 'Twon Hall super market  134/149 no shpo  Muhammadpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1097, 1, 6, 1, 13, 25, 102052395, 'Mr Jubayer (Pakistanmat)', NULL, NULL, NULL, 'Pakistanmat', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1098, 1, 6, 1, 13, 25, 102052432, 'Peri Pasta(Mirpur-1)', NULL, NULL, NULL, 'Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1099, 1, 6, 1, 13, 25, 102052439, 'Pran Frozen Food', 'Mr.Mahmud', '1704132898', NULL, 'PRAN Industrial Park  Ghorashal Polash', 800000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1100, 1, 6, 1, 13, 25, 102052476, 'BigBang (Zigatola)', NULL, '1754909190', NULL, '32/4 Sher e Bangla Road  Zigatola Hazaribagh', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1101, 1, 6, 1, 13, 25, 102052480, 'Take Out (Tejgaon)', NULL, '1847227193', NULL, 'Tejgao Opposite Shanta Taowar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1102, 1, 6, 1, 13, 25, 102052487, 'Q R S (N.Ganj)', NULL, '1979796464', NULL, '16/1 Folpotti  Narayanganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1103, 1, 6, 1, 13, 25, 102052489, 'Taste bud (Banani)', NULL, '1773169402', NULL, 'House#52.Road #12 A .Block H Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1104, 1, 6, 1, 13, 25, 102052490, 'Gurmat Food Company (Gulshan 2)', 'Mr Sahin', '1720627286', NULL, 'Sahajad Pur. K 5/1 Gulshan 2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1105, 1, 6, 1, 13, 25, 102052491, 'R K Trade International (Jatrabari)', NULL, '1788889420', NULL, 'Jatrabari Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1106, 1, 6, 1, 13, 25, 102052492, 'Dawn Town (Basundhara)', NULL, '1799544446', NULL, 'Ka 11/ 2A Haveily Center Level 3.Basundhara Main Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1107, 1, 6, 1, 13, 25, 102052493, 'Moms Best Hommet Pizza (Khilgao)', NULL, '1687810996', NULL, '446/C Nurjahan Road House No-1.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1108, 1, 6, 1, 13, 25, 102052494, 'California Fried Chicken  (Dhanmondi 27)', 'Mr Monem  Rashid', '1992043903', NULL, 'Road  #27  .Dhanmondi  opposite Rappa Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1109, 1, 6, 1, 13, 25, 102052495, 'Colino s Restaurant& Cafe (Uttara)', 'Sumon', '1784666777', NULL, 'House #22 .Road #15 .Sector #14 .Uttara Dhaka 1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1110, 1, 6, 1, 13, 25, 102052496, 'Shop-08(Baridhara)', NULL, NULL, NULL, 'Shop-08 House # 02  Block # A  Basundhara R/A  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1111, 1, 6, 1, 13, 25, 102052497, 'Mak  Pizza& Cafe (Hazaribug)', NULL, '1734607547', NULL, '1/4 A  Soroj Mansion .Tali Office Mor Rayer Bazzar Near Shikdar Madical .Hazaribug Dhaka 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1112, 1, 6, 1, 13, 25, 102052498, 'Bhoother  Adda (Shoniakhra)', NULL, '1621712029', NULL, 'House #445 .Jannat Tower 2nd Floor.Shoniakhra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1113, 1, 6, 1, 13, 25, 102052500, 'Talukdar Trading', NULL, '1677855247', NULL, 'Mirpur- 14', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1114, 1, 6, 1, 13, 25, 102052501, 'Meal In The Car(Uttara)', NULL, '1308626882', NULL, 'Road-12 Sector-13 Garib A Nawaz Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1115, 1, 6, 1, 13, 25, 102052503, 'Bojra Restaurant (Dhanmondi)', NULL, '1627810970', NULL, 'Shekh Russel Island Dhanmondi  Dhaka-1205', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1116, 1, 6, 1, 13, 25, 102052505, 'Chicken King( Uttar Badda)', NULL, '1789580157', NULL, 'Uttar Badda Main Road  Badda  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1117, 1, 6, 1, 13, 25, 102052506, 'Dingi Restaurant (Dhanmondi Lake)', 'Akib', '1845753349', NULL, 'Dhanmondi Lake Road ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1118, 1, 6, 1, 13, 25, 102052510, 'Burger Box (Rampura Bazar)', NULL, '1952830278', NULL, 'West  Hazi Para Rampura Bazar.Janata Bank& Walton Palazza.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1119, 1, 6, 1, 13, 25, 102052511, 'Pizza Lavita (Police Plaza)', NULL, '1721747439', NULL, 'Concord Shopping Complex Level 4.Food Court Shop No 546.Near Gulshan 1 Shoting club', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1120, 1, 6, 1, 13, 25, 102052512, 'Formuza (B.City)', NULL, '1796896547', NULL, 'Bashundhara City  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1121, 1, 6, 1, 13, 25, 102052513, 'Mr Altaf(Baily Road)', NULL, '1735719460', NULL, 'Baily Road Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1122, 1, 6, 1, 13, 25, 102052514, 'Igloo(Mohin Uddin)', 'Mohin Uddin', NULL, NULL, NULL, 600000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1123, 1, 6, 1, 13, 25, 102052515, 'Kolpo Foods (Uttara)', NULL, '1738950447', NULL, 'Sector 12 Road 17 B.Khalpar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1124, 1, 6, 1, 13, 25, 102052357, 'Kamal  (Karwanbazar)', NULL, '1981119923', NULL, 'Karwanbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1125, 1, 6, 1, 13, 25, 102052359, 'Mr Shopon (Badda)', NULL, NULL, NULL, 'Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1126, 1, 6, 1, 13, 25, 102052361, 'Humayun Gosto Bitan(Mirpur1)', NULL, '1924859072', NULL, 'Mirpur1.Sehali Suppar Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1127, 1, 6, 1, 13, 25, 102052375, 'Billal Gosto Bitan(Mirpur13)', NULL, '1615004942', NULL, 'Kasabazar Mosjid Market(Mirpur 13)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1128, 1, 6, 1, 13, 25, 102052380, 'Bhoother Bari (Zinzira)', NULL, '1777481913', NULL, '1 No Howle Bus Road.Zinzira Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1129, 1, 6, 1, 13, 25, 102052387, 'Usuf (Newmarket)', NULL, NULL, NULL, 'New Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1130, 1, 6, 1, 13, 25, 102052398, 'Ruhul Amin (Gulshan1)', NULL, '1861589986', NULL, 'Gulshan 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1131, 1, 6, 1, 13, 25, 102052442, 'Noof Mini Supper Shop', NULL, '1715863579', NULL, 'Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1132, 1, 6, 1, 13, 25, 102052499, 'BD Bites(Baridhara)', NULL, '1777477047', NULL, 'Shop-05(2nd floor) House-100 Road-02  Block-A Bashundhara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1133, 1, 6, 1, 13, 25, 102052502, 'Talukdar Trading (Kochukhet)', NULL, '1677855247', NULL, 'Kochukhat Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1134, 1, 6, 1, 13, 25, 102052507, 'Shampan (Dhanmondi 27)', 'Akib', '1845753349', NULL, 'Sector 1  Road No. 27 (Old)  Near The Lake End Restaurant  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1135, 1, 6, 1, 13, 25, 102052509, 'Operose (Mirpur 12)', NULL, '1977628300', NULL, 'D O H  S  Mirpur 12.Near Ria s Recepi', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1136, 1, 6, 1, 13, 25, 102052516, 'Igloo (Salam)', NULL, '1922523591', NULL, 'Karwanbazar', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1137, 1, 6, 1, 13, 25, 102052517, 'Igloo(Alomgir)', NULL, NULL, NULL, 'Dhanmondi', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1138, 1, 6, 1, 13, 25, 102052519, 'Mr Nizam', NULL, NULL, NULL, 'Dhanmondi', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1139, 1, 6, 1, 13, 25, 102052520, 'Dhaka Pizza (Mirpur 1)', NULL, NULL, NULL, 'Block E .Road No A V E 3.House No 16 .Mirpur 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1140, 1, 6, 1, 13, 25, 102052521, 'Chick N Roll (Mohammadpur)', NULL, NULL, NULL, 'Md.Pur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1141, 1, 6, 1, 13, 25, 102052523, 'Shawarma House (Mirpur-11)', NULL, '1759394933', NULL, 'House #15 Road 1.Mirpur 11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1142, 1, 6, 1, 13, 25, 102052526, 'Take Out  (Moggbazar)', NULL, '1847227196', NULL, 'Punak Complex Lift No 1.26/A Captain Monsur Ali Soroni.  Ramna  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1143, 1, 6, 1, 13, 25, 102052528, 'Burger Express (Baily Road)', NULL, '1920979755', NULL, 'Shawrma House Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1144, 1, 6, 1, 13, 25, 102052530, '3 Food (Khulna)', NULL, '1912315916', NULL, 'Mirpur 14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1145, 1, 6, 1, 13, 25, 102052531, 'Food Nest (Mirpur14)', NULL, '1727515271', NULL, 'Mirpur  14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1146, 1, 6, 1, 13, 25, 102052532, 'Burgerology(Bashundhara)', NULL, '1730715323', NULL, 'Ka-7/2  2nd Floor  Bashundhara road  Dhaka-1229', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1147, 1, 6, 1, 13, 25, 102052533, 'Mexican Hot Subway (Jamalpur)', NULL, '1714637511', NULL, 'Pach Rastar More.Sardarpara Jamalpur 2000', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1148, 1, 6, 1, 13, 25, 102052536, 'RV FFC (Dayaganj)', NULL, '1811235653', NULL, '84/Shamibag Shokti Oshodaloy market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1149, 1, 6, 1, 13, 25, 102052537, 'NAVANA FOODS LIMITED (Tejgaon)', NULL, '1929988728', NULL, '220  KUNI PARA  TEJGOAN I/A', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1150, 1, 6, 1, 13, 25, 102052538, 'Bashoman Resturant (Purbachal)', NULL, '01310865365 /01941111333', NULL, 'Purbachal', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1151, 1, 6, 1, 13, 25, 102052540, 'Haritaj Cafe (Raifel Square)', NULL, '1716570236', NULL, 'Raifel Square)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1152, 1, 6, 1, 13, 25, 102052541, 'Cafe Dream (Motijheel)', NULL, '1855459088', NULL, 'Baaaaitul Mamur Jame Mosjid Market.A B C Colony Hospital  Zone Motijheel Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1153, 1, 6, 1, 13, 25, 102052545, 'Monir Kitchen(Mirpur)', NULL, NULL, NULL, 'D O H S  Mirpur', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1154, 1, 6, 1, 13, 25, 102052546, 'Bismillah Enterprise(Ctg)', 'Mr. Azad', '1701664077', NULL, 'CRB ( 7 raster more)  Kotowali', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1155, 1, 6, 1, 13, 25, 102052547, 'Food Lab (Khulna)', NULL, '1712797386', NULL, '102 Sir  Iqbal Road. Khulna', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1156, 1, 6, 1, 13, 25, 102052548, 'Mejbani Khana (Mohammadpur)', 'Md. Ariful Islam', '1816590008', NULL, '18/5  Block-F  ring Road  Tikka para  Mohammadpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1157, 1, 6, 1, 13, 25, 102052549, 'Mukbul (Newmarket)', NULL, NULL, NULL, 'Newmarket', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1158, 1, 6, 1, 13, 25, 102052358, 'Jill Mill (Pollice Pallaza)', NULL, '1956156357', NULL, 'Near (Pollice Pallaza)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1159, 1, 6, 1, 13, 25, 102052360, 'Ballal Gosto Bitan (Mirpur13)', NULL, '1615004942', NULL, 'Mirpur 13 Bazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1160, 1, 6, 1, 13, 25, 102052382, 'Ria s Recipes (Park Foodiez)', NULL, '1921867947', NULL, 'Mirpur 12.DOHS Get', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1161, 1, 6, 1, 13, 25, 102052388, 'Jhir Gosto Bitan (Utt)', NULL, '1780350603', NULL, 'Dholi Para.Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1162, 1, 6, 1, 13, 25, 102052470, 'Taco Shop(Uttara)', NULL, NULL, NULL, 'Shopno Building Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1163, 1, 6, 1, 13, 25, 102052518, 'Mr. Gopinath', NULL, '1620347272', NULL, 'Tejgaon  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1164, 1, 6, 1, 13, 25, 102052527, 'Food Ista (Police Plaza)', NULL, '1904599544', NULL, 'Police Plaza .Shop No 47', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1165, 1, 6, 1, 13, 25, 102052529, 'Md Nahiyan', NULL, NULL, NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1166, 1, 6, 1, 13, 25, 102052534, 'Street Oven (Simanto Square)', NULL, '1313025905', NULL, 'Simanto Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1167, 1, 6, 1, 13, 25, 102052535, 'Igloo(Hasan)', NULL, NULL, NULL, NULL, 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1168, 1, 6, 1, 13, 25, 102052539, '27 Nombor (Dhanmondi)', NULL, '1315051955', NULL, 'House 352/A (19 new)  Street 27 (16 new  Dhaka 1209', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1169, 1, 6, 1, 13, 25, 102052543, 'Hungry Guest (Mirpur10)', 'Shahadat', '01318314253/01966462879', NULL, 'Beside Cricket Stadium 5 No Gate. Swimming Pool Kathbadam', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1170, 1, 6, 1, 13, 25, 102052544, 'Muslim Store (Kaptan Bazar)', NULL, '1673583857', NULL, 'Kaptan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1171, 1, 6, 1, 13, 25, 102052550, 'Shikdar Food Island (Mirpur 60 Feet)', NULL, '1511005904', NULL, 'Mirpur 60 Feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1172, 1, 6, 1, 13, 25, 102052551, 'Kawan Bangla Agro Ltd.', 'Shaikh Hasan', '1755049155', NULL, 'Police Fari  Sayedabad  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1173, 1, 6, 1, 13, 25, 102052555, 'Smark Subway (Mirpur-60 Feet)', 'Shohel Mia', '1635089885', NULL, '60 Feet  Barek Molla more  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1174, 1, 6, 1, 13, 25, 102052557, 'Street Oven(Baily Road)', NULL, '1927246008', NULL, '02 Green Cozy Cot(1st Floor)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1175, 1, 6, 1, 13, 25, 102052558, 'Eat House(R.Square)', NULL, '1700690384', NULL, 'Beside of Rifle Square', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1176, 1, 6, 1, 13, 25, 102052560, 'Bagha Club (Gulshan2)', NULL, '1.89E+11', NULL, 'Road #44.House #17 .B', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1177, 1, 6, 1, 13, 25, 102052561, 'Smokes Restaurant (Gulshan)', NULL, '1985387275', NULL, 'Crystal  Place Level 2.Gulshan 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1178, 1, 6, 1, 13, 25, 102052565, 'Organic Juice Bar (Eastern Plaza)', NULL, '01611544577  01302694625', NULL, 'Eastern plaza  Hatirpool  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1179, 1, 6, 1, 13, 25, 102052566, 'Mashawi  Restaurant (Banasree)', 'Azhar', '1515636602', NULL, 'Block #C Road #5.House 39 Banasree Rampura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1180, 1, 6, 1, 13, 25, 102052568, 'Lingkon', NULL, '1762721990', NULL, NULL, 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1181, 1, 6, 1, 13, 25, 102052572, 'Mr Masud', NULL, '1766650540', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1182, 1, 6, 1, 13, 25, 102052574, 'Mr Rokon (Hemayetpur Savar)', NULL, '1995052102', NULL, 'Hemayetpur Savar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1183, 1, 6, 1, 13, 25, 102052575, 'Shawarma Damasco(Mirpur-6)', NULL, '1711357085', NULL, 'Mirpur-6  Beside Al-Fuad Community Center', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1184, 1, 6, 1, 13, 25, 102052576, 'Pasta Club (Lalbagh Kellah Gate)', NULL, '01616441614 /01674037362', NULL, 'Level #3 Road  E #50 Lalbagh Kellah Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1185, 1, 6, 1, 13, 25, 102052580, 'Gausia Enterprise(Uttara)', 'Abdullah Al Mamun', '1910356732', NULL, 'Beside Ahaliya Field  Sector-14  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1186, 1, 6, 1, 13, 25, 102052583, 'Usuf Store (Karwanbazar)', NULL, '1735967826', NULL, 'Karwanbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1187, 1, 6, 1, 13, 25, 102052586, 'Cafe Crush (Badda Gudaraghat)', NULL, '1674227136', NULL, 'Badda Gudaraghat', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1188, 1, 6, 1, 13, 25, 102052504, 'Mr. Nasir', 'Nasir uddin', NULL, NULL, 'Jurain Bazar  Jurain  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1189, 1, 6, 1, 13, 25, 102052522, 'Bengal Beans Bangladesh (Gulshan 2)', NULL, '1819273248', NULL, 'Bangladesh Plot#11/A Road#117 .Gulshan 2.Dhaka 1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1190, 1, 6, 1, 13, 25, 102052542, 'Quick Bite (Dhanmondi)', 'Md Alamin Khan', '1923587623', NULL, 'Shimanto Shamvar Market .9 Flowr', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1191, 1, 6, 1, 13, 25, 102052559, 'Chillox (chittagong )', NULL, '1638036014', NULL, 'Chittagong .Nasirabad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1192, 1, 6, 1, 13, 25, 102052562, 'Crackshake Dhanmondi', 'Mr Rubel', '1985630397', NULL, 'Dhanmondi  Garlic Ginjar Building  Road # 11/A  Level # 10', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1193, 1, 6, 1, 13, 25, 102052570, 'Mr Nurul Islam (Kamranggirchar)', NULL, NULL, NULL, 'Kamranggirchar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1194, 1, 6, 1, 13, 25, 102052578, 'Mr Ruhul Amin (Mohammad Pur)', NULL, '1712936801', NULL, 'Bosila Bridge Mohammad pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1195, 1, 6, 1, 13, 25, 102052582, 'Camden Town (Mirpur-60 Feet)', NULL, '1307171001', NULL, '60 Fit Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1196, 1, 6, 1, 13, 25, 102052587, 'NR Restaurant-Uttara', 'Mr. Nurul Alam', '1712755193', NULL, '4A  Road-5  Sector-4  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1197, 1, 6, 1, 13, 25, 102052589, 'Chicken King  utt badda', NULL, NULL, NULL, 'Thana road  Utt Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1198, 1, 6, 1, 13, 25, 102052593, 'Cafe Zodiac Uttara', 'Humayun Iqbal (Owner)', '1714113665', NULL, 'H # 40  R # 13  Sector # 4  Uttara Model Town  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1199, 1, 6, 1, 13, 25, 102052595, 'Prince Burger (Lalbag)', NULL, '1815931526', NULL, 'Dhakeswari Mondir  Lalbag  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1200, 1, 6, 1, 13, 25, 102052596, 'Mimi  Varieties Store (Jatrabari)', NULL, '01819485643/01711007295', NULL, '82/A Haji Younus  Market Chowrasta Dhaka 1204', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1201, 1, 6, 1, 13, 25, 102052598, 'Event - Nur Hasna Suchana (Dhanmondi)', 'Nur Hasna Suchana', '1684054451', NULL, 'Deffodil group  Dhanmondi 32  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1202, 1, 6, 1, 13, 25, 102052599, 'The Pabulum (Mirpur-2)', NULL, '1784887544', NULL, 'Plot-23 Block-K Section-02 Singapur Hotel Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1203, 1, 6, 1, 13, 25, 102052600, 'Tremo Coffee Shop(Mowlubi Bazar)', NULL, '1617153200', NULL, 'Mowlubi Bazar', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1204, 1, 6, 1, 13, 25, 102052601, 'Street Oven(Mirpur DOHS)', NULL, '1671182292', NULL, 'Shoping Complex  Shop No# 19.Level 8', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1205, 1, 6, 1, 13, 25, 102052602, 'Dr Farhana Rouf (Mirpur 6)', NULL, '1913520423', NULL, 'Road #8 House #6 Block #6 Mirpur #6', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1206, 1, 6, 1, 13, 25, 102052604, 'Hang Out (Dhokhin Banasree)', NULL, '1832791585', NULL, 'Dhokhin Banasree .Near 10 Tala Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1207, 1, 6, 1, 13, 25, 102052606, 'S.M. Enterprise', 'M. Shamser Ali Khan (Shamim)', '1912021206', NULL, 'DCC Market  Gulshan-1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1208, 1, 6, 1, 13, 25, 102052607, 'Fry  King (Bcity)', NULL, '1726908996', NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1209, 1, 6, 1, 13, 25, 102052611, 'Mr Azad (B.City)', NULL, NULL, NULL, 'Bashundhara City  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1210, 1, 6, 1, 13, 25, 102052613, 'Momota Enterprise (Mohakhali Wirless Gate)', 'Ibrahims', '1854080460', NULL, 'Mohakhali Wirless Gate Road 131', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1211, 1, 6, 1, 13, 25, 102052614, 'Luminous Pizza (Gopalgonj)', 'Mr. Nazmul Islam', '1670388110', NULL, 'Gopalgoni', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1212, 1, 6, 1, 13, 25, 102052620, 'Helvatia (Uttara)', NULL, '181926068', NULL, 'House #12 Road #19  2nd Floor  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1213, 1, 6, 1, 13, 25, 102052625, 'Eit & Enjoy', '1759732283', NULL, NULL, '695/1 Block-c  khilgoan', 5000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1214, 1, 6, 1, 13, 25, 102052627, 'Aash Cafe (Uttara)', NULL, '1921814526', NULL, 'Uttara Near Kabab Factory', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1215, 1, 6, 1, 13, 25, 102052508, 'Mim General (Gulshan 1)', NULL, '1724529257', NULL, 'Gulshan 1 .D C C Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1216, 1, 6, 1, 13, 25, 102052524, 'Tanjil Enterprise (New Market)', 'Mr. Mannan', '1786349990', NULL, 'Shop-55 New Market Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1217, 1, 6, 1, 13, 25, 102052585, 'Savva (Gulshan 2)', NULL, '1712070427', NULL, 'House #3/A Road #49  Level  #14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1218, 1, 6, 1, 13, 25, 102052605, 'Food Club(Rampura)', NULL, '1719563506', NULL, '464/H  Islam Tower Rampura  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1219, 1, 6, 1, 13, 25, 102052610, 'Chaper Shohor(Uttara)', NULL, '1711905520', NULL, 'Prem Bagan More Dokkhinkhan', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1220, 1, 6, 1, 13, 25, 102052615, 'Mobarak Enterprise (N.ganj)', 'Arifur Rahman', '1711229463', NULL, 'B.B Road  Chasara (Beside Railgate)  Narayongonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1221, 1, 6, 1, 13, 25, 102052617, 'Habibys (Tejgaon)', NULL, '1404250965', NULL, 'Tejgaon Near Shanta Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1222, 1, 6, 1, 13, 25, 102052628, 'Bismillah Enterprise(Basabo)', 'Md Abdul Halim', '1631511941', NULL, '1/1  Boddho Mondir Road  Basabo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1223, 1, 6, 1, 13, 25, 102052630, 'Daily Shopping (Pran Group)', 'MD Abdul Alim', '1704140883', NULL, '105 Middel Badda Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1224, 1, 6, 1, 13, 25, 102052631, 'Sichuan  Garden (Wari)', 'Riyaj', '1686998462', NULL, '1/1 Rankin Street Dhaka Wari .Near Arong Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1225, 1, 6, 1, 13, 25, 102052632, 'The Pabulum (Mohammadpur)', NULL, '1737947286', NULL, 'Tajmohol Road  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1226, 1, 6, 1, 13, 25, 102052633, 'Gass Onion(Rifle Square)', NULL, '1671491101', NULL, 'Shimanto Shomvar(9th floor)', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1227, 1, 6, 1, 13, 25, 102052636, 'Chit Chat (N.Ganj)', 'Foyez Ahammed', '1882861352', NULL, '2\\1 New Chashara  Hazi Abdur Rahman Road Jam tola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1228, 1, 6, 1, 13, 25, 102052639, 'Chefs Cusine (Uttara)', NULL, '1305853660', NULL, 'Garib E Newaz Avenue .Uttara Showpno Building 4th Floor House 27  Sector 11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1229, 1, 6, 1, 13, 25, 102052640, 'R-Bite(Banasree)', NULL, '1762509066', NULL, 'House-31 Road-01 Block-F  Banasree', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1230, 1, 6, 1, 13, 25, 102052642, 'Farmhouse Burger (Gulshan 1)', NULL, '1755693712', NULL, '23 Gulshan 1 Avenue Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1231, 1, 6, 4, 13, 25, 102052643, '138 East (Gulshan 1)', NULL, '1622664045', NULL, 'Road #138  House #10 Gulshan 1', 100000.00, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 15:53:29'),
(1232, 1, 6, 1, 13, 25, 102052645, 'Captain s Cafe (Taltola)', NULL, '01309989644/01954040842', NULL, 'Road # Sohid Baki  Near Bhoother Adda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1233, 1, 6, 1, 13, 25, 102052648, 'Cafe AB (Mirpur DOHS)', 'Azad', '1964111777', NULL, 'Mirpur DOHS  34-49 Park Foodies  Food Court', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1234, 1, 6, 1, 13, 25, 102052649, 'Burger Attack 1 (Middle Badda)', 'Mr. Ashraful', '1830181670', NULL, 'Ta 17/A  Badda High School road  Badda  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1235, 1, 6, 1, 13, 25, 102052651, 'Chai Pai Yummi Restaurant (nikunjo)', 'Mr. Ashraful', '1720321187', NULL, 'Khilkhat Bazar HaziSalam Manshoin(2nd floor)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1236, 1, 6, 1, 13, 25, 102052655, 'Indian Hundy (B.city)', NULL, '1672000005', NULL, 'Bosundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1237, 1, 6, 1, 13, 25, 102052656, 'Brutown Cafe (Siddeswari)', 'Mr. Rajib', '01673003588  01722219531', NULL, '62/A Siddeswari Road Safa Apartment  Near Monowara Hospital  Siddeswari. 01772-992551', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1238, 1, 6, 1, 13, 25, 102052658, 'The Buffet King (Bashundhara)', NULL, '1610203030', NULL, 'Bashundhara R\\A Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1239, 1, 6, 1, 13, 25, 102052661, 'Petuk Burger (Banasree)', 'Shuvo', '1767832006', NULL, 'Road #3  Block #H House #19', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1240, 1, 6, 1, 13, 25, 102052663, 'Candel Light Cafe (Taltola)', NULL, '1614972743', NULL, 'Taltola Near Bunkars', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1241, 1, 6, 1, 13, 25, 102052664, 'Imlii Restaurant (Wari)', NULL, '1736577078', NULL, 'Beside of Rajdhani Super Market. Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1242, 1, 6, 1, 13, 25, 102052666, 'Italiyan Pizza & Cafe (Shahajatpur)', NULL, '1766681190', NULL, 'Shahajatpur Near Camriyan Colllage', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1243, 1, 6, 1, 13, 25, 102052667, 'Glass Onion (Shimanto Shamver)', 'Jhon', '1755513043', NULL, 'Shimanto Shamver  level 9. glass onion', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1244, 1, 6, 1, 13, 25, 102052668, 'Yum Taste(Mirpur-60 Feet)', 'Ziaur Rahman', '1305608462', NULL, '264\\4\\A  Middle pirerbag  Pabna goli kamal shoroni road 60 feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1245, 1, 6, 1, 13, 25, 102052525, 'Prince(Safe N Fresh)', NULL, NULL, NULL, 'Safe N Fresh', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1246, 1, 6, 1, 13, 25, 102052554, 'Star Ice Parlar (Banasree)', 'Mr. Hasan', '1619404235', NULL, 'Road # 2  House # 35  Block # C  Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1247, 1, 6, 1, 13, 25, 102052556, 'Meat Food Cafe (Mirpur 2)', 'Mr. Rasel', '1977778675', NULL, 'House # 3/1  Road # 11  Rupnagar R/A  Monipuri School Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1248, 1, 6, 1, 13, 25, 102052564, 'Mr. Monir (Pallabi)', 'Mr Mokbul', '1621825420', NULL, 'Estern Housing Mirpur Pallabi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1249, 1, 6, 1, 13, 25, 102052609, 'Pasta Club (Wari)', NULL, '1616441612', NULL, '09. Ranking Street Wari. 2nd  Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1250, 1, 6, 1, 13, 25, 102052618, 'Pinewood Catn Restaurant (Dhanmondi)', NULL, '1674544304', NULL, 'House #19 Road #12 Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1251, 1, 6, 1, 13, 25, 102052624, 'ICCB(Kuril)', 'Mr.Shahjalal', '1704165275', NULL, 'Kuril  300 Feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1252, 1, 6, 1, 13, 25, 102052637, 'Park Paprichaap Nikunjo', NULL, '1905580547', NULL, 'Road#5  Plot#7  Nikunjo 2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1253, 1, 6, 1, 13, 25, 102052644, 'Take Out (Jamuna)', NULL, '1847227193', NULL, 'Jamuna Future Park', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1254, 1, 6, 1, 13, 25, 102052652, 'Bhoother Adda (Mohammdpur)', NULL, '1914886315', NULL, '31/9 Tajmohol Road .Oposite Akin Ahare Hospital', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1255, 1, 6, 1, 13, 25, 102052671, 'Sweet & Spicy Corn(Shanti Nagar)', NULL, '1731954223', NULL, 'Eastern Plus(1st floor)  Shanti Nagar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1256, 1, 6, 1, 13, 25, 102052673, 'Coffee Glory International (Kuril)', 'Prosanto Debnath', '01844523853/01791989423', NULL, 'K A 95  Kuratoli Bishowroad Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1257, 1, 6, 1, 13, 25, 102052674, 'Desi Delicacy (Dhanmondi)', NULL, '1733857748', NULL, 'Uni Mart Near Almas Supar Shop 8/A.3rd Floor Level#3', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1258, 1, 6, 1, 13, 25, 102052675, 'Bismillah Enterprise(K.B)', NULL, '1720442244', NULL, 'Karwan Bazar Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1259, 1, 6, 1, 13, 25, 102052676, 'Turkish Bazar (Dhanmondi)', NULL, '1920247918', NULL, 'Uni Mart 3rd Floor .Near Almash Supar Shop', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1260, 1, 6, 1, 13, 25, 102052678, 'Khanas  (Mohammad Pur)', NULL, '1711959920', NULL, 'Mohammad Pur .Nurjahan Road.Near B F C', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1261, 1, 6, 1, 13, 25, 102052680, 'Simla Mini Chainese (Shahjanpur)', NULL, '1745713921', NULL, 'Shahjanpur .Near Uttara Bank', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1262, 1, 6, 1, 13, 25, 102052681, 'Eat & Repeat Restaurant &Cafe (Gazipur)', 'Sadikur Rahman', '1677714758', NULL, '83 Azim Uddin Road .Rajbari Joydevpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1263, 1, 6, 1, 13, 25, 102052682, 'Protidiner Kenakata(Eskaton)', NULL, '01771029088  01675761081', NULL, '51 New Eskaton Road Eastern Tower(2nd floor) Ramna', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1264, 1, 6, 1, 13, 25, 102052684, 'Cheesy & Juicy(Tilpapara)', NULL, '1812778899', NULL, 'Khilgoan  Tilpapara  Harbhanga More', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1265, 1, 6, 1, 13, 25, 102052685, 'Artisan Cheese (Mirpur-1)', 'Mr. Bappa', '1979162976', NULL, 'Section-1  Block-C  Road-4  House-14  Mirpur-1  Dhaka-1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1266, 1, 6, 1, 13, 25, 102052688, 'Food (live food live music)', 'Nazrul Islam', '1790656544', NULL, 'Cha- 90\\A  Level 3  BTI premier shopping mall Uttar Badda Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1267, 1, 6, 1, 13, 25, 102052691, 'King s Burger (Jamuna Future Park)', NULL, '1647563258', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1268, 1, 6, 1, 13, 25, 102052552, 'Water Zone(Comilla)', NULL, NULL, NULL, 'Comilla', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1269, 1, 6, 1, 13, 25, 102052553, 'O Play Restaurant (Gulshan 1)', 'Chanhdan', '1817660309', NULL, 'Gulshan 1.Near Bela Italiya', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1270, 1, 6, 1, 13, 25, 102052693, 'Indian Spicy Masala (B C)', NULL, '1778972074', NULL, 'Bashundhara City', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1271, 1, 6, 1, 13, 25, 102052721, 'Taslima (Tejgao)', NULL, '1401712806', NULL, 'Tejgao Bablli Moshjid', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1272, 1, 6, 1, 13, 25, 102052731, 'Colors Music (Tonghi Gazipur)', NULL, '1680161577', NULL, 'Morkun Ghatpar Tonghi Gazipur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1273, 1, 6, 1, 13, 25, 102052743, 'Pizza Calda Del Italia(Mirpur)', 'Juyel', '01951768366  01744259448', NULL, 'Plot- 3448  Block- G  Mirpur DOHS  Main Gate  Dhaka 1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1274, 1, 6, 1, 13, 25, 102052749, 'M/S Shikdar Enterprise', 'Saiful Islam', '1707222293', NULL, 'Shikdar Super Market  New Sadarghat Road  Hatkhola  Barishal', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1275, 1, 6, 1, 13, 25, 102052751, 'Cafe Famous (Bailyroad)', NULL, '1708535335', NULL, 'Bailyroad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1276, 1, 6, 1, 13, 25, 102052746, 'Barakah Kitchen (Lalmatia)', NULL, '01962400623/01793940599', NULL, 'House B#29 Block #E .Lalmatia  Mohila College.Beside Cafe Rose Garden', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1277, 1, 6, 1, 13, 25, 102052778, 'Villa Azur (Banani)', 'Mr Shamsu', '1887333661', NULL, 'House-61  Road-15(D)  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1278, 1, 6, 1, 13, 25, 102052563, 'Mim Enterprise (Savar)', 'Md Julhas Ali', '1744697831', NULL, 'West Bank Town.Savar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1279, 1, 6, 1, 13, 25, 102052567, 'R V F F C (Shamibag)', NULL, NULL, NULL, 'Shamibag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1280, 1, 6, 1, 13, 25, 102052569, 'Central Jail (Uttara )', 'Milon', '1768515852', NULL, 'House-3  Road-2  3rd floor  jasim Uddin  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1281, 1, 6, 1, 13, 25, 102052571, 'Kludio Limited (Badda)', 'Mr Asif', '1407892441', NULL, 'Ja-88(3rd floor) Comilla Parb Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1282, 1, 6, 1, 13, 25, 102052573, 'Food Tong (Banasree)', NULL, NULL, NULL, 'Banasree .Block# K  Road #14', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1283, 1, 6, 1, 13, 25, 102052577, 'Indian Dhaba(Tikatoli)', 'Mr .Arif', '1975749999', NULL, '48/2/A  RK  Mission Road Tikatoli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1284, 1, 6, 1, 13, 25, 102052579, 'Mr Babu  (Azimpur)', NULL, '1768535773', NULL, 'Azimpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1285, 1, 6, 1, 13, 25, 102052581, 'Jenetic Plaza (Dhanmondi-27)', 'Mr Babu Patowry', '1833490857', NULL, 'Road # 16 (New)  House # 16 (New)  Dhanmondi  Dhaka  1215', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1286, 1, 6, 1, 13, 25, 102052584, 'Indian Spice Wald(Jamuna)', NULL, NULL, NULL, 'Jamuna Futurepark', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1287, 1, 6, 1, 13, 25, 102052588, 'Pizza Heaven ( Nikunjo)', NULL, '01714113537/01798414140', NULL, 'H # 55/B  R # 3  (west) Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1288, 1, 6, 1, 13, 25, 102052590, 'Pizza Inn', NULL, '1971224511', NULL, 'Mohakhali Plaza  55 Shahid Tajuddin Ahmed Sarani  Rosolbag  Mohakhali  Dhaka-1212', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1289, 1, 6, 1, 13, 25, 102052591, 'Space Apartment (Gulshan 2)', 'Richard Jibon', '1726134989', NULL, 'Plot #14 /B Road 57 Dhaka  1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1290, 1, 6, 1, 13, 25, 102052592, 'Quality Integrated Agro Ltd (Uttara)', NULL, '1755631417', NULL, 'House#12  Road #7 Sector # 4 Uttara', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1291, 1, 6, 1, 13, 25, 102052594, 'Khan Marketing (Notunbazar)', NULL, NULL, NULL, 'Near Vatara Thana  Notunbazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1292, 1, 6, 1, 13, 25, 102052597, 'The Chocolate Room (Gulshan 1)', NULL, NULL, NULL, 'Ground Floor  Star Center Plot-2A Block SE (C) Road  138 Gulshan avenue  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1293, 1, 6, 1, 13, 25, 102052603, 'OFF BEAT  (Dhokhin Banasree)', NULL, '1681170136', NULL, 'Dhokhin Banasree Near 10 Tala Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1294, 1, 6, 1, 13, 25, 102052608, 'Tasty Bite (Mirpur 1)', NULL, '1610777525', NULL, 'Road-01  Block-G Mirpur 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1295, 1, 6, 1, 13, 25, 102052612, 'Bonton Foods Ltd (Gulshan 1 D C C)', 'Md Shamim Reza', '1884000666', NULL, 'Shopping Complex (3rd Floor)  Gulshan-1 DCC Market', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1296, 1, 6, 1, 13, 25, 102052616, 'Habibys (Bashundhara)', NULL, '1827617914', NULL, 'Basundhara Baridhara .Grameen Phone Centre', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1297, 1, 6, 1, 13, 25, 102052619, 'Nina s Kitchen (Mohakhali DOHS)', 'Mr Asad', '1408549177', NULL, 'Road #8 House #B /107.Mohakhali DOHS', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1298, 1, 6, 1, 13, 25, 102052621, 'Poopies (Lokkhi Bazar Wari)', NULL, '1686825418', NULL, 'Lokkhi Bazar Wari Ahmed Plaza KFC Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1299, 1, 6, 1, 13, 25, 102052622, 'Mary Montana(Uttara)', NULL, '1719164672', NULL, 'House-39 Road-18 Sector-03 3 rd floor Uttara Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1300, 1, 6, 1, 13, 25, 102052623, 'Kashundi Restaurant (I U B) Bashundhara', NULL, '01958399507 /01870295709', NULL, 'Bashundhara /Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1301, 1, 6, 1, 13, 25, 102052626, 'Grab A Cuppa (Uttara)', 'Jannat', '1726588372', NULL, 'Plot 29  Road 2 Sector 3 Uttora', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1302, 1, 6, 1, 13, 25, 102052629, 'Mr  Robiul (Gulshan 1)', NULL, '1909630683', NULL, 'Gulshan 1 D C C Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1303, 1, 6, 1, 13, 25, 102052634, 'Showrma Stick(Baily Road)', NULL, '1675887531', NULL, 'Baily Road', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1304, 1, 6, 1, 13, 25, 102052635, 'Chef Cuisin (Shaymoli)', NULL, '1952830278', NULL, 'Shamoli', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1305, 1, 6, 1, 13, 25, 102052638, 'Sower & Suger (Banasree)', 'Shubon', '1911711214', NULL, 'Block F Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1306, 1, 6, 1, 13, 25, 102052641, 'Cricketers Kitchen (Gulshan 1 Shooting Club)', 'Mr Zia', '1783551415', NULL, 'Road 144 Behind Gulshan Shooting Club Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1307, 1, 6, 1, 13, 25, 102052696, 'Krave (Nasirabad Chittagong)', 'Mr Enamul', '1673253064', NULL, 'Nasirabad Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1308, 1, 6, 1, 13, 25, 102052698, 'Burger Fiesta (Mohammadpur)', 'Mr. Mohsin', '1828367353', NULL, 'Town Hall super market  134/149 no shop  Mohammadpur  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1309, 1, 6, 1, 13, 25, 102052699, 'Pizza Lovy (Wari)', NULL, '1784903294', NULL, 'Wari Near  Post Office', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1310, 1, 6, 1, 13, 25, 102052700, 'Green Terrace (Lalbag)', 'Badol', '1778339903', NULL, 'Lalbag Opposite Ibna Sina Hospital .Play Ground', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1311, 1, 6, 1, 13, 25, 102052703, 'Poplar Taiwans(Jamuna)', NULL, '1821100442', NULL, 'Level-05  Cinema Next Door Jamuna Future Park', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1312, 1, 6, 1, 13, 25, 102052704, 'Burger Attack (Uttara)', 'Mr Ashraful', '1830181670', NULL, 'Road # 1  Sector # 14  Shahmakdum  Beside BITL School  Uttara.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1313, 1, 6, 1, 13, 25, 102052705, 'Pizza Roma (Dhanmondi)', NULL, '1617122050', NULL, 'Ahmed &Kazi Tower.Building #35 Road #2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1314, 1, 6, 1, 13, 25, 102052706, 'Rafi Enterprise (Mohammad Pur)', NULL, '1625921144', NULL, 'Mohammad Pur Kachabazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1315, 1, 6, 1, 13, 25, 102052708, 'La Esseence (Dhanmondi)', NULL, '1731967508', NULL, 'Dhanmondi 15 Mad chef Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1316, 1, 6, 1, 13, 25, 102052709, 'Tarikul Islam (Shahajatpur)', NULL, '1961820970', NULL, 'Shahajatpur .Jamai Goli Boroi Tola Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1317, 1, 6, 1, 13, 25, 102052710, 'Premier Hotel management Co. Ltd (Renaissance)', 'Mr. Atikur Rahman Chowdhury', '1704112614', NULL, 'C.E.S (F) 3  78 Bir Uttam Mir Sowkot Road Gulshan-1  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1318, 1, 6, 1, 13, 25, 102052711, 'Salt & Pepper (Narayanganj)', NULL, '1855459088', NULL, '2/6 Near By Govt Tolaram College Narayanganj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1319, 1, 6, 1, 13, 25, 102052712, 'Preetom (Dhanmondi)', NULL, '1828784128', NULL, 'Lilyrin Tower  Level 1  Building- 39  1205 Dhaka  1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1320, 1, 6, 1, 13, 25, 102052713, 'Pizza On Time (Dhanmondi)', NULL, '1913455576', NULL, 'Road #3 House #36 Dhanmondi Dhaka 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1321, 1, 6, 1, 13, 25, 102052714, 'Cilantro(Banani)', 'Mr. Asif', '1675509994', NULL, 'Snowdrop Apartments  Level-1 A1 House no 78  Block M Road no:11  Banani Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1322, 1, 6, 1, 13, 25, 102052715, 'Arsalan (Jamuna)', NULL, '1687960445', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1323, 1, 6, 1, 13, 25, 102052719, 'KIB Restaurant(Khamar Bari)', NULL, NULL, NULL, 'Krishi Institue  Khamar Bari', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1324, 1, 6, 1, 13, 25, 102052720, 'Chef s Dine(Lalbag)', 'Asif', '1893313988', NULL, 'House 17 Chowrasta Kella Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1325, 1, 6, 1, 13, 25, 102052722, 'B Tasty Bistro(Uttara)', NULL, NULL, NULL, 'Zam Zam Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1326, 1, 6, 1, 13, 25, 102052723, 'Rose Cafe ((Dhanmondi)', NULL, '1921537925', NULL, 'Dhanmondi 15', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1327, 1, 6, 1, 13, 25, 102052725, 'Boom Boom Juice & Coffee Shop', 'Nurul Amin  Foyfal', '01782355071  01960207849', NULL, 'B-10/2 Thana Road  Savar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1328, 1, 6, 1, 13, 25, 102052727, 'Hamim khan  (Mowlobibazar)', NULL, '01811632911/01911902900', NULL, '66 No Bolla Mention MowlobiBazar.Near Agroni Bank', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1329, 1, 6, 1, 13, 25, 102052728, 'Rk Restaurant(Banasree)', NULL, NULL, NULL, 'Banasree', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1330, 1, 6, 1, 13, 25, 102052729, 'Food Papa (Mirpur-1)', NULL, '1737322292', NULL, 'House #178 Near Ansar Camp.Moddho Paip Para Madrasha Mirpur 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1331, 1, 6, 1, 13, 25, 102052730, 'Dilli Darbar (Jamuna Future Park)', NULL, '1965829364', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1332, 1, 6, 1, 13, 25, 102052733, 'Hotel Shalimar (Kamlapur)', NULL, '1710704334', NULL, '2/A North Kamlapur Dhaka 1217', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1333, 1, 6, 1, 13, 25, 102052697, 'Monir (Uttara)', NULL, '1754631417', NULL, 'Sector  #4 Ppular  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1334, 1, 6, 1, 13, 25, 102052702, 'Shwapno (Mirpur 1)', 'Jalal', '1741115802', NULL, 'Supar Shop 3/A .Darus Salam Road Mirpur 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1335, 1, 6, 1, 13, 25, 102052707, 'Cremem De La Creme Coffee (Tejgaon)', NULL, '1832429671', NULL, 'Beside Independent Tv  Tejgaon.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1336, 1, 6, 1, 13, 25, 102052717, 'Kindred Food Garden (Uttara)', NULL, '1842322477', NULL, 'House #9 Road #13 Sector #4 (Uttara)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1337, 1, 6, 1, 13, 25, 102052724, 'Coffee Time(Mirpur-1)', 'Mohammad Saleh', '1741992430', NULL, 'House no:42  block E Zoo Road -2 Oposite Side Of eid ga Field  Mirpur 1  1216  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1338, 1, 6, 1, 13, 25, 102052726, 'Alomgir (Shantinagor)', NULL, '1762667082', NULL, '165/Shantinagor Sky Viw Park City .C/19 Starplus Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1339, 1, 6, 1, 13, 25, 102052734, 'Street Oven(Wari)', NULL, '1671182292', NULL, '29.29/1 Flat 1/B .Tipu Sultan Road Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1340, 1, 6, 1, 13, 25, 102052735, 'Coffelicious Coffe (Uttara)', NULL, '1616998996', NULL, 'Near Rajlokkhi Market Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1341, 1, 6, 1, 13, 25, 102052736, 'M/S Maa Enterprise (Kalabagan)', 'Mr. Lavlo', '1780184735', NULL, '72  Kalabagan 2nd Lane  kalabagan  Dhanmondi  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1342, 1, 6, 1, 13, 25, 102052737, 'Shwarma Fusion', 'Mr. Shagor', '1861063651', NULL, '100 Feet Road Food Court  Natun Bazar  Vatara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1343, 1, 6, 1, 13, 25, 102052738, 'The Cafeteria (Banani)', NULL, '1311470705', NULL, 'House #9 Block # C Road 17.Prime Asia University Banani Dhaka 1213', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1344, 1, 6, 1, 13, 25, 102052739, 'Nadiya Enterprise (Gazipur Joydebpur)', NULL, '1778272484', NULL, 'Gazipur Joydebpur', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1345, 1, 6, 1, 13, 25, 102052741, 'Bishmillah Traders (Mohammadpur)', 'Mr. Raihan', '1317194830', NULL, 'Road-5  Kaderabad Housing  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1346, 1, 6, 1, 13, 25, 102052744, 'Oven Craft (Badda  Link Road)', 'Nudrat Nawar Nodee', '1611008007', NULL, 'Road-1  Shahadath Shoroni  Gulshan Badda Link Road  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1347, 1, 6, 1, 13, 25, 102052745, 'Burger Guys (Uttara)', NULL, '1710301004', NULL, 'Goriber Newaz Avenue Section 11. Minabazar ar 4th Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1348, 1, 6, 1, 13, 25, 102052747, 'Spaghetti Jazz (Dhanmondi)', NULL, '1726590367', NULL, 'Dhanmondi 15 Unimart', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1349, 1, 6, 1, 13, 25, 102052748, 'Steak Hell(Bashundhara)', NULL, '1719301029', NULL, 'Bashundhara  Baridhara', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1350, 1, 6, 1, 13, 25, 102052750, 'Take In (Mirpur 2)', 'Noor', '1782821363', NULL, 'Mirpur Shopping Center Food Court  Level #7  Lift-6  Mirpur 2  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1351, 1, 6, 1, 13, 25, 102052752, 'Egg Food (Elephant Road)', NULL, '1842341874', NULL, 'Elephant road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1352, 1, 6, 1, 13, 25, 102052753, 'Pan Pacific Sonargaon', 'Mr. Mahbub  Purchase manager', NULL, NULL, 'Sonargaon road  Karwan Bazar  Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1353, 1, 6, 1, 13, 25, 102052754, 'Sakib 75Restaurant (Dhanmondi)', NULL, '1715076761', NULL, 'Rupayan Z R plaza 9th Floor House #46 Road 9/A .Satmosjid Road Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1354, 1, 6, 1, 13, 25, 102052755, 'Ador Enterprise(Mirpur)', 'Mr. Atik', '1799781561', NULL, 'Shah Ali City Corporation market  Mirpur-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1355, 1, 6, 1, 13, 25, 102052758, 'Babuland (Wari)', NULL, '1313428425', NULL, 'Rose Vally Shopping Mall  29  Ranking Street Wari', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1356, 1, 6, 1, 13, 25, 102052759, 'Fat boy (Narayanganj)', 'Mr. Mujib', '1717767379', NULL, 'Opposite of Morgan Girls High School.Deovoug Hredom Plaza Ground Floor Shop #5', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1357, 1, 6, 1, 13, 25, 102053113, 'Tommy Miah\'s Tea Bar (Nikunjo-2)', 'Mr. Limon', '1727292132', NULL, 'House 20  Road 17  Nikunjo -2  Dhaka Nikunjo', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1358, 1, 6, 1, 13, 25, 102052798, 'Cafe Shanghai (Kalshi)', 'Mr. Shuvo', '1305744345', NULL, 'Kalsi Road  Kalshi  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1359, 1, 6, 1, 13, 25, 102052801, 'Hungrila (Bashundhara gate)', 'Mr. Ismail', '1798372874', NULL, 'Bashundhara gate  Bashundhara R/A  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1360, 1, 6, 1, 13, 25, 102052804, 'Arabian Nights (Dhanmondi)', 'Mr. Shakil', '1763667616', NULL, 'Shimanto Somvar  Dhanmondi  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1361, 1, 6, 1, 13, 25, 102052805, 'Cafe Rain Street(Mirpur-1)', 'Mr. Mahbub', '1778088084', NULL, 'House-32  Road-5  Block-G  Opposit of Yellow Show Room  Mirpur-1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1362, 1, 6, 1, 13, 25, 102052806, 'Coffee Nut (Wari)', 'Rayhan', '1980979429', NULL, 'Neyar Post Office 5/2 Folder Street Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1363, 1, 6, 1, 13, 25, 102052808, 'Garden Oasis(Jamuna)', 'Mr. Bacchu', '1909915302', NULL, 'House-48  Block-C  5th Floor  Jamuna Future Park  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1364, 1, 6, 1, 13, 25, 102052809, '7/24 Restaurant (Gulshan)', NULL, '1683806946', NULL, '6/A  Rangs FC 2  2nd Floor  Corner of Rd 32 and Gulshan avenue Dhaka  Bangladesh  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1365, 1, 6, 1, 13, 25, 102052810, 'Sizzle N Drizzle(Bashundhara)', 'Mr. Rasel', '1648188994', NULL, 'Shop# 8  The Kings Food Court Ka-9/A  Haji Abdul latif Mansion  Bashundhara Gate  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1366, 1, 6, 1, 13, 25, 102052811, 'Mr. Nurul Islam(Bashundhara)', 'Mr. Nurul Islam', '1734796955', NULL, 'Studio 21  Hazi Abdul Latif Mansion  9/A  Bashundhara gate  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1367, 1, 6, 1, 13, 25, 102052812, 'Morning Brewed(Mirpur-6)', 'Mr. Sumon', '1973422444', NULL, 'House-7/8  block-A/J  Section-06  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1368, 1, 6, 1, 13, 25, 102052813, 'Purple Cafe and Restaurant(Mirpur-14)', 'Mr. Forhad', '1627349236', NULL, '72/1  Ananda Road  Mirpur-14  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1369, 1, 6, 1, 13, 25, 102052814, 'Sohel Rana(Mdp)', NULL, '1799015818', NULL, 'Mohammadpur Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1370, 1, 6, 1, 13, 25, 102052818, 'Food Fusion (Uttara)', NULL, '1627226717', NULL, 'House-5  Sector-7  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1371, 1, 6, 1, 13, 25, 102052819, 'Pizza Garage (Palashi)', NULL, '1937015075', NULL, 'House-22/5  Dhakessari Mondir Road  Palashi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1372, 1, 6, 1, 13, 25, 102052820, 'Mi Casa (Mirpur DOHS)', 'Mr. Asif', '1841410040', NULL, 'Shop No: 2  Level:7  Mirpur DOHS Shopping Complex  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1373, 1, 6, 1, 13, 25, 102052821, 'Cafe Droom(Dhan)', NULL, '1640209007', NULL, 'House-89/2  Road-12/A  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1374, 1, 6, 1, 13, 25, 102052823, 'Indian Spicy Sea Food (Bcity)', 'Mr. Javed', '1816818633', NULL, 'Shop No: 40  Bashundhara City  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1375, 1, 6, 1, 13, 25, 102052824, 'Bhai Bhai General Store (kochukhet)', 'Mr. Rasel', '1612218843', NULL, 'C/46  Rojonigandha Super Market  Kochukhet  Dhaka Cantonment  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1376, 1, 6, 1, 13, 25, 102052827, 'Take Out (Mohammadpur)', NULL, '1847227197', NULL, 'H I Khan Trade Center  Plot Z-23 & Z-24  Block - D  Tajmohol Road Main Road  Mohammadpur Dhaka-1207', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1377, 1, 6, 1, 13, 25, 102052828, 'The Spicy Cooker (Uttara)', 'Sahin', '1829250789', NULL, 'Sector #03 Road #02  Shwapno  Food Court.Uttara Dhaka 1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1378, 1, 6, 1, 13, 25, 102052831, 'Mr Samim (Wari)', NULL, '1615127612', NULL, 'Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1379, 1, 6, 1, 13, 25, 102052832, 'Cafe Cheerful Spices (Gabtoli)', NULL, '1873919262', NULL, '173  Bagbari Uttar Para  gabtoli  Mirpur  Dhaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1380, 1, 6, 1, 13, 25, 102052833, 'Food Swingers (Uttara)', NULL, '1788800303', NULL, 'House-1  Road-10  Sector-4  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1381, 1, 6, 1, 13, 25, 102052837, 'The Kitchen 2020(Bangla Motor)', NULL, '1726737404', NULL, 'Bangla Motor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1382, 1, 6, 1, 13, 25, 102052809, 'The Kitchen2020 (BanglaMotor)', NULL, '1726737404', NULL, 'Bangla Motor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1383, 1, 6, 1, 13, 25, 102052822, 'Eater\'s Bay (Dalibari)', 'Mehedi Hasan', '1681620258', NULL, 'Beside Appolo gate  Dalibari road  Bashundhara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1384, 1, 6, 1, 13, 25, 102052829, 'Cafe Cricketars (Shantinagor Bazzar)', NULL, '1705820037', NULL, 'Shantinagor Bazzar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1385, 1, 6, 1, 13, 25, 102052834, 'Burger Express', NULL, '1860535770', NULL, '1 New Baily Road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1386, 1, 6, 1, 13, 25, 102052835, 'Pizza Club(Zail Gate)', NULL, '1674759596', NULL, '49 Begum Bazar Zailkhana Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1387, 1, 6, 1, 13, 25, 102052836, 'Master Oven (Baridhara)', 'Mr. Ovi', '177747047', NULL, 'Rajbari Food Court  Bashundhara residential area  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1388, 1, 6, 1, 13, 25, 102052838, 'Shamim Traders(Tangail)', 'Mr. Mahfuz', '1632112770', NULL, 'Akur Takur Para  Tangail', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1389, 1, 6, 1, 13, 25, 102052839, 'Showrma House (Purbachol)', NULL, '1798257591', NULL, 'Mehedi Food Court Purbachol', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1390, 1, 6, 1, 13, 25, 102052841, 'AR Enterprise (Gulshan)', NULL, '1684666442', NULL, '100 feet road  Natun bazar  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1391, 1, 6, 1, 13, 25, 102052842, 'Babylon Burger City(100 Fit)', NULL, '1713336478', NULL, 'Madani Avenue Natun Bazar  100 Fit Road', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1392, 1, 6, 1, 13, 25, 102052843, 'Burger & Co.(Jatrrabari)', NULL, '1977771822', NULL, '5/L  Shahid faruk Road  West Jatrabari  Beside Al Arafa bank', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1393, 1, 6, 1, 13, 25, 102052843, 'A To Z Chainis (Dakhin Banasree)', NULL, '1641677493', NULL, '10 Tala Market Dakhin Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1394, 1, 6, 1, 13, 25, 102052844, 'Burger Plus (Jatrabari)', NULL, '1910063423', NULL, 'Shahid Faruk Road  West Jatrabari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1395, 1, 6, 1, 13, 25, 102052845, 'A To Z Chainis (Dakhin Banasree)', NULL, '1641677493', NULL, '10 Tala Market Dakhin Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1396, 1, 6, 1, 13, 25, 102052846, 'Green Oven Ltd. (Dhalibari)', 'Mr. Prince', '1974199942', NULL, 'House-168/83  Auto stand  Solmaid madbor bari  Dhalibari road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1397, 1, 6, 1, 13, 25, 102052847, 'Cheese Lovers (Dhanmondi)', NULL, '1645009410', NULL, 'Zigatola bus stand  Dhanmondi  Dhaka-1205', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1398, 1, 6, 1, 13, 25, 102052849, 'Kung Fu Panda (Jatrabari)', NULL, '1711446874', NULL, 'West Jatrabari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1399, 1, 6, 1, 13, 25, 102052850, 'CHLELSEY .S (Banani)', NULL, '1634837523', NULL, 'Kamal Ataturk Avenue  Banani .Near Chillox', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1400, 1, 6, 1, 13, 25, 102052853, 'Mr. Boss (Mouchak)', 'Mr. Krishan', '1770741509', NULL, 'Wireless mor  Near Gurmet burger  Mouchak  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1401, 1, 6, 1, 13, 25, 102052854, 'Burger School (Jatrabari)', NULL, '1947559893', NULL, 'Shahid Faruk road  West Jatrabari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1402, 1, 6, 1, 13, 25, 102052857, 'Ayesha Enterprise (Kochukhet)', 'Afsar', '1868981212', NULL, 'Shop C; 54 Rojonigondha Super Market .Kochukhet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1403, 1, 6, 1, 13, 25, 102052858, 'Banolata Restaurant (Mohakhali)', NULL, '1625493179', NULL, 'Mohakhali Amtoli Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1404, 1, 6, 1, 13, 25, 102052859, 'Burger & Co. (Doyaganj)', NULL, '1798328501', NULL, 'Dayaganj  Opposit of Shakti Mandir  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1405, 1, 6, 1, 13, 25, 102052861, 'Kmondar Fqrul (Banani)', NULL, '1730714478', NULL, 'Banani Kakuli DOSH  .Road #6 House #82', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1406, 1, 6, 1, 13, 25, 102052867, 'Twenty Twenty Restaurant (Nikunjo)', NULL, '1854810015', NULL, 'House-84  Road-19  Nikunjo-2  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1407, 1, 6, 1, 13, 25, 102052869, 'Craze Burger & Coffee Lounge (Dhanmondi)', NULL, '01764706435/ 01819458511', NULL, '11/A  Dhanmondi  Dhaka-1205', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1408, 1, 6, 1, 13, 25, 102052872, 'Wow Momo (Police Plaza)', NULL, '1834661260', NULL, 'Police Plaza food court', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1409, 1, 6, 1, 13, 25, 102052877, 'Ocaso skyscape (uttara)', 'Imran', '1715387478', NULL, 'House#16  Sector#9  uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1410, 1, 6, 1, 13, 25, 102052878, 'Chaikana Kebab & Grill (Uttara)', NULL, '1752045979', NULL, 'Sector-3  Shopno Food Court  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1411, 1, 6, 1, 13, 25, 102052815, 'Burger Club (Bshundhara gate)', NULL, '199993575', NULL, 'Urban Food Court  Bashundhara R/A  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1412, 1, 6, 1, 13, 25, 102052848, 'Cafe Shahi Darbar (Jatrabari)', NULL, '1633170221', NULL, 'West Jatrabari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1413, 1, 6, 1, 13, 25, 102052851, 'Cafe Crush (Basundhara)', NULL, '1674350169', NULL, 'Basundhara Apollo Hospitals Poket Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1414, 1, 6, 1, 13, 25, 102052855, 'Madina Trading (Mirpur DOHS)', NULL, '1685259429', NULL, 'Amonton Food Court .Mirpur DOSH', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1415, 1, 6, 1, 13, 25, 102052860, 'Cafino (Baridhara)', NULL, '1978851444', NULL, 'Metro Kichen s  Shop #29 Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1416, 1, 6, 1, 13, 25, 102052864, 'Helvetia (Motijheel)', NULL, '1715496909', NULL, '48/1  Motijheel C/A  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1417, 1, 6, 1, 13, 25, 102052868, 'Holiday Inn Dhaka City Center', NULL, '1324717050', NULL, '23  Shahid Tajuddin Ahmed Sarani  Tejgaon  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1418, 1, 6, 1, 13, 25, 102052871, 'Tour De Cyclist (Mirpur11)', NULL, '1726917675', NULL, 'House #12 Road #1 Mirpur 11 Dhaka 1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1419, 1, 6, 1, 13, 25, 102052873, 'Kanary Restaurant (Basundhara)', NULL, '1726102727', NULL, 'Basundhara Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1420, 1, 6, 1, 13, 25, 102052876, 'Mr Rafik(Gul-01)', NULL, '1991196707', NULL, 'DCC Market Gulshan-01', 15000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1421, 1, 6, 1, 13, 25, 102052879, 'Crave (Bashundhara)', 'M D Ali', '1886000186', NULL, 'Ghat Par Bashundhara R/A  Dhaka Shop #20 North Member Bari  Suparmarket', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1422, 1, 6, 1, 13, 25, 102052880, 'Pizza Gang (Panthopath)', NULL, '1636602214', NULL, 'House-54/A  Dolphin Goli  Opposite of Square Hospitral  Panthopath  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1423, 1, 6, 1, 13, 25, 102052881, 'Silver Point', 'Mr. Sarad', NULL, NULL, 'Safe & Fresh  kawranbazar  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1424, 1, 6, 1, 13, 25, 102052882, 'Origin Island (Dhanmondi)', NULL, '1716376347', NULL, 'Ahmed & Kazi Tower  39 Bir Uttam M.A Rob Road  Dhanmondi-2  Dhaka-1205', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1425, 1, 6, 1, 13, 25, 102052883, 'Sudhangsu Howlader', NULL, '1996899859', NULL, NULL, 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1426, 1, 6, 1, 13, 25, 102052884, 'Dish Catering (Pran Group)', 'Mr. Eynul Haque', '1992666571', NULL, 'PRAN RFL Center  105  Middle Badda  Dhaka-1212', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1427, 1, 6, 1, 13, 25, 102052886, 'Makdul Store', 'Mr. Jabed', '1720001988', NULL, 'BTI Premier Plaza  Uttar Badda   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1428, 1, 6, 1, 13, 25, 102052887, 'Shahparan Chicken(Baridhara)', 'Shahjahan Islam', '01627889730  01701788692', NULL, 'Near Appolo Hospital  Bashundhara  Baridhara', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1429, 1, 6, 1, 13, 25, 102052888, 'Eon Foods Ltd.', NULL, '1708495191', NULL, '317  Tejgoan I/A ( Beside Channel I office)   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1430, 1, 6, 1, 13, 25, 102052889, 'Office Staff', NULL, NULL, NULL, 'Mogbazer & Trimohoni', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1431, 1, 6, 1, 13, 25, 102052890, 'Takul Foods(Mirpur)', 'Mr. Hasan', '1780007833', NULL, 'Goni Villa  571/1  Chowdhury bari goli  ECB Cottor  MirpurE C B Branch 2nd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1432, 1, 6, 1, 13, 25, 102052891, 'Hello Pizza', NULL, '1773753269', NULL, 'Pizza End   Gazipura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1433, 1, 6, 1, 13, 25, 102052892, 'Ahad Store (Narayanganj)', 'Mr. Mansur', '1756452149', NULL, 'Dipu Bazar  Narayanganj', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1434, 1, 6, 1, 13, 25, 102052893, 'M C S  (Bashundhara)', NULL, '1779816579', NULL, 'Bashundhara1 st Floor Hassan Dorji Super Market Momtajuddin Kacha bazar Road Solmaid Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1435, 1, 6, 1, 13, 25, 102052896, 'Bitcoin Cafe (Mirpur-1)', NULL, '1914624742', NULL, 'Zoo Road Beside Eidgha Field 1216 dhaka Bangladesh', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1436, 1, 6, 1, 13, 25, 102052897, 'Burgerology (Wari)', NULL, '1730586420', NULL, 'Rankin Street roze Valley Shopping mall  Wari (beside Wari Jame Mosjid)  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1437, 1, 6, 1, 13, 25, 102052816, 'Apon Coffee Shop (Taltola)', NULL, '1717611339', NULL, 'Taltola Road  Khilgaon  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1438, 1, 6, 1, 13, 25, 102052817, 'Burgarita (Taltola)', NULL, '1786048699', NULL, 'Taltola road  Khilgaon  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1439, 1, 6, 1, 13, 25, 102052862, 'Saltz (Unimart)', NULL, '1319783330', NULL, 'Gulshan #2 Unimart .House #23 A Road #99', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1440, 1, 6, 1, 13, 25, 102052885, 'Babul Meat', 'Babul Mia', '1853633350', NULL, 'Jatrabari  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1441, 1, 6, 1, 13, 25, 102052898, 'Abdul Alim (Pran SCM)', 'Abdul Alim', '1704140883', NULL, 'Hossain Market  Badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1442, 1, 6, 1, 13, 25, 102052899, 'Abdul Goni Store (Karwanbazar)', NULL, '1818421255', NULL, 'Karwanbazar Kitchen market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1443, 1, 6, 1, 13, 25, 102052900, 'Shanto Traders (Narayanganj)', 'Mr. Asad', '1979796464', NULL, '16/1  Nabab Sirajuddowla Road  Folpotti  Narayanganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1444, 1, 6, 1, 13, 25, 102052901, 'BAJUICE (Banasree)', 'Mr. Fuad', '1713274263', NULL, 'H-1  R-4  Block-F  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1445, 1, 6, 1, 13, 25, 102052902, 'Eorange Shop', 'Mr. Raihan  Store Incharge', '1642033333', NULL, 'Warehouse: GM Plaza Shopping Complex  Sha-72/2  Sha-164 (new)  Uttar Badda Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1446, 1, 6, 1, 13, 25, 102052903, 'Indian Spicy Chicken (Dhanmondi 27)', NULL, '1936967690', NULL, 'Dhanmondi 27 Opposite Meena Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1447, 1, 6, 1, 13, 25, 102052904, 'Arabian Nights (Mohammadpur)', 'Mr. Sumon', '1674664975', NULL, '22/14 Block C  Tajmohol Road  Mohammadpur  Dhaka- 1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1448, 1, 6, 1, 13, 25, 102052905, 'The Hot Palat (Lokkhi Bazar)', NULL, '1308163315', NULL, 'Lokkhi Bazar Near Sohrawardi College', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1449, 1, 6, 1, 13, 25, 102052906, 'LFC (Kishoreganj)', 'Mr. Monir', '1906076802', NULL, 'Kishoreganj Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1450, 1, 6, 1, 13, 25, 102052907, 'Mad Chef (Gulshan 1)', NULL, '1926027064', NULL, 'Gulshan 1 Road #137 House #7 Near Exim Bank', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1451, 1, 6, 1, 13, 25, 102052908, 'Cielo Rooftop (Banglamotor)', 'Mr. Juel- Outlet Manager', '1841393748', NULL, 'level-19  Borak Unique Heights  117 Kazi Nazrul Islam Avenue  Dhaka-1000', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1452, 1, 6, 1, 13, 25, 102052909, 'Oven Pizza(Uttara)', NULL, '1826511431', NULL, 'House #41 Road Garib E Nawaz Sector #11  Meena Bazar Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1453, 1, 6, 1, 13, 25, 102052910, 'Arabian Nights (Shantinagar)', NULL, '1842282412', NULL, '21 Shantinagar  1st floor  Polton  Dhaka- 1217', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1454, 1, 6, 1, 13, 25, 102052911, 'Crush Restaurant (Shoniakra)', NULL, '1778334482', NULL, 'Shoniakra Near Bornomala School', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1455, 1, 6, 1, 13, 25, 102052912, 'Chape Achi (Uttara)', NULL, '1790010027', NULL, 'Plot # 4 Road # 3 Sector # 13 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1456, 1, 6, 1, 13, 25, 102052914, 'Afgan Grill(Badda)', NULL, '1708528888', NULL, 'Plot # 02  Road # 210  Sector # 02  Satarkul Uttar Badda Bazar Road', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1457, 1, 6, 1, 13, 25, 102052915, '3 Food (Mirpur 1)', NULL, '1712548123', NULL, '1 -G 25 - 29 Oppsite Of Yellow Beside  Of Arong  Birbikrom  Hemayet Uddin Sarak  Zoo Road  Mirpur 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1458, 1, 6, 1, 13, 25, 102052916, 'CRAVE (Bashundhara )', 'MD Ali', '1722039377', NULL, 'Residential Area Shop #20 North Member Bari Supermarket Ghatpar Vatara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1459, 1, 6, 1, 13, 25, 102052917, 'TATY TRAILS', 'Aman Rahman', '1711085759', NULL, 'House#91 Block#D Road#5 South Banasree Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1460, 1, 6, 1, 13, 25, 102052919, 'Mr. Sub (Mohammadpur)', 'Mr. Dipu', '1745565398', NULL, 'Tajmohol road (near Mr.Baker)  Mohammadpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1461, 1, 6, 1, 13, 25, 102052924, 'Cafe Roshin (Eastern Plaza)', 'Mr. Fuad', '1811195836', NULL, 'Level-3  Eastern Plaza  Hatirpool  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1462, 1, 6, 1, 13, 25, 102052925, 'Daining Lounge (Taltola)', NULL, '1976239619', NULL, 'Taltola Fazitas Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1463, 1, 6, 1, 13, 25, 102052825, 'VIP Enterprise (Kochukhet)', 'Mr. Sabuj', '1917255623', NULL, 'C-37  Rojonogandha Super market  Kochukhet  Dhaka cantonment  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1464, 1, 6, 1, 13, 25, 102052826, 'Sub Lovers (Tejgaon)', 'Mr. Ringku', '1916881693', NULL, 'Channel I Building  40  Shahid Taj Uddin Ahmed Sarani  Tejgaon Indusrial Area  Dhaka-1208', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1465, 1, 6, 1, 13, 25, 102052863, 'Bhairab Halal Foods', 'A.K.M Faisal', '1979140150', NULL, 'Near Nuha CNG Kamalpur  (Dhaka-Sylhet Highway) Dhairab  Kishoregonj. 01811912083', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1466, 1, 6, 1, 13, 25, 102052895, 'Pizza Ganj (Munshiganj)', 'Mr. Rony', '1954162574', NULL, 'Munshganj Sadar  Munshiganj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1467, 1, 6, 1, 13, 25, 102052920, 'Take Out (Khilgaon)', 'MD Azad', '1812184754', NULL, 'Khilgaon Near Nur Jame Mosque', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1468, 1, 6, 1, 13, 25, 102052921, '3 Food Mirpur (DOHS)', NULL, '1978918083', NULL, 'Mirpur DOSH  Shopping Complex Lift #7 Shop #9', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1469, 1, 6, 1, 13, 25, 102052922, 'Street Oven (Mohammad Pur)', NULL, '1309338219', NULL, '15/14  Block-c Tajmohol Road  Mohammadpur  Dhaka 1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1470, 1, 6, 1, 13, 25, 102052926, 'Sub Way (Bashundhara)', NULL, '1720162126', NULL, 'Bortabari Goli Bashundhara R/A  Burger Lab goli', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1471, 1, 6, 1, 13, 25, 102052927, 'Mamma Mia Pizza & Burger', NULL, '1915217466', NULL, '78  Aga Sadek Road  Satrowja Abul hasnat Road ( Beside satrowja Mazar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1472, 1, 6, 1, 13, 25, 102052928, 'Best Fried Chicken (BFC)-Uttara-01', NULL, '1759421371', NULL, '1  Jashim Uddin Road  Uttara Tower (1st Floor)  Sector-3  Uttara  Dhaka-1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1473, 1, 6, 1, 13, 25, 102052929, 'Best Fried Chicken (BFC)-Orchid Plaza', NULL, '1739613602', NULL, 'House # 02  Road # 15 (New)  (Old-28)  Dhanmondi  Orchid Plaza  Dhaka-1209. 029143223', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1474, 1, 6, 1, 13, 25, 102052930, 'Best Fried Chicken (BFC)- Gulshan-2', NULL, '1983570887', NULL, 'House # 40/8  Road-92 (Madani Sarak)  Gulshan North Avenue  Gulshan  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1475, 1, 6, 1, 13, 25, 102052932, 'Best Fried Chicken (BFC)- Meher Plaza', NULL, '1724316997', NULL, 'House # 13/A  Road # 5  Meher Plaza  Dhanmondi  Dhaka-1205  Tel: 0258616208', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1476, 1, 6, 1, 13, 25, 102052933, 'Best Fried Chicken (BFC)- Keari Plaza', NULL, '1771270704', NULL, 'Plot # 83  Road # 8/A  Shop- 218  1st Floor  Keari Plaza  Dhanmondi  Dhaka-1209. 029131863', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1477, 1, 6, 1, 13, 25, 102052935, 'Best Fried Chicken (BFC)- Eskaton', NULL, '1798777338', NULL, '15  Bara Moghbazar (1st Floor)  New Eskaton  Dhaka-1000. Tel: 0248313320', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1478, 1, 6, 1, 13, 25, 102052941, 'Nerdy Beans Coffee House(Dhn)', NULL, '1765857590', NULL, 'Ahamed Kazi tower  Road 02 Dhanmondi', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1479, 1, 6, 1, 13, 25, 102052942, 'Uttara Coffee House(Sylhet)', NULL, '1731348479', NULL, 'Sunamganj Sadar  Sylhet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1480, 1, 6, 1, 13, 25, 102052943, 'Best Fried Chicken (BFC)- Bcity-02', NULL, '1757419155', NULL, 'Shop # 42  Level # 8  Panthapath  Dhak  028143994', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1481, 1, 6, 1, 13, 25, 102052946, 'Sub Lovers (Nurjahan Road)', NULL, '1742807042', NULL, 'Nurjahan Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1482, 1, 6, 1, 13, 25, 102052947, 'Shawarma House (Munshiganj)', 'Mr. Rony', '1741118993', NULL, 'Munshiganj Sadar  Munshiganj', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1483, 1, 6, 1, 13, 25, 102052948, 'Arabian Nights (Uttara)', NULL, '1834812546', NULL, 'Uttara Shop #3 House #4 Road #1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1484, 1, 6, 1, 13, 25, 102052949, 'Sancks Bucks (Kakrail)', NULL, '1912645814', NULL, 'Kakrail Agora Goli  Will Little Flower School er 4 Number  Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1485, 1, 6, 1, 13, 25, 102052950, 'Baraka Traders (Sylhet)', 'Mr. Omar Moudud', '1319388641', NULL, 'Housing State  Sylhet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1486, 1, 6, 1, 13, 25, 102052951, 'Saffron (Jamuna)', NULL, '1973791921', NULL, 'Jamuna Future Park Block #D  Level #5 Shop #12', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1487, 1, 6, 1, 13, 25, 102052952, 'Best Fried Chicken (BFC)-CPU', 'Mr. Faisal ', '1911056400', NULL, 'Plot # 2544  Ground Floor  Natun Bazar  100 feet  Vatara Thana  Sayed Nagar  Dhaka- 1212.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1488, 1, 6, 1, 13, 25, 102052954, 'Best Fried Chicken (BFC)-Shaymoli', NULL, '1767320047', NULL, 'Plot # 23/8C  Holding # 24/2  Shyamoli Cinema Complex Building  Dhaka -1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1489, 1, 6, 1, 13, 25, 102052646, 'Mr Mannan  ', NULL, '1712080318', NULL, NULL, 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1490, 1, 6, 1, 13, 25, 102052647, 'Fatman Burger (Mohammadpur)', 'Mr. Ovee', '1707001331', NULL, 'Solimullah Road khelar math  West Side  Near Panir Tanki  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1491, 1, 6, 1, 13, 25, 102052650, 'Burger Attack 2 (ECB Chottor)', 'Mr. Ashraful', '1830181670', NULL, 'ECB Chottor  Manikdi Army Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1492, 1, 6, 1, 13, 25, 102052653, 'Red Beans (Uttara)', NULL, '1914731559', NULL, 'Road Lake View Sector 07 House #76  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1493, 1, 6, 1, 13, 25, 102052654, 'Pizza guy Warehouse', NULL, '1678054568', NULL, '2023/Dali Road  Nurjahan Garden. Beside Metro Kitchen', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1494, 1, 6, 1, 13, 25, 102052657, 'Mr Pizza (Uttara)', 'Daniyel', '01857222099/01915598245', NULL, 'House #12 Road #31 Sector #7  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1495, 1, 6, 1, 13, 25, 102052659, 'The Hub Rooftop (Mirpur1)', 'Arif', '01712770780  01715961073', NULL, '29 Zoo Road 1/G. Mirpur 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1496, 1, 6, 1, 13, 25, 102052660, 'Shawarma House (60 feet)', 'Jeshun', '1711944076', NULL, '382\\B  West Monipur 60 Feet Barek Mollar mor Dhaka1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1497, 1, 6, 1, 13, 25, 102052662, 'Crust And Beans (Mirpur-6)', NULL, '1406193403', NULL, 'House 5-6 Avenue 5 Prosikkha Al Fuad Community Centare  Oppsite', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1498, 1, 6, 1, 13, 25, 102052665, 'Dilli Darbar (Banasree)', NULL, '1955558878', NULL, 'Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1499, 1, 6, 1, 13, 25, 102052667, '....', 'Mr. Mushfiq', '1787678312', NULL, 'Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1500, 1, 6, 1, 13, 25, 102052669, 'Italian Pizza (Uttara)', NULL, '1731679766', NULL, 'House# 36 Road #9 Sector #4 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1501, 1, 6, 1, 13, 25, 102052670, 'Bluetony (Bashundhara)', NULL, '1616785658', NULL, 'Buzz100 Food World Bashundhara Apollo Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1502, 1, 6, 1, 13, 25, 102052672, 'Mad Chef(Sylhet)', NULL, '1859317991', NULL, '3rd Floor Arcadia Shopping mall Darshan Dewri sylhet 3100', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1503, 1, 6, 1, 13, 25, 102052677, 'Food Tast (Aftabnagor)', NULL, '1825633538', NULL, 'Aftabnagor Near A F C', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1504, 1, 6, 1, 13, 25, 102052679, 'Bene Bistro (Gulshan2)', 'Mr Hasan', '1892409125', NULL, 'House#36 Road #117  Gulshan 2', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1505, 1, 6, 1, 13, 25, 102052683, 'Cheese & Juice Khilgaon', 'Ashfaq', '1812778899', NULL, 'Tilpapara  Harvanga mor  Khilgaon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1506, 1, 6, 1, 13, 25, 102053878, 'M/S Shayan Enterprise (Uttara)', 'Md Shayan', '1963631901', NULL, 'Uddayan School Road  Koshai Bari Mollantac  Dakhinkhan  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1507, 1, 6, 1, 13, 25, 102052686, 'Plated new (Bashundhara)', 'Sunny', '1313890864', NULL, 'Havily Center Level 3  11\\2 Boshundhara Gate Plated oposite of Burger king', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1508, 1, 6, 1, 13, 25, 102052687, 'Sub Lovers (Mohakhali)', NULL, '1637123615', NULL, 'S K S Tower 3rd Floor Mohakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1509, 1, 6, 1, 13, 25, 102052689, 'Four Point by Sheraton', 'Mr. Shohel', '1709636470', NULL, 'house -12  Road-30  Gulshan-1  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1510, 1, 6, 1, 13, 25, 102052690, 'Igloo(Sharif)', NULL, NULL, NULL, 'Igloo Foods Ltd', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1511, 1, 6, 1, 13, 25, 102052692, 'Burger Attack Nikunjo', 'Mr. Ashraful', '1830181670', NULL, 'Rajuk Trade Centre  Khilkhet  Nikunjo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1512, 1, 6, 1, 13, 25, 102052694, 'Mafuja Tading Corp. (Shantinagor Bazar)', NULL, '1671123657', NULL, 'Shantinagor Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1513, 1, 6, 1, 13, 25, 102052695, 'The Tabbak Restaurant (Mirpur-60 Feet)', NULL, '1678713897', NULL, 'Barek Mollah More Mirpur 60 Feet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1514, 1, 6, 1, 13, 25, 102052718, 'Seventh Seventh (Pallabi)', 'Md Hasanur Rahman', '1997853570', NULL, 'Road #9/1 Block #B Section#6 Mirpur Pallabi Dhaka 1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1515, 1, 6, 1, 13, 25, 102052732, 'Unicafe Restaurant& Fun(Mohammad Pur)', 'Mr Ruhul', '01811456691/01746419178', NULL, 'House#45  2nd Floor  Ringroad Mohammadpur Dhaka 1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1516, 1, 6, 1, 13, 25, 102052852, 'Doll\'s kitchen (Hatirpool)', 'Mr. Sagor', '1905640377', NULL, 'Ground floor  Beside Motalib Plaza  Hatirpool  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1517, 1, 6, 1, 13, 25, 102052875, 'Take Out (Mirpur-11)', NULL, '1847227193', NULL, 'Shagufta R M Senter House #16/17 .Section #7  Road #11 Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1518, 1, 6, 1, 13, 25, 102052913, 'Afgan Grill(Dhan)', NULL, '1708528888', NULL, 'House # 80  Road # 8 A Chef Table Food Court  Dhanmondi', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1519, 1, 6, 1, 13, 25, 102052918, 'Tasty Trails (Banasree)', 'Aman Rahman', '1776678719', NULL, 'House # 91 Block#D Road#5 South Banasree Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1520, 1, 6, 1, 13, 25, 102052940, 'Best Fried Chicken (BFC)- Shyamoli', NULL, NULL, NULL, 'Plot # 23/8C  Holding # 24/2  Shyamoli Cinema Complex Building  Dhaka -1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1521, 1, 6, 1, 13, 25, 102052945, 'Best Fried Chicken (BFC)-Satmasjid', NULL, '1707539754', NULL, 'Plot No- 55 86 (New)  Satmasjid Road  Green Rawshanwara Tower  Dhanmondi C/A  Dhaka.029139002', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1522, 1, 6, 1, 13, 25, 102052956, 'The Daining Lounge (Wari)', NULL, '1701436609', NULL, 'Wari 8/1 Ranking Street Dhaka 1203', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1523, 1, 6, 1, 13, 25, 102052957, 'Sabuj Store(DCC)', NULL, '1618084378', NULL, 'DCC Market  Gulshan-01', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1524, 1, 6, 1, 13, 25, 102052959, 'Food Buzz cafe (Ashuganj)', 'Mr. Nazim', '01685241991  01680002018', NULL, 'Munshi Market  Ashugan Bazar  Ashuganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1525, 1, 6, 1, 13, 25, 102052960, 'Dr Jumu (Adabar)', NULL, '1737614081', NULL, 'Adabar House #564 Road #7', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1526, 1, 6, 1, 13, 25, 102052961, 'Pizza Shuttle (Askona)', 'Mr. Sajid', '1717263616', NULL, '21 Kolahol Ashkona Hajjcamp  Dakkhinkhan. Near Parvin Hotel', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1527, 1, 6, 1, 13, 25, 102052962, 'Cafe Login (Panthopath)', 'Mr. Arif Hossain Dewan', '1777646367', NULL, '152/18  Sab Moon tower  1st Floor  Panthopath signal', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1528, 1, 6, 1, 13, 25, 102052963, 'Cow Boy Kitchen (Wari)', 'Asif', '1407892441', NULL, 'Wari Besid The Bolda Garden', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1529, 1, 6, 1, 13, 25, 102052965, 'Queen\'s Bakery (Khilkhet)', 'Mr. Shohel', '1883795567', NULL, 'Khilkhet More  Khilkhet  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1530, 1, 6, 1, 13, 25, 102052967, 'Abu Raihan (Karwan Bazar)', NULL, '1749074680', NULL, 'Karwan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1531, 1, 6, 1, 13, 25, 102052970, 'Hongbao Restaurant (Gulshan)', 'Mizanur Rahman Chowdhury', '1844533049', NULL, '65 Gulshan Avenue  Wroori Bank building  Gulshan-1 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1532, 1, 6, 1, 13, 25, 102052971, 'Anwar Traders (Uttara)', NULL, '1919261282', NULL, 'Sector-14  Road-23  House-1  Uttara  Dhaka-1230', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1533, 1, 6, 1, 13, 25, 102052974, 'Riveriya Restaurant (Mohammadpur)', 'Fahim', '1743227936', NULL, 'House #14 Fast Floor Road #1 Green City Chondrima Model Town Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1534, 1, 6, 1, 13, 25, 102052975, 'Pizzaology (Wari)', 'Mr. Rony', '1784903294', NULL, 'Rankin Street  Wari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1535, 1, 6, 1, 13, 25, 102052978, 'Maya Store (Narayanganj)', NULL, '1722697554', NULL, 'Narayanganj Foll Potti Kacha Bazar', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1536, 1, 6, 1, 13, 25, 102052980, 'Rangs Group (Tejgaon)', 'Mr. Mainul', '1313199501', NULL, '117/A Old Airport Road  Bijoy Sarani  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1537, 1, 6, 1, 13, 25, 102052981, 'Star Chicken (Khilgaon)', NULL, '1676729429', NULL, '394/B Near Alomgir catering', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1538, 1, 6, 1, 13, 25, 102052983, 'Dream Spicy (Norshingdi)', NULL, '1819264991', NULL, 'Dream Holiday Park  Pachdona  Narshingdi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1539, 1, 6, 1, 13, 25, 102052984, 'Snacks Darbar (Taltola)', 'Abdullah Habib', '1970083286', NULL, 'Beside Star Chicken  Taltola  Khilgaon  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1540, 1, 6, 1, 13, 25, 102052986, 'Daynamic Food Court (Dhanmondi 32)', NULL, '1986069633', NULL, 'Dhanmondi 12 A Near Takoya Moshjid', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1541, 1, 6, 1, 13, 25, 102052987, 'Dhakaiya Pizza (Puran Dhaka)', NULL, '01670732793/09638905895', NULL, '6/1 Suku Mia Lane (Iqbal Mansion ) satrowza  Dhaka 1100(Sultan Park Building Er Paser Goli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1542, 1, 6, 1, 13, 25, 102052993, 'Pizzaology (Khulna)', 'Mr. Belal', '1301781861', NULL, '118 Upper Jessore Rd  Khulna', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1543, 1, 6, 1, 13, 25, 102052866, 'Parkway (Aftab Nagar)', 'Abdullah Al zubayer', '1627010343', NULL, 'Opposite of east west university  City Bank both goli  Aftabnagar  Dhaka-1212', 15000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1544, 1, 6, 1, 13, 25, 102052894, 'Royal Castle (Lalbag 50)', NULL, '1707007798', NULL, 'Lalbag 50', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1545, 1, 6, 1, 13, 25, 102052931, 'Best Fried Chicken (BFC)- B.City - 01', NULL, '1757170012', NULL, 'Shop # 75  Level # 8  Panthapath  Dhaka  029111439 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1546, 1, 6, 1, 13, 25, 102052936, 'Best Fried Chicken (BFC)- Banani', NULL, '1941677142', NULL, 'House # 25  Block # H  Road # 11  Banani  Dhaka-1213  Tel: 0255042183', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1547, 1, 6, 1, 13, 25, 102052958, 'Shariatpur(DCC)', NULL, NULL, NULL, 'DCC Market  Gulshan-01', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1548, 1, 6, 1, 13, 25, 102052964, 'Nowshad Masala (Mirpur-11)', NULL, '1679870593', NULL, 'Mirpur 11 Kacha Bazar Near Mamun Masala', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1549, 1, 6, 1, 13, 25, 102052982, 'Ma Enterprise (Taltola)', NULL, '1973357216', NULL, 'Taltola Near Nayma', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1550, 1, 6, 1, 13, 25, 102052985, 'Hashtag Pizza (ElephantRoad)', 'Murshed', '1673464185', NULL, 'Lauren Vista Market Elephantroad Shop #5  169 Dhaka 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1551, 1, 6, 1, 13, 25, 102052989, 'Trust Showrma (ECB )', 'Seemanto', '1777970470', NULL, 'ECB Chattor  Miirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1552, 1, 6, 1, 13, 25, 102052990, 'Pizzaology (Mohammadpur)', NULL, '1893826842', NULL, 'Satmosjid Super Market Mohammadpur Bus Stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1553, 1, 6, 1, 13, 25, 102052996, 'Uttara Club Limited (Uttara)', NULL, '1709534133', NULL, 'Plot #6 Road #9 Sector #1 Uttara Model Town 1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1554, 1, 6, 1, 13, 25, 102052998, 'Oven (Mohammadpur)', NULL, '1310295260', NULL, 'Mohammadpur 383/B  katashur Shahi Mashjid Goli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1555, 1, 6, 1, 13, 25, 102052999, 'Saddam store( karwan bazar)', NULL, '1874610564', NULL, 'Kitchen  market  2nd  Floor karwan bazer', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1556, 1, 6, 1, 13, 25, 102053000, 'The Burger blast (Dhanmondi)', NULL, '1645009410', NULL, '17 west dhanmondi shankor.(mosjid er pase)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1557, 1, 6, 1, 13, 25, 102053003, 'Pizza Nor (Uttara)', 'Emrran', '1782090866', NULL, 'House# 41.Road# 8.Sector#13', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1558, 1, 6, 1, 13, 25, 102053005, 'Razib Varieties Store (Munshiganj)', NULL, '1955899500', NULL, 'Super market.Munshiganj Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1559, 1, 6, 1, 13, 25, 102053007, 'Crush Restaurant (Narayanganj)', NULL, '1778334482', NULL, '208/2 A  MD Square  Bhasa Sainik road  Chashara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1560, 1, 6, 1, 13, 25, 102053008, 'Gangchill (Kishorgonj)', NULL, '1641052186', NULL, 'Gangchill. Kishorgonj Sador', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1561, 1, 6, 1, 13, 25, 102053009, 'Jahin Enterprise (Mirpur-2)', 'Jasim Ahmed', '1715341732', NULL, 'Hous#16 Road#5 (Mirpur#2) Opposite of 2no Gate mirpur  cricket Stadium', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1562, 1, 6, 1, 13, 25, 102053010, 'Cheese Story (Mohammadpur)', NULL, '1737947286', NULL, 'House#25/2 Block-C 3rd Floor (Tajmahal Road)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1563, 1, 6, 1, 13, 25, 102053011, 'Chill Out (Wari)', NULL, '1792220637', NULL, 'Wari House #3', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1564, 1, 6, 1, 13, 25, 102053017, 'Best Fried Chicken(BFC)-Badda', NULL, NULL, NULL, 'Plot Cha # 70  70/A  Rupayun Millennium Square  Progati Sarani Uttar Badda Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1565, 1, 6, 1, 13, 25, 102053019, 'Omega kitchen (Bashundhara)', 'Suvo Vowmic', '1752440007', NULL, 'Mutual Trust Bank Bhaban  3rd Floor  15/5 Pragati Ave .Kalachadpur   Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1566, 1, 6, 1, 13, 25, 102053020, 'Appe Dena (Shimanto Somver)', 'Sumon', '1601010776', NULL, 'Shimonto Somver Food Coart', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1567, 1, 6, 1, 13, 25, 102053021, 'Nur Bread Factory', NULL, NULL, NULL, 'GM Bari  Satarkul  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1568, 1, 6, 1, 13, 25, 102053022, 'Awesome Kitchen (Lingroad)', NULL, '1911198710', NULL, 'House # 98 Gulshan Badda Ling Road Dhaka 1st Floor Dutch Bangla Bank ATM Booth', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1569, 1, 6, 1, 13, 25, 102053024, 'Spicy Ramna (Dhanmondi)', NULL, '01777811512  01719213123', NULL, 'H-54(5th Floor) R-10/A(Shatmoshjid Road)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1570, 1, 6, 1, 13, 25, 102052923, 'Jarvis Digital (Gulshan-1 Market)', 'Mr. Sami', '1689449640', NULL, 'Suite-3/B  House-1/A    Road-16/A   Gulshan-1 ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1571, 1, 6, 1, 13, 25, 102052939, 'Best Fried Chicken (BFC)- Khilgaon', NULL, '1921875061', NULL, 'Plot No-566/C  Block-C  Khilgaon  (Holding No-918)  Dhaka-1219  Tel: 0247217416', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1572, 1, 6, 1, 13, 25, 102052944, 'Best Fried Chicken (BFC)-Mirpur-10', NULL, '1701120570', NULL, 'Plot No-01  Road No-03  Block-A  Section-6  Green Avenue Park  Mirpur  Dhaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1573, 1, 6, 1, 13, 25, 102052953, 'Best Fried Chicken (BFC)-JFP', NULL, '1316415974', NULL, 'Shop No: 5C-043  Level # 5  Jamuna Future Park  Dhaka.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1574, 1, 6, 1, 13, 25, 102052955, 'Maa Enterprise (Karwanbazar)', 'Mr. Riyaz', '1797424737', NULL, 'Shop No: 78-79  Kitchen market  Karwanbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1575, 1, 6, 1, 13, 25, 102052972, 'Mr Pizza (Bashundhara)', NULL, '1600019605', NULL, 'Bashundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1576, 1, 6, 1, 13, 25, 102052973, 'J M Enterprise (Mohammadpur)', NULL, '1965918193', NULL, 'Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1577, 1, 6, 1, 13, 25, 102052976, 'Cheese Loaded (Bashundhara)', NULL, '01975577934/01610203030', NULL, 'Bashundhara Urban Void Food Court Beside Buffet King', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1578, 1, 6, 1, 13, 25, 102052979, 'L F C (Gazipura)', NULL, '1711338163', NULL, 'Gazipura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1579, 1, 6, 1, 13, 25, 102052995, 'Chicken king (Satarkul)', 'Md.Juwel', '1727265397', NULL, 'Satarkul  Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1580, 1, 6, 1, 13, 25, 102053002, 'Baily Bites (Balyroad)', NULL, '1700679001', NULL, 'New Balyroad Green Kazi 1st Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1581, 1, 6, 1, 13, 25, 102053013, 'City kebab & Cafe (ECB)', 'Mr.Najim uddin Bhuiyan', '1707132741', NULL, '562.Ecb Chattor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1582, 1, 6, 1, 13, 25, 102053023, 'Al-Amar (Gulshan)', NULL, '1718423945', NULL, 'Sanmar Tower-2  R-2  H-38/A  Level-6  Gulshan  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1583, 1, 6, 1, 13, 25, 102053026, 'Bashundhara Amusement Park Ltd.', NULL, '1991197822', NULL, 'Plot # 125/A  Block# A  Bashundhara R/A  Road No - 2 Baridhara  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1584, 1, 6, 1, 13, 25, 102053027, 'Food Stove (Wari)', NULL, '1818153237', NULL, 'Shop-12 Rosevally Shopping  Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1585, 1, 6, 1, 13, 25, 102053028, 'The Ground (Wari)', NULL, '1717430137', NULL, 'Wari Post Office', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1586, 1, 6, 1, 13, 25, 102053030, 'Junk Cafe(Mirpur-6)', NULL, '1882451619', NULL, 'House-01 Road-09 Block-C Section-06', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1587, 1, 6, 1, 13, 25, 102053031, 'H K Enterprise (Mirpur 60 Feet)', NULL, '1711935976', NULL, '239/A Southpirarbag Mirpur 60 Feet Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1588, 1, 6, 1, 13, 25, 102053034, 'Cheese Story (Mirpur-10)', NULL, '1784887544', NULL, 'Plot #23 Block K Section #2 Singapur Hotel Mirpur 10', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1589, 1, 6, 1, 13, 25, 102053037, 'American Special burger (Sylhet)', NULL, '1768374769', NULL, 'Sylhet Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1590, 1, 6, 1, 13, 25, 102053038, 'Cielo Roof Top (Banani)', 'Mr. Arif', '1782247034', NULL, 'Awr-Nib tower  14th  floor  Roof topRoad-11  House-99  block-C  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1591, 1, 6, 1, 13, 25, 102053039, 'Omega Kitchen (Gulshan)', NULL, '1673022122', NULL, 'Concord SARK building  1st floor  road-132  house-56/A  Gulshan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1592, 1, 6, 1, 13, 25, 102053041, 'Wow Chef (Pink City)', 'Sakib Ullah Arman', '1936587538', NULL, '5th Floor  Pink City  Gulshan-2', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1593, 1, 6, 1, 13, 25, 102053044, 'Pizza End(DEPZ)', NULL, '01313700696  01313700697', NULL, '183 NS Tower(Near DEPZ Gate)  Gonok Bari Ashulia Dhaka', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1594, 1, 6, 1, 13, 25, 102053045, 'Dusa King  (Uttara)', NULL, '1715618095', NULL, 'Road #2 Uttara Rajlokhi Shopno Building 2nd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1595, 1, 6, 1, 13, 25, 102053047, 'Little Yellow', NULL, '1789795003', NULL, '223/1-A Malibagh(Near Malibagh Shahi Mashjid)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1596, 1, 6, 1, 13, 25, 102052966, 'Tasty Bite (Polton)', NULL, '1707001823', NULL, '59/2 Purana Polton  Shopno Building', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1597, 1, 6, 1, 13, 25, 102052969, 'Mad Chef (Sylhet)', NULL, '1859317991', NULL, '3rd Floor Arcadia Shopping Mall  Darshan Dewri Sylhet 3100', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1598, 1, 6, 1, 13, 25, 102052991, 'Raza Masala (Mirpur-11)', NULL, '1671516075', NULL, 'Mirpur 11 Kacha Bazar  Near Mamun Masala', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1599, 1, 6, 1, 13, 25, 102053006, 'Hear World(Dhanmondi)', NULL, '1534837119', NULL, 'Dhanmondi Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1600, 1, 6, 1, 13, 25, 102053029, 'Showrma House(Badda)', NULL, '1790735061', NULL, 'Primer Plaza shopping Mall', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1601, 1, 6, 1, 13, 25, 102053035, 'The Coffee Club (Sylhet)', 'Mr. Pallab', '1714121313', NULL, 'Bir Bikrom Yamin Complex  3rd Floor  Kumar Para  Sylhet', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1602, 1, 6, 1, 13, 25, 102053040, 'Khan Fast Food (Noria)', 'Monir Khan', '1729897011', NULL, 'Kata Bon Elephent Road Al Baraka Tower Building Lift-9', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1603, 1, 6, 1, 13, 25, 102053042, 'Cafa GOGA', NULL, '1947820176', NULL, '151/2/28 Tarabag Tilpara Khilgaon (Opposite to khilgaon Tilpa para fire Service Station)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1604, 1, 6, 1, 13, 25, 102053043, 'Cafe GAGA(Tilpa Para)', NULL, '1947820176', NULL, '151/2/28 Tarabag Khilgaon (opposite to khilgon TIlpa Para Fire service Station)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1605, 1, 6, 1, 13, 25, 102053048, 'Indian Tasty(B.City)', NULL, '1816818633', NULL, 'B.city Shop#43', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1606, 1, 6, 1, 13, 25, 102053050, 'Food Flix (Mogh bazer)', 'Momin', '01844266214/', NULL, 'Mogh bazer Kazi office Lane House-111', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1607, 1, 6, 1, 13, 25, 102053051, 'Lal Bati (Bashundhara)', NULL, '1701788692', NULL, 'Rajbari Food Court Shop #7 Block A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1608, 1, 6, 1, 13, 25, 102053052, 'Sheraton Food (Bashabo)', NULL, '1757374255', NULL, '123/A Moddho Bashabo  Bou Bazar Dhaka 1214 Near Shabujbag Thana', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1609, 1, 6, 1, 13, 25, 102053054, 'Kahve Cafe Garden (Banani)', NULL, '1710860602', NULL, 'House #55 Block E Road #13 Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1610, 1, 6, 1, 13, 25, 102053056, 'Kavana See Food (B City)', 'MD Saiful', '1724695511', NULL, 'Bashundhara City Block A Shop #77', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1611, 1, 6, 1, 13, 25, 102053057, 'Food Factor (Mirpur-2)', 'Mr.Kamal', '1672449811', NULL, 'Road-2 House-20 Block-G Section-2 Mirpur Dhaka-1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1612, 1, 6, 1, 13, 25, 102053061, 'The Pabulum (Uttara)', NULL, '1786611742', NULL, 'Road-10  Sector-11  Uttara  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1613, 1, 6, 1, 13, 25, 102053062, 'Back Way (Tongi)', NULL, '1811559014', NULL, 'Holy Home Plaza 9/1 Shakil Soroni College Road  Tongi Gazipur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1614, 1, 6, 1, 13, 25, 102053063, 'Burgerology (Elephant Road)', NULL, '01741-987805', NULL, '209/A New Elephant Rd  (1st Floor)  North Side From Bata Signal 1205 Dhaka ', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1615, 1, 6, 1, 13, 25, 102053064, 'Pepperoni Limited', 'Towfique Reza Tonmoy', '1404427565', NULL, 'Secret Recipe Warehouse  220 Kunipara  Tejgaon  Dhaka 1215', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1616, 1, 6, 1, 13, 25, 102053065, 'Dynamic Food Court Ltd. (Dhanmondi-5)', NULL, '1755701162', NULL, 'Shudha Shodon Dip  Road No-05  Dhanmondi  Dhaka- 1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1617, 1, 6, 1, 13, 25, 102053067, 'Food Nest (Green Road)', NULL, '1689504036', NULL, 'Green Supar Market Opposite Besaid Tonghor & Tehari Ghor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1618, 1, 6, 1, 13, 25, 102053068, 'Sub Lovers (Badda)', NULL, '1874609814', NULL, 'Dokhin Badda Near Kacha Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1619, 1, 6, 1, 13, 25, 102053069, 'Junket (Mirpur DOHS)', NULL, '1753357548', NULL, 'Mirpur DOSH Shopping Complex Lift#7  Shop #9', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1620, 1, 6, 1, 13, 25, 102053071, 'Mr. Saiful (Mirpur-1)', NULL, '1648889602', NULL, 'Priyangka housing  Block-A  Road No-1  House-34  Mirpur-1', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1621, 1, 6, 1, 13, 25, 102053072, 'Hang Out Cafe (Uttara)', NULL, '1948210979', NULL, 'House-11  5th Floor  Shah Makdum Avenue  Sector-13  Uttara  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1622, 1, 6, 1, 13, 25, 102052968, 'Salt & Pepper (Bashundhara)', NULL, '1676809805', NULL, 'Rajbari Food Court  Bashundhara R/A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1623, 1, 6, 1, 13, 25, 102052988, 'Food Oven  Kitchen (Tongi)', NULL, '1687100602', NULL, 'Tongi  College Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1624, 1, 6, 1, 13, 25, 102053004, 'Pizza Delicious (Mirpur ECB)', NULL, '1915696965', NULL, 'Mirpur ECB Chattar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1625, 1, 6, 1, 13, 25, 102053016, 'Coffee Glory International', 'Prosanto Debnath', '1791989423', NULL, 'KA 95 Kuratoli Kuril Bishowroad', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1626, 1, 6, 1, 13, 25, 102053032, 'Lovely Loungee (uttara)', 'Mr.Rasel', '1914747083', NULL, 'Sector-7 Road-18 House-56 (Uttara)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1627, 1, 6, 1, 13, 25, 102053053, 'Mokka store (Shantinagar)', NULL, '1728554307', NULL, 'Shantinagar Bazar C 16 Dhaka 1217', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1628, 1, 6, 1, 13, 25, 102053059, 'Islam Traders (Donia)', NULL, '1924934634', NULL, 'ARS Tower Front Site 436 Noyapara Road Donia', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1629, 1, 6, 1, 13, 25, 102053066, 'Bella Italia(Uttara)', NULL, '1717906690', NULL, 'Plot-6  Level-5  Sonargaon Janapad Sector-11', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1630, 1, 6, 1, 13, 25, 102053070, 'PAPIZZA  (Mirpur-6)', NULL, '1601110555', NULL, 'Plot 3-4 Block A Avenue 5 Mirpur 6', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1631, 1, 6, 1, 13, 25, 102053073, 'Kudos (Mohammadpur)', NULL, '01400-006353', NULL, 'Y/10 Nurjahan Road Mohammadpur Dhaka-1207 1207 Dhaka  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1632, 1, 6, 1, 13, 25, 102053074, 'Renu\'s Kitchen (Uttara)', 'Renu Akter/ Mr. Faruk', '1761400811', NULL, 'House-24  Road-9  Sector-11  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1633, 1, 6, 1, 13, 25, 102053077, 'Crush Restaurant(Uttara)', NULL, NULL, NULL, 'Uttara Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1634, 1, 6, 1, 13, 25, 102053079, 'Indian Kitchen (Eastern Plaza)', NULL, '1307610098', NULL, 'Eastern Plaza Food court  Hatirpool  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1635, 1, 6, 1, 13, 25, 102053082, 'Chap Stick (Mirpur 60Feet)', NULL, '1799531656', NULL, 'Mirpur 60 Feet Near Chill Out LTD', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1636, 1, 6, 1, 13, 25, 102053083, 'Happy Tummy (Hatirjheel Road)', 'Moshiul Islam', '1712286066', NULL, '211/C  Ulon Road  West Rampura  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1637, 1, 6, 1, 13, 25, 102053084, 'Pizza Dot Com (Khilkhet)', NULL, '1780305504', NULL, 'Bashir House  Kha-82/1-A  namapara  Khilkhet', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1638, 1, 6, 1, 13, 25, 102053086, 'Kudos (Wari)', NULL, '01531-717315', NULL, '15/A   Rankin Street  Wari 1203 Dhaka ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1639, 1, 6, 1, 13, 25, 102053089, 'Hang Out (Dhanmondi)', 'Manager- Mr. Forhad', '1796590600', NULL, 'Rupayan ZR Plaza  Road-19  Satmoszid road  Dhanmondi  Dhaka-1209', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1640, 1, 6, 1, 13, 25, 102053092, 'Ismat Enterprise (JamunaFuture Park)', NULL, '1718957150', NULL, 'Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1641, 1, 6, 1, 13, 25, 102053095, 'Pizza Glaze (Dhanmondi)', NULL, '1728006634', NULL, 'House-73 shankar west Dhanmondi', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1642, 1, 6, 1, 13, 25, 102053097, 'Cafe Jheel (Press Club)', NULL, '1680160216', NULL, '18/1  Topkhana road  Press Club  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1643, 1, 6, 1, 13, 25, 102053098, 'Food Lab cafe & Restaurant (Sylhet)', 'Mr. Sohel Rana', '1788717235', NULL, 'Sylhet  Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1644, 1, 6, 1, 13, 25, 102053100, 'Kudos (Mirpur-6)', NULL, '01955-556662', NULL, 'House 5-6 lane-15 block-D section- 6 Mirpur Dhaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1645, 1, 6, 1, 13, 25, 102053101, 'Gweebarra bakery Ind. Ltd.', 'Mr. Shahriar', '1729076911', NULL, 'Boro Rangamatia  Zirabo  Ashuliya  Savar  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1646, 1, 6, 1, 13, 25, 102053102, 'Indian Hut (B.City)', 'Safiul', '1919772866', NULL, 'B.city Level-8 Block-A Shope-67', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1647, 1, 6, 1, 13, 25, 102053108, 'Tarky House (Mirpur-12)', NULL, '1953003025', NULL, 'Mirpur-12 Dohs Shopping complex Level-8 Shop No-10', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1648, 1, 6, 1, 13, 25, 102052994, 'Pizza Terminal (Bashundhara)', NULL, '1741124839', NULL, '442 New Apollo Road A Block Dhalibari Poket Gate Six Storage Building Ground Floor Bashundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1649, 1, 6, 1, 13, 25, 102052997, 'Street Oven (Taltola)', NULL, '1919406827', NULL, 'House-394/B  Malibag Chowdhury para  Khilgaon  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1650, 1, 6, 1, 13, 25, 102053012, 'Prince Kitchen (Mirpur-12)', NULL, '1611117033', NULL, 'Sultan Mension #3 Sujatnagar Mirpur #12 Pallabi Dhaka 1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1651, 1, 6, 1, 13, 25, 102053014, 'Xompesh.(Mirpur DOHS)', 'Noman', '1726667999', NULL, 'Shop no-6 Level-7. Mirpur DOHS shopping Complex.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1652, 1, 6, 1, 13, 25, 102053023, 'Spicy Ramna Restaurant(Dhn)', NULL, '1777811512', NULL, 'H-54(Floor-5th) R-10/A Satmoshjid Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1653, 1, 6, 1, 13, 25, 102053060, 'Paprika (Shaymoli)', NULL, '1710223391', NULL, '23/1 Bir Uttam Nurzzaman Road Oposite Of Shaymoli Shishumeli Foodover Bridge', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1654, 1, 6, 1, 13, 25, 102053081, 'AR Enterprise (Mirpur-1)', 'Mr. Arif', '1724583913', NULL, '182/A first colony  Lalkuthi bazar  Mazar road  Mirpur-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1655, 1, 6, 1, 13, 25, 102053094, 'Garish Dough (Mohammadpur)', NULL, '1677645723', NULL, 'House-24/21  Block-F  Bizli Moholla  Mohammadpur', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1656, 1, 6, 1, 13, 25, 102053103, 'Dine and gossip (Mirpur-1)', 'Muhid', '1787796336', NULL, 'House-12 Road-5 Block-G mirpur-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1657, 1, 6, 1, 13, 25, 102053105, 'Kudos (Uttara)', NULL, '1934887812', NULL, '26 gausul Azam Avenue  Sec-13  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1658, 1, 6, 1, 13, 25, 102053106, 'Moon Shawarma House(Jail Gate)', NULL, '1936108044', NULL, '123 Nazim Uddin Road-47/2A Dhaka-1211', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1659, 1, 6, 1, 13, 25, 102053110, 'Sub Lovers (Eastern Plaza)', NULL, '1642405402', NULL, 'Eastern Plaza Food Court  4th Floor  Hatirpool  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1660, 1, 6, 1, 13, 25, 102053112, 'Cha-Ddabaaz(Dhanmondi)', NULL, '1623735524', NULL, 'Plot-61.New Zigatala Mor.Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1661, 1, 6, 1, 13, 25, 102053117, 'Bashundhara Kitchen', 'Md.Monirul Haq', '1671515853', NULL, '15/5  MTB Building(3rd Floor)  Progati Sarani Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1662, 1, 6, 1, 13, 25, 102053118, 'Abdul Hakim Store (Mirpur1)', NULL, '1305198125', NULL, 'Mirpur 1   5& 7 Near hazrat Sha ali Mangsho Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1663, 1, 6, 1, 13, 25, 102053122, 'HRK Foods Ltd (Mirpur 6)', NULL, '1765993654', NULL, 'House #9/1 Block B Mirpur 6', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1664, 1, 6, 1, 13, 25, 102053123, 'Golden Pizza House (Uttara)', 'Md Harun Or Rashid', '1718664646', NULL, 'Shop-35/A  House-89 Road-28  Sectror-07 Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1665, 1, 6, 1, 13, 25, 102053124, 'LongHorn Steak &Pizza (Malibagh)', NULL, '1759257074', NULL, '78/B Malibagh Chowdhury Para', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1666, 1, 6, 1, 13, 25, 102053126, 'AFGHAN B.B.Q (Aftabnagor)', NULL, '1703300010', NULL, 'Shop No #1 Plot #1 Block #A Opojite East West University Aftabnagor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1667, 1, 6, 1, 13, 25, 102053127, 'Hotel Castle Salam (Khulna)', 'Mr. Rezaul Karim  Executive Director', '1819710025', NULL, 'G-8  Taltola Lane  KDA Avenue  Khulna-9000', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1668, 1, 6, 1, 13, 25, 102053001, 'Mr Gosto (Mirpur ECB)', NULL, '1756866797', NULL, 'Mirpur EC B Chattar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1669, 1, 6, 1, 13, 25, 102053015, 'Street Oven( Dhanmondi Head Office)', NULL, '1313717261', NULL, 'Dhanmondi House #38', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1670, 1, 6, 1, 13, 25, 102053018, 'Crush Restaurant (Zigatola)', 'Alom', '1928282863', NULL, 'Keari Criescent 60 Satmosjid Road  Level #10 Zigatola Bus Stand Dhanmondi 1209', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1671, 1, 6, 1, 13, 25, 102053076, 'Allahar Dan Genarel Store (Banani)', NULL, '1741494798', NULL, 'Banani Kachabazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1672, 1, 6, 1, 13, 25, 102053090, 'Pizza Heist (Mirpur-6)', 'Mr Reyel', '1775428428', NULL, 'House-44 Avenue-5 Block-A( Mirpur-6)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1673, 1, 6, 1, 13, 25, 102053120, 'Chillux (Kishorgonj)', 'Suruj', '1912291224', NULL, 'Kishorgonj Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1674, 1, 6, 1, 13, 25, 102053128, 'Ayesha Enterprise (Vairob)', NULL, '1846042280', NULL, 'Vairob Sadar  Vairob', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1675, 1, 6, 1, 13, 25, 102053131, 'Trump Cafe(Zigatola)', NULL, '1818554492', NULL, 'Keari Crescent(3rd Floor)  Zigatola Bus Stand Dhanmondi', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1676, 1, 6, 1, 13, 25, 102053133, 'Oven (Banani)', NULL, '1946770576', NULL, 'House #37 Road #6 Block C  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1677, 1, 6, 1, 13, 25, 102053136, 'Street Oven(Mymensing)', 'Md.Faruk', '1936344874', NULL, 'Ferdows Tower  1 Shayma Choronroy Road  Zilla School More Mymensing-2200', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1678, 1, 6, 1, 13, 25, 102053137, 'Queens Confectioneries (Uttra)', NULL, NULL, NULL, 'House-24 Garib E Newaz Avenue. Sector--11 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1679, 1, 6, 1, 13, 25, 102053140, 'Pita & Burger (Baily Road)', NULL, '1965555444', NULL, 'Gold Palace Ground Floor 3 New Bally Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1680, 1, 6, 1, 13, 25, 102053142, 'Ami Gos Pizza &Restaurant (Zail Gate))', NULL, '1920018088', NULL, 'Abul Hasnat Road  7 Razza Mazar Zail Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1681, 1, 6, 1, 13, 25, 102053146, 'Dynamic Food Court (Zigatola)', 'Jakir Hosain', '1627153237', NULL, 'Near Zigatola Bus Stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1682, 1, 6, 1, 13, 25, 102053147, 'Eat Way (Eastern Plaza)', NULL, '1993010733', NULL, 'Shop No-9 Eastern  Plaza Food Crout', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1683, 1, 6, 1, 13, 25, 102053150, 'Burger Man (Savar)', 'Mr. Joy', '1676626400', NULL, 'Shimultola  CRP road  Savar', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1684, 1, 6, 1, 13, 25, 102053151, 'Mutz (Mohammadpur)', NULL, '1719152552', NULL, '88/1 Katasur Mohammadpur Near Al haj Makbul Hosen College', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1685, 1, 6, 1, 13, 25, 102053152, 'Pizza Loop (Mirpur 10)', NULL, '1953376154', NULL, 'House #2 Road #3 Block K-A Section #10 Yummy Yummy Restaurant ar Buillding Ar 2nd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1686, 1, 6, 1, 13, 25, 102053153, 'Kazi Tanvir Akhter', NULL, '1971018416', NULL, 'House-9 Road-5 Block-A Section-10 Pallabi Mirpur (Benaroshi PalliRoad-3 )', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1687, 1, 6, 1, 13, 25, 102053155, 'Prince Burger (Eastern Plaza)', NULL, '1815931526', NULL, 'Shop #7 Level #4 Food Court  Eastern Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1688, 1, 6, 1, 13, 25, 102053157, 'Food buddy (Gulshan 2)', 'Razu Khan', '1940771875', NULL, 'Kha 66/8  Lakeside Sahajadpur  Gulshan 2  Dhaka 1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1689, 1, 6, 1, 13, 25, 102053158, 'Mukta Enterprise (Newmarket)', NULL, '1700812683', NULL, 'New market Shop -63 Block-D', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1690, 1, 6, 1, 13, 25, 102053159, 'Mayer Duya Moshla Vandar', NULL, '1918039366', NULL, 'New market Shope No-45', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1691, 1, 6, 1, 13, 25, 102053160, 'Ghore Pizza Cloud(Khil)', NULL, NULL, NULL, 'Khilgoan  Nurbag Mosjid', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1692, 1, 6, 1, 13, 25, 102052701, 'Star Cineplex (Mohakhali)', 'Anamul', '1682261096', NULL, 'S K S Tower Level #3', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1693, 1, 6, 1, 13, 25, 102052716, 'Zikra Traders(Kallyanpur)', 'Mr. Rupok', '1307539073', NULL, 'Darussalam Tower  Darussalam  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1694, 1, 6, 1, 13, 25, 102052740, 'Sonia Store(Sonir Akhra)', 'Kamrul', '1757340259', NULL, 'Sonir Akhra Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1695, 1, 6, 1, 13, 25, 102052756, 'SA Foods (Demra Staff Quarter)', NULL, '1861589444', NULL, 'Demra Staff Quarter', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1696, 1, 6, 1, 13, 25, 102052760, 'Oasis (Mohammad pur)', NULL, '1944541842', NULL, 'Mohammad pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1697, 1, 6, 1, 13, 25, 102052761, 'Hotel Lake Castle (Gulshan 2)', 'Mizan', '1911007176', NULL, 'House 1/A Road 68/A .Gulshan 2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1698, 1, 6, 1, 13, 25, 102052762, 'Salt & Butter (Basundhara)', 'Nasir', '1711636793', NULL, 'Basundhara Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1699, 1, 6, 1, 13, 25, 102052763, 'Chicken Boost (Banani)', NULL, '1914282431', NULL, 'House-70  Road-17 Block-E', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1700, 1, 6, 1, 13, 25, 102052764, 'Liza Trading (Mohammadpur)', NULL, '1916721282', NULL, 'Mohammadpur Krishi Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1701, 1, 6, 1, 13, 25, 102052765, 'The Fire Grill (Dhanmondi)', NULL, '1996101171', NULL, 'House #67 Navana G H Height .Near Sonkor Bus Stop', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1702, 1, 6, 1, 13, 25, 102052766, 'Ice Cream Parlar(Mowchak)', NULL, '1636659683', NULL, 'Fortune Shopping Mall  Mowchak', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1703, 1, 6, 1, 13, 25, 102052767, 'Euro Cafe Shawarma House (Munshiganj)', 'SM Robin', '1720900027', NULL, '148-150 (1St floor) Munshiganj sadar  pouro Market  Munshigang', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1704, 1, 6, 1, 13, 25, 102052768, 'Tomato Restaurant& Juice Bar(Khilkhet)', 'Mubarok', '1534106395', NULL, 'Mohammadiya Housing  Khilkhet Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1705, 1, 6, 1, 13, 25, 102052770, 'Anti Clock (Purbachol)', 'Shahariar', '1760152390', NULL, 'Purbachol Mehedi  Food Court', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1706, 1, 6, 1, 13, 25, 102052771, 'Burger Mania (Mirpur-2)', 'Mr Angkur', '1684768673', NULL, 'House #18 Road #2 Block #G Section #2 Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1707, 1, 6, 1, 13, 25, 102052773, 'Burger Lab (Mirpur-1)', NULL, '1777428021', NULL, 'House # 42  Block # E  Zoo Road 2  Opposite of eidgah field  Mirpur 1.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1708, 1, 6, 1, 13, 25, 102052774, 'Food Swing (Purbachol)', 'Muktadir Hosain', '1817532998', NULL, 'Purbachol Mehedi Market.Shop No 172.173', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1709, 1, 6, 1, 13, 25, 102052776, 'Burger Barrista (Laxmibazar)', 'Rbin', '1911727670', NULL, '73 Subash Bose Avenue.1st Floor Luxmibazar Dhaka 1100', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1710, 1, 6, 1, 13, 25, 102052777, 'Cheese Bitr (Banasree)', 'Juyel', '1799943125', NULL, 'Block #D Road #5 House #19  Rampura Banasree', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1711, 1, 6, 1, 13, 25, 102052779, 'DPL Restaurant & Bar (Panthopath)', 'Kazi Shihab', '1793369288', NULL, '147/A/1 Green Road .Taher Bhabon Dhaka1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1712, 1, 6, 1, 13, 25, 102052780, 'Mint Leaf (Simanto Sombhar)', NULL, '1830141754', NULL, 'Simanto Sombhar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1713, 1, 6, 1, 13, 25, 102052781, 'Bachelor\'s (Nikunja 2)', 'Nayem', '1790239999', NULL, 'Road # 16  House #  21  Nikunja 2  Khilkhet Dhaka 1229', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1714, 1, 6, 1, 13, 25, 102052783, 'Roadside Kitchen (Mirpur-1)', 'Maruf', '1406666146', NULL, '3rd Level 42/1 Section #1 Block#E Mirpur 1.Zoo RoadDhaka 1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1715, 1, 6, 1, 13, 25, 102052786, 'Estetico Cafe (Bashundhara)', NULL, '1847355601', NULL, 'Burgerlab Building  Bashundhara R/A', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1716, 1, 6, 1, 13, 25, 102052788, 'Lezzetli (Simanto Sombhar)', NULL, '1879830055', NULL, 'Simanto Sombhar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1717, 1, 6, 1, 13, 25, 102053046, 'Sao Trio(Dhan)', NULL, '1714895825', NULL, 'Gigatola bus Stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1718, 1, 6, 1, 13, 25, 102053055, 'Snap Eat (Dhanmondi)', NULL, '1716582272', NULL, 'House-54  Road-10/A  Satmosjid road  Dhanmondi', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1719, 1, 6, 1, 13, 25, 102053058, 'Treat cafe (Dhanmondi)', NULL, '01794155434/01300805112', NULL, 'Kb Square -11th Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1720, 1, 6, 1, 13, 25, 102053144, 'Mr.Mamun(Jeshore)', NULL, '1731358343', NULL, 'Jeshore Sadar', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1721, 1, 6, 1, 13, 25, 102053156, 'Cafe Blue(Panthopath)', NULL, '1838880159', NULL, 'Union Height Building 55 -2 West Panthopath Dhaka Opposite Of Square Hospital', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1722, 1, 6, 1, 13, 25, 102053161, 'AHM Enterprise (Newmarket)', 'Mr. Hanif', '1711663890', NULL, 'New Super market   Holding-132  Besise Kachabazar  Newmarket', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1723, 1, 6, 1, 13, 25, 102053163, 'Star Pizza (Madaripur)', 'Mr. Sohel Khan', '1758387764', NULL, 'Circuit House Road  Selfie Tower  Madaripur Sadar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1724, 1, 6, 1, 13, 25, 102053164, 'Toost (Uttara)', 'Mr Shaheen', '1785644355', NULL, 'House #269 Sangrami Sharani Maddha Azampur Azampur Kacha Bazar Beside Brack Market Azampur Rail Line', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1725, 1, 6, 1, 13, 25, 102053165, 'The Spicy Kitchen (Gulshan-1)', NULL, '1911103790', NULL, 'Gulshan-1 Navana Tower', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1726, 1, 6, 1, 13, 25, 102053166, 'Live Green (Gulshan 1)', NULL, '1811216285', NULL, 'House #6 Road # 23 A Gulshan 1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1727, 1, 6, 1, 13, 25, 102053167, 'Mr Manik Supar Shop (Uttara)', NULL, '1971684433', NULL, 'House #88 Road #15  Sector #14 Uttara Dhaka 1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1728, 1, 6, 1, 13, 25, 102053170, 'Chickens (Mohammadpur)', 'Shakkhor', '1716527377', NULL, 'House 2/4 Block A Nobwdoy  Housing (End of Road #6 Mohammadiya  Housing Socity Mohammadpur Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1729, 1, 6, 1, 13, 25, 102053173, 'Hobnob Coffee (Uttara)', NULL, '1979316428', NULL, 'House-55  1st floor  Gausul Azam avenue  Sector-14  Uttara', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1730, 1, 6, 1, 13, 25, 102053174, 'SM Traders (Banasree)', NULL, '1710040743', NULL, 'Block #Am  Road #8 House #13 Near Power House', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1731, 1, 6, 1, 13, 25, 102053179, 'PIXEL ( Dhanmondi )', 'Mr. Mahbubur Rahman', '1750333333', NULL, 'Kashba Center (5 th Floor) House# 5/2  Road# 4   Dhanmondi.(Western Grill Building)', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1732, 1, 6, 1, 13, 25, 102053180, 'The Pablum(Polasi)', NULL, '1987355411', NULL, '22.6 Dhakeshwari Road', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1733, 1, 6, 1, 13, 25, 102053139, 'Beet Dynamic (Dhanmondi)', NULL, '1755701162', NULL, 'Zigatola', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1734, 1, 6, 1, 13, 25, 102053148, 'Pizza Mela (N.Gonj)', 'Mr.Mujb', '1612813305', NULL, 'Golachipa Rupar Barir mor(N.Gonj)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1735, 1, 6, 1, 13, 25, 102053177, 'Onnow Ltd (Tejgaon)', NULL, '1670108165', NULL, 'House-443. Western Garden City .East Nakhalpara Tejgaon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1736, 1, 6, 1, 13, 25, 102053129, 'Purnima Restaurant (Mirpur 2)', NULL, '1917269581', NULL, 'Mirpur 2  near stadium', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1737, 1, 6, 1, 13, 25, 102053145, 'Beans & Grills (Banasree)', NULL, '01923849464 /01660196267', NULL, 'House #1 Road #1  E  Block Banasree Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1738, 1, 6, 1, 13, 25, 102053171, 'Fish Valley & BBQ (Donia)', 'Mr. Raseel', '1720212689', NULL, 'Goal Barir Mor  Donia  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1739, 1, 6, 1, 13, 25, 102053176, 'Burger Maniya(Uttara)', NULL, '1625235175', NULL, 'Uttra Abdullah Pur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1740, 1, 6, 1, 13, 25, 102052757, 'Pinewood Cafe Kichen (Banani)', 'Arzu', '1757102333', NULL, 'House #48 Road #13/C Block #E  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1741, 1, 6, 1, 13, 25, 102052769, 'Manal Enterprise (Mirpur-60 Feet)', 'Mr Parvez', '1675915317', NULL, '239/3  Middle Pirerbagh Pabnagoli 60 Feet Road Dhaka 1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1742, 1, 6, 1, 13, 25, 102052772, 'Tiffin Box(Panthopath)', 'Ashif', '1934875663', NULL, 'H-66  Green Road  Flot-10 Rajanigandha Complex  01834995294', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1743, 1, 6, 1, 13, 25, 102052775, 'Coventina Lake Suites (Gulshan 2)', NULL, '1712489217', NULL, 'House #28 Road #113 Gulshan 2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1744, 1, 6, 1, 13, 25, 102052781, 'Chiyars Eats (Purbachol)', 'Jaman', '1617599160', NULL, 'Mehedi Food Court', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1745, 1, 6, 1, 13, 25, 102052782, 'Chiyars Eats (Purbachol)', 'Jaman', '1617599160', NULL, 'Mehedi Food Court Purbachol', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1746, 1, 6, 1, 13, 25, 102052784, 'Coffelick Cafe (Narayangonj)', 'Tofazal Hossain', '1932408588', NULL, '1/4 A Sher E  Bangla Road .Octo Office Narayangonj.Arribs School Golli Opposite OfKashfa Homes', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1747, 1, 6, 1, 13, 25, 102052785, 'M/S Shohag Traders(Tongi)', NULL, NULL, NULL, 'Noakhali Potti Tongi Bazar', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1748, 1, 6, 1, 13, 25, 102052787, 'Cheese s  Crust (Jail gate)', NULL, '01931500078/01930110408', NULL, '47/2 A Nazim Uddin Road .Dhaka 1211', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1749, 1, 6, 1, 13, 25, 102052789, 'Pizza Gang (Uttara)', NULL, '1816656582', NULL, 'Sector #3 Road #1 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1750, 1, 6, 1, 13, 25, 102052790, 'Mama food (Purbachol)', 'Ashraful', '1403875504', NULL, 'Mehedi Food Court Purbachol', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1751, 1, 6, 1, 13, 25, 102052791, 'AL Fahim Enterprise(N.Ganj)', 'Foyz', '1720912071', NULL, 'Bulata Gocea Segla B-Rupgoan Narangonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1752, 1, 6, 1, 13, 25, 102052792, 'Porshi Store(Rampura)', NULL, NULL, NULL, '222  Wapda Road West Rampura', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1753, 1, 6, 1, 13, 25, 102052793, 'Taste Of Nawab(Nazira Bazar)', 'Abdulla Al Mamun', '1816622733', NULL, '74/75 Kazi Alauddin Road Nazira Bazar Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1754, 1, 6, 1, 13, 25, 102052794, 'Cafe D Amore(Mirpur60Feet)', 'Miraz', '1712025244', NULL, '220/2South Pirerbag 60 Feet Amtola Mirpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1755, 1, 6, 1, 13, 25, 102052795, 'Baithok Khana(Badda)', NULL, '1724220574', NULL, 'Cha-63/4  Uttar Badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1756, 1, 6, 1, 13, 25, 102052796, 'Station 121(Gulshan-02)', 'Sayed Hossain (Nayaon)', '1690013961', NULL, 'House-121/B  Gulshan Avenue  Gulshan  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1757, 1, 6, 1, 13, 25, 102052797, 'Doreen Hotels & Resorts Ltd.', 'Md. Rashedul Islam', '1966662175', NULL, 'House-16B  Road-35  Gulshan-2  Dhaka-1212', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1758, 1, 6, 1, 13, 25, 102052799, 'Water World(Faridpur)', NULL, '1766617952', NULL, 'Faridpur', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1759, 1, 6, 1, 13, 25, 102052800, 'BON APPE TIT (Taltola)', NULL, '1930010220', NULL, 'Taltotal Market  Khilgaon  Dkaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1760, 1, 6, 1, 13, 25, 102052802, 'Food Khan (Uttara)', 'Mr. Imran', '1624064463', NULL, 'Sector-5  Road-4/A  House-27  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1761, 1, 6, 1, 13, 25, 102052803, 'Humayra Mushroom (Mugda)', 'Mr. Himu', '1671450157', NULL, '35 North Mugdapara  Dhaka-1214', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1762, 1, 6, 1, 13, 25, 102052807, 'The Eatalia(Mirpur-1)', 'Mr. Anik', '1677170228', NULL, '29  Zoo Road  1/G  Mirpur-1  Opposite of Bangladesh Eye Hospital  Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1763, 1, 6, 1, 13, 25, 102052840, 'Showrma House (B.City)', NULL, '1689309040', NULL, 'Bashundhara City  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1764, 1, 6, 1, 13, 25, 102052856, 'Crack Chef (Aftabnagor)', NULL, '1799000007', NULL, 'House #17 Main Road  Block #C  Aftabnagor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1765, 1, 6, 1, 13, 25, 102052874, 'Bin Hai cafe(Uttara)', NULL, '1676725215', NULL, 'House # 34  Road # 20  Sector # 3  uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1766, 1, 6, 1, 13, 25, 102052830, 'Rustic Eatery (Dhanmondi)', NULL, '1825081554', NULL, 'Dhanmondi 9/A House #39', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1767, 1, 6, 1, 13, 25, 102052865, 'Claims (Police Plaza)', NULL, '1714097950', NULL, 'Police Plaza Food Court  Gulshan-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1768, 1, 6, 1, 13, 25, 102052870, 'Indian Spicy Chicken (Dhanmondi-27)', NULL, '1707118257', NULL, 'Opposit of Meena bazar  Dhanmondi-27 ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1769, 1, 6, 1, 13, 25, 102052977, 'Street Oven LTD (Gulshan 1)', NULL, '1313717261', NULL, '56/A 1St Floor Concord Sark Building Road 132  ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1770, 1, 6, 1, 13, 25, 102052992, 'Food Formula (Wari)', NULL, '1677319800', NULL, '11 Hare Street  Near Panir Pamp Er Goli wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1771, 1, 6, 1, 13, 25, 102053025, 'M/S.Yousuf Store (Kapptan Bazer)', 'Yousuf', '1911228140', NULL, 'Kaptan Bazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1772, 1, 6, 1, 13, 25, 102053033, 'Cafe Sweets -16 (Bashundhara)', NULL, '1887040470', NULL, 'New Appollo Hospital Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1773, 1, 6, 1, 13, 25, 102053036, 'The Great Kebab &Pizza (Shantinagar)', NULL, '1309040301', NULL, 'House #156 Green Mazeda Park Dhaka 1217', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1774, 1, 6, 1, 13, 25, 102053049, 'Pizza Home Twon(Gul-2)', NULL, '1725360766', NULL, 'Gulshan -2 (Near Manarat School Lack Par)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1775, 1, 6, 1, 13, 25, 102053085, 'Kudos (Khilgaon)', 'Mr. Shahriar', '1768686876', NULL, '920/C  Shahid Baki Road  Taltola  Khilgaon  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1776, 1, 6, 1, 13, 25, 102053111, 'Shitol Restaurant (Dhanmondi 27)', NULL, '1911183550', NULL, 'Opposite Jenetic Plaza  Dhanmondi-27', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1777, 1, 6, 1, 13, 25, 102053125, 'Albaraka (Newmarket)', NULL, '1999572587', NULL, 'New Market Block-D Shope No-22', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1778, 1, 6, 1, 13, 25, 102053169, '8 No Dokan (Bashundhara)', NULL, '1613461212', NULL, 'Rajbari Food Court  Shop #8 Plot #100 Road #2  Block A Bashundhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1779, 1, 6, 1, 13, 25, 102052934, 'Best Fried Chicken (BFC)- Baily Road', NULL, '1755909265', NULL, '31/1  Siddeshari Circular Road  Baily Road  Ground Floor  Dhaka-1000. Tel: 029353559', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1780, 1, 6, 1, 13, 25, 102052937, 'Best Fried Chicken (BFC)-  Uttara- 02', NULL, '1758112837', NULL, 'Plot # 19  Sonargaon Janapath Road  Sector# 13  Uttara  Dhaka-1230.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1781, 1, 6, 1, 13, 25, 102052938, 'Best Fried Chicken (BFC)- Mohammadpur', NULL, '1726493693', NULL, 'House-25/2 (Ground Floor)  Tajmohal Road  Block-C  Mohammadpur. Dhaka-1207.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1782, 1, 6, 1, 13, 25, 102053075, 'Noakhali  Store (Uttara)', NULL, '1934181973', NULL, 'Uttara 11 Number  Kachabazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1783, 1, 6, 1, 13, 25, 102053087, 'Helvetia Restaurant(Motijheel)', NULL, '1715496909', NULL, '48/1 Motijheel Shapla Chottor', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1784, 1, 6, 1, 13, 25, 102053091, 'Captain Chef (Bashundhara)', NULL, '1731785419', NULL, 'Bashundhara Arban Food Court  Shop #10 2nd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1785, 1, 6, 1, 13, 25, 102053093, 'Dark Caffe & Cold (Mirpur-1)', 'Md.Rashel mia', '01911684070/01716676388', NULL, 'Ahmmod Nagor Paik para( Mirpur-1)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1786, 1, 6, 1, 13, 25, 102053096, 'Babuland (Badda)', NULL, '1620855976', NULL, 'Badda BTL Premier (Badda)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1787, 1, 6, 1, 13, 25, 102053099, 'Korai Gosto (B.City)', 'Md.Mehedi Hasan', '1720338903', NULL, 'Shop-87 Level-8 Block-D (B.city)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1788, 1, 6, 1, 13, 25, 102053104, 'Golden Gym (Uttara)', NULL, '1626966528', NULL, 'Sector #14 House #71  Gausul Azam  Avenue Road  Lift #2 3rd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1789, 1, 6, 1, 13, 25, 102053107, 'Cha-Ddabuj (Shiddeswari)', NULL, '1782866849', NULL, 'Shiddeswari Opposite in Popeyes', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1790, 1, 6, 1, 13, 25, 102053114, 'Me time (Uttara)', NULL, '1841560760', NULL, 'Sector-9 Road-1 House-55', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1791, 1, 6, 1, 13, 25, 102053115, 'Flaming Grill (Gulshan-2)', NULL, '1675375711', NULL, 'House-175  Road-61  Gulshan-2', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1792, 1, 6, 1, 13, 25, 102053119, 'Eat Italia Restaurant (Police Plaza)', NULL, '1755769602', NULL, 'Police Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1793, 1, 6, 1, 13, 25, 102053130, 'Cafe Zeel (Satrasta)', NULL, '1912482737', NULL, 'Dipika Mor  Sat Rasta  Tejgaon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1794, 1, 6, 1, 13, 25, 102053132, 'Tune & Bite(wari)', NULL, '1989895330', NULL, '9 Rankin Street(2nd Floor) Wari Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1795, 1, 6, 1, 13, 25, 102053134, 'Robin Corporation (Wari)', NULL, '1401440910', NULL, 'Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1796, 1, 6, 1, 13, 25, 102053135, 'Food Bar (Tongi)', NULL, '1773598738', NULL, 'Tongi College Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1797, 1, 6, 1, 13, 25, 102053138, 'FFC  Chinese (Mugda)', 'Md .  Rashel', '1720666169', NULL, '59/4 Atish Dipongkor Sarkar Mugda Bishaw Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1798, 1, 6, 1, 13, 25, 102053141, 'Uttara Pizza House (Uttara)', 'Monir', '1962838994', NULL, 'House #4 Road #14 Sector #1 Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1799, 1, 6, 1, 13, 25, 102053143, 'Mr. Saiful Islam (Gulshan)', NULL, '1670730386', NULL, 'KA-01/B  Kalachadpur  Near United Hospital  Gulshan-2', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1800, 1, 6, 1, 13, 25, 102053149, 'Ghost Kitchen Bangladesh Limited (Mogbazar)', NULL, '1934609635', NULL, 'Mogbazar Agora Goli (Mogbazar)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1801, 1, 6, 1, 13, 25, 102053154, 'Food Mayor (Uttara)', 'Mr.Monir', '1847346075', NULL, 'House-1 Road-15 Sector-14 Shop No-4 Uttara Just Opposite Bit School Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1802, 1, 6, 1, 13, 25, 102053162, 'Mad Chef (Mohammadpur)', NULL, '1843997420', NULL, 'Mohammadpur Tikkapara Block #F  House -16/10 Dhaka 1207  Near suchana Community  Center', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1803, 1, 6, 1, 13, 25, 102053168, 'Pizza Roma(Gul-1)', NULL, '1614888666', NULL, 'Road-16/A Hotel bengal Canary Park Oppsite', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1804, 1, 6, 1, 13, 25, 102053078, 'Cheese Story (Polashi)', NULL, '1987355411', NULL, '22  6 Dhakeshwari road  Polashi  lalbag Dhaka 1211', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1805, 1, 6, 1, 13, 25, 102053080, 'Pizzatalia (Dhalibari)', 'Redwanul Haque', '1308337344', NULL, 'Coca-Cola Apollo road  House - 315  Floor - 3 rd  Bashundhara R/A', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1806, 1, 6, 1, 13, 25, 102053088, 'The kitchen (Rangpur)', 'Mr. Sohel', '1737112659', NULL, 'House: 51/1 Road:01  1st floor  Taher Medicine  Dhap  Rangpur city  01763089474', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1807, 1, 6, 1, 13, 25, 102053109, 'Red Window(Gul-02)', NULL, '1887344444', NULL, 'House # 16/B  Road # 112  Gulshan-02  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1808, 1, 6, 1, 13, 25, 102053116, 'The American Burger (Sirajganj)', NULL, '1767159063', NULL, 'Anayetpur  Sirajganj', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1809, 1, 6, 1, 13, 25, 102053121, 'Jive Jol (Bogura)', 'Ishtiak haider', '1817333333', NULL, 'kalibari  jaleswaritola bogura', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1810, 1, 6, 1, 13, 25, 102053172, 'Isamoti Store (Kaptanbazar)', 'Mr. Faisal', '1937817140', NULL, 'Kaptan Bazar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1811, 1, 6, 1, 13, 25, 102053175, 'Love Bird (Mirpur-1)', NULL, '1758003373', NULL, 'Mirpur 1 Near Agura', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1812, 1, 6, 1, 13, 25, 102053178, 'Cafe Avenger (Cumilla)', 'Mr. Sakib', '1309006059', NULL, 'Kandirpar  city market  Cumilla', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1813, 1, 6, 1, 13, 25, 102053181, 'Premium Express (Mirpur-1)', NULL, '1772737457', NULL, '312/7/6 1St Colony (Near Tolarbagh 3rd Gate) Mirpur-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1814, 1, 6, 1, 13, 25, 102053183, 'Cafe Goga (Dhalibari)', NULL, '1951893604', NULL, '538 Vatara  dhalibari In Front Of Apollo Hospital Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1815, 1, 6, 1, 13, 25, 102053184, 'New Shawarma House (Lalmatia)', NULL, '1777914708', NULL, 'Lalmatia F Block  Dhanmondi  Dhaka-1205', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1816, 1, 6, 1, 13, 25, 102053185, 'B. Baria Baniyatee Store (Gulshan-2)', NULL, NULL, NULL, 'Gulshan-2  Kachabazar', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1817, 1, 6, 1, 13, 25, 102053188, 'Indian Darbar (Police Plaza)', NULL, '1713086603', NULL, 'Near Police Plaza  Gulshan-1', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1818, 1, 6, 1, 13, 25, 102053190, 'Al falah General (Donia)', NULL, '1719589238', NULL, '540 South Doniya Opposite DaniyaShahi  Masjid Kadomtoli Dhaka 1236', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1819, 1, 6, 1, 13, 25, 102053182, 'Cafe Blue (Shonirakhra)', NULL, '1838880159', NULL, 'Rayarbagh  Shonirakhra  Bus stand', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1820, 1, 6, 1, 13, 25, 102053186, 'Kazi and Co.(Mohammadpur)', 'Kazi Siddik Ahmed', '1672098261', NULL, 'House-203/2  Road-3  Panthoshala Housing  near At Takwa Moszid  Shekhetek  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1821, 1, 6, 1, 13, 25, 102053187, 'Khan Enterprise (Ctg)', 'Mr. Ifaz Chowdhury', '1755889277', NULL, 'Probortok mor  2 no gate  Chittagong', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1822, 1, 6, 1, 13, 25, 102053189, 'Pizza Store (Mirpur)', NULL, '1971170948', NULL, '161/7  Manikdi ECB Chattar  Mirpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1823, 1, 6, 1, 13, 25, 102053191, 'Modina Store (Kaptanbazar)', NULL, '1914946589', NULL, 'Kaptan Bazar 1 no gate 57/17', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1824, 1, 6, 1, 13, 25, 102053193, 'Cheez(Bashundhara)', NULL, '1312195221', NULL, '2nd Floor Jabbar Molla Tower(Bashundhara)', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1825, 1, 6, 1, 13, 25, 102053194, 'Cheez(Uttara)', NULL, '1764244343', NULL, '4th Floor House 34 Gareeb-E-Nawaz Ave Sector-11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1826, 1, 6, 1, 13, 25, 102053195, 'Cheez(Gulshan)', NULL, '1312195220', NULL, 'Ground Floor House-7 Road -137 (Gulshan-1)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1827, 1, 6, 1, 13, 25, 102053197, 'Cheez(Mirpur)', NULL, '1311073775', NULL, '3Rd Floor Section-6 Block-A Upoma plaza Road -4 House-2/A (Mirpur)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1828, 1, 6, 1, 13, 25, 102053202, 'Mahi Store (Mirpur 14)', NULL, '1308967344', NULL, 'Ibrahimpur Bazar', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1829, 1, 6, 1, 13, 25, 102053203, 'Blue Rain (Mirpur-2)', NULL, '1997853570', NULL, 'Love road  Opposite of Satdium  Mirpur-2', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1830, 1, 6, 1, 13, 25, 102053204, 'Nabab Restaurant (Narshingdi)', NULL, '1685125411', NULL, 'Bhyiuan Super Market  Pourasava mor  Madhabdi  Narshingdi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1831, 1, 6, 1, 13, 25, 102053205, 'Eatio(Uttara)', 'Anamul', '1683823651', NULL, 'Nothern Front Food Court House-1 Road-17/A Sector-12', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1832, 1, 6, 1, 13, 25, 102053206, 'B.Baria Baniati Store (Gulshan-2)', NULL, '1746123022', NULL, 'Gulshan-2 Kacha Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1833, 1, 6, 1, 13, 25, 102053207, 'Woodhouse Grill (Banani)', 'Mir Leon', '1758855829', NULL, 'Level-4  Holding-56  BlockF  Road-11  banani  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1834, 1, 6, 1, 13, 25, 102053209, 'M F C (Mirpur 2)', NULL, '1680034358', NULL, 'Mirpur Shopping Center 7 Floor Lift Er 6', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1835, 1, 6, 1, 13, 25, 102053210, 'Snackers (Bashundhara )', NULL, '1786692550', NULL, 'Bashundhara Gate  Jamuna Future Park', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1836, 1, 6, 1, 13, 25, 102053211, 'Papa s Burger (Tongi)', NULL, '1315841132', NULL, 'Ovijan # 47 Surtaranga Road Auchpara Tongi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1837, 1, 6, 1, 13, 25, 102053214, 'Sandwich Mama (Mirpur)', 'Shariful Islam', '1687413107', NULL, 'Section-6  Block-C  House-15  Mirpur-6', 15000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1838, 1, 6, 1, 13, 25, 102053216, 'London Food (Mirpur)', 'Mr. Jalal Uddin', '1625554420', NULL, 'Barek Mollar Mor  60 Feet road  Mirpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1839, 1, 6, 1, 13, 25, 102053220, 'Mexican & Sea Food (B.Ct)', 'Saiful', '1724695511', NULL, 'Bashundhara City L-8 Shope-71 Block-b', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1840, 1, 6, 1, 13, 25, 102053222, 'RedBrick Pizzeria (Lalmatia)', '1777914708', '1777914708', NULL, 'Block-F  House -23 Mohammadpur Lalmatia', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1841, 1, 6, 1, 13, 25, 102053224, 'Chap Place (Uttara)', 'Roni', '1613965888', NULL, 'Uttarkhan Masterpara  Kalabagan  Dhaka-1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1842, 1, 6, 1, 13, 25, 102053192, 'Cheesy Bite (Azimpur)', NULL, '1842554722', NULL, '37/7 Azimpur Tower Near Raihan School', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1843, 1, 6, 1, 13, 25, 102053225, 'Pine Wood Cafe New (Dhanmondi)', NULL, '1721627369', NULL, 'House-4  Road-6  Mirpur road  Dhanmondi  Mob: 01610159152', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1844, 1, 6, 1, 13, 25, 102053228, 'Signature (Uttara)', 'Md. Rokon', '1644510694', NULL, 'house-51  Shah Makdum Road  Sector-12  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1845, 1, 6, 1, 13, 25, 102053229, 'Oasis (Baily Road)', NULL, '1711394856', NULL, 'Baily Road (Showarma House Building)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1846, 1, 6, 1, 13, 25, 102053232, 'Indian Kitchen (Eastern Plaza)', NULL, '1782355255', NULL, 'Shop-37/3rd floor  Eastern Plaza', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1847, 1, 6, 1, 13, 25, 102053233, 'Burger Express(Wari)', 'Fakrul', '1841979722', NULL, 'Burgerology Building(Wari)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1848, 1, 6, 1, 13, 25, 102053286, 'Kudos (Panthopath)', NULL, '1768686876', NULL, 'Sundaram Plaza  20/3  1st floor  Bir Uttam Kazi Nuruzzaman Rd  Panthapath 1215 Dhaka ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1849, 1, 6, 1, 13, 25, 102053288, 'Mr. Manik Foods (Gulshan-1)', NULL, '1980535362', NULL, 'Opposite of Robi Tower  Gulshan-1 ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1850, 1, 6, 1, 13, 25, 102053293, 'Taste Ride (Polton)', 'Mr. Shamim', '1712420778', NULL, 'China Town  16 mo dokan Oppsit of Polwel Market  Polton', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1851, 1, 6, 1, 13, 25, 102053294, 'Bungkers (Uttara)', 'Mrs Wahida', '1921655380', NULL, 'Sector-12  House-4  Road-2  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1852, 1, 6, 1, 13, 25, 102053295, 'Wait and See (Badda)', NULL, '1714938323', NULL, 'Gudaraghat  Badda', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1853, 1, 6, 1, 13, 25, 102053297, 'Red Onion (Poltan)', NULL, '1719081360', NULL, '67/1 Poltan China Town 5th Floor Food Zone  Shop-14  Naya Palton  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1854, 1, 6, 1, 13, 25, 102053300, 'Food Forest (Polton)', NULL, '1787883213', NULL, '67/1 Polton  China Town 5th Floor  Food Zone  Shop-2  Naya Polton', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1855, 1, 6, 1, 13, 25, 102053301, 'Dunkin Dine (Dhanmondi)', NULL, '1999902627', NULL, 'Shimanto Somvar Food Court  9th Flloor  Dhanmondi  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1856, 1, 6, 1, 13, 25, 102053305, 'Happy Tummy (Kushtia)', NULL, '1760649219', NULL, 'Bok Chottor  Kustia Sadar  Kushtia', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1857, 1, 6, 1, 13, 25, 102053308, 'Bar-B-Q Lounge (Mirpur DOHS)', 'Mr. Mehedi', '1944551177', NULL, 'Mirpur DOHS Shopping Complex  1st Floor  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1858, 1, 6, 1, 13, 25, 102053309, 'Chennei Food Express', NULL, '1911377737', NULL, '67/1 Polton Chaina Town  Level-5 Shop No-5', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1859, 1, 6, 1, 13, 25, 102053312, 'Makan (Polton)', NULL, '1322075950', NULL, '67/1  Polton Chaina Town  Level- 5th floor   Noya Polton', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1860, 1, 6, 1, 13, 25, 102053313, 'AKSID Corporation (Baridhara', NULL, '1700761405', NULL, 'Flat-5A  Plot-4  Road-12  Block-J  Baridhara  Dhaka-1219', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1861, 1, 6, 1, 13, 25, 102053314, 'De Partex (Tejgaon)', 'Suruj Ali Khan', '1730377220', NULL, '222 Bir Uttam Mir Shawkat road  Dhaka-1205', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1862, 1, 6, 1, 13, 25, 102053318, 'Happy Belly (Mirpur DOHS)', NULL, '1712009267', NULL, 'Mirpur DOHS Shopping Complex Level-7  Shop-21', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1863, 1, 6, 1, 13, 25, 102053322, 'Sultan legacy (Dhanmondi)', NULL, '01610-191020', NULL, 'Road-5  House-21  Dhanmondi Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1864, 1, 6, 1, 13, 25, 102053323, 'Master Chef Pizza (Mirpur-1)', 'Md. Faruk', '1638068438', NULL, '300/4  1/C  Ahamed Nagar  Mirpur-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1865, 1, 6, 1, 13, 25, 102053325, 'Lantern\'s Cafe (Banasree)', NULL, '1786125586', NULL, 'Block-C  road-5  Banasree', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1866, 1, 6, 1, 13, 25, 102053326, 'Try Fry (Banani)', NULL, '1643911248', NULL, 'House-56   Road-11  Wood House building  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1867, 1, 6, 1, 13, 25, 102053328, 'Mad Chef (Malibag)', NULL, '1321180273', NULL, 'Beside Abul Hotel  Malibag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1868, 1, 6, 1, 13, 25, 102053329, 'Bros Dream Orchid (Tongi)', NULL, '1671772666', NULL, '54/A  Tongi College gate', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1869, 1, 6, 1, 13, 25, 102053330, 'Cheez (Baily road)', NULL, '01316-195220', NULL, '2nd Floor  House 37 Road-12  Baily road  Dhaka 1213', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1870, 1, 6, 1, 13, 25, 102053331, 'Cheez (Khilgaon)', NULL, '1321180272', NULL, 'Beside Abul Hotel  Malibag', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1871, 1, 6, 1, 13, 25, 102053333, 'Urban Slices (Uttara)', NULL, '1855318736', NULL, 'Road-3  House-11  Sector-11  Uttara', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1872, 1, 6, 1, 13, 25, 102053334, 'Sajib Store (Gulshan)', NULL, '1829316439', NULL, 'Gulshan DCC Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1873, 1, 6, 1, 13, 25, 102053335, 'AUS BD (Tejgaon)', 'Mr. Dedarul Islam', '1717633700', NULL, '189/A (1st floor) Habib metal industry lane  Tejgaon industrial area.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1874, 1, 6, 1, 13, 25, 102053341, 'Cheese Walla (Mirpur 11)', 'Mr. Munna', '1988414806', NULL, 'Block -D  Road-25 Mirpur 11', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1875, 1, 6, 1, 13, 25, 102053339, 'Kashmiree Darbar (Polton)', 'Abu Taiub', '1705184912', NULL, 'China Town Food court  Polton', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1876, 1, 6, 1, 13, 25, 102053342, 'Hemel Enterprise (Taltola)', NULL, '1985018923', NULL, 'Shop no: 180  Taltola market  Khilgaon', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1877, 1, 6, 1, 13, 25, 102053345, 'Blue Salt (Gulshan)', NULL, '1726803854', NULL, 'Road-11/A  House-23  Gulshan-2', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1878, 1, 6, 1, 13, 25, 102053351, 'The Luncheon Catering (Kalachadpur)', NULL, '1726176226', NULL, 'Kalachadpur Awamilig club er pashe', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1879, 1, 6, 1, 13, 25, 102053352, 'D MEX (Uttara)', NULL, '1750749292', NULL, 'House-40  Sector-13  Garib-E-Newaz Avenue  Uttara', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1880, 1, 6, 1, 13, 25, 102053357, 'Bellavita Pizzaria (Bashundhara)', NULL, '1919227788', NULL, 'Ka-1/C  Joynal Complex  Bashundhara Road  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1881, 1, 6, 1, 13, 25, 102053358, 'Shawarma House (DIT Project)', NULL, '1878695075', NULL, 'DIT project  House-8/A  Road-11  East Merul Badda', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1882, 1, 6, 1, 13, 25, 102053360, 'Pizza War (Dhanmondi)', 'Sabbir Hossain', '1885080807', NULL, '117 Arman Khan Goli  13/A west Dhanmondi', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1883, 1, 6, 1, 13, 25, 102053363, 'Pizza Mafia (Mohammadpur)', NULL, '1325377375', NULL, 'Mohammadpur  Street Oven  building', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1884, 1, 6, 1, 13, 25, 102053364, 'WOW Pizza (Mirpur-14)', NULL, '01766109056  01303676969', NULL, 'Opposite of Metro complex  Mirpur-14 main road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1885, 1, 6, 1, 13, 25, 102053371, 'Liton Enterprise (Uttara)', NULL, '1817057455', NULL, 'Kushol Center  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1886, 1, 6, 1, 13, 25, 102053379, 'Rainbow Bridge', 'Shuvo', '1792503181', NULL, '430  Tizarat Shoping Tower  Donia Road  Nayapara  Sonir Akhra', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1887, 1, 6, 1, 13, 25, 102053380, 'Mr. Nazmul (Tongi)', NULL, '1633808078', NULL, 'College Gate  Tongi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1888, 1, 6, 1, 13, 25, 102053385, 'Civic Foods Ltd (Banani)', NULL, '1950557744', NULL, 'House- 1  Road- 11  Classic Center  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1889, 1, 6, 1, 13, 25, 102053388, 'The Tongue Teasers (Dhalibari)', 'Mr. Faisal', '1908152216', NULL, '422  Abdus Sobhan  Dhalibari road  Bashundhara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1890, 1, 6, 1, 13, 25, 102053389, 'Sourov\'s Kitchen', 'Md. Abdullah Al Imran', '1731405948', NULL, '102/Kha  Matikata Bazar  Dhaka Cantonment  Dhaka-1206', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1891, 1, 6, 1, 13, 25, 102053393, 'Cheers Restaurant (Dhanmondi-27)', NULL, '1716238668', NULL, 'House-30/A  Road-16 (new)  27 (old)  Dhanmondi  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1892, 1, 6, 1, 13, 25, 102053394, 'Taza Fal-2 (Shimanto Square)', 'Mr. Ismail', '1687880812', NULL, '2nd  Floor  Simanto squar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1893, 1, 6, 1, 13, 25, 102053395, 'Food Ground (Gudaraghat)', NULL, '1680752375', NULL, 'Gudaraghat Lake Road  Badda  Dhaka', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1894, 1, 6, 1, 13, 25, 102053396, 'Chicken Republic (Tejgaon)', NULL, '1830758698', NULL, 'Tejgaon Food Court  Near Shanta Tower', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1895, 1, 6, 1, 13, 25, 102053398, 'Kool Cha (Dhanmondi)', NULL, '1401404324', NULL, 'House-17  4th floor  Bir Uttam AK Rob road  Dhanmondi yellow cafe building.', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1896, 1, 6, 1, 13, 25, 102053399, 'Ciao restaurant (Uttara)', NULL, '1923849464', NULL, 'Sector-12  Khalpar  BGMEA  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1897, 1, 6, 1, 13, 25, 102053401, 'Best Fried Chicken (BFC) - Mirpur-01', NULL, NULL, NULL, 'plot-1/1  Road-2  block-G  Section-1  Zoo road  Mirpur-1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1898, 1, 6, 1, 13, 25, 102053404, 'Mr Munna', NULL, NULL, NULL, 'Mirpur  Dhaka', 450000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1899, 1, 6, 1, 13, 25, 102053405, 'M/S Noor Traders(K.B)', NULL, '1797424737', NULL, 'Karwan Bazar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1900, 1, 6, 1, 13, 25, 102053406, 'Pizza Shuttle (60 Feet)', 'Mr. Shajid', '1725553955', NULL, '361/Ka  60 Feet road  Pirarbag  Monipur  Mirpur  Dhaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1901, 1, 6, 1, 13, 25, 102053411, 'Kamal Store (Gudaraghat)', 'Mr. Kamrul Islam', '1819229224', NULL, 'Warehouse: Badda High School Road  Gudaraghat  Shop: Gulshan DCC market  3rd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1902, 1, 6, 1, 13, 25, 102053412, 'HMS Traders (Ctg)', NULL, '1780194900', NULL, '2 No Gate  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1903, 1, 6, 1, 13, 25, 102053413, 'Mr. Akbar (Tejgaonj)', NULL, '1937980086', NULL, 'Tejgaon  Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1904, 1, 6, 1, 13, 25, 102053414, 'Pizza Bari (Faridpur)', NULL, '1888006017', NULL, 'Jheel Tuli  Saroda Sundori College road  Faridpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1905, 1, 6, 1, 13, 25, 102053415, 'MFC (Mouchak)', NULL, '1726254461', NULL, 'Fortune Market Food Court  Mouchak More  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1906, 1, 6, 1, 13, 25, 102053383, 'Black Valley Rooftop (Shonir Akhra)', NULL, '1799222948', NULL, '429 Nayapara  Donia road  Shonir Akhra', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1907, 1, 6, 1, 13, 25, 102053386, 'Munchies (Niketon)', 'Mr. Aminul', NULL, NULL, 'House-2  Road-5  Block-D  Niketon  Gulshan-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1908, 1, 6, 1, 13, 25, 102053392, 'Pizza Star (Mirpur-10)', NULL, '1774880179', NULL, 'Sector-10  Road-10  House-1  Block-B', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1909, 1, 6, 1, 13, 25, 102053402, 'Kashful Garden restaurant (Keraniganj)', NULL, '1771838678', NULL, 'Sharighat  Daxin keraniganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1910, 1, 6, 1, 13, 25, 102053408, 'Ma Enterprise', 'Shariar Alom', '1862230730', NULL, 'Shajadpur  Noton bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1911, 1, 6, 1, 13, 25, 102053410, 'Mamun Masala (Mirpur-11)', 'Mr. Mamun', '1726694838', NULL, 'Mirpur-11  Kacha bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1912, 1, 6, 1, 13, 25, 102053416, 'Salam Cloud Kitchen (Bashundhara)', NULL, '1835309081', NULL, 'Ka/31 Somir uddin Road  Munshibari Jame Mosjid  Bashundhara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1913, 1, 6, 1, 13, 25, 102053418, 'Flamer Den(Baridhara)', NULL, '1923414242', NULL, 'Baridhara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1914, 1, 6, 1, 13, 25, 102053419, 'Delifrance Bangladesh (Rampura)', NULL, '1675375711', NULL, 'Islam Tower  Oposite of BTV  Rampura Main Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1915, 1, 6, 1, 13, 25, 102053420, 'One Stop Super Shop Ltd (Mohammadpur)', NULL, '1318306955', NULL, '13/5  Mohammadpur  Near Amin Mosjid  Opposite of Prime Minister Residance', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1916, 1, 6, 1, 13, 25, 102053421, 'Kebabs (Mirpur)', 'Mr. Rana', '1672125858', NULL, '30  East Kafrul  Near Hi tech Hospital  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1917, 1, 6, 1, 13, 25, 102053422, 'Real Chef Cafe (Kala chadpur)', NULL, '1726267587', NULL, 'Kala Chadpur school road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1918, 1, 6, 1, 13, 25, 102053423, 'SP Chicken (Banasree)', NULL, '1676177993', NULL, 'Road-4  block-D  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1919, 1, 6, 1, 13, 25, 102053424, 'Kings Delicious Food (Tongi)', NULL, '1718008002', NULL, 'House-38  Sultana Razia road  College gate  Tongi', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1920, 1, 6, 1, 13, 25, 102053425, 'Kudos (Banasree)', NULL, '01400-686876', NULL, 'House#1  Road#1  Block-B  Banasree  Dhaka-1219', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1921, 1, 6, 1, 13, 25, 102053429, 'La American (Shahjadpur)', NULL, '1999959601', NULL, 'Shahjadpur  beside of Subastu Shopping Complex', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1922, 1, 6, 1, 13, 25, 102053430, 'Samrat Dairy Food  (Satarkul)', NULL, '1926866991', NULL, 'Rokeya Appartment  Satarkul road  Uttar Badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1923, 1, 6, 1, 13, 25, 102053433, 'Pizza People (Bashundhara)', 'Mr. Rakib', '1736922153', NULL, 'Mutual Trust Bank Building  Bashundhara Gate', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1924, 1, 6, 1, 13, 25, 102053435, 'I Kitchen (Gulshan)', NULL, '1680733352', NULL, '113/A Near Gulshan 2  Shahabuddin Medical College  Sping Garden', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1925, 1, 6, 1, 13, 25, 102053439, 'Anarul Super Shop (Sarulia)', 'Mr. Jahir', '1537486973', NULL, 'Dogair Dokkhin Poschim para  Nur Masjid  Sarulia  Demra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1926, 1, 6, 1, 13, 25, 102053440, 'Brahmanbaria Store (Mohammadpur)', NULL, '1720018600', NULL, 'Town Hall market  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1927, 1, 6, 1, 13, 25, 102053446, 'Rana Enterprise (Narayanganj)', NULL, '1715991980', NULL, 'Narayanganj Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1928, 1, 6, 1, 13, 25, 102053447, 'Coffeelicious Coffee (Uttara Sector-7)', NULL, '1924590219', NULL, 'Road-18  House-1  Uttara Sector-7', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1929, 1, 6, 1, 13, 25, 102053448, 'Pizza Love (Polton)', NULL, '1723226727', NULL, '37/2  Purana Polton', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1930, 1, 6, 1, 13, 25, 102053449, 'SFC Shawarma House (Mohammadpur)', NULL, '1758387764', NULL, 'House-1  Prodhan Sarak  Beside Alhaz Mokbul College  Kaderabad Housing  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1931, 1, 6, 1, 13, 25, 102053450, 'Dhaka Bank (Polton)', NULL, '1715023830', NULL, 'Polton Holding No: #71 (1st Floor)  Purana Paltan Lane  Road No: 13(New) 1205  beside BNP Office', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1932, 1, 6, 1, 13, 25, 102053455, 'CCHUN JI CHINEESE & THAI (Shantinagar)', NULL, '1726439490', NULL, 'Cordova Circle (2nd floor)  Kakrail road  Shantinagar  Dhaka-1000', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1933, 1, 6, 1, 13, 25, 102053456, 'Drobbo.com (Banani)', NULL, '1833304374', NULL, 'House 27  Road-2  Nam Village road  Banani Chairman Bari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1934, 1, 6, 1, 13, 25, 102053458, 'Hungry Solution (Sanrarpar)', NULL, '1869664055', NULL, 'Sanar par bus stand  Sign board  Narayangang', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1935, 1, 6, 1, 13, 25, 102053427, 'Mohammed Ashique Ullah (Ctg)', NULL, '1727000028', NULL, 'House-50-C  Road-3  North Khulshi R/A  Chittagong', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1936, 1, 6, 1, 13, 25, 102053441, 'Cheesy Slice (Mirpur-12)', NULL, '1648494309', NULL, 'Shop No: 8  Signature Food Court  8th floor  Prince Bazar Building  Mirpur-12  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1937, 1, 6, 1, 13, 25, 102053444, 'Food Dinner (Banani)', NULL, '1790129635', NULL, 'Road-13/B  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1938, 1, 6, 1, 13, 25, 102053451, 'Take Out (Panthopath)', NULL, '1833729455', NULL, '57/11  1st Floor  East Razabazar  West Panthopath  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1939, 1, 6, 1, 13, 25, 102053454, 'Star Ceneplex (Mirpur-1)', NULL, '1755625489', NULL, 'Sony Cenema Hall  4th floor  Mirpur-1 ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1940, 1, 6, 1, 13, 25, 102053459, 'Hot & Chilly (Uttara)', NULL, '1677530049', NULL, '31# Sector 10  Road 1/A Uttara  Dhaka-1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1941, 1, 6, 1, 13, 25, 102053462, 'Spicy Shawarma House (Mirpur-14)', NULL, '1913743639', NULL, 'Ibrahimpur Kachabazar  Mirpur-14', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1942, 1, 6, 1, 13, 25, 102053464, 'Bella Italia (Mirpur WH)', 'Mr. Sujon', '1717906690', NULL, 'Daily Needs  Baganbari  Matikata  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1943, 1, 6, 1, 13, 25, 102053465, 'Pabna Dept. Store (Mdpur)', NULL, '1911022522', NULL, '15/9  Sher Sha Suri road  town hall road  mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1944, 1, 6, 1, 13, 25, 102053467, 'Kindred Cafe and Bakery (Nikunjo-2)', NULL, '1842322477', NULL, 'Road-13  House- 25 (Nikunjo-2)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1945, 1, 6, 1, 13, 25, 102053468, 'Twisted Cafe (Mirpur-12)', NULL, '1865614276', NULL, 'Signature Food Court  Sultan mansion  Lift-8  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1946, 1, 6, 1, 13, 25, 102053469, 'Roosters Peri Peri (Banani)', NULL, '1817080711', NULL, 'House-68  road-10  block-D  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1947, 1, 6, 1, 13, 25, 102053470, 'Arabian Butcher Restaurant', NULL, NULL, NULL, 'Trimohoni Bus Stand  Nandipara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1948, 1, 6, 1, 13, 25, 102053474, 'PizzaBurg (Bashundhara)', NULL, '01892-698866', NULL, 'Hazi Abdul Latif Mansion  9/KA  Manson  R/A  Ka-9 Bashundhara road  Dhaka-1229', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1949, 1, 6, 1, 13, 25, 102053478, 'Capital Kitchen', NULL, '1787178159', NULL, '543  High Dream Palace  ECB Chottor  Dhaka Cantorment Dhaka- 1206', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1950, 1, 6, 1, 13, 25, 102053480, 'Pitza Slice (Uttara)', NULL, '1400774892', NULL, 'H-03  R-14  Sector  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1951, 1, 6, 1, 13, 25, 102053483, 'Pizza and Juice Factory (Shaymoli)', NULL, '153838591', NULL, '91/Ka Shaymoli  Beside Shaymoli Park', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1952, 1, 6, 1, 13, 25, 102053484, 'Foodology (DOHS)', NULL, '1856559887', NULL, 'Shagufta New Road  Mirpur DOHS gate.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1953, 1, 6, 1, 13, 25, 102053485, 'Black Bee Coffee (Dhanmondi)', NULL, '1887590158', NULL, 'Road-8/A  House-81  Green Taj Center  Level-3  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1954, 1, 6, 1, 13, 25, 102053486, 'Lavista (Uttara)', NULL, '1775074828', NULL, 'Sector-3  Road-2  House-29  Rajlokkhi  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1955, 1, 6, 1, 13, 25, 102053487, 'Pallabi Restora (Mirpur-12)', NULL, '1727412269', NULL, 'House-1/C  Road-9  Block-C  Mirpur-12', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1956, 1, 6, 1, 13, 25, 102053488, 'Taj Kitchen (Mohammadpur)', NULL, '1738966555', NULL, '25/5  Tajmohol road  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1957, 1, 6, 1, 13, 25, 102053494, 'Food Factory (Faridpur)', NULL, '1879641745', NULL, 'Alphadanga Sadar  Faridpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1958, 1, 6, 1, 13, 25, 102053495, 'Food Bungalow (Mirpur-14)', NULL, '1575048957', NULL, 'DCC-7 market  Mirpur-14  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1959, 1, 6, 1, 13, 25, 102053497, 'Nirjhor Cafe & Convention (Sarulia)', NULL, '1786697011', NULL, 'Mannan Shadu tower  2nd floor  Hazi nagar  Sarulia  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1960, 1, 6, 1, 13, 25, 102053503, 'Royel Place (Bashtola)', NULL, '1773859296', NULL, 'Bashtola  Shahjadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1961, 1, 6, 1, 13, 25, 102053507, 'AL-Khais Traders (Mirpur-10)', NULL, '1796289136', NULL, 'House- 8  Road - 4  Mirpur -10', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1962, 1, 6, 1, 13, 25, 102053510, 'TOSS Food Lounge (Shantinagar)', NULL, '1776253207', NULL, 'Tropical razia complex  1st floor', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1963, 1, 6, 1, 13, 25, 102053457, 'Cravings Restaurant (Khilgaon)', NULL, '01755673551/01407892441', NULL, 'Khilgaon taltola  Beside Cherry drops', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1964, 1, 6, 1, 13, 25, 102053476, 'PizzaBurg (Shyamoli)', NULL, '1733464944', NULL, '295 Holy Lane  Dhaka-1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1965, 1, 6, 1, 13, 25, 102053489, 'The Meat Bar (Bashundhara)', NULL, '1752088021', NULL, 'Rajbari Food Court  Bashundhara R/A', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1966, 1, 6, 1, 13, 25, 102053496, 'Sweets & Savory (Khilgaon)', NULL, '1676284602', NULL, 'House - 566/A  Block-C  Khilgaon Taltola (4th Floor). · Dhaka ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1967, 1, 6, 1, 13, 25, 102053499, 'GKFC (Polton)', NULL, NULL, NULL, 'China town food court  polton', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1968, 1, 6, 1, 13, 25, 102053500, 'Axis Power', NULL, '1819276407', NULL, '83  Central Road  Dom Inno   Flat - A1  01819 218024/01919756737', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1969, 1, 6, 1, 13, 25, 102053502, 'Silver Bell (Uttara)', NULL, '1819041291', NULL, 'Diabari Bot Tola  Near metro station  Sector-15  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1970, 1, 6, 1, 13, 25, 102053504, 'Dream Chotpoti House (Narshingdi)', NULL, '1715687760', NULL, 'Dream Holiday Park  Narshingdi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1971, 1, 6, 1, 13, 25, 102053506, 'Fat Boy (Vatara)', NULL, '1936335628', NULL, 'Shop No: 20 (North) Mamber Bari Super Market  Ghatpar  Vatara  Dhaka.', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1972, 1, 6, 1, 13, 25, 102053511, 'Queens Confectionaries (New)', NULL, '1778545733', NULL, 'Plot- 16  Road-2/A  Sector-15  Block C/1  Uttara  Dhaka- 1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1973, 1, 6, 1, 13, 25, 102053512, 'Deli Zio (Uttara)', NULL, '1886622641', NULL, 'Sector-3  Road-1  House-18  Jasim Uddin  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1974, 1, 6, 1, 13, 25, 102053513, 'Homefectionery (Badda)', NULL, '1843863873', NULL, 'TA-95  3rd floor  Badda L:ink road  Badda  Dhaka-1212', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1975, 1, 6, 1, 13, 25, 102053514, 'Romancia (Polton)', NULL, '1617000102', NULL, 'Chaina town food court  Polton', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1976, 1, 6, 1, 13, 25, 102053515, 'Crust (Dhanmondi)', NULL, '1830755698', NULL, '275K  Navana Mashira  Level-4  Near Oxford Internatioal School  Road-27', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1977, 1, 6, 1, 13, 25, 102053516, 'Friends Cafe & Restaurant (Dhanmondi)', NULL, '1812976859', NULL, 'Dhanmondi lake  Near Dingi restaurant', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1978, 1, 6, 1, 13, 25, 102053517, 'Khai Khai Burger (Dhanmondi)', NULL, '1776347665', NULL, '54  Green Road  Green Tower  Kathalbagan Mor', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1979, 1, 6, 1, 13, 25, 102053520, 'Shawarma King (Baily roaad)', NULL, '1728641757', NULL, 'Baily Road  Opposite of BFC', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1980, 1, 6, 1, 13, 25, 102053521, 'Shawarma King (Shantinagar)', NULL, '1710597548', NULL, 'Opposite of Arabian nights  Shantinagar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1981, 1, 6, 1, 13, 25, 102053527, 'King Fishers (Gulshan)', NULL, '1772159360', NULL, 'Opposit of Westin  Gulshan-2  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1982, 1, 6, 1, 13, 25, 102053530, 'Kudos (Lalbag)', NULL, '1712733750', NULL, 'Kella gate  Lalbag', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1983, 1, 6, 1, 13, 25, 102053531, 'Moja Bites (Wari)', NULL, '1791620205', NULL, '8/A  Ranking Street Wari  Beside Easy Show Room ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1984, 1, 6, 1, 13, 25, 102053535, 'Fingerlicks Cafe (Mirpur-12)', NULL, '1701131663', NULL, 'Safura food village Safura Tade city market  1 No sujat nogor  Pallabi  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1985, 1, 6, 1, 13, 25, 102053546, 'Czar (Gulshan)', NULL, '1701701769', NULL, 'A& W goli  BTI Landmark  Gulshan Avenue  Gulshan-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1986, 1, 6, 1, 13, 25, 102053548, 'Maxican Mirchi (Uttara)', NULL, '1781542408', NULL, '810  Zam Zam Tower', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1987, 1, 6, 1, 13, 25, 102053552, 'Dingi Kabab Ghor (Dhanmondi)', NULL, '1580576610', NULL, 'Dhanmondi Lake Road  Dhanmondi  Dhaka-1205', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1988, 1, 6, 1, 13, 25, 102053555, 'Pizzaology (Satkhira)', NULL, '1893826848', NULL, 'Satkhira Sadar  Satkhira', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1989, 1, 6, 1, 13, 25, 102053562, 'Bon Appetit (Mohammadpur)', NULL, '1735448993', NULL, 'tajmohol road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1990, 1, 6, 1, 13, 25, 102053574, 'Cafe Americano(Banasree)', NULL, '1939956900', NULL, 'Banasree  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1991, 1, 6, 1, 13, 25, 102053575, 'Jalapeno Cafe Lebanese (Uttara)', 'Mr. Hasib', '1793266513', NULL, 'House No- 46  Rabindra Sarani  Sector - 7  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1992, 1, 6, 1, 13, 25, 102053576, 'UPTOWN (Mirpur 1)', 'Mr. Sumon', '1719505319', NULL, 'Sony Square Food Court  Mirpur 1', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1993, 1, 6, 1, 13, 25, 102053587, 'Goreng Restaurant (Joydebpur)', NULL, '1726601327', NULL, 'East Chondona  Koborsthan road  Joydebpur  Gazipur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1994, 1, 6, 1, 13, 25, 102053196, 'Cheez(Banani)', NULL, '1316195220', NULL, 'Road-12 Block-E House-37 (Banani)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1995, 1, 6, 1, 13, 25, 102053198, 'Cheez(Dhanmondi)', NULL, '1312195222', NULL, '2nd Floor Kb square House 49/A Satmashjid Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1996, 1, 6, 1, 13, 25, 102053199, 'Cheez(Mohmmadpur)', NULL, '1714061305', NULL, '16/10 Ring Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1997, 1, 6, 1, 13, 25, 102053200, 'Ashta banjan (Panthapath)', NULL, '1732966649', NULL, '20/5 West Panthapath', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1998, 1, 6, 1, 13, 25, 102053227, 'Delicious Food Express', 'Selim Reja', '01710963508 (01300422005)', NULL, '24/4 ring road  mohammadpur  dhaka -1207.01300422005 near shia mosjid', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(1999, 1, 6, 1, 13, 25, 102053236, 'Bazzarmama.com (Sylhet)', 'Mr. Rajon', '1618206600', NULL, 'Kazi Asparagus Food Island  58 East Zindabazzar  Sylhet', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2000, 1, 6, 1, 13, 25, 102053238, 'Al Madina (New market)', NULL, '29663476', NULL, 'New Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2001, 1, 6, 1, 13, 25, 102053201, 'Jahir Enterprise (Dhanmondi)', 'Mr. Mahmud', '1722336547', NULL, 'Shah Ali Goli  3/7/4A  Rayer Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2002, 1, 6, 1, 13, 25, 102053226, 'Tasty-Monk (Mirpur)', 'Opu', '1676788835', NULL, '8/4   Len -01  Block- D  Section - 15  behind police convention hall  near bijoy rakeen city', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2003, 1, 6, 1, 13, 25, 102053230, 'Hakka Jhaka ( Banani)', NULL, '1616666543', NULL, 'Road-11  Plot-47  Block-H  Banani', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2004, 1, 6, 1, 13, 25, 102053231, 'Burger Express (Hatirpool)', 'Managaer  Mr. Milon', '1841979755', NULL, '2 Circular Road  Hatirpool  Voter Goli  Near Dhanmondi Masjid  01821768017', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2005, 1, 6, 1, 13, 25, 102053237, 'Pizza Heaven (Khilkhet )', NULL, '1767051598', NULL, 'Khilkhet Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2006, 1, 6, 1, 13, 25, 102053239, 'The Grillers (Banani)', NULL, '1844027462', NULL, 'Swapan Villa  Road-12  House-52  Block-H  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2007, 1, 6, 1, 13, 25, 102053240, 'Tango Cafe (Mirpur Pallavi)', NULL, '195694110', NULL, 'Mirpur Pallavi sare 11 Shopping Center', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2008, 1, 6, 1, 13, 25, 102053460, 'Cheez (Parliament)', NULL, '1305785585', NULL, 'National Parliament Bhaban Cafeteria  Agargaon  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2009, 1, 6, 1, 13, 25, 102053509, 'BurgerX (Dhalibari)', NULL, '1837656157', NULL, '444 new Appolo road  Block-A  Dhalibari pocket gate  Dilu bhaban  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2010, 1, 6, 1, 13, 25, 102053523, 'BOB Resturant (Mirpur)', 'Ali Azam', '1711518492', NULL, '56/1  West Monipur  60 Feet road  Mirpur - 2. Near by Monipur School', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2011, 1, 6, 1, 13, 25, 102053539, 'Zahid Traders', NULL, '1718523150', NULL, 'Munshi Plaza Ka 5/C jagannathpur  Bashundara link road  Vatara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2012, 1, 6, 1, 13, 25, 102053540, 'Maa Enterprise (Shahjadpur)', NULL, '1862230730', NULL, 'Shahjadpur Bus Station  besise Lavender Super Shop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2013, 1, 6, 1, 13, 25, 102053543, 'Arax (Banani)', NULL, '1786294308', NULL, 'Road 2  House 98  Banani  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2014, 1, 6, 1, 13, 25, 102053550, 'TURK KEBAB (Shyamoli)', NULL, '1688515063', NULL, '23/8 Mirpur Road  Shyamoli  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2015, 1, 6, 1, 13, 25, 102053554, 'Kudos (Bashundara)', NULL, '1978830038', NULL, '15/5 Pragati Ave. Bashundara City gate  Mutual Trust Bank  3rd Floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2016, 1, 6, 1, 13, 25, 102053557, 'Wafiyyah Restaurant (Mirpur-2)', NULL, '1714536596', NULL, '1 Number Gate  Opposite of stadium road  H-Block  House No- 30', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2017, 1, 6, 1, 13, 25, 102053561, 'Cafe Al Baik (South Mugda)', 'Md. Sakil', '1980396271', NULL, '1/30/13-1 South Mughda wasa road JS Grammer School er opposite', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2018, 1, 6, 1, 13, 25, 102053569, 'Sub Way BD (Bashundhara)', 'Mr. Amin', '1790003679', NULL, 'House-833  Road-39  Block-L  Bashundhara Residential Area', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2019, 1, 6, 1, 13, 25, 102053573, 'Spicy & Cool (Uttara)', NULL, '1681146629', NULL, 'Zam Zam Tower food court  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2020, 1, 6, 1, 13, 25, 102053578, 'Cafe Express (Tokyo Square)', 'Mr. Anik', '1636858892', NULL, 'Tokyo Square  2nd floor  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2021, 1, 6, 1, 13, 25, 102053584, 'American Burger (Chittagong)', NULL, '1714574746', NULL, 'Chittagong', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2022, 1, 6, 1, 13, 25, 102053590, 'Royal Food Corner (Bagerhaat)', 'MD. Dulal', '1705585209', NULL, 'Haji Supper Market  NobboiRoshi Bus Stand  Morelganj  Bagerhat', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2023, 1, 6, 1, 13, 25, 102053591, 'Al Fresco (Taltola)', NULL, '1972299330', NULL, '385/B  Shahid Baki Road  Khilgaon Taltola', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2024, 1, 6, 1, 13, 25, 102053596, 'Banee\'s Creation (Lalmatia)', NULL, '1966644888', NULL, '7/7 Lalmatia  Block-C  Opposite of Shanta mariyam Institute', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2025, 1, 6, 1, 13, 25, 102053602, 'Lankan Foods (Shahjadpur)', NULL, '1995074861', NULL, 'Bashtola  Shahjadpur  Natunbazar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2026, 1, 6, 1, 13, 25, 102053605, 'Bishmillah Coffee House (Norda)', NULL, '1712153593', NULL, 'E-27  Shahid Abdul Aziz road  Jagannatpur  Vatara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2027, 1, 6, 1, 13, 25, 102053609, 'Subol General Store (DCC)', NULL, '1911486377', NULL, 'DCC Kacha bazar  Gulshan-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2028, 1, 6, 1, 13, 25, 102053615, 'WhollyDeli (Bijoy Sarani)', NULL, '1755633988', NULL, 'Bijoy Sarani  Hatil building  Lift-5', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2029, 1, 6, 1, 13, 25, 102053616, 'Burger Express (Banani)', NULL, '1601979711', NULL, 'Road-7  House-33  Banani Kachabazar Road  Banani  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2030, 1, 6, 1, 13, 25, 102053618, 'Dark Burg (Mirpur-12)', NULL, '1614690438', NULL, 'Signature Food Court  Sultan Mansion  Begum Rokeya Sarani  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2031, 1, 6, 1, 13, 25, 102053619, 'Cui Gouse (Uttara)', NULL, '1403000498', NULL, 'Rajlokkhi  Shopno nbuilding  Level-4  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2032, 1, 6, 1, 13, 25, 102053620, 'Mr. Abdur Rouf (Shantinagar)', NULL, '1779591553', NULL, 'Shantinagar Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2033, 1, 6, 1, 13, 25, 102053621, 'Preetom Burger (Gulshan)', NULL, '1611157206', NULL, 'Panda Kitchen  Road-132  Shop-13  Gulshan-1  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2034, 1, 6, 1, 13, 25, 102053623, 'The Little Rome (Uttara)', 'Iftee', '1717661585', NULL, 'House # 39  Road # 18  Sector # 03', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2035, 1, 6, 1, 13, 25, 102053624, 'Thirty Three Restaurant (Dhanmondi)', NULL, '1720338875', NULL, '754/B  4th floor  Satmosjid road  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2036, 1, 6, 1, 13, 25, 102053626, 'Azmir Hotel (Tejgaon)', NULL, '1715537608', NULL, 'Begun Bari Tejgaon  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2037, 1, 6, 1, 13, 25, 102053628, 'Perfect Eat', 'Joyanto', '1748402676', NULL, 'Mirpur Shop: 11  Lift: 7  DOHS Shopping Complex', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2038, 1, 6, 1, 13, 25, 102053490, 'Sublovers (Tilpapara)', NULL, '1745565398', NULL, '18 no goli  Tilpapara  Khilgaon', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2039, 1, 6, 1, 13, 25, 102053491, 'Crush Station (Taltola)', NULL, '1635706061', NULL, '552/C  Level-3  Khilgaon Taltola', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2040, 1, 6, 1, 13, 25, 102053493, 'EFC (Polton)', NULL, '1934142808', NULL, '55/1  Islam Tower  Level-5  Puana polton', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2041, 1, 6, 1, 13, 25, 102053505, 'Pizza Hall (Banasree)', 'Mr. Shishir', '1608108751', NULL, 'House - 14  Block - B Main Road Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2042, 1, 6, 1, 13, 25, 102053524, 'Mad chef (Parliament)', NULL, '1734871067', NULL, 'Sangsadbhaban gate no:6  Agaogaon  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2043, 1, 6, 1, 13, 25, 102053547, 'HEXA Dine (Banani)', NULL, '01886-439222', NULL, 'House-34  Road-10  Block-D  Banani  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2044, 1, 6, 1, 13, 25, 102053566, 'Southern CHIC (Gulshan)', NULL, '1629876180', NULL, 'BTL Landmark  16th Gulshan  Level-2  A&W Goli', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2045, 1, 6, 1, 13, 25, 102053598, 'Korean Bangladesh Club (Mirpur-1)', NULL, '1772159360', NULL, 'Bagdad Shopping Complex  Level-12  Mirpur-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2046, 1, 6, 1, 13, 25, 102053599, 'Twelve-30 Cafe (Uttara)', NULL, '1753795440', NULL, 'House-25  Road-18  Sector-3  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2047, 1, 6, 1, 13, 25, 102053603, 'Mizan General Store (KB)', NULL, '1726887481', NULL, 'Kitchen market 2nd floor  Karwanbazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2048, 1, 6, 1, 13, 25, 102053614, 'Hot Chicken (JFP)', NULL, '1911684070', NULL, 'Jamuna Future park food court', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2049, 1, 6, 1, 13, 25, 102053625, 'Foodieco Restaurant (Green Road)', NULL, '1717714763', NULL, '25/A  Green Road  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2050, 1, 6, 1, 13, 25, 102053627, 'Plaks (Polton)', NULL, '1882604759', NULL, 'China Town Food Court  Polton', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2051, 1, 6, 1, 13, 25, 102053629, 'Cafe Darbar (Dhanmondi)', 'Md. Shanto Rahman', '1828682448', NULL, 'Dhanmondi 5/A House#74  Level#6', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2052, 1, 6, 1, 13, 25, 102053630, 'Hungry Port Bd (Khilgaon)', 'Mustayeen', '1948137078', NULL, 'Kazi Ejlas Ground Floor  823/A Khilgaon Chourasta Ekota Shorok Kazi Para ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2053, 1, 6, 1, 13, 25, 102053631, 'Todos Santos (Gulshan 2)', NULL, '1817560425', NULL, 'Gulshan 2  Hamid Tower Level- 10', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2054, 1, 6, 1, 13, 25, 102053632, 'Water Fall Garden (Shajadpur)', NULL, '1912141674', NULL, '32/51/B Sajadpur Opposite of Suvastu Nazan Valley Shopping Complex  Baridhara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2055, 1, 6, 1, 13, 25, 102053634, 'Dallas Express (Shimanto Shomvar)', NULL, '1938190189', NULL, 'Shimanto Shomvar  Shop No: 9016', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2056, 1, 6, 1, 13, 25, 102053635, 'Panshe (Dhanmondi)', NULL, '01986069633  01755701162', NULL, 'Dhanmondi Lake road  Mirpur road  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2057, 1, 6, 1, 13, 25, 102053636, 'Al Reza Mamun (Banasree)', NULL, '1621085402', NULL, 'House-23  Road-5  Block-D  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2058, 1, 6, 1, 13, 25, 102053637, 'Chacha Chotpoti chicken (Nodda)', 'Md.Liyakot', '1927112736', NULL, 'Shohid abdul Aziz Shorok Nodda Vatara.Dhaka  1229', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2059, 1, 6, 1, 13, 25, 102053638, 'Shifa Burger (Baily Road)', 'Md  Rabiul Islam', '1629356510', NULL, 'baily road  green kazi cottage  1st floor  Shop no: 9', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2060, 1, 6, 1, 13, 25, 102053640, 'Bar BQ Loung', NULL, '1944551188', NULL, 'Mirpur DOHS Shopping Complex  1st Floor Rooftop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2061, 1, 6, 1, 13, 25, 102053642, 'Tasty Buds (Uttara)', NULL, '1919525022', NULL, 'Zam Zam Tower  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2062, 1, 6, 1, 13, 25, 102053647, 'Parsley kitchen (Uttara)', NULL, '1624485735', NULL, 'Shop No: 15  house-1  Road-17  Sector-12  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2063, 1, 6, 1, 13, 25, 102053650, 'Kabab Kitchen (Taltola)', NULL, '1842402076', NULL, '532/1 Shohidbagh Mosjid Goli  Dhaka-1217', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2064, 1, 6, 1, 13, 25, 102053653, 'Indian Spicy Chicken (Khilkhet)', NULL, '1936967690', NULL, 'Khilkhet  Near Panir Pump', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2065, 1, 6, 1, 13, 25, 102053654, 'BP Restaurant and cafe (Naogaon)', NULL, '1755634000', NULL, 'Naogaon Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2066, 1, 6, 1, 13, 25, 102053658, 'Aussie Guys Pizza (Banani)', NULL, '1748780172', NULL, 'Block-D  Road-15  House-4  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2067, 1, 6, 1, 13, 25, 102053633, 'The Pacific Restaurant (Badda)', NULL, '1880970648', NULL, '181/1-A  Lake road  Gudara Ghat  Badda', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2068, 1, 6, 1, 13, 25, 102053639, 'Mir Monir (Tongi)', NULL, '1941585305', NULL, 'Tongi College Gate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2069, 1, 6, 1, 13, 25, 102053641, '.', 'Anik Ahmmed', NULL, NULL, 'House 1/11/2  Road 5  Block- G  Mirpur-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2070, 1, 6, 1, 13, 25, 102053643, 'Taevas (Dhanmondi 7)', NULL, '199686486', NULL, 'Rangs Fortune  28 Bir Uttam MA Rob sarak  Dhanmondi-7  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2071, 1, 6, 1, 13, 25, 102053644, 'Thangabali (Mirpur-1)', NULL, '1911502933', NULL, 'House-1/11/2  road-5  block-G  Mirpur-1', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2072, 1, 6, 1, 13, 25, 102053648, 'Addabazi (Lalmatia)', NULL, '1992177537', NULL, '3/4  Block - D Lalmatia', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2073, 1, 6, 1, 13, 25, 102053655, 'Dilli Darbar (Mohammadpur)', NULL, '1762309830', NULL, '44  Probal Housing  Ring Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2074, 1, 6, 1, 13, 25, 102053656, 'Unique Hotel & Resorts PLC (Westin)', NULL, '1709654325', NULL, 'Address- Plot-1  cwn(b) Road-45  Gulshan-02  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2075, 1, 6, 1, 13, 25, 102053663, 'Taher Store (Hatirpool)', NULL, '1711014499', NULL, 'Hatirpool Kachabazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2076, 1, 6, 1, 13, 25, 102053664, 'Garden Cafe (Khilgaon)', NULL, '1714380950', NULL, 'Khilgaon Taltola', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2077, 1, 6, 1, 13, 25, 102053667, 'Norail Food (Mirpur DOHS)', 'Md. Shfiq', '1571049949', NULL, 'Mirpur DOHS Shopping Complex Lift- 8', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2078, 1, 6, 1, 13, 25, 102053668, 'Delwar Store (Mohammadpur)', 'Md. Delwar', '1754761895', NULL, 'Mohammadpur Townhall Kacha Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2079, 1, 6, 1, 13, 25, 102053670, 'Unique Hotel & Resorts PLC (Sheraton)', NULL, '1313709066', NULL, '44  Kamal Ataturk Avenue  Banani  Dhaka-1213', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2080, 1, 6, 1, 13, 25, 102053672, 'Corn Gallery (JFP)', NULL, '1798882224', NULL, '1st floor  Central Court  beside lift-1 & 2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2081, 1, 6, 1, 13, 25, 102053673, 'Tasty Bites (ECB)', 'Mr. Shamim', '01828122671 / 01730975029', NULL, '598/8  4th Floor South Manikdi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2082, 1, 6, 1, 13, 25, 102053680, 'Wooden Oven (Mirpur-14)', NULL, '1757073437', NULL, 'H-144  N. Kafrul  Kachukhet  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2083, 1, 6, 1, 13, 25, 102053682, 'Dough (Dhanmondi)', NULL, '1766628655', NULL, 'Fortune Square 11th Floor  Plot- 32  Road-2  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2084, 1, 6, 1, 13, 25, 102053684, 'Murad Store (Sylhet)', NULL, '01712-545812', NULL, 'Mohajon Potti  Sylhet', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2085, 1, 6, 1, 13, 25, 102053685, 'Nababi Voj (Mirpur-12)', NULL, '1886677962', NULL, 'Block-B  Road-6/6  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2086, 1, 6, 1, 13, 25, 102053688, 'Campfine Restaurant (Uttara)', NULL, '1712844088', NULL, '55  Gausul Azam Avenue  Sector-14  Uttara  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2087, 1, 6, 1, 13, 25, 102053690, 'Al Madina Store (Munshiganj)', NULL, '1994390301', NULL, 'Munshiganj Super Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2088, 1, 6, 1, 13, 25, 102053691, 'Shaon Traders (Mowlavibazar)', NULL, '01741153222   01971527429', NULL, 'Mowlavibazar  Gail Gate  Old Town', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2089, 1, 6, 1, 13, 25, 102053692, 'Burger Station(Azimpur)', NULL, '1919534361', NULL, '15/A/11  Azimpur road  Lalbag', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2090, 1, 6, 1, 13, 25, 102053694, 'Bundose (Kholgaon)', NULL, '1929148208', NULL, '586/C Khilgaon Shahid Baki Road  Opposite of Chillox', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2091, 1, 6, 1, 13, 25, 102053698, 'Hashtag Coffee (Mirpur)', NULL, '1736730712', NULL, 'Plot-5  Shop-27  road-12  Sonar Bangla Market  Rupnagar  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2092, 1, 6, 1, 13, 25, 102053699, 'Greens Pepper Restaurant Ltd (Bashundara)', NULL, '1768316090', NULL, 'Road - 17  Block - I Dhali Fitness Center Opposite of Walton Head Office', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2093, 1, 6, 1, 13, 25, 102053704, 'Pizza Mastan (Baily road)', NULL, '1968628819', NULL, 'Al madina place  shop-03  31/1  Baily road  Shantinagar mor  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2094, 1, 6, 1, 13, 25, 102053705, 'Burger & Steak (Dhanmondi)', NULL, '1751796926', NULL, 'Rangs KB Square  Level-11  Satmosjid road 9/A  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2095, 1, 6, 1, 13, 25, 102053706, 'Wafl Cafe (Uttara)', 'Yeasin', '1313789101', NULL, 'Section:13  Road:13  House: 01  Level: 3  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2096, 1, 6, 1, 13, 25, 102053649, 'Cafe Sao Paulo (Dhanmondi)', NULL, '1670178585', NULL, 'Gawsia Twin Piek  3rd floor  House-42-43  Satmosjid road  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2097, 1, 6, 1, 13, 25, 102053652, 'The Hotdog Company (Dhanmondi)', NULL, '1719182424', NULL, 'Road: 3/A  AMM Center  6th floor  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2098, 1, 6, 1, 13, 25, 102053669, 'Soi7 Cafe (Dhanmondi)', 'Md. Rahad', '1996846486', NULL, 'House: 28  Road: 7  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2099, 1, 6, 1, 13, 25, 102053671, 'Shawarma King (Sonir Akhra)', NULL, '1746036579', NULL, 'Beside of Borno Mala High School  Sonir Akhra', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2100, 1, 6, 1, 13, 25, 102053677, 'AG Food (Niketon)', 'Md. Oman Faruk', '1791323171', NULL, 'Niketon Bazar  Gate', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2101, 1, 6, 1, 13, 25, 102053701, 'Meet & Eat (Mohammadpur)', NULL, '168900989', NULL, '14/5  Hazi Chunnu Mia  Road  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2102, 1, 6, 1, 13, 25, 102053702, 'Taza BBQ (Gulshan)', NULL, '1983667077', NULL, '175/A  Road-61  Gulshan Gulshan-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2103, 1, 6, 1, 13, 25, 102053703, 'Red Chilli Food (Mohakhali)', NULL, '1912002497', NULL, 'SKS tower  3rd floor  Shop no: 9  Mohakhali', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2104, 1, 6, 1, 13, 25, 102053708, 'Mr. Manik Foods (Mohammadpur)', 'Md. Kamrul', '1865963434', NULL, '223/24 H.I Khan Trade Center Taj Mohol Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2105, 1, 6, 1, 13, 25, 102053715, 'Hunger Villege (Tongi)', NULL, '1400123242', NULL, 'Tongi College Gate', 40000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2106, 1, 6, 1, 13, 25, 102053716, 'Ninja Dining (Uttara)', NULL, '1715510768', NULL, 'Nothern fornt food court  Khalper  Uttara', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2107, 1, 6, 1, 13, 25, 102053717, 'Burger Lab (Uttara)', NULL, '1782570989', NULL, 'House-16  Garib Neaz Avenue  Sector-11  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2108, 1, 6, 1, 13, 25, 102053719, 'Rustic Eatery (Banani)', NULL, '1865139970', NULL, 'Block-D  Road-8  House-2  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2109, 1, 6, 1, 13, 25, 102053720, 'Yummy Yummy (Mirpur 11)', NULL, '1734496131', NULL, 'House-14  Road-9  Block-D  Mirpur-11', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2110, 1, 6, 1, 13, 25, 102053727, 'Crisp (Dhanmondi Chefs Table)', NULL, '01914001430/01719953125', NULL, 'Level-3  House-80  Road-8/A  Satmosjid Road  Dhaka-1205', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2111, 1, 6, 1, 13, 25, 102053730, 'Kazipur Chicken (Nilkhet)', NULL, '1789592667', NULL, 'Shop-58  Nilkhet City Corporation market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2112, 1, 6, 1, 13, 25, 102053732, 'Mayer Hassel (Uttara)', NULL, '1710850281', NULL, 'Shop-12  Northern pront food court  Sonargaon Janapath  Sector-12  New khalpar  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2113, 1, 6, 1, 13, 25, 102053735, 'Home Kitchen (Jail Gate)', NULL, '1707072430', NULL, 'Nazim Uddin road  near Jail Gate', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2114, 1, 6, 1, 13, 25, 102053737, 'Simple R Ki (Khilket)', 'Mr. Iqbal', '1601008555', NULL, 'Near Namapara Panir Pamp  Khilkhet', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2115, 1, 6, 1, 13, 25, 102053740, 'Ascott The Residence{Bridhara}', 'Mr. Saiful', '1712900999', NULL, 'Diplomatic Zone  Road-8  House No-13  Block- K', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2116, 1, 6, 1, 13, 25, 102053741, 'Rool Avenue (Uttara)', 'Abu Bakkar Siddique', '1798875506', NULL, 'Road-1  Sector-7  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2117, 1, 6, 1, 13, 25, 102053750, 'Crazy Chicken\'s (Mirpur DOHS)', NULL, '1741893853', NULL, 'Daruchini Food Village Near Mirpur DOHS  gate number-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2118, 1, 6, 1, 13, 25, 102053753, 'Broast Foods Industries Pvt Ltd (Ctg)', 'Mr. Kawsar', '1869451958', NULL, 'Highway Plaza  1st Floor  600 CDA Avenue  Lalkhan Bazar  Chattagram', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2119, 1, 6, 1, 13, 25, 102053657, 'Pacific Shop (Tejgaon)', NULL, '1911914999', NULL, '78/2  Old airport road  Bijoy Sarani  Tejgaon  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2120, 1, 6, 1, 13, 25, 102053660, 'Helvetia (Eastern Plaza)', NULL, '1973667663', NULL, 'Food Court  Shop-3  Eastern Plaza  Hatirpool  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2121, 1, 6, 1, 13, 25, 102053661, 'Spice kitchen (Wari)', NULL, '1799976642', NULL, '19/1B  Larmini street  1st floor  Wari  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2122, 1, 6, 1, 13, 25, 102053662, 'Pizzu (Dhanmondi)', NULL, '1841393748', NULL, '44  old Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2123, 1, 6, 1, 13, 25, 102053674, 'Pizza Hall', NULL, '1608108751', NULL, '932/C Khilgaon Taltola  Opposite of Nazma Tower', 40000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2124, 1, 6, 1, 13, 25, 102053683, 'Momo Mela (Banasree)', 'Md. Noor Alom', '01777015955  01976015955', NULL, 'Block# C  Road# 5  House# 31  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2125, 1, 6, 1, 13, 25, 102053700, 'Chui Gosh (Uttara)', NULL, '1401877160', NULL, 'Near Rajlokkhi Shwapno', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2126, 1, 6, 1, 13, 25, 102053721, 'The Rio Lounge Ltd (Gulshan 2 )', 'Md. Arif Chowdhury', '1600365408', NULL, '7th Floor  Pink City Shopping Center  15 Gulshan Avenue  Dhaka-1212', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2127, 1, 6, 1, 13, 25, 102053723, 'Kureghor Kabab (Banasree)', NULL, '1705038028', NULL, 'House No-33  Block-F  Road:2  Daily Shoping er upore', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2128, 1, 6, 1, 13, 25, 102053731, 'Elite Foods Industries Ltd. (Uttara)', NULL, '1856358808', NULL, '25 Gareeb-E-Newaj Avenue  Uttara  Dhaka-1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2129, 1, 6, 1, 13, 25, 102053743, 'GREENLAND SERVICES LTD (Mirpur)', NULL, '1709991041', NULL, 'Plot No # 02  Road # 11  Block # c  Section # 06 Mirpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2130, 1, 6, 1, 13, 25, 102053745, 'GREENLAND SERVICES LTD (Banani)', NULL, '1709991016', NULL, 'Plot # 52  Road # 11  Block #c  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2131, 1, 6, 1, 13, 25, 102053751, 'Thalai (B.City)', NULL, '1716840605', NULL, 'Shop No- 89 90  Bashundhara City', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2132, 1, 6, 1, 13, 25, 102053754, 'Pitza (Uttara)', NULL, '1401474892', NULL, 'Sector 11  Road-10B  House 24  Opposite of Meena Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2133, 1, 6, 1, 13, 25, 102053755, 'FNC Limited (Gulshan)', NULL, '01729-066-402', NULL, 'Safura Tower (9th Floor)  20 Kemal Ataturk Avenue  Banani C/A  Dhaka 1213', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2134, 1, 6, 1, 13, 25, 102053756, 'Bangla Kitchen (Shantinagar)', NULL, '1959856565', NULL, '60 Chamelibag  Shantinagar  Dhaka-1217', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2135, 1, 6, 1, 13, 25, 102053757, 'Food & Fire (Gazipur)', NULL, '1932390991', NULL, 'Earshad Nagar  Tongi  Gazipur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2136, 1, 6, 1, 13, 25, 102053758, 'Madrashatum Morium Al Islam', 'Jaman Ahmed', '1736811153', NULL, 'Kishoregonj Fourteen Union', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2137, 1, 6, 1, 13, 25, 102053761, 'Hobnob Coffee (Banani)', NULL, '1844659830', NULL, 'House-158  Block-E  Taneem Square (2nd Floor)  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2138, 1, 6, 1, 13, 25, 102053764, 'Fatman Burger (Banani)', NULL, '1707001331', NULL, 'Road-21  House-74  Bidda Niketon School er pashe  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2139, 1, 6, 1, 13, 25, 102053765, 'Red Bee (Jatrabari)', NULL, '1766392020', NULL, 'Bou Bazar  Uttar Jatrabari  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2140, 1, 6, 1, 13, 25, 102053766, 'Dough Diaries', NULL, '1728095215', NULL, 'Arong Gulshan Tejgong Link Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2141, 1, 6, 1, 13, 25, 102053770, 'Tortilla (Mirpur)', NULL, '1726793292', NULL, 'House-2  Road-3  Block-A  Section-10  Mirpur  Dhaka1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2142, 1, 6, 1, 13, 25, 102053772, 'Mr. Pasta (Taltola)', 'Emran', '1628086067', NULL, 'Khilgoan Taltoal  Beside BFC', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2143, 1, 6, 1, 13, 25, 102053774, 'Grand Bistro (Taltola)', NULL, '1963646622', NULL, 'Taltola Beside Mr. Burger', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2144, 1, 6, 1, 13, 25, 102053777, 'Meat & Grill', 'Naim', '1713858667', NULL, 'Opposide of Al Karim tower  Basila road  After Basila Bridge', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2145, 1, 6, 1, 13, 25, 102053778, 'Delhi Spicy (Bcity)', NULL, '1719406799', NULL, 'Shop No: 91  Block-D  Bashundhara City Food Court', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2146, 1, 6, 1, 13, 25, 102053783, 'Bon Appetit Delight', NULL, '1797051985', NULL, '2nd Floor  2/20  Tajmohol Road  Mohammadpur  Dhaka-1207', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2147, 1, 6, 1, 13, 25, 102053784, 'Elite food\'s industries Ltd. (Cox\'s Bazar)', 'Mr.Sawron', '1840126553', NULL, 'Plot B block c  sughanda point  kolatali road  Cox\'s Bazar.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2148, 1, 6, 1, 13, 25, 102053676, 'Cielo Roof Top (Badda)', NULL, '1782247034', NULL, 'Level-11  Hossain Market  Uttar Badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2149, 1, 6, 1, 13, 25, 102053747, 'NAVANA FOODS LIMITED (Gulshan-2)', NULL, NULL, NULL, 'HOUSE-2B. Block- NE (B)  Road-71. Gulshan-2  DHAKA-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2150, 1, 6, 1, 13, 25, 102053762, 'Pizza Heist (Badda)', NULL, '1674000290', NULL, 'Ta-182/1/A  Middle Badda (Near Badda High School)  Badda Dhaka-1212', 40000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2151, 1, 6, 1, 13, 25, 102053782, 'American Embassy Employees Association', NULL, '1724214316', NULL, 'House-13 Road-68(Back Gate)  Gulshan-02 Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2152, 1, 6, 1, 13, 25, 102053787, 'Corn Gallery (ECB)', NULL, '1405741479', NULL, 'Mega food Court  ECB  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2153, 1, 6, 1, 13, 25, 102053788, 'Royel Host Restaurant (Jatrabari)', NULL, '1717376847', NULL, '314/A/4  Bir Uttam Haidar Road  South Jatrabari  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2154, 1, 6, 1, 13, 25, 102053789, 'Cafe Hot Plate (Mugda)', 'Md. Abu Bakkar', '1762377886', NULL, 'Omit Nur Saleh Garden 2/3 South Mugda Dhaka-1214', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2155, 1, 6, 1, 13, 25, 102053790, 'Konna (Dhanmondi)', NULL, '1715006489', NULL, 'House-35  Road-7  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2156, 1, 6, 1, 13, 25, 102053793, 'Devour Ltd (Baridhara)', 'Md. Monir', '1713029996', NULL, 'Ground Floor  House - 10  Road - 5/A  Block - J  Baridhara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2157, 1, 6, 1, 13, 25, 102053794, 'King Fishers (Uttara)', NULL, '1772159360', NULL, 'Garib E Newaz  Sector-13  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2158, 1, 6, 1, 13, 25, 102053795, 'Sung Garden (Dhanmondi)', NULL, '1711902874', NULL, 'Mir Noor Square  1st floor  House 43  Road- 2/A  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2159, 1, 6, 1, 13, 25, 102053796, 'Slieez (Mirpur)', NULL, '1963569092', NULL, 'Romjan Meha Super Market  Mirpur 12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2160, 1, 6, 1, 13, 25, 102053797, 'Babuland (Mirpur)', NULL, '1620855976', NULL, 'Mirpur Shopping Mall  7th Floor  Mirpur-2', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2161, 1, 6, 1, 13, 25, 102053798, 'Legendr Pizza Park', NULL, '1985326219', NULL, 'Block- D  Road- 8  House- 2  Eidgahmath  Mirpur- 12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2162, 1, 6, 1, 13, 25, 102053799, 'Pasta Club (Banasree)', NULL, '1810529424', NULL, 'Block- B  Road- 1  House- 31', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2163, 1, 6, 1, 13, 25, 102053800, 'Rich Table (Uttara)', NULL, '1610112144', NULL, 'Garib-E-newaz Avenue  House-30  Lift-3  Sector-13  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2164, 1, 6, 1, 13, 25, 102053801, 'Karishma Services Ltd(Amari Dhaka)', NULL, '1777719396', NULL, 'House No # 47 Road No # 41 Gulshan-1  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2165, 1, 6, 1, 13, 25, 102053803, 'Sub Club', NULL, '1712654440', NULL, 'Khilgaon  Taltola  Beside Apon Coffee Shop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2166, 1, 6, 1, 13, 25, 102053804, 'Boogie Bites (Khilgaon)', NULL, '1682652525', NULL, '381/B Rooftop of Apon Coffee House Shoid Baki Road  Khilgaon  Dhaka-1219', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2167, 1, 6, 1, 13, 25, 102053809, 'Dhaka Royel Club(Uttara)', NULL, '1644510694', NULL, 'Sector#13  Road#14  House#21  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2168, 1, 6, 1, 13, 25, 102053811, 'Pasta Club Central Kitchen', 'Kabir', '1854034160', NULL, 'Trimohoni Bridge  Hajibari Road ', 400000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2169, 1, 6, 1, 13, 25, 102053813, 'CSD (Mohakhali DOHS)', NULL, '1985115220', NULL, 'Mohakhali DOHS  Road-20  House-38  Mohakhali  Dhaka', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2170, 1, 6, 1, 13, 25, 102053814, 'Dhaka Club Ltd (Shahbag)', NULL, '1917137842', NULL, 'Ramna Shahbag  Dhaka-1000', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2171, 1, 6, 1, 13, 25, 102053815, 'Batatys', NULL, '1701674959', NULL, 'Block-A  Road-2  Rajbari Food Court  Bashundhara Residential Area', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2172, 1, 6, 1, 13, 25, 102053816, 'Taste Ride (Moghbazar)', 'Md. Mafujur Rahman', '1716586326', NULL, NULL, 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2173, 1, 6, 1, 13, 25, 102053820, 'Unique Hotel & Resorts PLC (HANSA)', NULL, '1708800743', NULL, 'Plot#3&5  Road#10/A. Sector-9. Uttara. Dhaka-1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2174, 1, 6, 1, 13, 25, 102053821, 'Suvaco Bangladesh (Tejgaon)', NULL, '1877631650', NULL, NULL, 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2175, 1, 6, 1, 13, 25, 102053825, 'Shuktara Cafe (Mirpur)', NULL, '1713546789', NULL, 'Mirpur Cricket Stadium No-1 Gate  North Side', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2176, 1, 6, 1, 13, 25, 102053826, 'Stake Burger (Bashundhara)', NULL, '1647723932', NULL, 'Bashundhara Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2177, 1, 6, 1, 13, 25, 102053208, 'Chilli  Cafe (Mogbazar)', 'Nibir', '1973148888', NULL, '16/4 Madhubag Mogbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2178, 1, 6, 1, 13, 25, 102053212, 'Nobanno cafe & resturant (purbachol)', NULL, '1400333665', NULL, 'Purbachol nila market sector# 1  rode #203  house #18', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2179, 1, 6, 1, 13, 25, 102053218, 'DHAKA INSIDE (Mirpur)', 'Kazi Tanvir Akhter', '1971018416', NULL, 'House:9  Road:5  Block:A  Section:10  Pallabi  Mirpur. Benaroshi Palli.', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2180, 1, 6, 1, 13, 25, 102053223, 'Station Zero (Mohammodpur)', 'Mr.Rasel', '1316434618', NULL, 'Mohammadia Housig Main Road.Opposite of Nur Masjid', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2181, 1, 6, 1, 13, 25, 102053242, 'Afgan Grill (Banani)', NULL, '1708528888', NULL, 'Road-11  House-25  Banani', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2182, 1, 6, 1, 13, 25, 102053243, 'Mahira Store (Rangpur)', 'Mosaddek Ali', '1643876550', NULL, 'Rangpur Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2183, 1, 6, 1, 13, 25, 102053244, 'Burger Express (Mohammadpur)', NULL, '1601979755', NULL, 'Y/8  Nurjahan Road  Mohammadpur  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2184, 1, 6, 1, 13, 25, 102053213, 'Bhatiali Food Village (Tongi)', NULL, '1936470222', NULL, 'Sur Torongo road  Cherag Ali  Tongi', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2185, 1, 6, 1, 13, 25, 102053215, 'Chaa Bari (Jhenaidah)', 'Abdus Sattar', '1748155081', NULL, 'H.S.S Road  Jhenaidah Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2186, 1, 6, 1, 13, 25, 102053217, 'Shimanto QQ Smoothie Bar (Dhanmondi)', 'Arif', '1994152982', NULL, 'Shimanto Square', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2187, 1, 6, 1, 13, 25, 102053219, 'Prottoya Enterprise (Feni)', 'Kandokar Juel', '1820227117', NULL, 'Gaurisankar market  Khoddor Potti  Feni Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2188, 1, 6, 1, 13, 25, 102053221, 'Chomok Gourmet Cafe (Ctg)', 'Mehedi Ahmed', NULL, NULL, '394  Brother\'s Mansion  East Rampur  Eidgah Ruposhi Bakery  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2189, 1, 6, 1, 13, 25, 102053689, 'Ruya Cafe (Bijoy Sarani)', NULL, '1912042113', NULL, 'Bangabandhu Samorik Jadughor  Bijoy Sarani  Tejgaon  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2190, 1, 6, 1, 13, 25, 102053695, 'Cafe PSC (Mirpur-14)', NULL, '1718954960', NULL, 'Police Staff College  Mirpur-14', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2191, 1, 6, 1, 13, 25, 102053724, 'Crisp (Gulshan Unimart Chefs Table)', NULL, '01918643663/01978643663', NULL, 'Level-2  Gulshan center point  road-90  91  Gulshan2  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2192, 1, 6, 1, 13, 25, 102053733, 'Nur Beef house (Gulshan-2)', NULL, '1819150153', NULL, 'Shop-9  Gulshan-2 Kachabazar', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2193, 1, 6, 1, 13, 25, 102053768, 'Win Bees (Khilgaon)', NULL, '1304862095', NULL, 'Khilgaon Taltola Super market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2194, 1, 6, 1, 13, 25, 102053779, 'Halim Baburchi (Mogbazar)', NULL, '1700513745', NULL, 'Beside Mogbazar Agora', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2195, 1, 6, 1, 13, 25, 102053785, 'Coffeelious Express (Khilgaon)', NULL, '1784621699', NULL, '394/B  Shahid Baki Road  1st Floor  Opposite of Pallima School  Khilgaon  Taltola', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2196, 1, 6, 1, 13, 25, 102053806, 'Mexican Cafe', NULL, '1999902627', NULL, 'Shimanto Shomver Food Court (9th floor) Shop#9032  Pilkhana  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2197, 1, 6, 1, 13, 25, 102053810, 'Flame Restaurant (Banani)', 'Sumon', '1816420030', NULL, 'House: 32  Road: 11  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2198, 1, 6, 1, 13, 25, 102053812, 'CSD Officers Club (Mirpur Cantonment)', NULL, '1754578251', NULL, 'Army Officers Club  Opposite of Army Head Quarter  Mipur Cantonment  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2199, 1, 6, 1, 13, 25, 102053817, 'Pankouri (Mirpur ECB)', 'Md. Rony', '1680727016', NULL, '558/3 ECB Chottor Opposite BJ Tower', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2200, 1, 6, 1, 13, 25, 102053818, 'Dusa Hut (Adabor)', 'Md. Liton', '1727857171', NULL, 'Janata Housing SOciety  Shahabuddin Plaza  Adabor', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2201, 1, 6, 1, 13, 25, 102053827, 'Pasta Club( Sonirakhra)', NULL, '1890374721', NULL, 'Beside of Borno Mala High School  Sonir Akhra', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2202, 1, 6, 1, 13, 25, 102053829, 'Baburchi Bari (Bashundhara)', 'Alamin Hossain', '1817549959', NULL, 'Kha - 90  Road- 11  Kuril  Bashundhara  Dhaka -1219  Near - Northsouth University', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2203, 1, 6, 1, 13, 25, 102053830, 'Meat Theory (Banani)', NULL, '1990887700', NULL, 'Classic Center  Level-3  House No-1  Road-11  Block - F  Banani', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2204, 1, 6, 1, 13, 25, 102053832, 'Mummy\'s Kitchen (Banasree)', 'Mr. Montasim', '1867822553', NULL, 'House-29  Road-5/9  South Banasree  Behind of Banasree Model School  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2205, 1, 6, 1, 13, 25, 102053835, 'Kiddie Garden (Banasree)', NULL, '1681561839', NULL, 'Block-G  Road-2  House-2', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2206, 1, 6, 1, 13, 25, 102053836, 'Burger  Queen.com', NULL, '1774921257', NULL, 'In front of Sial Barir Mor  Mirpur-2  Commerce College road  Near Chatona School', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2207, 1, 6, 1, 13, 25, 102053838, 'Indian Spicy Chiken (Malibagh)', 'Md. Sirajul Islam', '1785625632', NULL, '99/1 B Malibagh ChwoduryPara Dhaka 1219', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2208, 1, 6, 1, 13, 25, 102053840, 'Sena Hotel Developments Ltd', NULL, '1730089135', NULL, 'Airport Road  Dhaka Cantonment  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2209, 1, 6, 1, 13, 25, 102053842, 'Zero Cafe (Mogbazar)', NULL, '1890459614', NULL, 'Wireless  Mogbazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2210, 1, 6, 1, 13, 25, 102053843, 'AGK Food Rooftop (Mirpur DOHS)', NULL, '1711275465', NULL, 'Mirpur DOHS Shopping Complex Rooftop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2211, 1, 6, 1, 13, 25, 102053845, 'Shahed Enterprise', NULL, '1715305930', NULL, 'Karwanbazar  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2212, 1, 6, 1, 13, 25, 102053846, 'Burger Express (N. Gong)', NULL, '1401497955', NULL, 'Chasara  Narayngonj', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2213, 1, 6, 1, 13, 25, 102053847, 'Ahmadia Sunnia Moszid (Bakshibazar)', 'Mr. Mahbub', '1741505151', NULL, 'Bakshibazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2214, 1, 6, 1, 13, 25, 102053792, 'Showrob Kitchen(Tejgoan)', NULL, NULL, NULL, 'Tejgoan  Dhaka', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2215, 1, 6, 1, 13, 25, 102053802, 'CSD Sorobon Tess (Mirpur Dohs)', NULL, '1769057594', NULL, 'Dhaka Cantonment  Dhaka-1209', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2216, 1, 6, 1, 13, 25, 102053831, 'Cafe Milano (Ctg)', NULL, '1875525511', NULL, 'Mayor goli  mayor er basha  2no gate Chittagong', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2217, 1, 6, 1, 13, 25, 102053833, 'Khatir (Uttara)', NULL, '1720536655', NULL, '19  Sonargaon  Janapath Road  Union Nahar Square (Top of BFC)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2218, 1, 6, 1, 13, 25, 102053837, 'Mr. Burger Kitchen', NULL, '1874660055', NULL, '91/B Khilgaon Chowdhury Para  Dhaka  Firoza Tower Noor Masjid', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2219, 1, 6, 1, 13, 25, 102053844, 'Sultan Suleiman (Uttara)', NULL, '1624773312', NULL, 'Shah Mokdum Avenue  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2220, 1, 6, 1, 13, 25, 102053849, 'Abdullahpur Store (Mirpur-14)', 'Abdul Hannan', '1308967344', NULL, 'Pul par  Mirpur-14', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2221, 1, 6, 1, 13, 25, 102053850, 'Mr. Sumon (Mirpur-60 Feet)', NULL, '01721-179433', NULL, '363/1/a  Abu Bakkar Madrasha  Chapra Mosjid  60 Feet Road  Mirpur', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2222, 1, 6, 1, 13, 25, 102053851, 'Beans & Aroma (Dhanmondi)', NULL, '1625489446', NULL, 'Plot- 753  1st Floor  Satmosjid Road  Dhaka-1205', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2223, 1, 6, 1, 13, 25, 102053852, 'Indian Spicy Chicken (Sahajadpur)', 'Md. Maidul', '1736649833', NULL, 'House#Ga-31/1  Pragati Sarani Road  Sahajadpur  Gulshan  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2224, 1, 6, 1, 13, 25, 102053853, 'Jolly Molly(Mirpur)', 'Ratul', '1726222367', NULL, 'Opposit off Sony Cinema Hall', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2225, 1, 6, 1, 13, 25, 102053854, 'Mr. Leon (Banani)', 'Mr. Leon', '1758855829', NULL, 'Classic Center  Level-3  House No-1  Road-11  Block - F  Banani', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2226, 1, 6, 1, 13, 25, 102053855, 'Burger Attack (Staff Quater)', NULL, '01632-808735', NULL, 'Hazi Hossain Plaza  Staff Quater  Demra  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2227, 1, 6, 1, 13, 25, 102053856, 'Mela Food Bless (Narayanganj)', 'Md. Monir', '1771792514', NULL, '46/2  Abdul Hamid Road  New Chasara Jamtola  Beside Narayanganj Central Eid Gah', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2228, 1, 6, 1, 13, 25, 102053857, 'Chillin Restaurant & Music Cafe(Uttara)', 'Md. Enamul', '1757791718', NULL, 'House-12  Level-3  Sonargaon janapad Road  Sector-11  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2229, 1, 6, 1, 13, 25, 102053858, 'Slieez (Wari)', NULL, '1762096635', NULL, '15/A Rankin Street  Wari  Dhaka-1203', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2230, 1, 6, 1, 13, 25, 102053862, 'M/S Bhai Bhai Store (Hatirpool)', 'Mr. Masud', '1878242649', NULL, '158/1  Opposite of Hatirpool kacha Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2231, 1, 6, 1, 13, 25, 102053864, 'Jihad Store (Hatirpool)', NULL, '1880166983', NULL, '158  Taher Plaza  Hatirpool Bazar  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2232, 1, 6, 1, 13, 25, 102053865, 'Mr. Faruk (Baridhara)', NULL, '01674-608160', NULL, '712 RAWSHAN TOWER HEMLEY 2 BARIDHARA J BLOCK  NAYANAGAR VATARA  IN FRONT UITS UNIVERSITY', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2233, 1, 6, 1, 13, 25, 102053866, 'Food View (Uttara)', 'Mr. Mehedi', '1819530877', NULL, 'House-79  Sector-12  Sha makhdum Avenue  Uttara', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2234, 1, 6, 1, 13, 25, 102053870, 'Khadok\'s Resturant (Munshigonj)', '1647655966', '1647655966', NULL, 'Munshigonj Super Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2235, 1, 6, 1, 13, 25, 102053871, 'Changga (Mirpur)', NULL, '1815121142', NULL, 'City Club Flied  Shop No: 88-89  Block - B  Road - 1  Section - 12  Mirpur - 12  Dhaka - 1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2236, 1, 6, 1, 13, 25, 102053872, 'Coal & Coffe (Uttara)', 'Md. Faruk', '1624062518', NULL, 'Shanargoan Janapath Road  House-60  Sector-9  Road-1', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2237, 1, 6, 1, 13, 25, 102053873, 'Al Hadiu (Tejgaon)', '1740556562', '1740556562', NULL, 'Tejgaon', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2238, 1, 6, 1, 13, 25, 102053874, 'South Indian Chicken (Md.pur)', 'Md. Anisun Rahman', '1734011159', NULL, 'Shia Mosjeed  Tajmohol Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2239, 1, 6, 1, 13, 25, 102053876, 'Mr. Akash Ahamed', 'Mr. Akash', '1742416621', NULL, 'Sonirakhra  Barnamala School & college', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2240, 1, 6, 1, 13, 25, 102053828, 'Pizza Inn(Baily Road)', NULL, '1816344683', NULL, 'Beside KFC Building  Baily Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2241, 1, 6, 1, 13, 25, 102053848, 'Mr. Imran Ahamad (Kishoreganj)', NULL, '1736811153', NULL, 'Kishoregonj Town', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2242, 1, 6, 1, 13, 25, 102053859, 'Tour De Cyclist (Baily Road)', NULL, '1323786097', NULL, 'Vicaroon Nesa School  Gate No 8  Captain Avenue 2nd Floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2243, 1, 6, 1, 13, 25, 102053860, 'Kabab me haddi(Dhn)', 'Biplob', '1821484443', NULL, 'Jigatola tenari more Dhanmondi', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2244, 1, 6, 1, 13, 25, 102053868, 'Civic Foods Ltd (Baridhara DOHS)', NULL, '1674515422', NULL, 'Baridhara DOHS  Road-1  House- 164  Ground Floor', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2245, 1, 6, 1, 13, 25, 102053875, 'Puro foods Ltd  (Tejgaon)', NULL, '1787690938', NULL, '304  T/ A Dhaka. Delivery point   9/ka  kha Tejgaon   beside Tibbot Colony bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2246, 1, 6, 1, 13, 25, 102053877, 'Jol Kuthir Food kitchen (100 feet)', NULL, '1632123386', NULL, 'Chefs Table 100 feet  Natun Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2247, 1, 6, 1, 13, 25, 102053879, 'Bismillah Fast Food & Restaurant (Tongi)', 'Liton Mahmud', '1704112010', NULL, 'Tongi  Hossain Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2248, 1, 6, 1, 13, 25, 102053882, 'Fortis Dinning', 'Mr. Hassan', '1715165037', NULL, 'Fortis Sports Ground  Natun Bazar  Boro Beraid( Behind AKM Rahmatullah University College)', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2249, 1, 6, 1, 13, 25, 102053886, 'Peyala (Gulshan Avenue)', NULL, '1902542345', NULL, '49  Gulshan Avenue Gulshan-02 Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2250, 1, 6, 1, 13, 25, 102053887, 'Classic Foods (Demra Staff Quater)', 'Md. Zakir', '1670019730', NULL, 'Demra Staff Quater', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2251, 1, 6, 1, 13, 25, 102053888, 'Malaysia Chicken (Uttara)', 'Md. Robel', '1727945500', NULL, 'House #1  Road #18  Rabindro Saroni  Sector#7. Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2252, 1, 6, 1, 13, 25, 102053889, 'Shahi Darbar (Mohakhali)', 'Md. Mohosin', '1682601025', NULL, 'SKS Tower Mohakhali  Shop#4', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2253, 1, 6, 1, 13, 25, 102053891, 'Sk Fast Food(Shekher Jayga)', NULL, '1627430612', NULL, 'Beside of Ali Ahmed School Shekher Jayga', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2254, 1, 6, 1, 13, 25, 102053892, 'Hotel Grand Park (Barishal)', NULL, '1713056362', NULL, 'Barishal Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2255, 1, 6, 1, 13, 25, 102053893, 'Cafe Zero 7  Zero 9 (Sonir Akhra)', NULL, '1910900015', NULL, 'Opposite side of Varnamala School & College', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2256, 1, 6, 1, 13, 25, 102053894, 'Queens Confectionaries (Uttara-10)', NULL, '01875351267/01812116139', NULL, 'House-102  Road-12  Sector-10  Uttara', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2257, 1, 6, 1, 13, 25, 102053895, 'TFC (Rajshahi)', NULL, '1746857173', NULL, 'Dhaka office: Square Hospital area  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2258, 1, 6, 1, 13, 25, 102053896, 'Buyer\'s and pizza Restaurant (Ashuila)', NULL, '01705590417/01985830587', NULL, 'NS Tower DPEZ Road  Gonokbari Ashulia Savar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2259, 1, 6, 1, 13, 25, 102053897, 'Mr. Nazmul (Tejgaon)', NULL, '1641829469', NULL, 'Shikajo Cold Storage  Tejgaon', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2260, 1, 6, 1, 13, 25, 102053900, 'Mondol Trading (Kuril)', NULL, '01915-543759', NULL, 'Kuril Chow Rasta  Kuril  Dkaha', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2261, 1, 6, 1, 13, 25, 102053902, 'Spicy Sheak (Mohammadpur)', NULL, '1790111193', NULL, '16/2  Tajmohol Road  Block- C  Mohammadpur  Dhaka-1207', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2262, 1, 6, 1, 13, 25, 102053903, '68 Caffeine (Dhanmondi)', NULL, '1794054374', NULL, 'House-68  Road-7/A  Dhanmondi  DHaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2263, 1, 6, 1, 13, 25, 102053904, 'Al Fresco (Tejgaon)', 'Md. Naim', '1977794600', NULL, 'Santa Tower  Tejgaon', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2264, 1, 6, 1, 13, 25, 102053905, 'Coffee N Cafe (Narshingdi)', NULL, '1612858543', NULL, 'Bhyiuan Super Market  Pourasava mor  Madhabdi  Narshingdi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2265, 1, 6, 1, 13, 25, 102053906, 'Oceania Sea Food & Kabab (Uttara)', NULL, '1841929533', NULL, 'House-18  Road-1  Sector-03  Jashim Uddin  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2266, 1, 6, 1, 13, 25, 102053805, 'Delicious Monsel (Lalmatia)', NULL, '1934181973', NULL, 'Lalmatia', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2267, 1, 6, 1, 13, 25, 102053807, 'Cup of Joe (Mirpur 6)', 'Arafat', '1911915060', NULL, 'Mirpur-6  Beside of Morning Brewed', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2268, 1, 6, 1, 13, 25, 102053808, 'Tuss Garden', NULL, '1711523559', NULL, 'House 539  Road 12  Baytul Aman Housing  Society Muhammadpur  Adabor  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2269, 1, 6, 1, 13, 25, 102053819, 'Eat Stop (Mirpur-1)', 'Md. Faruk', '1716116022', NULL, 'M1  Food Court Mirpur-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2270, 1, 6, 1, 13, 25, 102053822, 'Cheese Land (Shaymoli)', NULL, '1738145370', NULL, 'Behiend Asha tower  Shaymoli  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2271, 1, 6, 1, 13, 25, 102053880, 'Adda Restaurant (Dhanmondi)', NULL, '1682862906', NULL, 'House#8 Road#4  Dhaka-1209', 0.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2272, 1, 6, 1, 13, 25, 102053881, 'Indian Spicy (Savar)', NULL, '1670848914', NULL, 'Nabinogor Sena Shopping Complex 6th Floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2273, 1, 6, 1, 13, 25, 102053890, 'Pizzaology (Jessore)', NULL, '1893826845', NULL, 'Jessore Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2274, 1, 6, 1, 13, 25, 102053899, 'Pasta Club (South Banasree)', NULL, '1810529424', NULL, 'South Banasree  Falguni Check  House-1  Block-K', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2275, 1, 6, 1, 13, 25, 102053908, 'Pan Pizza.com (Mohammadpur)', 'Md. Nasir Uddin', '1739238781', NULL, 'Shahara Market 124/1B Shop No-5  Basilla Main Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2276, 1, 6, 1, 13, 25, 102053909, 'Rosters Peri Peri (Bashundara)', 'Md. Rana', '1714301540', NULL, 'CROWD YARD  Haji Abdul Latif Mansion Holding-KA  9/A Bashundhara R/A', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2277, 1, 6, 1, 13, 25, 102053910, 'Rill Food (Mohakali)', 'Md. Rifat Khan', '1833078497', NULL, 'S.K.S Tower 3rd Floor  Mohakali', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2278, 1, 6, 1, 13, 25, 102053911, 'Food Masala Ent. (Hatirpool)', NULL, '1627931636', NULL, 'Hatirpool Kachabazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2279, 1, 6, 1, 13, 25, 102053912, 'Fiore Rooftop (Mirpur)', NULL, '1401013579', NULL, 'Rooftop  Plot no-76  Road No-2  Block-D  Mirpur-2  East Side of Eid Gah Ground  Dhaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2280, 1, 6, 1, 13, 25, 102053913, 'Mid Night Dhaka (Gulshan 1)', 'Md. Ridoy', '1949882150', NULL, 'House-2  Road-24  Gulshan-1', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2281, 1, 6, 1, 13, 25, 102053915, 'Princh Kitchen (Mirpur-12)', 'Md. Badol', '1717941033', NULL, 'Sultan Mansion 3  Suzat Nagar  Mirpur-12  Pallabi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2282, 1, 6, 1, 13, 25, 102053918, 'Abdul Momin Khan (Mdpur)', NULL, '1755521714', NULL, 'Flat#2B  H#288  Road#02  Adabor  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2283, 1, 6, 1, 13, 25, 102053920, 'Oven Canteen (Paribagh)', 'Raisa', '1731491581', NULL, 'Motaleb Plaza', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2284, 1, 6, 1, 13, 25, 102053922, 'Chicken Buzz (Mirpur-60 Feet)', NULL, '1324531441', NULL, 'Barek Mollar mor  60 feet   mirpur  dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2285, 1, 6, 1, 13, 25, 102053923, 'Kudos (Dhalibari)', 'Junayad', '1771119126', NULL, 'House -442  New Apolo Road  Dhalibari Road  Vatara  Bashundhara R/A Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2286, 1, 6, 1, 13, 25, 102053925, 'D.A Enterprise (Hossain Market)', 'Mr. Delower', '1912475223', NULL, 'Sachib Bari  Moynar bag  Hossain Mrket  Uttar Badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2287, 1, 6, 1, 13, 25, 102053929, 'Mossolla Potty (Mirpur11)', 'Md. Babor', '1824510965', NULL, '11 No. New Society Market  Dhaka 1216', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2288, 1, 6, 1, 13, 25, 102053932, 'Bun\'s N Beans', 'Muktadir Ruhan', '1303043213', NULL, '24 Outer Circuler Road  Moghbazar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2289, 1, 6, 1, 13, 25, 102053933, '..', NULL, NULL, NULL, 'Boro Beraid  Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2290, 1, 6, 1, 13, 25, 102053823, 'Bangladesh Fried Chicken (Kakrail)', 'Johir', '1721676165', NULL, 'Kakrail  Rajmoni Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2291, 1, 6, 1, 13, 25, 102053824, 'CSD (Garrision)', NULL, '1724767233', NULL, 'Beside Officers Club  Mirpur Cantonment', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2292, 1, 6, 1, 13, 25, 102053834, 'One Pin Coffee Limited', NULL, '1913000987', NULL, 'Level-9  Zam zam Tower  Sonargaon  Janapath Road  Sector 13  Uttara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2293, 1, 6, 1, 13, 25, 102053841, 'Wrap N Grab (Shaymoli)', NULL, '1909831347', NULL, 'Road- 2  House - 12/4  Shaymoli', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2294, 1, 6, 1, 13, 25, 102053869, 'Pizza Metro (Mirpur-11)', 'Md. Mamun', '1920756408', NULL, 'Shop-16  Bangla School & College Market  Mirpur-11', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2295, 1, 6, 1, 13, 25, 102053914, 'Italian Grocery (Gulshan)', NULL, '1794373761', NULL, 'Road-84  House-3B  Ground Floor  Gulshan-2', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2296, 1, 6, 1, 13, 25, 102053921, 'Sky Chef Roof Restaurant (Uttara)', NULL, '1760931130', NULL, '60  Garib e Newaz Avenue Sector-13  Utaara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2297, 1, 6, 1, 13, 25, 102053924, 'Take Away (Bashabo)', NULL, '178162189', NULL, 'B/1 Mayakanon  Bashabo  Bodho Mandir', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2298, 1, 6, 1, 13, 25, 102053926, 'Habit Lounge (Mirpur DOHS)', NULL, '1916832507', NULL, 'Mirpur DOHS Shopping Complex  Level-7  Shop - 14 15 16 18', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2299, 1, 6, 1, 13, 25, 102053928, 'Juice Ghor', 'Faruk Sarkar', '1794830568', NULL, 'House No: 39  Dhanmondi: 27  Shwapno Shop.', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2300, 1, 6, 1, 13, 25, 102053930, 'Boitok Restaurant (Banani)', 'Md. Saha Jalal', '1886677972', NULL, 'House-18  Road-4  Block-F  Banani', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2301, 1, 6, 1, 13, 25, 102053935, 'Bake Way (Banasree)', 'Md. Miraj', '1783622509', NULL, 'House-14  Block-H  Main Road South Banasree  Khilgaon  Dhaka-1219', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2302, 1, 6, 1, 13, 25, 102053936, 'Coffee Expresso (Uttara)', NULL, '1600277344', NULL, 'Sector- 3  Road-7  House-36  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2303, 1, 6, 1, 13, 25, 102053938, 'Amita Mini Mart (Jashim Uddin)', 'Mr. Arshad', '1986361761', NULL, 'House-2  Road-13  Sector-1  (Jashim Uddin)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2304, 1, 6, 1, 13, 25, 102053939, 'D Mart Super Shop', NULL, '1683114728', NULL, '186  Arambagh  Motijheel Dhaka-1000', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2305, 1, 6, 1, 13, 25, 102053941, 'Pickon', 'Nurjahan Road  Mohammadpur', '1778665599', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2306, 1, 6, 1, 13, 25, 102053944, 'Lazeez Shawrma (Mirpur 6)', 'Md. Masud', '1747010197', NULL, 'Mirpur 6  Beside Kudos', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2307, 1, 6, 1, 13, 25, 102053945, 'Mr. Arif (uttara)', NULL, '1777423052', NULL, 'Rajlokkhi Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2308, 1, 6, 1, 13, 25, 102053947, 'Jaima Store (Kaptan Bazar)', NULL, '1918208173', NULL, 'Bottola  Kaptan Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2309, 1, 6, 1, 13, 25, 102053950, 'Delivery Hero Stores (Bangladesh) Limited-Gulshan-', NULL, '1799738609', NULL, '23 Gulshan Avenue  Bir Uttam Mir Shawkat Sarak', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2310, 1, 6, 1, 13, 25, 102053951, 'Delivery Hero Stores (Bangladesh) Limited-Dhanmond', NULL, '1912709423', NULL, 'Bay Park Heights  Plot 2  Road no. 9  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2311, 1, 6, 1, 13, 25, 102053952, 'Delivery Hero Stores (Bangladesh) Limited-Uttara', NULL, '1625651399', NULL, '29 Gareeb-e-Nawaz Avenue  Sector- 13  Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2312, 1, 6, 1, 13, 25, 102053953, 'Delivery Hero Stores (Bangladesh) Ltd-Bashundhara', NULL, '1755327708', NULL, 'H- 42/4  Pragati Avenue  Nadda Postal Code', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2313, 1, 6, 1, 13, 25, 102053954, 'Sakib Enterprise (Kathalbagan)', NULL, '1728277138', NULL, 'Kathalbagan', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2314, 1, 6, 1, 13, 25, 102053955, 'Snaxy (Uttara)', 'Md. Fahad Chowdhury Alan', '1811896385', NULL, 'House-16  Walton Plaza  Saha Makhdum Avenue  Sector-13  Uttara-1230', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2315, 1, 6, 1, 13, 25, 102053839, 'Pizza Mastan (Md.Pur)', NULL, '1533838591', NULL, '20/3  Bizly Moholla Opposite of Adabor Thana', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2316, 1, 6, 1, 13, 25, 102053884, 'Best Fried Chicken (BFC)- Mirpur-12', NULL, NULL, NULL, '12/A  6/57  Pallabi  Mirpur  Near Gold wing niharika Mirpur-12 Dhaka  1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2317, 1, 6, 1, 13, 25, 102053948, 'Helvetia (Motijheel 127)', 'Md. Shenu', '1722448877', NULL, 'Motijheel 127', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2318, 1, 6, 1, 13, 25, 102053958, 'Hari Khana (Khilket)', 'Md. Jony', '1630930512', NULL, 'Khilket Tetultola  Opposite Merin Hospital', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2319, 1, 6, 1, 13, 25, 102053959, 'Wellness Cafe (Gulshan-2)', NULL, '1766661315', NULL, 'Labaid Diagonstics  Ground Floor  Gulshan-2', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2320, 1, 6, 1, 13, 25, 102053960, 'Mr. Shahidul Tejgaon)', NULL, '1979988302', NULL, 'Tejgaon  Shikaju Cold Storage', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2321, 1, 6, 1, 13, 25, 102053961, 'Manmo (Gulshan 2)', 'Md. Kabir', '1780363894', NULL, 'House-6  Road-113  Gulshan 2  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2322, 1, 6, 1, 13, 25, 102053963, 'Jackpot Bangladesh (Konapara)', NULL, '16801292057', NULL, '2nd Floor  Haji Mohibulla Palace  Momenbag Chowrasta  Konapara< jatrabari  Dhaka 1236', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2323, 1, 6, 1, 13, 25, 102053966, 'Cookhouse Capsule (Gulshan-1)', NULL, '1724422394', NULL, 'Concord SARK building  1st floor  road-132  house-56/A  Gulshan  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2324, 1, 6, 1, 13, 25, 102053967, 'Bite Club (Tejgaon Warehouse)', 'Suvo Vowmic', '1912548704', NULL, '189/A (1st floor) Habib metal industry lane  Tejgaon industrial area.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2325, 1, 6, 1, 13, 25, 102053968, 'Pizza Station (Baily Road)', NULL, '1322909382', NULL, 'Green Cozy Cottage Shopping Mall  Opposite of Khanas  Baily Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2326, 1, 6, 1, 13, 25, 102053970, 'Kudos (Lalmatia)', NULL, '1712733750', NULL, '1/5  Block-D Lalmatia  Dhanmondi  Dhaka-1207', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2327, 1, 6, 1, 13, 25, 102053973, 'SA International', NULL, '1716371006', NULL, 'Nur Mosjeed  Main Road  Nondipara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2328, 1, 6, 1, 13, 25, 102053974, 'Dcups Dine', NULL, '1677045849', NULL, '42/1 zoo Road  Eidgah Math  Mirpur-1', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2329, 1, 6, 1, 13, 25, 102053975, 'Steakout (Banani)', NULL, '1688642009', NULL, 'House-50  Block-C  Road-11  Pizza Hut & AB Bank Building  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2330, 1, 6, 1, 13, 25, 102053976, 'Foco (Mirpur)', NULL, NULL, NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2331, 1, 6, 1, 13, 25, 102053978, 'Bar code Restaurant Group (Ctg)', NULL, '1974087585', NULL, '222/250  Paschim Sholashahar  CDA Avenue  Muradpur', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2332, 1, 6, 1, 13, 25, 102053979, 'Khanas (Wari)', 'Mr. Dip', '1989839878', NULL, '24/A  Tipu Sultan Road  In front of Wari Thana', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2333, 1, 6, 1, 13, 25, 102053981, 'Food ATM (Bashundhara)', NULL, '1841339933', NULL, 'Bashundhara Get  Mega Food Court', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2334, 1, 6, 1, 13, 25, 102053982, 'EL Turkitoh (Baily Road)', 'Ifran', '1777127955', NULL, '10  Baily Road', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2335, 1, 6, 1, 13, 25, 102053983, 'Burger Rush (Uttara)', NULL, '1648847072', NULL, 'Plot-12  Taj Food Park  Saha Mokhdum Avenue  Sector-13  Uttara', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2336, 1, 6, 1, 13, 25, 102053984, 'Khanas (Uttara)', NULL, '1951234732', NULL, 'Uttara', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2337, 1, 6, 1, 13, 25, 102053985, 'Khanas (Uttara 2)', 'Mr. Sohel Rana', '1718037408', NULL, 'Level-3  House-39  Road-18  Sector-3  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2338, 1, 6, 1, 13, 25, 102053989, 'Khanas (Merul Badda)', NULL, '1671407324', NULL, 'Merul Baada', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2339, 1, 6, 1, 13, 25, 102053991, 'Radission Blu (Ctg)', NULL, '1777701188', NULL, 'Lalkhan Bazar  Chottogram', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2340, 1, 6, 1, 13, 25, 102053992, 'Milano Express (Ctg)', NULL, '1875525511', NULL, 'Mayor Goli  Meyor er Basa  2 no Gate  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2341, 1, 6, 1, 13, 25, 102053995, 'Good Eats (Ctg)', NULL, NULL, NULL, 'SHop#510  Finlay Square  2 No gate  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2342, 1, 6, 1, 13, 25, 102053246, 'The Food (Mohammadpur)', NULL, '1643400490', NULL, 'House-22/15  Khiljee Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2343, 1, 6, 1, 13, 25, 102053247, 'Indian Spicy (300 Feet)', NULL, '1715698285', NULL, 'Mehedi Food Court  300 Feet  Kuril', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2344, 1, 6, 1, 13, 25, 102053234, 'Street Oven (Mirpur 1)', NULL, '1862070436', NULL, 'Mirpur 1 New Market Lift Er #4', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2345, 1, 6, 1, 13, 25, 102053235, 'Moshlar Jogot (Narshingdi)', 'Mr. Shahadat Hossain', '1822158426', NULL, 'Velnagar  Jailkhana More  Narshingdi Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2346, 1, 6, 1, 13, 25, 102053248, 'Kloud Project Limited (Ctg)', 'Momith Hossain', '1534522963', NULL, 'Lake Valley R/A  Nooria Madrasha road-1  House-4  Opposit of USTC  Fayes Lake area  Chittagong', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2347, 1, 6, 1, 13, 25, 102053250, 'Mr. Hannan (Madaripur)', 'Mr. Hannan', '1776542211', NULL, 'Shibchar Bazar  Shibchar  Madaripur', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2348, 1, 6, 1, 13, 25, 102053251, 'Cha Pani (Basabo)', NULL, '1575322822', NULL, '84  Middle Basabo  Navana Tower 1 no gate  Basabo', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2349, 1, 6, 1, 13, 25, 102053252, 'Spicy Dosa king (Bcity)', NULL, '1785814747', NULL, 'Level-8  Block-A  Shop No: 76  Basgundhara City', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2350, 1, 6, 1, 13, 25, 102053253, 'M/S Mazumder Traders (Kochukhet)', 'Mr. Azam', '1303967904', NULL, 'C-45  Rajanigandha Supermarket  Kochukhet', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2351, 1, 6, 1, 13, 25, 102053255, 'Spice Garden (Sylhet)', 'Mr.Zisan', '1762746713', NULL, 'Block-A  Laldighir Par  Notun Market  Sylhet Sadar  Sylhet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2352, 1, 6, 1, 13, 25, 102053254, 'Rome Express (Dhalibari)', 'Md. Masudur Rahman', '1932662818', NULL, 'House- 360  Road-Cocacola  Baridhara J block  Near Dhalibari Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2353, 1, 6, 1, 13, 25, 102053256, 'Adda (Dhanmondi)', 'Nur Islam', '1745679876', NULL, 'House-8  Road-4  Dhanmondi  Dhaka-1209', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2354, 1, 6, 1, 13, 25, 102053257, 'Kabab.com (Banasree)', NULL, '1818902690', NULL, 'House-1  Block-B  Main Road  Banasree  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2355, 1, 6, 1, 13, 25, 102053258, 'Garden Ship (Mohammadpur)', 'Mr. Nahid', '1752166509', NULL, 'Tajmohol road  Block-B  Residensial model college back gate  Mohammadpur  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2356, 1, 6, 1, 13, 25, 102053260, 'Old 90\'s (Bashundhara)', NULL, '1670536067', NULL, 'Bashundhara gate  near Sub Lover\'s', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2357, 1, 6, 1, 13, 25, 102053261, 'Shah Miran General Store (Mohammadpur)', NULL, '1753057466', NULL, 'Near Town Hall Kachabazar  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2358, 1, 6, 1, 13, 25, 102053264, 'Pizza Square (Mohammadpur)', 'Mr. Anis', '1708428250', NULL, 'M-10  Nurjahan Road  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2359, 1, 6, 1, 13, 25, 102053267, 'Eat & Meet (Eastern Plaza)', 'Mr. Sagor', '1677747663', NULL, 'Eastern Plaza Food Court  Hatirpool  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2360, 1, 6, 1, 13, 25, 102053269, 'Sugar & Spicy(300 Fit)', NULL, NULL, NULL, NULL, 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2361, 1, 6, 1, 13, 25, 102053274, 'Burger Maniya (Gulshan-1)', NULL, '1625235175', NULL, '56/A  1st Floor  concord sark building  road-132  beside street oven  Gulshan-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2362, 1, 6, 1, 13, 25, 102053275, 'Lab Aid Hospital (Dhanmondi-4)', 'Mrs Laizu', '1766660163', NULL, 'House- 06  Road-04  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2363, 1, 6, 1, 13, 25, 102053279, 'Liqurorish (Uttara)', NULL, '1405269069', NULL, 'Jwel Tower  Ground floor  House-34  Garib-E Newaz avenue  Sector-11  Uttara', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2364, 1, 6, 1, 13, 25, 102053280, 'Treat Cafe & Restaurant(Mohammadpur)', NULL, '1722844488', NULL, '2/7  Nurjahan Road  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2365, 1, 6, 1, 13, 25, 102053281, 'Mostakim Cheese (Mirpur-1)', 'Mr. Mostakim', '1902291163', NULL, 'Mazar Road  Lalkuthi bazar  Mirpur-1 ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2366, 1, 6, 1, 13, 25, 102053282, 'Fish & Meat Theory (Mirpur DOHS)', NULL, '1732705049', NULL, 'Mirpur DOHS Shopping Center  Level-8  Shop-10', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2367, 1, 6, 1, 13, 25, 102053284, 'Wood Fire(Banasree)', NULL, '1551126397', NULL, 'House-01  Road-01  Block-B  banasree', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2368, 1, 6, 1, 13, 25, 102053285, 'Bikrompur Varieties Store (Mirpur-1)', NULL, '1675193001', NULL, 'College Market  Kachabazar . Mazar Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2369, 1, 6, 1, 13, 25, 102053289, 'Halal Food (Mirpur DOHS)', NULL, '1992679094', NULL, 'Mirpur DOHS Shopping Complex  8th Floor  Shop no-13', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2370, 1, 6, 1, 13, 25, 102053290, 'Burger Factory (Badda)', 'Mr. Rokon', '1847333934', NULL, 'Pran Head office goli  near kludio  Cumilla para  Middle badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2371, 1, 6, 1, 13, 25, 102053296, 'Rasoka Food Corner (Palton)', NULL, '1790707728', NULL, '67/1  Polton China Town (5th Floor) Food Zone  Shop#09  Naya Palton  Dhaka-1000', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2372, 1, 6, 1, 13, 25, 102053883, 'Level - 4 (Banani)', 'Md. Shfiq', '1675204742', NULL, 'House-100  Block-C   Road-11  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2373, 1, 6, 1, 13, 25, 102053885, 'Sun Shine Foods(Goran)', NULL, '1876061267', NULL, 'House-02 Road-14 Block-L Har Vanga More Khilgoan', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2374, 1, 6, 1, 13, 25, 102053898, 'Mr. Shourov (Tejgaon)', NULL, '1880162203', NULL, 'Paramount Cold Storage  Tejgaon', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2375, 1, 6, 1, 13, 25, 102053934, 'Panda Mart (Gulshan)', NULL, NULL, NULL, 'Gulshan-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2376, 1, 6, 1, 13, 25, 102053937, 'K.B Shop & Pharma (Bashundhara)', 'Md. SHiam', '1629400961', NULL, 'Ka-5 Bashundhara Main Gate  Dhaka-1229', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2377, 1, 6, 1, 13, 25, 102053943, 'Dosa Lovers', NULL, '1772155563', NULL, 'SKS Tower Food Court  Mohakhali', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2378, 1, 6, 1, 13, 25, 102053993, 'Like Restaurant', 'Md. Mithun', '1911757203', NULL, 'Near Redison Hotel', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2379, 1, 6, 1, 13, 25, 102053994, 'Eatin Park (South Banasree)', 'Mr. Faruk Ahamed', '1683043812', NULL, 'House-3  Block-G  Main Road  South Banasree  Khilgaon  Dhaka-1219', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2380, 1, 6, 1, 13, 25, 102053996, 'Banani Club (Banani)', NULL, NULL, NULL, 'House-105  Road-1  Block-F  Chairman Bari Road  Banani  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2381, 1, 6, 1, 13, 25, 102053997, 'Terracotta Tales Restaurant (Tejgaon)', NULL, '1680970864', NULL, 'Inside Arong  Tejgaon Link Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2382, 1, 6, 1, 13, 25, 102053999, '6Teen Cafe & Bistro', NULL, '1673185070', NULL, 'Finlay Square (5th Floor)  2 no Gate  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2383, 1, 6, 1, 13, 25, 102054000, 'Meat & Fish Mart (Ctg)', NULL, '1619645060', NULL, 'Sultan Colony  Chowmuhoni  Agrabad  Chittagong', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2384, 1, 6, 1, 13, 25, 102054001, 'Cozy Cafe(Taltola)', NULL, '1812044873', NULL, 'Khilgoan  Taltola', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2385, 1, 6, 1, 13, 25, 102054003, 'Cook Out Restro & cafe (Ctg)', NULL, '1841880701', NULL, 'S.S Khaled Road  Lalkhan bazar  Chottogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2386, 1, 6, 1, 13, 25, 102054004, 'Cafe Crush (Ctg)', NULL, '01869-951543', NULL, 'Finlay Square Food Court. Chottogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2387, 1, 6, 1, 13, 25, 102054006, 'Sub Street (Mirpur-60 feet)', NULL, '1712623113', NULL, 'South pirerbug  Mirpur 60 Feet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2388, 1, 6, 1, 13, 25, 102054007, 'Margarita Restaurant (Uttara)', NULL, '1945002001', NULL, 'Road-2  Sector-3  Paradise Tower  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2389, 1, 6, 1, 13, 25, 102054008, 'Shipm Chandra Bhowmik (Ctg)', NULL, '1630623563', NULL, 'Sadergat  RalibariMor  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2390, 1, 6, 1, 13, 25, 102054009, 'Dumpling (Baily Road)', NULL, '1817546794', NULL, 'Beside baily bites  Baily road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2391, 1, 6, 1, 13, 25, 102054010, 'Burger\'s World (Ctg)', NULL, NULL, NULL, 'Nizam Road  Golpahar More  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2392, 1, 6, 1, 13, 25, 102054014, 'Paragon House (Mohakhali)', NULL, '1713233500', NULL, 'Paragon House  5 Mohakhali C/A', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2393, 1, 6, 1, 13, 25, 102054015, 'Banga Bakers Ltd (Ctg)', NULL, '1770204002', NULL, 'Aturar Depo  Opposite of Amin Jute Mill  Bayezid  Chottogram', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2394, 1, 6, 1, 13, 25, 102054016, 'Sadmohol (Adabor)', NULL, '1963333233', NULL, 'Food guru food court  Adabor Link Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2395, 1, 6, 1, 13, 25, 102054019, 'The Peninsula Chattogram', NULL, '1755554574', NULL, '86/B  CDA Avenue  O.R. Nizam Road  Chattogram', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2396, 1, 6, 1, 13, 25, 102054020, 'De Bhai Bobdhu Formusa  (Mohakhali)', NULL, '1608639642', NULL, 'SKS Tower  Level-2  Mohakhali', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2397, 1, 6, 1, 13, 25, 102054021, 'Juice Ghor (Mirpur-12)', NULL, '1794830568', NULL, 'Shopno Super Shop  Mirpur-12 Bus stand', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2398, 1, 6, 1, 13, 25, 102054022, 'Bengal Meat Processing Ind. Ltd.', NULL, '1769969883', NULL, '110  Love Road  Tejgaon I/A  Dhaka-1208', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2399, 1, 6, 1, 13, 25, 102054023, 'Sakib Enterprise (Banani)', NULL, '1728277138', NULL, 'Shopno Super shop  Banani 11 no road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2400, 1, 6, 1, 13, 25, 102054024, 'GREENLAND SERVICES LTD (HO)', NULL, '1709991007', NULL, 'Cold Storage  91  Nandipara  Trimohoni  Khilgaon  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2401, 1, 6, 1, 13, 25, 102054027, 'Jole Jongol e (Gazipur)', NULL, '1726488700', NULL, 'Bramtuli Bridge  Gazipur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2402, 1, 6, 1, 13, 25, 102054029, 'Zipimart (JFP)', NULL, '1720605467', NULL, 'Jamuna Future park food court  beside blokbuster', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2403, 1, 6, 1, 13, 25, 102054033, 'Bishmillah Cafe (Mohammadpur)', NULL, '1711736474', NULL, '25/7  Tajmohol road  Shop-7 & 8  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2404, 1, 6, 1, 13, 25, 102053901, 'The Food Fest (Aftab Nagar)', NULL, '01939-355697', NULL, 'Mridha Bari Complex Addar More Block-G N/S Road Aftab Nagar Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2405, 1, 6, 1, 13, 25, 102054005, 'Razzak Store (Monipuri Para)', NULL, '1781366206', NULL, 'Monipuri Para  4 no gate  khamarbari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2406, 1, 6, 1, 13, 25, 102054011, 'Jazakallah Restaurant (Mirpur-1)', NULL, '1768553125', NULL, 'Road-7  House-35  Block-D  Mirpur-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2407, 1, 6, 1, 13, 25, 102054025, 'CoCo Cafe (Khilgaon)', NULL, '1779592506', NULL, 'Plot-379/B  1st Floor Ttaltola main road  Khilgaon', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2408, 1, 6, 1, 13, 25, 102054026, 'Jerry Bees (Uttara)', NULL, '1776347665', NULL, 'House 46  Sector-7  Robindra Sarani  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2409, 1, 6, 1, 13, 25, 102054030, 'Restaurant Tabu (Bashundhara)', NULL, '1401287682', NULL, 'Bashundhara  mega food court  Bashundhara gate  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2410, 1, 6, 1, 13, 25, 102054031, 'Fahim Enterprise(Banani)', NULL, '1906600126', NULL, 'Road # 17 Showpno Supper Shop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2411, 1, 6, 1, 13, 25, 102054034, 'Kindered Cafe & Bakery (Niketon)', NULL, '1911735377', NULL, 'House-58  Road-8  block-D  Parvin villa  Niketon', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2412, 1, 6, 1, 13, 25, 102054035, 'Seven Circle (300 feet)', 'Mr. Shohel', '1758387764', NULL, 'Kanchon Bridge  300 feet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2413, 1, 6, 1, 13, 25, 102054037, 'Sky City Hotel (Malibagh)', NULL, '1732733861', NULL, 'Malibagh mor  47 Siddeshwari circular road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2414, 1, 6, 1, 13, 25, 102054038, 'Tranz Ventures Ltd (Galitos)', NULL, '1958554100', NULL, 'Taher Tower (4th Floor) Plot No. 10  Circle-2  Gulshan Commercial Area Dhaka-1212.', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2415, 1, 6, 1, 13, 25, 102054041, 'Subahanallah Enterperise (Ctg)', 'Md. Jamir Uddin', '1879472100', NULL, 'Zaman House  Road No- 1  West Khulshi  Chattogram', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2416, 1, 6, 1, 13, 25, 102054042, 'Taher Trading (JFP)', NULL, '1908283119', NULL, 'Jamuna Future park  Shop No:48/A  Level-1', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2417, 1, 6, 1, 13, 25, 102054043, 'Hot Chilli (Mirpur-10)', NULL, '124092605', NULL, 'Section-10  Block-C  Road-14  House-2  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2418, 1, 6, 1, 13, 25, 102054046, 'Layers of Fries (Bashundhara)', 'Md. Siyam', '1744893839', NULL, 'AIUB University Gate   Bashundhara  Dhaka', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2419, 1, 6, 1, 13, 25, 102054049, 'Crush Food Cafe(Mirpur-10)', NULL, '1918853146', NULL, 'Golchottar Folpotti Raod-01 Deyan Mention Mirpur-10 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2420, 1, 6, 1, 13, 25, 102054050, 'Eat & Fit (Sreenagar)', 'Md. Lingkon', '1701616024', NULL, 'FoodCorner Sreenagar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2421, 1, 6, 1, 13, 25, 102054052, 'Kudos (South Banasree)', NULL, '1768686876', NULL, 'House-77  Road-20  Block-K  South Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2422, 1, 6, 1, 13, 25, 102054054, 'Ice Cube Parlour (Taltola)', NULL, '1864293722', NULL, '1 no gate  Khilgaon Taltola', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2423, 1, 6, 1, 13, 25, 102054056, 'S A Traders (Ctg)', 'Md. Monirul Hasan Sikder (Khokon)', '01819614521  01619614521', NULL, '2106/D  Amena Manjil  Akbarhah Mazar Road  Pahartali  Akbaeshah  Chittagonj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2424, 1, 6, 1, 13, 25, 102054058, 'Kudos Banani', 'Abbas Hawladar', '1864489109', NULL, 'Banani Road No; 11  Soinik Club  Cream and budge Building.', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2425, 1, 6, 1, 13, 25, 102054068, 'Cafen Joy (Khilkhet)', NULL, '1738003764', NULL, 'Near Panir Pump  Khilkhet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2426, 1, 6, 1, 13, 25, 102054069, 'Dillhi Station (Mohammadpur)', NULL, '1711318918', NULL, 'H-R1  Nurjahan Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2427, 1, 6, 1, 13, 25, 102054078, 'Sonargaon Trade Int. (Mdpur)', NULL, '1770507225', NULL, 'Mohammadpur town hall super market  2nd floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2428, 1, 6, 1, 13, 25, 102054086, 'Mr. Liton (Gulshan-2)', NULL, '1733404337', NULL, 'Pink City Gulshan-2  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2429, 1, 6, 1, 13, 25, 102054087, 'NN SHARMA HOUSE (Pallabi)', NULL, '1711172267', NULL, 'HOUSES #12 ROAD#15 BLOCK#C  SECTION 10 MIRPUR', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2430, 1, 6, 1, 13, 25, 102053907, 'Al Fresco (Wari)', 'Md. Hasib', '1972299330', NULL, '29/A  Tipu Sultan Road  Wari  Dhaka-1203', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2431, 1, 6, 1, 13, 25, 102053916, 'Humble & Grand (Uttara)', 'Md. Sayed Hassan Imam Shanto', '1708046481', NULL, 'Capita Shams 10 Lake Drive Road  Uttara -7  Uattar Model Town  Dhaka - 1230', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2432, 1, 6, 1, 13, 25, 102053919, 'Tofayel Store (Newmarket)', 'Md. Tofayel', '1716637380', NULL, 'Shop-67/1  Newmarket', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2433, 1, 6, 1, 13, 25, 102053940, 'Shotata Store (Kawran Bazar)', NULL, NULL, NULL, 'Kawran Bazar 2nd Floor  Kitchen Market', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2434, 1, 6, 1, 13, 25, 102053972, 'Maple Leaf International School Canteen (Dhanmondi', 'Md. Rony', '1629511102', NULL, 'House: 31  Road: 14 A  Near Bangladesh Medical College Hospital', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2435, 1, 6, 1, 13, 25, 102054002, 'Cafe 60 (Ctg)', NULL, '1673185070', NULL, 'Finlay  Square  5th floor  2 no gate ctg', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2436, 1, 6, 1, 13, 25, 102054059, 'Baby Land', NULL, '1715337045', NULL, 'House:31  Road : 8  Sector:3  Uttara  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2437, 1, 6, 1, 13, 25, 102054061, 'Glace (Dhanmondi)', NULL, '1720599394', NULL, 'Orchid plaza  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2438, 1, 6, 1, 13, 25, 102054066, 'Mr. Abrahar (Ctg)', 'Mr. Abrahar', '1713138728', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2439, 1, 6, 1, 13, 25, 102054072, 'Hotdough(Md.Pur)', NULL, '1677409123', NULL, '5/B/19  Solimullah Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2440, 1, 6, 1, 13, 25, 102054077, 'Multi Food Court(Motaleb Plaza)', NULL, '1704572496', NULL, 'ATM Chottor(Ground Floor) Motaleb Plaza Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2441, 1, 6, 1, 13, 25, 102054079, 'Mamun Fast Food(Baridhara)', NULL, '1906600126', NULL, 'Shara Bela Supper Shop  Bashundhara Gate Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2442, 1, 6, 1, 13, 25, 102054081, 'Jhal & Juice(Mirpur)', NULL, '1816699866', NULL, 'Plot # 11/1 Road # 01  Block # Ka Section-06 Mirpur Swimming Complex', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2443, 1, 6, 1, 13, 25, 102054084, 'Mayonnise (Wari)', NULL, '1893795568', NULL, '10A Ranking Street  Wari  beside Bata shop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2444, 1, 6, 1, 13, 25, 102054085, 'Amin Trade International (Ctg)', NULL, '1857766224', NULL, 'Shop No-3/4  Block-B  Karnafully Complex  Sholoshahar  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2445, 1, 6, 1, 13, 25, 102054089, 'SK Corporation(Wari)', NULL, '1933393101', NULL, 'Wari Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2446, 1, 6, 1, 13, 25, 102054094, 'Pat a Pet Cafe(Mirpur-1)', NULL, '1972766646', NULL, 'Mirpur Zoo Road Opposit Of Eid Ghah Math', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2447, 1, 6, 1, 13, 25, 102054095, 'Port Dundee (Narayangonj)', NULL, '18225994269', NULL, '207/5 Bangabadhu Sarak Chashara  Narayangonj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2448, 1, 6, 1, 13, 25, 102054099, 'M/S Haji Store (Ctg)', NULL, '1830488029', NULL, 'Kornofuli COmplex  Sholo Sahar  2 No Gate  Chitagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2449, 1, 6, 1, 13, 25, 102054101, 'Jolshiri (Gulshan)', 'Md.Arif', '1819150453', NULL, 'Central Park Jolshiri Abason', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2450, 1, 6, 1, 13, 25, 102054103, 'Pizzarella (Basabo)', NULL, '1676718371', NULL, '154 Ahmed bagh  Boddho Mondir Road  Basabo', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2451, 1, 6, 1, 13, 25, 102054105, 'Dilli Spicy Dosa (Banasree)', NULL, '1917164917', NULL, 'House-37  Road-7  Block-F  Brindabon Nursery  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2452, 1, 6, 1, 13, 25, 102054106, 'Kindred Cafe & Bakery(Banani)', NULL, '1752120848', NULL, 'Road-06 House-93 Block-C', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2453, 1, 6, 1, 13, 25, 102054107, 'M/S Bepari Business (Taltola)', NULL, '1775598608', NULL, '159-160 Mudi Market Khilgoan', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2454, 1, 6, 1, 13, 25, 102054110, 'Meat Balls(Shimanto Square)', NULL, '1675314632', NULL, 'Shimanto Square Food Court Dhanmondi Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2455, 1, 6, 1, 13, 25, 102054113, 'Lake Terrace(Uttara)', NULL, '1618377223', NULL, 'House-25/E Sector-07 Lake Drive Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2456, 1, 6, 1, 13, 25, 102054115, 'Favorita(Khilgaon)', NULL, '1917582845', NULL, '394/B Shahid Baki Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2457, 1, 6, 1, 13, 25, 102054116, 'Well Park(Ctg)', NULL, '1715443795', NULL, 'Road-01 Plot-02 O.R  Nizam Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2458, 1, 6, 1, 13, 25, 102054118, 'Blue Smoke(Uttara)', 'Md. Shamim', '1671746925', NULL, 'House: 35  SH Tower  4th Floor  Gausul Azam Ave Dhaka:1230', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2459, 1, 6, 1, 13, 25, 102054119, 'Papaz Kitchen(Meradia)', NULL, '1866930054', NULL, 'Merida Market Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2460, 1, 6, 1, 13, 25, 102054122, 'Yiamin Trade International (Ctg)', NULL, NULL, NULL, 'Edress Tower  4th Floor  Amir Market  Khatungonj  Chittagonj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2461, 1, 6, 1, 13, 25, 102053917, 'Abdul Mannan (Newmarket)', 'Abdul Mannan', '1786349990', NULL, 'Block - D  House- 55  Newmarket', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2462, 1, 6, 1, 13, 25, 102053964, 'Jakpot Bangladesh (Staff Quarter)', NULL, '1680192057', NULL, '2nd Floor  Akmol Shopping mall  Staff Quarter  Demra  Dhaka-1360', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2463, 1, 6, 1, 13, 25, 102053987, 'Le Delicia (Khilkhet)', NULL, '1918897961', NULL, 'Plot-94  Purbachal Express Highway  Dumri Khilkhet ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2464, 1, 6, 1, 13, 25, 102054012, 'Delhi Darbar (Ctg)', NULL, '1818347567', NULL, 'Bali Arcade market  Fifth floor  lal chand Rd  Chattogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2465, 1, 6, 1, 13, 25, 102054040, 'Cielo Rooftop(Mirpur12)', NULL, '1841393748', NULL, 'Hazi Kujrat Ali Molla Market(9th floor)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2466, 1, 6, 1, 13, 25, 102054055, 'Kauban(Banasree)', NULL, '1315841132', NULL, 'House # 01 Road # 01 Block # B Banasree Dhaka-1219', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2467, 1, 6, 1, 13, 25, 102054067, 'Chicken Buzz(Md.Pur)', NULL, '1784951299', NULL, 'House X /9 Nurjahan Road(Ground Floor)  Mohammadpur Dhaka-1207', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2468, 1, 6, 1, 13, 25, 102054070, 'Feast & Fiesta (Mdpur)', NULL, '1734510393', NULL, '16/2  Block-C  Tajmohol Road  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2469, 1, 6, 1, 13, 25, 102054076, 'Al Madina Store (Ctg)', NULL, '182,485,563,901,314,000,000', NULL, 'Road No-2  Plot- B-126  Kolpolok Abasik  Baklia  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2470, 1, 6, 1, 13, 25, 102054091, 'Dilli Station(Md.Pur)', NULL, '1993808394', NULL, 'Nurjahan Road Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2471, 1, 6, 1, 13, 25, 102054092, 'Green Lounge(Konapara)', 'Md.Lion', '1916883794', NULL, 'Konapara Demra Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2472, 1, 6, 1, 13, 25, 102054097, 'Fahim Enterprise (Banani-11)', NULL, '1837361957', NULL, 'Shopno Super Shop  Banani 11 No road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2473, 1, 6, 1, 13, 25, 102054124, 'Burger Bounce(Mohakhali)', NULL, '1738185680', NULL, 'SKS Tower  Level-03 Shop-21 Mohakhali Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2474, 1, 6, 1, 13, 25, 102054126, 'Alisha Traders (Gopibag)', NULL, '1632607825', NULL, 'RK Mission Road  Gopibag  Near Manik Nagar Bissho Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2475, 1, 6, 1, 13, 25, 102054127, 'Wind of Change (Ctg)', NULL, '1819824281', NULL, 'Level8 & 9  89/309  Yakub Trade Center  East Nasirabad  (Beside Badsha Mia Petrol Pamp)', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2476, 1, 6, 1, 13, 25, 102054129, 'Great Baritain (Banani)', NULL, '1913910224', NULL, 'House-25 Road-10 Block-E Opposit Banani Central Mosque', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2477, 1, 6, 1, 13, 25, 102054131, 'Sajid Enterprise (Mohammadpur)', NULL, '1704143080', NULL, 'Tokiyo Square  Japan garden City  Mohammadpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2478, 1, 6, 1, 13, 25, 102054134, 'Eaton Restaurant(Banasree)', NULL, '1615606162', NULL, 'House-01 Road-07 Block-H  Banasree Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2479, 1, 6, 1, 13, 25, 102054136, 'Cheez Express (Dhalibari)', NULL, '1608027297', NULL, 'Appolo Gate  Dhali Road  Bashundhara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2480, 1, 6, 1, 13, 25, 102054137, 'Ma Food & Dep[artmental Store (Banani)', NULL, '1305609921', NULL, 'House-25  Road-10  Block-D  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2481, 1, 6, 1, 13, 25, 102054139, 'PizzaBurg Ctg', NULL, '1829769500', NULL, '123  Equity Antara (4th Floor)  Momin Road  Jamalkhan  Chittagong.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2482, 1, 6, 1, 13, 25, 102054140, 'Fork & Kinfe(Uttara)', NULL, '1854308286', NULL, 'House-18 Road-01 Sector-03', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2483, 1, 6, 1, 13, 25, 102054141, 'Masud & Sons(Uttara)', NULL, '1739579202', NULL, 'Jashim Uddin Road Pakar Matha', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2484, 1, 6, 1, 13, 25, 102054142, 'Protein Pan (Bashundhara)', NULL, '1876892931', NULL, 'Bashundhara R/A  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2485, 1, 6, 1, 13, 25, 102054143, 'Bangla Kitchen(Basabo)', NULL, '1712314239', NULL, 'House-108 South Basabo', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2486, 1, 6, 1, 13, 25, 102054146, 'Amin Tredars (Cox\'s bazar)', NULL, '01844-818745', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2487, 1, 6, 1, 13, 25, 102054147, 'Bengal Meat Deli Restaurent (Ctg)', NULL, '01313-444070', NULL, 'Opposite of younesco city center. Gec mo', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2488, 1, 6, 1, 13, 25, 102054148, 'Kudos(ECB)', NULL, '1994743377', NULL, 'ECB Chottor Mega Food Park Meena Bazar Er Upor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2489, 1, 6, 1, 13, 25, 102053927, 'Ever Grow', NULL, NULL, NULL, 'Tejgaon  Dhaka', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2490, 1, 6, 1, 13, 25, 102053931, 'Abdullah AL Faiaz', 'Abdullah AL Faiaz', '1615553993', NULL, 'House-233  Road-3  Mohammadia Housing Society  Mohammadpur  Dhaka-1207', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2491, 1, 6, 1, 13, 25, 102053942, 'Sayed Enterprise (Bottola)', 'Mr. Sayed', '1766694558', NULL, 'Uttara Battola  Jashim Uddin Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2492, 1, 6, 1, 13, 25, 102053957, 'Mr. Suruj (Uttara)', NULL, '1615958795', NULL, 'Abdullahpur  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2493, 1, 6, 1, 13, 25, 102053965, 'Mayur Departmental Storei', NULL, '1731170750', NULL, 'Opposit of Western Grill Dhanmondi Dhaka', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2494, 1, 6, 1, 13, 25, 102053971, 'Pizza. Us (Basabo)', NULL, '1729660155', NULL, '83 Central Basabo (Near Navana Silver Dale)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2495, 1, 6, 1, 13, 25, 102053980, 'Khanas (Baily Road)', NULL, '1635726158', NULL, 'Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2496, 1, 6, 1, 13, 25, 102053986, 'Zephyr (Banani)', NULL, '01716661086  01321197337', NULL, 'Road-12  Catharsis Tower  Block-E  House-133  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2497, 1, 6, 1, 13, 25, 102054018, 'Baishakhio Restaurant (Teknaf)', NULL, '1882190573', NULL, 'Hnila  Teknaf  Coxs Bazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2498, 1, 6, 1, 13, 25, 102054039, 'The Metro(Uttara)', NULL, '1728868810', NULL, 'Road # 03 Sector # 13 Near Yellow Shopping Mall Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2499, 1, 6, 1, 13, 25, 102054083, 'Little Yellow (Taltola)', NULL, '1789795003', NULL, '394/B  Shahid Baki Road  Khilgaon opposite of Pollima Shongshod School', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2500, 1, 6, 1, 13, 25, 102054130, 'Mr Shafiq(Malibag)', NULL, '1714574746', NULL, 'Malibag Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2501, 1, 6, 1, 13, 25, 102054138, 'J R Trade House (Cox\'s Bazar)', NULL, '01885928306  01879472100', NULL, 'Chaindha  Ramu  Cox\'s Bazar', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2502, 1, 6, 1, 13, 25, 102054144, 'Pizza Tizza (Uttara)', NULL, '1717163323', NULL, 'Sector-7  Road-1  Opposite of Mosque & Park  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2503, 1, 6, 1, 13, 25, 102054145, 'Wow (Banasree)', NULL, '1681170136', NULL, 'Dokkhin Banasree Near 10 Tola Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2504, 1, 6, 1, 13, 25, 102054150, 'Tastease Resaturat (Ctg)', NULL, '1826615000', NULL, 'Halishahar branch  Opposite of Khandani restaurant  Block k  8 no. Gate  Chattogram 4000', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2505, 1, 6, 1, 13, 25, 102054151, 'Babuland (Green Road)', NULL, '1325099398', NULL, 'Plot-3A  Level-2  Green Road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2506, 1, 6, 1, 13, 25, 102054152, 'Even Better Cafe (Ctg)', NULL, '01689-900038', NULL, '5th Floor  Finlay Square  513  2 No Gate  Chattogram 4209.', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2507, 1, 6, 1, 13, 25, 102054153, 'Food Gallery (Ctg)', NULL, '01710-447808', NULL, '5th Floor  Finlay Square  2 No Gate  Chattogram 4209.', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2508, 1, 6, 1, 13, 25, 102054154, 'The Chick\'n (Ctg)', 'Biplob Uddin', '01640-754351', NULL, 'Shop no 14/15 Muradpur  Chattogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2509, 1, 6, 1, 13, 25, 102054156, 'Cafe Memoire', NULL, '01885936470/ 025508560', NULL, 'House-55  1st Floor  Shah Magdum Avenue  Sector-12  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2510, 1, 6, 1, 13, 25, 102054158, 'Faiz (Mohammadpur)', 'Mahabuba Rahman', '1552566957', NULL, '233  Housing Society Road=3  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2511, 1, 6, 1, 13, 25, 102054160, 'Hot Beans (Gulshan-2)', 'Md. Lingkon', '1306032034', NULL, 'Anabil Tower  Plot-3  Block-NW(J)  Gulshan North Avenue  Gulshan-2  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2512, 1, 6, 1, 13, 25, 102054161, 'Flaming Wings(Chittagong Road)', NULL, '1824983884', NULL, 'Chittagong Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2513, 1, 6, 1, 13, 25, 102054162, 'Coffee Time(Mirpur-06)', NULL, '1813555949', NULL, 'Plot # 3/4  Block # A  Mirpur-06', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2514, 1, 6, 1, 13, 25, 102054163, 'OWAIS RESTAURANT (Banani)', NULL, '1609356139', NULL, 'BFC Building House-25 Level-1  Road-11  Block-H  Banani  Dhaka-1213', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2515, 1, 6, 1, 13, 25, 102054164, 'Tawaz (Sonirakhra)', NULL, '1742386217', NULL, 'opposite of Baitul Ashekin Masjid. Kacchi bhai building Sonirakhra', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2516, 1, 6, 1, 13, 25, 102054165, 'Pizza Village(Uttara)', NULL, '1580794324', NULL, 'House-31 Road 05 Sector-13', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2517, 1, 6, 1, 13, 25, 102053245, 'Burger Express (Mirpur-10)', NULL, '1601979744', NULL, 'House-1  Lane-4  Block-B  Section-10  Benaroshi Palli  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2518, 1, 6, 1, 13, 25, 102053273, 'Bishmillah Trading (Karwanbazar)', NULL, '1847305299', NULL, 'Kachabar Nich tola  Karwanbazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2519, 1, 6, 1, 13, 25, 102053299, 'Snacks Bar (Polton)', NULL, '1675577745', NULL, '67/1 Polton  China Town 5th Floor  Food Zone  Shop-2  Naya Polton', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2520, 1, 6, 1, 13, 25, 102053304, 'Food Festival', NULL, '1916659787', NULL, '(67/1  Palton China Town  Level-5  Food Zone  Shop-F/6/8  Naya Palton', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2521, 1, 6, 1, 13, 25, 102053327, 'Food Panda Kitchen (Uttara)', NULL, '1915069009', NULL, 'Nabila Paragon Trade center  1st floor  Abdullapur- Ate para road  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2522, 1, 6, 1, 13, 25, 102053336, 'Insta Fresh Farms Ltd. (Banasree)', NULL, '1770166720', NULL, 'House # 21  Road # 3  Block # H Banasree Rampura  Dhaka-1229', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2523, 1, 6, 1, 13, 25, 102053340, 'Shotota Enterprise (Mughda)', 'Al Amin', '1841120340', NULL, 'Mughda wasa road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2524, 1, 6, 1, 13, 25, 102053354, 'Musahid Enterprise (Sunamganj)', NULL, '1716901716', NULL, 'Sunamganj Sadar', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2525, 1, 6, 1, 13, 25, 102053365, 'Roosters Peri Peri (Panthopath)', NULL, '1817080711', NULL, 'Panthopath  57/12  East Raza Bazar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2526, 1, 6, 1, 13, 25, 102053384, 'The Eatalia- Ctg', NULL, '1677170228', NULL, 'GEC Mor  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2527, 1, 6, 1, 13, 25, 102053397, 'Doughbie Restaurant (Uttara)', NULL, '01773374279  01820068696', NULL, 'Sector-14  Pakuria Bazzar  near nurul modina madrasha', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2528, 1, 6, 1, 13, 25, 102053479, 'Queens Bakery (Khilkhet)', NULL, '1826017053', NULL, 'A156 Khilkhet bazar  Dhaka- 1229', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2529, 1, 6, 1, 13, 25, 102053519, 'Bishmillah Foods and chineese (Karwanbazar)', NULL, '1755730562', NULL, 'Sonargaon hotel new lake road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2530, 1, 6, 1, 13, 25, 102053529, 'Bit & Bite', NULL, '1924544440', NULL, '260  Malibagh  behind of Showpno', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2531, 1, 6, 1, 13, 25, 102053533, 'Fries & Co (Mirpur 1)', NULL, '1791330414', NULL, 'Level 3  The Food Company Mirpur  Mirpur New Market  Mirpur 1  1216  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2532, 1, 6, 1, 13, 25, 102053558, 'Sliez (Mohammadpur)', 'Mr. Nim Hasan', '1711431646', NULL, '163/B  Road-3  Mohammadia Housing  Mohammadpur  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2533, 1, 6, 1, 13, 25, 102053589, 'Yousuf & Sons Bakery (Dhanmondi)', NULL, '1711542550', NULL, 'Anam Rangs Plaza  6/A  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2534, 1, 6, 1, 13, 25, 102053606, 'Abdullah\'s Dine (Shimanto Square)', NULL, '1711737501', NULL, '(Shimanto Square Food court  Dhanmondi  Dhaka-1205', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2535, 1, 6, 1, 13, 25, 102053241, 'The Moon Light (Shaymoli Square)', NULL, '1841241785', NULL, 'Shaymoli Square  Level-6  Shop-645', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2536, 1, 6, 1, 13, 25, 102053268, 'Arju Store (Kaptan Bazar)', NULL, '1790060261', NULL, 'Kaptan Bazar  Dhaka', 150000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2537, 1, 6, 1, 13, 25, 102053270, 'Domp Sky (Banasree)', 'Mr. Jubayer', '1712751913', NULL, 'Shawapno Building  B block  Banasree', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2538, 1, 6, 1, 13, 25, 102053283, 'Mad Chef (Baily Road)', NULL, '1926027064', NULL, 'Bangladesh Mohila Somity Building roof top  beside Viqarunnessa School  Baily Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2539, 1, 6, 1, 13, 25, 102053317, 'Faruk Abdullah', NULL, '1842460685', NULL, 'Paramount Cold Storage  Tejgaon', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2540, 1, 6, 1, 13, 25, 102053319, 'Civic Foods BD Ltd. (Dhanmondi)', 'Mr. Polash Sutradhar', '1304862095', NULL, 'H-144  1st Floor  Stamford University building  Satmosjid road  Dhanmondi', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2541, 1, 6, 1, 13, 25, 102053320, 'Cheesy Bite (South Banasree)', 'Mr. Momin', '1842554722', NULL, 'South Banasree  Near 10 tola market', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2542, 1, 6, 1, 13, 25, 102053321, 'Lazeez (Banasree)', NULL, '1962332285', NULL, 'H-19 R-2 B-D  Banasree Rampura Land mark - Beside Bondhor Narsari', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2543, 1, 6, 1, 13, 25, 102053332, 'Shaon Traders (Dhanmondi)', 'Mr. Shaon', '01741153222   01971527429', NULL, '178  Gazi Talukdar villa  Behind Star Kabab  Dhanmondi19 ', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2544, 1, 6, 1, 13, 25, 102053353, 'Zakir Store (Moulovi bazar)', NULL, '1728577610', NULL, 'Moulavibazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2545, 1, 6, 1, 13, 25, 102053356, 'Koyla Restaurant (Tejgaon)', 'Mr. Forhad', '1717650847', NULL, '411  Gulshan-Tejgaon Link road ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2546, 1, 6, 1, 13, 25, 102053359, 'Club Narshingdi (Mirpur-1)', NULL, '1756866797', NULL, 'Mirpur-1  Near Sony Cinema Hall', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2547, 1, 6, 1, 13, 25, 102053366, 'Coal & Coffee (Mohakhali)', 'Mr. Rifat', '1781100300', NULL, 'Mohakhali SKS Tower food court', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2548, 1, 6, 1, 13, 25, 102053368, 'Green Leaf (Lalbag)', NULL, '1407665666', NULL, '32/34/1  Kha  Lalbag road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2549, 1, 6, 1, 13, 25, 102053382, 'Bonafide Restaurant (Shonir Akhra)', NULL, '1923114152', NULL, 'Sharif Tower  Nayapara  Sonia Road  Shonir Akhra', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2550, 1, 6, 1, 13, 25, 102053409, 'Green Chilli (Bashundhara)', NULL, '1714378639', NULL, 'Progoti Avnue 15/5 Bashundhara road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2551, 1, 6, 1, 13, 25, 102053277, 'Pipra Kitchen (Uttara)', 'Mr. Arif', '1712092330', NULL, 'Nothem Front Food Court  House-1  Road-17/A  Sector-12  Uttara', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2552, 1, 6, 1, 13, 25, 102053291, 'Dhaka Regency Hotel & Resort Ltd', NULL, '1713332649', NULL, 'Plot-4 6 31 &33  Airport road  Nikunja-02  Khelkhet  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2553, 1, 6, 1, 13, 25, 102053348, 'Fish N Meat (Banasree)', NULL, '1903000031', NULL, 'Block E  Banasree  Dhaka-1219', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2554, 1, 6, 1, 13, 25, 102053350, 'Pizza King (Lalbag)', NULL, '1913455576', NULL, 'Kellar Gate  Lalbag', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2555, 1, 6, 1, 13, 25, 102053375, 'Bangladesh Distribution (Jurain)', NULL, '1713299422', NULL, 'Jurain  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2556, 1, 6, 1, 13, 25, 102053390, 'Yummy Bite (Aftabnagar)', NULL, '1737865230', NULL, 'Opposite of of Eas West University  Aftab Nagar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2557, 1, 6, 1, 13, 25, 102053391, 'Arabian Nights (Gulshan)', NULL, '1674282412', NULL, 'Road-132  House-56/A  3rd Floor  Concord Sark Building  Gulshan', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2558, 1, 6, 1, 13, 25, 102053428, 'Mr. Ridoy Rahman (Satkhira)', NULL, '1777215123', NULL, 'Satkhira Sadar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2559, 1, 6, 1, 13, 25, 102053431, 'Cafe Famous (Wari)', NULL, '1893826847', NULL, 'Rankin Street Wari  Beside pizzaology', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2560, 1, 6, 1, 13, 25, 102053442, 'Nirob Mart (Mohammadpur)', NULL, '1825995927', NULL, 'Ati bazar mosjid market  Ati bazar  keraniganj  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2561, 1, 6, 1, 13, 25, 102053463, 'Cafe Lazeez (Tejgaon)', NULL, '1799977900', NULL, '216  South Begunbari  tejgaon hatirjheel link road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2562, 1, 6, 1, 13, 25, 102053477, 'Slice & Bites (Panthapath)', NULL, '1783649294', NULL, '152/2/K Panthapath', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2563, 1, 6, 1, 13, 25, 102053481, 'Dipok General Store (Mohammadpur)', NULL, '1714710563', NULL, 'Town Hall Kachabazar  Shop-193-194-195  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2564, 1, 6, 1, 13, 25, 102053534, 'Star Back Pizza (Mirpur 10)', NULL, '1710787438', NULL, 'New Hope Shopping complex  Shop - 18/28 Main road - 1 Senpara Parabata  Mirpur - 10', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2565, 1, 6, 1, 13, 25, 102053541, '1', NULL, '1915705699', NULL, 'Shop No 812  7th floor  Zam Zam Tower  Sector 13  Uttara  DHaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2566, 1, 6, 1, 13, 25, 102053563, 'Bon Cafe (Uttara)', NULL, '1753795440', NULL, '34 Jasim Uddin  Sector-3  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2567, 1, 6, 1, 13, 25, 102053567, 'Cherry Bean Coffee (Gulshan)', NULL, '1766100930', NULL, 'Flat-C3  House  27  Road-39  Dhaka1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2568, 1, 6, 1, 13, 25, 102053580, 'Italian Pizza Hut (Shahjadpur)', NULL, '1766681190', NULL, 'Ga-31 Shahjadpur  Gulshan  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2569, 1, 6, 1, 13, 25, 102053601, 'Stakeout Pizza & Grill (Shiddheswary)', 'Mr. Azad', '1928480552', NULL, '55/1  Shiddesswary Road  Captains Avenue  Ramna  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2570, 1, 6, 1, 13, 25, 102053617, 'Peacock Cafe (Banasree)', NULL, '1735019193', NULL, 'Eastern Ban Bithi Copping complex  10 tola market  South Banasree', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2571, 1, 6, 1, 13, 25, 102053646, 'Dewan Enterprise (Mirpur-1)', NULL, '1977287998', NULL, '46 Hazrat Shah Ali Market  Mirpur-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2572, 1, 6, 1, 13, 25, 102053697, 'AK Azad (Mohammadpur)', NULL, '1722224131', NULL, 'Graphics Art Institute  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2573, 1, 6, 1, 13, 25, 102053710, 'Manual Cafe (Banani)', NULL, '1937630109', NULL, 'House-2  Road-10  Block-E  Banani  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2574, 1, 6, 1, 13, 25, 102053722, 'Mom\'s Burger (Mirpur 60 Feet)', 'Md. Ashikur Rahman', '1734972180', NULL, '750/9 Opposite Monipur Boy School Mipur 60 Feet', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2575, 1, 6, 1, 13, 25, 102053271, 'Chef Taef (Wari)', 'Mr. Saikat', '1321742061', NULL, '14/A  Rankin Street  Wari', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2576, 1, 6, 1, 13, 25, 102053276, 'Pizza Amore (Uttara)', 'Mr. Shahjahan', '1913820760', NULL, 'House-91  Road-18  Sector-14  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2577, 1, 6, 1, 13, 25, 102053298, 'Squeezedup Cafe (Banasree)', 'Mr. Mahfuz', '1811443431', NULL, 'House-36  Road-5  Block-C  Banasree  Dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2578, 1, 6, 1, 13, 25, 102053324, 'Pizza Express (Dhanmondi)', NULL, '1860141885', NULL, 'Kalabagan 1st Lane  House-61  Near Kalabagan Bus Stand', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2579, 1, 6, 1, 13, 25, 102053346, 'Bayezid Store (Siddhirganj)', 'Mr. Bayezid', '1799867505', NULL, 'Ahsan Ullah Super Market  Siddhirganj  Narayanganj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2580, 1, 6, 1, 13, 25, 102053374, 'Food Giant International Ltd. (Way Back Burger)', NULL, '1610656836', NULL, '11-81/A  Road-7  Sector-4  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2581, 1, 6, 1, 13, 25, 102053387, 'Chef Time (Mymenshing)', 'Shariful Islam', '1740557803', NULL, 'Politechnical Mor  Maskanda  Mymenshing', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2582, 1, 6, 1, 13, 25, 102053432, 'Eat Now', NULL, '1731677106', NULL, '10/1 Shantinagar  Nearest Popular Hospital  2nd Floor', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2583, 1, 6, 1, 13, 25, 102053452, 'Red Res (Uttara)', NULL, '1841885885', NULL, 'Road-2  House-2  Sector-4  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2584, 1, 6, 1, 13, 25, 102053472, 'PizzaBurg (Khilgaon)', NULL, '01965-380085', NULL, '551/C Khilgaon  Dhaka-1219', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2585, 1, 6, 1, 13, 25, 102053475, 'PizzaBurg  (Banasree)', NULL, '01873-927710', NULL, 'House No: 23  Iqra Foundation  Road: 05  Block: D Dhaka  1219', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2586, 1, 6, 1, 13, 25, 102053501, 'Jafran Restaurant (Moghbazar)', NULL, '1728798725', NULL, 'Moghbazar railgate', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2587, 1, 6, 1, 13, 25, 102053538, 'Pick N Hurry (Khamarbari)', 'Mr. Saikat', '1919146061', NULL, '28/1 Monipuripara Khejur Bagan Jame Mosjeed Market  Beside monipuripara 2 No. gate', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2588, 1, 6, 1, 13, 25, 102053582, 'Rustic Lounge (Gazipur)', 'Md. Khalid Rahman Shimul', '1676789755', NULL, 'D-196  Jonpukur par  Kazi Nazrul Islam Road  Camporal School Near Gazipur ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2589, 1, 6, 1, 13, 25, 102053659, 'Western Grill (Uttara)', NULL, '1881959933', NULL, 'Sector-11  House- 24  Garib E Newaz Avenue Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2590, 1, 6, 1, 13, 25, 102053666, 'Pizzakoi (Narayanganj)', NULL, '1627295139', NULL, 'Narayangaj Khanpur Hospital Road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2591, 1, 6, 1, 13, 25, 102053681, 'Delux Food Corner (Demra)', NULL, '1408090702', NULL, 'Demra Staff Quarter Haji Hossain Plaza 3rd Floor', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2592, 1, 6, 1, 13, 25, 102053687, 'Eurasia Food Processing (BD) Ltd.', NULL, '1313076464', NULL, 'Gouripur  Ashulia  Savar  Dhaka.', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2593, 1, 6, 1, 13, 25, 102053696, 'The Pizza Hot (Gazipura)', NULL, '1571152546', NULL, 'Safiuddin Accademy Road  Tongi  Gazipura', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2594, 1, 6, 1, 13, 25, 102053725, 'Gulshan Club', NULL, '1675628825', NULL, 'House  Nwj-2/a  Bir Uttam Sultan mahmud Road  Gulshan-2  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2595, 1, 6, 1, 13, 25, 102053746, 'NAVANA FOODS LIMITED (Gulshan-1)                  ', NULL, NULL, NULL, 'PLOT-SW (A)-29  HOUSE-35  GULSHAN SOUTH AVENUE  GULSHAN-01  DHAKA-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2596, 1, 6, 1, 13, 25, 102053760, 'Pizza Mastan (Elephant Road)', NULL, '1533838591', NULL, '347  New Elephant Road  Opposite of Eastern Mollika', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2597, 1, 6, 1, 13, 25, 102053769, 'Cheez (Wari)', NULL, NULL, NULL, 'Tipu Sultan Road  Wari  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2598, 1, 6, 1, 13, 25, 102053780, 'Hazi Mintu Baburchi (Mirpur)', NULL, '1849396666', NULL, 'talpara Ghat  Shah Ali Mazar  Mirpur-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2599, 1, 6, 1, 13, 25, 102053249, 'JBL Enterprise (Narayanganj)', NULL, '1878926229', NULL, 'Fall Patti  Narayanganj', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2600, 1, 6, 1, 13, 25, 102053262, 'Street 30 (Mohammadpur)', NULL, '1716594416', NULL, '30/10  Tajmohol road  behind prince bazzar  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2601, 1, 6, 1, 13, 25, 102053263, 'Bhai Bon Enterprise (Savar)', 'Mr. Mizan', '1872727501', NULL, 'Bank Town  Savar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2602, 1, 6, 1, 13, 25, 102053272, 'Babar Baking & Chainese (Mirpur-11)', NULL, '01720179593  01648877594', NULL, 'Mirpur-11 Kachabazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2603, 1, 6, 1, 13, 25, 102053292, 'Faisal Alam & Co (Narayanganj)', 'Mr. Faisal', '1819296674', NULL, '6 New 11 Old Bongshal Road  Nimtola  Narayanganj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2604, 1, 6, 1, 13, 25, 102053303, 'Paprika (Dhanmondi)', NULL, '1819501806', NULL, 'House No 55  Road No 4A  Saatmasjid Road  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2605, 1, 6, 1, 13, 25, 102053315, 'Food Flix (Uttara)', 'Mr. Yousuf', '1819217838', NULL, 'House-2  road-20/C  Sector-4  Uttara', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2606, 1, 6, 1, 13, 25, 102053338, 'Coffeelious Coffee(Elephant Road)', NULL, '1757920944', NULL, 'Elephant Road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2607, 1, 6, 1, 13, 25, 102053344, 'Mr. Karim (Mirpur-1)', NULL, '1793819637', NULL, 'Section-1  Block-C  Road-4  House-14  Mirpur-1  Dhaka-1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2608, 1, 6, 1, 13, 25, 102053347, 'Mayer Doa Trading (Shanirakhra)', 'Jashimuddin', '161733775', NULL, 'Goal barir mor  Hazi Anwar Mention  Shanirakhra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2609, 1, 6, 1, 13, 25, 102053361, 'Sultan Pizzaria (Mymenshing)', NULL, '1313161490', NULL, 'Notun bazar  boundary road  Mymenshing Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2610, 1, 6, 1, 13, 25, 102053367, 'Mr. Shafin Beg (Fakirapul)', NULL, '1612200553', NULL, 'Fakirapul mor  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2611, 1, 6, 1, 13, 25, 102053369, 'Channel 24 Canteen (Tejgaon)', NULL, '1611578320', NULL, 'Sat rasta  387 South  Tejgaon I/A  Dhaka-1208', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2612, 1, 6, 1, 13, 25, 102053373, 'Sordar General Store (Gulshan-2)', NULL, '1404885060', NULL, 'Shop-90  Gulshan-2 DCC market.', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2613, 1, 6, 1, 13, 25, 102053376, 'Tor Tazza (Gulshan DCC)', NULL, '1950495023', NULL, 'Gulshan-1  DCC Market', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2614, 1, 6, 1, 13, 25, 102053377, 'Per-se Cafe and Restaurant', 'Md. Sharif Hossain', '1620764228', NULL, '446  Nayapara  Donia Road  Sonir Akhra  (Lazz Pharma\'s 3Rd Floor)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2615, 1, 6, 1, 13, 25, 102053400, 'Chayer Shohor (Mirpur)', NULL, '1911198710', NULL, 'House-6/1  Road-16  Block-C  Sector-6  Pallabi  Dhaka-1216', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2616, 1, 6, 1, 13, 25, 102053403, 'Mr. Mahmud (Jhalokathi)', NULL, '1650078468', NULL, 'Jhalokathi Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2617, 1, 6, 1, 13, 25, 102053407, 'Khadok', NULL, '1737615300', NULL, 'Satarkul School Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2618, 1, 6, 1, 13, 25, 102053426, 'Taazaa (Savar)', 'Mr. Jakir Hossain Mamun', '1763110669', NULL, 'Thana Road Savar  beside bata showroom', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2619, 1, 6, 1, 13, 25, 102053436, 'Dhakaiya Koreana(Badda)', NULL, '1813888887', NULL, '92/3  North Badda  Beside Popular Diagnostics Center  Main Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2620, 1, 6, 1, 13, 25, 102053437, 'Friends Adda (Banasree)', NULL, '1936305828', NULL, 'Road-5  Block-C  House-33', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2621, 1, 6, 1, 13, 25, 102053453, 'Mr. Kowshik (Banasree)', NULL, '1722961115', NULL, 'South Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2622, 1, 6, 1, 13, 25, 102053265, 'Fresh & Daily (Badda)', NULL, '1794770125', NULL, 'House-131/2/GA (5th Floor) Badda Middle Badda  Progati Sharani  Dhaka 1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2623, 1, 6, 1, 13, 25, 102053266, 'Kanary Restaurant (Appolo Gate)', 'Mr. Mizanur Rahman', '1819200900', NULL, 'Dhalibari Food Court ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2624, 1, 6, 1, 13, 25, 102053287, 'Juice crafters & Cafe (Mirpur-14)', 'Nazmul Hasan', '1912544937', NULL, '72/1 anandho complex  Kochukhet road  Mirpur-14', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2625, 1, 6, 1, 13, 25, 102053302, 'Hasel Restaurent (Mirpur)', 'Mr. Hasan', '1911032745', NULL, 'B-162  Eastern 2nd Phase  Pallabi  Mirpur', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2626, 1, 6, 1, 13, 25, 102053307, 'Jheel Kutum (Hatirjheel)', 'Mr. Ringku', '1712860008', NULL, '480 Hatirjheel link road  beside gudaraghat', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2627, 1, 6, 1, 13, 25, 102053316, 'The Fenian Restaurant (Feni)', 'Rajesh Mojumder', '01818939538   01819629318', NULL, 'Appayon Afroz Tower  College Road  Feni', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2628, 1, 6, 1, 13, 25, 102053337, 'Eyasmin Variety Store (Mohammadpur)', 'Nure Alam', '1719535946', NULL, 'Townhall Market (Mohammadpur) Beside Main Road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2629, 1, 6, 1, 13, 25, 102053343, 'Arabian Butcher', 'Mr. Humayun Kabir', '1781316689', NULL, '194  Nandipara  Trimohoni  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2630, 1, 6, 1, 13, 25, 102053370, 'Agri Care Ltd (Gulshan)', NULL, '1841835617', NULL, 'Gulshan-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2631, 1, 6, 1, 13, 25, 102053378, 'Western Cafe', 'Md. Saydur Rahman', '1998563132', NULL, '449  Nayapara  Donai Road  Sonir Akhra', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2632, 1, 6, 1, 13, 25, 102053381, 'Hollywood Kitchen (Shonir Akhra)', 'Mr. Apu', '1840010090', NULL, '91  Nayapara  Donia Road  Sonir Akhra', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2633, 1, 6, 1, 13, 25, 102053417, 'Dosai Restaurant (Dhanmondi-27)', NULL, '1706625454', NULL, 'Rags nasim Square  Plot 275/D  8th floor  Road-27  Dhanmondi', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2634, 1, 6, 1, 13, 25, 102053438, 'The garden BBQ (Lalmatia)', NULL, '1710923940', NULL, '1/3 Lalmatia  Block-D  Road 27  Back side of Meena Bazar  Dhanmondi', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2635, 1, 6, 1, 13, 25, 102053443, 'Grand Haveli (Wari)', NULL, '1930906574', NULL, '5/2  Folder Street  wari', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2636, 1, 6, 1, 13, 25, 102053461, 'Little Asia', NULL, '1844682996', NULL, '46  Rupayon ZR Plaza  Shatmosjid Road  Dhanmondi  9/1  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2637, 1, 6, 1, 13, 25, 102053471, 'Just Eat (Green Road)', NULL, '1757505264', NULL, '73/1  Green Road', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2638, 1, 6, 1, 13, 25, 102053473, 'PizzaBurg (Wari)', NULL, '01608-880838', NULL, 'House: 02  Road: 01 Nawab Street  Dhaka1203', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2639, 1, 6, 1, 13, 25, 102053482, 'Oven Cave (Uttara)', NULL, '1989336638', NULL, 'House-115 Road - 18  Sector - 7  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2640, 1, 6, 1, 13, 25, 102053498, 'PizzaBurg (Kalshi)', NULL, '1404461226', NULL, 'Kalshi  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2641, 1, 6, 1, 13, 25, 102053508, 'Cafe Euphoria (Banani)', NULL, '1638888111', NULL, 'House-100  Road-11  House-100  level-5', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2642, 1, 6, 1, 13, 25, 102053528, 'Chhekapora (Uttara)', NULL, '1893034566', NULL, '48  Rabindra Sarani  Sector 7  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2643, 1, 6, 1, 13, 25, 102053559, 'Munchies (Gulshan)', NULL, '01312-280737', NULL, 'Plot-79  Main road  Gulshan Avenue', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2644, 1, 6, 1, 13, 25, 102053572, 'Mint Leaf (Dhalibari)', NULL, '1817045010', NULL, 'Dhalibari road  beside  Khanas', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2645, 1, 6, 1, 13, 25, 102053593, 'Taj Coffe (Mohammadpur)', NULL, '1704831608', NULL, 'Tajmohol Road  Mohammadpur', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2646, 1, 6, 1, 13, 25, 102053607, 'Chamak Restaurant (Bashundhara)', NULL, '1707538273', NULL, 'Member Bari  Ghatpar  bashundhara R/A  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2647, 1, 6, 1, 13, 25, 102053651, 'The palace Luxury Ressort (Habiganj)', NULL, '1988899362', NULL, 'Putijhuri  Bahobal Habiganj', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2648, 1, 6, 1, 13, 25, 102053665, 'Kazi Latif Food Court', NULL, '1736983900', NULL, 'Kazi bari road  near kazi abu taleb model accademy  Gazipura  Tongi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2649, 1, 6, 1, 13, 25, 102053678, 'Seagull Resturant (Polton)', 'Md. Bayazid (Liton)', '1725051576', NULL, 'Plot-116  Naya Palton Gazi Golam Dastagir Road (Box Culvert Road) 12th Floor  Dhaka-1000', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2650, 1, 6, 1, 13, 25, 102053946, 'M/S Abdur Rashid & Brothers', NULL, '1712182521', NULL, 'Green City  Notun Hut  Ruppur  Pabna', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2651, 1, 6, 1, 13, 25, 102053949, 'Delivery Hero Stores (Bangladesh) Ltd-Gulshan-2', NULL, '1744888123', NULL, 'Plot#12A  Block-CWN(A)  North Avenue (Kamal Ataturk Avenue)  Gulshan-2  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2652, 1, 6, 1, 13, 25, 102053962, 'Honey Bee Juice Bar', 'Md. Rasel Mia', '1608290822', NULL, 'Bashundhara Get  Mega Food Court', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2653, 1, 6, 1, 13, 25, 102053988, 'Cafe Seventh Heaven', NULL, '1863368414', NULL, 'Adel Plaza (7th Floor) 1/1 Block-A  Lalmatia  Mirpur Road', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2654, 1, 6, 1, 13, 25, 102053998, 'Cafe Lajawab ( Sylhet Mowlavibazar)', NULL, '1712961411', NULL, 'Rahmania Tower 361  Saifur Rahman Road  Mowlavibazar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2655, 1, 6, 1, 13, 25, 102054013, 'Fancy Fatman (Mirpur DOHS)', NULL, '1309901627', NULL, 'Mirpur DOHS Shopping Complex  Lift-8  Shop-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2656, 1, 6, 1, 13, 25, 102054017, 'Aha Food (Mdpur)', NULL, '1956733196', NULL, 'Food Guru food court  Adabor  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2657, 1, 6, 1, 13, 25, 102054045, 'Rose Pastry Studio (GUlshan-1)', NULL, '1796652170', NULL, 'House-58/B  Road-131  Gulshan-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2658, 1, 6, 1, 13, 25, 102054065, 'Mr. Abdullah (Ctg)', 'Mr. Abdullah', '1761603508', NULL, 'Cornafully Market  2 no Gate Ctg', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2659, 1, 6, 1, 13, 25, 102054100, 'De Bhai Bondhu Formusa (Shaymoli)', NULL, '1608639642', NULL, 'Shaymoli Shopping Mall  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2660, 1, 6, 1, 13, 25, 102054109, 'Nest Bar(Uttara)', 'Sujoy', '1723374796', NULL, '11 No Kacha Bazar Scetor-11 Al Amin Center Level # 7-9', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2661, 1, 6, 1, 13, 25, 102054117, 'Rana Enterprise(Kalabagan)', NULL, '1912798754', NULL, '67/D Kalabagan Near Uttara Bank', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2662, 1, 6, 1, 13, 25, 102054135, 'Maisa Food Corner(Kishorgonj)', 'Abdur Rahman', '01931127218  01642233817', NULL, 'Jaliya Paraa  (Near Golden Oil Pamp)  Chouddashata  Kishoregonj Sadar  Kishoregon', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2663, 1, 6, 1, 13, 25, 102054155, 'Barkot Kitchen (Mirpur)', NULL, '1600004979', NULL, 'Megha Food Court ECB Chattar Shop-15  Mirpur Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2664, 1, 6, 1, 13, 25, 102054157, 'Sherose Cafe & Restaurant (Dhalibari)', NULL, '1819131342', NULL, 'Dhalibari Road  Beside khanas', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2665, 1, 6, 1, 13, 25, 102054168, 'Kudos (Badda)', NULL, '1814535284', NULL, 'Merul Badda  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2666, 1, 6, 1, 13, 25, 102054169, 'Sams Cafe & Restaurant (Ctg)', 'Prosun Raj', '01978598970  01718598973', NULL, '2 No Road  Kolpolok Residential Area  In ftont of Tower  CDA Bakalia  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2667, 1, 6, 1, 13, 25, 102054172, 'Bangladesh Services Limited', NULL, '1712409991', NULL, '1 Minto Road Dhaka  Ramna PS; Dhaka-1000', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2668, 1, 6, 1, 13, 25, 102054173, 'Helvetia (Badda)', NULL, '1711548598', NULL, 'Cumilla para  Middle Badda', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2669, 1, 6, 1, 13, 25, 102054174, 'Chainese Park Restaurant(Basabo)', NULL, '1710704334', NULL, '48 Purbo Basabo beside Belal Masjid', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2670, 1, 6, 1, 13, 25, 102054176, 'Papa Chino s ( Ctg)', NULL, '01887-375968', NULL, 'Shop No. 02  Food Court  Fifth Floor  Bali Arcade  107 Lal Chand Rd  Chattogram 4000', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2671, 1, 6, 1, 13, 25, 102054177, 'Kalam store (Ctg)', NULL, '01815-606765', NULL, 'Riyaj Uddin Bazar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2672, 1, 6, 1, 13, 25, 102054181, 'SAO 26 (Uttara)', NULL, '1841515289', NULL, 'House-61 Road-02 Sector-14 Urttara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2673, 1, 6, 1, 13, 25, 102054182, 'Little Asia (Ctg)', NULL, NULL, NULL, 'Innovative Bhuiyan Orchid (Level 5 1025/Ka  Hill View Housing Society  Chattogram 4203', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2674, 1, 6, 1, 13, 25, 102054183, 'Indian Spice (Ctg)', NULL, '01818347567  01676446887', NULL, '5th Floor  Shop No-10 11 12  Bali Arcade Chawkbazar  Cgattogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2675, 1, 6, 1, 13, 25, 102054185, 'Coal & Coffee(Banani)', NULL, '1919662184', NULL, 'House-46 Road-10 Block-E Level-06 Beside of Hotel Sheraton', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2676, 1, 6, 1, 13, 25, 102054188, 'Me Likey Pizza (Ctg)', NULL, '1860272604', NULL, 'Halisahar Branch  Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2677, 1, 6, 1, 13, 25, 102054189, 'The pahalgam (Ctg)', NULL, '01834-033130', NULL, 'Nochima Bhaban  Port Connecting Rd  HaliSahar  Chattogram 4216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2678, 1, 6, 1, 13, 25, 102053956, 'Food Cottage (Goran)', 'Mr. Rony', '1813364110', NULL, 'Goran Har Vangarmor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2679, 1, 6, 1, 13, 25, 102053969, 'Pizza Station (Mirpur-1)', NULL, '1322909381', NULL, 'Mirpur-1  beside kacchi bhai  Oppsite of Sony Cinema', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2680, 1, 6, 1, 13, 25, 102053977, 'Alfresco (Uttara)', 'Rajib', '1977738900', NULL, 'House-1 Level- 3  Road-19  Sector-11(Opposite of bank alfala)', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2681, 1, 6, 1, 13, 25, 102053990, 'Bell Pepper(Ctg)', NULL, '1975123063', NULL, 'Ground Floor of Zinnurine Complex 63 East Nasirabad Chittagong Gate-02', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2682, 1, 6, 1, 13, 25, 102054028, 'Shadat Traders (Mohammadpur)', NULL, '1689056541', NULL, 'Shop-177  Mohammadpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2683, 1, 6, 1, 13, 25, 102054032, 'Moula Traders(Jamuna)', NULL, '1875029574', NULL, 'Shop No 42 C  Level-01 Jamuna Future Park', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2684, 1, 6, 1, 13, 25, 102054036, 'Brothers pickle (Banasree)', NULL, '1633021123', NULL, 'Shopno Supershop  Banasree B Block', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2685, 1, 6, 1, 13, 25, 102054062, 'Foodies Nest (Mirpur)', NULL, '1780764234', NULL, 'Love road  Mirpur-2  Dhaka', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2686, 1, 6, 1, 13, 25, 102054121, 'Issa Warp(Uttara)', NULL, '1780090028', NULL, 'House-06  Road-22  Sector-14  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2687, 1, 6, 1, 13, 25, 102054170, 'Kawsar Food Corner(Demra)', 'Md.Kader Patwary', '1817615883', NULL, 'Shop 28  Demra Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2688, 1, 6, 1, 13, 25, 102054179, 'Pizzarella (Hazaribagh)', NULL, '1852665509', NULL, '38 Nilambor Sha Road Hazaribagh Park  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2689, 1, 6, 1, 13, 25, 102054184, 'The Cafe Burger(Banasree)', NULL, '1675577745', NULL, 'House-25 Road-05 Block-C Banasree Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2690, 1, 6, 1, 13, 25, 102054186, 'Maj Morsalin (Ctg)', NULL, '01769006277  01769242026', NULL, 'GSO-2(Psy Ops) 24 Infantry Division   Chattagram Cantonment Bayzeed Bostami', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2691, 1, 6, 1, 13, 25, 102054187, 'Pizza Art (Ctg)', NULL, '01975-194488', NULL, '2no gate  opposite of barcode  Sananda R/A  Chattogram 4203', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2692, 1, 6, 1, 13, 25, 102054190, 'The Eatalia Pizza (Ctg)', NULL, '01965-041978', NULL, '787/863 M M  Mohammed Ali Rd  Chattogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2693, 1, 6, 1, 13, 25, 102054191, 'Bites (Baily Road)', NULL, '1307918801', NULL, 'Captain\'s avenue buliding  4 no kitchen  opposit of viqarunnesa school', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2694, 1, 6, 1, 13, 25, 102054192, 'M/S Liton Enterprise (Uttara)', 'Md. Manik Khan', '1611441971', NULL, 'SHop No-60  Kusul Center  Sector-3  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2695, 1, 6, 1, 13, 25, 102054193, 'Burger Express(Bashundhara)', NULL, '1893435309', NULL, 'Plot-492 Kuwait Mosque Road Vatara  Dhaka-1229', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2696, 1, 6, 1, 13, 25, 102054195, 'Shariatpur General Store (Gulshan 2)', NULL, '1552303189', NULL, '80  DNCC Kacha Bazar  Gulshan 2  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2697, 1, 6, 1, 13, 25, 102054197, 'Peyala- (Banani)', NULL, '1648141133', NULL, 'House-25  Ground Floor  Banani-11  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2698, 1, 6, 1, 13, 25, 102054200, 'Tharous Distribution (Ctg)', NULL, NULL, NULL, 'House:22 Road:1 gate:4 Block:L Halishahar housing eastate  Chottogram', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2699, 1, 6, 1, 13, 25, 102054202, 'Hello Fried Chicken (Raza Bazar)', NULL, '1841657076', NULL, 'Raza Bazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2700, 1, 6, 1, 13, 25, 102054203, 'Dessert Cafe(Mirpur)', NULL, '1613001630', NULL, 'Signature Food Court  Princh Bazar Building Lift # 8 Mirpur-12 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2701, 1, 6, 1, 13, 25, 102054205, 'Hunger Killers (Ctg)', NULL, '1812424171', NULL, 'Hakim Plaza  168/169 College Road Chawkbazar  Chattogram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2702, 1, 6, 1, 13, 25, 102054206, 'Babuland(Mirpur-12)', NULL, '1620855976', NULL, 'Ramjannesa Supper Market 4th floor 16/8 Begum Rokeya Shoroni', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2703, 1, 6, 1, 13, 25, 102054207, 'Hungry Wheels(Mirpur-1)', NULL, '01521334008  01831554215', NULL, 'Buddijibi Shohid Minar Darussalam', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2704, 1, 6, 1, 13, 25, 102054209, 'Arrosto Restaurant', NULL, '01847-166370', NULL, '1st Floor 15 O.R Nizam Road  Panchlaish Minar Building Chattogram 4203', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2705, 1, 6, 1, 13, 25, 102054213, 'Love Restaurant', NULL, '01851-601598', NULL, '1st Floor  8RWG+C3 Aziz  M A Stadium Market Rd  Chittagong 4000', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2706, 1, 6, 1, 13, 25, 102053259, 'Cafe Eden (Gulshan-2)', 'Mr. Arif', '1682323853', NULL, 'Plot-1/A  Road-61 $ 56  Gulshan-2', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2707, 1, 6, 1, 13, 25, 102053278, 'Garlic & Ginger (Gulshan-1)', 'Mr. Arif  Manager', '1926090637', NULL, 'Jabbar Tower  Level-10  42 Gulshan Avenue  Gulshan-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2708, 1, 6, 1, 13, 25, 102053306, 'C House Milano (Badda)', 'Mr. Mahtab', '1625375337', NULL, 'Warehouse: Cha 100/2  Hazi Sona Mia Road  Utta Badda Bazar shobji goli', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2709, 1, 6, 1, 13, 25, 102053310, 'Yummy Bites (Polton)', 'Md. Masud Sarker', '1731955173', NULL, '67/1 Polton Chaina Town 5th Floor Food Courd  Shop No. 12 Noya Polton', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2710, 1, 6, 1, 13, 25, 102053311, 'Burger Zone (Panthpath)', NULL, '1609110465', NULL, '44/11 West Panthpath  opposite Of Shomorita Hospital.', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2711, 1, 6, 1, 13, 25, 102053355, 'Mashallah Alam Hot Burger (Polton)', 'Mr. Alam', '1684677831', NULL, 'Zaman Tower  Bijoy Nagar panir tangki  Purana Polton', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2712, 1, 6, 1, 13, 25, 102053362, 'Black Brich Kitchen (Banani)', NULL, '1982112244', NULL, 'House-  2  Block-G  Road-11 Banani   Opposite of Pizza Inn', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2713, 1, 6, 1, 13, 25, 102053372, 'Mrs. Rokeya (Uttara)', NULL, '1921586601', NULL, 'House-30/A  Road-8  Sector-3  Uttara  Near by post office', 10000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2714, 1, 6, 1, 13, 25, 102053434, 'Juice Ghor (Green Road)', NULL, '1794830568', NULL, 'Shopno Super Shop  Green Road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2715, 1, 6, 1, 13, 25, 102053445, 'Mr. Torikul (Banasree)', NULL, '1611526060', NULL, 'Meradia Moddhopara ', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2716, 1, 6, 1, 13, 25, 102053466, 'Mr. Chef (Tongi)', NULL, '1689170646', NULL, 'Ovijan/4  Tongi college gate', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2717, 1, 6, 1, 13, 25, 102053492, 'Hungry Help (Polton)', NULL, '1775995699', NULL, 'China Town  Polton', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2718, 1, 6, 1, 13, 25, 102053518, 'Alauddin traders (Gulshan DCC-1)', NULL, '1713461570', NULL, 'level-4  Gulshan DCC-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2719, 1, 6, 1, 13, 25, 102053522, 'Kettle Cafe (Mohammadpur)', NULL, '1755752104', NULL, '12/9 Soimullah Road  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2720, 1, 6, 4, 13, 25, 102053525, '138 East (Gulshan 2)', NULL, '1786294308', NULL, 'Gulshan 2  Road-91  House 23-26', 100000.00, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 15:53:36'),
(2721, 1, 6, 1, 13, 25, 102053564, 'Tasty Bites (Banasree)', NULL, '1730975029', NULL, 'Arham Rooftop Food court  6th floor  House-14  Block-B  Main Road  Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2722, 1, 6, 1, 13, 25, 102053565, 'Foodies Club', 'Shofiqul Islam', '1841515567', NULL, 'Mirpur-11  Bus stand  Back side of Bank Asia', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2723, 1, 6, 1, 13, 25, 102053581, 'Encan Tos(Mirpur-12)', 'Md. Sanzid', '1717085050', NULL, 'Shop No-111  Level-3  Hazi Kujrot Ali Mollah Supar Market 1 no Harunabad Mirpur- 12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2724, 1, 6, 1, 13, 25, 102053583, 'Pizza Garage (Lalbag)', NULL, '1937015075', NULL, '37 Lalbag Road  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2725, 1, 6, 1, 13, 25, 102053595, 'M/S Sagor Store (Kaptanbazar)', NULL, '1716980347', NULL, '57/18  Kaptan Bazar  Gate-01  Gur Potti  Shop-8 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2726, 1, 6, 1, 13, 25, 102053613, 'Lake view Recreation Club (Gulshan-1)', NULL, '1772159360', NULL, 'Road-130  Gulshan-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2727, 1, 6, 1, 13, 25, 102053622, 'Poopies live kitchen (Khilgaon)', 'Mr. Sajib', '1785240915', NULL, 'Khilgaon Taltola  Near BFC', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2728, 1, 6, 1, 13, 25, 102053645, 'Azgar Ali Hospital Cafe (Gendaria)', NULL, NULL, NULL, 'Gendaria  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2729, 1, 6, 1, 13, 25, 102053675, 'Sliez (Noorjahan Road)', NULL, '1711431646', NULL, '2/3 Noorjahan Road  Mohammadpur', 40000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2730, 1, 6, 1, 13, 25, 102053679, 'Tea Factory', 'Rafi Abdullah', '1687880110', NULL, '275  Sher e Bangla Road  Rayer Bazar  Dhaka-1209', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2731, 1, 6, 1, 13, 25, 102053686, 'Coffee Lime (Khilgaon)', NULL, '01721652498/01731256787', NULL, '227/B  Malibag  Chowdhury Para  Near Matir Mosjid', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2732, 1, 6, 1, 13, 25, 102053693, 'HasanTraders (Narayanganj)', NULL, '1670945188', NULL, 'Fal Potti  Narayanganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2733, 1, 6, 1, 13, 25, 102053714, 'Corn Gallery (Chefs Table)', NULL, '1798882224', NULL, 'Courtside  Chefs Table  100 feet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2734, 1, 6, 1, 13, 25, 102053729, 'Mama Pizza (Taltola)', NULL, '1993868246', NULL, 'Malibag Chowdhury para', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2735, 1, 6, 1, 13, 25, 102053748, 'NAVANA FOODS LIMITED (Dhanmondi)', NULL, NULL, NULL, '67 (NEW) 767 (OLD) GH HEIGTS  SATMASJID ROAD DHANMONDI', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2736, 1, 6, 1, 13, 25, 102054098, 'Best One (Ctg)', NULL, '1859209408', NULL, 'Kornofoli Complex  2 No Gate  Ctg', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2737, 1, 6, 1, 13, 25, 102054112, 'M/S Salman Traders(Karwan Bazar)', NULL, '1645882616', NULL, 'Shop-06  Karwan Bazar Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2738, 1, 6, 1, 13, 25, 102054132, 'Piccolo Restutent & Cafe (Ctg)', NULL, NULL, NULL, 'The Institution of Engineers  Shahid Saifuddin Khaled Rd  Chattogram 4000', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2739, 1, 6, 1, 13, 25, 102054133, 'Green Meal Restaurant (Mirpur12)', NULL, '1709798966', NULL, '11.5 Bus Stand  Beside Setara Conven Hall  Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2740, 1, 6, 1, 13, 25, 102054149, 'Time 4 Shine Cafe & Restaurant', NULL, '1610797349', NULL, 'House-04 Sonargoan Janapath Road Sector-07 Uttara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2741, 1, 6, 1, 13, 25, 102054194, 'Juice Ghor (Mirpur 10)', 'Md. Faruk Sardar', '1794830568', NULL, 'Shwapno Shop  Mirpur 10', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2742, 1, 6, 1, 13, 25, 102054198, 'Adrok Pizza (Ctg)', NULL, '01824-113468', NULL, 'Bali Arcade food court  Chattogram 1429', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2743, 1, 6, 1, 13, 25, 102054208, 'Jack Cafe(Mirpur)', NULL, '1794012807', NULL, 'ECB   Mirpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2744, 1, 6, 1, 13, 25, 102054211, 'Kudos (Shonir akhra)', NULL, '1632489500', NULL, 'Fulkoli-532-535  Hazi Anwar Mansion  Gowalbari mor  Shonir akhra', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2745, 1, 6, 1, 13, 25, 102054212, 'Sky Lounge-rooftop(Mirpur-01)', NULL, '1813140821', NULL, 'Sony Square Mirpur-01 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2746, 1, 6, 1, 13, 25, 102054214, 'Beansy (Bashaundhara)', NULL, '1711175057', NULL, 'Ka-1/A Jagannathpur  Bashundhara Main Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2747, 1, 6, 1, 13, 25, 102054215, 'Cafe Sahin(Mirpur)', NULL, '1730303170', NULL, 'ECB  Mirpur Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2748, 1, 6, 1, 13, 25, 102054216, 'Vitale Restaurant & party Centre (Banasree)', NULL, '1718623111', NULL, 'Banasree Block no.F  Road no.4  House no.1 ', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2749, 1, 6, 1, 13, 25, 102054218, 'Pizza Lounge', NULL, '01602-565629', NULL, '1 S Khulshi Rd  Chattogram 4000', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2750, 1, 6, 1, 13, 25, 102054219, 'Sushi Oki (Bashundhara)', NULL, '1743896189', NULL, 'Plot: 1113  Road: 17  Bashundhara   Dhaka  1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2751, 1, 6, 1, 13, 25, 102054221, 'Juice Ghor(Gulshan-01)', 'Md.Faruk', '1794830568', NULL, 'Shawpno Supper Shop Gulshan-01 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2752, 1, 6, 1, 13, 25, 102054223, 'Kookit Limited (Uttara)', 'Mr. Rahat', '1966093579', NULL, 'House-09  Ave-02  Dia bBari Road  Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2753, 1, 6, 1, 13, 25, 102054224, 'Pizza Captain (Mohakhali)', NULL, '1811601883', NULL, 'West Nakhalpara  near rail gate  Mohakhali', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2754, 1, 6, 1, 13, 25, 102054227, 'Hotel Noorjahan (Sylhet)', NULL, '1675097753', NULL, 'Waves 1 Dargah Gate  Sylhet Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2755, 1, 6, 1, 13, 25, 102054228, 'PMGF Ltd (Kalachadpur)', NULL, '1729066402', NULL, 'Malancha Bhaban   Ka-1/1  Kalachadpur Main Road (North Baridhara) Gulshan 2  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2756, 1, 6, 1, 13, 25, 102054229, 'Tasty & Health Food(Lalbag)', NULL, '01621864021  01610314856', NULL, 'Lalbag Meena Bazar Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2757, 1, 6, 1, 13, 25, 102054230, 'Juice Ghor(Uttara)', NULL, '1794830568', NULL, 'Shawpno Supper Shoap  Uttara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2758, 1, 6, 1, 13, 25, 102054231, 'Kings Dinner(Uttara)', NULL, '1874821066', NULL, 'Jam Jam Tower', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2759, 1, 6, 1, 13, 25, 102054232, 'Global Asset Ltd-Hotel Grand Sylhet', NULL, '1321201582', NULL, 'Boroshala  Airport road  P.S: Sylhet-3101', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2760, 1, 6, 1, 13, 25, 102054233, 'Umami Restaurant(Khilgoan)', NULL, '1851881001', NULL, '960/B Khilgoan Near Bhooter Adda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2761, 1, 6, 1, 13, 25, 102054234, 'Sandra(Banasree)', NULL, '1714134512', NULL, 'Farazi Hospital Road Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2762, 1, 6, 1, 13, 25, 102054237, 'Paragon Mart(Wari)', NULL, '1610207728', NULL, 'Larmini Street 19/1B  Wari Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2763, 1, 6, 1, 13, 25, 102054238, 'Upper Crust Maatra Ltd. (Gulshan-2)', NULL, '1817759048', NULL, 'H-6 R-102 Gulshan2.  Dhaka-1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2764, 1, 6, 1, 13, 25, 102054239, 'Bangladesh Daring Momo(Mirpur)', NULL, '1641677411', NULL, 'Signature Food Court Lift-8  Mansion Begum Sarani Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2765, 1, 6, 1, 13, 25, 102054241, 'Mim Store(Uttara)', NULL, '1716576572', NULL, 'Habib Market  Sector-5 Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2766, 1, 6, 1, 13, 25, 102054159, 'MRG Happy Mug (Baridhara)', NULL, '1711944481', NULL, 'Ghatpar End of North South University Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2767, 1, 6, 1, 13, 25, 102054178, 'Master Chef BBQ', NULL, '1712729716', NULL, 'BAFWA Shopping Complex Mohakhali  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2768, 1, 6, 1, 13, 25, 102054196, 'Peyala (Karwan Bazar)', '1977741272', '1977741272', NULL, '10 Jahangir Tower  Karwan Bazar  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2769, 1, 6, 1, 13, 25, 102054222, 'Zero Salad Bar(Baily Road)', NULL, '1755713582', NULL, '55/1 Siddeswari Road Opposit of Viqarunnisa School Gate-08 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2770, 1, 6, 1, 13, 25, 102054226, 'The Aviary Restaurant(Uttara)', NULL, '1775710182', NULL, '17 Pohor Danga lift-04 Sonargaon Janapath Road Sector-13 Uttara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2771, 1, 6, 1, 13, 25, 102054235, 'Tokyo Kitchen(Banani)', NULL, '1404009003', NULL, 'House-52 Road-18 Block-J  Banani Dhaka-1213', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2772, 1, 6, 1, 13, 25, 102054236, 'Helvetia(Tejgoan)', NULL, '1322401182', NULL, 'The Grage Food Court  Near Shanta Tower Tejgoan', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2773, 1, 6, 1, 13, 25, 102054242, 'Bhalogari Cafe (Mohakali)', NULL, '1568177509', NULL, 'Shop No-72  Ground Floor  SKS Tower  Mohakali  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2774, 1, 6, 1, 13, 25, 102054243, 'Red Beans Cafe (Uttara)', NULL, '1885594782', NULL, 'House No - 69  Sector - 12  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2775, 1, 6, 1, 13, 25, 102054244, 'Munna Traders', NULL, '1821011303', NULL, 'Kajer dewri  2 no goli Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2776, 1, 6, 1, 13, 25, 102054245, 'Sinha Traders (Rup Pur)', NULL, '1719346219', NULL, 'Notun Hat  Green City  Rup pur Russian city', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2777, 1, 6, 1, 13, 25, 102054248, 'Cielo Rooftop(Gulshan)', NULL, '1776141877', NULL, 'AWR Tower Plot-35 Gulshan South Avenue', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2778, 1, 6, 1, 13, 25, 102054249, 'Masha Allah Food(Shimanto Square', NULL, '1518367121', NULL, 'Shimanto Square Ground Floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2779, 1, 6, 1, 13, 25, 102054250, 'Fahim Enterprise(Mirpur-10)', NULL, '1676796220', NULL, 'Showpno Supper Shop Mirpur-10 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2780, 1, 6, 1, 13, 25, 102054251, 'Tharous Distribution (Ctg)', NULL, '01748-820131', NULL, 'Halishahar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2781, 1, 6, 1, 13, 25, 102054252, 'Red Rough(Mirpur-2)', NULL, '1757427247', NULL, 'Plot-02 Block-A Mirpur-02', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2782, 1, 6, 1, 13, 25, 102054254, 'Unique Rgency Hotel (Banani)', NULL, '1318526016', NULL, 'Block-C  House-59  Road-17  Banani', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2783, 1, 6, 1, 13, 25, 102054255, 'Kichuri Bari (Uttara)', NULL, '1974010000', NULL, 'House 2  Road - 12  Sector - 6  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2784, 1, 6, 1, 13, 25, 102054256, 'Meat Church (Banani)', 'Mr. Tony Gomes', '01825-070652', NULL, 'Level - 5  House-32  Block - G  Road - 11  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2785, 1, 6, 1, 13, 25, 102054260, 'Onesta Food Bazra(Banani)', NULL, '1749766019', NULL, 'House-58 Road-11', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2786, 1, 6, 1, 13, 25, 102054261, 'Walking Street Chefmate(Dhanmondi)', NULL, '1600370356', NULL, 'Rangs fortune Square  Level-11 Dhanmondi-02  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2787, 1, 6, 1, 13, 25, 102054262, 'Nowakhali Store(Uttara)', NULL, '1771817946', NULL, 'Azampur Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2788, 1, 6, 1, 13, 25, 102054263, 'Babuland (Mirpur)', NULL, '1320387232', NULL, '963 964 East Shewrapara Rokeya Soroni  Miprur  Dhaka -1216', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2789, 1, 6, 1, 13, 25, 102054264, 'Khatir (Uttara -13)', NULL, '01914104433/01720536655', NULL, 'Houe 47 (A-1)  Road 13  Sector-13  Dhaka -1230', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2790, 1, 6, 1, 13, 25, 102054265, 'Munna Masala (Mirpur-11)', NULL, '1720179593', NULL, 'Mirpur-11 kachababazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2791, 1, 6, 1, 13, 25, 102054269, 'Street Oven(Keranigonj)', NULL, '1313717262', NULL, 'Shop-02  Level-07 Keranigonj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2792, 1, 6, 1, 13, 25, 102054270, 'Sinha Traders (Iswardi)', NULL, '1719346219', NULL, 'Notun Hut  Green City  Rup pur  Iswardi  Pabna', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2793, 1, 6, 1, 13, 25, 102054271, 'VR Chittagong Restaurant', NULL, '1822156772', NULL, 'Shop#438  3rd Floor  Khulshi Town Centre  426 Zakir Hossain Rd  Chattogram 4202', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2794, 1, 6, 1, 13, 25, 102054166, 'Spicy Station(Mirpur)', NULL, '1728987472', NULL, 'House-09 Road-05 Block-A Section-10 Mirpur Banaroshi Palli', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2795, 1, 6, 1, 13, 25, 102054201, 'Babuland(Dhan)', NULL, '1521207237', NULL, 'Shimanto Shamvar Level-06', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2796, 1, 6, 1, 13, 25, 102054210, 'Peyala kitchen (Gulshan)', NULL, '1946533653', NULL, '17 peninsular shipping service  Gulshan-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2797, 1, 6, 1, 13, 25, 102054217, 'Mohona Kitchen(Uttara)', NULL, '1717608010', NULL, 'Sector-14  Uttara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2798, 1, 6, 1, 13, 25, 102054220, 'Tasty & Healthy Foods(Kallanpur)', 'Md.Adnan', '1621864021', NULL, 'Road No # 10  Kallanpur Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2799, 1, 6, 1, 13, 25, 102054225, 'Cafe 73 (Nandipara)', NULL, '1720575454', NULL, 'American Plaza  Nandipara main road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2800, 1, 6, 1, 13, 25, 102054246, 'Southeast Bank Ltd (Ctg)', NULL, NULL, NULL, 'Chittagong', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2801, 1, 6, 1, 13, 25, 102054253, 'Faruk Enterprise(Basabo)', NULL, '1685106823', NULL, 'Basabo  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2802, 1, 6, 1, 13, 25, 102054258, 'Falcon Trade International', NULL, '01817-710707', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2803, 1, 6, 1, 13, 25, 102054266, 'Fahim Enterprise (Mohakhali)', NULL, '1676796220', NULL, 'Shopno Super Shop  Wireless Gate  Mohakhali', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2804, 1, 6, 1, 13, 25, 102054268, 'Al Waqia Street Oven(Demra)', NULL, '1762037062', NULL, 'Haji Nogor  Demra', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2805, 1, 6, 1, 13, 25, 102054272, 'Jubilant Foodworks BD Ltd.', 'Mr. Mahtab', '1713350380', NULL, 'Paragon House  Level-4  5  Mohakhali C/A  Dhaka-1212', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2806, 1, 6, 1, 13, 25, 102054273, 'Ena Trading (Adabor)', NULL, '1922432314', NULL, '36/ A Uttar Adabor  Road-01', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2807, 1, 6, 1, 13, 25, 102054274, 'M Cafe (Mirpur DOHS)', 'Md. Arif', '1636310391', NULL, 'Mirpur DOHS Shopping Complex  Mirpur  Dhaaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2808, 1, 6, 1, 13, 25, 102054277, 'Faruque Enterprise (ctg)', NULL, '01943-449075', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2809, 1, 6, 1, 13, 25, 102054278, 'Cafe Gusto (Mirpur-12)', NULL, '1612240172', NULL, 'Signature Food Court  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2810, 1, 6, 1, 13, 25, 102054279, 'Cash Sales by Fahmida', NULL, '1618003702', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2811, 1, 6, 1, 13, 25, 102054280, 'Cash Sales by Muna', NULL, '1618003703', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2812, 1, 6, 1, 13, 25, 102054281, 'Cash Sales by Anika', NULL, '1618003705', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2813, 1, 6, 1, 13, 25, 102054282, 'Cash Sales by Jannat', NULL, '1618003745', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2814, 1, 6, 1, 13, 25, 102054283, 'Pizza Mom (Cumilla)', NULL, '1672881522', NULL, 'Kandirpar Cumilla', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2815, 1, 6, 1, 13, 25, 102054284, 'Central Kitchen(Mirpur-12)', NULL, '1725508033', NULL, 'Plot # 1421 & 1422 Road # 8/2  Block # F  Shagupta Housing  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2816, 1, 6, 1, 13, 25, 102054286, 'Otithi Restaurent (Rajshahi)', NULL, '1796158629', NULL, 'Rajshahi Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2817, 1, 6, 1, 13, 25, 102054287, 'Lavender Food & Bakery(Badda)', NULL, '1717855069', NULL, 'AJ Height 2nd floor Uttar Badda Opposite Hossain Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2818, 1, 6, 1, 13, 25, 102054288, 'TFC (Mymenshing)', NULL, '1853381578', NULL, 'Mymenshing Sadar', 999999.99, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2819, 1, 6, 1, 13, 25, 102054289, 'Mahin Enterprise (Mymenshing)', NULL, '1673445888', NULL, 'Mymenshing Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2820, 1, 6, 1, 13, 25, 102054290, 'Delivery Hero Stores (BD) Ltd-Mirpur 01', NULL, NULL, NULL, '114 Senpara Parbata  Begum Rokeya Sarani Road  Mirpur 10', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2821, 1, 6, 1, 13, 25, 102054292, 'Delivery Hero Stores (BD) Ltd-Wari', NULL, NULL, NULL, 'Sardar Bhaban  40/1 Lal mohon Saha Street  Dholikhal  Dhaka 1100', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2822, 1, 6, 1, 13, 25, 102054295, 'Delivery Hero Stores (BD) Ltd- Rampura', NULL, NULL, NULL, 'M.G tower  389/B DIT Rd  Rampura Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2823, 1, 6, 1, 13, 25, 102054299, 'Foodiemoodie.bd(Uttara)', 'Badsha', '1843494678', NULL, '5 No Habib Market  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2824, 1, 6, 1, 13, 25, 102054300, 'Falafel (Ctg)', NULL, '01863-593156', NULL, '47/A  Chattessari road  chawkbazar  Chattagram.(besides Chattagram laboratory School)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2825, 1, 6, 1, 13, 25, 102054302, 'Daily Bazar(Mirpur-11)', NULL, '1779877683', NULL, 'Sambsdik Plot  Gate-2  Road-12 Mirpur-11  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2826, 1, 6, 1, 13, 25, 102054303, 'Shawarma House (Sylhet)', NULL, '1716468334', NULL, 'Sylhet Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2827, 1, 6, 1, 13, 25, 102054304, 'Uttara General Store(Uttara)', 'Md. Abdul Alim', '1615769994', NULL, 'House # 25  Road # 10  Sector # 04 Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2828, 1, 6, 1, 13, 25, 102054305, 'Brothers Pickle (Subhanbag)', NULL, '1633021123', NULL, 'Subhanbag Shopno Super shop  Outlet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2829, 1, 6, 1, 13, 25, 102054167, 'Jackpot (Shonir Akhra)', NULL, '1680192057', NULL, '446 Noyapara  Donia  Bornomala School Road  Shonir Akhra  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2830, 1, 6, 1, 13, 25, 102054180, 'Golden Chick(Taltola)', 'Robiul Hasan', '1633066192', NULL, 'Khilgaon Taltola Beside Vooter Adda', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2831, 1, 6, 1, 13, 25, 102054204, 'STATE OFF FOOD', NULL, '01612-325269', NULL, 'APPOIN Afroz Tower  FENI', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2832, 1, 6, 1, 13, 25, 102054240, 'Fifty Ave Restaurant (Savar)', NULL, '1775369494', NULL, 'Thana Road  Savar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2833, 1, 6, 1, 13, 25, 102054285, 'Food Forest (Feni)', NULL, '1812145275', NULL, 'Feni Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2834, 1, 6, 1, 13, 25, 102054291, 'Delivery Hero Stores (BD) Ltd-Mirpur 02', NULL, NULL, NULL, 'Safura Trade City  Pallabi  Mirpur 12  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2835, 1, 6, 1, 13, 25, 102054293, 'Delivery Hero Stores (BD) Ltd-Mohammadpur', NULL, NULL, NULL, 'H. I. KHAN TRADE CENTER at Plot # Z/23  Z/24  Block # D Tajmohal Road  Mohammadpur  Dhaka-1207', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2836, 1, 6, 1, 13, 25, 102054296, 'Delivery Hero Stores (BD) Ltd-Mogbazar', NULL, NULL, NULL, '227(New)  331 (Old) Outer Circular Road  Boro Moghbazar Dhaka-1217', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2837, 1, 6, 1, 13, 25, 102054306, 'Rizik Food(Mirpur)', 'Anis Shams', '1610001485', NULL, 'Ansar Camp Middle Pike Para  Near Bihari Mosque  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2838, 1, 6, 1, 13, 25, 102054307, 'AM Enterprise (Rangpur)', NULL, '1913850692', NULL, 'Rangpur sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2839, 1, 6, 1, 13, 25, 102054308, 'Cupstory (Sylhet)', NULL, '1717279379', NULL, 'Manik pir road  Noyashorok point sylhet', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2840, 1, 6, 1, 13, 25, 102054309, 'Kudos(Laxmibazar)', NULL, '1684941767', NULL, '19/A Subash Bose Avenue  Opposite of Ahmed Burger Laxmibazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2841, 1, 6, 1, 13, 25, 102054310, 'Mahira Store(Rangpur)', NULL, '1643876550', NULL, 'Rangpur Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2842, 1, 6, 1, 13, 25, 102054311, 'Pizza Station(Dhan)', 'Apon', '1919401097', NULL, 'Dhanmondi 11 A  Beside of Kacchi Bhai', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2843, 1, 6, 1, 13, 25, 102054314, 'G food ctg', NULL, '1844668712', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2844, 1, 6, 1, 13, 25, 102054315, 'Arina Food Chain(Santibag)', 'Rayan', '1671407324', NULL, 'AC Mosjid Goli Rabbi Saheber bari  Shantibag  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2845, 1, 6, 1, 13, 25, 102054317, 'M/S Dulon Traders(Uttara)', NULL, '1798131747', NULL, 'House # 26  Road # 10  Sector # 12  Uttara  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2846, 1, 6, 1, 13, 25, 102054318, 'Cafe Bar (Gulshan1)', NULL, '1772159360', NULL, 'Road-3  House-9/A/1  Opposite of KFC  Gulshan-1 ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2847, 1, 6, 1, 13, 25, 102054319, 'Kazi Zihad(Barishal)', NULL, '1993387304', NULL, 'Barishal Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2848, 1, 6, 1, 13, 25, 102054320, 'Spicy Land Cafe(Aftab Nagar)', NULL, '1976895838', NULL, 'Aftab Nagar Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2849, 1, 6, 1, 13, 25, 102054323, 'Food \"O\" Clock(Kishorganj)', NULL, '1620668024', NULL, 'Kishorgonj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2850, 1, 6, 1, 13, 25, 102054324, 'Cafe King(Green Road)', NULL, '1785789999', NULL, 'RH Home Center 1st floor Room 138  Greenroad  Farmgate Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2851, 1, 6, 1, 13, 25, 102054329, 'Fresh Pick Fast Food & Restaurant(Polton)', NULL, '1778425841', NULL, 'China Town  Level-5  Polton Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2852, 1, 6, 1, 13, 25, 102054330, 'Mr Burger (Banasree)', NULL, '1826660055', NULL, 'House -1  Road-04  Block-D  Banasree  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2853, 1, 6, 1, 13, 25, 102054332, 'Fuoco(Mirpur-01)', NULL, '1933492795', NULL, 'Mirpur Zoo Road  Mosjidul Akbar Eidgah Field', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2854, 1, 6, 1, 13, 25, 102054333, 'Habibi(Banani)', NULL, '1959367057', NULL, 'Block # K  Road # 24  House # 07 Banani Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2855, 1, 6, 1, 13, 25, 102054334, 'Manzo Restaurant(Gulshan)', NULL, '1329668884', NULL, '114  Gulshan Avenue Casablanca  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2856, 1, 6, 1, 13, 25, 102054337, 'Vaggokul Store(Mirpur)', 'Md.Mohon', '1919593026', NULL, '11 No Society New Market  Masala Patti Mirpur-11 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2857, 1, 6, 1, 13, 25, 102054338, 'Cheese Bar(Sonirakhra)', 'Md.Toha', '1989206612', NULL, 'Shonirakhra Bornomala School Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2858, 1, 6, 1, 13, 25, 102054340, 'Beans & Aroma(Bashundhara)', NULL, '1791262898', NULL, 'Rahman AJ Trade Center Lift-05  Opposite of Jamuna Future Park', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2859, 1, 6, 1, 13, 25, 102054171, 'Dipsy Dos(Mogbazar)', 'Sayan', '1717200123', NULL, '34 Dilu road Mogbazar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2860, 1, 6, 1, 13, 25, 102054175, 'Md Mofijur Rahman', NULL, NULL, NULL, 'Revenue Officer  Rajarbag Circle  (2nd floor)  Josna Complex  24 topkhana road  Dhaka-1000', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2861, 1, 6, 1, 13, 25, 102054199, 'Complementary', NULL, NULL, NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2862, 1, 6, 1, 13, 25, 102054247, 'Atik Enterprise(K.B)', NULL, '018/41581768', NULL, 'Karwan Bazar Dhaka  Shop-212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2863, 1, 6, 1, 13, 25, 102054257, 'Mohammad Moin Uddin', 'Mohammad Moin Uddin', '1723999991', NULL, 'House 107 Mosjid Road Banani DOHS', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2864, 1, 6, 1, 13, 25, 102054276, 'Nuage Kitchen (Kalabagan)', 'Md. Shahariar', '1627284789', NULL, '34  Lake circus Kalabagan', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2865, 1, 6, 1, 13, 25, 102054321, 'Rooster Peri Peri(Dhan)', NULL, '1614301540', NULL, '67 GH Height 3rd floor  Satmosjid road  Dhanmondi Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2866, 1, 6, 1, 13, 25, 102054328, 'Arax(Dhanmondi)', NULL, '1677892581', NULL, 'House no 37(9th floor) Khan ABC Tradplex  Road 02 Dhanmondi Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2867, 1, 6, 1, 13, 25, 102054331, 'Smart Kitchen(Mirpur)', 'Rajib Hossain', '1867696441', NULL, 'Jahir Smart Tower Begum Rokeya Sarani Taltola Mirpur Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2868, 1, 6, 1, 13, 25, 102054335, 'Premium Chicken(Uttara)', NULL, '1782090866', NULL, 'House # 04  Road # 03  Sector # 07 Uttara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2869, 1, 6, 1, 13, 25, 102054336, 'Candy Crush(Jamuna)', 'Md.Farhad', '1677438689', NULL, 'Jamuna Future Park', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2870, 1, 6, 1, 13, 25, 102054339, 'Take Out (Ctg Hali Sahar)', NULL, '01609-430377', NULL, 'RFCL C.K Tower  4th Floor  Road# 07   K-Block Port Connecting Road  Halishahar Housing Estate', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2871, 1, 6, 1, 13, 25, 102054341, 'Alfredos (Bogura)', NULL, '1716773766', NULL, 'Jaleshwari Tola  Bogura Sadar', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2872, 1, 6, 1, 13, 25, 102054342, 'The Burgatory(Wari)', NULL, '1631426905', NULL, '29 Rankin Street Wari Rose Vally', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2873, 1, 6, 1, 13, 25, 102054343, 'Zone Out (ECB)', NULL, '1744999814', NULL, 'ASW Food Park  ECB Chattar  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2874, 1, 6, 1, 13, 25, 102054344, 'YBB Corporation (Mohammadpur)', NULL, '1753158616', NULL, 'Krishi Market  Mohammadpur', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2875, 1, 6, 1, 13, 25, 102054345, 'Md Rashed(Uttara)', NULL, '1703796886', NULL, 'Rajlokhkhi Meena Bazar  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2876, 1, 6, 1, 13, 25, 102054346, 'Abdullah Restora(Mowluvibazar)', 'Md Rasel', '1720666169', NULL, 'Agamasilan Zame Mosjid', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2877, 1, 6, 1, 13, 25, 102054348, 'Kamal Department Store(Dhanmondi)', NULL, '1308983514', NULL, 'Tollarbag Sodahanbag', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2878, 1, 6, 1, 13, 25, 102054349, 'Tree House(Dhan)', NULL, '1609796454', NULL, 'Road  02  House  32  Domino\'s Building  Lift-11  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2879, 1, 6, 1, 13, 25, 102054350, 'Cool Junction(Zigatola)', NULL, NULL, NULL, 'Zigatola Bus Stand', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2880, 1, 6, 1, 13, 25, 102054351, 'Shakeaholic Restaurant(Baily Road)', NULL, '1768808282', NULL, 'Baily Road  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2881, 1, 6, 1, 13, 25, 102054352, 'Cafe Food Land(Polton)', NULL, '1873500500', NULL, 'Polton  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2882, 1, 6, 1, 13, 25, 102054353, 'Chittagong Grammar School(Banani)', 'Md. Maruf Mia', '1611652162', NULL, 'Road No- 04  Banani  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2883, 1, 6, 1, 13, 25, 102054354, 'The Savory(Mirpur-12)', 'Shukanto', '1641677411', NULL, 'Signature Food Court  Sultan Mansion  Begum Rokeya sarani  Mirpur-12', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2884, 1, 6, 1, 13, 25, 102054355, 'Pizza Wow(Mirpur)', NULL, '1889229406', NULL, 'House-18  Block-D  Avenue-05  Section-06  Mirpur  Dhaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2885, 1, 6, 1, 13, 25, 102054358, 'Sejuti Live Bakery(Basabo)', NULL, '1904779731', NULL, '18/7/A  Rajarbag Kalimondir er Samne  Basabo  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2886, 1, 6, 1, 13, 25, 102054361, 'Quality Food Shop(Konapara)', NULL, '1400075486', NULL, 'Musa Tower Shahjalal Road  Konapara  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2887, 1, 6, 1, 13, 25, 102054267, 'Boogeman (Mirpur-6)', NULL, '1717655940', NULL, 'Mirpur-6  Beside Kudos', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2888, 1, 6, 1, 13, 25, 102054275, 'Mamuni Store (Mohammadpur)', 'Md. Murad', '14820217462', NULL, 'Mohammadpur Town Hall Market', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2889, 1, 6, 1, 13, 25, 102054297, 'Mother\'s Kitchen(Md.Pur)', NULL, '1534651942', NULL, 'House-3/C  Asad Avenue', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2890, 1, 6, 1, 13, 25, 102054322, 'Md. Rased (Kallaynpur)', 'Md. Rashed', '1703796886', NULL, 'Road - 03  Kallaynpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2891, 1, 6, 1, 13, 25, 102054347, 'SA Juice Bar(Shahjadpur)', NULL, '1670213280', NULL, '2 No Gate  Suvasto  Nazar Vally  Shahjadpur  Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2892, 1, 6, 1, 13, 25, 102054356, 'Pusan Enterprise(Cantonment)', NULL, '1920888000', NULL, 'CSD Moinul Road  Shahid Anwar College Dhaka Cantonment', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2893, 1, 6, 1, 13, 25, 102054357, 'Al Jabal Food & Cafe (Badda)', NULL, '1855459088', NULL, '216 Orchid Jamshed tower  merul badda  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2894, 1, 6, 1, 13, 25, 102054359, 'Hot Aliment(Banasree)', NULL, '1793125917', NULL, 'Road-04  House-01  Block-D  Rampura  Banasree Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2895, 1, 6, 1, 13, 25, 102054360, 'Juice Ghor(Banani)', NULL, '1794830568', NULL, 'Shawpno Supper Shop  Banani  Near Hotel Sheraton  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2896, 1, 6, 1, 13, 25, 102054294, 'Delivery Hero Stores (BD) Ltd-Mirpur 03', NULL, NULL, NULL, 'Mollik Tower  3-14 Zoo Road  Dhaka 1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2897, 1, 6, 1, 13, 25, 102054298, 'Milano Halisohor', NULL, '1782828658', NULL, NULL, 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2898, 1, 6, 1, 13, 25, 102054301, 'Indian Spicy Chicken(New)', NULL, '1980009077', NULL, 'Ga-14/1 Progati Sarani  Khan Mention Shahajadpur Dhaka ', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2899, 1, 6, 1, 13, 25, 102054312, 'Dilli Darbar(Mirpur)', NULL, NULL, NULL, 'SKS Tower  Mohakhali Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2900, 1, 6, 1, 13, 25, 102054316, 'Pop & Fresh(Uttara)', NULL, '1637886550', NULL, 'Plot # 32-D  Road # 02  Sector # 03 Shwapno Supper Shop', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2901, 1, 6, 1, 13, 25, 102054325, 'Mahfuz Enterprise(Mirpur)', NULL, '1869681820', NULL, '11 no Society new Market(Masala Patti) Road 10  Line-02  Mirpur-11  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2902, 1, 6, 1, 13, 25, 102054326, 'Food Fair(Polton)', NULL, '1966437836', NULL, 'China Town Shopping Mall Level-05  Shop-14 Polton', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2903, 1, 6, 1, 13, 25, 102054327, 'Burgerology(Mirpur)', NULL, '1683618812', NULL, 'Zoo Road  Opposit of Eid Gha Math Mirpur-01 Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2904, 1, 6, 1, 13, 25, 102053349, 'Delicious Morsel (Dhanmondi)', NULL, '1934181973', NULL, 'Shimanto Somvar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2905, 1, 6, 1, 13, 25, 102054313, 'Destroy  Demage & Westage', NULL, NULL, NULL, NULL, 0.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2906, 1, 6, 1, 13, 25, 102053526, 'Road Side Kitchen (Mohammadpur)', NULL, '1754465222', NULL, '10 Nurjahan Road  Mohammadpur', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2907, 1, 6, 1, 13, 25, 102053532, 'Coffee Mania (Mirpur-10)', NULL, '1717059713', NULL, 'House-16  Line-6  Block-B  Mirpur-10  Dhaka-1216', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2908, 1, 6, 1, 13, 25, 102053536, 'Adda (Mirpur)', 'Mr. Shahjahan', '1903544652', NULL, '7 no Shewrapara  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2909, 1, 6, 1, 13, 25, 102053537, 'Shuvo Fast Food (gazipur)', NULL, '1715506597', NULL, 'Broad Bazar Bus stand  Bottola Road  Opposite side of Brac Bank  Gazipur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2910, 1, 6, 1, 13, 25, 102053542, '.', NULL, '1970837834', NULL, '5/2 Folder Street  Wari', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2911, 1, 6, 1, 13, 25, 102053544, 'The Cook Book (Khilgaon)', NULL, '1759257074', NULL, '920/C Khilgaon  Taltola  Near BFC', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2912, 1, 6, 1, 13, 25, 102053545, 'Big D (Panthopath)', NULL, '1706312721', NULL, '152/2  Green Road  Near Panthopath Signal', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2913, 1, 6, 1, 13, 25, 102053549, 'Cheesy Pizzaria (Vuter goli)', NULL, '1772367101', NULL, '68/A  North road  Vuter goli  Dhanmondi  Dhaka-1205', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2914, 1, 6, 1, 13, 25, 102053551, 'Bazzaro BD (Basabo)', NULL, '1303056181', NULL, 'Near Basabo Post Office  Basabo  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2915, 1, 6, 1, 13, 25, 102053553, 'Pizza Next Door & kaffee House (Banasree)', NULL, '182706628', NULL, 'House-1  Block-B Main Rood   Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2916, 1, 6, 1, 13, 25, 102053556, 'Korea Bangladesh Club (Gulshan-2)', NULL, '1772159360', NULL, 'Road-76  House-22  Gulshan-2  United Hospital road', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2917, 1, 6, 1, 13, 25, 102053560, 'Sardars Indian Cuisine(Mirpur-1)', 'Md. Miraz', '1713144235', NULL, 'Sony Square Mirpur-1 Food Code  3rd floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2918, 1, 6, 1, 13, 25, 102053568, '3 Bites (Savar)', NULL, '1795060273', NULL, 'Parbati Nagar  Talbag  Thana Road  Savar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2919, 1, 6, 1, 13, 25, 102053570, 'Pizza Dhaka (Mirpur 60F)', NULL, '1717719605', NULL, 'Pabna Goli  Mirpur 60 Feet', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2920, 1, 6, 1, 13, 25, 102053571, 'Circle Lounge (Rajarbagh)', NULL, '1887449239', NULL, '873  Outer Circular Road  Circle Inn Building Rajarbagh  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2921, 1, 6, 1, 13, 25, 102053577, 'Buck\'s Cafe (Ishwardi)', 'Md. Rakib', '1675737655', NULL, 'Bishwas Shopping Complex  Rooppur  Ishwardi', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2922, 1, 6, 1, 13, 25, 102053579, 'Mr. Sohel (Shantinagar Bazar)', 'Sohel', '1760876517', NULL, 'Atiq & Brother (Shantinagar Bazar)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2923, 1, 6, 1, 13, 25, 102053585, 'Dhaka Dine (Uttara)', 'Mr. Adnan', '1680909352', NULL, 'Sector-11  House-24  Road-2  Shwapno Building  Uttara', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2924, 1, 6, 1, 13, 25, 102053586, 'Pizz Yummy (Farmgate)', NULL, '1635281136', NULL, '1/1  East Razabazar  Under FM Method  Farmgate', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2925, 1, 6, 1, 13, 25, 102053588, 'Dhaka Traders (Karwanbazar)', NULL, '1920715471', NULL, 'Karwan Bazar  Kitchen market  level-2', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2926, 1, 6, 1, 13, 25, 102053592, 'Pavilion Cafe(Uttara)', NULL, '1980262149', NULL, 'Zam Zam Tower(Uttara)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2927, 1, 6, 1, 13, 25, 102053594, 'EFC (Banasree)', NULL, '1906484499', NULL, 'Block-E  Road-01  House-01  Banasree', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2928, 1, 6, 1, 13, 25, 102053597, 'Mr. Iqbal (Gulshan-1 DCC Market)', NULL, '1814802932', NULL, 'Gulshan-1 DCC Market', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2929, 1, 6, 1, 13, 25, 102053600, 'Burger House (Savar)', NULL, '1750037622', NULL, 'Thana Road  Savar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2930, 1, 6, 1, 13, 25, 102053604, 'Great Food (Shimanto Square)', NULL, '1732727834', NULL, 'Shimanto Square Food Court  Dhanmondi  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2931, 1, 6, 1, 13, 25, 102053608, 'Razzak Store (Taltola)', NULL, '1742474447', NULL, 'Taltola Kachabazar  Khilgaon  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2932, 1, 6, 1, 13, 25, 102053610, 'Sifat Store (Niketon)', 'Mr. Shahed', '1836060373', NULL, '169 Shanti Niketon Abashik area', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2933, 1, 6, 1, 13, 25, 102053611, 'Magic Corn (Wari)', NULL, '1627364341', NULL, '13  Ranking Street  Wari  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2934, 1, 6, 4, 13, 25, 102053612, '2.0 Roof Top (Mirpur-1)', NULL, '1633311046', NULL, 'Eid Gah Field  Mirpur-1  Dhaka', 50000.00, NULL, 1, 0, 0, 1, 1, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 15:53:43');
INSERT INTO `clients` (`id`, `company_id`, `reference_by`, `client_category_id`, `area_id`, `territory_id`, `code`, `name`, `contact_person`, `phone`, `email`, `address`, `credit_limit`, `chain_client_id`, `status`, `is_chain`, `is_vat`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2935, 1, 6, 1, 13, 25, 102053707, 'Mr. Hamza (Banani)', NULL, '1763220220', NULL, 'House-37  road-4  Block-F  Banani  Appt-35  Banani', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2936, 1, 6, 1, 13, 25, 102053709, 'Best Fried Chicken (BFC)- Green Road', NULL, '1723000914', NULL, '147 Green Road  Ejab Rabeya\'s   Heritage  Ground Floor  Panthapoth  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2937, 1, 6, 1, 13, 25, 102053711, 'Bangla Kitchen (Mohanagar Project)', NULL, '1818530243', NULL, 'House-53  Road-04  Mohanagar Project  Rampura', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2938, 1, 6, 1, 13, 25, 102053712, 'Little Yellow (Khilgaon)', NULL, '1789795003', NULL, 'Khilgaon Taltola  Beside La Fiesta', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2939, 1, 6, 1, 13, 25, 102053713, 'TNR Enterprise (Ctg)', NULL, '1711486852', NULL, 'Dewan Hat  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2940, 1, 6, 1, 13, 25, 102053718, 'Bismillah Snacks (Airport)', 'Md. Rabbi', '1612559977', NULL, 'Kaolan Asian city gate  Opposite Northen University', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2941, 1, 6, 1, 13, 25, 102053726, 'Lanchon (Shahjadpur)', NULL, '1726070090', NULL, 'Subastu tower  Shahjadpur  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2942, 1, 6, 1, 13, 25, 102053728, 'Food Chain Asia Ltd(Tej)', 'Mr. Mithun', '1787660400', NULL, '48 Begunbari  Tejgaon  Dhaka', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2943, 1, 6, 1, 13, 25, 102053734, 'Corn Gallery Warehouse (Gulshan)', NULL, '1783123798', NULL, 'Nabab Chatga Restaurant  Behind Navana Tower  Gulshan-1', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2944, 1, 6, 1, 13, 25, 102053736, 'The Chocolate Room (Gulshan-2)', NULL, '1701666957', NULL, 'Nasrin Casabella  Plot-2A  Block-NW(H)  1st floor Gulshan North Avenue  Gulshan 2 Dhaka-1212', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2945, 1, 6, 1, 13, 25, 102053738, 'Old School Cafe', NULL, '1300411731', NULL, 'Bashundhara R/A Gate  Nosor Tower', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2946, 1, 6, 1, 13, 25, 102053739, 'Appetina (Mohammadpur)', NULL, '1749444444', NULL, 'Z-16  Tajmohol Road  Mohammapur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2947, 1, 6, 1, 13, 25, 102053742, 'GREENLAND SERVICES LTD (Dhanmondi)', NULL, '1709990900', NULL, 'Dhanmondi 38 Sheikh Kamal Sarani Road 16  Dhanmondi  Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2948, 1, 6, 1, 13, 25, 102053744, 'GREENLAND SERVICES LTD (Uttara)', NULL, '1709990888', NULL, 'Plot No #29  Gausul Azam Avenue  Sector # 14  Uttara Dhaka', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2949, 1, 6, 1, 13, 25, 102053749, 'NAVANA FOODS LIMITED (Badda)', NULL, NULL, NULL, 'Rangs RL Square  Plot Kha-201/1  Progoti  Sharani  Badda  Dhaka 1212', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2950, 1, 6, 1, 13, 25, 102053752, 'Burger Mania (Mohammadpur)', NULL, '1614884120', NULL, 'Tajmohol Road Opposite American Burger  Brac Bank Building 3rd Floor', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2951, 1, 6, 1, 13, 25, 102053759, 'Unimart Ltd.- Central Kitchen (Satarkul)', NULL, '1918541166', NULL, 'Madani Avenue (Beside United International University)  Dhaka 1212 ', 600000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2952, 1, 6, 1, 13, 25, 102053763, 'C House Milano (Gulshan 1)', 'Md. Noshid', '1625375337', NULL, NULL, 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2953, 1, 6, 1, 13, 25, 102053767, 'Food Forest (Feni)', NULL, '1812145275', NULL, 'Feni Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2954, 1, 6, 1, 13, 25, 102053771, 'Meat n Cheez (Rupnagar)', NULL, '1950493113', NULL, 'House - 3 Road - 17  Rupnagar Residential Area  Mirpur  DHaka-1216', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2955, 1, 6, 1, 13, 25, 102053773, 'Mad Chef (Wari)', NULL, '1843997420', NULL, 'Tipu Sultan Road  Wari  Dhaka.', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2956, 1, 6, 1, 13, 25, 102053775, 'FFC (Dhanmondi 7)', 'Md. Musahid', '1780210298', NULL, 'Orchid Point  House - 17  Road - 7  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2957, 1, 6, 1, 13, 25, 102053776, 'Ascott Palace (Baridhara)', NULL, '1712900999', NULL, 'House-10  Road-6  Baridhara Diplomatic Zone', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2958, 1, 6, 1, 13, 25, 102053781, 'LE MERIDIEN DHAKA', NULL, '1766673413', NULL, '79/A Commercial Area  Airport Road  Nukunja-02  Khikhet  Dhaka-1229', 300000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2959, 1, 6, 1, 13, 25, 102053786, 'Steak Burger (Bashundhara)', NULL, '1647723932', NULL, 'KA-24/4  Sarker Market (1st Floor)  Bashundhara Road', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2960, 1, 6, 1, 13, 25, 102053791, 'Hajj Finance Company Limited (Motijheel)', NULL, '1817295952', NULL, 'Fazlur Rahman Centre  72 Dilkusha c/a', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2961, 1, 6, 1, 13, 25, 102053861, 'King Queen Panahar (Newmarket)', 'Abdullah AL Mamun Khan', '1632698010', NULL, 'Building No - 1  Shop No-2  Chadni Chowk Shopping Complex  Dhaka-1205', 20000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2962, 1, 6, 1, 13, 25, 102053863, 'Allah Bharasha General Store', NULL, '1306422619', NULL, '143  Shantinagar Bazar', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2963, 1, 6, 1, 13, 25, 102053867, 'Hot Swing (Shaymoli)', 'Mr. Juwel', '1325661605', NULL, 'House-91  Road-3  Shaymoli', 30000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2964, 1, 6, 1, 13, 25, 102054044, 'GREENLAND SERVICES LTD (Bashundhara)', NULL, '1709991016', NULL, 'House-77-78  Road-3/4  Blocl-I  main Avenue  Bashundhara R/A', 200000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2965, 1, 6, 1, 13, 25, 102054047, 'Pizza Inn (Mirpur-1)', NULL, '1816344683', NULL, 'Sony cinema hall  2nd floor  Mirpur 1  dhaka', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2966, 1, 6, 1, 13, 25, 102054048, 'Burger Choice (Uttor Badda)', NULL, '1719278588', NULL, 'House No: 225  Abdullah Bag  Shatarkull Road  Uttor Badda', 25000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2967, 1, 6, 1, 13, 25, 102054051, 'Cafe Spartan (Banasree)', NULL, '1671442321', NULL, 'House:33 Road no:03 Block:F  Banasree Rampura Dhaka 1219', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2968, 1, 6, 1, 13, 25, 102054053, 'Corn n\' Scoop (Lalmatia)', NULL, '1817591297', NULL, '4/4  Block-E  Lalmatia   Dhaka. (Opposite to Lalmatia Mohila College)', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2969, 1, 6, 1, 13, 25, 102054057, 'Star Cineplex (Ctg)', NULL, '1921095146', NULL, 'Level-10  Bali Arcade  227 Nawab Serajuddola Road  Chakbazar  Chattagram', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2970, 1, 6, 1, 13, 25, 102054060, 'PizzaBurg (Narayanganj)', NULL, '01404-461234', NULL, 'Sahera Zaman Emporium  Balur Math Naryanganj', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2971, 1, 6, 1, 13, 25, 102054063, 'Six Seven(Jamuna)', 'Bishal', '1829122200', NULL, 'Jamuna Future Park  Level-05', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2972, 1, 6, 1, 13, 25, 102054064, 'Pizza.us (Mirpur 60 feet)', NULL, '1729660155', NULL, '61/2  Walton Mor  Mirpur 60 feet', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2973, 1, 6, 1, 13, 25, 102054071, 'Cool Stone (Savar)', NULL, '1822895835', NULL, 'Sena Shopping Complex  Nabinagar  Savar  Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2974, 1, 6, 1, 13, 25, 102054073, 'Fahim Brothers (Ctg)', NULL, '1817794952', NULL, 'Riyajuddin Bazar  Chittagong', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2975, 1, 6, 1, 13, 25, 102054074, 'Ten Eleven Cafe', NULL, '1608061373', NULL, 'Equria(Hazi Osman Goni Supper Market) South Keranigonj Dhaka-1311', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2976, 1, 6, 1, 13, 25, 102054075, 'Taza Fal( Mirpur 11)', 'Md Monir', '1994473884', NULL, 'Mirpur 11 Showpno Supper Shop', 100000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2977, 1, 6, 1, 13, 25, 102054080, 'Maa Tredars (Ctg)', NULL, '1732910898', NULL, 'Riyaj Uddin bazer ctg', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2978, 1, 6, 1, 13, 25, 102054082, 'Thinking Cup(Kachukhat)', 'Md.Towhid', '1324443338', NULL, 'Kachukhat Moar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2979, 1, 6, 1, 13, 25, 102054088, 'Pizza Lane (Pallabi)', NULL, '1841163869', NULL, 'House-1  Road-7  Block-C  Near Old pallabi Thana  Mirpur', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2980, 1, 6, 1, 13, 25, 102054090, 'Juicyland(Khilgaon)', NULL, '1716546531', NULL, '585/1/C Khilgaon Opposite Chillox Burger', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2981, 1, 6, 1, 13, 25, 102054093, 'Starbase (Mirpur DOHS)', NULL, '1567911211', NULL, 'Road-9  Trust Bank Building  Lift-5  Mirpur DOHS', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2982, 1, 6, 1, 13, 25, 102054096, 'Fun Club (Narayanganj)', 'Md. Shoyeb', '1630275797', NULL, 'BB Road Narayanganj', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2983, 1, 6, 1, 13, 25, 102054102, 'Mr. Mofiz Ctg', 'Mr. Mofiz', '1942286957', NULL, 'GEC mor   Chittagong', 500000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2984, 1, 6, 1, 13, 25, 102054104, 'Pizzait (Tikatuli)', NULL, '1672889219', NULL, 'Proshanti Tower  8 Avoy das Lane  Tikatuli  Wari', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2985, 1, 6, 1, 13, 25, 102054108, 'Panio(Banasree)', NULL, '1616029715', NULL, 'Road-04 Block-H Holly Kitcken School  South Banasree', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2986, 1, 6, 1, 13, 25, 102054111, 'Shawpnill Chayer Adda(Baridhara)', NULL, '1406568360', NULL, 'House-09 Road-2/A Block-J  Vatara Baridhara Dhaka', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2987, 1, 6, 1, 13, 25, 102054114, 'Bondhon(Badda)', NULL, '1717470020', NULL, 'K 40/1 Dorga Bari More South Badda', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2988, 1, 6, 1, 13, 25, 102054120, 'Slieez (Dhanmondi)', NULL, NULL, NULL, 'House-472  Road- 2/A  Satmosjeed Road  Jigatola  Dhanmondi', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2989, 1, 6, 1, 13, 25, 102054123, 'Spicy Corn(Zigatola)', NULL, '1748711754', NULL, 'Zigatola near tannery more', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2990, 1, 6, 1, 13, 25, 102054125, 'Dainik Hut  (Mirpur- 1)', 'Mr Shorif', '1712517388', NULL, 'C/53  Shah Ali City Corporation Market  Mipur-1', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2991, 1, 6, 1, 13, 25, 102054128, 'Ektu Adda Hobe(Mirpur-10)', NULL, '1912476994', NULL, 'Mirpur-10 Near Hop School', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33'),
(2992, 1, 6, 1, 13, 25, 102054259, 'Dip Saha (Khulna)', NULL, '1783410949', NULL, 'Khulna Sadar', 50000.00, NULL, 1, 0, 0, 1, NULL, NULL, NULL, '2023-09-03 11:41:33', '2023-10-03 11:41:33');

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
(1, 1, 'RETAILER', 1, 1, NULL, NULL, NULL, '2023-09-23 15:05:44', '2023-09-23 15:05:44'),
(2, 1, 'DISTRIBUTOR', 1, 1, NULL, NULL, NULL, '2023-09-23 15:05:10', '2023-09-23 15:05:10'),
(3, 1, 'HOTEL & RESTAURANT', 1, 1, NULL, NULL, NULL, '2023-09-23 15:05:27', '2023-09-23 15:05:27'),
(4, 1, 'CORPORATE', 1, 1, NULL, NULL, NULL, '2023-09-23 15:05:59', '2023-09-23 15:05:59'),
(5, 1, 'OTHERS', 1, 1, NULL, NULL, NULL, '2023-09-23 15:06:18', '2023-09-23 15:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `client_messages`
--

CREATE TABLE `client_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_prices`
--

CREATE TABLE `client_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `default_price` double(8,2) NOT NULL,
  `client_price` double(8,2) NOT NULL,
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
  `amount` double NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `sales_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sales_id`)),
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_data`
--

CREATE TABLE `collection_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext NOT NULL,
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
(1, 'BF', 'Bonton Foods', 'bontonfoods', 'bonton.foods@gmail.com', '0161800371020', '547294984', 'www.bontonfoods.com', '5', '654', 'tradelicense', 'Suite # M-10, Level-10, Gulfeshan Plaza, Moghbazar, Dhaka-1217', 'media/company/2023-09-23-5P6r6GrnVMcqvKDDJr1IvlzE6tS3cFMt9D97WoIA.webp', 1, NULL, NULL, NULL, '2023-09-23 06:52:33', '2023-09-23 06:52:33');

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
  `secondary_mobile` varchar(255) NOT NULL,
  `secondary_email` varchar(255) NOT NULL,
  `map_url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `heading`, `title`, `address`, `work_time`, `primary_mobile`, `primary_email`, `secondary_mobile`, `secondary_email`, `map_url`, `created_at`, `updated_at`) VALUES
(1, 'GET IN TOUCH', '<span style=\"color: rgb(30, 41, 59); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium; text-align: center;\">Don’t hesitate to contact us directly so that we can think together about a solution.</span>', '<p>Suite # M-10, Level-10, </p><p>Gulfeshan Plaza, Moghbazar, </p><p>Dhaka-1217</p>', '<span style=\"color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">Monday to Friday</span><br style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><span style=\"color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">7 a.m. 12 p.m. – 1 p.m. 4 p.m.</span><br style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><br style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><span style=\"color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">Saturday</span><br style=\"border-width: 0px; border-style: solid; border-color: currentcolor; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgb(59 130 246 / 0.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\"><span style=\"color: rgb(71, 85, 105); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium;\">8 a.m. 2 p.m.</span>', '019 97 556677', 'admin@bontonfoods.com', '01997 556688', 'info@bontonfoods.com', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28922.48314930121!2d90.0115998!3d25.0235383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3757d610b1247fcd%3A0x6820b0a61eb62bfc!2sSherpur!5e0!3m2!1sen!2sbd!4v1695954109455!5m2!1sen!2sbd', '2023-10-04 02:43:38', '2023-10-18 14:02:58');

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
  `amount` double(16,2) NOT NULL,
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
-- Table structure for table `delivery_lists`
--

CREATE TABLE `delivery_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rate` double(16,2) NOT NULL,
  `qty` double NOT NULL,
  `amount` double(16,2) NOT NULL,
  `sales_list_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `details_cards`
--

INSERT INTO `details_cards` (`id`, `title`, `description`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A LARGE VARIETY OF PRODUCT', '<p><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment. </span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment. </span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment. </span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment. </span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment. </span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment. </span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.</span><span style=\"background-color: rgb(241, 245, 249); color: rgb(51, 65, 85); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, \"Noto Sans\", sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"; font-size: medium; text-align: center;\"> </span><br></p>', 5, 1, '2023-10-03 13:07:42', '2023-10-08 15:37:16'),
(2, 'A LARGE VARIETY OF PRODUCTS', '<p><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.</span><span style=\"background-color: rgb(241, 245, 249); color: rgb(51, 65, 85); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; text-align: center;\">&nbsp;</span><br></p>', 2, 1, '2023-10-03 13:08:10', '2023-10-03 13:08:10'),
(3, 'A LARGE VARIETY OF PRODUCTS', '<p><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.&nbsp;</span><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.</span><span style=\"background-color: rgb(241, 245, 249); color: rgb(51, 65, 85); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium; text-align: center;\">&nbsp;</span><br></p>', 3, 1, '2023-10-03 13:08:26', '2023-10-03 13:08:26');

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
-- Table structure for table `flashdeals`
--

CREATE TABLE `flashdeals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `featured` tinyint(4) NOT NULL DEFAULT 1,
  `banner` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flashdeal_products`
--

CREATE TABLE `flashdeal_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flash_deal_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `discount` double NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `total_target` int(11) NOT NULL,
  `total_target_amount` int(11) NOT NULL,
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
  `target` int(11) NOT NULL,
  `target_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_product_sections`
--

CREATE TABLE `home_product_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_ids` text DEFAULT NULL,
  `first_row_content` varchar(255) NOT NULL DEFAULT 'product',
  `second_row_content` varchar(255) NOT NULL DEFAULT 'product',
  `banner_one` varchar(255) DEFAULT NULL,
  `banner_one_link` varchar(255) DEFAULT NULL,
  `banner_two` varchar(255) DEFAULT NULL,
  `banner_two_link` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
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
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_no` bigint(20) NOT NULL,
  `payment_type` varchar(255) NOT NULL DEFAULT 'credit',
  `voucher_no` varchar(255) NOT NULL,
  `lifting_date` date NOT NULL,
  `total_cost` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
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
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_price` double(8,2) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL,
  `total_paid` double(8,2) NOT NULL DEFAULT 0.00,
  `sold_qty` int(11) NOT NULL DEFAULT 0,
  `return_qty` int(11) NOT NULL DEFAULT 0,
  `transfer_qty` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lifting_returns`
--

CREATE TABLE `lifting_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
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
-- Table structure for table `lifting_return_lists`
--

CREATE TABLE `lifting_return_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_return_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_product_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` double NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(10, '2023_08_02_000217_create_pages_table', 1),
(11, '2023_08_05_220022_create_menus_table', 1),
(12, '2023_08_05_220028_create_menu_items_table', 1),
(13, '2023_08_08_095304_create_admin_settings_table', 1),
(14, '2023_08_09_115019_create_categories_table', 1),
(15, '2023_08_09_161545_create_products_table', 1),
(16, '2023_08_09_163637_create_brands_table', 1),
(17, '2023_08_09_175745_create_product_prices_table', 1),
(18, '2023_08_10_115126_create_orders_table', 1),
(19, '2023_08_10_115133_create_order_products_table', 1),
(20, '2023_08_23_083356_create_portfolios_table', 1),
(21, '2023_08_30_114536_create_home_product_sections_table', 1),
(22, '2023_09_02_152658_create_attributes_table', 1),
(23, '2023_09_02_153152_create_attribute_values_table', 1),
(24, '2023_09_05_104150_create_product_stocks_table', 1),
(25, '2023_09_06_182742_create_shipping_addresses_table', 1),
(26, '2023_09_09_111028_create_locations_table', 1),
(27, '2023_09_09_183847_create_wishlists_table', 1),
(28, '2023_09_12_122146_create_flashdeals_table', 1),
(29, '2023_09_12_122242_create_flashdeal_products_table', 1),
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
(46, '2023_09_25_203513_create_group_sales_targets_table', 1),
(47, '2023_09_25_203644_create_group_sales_target_categories_table', 1),
(48, '2023_09_28_123659_create_vehicles_table', 1),
(49, '2023_09_29_213551_create_client_prices_table', 1),
(50, '2023_09_30_152737_create_liftings_table', 1),
(51, '2023_09_30_152744_create_lifting_products_table', 1),
(52, '2023_09_30_162737_create_lifting_documents_table', 1),
(53, '2023_10_03_165212_create_static_site_items_table', 1),
(54, '2023_10_03_172718_create_special_food_items_table', 1),
(55, '2023_10_03_182643_create_details_cards_table', 1),
(56, '2023_10_03_213106_create_showcase_items_table', 1),
(57, '2023_10_03_222638_create_client_messages_table', 1),
(58, '2023_10_03_224230_create_contacts_table', 1),
(59, '2023_10_04_081821_create_testimonials_table', 1),
(60, '2023_10_04_085027_create_abouts_table', 1),
(61, '2023_10_04_093333_create_social_works_table', 1),
(62, '2023_10_11_125908_create_sales_table', 1),
(63, '2023_10_11_125939_create_sales_lists_table', 1),
(64, '2023_10_11_130353_create_collections_table', 1),
(65, '2023_10_12_175550_create_sales_product_data_table', 1),
(66, '2023_10_15_090533_create_collection_data_table', 1),
(67, '2023_10_15_125909_create_sales_returns_table', 1),
(68, '2023_10_15_131506_create_sales_return_lists_table', 1),
(69, '2023_10_16_103106_create_lifting_returns_table', 1),
(70, '2023_10_16_103114_create_lifting_return_lists_table', 1),
(71, '2023_10_16_144752_create_vendor_payments_table', 1),
(72, '2023_10_16_145441_create_vendor_payment_data_table', 1),
(73, '2023_10_17_213643_create_deliveries_table', 1),
(74, '2023_10_17_213739_create_delivery_lists_table', 1),
(75, '2023_10_18_102801_create_transfers_table', 1),
(76, '2023_10_18_102810_create_transfer_products_table', 1);

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
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

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
  `invoice` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `shipping_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_charge` double(8,2) DEFAULT NULL,
  `sub_total` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `total` double(8,2) NOT NULL,
  `paid` double(8,2) NOT NULL,
  `due` double(8,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `order_type` varchar(255) NOT NULL DEFAULT 'offline',
  `pending_at` timestamp NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `processing_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `successed_at` timestamp NULL DEFAULT NULL,
  `canceled_at` timestamp NULL DEFAULT NULL,
  `return_at` timestamp NULL DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `flash_deal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `flash_deal_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `sale_price` double NOT NULL,
  `regular_price` double NOT NULL,
  `discount_price` double NOT NULL DEFAULT 0,
  `order_price` double NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `sold` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(20, 'System Setup', 'web', '2023-09-19 09:20:32', '2023-09-19 09:20:32'),
(21, 'Sales Group', 'web', '2023-09-19 09:20:46', '2023-09-23 14:50:24'),
(22, 'Store Setup', 'web', '2023-09-19 09:20:59', '2023-09-19 09:20:59'),
(23, 'Product Type', 'web', '2023-09-19 09:21:10', '2023-09-23 14:53:14'),
(24, 'Product Setup', 'web', '2023-09-19 09:21:19', '2023-09-19 09:21:19'),
(25, 'Staff Setup', 'web', '2023-09-19 09:21:25', '2023-09-19 09:21:25'),
(26, 'Product List', 'web', '2023-09-19 09:21:36', '2023-09-19 09:21:36'),
(27, 'System Configuration', 'web', '2023-09-19 09:22:02', '2023-09-19 09:22:02'),
(28, 'Group Sales Target', 'web', '2023-09-19 09:22:23', '2023-09-19 09:22:23'),
(29, 'Client Price Setup', 'web', '2023-09-19 09:22:33', '2023-09-19 09:22:33'),
(30, 'Procurement', 'web', '2023-09-19 09:23:13', '2023-09-19 09:23:13'),
(31, 'Transaction', 'web', '2023-09-19 09:23:22', '2023-09-19 09:23:22'),
(32, 'Vendor Setup', 'web', '2023-09-19 09:23:31', '2023-09-19 09:23:31'),
(33, 'Product Lifting', 'web', '2023-09-19 09:23:43', '2023-09-19 09:23:43'),
(34, 'Purchase Return', 'web', '2023-09-19 09:23:55', '2023-09-19 09:23:55'),
(35, 'Vendor Payment', 'web', '2023-09-19 09:24:05', '2023-09-19 09:24:05'),
(36, 'Reports', 'web', '2023-09-19 09:24:13', '2023-09-19 09:24:13'),
(37, 'Lifting History', 'web', '2023-09-19 09:24:28', '2023-09-19 09:24:28'),
(38, 'Return History', 'web', '2023-09-19 09:24:36', '2023-09-19 09:24:36'),
(39, 'Payment History', 'web', '2023-09-19 09:24:54', '2023-09-19 09:24:54'),
(40, 'Vendor Statement', 'web', '2023-09-19 09:25:06', '2023-09-19 09:25:06'),
(41, 'Inventory', 'web', '2023-09-19 09:25:29', '2023-09-19 09:25:29'),
(42, 'Transaction 2', 'web', '2023-09-19 09:25:38', '2023-09-19 09:25:38'),
(43, 'Product Transfer', 'web', '2023-09-19 09:25:55', '2023-09-19 09:25:55'),
(44, 'Transfer Receive', 'web', '2023-09-19 09:26:05', '2023-09-19 09:26:05'),
(45, 'Reports 2', 'web', '2023-09-19 09:26:14', '2023-09-19 09:26:14'),
(46, 'Closing Stock', 'web', '2023-09-19 09:26:33', '2023-09-19 09:26:33'),
(47, 'Stock Status', 'web', '2023-09-19 09:26:45', '2023-09-19 09:26:45'),
(48, 'Transfer Log', 'web', '2023-09-19 09:26:55', '2023-09-19 09:26:55'),
(49, 'Sales Management', 'web', '2023-09-19 09:28:03', '2023-09-19 09:28:03'),
(50, 'Transaction 3', 'web', '2023-09-19 09:28:16', '2023-09-19 09:28:16'),
(51, 'Region Setup', 'web', '2023-09-19 09:28:49', '2023-09-19 09:28:49'),
(52, 'Area Setup', 'web', '2023-09-19 09:29:03', '2023-09-19 09:29:03'),
(53, 'Territory Setup', 'web', '2023-09-19 09:29:15', '2023-09-19 09:29:15'),
(54, 'Client Setup', 'web', '2023-09-19 09:29:28', '2023-09-19 09:29:28'),
(55, 'Daily Sales', 'web', '2023-09-19 09:29:42', '2023-09-19 09:29:42'),
(56, 'Daily Collection', 'web', '2023-09-19 09:29:54', '2023-09-19 09:29:54'),
(57, 'Bulk Collection', 'web', '2023-09-19 09:30:07', '2023-09-19 09:30:07'),
(58, 'Sales Return', 'web', '2023-09-19 09:30:21', '2023-09-19 09:30:21'),
(59, 'Return Approval', 'web', '2023-09-19 09:30:32', '2023-09-19 09:30:32'),
(60, 'Reports 3', 'web', '2023-09-19 09:30:42', '2023-09-19 09:30:42'),
(61, 'Sales History', 'web', '2023-09-19 09:30:51', '2023-09-19 09:30:51'),
(62, 'Collection History', 'web', '2023-09-19 09:31:08', '2023-09-19 09:31:08'),
(63, 'Return History 2', 'web', '2023-09-19 09:31:21', '2023-09-19 09:31:21'),
(64, 'Client Statement', 'web', '2023-09-19 09:31:39', '2023-09-19 09:31:39'),
(65, 'Client List', 'web', '2023-09-19 09:31:52', '2023-09-19 09:31:52'),
(66, 'Business Analysis', 'web', '2023-09-19 09:33:29', '2023-09-19 09:33:29'),
(67, 'Payment Analysis', 'web', '2023-09-19 09:33:39', '2023-09-19 09:33:39'),
(68, 'Stock Valuation', 'web', '2023-09-19 09:33:47', '2023-09-19 09:33:47'),
(69, 'Sales Target & Achievement', 'web', '2023-09-19 09:33:56', '2023-09-19 09:33:56'),
(70, 'Sales Contribution', 'web', '2023-09-19 09:34:06', '2023-09-19 09:34:06'),
(71, 'Sales Realization Analysis', 'web', '2023-09-19 09:34:14', '2023-09-19 09:34:14'),
(72, 'Sales Ageing Report', 'web', '2023-09-19 09:34:41', '2023-09-19 09:34:41'),
(73, 'Dealer Outstanding', 'web', '2023-09-19 09:34:53', '2023-09-19 09:34:53'),
(74, 'Product Sales Profit', 'web', '2023-09-19 09:35:10', '2023-09-19 09:35:10'),
(75, 'Online Order', 'web', '2023-09-19 09:36:07', '2023-09-19 09:36:07'),
(76, 'Offline Order', 'web', '2023-09-19 09:36:18', '2023-09-23 10:00:01'),
(78, 'Prepare Gatepass', 'web', '2023-09-19 09:38:15', '2023-10-18 13:57:45'),
(80, 'Delivery Statement', 'web', '2023-09-19 09:38:34', '2023-10-18 13:58:25'),
(81, 'Client Chain', 'web', '2023-09-23 10:02:09', '2023-09-23 14:46:48'),
(82, 'Client Type', 'web', '2023-09-23 10:02:20', '2023-09-23 14:45:32'),
(83, 'admin.client-category.create', 'web', '2023-09-25 06:58:14', '2023-09-25 06:58:14'),
(84, 'admin.client-category.store', 'web', '2023-09-25 06:58:24', '2023-09-25 06:58:24'),
(85, 'admin.client-category.edit', 'web', '2023-09-25 06:58:31', '2023-09-25 06:58:31'),
(86, 'admin.client-category.update', 'web', '2023-09-25 06:58:40', '2023-09-25 06:58:40'),
(87, 'admin.client-category.destroy', 'web', '2023-09-25 06:58:49', '2023-09-25 06:58:49'),
(88, 'admin.chain-client.create', 'web', '2023-09-25 06:59:35', '2023-09-25 06:59:35'),
(89, 'admin.chain-client.store', 'web', '2023-09-25 06:59:50', '2023-09-25 06:59:50'),
(90, 'admin.chain-client.edit', 'web', '2023-09-25 06:59:55', '2023-09-25 06:59:55'),
(91, 'admin.chain-client.update', 'web', '2023-09-25 07:00:02', '2023-09-25 07:00:02'),
(92, 'admin.chain-client.destroy', 'web', '2023-09-25 07:00:19', '2023-09-25 07:00:19'),
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
(174, 'Measurement Unit', 'web', '2023-09-29 03:11:33', '2023-09-29 03:11:33'),
(175, 'admin.lifting.create', 'web', '2023-09-30 11:29:14', '2023-09-30 11:29:14'),
(176, 'admin.lifting.store', 'web', '2023-09-30 11:29:19', '2023-09-30 11:29:19'),
(177, 'admin.lifting.edit', 'web', '2023-09-30 11:29:23', '2023-09-30 11:29:23'),
(178, 'admin.lifting.update', 'web', '2023-09-30 11:29:27', '2023-09-30 11:29:27'),
(179, 'admin.lifting.destroy', 'web', '2023-09-30 11:29:33', '2023-09-30 11:29:33'),
(180, 'Website CMS', 'web', '2023-10-08 15:08:32', '2023-10-08 15:08:32'),
(181, 'Slider', 'web', '2023-10-08 15:09:27', '2023-10-08 15:14:11'),
(182, 'Site Items', 'web', '2023-10-08 15:22:26', '2023-10-08 15:22:26'),
(183, 'Special Item', 'web', '2023-10-08 15:23:03', '2023-10-18 13:55:44'),
(184, 'Social Working', 'web', '2023-10-08 15:23:47', '2023-10-08 15:23:47'),
(185, 'About', 'web', '2023-10-08 15:24:06', '2023-10-08 15:24:06'),
(186, 'Contact', 'web', '2023-10-08 15:24:27', '2023-10-08 15:24:27'),
(187, 'Testimonial', 'web', '2023-10-08 15:24:57', '2023-10-08 15:24:57'),
(188, 'Client Message', 'web', '2023-10-08 15:25:53', '2023-10-08 15:25:53'),
(189, 'Showcase Items', 'web', '2023-10-08 15:26:21', '2023-10-08 15:26:21'),
(190, 'Details Card', 'web', '2023-10-08 15:26:50', '2023-10-08 15:26:50'),
(191, 'admin.slider.create', 'web', '2023-10-08 15:28:49', '2023-10-08 15:28:49'),
(192, 'admin.slider.store', 'web', '2023-10-08 15:28:54', '2023-10-08 15:28:54'),
(193, 'admin.slider.edit', 'web', '2023-10-08 15:28:59', '2023-10-08 15:28:59'),
(194, 'admin.slider.update', 'web', '2023-10-08 15:29:07', '2023-10-08 15:29:07'),
(195, 'admin.slider.destroy', 'web', '2023-10-08 15:29:15', '2023-10-08 15:29:15'),
(196, 'admin.special-food-item.create', 'web', '2023-10-08 15:30:28', '2023-10-08 15:30:28'),
(197, 'admin.special-food-item.store', 'web', '2023-10-08 15:30:37', '2023-10-08 15:30:37'),
(198, 'admin.special-food-item.edit', 'web', '2023-10-08 15:30:41', '2023-10-08 15:30:41'),
(199, 'admin.special-food-item.update', 'web', '2023-10-08 15:30:47', '2023-10-08 15:30:47'),
(200, 'admin.special-food-item.destroy', 'web', '2023-10-08 15:30:51', '2023-10-08 15:30:51'),
(201, 'admin.social-working.create', 'web', '2023-10-08 15:31:27', '2023-10-08 15:31:27'),
(202, 'admin.social-working.store', 'web', '2023-10-08 15:31:31', '2023-10-08 15:31:31'),
(203, 'admin.social-working.edit', 'web', '2023-10-08 15:31:36', '2023-10-08 15:31:36'),
(204, 'admin.social-working.update', 'web', '2023-10-08 15:31:41', '2023-10-08 15:31:41'),
(205, 'admin.social-working.destroy', 'web', '2023-10-08 15:31:45', '2023-10-08 15:31:45'),
(206, 'admin.testimonial.create', 'web', '2023-10-08 15:33:23', '2023-10-08 15:33:23'),
(207, 'admin.testimonial.store', 'web', '2023-10-08 15:33:28', '2023-10-08 15:33:28'),
(208, 'admin.testimonial.edit', 'web', '2023-10-08 15:33:32', '2023-10-08 15:33:32'),
(209, 'admin.testimonial.update', 'web', '2023-10-08 15:33:37', '2023-10-08 15:33:37'),
(210, 'admin.testimonial.destroy', 'web', '2023-10-08 15:34:02', '2023-10-08 15:34:02'),
(211, 'admin.client-message.create', 'web', '2023-10-08 15:34:31', '2023-10-08 15:34:31'),
(212, 'admin.client-message.store', 'web', '2023-10-08 15:34:36', '2023-10-08 15:34:36'),
(213, 'admin.client-message.edit', 'web', '2023-10-08 15:34:40', '2023-10-08 15:34:40'),
(214, 'admin.client-message.update', 'web', '2023-10-08 15:34:44', '2023-10-08 15:34:44'),
(215, 'admin.client-message.destroy', 'web', '2023-10-08 15:34:49', '2023-10-08 15:34:49'),
(216, 'admin.showcase-item.create', 'web', '2023-10-08 15:35:20', '2023-10-08 15:35:20'),
(217, 'admin.showcase-item.store', 'web', '2023-10-08 15:35:24', '2023-10-08 15:35:24'),
(218, 'admin.showcase-item.edit', 'web', '2023-10-08 15:35:28', '2023-10-08 15:35:28'),
(219, 'admin.showcase-item.update', 'web', '2023-10-08 15:35:33', '2023-10-08 15:35:33'),
(220, 'admin.showcase-item.destroy', 'web', '2023-10-08 15:35:39', '2023-10-08 15:35:39'),
(221, 'admin.details-card.create', 'web', '2023-10-08 15:36:04', '2023-10-08 15:36:04'),
(222, 'admin.details-card.store', 'web', '2023-10-08 15:36:09', '2023-10-08 15:36:09'),
(223, 'admin.details-card.edit', 'web', '2023-10-08 15:36:13', '2023-10-08 15:36:13'),
(224, 'admin.details-card.update', 'web', '2023-10-08 15:36:17', '2023-10-08 15:36:17'),
(225, 'admin.details-card.destroy', 'web', '2023-10-08 15:36:22', '2023-10-08 15:36:22'),
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
(248, 'admin.lifting-return.create', 'web', '2023-10-16 04:47:09', '2023-10-16 04:47:09'),
(249, 'admin.lifting-return.store', 'web', '2023-10-16 04:47:15', '2023-10-16 04:47:15'),
(250, 'admin.lifting-return.edit', 'web', '2023-10-16 04:47:19', '2023-10-16 04:47:19'),
(251, 'admin.lifting-return.update', 'web', '2023-10-16 04:47:28', '2023-10-16 04:47:28'),
(252, 'admin.lifting-return.destroy', 'web', '2023-10-16 04:47:34', '2023-10-16 04:47:34'),
(253, 'admin.vendor-payment.create', 'web', '2023-10-16 09:19:38', '2023-10-16 09:19:38'),
(254, 'admin.vendor-payment.store', 'web', '2023-10-16 09:19:42', '2023-10-16 09:19:42'),
(255, 'admin.vendor-payment.edit', 'web', '2023-10-16 09:19:46', '2023-10-16 09:19:46'),
(256, 'admin.vendor-payment.update', 'web', '2023-10-16 09:19:51', '2023-10-16 09:19:51'),
(257, 'admin.vendor-payment.destroy', 'web', '2023-10-16 09:20:00', '2023-10-16 09:20:00'),
(258, 'admin.transfer.create', 'web', '2023-10-18 05:08:51', '2023-10-18 05:08:51'),
(259, 'admin.transfer.store', 'web', '2023-10-18 05:09:01', '2023-10-18 05:09:01'),
(260, 'admin.transfer.edit', 'web', '2023-10-18 05:09:05', '2023-10-18 05:09:05'),
(261, 'admin.transfer.update', 'web', '2023-10-18 05:09:22', '2023-10-18 05:09:22'),
(262, 'admin.transfer.destroy', 'web', '2023-10-18 05:09:29', '2023-10-18 05:09:29'),
(263, 'admin.transfer-receive.show', 'web', '2023-10-18 09:47:14', '2023-10-18 09:47:14'),
(264, 'admin.transfer-receive.edit', 'web', '2023-10-18 09:47:49', '2023-10-18 09:47:49'),
(265, 'admin.transfer-receive.destroy', 'web', '2023-10-18 09:48:01', '2023-10-18 09:48:01'),
(266, 'admin.return-approve.show', 'web', '2023-10-18 12:04:48', '2023-10-18 12:04:48'),
(267, 'admin.return-approve.edit', 'web', '2023-10-18 12:05:03', '2023-10-18 12:05:03'),
(268, 'admin.return-approve.destroy', 'web', '2023-10-18 12:05:12', '2023-10-18 12:05:12');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
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
  `ctn_size` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `check_stock` tinyint(4) NOT NULL DEFAULT 0,
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

INSERT INTO `products` (`id`, `company_id`, `vendor_id`, `attribute_id`, `category_id`, `brand_id`, `name`, `code`, `slug`, `thumbnail`, `more_images`, `short_description`, `description`, `additional_info`, `meta_title`, `meta_description`, `meta_keyword`, `alert_quantity`, `min_order`, `max_order`, `video`, `video_id`, `ctn_size`, `status`, `check_stock`, `show_on_website`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(12, 0, 1, 1, 5, NULL, 'Curly Fries', '24322', 'curly-fries-2', 'media/product/2023-10-23-6mInR4K4wsU82I5Q6oWEypoIwbUSQlHuZJiJcRpz.webp', 'media/product/2023-10-23-3f1VCvyzE5F0FbFniH94JF4BjtodTBAOKeCr1bVP.webp', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, 0, 1, 1, 1, 1, NULL, NULL, '2023-10-16 03:55:40', '2023-10-23 08:11:44'),
(13, 1, 1, 1, 5, NULL, 'Premium Wedges', '24Q', 'premium-wedges', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 03:56:41', '2023-10-16 03:56:41'),
(14, 1, 1, 1, 5, NULL, 'French Fries', 'A-60', 'french-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 03:57:31', '2023-10-16 03:57:31'),
(15, 1, 1, 1, 5, NULL, 'Hash Brown', 'B03', 'hash-brown', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:02:02', '2023-10-16 04:02:02'),
(16, 1, 1, 1, 5, NULL, '3/8 cut french Fries', 'C0005', '38-cut-french-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:02:56', '2023-10-16 04:02:56'),
(17, 1, 1, 1, 5, NULL, 'LB Original Wedges', 'C27', 'lb-original-wedges', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:06:50', '2023-10-16 04:06:50'),
(18, 1, 1, 1, 5, NULL, 'Criss Cut', 'D23', 'criss-cut', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:07:38', '2023-10-16 04:07:38'),
(19, 0, 1, 1, 5, NULL, 'Crispy Potato Wedges', 'E24', 'crispy-potato-wedges', 'media/product/2023-10-23-yFGdDxFjtkIIsoxeRnB5rQAaDDj6OEv2mx5MYaJZ.webp', 'media/product/2023-10-23-NAjzaptJIu3a0WcCpRjDBddi1jOtrJeNNx1ncCyr.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:08:18', '2023-10-23 08:11:23'),
(20, 1, 1, 1, 5, NULL, 'Non Coated Fries(Private reserve)', 'F62GL', 'non-coated-friesprivate-reserve', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:09:02', '2023-10-16 04:09:02'),
(21, 1, 1, 1, 5, NULL, '6mm Unsalted French Fries', 'F82 GL', '6mm-unsalted-french-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:09:43', '2023-10-16 04:09:43'),
(22, 1, 1, 1, 5, NULL, 'Lattice Chips', 'F82 GL', 'lattice-chips', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:10:19', '2023-10-16 04:10:19'),
(23, 0, 1, 1, 5, NULL, 'Coated French Fries', 'H 72', 'coated-french-fries', 'media/product/2023-10-23-vLrkTJ8gtOtTNY9RXsy4edCVeqgeisC0qy5VfaQ9.webp', 'media/product/2023-10-23-E4cwFBn83d5WzTzt3KtP3KmMQ86kjlzvWyuGMTEN.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:12:01', '2023-10-23 08:09:59'),
(24, 1, 1, 1, 5, NULL, 'Coated French Fries', 'H 79', 'coated-french-fries-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:12:31', '2023-10-16 04:12:31'),
(25, 1, 1, 1, 5, NULL, 'Round Hash Brown (Rosti)', 'LWS95', 'round-hash-brown-rosti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:13:36', '2023-10-16 04:13:36'),
(26, 0, 1, 1, 5, NULL, 'Coated French Fries (6mm)', 'M001', 'coated-french-fries-6mm', 'media/product/2023-10-23-OGXsVTm9i95tbhLL5PdpGOsylcmxlIDXv3JPmBQF.webp', 'media/product/2023-10-23-vczOFk6azfXIhw182LmW5Xyg1L0pmOjZUUlhgBGh.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:14:13', '2023-10-23 08:10:23'),
(27, 1, 1, 1, 5, NULL, 'Coated French Fries (9mm)', 'M002', 'coated-french-fries-9mm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:14:46', '2023-10-16 04:14:46'),
(28, 0, 1, 1, 5, NULL, 'Mondelle Coated French Fries (7mm)', 'M003', 'mondelle-coated-french-fries-7mm', 'media/product/2023-10-23-ITCrFBR7BknZOAWdMHBxWCFpl6EyI4L8KjZ53yK1.webp', 'media/product/2023-10-23-9mw9bryv1JkCrCfxYBnG34U1gF1W7IBHjNVaNg3d.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:15:32', '2023-10-23 08:13:26'),
(29, 1, 1, 1, 5, NULL, 'Crispy 2 go 10*10 mm Fries', 'M005', 'crispy-2-go-1010-mm-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:16:04', '2023-10-16 04:16:04'),
(30, 1, 1, 1, 5, NULL, 'Crispy 2 go 7*7 mm Fries', 'M007', 'crispy-2-go-77-mm-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:16:43', '2023-10-16 04:16:43'),
(31, 0, 1, 1, 5, NULL, 'Maestro Round Hash Brown', 'MRosti', 'maestro-round-hash-brown', 'media/product/2023-10-23-YA90eiRUBwA9gr1zYbnovHitu8arClvlOq2MHHnm.webp', 'media/product/2023-10-23-FmhdD7jFccWBknfX8GHkC6ObYvw9CHT3xKyJY3Lh.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:20:47', '2023-10-23 08:12:40'),
(32, 0, 1, 1, 5, NULL, 'Maestro Spicy Wedges', 'MW10', 'maestro-spicy-wedges', 'media/product/2023-10-23-wiV4GLx4b1JyFN032Vt3sOBsfe2dV48Gpw8peBCT.webp', 'media/product/2023-10-23-KXQQJhUW58g7rVb5r3nou4Y6dAysIyJoCYPsPPKb.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:21:15', '2023-10-23 08:20:23'),
(33, 0, 1, 1, 5, NULL, 'Mondelle Spicy Wedges', 'MW30', 'mondelle-spicy-wedges', 'media/product/2023-10-23-upow4nlqeiAPdMvdA97vPcHZL2MqzDpTRBhr10N3.webp', 'media/product/2023-10-23-2C2GGekEXv2O3WDrZyq4GNRWevtfxgSEoCZgG5Ep.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:21:55', '2023-10-23 08:15:16'),
(34, 0, 1, 1, 5, NULL, 'Premium French Fries', 'S0032', 'premium-french-fries', 'media/product/2023-10-23-aH6clAoI2KdQxhcWJHKnCs5NDvmgOEdi6YXAHbQL.webp', 'media/product/2023-10-23-QuE5a8vfhxWndU9c4og59wjHr74wQ2kkVglfX7GE.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:22:33', '2023-10-23 08:15:43'),
(35, 0, 1, 1, 5, NULL, '11 mm stealth French Fries', 'S0049', '11-mm-stealth-french-fries', 'media/product/2023-10-23-9CzJp4FpuEhK27ZGVupVeRuqr13VJWbf4yoKOxUp.webp', 'media/product/2023-10-23-LfbrIQPVhTrXinNhss771wPpfNHmLYuCbTFtLlBL.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:23:02', '2023-10-23 08:09:03'),
(36, 0, 1, 1, 5, NULL, '6mm Stealth French Fries', 'S02GL', '6mm-stealth-french-fries', 'media/product/2023-10-23-13TBh5EtiD5XOKmVpxBrODjpMrMi7FxGs8QQdmhK.webp', 'media/product/2023-10-23-j7hM2e8j2njskvEplmh5hcrhsaQmTmbAwVd09ej2.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:23:44', '2023-10-23 08:09:34'),
(37, 1, 1, 1, 5, NULL, '3/8\" Stealth French Fries', 'S04GL', '38-stealth-french-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:24:18', '2023-10-16 04:24:18'),
(38, 1, 1, 1, 5, NULL, 'Crinkle Cut Fries', 'S22', 'crinkle-cut-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:24:42', '2023-10-16 04:24:42'),
(39, 1, 1, 1, 5, NULL, '3/8 Regular Cut French Fries', 'S57', '38-regular-cut-french-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:25:47', '2023-10-16 04:25:47'),
(40, 1, 1, 1, 5, NULL, 'Tri Patties (Hash Brown)', 'S63', 'tri-patties-hash-brown', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:26:15', '2023-10-16 04:26:15'),
(41, 1, 1, 1, 5, NULL, '3/8\'\' Coated French Fries', 'SB 40', '38-coated-french-fries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:26:54', '2023-10-16 04:26:54'),
(42, 1, 1, 1, 5, NULL, 'Potato wedges', 'W01 GL', 'potato-wedges', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:27:26', '2023-10-16 04:27:26'),
(43, 0, 1, 1, 7, NULL, 'Banvit Chicken Nuggets (bulk)', 'BCN', 'banvit-chicken-nuggets-bulk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:31:16', '2023-10-23 06:41:21'),
(44, 0, 1, 1, 7, NULL, 'Chicken Dumpling', 'C Dumpling', 'chicken-dumpling', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:31:51', '2023-10-23 06:42:25'),
(45, 1, 1, 1, 7, NULL, 'Frozen Breast SC', 'C001', 'frozen-breast-sc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:32:22', '2023-10-16 04:32:22'),
(46, 0, 1, 1, 7, NULL, 'Frozen Leg SC', 'C002', 'frozen-leg-sc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:33:01', '2023-10-23 06:44:58'),
(47, 0, 1, 1, 7, NULL, 'Chicken Ball', 'CB', 'chicken-ball', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:33:44', '2023-10-23 06:41:59'),
(48, 0, 1, 1, 8, NULL, 'Chicken Ball-W', 'CB-W', 'chicken-ball-w', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:34:12', '2023-10-23 06:39:50'),
(49, 0, 1, 1, 7, NULL, 'Chicken Momo', 'C-Momo', 'chicken-momo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:34:58', '2023-10-23 06:44:01'),
(50, 1, 1, 1, 7, NULL, 'Frank Cheese (340g)', 'Doux Cheese', 'frank-cheese-340g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:36:28', '2023-10-16 04:36:28'),
(51, 0, 1, 1, 7, NULL, 'Chicken Frank, Garlic (340g)', 'Duox Garlic', 'chicken-frank-garlic-340g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:37:03', '2023-10-23 06:43:25'),
(52, 0, 1, 1, 7, NULL, 'Chicken frank-hot & spice, 340g', 'Duox H/S', 'chicken-frank-hot-spice-340g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:37:52', '2023-10-23 06:43:06'),
(53, 0, 1, 1, 7, NULL, 'Chicken Frank Original(340g)', 'Duox original', 'chicken-frank-original340g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:38:51', '2023-10-23 06:42:47'),
(54, 0, 1, 1, 7, NULL, 'Chicken Frank, Smoke(340g)', 'Duox Smoke', 'chicken-frank-smoke340g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:39:33', '2023-10-23 06:43:44'),
(55, 0, 1, 1, 7, NULL, 'Frozen Chicken Wing', 'FCW', 'frozen-chicken-wing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:40:21', '2023-10-23 06:44:39'),
(56, 0, 1, 1, 7, NULL, '10 pcs (350 gram )', 'Jodi', '10-pcs-350-gram', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:40:57', '2023-10-23 06:40:42'),
(57, 0, 1, 1, 7, NULL, 'Lezita Chicken Frank', 'LCF', 'lezita-chicken-frank', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:41:37', '2023-10-23 06:45:20'),
(58, 0, 1, 1, 7, NULL, 'Lezita Chiken Nuggets 600 gm', 'LCN 600', 'lezita-chiken-nuggets-600-gm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:43:17', '2023-10-23 06:46:26'),
(59, 0, 1, 1, 7, NULL, 'Lezita Chicken Nugget', 'LCN-1000', 'lezita-chicken-nugget', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:43:48', '2023-10-23 06:45:39'),
(60, 0, 1, 1, 7, NULL, 'Lezita Chicken Nuggets 260gm', 'LCN-260', 'lezita-chicken-nuggets-260gm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:44:19', '2023-10-23 06:46:02'),
(61, 0, 1, 1, 7, NULL, 'Mondy Chicken Frank ( Sausage)', 'MCF', 'mondy-chicken-frank-sausage', 'media/product/2023-10-23-vuRLAilMDZS9NHT9QUERpn1nhPR2khVCb0B1gSSt.webp', 'media/product/2023-10-23-Upt4YuhC45pvYcCFldoX2lx47S3ghOMfKf8WAZ6q.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:45:13', '2023-10-23 08:16:25'),
(62, 0, 1, 1, 7, NULL, 'Mondy Chicken Nuggets', 'MCN', 'mondy-chicken-nuggets', 'media/product/2023-10-23-zZrju5xCArAxB0Rtl4DWS9hAf8qEjPf2SCaXufwX.webp', 'media/product/2023-10-23-6ReaU4v78LcKygCeuwZBSeWSUqYqfmcuFPkTIGol.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:45:38', '2023-10-23 08:16:46'),
(63, 0, 1, 1, 7, NULL, 'Mondy Chicken  Frank ( Sausage)', 'MCS', 'mondy-chicken-frank-sausage-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:46:14', '2023-10-23 06:46:46'),
(64, 0, 1, 1, 7, NULL, 'Chicken Nuggets (Q)', 'QCN', 'chicken-nuggets-q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:46:48', '2023-10-23 06:44:20'),
(65, 0, 1, 1, 9, NULL, 'Koral Black 5 Kg', 'Koral Black', 'koral-black-5-kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 04:48:05', '2023-10-23 06:49:30'),
(66, 1, 1, 1, 9, NULL, 'Koral Red 2 kg+', 'Koral -Red', 'koral-red-2-kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:48:41', '2023-10-16 04:48:41'),
(67, 1, 1, 1, 9, NULL, 'Rupchanda 200g-300g', 'Rupchanda-M', 'rupchanda-200g-300g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:49:13', '2023-10-16 04:49:13'),
(68, 1, 1, 1, 9, NULL, 'Srimp-Medium', 'Srimp-M', 'srimp-medium', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:49:51', '2023-10-16 04:49:51'),
(69, 1, 1, 1, 6, NULL, 'Sweet Corn ( Cut)', 'V5299', 'sweet-corn-cut', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:51:58', '2023-10-16 04:51:58'),
(70, 1, 1, 1, 6, NULL, 'American Green Pease', 'V5292', 'american-green-pease', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:52:50', '2023-10-16 04:52:50'),
(71, 1, 1, 1, 6, NULL, 'Cob Corn', 'V5290', 'cob-corn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:53:19', '2023-10-16 04:53:19'),
(72, 1, 1, 1, 6, NULL, 'Sweet corn  ( cut)', 'V5042', 'sweet-corn-cut-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:53:50', '2023-10-16 04:53:50'),
(73, 1, 1, 1, 5, NULL, 'Balance upto 30th june-18', 'Old Product', 'balance-upto-30th-june-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:55:37', '2023-10-16 04:55:37'),
(74, 1, 1, 1, 6, NULL, 'Sweet corn cut', 'Euro Corn', 'sweet-corn-cut-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:58:49', '2023-10-16 04:58:49'),
(75, 1, 1, 1, 6, NULL, 'Frozen Baby Corn', 'I-Baby Corn', 'frozen-baby-corn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 04:59:39', '2023-10-16 04:59:39'),
(76, 1, 1, 1, 6, NULL, 'Frozen Cob Corn', 'I-Cob Corn', 'frozen-cob-corn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:00:19', '2023-10-16 05:00:19'),
(77, 1, 1, 1, 6, NULL, 'Frozen Green Peas', 'I-Green Peas', 'frozen-green-peas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:00:51', '2023-10-16 05:00:51'),
(78, 0, 1, 1, 6, NULL, 'Frozen Sweet Corn M Cut', 'I-M Cut', 'frozen-sweet-corn-m-cut', 'media/product/2023-10-23-9gOk5wRj4mHOxZ5GGs4sUbzol00P5SjpAmDj1BGb.webp', 'media/product/2023-10-23-TwO24UCKxx8u9GTnK4frIMHm7fH9aXpFrhZUmHfm.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 05:01:21', '2023-10-23 08:18:21'),
(79, 1, 1, 1, 6, NULL, 'Frozen Whole Kernel Corn', 'I-Whole Kernel', 'frozen-whole-kernel-corn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:01:48', '2023-10-16 05:01:48'),
(80, 1, 1, 1, 8, NULL, 'Parmesion Cheese', 'Parmesion', 'parmesion-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:06:57', '2023-10-16 05:06:57'),
(81, 1, 1, 1, 8, NULL, 'Pizzarollo Block Cheese', 'Pizza Bl', 'pizzarollo-block-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:07:27', '2023-10-16 05:07:27'),
(82, 0, 1, 1, 8, NULL, 'Pizzarollo Shredded Cheese', 'Pizza Shr', 'pizzarollo-shredded-cheese', 'media/product/2023-10-23-8z2tuq1tUCvNjo1ENKIgatiG8nkeWUxdut8aYuN4.webp', 'media/product/2023-10-23-yA2q8q7p0bpqPyCMni4Oj80ayNo702niGoLbqB0j.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 05:08:13', '2023-10-23 08:07:48'),
(83, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-10 PCS', 'mondy-burger-slice-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:09:19', '2023-10-16 05:09:19'),
(84, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-10 Pcs (Y)', 'mondy-burger-slice-cheese-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:09:53', '2023-10-16 05:09:53'),
(85, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-108 Pcs', 'mondy-burger-slice-cheese-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:10:33', '2023-10-16 05:10:33'),
(86, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-184 Pcs (Y)', 'mondy-burger-slice-cheese-4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:11:09', '2023-10-16 05:11:09'),
(87, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-184 Pcs(W)', 'mondy-burger-slice-cheese-5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:11:46', '2023-10-16 05:11:46'),
(88, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-24 Pcs', 'mondy-burger-slice-cheese-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:12:21', '2023-10-16 05:12:21'),
(89, 1, 1, 1, 8, NULL, 'Mondy Burger Slice Cheese', 'MS-24 Pcs (Y)', 'mondy-burger-slice-cheese-7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:12:56', '2023-10-16 05:12:56'),
(90, 0, 1, 1, 8, NULL, 'Mozzarollo Shredded Cheese', 'Mozza Shr', 'mozzarollo-shredded-cheese', 'media/product/2023-10-18-BjZKGPG5SkCBd3SYYHS7LBECtqzF8hx6fqmSoXyi.webp', 'media/product/2023-10-18-yweT82ygf0irkSVGtfaTmaQ0KrK2rpSUqnsp5lix.webp|media/product/2023-10-18-egPreCJ1PRvTt3Fj90Lf4Bl7ypAOx5yzUlWlYPmX.webp|media/product/2023-10-18-CXGhckDgYSq7Q8oSL1SnIVPXTQwkrWjsg8NsARQ6.webp|media/product/2023-10-18-RqJ6mabUWNih3mvv5hT47KOPZpNuVtPJPlLynYhA.webp|media/product/2023-10-18-F6KosjDCp9yzfNTJKuJOPHGJ6caQUK6CRMGwunml.webp|media/product/2023-10-18-0xVvHwPAjlllcSDrOaX90ZymBjv3p7ZrjyIw4S2q.webp|media/product/2023-10-18-6hLiJVz5DQj5WaHzB03RblT0Ls8W6mI9XI5Zuek3.webp|media/product/2023-10-18-5CgnzN5eATIlXz5GGHLdtbnXzqYxVkg7w6UUj8bF.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 05:17:10', '2023-10-18 10:55:37'),
(91, 1, 1, 1, 8, NULL, 'Mozzarollo Block Cheese', 'Mozz Bl', 'mozzarollo-block-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:17:45', '2023-10-16 05:17:45'),
(92, 1, 1, 1, 8, NULL, 'Mozzarella Block cheese-1 kg', 'LBC', 'mozzarella-block-cheese-1-kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:19:25', '2023-10-16 05:19:25'),
(93, 1, 1, 1, 8, NULL, 'Mozzarella Cheese (Roll)', 'M Roll', 'mozzarella-cheese-roll', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:20:05', '2023-10-16 05:20:05'),
(94, 1, 1, 1, 8, NULL, 'Melborn Slice Cheese', 'MEL84', 'melborn-slice-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:20:45', '2023-10-16 05:20:45'),
(95, 1, 1, 1, 8, NULL, 'Three cow Mozzarella cheese', '3 CC', 'three-cow-mozzarella-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:21:40', '2023-10-16 05:21:40'),
(96, 0, 1, 1, 8, NULL, 'Anchor Burger Slices Cheese White', 'ABS- W84', 'anchor-burger-slices-cheese-white', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, 1, NULL, NULL, '2023-10-16 05:22:15', '2023-10-23 06:35:39'),
(97, 1, 1, 1, 8, NULL, 'Anchor Burger Slices Cheese Yellow', 'ABS- Y84', 'anchor-burger-slices-cheese-yellow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:22:56', '2023-10-16 05:22:56'),
(98, 1, 1, 1, 8, NULL, 'Local Mozzarella Cheese', 'C-Ball', 'local-mozzarella-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:23:28', '2023-10-16 05:23:28'),
(99, 1, 1, 1, 8, NULL, 'Fastaurant Mozzarella Cheese-1 kg', 'FMC', 'fastaurant-mozzarella-cheese-1-kg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:24:04', '2023-10-16 05:24:04'),
(100, 1, 1, 1, 8, NULL, 'Grandor Mozzarella  Cheese', 'GMSC', 'grandor-mozzarella-cheese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:24:37', '2023-10-16 05:24:37'),
(101, 1, 1, 1, 8, NULL, 'HochLand Burrger slice', 'HBS-84', 'hochland-burrger-slice', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 1, 0, 1, NULL, NULL, NULL, '2023-10-16 05:25:09', '2023-10-16 05:25:09'),
(102, 0, 1, 1, 8, NULL, 'Happy Velly Slice Cheese', 'HVSC', 'happy-velly-slice-cheese', 'media/product/2023-10-19-OZ7clDg9Gr39kXiiPvKdhacaBz7xOcM01qbacoI7.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, 0, 0, 1, 1, NULL, NULL, '2023-10-16 05:25:38', '2023-10-19 07:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_price` double(8,2) NOT NULL,
  `sale_price` double(8,2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `discount_tk` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `lifting_price`, `sale_price`, `discount`, `discount_tk`, `created_at`, `updated_at`) VALUES
(3, 12, 1.00, 1.00, 0, 0.00, '2023-10-16 03:55:40', '2023-10-23 08:11:44'),
(4, 13, 0.00, 0.00, 0, 0.00, '2023-10-16 03:56:41', '2023-10-16 03:56:41'),
(5, 14, 0.00, 0.00, 0, 0.00, '2023-10-16 03:57:31', '2023-10-16 03:57:31'),
(6, 15, 0.00, 0.00, 0, 0.00, '2023-10-16 04:02:02', '2023-10-16 04:02:02'),
(7, 16, 0.00, 0.00, 0, 0.00, '2023-10-16 04:02:56', '2023-10-16 04:02:56'),
(8, 17, 0.00, 0.00, 0, 0.00, '2023-10-16 04:06:50', '2023-10-16 04:06:50'),
(9, 18, 0.00, 0.00, 0, 0.00, '2023-10-16 04:07:38', '2023-10-16 04:07:38'),
(10, 19, 0.00, 0.00, 0, 0.00, '2023-10-16 04:08:18', '2023-10-23 08:11:23'),
(11, 20, 0.00, 0.00, 0, 0.00, '2023-10-16 04:09:02', '2023-10-16 04:09:02'),
(12, 21, 0.00, 0.00, 0, 0.00, '2023-10-16 04:09:43', '2023-10-16 04:09:43'),
(13, 22, 0.00, 0.00, 0, 0.00, '2023-10-16 04:10:19', '2023-10-16 04:10:19'),
(14, 23, 0.00, 0.00, 0, 0.00, '2023-10-16 04:12:01', '2023-10-23 08:09:59'),
(15, 24, 0.00, 0.00, 0, 0.00, '2023-10-16 04:12:31', '2023-10-16 04:12:31'),
(16, 25, 0.00, 0.00, 0, 0.00, '2023-10-16 04:13:36', '2023-10-16 04:13:36'),
(17, 26, 0.00, 0.00, 0, 0.00, '2023-10-16 04:14:13', '2023-10-23 08:10:23'),
(18, 27, 0.00, 0.00, 0, 0.00, '2023-10-16 04:14:46', '2023-10-16 04:14:46'),
(19, 28, 0.00, 0.00, 0, 0.00, '2023-10-16 04:15:32', '2023-10-23 08:13:26'),
(20, 29, 0.00, 0.00, 0, 0.00, '2023-10-16 04:16:04', '2023-10-16 04:16:04'),
(21, 30, 0.00, 0.00, 0, 0.00, '2023-10-16 04:16:43', '2023-10-16 04:16:43'),
(22, 31, 0.00, 0.00, 0, 0.00, '2023-10-16 04:20:47', '2023-10-23 08:12:40'),
(23, 32, 0.00, 0.00, 0, 0.00, '2023-10-16 04:21:15', '2023-10-23 08:20:23'),
(24, 33, 0.00, 0.00, 0, 0.00, '2023-10-16 04:21:55', '2023-10-23 08:15:16'),
(25, 34, 0.00, 0.00, 0, 0.00, '2023-10-16 04:22:33', '2023-10-23 08:15:43'),
(26, 35, 0.00, 0.00, 0, 0.00, '2023-10-16 04:23:02', '2023-10-23 08:09:03'),
(27, 36, 0.00, 0.00, 0, 0.00, '2023-10-16 04:23:44', '2023-10-23 08:09:34'),
(28, 37, 0.00, 0.00, 0, 0.00, '2023-10-16 04:24:18', '2023-10-16 04:24:18'),
(29, 38, 0.00, 0.00, 0, 0.00, '2023-10-16 04:24:42', '2023-10-16 04:24:42'),
(30, 39, 0.00, 0.00, 0, 0.00, '2023-10-16 04:25:47', '2023-10-16 04:25:47'),
(31, 40, 0.00, 0.00, 0, 0.00, '2023-10-16 04:26:15', '2023-10-16 04:26:15'),
(32, 41, 0.00, 0.00, 0, 0.00, '2023-10-16 04:26:54', '2023-10-16 04:26:54'),
(33, 42, 0.00, 0.00, 0, 0.00, '2023-10-16 04:27:26', '2023-10-16 04:27:26'),
(34, 43, 0.00, 0.00, 0, 0.00, '2023-10-16 04:31:16', '2023-10-23 06:41:21'),
(35, 44, 0.00, 0.00, 0, 0.00, '2023-10-16 04:31:51', '2023-10-23 06:42:25'),
(36, 45, 0.00, 0.00, 0, 0.00, '2023-10-16 04:32:22', '2023-10-16 04:32:22'),
(37, 46, 0.00, 0.00, 0, 0.00, '2023-10-16 04:33:01', '2023-10-23 06:44:58'),
(38, 47, 0.00, 0.00, 0, 0.00, '2023-10-16 04:33:44', '2023-10-23 06:41:59'),
(39, 48, 0.00, 0.00, 0, 0.00, '2023-10-16 04:34:12', '2023-10-23 06:39:50'),
(40, 49, 0.00, 0.00, 0, 0.00, '2023-10-16 04:34:58', '2023-10-23 06:44:01'),
(41, 50, 0.00, 0.00, 0, 0.00, '2023-10-16 04:36:28', '2023-10-16 04:36:28'),
(42, 51, 0.00, 0.00, 0, 0.00, '2023-10-16 04:37:03', '2023-10-23 06:43:25'),
(43, 52, 0.00, 0.00, 0, 0.00, '2023-10-16 04:37:52', '2023-10-23 06:43:06'),
(44, 53, 0.00, 0.00, 0, 0.00, '2023-10-16 04:38:51', '2023-10-23 06:42:47'),
(45, 54, 0.00, 0.00, 0, 0.00, '2023-10-16 04:39:33', '2023-10-23 06:43:44'),
(46, 55, 0.00, 0.00, 0, 0.00, '2023-10-16 04:40:21', '2023-10-23 06:44:39'),
(47, 56, 0.00, 0.00, 0, 0.00, '2023-10-16 04:40:57', '2023-10-23 06:40:42'),
(48, 57, 0.00, 0.00, 0, 0.00, '2023-10-16 04:41:37', '2023-10-23 06:45:20'),
(49, 58, 0.00, 0.00, 0, 0.00, '2023-10-16 04:43:17', '2023-10-23 06:46:26'),
(50, 59, 0.00, 0.00, 0, 0.00, '2023-10-16 04:43:48', '2023-10-23 06:45:39'),
(51, 60, 0.00, 0.00, 0, 0.00, '2023-10-16 04:44:19', '2023-10-23 06:46:02'),
(52, 61, 0.00, 0.00, 0, 0.00, '2023-10-16 04:45:13', '2023-10-23 08:16:25'),
(53, 62, 0.00, 0.00, 0, 0.00, '2023-10-16 04:45:38', '2023-10-23 08:16:46'),
(54, 63, 0.00, 0.00, 0, 0.00, '2023-10-16 04:46:14', '2023-10-23 06:46:46'),
(55, 64, 0.00, 0.00, 0, 0.00, '2023-10-16 04:46:48', '2023-10-23 06:44:20'),
(56, 65, 0.00, 0.00, 0, 0.00, '2023-10-16 04:48:05', '2023-10-23 06:49:30'),
(57, 66, 0.00, 0.00, 0, 0.00, '2023-10-16 04:48:41', '2023-10-16 04:48:41'),
(58, 67, 0.00, 0.00, 0, 0.00, '2023-10-16 04:49:13', '2023-10-16 04:49:13'),
(59, 68, 0.00, 0.00, 0, 0.00, '2023-10-16 04:49:51', '2023-10-16 04:49:51'),
(60, 69, 0.00, 0.00, 0, 0.00, '2023-10-16 04:51:58', '2023-10-16 04:51:58'),
(61, 70, 0.00, 0.00, 0, 0.00, '2023-10-16 04:52:50', '2023-10-16 04:52:50'),
(62, 71, 0.00, 0.00, 0, 0.00, '2023-10-16 04:53:19', '2023-10-16 04:53:19'),
(63, 72, 0.00, 0.00, 0, 0.00, '2023-10-16 04:53:50', '2023-10-16 04:53:50'),
(64, 73, 0.00, 0.00, 0, 0.00, '2023-10-16 04:55:37', '2023-10-16 04:55:37'),
(65, 74, 0.00, 0.00, 0, 0.00, '2023-10-16 04:58:49', '2023-10-16 04:58:49'),
(66, 75, 0.00, 0.00, 0, 0.00, '2023-10-16 04:59:39', '2023-10-16 04:59:39'),
(67, 76, 0.00, 0.00, 0, 0.00, '2023-10-16 05:00:19', '2023-10-16 05:00:19'),
(68, 77, 0.00, 0.00, 0, 0.00, '2023-10-16 05:00:51', '2023-10-16 05:00:51'),
(69, 78, 0.00, 0.00, 0, 0.00, '2023-10-16 05:01:21', '2023-10-23 08:18:21'),
(70, 79, 0.00, 0.00, 0, 0.00, '2023-10-16 05:01:48', '2023-10-16 05:01:48'),
(71, 80, 0.00, 0.00, 0, 0.00, '2023-10-16 05:06:57', '2023-10-16 05:06:57'),
(72, 81, 0.00, 0.00, 0, 0.00, '2023-10-16 05:07:27', '2023-10-16 05:07:27'),
(73, 82, 0.00, 0.00, 0, 0.00, '2023-10-16 05:08:13', '2023-10-23 08:07:48'),
(74, 83, 0.00, 0.00, 0, 0.00, '2023-10-16 05:09:19', '2023-10-16 05:09:19'),
(75, 84, 0.00, 0.00, 0, 0.00, '2023-10-16 05:09:53', '2023-10-16 05:09:53'),
(76, 85, 0.00, 0.00, 0, 0.00, '2023-10-16 05:10:33', '2023-10-16 05:10:33'),
(77, 86, 0.00, 0.00, 0, 0.00, '2023-10-16 05:11:09', '2023-10-16 05:11:09'),
(78, 87, 0.00, 0.00, 0, 0.00, '2023-10-16 05:11:46', '2023-10-16 05:11:46'),
(79, 88, 0.00, 0.00, 0, 0.00, '2023-10-16 05:12:21', '2023-10-16 05:12:21'),
(80, 89, 0.00, 0.00, 0, 0.00, '2023-10-16 05:12:56', '2023-10-16 05:12:56'),
(81, 90, 0.00, 0.00, 0, 0.00, '2023-10-16 05:17:10', '2023-10-18 10:55:37'),
(82, 91, 0.00, 0.00, 0, 0.00, '2023-10-16 05:17:45', '2023-10-16 05:17:45'),
(83, 92, 0.00, 0.00, 0, 0.00, '2023-10-16 05:19:25', '2023-10-16 05:19:25'),
(84, 93, 0.00, 0.00, 0, 0.00, '2023-10-16 05:20:05', '2023-10-16 05:20:05'),
(85, 94, 0.00, 0.00, 0, 0.00, '2023-10-16 05:20:45', '2023-10-16 05:20:45'),
(86, 95, 0.00, 0.00, 0, 0.00, '2023-10-16 05:21:40', '2023-10-16 05:21:40'),
(87, 96, 0.00, 0.00, 0, 0.00, '2023-10-16 05:22:15', '2023-10-23 06:35:39'),
(88, 97, 0.00, 0.00, 0, 0.00, '2023-10-16 05:22:56', '2023-10-16 05:22:56'),
(89, 98, 0.00, 0.00, 0, 0.00, '2023-10-16 05:23:28', '2023-10-16 05:23:28'),
(90, 99, 0.00, 0.00, 0, 0.00, '2023-10-16 05:24:04', '2023-10-16 05:24:04'),
(91, 100, 0.00, 0.00, 0, 0.00, '2023-10-16 05:24:37', '2023-10-16 05:24:37'),
(92, 101, 0.00, 0.00, 0, 0.00, '2023-10-16 05:25:09', '2023-10-16 05:25:09'),
(93, 102, 0.00, 0.00, 0, 0.00, '2023-10-16 05:25:38', '2023-10-19 03:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `ordered` int(11) NOT NULL DEFAULT 0,
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
(1, 1, 'DR', 'Dhaka Region', 'xxxxx', '1111', 'xxxxx@gmail.com', 'address will goes here', 1, 1, NULL, NULL, NULL, '2023-09-23 06:53:22', '2023-09-23 06:53:22'),
(2, 1, 'MYR', 'Mymensingh', 'xxxxx', '1111', 'xxx@xxxx.com', 'address will goes here', 1, 1, 1, NULL, NULL, '2023-09-23 06:53:58', '2023-09-24 04:15:14'),
(4, 1, 'prefix', 'store', 'Mosharraf Hossain', '01997316189', 'admin@gmail.com', 'address will goes here', 1, 1, NULL, 1, '2023-09-23 16:14:21', '2023-09-23 15:57:49', '2023-09-23 16:14:21'),
(5, 1, 'prefix', 'store', NULL, NULL, NULL, NULL, 1, 1, NULL, 1, '2023-09-23 16:14:14', '2023-09-23 16:14:06', '2023-09-23 16:14:14'),
(6, 1, 'CTGR', 'Chattogram', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:09:44', '2023-09-24 04:09:44'),
(7, 1, 'NBR', 'North Bengal', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:10:39', '2023-09-24 04:10:39'),
(8, 1, 'SBR', 'South Bengal', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:11:07', '2023-09-24 04:11:07'),
(9, 1, 'SR', 'Sylhet Region', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-24 04:12:29', '2023-09-24 04:12:29');

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
(2, NULL, 'Company', 'web', '2023-10-24 06:03:09', '2023-10-24 06:03:09');

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
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1),
(72, 2),
(73, 1),
(73, 2),
(74, 1),
(74, 2),
(75, 1),
(75, 2),
(76, 1),
(76, 2),
(78, 1),
(78, 2),
(80, 1),
(80, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(84, 1),
(84, 2),
(85, 1),
(85, 2),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(89, 1),
(89, 2),
(90, 1),
(90, 2),
(91, 1),
(91, 2),
(92, 1),
(92, 2),
(93, 1),
(93, 2),
(94, 1),
(94, 2),
(95, 1),
(95, 2),
(96, 1),
(96, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(104, 1),
(104, 2),
(105, 1),
(105, 2),
(106, 1),
(106, 2),
(107, 1),
(107, 2),
(108, 1),
(108, 2),
(109, 1),
(109, 2),
(110, 1),
(110, 2),
(111, 1),
(111, 2),
(112, 1),
(112, 2),
(113, 1),
(113, 2),
(114, 1),
(114, 2),
(115, 1),
(115, 2),
(116, 1),
(116, 2),
(117, 1),
(117, 2),
(118, 1),
(118, 2),
(119, 1),
(119, 2),
(120, 1),
(120, 2),
(121, 1),
(121, 2),
(122, 1),
(122, 2),
(123, 1),
(123, 2),
(124, 1),
(124, 2),
(125, 1),
(125, 2),
(126, 1),
(126, 2),
(127, 1),
(127, 2),
(128, 1),
(128, 2),
(129, 1),
(129, 2),
(130, 1),
(130, 2),
(131, 1),
(131, 2),
(132, 1),
(132, 2),
(133, 1),
(133, 2),
(134, 1),
(134, 2),
(135, 1),
(135, 2),
(136, 1),
(136, 2),
(137, 1),
(137, 2),
(138, 1),
(138, 2),
(139, 1),
(139, 2),
(140, 1),
(140, 2),
(141, 1),
(141, 2),
(142, 1),
(142, 2),
(143, 1),
(143, 2),
(144, 1),
(144, 2),
(145, 1),
(145, 2),
(146, 1),
(146, 2),
(147, 1),
(147, 2),
(148, 1),
(148, 2),
(149, 1),
(149, 2),
(150, 1),
(150, 2),
(151, 1),
(151, 2),
(152, 1),
(152, 2),
(153, 1),
(153, 2),
(154, 1),
(154, 2),
(155, 1),
(155, 2),
(156, 1),
(156, 2),
(157, 1),
(157, 2),
(158, 1),
(158, 2),
(159, 1),
(159, 2),
(160, 1),
(160, 2),
(161, 1),
(161, 2),
(162, 1),
(162, 2),
(163, 1),
(163, 2),
(164, 1),
(164, 2),
(165, 1),
(165, 2),
(166, 1),
(166, 2),
(167, 1),
(167, 2),
(168, 1),
(168, 2),
(169, 1),
(169, 2),
(170, 1),
(170, 2),
(171, 1),
(171, 2),
(172, 1),
(172, 2),
(173, 1),
(173, 2),
(174, 1),
(174, 2),
(175, 1),
(175, 2),
(176, 1),
(176, 2),
(177, 1),
(177, 2),
(178, 1),
(178, 2),
(179, 1),
(179, 2),
(180, 1),
(180, 2),
(181, 1),
(181, 2),
(182, 1),
(182, 2),
(183, 1),
(183, 2),
(184, 1),
(184, 2),
(185, 1),
(185, 2),
(186, 1),
(186, 2),
(187, 1),
(187, 2),
(188, 1),
(188, 2),
(189, 1),
(189, 2),
(190, 1),
(190, 2),
(191, 1),
(191, 2),
(192, 1),
(192, 2),
(193, 1),
(193, 2),
(194, 1),
(194, 2),
(195, 1),
(195, 2),
(196, 1),
(196, 2),
(197, 1),
(197, 2),
(198, 1),
(198, 2),
(199, 1),
(199, 2),
(200, 1),
(200, 2),
(201, 1),
(201, 2),
(202, 1),
(202, 2),
(203, 1),
(203, 2),
(204, 1),
(204, 2),
(205, 1),
(205, 2),
(206, 1),
(206, 2),
(207, 1),
(207, 2),
(208, 1),
(208, 2),
(209, 1),
(209, 2),
(210, 1),
(210, 2),
(211, 1),
(211, 2),
(212, 1),
(212, 2),
(213, 1),
(213, 2),
(214, 1),
(214, 2),
(215, 1),
(215, 2),
(216, 1),
(216, 2),
(217, 1),
(217, 2),
(218, 1),
(218, 2),
(219, 1),
(219, 2),
(220, 1),
(220, 2),
(221, 1),
(221, 2),
(222, 1),
(222, 2),
(223, 1),
(223, 2),
(224, 1),
(224, 2),
(225, 1),
(225, 2),
(226, 1),
(226, 2),
(227, 1),
(227, 2),
(228, 1),
(228, 2),
(229, 1),
(229, 2),
(230, 1),
(230, 2),
(231, 1),
(231, 2),
(232, 1),
(232, 2),
(233, 1),
(233, 2),
(234, 1),
(234, 2),
(235, 1),
(235, 2),
(236, 1),
(236, 2),
(237, 1),
(237, 2),
(238, 1),
(238, 2),
(239, 1),
(239, 2),
(240, 1),
(240, 2),
(241, 1),
(241, 2),
(242, 1),
(242, 2),
(243, 1),
(243, 2),
(244, 1),
(244, 2),
(245, 1),
(245, 2),
(246, 1),
(246, 2),
(247, 1),
(247, 2),
(248, 1),
(248, 2),
(249, 1),
(249, 2),
(250, 1),
(250, 2),
(251, 1),
(251, 2),
(252, 1),
(252, 2),
(253, 1),
(253, 2),
(254, 1),
(254, 2),
(255, 1),
(255, 2),
(256, 1),
(256, 2),
(257, 1),
(257, 2),
(258, 1),
(258, 2),
(259, 1),
(259, 2),
(260, 1),
(260, 2),
(261, 1),
(261, 2),
(262, 1),
(262, 2),
(263, 1),
(263, 2),
(264, 1),
(264, 2),
(265, 1),
(265, 2),
(266, 1),
(266, 2),
(267, 1),
(267, 2),
(268, 1),
(268, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `sales_type` varchar(255) NOT NULL,
  `total_amount` double NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `total_paid` double NOT NULL DEFAULT 0,
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
-- Table structure for table `sales_lists`
--

CREATE TABLE `sales_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` double NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `amount` double NOT NULL,
  `is_return` tinyint(4) NOT NULL DEFAULT 0,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `return_no` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount` double NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `approve_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reject` tinyint(4) NOT NULL DEFAULT 0,
  `reject_by` bigint(20) UNSIGNED DEFAULT NULL,
  `accounts_approve` tinyint(4) NOT NULL DEFAULT 0,
  `accounts_approve_by` bigint(20) UNSIGNED DEFAULT NULL,
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
  `sales_return_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sales_list_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` double NOT NULL,
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

INSERT INTO `settings` (`id`, `title`, `primary_mobile`, `secondary_mobile`, `primary_email`, `secondary_email`, `office_time`, `address`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `meta_image`, `google_map`, `favicon`, `logo`, `footer_logo`, `placeholder`, `facebook_page`, `facebook_group`, `youtube`, `twitter`, `linkedin`, `google`, `whatsapp`, `instagram`, `pinterest`, `banner_one`, `banner_one_link`, `banner_two`, `banner_two_link`, `created_at`, `updated_at`) VALUES
(1, 'Bonton Foods', '01997556677', '01997556688', 'admin@bontonfoods.com', 'info@bontonfoods.com', NULL, 'Suite # M-10, Level-10,  Gulfeshan Plaza, Moghbazar,  Dhaka-1217', NULL, NULL, NULL, NULL, 'media/default/2023-10-18-u2MZDmXdYvE5ZAkKTaCsqefdDNwq1eVX5zFMXMpu.webp', NULL, 'media/default/2023-10-18-HaU4ksnqjF804Y71eSfJCEhOxzFAXeTpIHPpB6IJ.webp', 'media/default/2023-10-15-a9o9GUoiyJWLhpwAJDWoyqhLWqHHG7xLVefQs2ay.webp', 'media/default/2023-10-18-b4zh7ASCPsNIf08hSEr2yoSS8swVh5EAk5d9KChV.webp', 'media/default/2023-10-18-fPfUe7FWbORgQR7F8BFMIKwi43hrBgPlEe0sjXvu.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-08 16:05:10', '2023-10-19 03:44:13');

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
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showcase_items`
--

INSERT INTO `showcase_items` (`id`, `title`, `thumbnail`, `short_description`, `slug`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A LARGE VARIETY OF PRODUCTS', 'media/showcase_items/2023-10-03-cajlbwBGJgRx6Vw2t31WPMI3XShALRNLriyMA16j.webp', '<p>We have the freshest foods with the best quality from the food industry segment.<br></p>', 'a-large-variety-of-products', 1, 1, '2023-10-03 16:00:30', '2023-10-03 16:00:30'),
(2, 'A LARGE VARIETY OF PRODUCTS', 'media/showcase_items/2023-10-03-RFPPB7LJNm6I5W9cTZ8pekbYU6xFYaRdikoFhxAk.webp', '<span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment.</span>', 'a-large-variety-of-products', 2, 1, '2023-10-03 16:07:44', '2023-10-03 16:10:45'),
(3, 'A LARGE VARIETY OF PRODUCTS', 'media/showcase_items/2023-10-03-jHTHdHYN6BG6632hlZcdPFb6saHuLyz3mMABLp2a.webp', '<p><span style=\"text-align: center;\">We have the freshest foods with the best quality from the food industry segment</span><br></p>', 'a-large-variety-of-products', 3, 1, '2023-10-03 16:11:28', '2023-10-03 16:11:28');

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
(2, NULL, NULL, 'media/slider/2023-10-03-VwwrHxI66FB1WEHfXmBFgBvaJVvpO08jU9DMr5MG.webp', 0, 1, '2023-10-03 11:09:43', '2023-10-19 05:03:44'),
(3, 'A Cycle of Scream as Posthuman Contingency Measure.', 'Dolorum accusantium unde nisi quidem quibusdam est reprehenderit।', 'media/slider/2023-10-04-S1CMcbUIIVpHHJgw3zbiHUvuXeEZM2llzgtgoUgi.webp', 1, 1, '2023-10-03 11:10:07', '2023-10-04 04:03:58');

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

--
-- Dumping data for table `social_works`
--

INSERT INTO `social_works` (`id`, `title`, `image`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'media/social_works/2023-10-04-QAVrsWbB6NRS1wlJtJ34siScGtEttPjxqgP3RNKa.webp', 1, 1, '2023-10-04 03:49:39', '2023-10-04 03:49:39'),
(2, NULL, 'media/social_works/2023-10-04-wJgEeGykqSqhcUhvfM2b2r78jNGQBFXYkO2AlbzM.webp', 2, 1, '2023-10-04 03:50:08', '2023-10-04 03:50:08'),
(3, NULL, 'media/social_works/2023-10-04-W52eABEvajXPfzMLtqHpFdIdavDXTawnEuVqNZ4n.webp', 3, 1, '2023-10-04 03:50:47', '2023-10-04 03:50:47'),
(4, NULL, 'media/social_works/2023-10-04-fuaYVs0LvgsvlIUX6XOd3MUDZsq22ZLFbBT4yQJE.webp', 4, 1, '2023-10-04 03:51:13', '2023-10-04 03:51:13'),
(5, NULL, 'media/social_works/2023-10-04-RovQtIVdF5yiGR87zdhnh3k05aH2tu7ATTL53zH6.webp', 5, 1, '2023-10-04 03:51:25', '2023-10-04 06:20:18'),
(6, NULL, 'media/social_works/2023-10-04-iz7cqgFKiOuZa47BsPsaiX25FuheMbXN8maOos8u.webp', 6, 1, '2023-10-04 03:51:51', '2023-10-04 03:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `special_food_items`
--

CREATE TABLE `special_food_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `serial` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_food_items`
--

INSERT INTO `special_food_items` (`id`, `name`, `image`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Beef', 'media/special_food_items/2023-10-03-wvXiDfTKfd7GOYNXZjOIF5Utn0OWXXb7ygrNFGfD.webp', 1, 1, '2023-10-03 11:50:32', '2023-10-03 12:22:55'),
(2, 'Prok', 'media/special_food_items/2023-10-03-xudTJ8aB5rUTqUBhxVVMmb27PzQyv1DaRFWeVmJ5.webp', 2, 1, '2023-10-03 12:23:24', '2023-10-03 12:23:24'),
(3, 'poultry', 'media/special_food_items/2023-10-03-N7bpgvWddp9y1u0i7QuO4KiuVuGC8P5NDPKqABrM.webp', 3, 1, '2023-10-03 12:23:49', '2023-10-03 12:23:49'),
(4, 'sea food', 'media/special_food_items/2023-10-03-dprmvCrWPIjmf2TtNT0n6vXB92EfJLGaMfu7rhvl.webp', 4, 1, '2023-10-03 12:24:22', '2023-10-03 12:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `staff` (`id`, `company_id`, `branch_id`, `store_id`, `code`, `name`, `short_name`, `designation`, `phone`, `address`, `email`, `national_id`, `joining_date`, `ac_no`, `ac_branch`, `type`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '01', 'Md. Abdul Motaleb', 'Motaleb', 'AGM- Finance & Admin', '01618003726', NULL, 'motaleb@bontoncompany.com', NULL, '2023-09-23', NULL, NULL, 'general', 1, 1, 1, NULL, NULL, '2023-09-23 15:03:40', '2023-10-19 10:02:03'),
(4, 1, 1, NULL, '02', 'Feroj Ahmad', 'Feroj', 'Manager- Accounts', '01618003712', NULL, 'feroj@bontoncompany.com', NULL, '2023-09-23', NULL, NULL, 'general', 1, 1, 1, NULL, NULL, '2023-09-23 16:31:41', '2023-10-19 10:02:38'),
(5, 1, 1, NULL, '03', 'Mohammad Naim Sad Masuk', 'Masuk', 'Senior Executive- Accounts', '01618003731', NULL, 'masuk@bontoncompany.com', NULL, '2023-09-23', NULL, NULL, 'general', 1, 1, 1, NULL, NULL, '2023-09-23 16:34:09', '2023-10-19 10:03:13'),
(6, 1, 1, NULL, '04', 'Hossain Mohammad Sohan', 'Sohan', 'Assistant Manager- Commercial', '01618003727', NULL, 'sohan@bontoncompany.com', NULL, '2023-09-23', NULL, NULL, 'general', 1, 1, 1, NULL, NULL, '2023-09-23 16:37:44', '2023-10-19 10:03:37'),
(7, 1, 1, NULL, '5', 'Nuha Akter', 'Nuha', 'Office Assistant', NULL, NULL, NULL, NULL, '2023-10-17', NULL, NULL, 'general', 1, 1, 1, NULL, NULL, '2023-10-17 16:09:30', '2023-10-19 10:04:21'),
(8, 1, 1, NULL, '6', 'Md. Azad Mia', 'Azad', 'AGM- Sales', '01618003700', NULL, 'azad@bontoncompany.com', NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, 1, NULL, NULL, '2023-10-19 10:00:51', '2023-10-19 10:04:35'),
(9, 1, 1, NULL, '7', 'Md. Lingkon Bhuiyan', 'Lingkon', 'Executive- Distribution', '01618003708', NULL, NULL, NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:05:44', '2023-10-19 10:05:44'),
(10, 1, 1, NULL, '8', 'Md. Monirul Islam', 'Monir', 'Executive- Sales Development', '01618003731', NULL, NULL, NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:10:05', '2023-10-19 10:10:05'),
(11, 1, 1, NULL, '9', 'Fahmida Akter', 'Fahmida', 'Senior Executive- CRM', '01618003702', NULL, 'cm1@bontoncompany.com', NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:11:20', '2023-10-19 10:11:20'),
(12, 1, 1, NULL, '10', 'Al Farabi', 'Anondo', 'Executive- Sales Development', '01618003714', NULL, NULL, NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:12:14', '2023-10-19 10:12:14'),
(13, 1, 1, NULL, '12', 'Md. Rakib Al Hasan', 'Rakib', 'Executive- Sales Development', '01618003722', NULL, NULL, NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, 1, NULL, NULL, '2023-10-19 10:13:03', '2023-10-22 06:25:15'),
(14, 1, 1, NULL, '12', 'Fatematuz Johara Mouna', 'Muna', 'Executive- CRM', '01618003703', NULL, 'cm2@bontoncompany.com', NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:14:36', '2023-10-19 10:14:36'),
(15, 1, 1, NULL, '13', 'Sifat Anika', 'Anika', 'Executive- Sales Development', '01618003705', NULL, 'cm1@bontoncompany.com', NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:31:33', '2023-10-19 10:31:33'),
(16, 1, 1, NULL, '14', 'Md. Shamim Reza', 'Shamim', 'Executive- Sales Development', NULL, NULL, NULL, NULL, '2023-10-19', NULL, NULL, 'sales', 1, 1, NULL, NULL, NULL, '2023-10-19 10:34:04', '2023-10-19 10:34:04'),
(17, 1, 1, NULL, '15', 'Mahmud Imran', 'Suvro', 'Manager- Operation', '01618003740', NULL, 'suvro@bontoncompany.com', NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:19:01', '2023-10-22 03:19:01'),
(18, 1, 1, NULL, '16', 'Md. Abdul Al Mamun', 'Mamun', 'Junior Enginner', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:20:09', '2023-10-22 03:20:09'),
(19, 1, 1, NULL, '17', 'Hasibur Rahman', 'Hasib', 'Store-In-Charge', '01618003718', NULL, 'hasib.bel@bontoncompany.com', NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:21:29', '2023-10-22 03:21:29'),
(20, 1, 1, NULL, '18', 'Md. Iqbal Hossain', 'Iqbal', 'Office- Logistic', '01618003741', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:22:37', '2023-10-22 03:22:37'),
(21, 1, 1, NULL, '19', 'MD. Selim Khan', 'Selim Khan', 'Assistant Store-In-Charge', '01618003743', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:25:18', '2023-10-22 03:25:18'),
(22, 1, 1, NULL, '20', 'Md. Robiul Islam', 'Robiul', 'Electrician', '01618003744', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:26:12', '2023-10-22 03:26:12'),
(23, 1, 1, NULL, '21', 'Jannat Akter', 'Jannat', 'Admin Assistant', '01618003745', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:27:19', '2023-10-22 03:27:19'),
(24, 1, 1, NULL, '22', 'Faheya Sultana', 'Eti', 'Office- Accounts & Admin', '01618003749', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 03:29:35', '2023-10-22 03:29:35'),
(25, 1, 1, NULL, '23', 'Md. Mofiz Uddin', 'Mofiz', 'Caretaker', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'general', 1, 1, NULL, NULL, NULL, '2023-10-22 04:31:37', '2023-10-22 04:31:37'),
(26, 1, 1, NULL, '24', 'Md. Serazul Islam', 'Lalon', 'Driver', '01618003713', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 06:23:51', '2023-10-22 06:23:51'),
(27, 1, 1, NULL, '25', 'Md. Abdullah', 'Abdullah', 'Driver', '01618003723', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 06:24:58', '2023-10-22 06:24:58'),
(28, 1, 1, NULL, '26', 'Md. Jafor', 'Jafor', 'Driver', '01618003711', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 06:27:12', '2023-10-22 06:27:12'),
(29, 1, 1, NULL, '26', 'Md. Afzal Hossain', 'Afzal', 'Driver', '01618003730', NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 06:28:08', '2023-10-22 06:28:08'),
(30, 1, 1, NULL, '27', 'Md. Mamun', 'Mamun', 'Driver', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 07:05:07', '2023-10-22 07:05:07'),
(31, 1, 1, NULL, '27', 'Md. Miraj', 'Miraj', 'Driver', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 07:05:42', '2023-10-22 07:05:42'),
(32, 1, 1, NULL, '28', 'Md. Rana Khan', 'Rana', 'Driver', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, NULL, NULL, NULL, '2023-10-22 07:06:26', '2023-10-22 07:06:26'),
(33, 1, 1, NULL, '29', 'Md. Amzad', 'Amzad', 'Driver', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'driver', 1, 1, 1, NULL, NULL, '2023-10-22 07:07:12', '2023-10-22 07:09:23'),
(34, 1, 1, NULL, '30', 'Md. Bodruzzaman', 'Bodruzzaman', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, 1, NULL, NULL, '2023-10-22 07:08:19', '2023-10-22 07:09:35'),
(35, 1, 1, NULL, '31', 'Mizanur Rahman', 'Mizan', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, NULL, NULL, NULL, '2023-10-22 07:10:10', '2023-10-22 07:10:10'),
(36, 1, 1, NULL, '32', 'Md. Deloar', 'Deloar', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, NULL, NULL, NULL, '2023-10-22 07:11:20', '2023-10-22 07:11:20'),
(37, 1, 1, NULL, '33', 'Md. Mostak', 'Mostak', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, NULL, NULL, NULL, '2023-10-22 07:11:56', '2023-10-22 07:11:56'),
(38, 1, 1, NULL, '34', 'Asraf', 'Asraf', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, NULL, NULL, NULL, '2023-10-22 07:12:32', '2023-10-22 07:12:32'),
(39, 1, 1, NULL, '35', 'Md. Jakaria', 'Jakaria', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, NULL, NULL, NULL, '2023-10-22 07:13:31', '2023-10-22 07:13:31'),
(40, 1, 1, NULL, '36', 'Md. Abdul Kadir', 'Kadir', 'Delivery Man', NULL, NULL, NULL, NULL, '2023-10-22', NULL, NULL, 'delivery_man', 1, 1, NULL, NULL, NULL, '2023-10-22 07:14:19', '2023-10-22 07:14:19');

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

--
-- Dumping data for table `static_site_items`
--

INSERT INTO `static_site_items` (`id`, `title`, `short_description`, `banner_title`, `testimonial_title`, `details_video_url`, `products_title`, `header_bg_image`, `banner_image`, `welcome_image`, `testimonial_image`, `x_separator_image`, `y_separator_image`, `shop_button_link`, `contact_button_link`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME TO BONTON FOODS', 'You are in the right place where you will find what you need for your restaurant at the best prices. The freshest products with the highest quality and excellent service. Explore our product collection and discover for yourself.', 'SHOP WITH US, RESTOCK YOUR INVENTORY QUICK & EASY.', 'ALWAYS, CLOSE TO YOU.', NULL, 'OUR PRODUCTS', 'media/site-items/2023-10-03-9y5Mr7QzwgDgS124p2bDNBJseSXgBVF1PLIHB9El.webp', 'media/site-items/2023-10-03-Ks3KztP2FkaALesdqsMBEf2YhsUoMmub42ehW07T.webp', 'media/site-items/2023-10-03-V43yN1ANy0ADg3S4NxQgZ75SNjxFxTiuaBhmHtNe.webp', 'media/site-items/2023-10-03-e5mGud9mdHnWZRF94nejSd7mpeciF352GxyfOvBX.webp', 'media/site-items/2023-10-03-8OfkG7MbLfPEphOtkQhn94iNtXQABRDrYLYiC13B.webp', 'media/site-items/2023-10-03-UqkuKHIPv4Q4l5ILV0Wc2kVRzpx8oPwRwYvJ1cF6.webp', 'http://localhost/technoparkbd/public/admin/site-item', 'http://localhost/technoparkbd/public/admin/site-item', '2023-10-03 10:59:56', '2023-10-19 04:45:08');

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
(1, 1, 1, 'HOS', 'Purchase Stock', 'Head Office Store', 'Suite # M-10, Level-10, Gulfeshan Plaza, Moghbazar, Dhaka-1217', 'vv', 1, 1, 1, 1, NULL, '2023-09-23 06:52:33', '2023-09-30 11:28:36');

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
(4, 1, 1, '01', 'Bashundhara City, Panthapath', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:16:31', '2023-09-23 16:26:05'),
(5, 1, 1, '02', 'Satmosjid Road', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:26:40', '2023-09-23 16:26:40'),
(6, 1, 1, '04', 'Mirpur Road', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:29:05', '2023-09-23 16:29:49'),
(7, 1, 5, '03', 'Gulshan', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:29:38', '2023-09-23 16:29:38'),
(8, 1, 6, '05', 'ECB, Kalshi, DOHS', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:30:17', '2023-09-23 16:30:17'),
(9, 1, 3, '06', 'Banasree,Rampura, Malibag', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:47:05', '2023-09-23 16:48:21'),
(10, 1, 3, '07', 'Khilgaon, Basabo', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:47:31', '2023-09-23 16:47:31'),
(11, 1, 3, '08', 'Shantinagar-Mogbazar-Baily Road', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:48:07', '2023-09-23 16:48:07'),
(12, 1, 10, '09', 'Palton-Motijheel-Wari', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:49:18', '2023-09-23 16:49:18'),
(13, 1, 10, '10', 'Police Plaza, Tejgaon, Mohakhali', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:50:46', '2023-09-23 16:50:46'),
(14, 1, 10, '11', 'Narayanganj-Munshiganj', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:51:42', '2023-09-24 04:28:52'),
(15, 1, 5, '12', 'Mohakhali, Banani', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:52:16', '2023-09-23 16:52:16'),
(16, 1, 4, '13', 'Uttara West Side', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:53:02', '2023-09-23 16:53:02'),
(17, 1, 4, '14', 'Uttara Eest Side', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:53:28', '2023-09-23 16:53:28'),
(18, 1, 10, '15', 'Dhaka General', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:54:02', '2023-09-23 16:54:02'),
(19, 1, 7, '16', 'Ctg Metro', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:54:27', '2023-09-23 16:54:27'),
(20, 1, 6, '17', 'Mirpur- 6- 11- 12, Pollabi', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:54:51', '2023-09-23 16:54:51'),
(21, 1, 6, '18', 'Mirpur- 10- 13- 14, Kochukhet', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:55:11', '2023-09-23 16:55:11'),
(22, 1, 8, '19', 'Newmarket', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:56:58', '2023-09-23 16:56:58'),
(23, 1, 11, '21', 'North Bangal', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:57:26', '2023-09-24 04:22:10'),
(24, 1, 12, '20', 'South Bangal', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:57:48', '2023-09-24 04:29:26'),
(25, 1, 13, '22', 'Sylhet', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:58:11', '2023-09-24 04:31:15'),
(26, 1, 7, '23', 'Chattogram', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:58:30', '2023-09-24 04:30:35'),
(27, 1, 6, '24', 'Mirpur- 1- 2- 60 Feet', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:59:00', '2023-09-23 16:59:00'),
(28, 1, 5, '25', 'Gulshan, Banani, Baridhara', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 16:59:23', '2023-09-23 16:59:23'),
(29, 1, 9, '26', 'Mymenshing- Kishoreganj', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 16:59:56', '2023-09-24 04:31:36'),
(30, 1, 7, '27', 'Comilla, Noakhali', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:00:20', '2023-09-23 17:00:20'),
(31, 1, 1, '28', 'Mirpur Road', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:02:29', '2023-09-23 17:02:29'),
(32, 1, 10, '29', 'Ashulia, Tongi, Gazipur', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 17:02:52', '2023-09-24 04:29:43'),
(33, 1, 5, '30', 'Dhalibari, Natunbazar', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:03:18', '2023-09-23 17:03:18'),
(34, 1, 10, '31', 'Kuril, JFP, Bashundhara', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:03:54', '2023-09-23 17:03:54'),
(35, 1, 1, '32', 'Shaymoli, Mohammadpur', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:04:23', '2023-09-23 17:04:23'),
(36, 1, 1, '33', 'Dhanmondi 27', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:05:12', '2023-09-23 17:05:12'),
(37, 1, 1, '34', 'Zigatola, Simanto Square', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:05:35', '2023-09-23 17:05:35'),
(38, 1, 10, '35', 'Banglamotor, Hatirpool, Elephant Road', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:05:59', '2023-09-23 17:05:59'),
(39, 1, 10, '36', 'Kallyanpur, Gabtoli, Savar', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:06:33', '2023-09-23 17:06:33'),
(40, 1, 10, '37', 'Shahjadpur, North Badda, Aftabnagar', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:07:08', '2023-09-23 17:07:08'),
(41, 1, 10, '38', 'Azimpur, Lalbag', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 17:07:34', '2023-09-23 17:07:52'),
(42, 1, 10, '39', 'Karwanbazar', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:08:16', '2023-09-23 17:08:16'),
(43, 1, 13, '40', 'Moulovi Bazar,', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, '2023-09-23 17:09:25', '2023-09-24 04:21:43'),
(44, 1, 10, '41', 'Old Dhaka', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:09:54', '2023-09-23 17:09:54'),
(45, 1, 4, '42', 'Nikunjo, Airport', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:10:14', '2023-09-23 17:10:14'),
(46, 1, 10, '43', 'Kaptanbazar-Jatrabari-Sonirakhra', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2023-09-23 17:10:36', '2023-09-23 17:10:36');

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

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `title`, `thumbnail`, `short_description`, `slug`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, 'QUALITY', 'media/testimonials/2023-10-04-Ku233uiWdHkItYEOM4K8wJinlnskfpbvwWxv0j5h.webp', '<p><span style=\"color: rgb(51, 65, 85); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium;\">We deliver the best. All our clients have the security and confidence that we deliver high-quality fresh products.</span><br></p>', 'quality', 1, 1, '2023-10-04 02:35:30', '2023-10-04 02:35:30'),
(2, 'ETHIC', 'media/testimonials/2023-10-04-WbHWwdQfvA57P6kGBP9LigHOKSRYaOg1eFDksdjw.webp', '<p><span style=\"color: rgb(51, 65, 85); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium;\">We deliver the best. All our clients have the security and confidence that we deliver high-quality fresh products.</span><br></p>', 'ethic', 2, 1, '2023-10-04 02:37:06', '2023-10-04 02:37:06'),
(3, 'TRUST', 'media/testimonials/2023-10-04-ypygqZgp2UAWAlBfhNDJVHBlIEPcw3mrZCEfO3RD.webp', '<p><span style=\"color: rgb(51, 65, 85); font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: medium;\">We deliver the best. All our clients have the security and confidence that we deliver high-quality fresh products.</span><br></p>', 'trust', 3, 1, '2023-10-04 02:38:08', '2023-10-04 02:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `transfer_no` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `host_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` double(16,2) NOT NULL,
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
  `transfer_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` double(16,2) NOT NULL,
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
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `area_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`area_id`)),
  `branch_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`branch_id`)),
  `store_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`store_id`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_staff` tinyint(4) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `role`, `company_id`, `name`, `user_name`, `email`, `phone`, `address`, `image`, `cover_image`, `area_id`, `branch_id`, `store_id`, `status`, `is_staff`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '$2y$10$STDWUGmnP11DefMETgX7i.EOj.mFUUlskfjf.6v7FbM297S44UVvO', NULL, NULL, NULL, NULL, NULL, '2023-10-24 06:03:09', '2023-10-24 06:03:09'),
(2, 1, 1, 'Bonton Foods', 'bontonfoods', 'bonton.foods@gmail.com', '0161800371020', NULL, NULL, NULL, 'null', 'null', 'null', 1, 0, NULL, '$2y$10$6R6NGttjQX6EB.jI7HWsRujYJ5KYTFj/Ufxp3kDQbXLOi9BGurEAG', NULL, 1, 1, NULL, NULL, '2023-09-23 06:52:33', '2023-10-24 06:36:52');

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

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `vendors` (`id`, `company_id`, `code`, `name`, `contact_person`, `email`, `phone`, `address`, `status`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'prefixd', 'BONTON EXPRESS', 'contact person', 'admin@gmail.com', '01997316189', 'address will goes here', 1, 1, 1, 1, NULL, '2023-09-25 05:24:30', '2023-10-02 08:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payments`
--

CREATE TABLE `vendor_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `lifting_id` bigint(20) UNSIGNED NOT NULL,
  `payment_no` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payment_data`
--

CREATE TABLE `vendor_payment_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_payment_id` bigint(20) UNSIGNED NOT NULL,
  `data` longtext NOT NULL,
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
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
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
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

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
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deliveries_serial_no_unique` (`serial_no`);

--
-- Indexes for table `delivery_lists`
--
ALTER TABLE `delivery_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_lists_delivery_id_foreign` (`delivery_id`),
  ADD KEY `delivery_lists_sales_list_id_foreign` (`sales_list_id`);

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
-- Indexes for table `flashdeals`
--
ALTER TABLE `flashdeals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flashdeals_slug_unique` (`slug`);

--
-- Indexes for table `flashdeal_products`
--
ALTER TABLE `flashdeal_products`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `home_product_sections`
--
ALTER TABLE `home_product_sections`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_product_data`
--
ALTER TABLE `sales_product_data`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_payments_lifting_id_foreign` (`lifting_id`);

--
-- Indexes for table `vendor_payment_data`
--
ALTER TABLE `vendor_payment_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_payment_data_vendor_payment_id_foreign` (`vendor_payment_id`);

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
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `admin_menu_actions`
--
ALTER TABLE `admin_menu_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_vendors`
--
ALTER TABLE `category_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chain_clients`
--
ALTER TABLE `chain_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2993;

--
-- AUTO_INCREMENT for table `client_categories`
--
ALTER TABLE `client_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client_messages`
--
ALTER TABLE `client_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_prices`
--
ALTER TABLE `client_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_data`
--
ALTER TABLE `collection_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_lists`
--
ALTER TABLE `delivery_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `details_cards`
--
ALTER TABLE `details_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flashdeals`
--
ALTER TABLE `flashdeals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flashdeal_products`
--
ALTER TABLE `flashdeal_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_sales_targets`
--
ALTER TABLE `group_sales_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_sales_target_categories`
--
ALTER TABLE `group_sales_target_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_product_sections`
--
ALTER TABLE `home_product_sections`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lifting_documents`
--
ALTER TABLE `lifting_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lifting_products`
--
ALTER TABLE `lifting_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lifting_returns`
--
ALTER TABLE `lifting_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lifting_return_lists`
--
ALTER TABLE `lifting_return_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=600;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_lists`
--
ALTER TABLE `sales_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `showcase_items`
--
ALTER TABLE `showcase_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_works`
--
ALTER TABLE `social_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `special_food_items`
--
ALTER TABLE `special_food_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `static_site_items`
--
ALTER TABLE `static_site_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `territories`
--
ALTER TABLE `territories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_payments`
--
ALTER TABLE `vendor_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_payment_data`
--
ALTER TABLE `vendor_payment_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `delivery_lists`
--
ALTER TABLE `delivery_lists`
  ADD CONSTRAINT `delivery_lists_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_lists_sales_list_id_foreign` FOREIGN KEY (`sales_list_id`) REFERENCES `sales_lists` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD CONSTRAINT `product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_return_lists`
--
ALTER TABLE `sales_return_lists`
  ADD CONSTRAINT `sales_return_lists_sales_return_id_foreign` FOREIGN KEY (`sales_return_id`) REFERENCES `sales_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transfer_products`
--
ALTER TABLE `transfer_products`
  ADD CONSTRAINT `transfer_products_transfer_id_foreign` FOREIGN KEY (`transfer_id`) REFERENCES `transfers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_payments`
--
ALTER TABLE `vendor_payments`
  ADD CONSTRAINT `vendor_payments_lifting_id_foreign` FOREIGN KEY (`lifting_id`) REFERENCES `liftings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_payment_data`
--
ALTER TABLE `vendor_payment_data`
  ADD CONSTRAINT `vendor_payment_data_vendor_payment_id_foreign` FOREIGN KEY (`vendor_payment_id`) REFERENCES `vendor_payments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
