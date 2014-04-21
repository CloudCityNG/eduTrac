INSERT INTO `screen` VALUES('', 'SLR', 'Student Load Rules', 'form/student_load_rule/');

INSERT INTO `screen` VALUES('', 'RSTR', 'Restriction Codes', 'form/rstr_code/');

INSERT INTO `screen` VALUES('', 'GRSC', 'Grade Scale', 'form/grade_scale/');

INSERT INTO `screen` VALUES('', 'SROS', 'Student Roster', 'section/sros/');

UPDATE `et_option` SET option_value = '00026' WHERE option_name = 'dbversion';