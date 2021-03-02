<?php


namespace app\models;
use app\interfaces\IModels;
use app\engine\Db;

abstract class Model implements IModels//abstract- мы не можем создать экземпляр абстрактного класса есть ещё final-значит нельзя создавать наследников// интерфейсы поддерживают множественное наследование
{
    protected $db;
    protected $tableName = '';

    public function __construct(Db $db)
    {
        $db = $this->db = $db;
    }




    public function getOne($id) { //вызываем с главной Index.php
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";//формируем запрос
        return $this->db->queryOne($sql); // пробрасываем запрос в вызываемый метод класса ДБ
    }


    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }

    public function getInfoAboutHomeWork($var, $valueGetOne) {
        echo $var->getOne($valueGetOne) . "<br>";
        echo $var->getAll();
        var_dump($var);
    }

    abstract public function getTableName();
}