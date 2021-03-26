<?php


namespace app\models\repositories;


use app\engine\Db;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{

    protected function getEntityClass() {
        return Basket::class;
    }


    protected function getTableName()
    {
        return 'basket';
    }

    public function getBasket($session_id) {
        $params["session_id"] = $session_id;
        $sql = "SELECT basket.id as basket_id, goods.id as goods_id, goods.name as name, goods.image as image, goods.price as price, goods.description as 
description FROM basket, goods WHERE basket.goods_id=goods.id AND session_id= :session_id";
        return Db::getInstance()->queryAll($sql, $params);
    }

}