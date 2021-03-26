<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Orders;


class AdminController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionOrders()
    {
        $admin = App::call()->ordersRepository->getAll();

        echo $this->render('admin', [ //передаём в рендер, в подшаблон каталог массив переменных, в дан.случае одну переменную
            'admin' => $admin, //в renderTemplate за создание переменной basket отвечает extract
            'isAdmin' => App::call()->usersRepository->isAdmin()
        ]);
    }

    public function actionDetails()
    {
        $session_id = App::call()->request->getParams()['basketid'];
        $orderamount = App::call()->request->getParams()['orderamount'];
        $username = App::call()->request->getParams()['username'];
        $order_id = App::call()->request->getParams()['order_id'];
        $statusNow = App::call()->request->getParams()['statusnow'];

        $details = App::call()->basketRepository->getBasket($session_id);

        echo $this->render('details', [
            'details' => $details,
            'orderamount' => $orderamount,
            'status' => App::call()->request->getParams()['status'],
            'username' => $username,
            'order_id' => $order_id, //чтобы передать статус какого заказа был обновлён
            'isAdmin' => App::call()->usersRepository->isAdmin(),
            'statusNow' => $statusNow
        ]);
    }

    public function actionStatus() {
        $status = App::call()->request->getParams()['status'];
        $order_id = App::call()->request->getParams()['order_id'];

        $order = App::call()->ordersRepository->getOne($order_id);
        $order->status = $status;
        App::call()->ordersRepository->save($order);
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }


}