<?php


namespace app\models\repositories;


use app\engine\App;
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
            App::call()->session->set('login', $login);
            // $_SESSION['auth']['login'] = $login; //поскольку в сессии могут быть одинаковые имена уточняем двумерным массивом
            App::call()->session->set('id', $user->id);
            //$_SESSION['auth']['id'] = $user->id;
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
        $login = App::call()->session->get('login');
        if (isset(App::call()->request->getParams()['hash']) && !isset($login)) {
            $hash = App::call()->request->getParams()['hash'];
            $user = $this->getWhere('hash', $hash);//если такой хэш найдётся извлекаем запись из БД
            if ($user) {
                App::call()->session->set('login', $user->login);
            }
        }
        return isset($login);
    }

    public function getName()
    {
        return App::call()->session->get('login');
    }

    public function isAdmin()
    {
        $login = App::call()->session->get('login');
        $hash = App::call()->request->getParams()['hash'];
        $user = $this->getWhere('hash', $hash);
        if(isset($user) && $login == 'admin') {
            return true;
        } else {
            return false;
        }
    }

}



