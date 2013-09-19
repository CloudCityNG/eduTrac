DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `applID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `acadProgID` int(11) unsigned zerofill NOT NULL,
  `startTerm` int(11) unsigned zerofill NOT NULL,
  `admitStatus` varchar(2) DEFAULT NULL,
  `PSAT_Verbal` varchar(5) NOT NULL,
  `PSAT_Math` varchar(5) NOT NULL,
  `SAT_Verbal` varchar(5) NOT NULL,
  `SAT_Math` varchar(5) NOT NULL,
  `ACT_English` varchar(5) NOT NULL,
  `ACT_Math` varchar(5) NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`applID`),
  UNIQUE KEY `application` (`personID`,`acadProgID`),
  KEY `startTerm` (`startTerm`),
  KEY `addedBy` (`addedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `institution`;
CREATE TABLE IF NOT EXISTS `institution` (
  `institutionID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ficeCode` int(6) DEFAULT NULL,
  `instType` varchar(4) NOT NULL,
  `instName` varchar(180) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  PRIMARY KEY (`institutionID`),
  UNIQUE KEY `ficeCode` (`ficeCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `institution_attended`;
CREATE TABLE IF NOT EXISTS `institution_attended` (
  `instAttID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `instID` int(11) unsigned zerofill NOT NULL,
  `personID` int(8) unsigned zerofill NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `GPA` double(4,1) DEFAULT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`instAttID`),
  UNIQUE KEY `inst_att` (`instID`,`personID`),
  KEY `personID` (`personID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `stu_acad_cred`;
CREATE TABLE IF NOT EXISTS `stu_acad_cred` (
  `stuAcadCredID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `compCred` double(4,1) NOT NULL,
  `attCred` double(4,1) NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `grade` varchar(2) DEFAULT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuAcadCredID`),
  UNIQUE KEY `stuAcadCred` (`stuID`,`courseSecID`,`termID`),
  KEY `courseSecID` (`courseSecID`),
  KEY `termID` (`termID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `stu_term`;
CREATE TABLE IF NOT EXISTS `stu_term` (
  `stuTermID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `termCredits` double(6,1) NOT NULL DEFAULT '0.0',
  `addDateTime` datetime NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuTermID`),
  UNIQUE KEY `stuTerm` (`stuID`,`termID`,`acadLevelCode`),
  KEY `termID` (`termID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `stu_term_load`;
CREATE TABLE IF NOT EXISTS `stu_term_load` (
  `stuLoadID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `stuLoad` varchar(2) NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuLoadID`),
  UNIQUE KEY `stuTermLoad` (`stuID`,`termID`,`acadLevelCode`),
  KEY `student_load` (`stuLoad`),
  KEY `termID` (`termID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `stu_acad_level`;
CREATE TABLE IF NOT EXISTS `stu_acad_level` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `acadProgID` int(11) unsigned zerofill NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `addDate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_acad_level` (`stuID`,`acadProgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `permission` VALUES(00000000000000000203, 'access_institutions_screen', 'Access Institutions Screen');

INSERT INTO `permission` VALUES(00000000000000000204, 'add_institution', 'Add Institution');

INSERT INTO `permission` VALUES(00000000000000000205, 'access_application_screen', 'Access Application Screen');

INSERT INTO `permission` VALUES(00000000000000000206, 'create_application', 'Create Application');

INSERT INTO `role_perms` VALUES(00000000000000000973, 12, 89, 1, '2013-09-15 21:00:54');

INSERT INTO `role_perms` VALUES(00000000000000000974, 12, 85, 1, '2013-09-15 21:00:54');

INSERT INTO `screen` VALUES(41, 'INST', 'Institution', 'institution/');

INSERT INTO `screen` VALUES(42, 'AINST', 'New Institution', 'institution/add/');

INSERT INTO `screen` VALUES(43, 'APPL', 'Application', 'application/');

INSERT INTO `cronjob` VALUES(2, 'cron/runStuTerms/', 'Create Student Terms Record', NULL, 0, NULL, 0, 0);

INSERT INTO `cronjob` VALUES(3, 'cron/runStuLoad/', 'Create Student Load Record', NULL, 0, NULL, 0, 0);

INSERT INTO `cronjob` VALUES(4, 'cron/updateStuTerms/', 'Update Student Terms', NULL, 0, NULL, 0, 0);

INSERT INTO `cronjob` VALUES(5, 'cron/updateStuLoad/', 'Update Student Load', NULL, 0, NULL, 0, 0);

ALTER TABLE `stu_course_sec` DROP COLUMN `grade`;

ALTER TABLE `course_sec` ADD COLUMN `startTime` varchar(8) DEFAULT NULL AFTER `endDate`;

ALTER TABLE `course_sec` ADD COLUMN `endTime` varchar(8) DEFAULT NULL AFTER `startTime`;

ALTER TABLE `application` ADD FOREIGN KEY (`startTerm`) REFERENCES `term` (`termID`) ON UPDATE CASCADE;

ALTER TABLE `application` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `application` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `course_sec` ADD FOREIGN KEY (`facID`) REFERENCES `faculty` (`facID`) ON UPDATE CASCADE;

ALTER TABLE `institution_attended` ADD FOREIGN KEY (`instID`) REFERENCES `institution` (`institutionID`) ON UPDATE CASCADE;

ALTER TABLE `institution_attended` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_acad_cred` ADD FOREIGN KEY (`courseSecID`) REFERENCES `course_sec` (`courseSecID`) ON UPDATE CASCADE;

ALTER TABLE `stu_acad_cred` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term_load` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE,

ALTER TABLE `stu_term_load` ADD FOREIGN KEY (`termID`) REFERENCES `stu_term` (`termID`) ON UPDATE CASCADE;

INSERT INTO `et_option` VALUES('', 'help_desk', 'http://community.7mediaws.org/projects/edutrac/');

UPDATE `et_option` SET option_value = '00005' WHERE option_name = 'dbversion';