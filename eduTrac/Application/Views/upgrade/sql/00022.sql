DROP TABLE IF EXISTS `credit_load`;

CREATE TABLE IF NOT EXISTS `student_load_rule` (
  `slrID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `status` varchar(1) NOT NULL,
  `min_cred` double(4,1) NOT NULL,
  `max_cred` double(4,1) NOT NULL,
  `term` varchar(255) NOT NULL,
  `acadLevelCode` varchar(255) NOT NULL,
  `active` enum('1','0') NOT NULL,
  PRIMARY KEY (`slrID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `student_load_rule` VALUES(00000000001, 'F', 12.0, 24.0, 'FA\\SP\\SU', 'CE\\UG\\GR\\PhD', '1');

INSERT INTO `student_load_rule` VALUES(00000000002, 'Q', 9.0, 11.0, 'FA\\SP\\SU', 'CE\\UG\\GR\\PhD', '1');

INSERT INTO `student_load_rule` VALUES(00000000003, 'H', 6.0, 8.0, 'FA\\SP\\SU', 'CE\\UG\\GR\\PhD', '1');

INSERT INTO `student_load_rule` VALUES(00000000004, 'L', 0.0, 5.0, 'FA\\SP\\SU', 'CE\\UG\\GR\\PhD', '1');

UPDATE `et_option` SET option_value = '00023' WHERE option_name = 'dbversion';