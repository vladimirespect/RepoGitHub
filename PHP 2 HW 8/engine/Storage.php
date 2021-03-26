<?php


namespace app\engine;


class Storage
{
    //в этом классе будут сохраниться тела компонентов,
    //изначально он будет пустой, но при первом обращении, благодаря магическому Гет
    //мы будем его заполнять
    protected $items = []; //['db' => new Db(), 'request' => new Request()]

    /*
     public function set($key, $object) {
        $this->items[$key] = $object; //в элемент массива добавляем объект
    }
     */

    public function get($key) {
        if(!isset($this->items[$key])) { //проверяем был ли создан экземпляр класса или нет
            $this->items[$key] = App::call()->createComponent($key); //создаём новый компонент
        }
        return $this->items[$key];
    }
}