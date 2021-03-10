<?php
//TODO сделать путь абсолютным
//нужно присвоить неймспейс каждому классу, который соответсвует пути где лежит этот файл+1 папка сверху 'app' во избежании конфлика с библиотеками
//каждому классу соответствует своя страница с именем кк у класса
//каждому образцу вместо длинного имени с полным путём к виртуальной папке обьявить пссевдоним в начале кода через use.
include "../config/config.php";
include "../engine/Autoload.php";


use app\engine\Autoload;//такой список работает в версиях старше 7й
use app\models\{Basket, Feedback, Gallery, Goods, Orders, Users};


spl_autoload_register([new Autoload(), 'loadClass']); //требует два параметра 1) экземпляр класса автозагрузчика, 2) имя метода его класса отвечающего за загрузку
//плюс в том что создаётся всего один экземпляр автозагрузчика


$controllerName = $_GET['c'] ?? 'product'; //если значения не будет, ставим по умолчанию product пока что
$actionName = $_GET['a'];//имя экшена от пользователя

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
//ucfirst($controllerName) - делает заглавной первую букву для имени класса, пришедшего из url
if (class_exists($controllerClass)) { //проверяем ведь данные пришли от пользователя
    $controller = new $controllerClass(); //через переменную переменных, создадим динамически объект класса по имени класса от пользователя
    $controller->runAction($actionName);
}









//READ
/*
$basket = Basket::getAll();
var_dump($basket);
*/


//INSERT


/*
$basket = new Basket(5885, 55885);
$basket->save();
var_dump($basket);
*/
//DELETE

/**
 * @var Basket $basket
 */

/*
$basket = Basket::getOne(88);
$basket->delete();
var_dump($basket);
*/

/*$goods = new Goods("чай", "4.jpg", "хороший", 17);
$goods->save();*/

//UPDATE
/*


/**
 * @var Goods $goods
 */

/*
$goods = Goods::getOne(5);
var_dump($goods);
$goods->name = "кофе";
$goods->price = "120";
$goods->image = "5.jpg";
$goods->save();
var_dump($goods);
*/

//END

/*
$feedback = new Feedback();
$feedback = $feedback->getOne(18);
var_dump($feedback);

$gallery = new Gallery();
var_dump($gallery->getOne(13));


$orders = new Orders();


$users = new Users();


*/




/*
//CREATE
$product = new Product("чай", "цейлонский", 22);
$product->save();

//READ
$basket = Basket::getOne(88);
$basket = Basket::getAll();

//DELETE
$basket = Basket::getOne(88);
$basket->delete();


//UPDATE
$goods = Goods::getOne(4);
var_dump($goods);
$goods->name = "кофе3";
$goods->price = "30";
$goods->save();
var_dump($goods);*/