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

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE `user_status` (
  `user_status_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_status` (`user_status_id`, `user_status_name`) VALUES
(1,	'admin'),
(2,	'user');

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

-- 2018-06-25 13:11:29
