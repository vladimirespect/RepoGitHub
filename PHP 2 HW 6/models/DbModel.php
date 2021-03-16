<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    /*public static function getAll()  //заккоментил пока не переделаем,  потому что в контроллере обрабатываем массивы а не объекты
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAllObjects($sql, static::class);
    }
*/

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getWhere ($name, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value ], static::class);
    }

//Создали функцию здесь, задействовали функцию из Db. Вывели переменную в шаблоне menu.
// А значение пробросили через Controller, обратившись через статику к Basket и вызвав в ней этот созданный здесь метод,
// чтобы передать имя TableName.
    public static function getCountWhere ($name, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value ])['count'];//тут же вытащили значение из двумерного массива по ключу каунт
    }


    public static function getLimit($limit) { //2й уровень реализации кнопки 'ещё' из дз 4 . первый в контроллере, третий в Дб
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);
    }

//CRUD Active Record
    public static function getOne($id)
    {
        $tableName = static::getTableName(); //!!!В СТАТИЧНОЙ ФУНКЦИИ $this->> НЕВОЗМОЖЕН
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //  return Db::getInstance()->queryOne($sql, ['id' => $id]); // пробрасываем запрос в вызываемый метод класса ДБ //Db::getInstance() -возвращает экземпляр ДБ
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }

    public function insert() {
        $params = [];
        $sql = "";
        $sqlValue = "";

        foreach ($this->props as $key => $value) {
            $params["{$key}"] = $this->$key; //парамс это массив вида ['id' => $this->id], в данном случае значения известны- это $value
            // session_id это значение $key, таким образом я в массив парамс добавляю ассоциативный ключ $key и передаю ему значение $value на каждой итерации перебора полей экземпляра объекта баскет
            $sql .= "{$key}, ";
            $sqlValue .=":{$key}, ";
        }                                         //'INSERT INTO basket (session_id, goods_id) VALUES (:session_id, :goods_id)'
        $tableName = static::getTableName();
        $sql = mb_substr($sql, 0, -2);
        $sqlValue = mb_substr($sqlValue, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$sql}) VALUES ({$sqlValue})";//предварительный запрос
        Db::getInstance()->execute($sql, $params);//довесок со значениями
        $this->id = Db::getInstance()->lastInsertId();//function getInstance() //нужна чтобы мы могли вызвать метод (например execute)  без создания экземпляра класса Db
        return $this;
    }

    public function update() {
        $params = [];
        $sql = "";
        foreach ($this->props as $key => $value) {
            if (!$value) continue; // если value не true- пропускаем поле.
            $sql .= "{$key}=:{$key}, ";
            $params["{$key}"] = $this->$key;
            $this->props[$key] = false; //возвращаем флажки тру фоллз обратно в фоллз для будущих запросов
        }
        $params["id"] = $this->id;
        $tableName = static::getTableName();
        $sql = "UPDATE {$tableName} SET " . mb_substr($sql, 0, -2) . ' WHERE id = :id';
        Db::getInstance()->execute($sql, $params);
    }


    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
        //$this->id сработает так как для каждого образца по шаблону класса оно будет прописано в собственных полях.
        // И этот метод будет вызываться после getOne в котором будет указан конкретный айди
    }
    //END CRUD

    public static function deleteAnd($name, $value, $name2, $value2) {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE {$name} = :value AND {$name2} = :value2";
        return Db::getInstance()->execute($sql, ['value' => $value , 'value2' => $value2 ]);
    }

    public function save() {
        if(is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    abstract static public function getTableName();
}