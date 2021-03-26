<?php

namespace app\controllers;

use app\engine\App;

class AuthController extends Controller
{
    public function actionLogin() {
        //action="/auth/login" в форме ввода и методом пост сюда передаём данные
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];

        //Request класс избавил нас от этого кода
        /*$login = $_POST['login'];
        $pass = $_POST['pass'];*/

        if(App::call()->usersRepository->auth($login, $pass)) {
            if (isset(App::call()->request->getParams()['save'])) {
                $hash = uniqid(rand(), true);
                $id = App::call()->session->get('id'); //чтобы поменять юзеру хэш в бд
                $user = App::call()->usersRepository->getOne($id);
                $user->hash = $hash;
                App::call()->usersRepository->save($user);

                setcookie("hash", $hash, time() + 3600, "(/)");
            }
            header("Location:" . $_SERVER['HTTP_REFERER']);//это системная переменная а не пользоват.данные
            die();
        } else {
            die("Не верный логин/пароль");
        }
    }

    public function actionLogout() {
        App::call()->session->regenerate();
        App::call()->session->destroy(); //удалит связь с сервером, а потом сервер удалит файл
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
    }
}