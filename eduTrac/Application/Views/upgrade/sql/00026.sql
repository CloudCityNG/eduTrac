ALTER TABLE `institution` CHANGE `ficeCode` `schoolCode` varchar(11) DEFAULT NULL;

ALTER TABLE `institution` ADD INDEX `schoolCode` (`schoolCode`);

ALTER TABLE `institution` ADD COLUMN `country` varchar(2) NOT NULL AFTER `state`;

ALTER TABLE `institution_attended` DROP FOREIGN KEY `institution_attended_ibfk_1`;

ALTER TABLE `institution_attended` DROP INDEX `inst_att`;

ALTER TABLE `institution_attended` CHANGE `instID` `schoolCode` varchar(11) NOT NULL;

ALTER TABLE `institution_attended` ADD COLUMN `major` varchar(255) NOT NULL AFTER `toDate`;

ALTER TABLE `institution_attended` ADD COLUMN `degree_awarded` varchar(6) NOT NULL AFTER `major`;

ALTER TABLE `institution_attended` ADD COLUMN `degree_conferred_date` date NOT NULL AFTER `degree_awarded`;

ALTER TABLE `institution_attended` ADD UNIQUE `inst_att` (`schoolCode`,`personID`);

ALTER TABLE `application` ADD COLUMN `applDate` date NOT NULL AFTER `ACT_Math`;

ALTER TABLE `building` ADD COLUMN `locationCode` varchar(11) DEFAULT NULL AFTER `buildingName`;

ALTER TABLE `building` ADD FOREIGN KEY (`locationCode`) REFERENCES `location` (`locationCode`) ON UPDATE CASCADE;

ALTER TABLE `institution_attended` ADD FOREIGN KEY (`schoolCode`) REFERENCES `institution` (`schoolCode`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00027' WHERE option_name = 'dbversion';