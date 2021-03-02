<?php

namespace app\my_models;

use app\models\Model;

class Feedback extends Model
{
    public $id;
    public $name;
    public $feedback;

    public function getTableName() {
        return 'feedback';
    }

}