<?php

namespace app\my_models;

use app\models\Model;

class Orders extends Model
{
    public $id;
    public $name;
    public $phone;
    public $session_id;
    public $status;

    public function getTableName() {
        return 'orders';
    }

}