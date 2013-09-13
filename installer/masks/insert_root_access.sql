INSERT INTO `person` (`personID`, `uname`, `password`, `fname`, `email`,`personType`) 
VALUES (NULL, '{admin_username}', '{admin_password}', '{admin_realname}', '{admin_email}','STA');

INSERT INTO `et_option` VALUES(1, 'dbversion', '00004');

INSERT INTO `et_option` VALUES(2, 'system_email', '{admin_email}');

INSERT INTO `et_option` VALUES(3, 'enable_ssl', '0');

INSERT INTO `et_option` VALUES(4, 'site_title', '{sitetitle}');

INSERT INTO `et_option` VALUES(5, 'cookieexpire', '604800');

INSERT INTO `et_option` VALUES(6, 'cookiepath', '/');

INSERT INTO `et_option` VALUES(7, 'hold_file_loc', '/Applications/MAMP/_HOLD_/');

INSERT INTO `et_option` VALUES(8, 'enable_benchmark', '0');

INSERT INTO `et_option` VALUES(9, 'maintenance_mode', '0');

INSERT INTO `et_option` VALUES(10, 'enable_cron_log', '0');

INSERT INTO `et_option` VALUES(11, 'current_term_code', '');

INSERT INTO `et_option` VALUES(12, 'hour_display', '12');

INSERT INTO `et_option` VALUES(13, 'limit_query_size', '30');

INSERT INTO `et_option` VALUES(14, 'week_start', '0');

INSERT INTO `et_option` VALUES(15, 'startTime', '08:00 AM');

INSERT INTO `et_option` VALUES(16, 'endTime', '05:00 PM');

INSERT INTO `et_option` VALUES(17, 'bullets_display', '0');

INSERT INTO `et_option` VALUES(18, 'enable_reserve_email', '1');

INSERT INTO `et_option` VALUES(19, 'reserve_from_email', 'test@gmail.com');

INSERT INTO `et_option` VALUES(20, 'reserve_reply_email', '');

INSERT INTO `person_roles` VALUES(1, 1, 8, '{datenow}');

INSERT INTO `cronjob` VALUES(1, '{siteurl}cron/activityLog/', 'Purge Activity Log', 300, 1378271185, 1378270885, 0, 0);