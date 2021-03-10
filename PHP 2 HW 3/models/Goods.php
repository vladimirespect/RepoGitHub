<?php

namespace app\models;

class Goods extends Model
{
    public $id;
    public $name;
    public $image;
    public $description;
    public $price;
    // public $id_;//поле для будущих связей

    public function __construct($name = null, $image = null, $description = null, $price = null)
    {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
    }


    public function getTableName() {
        return 'goods';
    }

}