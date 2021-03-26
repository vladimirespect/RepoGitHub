<?php


namespace app\models\repositories;


use app\engine\{Request, Session};
use app\models\Repository;
use app\models\entities\Users;


class UsersRepository extends Repository
{

    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityClass()
    {
        return Users::class;
    }

    // echo password_hash("123", PASSWORD_DEFAULT);
    public function auth($login, $pass)
    {
        $user = $this->getWhere('login', $login);
        if (password_verify($pass, $user->pass)) {
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


    public function isAuth()
    { //авторизован ли кто? Есть ли сессия?
        $session = new Session();
        $session = $session->get('login'); //TODO если что не работает с save session искать ошибку здесь
        if (isset((new Request())->getParams()['hash']) && !isset($session)) {
            $hash = (new Request())->getParams()['hash'];
            $user = $this->getWhere('hash', $hash);//если такой хэш найдётся извлекаем запись из БД
            if ($user) {
                $_SESSION['auth']['login'] = $user->login;
            }
        }
        return isset($_SESSION['auth']['login']);
    }

    public function getName()
    {
        return $_SESSION['auth']['login'];
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
