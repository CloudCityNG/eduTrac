CREATE TABLE IF NOT EXISTS `acad_cred` (
  `acadCredID` int(11) NOT NULL AUTO_INCREMENT,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `stuID` int(8) NOT NULL,
  `grade` varchar(5) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`acadCredID`),
  UNIQUE KEY `acadCred` (`courseSecID`,`termID`,`stuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `acad_program` (
  `acadProgID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `acadProgCode` varchar(15) NOT NULL,
  `acadProgTitle` varchar(180) NOT NULL,
  `programDesc` varchar(80) NOT NULL,
  `currStatus` varchar(1) NOT NULL,
  `statusDate` date NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `approvedDate` date NOT NULL,
  `deptID` int(11) unsigned zerofill NOT NULL,
  `schoolID` int(11) unsigned zerofill NOT NULL,
  `acadYearID` int(11) unsigned zerofill NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `degreeID` int(11) unsigned zerofill NOT NULL,
  `ccdID` int(11) unsigned zerofill DEFAULT NULL,
  `majorID` int(11) unsigned zerofill DEFAULT NULL,
  `minorID` int(11) unsigned zerofill DEFAULT NULL,
  `specID` int(11) unsigned zerofill DEFAULT NULL,
  `acadLevelCode` varchar(11) NOT NULL,
  `cipID` int(11) unsigned zerofill DEFAULT NULL,
  `locationID` int(11) unsigned zerofill DEFAULT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`acadProgID`),
  UNIQUE KEY `acadProgCode` (`acadProgCode`),
  KEY `acad_prog_code` (`acadProgCode`),
  KEY `acad_level_code` (`acadLevelCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `acad_year` (
  `acadYearID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `acadYearCode` varchar(11) NOT NULL,
  `acadYearDesc` varchar(30) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`acadYearID`),
  UNIQUE KEY `acadYear` (`acadYearCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` varchar(50) NOT NULL,
  `process` varchar(255) NOT NULL,
  `record` text,
  `uname` varchar(180) NOT NULL,
  `created_at` date NOT NULL,
  `expires_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `address` (
  `addressID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `address1` varchar(80) NOT NULL,
  `address2` varchar(80) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(2) NOT NULL,
  `addressType` varchar(2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `addressStatus` varchar(2) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) NOT NULL,
  `ext1` varchar(5) NOT NULL,
  `ext2` varchar(5) NOT NULL,
  `phoneType1` varchar(3) NOT NULL,
  `phoneType2` varchar(3) NOT NULL,
  `email1` varchar(80) NOT NULL,
  `email2` varchar(80) NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`addressID`),
  KEY `personID` (`personID`),
  KEY `addedBy` (`addedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `attend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(11) NOT NULL,
  `cc` varchar(30) NOT NULL DEFAULT '',
  `schoolid` varchar(16) NOT NULL DEFAULT '',
  `adate` date DEFAULT NULL,
  `acode` varchar(15) DEFAULT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `building` (
  `buildingID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `buildingCode` varchar(11) NOT NULL,
  `buildingName` varchar(180) NOT NULL,
  PRIMARY KEY (`buildingID`),
  UNIQUE KEY `buildingCode` (`buildingCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ccd` (
  `ccdID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ccdCode` varchar(11) NOT NULL,
  `ccdName` varchar(80) NOT NULL,
  `addDate` date NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ccdID`),
  UNIQUE KEY `ccdKey` (`ccdCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cip` (
  `cipID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cipCode` varchar(11) NOT NULL,
  `cipName` varchar(80) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cipID`),
  UNIQUE KEY `cipKey` (`cipCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `class_year` (
  `yearID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `acadLevelCode` varchar(4) NOT NULL,
  `classYear` varchar(4) NOT NULL,
  `minCredits` double(4,1) NOT NULL DEFAULT '0.0',
  `maxCredits` double(4,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`yearID`),
  UNIQUE KEY `classYear` (`classYear`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) DEFAULT NULL,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(6) DEFAULT NULL,
  `un_member` varchar(12) DEFAULT NULL,
  `calling_code` varchar(8) DEFAULT NULL,
  `cctld` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `country` VALUES(1, 'AF', 'Afghanistan', 'Islamic Republic of Afghanistan', 'AFG', '004', 'yes', '93', '.af');

INSERT INTO `country` VALUES(2, 'AX', 'Aland Islands', '&Aring;land Islands', 'ALA', '248', 'no', '358', '.ax');

INSERT INTO `country` VALUES(3, 'AL', 'Albania', 'Republic of Albania', 'ALB', '008', 'yes', '355', '.al');

INSERT INTO `country` VALUES(4, 'DZ', 'Algeria', 'People''s Democratic Republic of Algeria', 'DZA', '012', 'yes', '213', '.dz');

INSERT INTO `country` VALUES(5, 'AS', 'American Samoa', 'American Samoa', 'ASM', '016', 'no', '1+684', '.as');

INSERT INTO `country` VALUES(6, 'AD', 'Andorra', 'Principality of Andorra', 'AND', '020', 'yes', '376', '.ad');

INSERT INTO `country` VALUES(7, 'AO', 'Angola', 'Republic of Angola', 'AGO', '024', 'yes', '244', '.ao');

INSERT INTO `country` VALUES(8, 'AI', 'Anguilla', 'Anguilla', 'AIA', '660', 'no', '1+264', '.ai');

INSERT INTO `country` VALUES(9, 'AQ', 'Antarctica', 'Antarctica', 'ATA', '010', 'no', '672', '.aq');

INSERT INTO `country` VALUES(10, 'AG', 'Antigua and Barbuda', 'Antigua and Barbuda', 'ATG', '028', 'yes', '1+268', '.ag');

INSERT INTO `country` VALUES(11, 'AR', 'Argentina', 'Argentine Republic', 'ARG', '032', 'yes', '54', '.ar');

INSERT INTO `country` VALUES(12, 'AM', 'Armenia', 'Republic of Armenia', 'ARM', '051', 'yes', '374', '.am');

INSERT INTO `country` VALUES(13, 'AW', 'Aruba', 'Aruba', 'ABW', '533', 'no', '297', '.aw');

INSERT INTO `country` VALUES(14, 'AU', 'Australia', 'Commonwealth of Australia', 'AUS', '036', 'yes', '61', '.au');

INSERT INTO `country` VALUES(15, 'AT', 'Austria', 'Republic of Austria', 'AUT', '040', 'yes', '43', '.at');

INSERT INTO `country` VALUES(16, 'AZ', 'Azerbaijan', 'Republic of Azerbaijan', 'AZE', '031', 'yes', '994', '.az');

INSERT INTO `country` VALUES(17, 'BS', 'Bahamas', 'Commonwealth of The Bahamas', 'BHS', '044', 'yes', '1+242', '.bs');

INSERT INTO `country` VALUES(18, 'BH', 'Bahrain', 'Kingdom of Bahrain', 'BHR', '048', 'yes', '973', '.bh');

INSERT INTO `country` VALUES(19, 'BD', 'Bangladesh', 'People''s Republic of Bangladesh', 'BGD', '050', 'yes', '880', '.bd');

INSERT INTO `country` VALUES(20, 'BB', 'Barbados', 'Barbados', 'BRB', '052', 'yes', '1+246', '.bb');

INSERT INTO `country` VALUES(21, 'BY', 'Belarus', 'Republic of Belarus', 'BLR', '112', 'yes', '375', '.by');

INSERT INTO `country` VALUES(22, 'BE', 'Belgium', 'Kingdom of Belgium', 'BEL', '056', 'yes', '32', '.be');

INSERT INTO `country` VALUES(23, 'BZ', 'Belize', 'Belize', 'BLZ', '084', 'yes', '501', '.bz');

INSERT INTO `country` VALUES(24, 'BJ', 'Benin', 'Republic of Benin', 'BEN', '204', 'yes', '229', '.bj');

INSERT INTO `country` VALUES(25, 'BM', 'Bermuda', 'Bermuda Islands', 'BMU', '060', 'no', '1+441', '.bm');

INSERT INTO `country` VALUES(26, 'BT', 'Bhutan', 'Kingdom of Bhutan', 'BTN', '064', 'yes', '975', '.bt');

INSERT INTO `country` VALUES(27, 'BO', 'Bolivia', 'Plurinational State of Bolivia', 'BOL', '068', 'yes', '591', '.bo');

INSERT INTO `country` VALUES(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', 'BES', '535', 'no', '599', '.bq');

INSERT INTO `country` VALUES(29, 'BA', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', 'BIH', '070', 'yes', '387', '.ba');

INSERT INTO `country` VALUES(30, 'BW', 'Botswana', 'Republic of Botswana', 'BWA', '072', 'yes', '267', '.bw');

INSERT INTO `country` VALUES(31, 'BV', 'Bouvet Island', 'Bouvet Island', 'BVT', '074', 'no', 'NONE', '.bv');

INSERT INTO `country` VALUES(32, 'BR', 'Brazil', 'Federative Republic of Brazil', 'BRA', '076', 'yes', '55', '.br');

INSERT INTO `country` VALUES(33, 'IO', 'British Indian Ocean Territory', 'British Indian Ocean Territory', 'IOT', '086', 'no', '246', '.io');

INSERT INTO `country` VALUES(34, 'BN', 'Brunei', 'Brunei Darussalam', 'BRN', '096', 'yes', '673', '.bn');

INSERT INTO `country` VALUES(35, 'BG', 'Bulgaria', 'Republic of Bulgaria', 'BGR', '100', 'yes', '359', '.bg');

INSERT INTO `country` VALUES(36, 'BF', 'Burkina Faso', 'Burkina Faso', 'BFA', '854', 'yes', '226', '.bf');

INSERT INTO `country` VALUES(37, 'BI', 'Burundi', 'Republic of Burundi', 'BDI', '108', 'yes', '257', '.bi');

INSERT INTO `country` VALUES(38, 'KH', 'Cambodia', 'Kingdom of Cambodia', 'KHM', '116', 'yes', '855', '.kh');

INSERT INTO `country` VALUES(39, 'CM', 'Cameroon', 'Republic of Cameroon', 'CMR', '120', 'yes', '237', '.cm');

INSERT INTO `country` VALUES(40, 'CA', 'Canada', 'Canada', 'CAN', '124', 'yes', '1', '.ca');

INSERT INTO `country` VALUES(41, 'CV', 'Cape Verde', 'Republic of Cape Verde', 'CPV', '132', 'yes', '238', '.cv');

INSERT INTO `country` VALUES(42, 'KY', 'Cayman Islands', 'The Cayman Islands', 'CYM', '136', 'no', '1+345', '.ky');

INSERT INTO `country` VALUES(43, 'CF', 'Central African Republic', 'Central African Republic', 'CAF', '140', 'yes', '236', '.cf');

INSERT INTO `country` VALUES(44, 'TD', 'Chad', 'Republic of Chad', 'TCD', '148', 'yes', '235', '.td');

INSERT INTO `country` VALUES(45, 'CL', 'Chile', 'Republic of Chile', 'CHL', '152', 'yes', '56', '.cl');

INSERT INTO `country` VALUES(46, 'CN', 'China', 'People''s Republic of China', 'CHN', '156', 'yes', '86', '.cn');

INSERT INTO `country` VALUES(47, 'CX', 'Christmas Island', 'Christmas Island', 'CXR', '162', 'no', '61', '.cx');

INSERT INTO `country` VALUES(48, 'CC', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', 'CCK', '166', 'no', '61', '.cc');

INSERT INTO `country` VALUES(49, 'CO', 'Colombia', 'Republic of Colombia', 'COL', '170', 'yes', '57', '.co');

INSERT INTO `country` VALUES(50, 'KM', 'Comoros', 'Union of the Comoros', 'COM', '174', 'yes', '269', '.km');

INSERT INTO `country` VALUES(51, 'CG', 'Congo', 'Republic of the Congo', 'COG', '178', 'yes', '242', '.cg');

INSERT INTO `country` VALUES(52, 'CK', 'Cook Islands', 'Cook Islands', 'COK', '184', 'some', '682', '.ck');

INSERT INTO `country` VALUES(53, 'CR', 'Costa Rica', 'Republic of Costa Rica', 'CRI', '188', 'yes', '506', '.cr');

INSERT INTO `country` VALUES(54, 'CI', 'Cote d''ivoire (Ivory Coast)', 'Republic of C&ocirc;te D''Ivoire (Ivory Coast)', 'CIV', '384', 'yes', '225', '.ci');

INSERT INTO `country` VALUES(55, 'HR', 'Croatia', 'Republic of Croatia', 'HRV', '191', 'yes', '385', '.hr');

INSERT INTO `country` VALUES(56, 'CU', 'Cuba', 'Republic of Cuba', 'CUB', '192', 'yes', '53', '.cu');

INSERT INTO `country` VALUES(57, 'CW', 'Curacao', 'Cura&ccedil;ao', 'CUW', '531', 'no', '599', '.cw');

INSERT INTO `country` VALUES(58, 'CY', 'Cyprus', 'Republic of Cyprus', 'CYP', '196', 'yes', '357', '.cy');

INSERT INTO `country` VALUES(59, 'CZ', 'Czech Republic', 'Czech Republic', 'CZE', '203', 'yes', '420', '.cz');

INSERT INTO `country` VALUES(60, 'CD', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', 'COD', '180', 'yes', '243', '.cd');

INSERT INTO `country` VALUES(61, 'DK', 'Denmark', 'Kingdom of Denmark', 'DNK', '208', 'yes', '45', '.dk');

INSERT INTO `country` VALUES(62, 'DJ', 'Djibouti', 'Republic of Djibouti', 'DJI', '262', 'yes', '253', '.dj');

INSERT INTO `country` VALUES(63, 'DM', 'Dominica', 'Commonwealth of Dominica', 'DMA', '212', 'yes', '1+767', '.dm');

INSERT INTO `country` VALUES(64, 'DO', 'Dominican Republic', 'Dominican Republic', 'DOM', '214', 'yes', '1+809, 8', '.do');

INSERT INTO `country` VALUES(65, 'EC', 'Ecuador', 'Republic of Ecuador', 'ECU', '218', 'yes', '593', '.ec');

INSERT INTO `country` VALUES(66, 'EG', 'Egypt', 'Arab Republic of Egypt', 'EGY', '818', 'yes', '20', '.eg');

INSERT INTO `country` VALUES(67, 'SV', 'El Salvador', 'Republic of El Salvador', 'SLV', '222', 'yes', '503', '.sv');

INSERT INTO `country` VALUES(68, 'GQ', 'Equatorial Guinea', 'Republic of Equatorial Guinea', 'GNQ', '226', 'yes', '240', '.gq');

INSERT INTO `country` VALUES(69, 'ER', 'Eritrea', 'State of Eritrea', 'ERI', '232', 'yes', '291', '.er');

INSERT INTO `country` VALUES(70, 'EE', 'Estonia', 'Republic of Estonia', 'EST', '233', 'yes', '372', '.ee');

INSERT INTO `country` VALUES(71, 'ET', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', 'ETH', '231', 'yes', '251', '.et');

INSERT INTO `country` VALUES(72, 'FK', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', 'FLK', '238', 'no', '500', '.fk');

INSERT INTO `country` VALUES(73, 'FO', 'Faroe Islands', 'The Faroe Islands', 'FRO', '234', 'no', '298', '.fo');

INSERT INTO `country` VALUES(74, 'FJ', 'Fiji', 'Republic of Fiji', 'FJI', '242', 'yes', '679', '.fj');

INSERT INTO `country` VALUES(75, 'FI', 'Finland', 'Republic of Finland', 'FIN', '246', 'yes', '358', '.fi');

INSERT INTO `country` VALUES(76, 'FR', 'France', 'French Republic', 'FRA', '250', 'yes', '33', '.fr');

INSERT INTO `country` VALUES(77, 'GF', 'French Guiana', 'French Guiana', 'GUF', '254', 'no', '594', '.gf');

INSERT INTO `country` VALUES(78, 'PF', 'French Polynesia', 'French Polynesia', 'PYF', '258', 'no', '689', '.pf');

INSERT INTO `country` VALUES(79, 'TF', 'French Southern Territories', 'French Southern Territories', 'ATF', '260', 'no', NULL, '.tf');

INSERT INTO `country` VALUES(80, 'GA', 'Gabon', 'Gabonese Republic', 'GAB', '266', 'yes', '241', '.ga');

INSERT INTO `country` VALUES(81, 'GM', 'Gambia', 'Republic of The Gambia', 'GMB', '270', 'yes', '220', '.gm');

INSERT INTO `country` VALUES(82, 'GE', 'Georgia', 'Georgia', 'GEO', '268', 'yes', '995', '.ge');

INSERT INTO `country` VALUES(83, 'DE', 'Germany', 'Federal Republic of Germany', 'DEU', '276', 'yes', '49', '.de');

INSERT INTO `country` VALUES(84, 'GH', 'Ghana', 'Republic of Ghana', 'GHA', '288', 'yes', '233', '.gh');

INSERT INTO `country` VALUES(85, 'GI', 'Gibraltar', 'Gibraltar', 'GIB', '292', 'no', '350', '.gi');

INSERT INTO `country` VALUES(86, 'GR', 'Greece', 'Hellenic Republic', 'GRC', '300', 'yes', '30', '.gr');

INSERT INTO `country` VALUES(87, 'GL', 'Greenland', 'Greenland', 'GRL', '304', 'no', '299', '.gl');

INSERT INTO `country` VALUES(88, 'GD', 'Grenada', 'Grenada', 'GRD', '308', 'yes', '1+473', '.gd');

INSERT INTO `country` VALUES(89, 'GP', 'Guadaloupe', 'Guadeloupe', 'GLP', '312', 'no', '590', '.gp');

INSERT INTO `country` VALUES(90, 'GU', 'Guam', 'Guam', 'GUM', '316', 'no', '1+671', '.gu');

INSERT INTO `country` VALUES(91, 'GT', 'Guatemala', 'Republic of Guatemala', 'GTM', '320', 'yes', '502', '.gt');

INSERT INTO `country` VALUES(92, 'GG', 'Guernsey', 'Guernsey', 'GGY', '831', 'no', '44', '.gg');

INSERT INTO `country` VALUES(93, 'GN', 'Guinea', 'Republic of Guinea', 'GIN', '324', 'yes', '224', '.gn');

INSERT INTO `country` VALUES(94, 'GW', 'Guinea-Bissau', 'Republic of Guinea-Bissau', 'GNB', '624', 'yes', '245', '.gw');

INSERT INTO `country` VALUES(95, 'GY', 'Guyana', 'Co-operative Republic of Guyana', 'GUY', '328', 'yes', '592', '.gy');

INSERT INTO `country` VALUES(96, 'HT', 'Haiti', 'Republic of Haiti', 'HTI', '332', 'yes', '509', '.ht');

INSERT INTO `country` VALUES(97, 'HM', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'HMD', '334', 'no', 'NONE', '.hm');

INSERT INTO `country` VALUES(98, 'HN', 'Honduras', 'Republic of Honduras', 'HND', '340', 'yes', '504', '.hn');

INSERT INTO `country` VALUES(99, 'HK', 'Hong Kong', 'Hong Kong', 'HKG', '344', 'no', '852', '.hk');

INSERT INTO `country` VALUES(100, 'HU', 'Hungary', 'Hungary', 'HUN', '348', 'yes', '36', '.hu');

INSERT INTO `country` VALUES(101, 'IS', 'Iceland', 'Republic of Iceland', 'ISL', '352', 'yes', '354', '.is');

INSERT INTO `country` VALUES(102, 'IN', 'India', 'Republic of India', 'IND', '356', 'yes', '91', '.in');

INSERT INTO `country` VALUES(103, 'ID', 'Indonesia', 'Republic of Indonesia', 'IDN', '360', 'yes', '62', '.id');

INSERT INTO `country` VALUES(104, 'IR', 'Iran', 'Islamic Republic of Iran', 'IRN', '364', 'yes', '98', '.ir');

INSERT INTO `country` VALUES(105, 'IQ', 'Iraq', 'Republic of Iraq', 'IRQ', '368', 'yes', '964', '.iq');

INSERT INTO `country` VALUES(106, 'IE', 'Ireland', 'Ireland', 'IRL', '372', 'yes', '353', '.ie');

INSERT INTO `country` VALUES(107, 'IM', 'Isle of Man', 'Isle of Man', 'IMN', '833', 'no', '44', '.im');

INSERT INTO `country` VALUES(108, 'IL', 'Israel', 'State of Israel', 'ISR', '376', 'yes', '972', '.il');

INSERT INTO `country` VALUES(109, 'IT', 'Italy', 'Italian Republic', 'ITA', '380', 'yes', '39', '.jm');

INSERT INTO `country` VALUES(110, 'JM', 'Jamaica', 'Jamaica', 'JAM', '388', 'yes', '1+876', '.jm');

INSERT INTO `country` VALUES(111, 'JP', 'Japan', 'Japan', 'JPN', '392', 'yes', '81', '.jp');

INSERT INTO `country` VALUES(112, 'JE', 'Jersey', 'The Bailiwick of Jersey', 'JEY', '832', 'no', '44', '.je');

INSERT INTO `country` VALUES(113, 'JO', 'Jordan', 'Hashemite Kingdom of Jordan', 'JOR', '400', 'yes', '962', '.jo');

INSERT INTO `country` VALUES(114, 'KZ', 'Kazakhstan', 'Republic of Kazakhstan', 'KAZ', '398', 'yes', '7', '.kz');

INSERT INTO `country` VALUES(115, 'KE', 'Kenya', 'Republic of Kenya', 'KEN', '404', 'yes', '254', '.ke');

INSERT INTO `country` VALUES(116, 'KI', 'Kiribati', 'Republic of Kiribati', 'KIR', '296', 'yes', '686', '.ki');

INSERT INTO `country` VALUES(117, 'XK', 'Kosovo', 'Republic of Kosovo', '---', '---', 'some', '381', '');

INSERT INTO `country` VALUES(118, 'KW', 'Kuwait', 'State of Kuwait', 'KWT', '414', 'yes', '965', '.kw');

INSERT INTO `country` VALUES(119, 'KG', 'Kyrgyzstan', 'Kyrgyz Republic', 'KGZ', '417', 'yes', '996', '.kg');

INSERT INTO `country` VALUES(120, 'LA', 'Laos', 'Lao People''s Democratic Republic', 'LAO', '418', 'yes', '856', '.la');

INSERT INTO `country` VALUES(121, 'LV', 'Latvia', 'Republic of Latvia', 'LVA', '428', 'yes', '371', '.lv');

INSERT INTO `country` VALUES(122, 'LB', 'Lebanon', 'Republic of Lebanon', 'LBN', '422', 'yes', '961', '.lb');

INSERT INTO `country` VALUES(123, 'LS', 'Lesotho', 'Kingdom of Lesotho', 'LSO', '426', 'yes', '266', '.ls');

INSERT INTO `country` VALUES(124, 'LR', 'Liberia', 'Republic of Liberia', 'LBR', '430', 'yes', '231', '.lr');

INSERT INTO `country` VALUES(125, 'LY', 'Libya', 'Libya', 'LBY', '434', 'yes', '218', '.ly');

INSERT INTO `country` VALUES(126, 'LI', 'Liechtenstein', 'Principality of Liechtenstein', 'LIE', '438', 'yes', '423', '.li');

INSERT INTO `country` VALUES(127, 'LT', 'Lithuania', 'Republic of Lithuania', 'LTU', '440', 'yes', '370', '.lt');

INSERT INTO `country` VALUES(128, 'LU', 'Luxembourg', 'Grand Duchy of Luxembourg', 'LUX', '442', 'yes', '352', '.lu');

INSERT INTO `country` VALUES(129, 'MO', 'Macao', 'The Macao Special Administrative Region', 'MAC', '446', 'no', '853', '.mo');

INSERT INTO `country` VALUES(130, 'MK', 'Macedonia', 'The Former Yugoslav Republic of Macedonia', 'MKD', '807', 'yes', '389', '.mk');

INSERT INTO `country` VALUES(131, 'MG', 'Madagascar', 'Republic of Madagascar', 'MDG', '450', 'yes', '261', '.mg');

INSERT INTO `country` VALUES(132, 'MW', 'Malawi', 'Republic of Malawi', 'MWI', '454', 'yes', '265', '.mw');

INSERT INTO `country` VALUES(133, 'MY', 'Malaysia', 'Malaysia', 'MYS', '458', 'yes', '60', '.my');

INSERT INTO `country` VALUES(134, 'MV', 'Maldives', 'Republic of Maldives', 'MDV', '462', 'yes', '960', '.mv');

INSERT INTO `country` VALUES(135, 'ML', 'Mali', 'Republic of Mali', 'MLI', '466', 'yes', '223', '.ml');

INSERT INTO `country` VALUES(136, 'MT', 'Malta', 'Republic of Malta', 'MLT', '470', 'yes', '356', '.mt');

INSERT INTO `country` VALUES(137, 'MH', 'Marshall Islands', 'Republic of the Marshall Islands', 'MHL', '584', 'yes', '692', '.mh');

INSERT INTO `country` VALUES(138, 'MQ', 'Martinique', 'Martinique', 'MTQ', '474', 'no', '596', '.mq');

INSERT INTO `country` VALUES(139, 'MR', 'Mauritania', 'Islamic Republic of Mauritania', 'MRT', '478', 'yes', '222', '.mr');

INSERT INTO `country` VALUES(140, 'MU', 'Mauritius', 'Republic of Mauritius', 'MUS', '480', 'yes', '230', '.mu');

INSERT INTO `country` VALUES(141, 'YT', 'Mayotte', 'Mayotte', 'MYT', '175', 'no', '262', '.yt');

INSERT INTO `country` VALUES(142, 'MX', 'Mexico', 'United Mexican States', 'MEX', '484', 'yes', '52', '.mx');

INSERT INTO `country` VALUES(143, 'FM', 'Micronesia', 'Federated States of Micronesia', 'FSM', '583', 'yes', '691', '.fm');

INSERT INTO `country` VALUES(144, 'MD', 'Moldava', 'Republic of Moldova', 'MDA', '498', 'yes', '373', '.md');

INSERT INTO `country` VALUES(145, 'MC', 'Monaco', 'Principality of Monaco', 'MCO', '492', 'yes', '377', '.mc');

INSERT INTO `country` VALUES(146, 'MN', 'Mongolia', 'Mongolia', 'MNG', '496', 'yes', '976', '.mn');

INSERT INTO `country` VALUES(147, 'ME', 'Montenegro', 'Montenegro', 'MNE', '499', 'yes', '382', '.me');

INSERT INTO `country` VALUES(148, 'MS', 'Montserrat', 'Montserrat', 'MSR', '500', 'no', '1+664', '.ms');

INSERT INTO `country` VALUES(149, 'MA', 'Morocco', 'Kingdom of Morocco', 'MAR', '504', 'yes', '212', '.ma');

INSERT INTO `country` VALUES(150, 'MZ', 'Mozambique', 'Republic of Mozambique', 'MOZ', '508', 'yes', '258', '.mz');

INSERT INTO `country` VALUES(151, 'MM', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', 'MMR', '104', 'yes', '95', '.mm');

INSERT INTO `country` VALUES(152, 'NA', 'Namibia', 'Republic of Namibia', 'NAM', '516', 'yes', '264', '.na');

INSERT INTO `country` VALUES(153, 'NR', 'Nauru', 'Republic of Nauru', 'NRU', '520', 'yes', '674', '.nr');

INSERT INTO `country` VALUES(154, 'NP', 'Nepal', 'Federal Democratic Republic of Nepal', 'NPL', '524', 'yes', '977', '.np');

INSERT INTO `country` VALUES(155, 'NL', 'Netherlands', 'Kingdom of the Netherlands', 'NLD', '528', 'yes', '31', '.nl');

INSERT INTO `country` VALUES(156, 'NC', 'New Caledonia', 'New Caledonia', 'NCL', '540', 'no', '687', '.nc');

INSERT INTO `country` VALUES(157, 'NZ', 'New Zealand', 'New Zealand', 'NZL', '554', 'yes', '64', '.nz');

INSERT INTO `country` VALUES(158, 'NI', 'Nicaragua', 'Republic of Nicaragua', 'NIC', '558', 'yes', '505', '.ni');

INSERT INTO `country` VALUES(159, 'NE', 'Niger', 'Republic of Niger', 'NER', '562', 'yes', '227', '.ne');

INSERT INTO `country` VALUES(160, 'NG', 'Nigeria', 'Federal Republic of Nigeria', 'NGA', '566', 'yes', '234', '.ng');

INSERT INTO `country` VALUES(161, 'NU', 'Niue', 'Niue', 'NIU', '570', 'some', '683', '.nu');

INSERT INTO `country` VALUES(162, 'NF', 'Norfolk Island', 'Norfolk Island', 'NFK', '574', 'no', '672', '.nf');

INSERT INTO `country` VALUES(163, 'KP', 'North Korea', 'Democratic People''s Republic of Korea', 'PRK', '408', 'yes', '850', '.kp');

INSERT INTO `country` VALUES(164, 'MP', 'Northern Mariana Islands', 'Northern Mariana Islands', 'MNP', '580', 'no', '1+670', '.mp');

INSERT INTO `country` VALUES(165, 'NO', 'Norway', 'Kingdom of Norway', 'NOR', '578', 'yes', '47', '.no');

INSERT INTO `country` VALUES(166, 'OM', 'Oman', 'Sultanate of Oman', 'OMN', '512', 'yes', '968', '.om');

INSERT INTO `country` VALUES(167, 'PK', 'Pakistan', 'Islamic Republic of Pakistan', 'PAK', '586', 'yes', '92', '.pk');

INSERT INTO `country` VALUES(168, 'PW', 'Palau', 'Republic of Palau', 'PLW', '585', 'yes', '680', '.pw');

INSERT INTO `country` VALUES(169, 'PS', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', 'PSE', '275', 'some', '970', '.ps');

INSERT INTO `country` VALUES(170, 'PA', 'Panama', 'Republic of Panama', 'PAN', '591', 'yes', '507', '.pa');

INSERT INTO `country` VALUES(171, 'PG', 'Papua New Guinea', 'Independent State of Papua New Guinea', 'PNG', '598', 'yes', '675', '.pg');

INSERT INTO `country` VALUES(172, 'PY', 'Paraguay', 'Republic of Paraguay', 'PRY', '600', 'yes', '595', '.py');

INSERT INTO `country` VALUES(173, 'PE', 'Peru', 'Republic of Peru', 'PER', '604', 'yes', '51', '.pe');

INSERT INTO `country` VALUES(174, 'PH', 'Phillipines', 'Republic of the Philippines', 'PHL', '608', 'yes', '63', '.ph');

INSERT INTO `country` VALUES(175, 'PN', 'Pitcairn', 'Pitcairn', 'PCN', '612', 'no', 'NONE', '.pn');

INSERT INTO `country` VALUES(176, 'PL', 'Poland', 'Republic of Poland', 'POL', '616', 'yes', '48', '.pl');

INSERT INTO `country` VALUES(177, 'PT', 'Portugal', 'Portuguese Republic', 'PRT', '620', 'yes', '351', '.pt');

INSERT INTO `country` VALUES(178, 'PR', 'Puerto Rico', 'Commonwealth of Puerto Rico', 'PRI', '630', 'no', '1+939', '.pr');

INSERT INTO `country` VALUES(179, 'QA', 'Qatar', 'State of Qatar', 'QAT', '634', 'yes', '974', '.qa');

INSERT INTO `country` VALUES(180, 'RE', 'Reunion', 'R&eacute;union', 'REU', '638', 'no', '262', '.re');

INSERT INTO `country` VALUES(181, 'RO', 'Romania', 'Romania', 'ROU', '642', 'yes', '40', '.ro');

INSERT INTO `country` VALUES(182, 'RU', 'Russia', 'Russian Federation', 'RUS', '643', 'yes', '7', '.ru');

INSERT INTO `country` VALUES(183, 'RW', 'Rwanda', 'Republic of Rwanda', 'RWA', '646', 'yes', '250', '.rw');

INSERT INTO `country` VALUES(184, 'BL', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', 'BLM', '652', 'no', '590', '.bl');

INSERT INTO `country` VALUES(185, 'SH', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', 'SHN', '654', 'no', '290', '.sh');

INSERT INTO `country` VALUES(186, 'KN', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', 'KNA', '659', 'yes', '1+869', '.kn');

INSERT INTO `country` VALUES(187, 'LC', 'Saint Lucia', 'Saint Lucia', 'LCA', '662', 'yes', '1+758', '.lc');

INSERT INTO `country` VALUES(188, 'MF', 'Saint Martin', 'Saint Martin', 'MAF', '663', 'no', '590', '.mf');

INSERT INTO `country` VALUES(189, 'PM', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', 'SPM', '666', 'no', '508', '.pm');

INSERT INTO `country` VALUES(190, 'VC', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', 'VCT', '670', 'yes', '1+784', '.vc');

INSERT INTO `country` VALUES(191, 'WS', 'Samoa', 'Independent State of Samoa', 'WSM', '882', 'yes', '685', '.ws');

INSERT INTO `country` VALUES(192, 'SM', 'San Marino', 'Republic of San Marino', 'SMR', '674', 'yes', '378', '.sm');

INSERT INTO `country` VALUES(193, 'ST', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'STP', '678', 'yes', '239', '.st');

INSERT INTO `country` VALUES(194, 'SA', 'Saudi Arabia', 'Kingdom of Saudi Arabia', 'SAU', '682', 'yes', '966', '.sa');

INSERT INTO `country` VALUES(195, 'SN', 'Senegal', 'Republic of Senegal', 'SEN', '686', 'yes', '221', '.sn');

INSERT INTO `country` VALUES(196, 'RS', 'Serbia', 'Republic of Serbia', 'SRB', '688', 'yes', '381', '.rs');

INSERT INTO `country` VALUES(197, 'SC', 'Seychelles', 'Republic of Seychelles', 'SYC', '690', 'yes', '248', '.sc');

INSERT INTO `country` VALUES(198, 'SL', 'Sierra Leone', 'Republic of Sierra Leone', 'SLE', '694', 'yes', '232', '.sl');

INSERT INTO `country` VALUES(199, 'SG', 'Singapore', 'Republic of Singapore', 'SGP', '702', 'yes', '65', '.sg');

INSERT INTO `country` VALUES(200, 'SX', 'Sint Maarten', 'Sint Maarten', 'SXM', '534', 'no', '1+721', '.sx');

INSERT INTO `country` VALUES(201, 'SK', 'Slovakia', 'Slovak Republic', 'SVK', '703', 'yes', '421', '.sk');

INSERT INTO `country` VALUES(202, 'SI', 'Slovenia', 'Republic of Slovenia', 'SVN', '705', 'yes', '386', '.si');

INSERT INTO `country` VALUES(203, 'SB', 'Solomon Islands', 'Solomon Islands', 'SLB', '090', 'yes', '677', '.sb');

INSERT INTO `country` VALUES(204, 'SO', 'Somalia', 'Somali Republic', 'SOM', '706', 'yes', '252', '.so');

INSERT INTO `country` VALUES(205, 'ZA', 'South Africa', 'Republic of South Africa', 'ZAF', '710', 'yes', '27', '.za');

INSERT INTO `country` VALUES(206, 'GS', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', 'SGS', '239', 'no', '500', '.gs');

INSERT INTO `country` VALUES(207, 'KR', 'South Korea', 'Republic of Korea', 'KOR', '410', 'yes', '82', '.kr');

INSERT INTO `country` VALUES(208, 'SS', 'South Sudan', 'Republic of South Sudan', 'SSD', '728', 'yes', '211', '.ss');

INSERT INTO `country` VALUES(209, 'ES', 'Spain', 'Kingdom of Spain', 'ESP', '724', 'yes', '34', '.es');

INSERT INTO `country` VALUES(210, 'LK', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', 'LKA', '144', 'yes', '94', '.lk');

INSERT INTO `country` VALUES(211, 'SD', 'Sudan', 'Republic of the Sudan', 'SDN', '729', 'yes', '249', '.sd');

INSERT INTO `country` VALUES(212, 'SR', 'Suriname', 'Republic of Suriname', 'SUR', '740', 'yes', '597', '.sr');

INSERT INTO `country` VALUES(213, 'SJ', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', 'SJM', '744', 'no', '47', '.sj');

INSERT INTO `country` VALUES(214, 'SZ', 'Swaziland', 'Kingdom of Swaziland', 'SWZ', '748', 'yes', '268', '.sz');

INSERT INTO `country` VALUES(215, 'SE', 'Sweden', 'Kingdom of Sweden', 'SWE', '752', 'yes', '46', '.se');

INSERT INTO `country` VALUES(216, 'CH', 'Switzerland', 'Swiss Confederation', 'CHE', '756', 'yes', '41', '.ch');

INSERT INTO `country` VALUES(217, 'SY', 'Syria', 'Syrian Arab Republic', 'SYR', '760', 'yes', '963', '.sy');

INSERT INTO `country` VALUES(218, 'TW', 'Taiwan', 'Republic of China (Taiwan)', 'TWN', '158', 'former', '886', '.tw');

INSERT INTO `country` VALUES(219, 'TJ', 'Tajikistan', 'Republic of Tajikistan', 'TJK', '762', 'yes', '992', '.tj');

INSERT INTO `country` VALUES(220, 'TZ', 'Tanzania', 'United Republic of Tanzania', 'TZA', '834', 'yes', '255', '.tz');

INSERT INTO `country` VALUES(221, 'TH', 'Thailand', 'Kingdom of Thailand', 'THA', '764', 'yes', '66', '.th');

INSERT INTO `country` VALUES(222, 'TL', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', 'TLS', '626', 'yes', '670', '.tl');

INSERT INTO `country` VALUES(223, 'TG', 'Togo', 'Togolese Republic', 'TGO', '768', 'yes', '228', '.tg');

INSERT INTO `country` VALUES(224, 'TK', 'Tokelau', 'Tokelau', 'TKL', '772', 'no', '690', '.tk');

INSERT INTO `country` VALUES(225, 'TO', 'Tonga', 'Kingdom of Tonga', 'TON', '776', 'yes', '676', '.to');

INSERT INTO `country` VALUES(226, 'TT', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', 'TTO', '780', 'yes', '1+868', '.tt');

INSERT INTO `country` VALUES(227, 'TN', 'Tunisia', 'Republic of Tunisia', 'TUN', '788', 'yes', '216', '.tn');

INSERT INTO `country` VALUES(228, 'TR', 'Turkey', 'Republic of Turkey', 'TUR', '792', 'yes', '90', '.tr');

INSERT INTO `country` VALUES(229, 'TM', 'Turkmenistan', 'Turkmenistan', 'TKM', '795', 'yes', '993', '.tm');

INSERT INTO `country` VALUES(230, 'TC', 'Turks and Caicos Islands', 'Turks and Caicos Islands', 'TCA', '796', 'no', '1+649', '.tc');

INSERT INTO `country` VALUES(231, 'TV', 'Tuvalu', 'Tuvalu', 'TUV', '798', 'yes', '688', '.tv');

INSERT INTO `country` VALUES(232, 'UG', 'Uganda', 'Republic of Uganda', 'UGA', '800', 'yes', '256', '.ug');

INSERT INTO `country` VALUES(233, 'UA', 'Ukraine', 'Ukraine', 'UKR', '804', 'yes', '380', '.ua');

INSERT INTO `country` VALUES(234, 'AE', 'United Arab Emirates', 'United Arab Emirates', 'ARE', '784', 'yes', '971', '.ae');

INSERT INTO `country` VALUES(235, 'GB', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', 'GBR', '826', 'yes', '44', '.uk');

INSERT INTO `country` VALUES(236, 'US', 'United States', 'United States of America', 'USA', '840', 'yes', '1', '.us');

INSERT INTO `country` VALUES(237, 'UM', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'UMI', '581', 'no', 'NONE', 'NONE');

INSERT INTO `country` VALUES(238, 'UY', 'Uruguay', 'Eastern Republic of Uruguay', 'URY', '858', 'yes', '598', '.uy');

INSERT INTO `country` VALUES(239, 'UZ', 'Uzbekistan', 'Republic of Uzbekistan', 'UZB', '860', 'yes', '998', '.uz');

INSERT INTO `country` VALUES(240, 'VU', 'Vanuatu', 'Republic of Vanuatu', 'VUT', '548', 'yes', '678', '.vu');

INSERT INTO `country` VALUES(241, 'VA', 'Vatican City', 'State of the Vatican City', 'VAT', '336', 'no', '39', '.va');

INSERT INTO `country` VALUES(242, 'VE', 'Venezuela', 'Bolivarian Republic of Venezuela', 'VEN', '862', 'yes', '58', '.ve');

INSERT INTO `country` VALUES(243, 'VN', 'Vietnam', 'Socialist Republic of Vietnam', 'VNM', '704', 'yes', '84', '.vn');

INSERT INTO `country` VALUES(244, 'VG', 'Virgin Islands, British', 'British Virgin Islands', 'VGB', '092', 'no', '1+284', '.vg');

INSERT INTO `country` VALUES(245, 'VI', 'Virgin Islands, US', 'Virgin Islands of the United States', 'VIR', '850', 'no', '1+340', '.vi');

INSERT INTO `country` VALUES(246, 'WF', 'Wallis and Futuna', 'Wallis and Futuna', 'WLF', '876', 'no', '681', '.wf');

INSERT INTO `country` VALUES(247, 'EH', 'Western Sahara', 'Western Sahara', 'ESH', '732', 'no', '212', '.eh');

INSERT INTO `country` VALUES(248, 'YE', 'Yemen', 'Republic of Yemen', 'YEM', '887', 'yes', '967', '.ye');

INSERT INTO `country` VALUES(249, 'ZM', 'Zambia', 'Republic of Zambia', 'ZMB', '894', 'yes', '260', '.zm');

INSERT INTO `country` VALUES(250, 'ZW', 'Zimbabwe', 'Republic of Zimbabwe', 'ZWE', '716', 'yes', '263', '.zw');

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `courseNumber` int(6) NOT NULL,
  `courseCode` varchar(12) NOT NULL,
  `subjectID` int(11) unsigned zerofill NOT NULL,
  `deptID` int(11) unsigned zerofill NOT NULL,
  `courseDesc` text NOT NULL,
  `minCredit` double(4,1) NOT NULL DEFAULT '0.0',
  `maxCredit` double(4,1) NOT NULL DEFAULT '0.0',
  `increCredit` double(4,1) NOT NULL DEFAULT '0.0',
  `courseLevelCode` varchar(5) NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `courseShortTitle` varchar(60) NOT NULL,
  `courseLongTitle` varchar(255) NOT NULL,
  `preReq` text NOT NULL,
  `allowAudit` enum('1','0') NOT NULL DEFAULT '0',
  `allowWaitlist` enum('1','0') NOT NULL DEFAULT '0',
  `minEnroll` int(3) NOT NULL,
  `seatCap` int(3) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `currStatus` varchar(1) NOT NULL,
  `statusDate` date NOT NULL DEFAULT '0000-00-00',
  `approvedDate` date NOT NULL DEFAULT '0000-00-00',
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`courseID`),
  KEY `course_code` (`courseCode`),
  KEY `course_level_code` (`courseLevelCode`),
  KEY `acad_level_code` (`acadLevelCode`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `course_sec` (
  `courseSecID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `sectionNumber` varchar(5) NOT NULL,
  `courseSecCode` varchar(50) NOT NULL,
  `buildingID` int(11) unsigned zerofill NOT NULL,
  `roomID` int(11) unsigned zerofill NOT NULL,
  `locationID` int(11) unsigned zerofill NOT NULL,
  `courseLevelCode` varchar(5) NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `deptID` int(11) unsigned zerofill NOT NULL,
  `facID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `courseID` int(8) unsigned zerofill NOT NULL,
  `preReqs` text NOT NULL,
  `secShortTitle` varchar(180) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `dotw` varchar(7) NOT NULL,
  `minCredit` double(4,1) NOT NULL DEFAULT '0.0',
  `maxCredit` double(4,1) NOT NULL DEFAULT '0.0',
  `increCredit` double(4,1) NOT NULL DEFAULT '0.0',
  `ceu` double(4,1) NOT NULL DEFAULT '0.0',
  `instructorMethod` varchar(180) NOT NULL,
  `instructorLoad` double(4,1) NOT NULL DEFAULT '0.0',
  `contactHours` double(4,1) NOT NULL DEFAULT '0.0',
  `stuReg` enum('1','0') NOT NULL DEFAULT '1',
  `secType` enum('ONL','HB','ONC') NOT NULL DEFAULT 'ONC',
  `currStatus` varchar(1) NOT NULL,
  `statusDate` date NOT NULL,
  `approvedDate` date NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`courseSecID`),
  UNIQUE KEY `courseSection` (`courseSecCode`,`termID`),
  KEY `course_sec_code` (`courseSecCode`),
  KEY `current_status` (`currStatus`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `credit_load` (
  `credLoadID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `credLoadCode` varchar(6) NOT NULL,
  `credLoadName` varchar(80) NOT NULL,
  `credLoadCreds` double(4,1) NOT NULL DEFAULT '0.0',
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`credLoadID`),
  UNIQUE KEY `credLoadKey` (`credLoadCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cronjob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scriptpath` varchar(255) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `time_interval` int(11) DEFAULT NULL,
  `fire_time` int(11) NOT NULL DEFAULT '0',
  `time_last_fired` int(11) DEFAULT NULL,
  `run_only_once` tinyint(1) NOT NULL DEFAULT '0',
  `currently_running` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fire_time` (`fire_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cronlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` int(11) DEFAULT NULL,
  `script` varchar(128) DEFAULT NULL,
  `output` text,
  `execution_time` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `degree` (
  `degreeID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `degreeCode` varchar(11) NOT NULL,
  `degreeName` varchar(180) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`degreeID`),
  UNIQUE KEY `degreeKey` (`degreeCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `department` (
  `deptID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `deptTypeCode` varchar(6) NOT NULL,
  `deptCode` varchar(11) NOT NULL,
  `deptName` varchar(180) NOT NULL,
  `deptDesc` varchar(255) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`deptID`),
  UNIQUE KEY `deptCode` (`deptCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `discipline` (
  `disciplineID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `discCode` varchar(11) NOT NULL,
  `discName` varchar(180) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`disciplineID`),
  UNIQUE KEY `discCode` (`discCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `email_template` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `email_key` varchar(60) NOT NULL,
  `email_name` varchar(80) NOT NULL,
  `email_value` longtext NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `email_key` (`email_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `error` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `type` int(4) NOT NULL,
  `time` int(10) NOT NULL,
  `string` varchar(512) NOT NULL,
  `file` varchar(255) NOT NULL,
  `line` int(6) NOT NULL,
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `et_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(60) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `facID` int(8) unsigned zerofill NOT NULL,
  `buildingID` int(11) unsigned zerofill NOT NULL,
  `officeID` int(11) unsigned zerofill NOT NULL,
  `office_phone` varchar(15) NOT NULL,
  `deptID` int(11) unsigned zerofill NOT NULL,
  `addDate` date NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facID` (`facID`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `graduate` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `gradID` int(8) unsigned zerofill NOT NULL,
  `schoolID` int(11) unsigned zerofill NOT NULL,
  `progID` int(11) unsigned zerofill NOT NULL,
  `catYearID` int(11) unsigned zerofill NOT NULL,
  `gradDate` date NOT NULL,
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gradID` (`gradID`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `institution` (
  `institutionID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ficeCode` int(6) NOT NULL,
  `instName` varchar(180) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  PRIMARY KEY (`institutionID`),
  UNIQUE KEY `ficeCode` (`ficeCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `location` (
  `locationID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `locationCode` varchar(6) NOT NULL,
  `locationName` varchar(80) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`locationID`),
  UNIQUE KEY `locationKey` (`locationCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `major` (
  `majorID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `majorCode` varchar(11) NOT NULL,
  `majorName` varchar(180) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`majorID`),
  UNIQUE KEY `majKey` (`majorCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `minor` (
  `minorID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `minorCode` varchar(11) NOT NULL,
  `minorName` varchar(180) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`minorID`),
  UNIQUE KEY `minKey` (`minorCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `nslc_hold_file` (
  `nslcHoldFileID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `lname` varchar(150) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `address1` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `zip` varchar(150) NOT NULL,
  `country` varchar(150) NOT NULL,
  `ssn` int(20) NOT NULL,
  PRIMARY KEY (`nslcHoldFileID`),
  UNIQUE KEY `userID` (`stuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `nslc_setup` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `branch` varchar(2) NOT NULL,
  `termCode` varchar(8) NOT NULL,
  `termStartDate` date NOT NULL,
  `termEndDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `nslc_setup` VALUES(00000000001, '00', '13/FA', '2013-09-01', '2013-12-18');

CREATE TABLE IF NOT EXISTS `parent` (
  `parentID` int(8) unsigned zerofill NOT NULL,
  `parentKey` varchar(255) NOT NULL,
  `addDate` datetime NOT NULL,
  `addedBy` int(8) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `parent_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_key` varchar(60) NOT NULL DEFAULT '',
  `student_id` varchar(11) NOT NULL,
  `student_school` varchar(16) NOT NULL DEFAULT '',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `permission` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `permKey` varchar(30) NOT NULL,
  `permName` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `permKey` (`permKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `permission` VALUES(00000000000000000017, 'edit_settings', 'Edit Settings');

INSERT INTO `permission` VALUES(00000000000000000018, 'access_audit_trail_screen', 'Audit Trail Logs');

INSERT INTO `permission` VALUES(00000000000000000019, 'access_sql_interface_screen', 'SQL Interface Screen');

INSERT INTO `permission` VALUES(00000000000000000036, 'access_course_screen', 'Course Screen');

INSERT INTO `permission` VALUES(00000000000000000040, 'access_faculty_screen', 'Faculty Screen');

INSERT INTO `permission` VALUES(00000000000000000044, 'access_parent_screen', 'Parent Screen');

INSERT INTO `permission` VALUES(00000000000000000048, 'access_student_screen', 'Student Screen');

INSERT INTO `permission` VALUES(00000000000000000052, 'access_plugin_screen', 'Plugin Screen');

INSERT INTO `permission` VALUES(00000000000000000057, 'access_role_screen', 'Role Screen');

INSERT INTO `permission` VALUES(00000000000000000061, 'access_permission_screen', 'Permission Screen');

INSERT INTO `permission` VALUES(00000000000000000065, 'access_user_role_screen', 'User Role Screen');

INSERT INTO `permission` VALUES(00000000000000000069, 'access_user_permission_screen', 'User Permission Screen');

INSERT INTO `permission` VALUES(00000000000000000073, 'access_email_template_screen', 'Email Template Screen');

INSERT INTO `permission` VALUES(00000000000000000074, 'access_course_sec_screen', 'Course Section Screen');

INSERT INTO `permission` VALUES(00000000000000000075, 'add_course_sec', 'Add Course Section');

INSERT INTO `permission` VALUES(00000000000000000078, 'course_sec_inquiry_only', 'Course Section Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000079, 'course_inquiry_only', 'Course Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000080, 'access_person_screen', 'Person Screen');

INSERT INTO `permission` VALUES(00000000000000000081, 'add_person', 'Add Person');

INSERT INTO `permission` VALUES(00000000000000000085, 'access_acad_prog_screen', 'Academic Program Screen');

INSERT INTO `permission` VALUES(00000000000000000086, 'add_acad_prog', 'Add Academic Program');

INSERT INTO `permission` VALUES(00000000000000000089, 'acad_prog_inquiry_only', 'Academic Program Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000090, 'access_nslc', 'NSLC');

INSERT INTO `permission` VALUES(00000000000000000091, 'access_error_log_screen', 'Error Log Screen');

INSERT INTO `permission` VALUES(00000000000000000092, 'access_student_portal', 'Student Portal');

INSERT INTO `permission` VALUES(00000000000000000093, 'access_cronjob_screen', 'Cronjob Screen');

INSERT INTO `permission` VALUES(00000000000000000097, 'access_report_screen', 'Report Screen');

INSERT INTO `permission` VALUES(00000000000000000098, 'add_address', 'Add Address');

INSERT INTO `permission` VALUES(00000000000000000100, 'address_inquiry_only', 'Address Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000101, 'general_inquiry_only', 'General Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000102, 'faculty_inquiry_only', 'Faculty Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000103, 'parent_inquiry_only', 'Parent Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000104, 'student_inquiry_only', 'Student Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000106, 'access_plugin_admin_page', 'Plugin Admin Page');

INSERT INTO `permission` VALUES(00000000000000000108, 'access_save_query_screens', 'Save Query Screens');

INSERT INTO `permission` VALUES(00000000000000000109, 'access_forms', 'Forms');

INSERT INTO `permission` VALUES(00000000000000000110, 'create_stu_record', 'Create Student Record');

INSERT INTO `permission` VALUES(00000000000000000111, 'create_fac_record', 'Create Faculty Record');

INSERT INTO `permission` VALUES(00000000000000000112, 'create_par_record', 'Create Parent Record');

INSERT INTO `permission` VALUES(00000000000000000113, 'reset_person_password', 'Reset Person Password');

INSERT INTO `permission` VALUES(00000000000000000114, 'register_students', 'Register Students');

INSERT INTO `permission` VALUES(00000000000000000167, 'access_ftp', 'FTP');

INSERT INTO `permission` VALUES(00000000000000000168, 'access_stu_roster_screen', 'Access Student Roster Screen');

INSERT INTO `permission` VALUES(00000000000000000169, 'access_grading_screen', 'Grading Screen');

INSERT INTO `permission` VALUES(00000000000000000170, 'access_bill_tbl_screen', 'Billing Table Screen');

INSERT INTO `permission` VALUES(00000000000000000171, 'add_crse_sec_bill', 'Add Course Sec Billing');

INSERT INTO `permission` VALUES(00000000000000000176, 'access_parent_portal', 'Parent Portal');

INSERT INTO `permission` VALUES(00000000000000000177, 'import_data', 'Import Data');

INSERT INTO `permission` VALUES(00000000000000000178, 'add_course', 'Add Course');

INSERT INTO `permission` VALUES(00000000000000000179, 'person_inquiry_only', 'Person Inquiry Only');

INSERT INTO `permission` VALUES(00000000000000000180, 'room_request', 'Room Request');

INSERT INTO `permission` VALUES(00000000000000000181, 'delete_course', 'Delete Course');

INSERT INTO `permission` VALUES(00000000000000000182, 'delete_course_sec', 'Delete Course Section');

INSERT INTO `permission` VALUES(00000000000000000183, 'delete_acad_program', 'Delete Academic Program');

INSERT INTO `permission` VALUES(00000000000000000184, 'delete_semester', 'Delete Semester');

INSERT INTO `permission` VALUES(00000000000000000185, 'delete_term', 'Delete Term');

INSERT INTO `permission` VALUES(00000000000000000186, 'delete_acad_year', 'Delete Academic Year');

INSERT INTO `permission` VALUES(00000000000000000187, 'delete_department', 'Delete Department');

INSERT INTO `permission` VALUES(00000000000000000188, 'delete_subject', 'Delete Subject');

INSERT INTO `permission` VALUES(00000000000000000189, 'delete_credit_load', 'Delete Credit Load');

INSERT INTO `permission` VALUES(00000000000000000190, 'delete_class_year', 'Delete Class Year');

INSERT INTO `permission` VALUES(00000000000000000191, 'delete_degree', 'Delete Degree');

INSERT INTO `permission` VALUES(00000000000000000192, 'delete_major', 'Delete Major');

INSERT INTO `permission` VALUES(00000000000000000193, 'delete_minor', 'Delete Minor');

INSERT INTO `permission` VALUES(00000000000000000194, 'delete_ccd', 'Delete CCD');

INSERT INTO `permission` VALUES(00000000000000000195, 'delete_specialization', 'Delete Specialization');

INSERT INTO `permission` VALUES(00000000000000000196, 'delete_cip', 'Delete CIP');

INSERT INTO `permission` VALUES(00000000000000000197, 'delete_location', 'Delete Location');

INSERT INTO `permission` VALUES(00000000000000000198, 'delete_building', 'Delete Building');

INSERT INTO `permission` VALUES(00000000000000000199, 'delete_room', 'Delete Room');

INSERT INTO `permission` VALUES(00000000000000000200, 'delete_school', 'Delete School');

INSERT INTO `permission` VALUES(00000000000000000201, 'activate_course_sec', 'Activate Course Section');

INSERT INTO `permission` VALUES(00000000000000000202, 'cancel_course_sec', 'Cancel Course Section');

CREATE TABLE IF NOT EXISTS `person` (
  `personID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uname` varchar(80) NOT NULL,
  `prefix` varchar(6) NOT NULL,
  `personType` varchar(3) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `mname` varchar(2) NOT NULL,
  `email` varchar(150) NOT NULL,
  `ssn` int(9) NOT NULL,
  `dob` date NOT NULL,
  `veteran` enum('1','0') NOT NULL,
  `ethnicity` varchar(30) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `schoolCode` varchar(11) DEFAULT NULL,
  `buildingCode` varchar(11) DEFAULT NULL,
  `officeCode` varchar(11) DEFAULT NULL,
  `office_phone` varchar(15) DEFAULT NULL,
  `deptCode` varchar(11) DEFAULT NULL,
  `emergency_contact` varchar(150) NOT NULL,
  `emergency_contact_phone` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `approvedDate` datetime NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`personID`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `ssn` (`ssn`),
  KEY `person_type` (`personType`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `person_perms` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `personID` int(11) unsigned zerofill NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `userID` (`personID`,`permID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `person_roles` (
  `rID` int(11) NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `roleID` bigint(20) NOT NULL,
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`rID`),
  UNIQUE KEY `userID` (`personID`,`roleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(30) NOT NULL,
  `eventDate` date NOT NULL DEFAULT '0000-00-00',
  `startTime` time NOT NULL DEFAULT '00:00:00',
  `endTime` time NOT NULL DEFAULT '00:00:00',
  `description` text NOT NULL,
  `recurring` tinyint(4) NOT NULL DEFAULT '0',
  `recurDOTW` tinyint(4) DEFAULT NULL,
  `eventDay` tinyint(4) NOT NULL DEFAULT '0',
  `catID` int(11) unsigned zerofill NOT NULL DEFAULT '00000000001',
  `approved` enum('1','0') NOT NULL DEFAULT '0',
  `endDate` date NOT NULL DEFAULT '0000-00-00',
  `roomID` int(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_date` (`eventDate`),
  KEY `event_name` (`eventName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reservation_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(30) NOT NULL,
  `fgcolor` char(8) NOT NULL DEFAULT '#000000',
  `bgcolor` char(8) NOT NULL DEFAULT '#ffffff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `role` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `roleName` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `roleName` (`roleName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `role` VALUES(00000000000000000009, 'Faculty');

INSERT INTO `role` VALUES(00000000000000000010, 'Parent');

INSERT INTO `role` VALUES(00000000000000000012, 'Staff');

INSERT INTO `role` VALUES(00000000000000000011, 'Student');

INSERT INTO `role` VALUES(00000000000000000008, 'Super Administrator');

CREATE TABLE IF NOT EXISTS `role_perms` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `roleID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `roleID_2` (`roleID`,`permID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `role_perms` VALUES(00000000000000000156, 11, 92, 1, '2013-09-03 11:30:43');

INSERT INTO `role_perms` VALUES(00000000000000000201, 8, 21, 1, '2013-09-03 12:03:29');

INSERT INTO `role_perms` VALUES(00000000000000000238, 8, 23, 1, '2013-09-03 12:03:29');

INSERT INTO `role_perms` VALUES(00000000000000000268, 8, 22, 1, '2013-09-03 12:04:18');

INSERT INTO `role_perms` VALUES(00000000000000000292, 8, 20, 1, '2013-09-03 12:04:18');

INSERT INTO `role_perms` VALUES(00000000000000000309, 9, 84, 1, '2013-09-03 12:05:33');

INSERT INTO `role_perms` VALUES(00000000000000000310, 9, 107, 1, '2013-09-03 12:05:33');

INSERT INTO `role_perms` VALUES(00000000000000000462, 10, 176, 1, '2013-09-03 12:36:35');

INSERT INTO `role_perms` VALUES(00000000000000000470, 12, 84, 1, '2013-09-03 12:37:49');

INSERT INTO `role_perms` VALUES(00000000000000000471, 12, 107, 1, '2013-09-03 12:37:49');

INSERT INTO `role_perms` VALUES(00000000000000000712, 13, 24, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000713, 13, 25, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000714, 13, 156, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000715, 13, 140, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000716, 13, 144, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000717, 13, 164, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000718, 13, 124, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000719, 13, 128, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000720, 13, 116, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000721, 13, 152, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000722, 13, 132, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000723, 13, 136, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000724, 13, 160, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000725, 13, 173, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000726, 13, 29, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000727, 13, 148, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000728, 13, 120, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000729, 13, 33, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000730, 13, 155, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000731, 13, 139, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000732, 13, 143, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000733, 13, 163, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000734, 13, 123, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000735, 13, 127, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000736, 13, 27, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000737, 13, 158, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000738, 13, 142, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000739, 13, 146, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000740, 13, 166, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000741, 13, 126, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000742, 13, 130, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000743, 13, 118, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000744, 13, 154, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000745, 13, 134, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000746, 13, 138, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000747, 13, 162, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000748, 13, 175, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000749, 13, 31, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000750, 13, 150, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000751, 13, 122, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000752, 13, 35, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000753, 13, 115, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000754, 13, 26, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000755, 13, 99, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000756, 13, 157, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000757, 13, 141, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000758, 13, 145, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000759, 13, 165, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000760, 13, 125, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000761, 13, 129, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000762, 13, 117, 1, '2013-09-03 22:37:31');

INSERT INTO `role_perms` VALUES(00000000000000000763, 13, 153, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000764, 13, 133, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000765, 13, 137, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000766, 13, 161, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000767, 13, 174, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000768, 13, 30, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000769, 13, 149, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000770, 13, 121, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000771, 13, 34, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000772, 13, 109, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000773, 13, 151, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000774, 13, 131, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000775, 13, 135, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000776, 13, 159, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000777, 13, 172, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000778, 13, 28, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000779, 13, 147, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000780, 13, 119, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000781, 13, 32, 1, '2013-09-03 22:40:18');

INSERT INTO `role_perms` VALUES(00000000000000000936, 9, 89, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000937, 9, 85, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000938, 9, 168, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000939, 9, 100, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000940, 9, 79, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000941, 9, 36, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000942, 9, 78, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000943, 9, 74, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000944, 9, 102, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000945, 9, 40, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000946, 9, 101, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000947, 9, 169, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000948, 9, 103, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000949, 9, 44, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000950, 9, 179, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000951, 9, 80, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000952, 9, 104, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000953, 9, 48, 1, '2013-09-04 03:38:19');

INSERT INTO `role_perms` VALUES(00000000000000000954, 12, 89, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000955, 12, 85, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000956, 12, 100, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000957, 12, 79, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000958, 12, 36, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000959, 12, 78, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000960, 12, 74, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000961, 12, 102, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000962, 12, 40, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000963, 12, 101, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000964, 12, 103, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000965, 12, 44, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000966, 12, 179, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000967, 12, 80, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000968, 12, 104, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000969, 12, 48, 1, '2013-09-04 04:50:27');

INSERT INTO `role_perms` VALUES(00000000000000000970, 9, 180, 1, '2013-09-04 04:51:37');

INSERT INTO `role_perms` VALUES(00000000000000000971, 11, 180, 1, '2013-09-04 04:51:52');

INSERT INTO `role_perms` VALUES(00000000000000000972, 12, 180, 1, '2013-09-04 04:52:01');

CREATE TABLE IF NOT EXISTS `room` (
  `roomID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `roomCode` varchar(11) NOT NULL,
  `buildingID` int(11) unsigned zerofill NOT NULL,
  `roomNumber` varchar(11) NOT NULL,
  `roomCap` int(4) NOT NULL,
  PRIMARY KEY (`roomID`),
  UNIQUE KEY `roomKey` (`roomCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `saved_query` (
  `savedQueryID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `personID` int(8) unsigned zerofill NOT NULL,
  `savedQueryName` varchar(80) NOT NULL,
  `savedQuery` text NOT NULL,
  `purgeQuery` enum('0','1') NOT NULL DEFAULT '0',
  `createdDate` date NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`savedQueryID`),
  KEY `personID` (`personID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `school` (
  `schoolID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `schoolCode` varchar(11) NOT NULL,
  `schoolName` varchar(180) NOT NULL,
  `buildingID` int(11) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`schoolID`),
  UNIQUE KEY `schoolCode` (`schoolCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `screen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `relativeURL` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `screen` VALUES(1, 'SYSS', 'System Settings', 'setting/');

INSERT INTO `screen` VALUES(2, 'MPRM', 'Manage Permissions', 'permission/');

INSERT INTO `screen` VALUES(3, 'APRM', 'Add Permission', 'permission/add/');

INSERT INTO `screen` VALUES(4, 'MRLE', 'Manage Roles', 'role/');

INSERT INTO `screen` VALUES(5, 'AUDT', 'Audit Trail', 'audit_trail/');

INSERT INTO `screen` VALUES(6, 'SQL', 'SQL Interface', 'sql/');

INSERT INTO `screen` VALUES(7, 'ARLE', 'Add Role', 'role/add/');

INSERT INTO `screen` VALUES(8, 'SCH', 'School Form', 'form/school/');

INSERT INTO `screen` VALUES(9, 'SEM', 'Semester Form', 'form/semester/');

INSERT INTO `screen` VALUES(10, 'TERM', 'Term Form', 'form/term/');

INSERT INTO `screen` VALUES(11, 'AYR', 'Acad Year Form', 'form/acad_year/');

INSERT INTO `screen` VALUES(12, 'CRSE', 'Course', 'course/');

INSERT INTO `screen` VALUES(13, 'DEPT', 'Department Form', 'form/department/');

INSERT INTO `screen` VALUES(14, 'CRL', 'Credit Load Form', 'form/credit_load/');

INSERT INTO `screen` VALUES(15, 'DEG', 'Degree Form', 'form/degree/');

INSERT INTO `screen` VALUES(16, 'MAJR', 'Major Form', 'form/major/');

INSERT INTO `screen` VALUES(17, 'MINR', 'Minor Form', 'form/minor/');

INSERT INTO `screen` VALUES(18, 'PROG', 'Academic Program', 'program/');

INSERT INTO `screen` VALUES(19, 'CCD', 'CCD Form', 'form/ccd/');

INSERT INTO `screen` VALUES(20, 'CIP', 'CIP Form', 'form/cip/');

INSERT INTO `screen` VALUES(21, 'LOC', 'Location Form', 'form/location/');

INSERT INTO `screen` VALUES(22, 'BLDG', 'Building Form', 'form/building/');

INSERT INTO `screen` VALUES(23, 'ROOM', 'Room Form', 'form/room/');

INSERT INTO `screen` VALUES(24, 'SPEC', 'Specialization From', 'form/specialization/');

INSERT INTO `screen` VALUES(25, 'SUBJ', 'Subject Form', 'form/subject/');

INSERT INTO `screen` VALUES(26, 'CLYR', 'Class Year Form', 'form/class_year/');

INSERT INTO `screen` VALUES(27, 'APRG', 'Add Acad Program', 'program/add/');

INSERT INTO `screen` VALUES(28, 'ACRS', 'Add Course', 'course/add/');

INSERT INTO `screen` VALUES(29, 'SECT', 'Course Section', 'section/');

INSERT INTO `screen` VALUES(30, 'RGN', 'Course Registration', 'section/register/');

INSERT INTO `screen` VALUES(31, 'NSCP', 'NSLC Purge', 'nslc/purge/');

INSERT INTO `screen` VALUES(32, 'NSCS', 'NSLC Setup', 'nslc/setup/');

INSERT INTO `screen` VALUES(33, 'NSCX', 'NSLC Extraction', 'nslc/extraction/');

INSERT INTO `screen` VALUES(34, 'NSCE', 'NSLC Verification', 'nslc/verification/');

INSERT INTO `screen` VALUES(35, 'NSCC', 'NSLC Correction', 'nslc/');

INSERT INTO `screen` VALUES(36, 'NSCT', 'NSLC File', 'nslc/file/');

INSERT INTO `screen` VALUES(37, 'NAE', 'Name & Address', 'person/');

INSERT INTO `screen` VALUES(38, 'APER', 'Add Person', 'person/add/');

INSERT INTO `screen` VALUES(39, 'SPRO', 'Student Profile', 'student/');

INSERT INTO `screen` VALUES(40, 'FAC', 'Faculty Profile', 'faculty/');

CREATE TABLE IF NOT EXISTS `semester` (
  `semesterID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `acadYearID` int(11) unsigned zerofill NOT NULL,
  `semCode` varchar(11) NOT NULL,
  `semName` varchar(80) NOT NULL,
  `semStartDate` date NOT NULL DEFAULT '0000-00-00',
  `semEndDate` date NOT NULL DEFAULT '0000-00-00',
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`semesterID`),
  UNIQUE KEY `semCode` (`semCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `specialization` (
  `specID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `specCode` varchar(11) NOT NULL,
  `specName` varchar(80) NOT NULL,
  PRIMARY KEY (`specID`),
  UNIQUE KEY `specCode` (`specCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `staffID` int(8) unsigned zerofill NOT NULL,
  `schoolID` int(11) NOT NULL,
  `buildingID` int(11) NOT NULL,
  `officeID` int(11) NOT NULL,
  `office_phone` varchar(15) NOT NULL,
  `deptID` int(11) NOT NULL,
  `addDate` datetime NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staffID` (`staffID`),
  KEY `approvedBy` (`approvedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL,
  `name` varchar(180) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `state` VALUES(00000000001, 'AL', 'Alabama');

INSERT INTO `state` VALUES(00000000002, 'AK', 'Alaska');

INSERT INTO `state` VALUES(00000000003, 'AZ', 'Arizona');

INSERT INTO `state` VALUES(00000000004, 'AR', 'Arkansas');

INSERT INTO `state` VALUES(00000000005, 'CA', 'California');

INSERT INTO `state` VALUES(00000000006, 'CO', 'Colorado');

INSERT INTO `state` VALUES(00000000007, 'CT', 'Connecticut');

INSERT INTO `state` VALUES(00000000008, 'DE', 'Delaware');

INSERT INTO `state` VALUES(00000000009, 'DC', 'District of Columbia');

INSERT INTO `state` VALUES(00000000010, 'FL', 'Florida');

INSERT INTO `state` VALUES(00000000011, 'GA', 'Georgia');

INSERT INTO `state` VALUES(00000000012, 'HI', 'Hawaii');

INSERT INTO `state` VALUES(00000000013, 'ID', 'Idaho');

INSERT INTO `state` VALUES(00000000014, 'IL', 'Illinois');

INSERT INTO `state` VALUES(00000000015, 'IN', 'Indiana');

INSERT INTO `state` VALUES(00000000016, 'IA', 'Iowa');

INSERT INTO `state` VALUES(00000000017, 'KS', 'Kansas');

INSERT INTO `state` VALUES(00000000018, 'KY', 'Kentucky');

INSERT INTO `state` VALUES(00000000019, 'LA', 'Louisiana');

INSERT INTO `state` VALUES(00000000020, 'ME', 'Maine');

INSERT INTO `state` VALUES(00000000021, 'MD', 'Maryland');

INSERT INTO `state` VALUES(00000000022, 'MA', 'Massachusetts');

INSERT INTO `state` VALUES(00000000023, 'MI', 'Michigan');

INSERT INTO `state` VALUES(00000000024, 'MN', 'Minnesota');

INSERT INTO `state` VALUES(00000000025, 'MS', 'Mississippi');

INSERT INTO `state` VALUES(00000000026, 'MO', 'Missouri');

INSERT INTO `state` VALUES(00000000027, 'MT', 'Montana');

INSERT INTO `state` VALUES(00000000028, 'NE', 'Nebraska');

INSERT INTO `state` VALUES(00000000029, 'NV', 'Nevada');

INSERT INTO `state` VALUES(00000000030, 'NH', 'New Hampshire');

INSERT INTO `state` VALUES(00000000031, 'NJ', 'New Jersey');

INSERT INTO `state` VALUES(00000000032, 'NM', 'New Mexico');

INSERT INTO `state` VALUES(00000000033, 'NY', 'New York');

INSERT INTO `state` VALUES(00000000034, 'NC', 'North Carolina');

INSERT INTO `state` VALUES(00000000035, 'ND', 'North Dakota');

INSERT INTO `state` VALUES(00000000036, 'OH', 'Ohio');

INSERT INTO `state` VALUES(00000000037, 'OK', 'Oklahoma');

INSERT INTO `state` VALUES(00000000038, 'OR', 'Oregon');

INSERT INTO `state` VALUES(00000000039, 'PA', 'Pennsylvania');

INSERT INTO `state` VALUES(00000000040, 'RI', 'Rhode Island');

INSERT INTO `state` VALUES(00000000041, 'SC', 'South Carolina');

INSERT INTO `state` VALUES(00000000042, 'SD', 'South Dakota');

INSERT INTO `state` VALUES(00000000043, 'TN', 'Tennessee');

INSERT INTO `state` VALUES(00000000044, 'TX', 'Texas');

INSERT INTO `state` VALUES(00000000045, 'UT', 'Utah');

INSERT INTO `state` VALUES(00000000046, 'VT', 'Vermont');

INSERT INTO `state` VALUES(00000000047, 'VA', 'Virginia');

INSERT INTO `state` VALUES(00000000048, 'WA', 'Washington');

INSERT INTO `state` VALUES(00000000049, 'WV', 'West Virginia');

INSERT INTO `state` VALUES(00000000050, 'WI', 'Wisconsin');

INSERT INTO `state` VALUES(00000000051, 'WY', 'Wyoming');

INSERT INTO `state` VALUES(00000000052, 'AB', 'Alberta');

INSERT INTO `state` VALUES(00000000053, 'BC', 'British Columbia');

INSERT INTO `state` VALUES(00000000054, 'MB', 'Manitoba');

INSERT INTO `state` VALUES(00000000055, 'NL', 'Newfoundland');

INSERT INTO `state` VALUES(00000000056, 'NB', 'New Brunswick');

INSERT INTO `state` VALUES(00000000057, 'NS', 'Nova Scotia');

INSERT INTO `state` VALUES(00000000058, 'NT', 'Northwest Territories');

INSERT INTO `state` VALUES(00000000059, 'NU', 'Nunavut');

INSERT INTO `state` VALUES(00000000060, 'ON', 'Ontario');

INSERT INTO `state` VALUES(00000000061, 'PE', 'Prince Edward Island');

INSERT INTO `state` VALUES(00000000062, 'QC', 'Quebec');

INSERT INTO `state` VALUES(00000000063, 'SK', 'Saskatchewan');

INSERT INTO `state` VALUES(00000000064, 'YT', 'Yukon Territory');

CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `advisorID` int(8) unsigned zerofill NOT NULL,
  `catYearID` int(11) unsigned zerofill NOT NULL,
  `antGradDate` varchar(5) NOT NULL,
  `acadLevelCode` varchar(4) NOT NULL,
  `addDate` datetime NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `stuID` (`stuID`),
  KEY `approvedBy` (`approvedBy`),
  KEY `acad_level_code` (`acadLevelCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_acad_cred` (
  `stuAcadCredID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `compCred` double(4,1) NOT NULL,
  `attCred` double(4,1) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuAcadCredID`),
  UNIQUE KEY `stuAcadCred` (`stuID`,`courseSecID`,`termID`),
  KEY `courseSecID` (`courseSecID`),
  KEY `termID` (`termID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `comment` text NOT NULL,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `stuID` (`stuID`),
  KEY `addedBy` (`addedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_course_sec` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `courseSecID` int(11) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `courseCredits` double(4,1) NOT NULL DEFAULT '0.0',
  `ceu` double(4,1) NOT NULL DEFAULT '0.0',
  `grade` varchar(2) DEFAULT NULL,
  `status` enum('A','N','D','W','C') NOT NULL DEFAULT 'A',
  `statusDate` date NOT NULL,
  `statusTime` varchar(10) NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courseSec` (`stuID`,`courseSecID`,`termID`),
  KEY `courseSecID` (`courseSecID`),
  KEY `termID` (`termID`),
  KEY `addedBy` (`addedBy`),
  KEY `stu_course_sec_status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_program` (
  `stuProgID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `progID` int(11) unsigned zerofill NOT NULL,
  `currStatus` varchar(1) NOT NULL,
  `statusDate` date NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `approvedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuProgID`),
  UNIQUE KEY `student_program` (`stuID`,`progID`),
  KEY `approvedBy` (`approvedBy`),
  KEY `progID` (`progID`),
  KEY `stu_program_status` (`currStatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_term` (
  `stuTermID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `termID` int(11) unsigned zerofill NOT NULL,
  `termCredits` double(6,1) NOT NULL DEFAULT '0.0',
  `addDateTime` datetime NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuTermID`),
  UNIQUE KEY `stuTerm` (`stuID`,`termID`),
  KEY `termID` (`termID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `stu_term_load` (
  `stuLoadID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` int(8) unsigned zerofill NOT NULL,
  `stuTermID` int(11) unsigned zerofill NOT NULL,
  `stuLoad` varchar(2) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stuLoadID`),
  UNIQUE KEY `stuTermLoad` (`stuID`,`stuTermID`),
  KEY `stuTermID` (`stuTermID`),
  KEY `student_load` (`stuLoad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `subject` (
  `subjectID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `subjCode` varchar(11) NOT NULL,
  `subjName` varchar(180) NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subjectID`),
  UNIQUE KEY `subjCode` (`subjCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `term` (
  `termID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `semesterID` int(11) unsigned zerofill NOT NULL,
  `termCode` varchar(11) NOT NULL,
  `termName` varchar(10) NOT NULL DEFAULT '',
  `reportingTerm` varchar(5) NOT NULL,
  `termStartDate` date NOT NULL DEFAULT '0000-00-00',
  `termEndDate` date NOT NULL DEFAULT '0000-00-00',
  `active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`termID`),
  UNIQUE KEY `termCode` (`termCode`),
  KEY `semesterID` (`semesterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `address` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `address` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `course` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `course_sec` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `faculty` ADD FOREIGN KEY (`facID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `faculty` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `graduate` ADD FOREIGN KEY (`gradID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `graduate` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person_roles` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `person_perms` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `saved_query` ADD FOREIGN KEY (`personID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `staff` ADD FOREIGN KEY (`staffID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `staff` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `student` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `student` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_program` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_program` ADD FOREIGN KEY (`approvedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_term_load` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_acad_cred` ADD FOREIGN KEY (`courseSecID`) REFERENCES `course_sec` (`courseSecID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_acad_cred` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`courseSecID`) REFERENCES `course_sec` (`courseSecID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_program` ADD FOREIGN KEY (`progID`) REFERENCES `acad_program` (`acadProgID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_term` ADD FOREIGN KEY (`termID`) REFERENCES `term` (`termID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_term_load` ADD FOREIGN KEY (`stuTermID`) REFERENCES `stu_term` (`stuTermID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `term` ADD FOREIGN KEY (`semesterID`) REFERENCES `semester` (`semesterID`) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE `stu_comment` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_comment` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`stuID`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `stu_course_sec` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;