<?php
require_once 'database.php';
require_once 'plant.php';
require_once 'goods.php';

class MenuRepository {
    private $db;

    public function __construct() {
        // database.php の Database クラスを利用
        $this->db = (new Database())->CreatePDO();
    }

    /**
     * すべてのメニューを最新順で取得
     */
    public function findAll() {
        // type(plant優先)＋created_at DESC で新しい順にソート
        $stmt = $this->db->query("SELECT * FROM menus ORDER BY type ASC, created_at DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $menus = [];
        foreach ($results as $data) {
            $menus[] = $this->instantiate($data);
        }
        return $menus;
    }

    /**
     * IDを指定して1件取得（詳細画面用）
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM menus WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? $this->instantiate($data) : null;
    }

    /**
     * DBのデータから適切なクラス（Plant/Goods）のインスタンスを作る
     */
    private function instantiate($data) {
        if ($data['type'] === 'plant') {
            return new Plant(
                $data['id'],
                $data['name'],
                $data['image'],
                $data['price'],
                $data['type'],
                $data['detail'],
                $data['created_at'] // コンストラクタに受け渡し
            );
        } else {
            return new Goods(
                $data['id'],
                $data['name'],
                $data['image'],
                $data['price'],
                $data['type'],
                $data['detail'],
                $data['created_at']
            );
        }
    }

    public function delete($id) {
        // 1. まず子である「orders」から、この商品に関連するデータを消す
        $stmt_orders = $this->db->prepare('DELETE FROM orders WHERE menu_id = ?');
        $stmt_orders->execute([$id]);

        // 2. その後、親である「menus」から商品を消す
        $stmt = $this->db->prepare('DELETE FROM menus WHERE id = ?');
        return $stmt->execute([$id]);
    }

    //引数$detail追加
    public function Insert($name, $price, $image, $type, $detail){
        try{
        //SQLの準備（INSERT文）
            $stmt = $this->db->prepare("INSERT INTO menus (name,price,image,type,detail)VALUES (:name, :price, :image, :type, :detail)");
        
            //値をセット
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':image',$image, PDO::PARAM_STR);
            $stmt->bindValue(':type',$type, PDO::PARAM_STR); 
            $stmt->bindValue(':detail',$detail, PDO::PARAM_STR); 

            //実行
            $stmt->execute();
        }catch (PDOException $e){
            die("データベース登録エラー: " . $e->getMessage());
        }
 
    }

}