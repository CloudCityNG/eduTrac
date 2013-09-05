INSERT INTO `person` (`personID`, `uname`, `password`, `fname`, `email`,`personType`) 
VALUES (NULL, '{admin_username}', '{admin_password}', '{admin_realname}', '{admin_email}','STA');

INSERT INTO `et_option` VALUES(1, 'dbversion', '00001');

INSERT INTO `et_option` VALUES(2, 'system_email', '{admin_email}');

INSERT INTO `et_option` VALUES(3, 'enable_ssl', '0');

INSERT INTO `et_option` VALUES(4, 'site_title', '{sitetitle}');

INSERT INTO `et_option` VALUES(5, 'cookieexpire', '604800');

INSERT INTO `et_option` VALUES(6, 'cookiepath', '/');

INSERT INTO `et_option` VALUES(7, 'hold_file_loc', '/Applications/MAMP/_HOLD_/');

INSERT INTO `et_option` VALUES(8, 'enable_benchmark', '0');

INSERT INTO `et_option` VALUES(9, 'maintenance_mode', '0');

INSERT INTO `et_option` VALUES(10, 'enable_cron_log', '0');

INSERT INTO `et_option` VALUES(11, 'current_term_code', '13/SP');

INSERT INTO `person_roles` VALUES(1, 00000001, 8, '{datenow}');

INSERT INTO `cronjob` VALUES(1, '{siteurl}cron/activityLog/', 'Purge Activity Log', 300, 1378271185, 1378270885, 0, 0);