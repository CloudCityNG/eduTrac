CREATE TABLE IF NOT EXISTS `job` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `pay_grade` int(11) NOT NULL,
  `title` varchar(180) NOT NULL,
  `hourly_wage` decimal(4,2) DEFAULT NULL,
  `weekly_hours` int(4) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `job_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `typeCode` varchar(6) NOT NULL,
  `type` varchar(180) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `typeCode` (`typeCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `pay_grade` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `grade` varchar(10) NOT NULL,
  `minimum_salary` decimal(10,2) NOT NULL,
  `maximum_salary` decimal(10,2) NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `staff_meta` (
  `sMetaID` int(11) NOT NULL AUTO_INCREMENT,
  `jobStatusID` int(11) NOT NULL,
  `jobID` int(11) NOT NULL,
  `staffID` int(8) unsigned zerofill NOT NULL,
  `supervisorID` int(8) unsigned zerofill NOT NULL,
  `staffType` varchar(3) NOT NULL,
  `hireDate` date NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `addDate` date NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sMetaID`),
  KEY `staffID` (`staffID`),
  KEY `supervisorID` (`supervisorID`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `timesheet` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `employeeID` int(8) unsigned zerofill NOT NULL,
  `jobID` int(11) NOT NULL,
  `workWeek` date NOT NULL,
  `startDateTime` datetime NOT NULL,
  `endDateTime` datetime NOT NULL,
  `note` text NOT NULL,
  `status` enum('P','R','A') NOT NULL DEFAULT 'P',
  `addDate` varchar(20) NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `employeeID` (`employeeID`),
  KEY `addedBy` (`addedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `job_status` VALUES(1, 'FT', 'Full Time');

INSERT INTO `job_status` VALUES(2, 'TQ', 'Three Quarter Time');

INSERT INTO `job_status` VALUES(3, 'HT', 'Half Time');

INSERT INTO `job_status` VALUES(4, 'CT', 'Contract');

INSERT INTO `job_status` VALUES(5, 'PD', 'Per Diem');

INSERT INTO `job_status` VALUES(6, 'TFT', 'Temp Full Time');

INSERT INTO `job_status` VALUES(7, 'TTQ', 'Temp Three Quarter Time');

INSERT INTO `job_status` VALUES(8, 'THT', 'Temp Half Time');

INSERT INTO `permission` VALUES('', 'login_as_user', 'Login as User');

INSERT INTO `permission` VALUES('', 'access_academics', 'Access Academics');

INSERT INTO `permission` VALUES('', 'access_financials', 'Access Financials');

INSERT INTO `permission` VALUES('', 'access_human_resources', 'Access Human Resources');

INSERT INTO `permission` VALUES('', 'submit_timesheets', 'Submit Timesheets');

INSERT INTO `permission` VALUES('', 'access_sql', 'Access SQL');

INSERT INTO `permission` VALUES('', 'access_person_mgmt', 'Access Person Management');

ALTER TABLE `staff_meta` ADD FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON UPDATE CASCADE;

ALTER TABLE `staff_meta` ADD FOREIGN KEY (`supervisorID`) REFERENCES `staff` (`staffID`) ON UPDATE CASCADE;

ALTER TABLE `staff_meta` ADD FOREIGN KEY (`approvedBy`) REFERENCES `staff` (`staffID`) ON UPDATE CASCADE;

ALTER TABLE `timesheet` ADD FOREIGN KEY (`employeeID`) REFERENCES `staff` (`staffID`) ON UPDATE CASCADE;

ALTER TABLE `timesheet` ADD FOREIGN KEY (`addedBy`) REFERENCES `staff` (`staffID`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00018' WHERE option_name = 'dbversion';