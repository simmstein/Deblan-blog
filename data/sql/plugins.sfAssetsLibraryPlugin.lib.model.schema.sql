
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_asset_folder
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_asset_folder`;


CREATE TABLE `sf_asset_folder`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tree_left` INTEGER default 0 NOT NULL,
	`tree_right` INTEGER default 0 NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`relative_path` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uk_relative_path` (`relative_path`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_asset
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_asset`;


CREATE TABLE `sf_asset`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`folder_id` INTEGER  NOT NULL,
	`filename` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`author` VARCHAR(255),
	`copyright` VARCHAR(100),
	`type` VARCHAR(10),
	`filesize` INTEGER,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `uk_folder_filename` (`folder_id`, `filename`),
	CONSTRAINT `sf_asset_FK_1`
		FOREIGN KEY (`folder_id`)
		REFERENCES `sf_asset_folder` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
