<?php

namespace app\models;

class Orders extends DbModel
{
    public $id = null;
    public $name;
    public $phone;
    public $session_id;
    public $status;
    // public $id_;//поле для будущих связей

    public function __construct($name = null, $phone = null, $session_id = null, $status = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->session_id = $session_id;
        $this->status = $status;
    }


    public static function getTableName() {
        return 'orders';
    }

}