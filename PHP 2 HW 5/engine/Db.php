<?php
//руководство PDO http://phpfaq.ru/pdo  https://habr.com/ru/post/137664/
//ВАЖНО: Подготовленные выражения - основная причина использовать PDO, поскольку это единственный безопасный способ выполнения SQL запросов, в которых участвуют переменные.

namespace app\engine;

use app\traits\TSingletone;

class Db
{
    use TSingletone;

    // use в классе-ключевое слово для подключения трейта (в данном случае паттерна синглтон), работает как инклюд

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3306',
        'login' => 'root',
        'password' => 'root',
        'database' => 'site',
        'charset' => 'utf8'
    ];

    private $connection = null; //PDO object

    private function getConnection()
    { //смысл функции проверить было ли создано подключение, и если да то не создавать его снова, а если нет то создать 1 раз для всех вызовов.
        if (is_null($this->connection)) {
            $this->connection = new \PDO(          //ставим слеш перeд ПДО тк он находится в глобальном пространстве имен, это расширение раскоменчиввается в РНР.ini
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC); //чтобы не писать всегда фетч ассок при запросах
        }
        return $this->connection; //возвращает экземпляр PDO  к которому можно обратиться вне этого метода $this->getConnection()->
    }


    private function prepareDsnString()
    { //sprintf - аналог echo- print, f-форматированный echo, s- с приставкой с он не выводит в поток, а просто возвращает текст.
        return sprintf("%s:host=%s;dbname=%s;charset=%s",//%s- this is placeholder %-признак плэйсхолдера, s- это тип плэйсхолдера, обозначает строку
            $this->config['driver'],    //значения для подстановки
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function lastInsertId()
    {
        // return вернуть айди последней вставленной через инсёрт записи и записать этот айди в поле созданного через инсерт объекта, через геттер так как трейт синглтон приватный
        return $this->connection->lastInsertId();
        //получить доступ к объекту пдо $this->getConnection()-> и вызвать у него ластинсерт айди
    }


    private function query($sql, $params) // в парамс проброшен айди с метода модели квери уан так ['id' => $id]
    {
        $stmt = $this->getConnection()->prepare($sql);//предварительный запрос с именованным плейсхолдером
        $stmt->execute($params); //пробрасываем массив парамс для бинда bindValue()// в таком виде никакой sql-инъекции невозможно
        return $stmt;
    }

    public function queryLimit($sql, $limit) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function queryOneObject($sql, $params, $class) //функция для записи информации в поля объекта из ДЗ к 3му уроку
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        //fetch_class присваивает значения столбцов соотв. свойствам объекта указанного класса
        //значения назначаются до вызова конструктора, если нам это не надо используем | \PDO::FETCH_PROPS_LATE и значения не будут изменены конструктором
        return $stmt->fetch();
    }
/*
    public function queryAllObjects($sql, $class, $params = [])  //заккоментил потому что в контроллере обрабатываем массивы а не объекты
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $stmt->fetchAll();
    }
*/
    public function queryAll($sql, $params = []) // пишем так $params = [], потому что может быть запрос без параметров, и чтобы снаружи не задавать пустой параметр даём значение по умолчанию
    {
        return $this->query($sql, $params)->fetchAll();
    }


    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();//-вернули ко-во затронутых строк, чтобы иметь возможность проконтролировать выполнение запроса
    }

}