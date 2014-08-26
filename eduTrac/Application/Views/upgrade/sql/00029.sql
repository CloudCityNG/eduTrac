DROP TABLE `person_perms`;

CREATE TABLE IF NOT EXISTS `person_perms` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `permission` text NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `personID` (`personID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `person_perms` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person_roles` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

DROP TABLE `role`;

CREATE TABLE IF NOT EXISTS `role` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `roleName` varchar(20) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `roleName` (`roleName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `role` VALUES(00000000000000000009, 'Faculty', 'a:19:{i:0;s:21:"access_faculty_screen";i:1;s:21:"access_student_screen";i:2;s:24:"access_course_sec_screen";i:3;s:23:"course_sec_inquiry_only";i:4;s:19:"course_inquiry_only";i:5;s:23:"access_acad_prog_screen";i:6;s:22:"acad_prog_inquiry_only";i:7;s:20:"address_inquiry_only";i:8;s:20:"general_inquiry_only";i:9;s:20:"faculty_inquiry_only";i:10;s:20:"student_inquiry_only";i:11;s:24:"access_stu_roster_screen";i:12;s:21:"access_grading_screen";i:13;s:19:"person_inquiry_only";i:14;s:19:"access_staff_screen";i:15;s:18:"staff_inquiry_only";i:16;s:16:"access_dashboard";i:17;s:16:"access_academics";i:18;s:18:"access_person_mgmt";}');

INSERT INTO `role` VALUES(00000000000000000010, 'Parent', '');

INSERT INTO `role` VALUES(00000000000000000011, 'Student', 'a:2:{i:0;s:21:"access_student_portal";i:1;s:12:"room_request";}');

INSERT INTO `role` VALUES(00000000000000000012, 'Staff', 'a:32:{i:0;s:27:"access_sql_interface_screen";i:1;s:20:"access_course_screen";i:2;s:21:"access_faculty_screen";i:3;s:21:"access_student_screen";i:4;s:28:"access_email_template_screen";i:5;s:24:"access_course_sec_screen";i:6;s:23:"course_sec_inquiry_only";i:7;s:19:"course_inquiry_only";i:8;s:20:"access_person_screen";i:9;s:23:"access_acad_prog_screen";i:10;s:22:"acad_prog_inquiry_only";i:11;s:23:"access_error_log_screen";i:12;s:20:"access_report_screen";i:13;s:20:"address_inquiry_only";i:14;s:25:"access_save_query_screens";i:15;s:12:"access_forms";i:16;s:17:"create_fac_record";i:17;s:24:"access_stu_roster_screen";i:18;s:22:"access_bill_tbl_screen";i:19;s:17:"add_crse_sec_bill";i:20;s:11:"import_data";i:21;s:19:"person_inquiry_only";i:22;s:19:"access_staff_screen";i:23;s:18:"staff_inquiry_only";i:24;s:19:"create_staff_record";i:25;s:23:"access_student_accounts";i:26;s:16:"access_academics";i:27;s:22:"access_human_resources";i:28;s:17:"submit_timesheets";i:29;s:10:"access_sql";i:30;s:18:"access_person_mgmt";i:31;s:22:"access_payment_gateway";}');

INSERT INTO `role` VALUES(00000000000000000008, 'Super Administrator', '');

UPDATE `et_option` SET option_value = '00030' WHERE option_name = 'dbversion';