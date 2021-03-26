<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Goods;

class GoodsRepository extends Repository
{

    public function getTableName()//protected убрано на время тестирования через PHP-unit
    {
        return 'goods';
    }

    protected function getEntityClass()
    {
        return Goods::class;
    }
}