<?php
declare(strict_types=1);
require_once('database.php');

class GoodsRepository{
    private PDO $pdo;
    private string $table_name = 'goods';

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function fetchAll():array {
        $stmt = $this->pdo->query("SELECT * FROM goods");
        $goods=[];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $goods[]= new Goods(
                    $row['name'],
                    (int)$row['price'],
                    $row['image'],
                    $row['difficulty']
                );
            }
            return $goods;
    }
}
?>