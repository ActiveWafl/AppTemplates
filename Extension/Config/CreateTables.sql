CREATE TABLE if not exists `{$PREFIX}Things` (
  `ThingId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SomeCol1` text NOT NULL,
  `SomeCol2` int(10) unsigned NOT NULL,
  `SomeCol3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ThingId`)
) ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE if not exists `{$PREFIX}OtherThings` (
  `OtherThingId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SomeCol1` text NOT NULL,
  `SomeCol2` int(10) unsigned NOT NULL,
  `SomeCol3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ThingId`)
) ENGINE=InnoDB CHARSET=utf8;