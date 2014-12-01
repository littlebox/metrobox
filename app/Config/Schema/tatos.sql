

DROP TABLE IF EXISTS `tatos`.`estates`;
DROP TABLE IF EXISTS `tatos`.`estates_images`;
DROP TABLE IF EXISTS `tatos`.`images`;
DROP TABLE IF EXISTS `tatos`.`users`;


CREATE TABLE `tatos`.`estates` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` int(11) UNSIGNED NOT NULL,
	`type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`operation` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`street_number` int(11) UNSIGNED NOT NULL,
	`street_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`province` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`postal_code` int(11) UNSIGNED NOT NULL,
	`latitude` float NOT NULL,
	`longitude` float NOT NULL,
	`surface_total` float UNSIGNED NOT NULL,
	`surface_covered` float UNSIGNED NOT NULL,
	`rooms` int(11) UNSIGNED NOT NULL,
	`expenses` int(11) UNSIGNED NOT NULL,
	`currency` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`antiqueness` int(11) UNSIGNED NOT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=InnoDB;

CREATE TABLE `tatos`.`estates_images` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`estate_id` int(11) UNSIGNED NOT NULL,
	`image_id` int(11) UNSIGNED NOT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=InnoDB;

CREATE TABLE `tatos`.`images` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=InnoDB;

CREATE TABLE `tatos`.`users` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	`password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	`role` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_unicode_ci,
	ENGINE=InnoDB;

