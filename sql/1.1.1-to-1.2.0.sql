ALTER TABLE `group` ADD `email` VARCHAR(255) NULL AFTER `bank_city`, ADD `facebook_page` VARCHAR(255) NULL AFTER `email`, ADD `facebook_group` VARCHAR(255) NULL AFTER `facebook_page`, ADD `twitter` VARCHAR(255) NULL AFTER `facebook_group`, ADD `comment` TEXT NULL AFTER `twitter`, ADD `presentation` TEXT NULL AFTER `comment`,
ADD `map_url` VARCHAR(255) NULL AFTER `presentation`;
