-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 31, 2023 at 05:43 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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
  `IdArea` int UNSIGNED NOT NULL,
  `AreaName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdBranch` int UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_area`
--

INSERT INTO `dm_tbl_area` (`IdArea`, `AreaName`, `IdBranch`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(51, 'Sảnh chính', 4, 1, '', '2023-04-21 13:24:11', '2023-04-21 13:24:11'),
(52, 'Sân ngoài', 4, 1, '', '2023-04-21 13:31:10', '2023-04-21 13:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_bookingstatus`
--

CREATE TABLE `dm_tbl_bookingstatus` (
  `IdStatus` int UNSIGNED NOT NULL,
  `StatusName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
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
  `IdBranch` int UNSIGNED NOT NULL,
  `BranchName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PhoneNumber` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_branchs`
--

INSERT INTO `dm_tbl_branchs` (`IdBranch`, `BranchName`, `Address`, `PhoneNumber`, `Email`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(4, 'Cơ sở 1', '113 Trần Phú, TP.Vinh', '', '', 1, '', '2023-04-14 01:37:06', '2023-04-14 01:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_categories`
--

CREATE TABLE `dm_tbl_categories` (
  `IdCategory` int UNSIGNED NOT NULL,
  `CategoryName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_categories`
--

INSERT INTO `dm_tbl_categories` (`IdCategory`, `CategoryName`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Đồ ăn', 1, NULL, NULL, '2023-04-12 15:42:23'),
(2, 'Đồ uống', 1, NULL, NULL, '2023-04-12 02:22:54'),
(3, 'Món dùng lẩu', 0, '', '2023-04-06 03:37:56', '2023-04-12 15:49:12'),
(4, 'Món dùng nướng', 0, '', '2023-04-06 03:38:12', '2023-04-12 15:49:08'),
(15, 'sdfdsf', 0, '', '2023-04-12 14:40:57', '2023-04-12 14:44:25'),
(16, 'Rượu', 0, 'vvvv', '2023-04-12 14:59:55', '2023-04-12 15:00:25'),
(17, 'Đồ nhậu', 0, '', '2023-04-19 18:12:24', '2023-04-19 18:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_orderstatus`
--

CREATE TABLE `dm_tbl_orderstatus` (
  `IdStatus` int UNSIGNED NOT NULL,
  `StatusName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `IdStatus` int UNSIGNED NOT NULL,
  `StatusName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `IdType` int UNSIGNED NOT NULL,
  `TypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaxSeats` int NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_tabletype`
--

INSERT INTO `dm_tbl_tabletype` (`IdType`, `TypeName`, `MaxSeats`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Đơn', 1, 1, '', '2023-04-13 02:32:01', '2023-04-13 02:32:01'),
(5, 'Đôi', 2, 1, '', '2023-04-13 02:41:02', '2023-04-13 02:43:53'),
(6, 'Trung bìnhh', 5, 1, '', '2023-04-13 02:44:43', '2023-05-14 16:47:59'),
(8, 'Lớn', 10, 0, '', '2023-04-13 02:59:55', '2023-05-14 16:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `dm_tbl_unit`
--

CREATE TABLE `dm_tbl_unit` (
  `IdUnit` int UNSIGNED NOT NULL,
  `UnitName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dm_tbl_unit`
--

INSERT INTO `dm_tbl_unit` (`IdUnit`, `UnitName`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Đĩa', 1, '', '2023-04-19 19:06:14', '2023-04-19 19:06:14'),
(2, 'Kg', 1, '', '2023-04-19 19:06:23', '2023-04-19 19:06:23'),
(3, 'Nồi', 1, '', '2023-04-20 19:49:48', '2023-04-20 19:49:48'),
(4, 'Ly', 1, '', '2023-04-28 01:00:11', '2023-04-28 01:00:11'),
(5, 'Con', 1, '', '2023-05-16 16:27:32', '2023-05-16 16:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_adminwebmenu`
--

CREATE TABLE `ht_tbl_adminwebmenu` (
  `IdMenuAdmin` int UNSIGNED NOT NULL,
  `MenuName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ControllerName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ActionName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lever` int NOT NULL,
  `ParentId` int NOT NULL,
  `Position` int NOT NULL,
  `Order` int NOT NULL,
  `UserCreated` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserEdit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_adminwebmenu`
--

INSERT INTO `ht_tbl_adminwebmenu` (`IdMenuAdmin`, `MenuName`, `ControllerName`, `ActionName`, `Lever`, `ParentId`, `Position`, `Order`, `UserCreated`, `IdName`, `Icon`, `UserEdit`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Thống kê', 'home', 'statistical', 0, 0, 1, 1, '', '', 'bi bi-grid', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
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
(13, 'Thực đơn', 'menus', 'index', 0, 0, 1, 5, '', '', 'bi bi-clipboard2-check', '', 1, NULL, NULL),
(14, 'Danh mục', 'category', 'index', 2, 3, 1, 3, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(15, 'Combo', 'combo', 'index', 0, 0, 1, 5, '', '', 'bi bi-c-circle', '', 1, NULL, NULL),
(16, 'Danh sách nhân viên', 'user', 'index', 2, 5, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(17, 'Phân quyền người dùng', 'role', 'index', 2, 5, 1, 2, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(18, 'Danh sách khách hàng', 'customer', 'index', 2, 6, 1, 1, '', '', 'bi bi-circle', '', 1, NULL, NULL),
(19, 'Nhóm khách hàng', '', '', 2, 6, 1, 2, '', '', 'bi bi-circle', '', 0, NULL, NULL),
(20, 'Thẻ thành viên', '', '', 2, 6, 1, 3, '', '', 'bi bi-circle', '', 0, NULL, NULL),
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
  `IdGroup` int UNSIGNED NOT NULL,
  `GroupName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_group`
--

INSERT INTO `ht_tbl_group` (`IdGroup`, `GroupName`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý', NULL, NULL, '2023-05-11 05:09:21'),
(2, 'Nhân viên', NULL, '2023-04-02 19:16:29', '2023-04-06 02:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_menuweb`
--

CREATE TABLE `ht_tbl_menuweb` (
  `IdMenu` int UNSIGNED NOT NULL,
  `MenuName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ControllerName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ActionName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lever` int DEFAULT NULL,
  `ParentId` int DEFAULT NULL,
  `Position` int DEFAULT NULL,
  `Order` int DEFAULT NULL,
  `UserCreated` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UserEdit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_menuweb`
--

INSERT INTO `ht_tbl_menuweb` (`IdMenu`, `MenuName`, `ControllerName`, `ActionName`, `Lever`, `ParentId`, `Position`, `Order`, `UserCreated`, `UserEdit`, `Icon`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', NULL, NULL, 1, 0, 1, 1, '', '', '', 1, NULL, '2023-05-19 05:49:43'),
(5, 'Liên hệ', NULL, 'contact', 1, 0, 1, 5, '', '', '', 1, '2023-04-15 22:44:24', '2023-05-19 06:09:24'),
(9, 'Giới thiệu', NULL, 'about', 1, 0, 1, 4, '', '', '', 1, '2023-05-19 05:49:29', '2023-05-19 06:09:19'),
(10, 'test', NULL, NULL, 1, 0, 1, NULL, '', '', '', 0, '2023-05-19 06:07:41', '2023-05-19 06:08:32'),
(11, 'cccc', NULL, NULL, 2, 10, 1, NULL, '', '', '', 0, '2023-05-19 06:07:50', '2023-05-19 06:08:32'),
(12, 'Thực đơn', NULL, 'menus', 1, 0, 1, 2, '', '', '', 1, '2023-05-19 06:09:02', '2023-05-19 06:09:02'),
(13, 'Đặt bàn', NULL, 'cart', 1, 0, 1, 3, '', '', '', 1, '2023-05-19 06:10:23', '2023-05-19 06:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `ht_tbl_role`
--

CREATE TABLE `ht_tbl_role` (
  `IdRole` int UNSIGNED NOT NULL,
  `IdGroup` int UNSIGNED NOT NULL,
  `IdMenuAdmin` int UNSIGNED NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `IdSlide` int UNSIGNED NOT NULL,
  `IdMenu` int UNSIGNED DEFAULT NULL,
  `Title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SubTitle` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ImageName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Position` int DEFAULT NULL,
  `Order` int DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ht_tbl_slideweb`
--

INSERT INTO `ht_tbl_slideweb` (`IdSlide`, `IdMenu`, `Title`, `SubTitle`, `ImageName`, `Position`, `Order`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(2, NULL, NULL, NULL, 'slide-20230416-171843.jpg', 1, 2, 1, NULL, NULL, '2023-04-16 03:20:13'),
(3, NULL, NULL, NULL, 'slide-20230416-171852.jpg', 1, 1, 1, NULL, NULL, '2023-04-16 03:20:07'),
(18, NULL, NULL, NULL, 'slide-20230416-171815.jpg', 1, 5, 1, NULL, '2023-04-16 03:10:19', '2023-04-16 03:21:22'),
(19, NULL, NULL, NULL, 'slide-20230416-172111.jpg', 1, 3, 1, NULL, '2023-04-16 03:21:11', '2023-04-16 03:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(40, '2023_05_03_085906_nhan_xet', 13),
(41, '2023_05_14_014345_tt_nhahang', 14);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `IdBooking` int UNSIGNED NOT NULL,
  `IdCustomer` int UNSIGNED DEFAULT NULL,
  `IdBranch` int UNSIGNED DEFAULT NULL,
  `IdTable` int DEFAULT NULL,
  `Discount` int UNSIGNED DEFAULT NULL,
  `BookingDate` datetime NOT NULL DEFAULT '2023-04-21 15:03:24',
  `TimeSlot` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NumberGuests` int DEFAULT NULL,
  `PrePayment` int DEFAULT NULL,
  `IdStatus` int UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`IdBooking`, `IdCustomer`, `IdBranch`, `IdTable`, `Discount`, `BookingDate`, `TimeSlot`, `NumberGuests`, `PrePayment`, `IdStatus`, `isActive`, `Note`, `created_at`, `updated_at`) VALUES
(59, 75, 4, 65, NULL, '2023-05-08 19:51:38', '8 - 10 giờ', 2, NULL, 3, 1, '', '2023-05-07 05:51:38', '2023-05-11 04:53:56'),
(60, 76, 4, 65, NULL, '2023-05-13 00:11:57', '10 - 12 giờ', 3, NULL, 4, 1, '', '2023-05-11 10:11:57', '2023-05-11 10:31:41'),
(61, 77, NULL, 66, NULL, '2023-05-14 19:55:49', '10 - 12 giờ', 5, NULL, 4, 1, '', '2023-05-13 12:55:49', '2023-05-14 16:50:04'),
(92, 78, NULL, 66, NULL, '2023-05-14 15:28:15', '10 - 12 giờ', 5, NULL, 2, 1, '', '2023-05-14 08:28:15', '2023-05-17 10:46:21'),
(125, 83, NULL, 72, NULL, '2023-05-17 23:16:00', '10 - 12 giờ', 3, NULL, 2, 1, '', '2023-05-16 16:16:00', '2023-05-17 10:56:30'),
(126, 84, NULL, 65, NULL, '2023-05-17 23:17:42', '10 - 12 giờ', 5, NULL, 4, 1, '', '2023-05-16 16:17:42', '2023-05-17 16:36:35'),
(127, 85, NULL, 68, NULL, '2023-05-18 23:18:16', '8 - 10 giờ', 2, NULL, 4, 1, '', '2023-05-16 16:18:16', '2023-05-17 16:45:39'),
(128, 78, NULL, 76, NULL, '2023-05-17 23:25:16', '12 - 14 giờ', 3, NULL, 2, 1, '', '2023-05-16 16:25:16', '2023-05-17 10:59:36'),
(129, 86, 4, NULL, NULL, '2023-05-17 23:45:20', '16 - 18 giờ', 5, NULL, 3, 0, '', '2023-05-16 16:45:20', '2023-05-19 08:03:26'),
(130, 78, NULL, 73, NULL, '2023-05-18 18:08:45', '10 - 12 giờ', 5, NULL, 4, 1, '', '2023-05-17 11:08:45', '2023-05-17 16:45:44'),
(131, 78, NULL, 66, NULL, '2023-05-18 23:03:59', '8 - 10 giờ', 5, NULL, 4, 1, '', '2023-05-17 16:03:59', '2023-05-17 16:45:47'),
(132, 78, NULL, 69, NULL, '2023-05-17 23:06:38', '8 - 10 giờ', 5, NULL, 4, 1, '', '2023-05-17 16:06:38', '2023-05-17 16:45:42'),
(133, 78, 4, 68, NULL, '2023-05-19 00:07:47', '8 - 10 giờ', 5, NULL, 4, 1, '', '2023-05-17 17:07:47', '2023-05-17 17:10:37'),
(134, 78, 4, 65, NULL, '2023-05-19 00:08:35', '14 - 16 giờ', 4, NULL, 4, 1, '', '2023-05-17 17:08:35', '2023-05-17 17:10:13'),
(135, 78, 4, NULL, NULL, '2023-05-19 08:25:55', '8 - 10 giờ', 6, NULL, 3, 0, '', '2023-05-18 01:25:55', '2023-05-19 08:03:29'),
(136, 82, 4, NULL, NULL, '2023-05-19 08:27:23', '10 - 12 giờ', 2, NULL, 3, 0, '', '2023-05-18 01:27:23', '2023-05-19 08:03:32'),
(137, 82, 4, NULL, NULL, '2023-05-19 08:28:24', '10 - 12 giờ', 1, NULL, 3, 0, '', '2023-05-18 01:28:24', '2023-05-19 08:03:34'),
(138, 79, 4, 64, NULL, '2023-05-19 08:30:59', '10 - 12 giờ', 3, 1100000, 4, 1, '', '2023-05-18 01:30:59', '2023-05-19 08:30:46'),
(139, 83, 4, NULL, NULL, '2023-05-19 14:41:39', '20 - 22 giờ', 1, NULL, 3, 0, '', '2023-05-19 07:41:39', '2023-05-19 08:03:40'),
(140, 78, 4, NULL, NULL, '2023-05-19 14:44:22', '6 - 8 giờ', 2, NULL, 3, 0, '', '2023-05-19 07:44:22', '2023-05-19 08:30:52'),
(141, 78, 4, NULL, NULL, '2023-05-19 15:03:06', '8 - 10 giờ', 2, NULL, 3, 0, '', '2023-05-19 08:03:06', '2023-05-19 08:30:55'),
(142, 87, 4, NULL, NULL, '2023-05-19 15:09:16', '6 - 8 giờ', 3, NULL, 3, 0, '', '2023-05-19 08:09:16', '2023-05-19 08:30:57'),
(143, 78, NULL, NULL, NULL, '2023-05-19 15:18:39', '8 - 10 giờ', 2, NULL, 3, 0, '', '2023-05-19 08:18:39', '2023-05-19 08:30:59'),
(144, 78, NULL, NULL, NULL, '2023-05-19 15:21:14', '8 - 10 giờ', 2, NULL, 3, 0, '', '2023-05-19 08:21:14', '2023-05-19 08:31:02'),
(145, 78, NULL, NULL, NULL, '2023-05-31 15:25:18', '8 - 10 giờ', 2, NULL, 3, 0, '', '2023-05-19 08:25:18', '2023-05-19 08:31:05'),
(146, 78, NULL, 64, NULL, '2023-05-31 15:25:58', '8 - 10 giờ', 2, NULL, 4, 1, '', '2023-05-19 08:25:58', '2023-05-19 08:31:29'),
(147, 78, 4, 64, NULL, '2023-05-24 15:28:19', '12 - 14 giờ', 1, 220000, 4, 1, '', '2023-05-19 08:28:19', '2023-05-19 08:31:13'),
(148, 83, 4, 64, NULL, '2023-05-30 17:42:15', '18 - 20 giờ', 3, NULL, 4, 1, '', '2023-05-19 10:42:15', '2023-05-19 10:42:30'),
(149, 83, 4, NULL, NULL, '2023-05-22 10:37:00', '16 - 18 giờ', 5, NULL, 1, 1, '', '2023-05-22 03:37:00', '2023-05-22 03:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancelledorder`
--

CREATE TABLE `tbl_cancelledorder` (
  `Id` int UNSIGNED NOT NULL,
  `IdOrder` int UNSIGNED NOT NULL,
  `CancellationReason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CancellationDate` datetime NOT NULL,
  `CancelledBy` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cancelledorder`
--

INSERT INTO `tbl_cancelledorder` (`Id`, `IdOrder`, `CancellationReason`, `CancellationDate`, `CancelledBy`, `created_at`, `updated_at`) VALUES
(2, 61, 'Khách yêu cầu hủy', '2023-05-11 18:55:09', 15, '2023-05-11 04:55:09', '2023-05-11 04:55:09'),
(3, 111, 'Khách yêu cầu hủy', '2023-05-16 23:32:28', 15, '2023-05-16 16:32:28', '2023-05-16 16:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo`
--

CREATE TABLE `tbl_combo` (
  `IdCombo` int UNSIGNED NOT NULL,
  `ComboName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` int NOT NULL DEFAULT '0',
  `CostPrice` int NOT NULL DEFAULT '0',
  `Avatar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_combo`
--

INSERT INTO `tbl_combo` (`IdCombo`, `ComboName`, `Price`, `CostPrice`, `Avatar`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(26, 'Lẩu combo', 350000, 160000, 'laucombo_20230512-235136.jpg', 1, '', '2023-04-21 00:02:02', '2023-05-29 19:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combo_items`
--

CREATE TABLE `tbl_combo_items` (
  `Id` int NOT NULL,
  `IdCombo` int UNSIGNED NOT NULL,
  `IdItems` int UNSIGNED NOT NULL,
  `Quantity` float UNSIGNED NOT NULL DEFAULT '1',
  `isActive` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_combo_items`
--

INSERT INTO `tbl_combo_items` (`Id`, `IdCombo`, `IdItems`, `Quantity`, `isActive`, `created_at`, `updated_at`) VALUES
(186, 26, 6, 1, 1, NULL, NULL),
(187, 26, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `IdCustomer` int UNSIGNED NOT NULL,
  `UserName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PassWord` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` tinyint(1) NOT NULL DEFAULT '1',
  `Avatar` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `PhoneNumber` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Province` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `District` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ward` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastLogin` datetime NOT NULL DEFAULT '2023-04-03 08:25:48',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`IdCustomer`, `UserName`, `PassWord`, `LastName`, `FirstName`, `Gender`, `Avatar`, `PhoneNumber`, `Email`, `Province`, `District`, `Ward`, `Address`, `LastLogin`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(75, '', NULL, 'Bắc Bùi', 'Xuân', 1, 'default.png', '0988364771', '', NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-07 05:31:55', '2023-05-12 09:14:34'),
(76, NULL, NULL, 'Lê Văn', 'Nam', 1, 'default.png', '0366498743', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-11 10:11:57', '2023-05-11 10:11:57'),
(77, NULL, NULL, 'Lê Xuân', 'Tú', 1, 'default.png', '0377978988', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-13 12:55:49', '2023-05-13 12:55:49'),
(78, NULL, NULL, 'Hồ Anh', 'Hòa', 1, 'default.png', '0865787133', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-14 07:42:59', '2023-05-14 07:42:59'),
(79, NULL, NULL, 'Hồ Anh', 'Hòa', 1, 'default.png', '123', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-14 07:46:04', '2023-05-14 07:46:04'),
(82, NULL, NULL, 'Bắc Bùi', 'Xuân', 1, 'default.png', '21312', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-14 09:12:19', '2023-05-14 09:12:19'),
(83, NULL, NULL, 'Hồ Anh', 'Hòa', 1, 'default.png', '0865787333', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-16 16:16:00', '2023-05-16 16:16:00'),
(84, NULL, NULL, 'Nguyễn Văn', 'A', 1, 'default.png', '0989876787', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-16 16:17:42', '2023-05-16 16:17:42'),
(85, NULL, NULL, 'Lê Thi', 'C', 1, 'default.png', '0376787213', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-16 16:18:16', '2023-05-16 16:18:16'),
(86, NULL, NULL, 'Nguyễn Thu', 'Hoa', 1, 'default.png', '0987898778', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-16 16:45:20', '2023-05-16 16:45:20'),
(87, NULL, NULL, 'Hồ Anh', 'Hoàng', 1, 'default.png', '0865787345', NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:25:48', 1, NULL, '2023-05-19 08:09:16', '2023-05-19 08:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `Id` int UNSIGNED NOT NULL,
  `IdCustomer` int UNSIGNED NOT NULL,
  `IdBooking` int UNSIGNED NOT NULL,
  `NumStars` int NOT NULL DEFAULT '5',
  `Content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT '0',
  `FeedbackDate` datetime NOT NULL DEFAULT '2023-05-03 09:14:37',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `IdItems` int UNSIGNED NOT NULL,
  `ItemsName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unit` int UNSIGNED NOT NULL,
  `IdCategory` int UNSIGNED NOT NULL,
  `Avatar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`IdItems`, `ItemsName`, `Unit`, `IdCategory`, `Avatar`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(1, 'Lẩu cá kèo', 0, 1, 'cakeotuoisong_2023-04-09-13-18-08.jpg', 0, NULL, NULL, '2023-05-14 08:50:19'),
(2, 'Nước dùng lẩu', 0, 1, 'nuocdunglau_2023-04-09-13-23-56.jpg', 0, NULL, NULL, '2023-05-12 17:12:05'),
(3, 'Rau nhúng', 2, 1, 'raunhung_2023-04-09-13-19-22.webp', 0, NULL, NULL, '2023-05-12 17:18:26'),
(4, 'Bún tươi/Mì tôm', 0, 1, 'buntuoimitom_2023-04-09-13-18-46.jpg', 0, NULL, NULL, '2023-05-12 17:18:29'),
(5, 'Nước chấm', 0, 1, 'portfolio-5.jpg', 0, 'Tùy chọn', NULL, '2023-04-12 15:56:27'),
(6, 'Cá hồi nướng bơ', 1, 1, 'cahoinuongmuoiot_2023-04-09-13-24-59.jpg', 1, '', '2023-04-05 23:08:14', '2023-04-28 02:05:39'),
(28, 'Vịt quay Tứ Xuyên', 5, 1, 'vitquaytuxuyen_2023-04-12-02-02-55.jpg', 1, '', '2023-04-11 12:02:55', '2023-05-16 16:27:49'),
(29, 'Tôm nướng muối ớt', 1, 1, 'tomnuongmuoiot_2023-04-13-05-56-42.jpg', 1, '', '2023-04-11 12:05:11', '2023-04-21 00:10:52'),
(30, 'Lẩu thập cẩm', 3, 1, 'lauthapcam_2023-04-12-02-07-43.jpg', 1, '', '2023-04-11 12:07:43', '2023-04-20 19:50:10'),
(31, 'Lẩu cua đồng', 1, 1, 'laucuadong_2023-04-12-02-08-51.jpg', 1, '', '2023-04-11 12:08:51', '2023-05-16 16:26:57'),
(32, 'Salad rau củ quả', 1, 1, 'saladraucuqua_2023-04-12-02-10-03.jpg', 1, '', '2023-04-11 12:10:03', '2023-04-20 19:48:22'),
(41, 'Chạch chiên sả ớtt', 1, 1, 'chachchiensaott_20230428-150250.jpg', 1, '', '2023-04-20 14:22:23', '2023-04-28 01:02:50'),
(61, 'Coffe', 4, 2, 'coffe_20230428-150212.webp', 1, '', '2023-04-28 01:00:30', '2023-04-28 01:02:12'),
(62, 'Coca Cola', 4, 2, 'cocacola_20230516-232936.png', 1, '', '2023-05-16 16:29:36', '2023-05-16 16:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `IdMenu` int UNSIGNED NOT NULL,
  `MenuName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrderMenu` int DEFAULT NULL,
  `Avatar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menus`
--

INSERT INTO `tbl_menus` (`IdMenu`, `MenuName`, `OrderMenu`, `Avatar`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(15, 'Món nướng', 2, 'monnuong_20230514-234852.jpg', 1, '', '2023-04-11 12:11:13', '2023-05-14 16:48:52'),
(16, 'Các món lẩu', 3, 'cacmonlau_20230514-234840.jpg', 1, '', '2023-04-11 12:11:37', '2023-05-14 16:48:40'),
(18, 'Món chính', 4, 'monchinh_20230514-234926.jpg', 1, '', '2023-04-11 12:15:06', '2023-05-14 16:49:26'),
(25, 'Món khai vị', 1, 'monkhaivi_20230514-234947.jpg', 1, '', '2023-05-11 08:55:26', '2023-05-14 16:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menus_items`
--

CREATE TABLE `tbl_menus_items` (
  `Id` int NOT NULL,
  `IdMenu` int UNSIGNED NOT NULL,
  `IdItems` int UNSIGNED NOT NULL,
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
(38, 18, 29, NULL, NULL),
(39, 18, 30, NULL, NULL),
(40, 18, 31, NULL, NULL),
(41, 18, 32, NULL, NULL),
(48, 25, 31, NULL, NULL),
(49, 25, 32, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `Id` int UNSIGNED NOT NULL,
  `IdOrder` int UNSIGNED NOT NULL,
  `IdItems` int UNSIGNED DEFAULT NULL,
  `IdCombo` int UNSIGNED DEFAULT NULL,
  `Quantity` int NOT NULL DEFAULT '1',
  `PriceSale` int NOT NULL DEFAULT '0',
  `Amount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`Id`, `IdOrder`, `IdItems`, `IdCombo`, `Quantity`, `PriceSale`, `Amount`, `created_at`, `updated_at`) VALUES
(138, 61, 30, NULL, 2, 280000, 560000, NULL, '2023-05-07 05:51:56'),
(141, 61, 41, NULL, 1, 150000, 150000, '2023-05-07 05:53:32', '2023-05-07 05:54:11'),
(147, 63, 29, NULL, 1, 85000, 85000, NULL, NULL),
(148, 63, 28, NULL, 1, 0, 0, NULL, NULL),
(149, 63, 30, NULL, 1, 280000, 280000, NULL, NULL),
(150, 64, 29, NULL, 2, 85000, 170000, NULL, '2023-05-11 10:13:03'),
(151, 64, 28, NULL, 1, 0, 0, NULL, NULL),
(152, 65, 41, NULL, 1, 150000, 150000, NULL, NULL),
(154, 65, 30, NULL, 1, 280000, 280000, NULL, NULL),
(159, 67, 41, NULL, 1, 150000, 150000, NULL, NULL),
(160, 67, 32, NULL, 1, 120000, 120000, NULL, NULL),
(161, 67, 31, NULL, 1, 0, 0, NULL, NULL),
(162, 68, 30, NULL, 1, 280000, 280000, NULL, NULL),
(163, 68, 31, NULL, 1, 0, 0, NULL, NULL),
(164, 69, 30, NULL, 1, 280000, 280000, NULL, NULL),
(165, 69, 6, NULL, 4, 220000, 880000, NULL, NULL),
(166, 69, 29, NULL, 2, 85000, 170000, NULL, NULL),
(167, 69, 32, NULL, 2, 120000, 240000, NULL, NULL),
(168, 70, 30, NULL, 1, 280000, 280000, NULL, NULL),
(169, 70, 31, NULL, 1, 0, 0, NULL, NULL),
(170, 70, 32, NULL, 1, 120000, 120000, NULL, NULL),
(171, 70, 41, NULL, 1, 150000, 150000, NULL, NULL),
(172, 71, 30, NULL, 1, 280000, 280000, NULL, NULL),
(173, 71, 6, NULL, 2, 220000, 440000, NULL, NULL),
(237, 108, 29, NULL, 2, 85000, 170000, NULL, NULL),
(238, 108, 31, NULL, 2, 380000, 760000, NULL, NULL),
(239, 108, 62, NULL, 3, 15000, 45000, NULL, NULL),
(240, 109, 41, NULL, 1, 150000, 150000, NULL, NULL),
(241, 109, 28, NULL, 1, 220000, 220000, NULL, NULL),
(242, 109, 29, NULL, 1, 85000, 85000, NULL, NULL),
(243, 110, 31, NULL, 1, 380000, 380000, NULL, NULL),
(244, 110, 32, NULL, 1, 120000, 120000, NULL, NULL),
(245, 110, 28, NULL, 1, 220000, 220000, NULL, NULL),
(246, 111, 31, NULL, 1, 380000, 380000, NULL, NULL),
(247, 111, 6, NULL, 1, 220000, 220000, NULL, NULL),
(250, 116, 41, NULL, 1, 150000, 150000, '2023-05-17 11:08:56', '2023-05-17 11:08:56'),
(251, 116, 32, NULL, 1, 120000, 120000, '2023-05-17 11:08:56', '2023-05-17 11:08:56'),
(252, 116, 31, NULL, 1, 380000, 380000, '2023-05-17 11:08:56', '2023-05-17 11:08:56'),
(253, 117, 6, NULL, 1, 220000, 220000, NULL, NULL),
(254, 117, 28, NULL, 1, 220000, 220000, NULL, NULL),
(255, 117, 29, NULL, 1, 85000, 85000, NULL, NULL),
(256, 117, 30, NULL, 1, 280000, 280000, NULL, NULL),
(257, 118, 6, NULL, 2, 220000, 440000, NULL, NULL),
(258, 118, 28, NULL, 2, 220000, 440000, NULL, NULL),
(259, 118, 29, NULL, 2, 85000, 170000, NULL, NULL),
(260, 118, 30, NULL, 2, 280000, 560000, NULL, NULL),
(261, 119, 62, NULL, 4, 15000, 60000, NULL, '2023-05-17 16:36:11'),
(262, 119, 30, NULL, 1, 280000, 280000, NULL, NULL),
(263, 119, 6, NULL, 1, 220000, 220000, NULL, NULL),
(264, 120, 32, NULL, 1, 120000, 120000, NULL, NULL),
(265, 120, 31, NULL, 1, 380000, 380000, NULL, NULL),
(266, 120, 28, NULL, 1, 220000, 220000, '2023-05-17 16:49:41', '2023-05-17 16:49:41'),
(267, 121, 6, NULL, 1, 220000, 220000, NULL, NULL),
(268, 121, 28, NULL, 1, 220000, 220000, NULL, NULL),
(269, 121, 30, NULL, 1, 280000, 280000, NULL, NULL),
(270, 122, 31, NULL, 1, 380000, 380000, '2023-05-17 17:10:34', '2023-05-17 17:10:34'),
(271, 122, 32, NULL, 1, 120000, 120000, '2023-05-17 17:10:34', '2023-05-17 17:10:34'),
(272, 122, 28, NULL, 1, 220000, 220000, '2023-05-17 17:10:34', '2023-05-17 17:10:34'),
(273, 122, 29, NULL, 1, 85000, 85000, '2023-05-17 17:10:34', '2023-05-17 17:10:34'),
(274, 123, 6, NULL, 1, 220000, 220000, NULL, NULL),
(275, 124, 6, NULL, 4, 220000, 880000, NULL, NULL),
(276, 124, 28, NULL, 1, 220000, 220000, NULL, NULL),
(277, 125, 6, NULL, 1, 220000, 220000, NULL, NULL),
(278, 127, 6, NULL, 1, 220000, 220000, NULL, NULL),
(279, 127, 28, NULL, 1, 220000, 220000, NULL, NULL),
(280, 127, 29, NULL, 1, 85000, 85000, NULL, NULL),
(281, 128, 28, NULL, 1, 220000, 220000, NULL, NULL),
(282, 129, 28, NULL, 1, 220000, 220000, NULL, NULL),
(283, 130, 28, NULL, 1, 220000, 220000, NULL, NULL),
(284, 131, 28, NULL, 1, 220000, 220000, NULL, NULL),
(285, 132, 28, NULL, 1, 220000, 220000, NULL, NULL),
(286, 132, 31, NULL, 1, 380000, 380000, '2023-05-19 08:31:11', '2023-05-19 08:31:11'),
(287, 132, 30, NULL, 1, 280000, 280000, '2023-05-19 08:31:11', '2023-05-19 08:31:11'),
(288, 133, 6, NULL, 1, 220000, 220000, NULL, NULL),
(289, 133, 28, NULL, 1, 220000, 220000, NULL, NULL),
(290, 133, 29, NULL, 1, 85000, 85000, NULL, NULL),
(291, 134, 6, NULL, 1, 220000, 220000, NULL, NULL),
(292, 134, 31, NULL, 1, 380000, 380000, NULL, NULL),
(293, 135, 31, NULL, 1, 380000, 380000, NULL, NULL),
(294, 135, 32, NULL, 1, 120000, 120000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `IdOrder` int UNSIGNED NOT NULL,
  `IdCustomer` int UNSIGNED DEFAULT NULL,
  `IdBooking` int UNSIGNED DEFAULT NULL,
  `IdTable` int UNSIGNED DEFAULT NULL,
  `Discount` int UNSIGNED DEFAULT NULL,
  `IdUser` int UNSIGNED DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `TimeIn` datetime DEFAULT NULL,
  `TimeOut` datetime DEFAULT NULL,
  `TotalCost` int DEFAULT NULL,
  `TotalAmount` int DEFAULT NULL,
  `PaymentMethod` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PaymentTime` datetime DEFAULT NULL,
  `Status` int UNSIGNED DEFAULT NULL,
  `Notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`IdOrder`, `IdCustomer`, `IdBooking`, `IdTable`, `Discount`, `IdUser`, `OrderDate`, `TimeIn`, `TimeOut`, `TotalCost`, `TotalAmount`, `PaymentMethod`, `PaymentTime`, `Status`, `Notes`, `created_at`, `updated_at`) VALUES
(61, 75, 59, 65, NULL, 15, '2023-05-07 19:51:50', '2023-05-07 19:51:50', NULL, 0, 710000, NULL, NULL, 3, NULL, '2023-05-07 05:51:38', '2023-05-11 04:55:09'),
(63, NULL, NULL, 64, NULL, 15, '2023-05-11 18:08:15', '2023-05-11 18:08:15', '2023-05-12 00:31:48', 280000, 365000, 'Tiền mặt', '2023-05-12 00:31:48', 2, NULL, '2023-05-11 04:08:15', '2023-05-11 10:31:48'),
(64, 76, 60, 65, NULL, 15, '2023-05-12 00:12:43', '2023-05-12 00:12:43', '2023-05-12 00:31:41', 100000, 170000, 'Tiền mặt', '2023-05-12 00:31:41', 2, NULL, '2023-05-11 10:12:38', '2023-05-11 10:31:41'),
(65, NULL, NULL, 68, NULL, 15, '2023-05-12 16:12:23', '2023-05-12 16:12:23', '2023-05-12 16:14:04', 390000, 430000, 'Tiền mặt', '2023-05-12 16:14:04', 2, NULL, '2023-05-12 09:12:23', '2023-05-12 09:14:04'),
(67, NULL, NULL, 64, NULL, 15, '2023-05-12 20:09:48', '2023-05-12 20:09:48', '2023-05-12 20:13:42', 235000, 270000, 'Tiền mặt', '2023-05-12 20:13:42', 2, NULL, '2023-05-12 13:09:48', '2023-05-12 13:13:42'),
(68, NULL, NULL, 69, NULL, 15, '2023-05-12 20:32:23', '2023-05-12 20:32:23', '2023-05-12 20:33:59', 244000, 280000, 'Tiền mặt', '2023-05-12 20:33:59', 2, NULL, '2023-05-12 13:32:23', '2023-05-12 13:33:59'),
(69, NULL, NULL, 66, NULL, 15, '2023-05-12 20:41:43', '2023-05-12 20:41:43', '2023-05-12 20:41:45', 1230000, 1570000, 'Tiền mặt', '2023-05-12 20:41:45', 2, NULL, '2023-05-12 13:41:43', '2023-05-12 13:41:45'),
(70, NULL, NULL, 67, NULL, 15, '2023-05-12 20:44:32', '2023-05-12 20:44:32', '2023-05-12 20:44:37', 540000, 550000, 'Tiền mặt', '2023-05-12 20:44:37', 2, NULL, '2023-05-12 13:44:32', '2023-05-12 13:44:37'),
(71, NULL, NULL, 73, NULL, 15, '2023-05-12 20:47:33', '2023-05-12 20:47:33', '2023-05-12 20:47:46', 64000, 720000, 'Tiền mặt', '2023-05-12 20:47:46', 2, NULL, '2023-05-12 13:47:33', '2023-05-12 13:47:46'),
(108, NULL, NULL, 64, NULL, 15, '2023-05-16 23:31:02', '2023-05-16 23:31:02', '2023-05-18 08:23:32', 900000, 975000, 'Tiền mặt', '2023-05-18 08:23:32', 2, NULL, '2023-05-16 16:31:02', '2023-05-18 01:23:32'),
(109, NULL, NULL, 66, NULL, 15, '2023-05-16 23:32:05', '2023-05-16 23:32:05', '2023-05-16 23:37:04', 333333, 455000, 'Tiền mặt', '2023-05-16 23:37:04', 2, NULL, '2023-05-16 16:32:05', '2023-05-16 16:37:04'),
(110, NULL, NULL, 68, NULL, 15, '2023-05-16 23:32:12', '2023-05-16 23:32:12', '2023-05-16 23:35:51', 590900, 720000, 'Tiền mặt', '2023-05-16 23:35:51', 2, NULL, '2023-05-16 16:32:12', '2023-05-16 16:35:51'),
(111, NULL, NULL, 73, NULL, 15, '2023-05-16 23:32:18', '2023-05-16 23:32:18', NULL, 0, 600000, NULL, NULL, 3, NULL, '2023-05-16 16:32:18', '2023-05-16 16:32:28'),
(114, 85, 127, 68, NULL, 15, '2023-05-17 17:59:18', '2023-05-17 17:59:18', '2023-05-17 23:45:39', 0, 0, 'Tiền mặt', '2023-05-17 23:45:39', 2, NULL, '2023-05-17 10:59:15', '2023-05-17 16:45:39'),
(116, 78, 130, 73, NULL, 15, '2023-05-17 18:08:47', '2023-05-17 18:08:47', '2023-05-17 23:45:44', 0, 650000, 'Tiền mặt', '2023-05-17 23:45:44', 2, NULL, '2023-05-17 11:08:47', '2023-05-17 16:45:44'),
(117, 78, 131, 66, NULL, 15, '2023-05-17 23:03:59', '2023-05-17 23:03:59', '2023-05-17 23:45:47', 805000, 805000, 'Tiền mặt', '2023-05-17 23:45:47', 2, NULL, '2023-05-17 16:03:59', '2023-05-17 16:45:47'),
(118, 78, 132, 69, NULL, 15, '2023-05-17 23:06:38', '2023-05-17 23:06:38', '2023-05-17 23:45:42', 1020000, 1610000, 'Tiền mặt', '2023-05-17 23:45:42', 2, NULL, '2023-05-17 16:06:38', '2023-05-17 16:45:42'),
(119, 84, 126, 65, NULL, 15, '2023-05-17 23:36:32', '2023-05-17 23:36:32', '2023-05-17 23:36:35', 338000, 560000, 'Tiền mặt', '2023-05-17 23:36:35', 2, NULL, '2023-05-17 16:17:09', '2023-05-17 16:36:35'),
(120, NULL, NULL, 67, NULL, 15, '2023-05-17 23:48:10', '2023-05-17 23:48:10', '2023-05-17 23:49:50', 460000, 720000, 'Tiền mặt', '2023-05-17 23:49:50', 2, NULL, '2023-05-17 16:48:10', '2023-05-17 16:49:50'),
(121, 78, 134, 65, NULL, 15, '2023-05-18 00:10:11', '2023-05-18 00:10:11', '2023-05-18 00:10:13', 460000, 720000, 'Tiền mặt', '2023-05-18 00:10:13', 2, NULL, '2023-05-17 17:08:35', '2023-05-17 17:10:13'),
(122, 78, 133, 68, NULL, 15, '2023-05-18 00:10:24', '2023-05-18 00:10:24', '2023-05-18 00:10:37', 510000, 805000, 'Tiền mặt', '2023-05-18 00:10:37', 2, NULL, '2023-05-17 17:10:22', '2023-05-17 17:10:37'),
(123, 82, 136, NULL, NULL, 15, '2023-05-18 08:27:23', '2023-05-18 08:27:23', NULL, 160000, 220000, NULL, NULL, 3, NULL, '2023-05-18 01:27:23', '2023-05-19 08:03:32'),
(124, 79, 138, 64, NULL, 15, '2023-04-19 15:30:42', '2023-04-19 15:30:42', '2023-04-19 15:30:46', 790000, 1100000, 'Tiền mặt', '2023-05-19 15:30:46', 2, NULL, '2023-05-18 01:30:59', '2023-05-19 08:30:46'),
(125, 78, 140, NULL, NULL, 15, '2023-05-19 14:44:22', '2023-05-19 14:44:22', NULL, 160000, 220000, NULL, NULL, 3, NULL, '2023-05-19 07:44:22', '2023-05-19 08:30:52'),
(126, 78, 141, NULL, NULL, 15, '2023-05-19 15:03:06', NULL, NULL, 0, 0, NULL, NULL, 3, NULL, '2023-05-19 08:03:06', '2023-05-19 08:30:55'),
(127, 87, 142, NULL, NULL, 15, '2023-05-19 15:09:16', '2023-05-19 15:09:16', NULL, 360000, 525000, NULL, NULL, 3, NULL, '2023-05-19 08:09:16', '2023-05-19 08:30:57'),
(128, 78, 143, NULL, NULL, NULL, '2023-05-19 15:18:39', '2023-05-19 15:18:39', NULL, 150000, 220000, NULL, NULL, 3, NULL, '2023-05-19 08:18:39', '2023-05-19 08:30:59'),
(129, 78, 144, NULL, NULL, NULL, '2023-05-19 15:21:14', '2023-05-19 15:21:14', NULL, 150000, 220000, NULL, NULL, 3, NULL, '2023-05-19 08:21:14', '2023-05-19 08:31:02'),
(130, 78, 145, NULL, NULL, NULL, '2023-05-19 15:25:18', '2023-05-19 15:25:18', NULL, 150000, 220000, NULL, NULL, 3, NULL, '2023-05-19 08:25:18', '2023-05-19 08:31:05'),
(131, 78, 146, 64, NULL, 15, '2023-05-19 15:31:26', '2023-05-19 15:31:26', '2023-05-19 15:31:29', 150000, 220000, 'Tiền mặt', '2023-05-19 15:31:29', 2, NULL, '2023-05-19 08:25:58', '2023-05-19 08:31:29'),
(132, 78, 147, 64, NULL, 15, '2023-05-19 15:31:08', '2023-05-19 15:31:08', '2023-05-19 15:31:13', 560000, 880000, 'Tiền mặt', '2023-05-19 15:31:13', 2, NULL, '2023-05-19 08:28:19', '2023-05-19 08:31:13'),
(133, 83, 148, 64, NULL, 15, '2023-05-19 17:42:27', '2023-05-19 17:42:27', '2023-05-19 17:42:30', 360000, 525000, 'Tiền mặt', '2023-05-19 17:42:30', 2, NULL, '2023-05-19 10:42:15', '2023-05-19 10:42:30'),
(134, 83, 149, NULL, NULL, NULL, '2023-05-22 10:37:00', '2023-05-22 10:37:00', NULL, 420000, 600000, NULL, NULL, 1, NULL, '2023-05-22 03:37:00', '2023-05-22 03:37:00'),
(135, NULL, NULL, 65, NULL, 15, '2023-05-24 03:48:38', '2023-05-24 03:48:38', '2023-05-24 03:48:57', 310000, 500000, 'Tiền mặt', '2023-05-24 03:48:57', 2, NULL, '2023-05-23 20:48:38', '2023-05-23 20:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricelist`
--

CREATE TABLE `tbl_pricelist` (
  `IdPrice` int UNSIGNED NOT NULL,
  `IdItems` int UNSIGNED NOT NULL,
  `PriceName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SalePrice` int DEFAULT NULL,
  `CostPrice` int DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(42, 6, 'Giá thường', 220000, 160000, 1, NULL, NULL, NULL),
(43, 31, 'Giá thường', 380000, 260000, 1, NULL, NULL, NULL),
(44, 28, 'Giá thường', 220000, 150000, 1, NULL, NULL, NULL),
(45, 62, 'Giá thường', 15000, 7000, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_res_info`
--

CREATE TABLE `tbl_res_info` (
  `Id` int UNSIGNED NOT NULL,
  `ResName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Hotline1` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Hotline2` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OpeningDay` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OpenTime` time DEFAULT NULL,
  `CloseTime` time DEFAULT NULL,
  `ShortDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LongDescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_res_info`
--

INSERT INTO `tbl_res_info` (`Id`, `ResName`, `Hotline1`, `Hotline2`, `Email`, `Logo`, `OpeningDay`, `OpenTime`, `CloseTime`, `ShortDescription`, `LongDescription`, `created_at`, `updated_at`) VALUES
(2, 'Nhà hàng HAH', '0865.787.333', '0989.437.113', 'hohoa201202@gmail.com', 'nhahanghah_20230514-231958.png', 'Thứ 2 - CN', '06:30:00', '21:30:00', NULL, '<h1 class=\"page_title\" style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-size: 15px; font-family: iCielBCCubano; position: relative; color: rgb(34, 34, 34);\"><span style=\"font-size: 25px; text-transform: uppercase; color: var(--extra-color); margin-left: 0px; transition: all 0.5s ease 0s;\"><b>NHÀ HÀNG HAH - SỰ LỰA CHỌN TUYỆT VỜI DÀNH CHO BẠN</b></span></h1><div class=\"summary\" style=\"margin: 16px 0px 28px; padding: 0px; font-weight: 600; color: rgb(85, 85, 85); font-family: &quot;Montserrat Alternates&quot;, Helvetica, Arial, &quot;DejaVu Sans&quot;, &quot;Liberation Sans&quot;, Freesans, sans-serif; font-size: 15px;\">Nhà hàng HAH - Nhà hàng phong cách phố Xưa Hà Nội! Một điểm đến nhuốm đậm màu thời gian, dẫu có chút hoài cổ nhưng luôn mang lại cảm giác bình yên, ấm cúng cho bất cứ ai. Đây là địa điểm lý tưởng để bạn thưởng thức bữa tiệc gặp mặt gia đình hay hội họp cùng bạn bè rôm rả.</div><div class=\"description\" style=\"margin: 0px; padding: 0px; line-height: 24px; color: rgb(34, 34, 34); font-family: &quot;Montserrat Alternates&quot;, Helvetica, Arial, &quot;DejaVu Sans&quot;, &quot;Liberation Sans&quot;, Freesans, sans-serif; font-size: 15px;\"><h2 style=\"margin: 10px 0px 12px; padding: 0px; font-size: 15px; font-family: iCielBCCubano; line-height: 30px;\"><strong>KHÔNG GIAN PHỐ XƯA HÀ NỘI</strong></h2><p style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Đã từ lâu, người ta đã không còn nhớ được rằng, nhắc đến Bò tơ quán mộc là nhớ đến Hà Nội xưa, hay nghĩ đến không gian phố xưa Hà Nội là nhớ đến Bò tơ quán mộc. Tọa lạc tại những con phố sầm uất và đông đúc người qua lại, chuỗi nhà hàng Bò tơ quán mộc trong mắt người Hà thành đã sớm trở thành địa điểm hiếm hoi, thân thuộc còn lưu giữ được vẻ đẹp thuần túy, bình yên và truyền thống.</p><p style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\"><img alt=\"\" height=\"1066\" src=\"https://botoquanmoc.com/upload_images/images/2019/06/27/51874720_579608439172564_4629655259650719744_o.jpg\" width=\"1600\" style=\"border: 1px solid rgba(243, 243, 243, 0.8); max-width: 100%; transition: all 0.9s ease 0s; height: auto !important;\"></p><p style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Đưa thực khách ngược dòng thời gian về với Hà Nội của 40 năm về trước, Bò Tơ Quán Mộc mở ra một không gian kiến trúc ấn tượng, vừa lạ vừa quen với những khung cảnh xưa cũ, giản dị, đạm bạc nhưng dịu dàng, ấm áp. Thực khách đến đây không chỉ để trải nghiệm ẩm thực mà còn để trải nghiệm một không gian gợi nhiều ký ức ấu thơ, đong đầy cảm xúc, gần gũi như chính ngôi nhà của mình. Mỗi một khung cửa gỗ, chiếc bàn, cái ghế, thậm chí là rèm cửa, chạn bát đều ẩn dấu hình bóng một Hà Nội thập niên 80 - thời điểm khốn khó, vất vả nhưng lại chan chứa tình người và tiếng cười vô tư của những đứa trẻ.</p><p style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\"><img alt=\"\" height=\"1067\" src=\"https://botoquanmoc.com/upload_images/images/2019/06/27/_H6A9387.jpg\" width=\"1600\" style=\"border: 1px solid rgba(243, 243, 243, 0.8); max-width: 100%; transition: all 0.9s ease 0s; height: auto !important;\"></p><p style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Cơ sở Bò Tơ Quán Mộc đầu tiên được mở tại biệt thự số 102 Thái Thịnh. Giữa khung cảnh phố xá ồn ã, tòa biệt thự như một lát cắt độc đáo về lối sống của người Hà Nội thủa trước. Nằm giữa sự xô bồ, hoa lệ, hiện đại, ngôi biệt thự vẫn giữ được vẻ đẹp riêng biệt nhưng không hề lạc lõng, giống như một cầu nối giữa hiện tại và quá khứ, khiến thực khách ghé thăm đều lưu luyến mãi không thôi. Trải qua hơn 1 năm hoạt động, nhận được nhiều sự yêu quý của khách hàng, Bò Tơ Quán Mộc đã tiếp tục mở cơ sở mới tại D17 ngõ 76 Nguyễn Phong Sắc, đem không gian phố Xưa đến với nhiều thực khách hơn tại Hà Nội.</p><h2 dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; font-size: 15px; font-family: iCielBCCubano; line-height: 30px;\"><strong>MÓN ĂN NGON</strong></h2><p dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Khách hàng yêu thích Bò Tơ Quán Mộc phần nhiều cũng vì món ăn ngon. Giống như tên gọi, chúng tôi chọn nguyên liệu là bò tơ – món ăn được xem là đặc sản vùng sông nước, từng tạo nên cơn sốt \"bò tơ Tây Ninh\" một thời ở Hà thành. Nhưng trải qua năm tháng, món ăn này của Bò Tơ Quán Mộc đã trở thành món ngon độc đáo mang phong vị riêng biệt của vùng Đông Kinh – Bắc Thành tự khi nào.</p><p dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Bò tơ – thứ thực phẩm có bao nhiêu thân quen với cuộc sống thường ngày, chỉ gọi tên thôi cũng thấy gần gũi, giản đơn, lại không kém phần mộc mạc, chân chất. Dẫu quen thuộc là thế, nhưng trải qua bàn tay của những vị đầu bếp chuyên nghiệp, thực đơn của nhà hàng Bò Tơ Quán Mộc lại luôn khiến thực khách phải bất ngờ và háo hức khi thưởng thức.</p><p dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\"><img alt=\"\" height=\"1067\" src=\"https://botoquanmoc.com/upload_images/images/2019/06/27/IMG_0357-2.jpg\" width=\"1600\" style=\"border: 1px solid rgba(243, 243, 243, 0.8); max-width: 100%; transition: all 0.9s ease 0s; height: auto !important;\"></p><p dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Nguyên liệu bò tơ được lựa chọn đúng theo tiêu chí TƯƠI – SẠCH – NGON để đảm bảo món ăn tròn vị, giữ được sự tươi ngon đặc trưng của thịt. Cùng với đó, các món ăn được chế biến theo công thức riêng biệt, có phần tinh tế và cầu kỳ. Ngay cả việc nêm nếm, gia giảm gia vị cũng phải được làm một cách bài bản, chăm chút, chỉ để mong mang đến được hương vị vẹn nguyên, phảng phất dáng vẻ thanh cao của chốn Hà thành.</p><p dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\">Ngồi giữa khung cảnh phố Xưa Hà Nội, ngắm dòng người tất bật qua khung cửa sổ gỗ xanh, thư giãn trong không gian ấm cúng như nhà mình, rồi nếm thử một miếng bò tơ chín mềm nóng hổi, thực khách sẽ cảm thấy cả miền ký ức Hà Nội thập niên 80 chợt thu bé lại, mênh mang và đầy thương!</p><p dir=\"ltr\" style=\"margin: 10px 0px 12px; padding: 0px; line-height: 30px;\"><strong>Hãy đến Bò Tơ Quán Mộc để tự mình trải nghiệm khách nhé!</strong></p></div>', '2023-05-14 15:59:12', '2023-05-14 16:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tables`
--

CREATE TABLE `tbl_tables` (
  `IdTable` int UNSIGNED NOT NULL,
  `TableName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdType` int UNSIGNED NOT NULL,
  `IdArea` int UNSIGNED NOT NULL,
  `IdStatus` int UNSIGNED NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_tables`
--

INSERT INTO `tbl_tables` (`IdTable`, `TableName`, `IdType`, `IdArea`, `IdStatus`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(64, '1', 6, 51, 1, 1, NULL, NULL, '2023-05-19 10:42:30'),
(65, '2', 6, 51, 1, 1, NULL, NULL, '2023-05-23 20:48:57'),
(66, '3', 6, 51, 1, 1, NULL, NULL, '2023-05-17 16:45:47'),
(67, '4', 6, 51, 1, 1, NULL, NULL, '2023-05-17 16:49:50'),
(68, '5', 6, 51, 1, 1, NULL, NULL, '2023-05-17 17:10:37'),
(69, '2', 5, 52, 1, 1, NULL, NULL, '2023-05-17 16:45:42'),
(70, '3', 5, 52, 1, 1, NULL, NULL, '2023-05-17 16:46:12'),
(71, '4', 5, 52, 1, 1, NULL, NULL, '2023-05-05 00:13:55'),
(72, '5', 6, 52, 1, 1, NULL, NULL, '2023-05-17 10:56:30'),
(73, '6', 6, 52, 1, 1, NULL, NULL, '2023-05-17 16:45:44'),
(74, '7', 6, 52, 1, 1, NULL, NULL, '2023-04-30 13:02:18'),
(75, '8', 1, 52, 1, 1, NULL, NULL, NULL),
(76, '9', 1, 52, 1, 1, NULL, NULL, '2023-05-17 10:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `IdUser` int UNSIGNED NOT NULL,
  `UserName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PassWord` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Avatar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `BirthDay` date NOT NULL DEFAULT '2023-04-03',
  `PhoneNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdGroup` int UNSIGNED NOT NULL,
  `LastLogin` datetime NOT NULL DEFAULT '2023-04-03 08:25:48',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`IdUser`, `UserName`, `PassWord`, `LastName`, `FirstName`, `Avatar`, `BirthDay`, `PhoneNumber`, `Email`, `IdGroup`, `LastLogin`, `isActive`, `Description`, `created_at`, `updated_at`) VALUES
(15, 'admin', '0cc175b9c0f1b6a831c399e269772661', 'Hồ Anh', 'Hòa', 'default.png', '2023-05-11', '0865787333', 'admin@gmail.com', 1, '2023-05-11 15:36:16', 1, '', '2023-05-11 01:36:16', '2023-05-16 13:52:15');

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
-- Indexes for table `tbl_res_info`
--
ALTER TABLE `tbl_res_info`
  ADD PRIMARY KEY (`Id`);

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
  MODIFY `IdArea` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dm_tbl_bookingstatus`
--
ALTER TABLE `dm_tbl_bookingstatus`
  MODIFY `IdStatus` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dm_tbl_branchs`
--
ALTER TABLE `dm_tbl_branchs`
  MODIFY `IdBranch` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dm_tbl_categories`
--
ALTER TABLE `dm_tbl_categories`
  MODIFY `IdCategory` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dm_tbl_orderstatus`
--
ALTER TABLE `dm_tbl_orderstatus`
  MODIFY `IdStatus` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dm_tbl_tablestatus`
--
ALTER TABLE `dm_tbl_tablestatus`
  MODIFY `IdStatus` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dm_tbl_tabletype`
--
ALTER TABLE `dm_tbl_tabletype`
  MODIFY `IdType` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dm_tbl_unit`
--
ALTER TABLE `dm_tbl_unit`
  MODIFY `IdUnit` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ht_tbl_adminwebmenu`
--
ALTER TABLE `ht_tbl_adminwebmenu`
  MODIFY `IdMenuAdmin` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ht_tbl_group`
--
ALTER TABLE `ht_tbl_group`
  MODIFY `IdGroup` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ht_tbl_menuweb`
--
ALTER TABLE `ht_tbl_menuweb`
  MODIFY `IdMenu` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ht_tbl_role`
--
ALTER TABLE `ht_tbl_role`
  MODIFY `IdRole` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `ht_tbl_slideweb`
--
ALTER TABLE `ht_tbl_slideweb`
  MODIFY `IdSlide` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `IdBooking` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_cancelledorder`
--
ALTER TABLE `tbl_cancelledorder`
  MODIFY `Id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_combo`
--
ALTER TABLE `tbl_combo`
  MODIFY `IdCombo` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_combo_items`
--
ALTER TABLE `tbl_combo_items`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `IdCustomer` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `Id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `IdItems` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `IdMenu` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_menus_items`
--
ALTER TABLE `tbl_menus_items`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `Id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `IdOrder` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tbl_pricelist`
--
ALTER TABLE `tbl_pricelist`
  MODIFY `IdPrice` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_res_info`
--
ALTER TABLE `tbl_res_info`
  MODIFY `Id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  MODIFY `IdTable` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `IdUser` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
