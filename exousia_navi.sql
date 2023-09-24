-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 12:23 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exousia_navi`
--

-- --------------------------------------------------------

--
-- Table structure for table `eastwoods_facilities`
--

CREATE TABLE `eastwoods_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facilities` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eastwoods_facilities`
--

INSERT INTO `eastwoods_facilities` (`id`, `facilities`, `operation_time`, `created_at`, `updated_at`, `floor`) VALUES
(2, 'epas', '08:00 am', '2023-09-06 10:54:52', '2023-09-23 10:53:36', 'floor-1'),
(3, 'beatae', '06:54 am', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-1'),
(4, 'illum', '13:01 pm', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-2'),
(5, 'sit', '10:38 am', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-2'),
(6, 'qui', '22:32 pm', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-3'),
(7, 'sed', '11:20 am', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-3'),
(8, 'laborum', '07:24 am', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-4'),
(9, 'tempora', '00:38 am', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-4'),
(10, 'necessitatibus', '16:50 pm', '2023-09-06 10:56:54', '2023-09-23 10:51:48', 'floor-5'),
(13, 'library', '09:00 am', '2023-09-23 10:37:58', '2023-09-23 10:37:58', 'floor-1'),
(14, 'saso', '8:00 am', '2023-09-23 10:37:58', '2023-09-23 10:37:58', 'ground-floor'),
(15, 'guidance', '9:00 am', '2023-09-23 10:37:58', '2023-09-23 10:37:58', 'ground-floor');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floorplans`
--

CREATE TABLE `floorplans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gridSize` bigint(20) NOT NULL,
  `gridDetails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`gridDetails`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floorplans`
--

INSERT INTO `floorplans` (`id`, `floor`, `gridSize`, `gridDetails`, `created_at`, `updated_at`) VALUES
(32, 'ground-floor', 40, '[{\"x\":\"0\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"1\",\"isBlock\":\"true\",\"label\":\"saso\"},{\"x\":\"0\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"1\",\"isBlock\":\"true\",\"label\":\"stair-in\"},{\"x\":\"0\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"2\",\"isBlock\":\"true\",\"label\":\"guidance\"},{\"x\":\"1\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"3\",\"isBlock\":\"true\",\"label\":\"front\"},{\"x\":\"3\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null}]', '2023-09-23 12:29:42', '2023-09-23 12:29:42'),
(33, 'floor-1', 40, '[{\"x\":\"0\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"1\",\"isBlock\":\"true\",\"label\":\"library\"},{\"x\":\"0\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"1\",\"isBlock\":\"true\",\"label\":\"stair-in\"},{\"x\":\"0\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"3\",\"isBlock\":\"true\",\"label\":\"front\"},{\"x\":\"3\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null}]', '2023-09-23 14:16:36', '2023-09-23 14:16:36'),
(34, 'floor-2', 40, '[{\"x\":\"0\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"1\",\"isBlock\":\"true\",\"label\":\"sit\"},{\"x\":\"0\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"1\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"0\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"1\",\"isBlock\":\"true\",\"label\":\"stair-in\"},{\"x\":\"1\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"1\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"2\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"3\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"2\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"3\",\"isBlock\":\"true\",\"label\":\"front\"},{\"x\":\"3\",\"y\":\"0\",\"width\":\"80\",\"height\":\"80\",\"row\":\"1\",\"column\":\"4\",\"isBlock\":\"true\",\"label\":\"illum\"},{\"x\":\"3\",\"y\":\"1\",\"width\":\"80\",\"height\":\"80\",\"row\":\"2\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"2\",\"width\":\"80\",\"height\":\"80\",\"row\":\"3\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"3\",\"width\":\"80\",\"height\":\"80\",\"row\":\"4\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"4\",\"width\":\"80\",\"height\":\"80\",\"row\":\"5\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"5\",\"width\":\"80\",\"height\":\"80\",\"row\":\"6\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"6\",\"width\":\"80\",\"height\":\"80\",\"row\":\"7\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"7\",\"width\":\"80\",\"height\":\"80\",\"row\":\"8\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"8\",\"width\":\"80\",\"height\":\"80\",\"row\":\"9\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null},{\"x\":\"3\",\"y\":\"9\",\"width\":\"80\",\"height\":\"80\",\"row\":\"10\",\"column\":\"4\",\"isBlock\":\"false\",\"label\":null}]', '2023-09-24 12:54:21', '2023-09-24 12:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `frequentlies`
--

CREATE TABLE `frequentlies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `frequently` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frequentlies`
--

INSERT INTO `frequentlies` (`id`, `frequently`, `created_at`, `updated_at`) VALUES
(1, 'who is teacher1?', '2023-09-10 05:40:37', '2023-09-10 15:22:03'),
(2, 'where is the library located?', '2023-09-10 05:41:57', '2023-09-10 20:19:26'),
(3, 'who is jaypee?', '2023-09-10 05:41:57', '2023-09-10 07:21:27'),
(6, 'Where exactly can I locate the epas?', '2023-09-19 07:28:37', '2023-09-19 07:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2023_09_06_074928_create_eastwoods_facilities_table', 2),
(6, '2023_09_10_021546_create_frequentlies_table', 3),
(7, '2023_09_10_091441_create_teachers_table', 4),
(10, '2023_09_14_154828_create_floorplans_table', 5),
(11, '2023_09_17_132424_update_table_name', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `position`, `created_at`, `updated_at`) VALUES
(1, 'teacher1', 'teacher', '2023-09-10 12:50:22', '2023-09-19 17:19:12'),
(2, 'teacher3', 'principal', '2023-09-10 12:50:22', '2023-09-19 17:19:12'),
(4, 'teacher2', 'teacher', '2023-09-10 13:41:01', '2023-09-19 17:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jaypee', 'admin@gmail.com', NULL, '$2y$10$4/s2F.DG5/Nsy3AB8ojrU.qTCTpJx/KIXV.w6XpiT6WWIw1kLxAj.', NULL, '2023-09-06 10:11:10', '2023-09-06 10:11:10'),
(2, 'corine', 'jpquintana01@gmail.com', NULL, '$2y$10$WggmAaSgBY8GuIIXSaK0q.lgZNit5uFCOSjsVFoi08K/o4bQy0Y1a', NULL, '2023-09-06 10:40:43', '2023-09-06 10:40:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eastwoods_facilities`
--
ALTER TABLE `eastwoods_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floorplans`
--
ALTER TABLE `floorplans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frequentlies`
--
ALTER TABLE `frequentlies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eastwoods_facilities`
--
ALTER TABLE `eastwoods_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floorplans`
--
ALTER TABLE `floorplans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `frequentlies`
--
ALTER TABLE `frequentlies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
