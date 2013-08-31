/*
MySQL Data Transfer
Source Host: localhost
Source Database: trinity_char
Target Host: localhost
Target Database: trinity_char
Date: 9/14/2009 10:25:53 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for armory_info
-- ----------------------------
DROP TABLE IF EXISTS `armory_info`;
CREATE TABLE `armory_info` (
  `id` int(100) NOT NULL auto_increment,
  `characters_lastupdate` int(100) NOT NULL,
  `arenaladder_lastupdate` int(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin2;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `armory_info` VALUES ('1', '0', '0');
