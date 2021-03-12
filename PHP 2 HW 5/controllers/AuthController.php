<?php


namespace app\controllers;

use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin() {
        //action="/auth/login" в форме ввода и методом пост сюда передаём данные
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if(Users::auth($login, $pass)) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
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