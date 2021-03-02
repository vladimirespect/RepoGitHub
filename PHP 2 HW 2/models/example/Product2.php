<?php

//цифровой
namespace app\models\example;


class Product2 extends MotherOfProducts
{
    public function calc() {
        $result = (($this->quantity*$this->price)/2);
        static::getSumm($result);
        return "Итоговая стоимость цифрового товара " . $result;
    }
}