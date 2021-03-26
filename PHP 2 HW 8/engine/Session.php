<?php


namespace app\engine;


class Session
{
//начинаем с того что прописываем все возможные функции обращения к сессии в методы этого класса

    public function start() {
        session_start();
    }

    public function destroy() {
        session_destroy();
    }

    public function regenerate(){
        session_regenerate_id();
    }

    public function getId() {
        return session_id();
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key){
        return $_SESSION[$key];
    }

}