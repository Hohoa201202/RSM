-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 06:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrestaurantmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_area`
--

CREATE TABLE `dm_tbl_area` (
  `IdArea` int(10) UNSIGNED NOT NULL,
  `AreaName` varchar(100) NOT NULL,
  `IdBranch` int(10) UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_area`
--

INSERT INTO `dm_tbl_area` (`IdArea`, `AreaName`, `IdBranch`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(51, 'Sảnh chính', 4, 1, '', '2023-04-21 20:24:11', '2023-04-21 20:24:11'),
(52, 'Sân ngoài', 4, 1, '', '2023-04-21 20:31:10', '2023-04-21 20:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_bookingstatus`
--

CREATE TABLE `dm_tbl_bookingstatus` (
  `IdStatus` int(10) UNSIGNED NOT NULL,
  `StatusName` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_bookingstatus`
--

INSERT INTO `dm_tbl_bookingstatus` (`IdStatus`, `StatusName`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Chưa nhận bàn', 1, NULL, NULL),
(2, 'Đã nhận bàn', 1, NULL, NULL),
(3, 'Đã hủy', 1, NULL, NULL),
(4, 'Đã hoàn thành', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_branchs`
--

CREATE TABLE `dm_tbl_branchs` (
  `IdBranch` int(10) UNSIGNED NOT NULL,
  `BranchName` varchar(100) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_branchs`
--

INSERT INTO `dm_tbl_branchs` (`IdBranch`, `BranchName`, `Address`, `PhoneNumber`, `Email`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(4, 'Cơ sở 1', '113 Trần Phú, TP.Vinh', '', '', 1, '', '2023-04-14 08:37:06', '2023-04-14 08:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_categories`
--

CREATE TABLE `dm_tbl_categories` (
  `IdCategory` int(10) UNSIGNED NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_categories`
--

INSERT INTO `dm_tbl_categories` (`IdCategory`, `CategoryName`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Đồ ăn', 1, NULL, NULL, '2023-04-12 22:42:23'),
(2, 'Đồ uống', 1, NULL, NULL, '2023-04-12 09:22:54'),
(3, 'Món dùng lẩu', 0, '', '2023-04-06 10:37:56', '2023-04-12 22:49:12'),
(4, 'Món dùng nướng', 0, '', '2023-04-06 10:38:12', '2023-04-12 22:49:08'),
(15, 'sdfdsf', 0, '', '2023-04-12 21:40:57', '2023-04-12 21:44:25'),
(16, 'Rượu', 0, 'vvvv', '2023-04-12 21:59:55', '2023-04-12 22:00:25'),
(17, 'Đồ nhậu', 0, '', '2023-04-20 01:12:24', '2023-04-20 01:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_orderstatus`
--

CREATE TABLE `dm_tbl_orderstatus` (
  `IdStatus` int(10) UNSIGNED NOT NULL,
  `StatusName` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_orderstatus`
--

INSERT INTO `dm_tbl_orderstatus` (`IdStatus`, `StatusName`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Chờ xác nhận thanh toán', 1, NULL, NULL, NULL),
(2, 'Đã thanh toán', 1, NULL, NULL, NULL),
(3, 'Đã hủy', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_tablestatus`
--

CREATE TABLE `dm_tbl_tablestatus` (
  `IdStatus` int(10) UNSIGNED NOT NULL,
  `StatusName` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_tablestatus`
--

INSERT INTO `dm_tbl_tablestatus` (`IdStatus`, `StatusName`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Bàn trống', 1, NULL, NULL, NULL),
(2, 'Đã đặt trước', 1, NULL, NULL, NULL),
(3, 'Đang phục vụ', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_tabletype`
--

CREATE TABLE `dm_tbl_tabletype` (
  `IdType` int(10) UNSIGNED NOT NULL,
  `TypeName` varchar(255) NOT NULL,
  `MaxSeats` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_tabletype`
--

INSERT INTO `dm_tbl_tabletype` (`IdType`, `TypeName`, `MaxSeats`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Đơn', 1, 1, '', '2023-04-13 09:32:01', '2023-04-13 09:32:01'),
(5, 'Đôi', 2, 1, '', '2023-04-13 09:41:02', '2023-04-13 09:43:53'),
(6, 'Trung bình', 5, 1, 'Dành cho gia đình từ 3 đến 5 người', '2023-04-13 09:44:43', '2023-04-13 09:52:17'),
(8, 'Lớn', 10, 1, '', '2023-04-13 09:59:55', '2023-04-13 09:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_unit`
--

CREATE TABLE `dm_tbl_unit` (
  `IdUnit` int(10) UNSIGNED NOT NULL,
  `UnitName` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_unit`
--

INSERT INTO `dm_tbl_unit` (`IdUnit`, `UnitName`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Đĩa', 1, '', '2023-04-20 02:06:14', '2023-04-20 02:06:14'),
(2, 'Kg', 1, '', '2023-04-20 02:06:23', '2023-04-20 02:06:23'),
(3, 'Nồi', 1, '', '2023-04-21 02:49:48', '2023-04-21 02:49:48'),
(4, 'Ly', 1, '', '2023-04-28 08:00:11', '2023-04-28 08:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_adminwebmenu`
--

CREATE TABLE `ht_tbl_adminwebmenu` (
  `IdMenuAdmin` int(10) UNSIGNED NOT NULL,
  `MenuName` varchar(50) NOT NULL,
  `ControllerName` varchar(50) NOT NULL,
  `ActionName` varchar(50) NOT NULL,
  `Lever` int(11) NOT NULL,
  `ParentId` int(11) NOT NULL,
  `Position` int(11) NOT NULL,
  `Order` int(11) NOT NULL,
  `UserCreated` varchar(50) NOT NULL,
  `IdName` varchar(50) NOT NULL,
  `Icon` varchar(50) NOT NULL,
  `UserEdit` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_adminwebmenu`
--

INSERT INTO `ht_tbl_adminwebmenu` (`IdMenuAdmin`, `MenuName`, `ControllerName`, `ActionName`, `Lever`, `ParentId`, `Position`, `Order`, `UserCreated`, `IdName`, `Icon`, `UserEdit`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Tổng quan', 'AdminHome', 'index', 0, 0, 1, 1, '', '', 'bi bi-grid', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Hóa đơn', 'AdminBill', 'index', 0, 0, 1, 2, '', 'orders', 'bi bi-journal-text', '', 1, NULL, NULL),
(3, 'Mặt hàng', '', 'index', 0, 0, 1, 4, '', 'items', 'bi bi-cup-hot', '', 1, NULL, NULL),
(4, 'Đặt bàn', '', '', 0, 0, 1, 3, '', 'booking', 'bi bi-table', '', 1, NULL, NULL),
(5, 'Nhân viên', '', 'index', 0, 0, 1, 6, '', 'user', 'bi bi-people', '', 1, NULL, NULL),
(6, 'Khách hàng', 'AdminBill', 'index', 0, 0, 1, 6, '', 'customer', 'bi bi-person', '', 1, NULL, NULL),
(7, 'Khuyến mãi', 'AdminBill', 'index', 0, 0, 1, 7, '', '', 'bi bi-heart', '', 0, NULL, NULL),
(8, 'Bài viết', '', 'index', 0, 0, 1, 8, '', 'posts', 'bi bi-sticky', '', 0, NULL, NULL),
(9, 'Hệ thống', '', 'systems', 0, 0, 1, 9, '', 'icons-nav', 'bi bi-laptop', '', 1, NULL, NULL),
(10, 'Thiết lập nhà hàng', 'settings', 'index', 0, 0, 1, 10, '', '', 'bi bi-gear', '', 1, NULL, NULL),
(11, 'Danh sách mặt hàng', 'items', 'index', 2, 3, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(13, 'Thực đơn', 'menus', 'index', 0, 1, 1, 5, '', '', 'bi bi-clipboard2-check', '', 1, NULL, NULL),
(14, 'Danh mục', 'category', 'index', 2, 3, 1, 3, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(15, 'Combo', 'combo', 'index', 0, 0, 1, 5, '', '', 'bi bi-c-circle', '', 1, NULL, NULL),
(16, 'Danh sách nhân viên', 'user', 'index', 2, 5, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(17, 'Phân quyền người dùng', 'role', 'index', 2, 5, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(18, 'Danh sách khách hàng', 'customer', 'index', 2, 6, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(19, 'Nhóm khách hàng', '', '', 2, 6, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(20, 'Thẻ thành viên', '', '', 2, 6, 1, 3, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(21, 'Danh sách bài viết', '', '', 2, 8, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(22, 'Danh sách chờ duyệt', '', '', 2, 8, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(23, 'Quản lý Menu', 'menu', 'index', 2, 9, 1, 1, '', '', 'bi bi-circle', '', 1, '0000-00-00 00:00:00', NULL),
(24, 'Quản lý Slide', 'slide', 'index', 2, 9, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(25, 'Đơn hiện thời', 'orders', 'index', 2, 2, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(26, 'Sơ đồ bàn', 'orders', 'table-list', 2, 4, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(27, 'Lịch sử đặt bàn', 'booking', 'booking-history', 2, 4, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(28, 'Lịch đặt bàn', 'booking', 'index', 2, 4, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(29, 'Lịch sử đơn hàng', 'orders', 'orders-history', 2, 2, 1, 3, '', '', 'bi bi-circle', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_group`
--

CREATE TABLE `ht_tbl_group` (
  `IdGroup` int(10) UNSIGNED NOT NULL,
  `GroupName` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_group`
--

INSERT INTO `ht_tbl_group` (`IdGroup`, `GroupName`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý', NULL, NULL, '2023-05-11 12:09:21'),
(2, 'Nhân viên', NULL, '2023-04-03 02:16:29', '2023-04-06 09:04:36'),
(8, 'Qlc1', '', '2023-04-19 01:33:09', '2023-04-19 01:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_menuweb`
--

CREATE TABLE `ht_tbl_menuweb` (
  `IdMenu` int(10) UNSIGNED NOT NULL,
  `MenuName` varchar(50) NOT NULL,
  `ControllerName` varchar(50) DEFAULT NULL,
  `ActionName` varchar(50) DEFAULT NULL,
  `Lever` int(11) DEFAULT NULL,
  `ParentId` int(11) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  `UserCreated` varchar(50) DEFAULT NULL,
  `UserEdit` varchar(50) DEFAULT NULL,
  `Icon` varchar(50) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_menuweb`
--

INSERT INTO `ht_tbl_menuweb` (`IdMenu`, `MenuName`, `ControllerName`, `ActionName`, `Lever`, `ParentId`, `Position`, `Order`, `UserCreated`, `UserEdit`, `Icon`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', NULL, NULL, 1, 0, 1, 1, '', '', '', 1, NULL, '2023-04-16 05:34:18'),
(5, 'Liên hệ', 'home', 'contact', 1, 0, 1, NULL, '', '', '', 1, '2023-04-16 05:44:24', '2023-04-16 05:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_role`
--

CREATE TABLE `ht_tbl_role` (
  `IdRole` int(10) UNSIGNED NOT NULL,
  `IdGroup` int(10) UNSIGNED NOT NULL,
  `IdMenuAdmin` int(10) UNSIGNED NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_role`
--

INSERT INTO `ht_tbl_role` (`IdRole`, `IdGroup`, `IdMenuAdmin`, `Description`, `created_at`, `updated_at`) VALUES
(56, 2, 1, NULL, NULL, NULL),
(57, 2, 2, NULL, NULL, NULL),
(58, 2, 3, NULL, NULL, NULL),
(59, 2, 4, NULL, NULL, NULL),
(60, 2, 6, NULL, NULL, NULL),
(61, 2, 8, NULL, NULL, NULL),
(62, 8, 5, '', NULL, NULL),
(74, 1, 1, NULL, NULL, NULL),
(75, 1, 2, NULL, NULL, NULL),
(76, 1, 4, NULL, NULL, NULL),
(77, 1, 3, NULL, NULL, NULL),
(78, 1, 13, NULL, NULL, NULL),
(79, 1, 5, NULL, NULL, NULL),
(80, 1, 15, NULL, NULL, NULL),
(81, 1, 6, NULL, NULL, NULL),
(82, 1, 7, NULL, NULL, NULL),
(83, 1, 8, NULL, NULL, NULL),
(84, 1, 9, NULL, NULL, NULL),
(85, 1, 10, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_slideweb`
--

CREATE TABLE `ht_tbl_slideweb` (
  `IdSlide` int(10) UNSIGNED NOT NULL,
  `IdMenu` int(10) UNSIGNED DEFAULT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `SubTitle` varchar(50) DEFAULT NULL,
  `ImageName` varchar(50) NOT NULL,
  `Position` int(11) DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_slideweb`
--

INSERT INTO `ht_tbl_slideweb` (`IdSlide`, `IdMenu`, `Title`, `SubTitle`, `ImageName`, `Position`, `Order`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(2, NULL, NULL, NULL, 'slide-20230416-171843.jpg', 1, 2, 1, NULL, NULL, '2023-04-16 10:20:13'),
(3, NULL, NULL, NULL, 'slide-20230416-171852.jpg', 1, 1, 1, NULL, NULL, '2023-04-16 10:20:07'),
(18, NULL, NULL, NULL, 'slide-20230416-171815.jpg', 1, 5, 1, NULL, '2023-04-16 10:10:19', '2023-04-16 10:21:22'),
(19, NULL, NULL, NULL, 'slide-20230416-172111.jpg', 1, 3, 1, NULL, '2023-04-16 10:21:11', '2023-04-16 10:21:11');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_03_24_084412_admin_web_menu', 1),
(3, '2023_03_31_073656_nhom_nguoi', 1),
(4, '2023_03_31_073739_phan_quyen', 1),
(5, '2023_03_31_074302_nguoi_dung', 1),
(6, '2023_03_31_151040_khach_hang', 1),
(17, '2023_04_06_094605_danhmuc_mat_hang', 2),
(18, '2023_04_06_094842_mat_hang', 2),
(19, '2023_04_06_101705_thuc_don', 2),
(20, '2023_04_06_102325_menu_items', 2),
(21, '2023_04_06_102729_combo', 2),
(22, '2023_04_06_103455_combo_mathang', 2),
(23, '2023_04_06_105923_bang_gia', 2),
(24, '2023_04_09_065826_slide', 3),
(25, '2023_04_13_150850_loai_ban', 4),
(27, '2023_04_14_143320_co_so', 5),
(28, '2023_04_14_161403_tt_ban', 6),
(29, '2023_04_14_161511_khu_vuc', 6),
(30, '2023_04_14_161549_ban', 6),
(31, '2023_04_16_074207_menu_web', 7),
(32, '2023_04_20_083729_donvi_tinh', 8),
(33, '2023_04_21_141840_dat_ban', 9),
(34, '2023_04_22_061318_tt_dat_ban', 10),
(35, '2023_04_29_145933_hoa_don', 11),
(36, '2023_04_29_151759_ct_hoa_don', 11),
(38, '2023_05_01_224157_tt_hoadon', 12),
(39, '2023_05_01_224805_ls_huy_hoadon', 12),
(40, '2023_05_03_085906_nhan_xet', 13);

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
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `IdBooking` int(10) UNSIGNED NOT NULL,
  `IdCustomer` int(10) UNSIGNED DEFAULT NULL,
  `IdBranch` int(10) UNSIGNED DEFAULT NULL,
  `IdTable` int(10) DEFAULT NULL,
  `Discount` int(10) UNSIGNED DEFAULT NULL,
  `BookingDate` datetime NOT NULL DEFAULT '2023-04-21 15:03:24',
  `TimeSlot` varchar(50) DEFAULT NULL,
  `NumberGuests` int(11) DEFAULT NULL,
  `IdStatus` int(10) UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`IdBooking`, `IdCustomer`, `IdBranch`, `IdTable`, `Discount`, `BookingDate`, `TimeSlot`, `NumberGuests`, `IdStatus`, `isActive`, `Note`, `created_at`, `updated_at`) VALUES
(59, 75, 4, 65, NULL, '2023-05-08 19:51:38', '8 - 10 giờ', 2, 3, 1, '', '2023-05-07 12:51:38', '2023-05-11 11:53:56'),
(60, 76, 4, 65, NULL, '2023-05-13 00:11:57', '10 - 12 giờ', 3, 4, 1, '', '2023-05-11 17:11:57', '2023-05-11 17:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancelledorder`
--

CREATE TABLE `tbl_cancelledorder` (
  `Id` int(10) UNSIGNED NOT NULL,
  `IdOrder` int(10) UNSIGNED NOT NULL,
  `CancellationReason` varchar(255) NOT NULL,
  `CancellationDate` datetime NOT NULL,
  `CancelledBy` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cancelledorder`
--

INSERT INTO `tbl_cancelledorder` (`Id`, `IdOrder`, `CancellationReason`, `CancellationDate`, `CancelledBy`, `created_at`, `updated_at`) VALUES
(2, 61, 'Khách yêu cầu hủy', '2023-05-11 18:55:09', 15, '2023-05-11 11:55:09', '2023-05-11 11:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo`
--

CREATE TABLE `tbl_combo` (
  `IdCombo` int(10) UNSIGNED NOT NULL,
  `ComboName` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL DEFAULT 0,
  `CostPrice` int(11) NOT NULL DEFAULT 0,
  `Avatar` varchar(50) NOT NULL DEFAULT 'default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_combo`
--

INSERT INTO `tbl_combo` (`IdCombo`, `ComboName`, `Price`, `CostPrice`, `Avatar`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(26, 'Lẩu combo', 350000, 160000, 'laucombo_20230511-230412.webp', 1, '', '2023-04-21 07:02:02', '2023-05-11 16:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_items`
--

CREATE TABLE `tbl_combo_items` (
  `Id` int(10) NOT NULL,
  `IdCombo` int(10) UNSIGNED NOT NULL,
  `IdItems` int(10) UNSIGNED NOT NULL,
  `Quantity` float UNSIGNED NOT NULL DEFAULT 1,
  `isActive` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_combo_items`
--

INSERT INTO `tbl_combo_items` (`Id`, `IdCombo`, `IdItems`, `Quantity`, `isActive`, `created_at`, `updated_at`) VALUES
(173, 26, 6, 1, 1, NULL, NULL),
(174, 26, 1, 1, 1, NULL, NULL),
(175, 26, 2, 1, 1, NULL, NULL),
(176, 26, 3, 1, 1, NULL, NULL),
(177, 26, 4, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `IdCustomer` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `PassWord` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `Gender` tinyint(1) NOT NULL DEFAULT 1,
  `Avatar` varchar(50) DEFAULT 'default.png',
  `PhoneNumber` varchar(10) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Province` varchar(50) DEFAULT NULL,
  `District` varchar(50) DEFAULT NULL,
  `Ward` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `LastLogin` datetime NOT NULL DEFAULT '2023-04-03 08:25:48',
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`IdCustomer`, `UserName`, `PassWord`, `LastName`, `FirstName`, `Gender`, `Avatar`, `PhoneNumber`, `Email`, `Province`, `District`, `Ward`, `Address`, `LastLogin`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(75, NULL, NULL, 'Bắc Bùi', 'Xuân', 1, 'default.png', '123', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-07 12:31:55', '2023-05-07 12:31:55'),
(76, NULL, NULL, 'Lê Văn', 'Nam', 1, 'default.png', '0366498743', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-11 17:11:57', '2023-05-11 17:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `Id` int(10) UNSIGNED NOT NULL,
  `IdCustomer` int(10) UNSIGNED NOT NULL,
  `IdBooking` int(10) UNSIGNED NOT NULL,
  `NumStars` int(11) NOT NULL DEFAULT 5,
  `Content` varchar(255) DEFAULT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT 0,
  `FeedbackDate` datetime NOT NULL DEFAULT '2023-05-03 09:14:37',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `IdItems` int(10) UNSIGNED NOT NULL,
  `ItemsName` varchar(50) NOT NULL,
  `Unit` int(10) UNSIGNED NOT NULL,
  `IdCategory` int(10) UNSIGNED NOT NULL,
  `Avatar` varchar(50) NOT NULL DEFAULT 'default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`IdItems`, `ItemsName`, `Unit`, `IdCategory`, `Avatar`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Lẩu cá kèo', 0, 1, 'cakeotuoisong_2023-04-09-13-18-08.jpg', 1, NULL, NULL, '2023-04-11 19:06:42'),
(2, 'Nước dùng lẩu', 0, 1, 'nuocdunglau_2023-04-09-13-23-56.jpg', 1, NULL, NULL, '2023-04-09 06:23:56'),
(3, 'Rau nhúng', 2, 1, 'raunhung_2023-04-09-13-19-22.webp', 1, NULL, NULL, '2023-04-20 02:35:21'),
(4, 'Bún tươi/Mì tôm', 0, 1, 'buntuoimitom_2023-04-09-13-18-46.jpg', 1, NULL, NULL, '2023-04-09 06:18:46'),
(5, 'Nước chấm', 0, 1, 'portfolio-5.jpg', 0, 'Tùy chọn', NULL, '2023-04-12 22:56:27'),
(6, 'Cá hồi nướng bơ', 1, 1, 'cahoinuongmuoiot_2023-04-09-13-24-59.jpg', 1, '', '2023-04-06 06:08:14', '2023-04-28 09:05:39'),
(28, 'Vịt quay Tứ Xuyên', 0, 1, 'vitquaytuxuyen_2023-04-12-02-02-55.jpg', 1, '', '2023-04-11 19:02:55', '2023-04-11 19:02:55'),
(29, 'Tôm nướng muối ớt', 1, 1, 'tomnuongmuoiot_2023-04-13-05-56-42.jpg', 1, '', '2023-04-11 19:05:11', '2023-04-21 07:10:52'),
(30, 'Lẩu thập cẩm', 3, 1, 'lauthapcam_2023-04-12-02-07-43.jpg', 1, '', '2023-04-11 19:07:43', '2023-04-21 02:50:10'),
(31, 'Lẩu cua đồng', 1, 1, 'laucuadong_2023-04-12-02-08-51.jpg', 1, NULL, '2023-04-11 19:08:51', '2023-04-20 02:34:41'),
(32, 'Salad rau củ quả', 1, 1, 'saladraucuqua_2023-04-12-02-10-03.jpg', 1, '', '2023-04-11 19:10:03', '2023-04-21 02:48:22'),
(41, 'Chạch chiên sả ớtt', 1, 1, 'chachchiensaott_20230428-150250.jpg', 1, '', '2023-04-20 21:22:23', '2023-04-28 08:02:50'),
(61, 'Coffe', 4, 2, 'coffe_20230428-150212.webp', 1, '', '2023-04-28 08:00:30', '2023-04-28 08:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `IdMenu` int(10) UNSIGNED NOT NULL,
  `MenuName` varchar(50) NOT NULL,
  `OrderMenu` varchar(50) DEFAULT NULL,
  `Avatar` varchar(50) NOT NULL DEFAULT 'default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`IdMenu`, `MenuName`, `OrderMenu`, `Avatar`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(15, 'Món nướng', '2', 'monnuong_2023-04-12-02-11-13.jpg', 1, '', '2023-04-11 19:11:13', '2023-04-11 19:11:13'),
(16, 'Các món lẩu', '3', 'default.png', 1, '', '2023-04-11 19:11:37', '2023-04-11 19:11:37'),
(18, 'Món chính', '4', 'default.png', 1, '', '2023-04-11 19:15:06', '2023-04-11 19:15:06'),
(25, 'Món khai vị', '1', 'default.png', 1, '', '2023-05-11 15:55:26', '2023-05-11 15:55:26'),
(26, 'xxx', '12', 'xxx_20230511-230854.jpg', 1, '', '2023-05-11 15:56:04', '2023-05-11 16:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus_items`
--

CREATE TABLE `tbl_menus_items` (
  `Id` int(10) NOT NULL,
  `IdMenu` int(10) UNSIGNED NOT NULL,
  `IdItems` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menus_items`
--

INSERT INTO `tbl_menus_items` (`Id`, `IdMenu`, `IdItems`, `created_at`, `updated_at`) VALUES
(25, 15, 6, NULL, NULL),
(26, 15, 28, NULL, NULL),
(27, 15, 29, NULL, NULL),
(28, 16, 30, NULL, NULL),
(29, 16, 31, NULL, NULL),
(31, 18, 1, NULL, NULL),
(32, 18, 2, NULL, NULL),
(33, 18, 3, NULL, NULL),
(34, 18, 4, NULL, NULL),
(35, 18, 5, NULL, NULL),
(36, 18, 6, NULL, NULL),
(37, 18, 28, NULL, NULL),
(38, 18, 29, NULL, NULL),
(39, 18, 30, NULL, NULL),
(40, 18, 31, NULL, NULL),
(41, 18, 32, NULL, NULL),
(48, 25, 31, NULL, NULL),
(49, 25, 32, NULL, NULL),
(76, 26, 6, NULL, NULL),
(81, 26, 28, '2023-05-11 16:08:25', '2023-05-11 16:08:25'),
(82, 26, 29, '2023-05-11 16:08:25', '2023-05-11 16:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `Id` int(10) UNSIGNED NOT NULL,
  `IdOrder` int(10) UNSIGNED NOT NULL,
  `IdItems` int(10) UNSIGNED DEFAULT NULL,
  `IdCombo` int(10) UNSIGNED DEFAULT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1,
  `PriceSale` int(11) NOT NULL DEFAULT 0,
  `Amount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`Id`, `IdOrder`, `IdItems`, `IdCombo`, `Quantity`, `PriceSale`, `Amount`, `created_at`, `updated_at`) VALUES
(138, 61, 30, NULL, 2, 280000, 560000, NULL, '2023-05-07 12:51:56'),
(141, 61, 41, NULL, 1, 150000, 150000, '2023-05-07 12:53:32', '2023-05-07 12:54:11'),
(145, 62, 41, NULL, 1, 150000, 150000, NULL, NULL),
(147, 63, 29, NULL, 1, 85000, 85000, NULL, NULL),
(148, 63, 28, NULL, 1, 0, 0, NULL, NULL),
(149, 63, 30, NULL, 1, 280000, 280000, NULL, NULL),
(150, 64, 29, NULL, 2, 85000, 170000, NULL, '2023-05-11 17:13:03'),
(151, 64, 28, NULL, 1, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `IdOrder` int(10) UNSIGNED NOT NULL,
  `IdCustomer` int(10) UNSIGNED DEFAULT NULL,
  `IdBooking` int(10) UNSIGNED DEFAULT NULL,
  `IdTable` int(10) UNSIGNED DEFAULT NULL,
  `Discount` int(10) UNSIGNED DEFAULT NULL,
  `IdUser` int(10) UNSIGNED DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `TimeIn` datetime DEFAULT NULL,
  `TimeOut` datetime DEFAULT NULL,
  `TotalCost` int(10) DEFAULT NULL,
  `TotalAmount` int(10) DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `PaymentTime` datetime DEFAULT NULL,
  `Status` int(10) UNSIGNED DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`IdOrder`, `IdCustomer`, `IdBooking`, `IdTable`, `Discount`, `IdUser`, `OrderDate`, `TimeIn`, `TimeOut`, `TotalCost`, `TotalAmount`, `PaymentMethod`, `PaymentTime`, `Status`, `Notes`, `created_at`, `updated_at`) VALUES
(61, 75, 59, 65, NULL, 15, '2023-05-07 19:51:50', '2023-05-07 19:51:50', NULL, 0, 710000, NULL, NULL, 3, NULL, '2023-05-07 12:51:38', '2023-05-11 11:55:09'),
(62, NULL, NULL, 68, NULL, 1, '2023-05-07 19:54:49', '2023-05-07 19:54:49', '2023-05-11 18:03:28', 0, 150000, 'Tiền mặt', '2023-05-11 18:03:28', 2, NULL, '2023-05-07 12:54:49', '2023-05-11 11:03:28'),
(63, NULL, NULL, 64, NULL, 15, '2023-05-11 18:08:15', '2023-05-11 18:08:15', '2023-05-12 00:31:48', 0, 365000, 'Tiền mặt', '2023-05-12 00:31:48', 2, NULL, '2023-05-11 11:08:15', '2023-05-11 17:31:48'),
(64, 76, 60, 65, NULL, 15, '2023-05-12 00:12:43', '2023-05-12 00:12:43', '2023-05-12 00:31:41', 0, 170000, 'Tiền mặt', '2023-05-12 00:31:41', 2, NULL, '2023-05-11 17:12:38', '2023-05-11 17:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricelist`
--

CREATE TABLE `tbl_pricelist` (
  `IdPrice` int(10) UNSIGNED NOT NULL,
  `IdItems` int(10) UNSIGNED NOT NULL,
  `PriceName` varchar(50) NOT NULL,
  `SalePrice` int(11) DEFAULT NULL,
  `CostPrice` int(11) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pricelist`
--

INSERT INTO `tbl_pricelist` (`IdPrice`, `IdItems`, `PriceName`, `SalePrice`, `CostPrice`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(35, 32, 'Giá thường', 120000, 50000, 1, NULL, NULL, NULL),
(36, 30, 'Giá thường', 280000, 150000, 1, NULL, NULL, NULL),
(37, 29, 'Giá thường', 85000, 50000, 1, NULL, NULL, NULL),
(40, 61, 'Giá thường', 25000, 10000, 1, NULL, NULL, NULL),
(41, 41, 'Giá thường', 150000, 70000, 1, NULL, NULL, NULL),
(42, 6, 'Giá thường', 220000, 160000, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tables`
--

CREATE TABLE `tbl_tables` (
  `IdTable` int(10) UNSIGNED NOT NULL,
  `TableName` varchar(100) NOT NULL,
  `IdType` int(10) UNSIGNED NOT NULL,
  `IdArea` int(10) UNSIGNED NOT NULL,
  `IdStatus` int(10) UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_tables`
--

INSERT INTO `tbl_tables` (`IdTable`, `TableName`, `IdType`, `IdArea`, `IdStatus`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(64, '1', 6, 51, 1, 1, NULL, NULL, '2023-05-11 17:31:48'),
(65, '2', 6, 51, 1, 1, NULL, NULL, '2023-05-11 17:31:41'),
(66, '3', 6, 51, 1, 1, NULL, NULL, '2023-05-07 11:03:24'),
(67, '4', 6, 51, 1, 1, NULL, NULL, '2023-05-07 12:12:58'),
(68, '5', 6, 51, 1, 1, NULL, NULL, '2023-05-11 08:36:53'),
(69, '2', 5, 52, 1, 1, NULL, NULL, '2023-05-05 07:10:48'),
(70, '3', 5, 52, 1, 1, NULL, NULL, '2023-05-05 07:12:45'),
(71, '4', 5, 52, 1, 1, NULL, NULL, '2023-05-05 07:13:55'),
(72, '5', 6, 52, 1, 1, NULL, NULL, NULL),
(73, '6', 6, 52, 1, 1, NULL, NULL, '2023-04-30 20:00:41'),
(74, '7', 6, 52, 1, 1, NULL, NULL, '2023-04-30 20:02:18'),
(75, '8', 1, 52, 1, 1, NULL, NULL, NULL),
(76, '9', 1, 52, 1, 1, NULL, NULL, '2023-04-30 19:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `IdUser` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `PassWord` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `Avatar` varchar(50) NOT NULL DEFAULT 'default.png',
  `BirthDay` date NOT NULL DEFAULT '2023-04-03',
  `PhoneNumber` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `IdGroup` int(10) UNSIGNED NOT NULL,
  `LastLogin` datetime NOT NULL DEFAULT '2023-04-03 08:25:48',
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `Description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`IdUser`, `UserName`, `PassWord`, `LastName`, `FirstName`, `Avatar`, `BirthDay`, `PhoneNumber`, `Email`, `IdGroup`, `LastLogin`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'a', '0cc175b9c0f1b6a831c399e269772661', 'Hồ Anh', 'Hòa', 'hoanhhoa_a.png', '2023-04-03', '', '', 1, '2023-04-03 08:25:48', 1, '', NULL, '2023-04-11 19:28:08'),
(15, 'admin', '0cc175b9c0f1b6a831c399e269772661', 'Hồ Anh', 'Hòa', 'default.png', '2023-05-11', '0865787333', 'admin@gmail.com', 1, '2023-05-11 15:36:16', 1, '', '2023-05-11 08:36:16', '2023-05-11 08:36:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dm_tbl_area`
--
ALTER TABLE `dm_tbl_area`
  ADD PRIMARY KEY (`IdArea`),
  ADD KEY `dm_tbl_area_idbranch_foreign` (`IdBranch`);

--
-- Indexes for table `dm_tbl_bookingstatus`
--
ALTER TABLE `dm_tbl_bookingstatus`
  ADD PRIMARY KEY (`IdStatus`);

--
-- Indexes for table `dm_tbl_branchs`
--
ALTER TABLE `dm_tbl_branchs`
  ADD PRIMARY KEY (`IdBranch`);

--
-- Indexes for table `dm_tbl_categories`
--
ALTER TABLE `dm_tbl_categories`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Indexes for table `dm_tbl_orderstatus`
--
ALTER TABLE `dm_tbl_orderstatus`
  ADD PRIMARY KEY (`IdStatus`);

--
-- Indexes for table `dm_tbl_tablestatus`
--
ALTER TABLE `dm_tbl_tablestatus`
  ADD PRIMARY KEY (`IdStatus`);

--
-- Indexes for table `dm_tbl_tabletype`
--
ALTER TABLE `dm_tbl_tabletype`
  ADD PRIMARY KEY (`IdType`);

--
-- Indexes for table `dm_tbl_unit`
--
ALTER TABLE `dm_tbl_unit`
  ADD PRIMARY KEY (`IdUnit`);

--
-- Indexes for table `ht_tbl_adminwebmenu`
--
ALTER TABLE `ht_tbl_adminwebmenu`
  ADD PRIMARY KEY (`IdMenuAdmin`);

--
-- Indexes for table `ht_tbl_group`
--
ALTER TABLE `ht_tbl_group`
  ADD PRIMARY KEY (`IdGroup`);

--
-- Indexes for table `ht_tbl_menuweb`
--
ALTER TABLE `ht_tbl_menuweb`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indexes for table `ht_tbl_role`
--
ALTER TABLE `ht_tbl_role`
  ADD PRIMARY KEY (`IdRole`),
  ADD UNIQUE KEY `ht_tbl_role_idgroup_idmenuadmin_unique` (`IdGroup`,`IdMenuAdmin`),
  ADD KEY `FK_IdMenuAdmin` (`IdMenuAdmin`);

--
-- Indexes for table `ht_tbl_slideweb`
--
ALTER TABLE `ht_tbl_slideweb`
  ADD PRIMARY KEY (`IdSlide`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`IdBooking`),
  ADD KEY `tbl_booking_idbranch_foreign` (`IdBranch`),
  ADD KEY `tbl_booking_idstatus_foreign` (`IdStatus`);

--
-- Indexes for table `tbl_cancelledorder`
--
ALTER TABLE `tbl_cancelledorder`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_cancelledorder_idorder_foreign` (`IdOrder`),
  ADD KEY `tbl_cancelledorder_cancelledby_foreign` (`CancelledBy`);

--
-- Indexes for table `tbl_combo`
--
ALTER TABLE `tbl_combo`
  ADD PRIMARY KEY (`IdCombo`);

--
-- Indexes for table `tbl_combo_items`
--
ALTER TABLE `tbl_combo_items`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_combo_items_idcombo_foreign` (`IdCombo`),
  ADD KEY `tbl_combo_items_iditems_foreign` (`IdItems`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`IdCustomer`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_IdCustomer` (`IdCustomer`),
  ADD KEY `FK_IdBooking` (`IdBooking`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`IdItems`),
  ADD KEY `tbl_items_idcategory_foreign` (`IdCategory`);

--
-- Indexes for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indexes for table `tbl_menus_items`
--
ALTER TABLE `tbl_menus_items`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_menus_items_idmenu_foreign` (`IdMenu`),
  ADD KEY `tbl_menus_items_iditems_foreign` (`IdItems`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tbl_orderdetails_idorder_foreign` (`IdOrder`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`IdOrder`);

--
-- Indexes for table `tbl_pricelist`
--
ALTER TABLE `tbl_pricelist`
  ADD PRIMARY KEY (`IdPrice`),
  ADD KEY `tbl_pricelist_iditems_foreign` (`IdItems`);

--
-- Indexes for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  ADD PRIMARY KEY (`IdTable`),
  ADD KEY `tbl_tables_idarea_foreign` (`IdArea`),
  ADD KEY `tbl_tables_idstatus_foreign` (`IdStatus`),
  ADD KEY `tbl_tables_idtype_foreign` (`IdType`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `tbl_user_username_unique` (`UserName`),
  ADD KEY `tbl_user_idgroup_foreign` (`IdGroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dm_tbl_area`
--
ALTER TABLE `dm_tbl_area`
  MODIFY `IdArea` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dm_tbl_bookingstatus`
--
ALTER TABLE `dm_tbl_bookingstatus`
  MODIFY `IdStatus` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dm_tbl_branchs`
--
ALTER TABLE `dm_tbl_branchs`
  MODIFY `IdBranch` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dm_tbl_categories`
--
ALTER TABLE `dm_tbl_categories`
  MODIFY `IdCategory` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dm_tbl_orderstatus`
--
ALTER TABLE `dm_tbl_orderstatus`
  MODIFY `IdStatus` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dm_tbl_tablestatus`
--
ALTER TABLE `dm_tbl_tablestatus`
  MODIFY `IdStatus` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dm_tbl_tabletype`
--
ALTER TABLE `dm_tbl_tabletype`
  MODIFY `IdType` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dm_tbl_unit`
--
ALTER TABLE `dm_tbl_unit`
  MODIFY `IdUnit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ht_tbl_adminwebmenu`
--
ALTER TABLE `ht_tbl_adminwebmenu`
  MODIFY `IdMenuAdmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ht_tbl_group`
--
ALTER TABLE `ht_tbl_group`
  MODIFY `IdGroup` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ht_tbl_menuweb`
--
ALTER TABLE `ht_tbl_menuweb`
  MODIFY `IdMenu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ht_tbl_role`
--
ALTER TABLE `ht_tbl_role`
  MODIFY `IdRole` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `ht_tbl_slideweb`
--
ALTER TABLE `ht_tbl_slideweb`
  MODIFY `IdSlide` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `IdBooking` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_cancelledorder`
--
ALTER TABLE `tbl_cancelledorder`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_combo`
--
ALTER TABLE `tbl_combo`
  MODIFY `IdCombo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_combo_items`
--
ALTER TABLE `tbl_combo_items`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `IdCustomer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `IdItems` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `IdMenu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_menus_items`
--
ALTER TABLE `tbl_menus_items`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `IdOrder` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_pricelist`
--
ALTER TABLE `tbl_pricelist`
  MODIFY `IdPrice` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  MODIFY `IdTable` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `IdUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dm_tbl_area`
--
ALTER TABLE `dm_tbl_area`
  ADD CONSTRAINT `dm_tbl_area_idbranch_foreign` FOREIGN KEY (`IdBranch`) REFERENCES `dm_tbl_branchs` (`IdBranch`);

--
-- Constraints for table `ht_tbl_role`
--
ALTER TABLE `ht_tbl_role`
  ADD CONSTRAINT `FK_IdGroup` FOREIGN KEY (`IdGroup`) REFERENCES `ht_tbl_group` (`IdGroup`),
  ADD CONSTRAINT `FK_IdMenuAdmin` FOREIGN KEY (`IdMenuAdmin`) REFERENCES `ht_tbl_adminwebmenu` (`IdMenuAdmin`);

--
-- Constraints for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD CONSTRAINT `tbl_booking_idstatus_foreign` FOREIGN KEY (`IdStatus`) REFERENCES `dm_tbl_bookingstatus` (`IdStatus`);

--
-- Constraints for table `tbl_cancelledorder`
--
ALTER TABLE `tbl_cancelledorder`
  ADD CONSTRAINT `tbl_cancelledorder_cancelledby_foreign` FOREIGN KEY (`CancelledBy`) REFERENCES `tbl_user` (`IdUser`),
  ADD CONSTRAINT `tbl_cancelledorder_idorder_foreign` FOREIGN KEY (`IdOrder`) REFERENCES `tbl_orders` (`IdOrder`);

--
-- Constraints for table `tbl_combo_items`
--
ALTER TABLE `tbl_combo_items`
  ADD CONSTRAINT `tbl_combo_items_idcombo_foreign` FOREIGN KEY (`IdCombo`) REFERENCES `tbl_combo` (`IdCombo`),
  ADD CONSTRAINT `tbl_combo_items_iditems_foreign` FOREIGN KEY (`IdItems`) REFERENCES `tbl_items` (`IdItems`);

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `FK_IdBooking` FOREIGN KEY (`IdBooking`) REFERENCES `tbl_booking` (`IdBooking`),
  ADD CONSTRAINT `FK_IdCustomer` FOREIGN KEY (`IdCustomer`) REFERENCES `tbl_customer` (`IdCustomer`);

--
-- Constraints for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD CONSTRAINT `tbl_items_idcategory_foreign` FOREIGN KEY (`IdCategory`) REFERENCES `dm_tbl_categories` (`IdCategory`);

--
-- Constraints for table `tbl_menus_items`
--
ALTER TABLE `tbl_menus_items`
  ADD CONSTRAINT `tbl_menus_items_iditems_foreign` FOREIGN KEY (`IdItems`) REFERENCES `tbl_items` (`IdItems`),
  ADD CONSTRAINT `tbl_menus_items_idmenu_foreign` FOREIGN KEY (`IdMenu`) REFERENCES `tbl_menus` (`IdMenu`);

--
-- Constraints for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD CONSTRAINT `tbl_orderdetails_idorder_foreign` FOREIGN KEY (`IdOrder`) REFERENCES `tbl_orders` (`IdOrder`);

--
-- Constraints for table `tbl_pricelist`
--
ALTER TABLE `tbl_pricelist`
  ADD CONSTRAINT `tbl_pricelist_iditems_foreign` FOREIGN KEY (`IdItems`) REFERENCES `tbl_items` (`IdItems`);

--
-- Constraints for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  ADD CONSTRAINT `tbl_tables_idarea_foreign` FOREIGN KEY (`IdArea`) REFERENCES `dm_tbl_area` (`IdArea`),
  ADD CONSTRAINT `tbl_tables_idstatus_foreign` FOREIGN KEY (`IdStatus`) REFERENCES `dm_tbl_tablestatus` (`IdStatus`),
  ADD CONSTRAINT `tbl_tables_idtype_foreign` FOREIGN KEY (`IdType`) REFERENCES `dm_tbl_tabletype` (`IdType`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_idgroup_foreign` FOREIGN KEY (`IdGroup`) REFERENCES `ht_tbl_group` (`IdGroup`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
