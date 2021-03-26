<?php


namespace app\controllers;

use app\models\entities\{Basket, Orders};
use app\models\repositories\{BasketRepository, OrdersRepository};
use app\engine\{Request, Session};

class BasketController extends Controller
{

    public function actionIndex()
    {
        $session = new Session();
        $basket = (new BasketRepository())->getBasket($session->getId());

        if(isset((new Request())->getParams()['ordermessage'])) {
            $ordermessage = "Заказ успешно оформлен. Спасибо!";
        }

        echo $this->render('basket', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'basket' => $basket, //в renderTemplate за создание переменной basket отвечает extract
            'ordermessage' => $ordermessage
        ]);
    }




    public function actionAdd()
    {
        //$id = (int)$_POST['id']; //получили id товара из поля name из формы с шаблона каталога с кнопки купить

        /*после создания класса Request в этом коде отпала необходимость
          $data = json_decode(file_get_contents('php://input')); //в ответе будет тело запроса
        //json_decode превратит ответ в объект

        $id = $data->id; //в объекте создастся поле айди и его значение будет равно айди товара по которому кликнули

        //var_dump($data) в отладчике хрома в Network preview мы увидим наш вар дамп прямо в асинхронном запросе)*/

        $id = (new Request())->getParams()['id'];
        $session = new Session(); //нам нужно чтобы в БД запись добавлялась под сессией конкретного пользователя

        //(new Basket($session->getId(), $id))->save(); был валидным до 7го урока и создания сущностей и репозиториев

        $basket = new Basket($session->getId(), $id);
        (new BasketRepository())->save($basket);


        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session->getId()),
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {

        $id = (new Request())->getParams()['id']; //метод ловит все переменные HTTP-запроса в качестве массива, и по ключу отдаёт нужное значение
        $session = new Session();
        (new BasketRepository())->deleteAnd('id', $id, 'session_id', $session->getId());

        //блок для того чтобы JS принял ответ корректно
        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', $session->getId()),
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

//$product = new Product('Чай'...); создаём сущность с новыми данными которую нужно добавить
    //new ProductRepository()->save($product);
    public function actionOrder() {

        $nameInBasket = (new Request())->getParams()['nameInBasket'];
        $phone = (new Request())->getParams()['phone'];
        $orderAmount = (new Request())->getParams()['totalBasket'];
        $session = new Session(); //нам нужно чтобы в БД запись добавлялась под сессией конкретного пользователя

        //(new Basket($session->getId(), $id))->save(); был валидным до 7го урока и создания сущностей и репозиториев

        $order = new Orders($nameInBasket, $phone, $session->getId(), $orderAmount, 0);
        (new OrdersRepository())->save($order);

        $session->regenerate();//сбрасывает айди сессии- сбрасывает корзину

        header("Location:" . $_SERVER['HTTP_REFERER']); //TODO Уважаемый преподаватель! В РНР1 мы просто передавали ?ordermessage=orderok методом гет в запросе,
        //TODO благодаря чему могли вывести сообщение об успешном оформлении заказа. Подскажите а как это реализовать с ЧПУ?
        die();

    }

}