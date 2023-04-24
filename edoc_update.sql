/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : edoc

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 21/04/2023 14:50:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `aemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apassword` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`aemail`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('admin@edoc.com', '123');

-- ----------------------------
-- Table structure for appointment
-- ----------------------------
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment`  (
  `appoid` int NOT NULL AUTO_INCREMENT,
  `pid` int NULL DEFAULT NULL,
  `apponum` int NULL DEFAULT NULL,
  `scheduleid` int NULL DEFAULT NULL,
  `appodate` date NULL DEFAULT NULL,
  PRIMARY KEY (`appoid`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `scheduleid`(`scheduleid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of appointment
-- ----------------------------
INSERT INTO `appointment` VALUES (1, 1, 1, 1, '2022-06-03');
INSERT INTO `appointment` VALUES (2, 1, 1, 9, '2023-04-21');

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor`  (
  `docid` int NOT NULL AUTO_INCREMENT,
  `docemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `docname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `docpassword` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `docnic` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `doctel` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `specialties` int NULL DEFAULT NULL,
  PRIMARY KEY (`docid`) USING BTREE,
  INDEX `specialties`(`specialties`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of doctor
-- ----------------------------
INSERT INTO `doctor` VALUES (3, 'blue@test.com', 'Blue', '123', '', '+445782121544', 58);
INSERT INTO `doctor` VALUES (2, 'pinky@test.com', 'Pinky', '123', '', '+6432554521', 57);

-- ----------------------------
-- Table structure for patient
-- ----------------------------
DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient`  (
  `pid` int NOT NULL AUTO_INCREMENT,
  `pemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ppassword` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `paddress` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pnic` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pdob` date NULL DEFAULT NULL,
  `ptel` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patient
-- ----------------------------
INSERT INTO `patient` VALUES (1, 'patient@edoc.com', 'Test Patient', '123', 'Sri Lanka', '0000000000', '2000-01-01', '0120000000');
INSERT INTO `patient` VALUES (2, 'emhashenudara@gmail.com', 'Hashen Udara', '123', 'Sri Lanka', '0110000000', '2022-06-03', '0700000000');
INSERT INTO `patient` VALUES (3, 'devstev2022@gmail.com', 'Steve Kane', 'qkrrmadlf199518', 'Toronto, Canada', '', '1995-01-08', '');

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule`  (
  `scheduleid` int NOT NULL AUTO_INCREMENT,
  `docid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `scheduledate` date NULL DEFAULT NULL,
  `scheduletime` time NULL DEFAULT NULL,
  `nop` int NULL DEFAULT NULL,
  PRIMARY KEY (`scheduleid`) USING BTREE,
  INDEX `docid`(`docid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schedule
-- ----------------------------
INSERT INTO `schedule` VALUES (1, '2', 'Test Session', '2050-01-01', '18:00:00', 50);
INSERT INTO `schedule` VALUES (9, '3', 'Test Session', '2023-04-22', '17:27:00', 511);

-- ----------------------------
-- Table structure for specialties
-- ----------------------------
DROP TABLE IF EXISTS `specialties`;
CREATE TABLE `specialties`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `procedure` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 59 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of specialties
-- ----------------------------
INSERT INTO `specialties` VALUES (57, 'Orthodontics & Dentofacial Orthopedics', '*Tooth Extraction\r\n*Dental Pasta/Filling\r\n*Dental Cleaning\r\n*Denture Procedure\r\n*Dental Braces Installation\r\n*Dental Retainers');
INSERT INTO `specialties` VALUES (58, 'Oral and Maxillofacial Surgery', '*Periodontal Surgery\r\n*Spical Surgery\r\n*Implant Surgery\r\n*Surgical Extractions of Teeth');

-- ----------------------------
-- Table structure for webuser
-- ----------------------------
DROP TABLE IF EXISTS `webuser`;
CREATE TABLE `webuser`  (
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `usertype` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of webuser
-- ----------------------------
INSERT INTO `webuser` VALUES ('admin@edoc.com', 'a');
INSERT INTO `webuser` VALUES ('blue@test.com', 'd');
INSERT INTO `webuser` VALUES ('patient@edoc.com', 'p');
INSERT INTO `webuser` VALUES ('emhashenudara@gmail.com', 'p');
INSERT INTO `webuser` VALUES ('devstev2022@gmail.com', 'p');
INSERT INTO `webuser` VALUES ('pinky@test.com', 'd');

SET FOREIGN_KEY_CHECKS = 1;
