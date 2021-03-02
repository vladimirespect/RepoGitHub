<?php

//штучный
namespace app\models\example;


class Product extends MotherOfProducts
{
    public function calc() {
        $result = $this->quantity*$this->price;
        static::getSumm($result);
    return "Итоговая стоимость штучного товара " . $result;
    }
}