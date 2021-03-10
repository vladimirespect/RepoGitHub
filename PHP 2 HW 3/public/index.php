<?php
//TODO сделать путь абсолютным
//нужно присвоить неймспейс каждому классу, который соответсвует пути где лежит этот файл+1 папка сверху 'app' во избежании конфлика с библиотеками
//каждому классу соответствует своя страница с именем кк у класса
//каждому образцу вместо длинного имени с полным путём к виртуальной папке обьявить пссевдоним в начале кода через use.
include "../config/config.php";
include "../engine/Autoload.php";


use app\engine\Autoload;//такой список работает в версиях старше 7й
use app\models\{Basket, Feedback, Gallery, Goods, Orders, Users};
use app\engine\Db;

spl_autoload_register([new Autoload(), 'loadClass']); //требует два параметра 1) экземпляр класса автозагрузчика, 2) имя метода его класса отвечающего за загрузку
//плюс в том что создаётся всего один экземпляр автозагрузчика


//INSERT


//поразмышлять что можно сделать чтобы не создавать пустой обьект и после новый
/*$basket = new Basket(5, 6);//TODO закомментил чтобы не вставлять данные при каждом обновлении
$basket->insert(); // вот так должно работать и в бд появится новая запись
var_dump($basket);*/

//DELETE

/*$basket = new Basket();
$basket = $basket->getOne(80);//TODO закомментил чтобы не удалять данные при каждом обновлении
//$basket->delete(); // сделать в дз используя фетч класс со статьи из хабр. Проблема в том что в полях объекта пусто, и надо чтобы гетУан заполнял их полученными данными
var_dump($basket);*/

//$goods = new Goods("чай", "4.jpg", "хороший", 17);

/*$goods = new Goods("чай", "4.jpg", "хороший", 17);
$goods->insert();*/

//UPDATE

/*$goods = new Goods;
$goods = $goods->getOne(4);
var_dump($goods);
$goods->name = "кофе3";
$goods->price = "30";
$goods->update();
var_dump($goods);*///TODO закомментил чтобы не апдейтить данные при каждом обновлении


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



/*
//CREATE
$product = new Product("чай", "цейлонский", 22);
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
$product->update();*/