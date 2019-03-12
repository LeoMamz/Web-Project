/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.18 : Database - seweb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`seweb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `seweb`;

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `cid` varchar(10) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `introduction` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `course` */

insert  into `course`(`cid`,`cname`,`introduction`) values ('0100','软件工程杂烩','{\"teacher\":\"史蒂芬亨得利发\",\"time\":\"dfg dsfg\",\"place\":\"广泛大概\",\"textbook\":\"梵蒂冈梵蒂冈\",\"pre_knowledge\":\"科技大厦开发解开了士大夫\",\"introduction\":\"sdf sdf\",\"standard\":\"撒地方撒地方\"}');

/*Table structure for table `coursefile` */

DROP TABLE IF EXISTS `coursefile`;

CREATE TABLE `coursefile` (
  `cid` varchar(10) DEFAULT NULL,
  `file_path` varchar(72) DEFAULT NULL,
  `file_name` varchar(64) DEFAULT NULL,
  `upload_time` datetime NOT NULL,
  `state` enum('t','s','f') DEFAULT 't',
  `type` enum('kj','mb','zl','zy','yxzy','sp','yp') DEFAULT NULL,
  `delete_type` int(11) DEFAULT '0',
  `file_id` int(8) NOT NULL AUTO_INCREMENT,
  `uploader` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`file_id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Data for the table `coursefile` */

insert  into `coursefile`(`cid`,`file_path`,`file_name`,`upload_time`,`state`,`type`,`delete_type`,`file_id`,`uploader`) values ('0100','kejian/6t.pdf','6t.pdf','2019-01-11 23:09:13','s','kj',1,43,'琼琼'),('0100','audios/1.mp3','1.mp3','2019-01-11 23:02:20','s','yp',0,42,'琼琼'),('0100','videos/xiao.mp4','xiao.mp4','2019-01-11 23:10:10','s','sp',1,44,'琼琼'),('0100','kejian/5.pdf','5.pdf','2019-01-11 23:23:53','s','kj',1,45,'琼琼'),('0100','kejian/8-9.pdf','8-9.pdf','2019-01-11 23:45:34','s','kj',1,46,'琼琼'),('0100','videos/1.3gp','1.3gp','2019-01-11 23:46:25','s','sp',0,47,'琼琼'),('0100','audios/1.amr','1.amr','2019-01-11 23:47:06','s','yp',0,48,'琼琼'),('0100','kejian/1-2.pdf','1-2.pdf','2019-01-11 22:59:23','s','kj',1,39,'琼琼'),('0100','cankaoziliao/作图.xlsx','作图.xlsx','2019-01-11 22:59:54','s','zl',0,40,'琼琼');

/*Table structure for table `coursehomework` */

DROP TABLE IF EXISTS `coursehomework`;

CREATE TABLE `coursehomework` (
  `cid` varchar(10) DEFAULT NULL,
  `homework_id` varchar(20) NOT NULL,
  `item_num` int(11) DEFAULT NULL,
  `item` varchar(2048) DEFAULT NULL,
  `homework_time` datetime DEFAULT NULL,
  `answer` varchar(30) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  PRIMARY KEY (`homework_id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `coursehomework` */

/*Table structure for table `coursestudent` */

DROP TABLE IF EXISTS `coursestudent`;

CREATE TABLE `coursestudent` (
  `cid` varchar(10) DEFAULT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `score` double DEFAULT NULL,
  KEY `cid` (`cid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `coursestudent` */

insert  into `coursestudent`(`cid`,`uid`,`score`) values ('0100','002',NULL),('0100','003',NULL),('0100','004',NULL),('0100','005',NULL),('0100','006',NULL);

/*Table structure for table `courseteacher` */

DROP TABLE IF EXISTS `courseteacher`;

CREATE TABLE `courseteacher` (
  `cid` varchar(10) DEFAULT NULL,
  `tid` varchar(10) DEFAULT NULL,
  KEY `cid` (`cid`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `courseteacher` */

insert  into `courseteacher`(`cid`,`tid`) values ('0100','000');

/*Table structure for table `forum` */

DROP TABLE IF EXISTS `forum`;

CREATE TABLE `forum` (
  `cid` varchar(10) DEFAULT NULL,
  `post_id` varchar(20) NOT NULL,
  `post_title` varchar(512) DEFAULT NULL,
  `author` varchar(10) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `recent_reply_time` datetime DEFAULT NULL,
  `reply_num` int(11) DEFAULT NULL,
  `state` enum('t','f') DEFAULT 't',
  PRIMARY KEY (`post_id`),
  KEY `cid` (`cid`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `forum` */

insert  into `forum`(`cid`,`post_id`,`post_title`,`author`,`create_time`,`recent_reply_time`,`reply_num`,`state`) values ('0100','00000001','fdsf sd','002','2019-01-10 07:23:21','2019-01-11 10:35:00',3,'t'),('0100','00000002','朋友们 你们好吗','002','2019-01-10 18:23:29','2019-01-11 15:04:42',2,'t'),('0100','00000003','111','002','2019-01-11 01:46:46','2019-01-11 01:46:46',1,'t'),('0100','00000004','hello','002','2019-01-11 10:18:17','2019-01-11 10:18:24',2,'t'),('0100','00000005','44654641','002','2019-01-11 21:36:58','2019-01-11 21:36:58',1,'t'),('0100','00000006','mm','003','2019-01-11 21:43:59','2019-01-11 21:43:59',1,'t'),('0100','00000007','软件工程','003','2019-01-11 23:32:08','2019-01-11 23:32:28',3,'t'),('0100','00000008','考试怎么办？','003','2019-01-11 23:51:36','2019-01-12 00:03:39',5,'t');

/*Table structure for table `messageboard` */

DROP TABLE IF EXISTS `messageboard`;

CREATE TABLE `messageboard` (
  `message_id` varchar(20) NOT NULL,
  `author` varchar(10) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `state` enum('t','f') DEFAULT 't',
  PRIMARY KEY (`message_id`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `messageboard` */

insert  into `messageboard`(`message_id`,`author`,`content`,`create_time`,`state`) values ('00000001','000','你好','2019-01-11 14:59:55','t'),('00000002','002','你也好','2019-01-11 15:05:30','t'),('00000003','000','软件工程\r\n','2019-01-11 23:15:00','t'),('00000004','000','撒旦飞洒地方健康；','2019-01-11 23:29:07','t'),('00000005','003','圣诞快乐房价昆仑山搭街坊\r\n大师头发吧','2019-01-11 23:32:37','t'),('00000006','000','明天快乐','2019-01-11 23:49:11','t'),('00000007','003','今天快乐','2019-01-11 23:51:54','t');

/*Table structure for table `myuser` */

DROP TABLE IF EXISTS `myuser`;

CREATE TABLE `myuser` (
  `uid` varchar(10) NOT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `password` varchar(72) DEFAULT NULL,
  `type` enum('s','t','m') DEFAULT 's',
  `introduction` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `myuser` */

insert  into `myuser`(`uid`,`uname`,`password`,`type`,`introduction`) values ('000','琼琼','123','t','{\"ta\":\"sdfkjsldkfsdf \",\"teachStyle\":\"当时法国讽德诵功\",\"achievement\":\"撒的撒旦撒大苏打撒电视上的fdg\",\"books\":\"当时法国sdf\",\"honour\":\"是大法官是大法官打发时光dfsg\",\"contact\":\"185216654kjdshfkjsdf \"}'),('001','舅舅','321','t','软测教师'),('002','伯伯','123','s','游戏王'),('003','柏柏','321','s','我只是'),('004','婧婧','123','s','我负责'),('005','范范','123','s','我有点'),('006','南南','123','s','我就是'),('007','诺诺','123','s','帅气'),('008','凉凉','123','s','美丽'),('009','晨晨','123','s','骚气'),('010','珊珊','123','s','不配'),('011','**','123','s','哈哈哈');

/*Table structure for table `notice` */

DROP TABLE IF EXISTS `notice`;

CREATE TABLE `notice` (
  `cid` varchar(10) DEFAULT NULL,
  `author` varchar(10) DEFAULT NULL,
  `notice_id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `state` enum('0','1','2') DEFAULT '0',
  PRIMARY KEY (`notice_id`),
  KEY `cid` (`cid`),
  KEY `author` (`author`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `notice` */

insert  into `notice`(`cid`,`author`,`notice_id`,`title`,`content`,`create_time`,`state`) values ('0100','舅舅',7,'安安安','弃修同学请来我这里登记一下','2019-01-11 00:00:00','0'),('0100','舅舅',8,'周五上课调整','根据泽东老师的安排，周五上课进行调整，到一月二十五日补课','2019-01-11 00:00:00','1'),('0100','舅舅',9,'阿斯蒂芬暗室逢灯','阿斯蒂芬阿斯蒂芬阿斯蒂芬阿斯蒂芬暗室逢灯','2019-01-11 00:00:00','2'),('0100','舅舅',10,'阿道夫阿斯蒂','阿萨反倒是哒发斯蒂芬阿萨德法师打发斯蒂芬','2019-01-11 00:00:00','1'),('0100','琼琼',11,'hahaha','hahaha','2019-01-11 00:00:00','0'),('0100','琼琼',12,'gg','gg','2019-01-11 00:00:00','1'),('0100','舅舅',13,'计算理论','哈哈哈哈哈哈','2019-01-11 00:00:00','1'),('0100','舅舅',14,'计算理论','心得','2019-01-11 00:00:00','0'),('0100','琼琼',15,'临时通知','这是测试1','2019-01-11 00:00:00','1'),('0100','琼琼',16,'测试','零食荣智\r\n\r\n当年非法离开对方\r\n出现过','2019-01-11 00:00:00','1'),('0100','琼琼',17,'软件工程','但是佛i为u富婆i技术的','2019-01-11 00:00:00','1'),('0100','琼琼',18,'让角色克里夫','','2019-01-11 00:00:00','2'),('0100','琼琼',19,'后天也许','到i分为哦JFK楼上的反过来尖峰时刻楼上的吉林省地方艰苦 ','2019-01-11 00:00:00','1');

/*Table structure for table `offline_work` */

DROP TABLE IF EXISTS `offline_work`;

CREATE TABLE `offline_work` (
  `hw_id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) DEFAULT NULL,
  `info` varchar(4096) DEFAULT NULL,
  `ddl` datetime DEFAULT NULL,
  PRIMARY KEY (`hw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `offline_work` */

insert  into `offline_work`(`hw_id`,`cid`,`info`,`ddl`) values (6,'0100','%7B%22title%22%3A%22%E8%AE%A9%E5%A5%B9%E4%BE%9D%E7%84%B6%E6%9C%89%E4%BA%BA%22%2C%22desc%22%3A%22%E6%89%93%E5%BC%80JFK%E5%85%AD%E7%82%B9%E5%8D%81%E5%88%86%5Cr%5Cn%E6%89%93%E7%AE%97%E6%96%B9%E8%90%A8%E6%8B%89JFK%5Cr%5Cn%E5%9C%B0%E6%96%B9%E5%9C%B0%E6%96%B9%22%2C%22time%22%3A%222019-01-09+19%3A18%3A16%22%2C%22state%22%3A%22s%22%2C%22file_path%22%3A%22hw%5C%2F5%E7%AE%80%E7%AD%94.pdf%22%2C%22uploader%22%3A%22%E7%90%BC%E7%90%BC%22%7D','2020-01-24 00:00:00'),(7,'0100','%7B%22title%22%3A%22%E7%A6%BB%E7%BA%BF%E4%BD%9C%E4%B8%9A%22%2C%22desc%22%3A%22%E6%88%91%E4%B9%9F%E4%B8%8D%E7%9F%A5%E9%81%93%E6%98%AF%E4%BB%80%E4%B9%88%EF%BC%81%EF%BC%81%22%2C%22time%22%3A%222019-01-11+01%3A49%3A20%22%2C%22state%22%3A%22s%22%2C%22file_path%22%3A%22hw%5C%2F1-2.pdf%22%2C%22uploader%22%3A%22%E7%90%BC%E7%90%BC%22%7D','2019-01-24 00:59:00'),(8,'0100','%7B%22title%22%3A%22%E6%98%A8%E5%A4%A9%22%2C%22desc%22%3A%22%E6%98%86%E4%BB%91%E5%B1%B1%E6%90%AD%E8%A1%97%E5%9D%8A%E5%8D%A1%E6%8B%89%E5%B0%B1%E6%98%AF%E7%8B%AC%E7%AB%8B%E5%BC%80%E5%8F%91%22%2C%22time%22%3A%222019-01-11+23%3A48%3A11%22%2C%22state%22%3A%22s%22%2C%22file_path%22%3A%22hw%5C%2F10-11.pdf%22%2C%22uploader%22%3A%22%E7%90%BC%E7%90%BC%22%7D','2019-01-26 00:59:00');

/*Table structure for table `offline_work_sub` */

DROP TABLE IF EXISTS `offline_work_sub`;

CREATE TABLE `offline_work_sub` (
  `hw_id` int(10) DEFAULT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `sub_info` varchar(2048) DEFAULT NULL,
  `sub_id` int(20) NOT NULL AUTO_INCREMENT,
  `grade_info` varchar(2048) DEFAULT NULL,
  `state` int(8) DEFAULT '0',
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `offline_work_sub` */

insert  into `offline_work_sub`(`hw_id`,`uid`,`sub_info`,`sub_id`,`grade_info`,`state`) values (6,'002','%7B%22title%22%3A%22%E8%AE%A9%E5%A5%B9%E4%BE%9D%E7%84%B6%E6%9C%89%E4%BA%BA%22%2C%22desc%22%3A%22%E6%89%93%E5%BC%80JFK%E5%85%AD%E7%82%B9%E5%8D%81%E5%88%86%5Cr%5Cn%E6%89%93%E7%AE%97%E6%96%B9%E8%90%A8%E6%8B%89JFK%5Cr%5Cn%E5%9C%B0%E6%96%B9%E5%9C%B0%E6%96%B9%22%2C%22time%22%3A%222019-01-09+19%3A18%3A16%22%2C%22state%22%3A%22s%22%2C%22file_path%22%3A%22hw%5C%2F5%E7%AE%80%E7%AD%94.pdf%22%2C%22uploader%22%3A%22%E7%90%BC%E7%90%BC%22%7D',5,'%7B%22grade%22%3A%229.8%22%2C%22comment%22%3A%22fghfgh%E6%A2%B5%E8%92%82%E5%86%88%5Cr%5Cn%E5%A3%AB%E5%A4%A7%E5%A4%AB%E9%98%BF%E6%96%AF%E8%92%82%E8%8A%AC%5Cr%5Cn%E5%A3%AB%E5%A4%A7%E5%A4%AB%E9%98%BF%E6%96%AF%E8%92%82%E8%8A%AC%22%2C%22time%22%3A%222019-01-10+06%3A53%3A26%22%7D',1),(7,'002','%7B%22time%22%3A%222019-01-11+01%3A54%3A57%22%2C%22file_name%22%3A%22%E4%B8%80%E8%B5%B7%E4%B8%8A%E5%8E%95%E6%89%80.png%22%2C%22file_path%22%3A%22hw_sub%5C%2F%E4%B8%80%E8%B5%B7%E4%B8%8A%E5%8E%95%E6%89%80.png%22%2C%22uploader%22%3A%22%E4%BC%AF%E4%BC%AF%22%7D',6,'%7B%22grade%22%3A%2210%22%2C%22comment%22%3A%22%E5%BE%88%E4%B8%8D%E9%94%99%EF%BC%8C%E5%80%BC%E5%BE%97%E9%BC%93%E5%8A%B1%EF%BC%8C%E5%B8%8C%E6%9C%9B%E5%90%8C%E5%AD%A6%E7%BB%A7%E7%BB%AD%E5%8A%AA%E5%8A%9B%EF%BC%81%22%2C%22time%22%3A%222019-01-11+01%3A55%3A23%22%7D',1),(6,'003','%7B%22time%22%3A%222019-01-11+15%3A40%3A30%22%2C%22file_name%22%3A%22%E8%BD%AF%E5%B7%A5.pdf%22%2C%22file_path%22%3A%22hw_sub%5C%2F%E8%BD%AF%E5%B7%A5.pdf%22%2C%22uploader%22%3A%22%E6%9F%8F%E6%9F%8F%22%7D',7,NULL,0),(8,'003','%7B%22time%22%3A%222019-01-11+23%3A50%3A20%22%2C%22file_name%22%3A%225.pdf%22%2C%22file_path%22%3A%22hw_sub%5C%2F5.pdf%22%2C%22uploader%22%3A%22%E6%9F%8F%E6%9F%8F%22%7D',8,NULL,0);

/*Table structure for table `onlinehw` */

DROP TABLE IF EXISTS `onlinehw`;

CREATE TABLE `onlinehw` (
  `hwno` varchar(10) NOT NULL,
  `cid` varchar(10) DEFAULT NULL,
  `hwname` varchar(20) DEFAULT NULL,
  `chap` varchar(10) DEFAULT NULL,
  `ddl` date DEFAULT NULL,
  PRIMARY KEY (`hwno`),
  UNIQUE KEY `hwno` (`hwno`),
  KEY `fk_cid` (`cid`),
  KEY `fk_chap` (`chap`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `onlinehw` */

insert  into `onlinehw`(`hwno`,`cid`,`hwname`,`chap`,`ddl`) values ('hw1','1023','地方官地方官梵蒂冈','chap1','2018-12-24'),('hw2','0100','地方官地方官梵蒂冈','chap1','2019-12-24'),('hw3','0100','李珏于是什么东西','chap1','2019-12-24'),('hw4','0100','士大夫看见撒旦克里夫就','chap2','2019-10-22'),('hw5','0100','软件工程','chap1','2019-10-22'),('hw6','0100','明天','chap1','2019-10-22');

/*Table structure for table `onlinehwgrades` */

DROP TABLE IF EXISTS `onlinehwgrades`;

CREATE TABLE `onlinehwgrades` (
  `hwno` varchar(10) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `time` date DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`hwno`,`uid`),
  KEY `fk_uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `onlinehwgrades` */

insert  into `onlinehwgrades`(`hwno`,`uid`,`time`,`grade`) values ('hw2','002','2019-01-09','0'),('hw3','002','2019-01-11','2'),('hw3','003','2019-01-11','0'),('hw5','002','2019-01-11','4'),('hw6','003','2019-01-11','0'),('hw6','004','2019-01-12','0'),('hw6','006','2019-01-12','0');

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` varchar(20) DEFAULT NULL,
  `reply` varchar(1024) DEFAULT NULL,
  `reply_author` varchar(10) DEFAULT NULL,
  `reply_time` datetime DEFAULT NULL,
  `reply_index` int(11) DEFAULT NULL,
  `state` enum('t','f') DEFAULT 't',
  KEY `post_id` (`post_id`),
  KEY `reply_author` (`reply_author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `post` */

insert  into `post`(`post_id`,`reply`,`reply_author`,`reply_time`,`reply_index`,`state`) values ('00000001','sdfsadf asdf士大夫阿斯蒂芬说的\r\n士大夫是','002','2019-01-10 07:23:21',1,'t'),('00000001','我是沙发','002','2019-01-10 18:22:46',2,'t'),('00000002','RT','002','2019-01-10 18:23:29',1,'t'),('00000003','111','002','2019-01-11 01:46:46',1,'t'),('00000004','yesssssssss','002','2019-01-11 10:18:17',1,'t'),('00000004','lalalala','002','2019-01-11 10:18:24',2,'t'),('00000001','haha','002','2019-01-11 10:35:00',3,'t'),('00000002','我来占个沙发','002','2019-01-11 15:04:42',2,'t'),('00000005','411333','002','2019-01-11 21:36:58',1,'t'),('00000006','nmm','003','2019-01-11 21:43:59',1,'t'),('00000007','山大佛i算的解放咯i看阿三 ','003','2019-01-11 23:32:08',1,'t'),('00000007','圣诞快乐房价昆仑山搭街坊\r\n发送端','003','2019-01-11 23:32:15',2,'t'),('00000007','两款手机发的昆仑山搭街坊','003','2019-01-11 23:32:28',3,'t'),('00000008','也许我要好好学习','003','2019-01-11 23:51:36',1,'t'),('00000008','圣诞快乐机房环境卢卡斯打飞机利空的身份','003','2019-01-11 23:51:44',2,'t'),('00000008','毛泽东','004','2019-01-12 00:03:23',3,'t'),('00000008','草泥马','004','2019-01-12 00:03:29',4,'t'),('00000008','|||&&&&','004','2019-01-12 00:03:39',5,'t');

/*Table structure for table `selectquestion` */

DROP TABLE IF EXISTS `selectquestion`;

CREATE TABLE `selectquestion` (
  `qno` varchar(10) NOT NULL,
  `cid` varchar(10) DEFAULT NULL,
  `chap` varchar(10) DEFAULT NULL,
  `content` varchar(250) DEFAULT NULL,
  `optiona` varchar(50) DEFAULT NULL,
  `optionb` varchar(50) DEFAULT NULL,
  `optionc` varchar(50) DEFAULT NULL,
  `optiond` varchar(50) DEFAULT NULL,
  `ans` char(1) DEFAULT NULL,
  PRIMARY KEY (`qno`),
  UNIQUE KEY `qno` (`qno`),
  KEY `fk_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `selectquestion` */

insert  into `selectquestion`(`qno`,`cid`,`chap`,`content`,`optiona`,`optionb`,`optionc`,`optiond`,`ans`) values ('qno1','0100','chap1','李珏宇','傻逼','牛赑','啥子','上帝就发','C'),('qno2','0100','chap1','ooo','jg','jhk','jhg','nbvn','A'),('qno3','0100','chap1','hhh','jhkj','kjh','jhgkj','hgkjhgk','A');

/*Table structure for table `textquestion` */

DROP TABLE IF EXISTS `textquestion`;

CREATE TABLE `textquestion` (
  `qno` varchar(10) NOT NULL,
  `cid` varchar(10) DEFAULT NULL,
  `chap` varchar(10) DEFAULT NULL,
  `content` varchar(250) DEFAULT NULL,
  `ans` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`qno`),
  UNIQUE KEY `qno` (`qno`),
  KEY `fk_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `textquestion` */

insert  into `textquestion`(`qno`,`cid`,`chap`,`content`,`ans`) values ('qno1','0100','chap1','软件需求工程的重要性','非常重要');

/*Table structure for table `uploadhomework` */

DROP TABLE IF EXISTS `uploadhomework`;

CREATE TABLE `uploadhomework` (
  `homework_id` varchar(20) DEFAULT NULL,
  `sid` varchar(10) DEFAULT NULL,
  `answer` varchar(30) DEFAULT NULL,
  `upload_file` varchar(40) DEFAULT NULL,
  `score` double DEFAULT NULL,
  `comment` varchar(1024) DEFAULT NULL,
  KEY `homework_id` (`homework_id`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `uploadhomework` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
