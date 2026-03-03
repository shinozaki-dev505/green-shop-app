<?php
require_once('database.php');

class OrderRepository{
    private $pdo;

    public function __construct(){
        $this->pdo = (new Database())->CreatePDO();
    }

    // 注文内容を1件ずつ保存するメソッド
    public function insert($menuId, $quantity, $totalPrice){
        $stmt = $this->pdo->prepare("
            INSERT INTO orders(menu_id, quantity, total_price)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$menuId, $quantity, $totalPrice]);
    }

    public function findAllwithName(){
        //JOINを使って、ordersとmenusを結合させて取得する SQL
        $sql ="
            SELECT orders.*, menus.name AS menu_name
            FROM orders
            JOIN menus ON orders.menu_id = menus.id
            ORDER BY orders.ordered_at DESC
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //合計金額を表示する
    public function getTotalSaleAmount(){
        $sql="SELECT SUM(total_price) AS total FROM orders";
        $stmt=$this->pdo->query($sql);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    //売上ランキング
    public function getRanking(){
        $sql = "SELECT menus.name, SUM(orders.quantity) AS total_quantity
                FROM orders
                JOIN menus ON orders.menu_id = menus.id
                GrOUP BY orders.menu_id
                ORDER BY total_quantity DESC
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //売上明細一覧に削除機能追加
    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id=? ");
        $stmt->execute([$id]);
    }

    //日付検索
    public function findByDate($date){
        $sql = "SELECT orders.*, menus.name AS menu_name
                FROM orders
                JOIN menus ON orders.menu_id = menus.id
                WHERE DATE(orders.ordered_at)=?
                ORDER BY orders.ordered_at DESC";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    }
}
?>