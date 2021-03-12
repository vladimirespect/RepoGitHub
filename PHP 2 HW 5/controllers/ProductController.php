<?php


namespace app\controllers;

use app\models\{Basket, Feedback, Gallery, Goods, Orders, Users};


class ProductController extends Controller
{


    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = $_GET['page'] ?? 0;
        //$catalog = Goods::getAll(); //всё, получили с помощью модели весь каталог) Супер!
        $catalog = Goods::getLimit(($page + 1) * 2);

        echo $this->render('catalog', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'catalog' => $catalog, //в renderTemplate за создание переменной каталог отвечает extract
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];

        $good = Goods::getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }


}