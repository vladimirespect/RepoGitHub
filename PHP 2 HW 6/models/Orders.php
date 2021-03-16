<?php

namespace app\models;

class Orders extends DbModel
{
    protected $id = null;
    protected $name;
    protected $phone;
    protected $session_id;
    protected $status;
    // public $id_;//поле для будущих связей

    protected $props = [
        'name' => false,
        'phone' => false,
        'session_id' => false,
        'status' => false
    ];

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