CREATE TABLE IF NOT EXISTS `restriction` (
  `rstrID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `rstrCode` varchar(6) NOT NULL,
  `severity` int(2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `comment` text NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rstrID`),
  KEY `rstrCode` (`rstrCode`),
  KEY `stuID` (`stuID`),
  KEY `addedBy` (`addedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `restriction_code` (
  `rstrCodeID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `rstrCode` varchar(6) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deptCode` varchar(11) NOT NULL,
  PRIMARY KEY (`rstrCodeID`),
  KEY `deptCode` (`deptCode`),
  KEY `rstrCode` (`rstrCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `restriction_code` ADD FOREIGN KEY (`deptCode`) REFERENCES `department` (`deptCode`) ON UPDATE CASCADE;

ALTER TABLE `restriction` ADD FOREIGN KEY (`rstrCode`) REFERENCES `restriction_code` (`rstrCode`) ON UPDATE CASCADE;

ALTER TABLE `restriction` ADD FOREIGN KEY (`stuID`) REFERENCES `student` (`stuID`) ON UPDATE CASCADE;

ALTER TABLE `restriction` ADD FOREIGN KEY (`addedBy`) REFERENCES `staff` (`staffID`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00022' WHERE option_name = 'dbversion';