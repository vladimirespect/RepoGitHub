<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Goods;

class GoodsRepository extends Repository
{

    protected function getTableName()//protected убирать на время тестирования через PHP-unit
    {
        return 'goods';
    }

    protected function getEntityClass()
    {
        return Goods::class;
    }
}