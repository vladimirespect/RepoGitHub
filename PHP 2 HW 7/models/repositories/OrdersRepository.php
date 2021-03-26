<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\Orders;

class OrdersRepository extends Repository
{

    protected function getTableName()
    {
        return 'orders';
    }

    protected function getEntityClass()
    {
        return Orders::class;
    }

    public function getOrderAmount() {

    }
}