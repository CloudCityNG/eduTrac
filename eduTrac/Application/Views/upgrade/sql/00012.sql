ALTER TABLE `stu_term` DROP COLUMN `stuTermID`;

ALTER TABLE `stu_term_gpa` DROP COLUMN `id`;

ALTER TABLE `stu_term_load` DROP COLUMN `stuLoadID`;

ALTER TABLE `stu_term_gpa` ADD UNIQUE `stu_term_gpa_unique` (`stuID`,`termID`,`acadLevelCode`);

UPDATE `et_option` SET option_value = '00013' WHERE option_name = 'dbversion';