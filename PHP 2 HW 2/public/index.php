<?php

//нужно присвоить неймспейс каждому классу, который соответсвует пути где лежит этот файл+1 папка сверху 'app' во избежании конфлика с библиотеками
//каждому классу соответствует своя страница с именем кк у класса
//каждому образцу вместо длинного имени с полным путём к виртуальной папке обьявить пссевдоним в начале кода через use.

include "../engine/Autoload.php";

use app\engine\{Autoload, Db as Engine_db};//такой список работает в версиях старше 7й
use app\models\{Product, User, Db};
use app\models\example\Db as Example_db;
use app\my_models\{Basket, Feedback, Gallery, Goods, Orders, Users};
use app\models\example\{Product as ProductHW, Product2, Product3};

spl_autoload_register([new Autoload(), 'loadClass']); //требует два параметра 1) экземпляр класса автозагрузчика, 2) имя метода его класса отвечающего за загрузку
//плюс в том что создаётся всего один экземпляр автозагрузчика

$product = new Product(new Engine_Db()); //namespace в файле Product.php
$product->getInfoAboutHomeWork($product, 1);

$user = new User(new Engine_Db()); //namespace в файле Product.php
$user->getInfoAboutHomeWork($user, 2);
/*echo $user->getOne(2) . "<br>";
echo $user->getAll();
var_dump($user);*/



$db = new Db();
$db->db_models();
var_dump($db);

$Ex_db = new Example_db();
$Ex_db->db_models_example();
var_dump($Ex_db);

$Eng_db = new Engine_db();
$Eng_db->db_engine();
var_dump($Eng_db);






echo "<h3>Мои таблицы</h3>";

$basket = new Basket(new Engine_Db());
$basket->getInfoAboutHomeWork($basket, 3);

$feedback = new Feedback(new Engine_Db());
$feedback->getInfoAboutHomeWork($feedback, 4);

$gallery = new Gallery(new Engine_Db());
$gallery->getInfoAboutHomeWork($gallery, 5);

$goods = new Goods(new Engine_Db());
$goods->getInfoAboutHomeWork($goods, 6);

$orders = new Orders(new Engine_Db());
$orders->getInfoAboutHomeWork($orders, 7);

$users = new Users(new Engine_Db());
$users->getInfoAboutHomeWork($users, 8);






echo "<h3>Третья часть ДЗ</h3>";


$productHW = new ProductHW(1, 100, 3);
var_dump($productHW);
echo $productHW->calc();
$a = \app\models\example\MotherOfProducts::$summ;
echo '<br> Общая сумма покупок на текущий момент: ' . $a . '<br>';

$product2 = new Product2(2, $productHW->price, 3);
var_dump($product2);
echo $product2->calc();
$a = \app\models\example\MotherOfProducts::$summ;
echo '<br> Общая сумма покупок на текущий момент: ' . $a . '<br>';

$product3 = new Product3(3, 100, 1100);
var_dump($product3);
echo $product3->calc();
$a = \app\models\example\MotherOfProducts::$summ;
echo '<br> Общая сумма покупок на текущий момент: ' . $a . '<br>';






























/*spl_autoload_register('loader');//по принципу стека регистрирует автозагрузчики
/spl_autoload_register('loader2');

function loader($className) {
    $load = new Autoload();//создали образец автозагручика класс которого подключили инклюдом-минус способа, многократное создание образцов этого класса
    $load->loadClass($className); //пробрасываем в метод лоадкласс имя класса которому не был создан инклюд на этой странице, имя передастся автоматически через __autoload
}

function loader2($className) {
    $load = new Autoload();//создали образец автозагручика класс которого подключили инклюдом-минус способа, многократное создание образцов этого класса
    $load->loadClass($className); //пробрасываем в метод лоадкласс имя класса которому не был создан инклюд на этой странице, имя передастся автоматически через __autoload
}*/


//$db = new Db();//функция автозагрузчика будет искать ДБ в папке модели и будет фатал вместо инклюда



















//include "../models/Product.php";


die();

//CREATE
$product = new Product();
$product->name = "чай";
$product->insert();

//READ
$product = new Product();
$product->getOne(5); //id// метод класса выполнит селект пробросив айди и взяв данные с собственных полей

//DELETE
$product = new Product();
$product->getOne(5);
$product->delete();//id берёт с поля

//UPDATE
$product = new Product();
$product->getOne(5);
$product->name = "кофе";
$product->update();