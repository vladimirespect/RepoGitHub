<?php

namespace app\models;

class User extends Model {
    public $login;
    public $pass;
    public $id;

    public function getTableName() {
        return 'users';
    }


}