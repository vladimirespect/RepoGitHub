<?php

namespace app\my_models;

use app\models\Model;

class Users extends Model
{
    public $id;
    public $login;
    public $pass;
    public $hash;

    public function getTableName() {
        return 'users';
    }
}