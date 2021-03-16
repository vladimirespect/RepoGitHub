<?php


namespace app\controllers;


use app\models\Basket;
use app\engine\Request;

class BasketController extends Controller
{

    public function actionIndex()
    {
        $basket = Basket::getBasket(session_id());

        echo $this->render('basket', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'basket' => $basket //в renderTemplate за создание переменной basket отвечает extract
        ]);
    }

    public function actionAdd() {
        //$id = (int)$_POST['id']; //получили id товара из поля name из формы с шаблона каталога с кнопки купить

        /*после создания класса Request в этом коде отпала необходимость
          $data = json_decode(file_get_contents('php://input')); //в ответе будет тело запроса
        //json_decode превратит ответ в объект

        $id = $data->id; //в объекте создастся поле айди и его значение будет равно айди товара по которому кликнули

        //var_dump($data) в отладчике хрома в Network preview мы увидим наш вар дамп прямо в асинхронном запросе)*/

        $id = (new Request())->getParams()['id'];

        $session_id = session_id();//нам нужно чтобы в БД запись добавлялась под сессией конкретного пользователя

        (new Basket($session_id, $id))->save();

        $response = [
            'success' => 'ok',
            'count' => Basket::getCountWhere('session_id',session_id())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
       /* header("Location:" . $_SERVER['HTTP_REFERER']);
        die(); это было нужно для синхронного запроса. */
    }

    public function actionDelete() {

        $basket_id = (new Request())->getParams()['basket_id']; //метод ловит все переменные HTTP-запроса в качестве массива, и по ключу отдаёт нужное значение

        Basket::deleteAnd('id', $basket_id,'session_id', session_id());

        header("Location:" . $_SERVER['HTTP_REFERER']);
         die();
    }

}