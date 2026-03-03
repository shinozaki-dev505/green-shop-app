# 植物・園芸用品ショップアプリ (Green Plant Shop App)

植物や園芸用品の閲覧、詳細確認、注文シミュレーションに加え、**管理者・一般スタッフによる権限管理**を備えた本格的なショップ管理システムです。Progateの学習をベースに、実務で必須となる「認証」と「認可」の仕組みを独自に組み込みました。

## 🚀 主な機能

### 👤 ユーザー認証・権限管理 (New!)
* **ログイン/ログアウト機能**: セッション管理に基づいたセキュアな認証システム。
* **権限別UI制御 (ACL)**:
    * **管理者 (Admin)**: 商品の新規登録、削除、売上データの閲覧など全操作が可能。
    * **一般スタッフ (Staff)**: 商品の閲覧と注文操作のみに制限（削除ボタンや管理メニューを非表示化）。
* **アクセスガード**: 未ログイン状態や権限不足のユーザーによるURL直接アクセスをサーバー側でブロック。

### 📋 ショップ・管理機能
* **動的なメニュー一覧**: MySQLから「植物 → 園芸用品」の順かつ新着順にソートして表示。
* **売上明細管理 (`sales.php`)**: 注文履歴のリアルタイム確認と履歴削除機能。
* **売れ筋ランキング (`ranking.php`)**: 販売個数に基づいた人気商品の動的集計・表示。
* **レビューシステム**: データベースからユーザーレビューを性別アイコン付きで動的に表示。
* **注文シミュレーション**: 複数商品の購入個数に応じた税込合計金額を一括算出。

## 📸 画面構成

1. **ログイン画面 (`login.php`)**

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/de1090d7-ab93-4c43-b9f4-57982f7c8261" />

2. **メニュー一覧画面 (`index.php`)** *権限に応じて「ゴミ箱」や「新規登録」ボタンが出現*

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/89527655-87a2-440a-98e6-1f68af88760e" />

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/4d40d228-568e-42be-89f4-519402faac37" />

3. **売上管理 (`sales.php`)** *管理者専用の注文履歴確認画面*

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/ba512a90-72a4-4312-ac2a-39b2c8de0e1b" />

4. **売れ筋ランキング (`ranking.php`)**

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/7d478be3-7994-403e-aefe-d0e7e83cdcbf" />


## 🛠 使用技術

* **Language**: PHP 8.x
* **Database**: MySQL 8.0 (MariaDB)
* **Design**: CSS3 (Flexbox, Absolute Positioning)
* **Security**: セッション管理、`htmlspecialchars` によるXSS対策、権限バリデーション
* **Architecture**: オブジェクト指向 (OOP) / リポジトリパターン

## 💡 こだわったポイント

* **レイアウトの整合性**:
  CSSの `vertical-align: top` や `position: absolute` を駆使し、権限によって削除ボタンが非表示になっても商品カードの高さや画像の位置がズレない、プロ仕様のグリッドデザインを実現しました。
* **データベース設計と集計**: 
  `OrderRepository` を新設し、注文データと商品データをリレーショナルに管理。複雑なランキング集計クエリもSQL側で最適化して処理しています。
* **堅牢なコード構造**:
  `auth.php` による認証ロジックの共通化や、`instanceof` を用いた動的なクラス判定による条件分岐など、保守性の高い設計を意識しました。

## 🔧 セットアップ

### 1. データベースの構築
`database.sql` を実行し、必要なテーブル（`menus`, `users`, `orders`）を作成・初期化してください。

```sql
CREATE DATABASE IF NOT EXISTS green_shop_db CHARACTER SET utf8mb4;
USE green_shop_db;
```

-- 詳細は付属の database.sql を参照してください


