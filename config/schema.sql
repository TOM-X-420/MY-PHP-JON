CREATE DATABASE IF NOT EXISTS `your_cpanel_username_rentals`
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `your_cpanel_username_rentals`;

-- Rental properties table
CREATE TABLE IF NOT EXISTS `properties` (
    `id`          INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `title`       VARCHAR(255)     NOT NULL,
    `description` TEXT,
    `price`       DECIMAL(10,2)    NOT NULL DEFAULT '0.00',
    `location`    VARCHAR(255),
    `bedrooms`    TINYINT UNSIGNED NOT NULL DEFAULT 1,
    `status`      ENUM('available','rented','maintenance') NOT NULL DEFAULT 'available',
    `image`       VARCHAR(255),
    `created_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact messages table
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(100) NOT NULL,
    `email`      VARCHAR(150) NOT NULL,
    `message`    TEXT         NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data
INSERT INTO `properties` (`title`, `description`, `price`, `location`, `bedrooms`, `status`) VALUES
('Cozy Studio Apartment', 'A bright and modern studio in the city centre.', 8500.00, 'Dhaka, Dhanmondi', 1, 'available'),
('2-Bedroom Family Flat',  'Spacious flat with balcony, close to schools.', 15000.00, 'Dhaka, Mirpur',    2, 'available'),
('3-Bedroom House',        'Large house with garden, quiet neighbourhood.',  22000.00, 'Dhaka, Uttara',    3, 'rented');
