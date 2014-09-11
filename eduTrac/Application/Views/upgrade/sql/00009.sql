DROP TABLE IF EXISTS `parent`;

DROP TABLE IF EXISTS `parent_student`;

CREATE TABLE IF NOT EXISTS `parent` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `parentID` int(8) unsigned zerofill NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `addDate` datetime NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `parentID` (`parentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `parent_child` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `parentID` int(8) unsigned zerofill NOT NULL,
  `childID` int(8) unsigned zerofill NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `parent_student_index` (`parentID`,`childID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `progress_report` (
  `prID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `facID` int(11) unsigned zerofill NOT NULL,
  `grade` varchar(30) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `behavior` varchar(180) NOT NULL,
  `assignments` varchar(180) NOT NULL,
  `notes` text NOT NULL,
  `courseTitle` varchar(180) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`prID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

UPDATE `et_option` SET option_value = '00010' WHERE option_name = 'dbversion';