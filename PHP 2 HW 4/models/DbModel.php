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
        $columns = [];

        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $params[":{$key}"] = $value; //парамс это массив вида ['id' => $this->id], в данном случае значения известны- это $value
            // session_id это значение $key, таким образом я в массив парамс добавляю ассоциативный ключ $key и передаю ему значение $value на каждой итерации перебора полей экземпляра объекта баскет
            $columns[] = $key; //подготавливаю массив для передачи в implode делая ключ $key- значением
        }
        $values = implode(", ", array_keys($params)); //array_keys($params) - извлекает ключи из массива
        $columns = implode(", ", $columns);
        //!!! использовать имплод- преобразование массива в строку
        // и формируем такую строку  //INSERT INTO {$this->getTableName()}('name', 'description', 'price') VALUES (:name, :description, :price)
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ($columns) VALUES ($values)";//предварительный запрос
        //columns & values это поля объекта и их значения+ дополнительно пробросить айди новой записи с бд
        Db::getInstance()->execute($sql, $params);//довесок со значениями
        $this->id = Db::getInstance()->lastInsertId();//function getInstance() //нужна чтобы мы могли вызвать метод (например execute)  без создания экземпляра класса Db
        return $this;
    }

    //TODO подумать как узнать какие поля были затронуты, используя магические методы и реализовать
    //когда закроем поля с именами столбцов не сможем получить доступ через $this->
    public function update() {
        $sql ="";
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == "id"|| $value == [] ) continue; // Ваш комментарий к дз 3: В update не понятно зачем $value == [], это для props будущих?
          // Моё пояснение: не понял что такое props. Но мы же при update на главной указываем поля для изменения, таким образом те поля которые не меняются оказываются массивом с пустым значением, и т.о. они игнорируются и не переопределяются в пустые в БД.
            $sql .= "{$key}=:{$key}, ";
            $params["{$key}"] = $value;
        }
        $params["id"] = $this->id;
        $tableName = static::getTableName();
        $sql = "UPDATE {$tableName} SET " . mb_substr($sql, 0, -2) . ' WHERE id = :id'; //обрезает последние 2 символа//номер символа/кол-во символов
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

    public function save() {
        if(is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    abstract static public function getTableName();
}