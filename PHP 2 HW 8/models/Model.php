<?php


namespace app\models;


abstract class Model //abstract- мы не можем создать экземпляр абстрактного класса есть ещё final-значит нельзя создавать наследников// интерфейсы поддерживают множественное наследование
{
    protected $props = [];

    public function __set($name, $value)
    { //магический метод позволяющий при попытке создать новое поле путем полиморфизма, перехватить и что то сделать с этой попыткой- выдать ошибку, залогировать и пр.
        //TODO проверить по props можно ли вообще менять это поле
        $this->props[$name] = true;
        $this->$name = $value;
    }

    public function __get($name)
    {
        //TODO проверить по props можно ли вообще читать это поле
        return $this->$name;
    }

    public function __isset($name) { //метод для Twig'a
        return isset($this->name);
    }
//для публичных полей магический гет и сет вызываться не будет, имеет смысл для протектед полей и прайват
//с помощью гет сет можно сделать хранилище всех динамически созданных методов, чтобы держать их под контролем
//instanceof - тру или фолз является ли объект экземпляром какого-то класса
//callable - тип данных если передаётся функция внутри функции
}