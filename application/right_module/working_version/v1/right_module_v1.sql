/*
Navicat MySQL Data Transfer

Source Server         : Windows_WampServer
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : dlth_xm_v1

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-09-22 22:56:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_home_users
-- ----------------------------
DROP TABLE IF EXISTS `data_home_users`;
CREATE TABLE `data_home_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_openid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_openid` (`user_openid`),
  UNIQUE KEY `user_token` (`user_token`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for data_right_lists
-- ----------------------------
DROP TABLE IF EXISTS `data_right_lists`;
CREATE TABLE `data_right_lists` (
  `right_id` int(10) NOT NULL AUTO_INCREMENT,
  `right_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_class` int(10) DEFAULT NULL,
  `right_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_route` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `right_info` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`right_id`),
  KEY `index` (`right_name`,`right_class`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for data_role_lists
-- ----------------------------
DROP TABLE IF EXISTS `data_role_lists`;
CREATE TABLE `data_role_lists` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_class` int(10) DEFAULT NULL,
  `role_insert` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_time` int(10) DEFAULT NULL,
  `role_right` varchar(8000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `index` (`role_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for data_user_admins
-- ----------------------------
DROP TABLE IF EXISTS `data_user_admins`;
CREATE TABLE `data_user_admins` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_phone` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_type` int(10) DEFAULT NULL,
  `admin_class` int(10) DEFAULT NULL,
  `admin_status` int(10) DEFAULT NULL,
  `admin_time` int(10) DEFAULT NULL,
  `right_class` int(10) DEFAULT NULL,
  `admin_right` varchar(8000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_formid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `index` (`admin_class`,`admin_status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for index_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `index_admin_roles`;
CREATE TABLE `index_admin_roles` (
  `admin_id` int(10) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for index_role_rights
-- ----------------------------
DROP TABLE IF EXISTS `index_role_rights`;
CREATE TABLE `index_role_rights` (
  `role_id` int(10) DEFAULT NULL,
  `right_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
