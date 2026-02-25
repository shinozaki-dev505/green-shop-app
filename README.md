# 植物・園芸用品ショップアプリ (Green Plant Shop App)

植物や園芸用品の閲覧、詳細情報の確認、および注文シミュレーションができるWebアプリケーションです。
Progateの学習内容をベースに、オブジェクト指向（OOP）とMySQLデータベースを組み合わせ、実務に近い動的なシステムへと進化させました。

## 🚀 主な機能

* **動的なメニュー一覧**: MySQLから取得した商品を「植物」→「園芸用品」の順で、さらに新着順にソートして表示。
* **削除機能 (New!)**: 一覧画面から不要なアイテムを即座に削除可能。
* **詳細情報の閲覧**: アイテムごとの育て方、難易度、レビューなどの詳細を確認。
* **レビュー表示**: データベースに保存されたユーザーレビューを性別アイコン付きで動的に表示。
* **注文シミュレーション**: 複数商品の購入個数に応じた税込合計金額を一括算出。

## 📸 画面構成

1.  **メニュー一覧画面 (`index.php`)**: 商品一覧と削除機能、個数入力。
   
   <img width="500" height="600" alt="image" src="https://github.com/user-attachments/assets/cd2ddd8c-03cb-4fd0-b11c-c216176752fc" />

2.  **商品詳細画面 (`show.php`)**: 詳細情報とレビューの閲覧。

   <img width="500" height="600" alt="image" src="https://github.com/user-attachments/assets/d1e193d5-11e2-4c15-b1ae-92c9d6fc9d1c" />

3.  **注文確認画面 (`confirm.php`)**: 選択した全商品の明細と合計金額の表示。

   <img width="400" height="400" alt="image" src="https://github.com/user-attachments/assets/dd54bccb-e525-4c4b-834a-372190d1cfc5" />

## 🛠 使用技術

* **Language**: PHP 8.x
* **Database**: MySQL 8.0 (MariaDB)
* **Version Control**: Git / GitHub
* **Concept**: オブジェクト指向プログラミング (OOP) / リポジトリパターン

## 💡 こだわったポイント

* **UI/UXの向上**: 
    * CSSの絶対配置 (`position: absolute`) を活用し、商品画像の上に削除ボタン（ゴミ箱アイコン）を配置。
    * フォームの入れ子問題を解消し、一括注文と個別削除が競合しない構造を設計。
* **データベース設計と効率的な取得**: 
    * `ORDER BY FIELD` 等のSQLクエリを用い、プログラム側での並び替え負荷を軽減。
    * リポジトリパターンを採用し、DB操作ロジックを分離して保守性を向上。
* **オブジェクト指向の深化**:
    * `instanceof` を用いた動的なクラス判定によるレイアウトの出し分け。
    * カプセル化による安全なデータアクセス。

## 🔧 セットアップ

### 1. データベースの構築
以下のSQLを実行してデータベースとテーブルを作成してください。

```sql
CREATE DATABASE IF NOT EXISTS green_shop_db CHARACTER SET utf8mb4;
USE green_shop_db;

CREATE TABLE IF NOT EXISTS menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255),
    type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 2. 環境設定
database.php をご自身の環境（Host, Port, User, Password）に合わせて編集してください。
