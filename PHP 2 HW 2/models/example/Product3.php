<?php

//весовой
namespace app\models\example;


class Product3 extends MotherOfProducts
{
    public function calc() {
        if ($this->quantity < 1000) {
            $result = $this->quantity*$this->price;
            static::getSumm($result);
            return "Итоговая стоимость весового товара " . $result;
        } else {
            $result = $this->quantity*$this->price*0.9;
            static::getSumm($result);
            return "Итоговая стоимость весового товара " . $result;
        }
    }
}