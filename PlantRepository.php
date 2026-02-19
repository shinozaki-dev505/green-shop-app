<?php
declare(strict_types=1);
require_once('database.php');

class PlantRepository{
    private PDO $pdo;
    private string $table_name = 'plant';

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function fetchAll():array {
        $stmt = $this->pdo->query("SELECT * FROM plant");
        $plant=[];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $plant[]= new Plant(
                    $row['name'],
                    (int)$row['price'],
                    $row['image'],
                    $row['place']
                );
            }
            return $plant;
    }   
}
?>
