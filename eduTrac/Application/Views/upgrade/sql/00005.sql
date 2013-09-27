DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `etID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `deptID` int(11) unsigned zerofill NOT NULL,
  `email_key` varchar(30) NOT NULL,
  `email_name` varchar(30) NOT NULL,
  `email_value` longtext NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`etID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `email_hold` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `queryID` int(11) unsigned zerofill NOT NULL,
  `fromName` varchar(118) NOT NULL,
  `fromEmail` varchar(118) NOT NULL,
  `subject` varchar(118) NOT NULL,
  `body` longtext NOT NULL,
  `processed` enum('1','0') NOT NULL DEFAULT '0',
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `email_queue` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `holdID` int(11) unsigned zerofill NOT NULL,
  `personID` int(8) unsigned zerofill NOT NULL,
  `fromName` varchar(118) NOT NULL,
  `fromEmail` varchar(118) NOT NULL,
  `uname` varchar(118) NOT NULL,
  `email` varchar(118) NOT NULL,
  `fname` varchar(118) NOT NULL,
  `lname` varchar(118) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `body` longtext NOT NULL,
  `sent` enum('1','0') NOT NULL DEFAULT '0',
  `sentDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `graduation_hold` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `queryID` int(11) unsigned zerofill NOT NULL,
  `gradDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `staffID` int(8) unsigned zerofill NOT NULL,
  `schoolID` int(11) unsigned zerofill NOT NULL,
  `buildingID` int(11) unsigned zerofill NOT NULL,
  `officeID` int(11) unsigned zerofill NOT NULL,
  `office_phone` varchar(15) NOT NULL,
  `deptID` int(11) unsigned zerofill NOT NULL,
  `addDate` date NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staffID` (`staffID`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_term_gpa` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `attCred` double(4,1) NOT NULL DEFAULT '0.0',
  `compCred` double(4,1) NOT NULL DEFAULT '0.0',
  `gradePoints` double(4,1) NOT NULL DEFAULT '0.0',
  `termGPA` double(4,2) NOT NULL DEFAULT '0.00',
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `acad_cred`;

ALTER TABLE `student` DROP COLUMN `antGradDate`;

ALTER TABLE `staff` CHANGE `schoolID` `schoolID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE `staff` CHANGE `buildingID` `buildingID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE `staff` CHANGE `officeID` `officeID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE `staff` CHANGE `deptID` `deptID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE `stu_acad_cred` ADD COLUMN `gradePoints` double(4,2) NOT NULL DEFAULT '0.00' AFTER `compCred`;

ALTER TABLE `course_sec` CHANGE `secShortTitle` `secShortTitle` varchar(60) NOT NULL;

ALTER TABLE `course_sec` DROP FOREIGN KEY `course_sec_ibfk_2`;

ALTER TABLE `student` ADD COLUMN `status` enum('A','H','L','W') NOT NULL DEFAULT 'A' AFTER `acadLevelCode`;

CREATE INDEX status ON student (status);

ALTER TABLE `stu_program` ADD COLUMN `eligible_to_graduate` enum('1','0') NOT NULL DEFAULT '0' AFTER `currStatus`;

ALTER TABLE `stu_program` ADD COLUMN `antGradDate` varchar(5) NOT NULL AFTER `eligible_to_graduate`;

ALTER TABLE `stu_term` CHANGE `LastUpdate` `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE `staff` ADD COLUMN `status` enum('A','I') NOT NULL DEFAULT 'A' AFTER `deptID`;

ALTER TABLE `faculty` ADD COLUMN `status` enum('A','I') NOT NULL DEFAULT 'A' AFTER `deptID`;

ALTER TABLE `faculty` ADD COLUMN `schoolID` int(11) unsigned zerofill NOT NULL AFTER `facID`;

INSERT INTO `permission` VALUES('', 'access_staff_screen', 'Staff Screen');

INSERT INTO `permission` VALUES('', 'staff_inquiry_only', 'Staff Inquiry Only');

INSERT INTO `permission` VALUES('', 'create_staff_record', 'Create Staff Record');

INSERT INTO `permission` VALUES('', 'graduate_students', 'Graduate Students');

INSERT INTO `permission` VALUES('', 'generate_transcripts', 'Generate Transcripts');

INSERT INTO `cronjob` VALUES('', 'cron/runEmailHold/', 'Process Email Hold Table', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/runEmailQueue/', 'Process Email Queue', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/purgeEmailHold/', 'Purge Email Hold', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/purgeEmailQueue/', 'Purge Email Queue', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/runGraduation/', 'Process Graduation', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/runTermGPA/', 'Create Student Term GPA Record', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/updateTermGPA/', 'Update Term GPA', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/purgeErrorLog/', 'Purge Error Log', NULL, 0, 0, 0, 0);

INSERT INTO `et_option` VALUES('', 'enable_cron_jobs', 0);

INSERT INTO `et_option` VALUES('', 'reset_password_text', '<b>eduTrac Password Reset</b><br>Password &amp; Login Information<br><br>You or someone else requested a new password to the eduTrac online system. If you did not request this change, please contact the administrator as soon as possible @ #adminemail#.&nbsp; To log into the eduTrac system, please visit #url# and login with your username and password.<br><br>FULL NAME:&nbsp; #fname# #lname#<br>USERNAME:&nbsp; #uname#<br>PASSWORD:&nbsp; #password#<br><br>If you need further assistance, please read the documentation at #helpdesk#.<br><br>KEEP THIS IN A SAFE AND SECURE LOCATION.<br><br>Thank You,<br>eduTrac Web Team<br>');

UPDATE `et_option` SET option_value = '00006' WHERE option_name = 'dbversion';