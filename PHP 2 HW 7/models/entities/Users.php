<?php

namespace app\models\entities;

use app\engine\{Request, Session};
use app\models\Model;

class Users extends Model
{
    protected $id = null;
    protected $login;
    protected $pass;
    protected $hash; //хэш для кнопки save pass с формы
    // public $id_;//поле для будущих связей

    protected $props = [
        'login' => false,
        'pass' => false,
        'hash' => false
    ];

    public function __construct($login = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }
}

