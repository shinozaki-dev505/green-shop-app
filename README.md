# 植物・園芸用品ショップアプリ (Green Plant Shop App)

植物や園芸用品の閲覧、詳細確認、注文シミュレーションに加え、**管理者・一般スタッフによる権限管理**を備えた本格的なショップ管理システムです。Progateの学習をベースに、実務で必須となる「認証」と「認可」の仕組みを独自に組み込みました。

## 🌟 今回のアップデート: アーキテクチャの刷新 (Refactoring)
保守性とセキュリティを向上させるため、ディレクトリ構造を全面的に刷新しました。
* **公開領域と非公開領域の分離**: ユーザーがアクセスする public/ と、システムの核となる src/ を分離。
* **堅牢なパス管理**: `__DIR__` を活用し、ディレクトリ階層の変更に左右されない安全なファイル読み込みを実現。

## 🚀 主な機能

### 👤 ユーザー認証・権限管理
* **ログイン/ログアウト機能**: セッション管理に基づいた認証システム。
* **権限別UI制御 (ACL)**:
    * **管理者 (Admin)**: 商品の新規登録、削除、売上データの閲覧が可能。
    * **一般スタッフ (Staff)**: 閲覧と注文操作のみに制限。
* **アクセスガード**: 未ログインユーザーによる管理画面への直接アクセスをサーバー側でブロック。

### 📋 ショップ・管理機能
* **動的なメニュー一覧**: MySQLから「植物・園芸用品」を新着順にソート表示。
* **商品詳細管理**: 植物（屋内/屋外）や用品（おすすめ度）など、カテゴリーごとの詳細情報を保持。
* **売上・ランキング管理**: `OrderRepository` による動的な集計と、管理者専用の売上明細確認。

## 📂 ディレクトリ構成
実務的なWebアプリケーションの構成を採用しています。

```text
green-shop-app/
├── auth/                # 認証関連
│   ├── login.php        # ログイン画面
│   ├── logout.php       # ログアウト処理
│   └── register.php     # ユーザー登録
├── db/                  # データベース関連
│   ├── database.sql     # テーブル設計SQL
│   └── erDiagram.md     # ER図（設計ドキュメント）
├── public/              # ブラウザからアクセスする公開領域
│   ├── index.php        # メインメニュー画面
│   ├── assets/          # CSS・画像リソース
│   │   ├── css/stylesheet.css
│   │   └── images/      # 商品画像
│   ├── products/        # 商品操作（confirm, new, delete等）
│   └── sales/           # 売上管理（sales, ranking）
├── src/                 # ロジック・クラス定義（非公開領域）
│   ├── Database.php     # DB接続クラス
│   ├── Menu.php / Plant.php / Goods.php # クラス定義
│   └── MenuRepository.php / OrderRepository.php # データ操作
└── README.md
```

## 📸 画面構成

1. **ログイン画面 (`auth/login.php`)**

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/de1090d7-ab93-4c43-b9f4-57982f7c8261" />

2. **メニュー一覧画面 (`public/index.php`)** *管理者権限時のみ「削除アイコン」や「管理メニュー」が表示されます。*

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/89527655-87a2-440a-98e6-1f68af88760e" />

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/d3a0396f-8cc6-4589-936b-a41c7426f9f1" />


3. **売上管理 (`public/sales/sales.php`)** *管理者専用の注文履歴確認画面*

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/ba512a90-72a4-4312-ac2a-39b2c8de0e1b" />

4. **売れ筋ランキング (`public/sales/ranking.php`)**

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/7d478be3-7994-403e-aefe-d0e7e83cdcbf" />


## 🛠 使用技術

* **Language**: PHP 8.x (OOP / 継承・ポリモーフィズムの活用)
* **Database**: MySQL 8.0 (MariaDB)(リレーショナル設計 / 外部キー制約)
* **IDE/Tool**: VS Code,XAMPP
* **Architecture**: 
     * **リポジトリパターン**:データアクセスを独立させ、保守性を向上。
     * **ディレクトリ分離**:public/src 構造によるセキュリティと整理。 

## 💡 こだわったポイント

* **レイアウトの整合性**:
  CSSの vertical-align: top や position: absolute を駆使。権限によって削除ボタンが非表示になっても、商品カードや画像の位置がズレないグリッドデザインを実現しました。
* **データベース設計と集計**: 
  `OrderRepository` を活用し、注文データと商品データをリレーショナルに管理。複雑なランキング集計もSQL側で最適化して処理しています。
  

## 🔧 セットアップ

### 1. データベースの構築
`database.sql` を実行し、必要なテーブル（`menus`, `users`, `orders`）を作成・初期化してください。

```sql
-- db/database.sql を MySQL にインポートしてください
-- (phpMyAdminの「インポート」タブ、または下記コマンド)
SOURCE db/database.sql;
```

### 2. 📸 画面構成のファイル名
ファイルを各フォルダ（`products/`, `sales/`）に移動したので、カッコ内のファイル名を最新の場所に合わせると、より親切になります。

* 1. ログイン画面 (`auth/login.php`) ※もしauthフォルダなら
* 3. 売上管理 (`public/sales/sales.php`)
* 4. 売れ筋ランキング (`public/sales/ranking.php`)

---



