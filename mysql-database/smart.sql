/*
 Navicat Premium Data Transfer

 Source Server         : local_mysql
 Source Server Type    : MySQL
 Source Server Version : 80018
 Source Host           : localhost:3306
 Source Schema         : smart

 Target Server Type    : MySQL
 Target Server Version : 80018
 File Encoding         : 65001

 Date: 22/12/2019 01:06:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detail_sesi
-- ----------------------------
DROP TABLE IF EXISTS `detail_sesi`;
CREATE TABLE `detail_sesi`  (
  `ds_id` int(11) NOT NULL AUTO_INCREMENT,
  `ds_sesi_id` int(11) NULL DEFAULT NULL,
  `ds_user_id` int(11) NULL DEFAULT NULL,
  `ds_ticket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ds_tgl` datetime(0) NULL DEFAULT NULL,
  `ds_berat` float(8, 4) UNSIGNED NULL DEFAULT 0.0000,
  `ds_no_ikan` int(2) NULL DEFAULT NULL,
  `ds_status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`ds_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_sesi
-- ----------------------------
INSERT INTO `detail_sesi` VALUES (1, 23, 2, '1805350103', '2019-12-15 21:30:15', 1.2700, 1, 1);
INSERT INTO `detail_sesi` VALUES (2, 25, NULL, '1452905172', '2019-12-15 23:34:47', 2.0000, 1, 1);
INSERT INTO `detail_sesi` VALUES (3, 25, NULL, '1452905172', '2019-12-15 23:35:11', 3.3400, 2, 1);
INSERT INTO `detail_sesi` VALUES (4, 25, NULL, '340034', '2019-12-20 18:28:28', 3.4300, 1, 1);
INSERT INTO `detail_sesi` VALUES (5, 25, NULL, '340034', '2019-12-20 19:04:50', 1.2300, 1, 1);
INSERT INTO `detail_sesi` VALUES (6, 25, NULL, '10001', '2019-12-20 19:21:51', 4.4500, 3, 1);
INSERT INTO `detail_sesi` VALUES (7, 25, NULL, '340034', '2019-12-20 19:30:19', 5.9100, 4, 1);
INSERT INTO `detail_sesi` VALUES (8, 25, NULL, '350035', '2019-12-21 10:31:31', 2.6100, 1, 1);
INSERT INTO `detail_sesi` VALUES (9, 23, NULL, '360036', '2019-12-21 15:56:52', 2.1000, 1, 1);
INSERT INTO `detail_sesi` VALUES (10, 23, NULL, '360036', '2019-12-21 17:35:43', 4.0100, 2, 1);
INSERT INTO `detail_sesi` VALUES (11, 14, NULL, '370037', '2019-12-21 23:28:29', 1.2200, 1, 1);
INSERT INTO `detail_sesi` VALUES (12, 14, NULL, '0039', '2019-12-21 23:54:56', 3.2200, 1, 1);

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
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notif
-- ----------------------------
INSERT INTO `notif` VALUES (1, '1212232', 'wqesdas', 'sfsdfdsfsdfqqXZCSADF', '2017-02-07 09:58:00', 'true');
INSERT INTO `notif` VALUES (2, 'inbox', 'You have new messages from 085730252608', 'zzzzzzz', '2017-02-07 10:13:08', 'true');

-- ----------------------------
-- Table structure for participant
-- ----------------------------
DROP TABLE IF EXISTS `participant`;
CREATE TABLE `participant`  (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_user_id` int(11) NULL DEFAULT NULL,
  `p_ticket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `p_sesi_id` int(11) NULL DEFAULT NULL,
  `p_tipe` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'peserta',
  `p_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `p_hp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `p_tgl` timestamp(0) NULL DEFAULT NULL,
  `p_status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`p_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of participant
-- ----------------------------
INSERT INTO `participant` VALUES (33, NULL, '10001', 25, 'peserta', 'agus', '0876554422', '2019-12-20 17:56:39', 1);
INSERT INTO `participant` VALUES (34, NULL, '330033', 25, 'peserta', 'andri', '0876554411', '2019-12-20 17:56:53', 1);
INSERT INTO `participant` VALUES (35, NULL, '340034', 25, 'peserta', 'khaled', '08442254411', '2019-12-20 17:57:14', 1);
INSERT INTO `participant` VALUES (36, NULL, '350035', 25, 'peserta', 'Joni', '0857662211', '2019-12-20 17:58:26', 1);
INSERT INTO `participant` VALUES (37, NULL, '360036', 23, 'peserta', 'ALI', '0977662211', '2019-12-21 00:56:35', 1);
INSERT INTO `participant` VALUES (38, NULL, '370037', 14, 'peserta', 'AGUS', '0987665522', '2019-12-21 06:35:19', 1);
INSERT INTO `participant` VALUES (39, NULL, '0038', 14, 'peserta', 'DONI', '1234578', '2019-12-21 06:38:59', 1);
INSERT INTO `participant` VALUES (40, NULL, '0039', 14, 'peserta', 'CACA', '09221133', '2019-12-21 06:59:05', 1);
INSERT INTO `participant` VALUES (41, NULL, '0040', 14, 'peserta', 'Joni', '19028978', '2019-12-21 07:01:53', 1);
INSERT INTO `participant` VALUES (42, NULL, '0041', 14, 'peserta', 'GHANI', '09172321', '2019-12-21 07:06:25', 1);
INSERT INTO `participant` VALUES (43, NULL, '0042', 14, 'peserta', 'GAGA', '1234671', '2019-12-21 07:21:20', 1);
INSERT INTO `participant` VALUES (44, NULL, '0043', 14, 'peserta', 'curut', '857223322', '2019-12-21 07:22:50', 1);
INSERT INTO `participant` VALUES (45, NULL, '0044', 14, 'peserta', 'KAKA', '98221133', '2019-12-21 07:54:32', 1);
INSERT INTO `participant` VALUES (46, NULL, '0045', 14, 'peserta', 'KAPI', '98123311', '2019-12-21 07:56:28', 1);
INSERT INTO `participant` VALUES (47, NULL, '0046', 14, 'peserta', 'vvv', '1222', '2019-12-21 07:58:36', 1);
INSERT INTO `participant` VALUES (48, NULL, '0047', 14, 'peserta', 'haha', '991222', '2019-12-21 08:00:19', 1);
INSERT INTO `participant` VALUES (49, NULL, '0048', 14, 'peserta', 'oo', '1212', '2019-12-21 08:01:51', 1);
INSERT INTO `participant` VALUES (50, NULL, '0049', 14, 'peserta', 'AA', '123312', '2019-12-21 08:03:18', 1);
INSERT INTO `participant` VALUES (51, NULL, '0050', 14, 'peserta', 'BB', '2233', '2019-12-21 08:04:12', 1);
INSERT INTO `participant` VALUES (52, NULL, '0051', 14, 'peserta', 'CC', '121233', '2019-12-21 08:05:00', 1);
INSERT INTO `participant` VALUES (53, NULL, '0052', 14, 'peserta', 'gg', '331212', '2019-12-21 08:05:37', 1);
INSERT INTO `participant` VALUES (54, NULL, '0053', 14, 'peserta', 'va', '12', '2019-12-21 08:06:25', 1);
INSERT INTO `participant` VALUES (55, NULL, '0054', 14, 'peserta', 'gasik', '121233', '2019-12-21 08:09:28', 1);
INSERT INTO `participant` VALUES (56, NULL, '0055', 14, 'peserta', 'JICA', '2121555', '2019-12-21 08:11:43', 1);
INSERT INTO `participant` VALUES (57, NULL, '0056', 14, 'peserta', 'oo', '1233', '2019-12-21 08:15:18', 1);
INSERT INTO `participant` VALUES (58, NULL, '0057', 14, 'peserta', 'haha', '7777', '2019-12-21 08:16:40', 1);
INSERT INTO `participant` VALUES (59, NULL, '0058', 14, 'peserta', 'gogo', '091212', '2019-12-21 08:18:18', 1);
INSERT INTO `participant` VALUES (60, NULL, '0059', 14, 'peserta', 'FF', '4444', '2019-12-21 08:19:31', 1);
INSERT INTO `participant` VALUES (61, NULL, '0060', 14, 'peserta', 'jojo', '1212', '2019-12-21 08:21:48', 1);
INSERT INTO `participant` VALUES (62, NULL, '0061', 14, 'peserta', 'koko', '5050', '2019-12-21 08:22:26', 1);
INSERT INTO `participant` VALUES (63, NULL, '0062', 14, 'peserta', 'kiki', '5151', '2019-12-21 08:23:43', 1);
INSERT INTO `participant` VALUES (64, NULL, '0063', 14, 'peserta', 'Kontri', '0857665522', '2019-12-21 08:55:36', 1);

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran`  (
  `bayar_id` int(255) NOT NULL AUTO_INCREMENT,
  `bayar_siswa` int(255) NOT NULL,
  `bayar_nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bayar_jml` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bayar_ket` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bayar_bln` int(2) NOT NULL,
  `bayar_thn` int(5) NOT NULL,
  `bayar_tgl` date NOT NULL,
  `bayar_jenis` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bayar_status` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`bayar_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembayaran
-- ----------------------------
INSERT INTO `pembayaran` VALUES (1, 2, 'doni', '250000', 'SPP BULAN APRIL', 4, 2015, '2015-04-06', 'SPP', 'LUNAS');
INSERT INTO `pembayaran` VALUES (2, 1, 'adi', '100000', 'pembayaran spp kelas 1 bulan april 2015', 4, 2015, '2015-04-20', 'SPP', 'LUNAS');

-- ----------------------------
-- Table structure for sesi
-- ----------------------------
DROP TABLE IF EXISTS `sesi`;
CREATE TABLE `sesi`  (
  `sesi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sesi_no` int(2) NULL DEFAULT NULL,
  `sesi_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sesi_jml_peserta` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sesi_tgl` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `sesi_durasi` time(0) NULL DEFAULT NULL,
  `sesi_jam` int(3) NULL DEFAULT 0,
  `sesi_menit` int(3) NULL DEFAULT 0,
  `sesi_start` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `sesi_stop` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `sesi_status` int(1) NULL DEFAULT 0 COMMENT '0 = open, 1= started, 2=stop',
  PRIMARY KEY (`sesi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sesi
-- ----------------------------
INSERT INTO `sesi` VALUES (1, 4, 'lomba1', '10', '2019-12-21 18:16:04', '13:32:51', 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);
INSERT INTO `sesi` VALUES (14, 1, 'Akhir Tahun', '12', '2019-12-22 00:53:58', NULL, 5, 15, '2019-12-22 00:53:58', '2019-12-22 00:53:58', 1);
INSERT INTO `sesi` VALUES (15, 1, 'DD', '121', '2019-12-21 18:16:04', NULL, 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);
INSERT INTO `sesi` VALUES (16, 3, '33', '333', '2019-12-21 18:16:04', NULL, 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);
INSERT INTO `sesi` VALUES (22, 3, 'RERE', '100', '2019-12-21 18:16:04', NULL, 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);
INSERT INTO `sesi` VALUES (23, 1, 'TAUN BARUAN', '200', '2019-12-21 22:27:32', '12:00:00', 12, 30, '2019-12-21 22:27:32', '2019-12-21 21:27:30', 2);
INSERT INTO `sesi` VALUES (24, 1, '22', '22', '2019-12-21 18:16:04', '00:40:00', 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);
INSERT INTO `sesi` VALUES (25, 1, 'SESI 123', '121', '2019-12-21 18:16:04', '04:00:00', 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);
INSERT INTO `sesi` VALUES (26, 1, 'DDDDDDD', '122', '2019-12-21 18:16:04', '02:00:00', 0, 0, '2019-12-21 18:16:04', '2019-12-21 18:16:04', 0);

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket`  (
  `ticket_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ticket_sesi_id` int(11) NULL DEFAULT NULL,
  `ticket_user_id` int(11) NULL DEFAULT NULL,
  `ticket_tipe` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ticket_tgl` datetime(0) NULL DEFAULT NULL,
  `ticket_status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`ticket_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `users` VALUES (4, 'q', 'q', 'q', '1', 'q@q.1', 'PESERTA', 'hospital1.png', 1, '2019-12-18 10:32:14', '2019-12-18 10:32:14', 0);
INSERT INTO `users` VALUES (5, '22', '22', '22', '22', '22@22.22', 'PESERTA', 'lonceng_300.png', 1, '2019-12-18 10:33:58', '2019-12-18 10:33:58', 0);
INSERT INTO `users` VALUES (6, 'yyy', 'yyy', 'yyy', '817298173', 'yy@yy.yy', 'PESERTA', '', 1, '2019-12-18 12:09:49', '2019-12-18 12:09:49', 0);

-- ----------------------------
-- View structure for pilih_sesi
-- ----------------------------
DROP VIEW IF EXISTS `pilih_sesi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `pilih_sesi` AS select `a`.`ds_id` AS `ds_id`,`a`.`ds_sesi_id` AS `ds_sesi_id`,`a`.`ds_user_id` AS `ds_user_id`,`a`.`ds_ticket` AS `ds_ticket`,`a`.`ds_tgl` AS `ds_tgl`,`a`.`ds_berat` AS `ds_berat`,`a`.`ds_no_ikan` AS `ds_no_ikan`,`a`.`ds_status` AS `ds_status`,`b`.`sesi_nama` AS `sesi_nama`,`c`.`user_nama` AS `user_nama`,`b`.`sesi_tgl` AS `sesi_tgl`,`b`.`sesi_start` AS `sesi_start`,`b`.`sesi_stop` AS `sesi_stop`,rank() OVER (PARTITION BY `a`.`ds_sesi_id` ORDER BY `a`.`ds_berat` desc )  AS `ranking` from ((`detail_sesi` `a` left join `sesi` `b` on((`a`.`ds_sesi_id` = `b`.`sesi_id`))) left join `users` `c` on((`a`.`ds_user_id` = `c`.`user_id`))) order by `a`.`ds_user_id`,`a`.`ds_berat` desc;

-- ----------------------------
-- View structure for v_grup_timbangan
-- ----------------------------
DROP VIEW IF EXISTS `v_grup_timbangan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_grup_timbangan` AS select `v_sesi`.`p_ticket` AS `p_ticket`,`v_sesi`.`p_sesi_id` AS `p_sesi_id`,rank() OVER (PARTITION BY `v_sesi`.`p_sesi_id` ORDER BY `v_sesi`.`p_sesi_id`,`v_sesi`.`p_ticket` desc )  AS `ranking` from `v_sesi` group by `v_sesi`.`p_ticket`,`v_sesi`.`p_sesi_id`;

-- ----------------------------
-- View structure for v_sesi
-- ----------------------------
DROP VIEW IF EXISTS `v_sesi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_sesi` AS select `a`.`p_id` AS `p_id`,`a`.`p_user_id` AS `p_user_id`,`a`.`p_ticket` AS `p_ticket`,`a`.`p_sesi_id` AS `p_sesi_id`,`a`.`p_tipe` AS `p_tipe`,`a`.`p_nama` AS `p_nama`,`a`.`p_hp` AS `p_hp`,`a`.`p_tgl` AS `p_tgl`,`a`.`p_status` AS `p_status`,`b`.`ds_berat` AS `ds_berat`,`b`.`ds_id` AS `ds_id`,`b`.`ds_no_ikan` AS `ds_no_ikan`,`b`.`ds_tgl` AS `ds_tgl`,if((`b`.`ds_berat` is not null),rank() OVER (PARTITION BY `a`.`p_sesi_id` ORDER BY `b`.`ds_berat` desc ) ,999) AS `ranking` from (`participant` `a` left join `detail_sesi` `b` on(((`a`.`p_sesi_id` = `b`.`ds_sesi_id`) and (`a`.`p_ticket` = `b`.`ds_ticket`))));

SET FOREIGN_KEY_CHECKS = 1;
