<?php


namespace app\engine;
require_once '../vendor/autoload.php';

use app\interfaces\IRenderer;

class TwigRender implements IRenderer
{

    private $twigObject;


    public function __construct() // додумался до конструктора, но реализовать не смог, создавалось 3 шаблона.
        // Пытался сделать по образу и подобию разового создания объекта PDO, тоже не получилось. Пришлось подсматривать.
        //Controller c public/index.php создаётся один. В его логику внесено создание экземляра контроллера страницы которую хочет пользователь
        //При создании экземпляра в конструктор подставляется экземпляр Twig и вызывается метод Render
        //Таким образом при создании одного конструктора создаётся один экземпляр твиг который хранится в переменной $twigObject
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twigObject = new \Twig\Environment($loader);
    }


    public function renderTemplate($template, $params = []) { //рендерит шаблоны
        return $this->twigObject->render($template. '.twig', $params); //name -переменная из шаблона index.twig
        //для layouta /layout соберётся уровнем выше и придёт сюда уже с именем папки


    }
}

