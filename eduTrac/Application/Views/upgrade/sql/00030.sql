DROP TABLE IF EXISTS `event`;

CREATE TABLE IF NOT EXISTS `event` (
  `eventID` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `eventType` varchar(255) NOT NULL,
  `catID` int(11) NOT NULL,
  `requestor` int(8) unsigned zerofill NOT NULL,
  `roomCode` varchar(11) DEFAULT NULL,
  `termCode` varchar(11) DEFAULT NULL,
  `title` varchar(120) NOT NULL,
  `description` text,
  `weekday` int(1) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `repeats` tinyint(1) DEFAULT NULL,
  `repeatFreq` tinyint(1) DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eventID`),
  UNIQUE KEY `event` (`roomCode`,`termCode`,`title`,`weekday`,`startDate`,`startTime`,`endTime`),
  KEY `termCode` (`termCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `event` ADD FOREIGN KEY (`catID`) REFERENCES `event_category` (`catID`) ON UPDATE CASCADE;

ALTER TABLE `event` ADD FOREIGN KEY (`requestor`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `event` ADD FOREIGN KEY (`roomCode`) REFERENCES `room` (`roomCode`) ON UPDATE CASCADE;

ALTER TABLE `event` ADD FOREIGN KEY (`termCode`) REFERENCES `term` (`termCode`) ON UPDATE CASCADE;

ALTER TABLE `event` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

DROP TABLE IF EXISTS `event_category`;

CREATE TABLE IF NOT EXISTS `event_category` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  `bgcolor` varchar(11) NOT NULL DEFAULT '#000000',
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `event_category` VALUES(1, 'Course', '#8C7BC6');

INSERT INTO `event_category` VALUES(2, 'Meeting', '#00CCFF');

INSERT INTO `event_category` VALUES(3, 'Conference', '#E66000');

INSERT INTO `event_category` VALUES(4, 'Event', '#61D0AF');

DROP TABLE IF EXISTS `event_meta`;

CREATE TABLE IF NOT EXISTS `event_meta` (
  `eventMetaID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` int(11) unsigned zerofill NOT NULL,
  `roomCode` varchar(11) DEFAULT NULL,
  `requestor` int(8) unsigned zerofill NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` varchar(120) NOT NULL,
  `description` text,
  `addDate` date NOT NULL,
  `addedBy` int(8) unsigned zerofill NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eventMetaID`),
  UNIQUE KEY `event_meta` (`eventID`,`roomCode`,`start`,`end`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `event_meta` ADD FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `event_meta` ADD FOREIGN KEY (`roomCode`) REFERENCES `room` (`roomCode`) ON UPDATE CASCADE;

ALTER TABLE `event_meta` ADD FOREIGN KEY (`requestor`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

ALTER TABLE `event_meta` ADD FOREIGN KEY (`addedBy`) REFERENCES `person` (`personID`) ON UPDATE CASCADE;

INSERT INTO `et_option` VALUES('', 'room_request_email', 'request@myschool.edu');

INSERT INTO `et_option` VALUES('', 'room_request_text', '<p>&nbsp;</p>\r\n<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F4F3F4">\r\n<tbody>\r\n<tr>\r\n<td style="padding: 15px;"><center>\r\n<table width="550" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td align="left">\r\n<div style="border: solid 1px #d9d9d9;">\r\n<table id="header" style="line-height: 1.6; font-size: 12px; font-family: Helvetica, Arial, sans-serif; border: solid 1px #FFFFFF; color: #444;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td style="color: #ffffff;" colspan="2" valign="bottom" height="30">.</td>\r\n</tr>\r\n<tr>\r\n<td style="line-height: 32px; padding-left: 30px;" valign="baseline"><span style="font-size: 32px;">eduTrac ERP</span></td>\r\n<td style="padding-right: 30px;" align="right" valign="baseline"><span style="font-size: 14px; color: #777777;">Room/Event Reservation Request</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table id="content" style="margin-top: 15px; margin-right: 30px; margin-left: 30px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td style="border-top: solid 1px #d9d9d9;" colspan="2">\r\n<div style="padding: 15px 0;">Below are the details of a new room request.</div>\r\n<div style="padding: 15px 0;"><strong>Name:</strong> #name#<br /><br /><strong>Email:</strong> #email#<br /><br /><strong>Event Title:</strong> #title#<br /><strong>Description:</strong> #description#<br /><strong>Request Type:</strong> #request_type#<br /><strong>Category:</strong> #category#<br /><strong>Room#:</strong> #room#<br /><strong>Start Date:</strong> #firstday#<br /><strong>End Date:</strong> #lastday#<br /><strong>Start Time:</strong> #sTime#<br /><strong>End Time:</strong> #eTime#<br /><strong>Repeat?:</strong> #repeat#<br /><strong>Occurrence:</strong> #occurrence#<br /><br /><br />\r\n<h3>Legend</h3>\r\n<ul>\r\n<li>Repeat - 1 means yes it is an event that is repeated</li>\r\n<li>Occurrence - 1 = repeats everyday, 7 = repeats weekly, 14 = repeats biweekly</li>\r\n</ul>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table id="footer" style="line-height: 1.5; font-size: 12px; font-family: Arial, sans-serif; margin-right: 30px; margin-left: 30px;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff">\r\n<tbody>\r\n<tr style="font-size: 11px; color: #999999;">\r\n<td style="border-top: solid 1px #d9d9d9;" colspan="2">\r\n<div style="padding-top: 15px; padding-bottom: 1px;">Powered by eduTrac ERP</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="color: #ffffff;" colspan="2" height="15">.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>');

INSERT INTO `et_option` VALUES('', 'room_booking_confirmation_text', '<p>&nbsp;</p>\r\n<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F4F3F4">\r\n<tbody>\r\n<tr>\r\n<td style="padding: 15px;"><center>\r\n<table width="550" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td align="left">\r\n<div style="border: solid 1px #d9d9d9;">\r\n<table id="header" style="line-height: 1.6; font-size: 12px; font-family: Helvetica, Arial, sans-serif; border: solid 1px #FFFFFF; color: #444;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td style="color: #ffffff;" colspan="2" valign="bottom" height="30">.</td>\r\n</tr>\r\n<tr>\r\n<td style="line-height: 32px; padding-left: 30px;" valign="baseline"><span style="font-size: 32px;">eduTrac ERP</span></td>\r\n<td style="padding-right: 30px;" align="right" valign="baseline"><span style="font-size: 14px; color: #777777;">Room/Event&nbsp;Booking&nbsp;Confirmation</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table id="content" style="margin-top: 15px; margin-right: 30px; margin-left: 30px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff">\r\n<tbody>\r\n<tr>\r\n<td style="border-top: solid 1px #d9d9d9;" colspan="2">\r\n<div style="padding: 15px 0;">Your room request or event request entitled <strong>#title#</strong> has been booked. If you have any questions or concerns, please email our office at <a href="mailto:request@bdci.edu">request@bdci.edu</a></div>\r\n<div style="padding: 15px 0;">Sincerely,<br />Room Scheduler</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table id="footer" style="line-height: 1.5; font-size: 12px; font-family: Arial, sans-serif; margin-right: 30px; margin-left: 30px;" border="0" width="490" cellspacing="0" cellpadding="0" bgcolor="#ffffff">\r\n<tbody>\r\n<tr style="font-size: 11px; color: #999999;">\r\n<td style="border-top: solid 1px #d9d9d9;" colspan="2">\r\n<div style="padding-top: 15px; padding-bottom: 1px;">Powered by eduTrac ERP</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td style="color: #ffffff;" colspan="2" height="15">.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>');

UPDATE `et_option` SET option_value = '00031' WHERE option_name = 'dbversion';