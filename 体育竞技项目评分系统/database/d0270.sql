/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.18 : Database - d027
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`d027` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `d027`;

/*Table structure for table `contestant` */

DROP TABLE IF EXISTS `contestant`;

CREATE TABLE `contestant` (
  `con_name` varchar(20) NOT NULL,
  `con_unit` varchar(50) DEFAULT NULL,
  `con_id` varchar(20) NOT NULL,
  `con_sex` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `con_id` (`con_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `contestant` */

/*Table structure for table `grade` */

DROP TABLE IF EXISTS `grade`;

CREATE TABLE `grade` (
  `program_id` varchar(20) NOT NULL,
  `grade1` float DEFAULT NULL,
  `grade2` float DEFAULT NULL,
  `grade3` float DEFAULT NULL,
  `grade4` float DEFAULT NULL,
  `grade5` float DEFAULT NULL,
  `final_grade` float DEFAULT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `grade` */

/*Table structure for table `group_members` */

DROP TABLE IF EXISTS `group_members`;

CREATE TABLE `group_members` (
  `group_code` varchar(20) DEFAULT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `member_id` varchar(20) DEFAULT NULL,
  `member_name` varchar(50) DEFAULT NULL,
  `member_unit` varchar(50) DEFAULT NULL,
  `check_status` int(2) DEFAULT '0',
  `member_present` int(2) DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4000 DEFAULT CHARSET=utf8;

/*Data for the table `group_members` */

/*Table structure for table `item` */

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `item_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `group_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`item_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `item` */

insert  into `item`(`item_id`,`item_name`,`group_id`) values ('101','长拳',1),('102','太极拳',2),('103','太极剑',3),('104','南拳',4),('105','南刀',5),('106','剑术',6),('107','刀术',7),('108','棍术',8),('109','枪术',9),('110','太极枪',10),('111','九节鞭',11),('112','扑刀',12),('113','长穗剑',13),('114','长穗双剑',14),('115','醉拳',0),('01','集体-太极八法五步',1),('02','集体-二十四式太极拳',2),('03','个人-太极八法五步',3),('04','个人-二十四式太极拳',4),('05','个人-其他太极拳',5),('06','个人-其他太极器械',6),('07','集体-二十四式太极拳（决赛）',7);

/*Table structure for table `judge` */

DROP TABLE IF EXISTS `judge`;

CREATE TABLE `judge` (
  `judge_id` varchar(20) NOT NULL,
  `judge_name` varchar(20) NOT NULL,
  `judge_password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`judge_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `judge` */

insert  into `judge`(`judge_id`,`judge_name`,`judge_password`) values ('000','徐曼','123'),('001','吴剑','321'),('002','马铭泽','123123'),('003','叶帆','321321'),('006','检录1','123'),('007','检录2','123'),('008','检录3','123'),('009','其他1','123'),('010','其他2','123'),('011','其他3','123');

/*Table structure for table `mark` */

DROP TABLE IF EXISTS `mark`;

CREATE TABLE `mark` (
  `mark_num` int(3) DEFAULT '0',
  `id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `mark` */

insert  into `mark`(`mark_num`,`id`) values (1,1);

/*Table structure for table `program` */

DROP TABLE IF EXISTS `program`;

CREATE TABLE `program` (
  `group_id` int(20) DEFAULT NULL,
  `item_id` varchar(20) NOT NULL,
  `program_id` int(20) NOT NULL AUTO_INCREMENT,
  `con_id` varchar(20) NOT NULL,
  `con_name` varchar(20) NOT NULL,
  `con_sex` varchar(4) NOT NULL,
  `con_unit` varchar(50) NOT NULL,
  `check_status1` int(1) DEFAULT '0',
  `check_status2` int(1) DEFAULT '0',
  `if_grade` int(1) DEFAULT '0',
  `grade1` float DEFAULT '0',
  `grade2` float DEFAULT '0',
  `grade3` float DEFAULT '0',
  `grade4` float DEFAULT '0',
  `grade5` float DEFAULT '0',
  `final_grade` float DEFAULT '0',
  `present` int(11) DEFAULT '0',
  `present_order` int(3) DEFAULT '0',
  `rank` int(3) DEFAULT '0',
  PRIMARY KEY (`program_id`),
  KEY `program_item` (`item_id`),
  KEY `program_con` (`group_id`),
  KEY `program_id` (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9802 DEFAULT CHARSET=utf8;

/*Data for the table `program` */

/*Table structure for table `temp` */

DROP TABLE IF EXISTS `temp`;

CREATE TABLE `temp` (
  `present_item` varchar(30) DEFAULT NULL,
  `id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `temp` */

insert  into `temp`(`present_item`,`id`) values ('个人-其他太极器械',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
