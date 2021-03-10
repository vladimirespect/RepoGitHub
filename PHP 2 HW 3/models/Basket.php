<?php

namespace app\models;

class Basket extends Model
{
    public $id;
    public $session_id;
    public $goods_id;
   // public $id_;//поле для будущих связей

//	Alt + Insert	Сгенерировать код… (getter-ы, setter-ы, конструкторы) не забывать удалять РНР док который нужен был бы для шторма если бы мы явно не указывали переменные в полях
    public function __Construct($session_id = null, $goods_id = null) { //здесь задано значение по умолчанию null,
        // потому что в противном случае мы не смогли бы создавать с главной страницы новые объекты без указания параметров, а передавать пустые параметры- лишняя трата времени
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }

    public function getTableName() {
        return 'basket';
    }

}