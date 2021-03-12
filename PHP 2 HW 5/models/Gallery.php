<?php

namespace app\models;

class Gallery extends DbModel
{
    protected $id = null;
    protected $name;
    protected $likes;
    // public $id_;//поле для будущих связей

    protected $props = [
        'name' => false,
        'likes' => false
    ];

    public function __construct($name = null, $likes = null)
    {
        $this->name = $name;
        $this->likes = $likes;
    }


    public static function getTableName() {
        return 'gallery';
    }

}