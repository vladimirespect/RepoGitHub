<?php

namespace app\models;

class Feedback extends DbModel
{
    protected $id = null;
    protected $name;
    protected $feedback;
    // public $id_;//поле для будущих связей

    protected $props = [
        'name' => false,
        'feedback' => false
    ];

    public function __construct($name = null, $feedback = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
    }


    public static function getTableName() {
        return 'feedback';
    }

}