<?php
//дз1 пункт1
class Users
{
    public $login;
    public $pass;
    public $session_id;

    public function __construct($login, $pass, $session_id)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->session_id = $session_id;
    }


    public function say()
    {
        echo "Я твой будущий клиент под логином  " . $this->login . ". <br>";
    }
}

$user = new Users("Admin", 123, "ch8niidpi0ccb20e37h7c09f0efs3ip4");

class Clients extends Users
{
    public $name;
    public $phone;

    public function __construct($login, $pass, $session_id, $name, $phone)
    {
        parent::__construct($login, $pass, $session_id);//указываем ролительский метод и передаём в него данные
        $this->name = $name;
        $this->phone = $phone;
    }
    public function say()
    {
        parent::say();
        echo "И вот я скопил денег и сделал свой заказ, указав личные данные.<br> А именно: моё имя- " . $this->name . ". <br> и мой телефон- " . $this->phone . ". <br>";
    }


}

$client = new Clients("Admin", 123, "ch8niidpi0ccb20e37h7c09f0efs3ip4", "Alex", 89852659790);
$client->say();



class Goods {
    public $goods_id;
    public $price;
    public $name;
    public $image;

    public function __construct($goods_id, $price, $name, $image)
    {
        $this->goods_id = $goods_id;
        $this->price = $price;
        $this->name = $name;
        $this->image = $image;
    }

    public function advertisement()
    {
        echo "Это замечательный " . $this->name . " по замечательной цене: " . $this->price . ". <br>";
    }
}

$good = new Goods(1, 2555, "Коврик", "carpet.jpg");

class Basket extends Goods {
    public $basket_id;

    public function __construct($goods_id, $price, $name, $image, $basket_id)
    {
        parent::__construct($goods_id, $price, $name, $image);
        $this->basket_id = $basket_id;
    }

    public function advertisement()
    {
    parent::advertisement();
    echo "Товар попадёт в корзину под номером: " . $this->basket_id . ". <br>";
    }
}

$basket = new Basket(2, 7585, "Диван", "sofa.jpg", 2);
$basket->session_id = $user->session_id;
$basket->advertisement();

class Sale extends Basket {
    protected $discount;

    public function __construct($goods_id, $price, $name, $image, $basket_id, $discount)
    {
        parent::__construct($goods_id, $price, $name, $image, $basket_id);
        $this->discount = $discount;
    }
    public function discount(Goods $basket)
    {
        $basket->price -= $basket->price*($this->discount/100);
        echo "Я подарю вам скидку в размере: " . $this->discount . "% на весь заказ. <br> Новая стоимость вашего заказа составляет: " . $basket->price . " руб. Спасибо за то, то выбрали наш интернет-магазин!";
    }

}

$salePosition = new Sale (2, 7585, "Диван", "sofa.jpg", 2, 10);
$salePosition->discount($basket);


$client->basket_id = $basket->basket_id;


echo "<br><br>Другие пункты ДЗ<br>Дан код://основной код закоменчен т.к. классы с одинаковым именем выдают  ворнинг";
/*class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();//1
$a2->foo();//2
$a1->foo();//3
$a2->foo();//4
//статичная функция с преинкрементом, место вызова функции разное, а адрес функции и функция одна и та же. static делает переменную одной для всех объектов её класса
// В данном случае статика работает как счётчик i в цикле увеличиваясь за каждую итерацию, т.е. здесь - за каждый вызов функции, т.к. обе переменные принадлежат одному классу.

echo "Что он выведет на каждом шаге? Почему? Немного изменим п.5:";
class A {
    public function foo() {
        static $x = 0;
        echo "<br>".++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();//1
$b1->foo();//1
$a1->foo();//2
$b1->foo();//2
echo " <br>№4. Объясните результаты в этом случае.";
//static делает переменную одной для всех объектов её класса, но не обьектов класса её наследника.
//т.о. переменные a и b- это объекты разных классов, и статичная функция запоминает разные данные переменной для объектов разных классов.
*/


echo "5. *Дан код:";
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo();//1
$b1->foo();//1
$a1->foo();//2
$b1->foo();//2
echo "Что он выведет на каждом шаге? Почему?//вся разница которую я увидел это отсутствие круглых скобок при создании экземпляра класса.
// Думаю что это работает т.к. явно не заданы какие-либо параметры конструктора класса.";
