<?php


namespace app\controllers;

use app\models\entities\{Basket, Orders};
use app\engine\App;

class BasketController extends Controller
{

    public function actionIndex()
    {
        //до 8го урока $session = new Session();
        $session_id = App::call()->session->getId();
        $basket = App::call()->basketRepository->getBasket($session_id);

        echo $this->render('basket', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'basket' => $basket, //в renderTemplate за создание переменной basket отвечает extract
            'ordermessage' => App::call()->session->get('ordermessage')
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

        $id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getId(); //нам нужно чтобы в БД запись добавлялась под сессией конкретного пользователя

        //(new Basket($session->getId(), $id))->save(); был валидным до 7го урока и создания сущностей и репозиториев

        $basket = new Basket($session_id, $id);
        App::call()->basketRepository->save($basket);


        $response = [
            'success' => 'ok',
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id),
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {

        $id = App::call()->request->getParams()['id']; //метод ловит все переменные HTTP-запроса в качестве массива, и по ключу отдаёт нужное значение
        $session_id = App::call()->session->getId();
        App::call()->basketRepository->deleteAnd('id', $id, 'session_id', $session_id);


        //блок для того чтобы JS принял ответ корректно
        $response = [
            'success' => 'ok',
            'count' => App::call()->basketRepository->getCountWhere('session_id', $session_id),
            //'total' => App::call()->session->get('total')
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

//$product = new Product('Чай'...); создаём сущность с новыми данными которую нужно добавить
    //new ProductRepository()->save($product);
    public function actionOrder() {

        $nameInBasket = App::call()->request->getParams()['nameInBasket'];
        $phone = App::call()->request->getParams()['phone'];
        $email = App::call()->request->getParams()['email'];
        $orderAmount = App::call()->request->getParams()['totalBasket'];
        $session_id = App::call()->session->getId(); //нам нужно чтобы в БД запись добавлялась под сессией конкретного пользователя
        $status = "Новый";

        //(new Basket($session->getId(), $id))->save(); был валидным до 7го урока и создания сущностей и репозиториев

        $order = new Orders($nameInBasket, $phone, $email, $session_id, $orderAmount, $status);
        App::call()->ordersRepository->save($order);

        App::call()->session->regenerate();//сбрасывает айди сессии- сбрасывает корзину
        App::call()->session->set('ordermessage',"Заказ успешно оформлен. Спасибо!");
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();

    }

}