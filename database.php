<?php

//Databaseクラス
class Database{
    //PDOのインスタンスを生成する関数
    public function CreatePDO(){
        $dsn='mysql:host=localhost;dbname=green_plant_shop;charset=utf8';
        $user='root';
        $password='';
        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        }catch (PDOException $e){
            exit('エラー:' . $e->getMessage());
        }
        return $db;
    }
 }
?>