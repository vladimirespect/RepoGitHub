<?php


namespace app\controllers;

use app\engine\App;



class ProductController extends Controller
{


    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        //код до 8го урока $page = (new Request())->getParams()['page'] ?? 0;

        $page = App::call()->request->getParams()['page'] ?? 0;
        //$catalog = Goods::getAll(); //всё, получили с помощью модели весь каталог) Супер!
        $catalog = App::call()->goodsRepository->getLimit(($page + 1) * App::call()->config['product_per_page']);

        echo $this->render('catalog', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'catalog' => $catalog, //в renderTemplate за создание переменной каталог отвечает extract
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = App::call()->request->getParams()['id'];

        //код до 8го урока $good = (new GoodsRepository())->getOne($id);
        $good = App::call()->goodsRepository->getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }


}