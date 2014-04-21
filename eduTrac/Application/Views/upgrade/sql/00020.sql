CREATE TABLE IF NOT EXISTS `grade_scale` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `grade` varchar(2) NOT NULL,
  `percent` varchar(10) NOT NULL,
  `points` decimal(6,2) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `grade_scale` VALUES(00000000001, 'A+', '97-100', '4.00', '1', '');

INSERT INTO `grade_scale` VALUES(00000000002, 'A', '93-96', '4.00', '1', '');

INSERT INTO `grade_scale` VALUES(00000000003, 'A-', '90-92', '3.70', '1', '');

INSERT INTO `grade_scale` VALUES(00000000004, 'B+', '87-89', '3.30', '1', '');

INSERT INTO `grade_scale` VALUES(00000000005, 'B', '83-86', '3.00', '1', '');

INSERT INTO `grade_scale` VALUES(00000000006, 'B-', '80-82', '2.70', '1', '');

INSERT INTO `grade_scale` VALUES(00000000007, 'P', '80-82', '2.70', '1', 'Minimum for Pass/Fail courses');

INSERT INTO `grade_scale` VALUES(00000000008, 'C+', '77-79', '2.30', '1', '');

INSERT INTO `grade_scale` VALUES(00000000009, 'C', '73-76', '2.00', '1', '');

INSERT INTO `grade_scale` VALUES(00000000010, 'C-', '70-72', '1.70', '1', '');

INSERT INTO `grade_scale` VALUES(00000000011, 'D+', '67-69', '1.30', '1', '');

INSERT INTO `grade_scale` VALUES(00000000012, 'D', '65-66', '1.00', '1', '');

INSERT INTO `grade_scale` VALUES(00000000013, 'F', 'Below 65', '0.00', '1', '');

INSERT INTO `grade_scale` VALUES(00000000014, 'I', '0', '0.00', '1', 'Incomplete grades');

INSERT INTO `grade_scale` VALUES(00000000015, 'AW', '0', '0.00', '1', '"AW" is an administrative grade assigned to students who have attended no more than the first two classes, but who have not officially dropped or withdrawn from the course. Does not count against GPA.');

INSERT INTO `grade_scale` VALUES(00000000016, 'NA', '0', '0.00', '1', '"NA" is an administrative grade assigned to students who are officially registered for the course and whose name appears on the grade roster, but who have never attended class. Does not count against GPA.');

INSERT INTO `grade_scale` VALUES(00000000017, 'W', '0', '0.00', '1', 'Withdrew');

INSERT INTO `grade_scale` VALUES(00000000018, 'IP', '90-98', '4.00', '1', 'Incomplete passing');

UPDATE `et_option` SET option_value = '00021' WHERE option_name = 'dbversion';