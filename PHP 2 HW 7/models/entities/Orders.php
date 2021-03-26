<?php

namespace app\models\entities;
use app\models\Model;

class Orders extends Model
{
    protected $id = null;
    protected $name;
    protected $phone;
    protected $session_id;
    protected $orderAmount;
    protected $status;
    // public $id_;//поле для будущих связей

    protected $props = [
        'name' => false,
        'phone' => false,
        'session_id' => false,
        'orderAmount' => false,
        'status' => false
    ];

    public function __construct($name = null, $phone = null, $session_id = null, $orderAmount = null, $status = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->session_id = $session_id;
        $this->orderAmount = $orderAmount;
        $this->status = $status;
    }

}