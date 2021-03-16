<?php


namespace app\controllers;

use app\models\Users;
use app\engine\Request;

class AuthController extends Controller
{
    public function actionLogin() {
        //action="/auth/login" в форме ввода и методом пост сюда передаём данные
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];

        //Request класс избавил нас от этого кода
        /*$login = $_POST['login'];
        $pass = $_POST['pass'];*/


        if(Users::auth($login, $pass)) {
            if (isset((new Request())->getParams()['save'])) {
                $hash = uniqid(rand(), true);
                $id = $_SESSION['auth']['id']; //чтобы поменять юзеру хэш в бд
                $user = Users::getOne($id);
                $user->hash = $hash;
                $user->save();

                setcookie("hash", $hash, time() + 3600, "(/)");
            }
            header("Location:" . $_SERVER['HTTP_REFERER']);//это системная переменная а не пользоват.данные
            die();
        } else {
            die("Не верный логин/пароль");
        }

    }

    public function actionLogout() {
            session_destroy(); //удалит связь с сервером, а потом сервер удалит файл
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
    }

}