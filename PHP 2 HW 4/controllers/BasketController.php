<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{

    public function actionIndex()
    {
        $basket = Basket::getBasket();

        echo $this->render('basket', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'basket' => $basket //в renderTemplate за создание переменной basket отвечает extract
        ]);
    }

}