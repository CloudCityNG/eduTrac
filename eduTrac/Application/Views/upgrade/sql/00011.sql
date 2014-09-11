DROP TABLE IF EXISTS `attend`;

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendance_index` (`courseSecID`,`stuID`,`date`),
  KEY `stuID` (`stuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `attendance` ADD FOREIGN KEY (`stuID`) REFERENCES `student` (`stuID`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00012' WHERE option_name = 'dbversion';