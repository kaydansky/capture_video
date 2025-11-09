--
-- Table structure for `ubiqisense` database
--

CREATE TABLE IF NOT EXISTS `names` (
  `NamesID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(128) NOT NULL,
  PRIMARY KEY (`NamesID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;