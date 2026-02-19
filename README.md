# 植物・園芸用品ショップアプリ (Green Plant Shop App)
植物や園芸用品の閲覧、詳細情報の確認、および注文シミュレーションができるWebアプリケーションです。
Progateの学習内容をベースに、オブジェクト指向（OOP）とMySQLデータベースを組み合わせ、より実務に近い動的なシステムへと進化させました。

## 🚀 主な機能
動的なメニュー一覧: MySQLから取得した植物（Plant）と園芸用品（Goods）を一覧表示。

詳細情報の閲覧: アイテムごとの育て方、難易度、レビューなどの詳細を確認可能。

レビュー機能: データベースに保存されたユーザーごとのレビュー（性別アイコン付き）を動的に表示。

注文シミュレーション: 購入個数に応じた税込合計金額を算出。

## 📸 画面遷移
ユーザーの動線を定義します。

--**1. メニュー一覧画面**: index.php

MySQLから取得した商品を一覧表示します。

<img width="700" alt="index" src="https://github.com/user-attachments/assets/da879970-864b-42b0-a239-4073e098572b" />

　↓ 画像または「詳細を見る」をクリック

--**2. 商品詳細画面**: show.php

育て方やレビューなどの詳細を確認できます。

<img width="700" alt="show" src="https://github.com/user-attachments/assets/ee0e9903-c292-42b3-ba2e-a96450f477e7" />

　↓ 個数を選択して「注文する」をクリック

--**3. 注文確認画面**: confirm.php

注文内容と合計金額を確認します。

<img width="500" alt="confirm" src="https://github.com/user-attachments/assets/c286ec77-937f-4c75-8295-fcd19bfbdeb2" />


## 🛠 使用技術
-**Language**: PHP 8.x

-**Database**: MySQL 8.0 (MariaDB) / ポート 3306

-**Frontend**: HTML5, CSS3

-**Concept**: オブジェクト指向プログラミング (OOP) / データベース連携

💡 こだわったポイント
- **データベース連携**: 従来、配列で管理していた商品情報をMySQLへ移行。SQLを用いて効率的にデータを取得する構造に改善しました。

## オブジェクト指向の活用:

-**クラスの継承**: Menu クラスを親とし、Plant と Goods で継承を行うことで、共通処理を効率化。

-**カプセル化**: プロパティに private / protected を使用し、ゲッター・セッター経由で操作。

-**動的な条件分岐**: instanceof を用いて、取得したデータが「植物」か「用品」かを判定し、それぞれに最適なレイアウトを出し分けています。

## 🔧 セットアップ
## 1. データベースの構築
MySQLにログインし、以下のSQLを実行してデータベースとテーブルを作成してください。

SQL
CREATE DATABASE IF NOT EXISTS green_shop_db CHARACTER SET utf8mb4;
USE green_shop_db;

```SQL
-- メニューテーブル（植物・用品 共通）
CREATE TABLE IF NOT EXISTS menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255),
    type ENUM('plant', 'goods') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

-- 必要に応じてレビューテーブルや初期データ（INSERT文）をここに追記
## 2. 環境設定
config.php（またはDB接続箇所）を、ご自身の環境に合わせて編集してください。

Host: 127.0.0.1

Port: 3306

DB Name: green_shop_db

## 3. 実行
本リポジトリを C:\xampp\htdocs\green-shop-app に配置。

XAMPPの Apache および MySQL を起動。
