<?php

namespace app\models\entities;

use app\models\Model;

class Feedback extends Model
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

}