-- Databáza pre projekt Zelený Raj Záhrady
-- PHP Skriptovacie jazyky - školský projekt

CREATE DATABASE IF NOT EXISTS zeleny_raj
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE zeleny_raj;

-- Tabuľka používateľov (admin)
CREATE TABLE IF NOT EXISTS users (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,       -- bcrypt hash
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabuľka služieb (CRUD entita)
CREATE TABLE IF NOT EXISTS services (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    price       DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    category    VARCHAR(100)  NOT NULL DEFAULT 'ostatné',
    is_active   TINYINT(1)    NOT NULL DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabuľka správ z kontaktného formulára
CREATE TABLE IF NOT EXISTS contact_messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL,
    message    TEXT         NOT NULL,
    is_read    TINYINT(1)   NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabuľka fotografií v galérii (CRUD entita č.2)
CREATE TABLE IF NOT EXISTS gallery_images (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    filename    VARCHAR(255) NOT NULL,
    description TEXT,
    sort_order  INT          NOT NULL DEFAULT 0,
    is_active   TINYINT(1)  NOT NULL DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Predvolený admin účet  (heslo: admin123)
INSERT INTO users (username, password) VALUES
('admin', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Ukážkové služby
INSERT INTO services (name, description, price, category) VALUES
('Kosenie trávnika', 'Profesionálne kosenie trávnika s odstraňovaním trávy. Platba za m².', 0.80, 'údržba'),
('Strih kríkov a živých plotov', 'Tvarovanie okrasných kríkov a živých plotov pre estetický vzhľad záhrady.', 35.00, 'údržba'),
('Návrh záhrady', 'Kompletný 2D/3D návrh záhrady vrátane rastlinného osadenia a chodníkov.', 250.00, 'návrh'),
('Výsadba rastlín', 'Profesionálna výsadba sezónnych kvetov, trvaliek a drevín.', 45.00, 'výsadba'),
('Automatické zavlažovanie', 'Inštalácia automatického zavlažovacieho systému na mieru.', 800.00, 'inštalácia'),
('Údržbový balík Štart', 'Kosenie + hnojenie 1× mesačne. Vhodný pre menšie záhrady.', 50.00, 'balík'),
('Údržbový balík Profi', 'Všetko zo Štart + strih kríkov, sezónne práce 2× mesačne.', 90.00, 'balík'),
('Údržbový balík Premium', 'Kompletná starostlivosť, zavlažovanie a poradenstvo 4× mesačne.', 160.00, 'balík');

-- Ukážkové fotky galérie
INSERT INTO gallery_images (title, filename, description, sort_order) VALUES
('Japonská záhrada', 'beautiful-view-mesmerizing-nature-traditional-styled-japanese-adelaide-himeji-gardens.jpg', 'Inšpirácia japonskou záhradnou architektúrou.', 1),
('Záhradná realizácia', 'i_6036673.jpg', 'Ukážka našej práce — udržiavaný trávnik s kvetinkami.', 2),
('Kvetinový záhon', 'park-outdoor-manicured-lawn-flowerbed-ai-generated-image.jpg', 'Starostlivo navrhnutý kvetinový záhon.', 3),
('Park s trávnikom', 'park-outdoor-manicured-lawn-flowerbed-ai-generated-image (1).jpg', 'Upravený park s pravidelnou údržbou.', 4),
('Lesná cesta', 'ubeyonroad-nbf9DiDvLeU-unsplash.jpg', 'Prírodné prostredie ako inšpirácia.', 5);
