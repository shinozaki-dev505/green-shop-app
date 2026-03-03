CREATE DATABASE IF NOT EXISTS green_shop_db CHARACTER SET utf8mb4;
USE green_shop_db;

CREATE TABLE IF NOT EXISTS menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255),
    type VARCHAR(50), -- ここを今の環境に合わせて更新
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- 並び替えに使うため追加
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 初期データ（任意。今の4件を入れておくと親切です）
INSERT INTO menus (name, price, image, type) VALUES 
('モンステラ', 3000, 'monstera.jpg', 'plant'),
('サボテン', 1300, 'cactus.jpg', 'plant'),
('有機肥料', 1620, 'fertilizer.jpg', 'goods'),
('素焼きの鉢', 868, 'pot.jpg', 'goods');