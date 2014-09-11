INSERT INTO `cronjob` VALUES('', 'cron/runDBBackup/', 'Backup Database', NULL, 0, 0, 0, 0);

UPDATE `et_option` SET option_value = '00009' WHERE option_name = 'dbversion';