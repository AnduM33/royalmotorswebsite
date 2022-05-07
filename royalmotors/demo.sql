/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MariaDB
 Source Server Version : 100315
 Source Host           : localhost:3306
 Source Schema         : demo

 Target Server Type    : MariaDB
 Target Server Version : 100315
 File Encoding         : 65001

 Date: 25/05/2019 17:36:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Peter', 'Parker', 'peter@parker.com', 'peterparker', '$2y$10$bZHp27QjG7BRWgjx.uUPSO1gjnXS9epzFG9Je1Z.VURcMdN/rVxs2', '11', '2019-05-25 10:10:55');
INSERT INTO `users` VALUES (3, 'John', 'Doe', 'john@doe.com', 'johndoe', '$2y$10$bcSwT50ntA.rwJwKW/oEc.kRuZtmyXz1qD5mslSHtRWQ40qYrVXXe', NULL, NULL);
INSERT INTO `users` VALUES (9, 'Student', 'Laborator', 'student@ulbsibiu.ro', 'student', '$2y$10$69CEIv9u4PKBnVu/Ilwxxe8iKGhsDGjtKzWIUllx2RqKW6RwJR9jC', NULL, NULL);
INSERT INTO `users` VALUES (10, 'Marco', 'Polo', 'marco@polo.com', 'marcopolo', '$2y$10$4RFZ1ULC0ARhAr4OeoIEqO65cOI3w.7p.xc.hnMuWtfJs0jigoueC', NULL, NULL);
INSERT INTO `users` VALUES (14, 'Zeno', 'Popovici', 'zeno@graffino.com', 'zeno', '$2y$10$og8M0NtVl68MgCX8P/SOweKczuCCANCLwh.Yo1zaAmZD1uvUrg5DC', '85ed58daa697dcfe851f01c2b04b98ac2c028ce1cf3e7b9ac8d7af732b59eb822e2d7dcf6e5d263966062ed5a488547f2b6cc66011e1cf32a14332c8770ff266', '2019-05-25 18:17:16');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
