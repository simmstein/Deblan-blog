
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`user_id` INTEGER  NOT NULL,
	`firstname` VARCHAR(25),
	`lastname` VARCHAR(25),
	`email` VARCHAR(100),
	`avatar` VARCHAR(128),
	`twitter` VARCHAR(128),
	`facebook` VARCHAR(128),
	`linkedin` VARCHAR(128),
	`blog` VARCHAR(128),
	`website` VARCHAR(128),
	`description` TEXT,
	PRIMARY KEY (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- bot
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bot`;


CREATE TABLE `bot`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`ip` VARCHAR(128),
	`url` VARCHAR(255),
	`trace` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post`;


CREATE TABLE `post`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`content` TEXT,
	`tags` VARCHAR(255),
	`picture` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`published_at` DATETIME,
	`user_id` INTEGER,
	`is_active` TINYINT,
	PRIMARY KEY (`id`),
	INDEX `post_FI_1` (`user_id`),
	CONSTRAINT `post_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- tag
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;


CREATE TABLE `tag`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- post_has_tag
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_has_tag`;


CREATE TABLE `post_has_tag`
(
	`post_id` INTEGER  NOT NULL,
	`tag_id` INTEGER  NOT NULL,
	PRIMARY KEY (`post_id`,`tag_id`),
	CONSTRAINT `post_has_tag_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_has_tag_FI_2` (`tag_id`),
	CONSTRAINT `post_has_tag_FK_2`
		FOREIGN KEY (`tag_id`)
		REFERENCES `tag` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`rank` INTEGER,
	`is_active` TINYINT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- post_has_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post_has_category`;


CREATE TABLE `post_has_category`
(
	`post_id` INTEGER  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	PRIMARY KEY (`post_id`,`category_id`),
	CONSTRAINT `post_has_category_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `post_has_category_FI_2` (`category_id`),
	CONSTRAINT `post_has_category_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- link
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `link`;


CREATE TABLE `link`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`url` VARCHAR(255)  NOT NULL,
	`description` VARCHAR(255),
	`rank` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;


CREATE TABLE `comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`post_id` INTEGER  NOT NULL,
	`parent_comment_id` INTEGER,
	`author` VARCHAR(255)  NOT NULL,
	`website` VARCHAR(255),
	`email` VARCHAR(255)  NOT NULL,
	`content` TEXT  NOT NULL,
	`avatar` VARCHAR(128),
	`ip` VARCHAR(255),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `comment_FI_1` (`post_id`),
	CONSTRAINT `comment_FK_1`
		FOREIGN KEY (`post_id`)
		REFERENCES `post` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `comment_FI_2` (`parent_comment_id`),
	CONSTRAINT `comment_FK_2`
		FOREIGN KEY (`parent_comment_id`)
		REFERENCES `comment` (`id`)
		ON UPDATE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
