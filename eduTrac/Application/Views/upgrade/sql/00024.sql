ALTER TABLE `course_sec` ADD COLUMN `comment` text NOT NULL AFTER `statusDate`;

ALTER TABLE `stu_course_sec` DROP COLUMN `courseFee`;

ALTER TABLE `stu_course_sec` DROP COLUMN `labFee`;

ALTER TABLE `stu_course_sec` DROP COLUMN `materialFee`;

UPDATE `et_option` SET option_value = '00025' WHERE option_name = 'dbversion';