<?php

namespace app\models;

class Users extends DbModel
{
    protected $id = null;
    protected $login;
    protected $pass;
    protected $hash;
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

    public static function  auth($login, $pass) {
        $user = Users::getWhere('login', $login);
        if ($pass == $user->pass) {
            $_SESSION['auth']['login'] = $login;
            $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

   public static function  isAuth() { //авторизован ли кто? Есть ли сессия?
    return isset($_SESSION['auth']['login']);
   }

   public static function getName() {
        return $_SESSION['auth']['login'];
   }


    public static function getTableName() {
        return 'users';
    }
}

/*$auth = false;

if (isAuth()) {
    $auth = true;
    $name = getUser();
}

if (isset($_GET['logout'])) {
    session_destroy(); //удалит связь с сервером, а потом сервер удалит файл
    //session_regenerate_id(); - заменит id сессии
    header("Location: /");
    die();
}

if ($_POST['login']) {
    $login = $_POST['login'];
    $pass = $_POST['pass']; Вынесено в authController /actionLogin


    if (auth($login, $pass)) {
        if (isset($_POST['save'])) {
            $hash = uniqid(rand(), true);
            $id = $_SESSION['auth']['id']; //чтобы поменять юзеру хэш в бд
            $sql = "UPDATE users SET hash = '{$hash}' WHERE id = {$id}";
            $result = mysqli_query($db, $sql);
            setcookie("hash", $hash, time() + 3600, "(/)");
        }
        header("Location: /");
        die();
    } else {
        die("Не верный логин/пароль");
    }
}



function auth($login, $pass) {
    global $db;
    $login = mysqli_real_escape_string($db, strip_tags(stripslashes($login)));
    $result = mysqli_query($db, "SELECT * FROM users WHERE login = '{$login}'"); Сделано методом getWhere в DbModels
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row['pass']) { //(password_verify($pass, $row['pass'])) в бд должен быть захешированный пароль
            // Если сравнение успешно, то Авторизация
            $_SESSION['auth']['login'] = $login;//поскольку в сессии могут быть одинаковые имена уточняем двумерным массивом
            $_SESSION['auth']['id'] = $row['id'];
            return true;
        }
    }

    return false;
}


//проверяет авторизован ли кто-то
function isAuth() {
    global $db;
    if (isset($_COOKIE["hash"]) && !isset($_SESSION['login'])) {
        $hash = $_COOKIE["hash"];
        $sql = "SELECT * FROM users WHERE hash = '{$hash}'";
        $result = mysqli_query($db, $sql);
        if($result) { //если такой хэш найдётся извлекаем запись из БД
            $row = mysqli_fetch_assoc($result);
            $user = $row['login'];
            if(!empty($user)) {
                $_SESSION['auth']['login'] = $user;
            }
        }
    }
    return isset($_SESSION['auth']['login']);
}

function getUser() {
    return $_SESSION['auth']['login'];
}

/*function Buy($id) {
    $_SESSION['basket'][] = $id;
}

//BasketCount
$session = session_id();// выдаст ID сессии
$basketCount = mysqli_query($db, "SELECT count(id) as count FROM basket WHERE session_id = '{$session}'");
$count = mysqli_fetch_assoc($basketCount)['count'];


 echo password_hash("123", PASSWORD_DEFAULT);
         password_verify($pass, $user->pass);

 */