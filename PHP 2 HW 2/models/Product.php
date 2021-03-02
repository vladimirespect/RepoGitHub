<?php
//по договоренности с преподавателем имя класса будет полностью соответствовать имени соответствующей таблицы из БД


namespace app\models;//теперь для программы файл Product.php переместился в вымышленную папку my_shop и все инклюды и вызовы экземпляров класса надо делать относительно неё
//проблема в том что в автозагрузчик теперь придёт путь my_shop\Product instead Product with reverse slash from Windows OS

class Product extends Model {
    public $id;
    public $name;
    public $description;
    public $price;

    public function getTableName() {
        return 'product';
    }

}