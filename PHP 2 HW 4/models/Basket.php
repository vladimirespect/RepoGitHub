<?php

namespace app\models;

use app\engine\Db;

class Basket extends DbModel
{
    public $id = null;
    public $session_id;
    public $goods_id;
   // public $id_;//поле для будущих связей

//	Alt + Insert
    public function __Construct($session_id = null, $goods_id = null) { //здесь задано значение по умолчанию null,
        // потому что в противном случае мы не смогли бы создавать с главной страницы новые объекты без указания параметров, а передавать пустые параметры- лишняя трата времени
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }

    public static function getBasket() {
        $sql = "SELECT basket.id as basket_id, goods.id as goods_id, goods.name as name, goods.image as image, goods.price as price, goods.description as 
description FROM basket, goods WHERE basket.goods_id=goods.id AND session_id= :session_id";
       $params["session_id"] = 'ch8niidpi0ccb20e37h7c09f0efs3ip4'; //Пока что задал явно
       return Db::getInstance()->queryAll($sql, $params);
    }

    public static function getTableName() {
        return 'basket';
    }

}