<?php

namespace app\models;

class Users extends DbModel
{
    public $id = null;
    public $login;
    public $pass;
    public $hash;
    // public $id_;//поле для будущих связей

    public function __construct($login = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }


    public static function getTableName() {
        return 'users';
    }
}