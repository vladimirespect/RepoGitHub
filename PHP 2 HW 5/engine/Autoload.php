<?php

namespace app\engine;
//имя класса с большой буквы, методы класса с маленькой
class Autoload
{
    /*private $path = [
        'models',
        'engine'
    ];*/


    public function loadClass($className) { //перед тем как сгенерировать ошибку и вывести фатал на экран, в момент обращения к классу который мы забыли подключить, эта функция перехваатывает сигнал и возвращает имя класса который мы не подключили
        $fileName = str_replace(['app', '\\'] , [ROOT_DIR, DS], $className) . ".php";// DIRECTORY_SEPARATOR вместо '/' будет подставлять нужный слэш в зависимости от ОС линукс или винда
        if (file_exists($fileName)) {
            include $fileName;
        }
        /*foreach($this->path as $path){
          $fileName = "../{$path}/{$className}.php";
          if (file_exists($fileName)) {
              include $fileName;
          }
        }*/
          //функция устарела, вместо неё уже надо использовать эту spl_autoload_register() //НУЖЕН АБСОЛЮТНЫЙ ПУТЬ ЧЕРЕЗ ДОКУМЕНТ РУТ
    }

}