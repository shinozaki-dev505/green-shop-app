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
                $data['created_at'] // コンストラクタに受け渡し
            );
        } else {
            return new Goods(
                $data['id'],
                $data['name'],
                $data['image'],
                $data['price'],
                $data['created_at']
            );
        }
    }

    public function delete($id) {
        // 1. まず、削除対象のデータを取得（画像パスを知るため）
        $menu = $this->findById($id);
        
        if ($menu) {
            $imagePath = $menu->getImage();
            // 2. サーバー内の画像ファイルを削除（unlink関数）
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // 3. データベースからレコードを削除
        $stmt = $this->db->prepare("DELETE FROM menus WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function Insert($name, $price, $image, $type){
        //SQLの準備（INSERT文）
        $stmt = $this->db->prepare("INSERT INTO menus (name,price,image,type)VALUES (:name, :price, :image, :type)");
    
        //値をセット
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':image',$image, PDO::PARAM_STR);
        $stmt->bindValue(':type',$type, PDO::PARAM_STR); 
    
        //実行
        $stmt->execute();
    }

}