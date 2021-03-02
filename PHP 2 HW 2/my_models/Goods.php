<?php

namespace app\my_models;

use app\models\Model;

class Goods extends Model
{
    public $id;
    public $name;
    public $image;
    public $description;
    public $price;

    public function getTableName() {
        return 'goods';
    }

}