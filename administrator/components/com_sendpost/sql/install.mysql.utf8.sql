DROP TABLE IF EXISTS `#__sendpost`;

CREATE TABLE `#__sendpost` (
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