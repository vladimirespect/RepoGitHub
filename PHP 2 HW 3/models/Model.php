<?php


namespace app\models;

use app\interfaces\IModels;
use app\engine\Db;

abstract class Model implements IModels//abstract- мы не можем создать экземпляр абстрактного класса есть ещё final-значит нельзя создавать наследников// интерфейсы поддерживают множественное наследование
{
    public function __set($name, $value)
    { //магический метод позволяющий при попытке создать новое поле путем полиморфизма, перехватить и что то сделать с этой попыткой- выдать ошибку, залогировать и пр.
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
//для публичных полей магический гет и сет вызываться не будет, имеет смысл для протектед полей и прайват
//с помощью гет сет можно сделать хранилище всех динамически созданных методов, чтобы держать их под контролем
//instanceof - тру или фолз является ли объект экземпляром какого-то класса
//callable - тип данных если передаётся функция внутри функции


    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }


//CRUD Active Record
    public function getOne($id)
    { //вызываем с главной Index.php
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";//формируем запрос
      //  return Db::getInstance()->queryOne($sql, ['id' => $id]); // пробрасываем запрос в вызываемый метод класса ДБ //Db::getInstance() -возвращает экземпляр ДБ
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }

    public function insert() {
        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            // пропустить поле id и для остальных собрать $columns-имена колонок бд и $values-имена плейсхолдеров и $params- массив их значений
           // var_dump($key . " => " . $value);
            if ($key == "id") continue; //до continue не додумался, пришлось подсмотреть у вас
            $params["{$key}"] = $value; //парамс это массив вида ['id' => $this->id], в данном случае значения известны- это $value
           // session_id это значение $key, таким образом я в массив парамс добавляю ассоциативный ключ $key и передаю ему значение $value на каждой итерации перебора полей экземпляра объекта баскет
            $columns[] = $key; //подготавливаю массив для передачи в implode делая ключ $key- значением
        }
        $values = ":" . implode(", :", $columns);
        $columns = implode(", ", $columns);
        //var_dump($values, $columns);
            //!!! использовать имплод- преобразование массива в строку
           // и формируем такую строку  //INSERT INTO {$this->getTableName()}('name', 'description', 'price') VALUES (:name, :description, :price)
            //парамс же будет такой массив - ключ $key реальное значение $value
                   // var_dump($key . " => " . $value);

        //INSERT INTO {$this->getTableName()}('name', 'description', 'price') VALUES (:name, :description, :price)
        //здесь должен сформироваться скуэль запрос на вставку данных columns==столбцы
       $sql = "INSERT INTO {$this->getTableName()} ($columns) VALUES ($values)";//предварительный запрос
       //columns & values это поля объекта и их значения+ дополнительно пробросить айди новой записи с бд
        Db::getInstance()->execute($sql, $params);//довесок со значениями
        $this->id = Db::getInstance()->lastInsertId();//function getInstance() //нужна чтобы мы могли вызвать метод (например execute)  без создания экземпляра класса Db
            return $this;
    }

    public function update() {
        $sql ="";
        $params = [];
//UPDATE `goods` SET `id`=[value-1],`name`=[value-2],`image`=[value-3],`price`=[value-4],`description`=[value-5] WHERE 1
       // $sql = "UPDATE {$this->getTableName()} SET `id`=[value-1],`name`=[value-2],`image`=[value-3],`price`=[value-4],`description`=[value-5] WHERE id = :id" ;//предварительный запрос
        //$sql = "UPDATE {$this->getTableName()} SET `id`=[value-1],`name`=[value-2],`image`=[value-3],`price`=[value-4],`description`=[value-5] WHERE id = :id" ;
        //'UPDATE feed8back SET name='php',feedback='hi' WHERE id =25'
        foreach ($this as $key => $value) {
            if ($key == "id"|| $value == [] ) continue;
            $sql .= "{$key}=:{$key}, ";//$sql .= "{$key}=':{$key}', ";
            $params["{$key}"] = $value;
        }
        $params["id"] = $this->id;
        // var_dump($params);
        $sql = "UPDATE {$this->getTableName()} SET " . mb_substr($sql, 0, -2) . ' WHERE id = :id'; //обрезает последние 2 символа//номер символа/кол-во символов
        Db::getInstance()->execute($sql, $params);
        var_dump(Db::getInstance()->execute($sql, $params));
      var_dump($sql);
    }


    public function delete() {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
        //$this->id сработает так как для каждого образца по шаблону класса оно будет прописано в собственных полях.
        // И этот метод будет вызываться после getOne в котором будет указан конкретный айди
    }

   //END CRUD

    abstract public function getTableName();
}