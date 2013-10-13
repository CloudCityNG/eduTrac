INSERT INTO `person` (`personID`, `uname`, `password`, `fname`, `email`,`personType`,`approvedBy`) VALUES (NULL, '{admin_username}', '{admin_password}', '{admin_realname}', '{admin_email}', 'STA', '1');

INSERT INTO `et_option` VALUES(1, 'dbversion', '00010');

INSERT INTO `et_option` VALUES(2, 'system_email', '{admin_email}');

INSERT INTO `et_option` VALUES(3, 'enable_ssl', '0');

INSERT INTO `et_option` VALUES(4, 'site_title', '{sitetitle}');

INSERT INTO `et_option` VALUES(5, 'cookieexpire', '604800');

INSERT INTO `et_option` VALUES(6, 'cookiepath', '/');

INSERT INTO `et_option` VALUES(7, 'hold_file_loc', '/Applications/MAMP/_HOLD_/');

INSERT INTO `et_option` VALUES(8, 'enable_benchmark', '0');

INSERT INTO `et_option` VALUES(9, 'maintenance_mode', '0');

INSERT INTO `et_option` VALUES(10, 'enable_cron_log', '0');

INSERT INTO `et_option` VALUES(11, 'current_term_id', '');

INSERT INTO `et_option` VALUES(12, 'hour_display', '12');

INSERT INTO `et_option` VALUES(13, 'limit_query_size', '30');

INSERT INTO `et_option` VALUES(14, 'week_start', '0');

INSERT INTO `et_option` VALUES(15, 'startTime', '08:00 AM');

INSERT INTO `et_option` VALUES(16, 'endTime', '05:00 PM');

INSERT INTO `et_option` VALUES(17, 'bullets_display', '0');

INSERT INTO `et_option` VALUES(18, 'enable_reserve_email', '1');

INSERT INTO `et_option` VALUES(19, 'reserve_from_email', 'test@gmail.com');

INSERT INTO `et_option` VALUES(20, 'reserve_reply_email', '');

INSERT INTO `et_option` VALUES(21, 'open_registration', '1');

INSERT INTO `et_option` VALUES(22, 'help_desk', 'http://community.7mediaws.org/projects/edutrac/');

INSERT INTO `et_option` VALUES(23, 'enable_cron_jobs', 0);

INSERT INTO `et_option` VALUES(24, 'reset_password_text', '<b>eduTrac Password Reset</b><br>Password &amp; Login Information<br><br>You or someone else requested a new password to the eduTrac online system. If you did not request this change, please contact the administrator as soon as possible @ #adminemail#.&nbsp; To log into the eduTrac system, please visit #url# and login with your username and password.<br><br>FULL NAME:&nbsp; #fname# #lname#<br>USERNAME:&nbsp; #uname#<br>PASSWORD:&nbsp; #password#<br><br>If you need further assistance, please read the documentation at #helpdesk#.<br><br>KEEP THIS IN A SAFE AND SECURE LOCATION.<br><br>Thank You,<br>eduTrac Web Team<br>');

INSERT INTO `person_roles` VALUES(1, 1, 8, '{datenow}');

INSERT INTO `staff` VALUES(1, '1', '', '', '', '', '', 'A', '{datenow}', '1', '');

INSERT INTO `cronjob` VALUES(1, '{siteurl}cron/activityLog/', 'Purge Activity Log', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(2, '{siteurl}cron/runStuTerms/', 'Create Student Terms Record', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(3, '{siteurl}cron/runStuLoad/', 'Create Student Load Record', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(4, '{siteurl}cron/updateStuTerms/', 'Update Student Terms', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(5, '{siteurl}cron/updateStuLoad/', 'Update Student Load', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(6, '{siteurl}cron/runEmailHold/', 'Process Email Hold Table', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(7, '{siteurl}cron/runEmailQueue/', 'Process Email Queue', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(8, '{siteurl}cron/purgeEmailHold/', 'Purge Email Hold', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(9, '{siteurl}cron/purgeEmailQueue/', 'Purge Email Queue', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(10, '{siteurl}cron/runGraduation/', 'Process Graduation', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(11, '{siteurl}cron/runTermGPA/', 'Create Student Term GPA Record', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(12, '{siteurl}cron/updateTermGPA/', 'Update Term GPA', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(13, '{siteurl}cron/purgeErrorLog/', 'Purge Error Log', NULL, 0, 0, 0, 0);

INSERT INTO `cronjob` VALUES(14, '{siteurl}cron/purgeSavedQuery/', 'Purge Saved Queries', 86400, 1380595419, 0, 0, 0);

INSERT INTO `cronjob` VALUES(15, '{siteurl}cron/purgeCronLogs/', 'Purge Cron Logs', 86400, 1380595404, 0, 0, 0);

INSERT INTO `cronjob` VALUES(16, '{siteurl}cron/runDBBackup/', 'Backup Database', NULL, 0, 0, 0, 0);