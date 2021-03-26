<?php


namespace app\models;


use app\engine\Db;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();

    /*public static function getAll()  //заккоментил пока не переделаем,  потому что в контроллере обрабатываем массивы а не объекты
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAllObjects($sql, static::class);
    }
*/

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function getWhere ($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value ], static::class);
    }

//Создали функцию здесь, задействовали функцию из Db. Вывели переменную в шаблоне menu.
// А значение пробросили через Controller, обратившись через статику к Basket и вызвав в ней этот созданный здесь метод,
// чтобы передать имя TableName.
    public function getCountWhere ($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value ])['count'];//тут же вытащили значение из двумерного массива по ключу каунт
    }


    public function getLimit($limit) { //2й уровень реализации кнопки 'ещё' из дз 4 . первый в контроллере, третий в Дб
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);
    }

//CRUD Active Record

//$product = (new ProductRepository())->getOne($id);
    public function getOne($id)
    {
        $tableName = $this->getTableName(); //!!!В СТАТИЧНОЙ ФУНКЦИИ $this->> НЕВОЗМОЖЕН
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //  return Db::getInstance()->queryOne($sql, ['id' => $id]); // пробрасываем запрос в вызываемый метод класса ДБ //Db::getInstance() -возвращает экземпляр ДБ
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }



    //$product = new Product('Чай'...); создаём сущность с новыми данными которую нужно добавить
    //new ProductRepository()->save($product);
    public function insert(Model $entity) {
        $params = [];
        $sql = "";
        $sqlValue = "";

        foreach ($entity->props as $key => $value) {
            $params["{$key}"] = $entity->$key; //парамс это массив вида ['id' => $this->id], в данном случае значения известны- это $value
            // session_id это значение $key, таким образом я в массив парамс добавляю ассоциативный ключ $key и передаю ему значение $value на каждой итерации перебора полей экземпляра объекта баскет
            $sql .= "{$key}, ";
            $sqlValue .=":{$key}, ";
        }                                         //'INSERT INTO basket (session_id, goods_id) VALUES (:session_id, :goods_id)'
        $tableName = $this->getTableName();
        $sql = mb_substr($sql, 0, -2);
        $sqlValue = mb_substr($sqlValue, 0, -2);
        $sql = "INSERT INTO {$tableName} ({$sql}) VALUES ({$sqlValue})";//предварительный запрос
        Db::getInstance()->execute($sql, $params);//довесок со значениями
        $entity->id = Db::getInstance()->lastInsertId();//function getInstance() //нужна чтобы мы могли вызвать метод (например execute)  без создания экземпляра класса Db
    }




//$product = (new ProductRepository())->getOne($id);
//$product->price = 150;
    //new ProductRepository()->save($product); хранилище синхронизируй мне этот продукт
    public function update(Model $entity) {
        $params = [];
        $sql = "";
        foreach ($entity->props as $key => $value) {
            if (!$value) continue; // если value не true- пропускаем поле.
            $sql .= "{$key}=:{$key}, ";
            $params["{$key}"] = $entity->$key;
            $entity->props[$key] = false; //возвращаем флажки тру фоллз обратно в фоллз для будущих запросов
        }
        $params["id"] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET " . mb_substr($sql, 0, -2) . ' WHERE id = :id';
        Db::getInstance()->execute($sql, $params);
    }


    //$product = (new ProductRepository())->getOne($id);
    //new ProductRepository()->delete($product); хранилище удали эту сущность
    public function delete(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $entity->id]);
        //$this->id сработает так как для каждого образца по шаблону класса оно будет прописано в собственных полях.
        // И этот метод будет вызываться после getOne в котором будет указан конкретный айди
    }
    //END CRUD

    public function deleteAnd($name, $value, $name2, $value2) { //TODO убрал статику 18.03.21
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE {$name} = :value AND {$name2} = :value2";
        return Db::getInstance()->execute($sql, ['value' => $value , 'value2' => $value2 ]);
    }

    public function save(Model $entity) {
        if(is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }
}