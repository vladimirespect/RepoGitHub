<?php

namespace app\models\entities;
use app\models\Model;

class Gallery extends Model
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

}