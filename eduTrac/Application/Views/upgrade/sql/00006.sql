ALTER TABLE `person_perms` DROP FOREIGN KEY `person_perms_ibfk_1`;

ALTER TABLE `person_roles` DROP FOREIGN KEY `person_roles_ibfk_1`;

UPDATE `et_option` SET option_value = '00007' WHERE option_name = 'dbversion';