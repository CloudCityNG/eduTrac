ALTER TABLE `school` DROP COLUMN `ficeCode`;

ALTER TABLE `institution` DROP INDEX `schoolCode`;

ALTER TABLE `institution_attended` DROP INDEX `inst_att`;

ALTER TABLE `institution` CHANGE `schoolCode` `fice_ceeb` varchar(11) DEFAULT NULL;

ALTER TABLE `institution` ADD INDEX `fice_ceeb` (`fice_ceeb`);

ALTER TABLE `institution_attended` CHANGE `schoolCode` `fice_ceeb` varchar(11) NOT NULL;

ALTER TABLE `institution_attended` ADD UNIQUE `inst_att` (`fice_ceeb`,`personID`);

ALTER TABLE `institution_attended` ADD FOREIGN KEY (`fice_ceeb`) REFERENCES `institution` (`fice_ceeb`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00028' WHERE option_name = 'dbversion';