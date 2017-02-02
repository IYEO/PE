DROP TABLE IF EXISTS `#__sendpost_data`;
DROP TABLE IF EXISTS `#__sendpost_recipient`;

CREATE TABLE `#__sendpost_data` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `date` TIMESTAMP NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(100),
    `details` TEXT(1000),
    `recipient` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
)
AUTO_INCREMENT = 0
DEFAULT CHARSET = utf8;

CREATE TABLE `#__sendpost_recipient` (
    `id` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
    `recipient` VARCHAR(100) NOT NULL DEFAULT 'smolensk@print-express99.ru',
    PRIMARY KEY (`id`)
)
DEFAULT CHARSET = utf8;

INSERT INTO `#__sendpost_recipient` (`id`, `recipient`) VALUES
    (1, 'smolensk@print-express99.ru');