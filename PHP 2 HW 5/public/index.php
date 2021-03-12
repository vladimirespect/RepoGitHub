<?php

session_start();

use app\engine\Autoload;//такой список работает в версиях старше 7й
use app\models\{Basket, Feedback, Gallery, Goods, Orders, Users};
use app\engine\Render;
use app\engine\TwigRender;


//TODO сделать путь абсолютным
//нужно присвоить неймспейс каждому классу, который соответсвует пути где лежит этот файл+1 папка сверху 'app' во избежании конфлика с библиотеками
//каждому классу соответствует своя страница с именем кк у класса
//каждому образцу вместо длинного имени с полным путём к виртуальной папке обьявить пссевдоним в начале кода через use.
include "../config/config.php";
include "../engine/Autoload.php";
include "../vendor/autoload.php"; //нужен ли неймспейс?



spl_autoload_register([new Autoload(), 'loadClass']); //требует два параметра 1) экземпляр класса автозагрузчика, 2) имя метода его класса отвечающего за загрузку
//плюс в том что создаётся всего один экземпляр автозагрузчика

//ЧПУ    //настройка ЧПУ сделана в файле public/.htaccess под сервер apache
$url = explode('/', $_SERVER['REQUEST_URI']);
/*$url is array (size=3)
  0 => string '' (length=0)
  1 => string 'product' (length=7)
  2 => string 'catalog' (length=7)*/
$controllerName = $url[1] ?: 'product'; //если значения не будет, ставим по умолчанию product пока что//$url[1] ?? 'product'; - с такой записью не работала главная, переписали на тернарный иф
$actionName = $url[2];//имя экшена от пользователя

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
//ucfirst($controllerName) - делает заглавной первую букву для имени класса, пришедшего из url
if (class_exists($controllerClass)) { //проверяем ведь данные пришли от пользователя
    $controller = new $controllerClass(new Render()); //через переменную переменных, создадим динамически объект класса по имени класса от пользователя
    //new $controllerClass(new Render()); - в этом поле теперь можем переключать рендер. В скобочках создаётся объект класса рендер который рендерит шаблоны
    $controller->runAction($actionName);
}

/*Создаётся контроллер в зависимости от того какую страницу хочет пользователь, находится нужный класс,
создаётся его экземпляр, в нём вызывается метод Render
При создании экземпляра в конструктор подставляется экземпляр Twig*/




//READ
/*
$basket = Basket::getAll();
var_dump($basket);
*/


//INSERT
/*
$basket = new Basket(9998888, 88888999);
$basket->save();
var_dump($basket);
*/

//DELETE

/**
 * @var Basket $basket
 */

/*
$basket = Basket::getOne(97);
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
$goods->price = "125";
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