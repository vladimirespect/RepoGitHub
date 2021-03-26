<?php

namespace app\models\entities;
use app\models\Model;

class Goods extends Model
{
    public $id = null;
    protected $name;
    protected $image;
    protected $description;
    protected $price;
    // public $id_;//поле для будущих связей

    protected $props = [
        'name' => false,
        'image' => false,
        'description' => false,
        'price' => false
    ];

    public function __construct($name = null, $image = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
    }

}