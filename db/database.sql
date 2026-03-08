-- 1. データベースの作成
CREATE DATABASE IF NOT EXISTS green_shop_db CHARACTER SET utf8mb4;
USE green_shop_db;

-- 2. 商品管理テーブル (menus)
CREATE TABLE IF NOT EXISTS menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255),
    type VARCHAR(50) NOT NULL,    -- 'plant'（植物）または 'goods'（園芸用品）
    detail VARCHAR(255),          -- 植物なら'屋内/屋外'、用品なら'1〜3'を保存
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. ユーザー管理テーブル (users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL UNIQUE, -- ログイン用ID
    password VARCHAR(255) NOT NULL,      -- ハッシュ化したパスワード
    name VARCHAR(100),                   -- 表示名
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. 注文履歴テーブル (orders)
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id_int INT NOT NULL,            -- usersテーブルのid
    menu_id INT NOT NULL,                -- menusテーブルのid
    count INT NOT NULL DEFAULT 1,        -- 個数
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- 外部キー制約（ユーザーや商品が削除された時の動作を定義）
    FOREIGN KEY (user_id_int) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 5. 初期データ（動作確認用）
-- --------------------------------------------------------

-- 商品の初期データ
INSERT INTO menus (name, price, image, type, detail) VALUES 
('モンステラ', 3000, 'monstera.jpg', 'plant', '屋内'),
('サボテン', 1300, 'cactus.jpg', 'plant', '屋外'),
('有機肥料', 1620, 'fertilizer.jpg', 'goods', '2'),
('素焼きの鉢', 868, 'pot.jpg', 'goods', '3');

-- テストユーザー（パスワードは 'password' をハッシュ化したもの：$2y$10$...）
-- ※本番運用では必ず各自でハッシュ化してください
INSERT INTO users (user_id, password, name) VALUES 
('testuser', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'テストユーザー');