<?php


namespace app\models\example;


abstract class MotherOfProducts
{
    protected $name= '';
    public $price;
    protected $quantity;


    public function __construct($name, $price, $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }


    public static $summ;
    static public function getSumm($result) {
        static::$summ +=  $result;
    }

    abstract public function calc();
}