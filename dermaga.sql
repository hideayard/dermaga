/*
 Navicat Premium Data Transfer

 Source Server         : local_mysql
 Source Server Type    : MySQL
 Source Server Version : 80018
 Source Host           : localhost:3306
 Source Schema         : dermaga

 Target Server Type    : MySQL
 Target Server Version : 80018
 File Encoding         : 65001

 Date: 08/02/2020 02:24:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cmd
-- ----------------------------
DROP TABLE IF EXISTS `cmd`;
CREATE TABLE `cmd`  (
  `cmd_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cmd_node_nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cmd_tx` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cmd_rx` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cmd_time_tx` datetime(0) NULL DEFAULT NULL,
  `cmd_time_rx` datetime(0) NULL DEFAULT NULL,
  `cmd_status` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`cmd_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cmd
-- ----------------------------
INSERT INTO `cmd` VALUES (1, 'Lampu 1', 'OFF', NULL, '2020-01-27 06:43:02', NULL, 0);
INSERT INTO `cmd` VALUES (2, 'Lampu 1', 'OFF', NULL, '2020-01-27 06:43:04', NULL, 0);
INSERT INTO `cmd` VALUES (3, 'Lampu 2', 'OFF', NULL, '2020-01-27 06:43:58', NULL, 0);
INSERT INTO `cmd` VALUES (4, 'Lampu 1', '0', NULL, '2020-01-29 02:25:55', NULL, 0);
INSERT INTO `cmd` VALUES (5, 'Lampu 1', '0', NULL, '2020-01-29 02:33:37', NULL, 0);
INSERT INTO `cmd` VALUES (6, 'Lampu 1', '0', NULL, '2020-01-29 02:35:55', NULL, 0);
INSERT INTO `cmd` VALUES (7, 'Lampu 1', '0', NULL, '2020-01-29 02:36:36', NULL, 0);
INSERT INTO `cmd` VALUES (8, 'Lampu 1', '0', NULL, '2020-01-29 02:38:01', NULL, 0);
INSERT INTO `cmd` VALUES (9, 'Lampu 1', '0', '1', '2020-01-29 02:38:41', '2020-01-30 07:54:19', 1);
INSERT INTO `cmd` VALUES (10, 'Lampu 1', '07:00;08:00;1', NULL, '2020-01-30 15:44:31', NULL, 0);
INSERT INTO `cmd` VALUES (11, 'Lampu 1', '1', NULL, '2020-01-30 15:46:28', NULL, 0);
INSERT INTO `cmd` VALUES (12, 'Lampu 1', '07:00;08:00;1\n', NULL, '2020-01-30 15:46:34', NULL, 0);
INSERT INTO `cmd` VALUES (13, 'Lampu 1', '07:00;08:00;1\n', NULL, '2020-01-30 15:46:34', NULL, 0);
INSERT INTO `cmd` VALUES (14, 'Lampu 1', '07:00;08:00;1', NULL, '2020-01-30 15:46:38', NULL, 0);
INSERT INTO `cmd` VALUES (15, 'Lampu 1', 'C07:00;08:00;1', NULL, '2020-01-30 15:47:57', NULL, 0);
INSERT INTO `cmd` VALUES (16, 'Lampu 1', '<B0', NULL, '2020-02-07 10:11:26', NULL, 0);
INSERT INTO `cmd` VALUES (17, 'Lampu 1', '<B1', NULL, '2020-02-07 10:12:13', NULL, 0);
INSERT INTO `cmd` VALUES (18, 'Lampu 2', '<B1', NULL, '2020-02-07 10:12:30', NULL, 0);
INSERT INTO `cmd` VALUES (19, 'Lampu 2', '<B0', NULL, '2020-02-07 10:12:57', NULL, 0);
INSERT INTO `cmd` VALUES (20, 'Lampu 1', '<B0', NULL, '2020-02-07 10:25:47', NULL, 0);
INSERT INTO `cmd` VALUES (21, 'Lampu 1', '<B1', NULL, '2020-02-07 10:25:48', NULL, 0);
INSERT INTO `cmd` VALUES (22, 'Lampu 1', '<B0', NULL, '2020-02-07 10:25:48', NULL, 0);
INSERT INTO `cmd` VALUES (23, 'Lampu 1', '<B1', NULL, '2020-02-07 10:25:49', NULL, 0);

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node`  (
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `node_ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `node_nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `node_cmd` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `node_tgl` timestamp(0) NULL DEFAULT NULL,
  `node_status` int(1) NULL DEFAULT NULL,
  `node_timer_on` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `node_timer_off` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `node_timer_status` int(1) UNSIGNED NULL DEFAULT 0,
  `node_time_on` datetime(0) NULL DEFAULT NULL,
  `node_time_off` datetime(0) NULL DEFAULT NULL,
  `node_last_maintenance` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`node_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES (1, NULL, 'Lampu 1', '1', '2019-12-24 07:23:21', 1, '2020-02-05 19:27:47', '2020-02-05 19:27:47', 1, '2020-01-30 17:44:30', NULL, '2020-02-05 19:27:47');
INSERT INTO `node` VALUES (2, NULL, 'Lampu 2', '0', '2019-12-24 07:24:26', 1, '2020-01-31 18:52:01', '2020-01-31 18:52:01', 0, NULL, '2020-01-31 16:01:40', NULL);
INSERT INTO `node` VALUES (3, NULL, 'Lampu 3', '1', NULL, 1, '2020-01-31 18:52:08', '2020-01-31 18:52:08', 0, '2020-01-31 15:01:55', NULL, NULL);
INSERT INTO `node` VALUES (4, NULL, 'Lampu 4', '1', NULL, 1, '2020-02-05 19:27:51', '2020-02-05 19:27:51', 1, '2020-01-31 16:22:01', NULL, '2020-02-05 19:27:51');
INSERT INTO `node` VALUES (5, NULL, 'Lampu 5', '0', NULL, 1, '2020-01-31 18:02:11', '2020-01-31 18:02:11', 0, NULL, '2020-01-31 18:02:05', NULL);
INSERT INTO `node` VALUES (6, NULL, 'Lampu 6', '1', NULL, 1, '2020-01-31 17:40:57', '2020-01-31 17:40:57', 0, NULL, NULL, NULL);
INSERT INTO `node` VALUES (7, NULL, 'Lampu 7', '1', NULL, 1, '2020-02-05 19:27:57', '2020-02-05 19:27:57', 1, NULL, NULL, '2020-02-05 19:27:57');
INSERT INTO `node` VALUES (8, NULL, 'Lampu 8', '0', NULL, 1, '2020-01-31 17:41:01', '2020-01-31 17:41:01', 0, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for notif
-- ----------------------------
DROP TABLE IF EXISTS `notif`;
CREATE TABLE `notif`  (
  `notif_id` int(255) NOT NULL AUTO_INCREMENT,
  `notif_from` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notif_title` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notif_text` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notif_date` datetime(0) NOT NULL,
  `notif_processed` enum('true','false') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`notif_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notif
-- ----------------------------
INSERT INTO `notif` VALUES (1, '1212232', 'wqesdas', 'sfsdfdsfsdfqqXZCSADF', '2017-02-07 09:58:00', 'true');
INSERT INTO `notif` VALUES (2, 'inbox', 'You have new messages from 085730252608', 'zzzzzzz', '2017-02-07 10:13:08', 'true');

-- ----------------------------
-- Table structure for sensor_data
-- ----------------------------
DROP TABLE IF EXISTS `sensor_data`;
CREATE TABLE `sensor_data`  (
  `sensor_data_id` int(255) NOT NULL AUTO_INCREMENT,
  `sensor_data_node_id` int(11) NULL DEFAULT NULL,
  `sensor_data_node_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sensor_data_voltase` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sensor_data_arus` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sensor_data_daya` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sensor_data_kwh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sensor_data_tanggal` datetime(0) NULL DEFAULT NULL,
  `sensor_data_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sensor_data_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sensor_data
-- ----------------------------
INSERT INTO `sensor_data` VALUES (1, NULL, 'Lampu 1', '220', '20', '5', '1234', '2020-01-29 02:42:00', '1');
INSERT INTO `sensor_data` VALUES (2, NULL, 'Lampu 1', '220', '10', '20', '1255', '2020-01-31 23:03:06', '1');
INSERT INTO `sensor_data` VALUES (3, NULL, 'Lampu 2', '220', '1', '5', '133', '2020-02-01 00:27:40', '1');
INSERT INTO `sensor_data` VALUES (4, NULL, 'Lampu 2', '220', '2', '4', '140', '2020-02-01 00:28:21', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_pass` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_hp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_tipe` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_foto` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_status` int(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `modified_at` timestamp(0) NULL DEFAULT NULL,
  `is_deleted` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin jaya abadi', '21232f297a57a5a743894a0e4a801fc3', '085730252608', 'zz@zz.zz', 'ADMIN', 'announcement.png', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'fahri', 'fahri kurniawan', '21232f297a57a5a743894a0e4a801fc3', NULL, 'fahri@gmail.com', 'OWNER', 'avatar5.png', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'doni', 'doni setiawan', '21232f297a57a5a743894a0e4a801fc3', NULL, 'doni@gmail.com', 'PEGAWAI', 'avatar01.png', 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'q', 'q', 'q', '1', 'q@q.1', 'PESERTA', 'hospital1.png', 1, '2019-12-18 09:32:14', '2019-12-18 09:32:14', 0);
INSERT INTO `users` VALUES (5, '22', '22', '22', '22', '22@22.22', 'PESERTA', 'lonceng_300.png', 1, '2019-12-18 09:33:58', '2019-12-18 09:33:58', 0);
INSERT INTO `users` VALUES (6, 'yyy', 'yyy', 'yyy', '817298173', 'yy@yy.yy', 'PESERTA', '', 1, '2019-12-18 11:09:49', '2019-12-18 11:09:49', 0);
