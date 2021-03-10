<?php

namespace app\models;

class Gallery extends DbModel
{
    public $id = null;
    public $name;
    public $likes;
    // public $id_;//поле для будущих связей

    public function __construct($name = null, $likes = null)
    {
        $this->name = $name;
        $this->likes = $likes;
    }


    public static function getTableName() {
        return 'gallery';
    }

}