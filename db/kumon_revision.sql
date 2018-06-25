-- Adminer 4.6.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `kumon_new` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kumon_new`;

DELIMITER ;;

DROP EVENT IF EXISTS `update_status_pending`;;
CREATE EVENT `update_status_pending` ON SCHEDULE EVERY 1 MINUTE STARTS '2017-11-26 18:22:17' ON COMPLETION PRESERVE ENABLE DO BEGIN
            INSERT INTO ticket_detail (ticket_id, ticket_status_id, user_id, cid, service, description, ticket_pending, status_pending)            
	    SELECT ticket_id, 1, user_id, cid, service, 'Auto open by schedule', NULL, NULL            
            FROM ticket_detail
            WHERE ticket_pending<=NOW() AND ticket_pending IS NOT NULL AND status_pending IS NULL;

         IF Row_Count()=1 THEN
            UPDATE ticket_detail SET status_pending=1, updated_date=NOW()
            WHERE ticket_pending <= NOW() AND ticket_pending IS NOT NULL AND status_pending IS NULL;
        
            UPDATE ticket SET ticket_status_id=1, updated_date=NOW()
            WHERE ticket_id=ticket_id AND ticket_status_id=2;
         END IF;
        END;;

DELIMITER ;

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `event_id` int(10) NOT NULL AUTO_INCREMENT,
  `location_id` int(10) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_status` int(2) NOT NULL DEFAULT '1' COMMENT '0 = tidak aktif, 1 = aktif',
  PRIMARY KEY (`event_id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `event` (`event_id`, `location_id`, `event_name`, `start_date`, `end_date`, `event_status`) VALUES
(16,	10,	'BPN EVENT',	'2018-06-29 22:10:00',	'2018-06-29 20:30:00',	1),
(17,	11,	'MDN EVENT',	'2018-06-22 22:45:00',	'2018-06-30 23:50:00',	1),
(20,	11,	'TES EVENT',	'2018-06-25 19:00:00',	'2018-06-25 19:36:00',	0);

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `grade_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade_code` varchar(10) DEFAULT NULL,
  `grade_name` varchar(40) DEFAULT NULL,
  `trophy_table` varchar(40) DEFAULT '5 TINGKAT',
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `grade` (`grade_id`, `grade_code`, `grade_name`, `trophy_table`) VALUES
(1,	'A',	'1 SD',	'5 TINGKAT'),
(2,	'B',	'2 SD',	'5 TINGKAT'),
(3,	'C',	'3 SD',	'5 TINGKAT'),
(4,	'D',	'4 SD',	'5 TINGKAT'),
(5,	'E',	'5 SD',	'5 TINGKAT'),
(6,	'F',	'6 SD',	'5 TINGKAT'),
(7,	'G',	'1 SMP',	'5 TINGKAT'),
(8,	'H',	'2 SMP',	'5 TINGKAT'),
(9,	'I',	'3 SMP',	'5 TINGKAT'),
(10,	'J',	'1 SD',	'7 TINGKAT'),
(11,	'K',	'2 SD',	'7 TINGKAT'),
(12,	'L',	'3 SD',	'7 TINGKAT'),
(13,	'M',	'4 SD',	'7 TINGKAT'),
(14,	'N',	'5 SD',	'7 TINGKAT'),
(15,	'O',	'6 SD',	'7 TINGKAT'),
(16,	'P',	'1 SMP',	'7 TINGKAT'),
(17,	'Q',	'2 SMP',	'7 TINGKAT'),
(18,	'R',	'3 SMP',	'7 TINGKAT'),
(19,	'1SMA',	'1 SMA',	'5 TINGKAT'),
(20,	'2SMA',	'2 SMA',	'5 TINGKAT'),
(21,	'3SMA',	'3 SMA',	'5 TINGKAT'),
(22,	'1SMA',	'1 SMA',	'7 TINGKAT'),
(23,	'2SMA',	'2 SMA',	'7 TINGKAT'),
(24,	'3SMA',	'3 SMA',	'7 TINGKAT'),
(25,	'5TKA',	'TK A',	'5 TINGKAT'),
(26,	'5TKB',	'TK B',	'5 TINGKAT'),
(27,	'7TKA',	'TK A',	'7 TINGKAT'),
(28,	'7TKB',	'TK B',	'7 TINGKAT'),
(29,	'X',	'X',	'COMPLETER');

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `location_id` int(10) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) NOT NULL,
  PRIMARY KEY (`location_id`),
  UNIQUE KEY `location_name` (`location_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `location` (`location_id`, `location_name`) VALUES
(10,	'BALIKPAPAN'),
(11,	'MEDAN');

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `member_id` int(20) NOT NULL AUTO_INCREMENT,
  `attend_status` int(2) NOT NULL DEFAULT '0' COMMENT '0 = belum hadir, 1 = hadir',
  `event_id` int(10) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `member_session` int(11) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `gate_in` varchar(50) DEFAULT 'NULL',
  `seat` varchar(10) DEFAULT 'NULL',
  `get_award` varchar(50) DEFAULT 'NULL',
  `trophy_table` varchar(50) DEFAULT 'NULL',
  `center` varchar(50) DEFAULT 'NULL',
  `instructor` varchar(50) DEFAULT 'NULL',
  `plakat` varchar(50) DEFAULT 'NULL',
  `rank` int(10) DEFAULT NULL,
  `among_of` int(10) DEFAULT NULL,
  `math` varchar(20) DEFAULT 'NULL',
  `ee` varchar(20) DEFAULT 'NULL',
  `efl` varchar(20) DEFAULT 'NULL',
  `cm` varchar(20) DEFAULT 'NULL',
  `ce` varchar(20) DEFAULT 'NULL',
  `cf` varchar(20) DEFAULT 'NULL',
  `trophy_at_class` varchar(20) DEFAULT 'NULL',
  `ashr_level` varchar(20) DEFAULT 'NULL',
  `student_id` int(15) DEFAULT NULL,
  `meeting_point` varchar(15) DEFAULT 'NULL',
  PRIMARY KEY (`member_id`),
  KEY `type_id` (`type_id`),
  KEY `event_id` (`event_id`),
  KEY `grade_id` (`grade_id`),
  CONSTRAINT `member_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`),
  CONSTRAINT `member_ibfk_4` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  CONSTRAINT `member_ibfk_5` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `member` (`member_id`, `attend_status`, `event_id`, `registration_number`, `member_name`, `member_session`, `grade_id`, `type_id`, `gate_in`, `seat`, `get_award`, `trophy_table`, `center`, `instructor`, `plakat`, `rank`, `among_of`, `math`, `ee`, `efl`, `cm`, `ce`, `cf`, `trophy_at_class`, `ashr_level`, `student_id`, `meeting_point`) VALUES
(1437,	1,	16,	'BP0001',	'ASQOLANI 1',	1,	26,	1,	NULL,	'5TKB 1',	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	1,	NULL),
(1438,	0,	16,	'BP0002',	'ASQOLANI 2',	1,	26,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	2,	NULL),
(1439,	0,	16,	'BP0003',	'ASQOLANI 3',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	3,	NULL),
(1440,	0,	16,	'BP0004',	'ASQOLANI 4',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	4,	NULL),
(1441,	0,	16,	'BP0005',	'ASQOLANI 5',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	5,	NULL),
(1442,	0,	16,	'BP0006',	'ASQOLANI 6',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	6,	NULL),
(1443,	0,	16,	'BP0007',	'ASQOLANI 7',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	7,	NULL),
(1444,	0,	16,	'BP0008',	'ASQOLANI 8',	1,	1,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	8,	NULL),
(1445,	0,	16,	'BP0009',	'ASQOLANI 9',	1,	1,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	9,	NULL),
(1446,	0,	16,	'BP0010',	'ASQOLANI 10',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	10,	NULL),
(1447,	0,	16,	'BP0011',	'ASQOLANI 11',	1,	1,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	11,	NULL),
(1448,	0,	16,	'BP0012',	'ASQOLANI 12',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	12,	NULL),
(1449,	0,	16,	'BP0013',	'ASQOLANI 13',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	13,	NULL),
(1450,	0,	16,	'BP0014',	'ASQOLANI 14',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	14,	NULL),
(1451,	0,	16,	'BP0015',	'ASQOLANI 15',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	15,	NULL),
(1452,	0,	16,	'BP0016',	'ASQOLANI 16',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	16,	NULL),
(1453,	0,	16,	'BP0017',	'ASQOLANI 17',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	17,	NULL),
(1454,	0,	16,	'BP0018',	'ASQOLANI 18',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	18,	NULL),
(1455,	0,	16,	'BP0019',	'ASQOLANI 19',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	19,	NULL),
(1456,	0,	16,	'BP0020',	'ASQOLANI 20',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	20,	NULL),
(1457,	0,	16,	'BP0021',	'ASQOLANI 21',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	21,	NULL),
(1458,	0,	16,	'BP0022',	'ASQOLANI 22',	1,	2,	1,	NULL,	NULL,	'F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	22,	NULL),
(1459,	0,	16,	'BP0023',	'ASQOLANI 23',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	23,	NULL),
(1460,	0,	16,	'BP0024',	'ASQOLANI 24',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	24,	NULL),
(1461,	0,	16,	'BP0025',	'ASQOLANI 25',	1,	2,	1,	NULL,	NULL,	'M5/F5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	25,	NULL),
(1462,	0,	16,	'BP0026',	'ASQOLANI 26',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	26,	NULL),
(1463,	0,	16,	'BP0027',	'ASQOLANI 27',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'C',	27,	NULL),
(1464,	0,	16,	'BP0028',	'ASQOLANI 28',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	28,	NULL),
(1465,	0,	16,	'BP0029',	'ASQOLANI 29',	1,	2,	1,	NULL,	NULL,	'M5',	'5 TINGKAT',	'M',	'NOT AVAIL',	NULL,	141,	4213,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'5',	29,	NULL);

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_code` varchar(10) NOT NULL,
  `type_name` varchar(20) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `type` (`type_id`, `type_code`, `type_name`) VALUES
(1,	'A',	'ASF'),
(2,	'C',	'Completer');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(15) NOT NULL AUTO_INCREMENT,
  `user_status_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `user_status_id` (`user_status_id`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`user_status_id`) REFERENCES `user_status` (`user_status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`user_id`, `user_status_id`, `username`, `first_name`, `last_name`, `email`, `password`, `created_date`, `updated_date`) VALUES
(27,	1,	'admin',	'admin',	'admin',	'admin@gmail.com',	'f6fdffe48c908deb0f4c3bd36c032e72',	'2018-05-26 21:18:55',	'2018-05-26 21:22:07'),
(28,	1,	'tes user',	'tes aja',	'aja',	'tes@gmail.com',	'e9826a10941f1a3d13e5af6db63dd8c4',	'2018-05-26 21:23:41',	'2018-05-26 21:23:41'),
(36,	2,	'cobain',	'cobain',	'cobain',	'cobain@gmail.com',	'bed5022921aa27b94229bb951668c58b',	'2018-05-26 21:37:27',	'2018-06-25 19:54:04');

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE `user_status` (
  `user_status_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_status` (`user_status_id`, `user_status_name`) VALUES
(1,	'admin'),
(2,	'user');

-- 2018-06-25 13:11:29
