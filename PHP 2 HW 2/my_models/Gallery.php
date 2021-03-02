<?php

namespace app\my_models;

use app\models\Model;

class Gallery extends Model
{
    public $id;
    public $name;
    public $likes;

    public function getTableName() {
        return 'gallery';
    }

}