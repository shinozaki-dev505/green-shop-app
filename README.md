# 植物・園芸用品ショップアプリ (Green Plant Shop App)

植物や園芸用品の閲覧、詳細確認、注文シミュレーションに加え、**管理者・一般スタッフによる権限管理**を備えた本格的なショップ管理システムです。Progateの学習をベースに、実務で必須となる「認証」と「認可」の仕組みを独自に組み込みました。

## 🌟 2026年5月 アップデート: 外部API連携 ＆ アーキテクチャ刷新
システムの機能拡張と保守性・セキュリティ向上のため、以下の大幅なリファクタリングを実施しました。

1. **外部API（気象庁データ）との動的連携**:
   * `public/weather.php` を新設し、気象庁の公開JSONデータを素のPHP（`file_get_contents` / `json_decode`）で取得。
   * トップページ（`public/index.php`）の看板下に「お天気案内ボックス」をインフォメーションとして集約。
   * **「晴れの日はサボテン、雨の日は室内向け観葉植物」**のように、リアルタイムの天候に応じた接客（動的なレコメンド機能）を文字列表現の検索処理を用いて実装しました。
2. **公開領域と非公開領域の分離**: 
   * ユーザーが直接アクセスする `public/` と、システムの核（クラス定義など）となる `src/` を厳密に分離。
3. **堅牢なパス管理**: 
   * `__DIR__` を活用し、今後のディレクトリ階層変更やプロジェクト移動に左右されない安全なファイル読み込みを実現。

## 🚀 主な機能

### 👤 ユーザー認証・権限管理
* **ログイン/ログアウト機能**: セッション管理に基づいた認証システム。
* **権限別UI制御 (ACL)**:
    * **管理者 (Admin)**: 商品の新規登録、削除、売上データの閲覧、新規ユーザー登録が可能。
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
├── auth/                 # 認証関連（非公開領域へのゲートウェイ）
│   ├── login.php        # ログイン画面
│   ├── logout.php       # ログアウト処理
│   └── register.php     # 新規スタッフ登録画面
├── db/                  # データベース関連
│   ├── database.sql     # テーブル設計SQL
│   └── erDiagram.md     # ER図（設計ドキュメント）
├── public/              # ブラウザからアクセスする公開領域
│   ├── index.php        # メインメニュー画面（お天気ボックス連動）
│   ├── weather.php      # 気象庁APIデータ取得処理
│   ├── assets/          # CSS・画像リソース
│   │   ├── css/stylesheet.css
│   │   └── images/      # 商品画像
│   ├── products/        # 商品操作画面
│   │   ├── new.php      # 新規商品登録
│   │   ├── confirm.php  # 注文確認
│   │   ├── show.php     # 商品詳細
│   │   └── delete.php   # 商品削除処理
│   └── sales/           # 売上管理画面（管理者専用）
│       ├── sales.php    # 売上明細
│       └── ranking.php  # 売れ筋ランキング
├── src/                 # ロジック・クラス定義（外部非公開領域）
│   ├── Database.php     # DB接続クラス
│   ├── Menu.php / Plant.php / Goods.php # オブジェクト定義（継承・ポリモーフィズム）
│   └── MenuRepository.php / OrderRepository.php # データ操作（リポジトリパターン）
└── README.md
```

## 📸 画面構成

1. **ログイン画面 (`auth/login.php`)**

  <img width="350" height="500" alt="image" src="https://github.com/user-attachments/assets/00395985-78d9-4a5a-9090-f0babf67768d" />

2. **スタッフ登録画面 (`auth/register.php`) ※今回、UIデザインを刷新しました**

  <img width="350" height="500" alt="image" src="https://github.com/user-attachments/assets/8e6cd8c9-0232-44b2-acfc-5a5766d6d246" />

3. **メニュー一覧画面 (`public/index.php`)** *管理者権限時のみ「削除アイコン」や「管理メニュー」が表示されます。*

  <img width="2376" height="3822" alt="localhost_green-shop-app_public_index php(iPad Pro)_weather" src="https://github.com/user-attachments/assets/3a2971cf-2d1a-43e2-82a8-af4102371284" />

4. **新商品を登録する (`public/products/new.php`) **

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/d3a0396f-8cc6-4589-936b-a41c7426f9f1" />

5. **売上管理 (`public/sales/sales.php`)** *管理者専用の注文履歴確認画面*

   <img width="500" height="500" alt="image" src="https://github.com/user-attachments/assets/ba512a90-72a4-4312-ac2a-39b2c8de0e1b" />

6. **売れ筋ランキング (`public/sales/ranking.php`)**

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



