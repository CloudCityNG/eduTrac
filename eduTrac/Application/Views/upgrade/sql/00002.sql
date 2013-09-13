ALTER TABLE `course` CHANGE `courseLevelCode` `courseLevelCode` varchar(5) NOT NULL;

ALTER TABLE `course_sec` CHANGE `courseLevelCode` `courseLevelCode` varchar(5) NOT NULL;

UPDATE `permission` SET permKey = 'delete_course_sec' WHERE ID = '00000000000000000182';

INSERT INTO `permission` VALUES(00000000000000000201, 'activate_course_sec', 'Activate Course Section');

INSERT INTO `permission` VALUES(00000000000000000202, 'cancel_course_sec', 'Cancel Course Section');

UPDATE `et_option` SET option_value = '00003' WHERE option_name = 'dbversion';