<?php

namespace app\models;

class Gallery extends Model
{
    public $id;
    public $name;
    public $likes;
    // public $id_;//поле для будущих связей

    public function __construct($name = null, $likes = null)
    {
        $this->name = $name;
        $this->likes = $likes;
    }


    public function getTableName() {
        return 'gallery';
    }

}