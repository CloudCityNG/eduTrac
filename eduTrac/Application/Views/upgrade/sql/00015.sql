CREATE TABLE IF NOT EXISTS `gl_account` (
  `glacctID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `gl_acct_number` varchar(200) NOT NULL,
  `gl_acct_name` varchar(200) NOT NULL,
  `gl_acct_type` varchar(200) NOT NULL,
  `gl_acct_memo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`glacctID`),
  UNIQUE KEY `gl_acct_number` (`gl_acct_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `gl_journal_entry` (
  `jeID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `gl_jentry_date` date NOT NULL,
  `gl_jentry_manual_id` varchar(100) DEFAULT NULL,
  `gl_jentry_title` varchar(100) DEFAULT NULL,
  `gl_jentry_description` varchar(200) DEFAULT NULL,
  `gl_jentry_personID` int(8) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`jeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `gl_transaction` (
  `trID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `jeID` int(11) unsigned zerofill DEFAULT NULL,
  `accountID` int(11) unsigned zerofill DEFAULT NULL,
  `gl_trans_date` date DEFAULT NULL,
  `gl_trans_memo` varchar(400) DEFAULT NULL,
  `gl_trans_debit` decimal(10,2) DEFAULT NULL,
  `gl_trans_credit` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`trID`),
  KEY `jeID` (`jeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `gl_transaction` ADD FOREIGN KEY (`jeID`) REFERENCES `gl_journal_entry` (`jeID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `permission` VALUES('', 'access_general_ledger', 'Access General Ledger');

UPDATE `et_option` SET option_value = '00016' WHERE option_name = 'dbversion';