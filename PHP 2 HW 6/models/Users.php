<?php

namespace app\models;

use app\engine\Request;

class Users extends DbModel
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

   // echo password_hash("123", PASSWORD_DEFAULT);
    public static function  auth($login, $pass) {
        $user = Users::getWhere('login', $login);
        if (password_verify($pass,$user->pass)) {
            $_SESSION['auth']['login'] = $login; //поскольку в сессии могут быть одинаковые имена уточняем двумерным массивом
            $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

//(new Request())->getParams()['hash']
//if (isset($_COOKIE["hash"]) && !isset($_SESSION['login'])) {
//               $hash = $_COOKIE["hash"];

// if (isset((new Request())->getParams()['hash']) && !isset($_SESSION['login'])) {
//              $hash = (new Request())->getParams()['hash'];



   public static function  isAuth() { //авторизован ли кто? Есть ли сессия?
       if (isset((new Request())->getParams()['hash']) && !isset($_SESSION['login'])) {
              $hash = (new Request())->getParams()['hash'];
               $user = Users::getWhere('hash', $hash);
               if($user) { //если такой хэш найдётся извлекаем запись из БД
                       $_SESSION['auth']['login'] = $user->login;
               }
           }
       return isset($_SESSION['auth']['login']);
     }

   public static function getName() {
        return $_SESSION['auth']['login'];
   }


    public static function getTableName() {
        return 'users';
    }
}
/*
if (isset($_GET['logout'])) {
    session_destroy(); //удалит связь с сервером, а потом сервер удалит файл
    //session_regenerate_id(); - заменит id сессии
    header("Location: /");
    die();
}

if ($_POST['login']) {
    $login = $_POST['login'];
    $pass = $_POST['pass']; Вынесено в authController /actionLogin


function getUser() {
    return $_SESSION['auth']['login'];
}

/*function Buy($id) {
    $_SESSION['basket'][] = $id;
}


 */