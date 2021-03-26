<?php

namespace app\models\entities;
use app\models\Model;

class Orders extends Model
{
    protected $id = null;
    protected $name;
    protected $phone;
    protected $email;
    protected $session_id;
    protected $orderAmount;
    protected $status;

    protected $props = [
        'name' => false,
        'phone' => false,
        'email' => false,
        'session_id' => false,
        'orderAmount' => false,
        'status' => false
    ];

    public function __construct($name = null, $phone = null, $email = null, $session_id = null, $orderAmount = null, $status = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->session_id = $session_id;
        $this->orderAmount = $orderAmount;
        $this->status = $status;
    }

}