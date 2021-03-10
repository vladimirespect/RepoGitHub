<?php
//конфигурация подключения, пока использована только в автозагрузчике
define('ROOT_DIR', dirname(__DIR__));//это нарушение ООП поправим к 8му уроку
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER_NAMESPACE', 'app\\controllers\\');
define('VIEWS_DIR', '../views/');

//TODO можно попробовать самостоятельно организовать хранение констант в классе через статику