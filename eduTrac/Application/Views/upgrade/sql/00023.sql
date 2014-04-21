ALTER TABLE `course_sec` MODIFY COLUMN `courseFee` DOUBLE(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `course_sec` MODIFY COLUMN `labFee` DOUBLE(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `course_sec` MODIFY COLUMN `materialFee` DOUBLE(10,2) NOT NULL DEFAULT '0.00';

ALTER TABLE `student_fee` ADD COLUMN `termCode` varchar(11) NOT NULL AFTER `stuID`;

ALTER TABLE `stu_course_sec` ADD COLUMN `courseFee` double(10,2) NOT NULL DEFAULT '0.00' AFTER `ceu`;

ALTER TABLE `stu_course_sec` ADD COLUMN `labFee` double(10,2) NOT NULL DEFAULT '0.00' AFTER `courseFee`;

ALTER TABLE `stu_course_sec` ADD COLUMN `materialFee` double(10,2) NOT NULL DEFAULT '0.00' AFTER `labFee`;

ALTER TABLE `student_fee` ADD FOREIGN KEY (`termCode`) REFERENCES `term` (`termCode`) ON UPDATE CASCADE;

UPDATE `et_option` SET option_value = '00024' WHERE option_name = 'dbversion';