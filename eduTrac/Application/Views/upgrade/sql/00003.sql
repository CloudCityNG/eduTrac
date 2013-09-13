ALTER TABLE `school` ADD COLUMN `ficeCode` varchar(8) DEFAULT NULL AFTER `schoolID`;

ALTER TABLE `student` ADD FOREIGN KEY (`advisorID`) REFERENCES `faculty` (`facID`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00004' WHERE option_name = 'dbversion';