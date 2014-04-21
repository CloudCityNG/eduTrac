CREATE TABLE IF NOT EXISTS `assignment` (
  `assignID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `facID` int(8) unsigned zerofill NOT NULL,
  `shortName` varchar(6) NOT NULL,
  `title` varchar(180) NOT NULL,
  `dueDate` date NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`assignID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `gradebook` (
  `gbID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `assignID` int(11) unsigned zerofill NOT NULL,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `facID` int(8) unsigned zerofill NOT NULL,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `grade` varchar(2) NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`gbID`),
  UNIQUE KEY `gradebook_unique_grade` (`assignID`,`courseSecID`,`facID`,`stuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

UPDATE `et_option` SET option_value = '00017' WHERE option_name = 'dbversion';