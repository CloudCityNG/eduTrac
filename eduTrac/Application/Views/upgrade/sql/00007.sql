ALTER TABLE `term` ADD COLUMN `dropAddEndDate` date NOT NULL DEFAULT '0000-00-00' AFTER `reportingTerm`;

INSERT INTO `screen` VALUES('', 'BRGN', 'Batch Course Registration', 'section/batch_register/');

INSERT INTO `screen` VALUES('', 'STAF', 'Staff', 'staff/');

INSERT INTO `cronjob` VALUES('', 'cron/purgeSavedQuery/', 'Purge Saved Queries', 86400, 1380595419, 0, 0, 0);

INSERT INTO `cronjob` VALUES('', 'cron/purgeCronLogs/', 'Purge Cron Logs', 86400, 1380595404, 0, 0, 0);

UPDATE `et_option` SET option_value = '00008' WHERE option_name = 'dbversion';