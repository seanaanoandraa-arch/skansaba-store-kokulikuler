CREATE DATABASE IF NOT EXISTS skansaba_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE skansaba_store;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 username VARCHAR(50) NOT NULL UNIQUE,
 phone VARCHAR(25) NOT NULL,
 password VARCHAR(255) NOT NULL,
 role ENUM('buyer','admin') NOT NULL DEFAULT 'buyer',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 category VARCHAR(80) NOT NULL,
 price DECIMAL(12,2) NOT NULL DEFAULT 0,
 stock INT NOT NULL DEFAULT 0,
 image VARCHAR(255) DEFAULT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE orders (
 id BIGINT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 total DECIMAL(12,2) NOT NULL,
 status ENUM('Menunggu','Diproses','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
 note TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_orders_user FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE=InnoDB;

CREATE TABLE order_items (
 id BIGINT AUTO_INCREMENT PRIMARY KEY,
 order_id BIGINT NOT NULL,
 product_id INT NULL,
 product_name VARCHAR(120) NOT NULL,
 price DECIMAL(12,2) NOT NULL,
 quantity INT NOT NULL,
 CONSTRAINT fk_items_order FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,
 CONSTRAINT fk_items_product FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO products(name,category,price,stock,image) VALUES
('Chocolatos','Makanan',500,25,'assets/images/chocolatos.jpeg'),
('Chiki Balls','Makanan',2000,25,'assets/images/Chiki_balls.jpeg'),
('Indomie','Makanan',3000,50,'assets/images/Indomie.jpeg'),
('Le Minerale','Minuman',2500,30,'assets/images/le_mineral.jpeg'),
('Mama Lemon','Kebutuhan Rumah Tangga',7000,20,'assets/images/Mama_lemon.jpeg'),
('Milku','Minuman',3000,25,'assets/images/Milku.jpeg'),
('Pop Mie','Makanan',5000,30,'assets/images/pop_mie.jpeg'),
('Sunco','Kebutuhan Rumah Tangga',20000,20,'assets/images/sunco.jpeg'),
('Teh Kotak','Minuman',3000,25,'assets/images/Teh_kotak.jpeg'),
('Tissue','Kebutuhan Rumah Tangga',9500,30,'assets/images/tissue.jpeg');
