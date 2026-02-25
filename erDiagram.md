```mermaid
erDiagram
    PLANT ||--o{ GROWTH_LOG : "1対多（1つの植物に複数の記録）"
    
    PLANT {
        string name "植物名"
        string species "種類"
        date purchase_date "購入日"
    }

    GROWTH_LOG {
        string photo_url "写真の保存場所"
        string comment "状態メモ"
        datetime recorded_at "記録日時"
    }
    