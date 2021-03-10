<?php

namespace app\models;

class Feedback extends Model
{
    public $id;
    public $name;
    public $feedback;
    // public $id_;//поле для будущих связей

    public function __construct($name = null, $feedback = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
    }


    public function getTableName() {
        return 'feedback';
    }

}