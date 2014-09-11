ALTER TABLE course_sec CHANGE `buildingCode` `buildingID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course_sec CHANGE `roomCode` `roomID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course_sec CHANGE `locationCode` `locationID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course_sec CHANGE `deptCode` `deptID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course_sec CHANGE `termCode` `termID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course CHANGE `subjCode` `subjectID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course CHANGE `deptCode` `deptID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE course CHANGE `courseNumber` `courseNumber` int(6) NOT NULL;

ALTER TABLE course CHANGE `courseCode` `courseCode` varchar(12) NOT NULL;

ALTER TABLE acad_cred CHANGE `courseSecCode` `courseSecID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_cred CHANGE `termCode` `termID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `deptCode` `deptID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `schoolCode` `schoolID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `acadYearCode` `acadYearID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `degreeCode` `degreeID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `ccdCode` `ccdID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `majorCode` `majorID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `minorCode` `minorID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `specCode` `specID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `cipCode` `cipID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE acad_program CHANGE `locationCode` `locationID` int(11) unsigned zerofill NOT NULL;

DROP TABLE if exists catalog_year;

ALTER TABLE faculty CHANGE `buildingCode` `buildingID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE faculty CHANGE `officeCode` `officeID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE faculty CHANGE `deptCode` `deptID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE graduate CHANGE `schoolCode` `schoolID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE graudate CHANGE `progCode` `progID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE graduate CHANGE `catYear` `catYearID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE graduate CHANGE `catYear` `catYearID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE person DROP COLUMN `schoolCode`;

ALTER TABLE person DROP COLUMN `buildingCode`;

ALTER TABLE person DROP COLUMN `officeCode`;

ALTER TABLE person DROP COLUMN `office_phone`;

ALTER TABLE person DROP COLUMN `deptCode`;

ALTER TABLE room CHANGE `buildingCode` `buildingID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE graduate CHANGE `catYear` `catYearID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE school CHANGE `buildingCode` `buildingID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE semester CHANGE `acadYearCode` `acadYearID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE student CHANGE `catYear` `catYearID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_acad_cred CHANGE `courseSecCode` `courseSecID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_acad_cred CHANGE `termCode` `termID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_course_sec CHANGE `courseSecCode` `courseSecID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_course_sec CHANGE `termCode` `termID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_program CHANGE `progCode` `progID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_term CHANGE `termCode` `termID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE term CHANGE `semCode` `semesterID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE term CHANGE `termID` `termID` int(11) unsigned zerofill NOT NULL;

ALTER TABLE stu_comment CHANGE `stuID` `stuID` int(8) unsigned zerofill NOT NULL;

ALTER TABLE stu_comment CHANGE `addedBy` `addedBy` int(8) unsigned zerofill NOT NULL;

CREATE INDEX acad_prog_code ON acad_program (acadProgCode);

CREATE INDEX acad_level_code ON acad_program (acadLevelCode);

CREATE INDEX course_code ON course (courseCode);

CREATE INDEX course_level_code ON course (courseLevelCode);

CREATE INDEX acad_level_code ON course (acadLevelCode);

CREATE INDEX course_sec_code ON course_sec (courseSecCode);

CREATE INDEX current_status ON course_sec (currStatus);

CREATE INDEX person_type ON person (personType);

CREATE INDEX acad_level_code ON student (acadLevelCode);

CREATE INDEX stu_course_sec_status ON stu_course_sec (status);

CREATE INDEX stu_program_status ON stu_program (currStatus);

CREATE INDEX student_load ON stu_term_load (stuLoad);

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(30) NOT NULL,
  `eventDate` date NOT NULL DEFAULT '0000-00-00',
  `startTime` time NOT NULL DEFAULT '00:00:00',
  `endTime` time NOT NULL DEFAULT '00:00:00',
  `description` text NOT NULL,
  `recurring` tinyint(4) NOT NULL DEFAULT '0',
  `recurDOTW` tinyint(4) DEFAULT NULL,
  `eventDay` tinyint(4) NOT NULL DEFAULT '0',
  `catID` int(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `approved` enum('1','0') NOT NULL DEFAULT '0',
  `endDate` date NOT NULL DEFAULT '0000-00-00',
  `roomID` int(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_date` (`eventDate`),
  KEY `event_name` (`eventName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reservation_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(30) NOT NULL,
  `fgcolor` char(8) NOT NULL DEFAULT '#000000',
  `bgcolor` char(8) NOT NULL DEFAULT '#ffffff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `address` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `address` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `course` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `course_sec` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `faculty` ADD FOREIGN KEY (`facID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `faculty` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `graduate` ADD FOREIGN KEY (`gradID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `graduate` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person_roles` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person_perms` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `saved_query` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `staff` ADD FOREIGN KEY (`staffID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `staff` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `student` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `student` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_program` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_program` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term_load` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_acad_cred` ADD FOREIGN KEY (`courseSecID`) REFERENCES `course_sec` (`courseSecID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_acad_cred` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`courseSecID`) REFERENCES `course_sec` (`courseSecID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_program` ADD FOREIGN KEY (`progID`) REFERENCES `acad_program` (`acadProgID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_term` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_term_load` ADD FOREIGN KEY (`stuTermID`) REFERENCES `stu_term` (`stuTermID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `term` ADD FOREIGN KEY (`semesterID`) REFERENCES `semester` (`semesterID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_comment` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_comment` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

INSERT INTO `et_option` VALUES(12, 'hour_display', '12');

INSERT INTO `et_option` VALUES(13, 'limit_query_size', '30');

INSERT INTO `et_option` VALUES(14, 'week_start', '0');

INSERT INTO `et_option` VALUES(15, 'startTime', '08:00 AM');

INSERT INTO `et_option` VALUES(16, 'endTime', '05:00 PM');

INSERT INTO `et_option` VALUES(17, 'bullets_display', '0');

INSERT INTO `et_option` VALUES(18, 'enable_reserve_email', '1');

INSERT INTO `et_option` VALUES(19, 'reserve_from_email', 'test@gmail.com');

INSERT INTO `et_option` VALUES(20, 'reserve_reply_email', '');

UPDATE `et_option` SET option_value = '00002' WHERE option_name = 'dbversion';