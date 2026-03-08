```mermaid
erDiagram
    USERS ||--o{ ORDERS : "1対多（一人が何度も注文する）"
    MENUS ||--o{ ORDERS : "1対多（一つの商品が何度も注文される）"

    USERS {
        int id PK "連番ID"
        string user_id "ログインID (Unique)"
        string password "ハッシュ化パスワード"
        string name "表示名"
        timestamp created_at "登録日時"
    }

    MENUS {
        int id PK "連番ID"
        string name "商品名"
        int price "価格"
        string image "画像パス"
        string type "商品種別 (plant/goods)"
        string detail "詳細情報 (屋内屋外/おすすめ度)"
        timestamp created_at "登録日時"
    }

    ORDERS {
        int id PK "連番ID"
        int user_id_int FK "ユーザーID"
        int menu_id FK "商品ID"
        int count "注文数"
        timestamp order_date "注文日時"
    }
    