ALTER TABLE `course_sec` ADD COLUMN `courseFee` double(6,2) NOT NULL DEFAULT '0.00' AFTER `stuReg`;

ALTER TABLE `course_sec` ADD COLUMN `labFee` double(6,2) NOT NULL DEFAULT '0.00' AFTER `courseFee`;

ALTER TABLE `course_sec` ADD COLUMN `materialFee` double(6,2) NOT NULL DEFAULT '0.00' AFTER `labFee`;

CREATE TABLE IF NOT EXISTS `bill` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `billing_table` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  `amount` double(6,2) NOT NULL DEFAULT '0.00',
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `addDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `student_fee` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `billID` int(11) unsigned zerofill NOT NULL,
  `feeID` int(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `student_fee_index` (`stuID`,`billID`,`feeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `payment` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `amount` double(6,2) NOT NULL DEFAULT '0.00',
  `checkNum` varchar(8) DEFAULT NULL,
  `paymentTypeID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `payment_type` (
  `ptID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`ptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `payment_type` VALUES(1, 'Cash');

INSERT INTO `payment_type` VALUES(2, 'Check');

INSERT INTO `payment_type` VALUES(3, 'Credit Card');

INSERT INTO `payment_type` VALUES(4, 'Paypal');

INSERT INTO `payment_type` VALUES(5, 'Wire Transfer');

INSERT INTO `payment_type` VALUES(6, 'Money Order');

INSERT INTO `payment_type` VALUES(7, 'Student Load');

INSERT INTO `payment_type` VALUES(8, 'Grant');

INSERT INTO `payment_type` VALUES(9, 'Financial Aid');

INSERT INTO `payment_type` VALUES(10, 'Scholarship');

INSERT INTO `payment_type` VALUES(11, 'Waiver');

INSERT INTO `payment_type` VALUES(12, 'Other');

INSERT INTO `permission` VALUES('', 'access_student_accounts', 'Access Student Accounts');

INSERT INTO `permission` VALUES('', 'student_account_inquiry_only', 'Student Account Inquiry Only');

CREATE TABLE IF NOT EXISTS `refund` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `amount` double(6,2) NOT NULL DEFAULT '0.00',
  `comment` text NOT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `bill` ADD FOREIGN KEY (`stuID`) REFERENCES `student` (`stuID`) ON UPDATE CASCADE;

ALTER TABLE `payment` ADD FOREIGN KEY (`stuID`) REFERENCES `student` (`stuID`) ON UPDATE CASCADE;

ALTER TABLE `refund` ADD FOREIGN KEY (`stuID`) REFERENCES `student` (`stuID`) ON UPDATE CASCADE;

ALTER TABLE `student_fee` ADD FOREIGN KEY (`stuID`) REFERENCES `student` (`stuID`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00011' WHERE option_name = 'dbversion';