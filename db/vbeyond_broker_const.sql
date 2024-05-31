/*
 Navicat Premium Data Transfer

 Source Server         : DB_Localhost
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : vbeyond_broker_const

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 31/05/2024 11:10:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cus_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cus_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `onsite_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `notify_id` int NULL DEFAULT NULL,
  `budget` int NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `maps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (3, 'BCO-001', 'ธนามณี ธาราวงศ์', '061111023', 'อยู่ระหว่างประสานงาน', NULL, NULL, NULL, 6, 1200000, 'เกาะเต่า', 'https://maps.app.goo.gl/Lnwsu5yb3nSChFHP7', 'ทดสอบ', 'ทดสอบหมายเหตุ', '2024-05-27 12:05:18', '2024-05-27 12:05:18', NULL);
INSERT INTO `customers` VALUES (4, 'BCO-002', 'ญาสิตา เจริญสิน', '098934120', 'อยู่ระหว่างประสานงาน', NULL, NULL, NULL, 6, 55000, 'เชียงใหม่', 'https://maps.app.goo.gl/t2iSgwgKv5KcgPDU9', '<p><b>รายละเอียด</b></p><ol><li><b>หนึ่ง</b></li><li><b>สอง</b></li><li><b>สาม</b></li></ol>', NULL, '2024-05-27 13:09:57', '2024-05-27 13:38:37', NULL);
INSERT INTO `customers` VALUES (5, 'BCO-003', 'ธมน ภูภาค', '09872910', 'อยู่ระหว่างประสานงาน', NULL, NULL, NULL, 7, 800000, 'ชลบุรี', 'https://maps.app.goo.gl/U53Fe9tA43kwQEhU7', '<ol><li>ทดสอบ1</li><li><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">ทดสอบ2</font></li></ol>', NULL, '2024-05-27 14:37:54', '2024-05-27 14:37:54', NULL);

-- ----------------------------
-- Table structure for emails
-- ----------------------------
DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of emails
-- ----------------------------
INSERT INTO `emails` VALUES (2, 'sirawich.t@vbeyond.co.th', 0, '2024-05-14 05:00:10', '2024-05-20 04:28:54');
INSERT INTO `emails` VALUES (3, 'santi.c@vbeyond.co.th', 1, '2024-05-14 06:16:27', '2024-05-20 10:05:00');

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES (3, '3', '1716786318_6654148eeeaa4.pdf', '2024-05-27 12:05:18', '2024-05-27 12:05:18');
INSERT INTO `files` VALUES (4, '4', '1716790197_665423b5b7985.pdf', '2024-05-27 13:09:57', '2024-05-27 13:09:57');
INSERT INTO `files` VALUES (6, '5', '1716795475_665438531a35e.pdf', '2024-05-27 14:37:55', '2024-05-27 14:37:55');
INSERT INTO `files` VALUES (7, '5', '1716795770_6654397a31b7d.pdf', '2024-05-27 14:42:50', '2024-05-27 14:42:50');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `cus_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (5, '3', '1716786318_6654148eea8f4.jpg', '2024-05-27 12:05:18', '2024-05-27 12:05:18');
INSERT INTO `images` VALUES (6, '3', '1716786318_6654148eed10a.png', '2024-05-27 12:05:18', '2024-05-27 12:05:18');
INSERT INTO `images` VALUES (7, '3', '1716786318_6654148eedddf.jpg', '2024-05-27 12:05:18', '2024-05-27 12:05:18');
INSERT INTO `images` VALUES (8, '4', '1716790197_665423b574e47.jpg', '2024-05-27 13:09:57', '2024-05-27 13:09:57');
INSERT INTO `images` VALUES (9, '5', '1716795474_66543852dad00.jpg', '2024-05-27 14:37:55', '2024-05-27 14:37:55');
INSERT INTO `images` VALUES (10, '5', '1716795475_6654385317e27.jpg', '2024-05-27 14:37:55', '2024-05-27 14:37:55');

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of logs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (3, '2024_05_08_091214_create_logs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_05_08_091728_create_role_user_table', 1);

-- ----------------------------
-- Table structure for notify
-- ----------------------------
DROP TABLE IF EXISTS `notify`;
CREATE TABLE `notify`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sla` int NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notify
-- ----------------------------
INSERT INTO `notify` VALUES (5, 'รีโนเวท', 37, '2024-05-13 07:05:25', '2024-05-13 07:05:25');
INSERT INTO `notify` VALUES (6, 'ก่อสร้าง', 75, '2024-05-13 07:08:21', '2024-05-13 07:08:21');
INSERT INTO `notify` VALUES (7, 'ออกแบบ', 30, '2024-05-13 07:09:08', '2024-05-13 11:22:39');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `role_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 3464, 'SuperAdmin', 1, '2024-05-08 10:25:04', '2024-05-08 10:25:04');
INSERT INTO `role_user` VALUES (4, 1234, 'SuperAdmin', 1, '2024-05-09 11:49:02', '2024-05-09 11:49:20');

SET FOREIGN_KEY_CHECKS = 1;
