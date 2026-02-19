-- ============================================
-- STREAM MAX — База данных
-- Выполните этот файл в phpMyAdmin
-- ============================================

CREATE TABLE IF NOT EXISTS `users` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100) NOT NULL,
  `username`   VARCHAR(50)  NOT NULL UNIQUE,
  `email`      VARCHAR(150) NOT NULL UNIQUE,
  `password`   VARCHAR(255) NOT NULL,
  `role`       ENUM('admin','user') DEFAULT 'user',
  `status`     ENUM('active','blocked') DEFAULT 'active',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `channels` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100) NOT NULL,
  `category`   VARCHAR(80)  NOT NULL,
  `url`        TEXT         NOT NULL,
  `icon`       VARCHAR(10)  DEFAULT '📡',
  `color`      VARCHAR(20)  DEFAULT '#0d0d2e',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user_channels` (
  `user_id`    INT NOT NULL,
  `channel_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `channel_id`),
  FOREIGN KEY (`user_id`)    REFERENCES `users`(`id`)    ON DELETE CASCADE,
  FOREIGN KEY (`channel_id`) REFERENCES `channels`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `leads` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100),
  `phone`      VARCHAR(30),
  `email`      VARCHAR(150),
  `device`     VARCHAR(80),
  `source`     VARCHAR(80),
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Администратор по умолчанию (пароль: admin123)
INSERT INTO `users` (`name`, `username`, `email`, `password`, `role`) VALUES
('Администратор', 'admin', 'admin@streammax.tv', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Тестовый пользователь (пароль: user123)
INSERT INTO `users` (`name`, `username`, `email`, `password`, `role`) VALUES
('Иван Петров', 'user', 'user@mail.com', '$2y$10$TKh8H1.PfjfgmhfjfgmjkUe9o9aq4dXAuNUAqW.P7oX6FGOuCrRm6', 'user');

-- Каналы по умолчанию
INSERT INTO `channels` (`name`, `category`, `url`, `icon`, `color`) VALUES
('Первый Канал',  '📺 Новости',      'https://stream.example.com/ch1.m3u8', '🏛️', '#0d0d2e'),
('Спорт 24',      '⚽ Спорт',        'https://stream.example.com/ch2.m3u8', '⚽', '#0a1520'),
('КиноПремьер',  '🎬 Кино',         'https://stream.example.com/ch3.m3u8', '🎬', '#1a0a28'),
('Мульт ТВ',      '🧒 Детские',      'https://stream.example.com/ch4.m3u8', '🎠', '#0a1a2e'),
('Новости 24',    '📺 Новости',      'https://stream.example.com/ch5.m3u8', '📰', '#1a1508');
