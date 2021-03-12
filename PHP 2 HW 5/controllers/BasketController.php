<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{

    public function actionIndex()
    {
        $basket = Basket::getBasket('ch8niidpi0ccb20e37h7c09f0efs3ip4'); //реальная корзина вместо session_id() для проверки дз

        echo $this->render('basket', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'basket' => $basket //в renderTemplate за создание переменной basket отвечает extract
        ]);
    }

}