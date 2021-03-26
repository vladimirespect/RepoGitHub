<?php

use app\engine\{Db, Request, Session, Render, TwigRender};
use app\models\repositories\{UsersRepository, BasketRepository, FeedbackRepository, GalleryRepository, GoodsRepository, OrdersRepository};

return [
    'root_dir' => dirname(__DIR__),
    'ds' => DIRECTORY_SEPARATOR,
    'controllers_namespaces' => 'app\\controllers\\',
    'templates_dir' => dirname(__DIR__) . "/views/",
    'product_per_page' => 2,
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'site',
            'charset' => 'utf-8'
        ],
        /*'db2' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root2',
            'password' => 'root2',
            'database' => 'site2',
            'charset' => 'utf-8'
        ],*/
        'request' => [
            'class' => Request::class
        ],
        'usersRepository' => [
            'class' => UsersRepository::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class
        ],
        'galleryRepository' => [
            'class' => GalleryRepository::class
        ],
        'goodsRepository' => [
            'class' => GoodsRepository::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'render' => [
            'class' => Render::class
        ],
        'twigRender' => [
            'class' => TwigRender::class
        ]

    ]
];


/*define('ROOT_DIR', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLERS_NAMESPACES', 'app\\controllers\\');
define('VIEWS_DIR', '../views/');
define('PRODUCT_PER_PAGE', 2);*/