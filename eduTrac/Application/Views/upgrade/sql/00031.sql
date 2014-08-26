CREATE TABLE IF NOT EXISTS `event_request` (
  `requestID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `eventType` varchar(255) NOT NULL,
  `catID` int(11) NOT NULL,
  `requestor` int(8) unsigned zerofill NOT NULL,
  `roomCode` varchar(11) DEFAULT NULL,
  `termCode` varchar(11) DEFAULT NULL,
  `title` varchar(120) NOT NULL,
  `description` text,
  `weekday` int(1) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `repeats` tinyint(1) DEFAULT NULL,
  `repeatFreq` tinyint(1) DEFAULT NULL,
  `addDate` date NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`requestID`),
  UNIQUE KEY `event_request` (`roomCode`,`termCode`,`title`,`weekday`,`startDate`,`startTime`,`endTime`),
  KEY `termCode` (`termCode`),
  KEY `requestor` (`requestor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `event_request` ADD FOREIGN KEY (`requestor`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `event_request` ADD FOREIGN KEY (`roomCode`) REFERENCES `room` (`roomCode`) ON UPDATE CASCADE;

ALTER TABLE `event_request` ADD FOREIGN KEY (`termCode`) REFERENCES `term` (`termCode`) ON UPDATE CASCADE;

ALTER TABLE `grade_scale` ADD COLUMN `count_in_gpa` enum('1','0') NOT NULL DEFAULT '0' AFTER `points`;
  
UPDATE `et_option` SET option_value = '00032' WHERE option_name = 'dbversion';