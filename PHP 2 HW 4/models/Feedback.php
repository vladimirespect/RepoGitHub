<?php

namespace app\models;

class Feedback extends DbModel
{
    public $id = null;
    public $name;
    public $feedback;
    // public $id_;//поле для будущих связей

    public function __construct($name = null, $feedback = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
    }


    public static function getTableName() {
        return 'feedback';
    }

}