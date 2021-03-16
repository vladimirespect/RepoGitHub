<?php

namespace app\models;

use app\engine\Db;

class Basket extends DbModel
{
    protected $id = null;
    protected $session_id;
    protected $goods_id;
   // public $id_;//поле для будущих связей

    protected $props = [
        'session_id' => false,
        'goods_id' => false
    ];

//	Alt + Insert
    public function __Construct($session_id = null, $goods_id = null) { //здесь задано значение по умолчанию null,
        // потому что в противном случае мы не смогли бы создавать с главной страницы новые объекты без указания параметров, а передавать пустые параметры- лишняя трата времени
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }

    public static function getBasket($session_id) {
        $params["session_id"] = $session_id;
        $sql = "SELECT basket.id as basket_id, goods.id as goods_id, goods.name as name, goods.image as image, goods.price as price, goods.description as 
description FROM basket, goods WHERE basket.goods_id=goods.id AND session_id= :session_id";
       return Db::getInstance()->queryAll($sql, $params);
    }

    public static function getTableName() {
        return 'basket';
    }

}